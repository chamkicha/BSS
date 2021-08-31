<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="serviceInvoices-table" width="100%">
    <thead>
     <tr>
        <th>Invoice Number</th>
        <th>Customer Name</th>
        <th>TRA Signature</th>
        <th>Invoice Created Date</th>
        <th>Next Invoice Date</th>
        <th>Current Charges</th>
        <th>Payment Status</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($serviceInvoices as $serviceInvoice)
        <tr>
            <td>{!! $serviceInvoice->invoice_number !!}</td>
            
            <td>
                <a href="{{ route('admin.serviceInvoice.serviceInvoices.show', collect($serviceInvoice)->first() ) }}">
                    {!! $serviceInvoice->cusromer_name !!}
                </a>
            </td>
            <td>
            
                @if($serviceInvoice->RCTVNUM === null)
                    <span class="label label-sm bg-danger text-white">No signature</span>
                @else
                    <span class="label label-sm bg-success text-white">{!! $serviceInvoice->RCTVNUM !!}</span>
                @endif
            </td>
            <td>{!! \Carbon\Carbon::parse($serviceInvoice->invoice_created_date)->format('d-M-y') !!}</td>
            <td>{!! \Carbon\Carbon::parse($serviceInvoice->next_invoice_date)->format('d-M-y') !!}</td>
            <td>{!! number_format($serviceInvoice->current_charges,2) !!}</td>
            <td>

                @if($serviceInvoice->payment_status === 'Fully')

                    <h5 style="color:green; ">PAID</h5>

                @elseif($serviceInvoice->payment_status === 'Not Paid')

                    <h5 style="color:red;  ">NOT PAID</h5>

                @endif
            
            </td>
            <td>
                 <a href="{{ route('admin.serviceInvoice.serviceInvoices.show', collect($serviceInvoice)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view serviceInvoice"></i>
                 </a>
                 @if (Sentinel::inRole('admin'))

                 <a href="{{ route('admin.serviceInvoice.serviceInvoices.edit', collect($serviceInvoice)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit serviceInvoice"></i>
                 </a>
                 <a href="{{ route('admin.serviceInvoice.serviceInvoices.confirm-delete', collect($serviceInvoice)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.serviceInvoice.serviceInvoices.delete', collect($serviceInvoice)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete serviceInvoice"></i>
                 @endif
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
        $('#serviceInvoices-table').DataTable({
                     "order": [[0, "desc"]],
                      responsive: true,
                      pageLength: 10
                  });
                  $('#serviceInvoices-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#serviceInvoices-table').on( 'length.dt', function ( e, settings, len ) {
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
