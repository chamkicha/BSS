<!-- Customer Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_no', 'Customer No:') !!}
    {!! Form::text('customer_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_type', 'Customer Type:') !!}
    {!! Form::text('customer_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Services Field -->
<div class="form-group col-sm-12">
    {!! Form::label('services', 'Services:') !!}
    {!! Form::text('services', null, ['class' => 'form-control']) !!}
</div>

<!-- Excise Dutty Field -->
<div class="form-group col-sm-12">
    {!! Form::label('excise_dutty', 'Excise Dutty:') !!}
    {!! Form::text('excise_dutty', null, ['class' => 'form-control']) !!}
</div>

<!-- V A T Field -->
<div class="form-group col-sm-12">
    {!! Form::label('v_a_t', 'V A T:') !!}
    {!! Form::text('v_a_t', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Wit Vat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total_wit_vat', 'Total Wit Vat:') !!}
    {!! Form::text('total_wit_vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
