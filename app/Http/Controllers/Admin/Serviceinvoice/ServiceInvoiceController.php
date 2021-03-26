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
