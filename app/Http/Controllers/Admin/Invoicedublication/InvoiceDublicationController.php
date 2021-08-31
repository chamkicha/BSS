<?php

namespace App\Http\Controllers\Admin\Invoicedublication;

use App\Http\Requests;
use App\Http\Requests\Invoicedublication\CreateInvoiceDublicationRequest;
use App\Http\Requests\Invoicedublication\UpdateInvoiceDublicationRequest;
use App\Repositories\Invoicedublication\InvoiceDublicationRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Invoicedublication\InvoiceDublication;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use Carbon\Carbon;
use Mail;



class InvoiceDublicationController extends InfyOmBaseController
{
    /** @var  InvoiceDublicationRepository */
    private $invoiceDublicationRepository;

    public function __construct(InvoiceDublicationRepository $invoiceDublicationRepo)
    {
        $this->invoiceDublicationRepository = $invoiceDublicationRepo;
    }

    /**
     * Display a listing of the InvoiceDublication.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->invoiceDublicationRepository->pushCriteria(new RequestCriteria($request));
        $invoiceDublications = $this->invoiceDublicationRepository->all();
        return view('admin.invoiceDublication.invoiceDublications.index')
            ->with('invoiceDublications', $invoiceDublications);
    }

    /**
     * Show the form for creating a new InvoiceDublication.
     *
     * @return Response
     */
    public function create()
    {
        $invoice_nos = DB::table('serviceinvoices')->where('deleted_at', null)->get();
        return view('admin.invoiceDublication.invoiceDublications.create')->with('invoice_nos' , $invoice_nos);
    }

