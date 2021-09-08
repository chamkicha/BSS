
<!-- Customer Name Field -->
<div class="form-group">
    {!! Form::label('customer_name', 'Customer Name:') !!}
    <p>{!! $paymentAndDue->customer_name !!}</p>
    <hr>
</div>

<!-- Customer Number Field -->
<div class="form-group">
    {!! Form::label('customer_no', 'Customer No:') !!}
    <p>
    <?php
        $customer_number = DB::table('customers')->where('id', $paymentAndDue->customer_no)->first()->customer_no;
        print_r($customer_number);
        ?></p>
    <hr>
</div>


<!-- Total Amount Field -->
<div class="form-group">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>
                <?php
                $total_maount = $paymentAndDue->paid_amount + $paymentAndDue->balance;
                print_r(number_format($total_maount,2));
                ?></p>
    <hr>
</div>

<!-- Paid Amount Field -->
<div class="form-group">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    <p>{!! number_format($paymentAndDue->paid_amount,2) !!}</p>
    <hr>
</div>

<!-- Balance Field -->
<div class="form-group">
    {!! Form::label('balance', 'Balance:') !!}
    <p>{!! number_format($paymentAndDue->balance,2) !!}</p>
    <hr>
</div>


