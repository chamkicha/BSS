@section('header_styles')

<link type="text/css" href="{{ asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}"
      rel="stylesheet"/>
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/selectize/css/selectize.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/iCheck/css/line/line.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/switchery/css/switchery.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/pages/formelements.css') }}" rel="stylesheet"/>
@stop



@isset($invoicenumber)
    <!-- Invoice Number Field -->
<div class="form-group col-sm-9">
    <strong> Invoice Number:</strong> {!!$invoicenumber !!}
</div>


    <!-- payment amount Field -->
<div class="form-group col-sm-9">
    <strong> Payment Amount (TZS):</strong> {!!number_format($paymentamount , 2) !!}
</div>

<!-- invoice number Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="invoice_number" name="invoice_number" class="form-control" value="{{$invoicenumber}}" >

</div>


<!-- Grand total Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="grand_total" name="grand_total" class="form-control" value="{{$paymentamount}}" >

</div>

<!-- cusromer_name Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="cusromer_name" name="cusromer_name" class="form-control" value="{{$cusromer_name}}" >

</div>

<!-- cusromer_name Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="customer_no" name="customer_no" class="form-control" value="{{$customer_no}}" >

</div>

<!-- Invoice payment method Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="serviceordertypes" name="serviceordertypes" class="form-control" value="{{$serviceordertypes}}" >

</div>

<!-- Servide Orde number Field -->
<div class="form-group col-sm-9">
    <input type="hidden" id="service_order_no" name="service_order_no" class="form-control" value="{{$service_order_no}}" >

</div>



@endisset

@empty($invoicenumber)
   
{{--  <!-- Invoice Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    {!! Form::text('invoice_number', null, ['class' => 'form-control']) !!}
</div>  --}}


    <!-- Customer Name Field -->
<div class="form-group has-success">
    <div >
        <label class="col-md-9 control-label"
                for="form2inputSuccess">Customer Name</label>
        <div class="col-md-9">    
        
            <select name="customer_no" id="select21" class="form-control select2">
                    
                    <option value="">Select Customer Name</option>
                    @foreach($customer_list as $customer)
                    <option value="{{ $customer->id}}">{{ $customer->customername }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
</div>


@endempty





<!-- Paid Amount Field -->
<div class="form-group col-sm-9">
    {!! Form::label('payment_amount', 'Paid Amount:') !!}
    {!! Form::number('payment_amount', null, ['class' => 'form-control','step'=>'any']) !!}
</div>



<!-- Payment Type Field  -->
<div class="form-group col-sm-9">
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

<!-- Payment Date Field -->
<div class="form-group col-sm-9">
    {!! Form::label('created_at', 'Payment Date:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Descriptions Field -->
<div class="form-group col-sm-9">
    {!! Form::label('payment_descriptions', 'Payment Descriptions:') !!}
    {!! Form::text('payment_descriptions', null, ['class' => 'form-control']) !!}
</div>


<!-- Upload Supportingdocument Field -->
<div class="form-group col-sm-9">
    <label class="c control-label" for="form-file-input">Upload Supportingdocument:</label>
    <div class=" pad-top20 ">
        <input type="file" id="upload_supportingdocument" name="upload_supportingdocument">
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-9 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.invoicwePayment.invoicwePayments.index') !!}" class="btn btn-secondary">Cancel</a>
</div>




@section('footer_scripts')
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>

<script language="javascript" type="text/javascript" src="{{ asset('vendors/sifter/sifter.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/microplugin/microplugin.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/selectize/js/selectize.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/card/js/jquery.card.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/pages/custom_elements.js') }}"></script>

@stop
