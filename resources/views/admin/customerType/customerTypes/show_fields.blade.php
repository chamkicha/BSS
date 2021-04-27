<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $customerType->id !!}</p>
    <hr>
</div>

<!-- Customer Type Name Default Field -->
<div class="form-group">
    {!! Form::label('customer_type_name_default', 'Customer Type Name Default:') !!}
    <p>{!! $customerType->customer_type_name_default !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $customerType->description !!}</p>
    <hr>
</div>

