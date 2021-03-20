<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="serviceOrders-table" width="100%">
    <thead>
     <tr>
        <th>Order I D</th>
        <th>Customer Name</th>
        <th>Payment Mode</th>
        <th>Service Status</th>
        <th>Price</th>
        <th>Service Starting Date</th>
        <th>Service Ending Date</th>
        <th>Service Descriptions</th>
        <th>Service Lists</th>
        <th>Next Handler</th>
        <th>Created By</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $serviceOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceOrders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $serviceOrders->order_i_d; ?></td>
            <td><?php echo $serviceOrders->customer_name; ?></td>
            <td><?php echo $serviceOrders->payment_mode; ?></td>
            <td><?php echo $serviceOrders->service_status; ?></td>
            <td><?php echo $serviceOrders->price; ?></td>
            <td><?php echo $serviceOrders->service_starting_date; ?></td>
            <td><?php echo $serviceOrders->service_ending_date; ?></td>
            <td><?php echo $serviceOrders->service_descriptions; ?></td>
            <td>

                <?php $__currentLoopData = (array) $serviceOrders->service_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($value); ?>,
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo $serviceOrders->next_handler; ?></td>
            <td><?php echo $serviceOrders->created_by; ?></td>
            <td>
                 <a href="<?php echo e(route('admin.serviceOrders.serviceOrders.show', collect($serviceOrders)->first() )); ?>">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view serviceOrders"></i>
                 </a>
                 <a href="<?php echo e(route('admin.serviceOrders.serviceOrders.edit', collect($serviceOrders)->first() )); ?>">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit serviceOrders"></i>
                 </a>
                 <a href="<?php echo e(route('admin.serviceOrders.serviceOrders.confirm-delete', collect($serviceOrders)->first() )); ?>" data-toggle="modal" data-target="#delete_confirm" data-id="<?php echo e(route('admin.serviceOrders.serviceOrders.delete', collect($serviceOrders)->first() )); ?>">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete serviceOrders"></i>

                 </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
<?php $__env->startSection('footer_scripts'); ?>

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
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/datatables/css/buttons.bootstrap4.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/datatables/css/dataTables.bootstrap4.css')); ?>"/>
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/datatables/css/buttons.bootstrap4.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/jquery.dataTables.js')); ?>" ></script>
 <script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/dataTables.bootstrap4.js')); ?>" ></script>

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

<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/serviceOrders/serviceOrders/table.blade.php ENDPATH**/ ?>