<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $invoicwePayment->id !!}</p>
    <hr>
</div>

<!-- Invoice Number Field -->
<div class="form-group">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    <p>{!! $invoicwePayment->invoice_number !!}</p>
    <hr>
</div>

<!-- Payment Amount Field -->
<div class="form-group">
    {!! Form::label('payment_amount', 'Payment Amount:') !!}
    <p>{!! $invoicwePayment->payment_amount !!}</p>
    <hr>
</div>

<!-- Payment Type Field -->
<div class="form-group">
    {!! Form::label('payment_type', 'Payment Type:') !!}
    <p>{!! $invoicwePayment->payment_type !!}</p>
    <hr>
</div>

<!-- Payment Descriptions Field -->
<div class="form-group">
    {!! Form::label('payment_descriptions', 'Payment Descriptions:') !!}
    <p>{!! $invoicwePayment->payment_descriptions !!}</p>
    <hr>
</div>

<!-- Upload Supportingdocument Field -->
<div class="form-group">
    {!! Form::label('upload_supportingdocument', 'Upload Supportingdocument:') !!}
    <p>{!! $invoicwePayment->upload_supportingdocument !!}</p>
    <hr>
</div>

