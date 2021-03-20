<!-- Product Type Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_type_name', 'Product Type Name:') !!}
    {!! Form::text('product_type_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.productType.productTypes.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
