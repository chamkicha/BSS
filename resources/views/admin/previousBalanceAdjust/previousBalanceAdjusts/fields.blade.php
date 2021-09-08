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

 <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css') }}">



@stop




        <!-- Invoice Number Field -->
    <div class="form-group has-success col-sm-12">
        <div class="row">
            <label class="col-md-2 control-label"
                    for="form2inputSuccess">Select Invoice</label>
            <div class="col-md-5">    
            
                <select name="invoice_no" id="select21" class="form-control select2">
                        
                        <option value="">Select Invoice</option>
                        @foreach($invoice_nos as $invoice_no)
                        <option value="{{ $invoice_no->id }}">{{ $invoice_no->invoice_number }}  {{ $invoice_no->cusromer_name }}</option>
                        @endforeach
                    </optgroup>
                </select>
                <span style="color: red">@error('invoice_no'){{'Invoice Number is required.'}}@enderror</span>
            </div>
        </div>
    </div>

            <!-- Add Sub Field -->
    <div class="form-group has-success col-sm-12">
        <div class="row">
            <label class="col-md-2 control-label"
                    for="form2inputSuccess">ADD / SUB:</label>
            
            <div class="col-md-5">    
                {!! Form::select('add_sub', ['add' => 'ADDITION', 'sub'=>'SUBSTRACTION'], null, ['class' => 'form-control']) !!}
                <span style="color: red">@error('amount'){{'Amount is required.'}}@enderror</span>
            </div>
        </div>
    </div>

            <!-- Amount Field Field -->
    <div class="form-group has-success col-sm-12">
        <div class="row">
            <label class="col-md-2 control-label"
                    for="form2inputSuccess">Amount:</label>
            
            <div class="col-md-5">    
                {!! Form::number('amount', null, ['class' => 'form-control' ,'step'=>'any']) !!}
                <span style="color: red">@error('amount'){{'Amount is required.'}}@enderror</span>
            </div>
        </div>
    </div>




<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.previousBalanceAdjust.previousBalanceAdjusts.index') !!}" class="btn btn-secondary">Cancel</a>
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
