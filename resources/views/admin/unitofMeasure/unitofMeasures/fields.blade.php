<!-- Unitof Measure Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('unitof_measure_name', 'Unitof Measure Name:') !!}
    {!! Form::text('unitof_measure_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.unitofMeasure.unitofMeasures.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
