<?php

namespace App\Http\Controllers\Admin\Paymentmode;

use App\Http\Requests;
use App\Http\Requests\Paymentmode\CreatePaymentModeRequest;
use App\Http\Requests\Paymentmode\UpdatePaymentModeRequest;
use App\Repositories\Paymentmode\PaymentModeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Paymentmode\PaymentMode;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PaymentModeController extends InfyOmBaseController
{
    /** @var  PaymentModeRepository */
    private $paymentModeRepository;

    public function __construct(PaymentModeRepository $paymentModeRepo)
    {
        $this->paymentModeRepository = $paymentModeRepo;
    }

    /**
     * Display a listing of the PaymentMode.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->paymentModeRepository->pushCriteria(new RequestCriteria($request));
        $paymentModes = $this->paymentModeRepository->all();
        return view('admin.paymentMode.paymentModes.index')
            ->with('paymentModes', $paymentModes);
    }

    /**
     * Show the form for creating a new PaymentMode.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.paymentMode.paymentModes.create');
    }

    /**
     * Store a newly created PaymentMode in storage.
     *
     * @param CreatePaymentModeRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentModeRequest $request)
    {
        $input = $request->all();

        $paymentMode = $this->paymentModeRepository->create($input);

        Flash::success('PaymentMode saved successfully.');

        return redirect(route('admin.paymentMode.paymentModes.index'));
    }

    /**
     * Display the specified PaymentMode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentMode = $this->paymentModeRepository->findWithoutFail($id);

        if (empty($paymentMode)) {
            Flash::error('PaymentMode not found');

            return redirect(route('paymentModes.index'));
        }

        return view('admin.paymentMode.paymentModes.show')->with('paymentMode', $paymentMode);
    }

    /**
     * Show the form for editing the specified PaymentMode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentMode = $this->paymentModeRepository->findWithoutFail($id);

        if (empty($paymentMode)) {
            Flash::error('PaymentMode not found');

            return redirect(route('paymentModes.index'));
        }

        return view('admin.paymentMode.paymentModes.edit')->with('paymentMode', $paymentMode);
    }

    /**
     * Update the specified PaymentMode in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentModeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentModeRequest $request)
    {
        $paymentMode = $this->paymentModeRepository->findWithoutFail($id);

        

        if (empty($paymentMode)) {
            Flash::error('PaymentMode not found');

            return redirect(route('paymentModes.index'));
        }

        $paymentMode = $this->paymentModeRepository->update($request->all(), $id);

        Flash::success('PaymentMode updated successfully.');

        return redirect(route('admin.paymentMode.paymentModes.index'));
    }

    /**
     * Remove the specified PaymentMode from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.paymentMode.paymentModes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = PaymentMode::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.paymentMode.paymentModes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
