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
        $serviceOrders = $this->serviceOrdersRepository->all();
        return view('admin.serviceOrders.serviceOrders.index')
            ->with('serviceOrders', $serviceOrders);
    }

    /**
     * Show the form for creating a new ServiceOrders.
     *
     * @return Response
     */
    public function create()
    {

        
        $customer_list = Customer::get();
        $paymentmode_list = Paymentmode::get();
        $service_order_type = DB::table('serviceordertypes')->get();
        $product_list = Product::get();
        return view('admin.serviceOrders.serviceOrders.create')
        ->with('customer_list', $customer_list)
        ->with('paymentmode_list', $paymentmode_list)
        ->with('service_order_type', $service_order_type)
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
        //dd($request);    
        
        $input = $request->all();
        $sub_total1 = $request->service_lists;
        
        $sub_total2 = DB::table('products')->whereIn('product_name', $sub_total1)
                  ->sum('grand_total');
        
        $customer_name = $request->customer_name;
        $customer_no = DB::table('customers')->where('customername', $customer_name)->get();
        $customer_no = $customer_no[0]->id;

        // tax amount
        $tax_amount = DB::table('products')->whereIn('product_name', $sub_total1)
                                            ->sum('vat_amount');

        // ED AMOUNT
        $ed_amount = DB::table('products')->whereIn('product_name', $sub_total1)
                                        ->sum('ed_amount');

        // SUB TOTAL
        $sub_total = DB::table('products')->whereIn('product_name', $sub_total1)
                                        ->sum('price');


        // DISCOUNT
        $discount =$request->discount;

        // GRAND TOTAL
        $grand_total = $sub_total2 - $discount;
        
       
        $object = array(
            'order_i_d' => $request->order_i_d,
            'customer_name' => $request->customer_name,
            'customer_no' => $customer_no,
            'payment_mode' => $request->payment_mode,
            'serviceordertypes' => $request->serviceordertypes,
            'service_status' => $request->service_status,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'tax_amount' => $tax_amount,
            'ed_amount' => $ed_amount,
            'req_status' => $request->req_status,
            //'tax_value' => $request->tax_amount,
            'discount' => $request->discount,
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

        $service_name_description = DB::table('products')->whereIn('product_name', $serviceOrders->service_lists)->get();
        $customer_details = DB::table('customers')->where('id', $serviceOrders->customer_no)->get();
        $comments_details = DB::table('comments')->where('order_i_d', $serviceOrders->order_i_d)->get();
        
        //dd($serviceOrders);


       $serviceOrders = array(
        "id" => $serviceOrders->id,
        "order_i_d" =>$serviceOrders->order_i_d,
        "customer_name" => $serviceOrders->customer_name,
        "customer_no" => $serviceOrders->customer_no,
        "comments_details" => $comments_details,
        "customer_details" => $customer_details,
        "payment_mode" => $serviceOrders->payment_mode,
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
        $paymentmode_list = Paymentmode::get();
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


       

}
