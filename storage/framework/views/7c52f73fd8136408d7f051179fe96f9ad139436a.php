<?php $__env->startSection('title'); ?>
Customers
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Customers</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(route('admin.dashboard')); ?>"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Customers</li>
        <li class="active">Customers List</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
     <div class="col-12">
     <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Customers List
                </h4>
                <div class="float-right">
                    <a href="<?php echo e(route('admin.customer.customers.create')); ?>" class="btn btn-sm btn-secondary"><span class="fa fa-plus"></span> <?php echo app('translator')->get('button.create'); ?></a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                 <?php echo $__env->make('admin.customer.customers.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 
            </div>
        </div>
        </div>
 </div>
 </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/customer/customers/index.blade.php ENDPATH**/ ?>