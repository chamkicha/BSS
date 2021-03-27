<?php

namespace App\Http\Controllers;

use App\Models\Serviceapproval;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;
use Flash;
use Illuminate\Support\Facades\Auth;

class ServiceapprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function show(Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function edit(Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serviceapproval $serviceapproval)
    {
        //
    }

    
    public function serviceapprove(Request $request)
    {    
        // if commercial manager aprove

        if ($request->next_handler_role_id==='3' && $request->req_status==='approved') {
            
            $nexthandler = DB::table('role_users')->where('role_id','6')->get();
            $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
            $nexthandler_role = $nexthandler[0]->id;
            $nexthandler_role_id = '6';
            $prevhandler_role = DB::table('role_users')->where('role_id','3')->get();
            $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
            $prevhandler_role = $prevhandler_role[0]->id;
            $prevhandler_role_id = '3';
            $nexthandler1 = $nexthandler[0]->first_name;
            $nexthandler2 = $nexthandler[0]->last_name;
            $nexthandler3 = ' ';
            $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
            
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['next_handler' => $nexthandler, 'next_handler_role' => $nexthandler_role, 'next_handler_role_id' => $nexthandler_role_id, 'prev_handler_role' => $prevhandler_role, 'prev_handler_role_id' => $prevhandler_role_id]);
        
        Flash::success('ServiceOrders updated successfully.');
        return redirect(route('admin.serviceOrders.serviceOrders.index'));
    
        } elseif($request->next_handler_role_id==='6' && $request->req_status==='approved') {

            // if technical manager aprove

            $nexthandler = DB::table('role_users')->where('role_id','3')->get();
            $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
            $nexthandler_role = $nexthandler[0]->id;
            $nexthandler_role_id = '3';
            $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
            $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
            $prevhandler_role = $prevhandler_role[0]->id;
            $prevhandler_role_id = '6';
            $nexthandler1 = $nexthandler[0]->first_name;
            $nexthandler2 = $nexthandler[0]->last_name;
            $nexthandler3 = ' ';
            $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
            
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['next_handler' => $nexthandler, 'next_handler_role' => $nexthandler_role, 'next_handler_role_id' => $nexthandler_role_id, 'prev_handler_role' => $prevhandler_role, 'prev_handler_role_id' => $prevhandler_role_id]);
        
        Flash::success('ServiceOrders updated successfully.');
        return redirect(route('admin.serviceOrders.serviceOrders.index'));

        }elseif($request->next_handler_role_id==='3' && $request->req_status==='activated' && $request->prev_handler_role_id==='6') {
            $servicestatues = DB::table('servicestatuss')->where('id','1')->get();
            $servicestatues = $servicestatues[0]->service_status_name;
            $activationdate = $request->activation_date;
            $activatedby1= Sentinel::getUser()->first_name;
            $activatedby2= Sentinel::getUser()->last_name;
            $activatedby=$activatedby1.$activatedby2;
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['service_status' => $servicestatues, 'activation_date' => $activationdate, 'activated_by' => $activatedby]);

            // service billing creation
            $bill_no = DB::table('servicebillings')->orderBy('bill_no', 'desc')->first();
            if(is_null($bill_no)){
           $bill_no = 1000;
            }else{
                $bill_no = $bill_no->bill_no + 1;
            }
            
            $customer_name = $request->customer_name;
            $customer_no = $request->customer_no;
            $service_order_no =$request->order_i_d;
            $sub_total =$request->sub_total;
            $tax_amount =$request->tax_amount;
            $ed_amount =$request->ed_amount;
            $discount =$request->discount;
            $grand_total =$request->grand_total;

            // service billing insert into database
            $bill_creation = DB::table('servicebillings')
            ->insert(['bill_no' => $bill_no, 
                      'customer_name' => $customer_name, 
                      'customer_no' => $customer_no, 
                      'service_order_no' => $service_order_no,
                      'billing_date' => $activationdate,
                      'sub_total' => $sub_total,
                      'tax_amount' => $tax_amount,
                      'ed_amount' => $ed_amount,
                      'discount' => $discount,
                      'grand_total' => $grand_total]);


                      
            // Payment and Due creation
            
            $customer_no = $request->customer_no;
            $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

            if(is_null($payment_due)){

            // PAYMENT AND DUE insert into database
            $grand_total_due =$request->grand_total;
            $bill_creation = DB::table('paymentanddues')
            ->insert(['customer_name' => $customer_name,
                     'total_amount' => $grand_total_due,
                     'balance' => $grand_total_due,
                      'customer_no' => $customer_no,]);


            }else{
                
                // PAYMENT AND DUE update into database
                $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                $grand_total2 = $grand_total3[0]->total_amount;
                $grand_total1 = $request->grand_total;
                $grand_total4 = $grand_total1 + $grand_total2;
                $balance = $grand_total3[0]->balance;
                $balance = $balance + $grand_total1;
                
                
                $bill_creation = DB::table('paymentanddues')
                ->where('customer_no', $customer_no)
                ->update(['total_amount' => $grand_total4,
                         'balance' => $balance]);
            } // END PAYMEND AND DUE CREATIONM

            

            // INVOICE creation
            $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
            if(is_null($invoice_number)){
           $invoice_number = 1000;
            }else{
                $invoice_number = $invoice_number->invoice_number + 1;
            }
            
            $cusromer_name = $request->customer_name;
            $customer_no = $request->customer_no;
            $service_order_no =$request->order_i_d;
            $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
            
            $due_balance = $due_balance->total_amount;
            $current_charges =$request->grand_total;
            $payment_amount =$request->grand_total;
            $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
            $payment_status = $payment_status[0]->payment_type_name;
            $current_charges =$request->grand_total;
            $service_name =$request->service_lists;

            // INVOICE insert into database
            $invoice_creation = DB::table('serviceinvoices')
            ->insert(['invoice_number' => $invoice_number,
                      'cusromer_name' => $cusromer_name, 
                      'customer_no' => $customer_no, 
                      'current_charges' => $current_charges, 
                      'service_order_no' => $service_order_no,
                      'invoice_created_date' => $activationdate,
                      'due_balance' => $due_balance,
                      'service_name' => $service_name,
                      'payment_amount' => $payment_amount,
                      'payment_status' => $payment_status,
                      'sub_total' => $sub_total,
                      'tax_amount' => $tax_amount,
                      'ed_amount' => $ed_amount,
                      'discount' => $discount,
                      'grand_total' => $grand_total]);



        Flash::success('ServiceOrders updated successfully.');
        return redirect(route('admin.serviceOrders.serviceOrders.index'));
            
                    } // end IF kubwa


       // dd($nexthandler_role);
        

    }
}
