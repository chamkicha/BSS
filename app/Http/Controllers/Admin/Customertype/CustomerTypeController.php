<?php

namespace App\Http\Controllers\Admin\Customertype;

use App\Http\Requests;
use App\Http\Requests\Customertype\CreateCustomerTypeRequest;
use App\Http\Requests\Customertype\UpdateCustomerTypeRequest;
use App\Repositories\Customertype\CustomerTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Customertype\CustomerType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CustomerTypeController extends InfyOmBaseController
{
    /** @var  CustomerTypeRepository */
    private $customerTypeRepository;

    public function __construct(CustomerTypeRepository $customerTypeRepo)
    {
        $this->customerTypeRepository = $customerTypeRepo;
    }

    /**
     * Display a listing of the CustomerType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->customerTypeRepository->pushCriteria(new RequestCriteria($request));
        $customerTypes = $this->customerTypeRepository->all();
        return view('admin.customerType.customerTypes.index')
            ->with('customerTypes', $customerTypes);
    }

    /**
     * Show the form for creating a new CustomerType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.customerType.customerTypes.create');
    }

    /**
     * Store a newly created CustomerType in storage.
     *
     * @param CreateCustomerTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerTypeRequest $request)
    {
        $input = $request->all();

        $customerType = $this->customerTypeRepository->create($input);

        Flash::success('CustomerType saved successfully.');

        return redirect(route('admin.customerType.customerTypes.index'));
    }

    /**
     * Display the specified CustomerType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerType = $this->customerTypeRepository->findWithoutFail($id);

        if (empty($customerType)) {
            Flash::error('CustomerType not found');

            return redirect(route('customerTypes.index'));
        }

        return view('admin.customerType.customerTypes.show')->with('customerType', $customerType);
    }

    /**
     * Show the form for editing the specified CustomerType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerType = $this->customerTypeRepository->findWithoutFail($id);

        if (empty($customerType)) {
            Flash::error('CustomerType not found');

            return redirect(route('customerTypes.index'));
        }

        return view('admin.customerType.customerTypes.edit')->with('customerType', $customerType);
    }

    /**
     * Update the specified CustomerType in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerTypeRequest $request)
    {
        $customerType = $this->customerTypeRepository->findWithoutFail($id);

        

        if (empty($customerType)) {
            Flash::error('CustomerType not found');

            return redirect(route('customerTypes.index'));
        }

        $customerType = $this->customerTypeRepository->update($request->all(), $id);

        Flash::success('CustomerType updated successfully.');

        return redirect(route('admin.customerType.customerTypes.index'));
    }

    /**
     * Remove the specified CustomerType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.customerType.customerTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = CustomerType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.customerType.customerTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
