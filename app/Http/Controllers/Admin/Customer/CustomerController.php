<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Requests;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Repositories\Customer\CustomerRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Customer\Customer;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Customertype\CustomerType;
use DB;

class CustomerController extends InfyOmBaseController
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->customerRepository->pushCriteria(new RequestCriteria($request));
        $customers = $this->customerRepository->all();
        return view('admin.customer.customers.index')
            ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        $customer_type = CustomerType::get();
        return view('admin.customer.customers.create')->with('customer_type',$customer_type);
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        //dd($request);
        $input = $request->all();

        $customer = $this->customerRepository->create($input);

        Flash::success('Customer saved successfully.');

        return redirect(route('admin.customer.customers.index'));
    }

    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->findWithoutFail($id);
        $serviceorder_details = DB::table('serviceorderss')->where('customer_no', $customer->id)->get();
        //dd( $comments_details);


        $customer = array(
            "id" => $customer->id,
            "customername" => $customer->customername,
            "customer_no" => $customer->customer_no,
            "t_i_n_number" => $customer->t_i_n_number,
            "serviceorder_details" => $serviceorder_details,
            "v_a_t_registration_number" => $customer->v_a_t_registration_number,
            "business_license_number" => $customer->business_license_number,
            "contact_person" => $customer->contact_person,
            "position_held" => $customer->position_held,
            "contact_telephone" => $customer->contact_telephone,
            "office_telephone" => $customer->office_telephone,
            "email" => $customer->email,
            "postal_address" => $customer->postal_address,
            "region" => $customer->region,
            "district" => $customer->district,
            "fax" => $customer->fax,
            "customer_type" => $customer->customer_type,
            "created_at" => $customer->created_at,
            "updated_at" => $customer->updated_at,
            "deleted_at" => $customer->deleted_at,
            "country" => $customer->country,




        );
       // dd($customer);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('admin.customer.customers.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customer_type = CustomerType::get();
        $customer = $this->customerRepository->findWithoutFail($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('admin.customer.customers.edit')->with('customer', $customer)->with('customer_type',$customer_type);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = $this->customerRepository->findWithoutFail($id);

        

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        $customer = $this->customerRepository->update($request->all(), $id);

        Flash::success('Customer updated successfully.');

        return redirect(route('admin.customer.customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.customer.customers.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Customer::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.customer.customers.index'))->with('success', Lang::get('message.success.delete'));

       }

}
