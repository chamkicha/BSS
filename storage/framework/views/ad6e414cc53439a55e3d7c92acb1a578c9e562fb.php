<?php $__env->startSection('title'); ?>
    Deleted users
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('vendors/datatables/css/dataTables.bootstrap4.css')); ?>"/>
    <link href="<?php echo e(asset('css/pages/tables.css')); ?>" rel="stylesheet" type="text/css"/>

<?php $__env->stopSection(); ?>
<!-- end page css -->


<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>Deleted users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> Users</a></li>
            <li class="active">Deleted users</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header bg-warning text-white">
                        <span>
                            <i class="livicon" data-name="users-remove" data-size="18" data-c="#ffffff"
                               data-hc="#ffffff"></i>
                            Deleted Users List
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr class="filters">
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User E-mail</th>
                                    <th>Deleted At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->deleted_at->diffForHumans(); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.restore.user', $user->id)); ?>"><i class="livicon"
                                                                                                      data-name="user-flag"
                                                                                                      data-c="#6CC66C"
                                                                                                      data-hc="#6CC66C"
                                                                                                      data-size="18"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>


<?php $__env->startSection("footer_scripts"); ?>
    <script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/jquery.dataTables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/dataTables.bootstrap4.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/deleted_users.blade.php ENDPATH**/ ?>