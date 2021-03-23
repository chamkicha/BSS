<!-- Id Field -->
<div class="form-group">
    <?php echo Form::label('id', 'Id:'); ?>

    <p><?php echo $serviceOrders->id; ?></p>
    <hr>
</div>

<!-- Order I D Field -->
<div class="form-group">
    <?php echo Form::label('order_i_d', 'Order I D:'); ?>

    <p><?php echo $serviceOrders->order_i_d; ?></p>
    <hr>
</div>

<!-- Customer Name Field -->
<div class="form-group">
    <?php echo Form::label('customer_name', 'Customer Name:'); ?>

    <p><?php echo $serviceOrders->customer_name; ?></p>
    <hr>
</div>

<!-- Payment Mode Field -->
<div class="form-group">
    <?php echo Form::label('payment_mode', 'Payment Mode:'); ?>

    <p><?php echo $serviceOrders->payment_mode; ?></p>
    <hr>
</div>

<!-- Service Status Field -->
<div class="form-group">
    <?php echo Form::label('service_status', 'Service Status:'); ?>

    <p><?php echo $serviceOrders->service_status; ?></p>
    <hr>
</div>

<!-- Price Field -->
<div class="form-group">
    <?php echo Form::label('price', 'Price:'); ?>

    <p><?php echo $serviceOrders->price; ?></p>
    <hr>
</div>

<!-- Service Starting Date Field -->
<div class="form-group">
    <?php echo Form::label('service_starting_date', 'Service Starting Date:'); ?>

    <p><?php echo $serviceOrders->service_starting_date; ?></p>
    <hr>
</div>

<!-- Service Ending Date Field -->
<div class="form-group">
    <?php echo Form::label('service_ending_date', 'Service Ending Date:'); ?>

    <p><?php echo $serviceOrders->service_ending_date; ?></p>
    <hr>
</div>

<!-- Service Descriptions Field -->
<div class="form-group">
    <?php echo Form::label('service_descriptions', 'Service Descriptions:'); ?>

    <p><?php echo $serviceOrders->service_descriptions; ?></p>
    <hr>
</div>

<!-- Service Lists Field -->
<div class="form-group">
    <?php echo Form::label('service_lists', 'Service Lists:'); ?>

    <p><?php $__currentLoopData = (array) $serviceOrders->service_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($value); ?>,
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>
    <hr>
</div>

<!-- Next Handler Field -->
<div class="form-group">
    <?php echo Form::label('next_handler', 'Next Handler:'); ?>

    <p><?php echo $serviceOrders->next_handler; ?></p>
    <hr>
</div>

<!-- Next Handler Field -->
<div class="form-group">
    <?php echo Form::label('created_by', 'Created By:'); ?>

    <p><?php echo $serviceOrders->created_by; ?></p>
    <hr>
</div>


<div class="form-group row">
    <div class="col-sm-12">
      <label for="status">Change Status:</label>
        <select id="req_status" name="req_status">
          <option disabled selected value> -- select status -- </option>
          
          <?php if(Sentinel::inRole('commercial-manager') && $serviceOrders->next_handler==='commercial manager'): ?>
               <option value="verified">Verify</option>
                <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='finance'): ?>
              <option value="approved">Approve</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='store'): ?>
              <option value="issued">Issue</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='sales'): ?>
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('admin')): ?>
              <option value="verified">Verify</option>
              <option value="approve">Approve</option>
              <option value="issued">Issue</option>
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          <?php endif; ?>
          </select>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/serviceOrders/serviceOrders/show_fields.blade.php ENDPATH**/ ?>