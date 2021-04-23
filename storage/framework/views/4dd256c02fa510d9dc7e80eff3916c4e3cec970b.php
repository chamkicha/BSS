<!-- Unitof Measure Name Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('unitof_measure_name', 'Unitof Measure Name:'); ?>

    <?php echo Form::text('unitof_measure_name', null, ['class' => 'form-control']); ?>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('description', 'Description:'); ?>

    <?php echo Form::text('description', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.unitofMeasure.unitofMeasures.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/unitofMeasure/unitofMeasures/fields.blade.php ENDPATH**/ ?>