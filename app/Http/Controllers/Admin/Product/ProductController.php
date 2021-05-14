<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Product\ProductRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Product\Product;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Unitofmeasure\UnitofMeasure;
use App\Models\Producttype\ProductType;
use Carbon\Carbon;
use Mail;

class ProductController extends InfyOmBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $products = $this->productRepository->all();
        return view('admin.product.products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $product_unit = UnitofMeasure::get();
        $product_type = ProductType::get();
        return view('admin.product.products.create')
               ->with('product_unit', $product_unit)
               ->with('product_type', $product_type);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {

        $this->validate($request, [
            'product_name'  => ['required', 'unique:products,product_name'],
            'product_unit' => 'required',
            'product_type' => 'required',
            'v_a_t' => 'required',
            'price' => 'required',
        ]);


        $input = $request->all();

        // tax amount
        $sub_total =$request->price;
        $tax_amount_percent =$request->v_a_t;
        $tax_amount2 = $tax_amount_percent * 0.01;
        $tax_amount1 = $tax_amount2 * $sub_total;
        $tax_amount1 = round($tax_amount1, 2);
        
        // ED AMOUNT
        $ed_amount =$request->e_d;
        $ed_amount2 = $ed_amount * 0.01;
        $ed_amount1 = $ed_amount2 * $sub_total;
        $ed_amount1 = round($ed_amount1, 2);
        
        // DISCOUNT
        $discount = $request->discount;
        $discount = round($discount, 2);

       // sub total
        $sub_total =$sub_total + $ed_amount1;
        $sub_total = round($sub_total, 2);
        
        // GRAND TOTAL
        $grand_total = $sub_total + $tax_amount1;
        $grand_total = round($grand_total, 2);
        //dd($grand_total);

        $input = array(
            "product_name" => $request->product_name,
            "product_unit" => $request->product_unit,
            "product_type" => $request->product_type,
            "created_by" => $request->created_by,
            "product_no" => $request->product_no,
            "v_a_t" => $request->v_a_t,
            "e_d" => $request->e_d,
            "price" => $sub_total,
            "vat_amount" => $tax_amount1,	
            "discount" => $discount,
            "ed_amount" => $ed_amount1,
            "grand_total" => $grand_total,
            "description" => $request->description,

        );
        //dd($input);

        $product = $this->productRepository->create($input);
       


        Flash::success('Product saved successfully.');
        
        $mail_subjects = 'Product '.$request->product_name. ' created by '.$request->created_by.' on '.Carbon::now()->format('d-m-Y');
        $mail_content = 'Hello.,'.' Product '.$request->product_name. ' was created by '.$request->created_by.' on '.Carbon::now()->format('d-m-Y'). 'Please login to BSS (10.60.83.218) to Verify';

        Mail::raw($mail_content, function ($message)use ($mail_subjects) {
            $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
            $message->to('gloria.muhazi@nidc.co.tz')
                     ->cc('commercial@nidc.co.tz')
                     ->bcc('nidctanzania@gmail.com')
                        ->subject($mail_subjects);
        });

        return redirect(route('admin.product.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.product.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product_unit = UnitofMeasure::get();
        $product_type = ProductType::get();
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.product.products.edit')
        ->with('product', $product)
        ->with('product_unit', $product_unit)
        ->with('product_type', $product_type);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        //dd($product);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }
        
        // tax amount
        $sub_total =$request->price;
        $tax_amount_percent =$request->v_a_t;
        $tax_amount2 = $tax_amount_percent * 0.01;
        $tax_amount1 = $tax_amount2 * $sub_total;
        $tax_amount1 = round($tax_amount1, 2);
        
        // ED AMOUNT
        $ed_amount =$request->e_d;
        $ed_amount2 = $ed_amount * 0.01;
        $ed_amount1 = $ed_amount2 * $sub_total;
        $ed_amount1 = round($ed_amount1, 2);
        
        // DISCOUNT
        $discount = $request->discount;
        $discount = round($discount, 2);

       // sub total
        $sub_total =$sub_total + $ed_amount1;
        $sub_total = round($sub_total, 2);
        
        // GRAND TOTAL
        $grand_total = $sub_total + $tax_amount1;
        $grand_total = round($grand_total, 2);
        //dd($grand_total);

        $input = array(
            "product_name" => $request->product_name,
            "product_unit" => $request->product_unit,
            "product_type" => $request->product_type,
            "created_by" => $request->created_by,
            "product_no" => $request->product_no,
            "v_a_t" => $request->v_a_t,
            "e_d" => $request->e_d,
            "price" => $sub_total,
            "vat_amount" => $tax_amount1,	
            "discount" => $discount,
            "ed_amount" => $ed_amount1,
            "grand_total" => $grand_total,
            "description" => $request->description,

        );
        //dd($input);


        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('admin.product.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.product.products.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Product::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.product.products.index'))->with('success', Lang::get('message.success.delete'));

       }

}
