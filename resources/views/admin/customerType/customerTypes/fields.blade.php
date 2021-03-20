<!-- Customer Type Name Default Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_type_name_default', 'Customer Type Name Default:') !!}
    {!! Form::text('customer_type_name_default', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.customerType.customerTypes.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
