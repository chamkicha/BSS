<table class="table table-bordered table-hover" id="revenuePerCustomerReports-table">
    <thead class="thead-light">
     <tr>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>Customer Type</th>
        <th>Dept (TZS)</th>
        <th>Total Amount (TZS)</th>
     </tr>
    </thead>
    <tbody>
    @foreach($revenuePerCustomerReports as $revenuePerCustomerReport)
        <tr>
            <td>{!! $revenuePerCustomerReport->customer_no !!}</td>
            <td>{!! $revenuePerCustomerReport->customername !!}</td>
            <td>{!! $revenuePerCustomerReport->customer_type !!}</td>
            <td>
                <?php
                $total_dept_maount = DB::table('paymentanddues')->where('customer_no', $revenuePerCustomerReport->id)->where('deleted_at',null)->sum('balance');
                print_r(number_format($total_dept_maount,2));
                ?></td>
            <td>
                <?php
                $total_maount = DB::table('serviceinvoices')->where('customer_no', $revenuePerCustomerReport->id)->where('deleted_at',null)->sum('grand_total');
                print_r(number_format($total_maount,2));
                ?></td>
            
        </tr>
    @endforeach
    </tbody>
</table>
@section('footer_scripts')
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>

    
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css') }}">

    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js') }}" ></script>

    <script>
                  $('#revenuePerCustomerReports-table').DataTable({
                      "order": [[4, "desc"]],
                      responsive: true,
                      pageLength: 30,
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
