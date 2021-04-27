<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $paymentType->id !!}</p>
    <hr>
</div>

<!-- Payment Type Name Field -->
<div class="form-group">
    {!! Form::label('payment_type_name', 'Payment Type Name:') !!}
    <p>{!! $paymentType->payment_type_name !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $paymentType->description !!}</p>
    <hr>
</div>

