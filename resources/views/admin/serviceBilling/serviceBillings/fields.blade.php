<!-- Bill No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bill_no', 'Bill No:') !!}
    {!! Form::text('bill_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Order No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_order_no', 'Service Order No:') !!}
    {!! Form::text('service_order_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Billing Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('billing_date', 'Billing Date:') !!}
    {!! Form::text('billing_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.serviceBilling.serviceBillings.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
