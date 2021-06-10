<?php

namespace App\Http\Controllers\Admin\Revenuepercustomerreport;

use App\Http\Requests;
use App\Http\Requests\Revenuepercustomerreport\CreateRevenuePerCustomerReportRequest;
use App\Http\Requests\Revenuepercustomerreport\UpdateRevenuePerCustomerReportRequest;
use App\Repositories\Revenuepercustomerreport\RevenuePerCustomerReportRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Revenuepercustomerreport\RevenuePerCustomerReport;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class RevenuePerCustomerReportController extends InfyOmBaseController
{
    /** @var  RevenuePerCustomerReportRepository */
    private $revenuePerCustomerReportRepository;

    public function __construct(RevenuePerCustomerReportRepository $revenuePerCustomerReportRepo)
    {
        $this->revenuePerCustomerReportRepository = $revenuePerCustomerReportRepo;
    }

    /**
     * Display a listing of the RevenuePerCustomerReport.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $customers = DB::table('customers')->get();
        foreach($customers as $customer){
            $client_product = DB::table('serviceinvoices')->where('customer_no',$customer->id)->where('deleted_at',null)->get();

            if($client_product->count() != 0){
            
            foreach($client_product as $client_products){
                //$excise_dutys[] = 0;
                 $v_a_ts[] = $client_products->tax_amount;
                 $amount_without_vats[] = $client_products->sub_total;
                 $otal_with_vats[] = $client_products->grand_total;
                
            }

             $excise_duty = 0;
             $v_a_t = array_sum($v_a_ts);
             $amount_without_vat = array_sum($amount_without_vats);
             $total_with_vat = array_sum($otal_with_vats);
             }else{

            
            $excise_duty = 0;
            $v_a_t = 0;
            $amount_without_vat = 0;
            $total_with_vat = 0;

             }
            $revenuePerCustomerReports[]=array(
                'id' => $customer->id,
                'customer_id' => $customer->id,
                'customer_name' => $customer->customername,
                'customer_type' => $customer->customer_type,
                'excise_duty' => $excise_duty,
                'v_a_t' => $v_a_t,
                'amount_without_vat' => $amount_without_vat,
                'total_with_vat' => $total_with_vat,
            );
        }
        //dd($revenuePerCustomerReports);
        return view('admin.revenuePerCustomerReport.revenuePerCustomerReports.index')
            ->with('revenuePerCustomerReports', $revenuePerCustomerReports);
    }

    /**
     * Show the form for creating a new RevenuePerCustomerReport.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.revenuePerCustomerReport.revenuePerCustomerReports.create');
    }

    /**
     * Store a newly created RevenuePerCustomerReport in storage.
     *
     * @param CreateRevenuePerCustomerReportRequest $request
     *
     * @return Response
     */
    public function store(CreateRevenuePerCustomerReportRequest $request)
    {
        $input = $request->all();

        $revenuePerCustomerReport = $this->revenuePerCustomerReportRepository->create($input);

        Flash::success('RevenuePerCustomerReport saved successfully.');

        return redirect(route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index'));
    }

    /**
     * Display the specified RevenuePerCustomerReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $revenuePerCustomerReport = $this->revenuePerCustomerReportRepository->findWithoutFail($id);

        if (empty($revenuePerCustomerReport)) {
            Flash::error('RevenuePerCustomerReport not found');

            return redirect(route('revenuePerCustomerReports.index'));
        }

        return view('admin.revenuePerCustomerReport.revenuePerCustomerReports.show')->with('revenuePerCustomerReport', $revenuePerCustomerReport);
    }

    /**
     * Show the form for editing the specified RevenuePerCustomerReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $revenuePerCustomerReport = $this->revenuePerCustomerReportRepository->findWithoutFail($id);

        if (empty($revenuePerCustomerReport)) {
            Flash::error('RevenuePerCustomerReport not found');

            return redirect(route('revenuePerCustomerReports.index'));
        }

        return view('admin.revenuePerCustomerReport.revenuePerCustomerReports.edit')->with('revenuePerCustomerReport', $revenuePerCustomerReport);
    }

    /**
     * Update the specified RevenuePerCustomerReport in storage.
     *
     * @param  int              $id
     * @param UpdateRevenuePerCustomerReportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRevenuePerCustomerReportRequest $request)
    {
        $revenuePerCustomerReport = $this->revenuePerCustomerReportRepository->findWithoutFail($id);

        

        if (empty($revenuePerCustomerReport)) {
            Flash::error('RevenuePerCustomerReport not found');

            return redirect(route('revenuePerCustomerReports.index'));
        }

        $revenuePerCustomerReport = $this->revenuePerCustomerReportRepository->update($request->all(), $id);

        Flash::success('RevenuePerCustomerReport updated successfully.');

        return redirect(route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index'));
    }

    /**
     * Remove the specified RevenuePerCustomerReport from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.revenuePerCustomerReport.revenuePerCustomerReports.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = RevenuePerCustomerReport::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index'))->with('success', Lang::get('message.success.delete'));

       }

}
