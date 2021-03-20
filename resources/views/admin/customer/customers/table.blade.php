<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="customers-table" width="100%">
    <thead>
     <tr>
        <th>Customername</th>
        <th>T I N Number</th>
        <th>V A T Registration Number</th>
        <th>Business License Number</th>
        <th>Contact Person</th>
        <th>Position Held</th>
        <th>Contact Telephone</th>
        <th>Office Telephone</th>
        <th>Email</th>
        <th>Postal Address</th>
        <th>Region</th>
        <th>District</th>
        <th>Fax</th>
        <th>Customer Type</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{!! $customer->customername !!}</td>
            <td>{!! $customer->t_i_n_number !!}</td>
            <td>{!! $customer->v_a_t_registration_number !!}</td>
            <td>{!! $customer->business_license_number !!}</td>
            <td>{!! $customer->contact_person !!}</td>
            <td>{!! $customer->position_held !!}</td>
            <td>{!! $customer->contact_telephone !!}</td>
            <td>{!! $customer->office_telephone !!}</td>
            <td>{!! $customer->email !!}</td>
            <td>{!! $customer->postal_address !!}</td>
            <td>{!! $customer->region !!}</td>
            <td>{!! $customer->district !!}</td>
            <td>{!! $customer->fax !!}</td>
            <td>{!! $customer->customer_type !!}</td>
            <td>
                 <a href="{{ route('admin.customer.customers.show', collect($customer)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view customer"></i>
                 </a>
                 <a href="{{ route('admin.customer.customers.edit', collect($customer)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit customer"></i>
                 </a>
                 <a href="{{ route('admin.customer.customers.confirm-delete', collect($customer)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.customer.customers.delete', collect($customer)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete customer"></i>

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
        $('#customers-table').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#customers-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#customers-table').on( 'length.dt', function ( e, settings, len ) {
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
