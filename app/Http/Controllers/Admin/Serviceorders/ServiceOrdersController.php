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
        foreach($serviceOrders as $serviceOrder){
        $client_product[] = DB::table('clientproducts')->where('service_order_no',$serviceOrder->order_i_d)->count();
        }
        $customer_name = DB::table('customers')->where('customername',$serviceOrder->customer_name)->get();
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
            'customer_no'  => 'required',
            'payment_mode' => 'required',
            'serviceordertypes' => 'required',
            'service_creation_date' => 'required',
            'service_ending_date' => 'required',
            'service_lists' => 'required',
        ]);
        $service_order_no = $this->serviceorder_no();
        $input = $request->all();
        $service_lists = $request->service_lists;
        
        
        //customer no
        $customer_no = $request->customer_no;
        $customer_name = DB::table('customers')->where('id', $customer_no)->first()->customername;
        //dd($customer_name);


        // ED AMOUNT
        $ed_amount = DB::table('products')->whereIn('id', $service_lists)
                                        ->sum('ed_amount');


        // GRAND TOTAL
        $grand_ttl_product = 0.00;

        foreach($request->service_lists as $product_id){

                //Get Month count
            $product_type = DB::table('products')->whereIn('id', $service_lists)->first()->product_type;
            if($product_type == 'Web Hosting'){
                $monthly_count = 1 ;
            }else{
            $monthly_count = DB::table('paymentmodes')->where('payment_interval', $request->payment_mode)
                    ->first()->monthly_count;
            }

            $check_discount = DB::table('products')->where('id', $product_id)->first()->product_type;
            
            if($check_discount == 'COLOCATION' or $check_discount == 'Virtual Server' or $check_discount == 'VPN service(IPSec)'){
                $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
                $product = DB::table('products')->where('id', $product_id)->first();
                $product_count = $request->item_quantity[$product_id];
                $discount = $request->discount[$product_id];
                $grand_ttl_product = $grand_ttl * $product_count;
                
                $discount = $discount * 0.01;

                $grand_ttl_product = $grand_ttl_product - ($grand_ttl_product * $discount);

                //$final_total[] = $grand_ttl_product;

                $product_sub_grand_value = $product->price * $monthly_count * $product_count;
                $product_sub_grand_discounted_value = $product_sub_grand_value - ($product_sub_grand_value * $discount);
                $product_sub_grand[] = $product_sub_grand_discounted_value;

                $product_vat_value = $product->vat_amount * $monthly_count * $product_count;
                $product_vat_discounted_value = $product_vat_value - ($product_vat_value * $discount);
                $product_vat[] = $product_vat_discounted_value;

                $product_grand_total_value = $product_sub_grand_discounted_value + $product_vat_discounted_value;
                $product_grand_total[] = $product_grand_total_value;
                
                $client_product = DB::table('clientproducts')
                                    ->insert(['client_no' => $customer_no, 
                                                'product_id' => $product_id, 
                                                'service_order_no' => $service_order_no, 
                                                'product_quantity' => $product_count, 
                                                'product_name' => $product->product_name, 
                                                'product_description' => $product->description, 
                                                'price' => $product_sub_grand_discounted_value, 
                                                'vat_amount' => $product_vat_discounted_value, 
                                                'amount' => $product_grand_total_value, 
                                                'created_at' => $request->service_creation_date,]);
                
                // foreach($final_total as $final_totals){
                // $client_product_amount = DB::table('clientproducts')
                //                     ->where('product_id',$product_id)
                //                     ->update(['amount' => $grand_ttl_product * $monthly_count]);
                // }

                
            }else{
                $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
                $product = DB::table('products')->where('id', $product_id)->first();
                $product_count = $request->item_quantity[$product_id];
                $grand_ttl_product = $grand_ttl * $product_count;
                
                //$discount =$request->discount;
                $discount = 0;

                //$grand_ttl_product = $grand_ttl_product - ($grand_ttl_product * $discount);

                //$final_total[] = $grand_ttl_product;

                $product_sub_grand_value = $product->price * $monthly_count * $product_count;
                $product_sub_grand[] = $product_sub_grand_value;
                //$product_sub_grand_discounted = $product_sub_grand - ($product_sub_grand * $discount);

                $product_vat_value = $product->vat_amount * $monthly_count * $product_count;
                $product_vat[] = $product_vat_value;
                //$product_vat_discounted = $product_vat - ($product_vat * $discount);

                $product_grand_total_value = ($product->price * $monthly_count * $product_count) + ($product->vat_amount * $monthly_count * $product_count);
                $product_grand_total[] = $product_grand_total_value;

                $client_product = DB::table('clientproducts')
                                    ->insert(['client_no' => $customer_no, 
                                                'product_id' => $product_id, 
                                                'service_order_no' => $service_order_no, 
                                                'product_quantity' => $product_count, 
                                                'product_name' => $product->product_name, 
                                                'product_description' => $product->description, 
                                                'price' => $product_sub_grand_value, 
                                                'vat_amount' => $product_vat_value, 
                                                'amount' => $product_grand_total_value, 
                                                'created_at' => $request->service_creation_date,]);
          }
        }

        // GRAND TOTAL
        $grand_total_sub_grand = array_sum($product_sub_grand);
        $grand_total_vat = array_sum($product_vat);
        $grand_total = array_sum($product_grand_total);
        //$grand_total = $grand_total * $monthly_count;


       
        $object = array(
            'order_i_d' => $service_order_no,
            'customer_name' => $customer_name,
            'customer_no' => $customer_no,
            'payment_mode' => $request->payment_mode,
            'serviceordertypes' => $request->serviceordertypes,
            'service_status' => $request->service_status,
            //'item_quantity' => $request->item_quantity,
            'sub_total' => $grand_total_sub_grand,
            'grand_total' => $grand_total,
            'tax_amount' => $grand_total_vat,
            'ed_amount' => $ed_amount,
            'req_status' => $request->req_status,
            //'tax_value' => $request->tax_amount,
            'discount' => $discount * 100,
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
        //dd($request);
        $this->validate($request, [
            'customer_no'  => 'required',
            'payment_mode' => 'required',
            'serviceordertypes' => 'required',
            'service_creation_date' => 'required',
            'service_ending_date' => 'required',
            'service_lists' => 'required',
        ]);
        $service_order_no = $this->serviceorder_no();
        $input = $request->all();
        $service_lists = $request->service_lists;
        
        
        //customer no
        $customer_no = $request->customer_no;
        $customer_name = DB::table('customers')->where('id', $customer_no)->first()->customername;
        //dd($customer_name);


        // ED AMOUNT
        $ed_amount = DB::table('products')->whereIn('id', $service_lists)
                                        ->sum('ed_amount');

        // DELETE ON clientproducts table
         DB::table('clientproducts')->where('service_order_no', $request->order_i_d)->delete();

        // GRAND TOTAL
        $grand_ttl_product = 0.00;
        foreach($request->service_lists as $product_id){

                //Get Month count
            $product_type = DB::table('products')->whereIn('id', $service_lists)->first()->product_type;
            if($product_type == 'Web Hosting'){
                $monthly_count = 1 ;
            }else{
            $monthly_count = DB::table('paymentmodes')->where('payment_interval', $request->payment_mode)
                    ->first()->monthly_count;
            }

            $check_discount = DB::table('products')->where('id', $product_id)->first()->product_type;
            
            if($check_discount == 'COLOCATION' or $check_discount == 'Virtual Server' or $check_discount == 'VPN service(IPSec)'){
                $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
                $product = DB::table('products')->where('id', $product_id)->first();
                $product_count = $request->item_quantity[$product_id];
                $discount = $request->discount[$product_id];
                $grand_ttl_product = $grand_ttl * $product_count;
                
                $discount = $discount * 0.01;

                $grand_ttl_product = $grand_ttl_product - ($grand_ttl_product * $discount);

                //$final_total[] = $grand_ttl_product;

                $product_sub_grand_value = $product->price * $monthly_count * $product_count;
                $product_sub_grand_discounted_value = $product_sub_grand_value - ($product_sub_grand_value * $discount);
                $product_sub_grand[] = $product_sub_grand_discounted_value;

                $product_vat_value = $product->vat_amount * $monthly_count * $product_count;
                $product_vat_discounted_value = $product_vat_value - ($product_vat_value * $discount);
                $product_vat[] = $product_vat_discounted_value;

                $product_grand_total_value = $product_sub_grand_discounted_value + $product_vat_discounted_value;
                $product_grand_total[] = $product_grand_total_value;
                
                $client_product = DB::table('clientproducts')
                                    ->insert(['client_no' => $customer_no, 
                                                'product_id' => $product_id, 
                                                'service_order_no' => $request->order_i_d, 
                                                'product_quantity' => $product_count, 
                                                'product_name' => $product->product_name, 
                                                'product_description' => $product->description, 
                                                'price' => $product_sub_grand_discounted_value, 
                                                'vat_amount' => $product_vat_discounted_value, 
                                                'amount' => $product_grand_total_value, 
                                                'created_at' => $request->service_creation_date,]);
                
                // foreach($final_total as $final_totals){
                // $client_product_amount = DB::table('clientproducts')
                //                     ->where('product_id',$product_id)
                //                     ->update(['amount' => $grand_ttl_product * $monthly_count]);
                // }

                
            }else{
                $grand_ttl = DB::table('products')->where('id', $product_id)->first()->grand_total;
                $product = DB::table('products')->where('id', $product_id)->first();
                $product_count = $request->item_quantity[$product_id];
                $grand_ttl_product = $grand_ttl * $product_count;
                
                //$discount =$request->discount;
                $discount = 0;

                //$grand_ttl_product = $grand_ttl_product - ($grand_ttl_product * $discount);

                //$final_total[] = $grand_ttl_product;

                $product_sub_grand_value = $product->price * $monthly_count * $product_count;
                $product_sub_grand[] = $product_sub_grand_value;
                //$product_sub_grand_discounted = $product_sub_grand - ($product_sub_grand * $discount);

                $product_vat_value = $product->vat_amount * $monthly_count * $product_count;
                $product_vat[] = $product_vat_value;
                //$product_vat_discounted = $product_vat - ($product_vat * $discount);

                $product_grand_total_value = ($product->price * $monthly_count * $product_count) + ($product->vat_amount * $monthly_count * $product_count);
                $product_grand_total[] = $product_grand_total_value;

                $client_product = DB::table('clientproducts')
                                    ->insert(['client_no' => $customer_no, 
                                                'product_id' => $product_id, 
                                                'service_order_no' => $request->order_i_d, 
                                                'product_quantity' => $product_count, 
                                                'product_name' => $product->product_name, 
                                                'product_description' => $product->description, 
                                                'price' => $product_sub_grand_value, 
                                                'vat_amount' => $product_vat_value, 
                                                'amount' => $product_grand_total_value, 
                                                'created_at' => $request->service_creation_date,]);
          }
        }

        // GRAND TOTAL
        $grand_total_sub_grand = array_sum($product_sub_grand);
        $grand_total_vat = array_sum($product_vat);
        $grand_total = array_sum($product_grand_total);
        //$grand_total = $grand_total * $monthly_count;



       
        $object = array(
            'order_i_d' => $request->order_i_d,
            'customer_name' => $customer_name,
            'customer_no' => $customer_no,
            'payment_mode' => $request->payment_mode,
            'serviceordertypes' => $request->serviceordertypes,
            //'item_quantity' => $request->item_quantity,
            'sub_total' => $grand_total_sub_grand,
            'grand_total' => $grand_total,
            'tax_amount' => $grand_total_vat,
            'ed_amount' => $ed_amount,
            //'tax_value' => $request->tax_amount,
            'discount' => $discount * 100,
            //'discount_value' => $discount_value,
            'service_creation_date' => $request->service_creation_date,
            'service_ending_date' => $request->service_ending_date,
            'service_descriptions' => $request->service_descriptions,
            'service_lists' => $request->service_lists,
        );

        $serviceOrders = $this->serviceOrdersRepository->findWithoutFail($id);

        

        if (empty($serviceOrders)) {
            Flash::error('ServiceOrders not found');

            return redirect(route('serviceOrders.index'));
        }

        $serviceOrders = $this->serviceOrdersRepository->update($object, $id);

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