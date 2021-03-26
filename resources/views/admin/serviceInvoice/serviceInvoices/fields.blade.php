<!-- Invoice Created Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('invoice_created_date', 'Invoice Created Date:') !!}
    {!! Form::date('invoice_created_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoice Due Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('invoice_due_date', 'Invoice Due Date:') !!}
    {!! Form::date('invoice_due_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Order No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_order_no', 'Service Order No:') !!}
    {!! Form::text('service_order_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Due Balance Field -->
<div class="form-group col-sm-12">
    {!! Form::label('due_balance', 'Due Balance:') !!}
    {!! Form::text('due_balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Charges Field -->
<div class="form-group col-sm-12">
    {!! Form::label('current_charges', 'Current Charges:') !!}
    {!! Form::text('current_charges', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_amount', 'Payment Amount:') !!}
    {!! Form::text('payment_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    {!! Form::select('payment_status', ['Paid' => 'Paid'], null, ['class' => 'form-control']) !!}
</div>

<!-- Invoice Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    {!! Form::text('invoice_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_name', 'Service Name:') !!}
    {!! Form::text('service_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cusromer Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cusromer_name', 'Cusromer Name:') !!}
    {!! Form::text('cusromer_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.serviceInvoice.serviceInvoices.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
