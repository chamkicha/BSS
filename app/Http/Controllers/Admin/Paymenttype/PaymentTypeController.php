<?php

namespace App\Http\Controllers\Admin\Paymenttype;

use App\Http\Requests;
use App\Http\Requests\Paymenttype\CreatePaymentTypeRequest;
use App\Http\Requests\Paymenttype\UpdatePaymentTypeRequest;
use App\Repositories\Paymenttype\PaymentTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Paymenttype\PaymentType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PaymentTypeController extends InfyOmBaseController
{
    /** @var  PaymentTypeRepository */
    private $paymentTypeRepository;

    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->paymentTypeRepository = $paymentTypeRepo;
    }

    /**
     * Display a listing of the PaymentType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->paymentTypeRepository->pushCriteria(new RequestCriteria($request));
        $paymentTypes = $this->paymentTypeRepository->all();
        return view('admin.paymentType.paymentTypes.index')
            ->with('paymentTypes', $paymentTypes);
    }

    /**
     * Show the form for creating a new PaymentType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.paymentType.paymentTypes.create');
    }

    /**
     * Store a newly created PaymentType in storage.
     *
     * @param CreatePaymentTypeRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentTypeRequest $request)
    {
        $input = $request->all();

        $paymentType = $this->paymentTypeRepository->create($input);

        Flash::success('PaymentType saved successfully.');

        return redirect(route('admin.paymentType.paymentTypes.index'));
    }

    /**
     * Display the specified PaymentType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('PaymentType not found');

            return redirect(route('paymentTypes.index'));
        }

        return view('admin.paymentType.paymentTypes.show')->with('paymentType', $paymentType);
    }

    /**
     * Show the form for editing the specified PaymentType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('PaymentType not found');

            return redirect(route('paymentTypes.index'));
        }

        return view('admin.paymentType.paymentTypes.edit')->with('paymentType', $paymentType);
    }

    /**
     * Update the specified PaymentType in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentTypeRequest $request)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        

        if (empty($paymentType)) {
            Flash::error('PaymentType not found');

            return redirect(route('paymentTypes.index'));
        }

        $paymentType = $this->paymentTypeRepository->update($request->all(), $id);

        Flash::success('PaymentType updated successfully.');

        return redirect(route('admin.paymentType.paymentTypes.index'));
    }

    /**
     * Remove the specified PaymentType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.paymentType.paymentTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = PaymentType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.paymentType.paymentTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
