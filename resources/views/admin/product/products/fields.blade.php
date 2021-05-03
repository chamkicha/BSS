<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function product_no()
{   

              
    $product_no = DB::table('products')->orderBy('product_no', 'desc')->first();
    
    if(is_null($product_no)){

        $product_no1 = 'PO_';

        $product_no = date('Y-m');
        $product_no = str_replace("-", "", $product_no);
        $product_no = str_replace(":", "", $product_no);
        $product_no2 = str_replace(" ", "", $product_no);
 
        $product_no3 = 1000;
        $product_no = $product_no1.$product_no2.$product_no3;

    }else{
        $product_no = DB::table('products')->orderBy('product_no', 'desc')->first()->product_no;
        $product_no = substr($product_no, -4);
        $product_no3 = e($product_no) + 1;
        $product_no1 = 'PO_';

        $product_no = date('Y-m');
        $product_no = str_replace("-", "", $product_no);
        $product_no = str_replace(":", "", $product_no);
        $product_no2 = str_replace(" ", "", $product_no);
        $product_no = $product_no1.$product_no2.$product_no3;
    }
        return $product_no;
} 

function created_by(){

    $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
}


?>


<div class="row">
             <div class"form-group col-lg-6">
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

                    <!-- Description Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>

            </div>

            
            <div class"form-group col-lg-6">


                    <!-- Price( T Z S) Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('price', 'Price( T Z S):') !!}
                        {!! Form::text('price', null, ['class' => 'form-control']) !!}
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


                    <!-- Discount(%) Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('discount', 'Discount(%):') !!}
                        {!! Form::text('discount', null, ['class' => 'form-control']) !!}
                    </div>

            </div>
            
<!-- product no Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="product_no" name="product_no" class="form-control" value="{{product_no()}}" >

</div>

<!-- created by Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="created_by" name="created_by" class="form-control" value="{{created_by()}}" >

</div>


</div>


<!-- Submit Field -->
<div class="form-group col-sm-4 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.product.products.index') !!}" class="btn btn-secondary">Cancel</a>
</div>


