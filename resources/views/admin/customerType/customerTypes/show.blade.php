@extends('admin/layouts/default')

@section('title')
CustomerType
@parent
@stop

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>CustomerTypes</li>
        <li class="active">Customer Type View</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
      <div class="col-12">
       <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Customer Type details
                    </h4>
                </div>
                    <div class="card-body">
                        @include('admin.customerType.customerTypes.show_fields')
                    </div>
                </div>

    <div class="form-group">
           <a href="{!! route('admin.customerType.customerTypes.index') !!}" class="btn btn-warning mt-2">Back</a>
    </div>
     </div>
     </div>
  </div>
</section>
@stop
