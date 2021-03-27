<ul id="menu" class="page-sidebar-menu">

    <li {!! (Request::is('admin') ? 'class="active"' : '' ) !!}>
        <a href="{{ route('admin.dashboard') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li {!! ( Request::is('admin/laravel_charts') || Request::is('admin/database_charts') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">SERVICES</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li class="{{ Request::is('admin/serviceOrders/serviceOrders*') ? 'active' : '' }}">
                <a href="{!! route('admin.serviceOrders.serviceOrders.index') !!}">
                <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="servers" data-size="18"
                        data-loop="true"></i>
                        Service Orders
                </a>
            </li>
            
            <li class="{{ Request::is('admin/serviceOrders/serviceOrders*') ? 'active' : '' }}">
                <a href="{!! route('admin.serviceOrders.serviceOrders.create') !!}">
                <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="servers" data-size="18"
                        data-loop="true"></i>
                        Create Service Orders 
                </a>
            </li>
        </ul>
    </li>

    

    <li {!! ( Request::is('admin/serviceBilling/serviceBillings*') || Request::is('aadmin/serviceInvoice/serviceInvoices*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">BILLING</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li {!! (Request::is('admin/serviceBilling/serviceBillings*') ? 'class="active" id="active"' : '' ) !!}">
                <a href="{!! route('admin.serviceBilling.serviceBillings.index') !!}">
                <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
                        data-loop="true"></i>
                        Service Billings
                </a>
            </li>
            
            <li {!! (Request::is('admin/serviceInvoice/serviceInvoices*') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{!! route('admin.serviceInvoice.serviceInvoices.index') !!}">
                <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
                        data-loop="true"></i>
                        ServiceInvoices
                </a>
            </li>
            

            <li class="{{ Request::is('admin/paymentAndDue/paymentAndDues*') ? 'active' : '' }}">
                <a href="{!! route('admin.paymentAndDue.paymentAndDues.index') !!}">
                <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
                        data-loop="true"></i>
                        PaymentAndDues
                </a>
            </li>

        </ul>
    </li>

    <li {!! ( Request::is('admin/laravel_charts') || Request::is('admin/database_charts') ? 'class="active"' : '' ) !!}>
            <a href="#">
                <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">CUSTOMERS</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{ Request::is('admin/customer/customers*') ? 'active' : '' }}">
                    <a href="{!! route('admin.customer.customers.index') !!}">
                    <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="user" data-size="18"
                            data-loop="true"></i>
                            Customers List
                    </a>
                </li>
                <li class="{{ Request::is('admin/customer/customers*') ? 'active' : '' }}">
                    <a href="{!! route('admin.customer.customers.create') !!}">
                    <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="user" data-size="18"
                            data-loop="true"></i>
                            Create Customers
                    </a>
                </li>
                
            </ul>
   </li>

    <li {!! ( Request::is('admin/laravel_charts') || Request::is('admin/database_charts') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">PRODUCTS</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li class="{{ Request::is('admin/product/products*') ? 'active' : '' }}">
                <a href="{!! route('admin.product.products.index') !!}">
                <i class="livicon" data-c="#6CC66C" data-hc="#6CC66C" data-name="servers" data-size="18"
                        data-loop="true"></i>
                        Products List
                </a>
            </li>
            
            <li class="{{ Request::is('admin/product/products*') ? 'active' : '' }}">
                <a href="{!! route('admin.product.products.create') !!}">
                <i class="livicon" data-c="#6CC66C" data-hc="#6CC66C" data-name="servers" data-size="18"
                        data-loop="true"></i>
                        Create Products
                </a>
            </li>
            

            
        </ul>
    </li>

    
    <li {!! ( Request::is('admin/laravel_charts') || Request::is('admin/database_charts') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">SETTINGS</span>
            <span class="fa arrow"></span>
        </a>
                <ul class="sub-menu">

                <li class="{{ Request::is('admin/productType/productTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.productType.productTypes.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="thumbnails-big" data-size="18"
                            data-loop="true"></i>
                            ProductTypes
                    </a>
                </li>


                <li class="{{ Request::is('admin/unitofMeasure/unitofMeasures*') ? 'active' : '' }}">
                    <a href="{!! route('admin.unitofMeasure.unitofMeasures.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
                            data-loop="true"></i>
                            UnitofMeasures
                    </a>
                </li>

                <li class="{{ Request::is('admin/customerType/customerTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.customerType.customerTypes.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="users" data-size="18"
                            data-loop="true"></i>
                            CustomerTypes
                    </a>
                </li>

                <li class="{{ Request::is('admin/paymentMode/paymentModes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.paymentMode.paymentModes.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
                            data-loop="true"></i>
                            PaymentModes
                    </a>
                </li>

                <li class="{{ Request::is('admin/servicestatus/servicestatuses*') ? 'active' : '' }}">
                    <a href="{!! route('admin.servicestatus.servicestatuses.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
                            data-loop="true"></i>
                            Servicestatuses
                    </a>
                </li>

                <li class="{{ Request::is('admin/paymentType/paymentTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.paymentType.paymentTypes.index') !!}">
                    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
                            data-loop="true"></i>
                            PaymentTypes
                    </a>
                </li>
        </ul>
    </li>

    <li {!! (Request::is('admin/users') || Request::is('admin/bulk_import_users') || Request::is('admin/users/create') || Request::is('admin/user_profile') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
            <span class="title">Users</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Users
                </a>
            </li>
            <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/users/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New User
                </a>
            </li>
            <li {!! ((Request::is('admin/users/*')) && !(Request::is('admin/users/create')) || Request::is('admin/user_profile') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::route('admin.users.show',Sentinel::getUser()->id) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Profile
                </a>
            </li>
            <li {!! (Request::is('admin/deleted_users') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/deleted_users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Users
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/roles/*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Roles</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/roles') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/roles') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Roles List
                </a>
            </li>
            <li {!! (Request::is('admin/roles/create') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{{ URL::to('admin/roles/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Role
                </a>
            </li>
        </ul>
    </li>
    <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>
