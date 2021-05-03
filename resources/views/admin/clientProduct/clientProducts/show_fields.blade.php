<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $clientProduct->id !!}</p>
    <hr>
</div>

<!-- Client No Field -->
<div class="form-group">
    {!! Form::label('client_no', 'Client No:') !!}
    <p>{!! $clientProduct->client_no !!}</p>
    <hr>
</div>

<!-- Product Name Field -->
<div class="form-group">
    {!! Form::label('product_name', 'Product Name:') !!}
    <p>{!! $clientProduct->product_name !!}</p>
    <hr>
</div>

<!-- Service Order No Field -->
<div class="form-group">
    {!! Form::label('service_order_no', 'Service Order No:') !!}
    <p>{!! $clientProduct->service_order_no !!}</p>
    <hr>
</div>

