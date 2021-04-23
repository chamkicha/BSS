<!-- Customer Type Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('customer_type', 'Customer Type:'); ?>

    <?php echo Form::text('customer_type', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.cusromerType.customertypes.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/cusromerType/customertypes/fields.blade.php ENDPATH**/ ?>