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
        $product_list = Product::get();
        return view('admin.serviceOrders.serviceOrders.create')
        ->with('customer_list', $customer_list)
        ->with('paymentmode_list', $paymentmode_list)
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
        
        $input = $request->all();
        $sub_total = $request->service_lists;
        $sub_total = DB::table('products')->whereIn('product_name', $sub_total)
                  ->sum('price');
        $customer_name = $request->customer_name;
        $customer_no = DB::table('customers')->where('customername', $customer_name)->get();
        $customer_no = $customer_no[0]->id;
        // tax amount

        $tax_amount =$request->tax_amount;
        $tax_amount = $tax_amount * 0.01;
        $tax_amount = $tax_amount * $sub_total;

        // ED AMOUNT

        $ed_amount =$request->ed_amount;
        $ed_amount = $ed_amount * 0.01;
        $ed_amount = $ed_amount * $sub_total;

        // DISCOUNT

        $discount =$request->discount;

        // GRAND TOTAL

        $grand_total =$sub_total + $tax_amount + $ed_amount - $discount;
       
        $object = array(
            'order_i_d' => $request->order_i_d,
            'customer_name' => $request->customer_name,
            'customer_no' => $customer_no,
            'payment_mode' => $request->payment_mode,
            'service_status' => $request->service_status,
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'tax_amount' => $tax_amount,
            'ed_amount' => $ed_amount,
            'discount' => $request->discount,
            'service_starting_date' => $request->service_starting_date,
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
        $paymentmode_list = Paymentmode::get();
        $product_list = Product::get();

        if (empty($serviceOrders)) {
            Flash::error('ServiceOrders not found');

            return redirect(route('serviceOrders.index'));
        }
        

        return view('admin.serviceOrders.serviceOrders.edit')->with('serviceOrders', $serviceOrders)
        ->with('customer_list', $customer_list)
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
