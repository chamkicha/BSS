

{{-- page level styles --}}
@section('header_styles')

<link type="text/css" href="{{ asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}"
      rel="stylesheet"/>
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/selectize/css/selectize.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/iCheck/css/line/line.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"/>
<link href="{{ asset('vendors/switchery/css/switchery.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/pages/formelements.css') }}" rel="stylesheet"/>
@stop

<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function servicestatus()
{      
  $servicestatus = Servicestatus::where('id','2')->first();
return $servicestatus->service_status_name;
} 

function createdby()
{      
    
    $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
} 


function nexthandler()
{      
    
    $nexthandler = DB::table('role_users')->where('role_id','3')->get();
    $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
    $nexthandler1 = $nexthandler[0]->first_name;
    $nexthandler2 = $nexthandler[0]->last_name;
    $nexthandler3 = ' ';
    $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
    return $nexthandler;
} 

function nexthandler_role()
{      
    $nexthandler = DB::table('role_users')->where('role_id','3')->get();
    $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
    $nexthandler = $nexthandler[0]->id;
    return $nexthandler;
} 

function nexthandler_role_id()
{      
    $nexthandler = DB::table('role_users')->where('role_id','3')->get();
    $nexthandler = $nexthandler[0]->role_id;
    return $nexthandler;
} 

function serviceorder()
{   

              
    $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first();
    
    if(is_null($serviceorder)){

        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
 
        $serviceorder3 = 1000;
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;

    }else{
        $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first()->order_i_d;
        $serviceorder=substr($serviceorder, -4);
        $serviceorder3 = e($serviceorder) + 1;
        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;
    }
        return $serviceorder;
} 


?>




<!-- Order I D Field -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="order_i_d"name="order_i_d" class="form-control" value = "{{serviceorder()}}">
    
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Customer:
    </label>
    <select name="customer_name" id="select21" class="form-control select2">
            
            <option value="">Select Customer Name</option>
            @foreach($customer_list as $customer)
            <option value="{{ $customer->customername}}">{{ $customer->customername }}</option>
            @endforeach
        </optgroup>
    </select>
</div>


<!-- Payment Mode Field -->
<div class="form-group col-sm-12">
    <label for="select21" class="control-label">
        Payment mode:
    </label>
    <select name="payment_mode" id="select21" class="form-control select2">
            
            <option value="">Select Payment Mode</option>
            @foreach($paymentmode_list as $paymentmode)
            <option value="{{ $paymentmode->payment_mode_name}}">{{ $paymentmode->payment_mode_name }}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<!-- Service Status Field -->
<div class="form-group col-sm-12">
    
        <input type="hidden" id="service_status"name="service_status" class="form-control" value = "{{servicestatus()}}">
    
</div>

<!-- Service Starting Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_starting_date', 'Service Starting Date:') !!}
    {!! Form::date('service_starting_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Ending Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_ending_date', 'Service Ending Date:') !!}
    {!! Form::date('service_ending_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Descriptions Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_descriptions', 'Service Descriptions:') !!}
    {!! Form::text('service_descriptions', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Lists Field -->
<div class="form-group col-sm-12">
    @foreach($product_list as $product_lists)
    <label class="checkbox-inline">
    <input type="checkbox" id="service_lists" name="service_lists[]" value="{{$product_lists->product_name}}"> {{$product_lists->product_name}}
    </label>
    @endforeach
</div>

<!-- TAX Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tax_amount', 'VAT %:') !!}
    {!! Form::text('tax_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- ED AMOUNT -->
<div class="form-group col-sm-12">
    {!! Form::label('ed_amount', 'ED %:') !!}
    {!! Form::text('ed_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- DISCOUNT -->
<div class="form-group col-sm-12">
    {!! Form::label('discount', 'DISCOUNT:') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>


<!-- Next Handler Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="next_handler" name="next_handler" class="form-control" value = "{{nexthandler()}}">
    
</div>

<!-- Next Handler_role Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="next_handler_role" name="next_handler_role" class="form-control" value = "{{nexthandler_role()}}">
    
</div>

<!-- Next Handler_role_id Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="next_handler_role_id" name="next_handler_role_id" class="form-control" value = "{{nexthandler_role_id()}}">
    
</div>


<!-- created by Field -->
<div class="form-group col-sm-12"> 
        
    <input type="hidden" id="created_by" name="created_by" class="form-control" value = "{{createdby()}}">
    
</div>





<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.serviceOrders.serviceOrders.index') !!}" class="btn btn-secondary">Cancel</a>
</div>




@section('footer_scripts')
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>

<script language="javascript" type="text/javascript" src="{{ asset('vendors/sifter/sifter.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/microplugin/microplugin.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/selectize/js/selectize.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('vendors/card/js/jquery.card.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/pages/custom_elements.js') }}"></script>

@stop