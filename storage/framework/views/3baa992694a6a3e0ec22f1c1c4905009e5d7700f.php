<!-- Product Name Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('product_name', 'Product Name:'); ?>

    <?php echo Form::text('product_name', null, ['class' => 'form-control']); ?>

</div>

<!-- Product Unit Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Product Unit:
    </label>
    <select name="product_unit" id="select21" class="form-control select2">
            
            <option value="">Select Product Unit</option>
            <?php $__currentLoopData = $product_unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($unit->unitof_measure_name); ?>"><?php echo e($unit->unitof_measure_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    </select>
</div>

<!-- Product Type Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Product Type:
    </label>
    <select name="product_type" id="select21" class="form-control select2">
            
            <option value="">Select Product Type</option>
            <?php $__currentLoopData = $product_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($type->product_type_name); ?>"><?php echo e($type->product_type_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    </select>
</div>

<!-- V A T(%) Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('v_a_t', 'V A T(%):'); ?>

    <?php echo Form::text('v_a_t', null, ['class' => 'form-control']); ?>

</div>

<!-- E D(%) Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('e_d', 'E D(%):'); ?>

    <?php echo Form::text('e_d', null, ['class' => 'form-control']); ?>

</div>

<!-- Price( T Z S) Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('price', 'Price( T Z S):'); ?>

    <?php echo Form::text('price', null, ['class' => 'form-control']); ?>

</div>

<!-- Discount(%) Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('discount', 'Discount(%):'); ?>

    <?php echo Form::text('discount', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.product.products.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/product/products/fields.blade.php ENDPATH**/ ?>