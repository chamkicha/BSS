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

<!-- Total Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
</div>

<!-- 0-30 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('0-30_days', '0-30 Days:') !!}
    {!! Form::text('0-30_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 31-60 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('31-60_days', '31-60 Days:') !!}
    {!! Form::text('31-60_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 61-90 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('61-90_days', '61-90 Days:') !!}
    {!! Form::text('61-90_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 91-120 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('91-120_days', '91-120 Days:') !!}
    {!! Form::text('91-120_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 121-180 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('121-180_days', '121-180 Days:') !!}
    {!! Form::text('121-180_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 181+ Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('181+_days', '181+ Days:') !!}
    {!! Form::text('181+_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.agingAnalysisReport.aginganalysisreports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
