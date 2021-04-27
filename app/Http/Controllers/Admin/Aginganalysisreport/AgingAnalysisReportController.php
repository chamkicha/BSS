<?php

namespace App\Http\Controllers\Admin\Aginganalysisreport;

use App\Http\Requests;
use App\Http\Requests\Aginganalysisreport\CreateAgingAnalysisReportRequest;
use App\Http\Requests\Aginganalysisreport\UpdateAgingAnalysisReportRequest;
use App\Repositories\Aginganalysisreport\AgingAnalysisReportRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Aginganalysisreport\AgingAnalysisReport;
use Flash;
use App\Models\Datatable;
use App\Models\Paymentanddue\PaymentAndDue;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AgingAnalysisReportController extends InfyOmBaseController
{
    /** @var  AgingAnalysisReportRepository */
    private $agingAnalysisReportRepository;

    public function __construct(AgingAnalysisReportRepository $agingAnalysisReportRepo)
    {
        $this->agingAnalysisReportRepository = $agingAnalysisReportRepo;
    }

    /**
     * Display a listing of the AgingAnalysisReport.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $PaymentAndDue =PaymentAndDue::all();   // We can pass max count for slider
        $max_id =Datatable::pluck('id')->max();
        $min_id =Datatable::pluck('id')->min();

        //$this->agingAnalysisReportRepository->pushCriteria(new RequestCriteria($request));
        //$agingAnalysisReports = $this->agingAnalysisReportRepository->all();
        return view('admin.agingAnalysisReport.agingAnalysisReports.index', )
            ->with('PaymentAndDue', $PaymentAndDue);
    }

    public function radioData(Request $request)
    {
        if ($request->ageRadio!=null && $request->ageRadio !='all') {
            if ($request->ageRadio < 100) {
                $tables = PaymentAndDue::where('age', '<=', $request->ageRadio)->get(['customer_name', 'customer_no', 'balance']);
            } else {
                $tables = PaymentAndDue::where('age', '>', 50)->get(['customer_name', 'customer_no', 'balance']);
            }
        } else {
            $tables = PaymentAndDue::get(['customer_name', 'customer_no', 'balance']);
        }

        return PaymentAndDue::of($tables)
            ->make(true);
    }

    /**
     * Show the form for creating a new AgingAnalysisReport.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.agingAnalysisReport.agingAnalysisReports.create');
    }

    /**
     * Store a newly created AgingAnalysisReport in storage.
     *
     * @param CreateAgingAnalysisReportRequest $request
     *
     * @return Response
     */
    public function store(CreateAgingAnalysisReportRequest $request)
    {
        $input = $request->all();

        $agingAnalysisReport = $this->agingAnalysisReportRepository->create($input);

        Flash::success('AgingAnalysisReport saved successfully.');

        return redirect(route('admin.agingAnalysisReport.agingAnalysisReports.index'));
    }

    /**
     * Display the specified AgingAnalysisReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $agingAnalysisReport = $this->agingAnalysisReportRepository->findWithoutFail($id);

        if (empty($agingAnalysisReport)) {
            Flash::error('AgingAnalysisReport not found');

            return redirect(route('agingAnalysisReports.index'));
        }

        return view('admin.agingAnalysisReport.agingAnalysisReports.show')->with('agingAnalysisReport', $agingAnalysisReport);
    }

    /**
     * Show the form for editing the specified AgingAnalysisReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $agingAnalysisReport = $this->agingAnalysisReportRepository->findWithoutFail($id);

        if (empty($agingAnalysisReport)) {
            Flash::error('AgingAnalysisReport not found');

            return redirect(route('agingAnalysisReports.index'));
        }

        return view('admin.agingAnalysisReport.agingAnalysisReports.edit')->with('agingAnalysisReport', $agingAnalysisReport);
    }

    /**
     * Update the specified AgingAnalysisReport in storage.
     *
     * @param  int              $id
     * @param UpdateAgingAnalysisReportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAgingAnalysisReportRequest $request)
    {
        $agingAnalysisReport = $this->agingAnalysisReportRepository->findWithoutFail($id);

        

        if (empty($agingAnalysisReport)) {
            Flash::error('AgingAnalysisReport not found');

            return redirect(route('agingAnalysisReports.index'));
        }

        $agingAnalysisReport = $this->agingAnalysisReportRepository->update($request->all(), $id);

        Flash::success('AgingAnalysisReport updated successfully.');

        return redirect(route('admin.agingAnalysisReport.agingAnalysisReports.index'));
    }

    /**
     * Remove the specified AgingAnalysisReport from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.agingAnalysisReport.agingAnalysisReports.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = AgingAnalysisReport::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.agingAnalysisReport.agingAnalysisReports.index'))->with('success', Lang::get('message.success.delete'));

       }

}
