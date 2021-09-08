<?php

namespace App\Http\Controllers\Admin\Productrevenue;

use App\Http\Requests;
use App\Http\Requests\Productrevenue\CreateProductRevenueRequest;
use App\Http\Requests\Productrevenue\UpdateProductRevenueRequest;
use App\Repositories\Productrevenue\ProductRevenueRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Productrevenue\ProductRevenue;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class ProductRevenueController extends InfyOmBaseController
{
    /** @var  ProductRevenueRepository */
    private $productRevenueRepository;

    public function __construct(ProductRevenueRepository $productRevenueRepo)
    {
        $this->productRevenueRepository = $productRevenueRepo;
    }

    /**
     * Display a listing of the ProductRevenue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productRevenues = DB::table('products')->get();
        // $this->productRevenueRepository->pushCriteria(new RequestCriteria($request));
        // $productRevenues1 = $this->productRevenueRepository->all();
        return view('admin.productrevenue.productRevenues.index')
            ->with('productRevenues', $productRevenues);
    }

    /**
     * Show the form for creating a new ProductRevenue.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productrevenue.productRevenues.create');
    }

    /**
     * Store a newly created ProductRevenue in storage.
     *
     * @param CreateProductRevenueRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRevenueRequest $request)
    {
        $input = $request->all();

        $productRevenue = $this->productRevenueRepository->create($input);

        Flash::success('ProductRevenue saved successfully.');

        return redirect(route('admin.productrevenue.productRevenues.index'));
    }

    /**
     * Display the specified ProductRevenue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productRevenue = $this->productRevenueRepository->findWithoutFail($id);

        if (empty($productRevenue)) {
            Flash::error('ProductRevenue not found');

            return redirect(route('productRevenues.index'));
        }

        return view('admin.productrevenue.productRevenues.show')->with('productRevenue', $productRevenue);
    }

    /**
     * Show the form for editing the specified ProductRevenue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productRevenue = $this->productRevenueRepository->findWithoutFail($id);

        if (empty($productRevenue)) {
            Flash::error('ProductRevenue not found');

            return redirect(route('productRevenues.index'));
        }

        return view('admin.productrevenue.productRevenues.edit')->with('productRevenue', $productRevenue);
    }

    /**
     * Update the specified ProductRevenue in storage.
     *
     * @param  int              $id
     * @param UpdateProductRevenueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRevenueRequest $request)
    {
        $productRevenue = $this->productRevenueRepository->findWithoutFail($id);

        

        if (empty($productRevenue)) {
            Flash::error('ProductRevenue not found');

            return redirect(route('productRevenues.index'));
        }

        $productRevenue = $this->productRevenueRepository->update($request->all(), $id);

        Flash::success('ProductRevenue updated successfully.');

        return redirect(route('admin.productrevenue.productRevenues.index'));
    }

    /**
     * Remove the specified ProductRevenue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.productrevenue.productRevenues.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProductRevenue::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.productrevenue.productRevenues.index'))->with('success', Lang::get('message.success.delete'));

       }

}
