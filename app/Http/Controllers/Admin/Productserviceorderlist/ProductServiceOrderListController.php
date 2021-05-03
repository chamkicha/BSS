<?php

namespace App\Http\Controllers\Admin\Productserviceorderlist;

use App\Http\Requests;
use App\Http\Requests\Productserviceorderlist\CreateProductServiceOrderListRequest;
use App\Http\Requests\Productserviceorderlist\UpdateProductServiceOrderListRequest;
use App\Repositories\Productserviceorderlist\ProductServiceOrderListRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Productserviceorderlist\ProductServiceOrderList;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductServiceOrderListController extends InfyOmBaseController
{
    /** @var  ProductServiceOrderListRepository */
    private $productServiceOrderListRepository;

    public function __construct(ProductServiceOrderListRepository $productServiceOrderListRepo)
    {
        $this->productServiceOrderListRepository = $productServiceOrderListRepo;
    }

    /**
     * Display a listing of the ProductServiceOrderList.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->productServiceOrderListRepository->pushCriteria(new RequestCriteria($request));
        $productServiceOrderLists = $this->productServiceOrderListRepository->all();
        return view('admin.productServiceOrderList.productServiceOrderLists.index')
            ->with('productServiceOrderLists', $productServiceOrderLists);
    }

    /**
     * Show the form for creating a new ProductServiceOrderList.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productServiceOrderList.productServiceOrderLists.create');
    }

    /**
     * Store a newly created ProductServiceOrderList in storage.
     *
     * @param CreateProductServiceOrderListRequest $request
     *
     * @return Response
     */
    public function store(CreateProductServiceOrderListRequest $request)
    {
        $input = $request->all();

        $productServiceOrderList = $this->productServiceOrderListRepository->create($input);

        Flash::success('ProductServiceOrderList saved successfully.');

        return redirect(route('admin.productServiceOrderList.productServiceOrderLists.index'));
    }

    /**
     * Display the specified ProductServiceOrderList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productServiceOrderList = $this->productServiceOrderListRepository->findWithoutFail($id);

        if (empty($productServiceOrderList)) {
            Flash::error('ProductServiceOrderList not found');

            return redirect(route('productServiceOrderLists.index'));
        }

        return view('admin.productServiceOrderList.productServiceOrderLists.show')->with('productServiceOrderList', $productServiceOrderList);
    }

    /**
     * Show the form for editing the specified ProductServiceOrderList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productServiceOrderList = $this->productServiceOrderListRepository->findWithoutFail($id);

        if (empty($productServiceOrderList)) {
            Flash::error('ProductServiceOrderList not found');

            return redirect(route('productServiceOrderLists.index'));
        }

        return view('admin.productServiceOrderList.productServiceOrderLists.edit')->with('productServiceOrderList', $productServiceOrderList);
    }

    /**
     * Update the specified ProductServiceOrderList in storage.
     *
     * @param  int              $id
     * @param UpdateProductServiceOrderListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductServiceOrderListRequest $request)
    {
        $productServiceOrderList = $this->productServiceOrderListRepository->findWithoutFail($id);

        

        if (empty($productServiceOrderList)) {
            Flash::error('ProductServiceOrderList not found');

            return redirect(route('productServiceOrderLists.index'));
        }

        $productServiceOrderList = $this->productServiceOrderListRepository->update($request->all(), $id);

        Flash::success('ProductServiceOrderList updated successfully.');

        return redirect(route('admin.productServiceOrderList.productServiceOrderLists.index'));
    }

    /**
     * Remove the specified ProductServiceOrderList from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.productServiceOrderList.productServiceOrderLists.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProductServiceOrderList::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.productServiceOrderList.productServiceOrderLists.index'))->with('success', Lang::get('message.success.delete'));

       }

}
