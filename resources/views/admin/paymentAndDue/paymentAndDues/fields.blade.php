<!-- Customer Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>


    <!-- Customer Name Field -->
<div class="form-group has-success">
    <div class="row">
        <label class="col-md-3 control-label"
                for="form2inputSuccess">Customer Name</label>
        <div class="col-md-9">    
        
            <select name="customer_name" id="select21" class="form-control select2">
                    
                    <option value="">Select Customer Name</option>
                    @foreach($customer_list as $customer)
                    <option value="{{ $customer->customername}}">{{ $customer->customername }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
</div>


<!-- Total Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::text('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Paid Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    {!! Form::text('paid_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Balance Field -->
<div class="form-group col-sm-12">
    {!! Form::label('balance', 'Balance:') !!}
    {!! Form::text('balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_no', 'Customer No:') !!}
    {!! Form::text('customer_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.paymentAndDue.paymentAndDues.index') !!}" class="btn btn-secondary">Cancel</a>
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
