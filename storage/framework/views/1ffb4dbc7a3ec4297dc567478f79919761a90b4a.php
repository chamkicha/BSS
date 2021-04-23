<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('roles/title.edit'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            <?php echo app('translator')->get('roles/title.edit'); ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    <?php echo app('translator')->get('general.dashboard'); ?>
                </a>
            </li>
            <li><?php echo app('translator')->get('roles/title.roles'); ?></li>
            <li class="active"><?php echo app('translator')->get('roles/title.edit'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                                  data-c="#fff" data-hc="white"></i>
                            <?php echo app('translator')->get('roles/title.edit'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php if($role): ?>
                        <?php echo Form::model($role, ['url' => URL::to('admin/roles/'. $role->id), 'method' => 'put', 'class' => 'form-horizontal']); ?>

                        <!-- CSRF Token -->
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group <?php echo e($errors->first('name', 'has-error')); ?>">
                                <div class="row">
                                    <label for="title" class="col-sm-2 control-label">
                                        <?php echo app('translator')->get('roles/form.name'); ?>
                                    </label>
                                    <div class="col-sm-5">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder=<?php echo app('translator')->get('roles/form.name'); ?> value="<?php echo old('name', $role->
                                    name); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo $errors->first('name', '<span class="help-block">:message</span>'); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="slug" class="col-sm-2 control-label"><?php echo app('translator')->get('roles/form.slug'); ?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="<?php echo $role->slug; ?>" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="offset-sm-2 col-sm-4">
                                        <a class="btn btn-danger" href="<?php echo e(route('admin.roles.index')); ?>">
                                            <?php echo app('translator')->get('button.cancel'); ?>
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <?php echo app('translator')->get('button.save'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        <?php else: ?>
                            <h1><?php echo app('translator')->get('roles/message.error.no_role_exists'); ?></h1>
                            <a class="btn btn-danger" href="<?php echo e(route('admin.roles.index')); ?>">
                                <?php echo app('translator')->get('button.back'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/roles/edit.blade.php ENDPATH**/ ?>