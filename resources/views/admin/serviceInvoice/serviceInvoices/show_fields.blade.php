



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
                           
                         <div class="card-body" style="border:1px solid #ccc;padding:0;margin:0;">

                            {{--  MAIN CONTENT  BEGIN  --}}
                            <div style="padding-left: 60px; padding-right: 60px;">
                            <div class="text-center" style="padding-top: 70px;">
                            <p><strong>TANZANIA TELECOMMUNICSTIONS CORPORATION </strong></p>
                            <p><strong>National Internet Data Center</strong></p>
                             </div>  


                                <div class="row" >
                                <div class="col-md-6 col-lg-6 col-12">
                                <div class="row" style="padding: 15px;margin-top:5px;">
                                        <div >
                                            <img src="{{ asset('images/ttcl.png') }}" style="width:80px;height:80px;" alt="logo" class="img-fluid">
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
                                        <p><strong>TAX INVOICE</strong></p>
                                 </div>
                                 <hr style="width:100%;text-align:left;margin-left:0">

                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                        <strong>Tax Invoice To:</strong><br>
                                        <p>{!! $serviceInvoice['cusromer_name'] !!}<br>
                                        {!! $serviceInvoice['postal_address'] !!}<br>
                                        {!! $serviceInvoice['district'] !!}<br>
                                        {!! $serviceInvoice['region'] !!}<br>
                                        {!! $serviceInvoice['country'] !!}<br>
                                        <strong>TIN: </strong>{!! $serviceInvoice['t_i_n_number'] !!}<br>
                                        <strong>VRN: </strong>{!! $serviceInvoice['v_a_t_registration_number'] !!}</p><br>
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                        <br><br><br><br><br><br>
                                        <strong>Total Previous Debt:</strong><br>
                                        {!! $serviceInvoice['previous_dept'] !!}<strong> TZS</strong></p><br>
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="padding-right:0">
                                        <strong>TIN: 100-102-927</strong><br>
                                        <strong>VRN: 10-000002 S</strong><br><br>
                
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Tax Invoice No.</th>
                                            <th>Date.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{!! $serviceInvoice['invoice_number'] !!}</td>
                                            <td>{!! $serviceInvoice['invoice_created_date'] !!}</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    </div>
                                    
                                </div>
                                <div class="row" style="padding:15px;">
                                    <div class="col-md-12 col-12 col-lg-12">
                                        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>SI No.</th>
                                                    <th>Item</th>
                                                    <th>Item Descriptions</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serviceInvoice['service_name_description'] as $serviceInvoices)
                                                <tr>
                                                    <td>{{ $serviceInvoices->product_name }}</td>
                                                    <td>{{ $serviceInvoices->product_name }}</td>
                                                    <td>{{ $serviceInvoices->description }}</td>
                                                    <td>{{ $serviceInvoices->price }}</td>
                                                    <td>{{ $serviceInvoices->price }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Sub-Total(TZS)</strong></td>
                                                    <td>225</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Net Total</td>
                                                    <td>2025.00</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>tax</td>
                                                    <td>599.40</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>TOTAL</strong></td>
                                                    <td><strong>2624.60</strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color: #eee;padding:15px;" id="footer-bg">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-12">
                                            <strong>Payment Details</strong><br>
                                            <strong>Kayin Bank</strong><br>
                                            <strong>Bank/Sort code</strong>: 32-25-85<br>
                                            <strong>Account Number</strong>: 54257963<br>
                                            <strong>Payment Reference</strong>: INV001<br>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12">
                                            <div class="float-right">
                                                <strong>Other Information</strong><br>
                                                <strong>Company Registration Number</strong>:254798621<br>
                                                <strong>Contact/PO</strong>:PO5876452
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="text-center"><strong>Payment should be made by bank transfer or cheque made by payable to Josh</strong></p>
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

