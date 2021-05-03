<?php

namespace App\Http\Controllers\Admin\Client_Product;

use App\Http\Requests;
use App\Http\Requests\Client_Product\CreateClientproductRequest;
use App\Http\Requests\Client_Product\UpdateClientproductRequest;
use App\Repositories\Client_Product\ClientproductRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Client_Product\Clientproduct;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ClientproductController extends InfyOmBaseController
{
    /** @var  ClientproductRepository */
    private $clientproductRepository;

    public function __construct(ClientproductRepository $clientproductRepo)
    {
        $this->clientproductRepository = $clientproductRepo;
    }

    /**
     * Display a listing of the Clientproduct.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->clientproductRepository->pushCriteria(new RequestCriteria($request));
        $clientproducts = $this->clientproductRepository->all();
        return view('admin.clientProduct.clientproducts.index')
            ->with('clientproducts', $clientproducts);
    }

    /**
     * Show the form for creating a new Clientproduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clientProduct.clientproducts.create');
    }

    /**
     * Store a newly created Clientproduct in storage.
     *
     * @param CreateClientproductRequest $request
     *
     * @return Response
     */
    public function store(CreateClientproductRequest $request)
    {
        $input = $request->all();

        $clientproduct = $this->clientproductRepository->create($input);

        Flash::success('Clientproduct saved successfully.');

        return redirect(route('admin.clientProduct.clientproducts.index'));
    }

    /**
     * Display the specified Clientproduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clientproduct = $this->clientproductRepository->findWithoutFail($id);

        if (empty($clientproduct)) {
            Flash::error('Clientproduct not found');

            return redirect(route('clientproducts.index'));
        }

        return view('admin.clientProduct.clientproducts.show')->with('clientproduct', $clientproduct);
    }

    /**
     * Show the form for editing the specified Clientproduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clientproduct = $this->clientproductRepository->findWithoutFail($id);

        if (empty($clientproduct)) {
            Flash::error('Clientproduct not found');

            return redirect(route('clientproducts.index'));
        }

        return view('admin.clientProduct.clientproducts.edit')->with('clientproduct', $clientproduct);
    }

    /**
     * Update the specified Clientproduct in storage.
     *
     * @param  int              $id
     * @param UpdateClientproductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientproductRequest $request)
    {
        $clientproduct = $this->clientproductRepository->findWithoutFail($id);

        

        if (empty($clientproduct)) {
            Flash::error('Clientproduct not found');

            return redirect(route('clientproducts.index'));
        }

        $clientproduct = $this->clientproductRepository->update($request->all(), $id);

        Flash::success('Clientproduct updated successfully.');

        return redirect(route('admin.clientProduct.clientproducts.index'));
    }

    /**
     * Remove the specified Clientproduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.clientProduct.clientproducts.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Clientproduct::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.clientProduct.clientproducts.index'))->with('success', Lang::get('message.success.delete'));

       }

}
