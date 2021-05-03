<?php

function activated_by()
{      
      $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
} 

?>



<form action="{{ route('serviceapprove') }}" method = "post"><!-- form add -->
    {{ csrf_field() }}

    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs ">
                    <li class=" nav-item ">
                        <a href="#tab1" data-toggle="tab" class="nav-link active">Customer Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" data-toggle="tab" class="nav-link">Service Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab3" data-toggle="tab" class="nav-link">Product List</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab4" data-toggle="tab" class="nav-link">Actions</a>
                    </li>
                </ul>
                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade  show active" role="tabpanel">
                        <br>
                        <!-- Customer Name Field -->
                        <div class="form-group">
                            <table>

                                
                                @foreach( $serviceOrders['customer_details'] as $value)
                                    <tr>
                                    <td><strong>Customer Name:</strong></td>
                                    <td>{{$value->customername}}</td>
                                    </tr>

                                    <tr>
                                    <td><strong>Customer No:</strong></td>
                                    <td>{{$value->customer_no}}</td>
                                    </tr>

                                    <tr>
                                    <td><strong>TIN Number:</strong></td>
                                    <td>{{$value->t_i_n_number}}</td>
                                    </tr>

                                    <tr>
                                    <td><strong>VAR:</strong></td>
                                    <td>{{$value->v_a_t_registration_number}}</td>
                                    </tr>

                                    <tr>
                                    <td><strong>Contact Person:</strong></td>
                                    <td>{{$value->contact_person}}</td>
                                    </tr>

                                    <tr>
                                    <td><strong>Phone Number:</strong></td>
                                    <td>{{$value->contact_telephone}}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    
                    </div>

                    <div id="tab2" class="tab-pane fade" role="tabpanel">
                            <br>
                            <table>

                            <!-- Order I D Field -->
                            <tr>
                                <td>{!! Form::label('order_i_d', 'Order No:') !!}</td>
                                <td>{!! $serviceOrders['order_i_d'] !!}</td>
                            </tr>

                            <!-- Payment Mode Field -->
                            <tr>
                                <td>{!! Form::label('payment_mode', 'Payment Mode:') !!}</td>
                                <td>{!! $serviceOrders['payment_mode'] !!}</td>
                            </tr>

                            <!-- Service Order Type Field -->
                            <tr>
                                <td>{!! Form::label('serviceordertypes', 'Service Order Type:') !!}</td>
                                <td>{!! $serviceOrders['serviceordertypes'] !!}</td>
                            </tr>

                            <!-- Service Status Field -->
                            <tr>
                                <td>{!! Form::label('service_status', 'Service Status:') !!}</td>
                                <td>
                                
                                @if ($serviceOrders['service_status'] === 'Active')
                                    <span class="label label-sm bg-success text-white">{!! $serviceOrders['service_status'] !!}</span>
                                
                                @elseif ($serviceOrders['service_status'] === 'Inactive')
                                    <span class="label label-sm bg-danger text-white   ">{!! $serviceOrders['service_status'] !!}</span>
                                @endif
                                </td>
                            </tr>

                            <!-- Service activation_date Field -->
                            <tr>
                                <td>{!! Form::label('activation_date', 'Service Activation Date:') !!}</td>
                                <td>{!! $serviceOrders['activation_date'] !!}</td>
                            </tr>

                            <!-- activated_by Field -->
                            <tr>
                                <td>{!! Form::label('activated_by', 'Service Activated by:') !!}</td>
                                <td>{!! $serviceOrders['activated_by'] !!}</td>
                            </tr>

                            <!-- Service Ending Date Field -->
                            <tr>
                                <td>{!! Form::label('service_ending_date', 'Service Ending Date:') !!}</td>
                                <td>{!! $serviceOrders['service_ending_date'] !!}</td>
                            </tr>

                            <!-- Service Service Creation Date Field -->
                            <tr>
                                <td>{!! Form::label('service_creation_date', 'Service Creation Date:') !!}</td>
                                <td>{!! $serviceOrders['service_creation_date'] !!}</td>
                            </tr>

                            <!-- Next Handler Field -->
                            <tr>
                                <td>{!! Form::label('next_handler', 'Next Handler:') !!}</td>
                                <td>{!! $serviceOrders['next_handler'] !!}</td>
                            </tr>

                            <!-- created Field -->
                            <tr>
                                <td>{!! Form::label('created_by', 'Created By:') !!}</td>
                                <td>{!! $serviceOrders['created_by'] !!}</td>
                            </tr>
                            </table>
                                

                    </div>


                    <div id="tab3" class="tab-pane fade" role="tabpanel">
                    <br>
                    
                        <table class="table table-bordered table-hover" style="width: 90%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Amount(TZS)</th>
                                <th>VAT</th>
                                <th>Total(TZS)</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                              @foreach( $serviceOrders['service_name_description'] as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->product_name}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{number_format($value->sub_total,2)}}</td>
                                <td>{{number_format($value->vat_amount,2)}}</td>
                                <td>{{number_format($value->grand_total,2)}}</td>
                            </tr>
                              @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Sub-Total</strong></td>
                                <td><strong>{!! number_format($serviceOrders['sub_total'],2) !!} </strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>VAT</strong></td>
                                <td><strong>{!! number_format($serviceOrders['tax_amount'],2) !!} </strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><strong>{!! number_format($serviceOrders['grand_total'],2) !!} </strong></td>
                            </tr>
                            </tbody>
                        </table> 


                    </div>
                    <div id="tab4" class="tab-pane fade" role="tabpanel">
                     <br>
                      {{--  comment begin  --}}
                     <div class="row">
                        <div class="col-md-6">
                        
                            <label for="inputContent" class=" control-label">Your Comment</label>
                            <div >
                                <textarea name="comment" id="inputContent" rows="3"
                                class="form-control resize_vertical "></textarea>
                            </div>
                            <br>
                            
                            <!-- Service Starting Date Field -->
                            @if (Sentinel::inRole('technical-manager') && $serviceOrders['next_handler_role_id']==='6' && $serviceOrders['prev_handler_role_id']==='3' && $serviceOrders['req_status']==='activated_req')
                            <div>
                                {!! Form::label('activation_date', 'Service Activation Date:') !!}
                                {!! Form::date('activation_date', null, ['class' => 'form-control']) !!}
                            </div>
                            @endif

                            <br>
                            <!-- files Date Field -->

                            @if (Sentinel::inRole('commercial-manager') && $serviceOrders['next_handler_role_id']==='3' && $serviceOrders['prev_handler_role_id']==='6' )
                                    
                            <div >
                                <label class="c control-label" for="form-file-input">Activation Form</label>
                                <div class=" pad-top20 ">
                                    <input type="file" id="activation_form" name="activation_form">
                                </div>
                            </div>
                            @endif

                            @if (Sentinel::inRole('technical_department') && $serviceOrders['req_status']==='assigned_activate')
                                    
                            <div >
                                <label class="c control-label" for="form-file-input">Activation Form</label>
                                <div class=" pad-top20 ">
                                    <input type="file" id="activation_form" name="activation_form">
                                </div>
                            </div>
                            </br>

                            <div>
                                {!! Form::label('activation_date', 'Service Activation Date:') !!}
                                {!! Form::date('activation_date', null, ['class' => 'form-control']) !!}
                            </div>
                            @endif
                            
                            <br>
                            <div >
                                <label for="status">Change Service Status:</label>
                                <select id="req_status" name="req_status" onchange="change_type()">
                                <option disabled selected value> -- select status -- </option>
                                
                                @if (Sentinel::inRole('commercial-manager') && $serviceOrders['next_handler_role_id']==='3' && $serviceOrders['prev_handler_role_id']===null)
                                    <option value="approved">Approve</option>
                                        <option value="cancelled">Cancel</option>

                                @elseif (Sentinel::inRole('technical-manager') && $serviceOrders['next_handler_role_id']==='6' && $serviceOrders['prev_handler_role_id']==='3' && $serviceOrders['req_status']==='approved')
                                    <option value="approved">Approve</option>
                                    <option value="assigned" >Assign To</option>
                                    <option value="cancelled">Cancel</option>

                                    
                                @elseif (Sentinel::inRole('technical_department') && $serviceOrders['req_status']==='assigned')
                                    <option value="assigned_approved" >Approve</option>
                                    <option value="cancelled">Cancel</option>


                                @elseif (Sentinel::inRole('commercial-manager') && $serviceOrders['next_handler_role_id']==='3' && $serviceOrders['prev_handler_role_id']==='6' )
                                    <option value="activated_req">Request for Service Activation</option>
                                    <option value="cancelled">Cancel</option>
                                    
                                @elseif (Sentinel::inRole('technical-manager') && $serviceOrders['next_handler_role_id']==='6' && $serviceOrders['prev_handler_role_id']==='3' && $serviceOrders['req_status']==='activated_req')
                                    <option value="activate">Activate</option>
                                    <option value="assigned_activate">Assign To</option>
                                    <option value="cancelled">Cancel</option>
                                    
                                @elseif (Sentinel::inRole('technical_department') && $serviceOrders['req_status']==='assigned_activate')
                                    <option value="assigned_activated_req">Activate Service</option>
                                    <option value="cancelled">Cancel</option>


                                @elseif (Sentinel::inRole('user') && $request['next_handler']==='sales')
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
                            <br>

                            <div>
                            
                                @if (Sentinel::inRole('technical-manager') && $serviceOrders['next_handler_role_id']==='6' && $serviceOrders['prev_handler_role_id']==='3' && $serviceOrders['req_status']==='approved')
                                    

                                     {{--  commercial department user assign  --}}
                                    <select  name="assigned_to" style="display: none" id="assigned_to">
                                    <option disabled selected value> -- select User -- </option>
                                        @foreach($serviceOrders['tech_user'] as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}}&nbsp;<span>{{$item->last_name}}</span></option>
                                        @endforeach
                                    </select>
                                    @endif
                            
                            </div>

                            

                            <div>
                            
                                @if (Sentinel::inRole('technical-manager') && $serviceOrders['next_handler_role_id']==='6' && $serviceOrders['prev_handler_role_id']==='3' && $serviceOrders['req_status']==='activated_req')
                                    

                                     {{--  commercial department user assign  --}}
                                    <select  name="assigned_to" style="display: none" id="assigned_to">
                                    <option disabled selected value> -- select User -- </option>
                                        @foreach($serviceOrders['tech_user'] as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}}&nbsp;<span>{{$item->last_name}}</span></option>
                                        @endforeach
                                    </select>
                                    @endif
                            
                            </div>




                        </div>

                        <div class="col-md-6">
                        
                                <div id="container3">
                                    <ul>
                                        <li data-jstree='{"opened":true}'><strong>Previous Comment</strong>
                                        
                                            <ul>
                                          @foreach( $serviceOrders['comments_details'] as $value)

                                                <li><strong>{{$value->username}}:</strong> {{$value->comment}}</li>
                                          @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                    
                        </div>

                    </div>
                     {{--  comments end  --}}


                    <br>

