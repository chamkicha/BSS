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

<!-- Amount Due Field -->
<div class="form-group col-sm-12">
    {!! Form::label('amount_due', 'Amount Due:') !!}
    {!! Form::text('amount_due', null, ['class' => 'form-control']) !!}
</div>

<!-- Days Field -->
<div class="form-group col-sm-12">
    {!! Form::label('days', 'Days:') !!}
    {!! Form::text('days', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.agingAnalysisReport.aginganalysisreports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
