<?php

namespace App\Http\Controllers\Admin\Invoicwepayment;

use App\Http\Requests;
use App\Http\Requests\Invoicwepayment\CreateInvoicwePaymentRequest;
use App\Http\Requests\Invoicwepayment\UpdateInvoicwePaymentRequest;
use App\Repositories\Invoicwepayment\InvoicwePaymentRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Invoicwepayment\InvoicwePayment;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Customer\Customer;
use NumberFormatter;
use DB;

class InvoicwePaymentController extends InfyOmBaseController
{
    /** @var  InvoicwePaymentRepository */
    private $invoicwePaymentRepository;

    public function __construct(InvoicwePaymentRepository $invoicwePaymentRepo)
    {
        $this->invoicwePaymentRepository = $invoicwePaymentRepo;
    }

    /**
     * Display a listing of the InvoicwePayment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->invoicwePaymentRepository->pushCriteria(new RequestCriteria($request));
        $invoicwePayments = $this->invoicwePaymentRepository->all();
        return view('admin.invoicwePayment.invoicwePayments.index')
            ->with('invoicwePayments', $invoicwePayments);
    }

    /**
     * Show the form for creating a new InvoicwePayment.
     *
     * @return Response
     */
    public function create()
    {
        $customer_list = Customer::get();
        $paymentmode_list = DB::table('paymenttypes')->get();
        return view('admin.invoicwePayment.invoicwePayments.create')
        ->with('customer_list', $customer_list)
        ->with('paymentmode_list', $paymentmode_list);
    }

    /**
     * Store a newly created InvoicwePayment in storage.
     *
     * @param CreateInvoicwePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoicwePaymentRequest $request)
    {
        $input = $request->all();

        $invoicwePayment = $this->invoicwePaymentRepository->create($input);

        Flash::success('InvoicwePayment saved successfully.');

        return redirect(route('admin.invoicwePayment.invoicwePayments.index'));
    }

    /**
     * Display the specified InvoicwePayment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoicwePayment = $this->invoicwePaymentRepository->findWithoutFail($id);
        $customerDetails = DB::table('customers')->where('id',$invoicwePayment->customer_no)->first();
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $payment_amount_spell = $f->format($invoicwePayment->payment_amount);
        if (empty($invoicwePayment)) {
            Flash::error('InvoicwePayment not found');

            return redirect(route('invoicwePayments.index'));
        }

        return view('admin.invoicwePayment.invoicwePayments.show')
               ->with('customerDetails', $customerDetails)
               ->with('payment_amount_spell', $payment_amount_spell)
               ->with('invoicwePayment', $invoicwePayment);
    }

    /**
     * Show the form for editing the specified InvoicwePayment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentmode_list = DB::table('paymenttypes')->get();
        $invoicwePayment = $this->invoicwePaymentRepository->findWithoutFail($id);

        if (empty($invoicwePayment)) {
            Flash::error('InvoicwePayment not found');

            return redirect(route('invoicwePayments.index'));
        }

        return view('admin.invoicwePayment.invoicwePayments.edit')
        ->with('paymentmode_list', $paymentmode_list)
        ->with('invoicwePayment', $invoicwePayment);
    }

    /**
     * Update the specified InvoicwePayment in storage.
     *
     * @param  int              $id
     * @param UpdateInvoicwePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoicwePaymentRequest $request)
    {
        $invoicwePayment = $this->invoicwePaymentRepository->findWithoutFail($id);

        

        if (empty($invoicwePayment)) {
            Flash::error('InvoicwePayment not found');

            return redirect(route('invoicwePayments.index'));
        }

        $invoicwePayment = $this->invoicwePaymentRepository->update($request->all(), $id);

        Flash::success('InvoicwePayment updated successfully.');

        return redirect(route('admin.invoicwePayment.invoicwePayments.index'));
    }

    /**
     * Remove the specified InvoicwePayment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.invoicwePayment.invoicwePayments.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = InvoicwePayment::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.invoicwePayment.invoicwePayments.index'))->with('success', Lang::get('message.success.delete'));

       }

}
