<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $invoicwePayment->id !!}</p>
    <hr>
</div>

<!-- Invoice Number Field -->
<div class="form-group">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    <p>{!! $invoicwePayment->invoice_number !!}</p>
    <hr>
</div>

<!-- Payment Amount Field -->
<div class="form-group">
    {!! Form::label('payment_amount', 'Payment Amount:') !!}
    <p>{!! $invoicwePayment->payment_amount !!}</p>
    <hr>
</div>

<!-- Payment Type Field -->
<div class="form-group">
    {!! Form::label('payment_type', 'Payment Type:') !!}
    <p>{!! $invoicwePayment->payment_type !!}</p>
    <hr>
</div>

<!-- Payment Descriptions Field -->
<div class="form-group">
    {!! Form::label('payment_descriptions', 'Payment Descriptions:') !!}
    <p>{!! $invoicwePayment->payment_descriptions !!}</p>
    <hr>
</div>

<!-- Upload Supportingdocument Field -->
<div class="form-group">
    {!! Form::label('upload_supportingdocument', 'Upload Supportingdocument:') !!}
    <p>{!! $invoicwePayment->upload_supportingdocument !!}</p>
    <hr>
</div>


{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('css/pages/invoice.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <h1>Invoice</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                            Dashboard
                        </a>
                    </li>
                    <li ><a href="#"> Service Invoice</a></li>
                    <li class="active">Invoice</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content my-3 pr-3 pl-3" id="invoice-stmt">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header bg-success text-white"> </div>
                           
                         <div class="card-body" style="padding:0;margin:0;">

                            {{--  MAIN CONTENT  BEGIN  --}}
                            <div style="padding-left: 60px; padding-right: 60px;">
                            <div class="text-center" style="padding-top: 70px;">
                            <p><strong>TANZANIA TELECOMMUNICATIONS CORPORATION </strong></p>
                            <p><strong>National Internet Data Center</strong></p>
                             </div>  


                                <div class="row" >
                                <div class="col-md-6 col-lg-6 col-12">
                                <div class="row" style="padding: 15px;margin-top:5px;">
                                        <div >
                                            <img src="{{ asset('images/ttcllogo.png') }}" style="width:90px;height:90px;" alt="logo" class="img-fluid">
                                        </div>
                                        <div class="float-left" style="margin-left:10px;">
                                            Telephone:+255(0)22 292 6402<br>
                                            Email:commercial@nidc.co.tz<br>
                                            Website:www.nidc.co.tz
                                        </div>
                                    
                                 </div>  
                                 </div>
                                    <div class="col-md-6 col-lg-6 col-12" style="display: flex; justify-content: flex-end">
                                        <div class="row" style="padding: 15px;margin-top:5px;">
                                        
                                        <div class="float-right">
                                        National Internet Data Center<br>
                                        Kijitonyama Area<br>
                                        P.O BOX 31611<br>
                                        Dar es salaam
                                        </div>
                                        <div >
                                            <img src="{{ asset('images/nidc.png') }}" style="width:160px;height:80px;" alt="logo" class="img-fluid">
                                        </div>
                                    
                                 </div>
                                    </div>
                                </div>

                                <div class="text-center" style="padding-top: 10px;">
                                        <p><strong>VAT#10-000002-S TIN#100-102-927 / ZBR VAT#07-00313-K ZBR TIN#300-103-545</strong></p>
                                 </div>

                                <div class="text-left" style="padding-top: 10px;">
                                        <p><strong>Received at: {!! \Carbon\Carbon::parse($invoicwePayment->created_at)->format('d-M-y') !!}</strong></p>
                                 </div>

                                <div class="text-center" style="padding-top: 10px;">
                                        <p><strong>RECEIPT</strong></p>
                                 </div>
                                 <hr style="width:100%;text-align:left;margin-left:0">

                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                        <p><strong>Received with thanks from: </strong>{!! $customerDetails->customername !!}<br>
                                        <strong>Customer No: </strong> {!! $customerDetails->customer_no !!}<br>
                                        <strong>District: </strong> {!! $customerDetails->district !!}<br>
                                        <strong>Region: </strong> {!! $customerDetails->region !!}<br>
                                        <strong>Country: </strong> {!! $customerDetails->country !!}<br>
                                        <strong>TIN: </strong>{!! $customerDetails->t_i_n_number !!}<br>
                                        <strong>VRN: </strong>{!! $customerDetails->v_a_t_registration_number !!}</p><br>
                                    </div>
                                    
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                      </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="padding-right:0">

                                    </div>
                                    
                                </div>
                                <p style="padding-left: 15px;"><strong>The sum of TZS {!! $invoicwePayment->payment_amount !!} ({!! $payment_amount_spell !!} only).</strong></p>
                                <br>
                                <br>
                                <br>


                                <div style="background-color: #eee;padding:15px;" id="footer-bg">
                                
                                    <div >
                                        <div >
                                        
                                            <br>
                                            <br>
                                            <div >
                                                
                                                <strong>Supervisor's Signature:</strong>
                                                <strong> ______________________________________________ </strong><strong>Date:  __________________________________ </strong><br>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <p style="padding-left: 15px;">Note: "Payments done through the Direct System/ Online system will only allocated into the customer's account once the payments has been validated with the Bank"</p>
                                    <div style="margin:10px 20px;text-align:center;" class="btn-section">

                                        
                                        <button type="button" class="btn btn_marTop button-alignment btn-info"
                                                data-toggle="button">
                                            <a style="color:#fff;" onclick="javascript:window.print();">
                                                <i class="livicon" data-name="printer" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white" style="position:relative;top:3px;"></i>
                                                Print
                                            </a>
                                        </button>
                                        <button type="button" class="btn btn_marTop button-alignment btn-secondary default_voice"
                                                data-toggle="button">
                                            <a style="color:#333;">
                                                <i class="livicon" data-name="check" data-size="16" data-loop="true"
                                                   data-c="#111" data-hc="#111" style="position:relative;top:3px;"></i>
                                                Send Your Invoice
                                            </a>
                                        </button>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
                <!-- content --> 
    @stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script  src="{{ asset('js/pages/invoice.js') }}"  type="text/javascript"></script>

@stop



