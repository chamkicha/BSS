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
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-8 col-12 my-3">
            <div class="card card-border">
                <div class="card-header">
                    <span>
                        <i class="livicon" data-name="dashboard" data-size="20" data-loop="true" data-c="#F89A14"
                            data-hc="#F89A14"></i>
                        Realtime Server Load
                        <small>- Load on the Server</small>
                    </span>
                </div>
                <div class="card-body">
                    <div id="realtimechart" style="height:350px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4 col-12 my-3">
            <div class="card blue_gradiant_bg">
                <div class="card-header">
                    <span class=" card_font">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="white"></i>
                        Server Stats
                        <small>- Monthly Report</small>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar"></div>
                                <h3 class="title">Network</h3>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"></div>
                        <div class="margin-bottom-10 visible-sm"></div>
                        <div class="col-sm-6">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_line"></div>
                                <h3 class="title">Load Rate</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN Percentage monitor -->
            <div class="card green_gradiante_bg">
                <div class="card-header">
                    <span class=" card_font">
                        <i class="livicon" data-name="spinner-six" data-size="16" data-loop="false" data-c="#fff"
                            data-hc="white"></i>
                        Result vs Target
                    </span>
                </div>
                <div class="card-body nopadmar">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <h4 class="small-heading">Sales</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-1" data-percent="45"><span
                                    class="percent">45</span>
                            </span>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-sm-6 text-center">
                            <h4 class="small-heading">Reach</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-3" data-percent="25">
                                <span class="percent">25</span>
                            </span>
                        </div>
                        <!-- /.col-sm-4 -->
                    </div>

                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- END BEGIN Percentage monitor-->
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
        $serviceorder = DB::table('serviceinvoices')->where('deleted_at',NULL)->sum('grand_total');
        return $serviceorder;
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