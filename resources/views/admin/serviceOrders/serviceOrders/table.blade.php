<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="serviceOrders-table" width="100%">
    <thead>
     <tr>
        <th>Order I D</th>
        <th>Customer Name</th>
        <th>Service Status</th>
        <th>Service State</th>
        <th>Service Order Type</th>
        <th>Service Createion Date</th>
        <th>Service Lists</th>
        <th>Next Handler</th>
        <th>Created By</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($serviceOrders as $serviceOrders)
        <tr>
            <td>{!! $serviceOrders->order_i_d !!}</td>
            <td>{!! $serviceOrders->customer_name !!}</td>
            <td>
            @if ($serviceOrders->service_status === 'Active')
                <span class="label label-sm bg-success text-white">{!! $serviceOrders->service_status !!}</span>
            
            @elseif ($serviceOrders->service_status === 'Inactive')
                <span class="label label-sm bg-danger text-white   ">{!! $serviceOrders->service_status !!}</span>
            @endif
            
            </td>
            <td>
             @if ($serviceOrders->req_status === 'created')
            <strong>{!! $serviceOrders->req_status !!}</strong>
            @else
             <strong>{!! $serviceOrders->req_status !!}</strong>
             @endif
            </td>
            <td>{!! $serviceOrders->serviceordertypes !!}</td>
            <td>{!! \Carbon\Carbon::parse($serviceOrders->service_creation_date)->format('d/m/Y') !!}</td>
            <td>

                @foreach($client_product as $client_products)
                {{$client_products->product_name}},
                @endforeach
            </td>
            <td>{!! $serviceOrders->next_handler !!}</td>
            <td>{!! $serviceOrders->created_by !!}</td>
            <td>
                 <a href="{{ route('admin.serviceOrders.serviceOrders.show', collect($serviceOrders)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view serviceOrders"></i>
                 </a>
                 @if (Sentinel::inRole('admin') or Sentinel::inRole('commercial-manager'))
                 
                 <a href="{{ route('admin.serviceOrders.serviceOrders.edit', collect($serviceOrders)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit serviceOrders"></i>
                 </a>
                 <a href="{{ route('admin.serviceOrders.serviceOrders.confirm-delete', collect($serviceOrders)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.serviceOrders.serviceOrders.delete', collect($serviceOrders)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete serviceOrders"></i>

                 </a>
                 @endif
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
        $('#serviceOrders-table').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#serviceOrders-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#serviceOrders-table').on( 'length.dt', function ( e, settings, len ) {
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
