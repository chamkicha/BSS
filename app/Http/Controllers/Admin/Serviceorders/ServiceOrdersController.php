<?php

namespace App\Http\Controllers\Admin\Serviceorders;

use App\Http\Requests;
use App\Http\Requests\Serviceorders\CreateServiceOrdersRequest;
use App\Http\Requests\Serviceorders\UpdateServiceOrdersRequest;
use App\Repositories\Serviceorders\ServiceOrdersRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Serviceorders\ServiceOrders;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Customer\Customer;
use App\Models\Paymentmode\Paymentmode;
use App\Models\Product\Product;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;


class ServiceOrdersController extends InfyOmBaseController
{
    /** @var  ServiceOrdersRepository */
    private $serviceOrdersRepository;

    public function __construct(ServiceOrdersRepository $serviceOrdersRepo)
    {
        $this->serviceOrdersRepository = $serviceOrdersRepo;
    }

    /**
     * Display a listing of the ServiceOrders.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->serviceOrdersRepository->pushCriteria(new RequestCriteria($request));
        $serviceOrders = $this->serviceOrdersRepository->orderBy('order_i_d', 'desc')->get();
        //dd($serviceOrders);
        if(count($serviceOrders)=='0')
        {
            return view('admin.serviceOrders.serviceOrders.index')
            ->with('serviceOrders', $serviceOrders);
        }else{
        $client_product = DB::table('clientproducts')->where('service_order_no',$serviceOrders[0]->order_i_d)->get();
        return view('admin.serviceOrders.serviceOrders.index')
            ->with('client_product', $client_product)
            ->with('serviceOrders', $serviceOrders);
        }
    }

    /**
     * Show the form for creating a new ServiceOrders.
     *
     * @return Response
     */
    public function create()
    {

        
        $customer_list = Customer::get();
        $paymentmode_list = DB::table('paymentmodes')->get();
        $service_order_type = DB::table('serviceordertypes')->get();
        $product_list = Product::get();
        //dd($product_list);
        return view('admin.serviceOrders.serviceOrders.create')
        ->with('customer_list', $customer_list)
        ->with('paymentmode_list', $paymentmode_list)
        ->with('service_order_type', $service_order_type)
        ->with('product_listz', $product_list)
        ->with('product_list', $product_list);
    }

