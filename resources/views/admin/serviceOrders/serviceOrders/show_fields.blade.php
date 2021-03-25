<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $serviceOrders->id !!}</p>
    <hr>
</div>

<!-- Order I D Field -->
<div class="form-group">
    {!! Form::label('order_i_d', 'Order I D:') !!}
    <p>{!! $serviceOrders->order_i_d !!}</p>
    <hr>
</div>

<!-- Customer Name Field -->
<div class="form-group">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    <p>{!! $serviceOrders->customer_name !!}</p>
    <hr>
</div>

<!-- Payment Mode Field -->
<div class="form-group">
    {!! Form::label('payment_mode', 'Payment Mode:') !!}
    <p>{!! $serviceOrders->payment_mode !!}</p>
    <hr>
</div>

<!-- Service Status Field -->
<div class="form-group">
    {!! Form::label('service_status', 'Service Status:') !!}
    <p>{!! $serviceOrders->service_status !!}</p>
    <hr>
</div>

<!-- Sub Total Field -->
<div class="form-group">
    {!! Form::label('sub_total', 'Sub Total:') !!}
    <p>{!! $serviceOrders->sub_total !!}</p>
    <hr>
</div>

<!-- Service Starting Date Field -->
<div class="form-group">
    {!! Form::label('service_starting_date', 'Service Starting Date:') !!}
    <p>{!! $serviceOrders->service_starting_date !!}</p>
    <hr>
</div>

<!-- Service Ending Date Field -->
<div class="form-group">
    {!! Form::label('service_ending_date', 'Service Ending Date:') !!}
    <p>{!! $serviceOrders->service_ending_date !!}</p>
    <hr>
</div>

<!-- Service Descriptions Field -->
<div class="form-group">
    {!! Form::label('service_descriptions', 'Service Descriptions:') !!}
    <p>{!! $serviceOrders->service_descriptions !!}</p>
    <hr>
</div>

<!-- Service Lists Field -->
<div class="form-group">
    {!! Form::label('service_lists', 'Service Lists:') !!}
    <p>@foreach((array) $serviceOrders->service_lists as $value)
        {{$value}},
        @endforeach</p>
    <hr>
</div>

<!-- Next Handler Field -->
<div class="form-group">
    {!! Form::label('next_handler', 'Next Handler:') !!}
    <p>{!! $serviceOrders->next_handler !!}</p>
    <hr>
</div>

<!-- Next Handler Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $serviceOrders->created_by !!}</p>
    <hr>
</div>


<form action="{{ route('serviceapprove') }}" method = "post"><!-- form add -->
    {{ csrf_field() }}

<div class="form-group row">
    <div class="col-sm-12">
      <label for="status">Change Service Status:</label>
        <select id="req_status" name="req_status">
          <option disabled selected value> -- select status -- </option>
          
          @if (Sentinel::inRole('commercial-manager') && $serviceOrders->next_handler_role_id==='3' && $serviceOrders->prev_handler_role_id===null)
               <option value="approved">Approve</option>
                <option value="cancelled">Cancel</option>
          @elseif (Sentinel::inRole('technical-manager') && $serviceOrders->next_handler_role_id==='6' && $serviceOrders->prev_handler_role_id==='3')
              <option value="approved">Approve</option>
              <option value="assigned">Assign To</option>
              <option value="cancelled">Cancel</option>
          @elseif (Sentinel::inRole('commercial-manager') && $serviceOrders->next_handler_role_id==='3' && $serviceOrders->prev_handler_role_id==='6' && $serviceOrders->service_status==='Inactive')
              <option value="activated">Activate</option>
              <option value="cancelled">Cancel</option>
          @elseif (Sentinel::inRole('user') && $request->next_handler==='sales')
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          @elseif (Sentinel::inRole('admin'))
              <option value="verified">Verify</option>
              <option value="approve">Approve</option>
              <option value="issued">Issue</option>
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          @endif
          </select>
</div>
</div>

<!-- Service Starting Date Field -->
@if (Sentinel::inRole('commercial-manager') && $serviceOrders->next_handler_role_id==='3' && $serviceOrders->prev_handler_role_id==='6'  && $serviceOrders->service_status==='Inactive')
<div class="form-group col-sm-12">
    {!! Form::label('activation_date', 'Service Activation Date:') !!}
    {!! Form::date('activation_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="row">
    <label class="col-md-3 col-lg-3 col-12 control-label" for="upload">File Upload</label>
    <div class="col-md-9 col-12 col-lg-9">
        <div class="input-group image-preview">
            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
            <span class="input-group-btn">
<!-- image-preview-clear button -->
<button type="button" class="btn btn-secondary image-preview-clear" style="display:none; border-radius:0 !important; border: 1px solid rgba(0, 0, 0, 0.16);">
<span class="fa  fa-times"></span> Clear
</button>
                <!-- image-preview-input -->
<div class="btn btn-secondary image_radius image-preview-input" style="margin-left:-3px;">
<span class="fa fa-folder-open"></span>
<span class="image-preview-input-title">Browse</span>
<input type="file" accept="image/png, image/jpeg, image/gif" name=""/> <!-- rename it -->
</div>
</span>
        </div><!-- /input-group image-preview [TO HERE]-->
    </div>
    </div>
</div>

@endif


<!-- next handler -->
<div class="form-group col-sm-12">
    <input type="hidden" id="next_handler"name="next_handler" class="form-control" value = "{{$serviceOrders->next_handler}}">
</div>

<!-- customer name -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_name"name="customer_name" class="form-control" value = "{{$serviceOrders->customer_name}}">
</div>

<!-- customer number -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_no"name="customer_no" class="form-control" value = "{{$serviceOrders->customer_no}}">
</div>


<!-- next handler id -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="next_handler_role_id" name="next_handler_role_id" class="form-control" value = "{{$serviceOrders->next_handler_role_id}}">
    
</div>

<!-- prev handler id -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="prev_handler_role_id" name="prev_handler_role_id" class="form-control" value = "{{$serviceOrders->prev_handler_role_id}}">
    
</div>

<!-- ORDER ID -->
<div class="form-group col-sm-12">
    <input type="hidden" id="order_i_d"name="order_i_d" class="form-control" value = "{{$serviceOrders->order_i_d}}">
</div>

<!-- CUSTOMER ID -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_no"name="customer_no" class="form-control" value = "{{$serviceOrders->customer_no}}">
</div>

<!-- SUB TOTAL -->
<div class="form-group col-sm-12">
    <input type="hidden" id="sub_total" name="sub_total" class="form-control" value = "{{$serviceOrders->sub_total}}">
</div>

<!-- TAX AMOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="tax_amount" name="tax_amount" class="form-control" value = "{{$serviceOrders->tax_amount}}">
</div>

<!-- ED AMOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="ed_amount" name="ed_amount" class="form-control" value = "{{$serviceOrders->ed_amount}}">
</div>

<!-- DISCOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="discount" name="discount" class="form-control" value = "{{$serviceOrders->discount}}">
</div>

<!-- GRAND TOTAL -->
<div class="form-group col-sm-12">
    <input type="hidden" id="grand_total" name="grand_total" class="form-control" value = "{{$serviceOrders->grand_total}}">
</div>



<button type="submit" id=""name="" class="btn btn-success  waves-light" style="float: right;"><i class="icofont icofont-check-circled"></i>Save and Submit</button>
          

</form><!-- form add end -->