<!-- next handler -->
<div class="form-group col-sm-12">
    <input type="hidden" id="next_handler"name="next_handler" class="form-control" value = "{{$serviceOrders['next_handler']}}">
</div>

<!-- customer name -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_name"name="customer_name" class="form-control" value = "{{$serviceOrders['customer_name']}}">
</div>

<!-- customer number -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_no"name="customer_no" class="form-control" value = "{{$serviceOrders['customer_no']}}">
</div>

<!-- payment_mode field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="payment_mode"name="payment_mode" class="form-control" value = "{{$serviceOrders['payment_mode']}}">
</div>


<!-- next handler id -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="next_handler_role_id" name="next_handler_role_id" class="form-control" value = "{{$serviceOrders['next_handler_role_id']}}">
    
</div>

<!-- prev handler id -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="prev_handler_role_id" name="prev_handler_role_id" class="form-control" value = "{{$serviceOrders['prev_handler_role_id']}}">
    
</div>

<!-- ORDER ID -->
<div class="form-group col-sm-12">
    <input type="hidden" id="order_i_d"name="order_i_d" class="form-control" value = "{{$serviceOrders['order_i_d']}}">
</div>

<!-- CUSTOMER ID -->
<div class="form-group col-sm-12">
    <input type="hidden" id="customer_no"name="customer_no" class="form-control" value = "{{$serviceOrders['customer_no']}}">
