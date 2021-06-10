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
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Mail;
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
    
   public function deactivate_customer(Request $request)
   {
        
    $customer_details_update = DB::table('customers')->where('id', $request->id)->update(['customer_status'=> $request->customer_status]);
    $customer = $this->customerRepository->findWithoutFail($request->id);
    $serviceorder_details = DB::table('serviceorderss')->where('customer_no', $customer->id)->where('deleted_at', NULL)->get();
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
        "created_by" => $customer->created_by,
        "customer_status" => $customer->customer_status,




    );
    // dd($customer);

    if (empty($customer)) {
        Flash::error('Customer not found');

        return redirect(route('customers.index'));
    }

    return view('admin.customer.customers.show')->with('customer', $customer);



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
        
        $this->validate($request, [
            'customername'  => ['required', 'unique:customers,customername'],
            
            't_i_n_number' => 'required',
            'contact_person' => 'required',
            'contact_telephone' => 'required',
            'office_telephone' => 'required',
            'email' => 'required',
            'customer_type' => 'required',
        ]);

 //dd($request);
        // Business_licence file
        if($request->has('Business_licence')){
            // Get filename with the extension
            $Business_licenceWithExt = $request->file('Business_licence')->getClientOriginalName();
            //Get just filename
            $Business_licence = pathinfo($Business_licenceWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Business_licence')->getClientOriginalExtension();
            // Filename to store
            $Business_licenceToStore = 'Business_licence'."_".$request->customer_no."_".date('d-m-Y-H-i').'.'.$extension;
            // Upload Image
            $Business_licence = $request->file('Business_licence')->storeAs('public/client_docs', $Business_licenceToStore);
        }else{ $Business_licence = null; }

        // Certificate_of_incorporation file
        if($request->has('Certificate_of_incorporation')){
            // Get filename with the extension
            $Certificate_of_incorporationWithExt = $request->file('Certificate_of_incorporation')->getClientOriginalName();
            //Get just filename
            $Certificate_of_incorporation = pathinfo($Certificate_of_incorporationWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Certificate_of_incorporation')->getClientOriginalExtension();
            // Filename to store
            $Certificate_of_incorporationToStore = 'Certificate_of_incorporation'."_".$request->customer_no."_".date('d-m-Y-H-i').'.'.$extension;
            // Upload Image
            $Certificate_of_incorporation = $request->file('Certificate_of_incorporation')->storeAs('public/client_docs', $Certificate_of_incorporationToStore);
        }else{ $Certificate_of_incorporation = null; }


        // TIN_registeration_number file
        if($request->has('TIN_registeration_number')){
            // Get filename with the extension
            $TIN_registeration_numberWithExt = $request->file('TIN_registeration_number')->getClientOriginalName();
            //Get just filename
            $TIN_registeration_number = pathinfo($TIN_registeration_numberWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('TIN_registeration_number')->getClientOriginalExtension();
            // Filename to store
            $TIN_registeration_numberToStore = 'TIN_registeration_number'."_".$request->customer_no."_".date('d-m-Y-H-i').'.'.$extension;
            // Upload Image
            $TIN_registeration_number = $request->file('TIN_registeration_number')->storeAs('public/client_docs', $TIN_registeration_numberToStore);
        }else{ $TIN_registeration_number = null; }
            

        // Tax_exemption_certification file
        if($request->has('Tax_exemption_certification')){
            // Get filename with the extension
            $Tax_exemption_certificationWithExt = $request->file('Tax_exemption_certification')->getClientOriginalName();
            //Get just filename
            $Tax_exemption_certification = pathinfo($Tax_exemption_certificationWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Tax_exemption_certification')->getClientOriginalExtension();
            // Filename to store
            $Tax_exemption_certificationToStore = 'Tax_exemption_certification'."_".$request->customer_no."_".date('d-m-Y-H-i').'.'.$extension;
            // Upload Image
            $Tax_exemption_certification = $request->file('Tax_exemption_certification')->storeAs('public/client_docs', $Tax_exemption_certificationToStore);
        }else{ $Tax_exemption_certification = null; }



        $input = array(

            "_token" => $request->_token,
            "customer_no" => $request->customer_no,
            "customername" => $request->customername,
            "t_i_n_number" => $request->t_i_n_number,
            "v_a_t_registration_number" => $request->v_a_t_registration_number,
            "business_license_number" => $request->business_license_number,
            "customer_type" => $request->customer_type,
            "contact_person" => $request->contact_person,
            "position_held" => $request->position_held,
            "contact_telephone" => $request->contact_telephone,
            "office_telephone" => $request->office_telephone,
            "email" => $request->email,
            "postal_address" => $request->postal_address,
            "region" => $request->region,
            "country" => $request->country,
            "district" => $request->district,
            'created_by'=>$request->created_by,
            "fax" => $request->fax,
            "Business_licence_file" => $Business_licence,
            "Certificate_of_incorporation_file" => $Certificate_of_incorporation,
            "TIN_registeration_number_file" => $TIN_registeration_number,
            "Tax_exemption_certification_file" => $Tax_exemption_certification,
        );

        $customer = $this->customerRepository->create($input);

        

        $mail_subjects = 'Customer '.$request->customername. ' created by '.$request->created_by.' on '.Carbon::now()->format('d-m-Y');
        $mail_content = 'Hello.,'.'Customer '.$request->customername. ' was created by '.$request->created_by.' on '.Carbon::now()->format('d-m-Y'). 'Please login to BSS (10.60.83.218) to Verify';

        Mail::raw($mail_content, function ($message)use ($mail_subjects) {
            $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
            $message->to('gloria.muhazi@nidc.co.tz')
                     ->cc('commercial@nidc.co.tz')
                     ->bcc('nidctanzania@gmail.com')
                        ->subject($mail_subjects);
        });


        //Flash::success('Customer saved successfully.');

        return redirect(route('admin.customer.customers.index'))->with('success', 'customer successfully created');
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
        $serviceorder_details = DB::table('serviceorderss')->where('customer_no', $customer->id)->where('deleted_at', NULL)->get();
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
            "created_by" => $customer->created_by,
            "customer_status" => $customer->customer_status,




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
