<?php

namespace App\Http\Controllers;

use App\Models\Serviceapproval;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;
use Flash;
use Illuminate\Support\Facades\Auth;

class ServiceapprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function show(Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function edit(Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serviceapproval $serviceapproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serviceapproval  $serviceapproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serviceapproval $serviceapproval)
    {
        //
    }

    
    public function serviceapprove(Request $request)
    {    
        // if commercial manager aprove

        if ($request->next_handler_role_id==='3' && $request->req_status==='approved') {
            
            $nexthandler = DB::table('role_users')->where('role_id','6')->get();
            $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
            $nexthandler_role = $nexthandler[0]->id;
            $nexthandler_role_id = '6';
            $prevhandler_role = DB::table('role_users')->where('role_id','3')->get();
            $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
            $prevhandler_role = $prevhandler_role[0]->id;
            $prevhandler_role_id = '3';
            $nexthandler1 = $nexthandler[0]->first_name;
            $nexthandler2 = $nexthandler[0]->last_name;
            $nexthandler3 = ' ';
            $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
            
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['next_handler' => $nexthandler, 'next_handler_role' => $nexthandler_role, 'next_handler_role_id' => $nexthandler_role_id, 'prev_handler_role' => $prevhandler_role, 'prev_handler_role_id' => $prevhandler_role_id]);
        
        Flash::success('ServiceOrders updated successfully.');
        return redirect(route('admin.serviceOrders.serviceOrders.index'));
    
        } elseif($request->next_handler_role_id==='6' && $request->req_status==='approved') {

            // if technical manager aprove

            $nexthandler = DB::table('role_users')->where('role_id','3')->get();
            $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
            $nexthandler_role = $nexthandler[0]->id;
            $nexthandler_role_id = '3';
            $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
            $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
            $prevhandler_role = $prevhandler_role[0]->id;
            $prevhandler_role_id = '6';
            $nexthandler1 = $nexthandler[0]->first_name;
            $nexthandler2 = $nexthandler[0]->last_name;
            $nexthandler3 = ' ';
            $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
            
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['next_handler' => $nexthandler, 'next_handler_role' => $nexthandler_role, 'next_handler_role_id' => $nexthandler_role_id, 'prev_handler_role' => $prevhandler_role, 'prev_handler_role_id' => $prevhandler_role_id]);
        
        Flash::success('ServiceOrders updated successfully.');
        return redirect(route('admin.serviceOrders.serviceOrders.index'));

        }elseif($request->next_handler_role_id==='3' && $request->req_status==='activated' && $request->prev_handler_role_id==='6') {
            $servicestatues = DB::table('servicestatuss')->where('id','1')->get();
            $servicestatues = $servicestatues[0]->service_status_name;
            $activationdate = $request->activation_date;
            $activatedby1= Sentinel::getUser()->first_name;
            $activatedby2= Sentinel::getUser()->last_name;
            $activatedby=$activatedby1.$activatedby2;
            $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
            ->update(['service_status' => $servicestatues, 'activation_date' => $activationdate, 'activated_by' => $activatedby]);

            // service billing creation
            $bill_no = DB::table('servicebillings')->orderBy('bill_no', 'desc')->first();
            if(is_null($bill_no)){
           $bill_no = 1000;
            }else{
                $bill_no = $bill_no->bill_no + 1;
            }
            
            $customer_name = $request->customer_name;
            $customer_no = $request->customer_no;
            $service_order_no =$request->order_i_d;
            $sub_total =$request->sub_total;
            $tax_amount =$request->tax_amount;
            $ed_amount =$request->ed_amount;
            $discount =$request->discount;
            $grand_total =$request->grand_total;

            // service billing insert into database
            $bill_creation = DB::table('servicebillings')
            ->insert(['bill_no' => $bill_no, 
                      'customer_name' => $customer_name, 
                      'customer_no' => $customer_no, 
                      'service_order_no' => $service_order_no,
                      'billing_date' => $activationdate,
                      'sub_total' => $sub_total,
                      'tax_amount' => $tax_amount,
                      'ed_amount' => $ed_amount,
                      'discount' => $discount,
                      'grand_total' => $grand_total]);

        
            Flash::success('ServiceOrders updated successfully.');
            return redirect(route('admin.serviceOrders.serviceOrders.index'));
            
        }elseif(Auth::user()->user_role == 'store') {
            $next_handler = 'sales';
        }elseif(Auth::user()->user_role == 'sales') {
            $next_handler = '';
        }


       // dd($nexthandler_role);
        

    }
}
