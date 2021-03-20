<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Unit Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Product Unit:
    </label>
    <select name="product_unit" id="select21" class="form-control select2">
            
            <option value="">Select Product Unit</option>
            @foreach($product_unit as $unit)
            <option value="{{ $unit->unitof_measure_name }}">{{ $unit->unitof_measure_name }}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<!-- Product Type Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Product Type:
    </label>
    <select name="product_type" id="select21" class="form-control select2">
            
            <option value="">Select Product Type</option>
            @foreach($product_type as $type)
            <option value="{{ $type->product_type_name }}">{{ $type->product_type_name }}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<!-- V A T(%) Field -->
<div class="form-group col-sm-12">
    {!! Form::label('v_a_t', 'V A T(%):') !!}
    {!! Form::text('v_a_t', null, ['class' => 'form-control']) !!}
</div>

<!-- E D(%) Field -->
<div class="form-group col-sm-12">
    {!! Form::label('e_d', 'E D(%):') !!}
    {!! Form::text('e_d', null, ['class' => 'form-control']) !!}
</div>

<!-- Price( T Z S) Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', 'Price( T Z S):') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount(%) Field -->
<div class="form-group col-sm-12">
    {!! Form::label('discount', 'Discount(%):') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.product.products.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
