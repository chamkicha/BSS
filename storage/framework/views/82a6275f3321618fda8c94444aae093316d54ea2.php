<!-- Customername Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('customername', 'Customername:'); ?>

    <?php echo Form::text('customername', null, ['class' => 'form-control']); ?>

</div>

<!-- T I N Number Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('t_i_n_number', 'T I N Number:'); ?>

    <?php echo Form::text('t_i_n_number', null, ['class' => 'form-control']); ?>

</div>

<!-- V A T Registration Number Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('v_a_t_registration_number', 'V A T Registration Number:'); ?>

    <?php echo Form::text('v_a_t_registration_number', null, ['class' => 'form-control']); ?>

</div>

<!-- Business License Number Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('business_license_number', 'Business License Number:'); ?>

    <?php echo Form::text('business_license_number', null, ['class' => 'form-control']); ?>

</div>

<!-- Contact Person Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('contact_person', 'Contact Person:'); ?>

    <?php echo Form::text('contact_person', null, ['class' => 'form-control']); ?>

</div>

<!-- Position Held Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('position_held', 'Position Held:'); ?>

    <?php echo Form::text('position_held', null, ['class' => 'form-control']); ?>

</div>

<!-- Contact Telephone Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('contact_telephone', 'Contact Telephone:'); ?>

    <?php echo Form::text('contact_telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- Office Telephone Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('office_telephone', 'Office Telephone:'); ?>

    <?php echo Form::text('office_telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

</div>

<!-- Postal Address Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('postal_address', 'Postal Address:'); ?>

    <?php echo Form::text('postal_address', null, ['class' => 'form-control']); ?>

</div>

<!-- Region Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('region', 'Region:'); ?>

    <?php echo Form::text('region', null, ['class' => 'form-control']); ?>

</div>

<!-- District Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('district', 'District:'); ?>

    <?php echo Form::text('district', null, ['class' => 'form-control']); ?>

</div>

<!-- Fax Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('fax', 'Fax:'); ?>

    <?php echo Form::text('fax', null, ['class' => 'form-control']); ?>

</div>

<!-- Customer Type Field -->

<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Customer:
    </label>
    <select name="customer_type" id="select21" class="form-control select2">
            
            <option value="">Select Customer Type</option>
            <?php $__currentLoopData = $customer_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($customer->customer_type_name_default); ?>"><?php echo e($customer->customer_type_name_default); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.customer.customers.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/customer/customers/fields.blade.php ENDPATH**/ ?>