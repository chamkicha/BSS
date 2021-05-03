<?php

namespace App\Http\Controllers\Admin\Client_Product;

use App\Http\Requests;
use App\Http\Requests\Client_Product\CreateClient_productRequest;
use App\Http\Requests\Client_Product\UpdateClient_productRequest;
use App\Repositories\Client_Product\Client_productRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Client_Product\Client_product;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Client_productController extends InfyOmBaseController
{
    /** @var  Client_productRepository */
    private $clientProductRepository;

    public function __construct(Client_productRepository $clientProductRepo)
    {
        $this->clientProductRepository = $clientProductRepo;
    }

    /**
     * Display a listing of the Client_product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->clientProductRepository->pushCriteria(new RequestCriteria($request));
        $clientProducts = $this->clientProductRepository->all();
        return view('admin.clientProduct.clientProducts.index')
            ->with('clientProducts', $clientProducts);
    }

    /**
     * Show the form for creating a new Client_product.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clientProduct.clientProducts.create');
    }

    /**
     * Store a newly created Client_product in storage.
     *
     * @param CreateClient_productRequest $request
     *
     * @return Response
     */
    public function store(CreateClient_productRequest $request)
    {
        $input = $request->all();

        $clientProduct = $this->clientProductRepository->create($input);

        Flash::success('Client_product saved successfully.');

        return redirect(route('admin.clientProduct.clientProducts.index'));
    }

    /**
     * Display the specified Client_product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clientProduct = $this->clientProductRepository->findWithoutFail($id);

        if (empty($clientProduct)) {
            Flash::error('Client_product not found');

            return redirect(route('clientProducts.index'));
        }

        return view('admin.clientProduct.clientProducts.show')->with('clientProduct', $clientProduct);
    }

    /**
     * Show the form for editing the specified Client_product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clientProduct = $this->clientProductRepository->findWithoutFail($id);

        if (empty($clientProduct)) {
            Flash::error('Client_product not found');

            return redirect(route('clientProducts.index'));
        }

        return view('admin.clientProduct.clientProducts.edit')->with('clientProduct', $clientProduct);
    }

    /**
     * Update the specified Client_product in storage.
     *
     * @param  int              $id
     * @param UpdateClient_productRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClient_productRequest $request)
    {
        $clientProduct = $this->clientProductRepository->findWithoutFail($id);

        

        if (empty($clientProduct)) {
            Flash::error('Client_product not found');

            return redirect(route('clientProducts.index'));
        }

        $clientProduct = $this->clientProductRepository->update($request->all(), $id);

        Flash::success('Client_product updated successfully.');

        return redirect(route('admin.clientProduct.clientProducts.index'));
    }

    /**
     * Remove the specified Client_product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.clientProduct.clientProducts.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Client_product::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.clientProduct.clientProducts.index'))->with('success', Lang::get('message.success.delete'));

       }

}
