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
use Response;
use Carbon\Carbon;
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
    
        $aginganalysisreports = DB::table('serviceinvoices')->where('payment_status', '!=' , 'Fully')->get();

        foreach($aginganalysisreports as $aginganalysisreport){ 
        

            if(is_null($request->aging_date)){
                $aging_date = 30;
    
            }else{
                $aging_date = $request->aging_date;
            }

        $invoice_due_date = $aginganalysisreport->invoice_due_date;
        
        $due_date_add_aging = Carbon::parse($invoice_due_date)->addDays($aging_date)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $today = \Carbon\Carbon::createFromFormat('Y-m-d', $today);
        $due_date = \Carbon\Carbon::createFromFormat('Y-m-d', $due_date_add_aging);
        $diff_in_days =  $today->diffInDays($due_date);
       // dd($diff_in_days);
       
        if($aging_date >= $diff_in_days)
            {
                $aginganalysisreporte[]=array(
                    'cusromer_name' => $aginganalysisreport->cusromer_name,
                    'invoice_number' => $aginganalysisreport->invoice_number,
                    'current_charges' => $aginganalysisreport->current_charges,
                    'invoice_due_date' => $aginganalysisreport->invoice_due_date,
                    'diff_in_days' => $diff_in_days,
                );
                    $aging_date = $aging_date;
                    $total_amounts[] = $aginganalysisreport->current_charges;
            }
         
         }
        //dd($aginganalysisreporte);
        $aginganalysisreport = $aginganalysisreporte;
        $total_amount = array_sum($total_amounts);
        return view('admin.agingAnalysisReport.aginganalysisreports.index')
            ->with('aging_date', $aging_date)
            ->with('aginganalysisreports', $aginganalysisreport)
            ->with('total_amount', $total_amount);
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
