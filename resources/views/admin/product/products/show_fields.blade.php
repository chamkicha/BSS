<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $product->id !!}</p>
    <hr>
</div>

<!-- Product Name Field -->
<div class="form-group">
    {!! Form::label('product_name', 'Product Name:') !!}
    <p>{!! $product->product_name !!}</p>
    <hr>
</div>

<!-- Product Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $product->description !!}</p>
    <hr>
</div>

<!-- Product Unit Field -->
<div class="form-group">
    {!! Form::label('product_unit', 'Product Unit:') !!}
    <p>{!! $product->product_unit !!}</p>
    <hr>
</div>

<!-- Product Type Field -->
<div class="form-group">
    {!! Form::label('product_type', 'Product Type:') !!}
    <p>{!! $product->product_type !!}</p>
    <hr>
</div>

<!-- V A T(%) Field -->
<div class="form-group">
    {!! Form::label('v_a_t(%)', 'V A T(%):') !!}
    <p>{!! $product->v_a_t(%) !!}</p>
    <hr>
</div>

<!-- E D(%) Field -->
<div class="form-group">
    {!! Form::label('e_d(%)', 'E D(%):') !!}
    <p>{!! $product->e_d(%) !!}</p>
    <hr>
</div>

<!-- Price( T Z S) Field -->
<div class="form-group">
    {!! Form::label('price(_t_z_s)', 'Price( T Z S):') !!}
    <p>{!! $product->price(_t_z_s) !!}</p>
    <hr>
</div>

<!-- Discount(%) Field -->
<div class="form-group">
    {!! Form::label('discount(%)', 'Discount(%):') !!}
    <p>{!! $product->discount(%) !!}</p>
    <hr>
</div>

