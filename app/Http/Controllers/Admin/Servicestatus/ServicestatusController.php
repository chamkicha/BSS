<?php

namespace App\Http\Controllers\Admin\Servicestatus;

use App\Http\Requests;
use App\Http\Requests\Servicestatus\CreateServicestatusRequest;
use App\Http\Requests\Servicestatus\UpdateServicestatusRequest;
use App\Repositories\Servicestatus\ServicestatusRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Servicestatus\Servicestatus;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ServicestatusController extends InfyOmBaseController
{
    /** @var  ServicestatusRepository */
    private $servicestatusRepository;

    public function __construct(ServicestatusRepository $servicestatusRepo)
    {
        $this->servicestatusRepository = $servicestatusRepo;
    }

    /**
     * Display a listing of the Servicestatus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->servicestatusRepository->pushCriteria(new RequestCriteria($request));
        $servicestatuses = $this->servicestatusRepository->all();
        return view('admin.servicestatus.servicestatuses.index')
            ->with('servicestatuses', $servicestatuses);
    }

    /**
     * Show the form for creating a new Servicestatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.servicestatus.servicestatuses.create');
    }

    /**
     * Store a newly created Servicestatus in storage.
     *
     * @param CreateServicestatusRequest $request
     *
     * @return Response
     */
    public function store(CreateServicestatusRequest $request)
    {
        $input = $request->all();

        $servicestatus = $this->servicestatusRepository->create($input);

        Flash::success('Servicestatus saved successfully.');

        return redirect(route('admin.servicestatus.servicestatuses.index'));
    }

    /**
     * Display the specified Servicestatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $servicestatus = $this->servicestatusRepository->findWithoutFail($id);

        if (empty($servicestatus)) {
            Flash::error('Servicestatus not found');

            return redirect(route('servicestatuses.index'));
        }

        return view('admin.servicestatus.servicestatuses.show')->with('servicestatus', $servicestatus);
    }

    /**
     * Show the form for editing the specified Servicestatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $servicestatus = $this->servicestatusRepository->findWithoutFail($id);

        if (empty($servicestatus)) {
            Flash::error('Servicestatus not found');

            return redirect(route('servicestatuses.index'));
        }

        return view('admin.servicestatus.servicestatuses.edit')->with('servicestatus', $servicestatus);
    }

    /**
     * Update the specified Servicestatus in storage.
     *
     * @param  int              $id
     * @param UpdateServicestatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServicestatusRequest $request)
    {
        $servicestatus = $this->servicestatusRepository->findWithoutFail($id);

        

        if (empty($servicestatus)) {
            Flash::error('Servicestatus not found');

            return redirect(route('servicestatuses.index'));
        }

        $servicestatus = $this->servicestatusRepository->update($request->all(), $id);

        Flash::success('Servicestatus updated successfully.');

        return redirect(route('admin.servicestatus.servicestatuses.index'));
    }

    /**
     * Remove the specified Servicestatus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.servicestatus.servicestatuses.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Servicestatus::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.servicestatus.servicestatuses.index'))->with('success', Lang::get('message.success.delete'));

       }

}
