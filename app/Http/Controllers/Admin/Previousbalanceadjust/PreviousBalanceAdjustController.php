<?php

namespace App\Http\Controllers\Admin\Previousbalanceadjust;

use App\Http\Requests;
use App\Http\Requests\Previousbalanceadjust\CreatePreviousBalanceAdjustRequest;
use App\Http\Requests\Previousbalanceadjust\UpdatePreviousBalanceAdjustRequest;
use App\Repositories\Previousbalanceadjust\PreviousBalanceAdjustRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Previousbalanceadjust\PreviousBalanceAdjust;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Sentinel;
use DB;

class PreviousBalanceAdjustController extends InfyOmBaseController
{
    /** @var  PreviousBalanceAdjustRepository */
    private $previousBalanceAdjustRepository;

    public function __construct(PreviousBalanceAdjustRepository $previousBalanceAdjustRepo)
    {
        $this->previousBalanceAdjustRepository = $previousBalanceAdjustRepo;
    }

    /**
     * Display a listing of the PreviousBalanceAdjust.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->previousBalanceAdjustRepository->pushCriteria(new RequestCriteria($request));
        $previousBalanceAdjusts = $this->previousBalanceAdjustRepository->all();
        return view('admin.previousBalanceAdjust.previousBalanceAdjusts.index')
            ->with('previousBalanceAdjusts', $previousBalanceAdjusts);
    }

    /**
     * Show the form for creating a new PreviousBalanceAdjust.
     *
     * @return Response
     */
    public function create()
    {
        $invoice_nos = DB::table('serviceinvoices')->where('deleted_at', null)->get();
        return view('admin.previousBalanceAdjust.previousBalanceAdjusts.create')->with('invoice_nos' , $invoice_nos);
    }

    /**
     * Store a newly created PreviousBalanceAdjust in storage.
     *
     * @param CreatePreviousBalanceAdjustRequest $request
     *
     * @return Response
     */
    public function store(CreatePreviousBalanceAdjustRequest $request)
    {
        

        $this->validate($request, ['invoice_no'  => 'required',
                                    'add_sub'  => 'required',
                                    'amount'  => 'required'
                                    ]);
        if($request->add_sub == 'add'){

        $invoice_details = DB::table('serviceinvoices')->where('id' , $request->invoice_no)->first();
        $previous_dept = $invoice_details->previous_dept + $request->amount;
        $update_previous_balance = DB::table('serviceinvoices')
                                    ->where('id', $request->invoice_no)
                                    ->update(['previous_dept' => $previous_dept,]);
        $payment_dues_add = $this->payment_dues_add($invoice_details->customer_no, $request->amount);

        $username = Sentinel::getUser()->full_name;
        activity('(ADD) Balance Adjustment for invoice '. $request->invoice_no.', Amount='.$request->amount)->log($username);

        return redirect(route('admin.serviceInvoice.serviceInvoices.show', [$request->invoice_no]))->with('success', 'service invoice successful');

        }elseif($request->add_sub == 'sub'){
            $invoice_details = DB::table('serviceinvoices')->where('id' , $request->invoice_no)->first();

            if($invoice_details->previous_dept >= $request->amount){
            $previous_dept = $invoice_details->previous_dept - $request->amount;
            $update_previous_balance = DB::table('serviceinvoices')
                                        ->where('id', $request->invoice_no)
                                        ->update(['previous_dept' => $previous_dept,]);

            $payment_dues_add = $this->payment_dues_sub($invoice_details->customer_no, $request->amount);

            $username = Sentinel::getUser()->full_name;
            activity('(SUB) Balance Adjustment for invoice '. $request->invoice_no.', Amount='.$request->amount)->log($username);

            return redirect(route('admin.serviceInvoice.serviceInvoices.show', [$request->invoice_no]))->with('success', 'service invoice successful');
            }else{
            return redirect(route('admin.serviceInvoice.serviceInvoices.show', [$request->invoice_no]))->with('error', 'Previous balance must be less than value entered');

            }
        }

      
    }

    /**
     * Display the specified PreviousBalanceAdjust.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $previousBalanceAdjust = $this->previousBalanceAdjustRepository->findWithoutFail($id);

        if (empty($previousBalanceAdjust)) {
            Flash::error('PreviousBalanceAdjust not found');

            return redirect(route('previousBalanceAdjusts.index'));
        }

        return view('admin.previousBalanceAdjust.previousBalanceAdjusts.show')->with('previousBalanceAdjust', $previousBalanceAdjust);
    }

    /**
     * Show the form for editing the specified PreviousBalanceAdjust.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $previousBalanceAdjust = $this->previousBalanceAdjustRepository->findWithoutFail($id);

        if (empty($previousBalanceAdjust)) {
            Flash::error('PreviousBalanceAdjust not found');

            return redirect(route('previousBalanceAdjusts.index'));
        }

        return view('admin.previousBalanceAdjust.previousBalanceAdjusts.edit')->with('previousBalanceAdjust', $previousBalanceAdjust);
    }

    /**
     * Update the specified PreviousBalanceAdjust in storage.
     *
     * @param  int              $id
     * @param UpdatePreviousBalanceAdjustRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePreviousBalanceAdjustRequest $request)
    {
        $previousBalanceAdjust = $this->previousBalanceAdjustRepository->findWithoutFail($id);

        

        if (empty($previousBalanceAdjust)) {
            Flash::error('PreviousBalanceAdjust not found');

            return redirect(route('previousBalanceAdjusts.index'));
        }

        $previousBalanceAdjust = $this->previousBalanceAdjustRepository->update($request->all(), $id);

        Flash::success('PreviousBalanceAdjust updated successfully.');

        return redirect(route('admin.previousBalanceAdjust.previousBalanceAdjusts.index'));
    }

    /**
     * Remove the specified PreviousBalanceAdjust from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.previousBalanceAdjust.previousBalanceAdjusts.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = PreviousBalanceAdjust::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.previousBalanceAdjust.previousBalanceAdjusts.index'))->with('success', Lang::get('message.success.delete'));

       }


       public function payment_dues_add($customer_no , $amount){
           // PAYMENT AND DUE update into database
           $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
           $grand_total2 = $grand_total3->total_amount;
           $grand_total1 = $amount;
           $grand_total4 = $grand_total1 + $grand_total2;
           $balance = $grand_total3->balance;
           $balance = $balance + $grand_total1;
           //dd($grand_total4);
           
           $bill_creation = DB::table('paymentanddues')
           ->where('customer_no', $customer_no)
           ->update(['total_amount' => $grand_total4,
                   'balance' => $balance]);
             return null;
       }

       


       public function payment_dues_sub($customer_no , $amount){
        // PAYMENT AND DUE update into database
        $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
        $grand_total2 = $grand_total3->total_amount;
        $grand_total1 = $amount;
        $grand_total4 = $grand_total2 - $grand_total1;
        $balance = $grand_total3->balance;
        $balance = $balance - $grand_total1;
        //dd($grand_total4);
        
        $bill_creation = DB::table('paymentanddues')
        ->where('customer_no', $customer_no)
        ->update(['total_amount' => $grand_total4,
                'balance' => $balance]);
          return null;
    }

}
