<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function customerNo()
{   

              
    $customer_no = DB::table('customers')->orderBy('customer_no', 'desc')->first();
    
    if(is_null($customer_no)){

        $customer_no1 = 'CO_';

        $customer_no = date('Y-m');
        $customer_no = str_replace("-", "", $customer_no);
        $customer_no = str_replace(":", "", $customer_no);
        $customer_no2 = str_replace(" ", "", $customer_no);
 
        $customer_no3 = 1000;
        $customer_no = $customer_no1.$customer_no2.$customer_no3;

    }else{
        $customer_no = DB::table('customers')->orderBy('customer_no', 'desc')->first()->customer_no;
        $customer_no = substr($customer_no, -4);
        $customer_no3 = e($customer_no) + 1;
        $customer_no1 = 'CO_';

        $customer_no = date('Y-m');
        $customer_no = str_replace("-", "", $customer_no);
        $customer_no = str_replace(":", "", $customer_no);
        $customer_no2 = str_replace(" ", "", $customer_no);
        $customer_no = $customer_no1.$customer_no2.$customer_no3;
    }
        return $customer_no;
} 


?>




<!-- cUSTOMER NO Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="customer_no" name="customer_no" class="form-control" value = "{{customerNo()}}">
    
</div>


    <div class="card-body">
            <div id="rootwizard">
                <ul class="nav nav-pills">
                    <li  class="nav-item">
                        <a href="#tab1" data-toggle="tab" class="nav-link active color_accrd">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" data-toggle="tab" class="nav-link color_accrd ml-2">Contacts Information</a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab" class="nav-link color_accrd ml-2">Attachment Information</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1">
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Customername Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('customername', 'Customername:') !!}
                                    {!! Form::text('customername', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- T I N Number Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('t_i_n_number', 'T I N Number:') !!}
                                    {!! Form::text('t_i_n_number', null, ['class' => 'form-control']) !!}
                                </div>

                                </div>
                                <div class="col-lg-4">

                                <!-- V A T Registration Number Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('v_a_t_registration_number', 'V A T Registration Number:') !!}
                                    {!! Form::text('v_a_t_registration_number', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Business License Number Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('business_license_number', 'Business License Number:') !!}
                                    {!! Form::text('business_license_number', null, ['class' => 'form-control']) !!}
                                </div>
                                

                                <!-- Customer Type Field -->

                                <div class="form-group col-sm-12">

                                    <label for="select21" class="control-label">
                                        Customer Type:
                                    </label>
                                    <select name="customer_type" id="select21" class="form-control select2">
                                            
                                            <option value="">Select Customer Type</option>
                                            @foreach($customer_type as $customer)
                                            <option value="{{ $customer->customer_type_name_default}}">{{ $customer->customer_type_name_default }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                    
                        <div class="row">
                            <div class="col-lg-4">

                                <!-- Contact Person Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('contact_person', 'Contact Person:') !!}
                                    {!! Form::text('contact_person', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Position Held Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('position_held', 'Position Held:') !!}
                                    {!! Form::text('position_held', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Contact Telephone Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('contact_telephone', 'Contact Telephone:') !!}
                                    {!! Form::text('contact_telephone', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Office Telephone Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('office_telephone', 'Office Telephone:') !!}
                                    {!! Form::text('office_telephone', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Email Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('email', 'Email:') !!}
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <!-- Postal Address Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('postal_address', 'Postal Address:') !!}
                                    {!! Form::text('postal_address', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Region Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('region', 'Region:') !!}
                                    {!! Form::text('region', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Country Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('country', 'Country:') !!}
                                    {!! Form::text('country', null, ['class' => 'form-control']) !!}
                                </div>


                                <!-- District Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('district', 'District:') !!}
                                    {!! Form::text('district', null, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Fax Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::label('fax', 'Fax:') !!}
                                    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                    
                        <div class="row">
                            <br>
                            <div class="col-lg-4">
                                
                                <div >
                                    <label class="c control-label" for="form-file-input">Business licence</label>
                                    <div class=" pad-top20 ">
                                        <input type="file" id="Business_licence" name="Business_licence">
                                    </div>
                                </div>
                            <br>
                                
                                <div >
                                    <label class="c control-label" for="form-file-input">Certificate of incorporation</label>
                                    <div class=" pad-top20 ">
                                        <input type="file" id="Certificate_of_incorporation" name="Certificate_of_incorporation">
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                
                                <div >
                                    <label class="c control-label" for="form-file-input">TIN registeration number</label>
                                    <div class=" pad-top20 ">
                                        <input type="file" id="TIN_registeration_number" name="TIN_registeration_number">
                                    </div>
                                </div>
                            <br>
                                
                                <div >
                                    <label class="c control-label" for="form-file-input">Tax exemption certification</label>
                                    <div class=" pad-top20 ">
                                        <input type="file" id="Tax_exemption_certification" name="Tax_exemption_certification">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.customer.customers.index') !!}" class="btn btn-secondary">Cancel</a>
</div>


