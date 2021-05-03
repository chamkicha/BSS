<?php

namespace App\Http\Controllers\Admin\Client_Product;

use App\Http\Requests;
use App\Http\Requests\Client_Product\CreateClientproductreportRequest;
use App\Http\Requests\Client_Product\UpdateClientproductreportRequest;
use App\Repositories\Client_Product\ClientproductreportRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Client_Product\Clientproductreport;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ClientproductreportController extends InfyOmBaseController
{
    /** @var  ClientproductreportRepository */
    private $clientproductreportRepository;

    public function __construct(ClientproductreportRepository $clientproductreportRepo)
    {
        $this->clientproductreportRepository = $clientproductreportRepo;
    }

    /**
     * Display a listing of the Clientproductreport.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->clientproductreportRepository->pushCriteria(new RequestCriteria($request));
        $clientproductreports = $this->clientproductreportRepository->all();
        return view('admin.clientProduct.clientproductreports.index')
            ->with('clientproductreports', $clientproductreports);
    }

    /**
     * Show the form for creating a new Clientproductreport.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clientProduct.clientproductreports.create');
    }

    /**
     * Store a newly created Clientproductreport in storage.
     *
     * @param CreateClientproductreportRequest $request
     *
     * @return Response
     */
    public function store(CreateClientproductreportRequest $request)
    {
        $input = $request->all();

        $clientproductreport = $this->clientproductreportRepository->create($input);

        Flash::success('Clientproductreport saved successfully.');

        return redirect(route('admin.clientProduct.clientproductreports.index'));
    }

    /**
     * Display the specified Clientproductreport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clientproductreport = $this->clientproductreportRepository->findWithoutFail($id);

        if (empty($clientproductreport)) {
            Flash::error('Clientproductreport not found');

            return redirect(route('clientproductreports.index'));
        }

        return view('admin.clientProduct.clientproductreports.show')->with('clientproductreport', $clientproductreport);
    }

    /**
     * Show the form for editing the specified Clientproductreport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clientproductreport = $this->clientproductreportRepository->findWithoutFail($id);

        if (empty($clientproductreport)) {
            Flash::error('Clientproductreport not found');

            return redirect(route('clientproductreports.index'));
        }

        return view('admin.clientProduct.clientproductreports.edit')->with('clientproductreport', $clientproductreport);
    }

    /**
     * Update the specified Clientproductreport in storage.
     *
     * @param  int              $id
     * @param UpdateClientproductreportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientproductreportRequest $request)
    {
        $clientproductreport = $this->clientproductreportRepository->findWithoutFail($id);

        

        if (empty($clientproductreport)) {
            Flash::error('Clientproductreport not found');

            return redirect(route('clientproductreports.index'));
        }

        $clientproductreport = $this->clientproductreportRepository->update($request->all(), $id);

        Flash::success('Clientproductreport updated successfully.');

        return redirect(route('admin.clientProduct.clientproductreports.index'));
    }

    /**
     * Remove the specified Clientproductreport from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.clientProduct.clientproductreports.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Clientproductreport::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.clientProduct.clientproductreports.index'))->with('success', Lang::get('message.success.delete'));

       }

}
