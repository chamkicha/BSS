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

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $serviceOrders->price !!}</p>
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
