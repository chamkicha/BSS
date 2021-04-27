<?php

namespace App\Http\Controllers\Admin\Paymentanddue;

use App\Http\Requests;
use App\Http\Requests\Paymentanddue\CreatePaymentAndDueRequest;
use App\Http\Requests\Paymentanddue\UpdatePaymentAndDueRequest;
use App\Repositories\Paymentanddue\PaymentAndDueRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Paymentanddue\PaymentAndDue;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PaymentAndDueController extends InfyOmBaseController
{
    /** @var  PaymentAndDueRepository */
    private $paymentAndDueRepository;

    public function __construct(PaymentAndDueRepository $paymentAndDueRepo)
    {
        $this->paymentAndDueRepository = $paymentAndDueRepo;
    }

    /**
     * Display a listing of the PaymentAndDue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->paymentAndDueRepository->pushCriteria(new RequestCriteria($request));
        $paymentAndDues = $this->paymentAndDueRepository->all();
        return view('admin.paymentAndDue.paymentAndDues.index')
            ->with('paymentAndDues', $paymentAndDues);
    }

    /**
     * Show the form for creating a new PaymentAndDue.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.paymentAndDue.paymentAndDues.create');
    }

    /**
     * Store a newly created PaymentAndDue in storage.
     *
     * @param CreatePaymentAndDueRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentAndDueRequest $request)
    {
        $input = $request->all();

        $paymentAndDue = $this->paymentAndDueRepository->create($input);

        Flash::success('PaymentAndDue saved successfully.');

        return redirect(route('admin.paymentAndDue.paymentAndDues.index'));
    }

    /**
     * Display the specified PaymentAndDue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentAndDue = $this->paymentAndDueRepository->findWithoutFail($id);

        if (empty($paymentAndDue)) {
            Flash::error('PaymentAndDue not found');

            return redirect(route('paymentAndDues.index'));
        }

        return view('admin.paymentAndDue.paymentAndDues.show')->with('paymentAndDue', $paymentAndDue);
    }

    /**
     * Show the form for editing the specified PaymentAndDue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentAndDue = $this->paymentAndDueRepository->findWithoutFail($id);

        if (empty($paymentAndDue)) {
            Flash::error('PaymentAndDue not found');

            return redirect(route('paymentAndDues.index'));
        }

        return view('admin.paymentAndDue.paymentAndDues.edit')->with('paymentAndDue', $paymentAndDue);
    }

    /**
     * Update the specified PaymentAndDue in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentAndDueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentAndDueRequest $request)
    {
        $paymentAndDue = $this->paymentAndDueRepository->findWithoutFail($id);

        

        if (empty($paymentAndDue)) {
            Flash::error('PaymentAndDue not found');

            return redirect(route('paymentAndDues.index'));
        }

        $paymentAndDue = $this->paymentAndDueRepository->update($request->all(), $id);

        Flash::success('PaymentAndDue updated successfully.');

        return redirect(route('admin.paymentAndDue.paymentAndDues.index'));
    }

    /**
     * Remove the specified PaymentAndDue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.paymentAndDue.paymentAndDues.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = PaymentAndDue::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.paymentAndDue.paymentAndDues.index'))->with('success', Lang::get('message.success.delete'));

       }

}
