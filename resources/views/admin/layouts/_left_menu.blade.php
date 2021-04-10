<ul id="menu" class="page-sidebar-menu">

    <li {!! (Request::is('admin') ? 'class="active"' : '' ) !!}>
        <a href="{{ route('admin.dashboard') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li {!! ( Request::is('admin/serviceOrders/serviceOrders*') || Request::is('admin/serviceOrders/serviceOrders/create') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">SERVICES</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li {!! (Request::is('admin/serviceOrders/serviceOrders/index') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{!! route('admin.serviceOrders.serviceOrders.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Service Orders
                </a>
            </li>
            
            <li  {!! (Request::is('admin/serviceOrders/serviceOrders/create') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{!! route('admin.serviceOrders.serviceOrders.create') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Create Service Orders 
                </a>
            </li>
        </ul>
    </li>

    

    <li {!! ( Request::is('admin/serviceBilling/serviceBillings*') || Request::is('admin/creditNote/creditNotes*') || Request::is('admin/invoicwePayment/invoicwePayments*') || Request::is('admin/serviceInvoice/serviceInvoices*') || Request::is('admin/paymentAndDue/paymentAndDues*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="bank" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">BILLING</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li {!! (Request::is('admin/serviceBilling/serviceBillings*') ? 'class="active" id="active"' : '' ) !!}">
                <a href="{!! route('admin.serviceBilling.serviceBillings.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Service Billings
                </a>
            </li>
            
            <li {!! (Request::is('admin/serviceInvoice/serviceInvoices*') ? 'class="active" id="active"' : '' ) !!}>
                <a href="{!! route('admin.serviceInvoice.serviceInvoices.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Service Invoices
                </a>
            </li>
            
            <li class="{{ Request::is('admin/invoicwePayment/invoicwePayments*') ? 'active' : '' }}">
                <a href="{!! route('admin.invoicwePayment.invoicwePayments.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Payments
                </a>
            </li>

            

            <li class="{{ Request::is('admin/paymentAndDue/paymentAndDues*') ? 'active' : '' }}">
                <a href="{!! route('admin.paymentAndDue.paymentAndDues.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Payment and Dues
                </a>
            </li>

            

            <li class="{{ Request::is('admin/creditNote/creditNotes*') ? 'active' : '' }}">
                <a href="{!! route('admin.creditNote.creditNotes.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        CreditNotes
                </a>
            </li>
 


        </ul>
    </li>

    <li {!! ( Request::is('admin/customer/customers*') || Request::is('admin/customer/customers/create') ? 'class="active"' : '' ) !!}>
            <a href="#">
                <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">CUSTOMERS</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{ Request::is('admin/customer/customers*') ? 'active' : '' }}">
                    <a href="{!! route('admin.customer.customers.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            Customers List
                    </a>
                </li>
                <li class="{{ Request::is('admin/customer/customers/create') ? 'active' : '' }}">
                    <a href="{!! route('admin.customer.customers.create') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            Create Customers
                    </a>
                </li>
                
            </ul>
   </li>

    <li {!! ( Request::is('admin/product/products*') || Request::is('admin/product/products/create') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">PRODUCTS</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            
            <li class="{{ Request::is('admin/product/products*') ? 'active' : '' }}">
                <a href="{!! route('admin.product.products.index') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Products List
                </a>
            </li>
            
            <li class="{{ Request::is('admin/product/products/create') ? 'active' : '' }}">
                <a href="{!! route('admin.product.products.create') !!}">
                <i class="fa fa-angle-double-right"></i>
                        Create Products
                </a>
            </li>
            

            
        </ul>
    </li>

    
    <li {!! ( Request::is('admin/productType/productTypes*') || Request::is('admin/serviceOrderType/serviceOrderTypes*') || Request::is('admin/unitofMeasure/unitofMeasures*') || Request::is('admin/customerType/customerTypes*') || Request::is('admin/paymentMode/paymentModes*') || Request::is('admin/servicestatus/servicestatuses*') || Request::is('admin/paymentType/paymentTypes*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="gears" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">SETTINGS</span>
            <span class="fa arrow"></span>
        </a>
                <ul class="sub-menu">

                <li class="{{ Request::is('admin/productType/productTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.productType.productTypes.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            ProductTypes
                    </a>
                </li>


                <li class="{{ Request::is('admin/unitofMeasure/unitofMeasures*') ? 'active' : '' }}">
                    <a href="{!! route('admin.unitofMeasure.unitofMeasures.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            UnitofMeasures
                    </a>
                </li>

                <li class="{{ Request::is('admin/customerType/customerTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.customerType.customerTypes.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            CustomerTypes
                    </a>
                </li>

                <li class="{{ Request::is('admin/paymentMode/paymentModes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.paymentMode.paymentModes.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            PaymentModes
                    </a>
                </li>

                <li class="{{ Request::is('admin/servicestatus/servicestatuses*') ? 'active' : '' }}">
                    <a href="{!! route('admin.servicestatus.servicestatuses.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            Servicestatuses
                    </a>
                </li>

                <li class="{{ Request::is('admin/paymentType/paymentTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.paymentType.paymentTypes.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            PaymentTypes
                    </a>
                </li>

                <li class="{{ Request::is('admin/serviceOrderType/serviceOrderTypes*') ? 'active' : '' }}">
                    <a href="{!! route('admin.serviceOrderType.serviceOrderTypes.index') !!}">
                    <i class="fa fa-angle-double-right"></i>
                            Service Order Types
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
