<!-- Payment Mode Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_mode_name', 'Payment Mode Name:') !!}
    {!! Form::text('payment_mode_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Interval Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_interval', 'Payment Interval (Days):') !!}
    {!! Form::number('payment_interval', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.paymentMode.paymentModes.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
