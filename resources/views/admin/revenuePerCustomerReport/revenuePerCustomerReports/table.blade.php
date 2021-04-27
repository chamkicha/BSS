<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">

{{--  <section class="content indexpage pr-3 pl-3">
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
                                    <i class="livicon  float-right" data-name="eye-open" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
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
                                    <i class="livicon float-right" data-name="piggybank" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
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

                                    <div class="number" >{{totalincome()}}</div>
                                </div>
                                <div class="col-6">
                                    <i class="livicon float-right" data-name="archive-add" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
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
                                    <i class="livicon float-right" data-name="users" data-l="true" data-c="#fff"
                                        data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
</section>  --}}

<table class="table table-striped table-bordered" id="revenuePerCustomerReports-table" width="100%">
    <thead>
     <tr>
        <th>Customer Name</th>
        <th>Customer No</th>
        <th>Customer Type</th>
        <th>Services</th>
        <th>Excise Dutty</th>
        <th>V A T</th>
        <th>Total Wit Vat</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($revenuePerCustomerReports as $revenuePerCustomerReport)
        <tr>
            <td>{!! $revenuePerCustomerReport->customer_name !!}</td>
            <td>{!! $revenuePerCustomerReport->customer_no !!}</td>
            <td>{!! $revenuePerCustomerReport->customer_type !!}</td>
            <td>{!! $revenuePerCustomerReport->services !!}</td>
            <td>{!! $revenuePerCustomerReport->excise_dutty !!}</td>
            <td>{!! $revenuePerCustomerReport->v_a_t !!}</td>
            <td>{!! $revenuePerCustomerReport->total_wit_vat !!}</td>
            <td>
                 <a href="{{ route('admin.revenuePerCustomerReport.revenuePerCustomerReports.show', collect($revenuePerCustomerReport)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view revenuePerCustomerReport"></i>
                 </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this Item? This operation is irreversible.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                            </div>
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $('#revenuePerCustomerReports-table').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#revenuePerCustomerReports-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#revenuePerCustomerReports-table').on( 'length.dt', function ( e, settings, len ) {
                     setTimeout(function(){
                            $('.livicon').updateLivicon();
                     },500);
                  } );

                  $('#delete_confirm').on('show.bs.modal', function (event) {
                      var button = $(event.relatedTarget)
                       var $recipient = button.data('id');
                      var modal = $(this);
                      modal.find('.modal-footer a').prop("href",$recipient);
                  })

       </script>

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
        $serviceorder = DB::table('serviceorderss')->count();
        return $serviceorder;
    } 

    function serviceorderactive()
    {      
        $serviceorder = DB::table('serviceorderss')->where('service_status', 'active')->count();
        return $serviceorder;
    } 

    function serviceorderinactive()
    {      
        $serviceorder = DB::table('serviceorderss')->where('service_status', 'inactive')->count();
        return $serviceorder;
    } 

    function totalincome()
    {      
        $serviceorder = DB::table('serviceinvoices')->sum('grand_total');
        return $serviceorder;
    } 

    function paid()
    {      
        $serviceorder = DB::table('paymentanddues')->sum('paid_amount');
        return $serviceorder;
    } 

    function dept()
    {      
        $serviceorder = DB::table('paymentanddues')->sum('balance');
        return $serviceorder;
    } 

    function invoices()
    {      
        $invoices = DB::table('serviceinvoices')->count();
        return $invoices;
    } 

    function paidinvoices()
    {      
        $paidinvoices = DB::table('serviceinvoices')->where('payment_status','Fully')->count();
        return $paidinvoices;
    } 

    function unpaidinvoices()
    {      
        $unpaidinvoices = DB::table('serviceinvoices')->where('payment_status','!=','Fully')->count();
        return $unpaidinvoices;
    } 


?>