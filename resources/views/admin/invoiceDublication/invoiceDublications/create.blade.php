@extends('admin/layouts/default')

@section('title')
Invoice Dublication
@parent
@stop

@section('content')
@include('common.errors')
<section class="content-header">
    <h1>Invoice Dublication</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>InvoiceDublications</li>
        <li class="active">Create Invoice Dublication </li>
    </ol>
</section>
<section class="content">
<div class="container">
<div class="row">
    <div class="col-12">
     <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Create Invoice Dublication
                </h4></div>
            <br />
            <div class="card-body">
            {!! Form::open(['route' => 'admin.invoiceDublication.invoiceDublications.store']) !!}

                @include('admin.invoiceDublication.invoiceDublications.fields')

            {!! Form::close() !!}
        </div>
      </div>
      </div>
 </div>

</div>
</section>
 @stop
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
@stop
