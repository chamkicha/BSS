<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Vat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vat', 'Vat:') !!}
    {!! Form::text('vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Excise Dutty Field -->
<div class="form-group col-sm-12">
    {!! Form::label('excise_dutty', 'Excise Dutty:') !!}
    {!! Form::text('excise_dutty', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-12">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    {!! Form::text('grand_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Revenue Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_revenue', 'Product Revenue:') !!}
    {!! Form::text('product_revenue', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.productrevenue.productRevenues.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
