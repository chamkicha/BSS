<?php

namespace App\Http\Controllers\Admin\Serviceordertype;

use App\Http\Requests;
use App\Http\Requests\Serviceordertype\CreateServiceOrderTypeRequest;
use App\Http\Requests\Serviceordertype\UpdateServiceOrderTypeRequest;
use App\Repositories\Serviceordertype\ServiceOrderTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Serviceordertype\ServiceOrderType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ServiceOrderTypeController extends InfyOmBaseController
{
    /** @var  ServiceOrderTypeRepository */
    private $serviceOrderTypeRepository;

    public function __construct(ServiceOrderTypeRepository $serviceOrderTypeRepo)
    {
        $this->serviceOrderTypeRepository = $serviceOrderTypeRepo;
    }

    /**
     * Display a listing of the ServiceOrderType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->serviceOrderTypeRepository->pushCriteria(new RequestCriteria($request));
        $serviceOrderTypes = $this->serviceOrderTypeRepository->all();
        return view('admin.serviceOrderType.serviceOrderTypes.index')
            ->with('serviceOrderTypes', $serviceOrderTypes);
    }

    /**
     * Show the form for creating a new ServiceOrderType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.serviceOrderType.serviceOrderTypes.create');
    }

    /**
     * Store a newly created ServiceOrderType in storage.
     *
     * @param CreateServiceOrderTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceOrderTypeRequest $request)
    {
        $input = $request->all();

        $serviceOrderType = $this->serviceOrderTypeRepository->create($input);

        Flash::success('ServiceOrderType saved successfully.');

        return redirect(route('admin.serviceOrderType.serviceOrderTypes.index'));
    }

    /**
     * Display the specified ServiceOrderType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serviceOrderType = $this->serviceOrderTypeRepository->findWithoutFail($id);

        if (empty($serviceOrderType)) {
            Flash::error('ServiceOrderType not found');

            return redirect(route('serviceOrderTypes.index'));
        }

        return view('admin.serviceOrderType.serviceOrderTypes.show')->with('serviceOrderType', $serviceOrderType);
    }

    /**
     * Show the form for editing the specified ServiceOrderType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serviceOrderType = $this->serviceOrderTypeRepository->findWithoutFail($id);

        if (empty($serviceOrderType)) {
            Flash::error('ServiceOrderType not found');

            return redirect(route('serviceOrderTypes.index'));
        }

        return view('admin.serviceOrderType.serviceOrderTypes.edit')->with('serviceOrderType', $serviceOrderType);
    }

    /**
     * Update the specified ServiceOrderType in storage.
     *
     * @param  int              $id
     * @param UpdateServiceOrderTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceOrderTypeRequest $request)
    {
        $serviceOrderType = $this->serviceOrderTypeRepository->findWithoutFail($id);

        

        if (empty($serviceOrderType)) {
            Flash::error('ServiceOrderType not found');

            return redirect(route('serviceOrderTypes.index'));
        }

        $serviceOrderType = $this->serviceOrderTypeRepository->update($request->all(), $id);

        Flash::success('ServiceOrderType updated successfully.');

        return redirect(route('admin.serviceOrderType.serviceOrderTypes.index'));
    }

    /**
     * Remove the specified ServiceOrderType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.serviceOrderType.serviceOrderTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ServiceOrderType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.serviceOrderType.serviceOrderTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
