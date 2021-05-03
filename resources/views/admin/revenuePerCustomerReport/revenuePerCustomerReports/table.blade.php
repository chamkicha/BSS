<section class="content indexpage pr-3 pl-3">
    <div class="row">
        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg bg-primary text-white no-radius">
                <div class="card-body squarebox square_boxs cardpaddng">
                    <div class="row">
                        <div class="col-12 float-left nopadmar">
                            <div class="row">
                                <div class="square_box col-12 text-right">
                                    <span>Total Customer</span>

                                    <div class="number">{{ number_format(total_customer())}}</div>
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
                                <div class="square_box col-12 float-left">
                                    <span>Total Excise Duty</span>

                                    <div class="number">{{ number_format(total_exciseduty(),2)}}</div>
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
                                <div class="square_box col-12 float-left">
                                    <span>Total VAT</span>

                                    <div class="number" >{{ number_format(total_vat(),2)}}</div>
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
                                <div class="square_box col-12 float-left">
                                    <span>Grand Total</span>

                                    <div class="number" >{{ number_format(grand_total(),2)}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
</section>

<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
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
     </tr>
    </thead>
    <tbody>
    @foreach($revenuePerCustomerReports as $revenuePerCustomerReport)
        <tr>
            <td>{!! $revenuePerCustomerReport->customer_name !!}</td>
            <td>{!! $revenuePerCustomerReport->customer_no !!}</td>
            <td>{!! $revenuePerCustomerReport->customer_type !!}</td>
            <td>
            
                
            
            </td>
            <td>{!! $revenuePerCustomerReport->excise_dutty !!}</td>
            <td>{!! $revenuePerCustomerReport->v_a_t !!}</td>
            <td>{!! $revenuePerCustomerReport->total_wit_vat !!}</td>
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
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>


 <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css') }}">

 <script type="text/javascript" src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js') }}" ></script>

    <script>
                  $('#revenuePerCustomerReports-table').DataTable({
                      responsive: true,
                      pageLength: 10,
                      dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
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
                  });

                  

       </script>

@stop



<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

    function total_customer()
    {      
        $customers = DB::table('revenuepercustomerreports')->count();
        return $customers;
    } 

    function total_exciseduty()
    {      
        $total_exciseduty = DB::table('revenuepercustomerreports')->sum('excise_dutty');
        return $total_exciseduty;
    } 

    function total_vat()
    {      
        $total_vat = DB::table('revenuepercustomerreports')->sum('v_a_t');
        return $total_vat;
    } 

    function grand_total()
    {      
        $customers = DB::table('revenuepercustomerreports')->sum('total_wit_vat');
        return $customers;
    } 

?>