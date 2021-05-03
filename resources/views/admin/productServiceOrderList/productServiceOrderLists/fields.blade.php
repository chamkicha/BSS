<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_no', 'Product No:') !!}
    {!! Form::text('product_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Total Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sub_total', 'Sub Total:') !!}
    {!! Form::text('sub_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tax_amount', 'Tax Amount:') !!}
    {!! Form::text('tax_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-12">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    {!! Form::text('grand_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Order I D Field -->
<div class="form-group col-sm-12">
    {!! Form::label('order_i_d', 'Order I D:') !!}
    {!! Form::text('order_i_d', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.productServiceOrderList.productServiceOrderLists.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
