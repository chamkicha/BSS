
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs ">
                    <li class=" nav-item ">
                        <a href="#tab1" data-toggle="tab" class="nav-link active">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" data-toggle="tab" class="nav-link">Contact Information</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab3" data-toggle="tab" class="nav-link">Service List</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab4" data-toggle="tab" class="nav-link">Attachments</a>
                    </li>
                </ul>
                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade  show active" role="tabpanel">
                            <br>
                            <table>
                            

                                <!-- Customername Field -->
                                <tr>
                                    <td><strong>{!! Form::label('customername', 'Customer name:') !!}</strong></td>
                                    <td>{!! $customer['customername'] !!}</td>
                                </tr>

                                <!-- Customer Type Field -->
                                <tr>
                                    <td><strong>{!! Form::label('customer_type', 'Customer Type:') !!}<strong></td>
                                    <td>{!! $customer['customer_type'] !!}</td>
                                </tr>


                                <!-- Customernumber Field -->
                                <tr>
                                    <td><strong>{!! Form::label('customer_no', 'Customer Number:') !!}</strong></td>
                                    <td>{!! $customer['customer_no'] !!}</td>
                                </tr>


                                <!-- T I N Number Field -->
                                <tr>
                                    <td><strong>{!! Form::label('t_i_n_number', 'T I N Number:') !!}</strong></td>
                                    <td>{!! $customer['t_i_n_number'] !!}</td>
                                </tr>

                                <!-- V A T Registration Number Field -->
                                <tr>
                                    <td><strong>{!! Form::label('v_a_t_registration_number', 'V A T Registration Number:') !!}</strong></td>
                                    <td>{!! $customer['v_a_t_registration_number'] !!}</td>
                                </tr>

                                <!-- Business License Number Field  -->
                                <tr>
                                    <td><strong>{!! Form::label('business_license_number', 'Business License Number:') !!}</strong></td>
                                    <td>{!! $customer['business_license_number'] !!}</td>
                                </tr>

                            </table>
                    
                    </div>

                    <div id="tab2" class="tab-pane fade" role="tabpanel">
                            <br>
                            
                     <div class="row">
                        <div class="col-md-4">
                        
                           
                            <table>




                                <!-- Contact Person Field -->
                                <tr>
                                    <td><strong>{!! Form::label('contact_person', 'Contact Person:') !!}<strong></td>
                                    <td>{!! $customer['contact_person'] !!}</td>
                                </tr>

                                <!-- Position Held Field -->
                                <tr>
                                    <td><strong>{!! Form::label('position_held', 'Position Held:') !!}<strong></td>
                                    <td>{!! $customer['position_held'] !!}</td>
                                </tr>

                                <!-- Contact Telephone Field -->
                                <tr>
                                    <td><strong>{!! Form::label('contact_telephone', 'Contact Telephone:') !!}<strong></td>
                                    <td>{!! $customer['contact_telephone'] !!}</td>
                                </tr>

                                <!-- Office Telephone Field -->
                                <tr>
                                    <td><strong>{!! Form::label('office_telephone', 'Office Telephone:') !!}<strong></td>
                                    <td>{!! $customer['office_telephone'] !!}</td>
                                </tr>
                            </table>




                        </div>

                        <div class="col-md-4">
                        
                                
                            <table>
                            
                                <!-- Email Field  -->
                                <tr>
                                    <td><strong>{!! Form::label('email', 'Email:') !!}<strong></td>
                                    <td>{!! $customer['email'] !!}</td>
                                </tr>

                                <!-- Postal Address Field -->
                                <tr>
                                    <td><strong>{!! Form::label('postal_address', 'Postal Address:') !!}<strong></td>
                                    <td>{!! $customer['postal_address'] !!}</td>
                                </tr>

                                <!-- Region Field -->
                                <tr>
                                    <td><strong>{!! Form::label('region', 'Region:') !!}<strong></td>
                                    <td>{!! $customer['region'] !!}</td>
                                </tr>

                                <!-- District Field -->
                                <tr>
                                    <td><strong>{!! Form::label('district', 'District:') !!}<strong></td>
                                    <td>{!! $customer['district'] !!}</td>
                                </tr>

                                <!-- created Field -->
                                <tr>
                                    <td><strong>{!! Form::label('fax', 'Fax:') !!}<strong></td>
                                    <td>{!! $customer['fax'] !!}</td>
                                </tr>

                            </table>
                    
                        </div>

                    </div>
                                

                    </div>


                    <div id="tab3" class="tab-pane fade" role="tabpanel">
                    <br>
                    
                        <table class="table table-bordered table-hover" style="width: 90%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Order No.</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Created By</th>
                                <th>Service Order Type</th>
                                <th>Payment Model</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                              @foreach( $customer['serviceorder_details'] as $value)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->order_i_d}}</td>
                                <td>{{$value->service_status}}</td>
                                <td>{{$value->service_lists}}</td>
                                <td>{{$value->created_by}}</td>
                                <td>{{$value->serviceordertypes}}</td>
                                <td>{{$value->payment_mode}}</td>
                            </tr>
                                    
                              @endforeach
                            </tbody>
                        </table> 


                    </div>
                    <div id="tab4" class="tab-pane fade" role="tabpanel">
                     <br>
                      {{--  comment begin  --}}
                     <div class="row">
                        <div class="col-md-6">
                        
                           {{--  sisi  --}}




                        </div>

                        <div class="col-md-6">
                        
                                {{--  left  --}}
                    
                        </div>

                    </div>
                     {{--  comments end  --}}


                    <br>




                    </div>
                </div>
            </div>
        </div>

    </section>