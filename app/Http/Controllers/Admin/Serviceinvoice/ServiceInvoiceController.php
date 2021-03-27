<?php

namespace App\Http\Controllers\Admin\Serviceinvoice;

use App\Http\Requests;
use App\Http\Requests\Serviceinvoice\CreateServiceInvoiceRequest;
use App\Http\Requests\Serviceinvoice\UpdateServiceInvoiceRequest;
use App\Repositories\Serviceinvoice\ServiceInvoiceRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Serviceinvoice\ServiceInvoice;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class ServiceInvoiceController extends InfyOmBaseController
{
    /** @var  ServiceInvoiceRepository */
    private $serviceInvoiceRepository;

    public function __construct(ServiceInvoiceRepository $serviceInvoiceRepo)
    {
        $this->serviceInvoiceRepository = $serviceInvoiceRepo;
    }

    /**
     * Display a listing of the ServiceInvoice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->serviceInvoiceRepository->pushCriteria(new RequestCriteria($request));
        $serviceInvoices = $this->serviceInvoiceRepository->all();
        return view('admin.serviceInvoice.serviceInvoices.index')
            ->with('serviceInvoices', $serviceInvoices);
    }

    /**
     * Show the form for creating a new ServiceInvoice.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.serviceInvoice.serviceInvoices.create');
    }

    /**
     * Store a newly created ServiceInvoice in storage.
     *
     * @param CreateServiceInvoiceRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceInvoiceRequest $request)
    {
        $input = $request->all();

        $serviceInvoice = $this->serviceInvoiceRepository->create($input);

        Flash::success('ServiceInvoice saved successfully.');

        return redirect(route('admin.serviceInvoice.serviceInvoices.index'));
    }

    /**
     * Display the specified ServiceInvoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);
        $customer_details = DB::table('customers')->where('id', $serviceInvoice->customer_no)->first();
        $postal_address = $customer_details->postal_address;
        $district = $customer_details->district;
        $region = $customer_details->region;
        $country = $customer_details->country;
        $t_i_n_number = $customer_details->t_i_n_number;
        $v_a_t_registration_number = $customer_details->v_a_t_registration_number;
        $previous_dept = DB::table('paymentanddues')->where('customer_no', $serviceInvoice->customer_no)->first();
        $previous_dept = $previous_dept->total_amount;
        $service_name = (array)json_decode($serviceInvoice['service_name'], true);
        //$service_name=implode(",",$service_name);
        //$service_name = $serviceInvoice->service_name;
        $service_name_description = DB::table('products')->whereIn('product_name', $service_name)->get();
        //dd($service_name_description);
        
        $serviceInvoice = array(
            "id" => $serviceInvoice->id,
            "invoice_number" => $serviceInvoice->invoice_number,
            "customer_no" => $serviceInvoice->customer_no,
            "invoice_created_date" => $serviceInvoice->invoice_created_date,
            "invoice_due_date" => $serviceInvoice->invoice_due_date,
            "cusromer_name" => $serviceInvoice->cusromer_name,
            "service_order_no" => $serviceInvoice->service_order_no,
            "due_balance" => $serviceInvoice->due_balance,
            "current_charges" => $serviceInvoice->current_charges,
            "payment_amount" => $serviceInvoice->payment_amount,
            "payment_status" => $serviceInvoice->payment_status,
            "service_name" => $service_name,
            "service_name_description" => $service_name_description,
            "created_at" => $serviceInvoice->created_at,
            "updated_at" => $serviceInvoice->updated_at,
            "deleted_at" => $serviceInvoice->deleted_at,
            "postal_address" => $postal_address,
            "previous_dept" => $previous_dept,
            "district" => $district,
            "region" => $region,
            "country" => $country,
            "t_i_n_number" => $t_i_n_number,
            "v_a_t_registration_number" => $v_a_t_registration_number,
        );
        //dd($serviceInvoice);

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        return view('admin.serviceInvoice.serviceInvoices.show')->with('serviceInvoice', $serviceInvoice);
    }

    /**
     * Show the form for editing the specified ServiceInvoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        return view('admin.serviceInvoice.serviceInvoices.edit')->with('serviceInvoice', $serviceInvoice);
    }

    /**
     * Update the specified ServiceInvoice in storage.
     *
     * @param  int              $id
     * @param UpdateServiceInvoiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceInvoiceRequest $request)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);

        

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        $serviceInvoice = $this->serviceInvoiceRepository->update($request->all(), $id);

        Flash::success('ServiceInvoice updated successfully.');

        return redirect(route('admin.serviceInvoice.serviceInvoices.index'));
    }

    /**
     * Remove the specified ServiceInvoice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.serviceInvoice.serviceInvoices.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ServiceInvoice::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.serviceInvoice.serviceInvoices.index'))->with('success', Lang::get('message.success.delete'));

       }

}
