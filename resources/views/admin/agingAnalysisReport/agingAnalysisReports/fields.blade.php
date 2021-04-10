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

<!-- 30 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('30_days', '30 Days:') !!}
    {!! Form::text('30_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 60 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('60_days', '60 Days:') !!}
    {!! Form::text('60_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 90 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('90_days', '90 Days:') !!}
    {!! Form::text('90_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 120 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('120_days', '120 Days:') !!}
    {!! Form::text('120_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 150 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('150_days', '150 Days:') !!}
    {!! Form::text('150_days', null, ['class' => 'form-control']) !!}
</div>

<!-- 180 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('180_days', '180 Days:') !!}
    {!! Form::text('180_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Morethan180 Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('morethan180_days', 'Morethan180 Days:') !!}
    {!! Form::text('morethan180_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.agingAnalysisReport.agingAnalysisReports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
