<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;

class PaymentController extends Controller
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
    public function create(Request $request)
    {
       
        
        $paymentmode_list = DB::table('paymenttypes')->get();
        $invoicenumber = $request->invoice_number;
        $paymentamount = $request->grand_total;
        $service_order_no = $request->service_order_no;
        $cusromer_name = $request->cusromer_name;
        $serviceordertypes = $request->serviceordertypes;
        return view('admin.invoicwePayment.invoicwePayments.create')
               ->with('invoicenumber', $invoicenumber)
               ->with('paymentmode_list', $paymentmode_list)
               ->with('cusromer_name', $cusromer_name)
               ->with('service_order_no', $service_order_no)
               ->with('serviceordertypes', $serviceordertypes)
               ->with('paymentamount', $paymentamount);


               

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->serviceordertypes==="Prepaid"){



       
        $payment_amount = $request->payment_amount;
        $payment_type = $request->payment_type;
        $payment_descriptions = $request->payment_descriptions;
        $upload_supportingdocument = $request->upload_supportingdocument;
        $invoice_number = $request->invoice_number;
        $cusromer_name = $request->cusromer_name;
        $grand_total = $request->grand_total;

        
        // payments insert into database
        $bill_creation = DB::table('invoicwepayments')
        ->insert(['payment_amount' => $payment_amount, 
                    'payment_type' => $payment_type, 
                    'payment_descriptions' => $payment_descriptions, 
                    'upload_supportingdocument' => $upload_supportingdocument,
                    'invoice_number' => $invoice_number,
                    'cusromer_name' => $cusromer_name,
                    'grand_total' => $grand_total,]);


        // status updates update
        
        $bill_creation = DB::table('serviceinvoices')
        ->where('invoice_number', $invoice_number)
        ->update(['payment_status' => $payment_type]);

        
        // payment and due update
        
        $paymentmode_due_details = DB::table('paymentanddues')
                    ->where('customer_name', $cusromer_name)
                    ->get();
                    
        $total_amount = $paymentmode_due_details[0]->total_amount;
        $paid_amount = $payment_amount;
        
        $balance = $total_amount - $paid_amount;



        // Payment For Prepaid update
        
            
        $servicestatues = DB::table('servicestatuss')->where('id','1')->get();
        $servicestatues = $servicestatues[0]->service_status_name;
        $activationdate = $request->activation_date;
        $activatedby1= Sentinel::getUser()->first_name;
        $activatedby2= Sentinel::getUser()->last_name;
        $activatedby=$activatedby1.$activatedby2;
        $servicestatus = DB::table('serviceorderss')->where('order_i_d', $request->service_order_no)
        ->update(['service_status' => $servicestatues, 'activation_date' => $activationdate, 'activated_by' => $activatedby]);


        } //END IF PREPAID CUSTOMER
        else{

            


        //dd($request);
        $payment_amount = $request->payment_amount;
        $payment_type = $request->payment_type;
        $payment_descriptions = $request->payment_descriptions;
        $upload_supportingdocument = $request->upload_supportingdocument;
        $invoice_number = $request->invoice_number;
        $cusromer_name = $request->cusromer_name;
        $grand_total = $request->grand_total;

        
        // payments insert into database
        $bill_creation = DB::table('invoicwepayments')
        ->insert(['payment_amount' => $payment_amount, 
                    'payment_type' => $payment_type, 
                    'payment_descriptions' => $payment_descriptions, 
                    'upload_supportingdocument' => $upload_supportingdocument,
                    'invoice_number' => $invoice_number,
                    'cusromer_name' => $cusromer_name,
                    'grand_total' => $grand_total,]);


        // status updates update
        
        $bill_creation = DB::table('serviceinvoices')
        ->where('invoice_number', $invoice_number)
        ->update(['payment_status' => $payment_type]);

        // payment and due update
        
        $paymentmode_due_details = DB::table('paymentanddues')
                    ->where('customer_name', $cusromer_name)
                    ->get();
                    
        $total_amount = $paymentmode_due_details[0]->total_amount;
        $paid_amount = $payment_amount;
        
        $balance = $total_amount - $paid_amount;
       

        $paymentmode_due_update = DB::table('paymentanddues')
        ->where('customer_name', $cusromer_name)
        ->update(['paid_amount' => $paid_amount,
                  'balance' => $balance]);


        }

        Flash::success('Invoice Payment saved successfully.');

        return redirect(route('admin.invoicwePayment.invoicwePayments.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
