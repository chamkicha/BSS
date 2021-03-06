
<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function get_signature_by()
{      
    
    $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
} 

?>



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
                                        <p><strong>TAX INVOICE</strong></p>
                                 </div>
                                 <hr style="width:100%;text-align:left;margin-left:0">

                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">
                                        <strong>Tax Invoice To:</strong><br>
                                        <p><strong>Customer Name:&nbsp;</strong>{!! $serviceInvoice['cusromer_name'] !!}<br>
                                        <strong>Address:</strong>&nbsp;{!! $serviceInvoice['postal_address'] !!}<br>
                                        <strong>Disrtict:</strong>&nbsp;{!! $serviceInvoice['district'] !!}<br>
                                        <strong>Region:</strong>&nbsp;{!! $serviceInvoice['region'] !!}<br>
                                        <strong>Country:</strong>&nbsp;{!! $serviceInvoice['country'] !!}<br>
                                        <strong>TIN: </strong>&nbsp;{!! $serviceInvoice['t_i_n_number'] !!}<br>
                                        <strong>VRN: </strong>&nbsp;{!! $serviceInvoice['v_a_t_registration_number'] !!}</p><br>
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="margin-top:5px;">

                                        <br>

                                        <strong>TIN:</strong> 100-102-927<br>
                                        <strong>VRN:</strong> 10-000002-S<br>
                                        <strong>Tax Invoice No.:</strong> {!! $serviceInvoice['invoice_number'] !!}<br>
                                        <strong>Bill Period:</strong> {!! $serviceInvoice['invoice_created_date'] !!} &nbsp;<strong>to</strong> &nbsp;{!! $serviceInvoice['next_invoice_date'] !!}<br>
                                        {{--  <strong>Due Date:</strong> {!! $serviceInvoice['invoice_due_date'] !!} <br>  --}}

                                        @if(!empty($serviceInvoice['qrcode_path']))

                                         <img src="{{ URL::asset('public/qrimages/'.$serviceInvoice['qrcode_path']) }}" /><br>
                                        Verification Code: <strong>{!! $serviceInvoice['RCTVNUM'] !!}</strong><br>
                                        Verification Time: <strong>{!! $serviceInvoice['RCTVNUM_DATE'] !!}</strong>  <br><br>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4" style="padding-right:0; border: thin solid black">
                                        
                                        <strong>Summary of total transaction for the period</strong><br>
                                        <hr>

                                        <table style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Balance & Payment</th>
                                                <th>Amount(Tzs)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>(+)Previous Balance:</td>
                                                <td>{!! number_format($serviceInvoice['previous_dept'], 2) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>(-)Payment Received:</td>
                                                <td>{!! number_format($serviceInvoice['previous_paid'], 2) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>(+)Current Bill:</td>
                                                <td>{!! number_format($serviceInvoice['grand_total'], 2) !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <strong>Total Current Charges: {!! number_format($serviceInvoice['Prev_current_total'], 2) !!}</strong>

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
                                                    <th>VAT</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serviceInvoice['service_name_description'] as $serviceInvoices)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $serviceInvoices->product_name }}</td>
                                                    <td>{{ $serviceInvoices->product_description }}*{{ $serviceInvoices->product_quantity }}</td>
                                                    <td>{{ number_format($serviceInvoices->price, 2) }}</td>
                                                    <td>{{ number_format($serviceInvoices->vat_amount, 2) }}</td>
                                                    <td>{{number_format($serviceInvoices->amount, 2)  }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Sub-Total(TZS)</strong></td>
                                                    <td><strong>{!! number_format($serviceInvoice['sub_total'], 2) !!}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>VAT(TZS)</strong></td>
                                                    <td><strong>{!! number_format($serviceInvoice['tax_amount_total'], 2) !!}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Total with VAT (TZS)</strong></td>
                                                    <td><strong>{!! number_format($serviceInvoice['grand_total'], 2) !!}<strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color: #eee;padding:15px;" id="footer-bg">
                                
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-12">
                                            <div >
                                                <strong>Bank Account Details:</strong><br>
                                                <strong>Account No </strong>: 9925260961<br>
                                                <strong>Account Name </strong>: Tanzania Telecommunications Corporation<br>
                                                <strong>Bank </strong>: Bank of Tanzania (BOT)<br>
                                                <strong>Currency </strong>: TZS<br>
                                                </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-12">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12">
                                            <div class="float-right">
                                                
                                                <br>
                                                <strong>______________________________________________</strong><br>
                                               <div class="text-center">
                                                    <strong>S. Malimi</strong><br>
                                                    <strong>Head NIDC</strong>

                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="text-center"><strong>Please, present copy of this invoice during payment.</strong></p>
                                    
                                    <div style="margin:10px 20px;text-align:center;" class="btn-section">

                                        <!-- form add start-->
                                     <form action="{{ url('invoicenumber') }}" method = "post"><!-- form add -->
                                            {{ csrf_field() }}


                                        <!-- Invoice number Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="invoice_number" name="invoice_number" class="form-control" value="{{$serviceInvoice['invoice_number']}}" >

                                        </div>

                                        
                                        <!-- Payment amount Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="grand_total" name="grand_total" class="form-control" value="{{$serviceInvoice['grand_total']}}" >

                                        </div>

                                        
                                        <!-- Service Order  type Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="service_order_no" name="service_order_no" class="form-control" value="{{$serviceInvoice['service_order_no']}}" >

                                        </div>

                                        
                                        <!-- Service Order  id Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="serviceordertypes" name="serviceordertypes" class="form-control" value="{{$serviceInvoice['serviceordertypes']}}" >

                                        </div>

                                        
                                        <!-- Payment amount Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="cusromer_name" name="cusromer_name" class="form-control" value="{{$serviceInvoice['cusromer_name'] }}" >

                                        </div>

                                        
                                        <!-- Payment amount Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="customer_no" name="customer_no" class="form-control" value="{{$serviceInvoice['customer_no'] }}" >

                                        </div>


                                        @if($serviceInvoice['payment_status'] !== 'Fully')
                                        <button type="submit" class="btn btn_marTop button-alignment btn-info"
                                                data-toggle="button">
                                            <a style="color:#fff;"">
                                                <i class="livicon" data-name="printer" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white" style="position:relative;top:3px;"></i>
                                               Make Payment
                                            </a>
                                        </button>
                                        @endif

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

                                        

                                        </form><!-- form add end -->
                                    </div>

                                    
                                    <div style="margin:10px 20px;text-align:center;" class="btn-section">

                                        <!-- form  GET SIGNATURE add start-->
                                     <form action="{{ route('admin.serviceInvoice.serviceInvoices.traapi') }}" method = "post"><!-- form add -->
                                            {{ csrf_field() }}


                                        <!-- Invoice number Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="invoice_number" name="invoice_number" class="form-control" value="{{$serviceInvoice['invoice_number']}}" >

                                        </div>

                                        
                                        <!-- client mobile number  number Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="mobile_number" name="mobile_number" class="form-control" value="{{$serviceInvoice['mobile_number']}}" >

                                        </div>
                                        
                                        <!-- Payment amount Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="grand_total" name="grand_total" class="form-control" value="{{ str_replace(',', '', number_format($serviceInvoice['grand_total'],2))}}" >

                                        </div>
                                        

                                        <!-- Sub total Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="sub_total" name="sub_total" class="form-control" value="{{$serviceInvoice['sub_total'] }}" >

                                        </div>
                                        

                                        <!-- Total Vat Amount Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="tax_amount_total" name="tax_amount_total" class="form-control" value="{{$serviceInvoice['tax_amount_total'] }}" >

                                        </div>

                                        <!-- service_name_description Field -->
                                        <div class="form-group col-sm-12">
                                        
                                                @foreach($serviceInvoice['service_name_description'] as $serviceInvoices)
                                                
                                                <input type="hidden" id="description" name="description" class="form-control" value="{{$serviceInvoices->product_description}}" >
                                                <input type="hidden" id="vat_amount" name="vat_amount" class="form-control" value="{{ str_replace(',', '',number_format($serviceInvoices->vat_amount, 2))}}" >
                                                <input type="hidden" id="price" name="price" class="form-control" value="{{ str_replace(',', '',number_format($serviceInvoices->price,2))}}" >
                                                <input type="hidden" id="product_quantity" name="product_quantity" class="form-control" value="{{ $serviceInvoices->product_quantity}}" >
                                             


                                                @endforeach

          
                                        </div>

                                        
                                        <!-- customer no description Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="customer_no" name="customer_no" class="form-control" value="{{$serviceInvoice['customer_no']}}" >

                                        </div>

                                        
                                        <!-- Service Order  type Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="service_order_no" name="service_order_no" class="form-control" value="{{$serviceInvoice['service_order_no']}}" >

                                        </div>

                                        
                                        <!-- Service Order  id Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="serviceordertypes" name="serviceordertypes" class="form-control" value="{{$serviceInvoice['serviceordertypes']}}" >

                                        </div>

                                        
                                        <!--   id Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="id" name="id" class="form-control" value="{{$serviceInvoice['id']}}" >

                                        </div>

                                        
                                        <!-- customer name Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="cusromer_name" name="cusromer_name" class="form-control" value="{{$serviceInvoice['cusromer_name'] }}" >

                                        </div>

                                        
                                        <!-- customer t_i_n_number Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="t_i_n_number" name="t_i_n_number" class="form-control" value="{{$serviceInvoice['t_i_n_number'] }}" >

                                        </div>
                                        

                                        
                                        <!-- get signature by Field -->
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" id="get_signature_by" name="get_signature_by" class="form-control" value="{{ get_signature_by() }}" >

                                        </div>

                                        @if(empty($serviceInvoice['qrcode_path'])  or Sentinel::inRole('admin'))

                                        <button type="submit" class="btn btn_marTop button-alignment btn-secondary default_voice"
                                                data-toggle="button">
                                            <a style="color:#333;">
                                                <i class="livicon" data-name="check" data-size="16" data-loop="true"
                                                   data-c="#111" data-hc="#111" style="position:relative;top:3px;"></i>
                                                Get Signature
                                            </a>
                                        </button>
                                       @endif
                                        
                                        @if($serviceInvoice['payment_status'] === 'Fully')

                                            <h2 style="color:green; ">PAID</h2>
                                        

                                        @elseif($serviceInvoice['payment_status'] === 'Not Paid')

                                            <h2 style="color:red;  ">NOT PAID</h2>
                                        

                                        @endif

                                        </form><!-- form get signature add end -->
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



