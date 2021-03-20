<?php $__env->startSection('title'); ?>
Products
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
     <h1>Products Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="<?php echo e(route('admin.dashboard')); ?>"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Products</li>
         <li class="active">Edit Product </li>
     </ol>
    </section>
    <section class="content">
    <div class="container">
      <div class="row">
             <div class="col-12">
              <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit  Product
                        </h4></div>
                    <br />
                <div class="card-body">
                <?php echo Form::model($product, ['route' => ['admin.product.products.update', collect($product)->first() ], 'method' => 'patch']); ?>


                <?php echo $__env->make('admin.product.products.fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo Form::close(); ?>

                </div>
              </div>
           </div>
        </div>
    </div>
   </section>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/product/products/edit.blade.php ENDPATH**/ ?>