<?php


function credit_note_no()
{   

              
    $credit_note_no = DB::table('creditnotes')->orderBy('credit_note_no', 'desc')->first();
    
    if(is_null($credit_note_no)){

        $credit_note_no1 = 'CN_';

        $credit_note_no = date('Y-m-d ');
        $credit_note_no = str_replace("-", "", $credit_note_no);
        $credit_note_no = str_replace(":", "", $credit_note_no);
        $credit_note_no2 = str_replace(" ", "", $credit_note_no);
 
        $credit_note_no3 = 1000;
        $credit_note_no = $credit_note_no1.$credit_note_no2.$credit_note_no3;

    }else{
        $credit_note_no = DB::table('creditnotes')->orderBy('credit_note_no', 'desc')->first()->credit_note_no;
        $credit_note_no=substr($credit_note_no, -4);
        $credit_note_no3 = e($credit_note_no) + 1;
        $credit_note_no1 = 'CN_';

        $credit_note_no = date('Y-m-d ');
        $credit_note_no = str_replace("-", "", $credit_note_no);
        $credit_note_no = str_replace(":", "", $credit_note_no);
        $credit_note_no2 = str_replace(" ", "", $credit_note_no);
        $credit_note_no = $credit_note_no1.$credit_note_no2.$credit_note_no3;
    }
        return $credit_note_no;
}


function created_by()
{      
    
    $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
}


?>


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




    <!-- Invoice No Field -->
<div class="form-group has-success">
    <div >
        <label class="col-sm-10 form-group"
                for="form2inputSuccess">Invoice No:</label>
        <div class="col-sm-10">    
        
            <select name="invoice_no" id="select21" class="form-control select2">
                    
                    <option value="">Select Invoice No</option>
                    @foreach($service_invoice as $invoice)
                    <option value="{{ $invoice->invoice_number}}">{{ $invoice->invoice_number }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-10">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>


<!-- Reason For Adjustment Field -->
<div class="form-group col-sm-10">
    {!! Form::label('reason_for_adjustment', 'Reason For Adjustment:') !!}
    {!! Form::text('reason_for_adjustment', null, ['class' => 'form-control']) !!}
</div>

<!-- credit_note_no Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="credit_note_no" name="credit_note_no" class="form-control" value = "{{credit_note_no()}}">
    
</div>

<!-- created by Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="created_by" name="created_by" class="form-control" value = "{{created_by()}}">
    
</div>

<!-- Submit Field -->
<div class="form-group col-sm-10 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.creditNote.creditNotes.index') !!}" class="btn btn-secondary">Cancel</a>
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