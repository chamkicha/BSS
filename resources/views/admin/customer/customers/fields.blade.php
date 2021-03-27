<!-- Customername Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customername', 'Customername:') !!}
    {!! Form::text('customername', null, ['class' => 'form-control']) !!}
</div>

<!-- T I N Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('t_i_n_number', 'T I N Number:') !!}
    {!! Form::text('t_i_n_number', null, ['class' => 'form-control']) !!}
</div>

<!-- V A T Registration Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('v_a_t_registration_number', 'V A T Registration Number:') !!}
    {!! Form::text('v_a_t_registration_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Business License Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('business_license_number', 'Business License Number:') !!}
    {!! Form::text('business_license_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Field -->
<div class="form-group col-sm-12">
    {!! Form::label('contact_person', 'Contact Person:') !!}
    {!! Form::text('contact_person', null, ['class' => 'form-control']) !!}
</div>

<!-- Position Held Field -->
<div class="form-group col-sm-12">
    {!! Form::label('position_held', 'Position Held:') !!}
    {!! Form::text('position_held', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Telephone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('contact_telephone', 'Contact Telephone:') !!}
    {!! Form::text('contact_telephone', null, ['class' => 'form-control']) !!}
</div>

<!-- Office Telephone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('office_telephone', 'Office Telephone:') !!}
    {!! Form::text('office_telephone', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Postal Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('postal_address', 'Postal Address:') !!}
    {!! Form::text('postal_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Region Field -->
<div class="form-group col-sm-12">
    {!! Form::label('region', 'Region:') !!}
    {!! Form::text('region', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>


<!-- District Field -->
<div class="form-group col-sm-12">
    {!! Form::label('district', 'District:') !!}
    {!! Form::text('district', null, ['class' => 'form-control']) !!}
</div>

<!-- Fax Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fax', 'Fax:') !!}
    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Type Field -->

<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Customer:
    </label>
    <select name="customer_type" id="select21" class="form-control select2">
            
            <option value="">Select Customer Type</option>
            @foreach($customer_type as $customer)
            <option value="{{ $customer->customer_type_name_default}}">{{ $customer->customer_type_name_default }}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.customer.customers.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
