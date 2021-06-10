
{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('css/pages/invoice.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <h1>Credit Note</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                            Dashboard
                        </a>
                    </li>
                    <li ><a href="#"> Service Invoice</a></li>
                    <li class="active">Credit Note</li>
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
                                        <p><strong>CREDIT NOTE</strong></p>
                                 </div>
                                 <hr style="width:100%;text-align:left;margin-left:0">

                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                        <strong>Credit Note To:</strong><br>
                                        <p>{!! $creditNote->customer_name !!}<br>
                                        {!! $customerDetails->postal_address !!}<br>
                                        {!! $customerDetails->district !!}<br>
                                        {!! $customerDetails->region !!}<br>
                                        {!! $customerDetails->country !!}<br>
                                        <strong>TIN: </strong>{!! $customerDetails->t_i_n_number !!}<br>
                                        <strong>VRN: </strong>{!! $customerDetails->v_a_t_registration_number !!}</p><br>
                                    </div>
                                    
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                      </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="padding-right:0">
                                        <strong>TIN: 100-102-927</strong><br>
                                        <strong>VRN: 10-000002-S</strong><br><br>
                
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Credit Note No.</th>
                                            <th>Date.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{!! $creditNote['credit_note_no'] !!}</td>
                                            <td>{!! $creditNote['created_at'] !!}</td>
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
                                                    <th>VAT</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($service_name_description as $serviceInvoices)
                                                <tr>
                                                    <td>{{ $serviceInvoices->product_name }}</td>
                                                    <td>{{ $serviceInvoices->product_name }}</td>
                                                    <td>{{ $serviceInvoices->description }}</td>
                                                    <td>{{ number_format($serviceInvoices->vat_amount, 2) }}</td>
                                                    <td>{{ number_format($serviceInvoices->price, 2) }}</td>
                                                    <td>{{number_format($serviceInvoices->grand_total, 2)  }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Sub-Total(TZS)</strong></td>
                                                    <td><strong>{!! number_format($creditNote['sub_total'], 2) !!}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>VAT(TZS)</strong></td>
                                                    <td><strong>{!! number_format($creditNote['tax_amount'], 2) !!}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Total with VAT (TZS)</strong></td>
                                                    <td><strong>{!! number_format($creditNote['total_amount'], 2) !!}<strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <strong>Ressons for adjustment:</strong>{{$creditNote['reason_for_adjustment']}}
                                <br>
                                <br>
                                <br>


                                <div style="background-color: #eee;padding:15px;" id="footer-bg">
                                
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-6">
                                        
                                            <br>
                                            <br>
                                            <div >
                                                
                                                <strong>______________________________________________</strong><br>
                                                <strong>Prepared By:</strong><br>
                                                <strong>{{$creditNote['created_by']}}</strong><br>
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12">
                                        
                                            <br>
                                            <br>
                                            <div class="float-right">
                                                
                                                <strong>______________________________________________</strong><br>
                                                <strong>Authorized By:</strong><br>
                                                <strong>S. Malimi</strong><br>
                                                <strong>Head NIDC</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
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

