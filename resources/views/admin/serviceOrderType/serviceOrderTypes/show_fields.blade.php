<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $serviceOrderType->id !!}</p>
    <hr>
</div>

<!-- Service Order Type Name Field -->
<div class="form-group">
    {!! Form::label('service_order_type_name', 'Service Order Type Name:') !!}
    <p>{!! $serviceOrderType->service_order_type_name !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $serviceOrderType->description !!}</p>
    <hr>
</div>

