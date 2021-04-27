<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $serviceBilling->id !!}</p>
    <hr>
</div>

<!-- Bill No Field -->
<div class="form-group">
    {!! Form::label('bill_no', 'Bill No:') !!}
    <p>{!! $serviceBilling->bill_no !!}</p>
    <hr>
</div>

<!-- customer name Field -->
<div class="form-group">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    <p>{!! $serviceBilling->customer_name !!}</p>
    <hr>
</div>

<!-- customer number Field -->
<div class="form-group">
    {!! Form::label('customer_no', 'Customer Number:') !!}
    <p>{!! $serviceBilling->customer_no !!}</p>
    <hr>
</div>

<!-- Service Order No Field -->
<div class="form-group">
    {!! Form::label('service_order_no', 'Service Order No:') !!}
    <p>{!! $serviceBilling->service_order_no !!}</p>
    <hr>
</div>

<!-- Billing Date Field -->
<div class="form-group">
    {!! Form::label('billing_date', 'Billing Date:') !!}
    <p>{!! $serviceBilling->billing_date !!}</p>
    <hr>
</div>

<!-- Sub Total Field -->
<div class="form-group">
    {!! Form::label('sub_total', 'Sub Total:') !!}
    <p>{!! $serviceBilling->sub_total !!}</p>
    <hr>
</div>

<!-- TAX Amount Field -->
<div class="form-group">
    {!! Form::label('tax_amount', 'TAX Amount:') !!}
    <p>{!! $serviceBilling->tax_amount !!}</p>
    <hr>
</div>

<!-- ED Amount Field -->
<div class="form-group">
    {!! Form::label('ed_amount', 'ED Amount:') !!}
    <p>{!! $serviceBilling->ed_amount !!}</p>
    <hr>
</div>

<!-- Discount Field -->
<div class="form-group">
    {!! Form::label('discount', 'Discount:') !!}
    <p>{!! $serviceBilling->discount !!}</p>
    <hr>
</div>


<!-- Grand Total Field -->
<div class="form-group">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    <p>{!! $serviceBilling->grand_total !!}</p>
    <hr>
</div>
