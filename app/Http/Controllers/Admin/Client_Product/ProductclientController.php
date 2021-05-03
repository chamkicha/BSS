<?php

namespace App\Http\Controllers\Admin\Client_Product;

use App\Http\Requests;
use App\Http\Requests\Client_Product\CreateProductclientRequest;
use App\Http\Requests\Client_Product\UpdateProductclientRequest;
use App\Repositories\Client_Product\ProductclientRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Client_Product\Productclient;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductclientController extends InfyOmBaseController
{
    /** @var  ProductclientRepository */
    private $productclientRepository;

    public function __construct(ProductclientRepository $productclientRepo)
    {
        $this->productclientRepository = $productclientRepo;
    }

    /**
     * Display a listing of the Productclient.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->productclientRepository->pushCriteria(new RequestCriteria($request));
        $productclients = $this->productclientRepository->all();
        return view('admin.clientProduct.productclients.index')
            ->with('productclients', $productclients);
    }

    /**
     * Show the form for creating a new Productclient.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clientProduct.productclients.create');
    }

    /**
     * Store a newly created Productclient in storage.
     *
     * @param CreateProductclientRequest $request
     *
     * @return Response
     */
    public function store(CreateProductclientRequest $request)
    {
        $input = $request->all();

        $productclient = $this->productclientRepository->create($input);

        Flash::success('Productclient saved successfully.');

        return redirect(route('admin.clientProduct.productclients.index'));
    }

    /**
     * Display the specified Productclient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productclient = $this->productclientRepository->findWithoutFail($id);

        if (empty($productclient)) {
            Flash::error('Productclient not found');

            return redirect(route('productclients.index'));
        }

        return view('admin.clientProduct.productclients.show')->with('productclient', $productclient);
    }

    /**
     * Show the form for editing the specified Productclient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productclient = $this->productclientRepository->findWithoutFail($id);

        if (empty($productclient)) {
            Flash::error('Productclient not found');

            return redirect(route('productclients.index'));
        }

        return view('admin.clientProduct.productclients.edit')->with('productclient', $productclient);
    }

    /**
     * Update the specified Productclient in storage.
     *
     * @param  int              $id
     * @param UpdateProductclientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductclientRequest $request)
    {
        $productclient = $this->productclientRepository->findWithoutFail($id);

        

        if (empty($productclient)) {
            Flash::error('Productclient not found');

            return redirect(route('productclients.index'));
        }

        $productclient = $this->productclientRepository->update($request->all(), $id);

        Flash::success('Productclient updated successfully.');

        return redirect(route('admin.clientProduct.productclients.index'));
    }

    /**
     * Remove the specified Productclient from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.clientProduct.productclients.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Productclient::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.clientProduct.productclients.index'))->with('success', Lang::get('message.success.delete'));

       }

}
