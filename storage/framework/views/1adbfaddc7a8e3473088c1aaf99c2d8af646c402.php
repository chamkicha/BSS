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
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/serviceOrders/serviceOrders/show_fields.blade.php ENDPATH**/ ?>