<!-- Payment Mode Name Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('payment_mode_name', 'Payment Mode Name:'); ?>

    <?php echo Form::text('payment_mode_name', null, ['class' => 'form-control']); ?>

</div>

<!-- Payment Interval Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('payment_interval', 'Payment Interval:'); ?>

    <?php echo Form::text('payment_interval', null, ['class' => 'form-control']); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::text('description', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.paymentMode.paymentModes.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/paymentMode/paymentModes/fields.blade.php ENDPATH**/ ?>