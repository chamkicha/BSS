<!-- Payment Type Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_type_name', 'Payment Type Name:') !!}
    {!! Form::text('payment_type_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.paymentType.paymentTypes.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
