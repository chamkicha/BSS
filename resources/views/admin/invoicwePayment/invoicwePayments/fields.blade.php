@isset($invoicenumber)
    <!-- Invoice Number Field -->
<div class="form-group col-sm-12">
    <strong> Invoice Number:</strong> {!!$invoicenumber !!}
</div>


    <!-- payment amount Field -->
<div class="form-group col-sm-12">
    <strong> Payment Amount (TZS):</strong> {!!number_format($paymentamount , 2) !!}
</div>

<!-- invoice number Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="invoice_number" name="invoice_number" class="form-control" value="{{$invoicenumber}}" >

</div>


<!-- Grand total Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="grand_total" name="grand_total" class="form-control" value="{{$paymentamount}}" >

</div>

<!-- cusromer_name Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="cusromer_name" name="cusromer_name" class="form-control" value="{{$cusromer_name}}" >

</div>


@endisset

@empty($invoicenumber)
   
<!-- Invoice Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    {!! Form::text('invoice_number', null, ['class' => 'form-control']) !!}
</div>


@endempty





<!-- Paid Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_amount', 'Paid Amount:') !!}
    {!! Form::text('payment_amount', null, ['class' => 'form-control']) !!}
</div>



<!-- Payment Type Field  -->
<div class="form-group col-sm-12">
    <label for="select21" class="control-label">
        Payment Type:
    </label>
    <select name="payment_type" id="select21" class="form-control select2">
            
            <option value="">Select Payment Type</option>
            @foreach($paymentmode_list as $paymentmode)
            <option value="{{ $paymentmode->payment_type_name}}">{{ $paymentmode->payment_type_name }}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<!-- Payment Descriptions Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_descriptions', 'Payment Descriptions:') !!}
    {!! Form::text('payment_descriptions', null, ['class' => 'form-control']) !!}
</div>

<!-- Upload Supportingdocument Field -->
<div class="form-group col-sm-12">
    {!! Form::label('upload_supportingdocument', 'Upload Supportingdocument:') !!}
    {!! Form::text('upload_supportingdocument', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.invoicwePayment.invoicwePayments.index') !!}" class="btn btn-secondary">Cancel</a>
</div>



