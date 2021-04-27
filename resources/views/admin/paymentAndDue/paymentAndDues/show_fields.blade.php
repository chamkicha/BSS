<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $paymentAndDue->id !!}</p>
    <hr>
</div>

<!-- Customer Name Field -->
<div class="form-group">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    <p>{!! $paymentAndDue->customer_name !!}</p>
    <hr>
</div>

<!-- Total Amount Field -->
<div class="form-group">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>{!! $paymentAndDue->total_amount !!}</p>
    <hr>
</div>

<!-- Paid Amount Field -->
<div class="form-group">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    <p>{!! $paymentAndDue->paid_amount !!}</p>
    <hr>
</div>

<!-- Balance Field -->
<div class="form-group">
    {!! Form::label('balance', 'Balance:') !!}
    <p>{!! $paymentAndDue->balance !!}</p>
    <hr>
</div>

<!-- Customer No Field -->
<div class="form-group">
    {!! Form::label('customer_no', 'Customer No:') !!}
    <p>{!! $paymentAndDue->customer_no !!}</p>
    <hr>
</div>

