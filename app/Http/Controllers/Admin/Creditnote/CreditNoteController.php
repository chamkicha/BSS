<?php

namespace App\Http\Controllers\Admin\Creditnote;

use App\Http\Requests;
use App\Http\Requests\Creditnote\CreateCreditNoteRequest;
use App\Http\Requests\Creditnote\UpdateCreditNoteRequest;
use App\Repositories\Creditnote\CreditNoteRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Creditnote\CreditNote;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class CreditNoteController extends InfyOmBaseController
{
    /** @var  CreditNoteRepository */
    private $creditNoteRepository;

    public function __construct(CreditNoteRepository $creditNoteRepo)
    {
        $this->creditNoteRepository = $creditNoteRepo;
    }

    /**
     * Display a listing of the CreditNote.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->creditNoteRepository->pushCriteria(new RequestCriteria($request));
        $creditNotes = $this->creditNoteRepository->all();
        return view('admin.creditNote.creditNotes.index')
            ->with('creditNotes', $creditNotes);
    }

    /**
     * Show the form for creating a new CreditNote.
     *
     * @return Response
     */
    public function create()
    {
        $service_invoice = DB::table('serviceinvoices')->get();
        return view('admin.creditNote.creditNotes.create')
                     ->with('service_invoice', $service_invoice);
    }

    /**
     * Store a newly created CreditNote in storage.
     *
     * @param CreateCreditNoteRequest $request
     *
     * @return Response
     */
    public function store(CreateCreditNoteRequest $request)
    {
        $this->validate($request, [
            'invoice_no'  => ['required', 'unique:creditnotes,invoice_no'],
            'created_at' => 'required',
            'reason_for_adjustment' => 'required',
        ]);
        //dd($request);
        $invoice_details = DB::table('serviceinvoices')
                               ->where('invoice_number',$request->invoice_no)
                               ->get();
        $status = 'created';
        
        
        $input = array(
            'credit_note_no' => $request->credit_note_no,
            'customer_name' => $invoice_details[0]->cusromer_name,
            'customer_no' => $invoice_details[0]->customer_no,
            'invoice_no' => $request->invoice_no,
            'reason_for_adjustment' => $request->reason_for_adjustment,
            'total_amount' => $invoice_details[0]->grand_total,
            'sub_total' => $invoice_details[0]->sub_total,
            'service_name' => $invoice_details[0]->service_name,
            'tax_amount' => $invoice_details[0]->tax_amount,
            'created_by' => $request->created_by,
            'created_at' => $request->created_at,
            'status' => $status,


        );

        $creditNote = $this->creditNoteRepository->create($input);

        Flash::success('CreditNote saved successfully.');

        return redirect(route('admin.creditNote.creditNotes.index'));
    }

    /**
     * Display the specified CreditNote.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $creditNote = $this->creditNoteRepository->findWithoutFail($id);
        
        $customerDetails = DB::table('customers')
                               ->where('customername',$creditNote->customer_name)
                               ->first();
        $service_name = (array)json_decode($creditNote->service_name, true);
        $service_name_description = DB::table('products')->whereIn('product_name', $service_name)->get();
        
        if (empty($creditNote)) {
            Flash::error('CreditNote not found');

            return redirect(route('creditNotes.index'));
        }

        return view('admin.creditNote.creditNotes.show')
                ->with('customerDetails', $customerDetails)
                ->with('service_name_description', $service_name_description)
                ->with('creditNote', $creditNote);
    }

    /**
     * Show the form for editing the specified CreditNote.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $creditNote = $this->creditNoteRepository->findWithoutFail($id);

        if (empty($creditNote)) {
            Flash::error('CreditNote not found');

            return redirect(route('creditNotes.index'));
        }

        return view('admin.creditNote.creditNotes.edit')->with('creditNote', $creditNote);
    }

    /**
     * Update the specified CreditNote in storage.
     *
     * @param  int              $id
     * @param UpdateCreditNoteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCreditNoteRequest $request)
    {
        $creditNote = $this->creditNoteRepository->findWithoutFail($id);

        

        if (empty($creditNote)) {
            Flash::error('CreditNote not found');

            return redirect(route('creditNotes.index'));
        }

        $creditNote = $this->creditNoteRepository->update($request->all(), $id);

        Flash::success('CreditNote updated successfully.');

        return redirect(route('admin.creditNote.creditNotes.index'));
    }

    /**
     * Remove the specified CreditNote from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.creditNote.creditNotes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = CreditNote::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.creditNote.creditNotes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
