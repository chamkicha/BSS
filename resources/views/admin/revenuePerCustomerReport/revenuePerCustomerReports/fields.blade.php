<!-- Customer Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    {!! Form::text('customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_type', 'Customer Type:') !!}
    {!! Form::text('customer_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Excise Duty Field -->
<div class="form-group col-sm-12">
    {!! Form::label('excise_duty', 'Excise Duty:') !!}
    {!! Form::text('excise_duty', null, ['class' => 'form-control']) !!}
</div>

<!-- V A T Field -->
<div class="form-group col-sm-12">
    {!! Form::label('v_a_t', 'V A T:') !!}
    {!! Form::text('v_a_t', null, ['class' => 'form-control']) !!}
</div>

<!-- Total With Vat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total_with_vat', 'Total With Vat:') !!}
    {!! Form::text('total_with_vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.revenuePerCustomerReport.revenuePerCustomerReports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