    /**
     * Store a newly created InvoiceDublication in storage.
     *
     * @param CreateInvoiceDublicationRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoiceDublicationRequest $request)
    {
        $invoice_details = DB::table('serviceinvoices')->where('id' , $request->invoice_no)->first();



            // INVOICE creation
            $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
            if(is_null($invoice_number)){
            $invoice_number = 1000;
            }else{
                $invoice_number = $invoice_number->invoice_number + 1;
            }  
             // check contract validation
            $service_validation = DB::table('serviceorderss')
                                 ->where('order_i_d', $invoice_details->service_order_no)
                                 ->first();
            $service_status = $service_validation->service_status;

            // check invoice deletion
           $service_deletion = DB::table('serviceinvoices')
                                ->where('invoice_number', $invoice_details->invoice_number)
                                ->first()->deleted_at;

            if($service_status == 'Active' && is_null($service_deletion)){


                        
                $service_order_no = $invoice_details->service_order_no;
                
                
                //customer no
                $customer_no = $invoice_details->customer_no;
                $customer_name = DB::table('customers')->where('id', $customer_no)->first()->customername;

                // GRAND TOTAL
                $products_list = DB::table('clientproducts')->where('service_order_no', $service_order_no)->get();
                $service_order_details = DB::table('serviceorderss')->where('order_i_d', $service_order_no)->first();
                    // GRAND TOTAL

                foreach($products_list as $product_list){

                        //Get Month count
                    $product_type = DB::table('products')->where('id', $product_list->product_id)->first()->product_type;
                    
                   if($product_type != 'Initial Payment'){
                       
                    // Sub Total
                    $price = $product_list->price;
                    $product_sub_grand[] = $price;
                    
                    // Tax Total
                    $vat_amount = $product_list->vat_amount;
                    $product_vat[] = $vat_amount;
                    
                    // Grand Total
                    $amount = $product_list->amount;
                    $product_grand_total[] = $amount;


                    $client_product = DB::table('invoice_product')
                                        ->insert(['client_no' => $product_list->client_no, 
                                                    'product_id' => $product_list->product_id, 
                                                    'service_order_no' => $product_list->service_order_no, 
                                                    'product_quantity' => $product_list->product_quantity, 
                                                    'product_name' => $product_list->product_name, 
                                                    'product_description' => $product_list->product_description, 
                                                    'price' => $price, 
                                                    'vat_amount' => $vat_amount, 
                                                    'amount' => $amount, 
                                                    'invoice_no' => $invoice_number, 
                                                    'created_at' => date('Y-m-d H:i:s'),]);
                    }
                 }

                // GRAND TOTAL + SUB TOTAL + TAX AMOUNT
                $grand_total_sub_grand = array_sum($product_sub_grand);
                $grand_total_vat = array_sum($product_vat);
                $grand_total = array_sum($product_grand_total);

                $activation_date = date('Y-m-d');
                
                // next_invoice_date creation
                $payment_mode_intervals = DB::table('serviceorderss')->where('order_i_d', $invoice_details->service_order_no)->first()->payment_mode;
                // $next_invoice_date = Carbon::parse($today)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($request->invoice_creation_date)->addDays(4)->format('Y-m-d');
                //dd($next_invoice_date);
                
                $cusromer_name = $invoice_details->cusromer_name;
                $customer_no = $invoice_details->customer_no;
                $service_order_no =$invoice_details->service_order_no;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$grand_total;
                $payment_amount =$grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                //$sub_total = $grand_total_sub_grand;
                //$tax_amount = $grand_total_vat;
                $discount = $invoice_details->discount;
                ///$grand_total = $grand_total;
                $previous_dept = $this->previous_dept($customer_no,$grand_total);

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $request->invoice_creation_date,
                        'next_invoice_date' => $request->next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'payment_amount' => $payment_amount,
                        'payment_status' => $payment_status,
                        'sub_total' => $grand_total_sub_grand,
                        'tax_amount' => $grand_total_vat,
                        'first_invoice' => 0,
                        'discount' => $discount,
                        'previous_dept' => $previous_dept,
                        'grand_total' => $grand_total]);

                        $subjects = 'Invoice '.$invoice_number. ' generated for '.$cusromer_name.' from '.Carbon::parse($request->invoice_creation_date)->format('d-m-Y').' to '.Carbon::parse($request->next_invoice_date)->format('d-m-Y');
                        $content = 'Please login to BSS (10.60.83.218) to check the Invoice generated';

                        Mail::raw($content, function ($message)use ($subjects) {
                            $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
                            $message->to('bssadmin@nidc.co.tz','bahati.otaigo@nidc.co.tz','augustino.irafay@nidc.co.tz','commercial@nidc.co.tz')
                            //$message->to('nidctanzania@gmail.com')
                                     ->subject($subjects)
                                    ->cc('nidctanzania@gmail.com');
                        });



                        // Payment and Due creation
                        $customer_no = $invoice_details->customer_no;

                        $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                        if(is_null($payment_due)){

                        // PAYMENT AND DUE insert into database
                        $bill_creation = DB::table('paymentanddues')
                        ->insert(['customer_name' => $customer_name,
                                'total_amount' => $grand_total,
                                'balance' => $grand_total,
                                'customer_no' => $customer_no,]);


                        }else{
                            
                            // PAYMENT AND DUE update into database
                            $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                            $grand_total2 = $grand_total3[0]->total_amount;
                            $grand_total1 = $grand_total;
                            $grand_total4 = $grand_total1 + $grand_total2;
                            $balance = $grand_total3[0]->balance;
                            $balance = $balance + $grand_total1;
                            //dd($grand_total4);
                            
                            $bill_creation = DB::table('paymentanddues')
                            ->where('customer_no', $customer_no)
                            ->update(['total_amount' => $grand_total4,
                                    'balance' => $balance]);
                        } // END PAYMEND AND DUE CREATIONM

                        $request_id = DB::table('serviceinvoices')->where('invoice_number',$invoice_number)->first()->id;
                        return redirect(route('admin.serviceInvoice.serviceInvoices.show', [$request_id]))->with('success', 'service invoice successful');
                

          }

          
    }

    /**
     * Display the specified InvoiceDublication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoiceDublication = $this->invoiceDublicationRepository->findWithoutFail($id);

        if (empty($invoiceDublication)) {
            Flash::error('InvoiceDublication not found');

            return redirect(route('invoiceDublications.index'));
        }

        return view('admin.invoiceDublication.invoiceDublications.show')->with('invoiceDublication', $invoiceDublication);
    }

    /**
     * Show the form for editing the specified InvoiceDublication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoiceDublication = $this->invoiceDublicationRepository->findWithoutFail($id);

        if (empty($invoiceDublication)) {
            Flash::error('InvoiceDublication not found');

            return redirect(route('invoiceDublications.index'));
        }

        return view('admin.invoiceDublication.invoiceDublications.edit')->with('invoiceDublication', $invoiceDublication);
    }

    /**
     * Update the specified InvoiceDublication in storage.
     *
     * @param  int              $id
     * @param UpdateInvoiceDublicationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoiceDublicationRequest $request)
    {
        $invoiceDublication = $this->invoiceDublicationRepository->findWithoutFail($id);

        

        if (empty($invoiceDublication)) {
            Flash::error('InvoiceDublication not found');

            return redirect(route('invoiceDublications.index'));
        }

        $invoiceDublication = $this->invoiceDublicationRepository->update($request->all(), $id);

        Flash::success('InvoiceDublication updated successfully.');

        return redirect(route('admin.invoiceDublication.invoiceDublications.index'));
    }

    /**
     * Remove the specified InvoiceDublication from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.invoiceDublication.invoiceDublications.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = InvoiceDublication::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.invoiceDublication.invoiceDublications.index'))->with('success', Lang::get('message.success.delete'));

       }

       


    public function previous_dept($customer_no,$grand_total){

        
        $previous_dept = DB::table('paymentanddues')->where('customer_no', $customer_no)->where('customer_no', $customer_no)->first();
        $previous_dept = $previous_dept->total_amount;
        if($previous_dept === $grand_total){
            
            $previous_dept ='0';
            return $previous_dept;
        }
        else{
            $previous_dept = $previous_dept; 
            return $previous_dept;
        }
    }

}
