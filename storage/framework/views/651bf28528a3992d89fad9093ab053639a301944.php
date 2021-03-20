<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('roles/title.management'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('roles/title.management'); ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    <?php echo app('translator')->get('general.dashboard'); ?>
                </a>
            </li>
            <li><a href="#"> <?php echo app('translator')->get('roles/title.roles'); ?></a></li>
            <li class="active"><?php echo app('translator')->get('roles/title.roles_list'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white clearfix">
                        <span class=" float-left"><i class="livicon" data-name="users" data-size="16"
                                                             data-loop="true" data-c="#fff" data-hc="white"></i>
                            <?php echo app('translator')->get('roles'); ?>
                        </span>
                        <div class="float-right">
                            <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-sm btn-secondary"><span
                                        class="fa fa-plus"></span> <?php echo app('translator')->get('button.create'); ?></a>
                        </div>
                    </div>
                    <br/>
                    <div class="card-body">
                        <?php if($roles->count() >= 1): ?>
                            <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive ">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('roles/table.id'); ?></th>
                                        <th><?php echo app('translator')->get('roles/table.name'); ?></th>
                                        <th><?php echo app('translator')->get('roles/table.users'); ?></th>
                                        <th><?php echo app('translator')->get('roles/table.created_at'); ?></th>
                                        <th><?php echo app('translator')->get('roles/table.actions'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo $role->id; ?></td>
                                            <td><?php echo $role->name; ?></td>
                                            <td><?php echo $role->users()->count(); ?></td>
                                            <td><?php echo $role->created_at->diffForHumans(); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('admin.roles.edit', $role->id)); ?>">
                                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                                                       data-c="#428BCA" data-hc="#428BCA" title="edit role"></i>
                                                </a>
                                                <!-- let's not delete 'Admin' role by accident -->
                                                <?php if($role->id !== 1): ?>
                                                    <?php if($role->users()->count()): ?>
                                                        <a href="#" data-toggle="modal" data-target="#users_exists"
                                                           data-name="<?php echo $role->name; ?>" class="users_exists">
                                                            <i class="livicon" data-name="warning-alt" data-size="18"
                                                               data-loop="true" data-c="#f56954" data-hc="#f56954"
                                                               title="<?php echo app('translator')->get('roles/form.users_exists'); ?>"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('admin.roles.confirm-delete', $role->id)); ?>"
                                                           data-toggle="modal" data-id="<?php echo e($role->id); ?>"
                                                           data-target="#delete_confirm">
                                                            <i class="livicon" data-name="remove-alt" data-size="18"
                                                               data-loop="true" data-c="#f56954" data-hc="#f56954"
                                                               title="<?php echo app('translator')->get('roles/form.delete_role'); ?>"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <?php echo app('translator')->get('general.noresults'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>    <!-- row-->
    </section>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

    <div class="modal fade" id="users_exists" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php echo app('translator')->get('roles/message.users_exists'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this Role? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    
    
    

    
    
    


    <script>
        var $url_path = '<?php echo url('/'); ?>';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var $recipient = button.data('id');
            var modal = $(this)
            modal.find('.modal-footer a').prop("href", $url_path + "/admin/roles/" + $recipient + "/delete");
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>