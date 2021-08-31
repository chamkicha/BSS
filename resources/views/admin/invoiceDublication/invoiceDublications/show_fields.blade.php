<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $invoiceDublication->id !!}</p>
    <hr>
</div>

<!-- Invoice Number Field -->
<div class="form-group">
    {!! Form::label('invoice_number', 'Invoice Number:') !!}
    <p>{!! $invoiceDublication->invoice_number !!}</p>
    <hr>
</div>

<!-- Invoice Creation Date Field -->
<div class="form-group">
    {!! Form::label('invoice_creation_date', 'Invoice Creation Date:') !!}
    <p>{!! $invoiceDublication->invoice_creation_date !!}</p>
    <hr>
</div>

<!-- Next Invoice Date Field -->
<div class="form-group">
    {!! Form::label('next_invoice_date', 'Next Invoice Date:') !!}
    <p>{!! $invoiceDublication->next_invoice_date !!}</p>
    <hr>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $invoiceDublication->created_by !!}</p>
    <hr>
</div>

