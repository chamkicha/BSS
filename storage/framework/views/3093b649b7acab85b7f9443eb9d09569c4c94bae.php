

<li class="<?php echo e(Request::is('admin/serviceOrders/serviceOrders*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.serviceOrders.serviceOrders.index'); ?>">
    <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="servers" data-size="18"
               data-loop="true"></i>
               ServiceOrders
    </a>
</li>


<li class="<?php echo e(Request::is('admin/customer/customers*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.customer.customers.index'); ?>">
    <i class="livicon" data-c="#418BCA" data-hc="#418BCA" data-name="user" data-size="18"
               data-loop="true"></i>
               Customers
    </a>
</li>

<li class="<?php echo e(Request::is('admin/product/products*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.product.products.index'); ?>">
    <i class="livicon" data-c="#6CC66C" data-hc="#6CC66C" data-name="servers" data-size="18"
               data-loop="true"></i>
               Products
    </a>
</li>

<li class="<?php echo e(Request::is('admin/productType/productTypes*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.productType.productTypes.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="thumbnails-big" data-size="18"
               data-loop="true"></i>
               ProductTypes
    </a>
</li>






<li class="<?php echo e(Request::is('admin/unitofMeasure/unitofMeasures*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.unitofMeasure.unitofMeasures.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
               data-loop="true"></i>
               UnitofMeasures
    </a>
</li>

<li class="<?php echo e(Request::is('admin/customerType/customerTypes*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.customerType.customerTypes.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="users" data-size="18"
               data-loop="true"></i>
               CustomerTypes
    </a>
</li>

<li class="<?php echo e(Request::is('admin/paymentMode/paymentModes*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.paymentMode.paymentModes.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
               data-loop="true"></i>
               PaymentModes
    </a>
</li>

<li class="<?php echo e(Request::is('admin/servicestatus/servicestatuses*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.servicestatus.servicestatuses.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="dashboard" data-size="18"
               data-loop="true"></i>
               Servicestatuses
    </a>
</li>

<li class="<?php echo e(Request::is('admin/serviceBilling/serviceBillings*') ? 'active' : ''); ?>">
    <a href="<?php echo route('admin.serviceBilling.serviceBillings.index'); ?>">
    <i class="livicon" data-c="#31B0D5" data-hc="#31B0D5" data-name="bank" data-size="18"
               data-loop="true"></i>
               ServiceBillings
    </a>
</li>

<?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/layouts/menu.blade.php ENDPATH**/ ?>