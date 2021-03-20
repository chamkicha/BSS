<!-- Service Status Name Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('service_status_name', 'Service Status Name:'); ?>

    <?php echo Form::text('service_status_name', null, ['class' => 'form-control']); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::text('description', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.servicestatus.servicestatuses.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/servicestatus/servicestatuses/fields.blade.php ENDPATH**/ ?>