<?php

namespace App\Http\Controllers\Admin\Aginganalysisreport;

use App\Http\Requests;
use App\Http\Requests\Aginganalysisreport\CreateAginganalysisreportRequest;
use App\Http\Requests\Aginganalysisreport\UpdateAginganalysisreportRequest;
use App\Repositories\Aginganalysisreport\AginganalysisreportRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Aginganalysisreport\Aginganalysisreport;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
Use \Carbon\Carbon;
use Response;
use DB;

class AginganalysisreportController extends InfyOmBaseController
{
    /** @var  AginganalysisreportRepository */
    private $aginganalysisreportRepository;

    public function __construct(AginganalysisreportRepository $aginganalysisreportRepo)
    {
        $this->aginganalysisreportRepository = $aginganalysisreportRepo;
    }

    /**
     * Display a listing of the Aginganalysisreport.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        
        $aginganalysisreports = DB::table('paymentanddues')->get();
           // dd($aginganalysisreports);
        
        foreach($aginganalysisreports as $aginganalysisreport){
            $invoice_balance = DB::table('serviceinvoices')->where('customer_no',$aginganalysisreport->customer_no)->get();
        dd($invoice_balance);
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $invoice_balance->invoice_created_date);
            $from = Carbon::now()->format('Y-m-d');
            $diff_in_days = $to->diffInDays($from);
            if($diff_in_days >= 30 && $invoice_balances->payment_status != 'Paid')
            {
                $days30[] = $invoice_balances->current_charges;
                //dd($days30);
            }else{
            //dd($invoice_balances);
            }
        }
        dd($invoice_balance);
        return view('admin.agingAnalysisReport.aginganalysisreports.index')
            ->with('aginganalysisreports', $aginganalysisreports);
    }

    /**
     * Show the form for creating a new Aginganalysisreport.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.agingAnalysisReport.aginganalysisreports.create');
    }

    /**
     * Store a newly created Aginganalysisreport in storage.
     *
     * @param CreateAginganalysisreportRequest $request
     *
     * @return Response
     */
    public function store(CreateAginganalysisreportRequest $request)
    {
        $input = $request->all();

        $aginganalysisreport = $this->aginganalysisreportRepository->create($input);

        Flash::success('Aginganalysisreport saved successfully.');

        return redirect(route('admin.agingAnalysisReport.aginganalysisreports.index'));
    }

    /**
     * Display the specified Aginganalysisreport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aginganalysisreport = $this->aginganalysisreportRepository->findWithoutFail($id);

        if (empty($aginganalysisreport)) {
            Flash::error('Aginganalysisreport not found');

            return redirect(route('aginganalysisreports.index'));
        }

        return view('admin.agingAnalysisReport.aginganalysisreports.show')->with('aginganalysisreport', $aginganalysisreport);
    }

    /**
     * Show the form for editing the specified Aginganalysisreport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aginganalysisreport = $this->aginganalysisreportRepository->findWithoutFail($id);

        if (empty($aginganalysisreport)) {
            Flash::error('Aginganalysisreport not found');

            return redirect(route('aginganalysisreports.index'));
        }

        return view('admin.agingAnalysisReport.aginganalysisreports.edit')->with('aginganalysisreport', $aginganalysisreport);
    }

    /**
     * Update the specified Aginganalysisreport in storage.
     *
     * @param  int              $id
     * @param UpdateAginganalysisreportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAginganalysisreportRequest $request)
    {
        $aginganalysisreport = $this->aginganalysisreportRepository->findWithoutFail($id);

        

        if (empty($aginganalysisreport)) {
            Flash::error('Aginganalysisreport not found');

            return redirect(route('aginganalysisreports.index'));
        }

        $aginganalysisreport = $this->aginganalysisreportRepository->update($request->all(), $id);

        Flash::success('Aginganalysisreport updated successfully.');

        return redirect(route('admin.agingAnalysisReport.aginganalysisreports.index'));
    }

    /**
     * Remove the specified Aginganalysisreport from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.agingAnalysisReport.aginganalysisreports.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Aginganalysisreport::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.agingAnalysisReport.aginganalysisreports.index'))->with('success', Lang::get('message.success.delete'));

       }

}
