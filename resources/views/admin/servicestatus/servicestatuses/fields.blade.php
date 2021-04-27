<!-- Service Status Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_status_name', 'Service Status Name:') !!}
    {!! Form::text('service_status_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.servicestatus.servicestatuses.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