    /**
     * Store a newly created ServiceOrders in storage.
     *
     * @param CreateServiceOrdersRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceOrdersRequest $request)
    {      
        //dd($request->all());    
        
        $this->validate($request, [
            'customer_name'  => 'required',
            'payment_mode' => 'required',
            'serviceordertypes' => 'required',
            'service_creation_date' => 'required',
            'service_ending_date' => 'required',
            'service_lists' => 'required',
        ]);
        $service_order_no = $this->serviceorder_no();
        $input = $request->all();
        $service_lists = $request->service_lists;
        //Get Month count
        $product_type = DB::table('products')->whereIn('id', $service_lists)->first()->product_type;
        if($product_type == 'Web Hosting'){
            $monthly_count = 1 ;
        }else{
        $monthly_count = DB::table('paymentmodes')->where('payment_interval', $request->payment_mode)
                  ->first()->monthly_count;
        }
        
        //customer no
        $customer_name = $request->customer_name;
        $customer_no = DB::table('customers')->where('customername', $customer_name)->get();
        $customer_no = $customer_no[0]->id;


        // ED AMOUNT
        $ed_amount = DB::table('products')->whereIn('id', $service_lists)
                                        ->sum('ed_amount');


        // GRAND TOTAL
        $grand_ttl_product = 0.00;

        foreach($request->service_lists as $product_id){
            $check_discount = DB::table('products')->where('id', $product_id)->first()->product_type;
            
            if($check_discount == 'COLOCATION' or $check_discount == 'Virtual Server'){
                $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
                $product = DB::table('products')->where('id', $product_id)->get();
                $product_count = $request->item_quantity[$product_id];
                $grand_ttl_product = $grand_ttl * $product_count;
                
                $discount =$request->discount;
                $discount = $discount * 0.01;

                $grand_ttl_product = $grand_ttl_product - ($grand_ttl_product * $discount);

                $final_total[] = $grand_ttl_product;
                
                $client_product = DB::table('clientproducts')
                                    ->insert(['client_no' => $customer_no, 
                                                'product_id' => $product_id, 
                                                'service_order_no' => $service_order_no, 
                                                'product_quantity' => $product_count, 
                                                'product_name' => $product[0]->product_name, 
                                                'product_description' => $product[0]->description, 
                                                'price' => $product[0]->price * $monthly_count, 
                                                'vat_amount' => $product[0]->vat_amount * $monthly_count, 
                                                'amount' => $final_total[0] * $monthly_count, 
                                                'created_at' => $request->service_creation_date,]);

                
            }else{
            $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
            $product = DB::table('products')->where('id', $product_id)->get();
            $product_count = $request->item_quantity[$product_id];
            $final_total[] = $grand_ttl * $product_count;
                
            $client_product = DB::table('clientproducts')
                            ->insert(['client_no' => $customer_no, 
                                        'product_id' => $product_id, 
                                        'service_order_no' => $service_order_no, 
                                        'product_quantity' => $product_count, 
                                        'product_name' => $product[0]->product_name, 
                                        'product_description' => $product[0]->description, 
                                        'price' => $product[0]->price * $monthly_count, 
                                        'vat_amount' => $product[0]->vat_amount * $monthly_count, 
                                        'amount' => $final_total[0] * $monthly_count, 
                                        'created_at' => $request->service_creation_date,]);
          }
        }

        // GRAND TOTAL
        $grand_total = array_sum($final_total);
        $grand_total = $grand_total * $monthly_count;



        // TAX AMOUNT
        $tax_amount = 0.00;

        foreach($request->service_lists as $product_id){
            $check_discount = DB::table('products')->where('id', $product_id)->first()->product_type;
            
            if($check_discount == 'COLOCATION' or $check_discount == 'Virtual Server'){
                $tax_amount = DB::table('products')->where('id', $product_id)->first()->vat_amount;
                $product_count = $request->item_quantity[$product_id];
                $tax_amount_product = $tax_amount * $product_count;
                
                $discount =$request->discount;
                $discount = $discount * 0.01;
                $tax_amount_product = $tax_amount_product - ($tax_amount_product * $discount);

                $final_tax_amount[] = $tax_amount_product;
                
                
                $client_product_vat_update = DB::table('clientproducts')
                                    ->where('product_id',$product_id)
                                    ->update(['vat_amount' => $final_tax_amount[0] * $monthly_count,]);

                
            }else{
            $tax_amount = DB::table('products')->where('id', $product_id)->first()->vat_amount;
            $product_count = $request->item_quantity[$product_id];
            $final_tax_amount[] = $tax_amount * $product_count;
          }
        }

        // TAX AMOUNT
        $tax_amount = array_sum($final_tax_amount);
        $tax_amount = $tax_amount * $monthly_count;

        

        // SUB TOTAL
        $sub_total = 0.00;

        foreach($request->service_lists as $product_id){
            $check_discount = DB::table('products')->where('id', $product_id)->first()->product_type;
            
            if($check_discount == 'COLOCATION' or $check_discount == 'Virtual Server'){
                $sub_total = DB::table('products')->where('id', $product_id)->first()->price;
                $product_count = $request->item_quantity[$product_id];
                $sub_total_product = $sub_total * $product_count;
                
                $discount =$request->discount;
                $discount = $discount * 0.01;

                $sub_total_product = $sub_total_product - ($sub_total_product * $discount);
                $final_sub_total[] = $sub_total_product;

                $client_product_subtotal_update = DB::table('clientproducts')
                                    ->where('product_id',$product_id)
                                    ->update(['price' => $final_sub_total[0] * $monthly_count,]);

                
            }else{
            $sub_total = DB::table('products')->where('id', $product_id)->first()->price;
            $product_count = $request->item_quantity[$product_id];
            $final_sub_total[] = $sub_total * $product_count;
          }
        }

        // SUB TOTAL
        $sub_total = array_sum($final_sub_total);
        $sub_total = $sub_total * $monthly_count;


       
        $object = array(
            'order_i_d' => $service_order_no,
            'customer_name' => $request->customer_name,
            'customer_no' => $customer_no,
            'payment_mode' => $request->payment_mode,
            'serviceordertypes' => $request->serviceordertypes,
            'service_status' => $request->service_status,
            //'item_quantity' => $request->item_quantity,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'tax_amount' => $tax_amount,
            'ed_amount' => $ed_amount,
            'req_status' => $request->req_status,
            //'tax_value' => $request->tax_amount,
            'discount' => $request->discount,
            //'discount_value' => $discount_value,
            'service_creation_date' => $request->service_creation_date,
            'service_ending_date' => $request->service_ending_date,
            'service_descriptions' => $request->service_descriptions,
            'service_lists' => $request->service_lists,
            'next_handler' => $request->next_handler,
            'next_handler_role' => $request->next_handler_role,
            'next_handler_role_id' => $request->next_handler_role_id,
            'created_by' => $request->created_by
        );

        //dd($object);

       $serviceOrders = $this->serviceOrdersRepository->create($object);

    //    foreach($request->service_lists as $service_name)
    //    {
        
    //     // DISCOUNT PER PRODUCT
    //     $sub_total = DB::table('products')->where('product_name', $service_name)
    //                                     ->sum('grand_total');
        
    //     // DESCRIPTION PER PRODUCT
    //     $description = DB::table('products')->where('product_name', $service_name)
    //                                     ->first()->description;


    //     $discount =$request->discount;
    //     $discount = $discount * 0.01;
    //     $discount_value = $sub_total * $discount ;

    //     // GRAND TOTAL PER PRODUCT
    //     $grand_total = $sub_total - $discount_value;
    //     $grand_total = $grand_total * $monthly_count;


    //     // tax amount PER PRODUCT
    //     //$tax_amount = DB::table('products')->whereIn('product_name', $service_lists)->sum('vat_amount');
    //     $tax_amount = $grand_total / 1.18;
    //     $tax_amount = $grand_total - $tax_amount;

    //     // SUB TOTAL PER PRODUCT
    //     $sub_total = $grand_total / 1.18;

    //     $client_product = DB::table('productsserviceorders')
    //                     ->insert([ 
    //                                 'product_name' => $service_name, 
    //                                 'description' => $description, 
    //                                 'sub_total' => $sub_total, 
    //                                 'vat_amount' => $tax_amount, 
    //                                 'grand_total' => $grand_total, 
    //                                 'order_i_d' => $request->order_i_d, 
    //                                 'created_at' => $request->service_creation_date,]);
        
    //    }

       
        
        $nexthandler_email = $this->next_handler_email_sent($service_order_no,$request->customer_name,$request->created_by);

        Flash::success('ServiceOrders saved successfully.');

        return redirect(route('admin.serviceOrders.serviceOrders.index'));
    }

    /**
     * Display the specified ServiceOrders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serviceOrders = $this->serviceOrdersRepository->findWithoutFail($id);
//dd($serviceOrders);
        $service_name_description = DB::table('clientproducts')->where('service_order_no', $serviceOrders->order_i_d)->get();
        $customer_details = DB::table('customers')->where('id', $serviceOrders->customer_no)->get();
        $comments_details = DB::table('comments')->where('order_i_d', $serviceOrders->order_i_d)->get();
        $tech_user = DB::table('role_users')->where('role_id', '5')
                                            ->leftJoin('users', 'users.id', '=', 'role_users.user_id')
                                            ->select('users.id','users.first_name','users.last_name')
                                           ->get();

        $payment_mode = DB::table('paymentmodes')
                            ->where('payment_interval', $serviceOrders->payment_mode)
                            ->first()->payment_mode_name;

        
        //dd($service_name_description);


       $serviceOrders = array(
        "id" => $serviceOrders->id,
        "order_i_d" =>$serviceOrders->order_i_d,
        "customer_name" => $serviceOrders->customer_name,
        "customer_no" => $serviceOrders->customer_no,
        "comments_details" => $comments_details,
        "customer_details" => $customer_details,
        "payment_mode" => $payment_mode,
        "serviceordertypes" => $serviceOrders->serviceordertypes,
        "service_status" => $serviceOrders->service_status,
        "sub_total" => $serviceOrders->sub_total,
        "tax_amount" => $serviceOrders->tax_amount,
        "ed_amount" => $serviceOrders->ed_amount,
        "grand_total" => $serviceOrders->grand_total,
        "service_creation_date" =>$serviceOrders->service_creation_date,
        "service_ending_date" => $serviceOrders->service_ending_date,
        "service_descriptions" => $serviceOrders->service_descriptions,
        "service_lists" => $serviceOrders->service_lists,
        "service_name_description" => $service_name_description,
        "next_handler" => $serviceOrders->next_handler,
        "created_at" => $serviceOrders->created_at,
        "updated_at" => $serviceOrders->updated_at,
        "created_by" => $serviceOrders->created_by,
        "next_handler_role" => $serviceOrders->next_handler_role,
        "next_handler_role_id" => $serviceOrders->next_handler_role_id,
        "prev_handler_role" => $serviceOrders->prev_handler_role,
        "prev_handler_role_id" => $serviceOrders->prev_handler_role_id,
        "req_status" => $serviceOrders->req_status,
        "activation_date" => $serviceOrders->activation_date,
        "activated_by" => $serviceOrders->activated_by,
        "discount" => $serviceOrders->discount,
        "ed_value" => $serviceOrders->ed_value,
        "tax_value" => $serviceOrders->tax_value,
        "tech_user" => $tech_user,
       );

      //dd($serviceOrders);





        if (empty($serviceOrders)) {
            Flash::error('ServiceOrders not found');

            return redirect(route('serviceOrders.index'));
        }

        return view('admin.serviceOrders.serviceOrders.show')->with('serviceOrders', $serviceOrders);
    }

    /**
     * Show the form for editing the specified ServiceOrders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serviceOrders = $this->serviceOrdersRepository->findWithoutFail($id);
        $customer_list = Customer::get();
        $service_order_type = DB::table('serviceordertypes')->get();
        $paymentmode_list = DB::table('paymentmodes')->get();;
        $product_list = Product::get();

        if (empty($serviceOrders)) {
            Flash::error('ServiceOrders not found');

            return redirect(route('serviceOrders.index'));
        }
        

        return view('admin.serviceOrders.serviceOrders.edit')->with('serviceOrders', $serviceOrders)
        ->with('customer_list', $customer_list)
        ->with('service_order_type', $service_order_type)
        ->with('paymentmode_list', $paymentmode_list)
        ->with('product_list', $product_list);
    }

    /**
     * Update the specified ServiceOrders in storage.
     *
     * @param  int              $id
     * @param UpdateServiceOrdersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceOrdersRequest $request)
    {
        $serviceOrders = $this->serviceOrdersRepository->findWithoutFail($id);

        

        if (empty($serviceOrders)) {
            Flash::error('ServiceOrders not found');

            return redirect(route('serviceOrders.index'));
        }

        $serviceOrders = $this->serviceOrdersRepository->update($request->all(), $id);

        Flash::success('ServiceOrders updated successfully.');

        return redirect(route('admin.serviceOrders.serviceOrders.index'));
    }

    /**
     * Remove the specified ServiceOrders from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.serviceOrders.serviceOrders.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ServiceOrders::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.serviceOrders.serviceOrders.index'))->with('success', Lang::get('message.success.delete'));

       }

    // SEND NEXT_HANDLER EMAIL FUNCTION
    public function next_handler_email_sent($service_order_no,$customer_name,$created_by)
    {

        $mail_subjects = 'Service Order '.$service_order_no. ' for customer '.$customer_name. ' was created by '.$created_by;
        $mail_content = 'Hello Gloria, Please login to BSS (10.60.83.218) to approve  the Service Order generated';

        Mail::raw($mail_content, function ($message)use ($mail_subjects) {
            $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
            $message->to('gloria.muhazi@nidc.co.tz')
                    ->cc('commercial@nidc.co.tz')
                    ->bcc('nidctanzania@gmail.com')
                        ->subject($mail_subjects);
        });
     }
     // END SEND NEXT_HANDLER EMAIL FUNCTION


     
public function serviceorder_no()
{   

              
    $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first();
    
    if(is_null($serviceorder)){

        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
 
        $serviceorder3 = 1000;
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;

    }else{
        $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first()->order_i_d;
        $serviceorder=substr($serviceorder, -4);
        $serviceorder3 = e($serviceorder) + 1;
        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;
    }
        return $serviceorder;
} 
       

}
