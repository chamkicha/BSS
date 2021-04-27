<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $productType->id !!}</p>
    <hr>
</div>

<!-- Product Type Name Field -->
<div class="form-group">
    {!! Form::label('product_type_name', 'Product Type Name:') !!}
    <p>{!! $productType->product_type_name !!}</p>
    <hr>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $productType->description !!}</p>
    <hr>
</div>

