<?php

namespace App\Http\Controllers\Admin\Unitofmeasure;

use App\Http\Requests;
use App\Http\Requests\Unitofmeasure\CreateUnitofMeasureRequest;
use App\Http\Requests\Unitofmeasure\UpdateUnitofMeasureRequest;
use App\Repositories\Unitofmeasure\UnitofMeasureRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Unitofmeasure\UnitofMeasure;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UnitofMeasureController extends InfyOmBaseController
{
    /** @var  UnitofMeasureRepository */
    private $unitofMeasureRepository;

    public function __construct(UnitofMeasureRepository $unitofMeasureRepo)
    {
        $this->unitofMeasureRepository = $unitofMeasureRepo;
    }

    /**
     * Display a listing of the UnitofMeasure.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->unitofMeasureRepository->pushCriteria(new RequestCriteria($request));
        $unitofMeasures = $this->unitofMeasureRepository->all();
        return view('admin.unitofMeasure.unitofMeasures.index')
            ->with('unitofMeasures', $unitofMeasures);
    }

    /**
     * Show the form for creating a new UnitofMeasure.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.unitofMeasure.unitofMeasures.create');
    }

    /**
     * Store a newly created UnitofMeasure in storage.
     *
     * @param CreateUnitofMeasureRequest $request
     *
     * @return Response
     */
    public function store(CreateUnitofMeasureRequest $request)
    {
        $input = $request->all();

        $unitofMeasure = $this->unitofMeasureRepository->create($input);

        Flash::success('UnitofMeasure saved successfully.');

        return redirect(route('admin.unitofMeasure.unitofMeasures.index'));
    }

    /**
     * Display the specified UnitofMeasure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unitofMeasure = $this->unitofMeasureRepository->findWithoutFail($id);

        if (empty($unitofMeasure)) {
            Flash::error('UnitofMeasure not found');

            return redirect(route('unitofMeasures.index'));
        }

        return view('admin.unitofMeasure.unitofMeasures.show')->with('unitofMeasure', $unitofMeasure);
    }

    /**
     * Show the form for editing the specified UnitofMeasure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unitofMeasure = $this->unitofMeasureRepository->findWithoutFail($id);

        if (empty($unitofMeasure)) {
            Flash::error('UnitofMeasure not found');

            return redirect(route('unitofMeasures.index'));
        }

        return view('admin.unitofMeasure.unitofMeasures.edit')->with('unitofMeasure', $unitofMeasure);
    }

    /**
     * Update the specified UnitofMeasure in storage.
     *
     * @param  int              $id
     * @param UpdateUnitofMeasureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnitofMeasureRequest $request)
    {
        $unitofMeasure = $this->unitofMeasureRepository->findWithoutFail($id);

        

        if (empty($unitofMeasure)) {
            Flash::error('UnitofMeasure not found');

            return redirect(route('unitofMeasures.index'));
        }

        $unitofMeasure = $this->unitofMeasureRepository->update($request->all(), $id);

        Flash::success('UnitofMeasure updated successfully.');

        return redirect(route('admin.unitofMeasure.unitofMeasures.index'));
    }

    /**
     * Remove the specified UnitofMeasure from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.unitofMeasure.unitofMeasures.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = UnitofMeasure::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.unitofMeasure.unitofMeasures.index'))->with('success', Lang::get('message.success.delete'));

       }

}
