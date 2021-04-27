<!-- Customer Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_type', 'Customer Type:') !!}
    {!! Form::text('customer_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.cusromerType.customertypes.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
