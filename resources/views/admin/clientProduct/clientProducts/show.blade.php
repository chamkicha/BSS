@extends('admin/layouts/default')

@section('title')
Client_product
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Client_product View</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Client_products</li>
        <li class="active">Client_product View</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
      <div class="col-12">
       <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Client_product details
                    </h4>
                </div>
                    <div class="card-body">
                        @include('admin.clientProduct.clientProducts.show_fields')
                    </div>
                </div>

    <div class="form-group">
           <a href="{!! route('admin.clientProduct.clientProducts.index') !!}" class="btn btn-warning mt-2">Back</a>
    </div>
     </div>
     </div>
  </div>
</section>
@stop
