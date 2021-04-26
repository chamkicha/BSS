<?php

namespace App\Http\Controllers;

use App\Models\Serviceapproval;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;
use Flash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    
        //dd($request);
        //IF IS POST PAID 
     if($request->serviceordertypes==='PostPaid') 
     {

        
            // if commercial manager aprove
            //dd($request);
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'prev_handler_role' => $prevhandler_role,
                          'req_status'  => $request->req_status,
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order Approved and Sent to Technical Department');
        
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Commercial Department for activation request');

            }
            // if tech manager assign to user
            
            elseif($request->next_handler_role_id==='6' && $request->req_status==='assigned') {

                // if technical manager aprove

                $nexthandler = DB::table('users')->where('id',$request->assigned_to)->first();
                $nexthandler_role = '5';
                $nexthandler_role_id = '3';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler->first_name;
                $nexthandler2 = $nexthandler->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Techical manager');

            }

            
            // if tech manager assign to user to activate
            
            elseif($request->next_handler_role_id==='6' && $request->req_status==='assigned_activate') {

                // if technical manager aprove

                $nexthandler = DB::table('users')->where('id',$request->assigned_to)->first();
                $nexthandler_role = '5';
                $nexthandler_role_id = '3';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler->first_name;
                $nexthandler2 = $nexthandler->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Technical Team for Activation');

            }

            // technical staff aprove from assigned

            elseif($request->next_handler_role_id==='3' && $request->req_status==='assigned_approved') {

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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Commercial Department for activation request');

            }
            
            
            
            
            
            // commercial manager send activation request
            elseif($request->next_handler_role_id==='3' && $request->req_status==='activated_req' ) {
              
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
                // comment installation
                $comment= $request->comment;
                $username= Sentinel::getUser()->first_name;
                $comment_insert = DB::table('comments')
                ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);

                
            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'activation request was successfull sent to technical department');

            
            }

            
            // technical  staff activate service
            elseif($request->next_handler_role_id==='3' && $request->req_status==='assigned_activated_req') {

                $this->validate($request, ['activation_date'  => 'required',]);


                $nexthandler = DB::table('role_users')->where('role_id','4')->get();
                $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
                $nexthandler_role = $nexthandler[0]->id;
                $nexthandler_role_id = '4';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler[0]->first_name;
                $nexthandler2 = $nexthandler[0]->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['service_status' =>'Active', 
                          'next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'activated_by' => $request->activated_by,
                          'req_status'  => $request->req_status,
                          'activation_date' => $request->activation_date,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

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
                        'billing_date' => $request->activation_date,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


                        
                // Payment and Due creation
                
                $customer_no = $request->customer_no;
                $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                if(is_null($payment_due)){

                // PAYMENT AND DUE insert into database
                $grand_total_due =$request->grand_total;
                $bill_creation = DB::table('paymentanddues')
                ->insert(['customer_name' => $customer_name,
                        'total_amount' => $grand_total_due,
                        'balance' => $grand_total_due,
                        'customer_no' => $customer_no,]);


                }else{
                    
                    // PAYMENT AND DUE update into database
                    $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                    $grand_total2 = $grand_total3[0]->total_amount;
                    $grand_total1 = $request->grand_total;
                    $grand_total4 = $grand_total1 + $grand_total2;
                    $balance = $grand_total3[0]->balance;
                    $balance = $balance + $grand_total1;
                    
                    
                    $bill_creation = DB::table('paymentanddues')
                    ->where('customer_no', $customer_no)
                    ->update(['total_amount' => $grand_total4,
                            'balance' => $balance]);
                } // END PAYMEND AND DUE CREATIONM

                

                // INVOICE creation
                $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
                if(is_null($invoice_number)){
            $invoice_number = 1000;
                }else{
                    $invoice_number = $invoice_number->invoice_number + 1;
                }
                $activation_date = $request->activation_date;
                
                // next_invoice_date creation
                $payment_mode_intervals = DB::table('paymentmodes')
                                          ->where('payment_mode_name', $request->payment_mode)
                                          ->first()->payment_interval;
                $next_invoice_date = Carbon::parse($activation_date)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($next_invoice_date)->addDays(20)->format('Y-m-d');
                
                $cusromer_name = $request->customer_name;
                $customer_no = $request->customer_no;
                $service_order_no =$request->order_i_d;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$request->grand_total;
                $payment_amount =$request->grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                $current_charges =$request->grand_total;
                $service_name =$request->service_lists;

                // CUSTOMER REVENUE REPORT GENERATION POSTPAID
                $invoice_details = array(
                'invoice_number' => $invoice_number,
                'cusromer_name' => $cusromer_name, 
                'customer_no' => $customer_no, 
                'current_charges' => $current_charges, 
                'service_order_no' => $service_order_no,
                'invoice_created_date' => $activation_date,
                'due_balance' => $due_balance,
                'service_name' => $service_name,
                'payment_amount' => $payment_amount,
                'payment_status' => $payment_status,
                'sub_total' => $sub_total,
                'tax_amount' => $tax_amount,
                'ed_amount' => $ed_amount,
                'discount' => $discount,
                'grand_total' => $grand_total
                );
                $customer_report_run = $this->customer_report_revenue($invoice_details);

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $activation_date,
                        'next_invoice_date' => $next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'service_name' => $service_name,
                        'payment_amount' => $payment_amount,
                        'payment_mode' => $payment_mode_intervals,
                        'payment_status' => $payment_status,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);



                        return redirect(route('admin.serviceOrders.serviceOrders.index'))
                        ->with('success', 'service wa successful activated');
            
                
                        } // end IF kubwa

            // technical manager activate
            elseif($request->next_handler_role_id==='6' && $request->req_status==='activate') {
                
                $this->validate($request, ['activation_date'  => 'required',]);

                // if technical manager activate

                $nexthandler = DB::table('role_users')->where('role_id','4')->get();
                $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
                $nexthandler_role = $nexthandler[0]->id;
                $nexthandler_role_id = '4';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler[0]->first_name;
                $nexthandler2 = $nexthandler[0]->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['service_status' =>'Active', 
                          'next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'activation_date' => $request->activation_date,
                          'activated_by' => $request->activated_by,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

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
                        'billing_date' => $request->activation_date,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


                        
                // Payment and Due creation
                
                $customer_no = $request->customer_no;
                $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                if(is_null($payment_due)){

                // PAYMENT AND DUE insert into database
                $grand_total_due =$request->grand_total;
                $bill_creation = DB::table('paymentanddues')
                ->insert(['customer_name' => $customer_name,
                        'total_amount' => $grand_total_due,
                        'balance' => $grand_total_due,
                        'customer_no' => $customer_no,]);


                }else{
                    
                    // PAYMENT AND DUE update into database
                    $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                    $grand_total2 = $grand_total3[0]->total_amount;
                    $grand_total1 = $request->grand_total;
                    $grand_total4 = $grand_total1 + $grand_total2;
                    $balance = $grand_total3[0]->balance;
                    $balance = $balance + $grand_total1;
                    
                    
                    $bill_creation = DB::table('paymentanddues')
                    ->where('customer_no', $customer_no)
                    ->update(['total_amount' => $grand_total4,
                            'balance' => $balance]);
                } // END PAYMEND AND DUE CREATIONM

                

                // INVOICE creation
                $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
                if(is_null($invoice_number)){
            $invoice_number = 1000;
                }else{
                    $invoice_number = $invoice_number->invoice_number + 1;
                }

                $activation_date = $request->activation_date;

                
                // next_invoice_date creation
                $payment_mode_intervals = DB::table('paymentmodes')
                                          ->where('payment_mode_name', $request->payment_mode)
                                          ->first()->payment_interval;
                $next_invoice_date = Carbon::parse($activation_date)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($next_invoice_date)->addDays(20)->format('Y-m-d');
                
                $cusromer_name = $request->customer_name;
                $customer_no = $request->customer_no;
                $service_order_no =$request->order_i_d;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$request->grand_total;
                $payment_amount =$request->grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                $current_charges =$request->grand_total;
                $service_name =$request->service_lists;

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $activation_date,
                        'next_invoice_date' => $next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'service_name' => $service_name,
                        'payment_amount' => $payment_amount,
                        'payment_status' => $payment_status,
                        'payment_mode' => $payment_mode_intervals,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);



                        return redirect(route('admin.serviceOrders.serviceOrders.index'))
                        ->with('success', 'service wa successful activated');
            
                
                        } // end IF kubwa


            


     } // end ELSE IS POSTPAID



     // ELSE IS PREPAID
