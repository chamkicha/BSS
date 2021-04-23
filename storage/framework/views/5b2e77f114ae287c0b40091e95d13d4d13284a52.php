<?php $__env->startSection('title'); ?>
    Import New Users ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/import_data.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
      <section class="content-header">
        <!--section starts-->
        <h1>Import New Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">Import New Users</li>
        </ol>
    </section>
        <!-- Main content -->
        <section class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title float-left my-2">Import New Users</h3>
                             <a href="<?php echo e(URL::to('admin/download_users/xlsx')); ?>"><button class="btn btn-success float-right">Download</button></a>
                        </div>


                        <div class="card-body">
                            <form method="POST" action="<?php echo e(URL('admin/bulk_import_users')); ?>"  files="true" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="file" name="import_file"  accept=".xlsx" />

                                <button class="btn btn-primary import btn-block" type="submit">Import File</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/users/import_users.blade.php ENDPATH**/ ?>