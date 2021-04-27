<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $paymentMode->id !!}</p>
    <hr>
</div>

<!-- Payment Mode Name Field -->
<div class="form-group">
    {!! Form::label('payment_mode_name', 'Payment Mode Name:') !!}
    <p>{!! $paymentMode->payment_mode_name !!}</p>
    <hr>
</div>

<!-- Payment Interval Field -->
<div class="form-group">
    {!! Form::label('payment_interval', 'Payment Interval:') !!}
    <p>{!! $paymentMode->payment_interval !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $paymentMode->description !!}</p>
    <hr>
</div>