else{

    
            // if commercial manager aprove
            //dd($request);
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'prev_handler_role' => $prevhandler_role,
                          'req_status'  => $request->req_status,
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order Approved and Sent to Technical Department');
        
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);

            
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
                        'billing_date' => $request->activation_date,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


                        
                // Payment and Due creation
                
                $customer_no = $request->customer_no;
                $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                if(is_null($payment_due)){

                // PAYMENT AND DUE insert into database
                $grand_total_due =$request->grand_total;
                $bill_creation = DB::table('paymentanddues')
                ->insert(['customer_name' => $customer_name,
                        'total_amount' => $grand_total_due,
                        'balance' => $grand_total_due,
                        'customer_no' => $customer_no,]);


                }else{
                    
                    // PAYMENT AND DUE update into database
                    $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                    $grand_total2 = $grand_total3[0]->total_amount;
                    $grand_total1 = $request->grand_total;
                    $grand_total4 = $grand_total1 + $grand_total2;
                    $balance = $grand_total3[0]->balance;
                    $balance = $balance + $grand_total1;
                    
                    
                    $bill_creation = DB::table('paymentanddues')
                    ->where('customer_no', $customer_no)
                    ->update(['total_amount' => $grand_total4,
                            'balance' => $balance]);
                } // END PAYMEND AND DUE CREATIONM

                

                // INVOICE creation

                $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
                if(is_null($invoice_number)){
            $invoice_number = 1000;
                }else{
                    $invoice_number = $invoice_number->invoice_number + 1;
                }

                $activation_date = date('Y-m-d');

                // next_invoice_date creation
                $payment_mode_intervals = DB::table('paymentmodes')
                                          ->where('payment_mode_name', $request->payment_mode)
                                          ->first()->payment_interval;
                $next_invoice_date = Carbon::parse($activation_date)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($next_invoice_date)->addDays(20)->format('Y-m-d');

                $cusromer_name = $request->customer_name;
                $customer_no = $request->customer_no;
                $service_order_no =$request->order_i_d;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$request->grand_total;
                $payment_amount =$request->grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                $current_charges =$request->grand_total;
                $service_name =$request->service_lists;

                // CUSTOMER REVENUE REPORT GENERATION PREPAID
                $invoice_details = array(
                    'invoice_number' => $invoice_number,
                    'cusromer_name' => $cusromer_name, 
                    'customer_no' => $customer_no, 
                    'current_charges' => $current_charges, 
                    'service_order_no' => $service_order_no,
                    'invoice_created_date' => $activation_date,
                    'due_balance' => $due_balance,
                    'service_name' => $service_name,
                    'payment_amount' => $payment_amount,
                    'payment_status' => $payment_status,
                    'sub_total' => $sub_total,
                    'tax_amount' => $tax_amount,
                    'ed_amount' => $ed_amount,
                    'discount' => $discount,
                    'grand_total' => $grand_total
                    );
                    $customer_report_run = $this->customer_report_revenue($invoice_details);

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $activation_date,
                        'next_invoice_date' => $next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'service_name' => $service_name,
                        'payment_amount' => $payment_amount,
                        'payment_mode' => $payment_mode_intervals,
                        'payment_status' => $payment_status,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Commercial Department for activation request');

            }
            // if tech manager assign to user
            
            elseif($request->next_handler_role_id==='6' && $request->req_status==='assigned') {

                // if technical manager aprove

                $nexthandler = DB::table('users')->where('id',$request->assigned_to)->first();
                $nexthandler_role = '5';
                $nexthandler_role_id = '3';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler->first_name;
                $nexthandler2 = $nexthandler->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);

            
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
                        'billing_date' => $request->activation_date,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


                        
                // Payment and Due creation
                
                $customer_no = $request->customer_no;
                $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                if(is_null($payment_due)){

                // PAYMENT AND DUE insert into database
                $grand_total_due =$request->grand_total;
                $bill_creation = DB::table('paymentanddues')
                ->insert(['customer_name' => $customer_name,
                        'total_amount' => $grand_total_due,
                        'balance' => $grand_total_due,
                        'customer_no' => $customer_no,]);


                }else{
                    
                    // PAYMENT AND DUE update into database
                    $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                    $grand_total2 = $grand_total3[0]->total_amount;
                    $grand_total1 = $request->grand_total;
                    $grand_total4 = $grand_total1 + $grand_total2;
                    $balance = $grand_total3[0]->balance;
                    $balance = $balance + $grand_total1;
                    
                    
                    $bill_creation = DB::table('paymentanddues')
                    ->where('customer_no', $customer_no)
                    ->update(['total_amount' => $grand_total4,
                            'balance' => $balance]);
                } // END PAYMEND AND DUE CREATIONM

                

                // INVOICE creation
                $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
                if(is_null($invoice_number)){
            $invoice_number = 1000;
                }else{
                    $invoice_number = $invoice_number->invoice_number + 1;
                }

                $activation_date = date('Y-m-d');
                
                // next_invoice_date creation
                $payment_mode_intervals = DB::table('paymentmodes')
                                          ->where('payment_mode_name', $request->payment_mode)
                                          ->first()->payment_interval;
                $next_invoice_date = Carbon::parse($activation_date)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($next_invoice_date)->addDays(20)->format('Y-m-d');
                
                $cusromer_name = $request->customer_name;
                $customer_no = $request->customer_no;
                $service_order_no =$request->order_i_d;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$request->grand_total;
                $payment_amount =$request->grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                $current_charges =$request->grand_total;
                $service_name =$request->service_lists;

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $activation_date,
                        'next_invoice_date' => $next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'payment_mode' => $payment_mode_intervals,
                        'service_name' => $service_name,
                        'payment_amount' => $payment_amount,
                        'payment_status' => $payment_status,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);


        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Techical manager');

            }

            
            // if tech manager assign to user to activate
            
            elseif($request->next_handler_role_id==='6' && $request->req_status==='assigned_activate') {

                // if technical manager aprove

                $nexthandler = DB::table('users')->where('id',$request->assigned_to)->first();
                $nexthandler_role = '5';
                $nexthandler_role_id = '3';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler->first_name;
                $nexthandler2 = $nexthandler->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Technical Team for Activation');

            }

            // technical staff aprove from assigned

            elseif($request->next_handler_role_id==='3' && $request->req_status==='assigned_approved') {

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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        

            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'Order successfull Approved and Sent to Commercial Department for activation request');

            }
            
            
            
            
            
            // commercial manager send activation request
            elseif($request->next_handler_role_id==='3' && $request->req_status==='activated_req' ) {
              
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
                ->update(['next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
                // comment installation
                $comment= $request->comment;
                $username= Sentinel::getUser()->first_name;
                $comment_insert = DB::table('comments')
                ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);

                
            return redirect(route('admin.serviceOrders.serviceOrders.index'))
            ->with('success', 'activation request was successfull sent to technical department');

            
            }

            
            // technical  staff activate service
            elseif($request->next_handler_role_id==='3' && $request->req_status==='assigned_activated_req') {


                $nexthandler = DB::table('role_users')->where('role_id','4')->get();
                $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
                $nexthandler_role = $nexthandler[0]->id;
                $nexthandler_role_id = '4';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler[0]->first_name;
                $nexthandler2 = $nexthandler[0]->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['service_status' =>'Active', 
                          'next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'activated_by' => $request->activated_by,
                          'req_status'  => $request->req_status,
                          'activation_date' => $request->activation_date,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        


                        return redirect(route('admin.serviceOrders.serviceOrders.index'))
                        ->with('success', 'service wa successful activated');
            
                
                        } // end IF kubwa

            // technical manager activate
            elseif($request->next_handler_role_id==='6' && $request->req_status==='activate') {

                // if technical manager activate

                $nexthandler = DB::table('role_users')->where('role_id','4')->get();
                $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
                $nexthandler_role = $nexthandler[0]->id;
                $nexthandler_role_id = '4';
                $prevhandler_role = DB::table('role_users')->where('role_id','6')->get();
                $prevhandler_role = DB::table('users')->where('id',$prevhandler_role[0]->user_id)->get();
                $prevhandler_role = $prevhandler_role[0]->id;
                $prevhandler_role_id = '6';
                $nexthandler1 = $nexthandler[0]->first_name;
                $nexthandler2 = $nexthandler[0]->last_name;
                $nexthandler3 = ' ';
                $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
                
                $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->order_i_d)
                ->update(['service_status' =>'Active', 
                          'next_handler' => $nexthandler, 
                          'next_handler_role' => $nexthandler_role, 
                          'next_handler_role_id' => $nexthandler_role_id, 
                          'req_status'  => $request->req_status,
                          'activation_date' => $request->activation_date,
                          'activated_by' => $request->activated_by,
                          'prev_handler_role' => $prevhandler_role, 
                          'prev_handler_role_id' => $prevhandler_role_id]);
            
                
            // comment installation
            $comment= $request->comment;
            $username= Sentinel::getUser()->first_name;
            $comment_insert = DB::table('comments')
            ->insert(['comment' => $comment, 'order_i_d' => $request->order_i_d, 'username' => $username]);
        


                        return redirect(route('admin.serviceOrders.serviceOrders.index'))
                        ->with('success', 'service was successful activated');
            
                
                        } // end IF kubwa


                    }


}// end ELSE IS PREPAID


