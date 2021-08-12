@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
NIDC
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

<link href="{{ asset('vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" href="{{ asset('vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" />
<link rel="stylesheet" href="{{ asset('vendors/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/only_dashboard.css') }}" />
<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
    

<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/buttons.css') }}" />

@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <h1>Welcome to NIDC-BSS</h1>
    <ol class="breadcrumb">
        <li class=" breadcrumb-item active">
            <a href="#">
                <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                Dashboard
            </a>
        </li>
    </ol>
</section>
<section class="content indexpage pr-3 pl-3">
    <div class="row">
        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg bg-primary text-white no-radius">
                <div class="card-body squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-6 text-right">
                                    <span>Total Client</span>

                                    <div class="number">{{servicestatus()}}</div>
                                </div>
                                <div class="col-6">
                                    <i class="livicon  float-right" data-name="users" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="stat-label">Active</small>
                                    <h4 >{{activeclient()}}</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <small class="stat-label">Inactive</small>
                                    <h4 >{{inactiveclient()}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="card-body bg-danger text-white squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-6 float-left">
                                    <span>Service Orders</span>

                                    <div class="number">{{serviceorder()}}</div>
                                </div>
                                <div class="col-6">
                                    <i class="livicon float-right" data-name="archive-add" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="stat-label">Active</small>
                                    <h4 >{{serviceorderactive()}}</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <small class="stat-label">Inactive</small>
                                    <h4 >{{serviceorderinactive()}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
            <!-- Trans label pie charts strats here-->
            <div class="goldbg bg-warning text-white no-radius">
                <div class="card-body squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-6 float-left">
                                    <span>Total Income</span>

                                    <div class="number" >{{ number_format(totalincome(),2)}}</div>
                                </div>
                                {{--  <div class="col-6">
                                    <i class="livicon float-right" data-name="archive-add" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
                                </div>  --}}
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="stat-label">Paid</small>
                                    <h4 >{{ number_format(paid(),2)}}</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <small class="stat-label">Dept</small>
                                    <h4 >{{ number_format(dept(),2)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
            <!-- Trans label pie charts strats here-->
            <div class="palebluecolorbg bg-success text-white no-radius">
                <div class="card-body squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-6 float-left">
                                    <span>Service Invoice</span>

                                    <div class="number" >{{invoices()}}</div>
                                </div>
                                <div class="col-6">
                                    <i class="livicon float-right" data-name="doc-portrait" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="stat-label">Paid</small>
                                    <h4 >{{paidinvoices()}}</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <small class="stat-label">Unpaid</small>
                                    <h4 >{{unpaidinvoices()}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    </br>
    </br>
            <div class="card card-border">
                <div class="card-header">
                    <span>
                        <i class="livicon" data-name="dashboard" data-size="20" data-loop="true" data-c="#F89A14"
                            data-hc="#F89A14"></i>
                        QUICK LINKS
                    </span>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="list-group">
                                <a href="{!! route('admin.serviceOrders.serviceOrders.create') !!}" class="list-group-item facebook-like">
                                    <p class="float-right">
                                        <i class="fab fa fa-tasks f"></i>
                                    </p>
                                    <h4 class="list-group-item-heading "><b> 
                                    <?php 
                                    $serviceorder = DB::table('serviceorderss')->where('deleted_at',null)->count(); 
                                    print_r($serviceorder);?>
                                    </b></h4>
                                    <p class="list-group-item-text">CREATE SERVICE ORDER</p>
                                </a>
                                <a href="{!! route('admin.customer.customers.create') !!}" class="list-group-item twitter">
                                    <p class="float-right">
                                        <i class="fab fa fa-user-plus f"></i>
                                    </p>
                                    <h4 class="list-group-item-heading " ><b>
                                                                <?php
                                                                $customers = DB::table('customers')->where('deleted_at',null)->count();
                                                                print_r($customers);
                                                                ?></b></h4>
                                    <p class="list-group-item-text ">CREATE CUSTOMER</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="list-group">
                                <a href="{!! route('admin.product.products.create') !!}" class="list-group-item tumblr">
                                    <p class="float-right">
                                        <i class="fab fa fa-server f"></i>
                                    </p>
                                    <h4 class="list-group-item-heading "><b><?php
                                                        $products = DB::table('products')->count();
                                                        print_r($products);
                                                        ?></b></h4>
                                    <p class="list-group-item-text">CREATE PRODUCT</p>
                                </a>
                                <a href="{!! route('admin.invoicwePayment.invoicwePayments.create') !!}" class="list-group-item linkedin">
                                    <p class="float-right">
                                        <i class="fab fa fa-university f"></i>
                                    </p>
                                    <h4 class="list-group-item-heading" ><b>
                                    <?php
                                    $invoicwepayments = DB::table('invoicwepayments')->where('deleted_at',null)->sum('payment_amount');
                                    print_r(number_format($invoicwepayments,2));
                                    ?></b></h4>
                                    <p class="list-group-item-text ">CREATE PAYMENT</p>
                                </a>

                            </div>
                        </div>
                    </div>
                    </div>
</section>
<div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <p>You are already editing a row, you must save or cancel that row before edit/delete a new row</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('vendors/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    
<script src="{{ asset('js/pages/custom_buttons.js') }}"></script>

<!-- EASY PIE CHART JS -->
<script src="{{ asset('vendors/bower-jquery-easyPieChart/js/easypiechart.min.js') }}"></script>
<script src="{{ asset('vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js') }}"></script>
<!--for calendar-->
<script src="{{ asset('vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
<!--   Realtime Server Load  -->
<script src="{{ asset('vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
<!--Sparkline Chart-->
<script src="{{ asset('vendors/sparklinecharts/jquery.sparkline.js') }}"></script>
<!-- Back to Top-->
<script type="text/javascript" src="{{ asset('vendors/countUp.js/js/countUp.js') }}"></script>
<!--   maps -->
<script src="{{ asset('vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!--  todolist-->
<script src="{{ asset('js/pages/todolist.js') }}"></script>
<script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>


<!--//jquery-ui-->

{{--<script src="{{ asset('js/pages/jquery-ui.min.js') }}" type="text/javascript"></script>--}}

@stop


<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

    function servicestatus()
    {      
        $customers = DB::table('customers')->count();
        return $customers;
    } 

    function activeclient()
    {      
        $customers = DB::table('customers')->where('customer_status', 'active')->count();
        return $customers;
    } 

    function inactiveclient()
    {      
        $customers = DB::table('customers')->where('customer_status', 'inactive')->count();
        return $customers;
    } 

    function serviceorder()
    {      
        $serviceorder = DB::table('serviceorderss')->where('deleted_at',NULL)->count();
        return $serviceorder;
    } 

    function serviceorderactive()
    {      
        $serviceorder = DB::table('serviceorderss')->where('service_status', 'active')->where('deleted_at',NULL)->count();
        return $serviceorder;
    } 

    function serviceorderinactive()
    {      
        $serviceorder = DB::table('serviceorderss')->where('service_status', 'inactive')->where('deleted_at',NULL)->count();
        return $serviceorder;
    } 

    function totalincome()
    {      
       // $serviceorder = DB::table('serviceinvoices')->where('deleted_at',NULL)->sum('grand_total');
        $totalincome_paid_amount = DB::table('paymentanddues')->where('deleted_at',NULL)->sum('paid_amount');
        $totalincome_balance = DB::table('paymentanddues')->where('deleted_at',NULL)->sum('balance');
        $totalincome =  $totalincome_paid_amount + $totalincome_balance;

        return $totalincome;
    } 

    function paid()
    {      
        $serviceorder = DB::table('paymentanddues')->where('deleted_at',NULL)->sum('paid_amount');
        return $serviceorder;
    } 

    function dept()
    {      
        $serviceorder = DB::table('paymentanddues')->where('deleted_at',NULL)->sum('balance');
        return $serviceorder;
    } 

    function invoices()
    {      
        $invoices = DB::table('serviceinvoices')->where('deleted_at',NULL)->count();
        return $invoices;
    } 

    function paidinvoices()
    {      
        $paidinvoices = DB::table('serviceinvoices')->where(['payment_status'=>'Fully','deleted_at'=>NULL])->count();
        return $paidinvoices;
    } 

    function unpaidinvoices()
    {      
        $unpaidinvoices = DB::table('serviceinvoices')->where('payment_status','!=','Fully')->where('deleted_at',NULL)->count();
        return $unpaidinvoices;
    } 


?>