</div>

<!-- SUB TOTAL -->
<div class="form-group col-sm-12">
    <input type="hidden" id="sub_total" name="sub_total" class="form-control" value = "{{$serviceOrders['sub_total']}}">
</div>

<!-- TAX AMOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="tax_amount" name="tax_amount" class="form-control" value = "{{$serviceOrders['tax_amount']}}">
</div>

<!-- ED AMOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="ed_amount" name="ed_amount" class="form-control" value = "{{$serviceOrders['ed_amount']}}">
</div>

<!-- DISCOUNT -->
<div class="form-group col-sm-12">
    <input type="hidden" id="discount" name="discount" class="form-control" value = "{{$serviceOrders['discount']}}">
</div>

<!-- GRAND TOTAL -->
<div class="form-group col-sm-12">
    <input type="hidden" id="grand_total" name="grand_total" class="form-control" value = "{{$serviceOrders['grand_total']}}">
</div>

<!-- Service Order Type -->
<div class="form-group col-sm-12">
    <input type="hidden" id="serviceordertypes" name="serviceordertypes" class="form-control" value = "{{$serviceOrders['serviceordertypes']}}">
</div>

<!-- Service Lists Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="service_lists" name="service_lists" class="form-control" value="{{json_encode($serviceOrders['service_lists'],TRUE)}}" >

</div>

<!-- activated by Field -->
<div class="form-group col-sm-12">
    <input type="hidden" id="activated_by" name="activated_by" class="form-control" value="{{activated_by()}}" >

</div>





<button type="submit" id=""name="" class="btn btn-success  waves-light" style="float: right;"><i class="icofont icofont-check-circled"></i>Save and Submit</button>
          

</form><!-- form add end -->

                    </div>
                </div>
            </div>
        </div>

    </section>

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<script src="{{ asset('vendors/jstree/js/jstree.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/bootstrap-treeview.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/treeview_jstree.js') }}" type="text/javascript"></script>

@stop

<script type="text/javascript">
    function change_type() 
    {
        var selectBox = document.getElementById("req_status");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue=="assigned")
            {
            $('#assigned_to').show();
            }
        else if (selectedValue=="assigned_activate"){
            $('#assigned_to').show();
            }
        else {
            $('#assigned_to').hide();
            }
    }
</script>