// CUSTOMER REVENUE REPORT CLASS
public function customer_report_revenue($clientreport)
{

    $service_order_type = DB::table('revenuepercustomerreports')
                          ->where('customer_no', $clientreport['customer_no'])
                          ->first();

    $customer_type = DB::table('customers')
                          ->where('id', $clientreport['customer_no'])
                          ->first()
                          ->customer_type;

   $service_name = (array)json_decode($clientreport['service_name'], true);
    
    $excise_dutty = DB::table('products')
                        ->whereIn('product_name', $service_name)
                        ->sum('ed_amount');
    
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    if(is_null($service_order_type)){

    $service_order_type = DB::table('revenuepercustomerreports')
                                ->insert([
                                    'customer_name' => $clientreport['cusromer_name'],
                                    'customer_no' => $clientreport['customer_no'],
                                    'customer_type' => $customer_type,
                                    'services' => $clientreport['service_name'],
                                    'excise_dutty' => (int)$excise_dutty,
                                    'v_a_t' => (int)$clientreport['tax_amount'],
                                    'total_wit_vat' => (int)$clientreport['grand_total'],
                                    'created_at' => $created_at
                                ]);


    }else{
    //dd($clientreport);

        $service_order_type = DB::table('revenuepercustomerreports')
                          ->where('customer_no', $clientreport['customer_no'])
                          ->first();
        $excise_dutty = (int)$service_order_type->excise_dutty + (int)$excise_dutty;
        $tax_amount = (int)$service_order_type->v_a_t + (int)$clientreport['tax_amount'];
        $grand_total = (int)$service_order_type->total_wit_vat + (int)$clientreport['grand_total'];
        //$service_name = $service_order_type->services + $clientreport['service_name'];

        $service_order_type = DB::table('revenuepercustomerreports')
                          ->where('customer_no', $clientreport['customer_no'])
                          ->update([
                            //'services' => $service_name,
                            'excise_dutty' => $excise_dutty,
                            'v_a_t' => $tax_amount,
                            'total_wit_vat' => $grand_total,
                            'updated_at' => $updated_at,
                        ]);

    }
    //dd($clientreport);
    

} // END CUSTOMER REVENUE REPORT CLASS



}

