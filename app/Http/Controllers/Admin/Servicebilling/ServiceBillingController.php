<?php

namespace App\Http\Controllers\Admin\Servicebilling;

use App\Http\Requests;
use App\Http\Requests\Servicebilling\CreateServiceBillingRequest;
use App\Http\Requests\Servicebilling\UpdateServiceBillingRequest;
use App\Repositories\Servicebilling\ServiceBillingRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Servicebilling\ServiceBilling;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ServiceBillingController extends InfyOmBaseController
{
    /** @var  ServiceBillingRepository */
    private $serviceBillingRepository;

    public function __construct(ServiceBillingRepository $serviceBillingRepo)
    {
        $this->serviceBillingRepository = $serviceBillingRepo;
    }

    /**
     * Display a listing of the ServiceBilling.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->serviceBillingRepository->pushCriteria(new RequestCriteria($request));
        $serviceBillings = $this->serviceBillingRepository->all();
        return view('admin.serviceBilling.serviceBillings.index')
            ->with('serviceBillings', $serviceBillings);
    }

    /**
     * Show the form for creating a new ServiceBilling.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.serviceBilling.serviceBillings.create');
    }

    /**
     * Store a newly created ServiceBilling in storage.
     *
     * @param CreateServiceBillingRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceBillingRequest $request)
    {
        $input = $request->all();

        $serviceBilling = $this->serviceBillingRepository->create($input);

        Flash::success('ServiceBilling saved successfully.');

        return redirect(route('admin.serviceBilling.serviceBillings.index'));
    }

    /**
     * Display the specified ServiceBilling.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serviceBilling = $this->serviceBillingRepository->findWithoutFail($id);

        if (empty($serviceBilling)) {
            Flash::error('ServiceBilling not found');

            return redirect(route('serviceBillings.index'));
        }

        return view('admin.serviceBilling.serviceBillings.show')->with('serviceBilling', $serviceBilling);
    }

    /**
     * Show the form for editing the specified ServiceBilling.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serviceBilling = $this->serviceBillingRepository->findWithoutFail($id);

        if (empty($serviceBilling)) {
            Flash::error('ServiceBilling not found');

            return redirect(route('serviceBillings.index'));
        }

        return view('admin.serviceBilling.serviceBillings.edit')->with('serviceBilling', $serviceBilling);
    }

    /**
     * Update the specified ServiceBilling in storage.
     *
     * @param  int              $id
     * @param UpdateServiceBillingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceBillingRequest $request)
    {
        $serviceBilling = $this->serviceBillingRepository->findWithoutFail($id);

        

        if (empty($serviceBilling)) {
            Flash::error('ServiceBilling not found');

            return redirect(route('serviceBillings.index'));
        }

        $serviceBilling = $this->serviceBillingRepository->update($request->all(), $id);

        Flash::success('ServiceBilling updated successfully.');

        return redirect(route('admin.serviceBilling.serviceBillings.index'));
    }

    /**
     * Remove the specified ServiceBilling from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.serviceBilling.serviceBillings.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ServiceBilling::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.serviceBilling.serviceBillings.index'))->with('success', Lang::get('message.success.delete'));

       }

}
