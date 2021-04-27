<?php

namespace App\Http\Controllers\Admin\Producttype;

use App\Http\Requests;
use App\Http\Requests\Producttype\CreateProductTypeRequest;
use App\Http\Requests\Producttype\UpdateProductTypeRequest;
use App\Repositories\Producttype\ProductTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Producttype\ProductType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductTypeController extends InfyOmBaseController
{
    /** @var  ProductTypeRepository */
    private $productTypeRepository;

    public function __construct(ProductTypeRepository $productTypeRepo)
    {
        $this->productTypeRepository = $productTypeRepo;
    }

    /**
     * Display a listing of the ProductType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->productTypeRepository->pushCriteria(new RequestCriteria($request));
        $productTypes = $this->productTypeRepository->all();
        return view('admin.productType.productTypes.index')
            ->with('productTypes', $productTypes);
    }

    /**
     * Show the form for creating a new ProductType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productType.productTypes.create');
    }

    /**
     * Store a newly created ProductType in storage.
     *
     * @param CreateProductTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateProductTypeRequest $request)
    {
        $input = $request->all();

        $productType = $this->productTypeRepository->create($input);

        Flash::success('ProductType saved successfully.');

        return redirect(route('admin.productType.productTypes.index'));
    }

    /**
     * Display the specified ProductType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productType = $this->productTypeRepository->findWithoutFail($id);

        if (empty($productType)) {
            Flash::error('ProductType not found');

            return redirect(route('productTypes.index'));
        }

        return view('admin.productType.productTypes.show')->with('productType', $productType);
    }

    /**
     * Show the form for editing the specified ProductType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productType = $this->productTypeRepository->findWithoutFail($id);

        if (empty($productType)) {
            Flash::error('ProductType not found');

            return redirect(route('productTypes.index'));
        }

        return view('admin.productType.productTypes.edit')->with('productType', $productType);
    }

    /**
     * Update the specified ProductType in storage.
     *
     * @param  int              $id
     * @param UpdateProductTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductTypeRequest $request)
    {
        $productType = $this->productTypeRepository->findWithoutFail($id);

        

        if (empty($productType)) {
            Flash::error('ProductType not found');

            return redirect(route('productTypes.index'));
        }

        $productType = $this->productTypeRepository->update($request->all(), $id);

        Flash::success('ProductType updated successfully.');

        return redirect(route('admin.productType.productTypes.index'));
    }

    /**
     * Remove the specified ProductType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.productType.productTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProductType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.productType.productTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
