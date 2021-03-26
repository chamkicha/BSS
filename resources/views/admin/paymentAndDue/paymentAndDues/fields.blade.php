<!-- Customer Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::text('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Paid Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    {!! Form::text('paid_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Balance Field -->
<div class="form-group col-sm-12">
    {!! Form::label('balance', 'Balance:') !!}
    {!! Form::text('balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_no', 'Customer No:') !!}
    {!! Form::text('customer_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.paymentAndDue.paymentAndDues.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
