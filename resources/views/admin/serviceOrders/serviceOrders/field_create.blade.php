

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

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal">

                                                     <!-- Customer Name Field -->
                                                    <div class="form-group has-success">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label"
                                                                   for="form2inputSuccess">Customer Name</label>
                                                            <div class="col-md-9">    
                                                            
                                                                <select name="customer_name" id="select21" class="form-control select2">
                                                                        
                                                                        <option value="">Select Customer Name</option>
                                                                        @foreach($customer_list as $customer)
                                                                        <option value="{{ $customer->customername}}">{{ $customer->customername }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <!-- Payment Mode Field -->
                                                    <div class="form-group has-success">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label"
                                                                   for="form2inputsuccess">Payment Mode</label>
                                                            <div class="col-md-9">
                                                                
                                                                    <select name="payment_mode" id="select21" class="form-control select2">
                                                                            
                                                                            <option value="">Select Payment Mode</option>
                                                                            @foreach($paymentmode_list as $paymentmode)
                                                                            <option value="{{ $paymentmode->payment_mode_name}}">{{ $paymentmode->payment_mode_name }}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Service Order Type -->
                                                    <div class="form-group has-success">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label" for="form2inputfeedback">Service Order Type</label>
                                                            <div class="col-md-9">
                                                                <select name="serviceordertypes" id="select21" class="form-control select2">
                                                                        
                                                                        <option value="">Select Service Order Type</option>
                                                                        @foreach($service_order_type as $serviceordertype)
                                                                        <option value="{{ $serviceordertype->service_order_type_name}}">{{ $serviceordertype->service_order_type_name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                            <div class="col-md-6">

                                                <!-- Service Creation Date Field -->
                                                    <div class="form-group has-success has-feedback">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label" for="inputSuccess1">Service Creation Date:</label>
                                                            <div class="col-md-9">
                                                                <div class="form-group col-sm-12">
                                                                    {!! Form::date('service_creation_date', null, ['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                <!-- Service Ending Date Field -->
                                                    <div class="form-group has-success has-feedback">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label" for="inputSuccess1">Service Ending Date:</label>
                                                            <div class="col-md-9">
                                                                <div class="form-group col-sm-12">
                                                                    {!! Form::date('service_ending_date', null, ['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                <!-- Service Descriptions Field -->
                                                    <div class="form-group has-success has-feedback">
                                                        <div class="row">
                                                            <label class="col-md-3 control-label" for="inputSuccess1">Service Descriptions:</label>
                                                            <div class="col-md-9">
                                                                <div class="form-group col-sm-12">
                                                                    {!! Form::text('service_descriptions', null, ['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    






<!-- Service Lists Field -->

    <div class="form-group striped-col">
        <div class="row">
            <div class="col-md-9">
            
            <label class="control-label has-success has-feedback">Product List</label>
                @foreach($product_list as $product_lists)
                    <div class="checkbox mar-left5">
                            <label for="form-checkbox1">
                                <input type="checkbox" id="service_lists" name="service_lists[]" value="{{$product_lists->product_name}}" class="square-blue"> {{$product_lists->product_name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

<!-- Next Handler Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="next_handler" name="next_handler" class="form-control" value = "{{nexthandler()}}">
    
</div>

<!-- req_status Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="req_status" name="req_status" class="form-control" value = "created">
    
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


<!-- Order I D Field -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="order_i_d"name="order_i_d" class="form-control" value = "{{serviceorder()}}">
    
</div>



<!-- Service Status Field -->
<div class="form-group col-sm-12">
    
        <input type="hidden" id="service_status"name="service_status" class="form-control" value = "{{servicestatus()}}">
    
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


