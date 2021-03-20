<!-- Customer Type Name Default Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('customer_type_name_default', 'Customer Type Name Default:'); ?>

    <?php echo Form::text('customer_type_name_default', null, ['class' => 'form-control']); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::text('description', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.customerType.customerTypes.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/customerType/customerTypes/fields.blade.php ENDPATH**/ ?>