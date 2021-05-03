<!-- Client No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_no', 'Client No:') !!}
    {!! Form::text('client_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Order No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_order_no', 'Service Order No:') !!}
    {!! Form::text('service_order_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.clientProduct.clientproductreports.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
