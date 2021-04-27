<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $servicestatus->id !!}</p>
    <hr>
</div>

<!-- Service Status Name Field -->
<div class="form-group">
    {!! Form::label('service_status_name', 'Service Status Name:') !!}
    <p>{!! $servicestatus->service_status_name !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $servicestatus->description !!}</p>
    <hr>
</div>

