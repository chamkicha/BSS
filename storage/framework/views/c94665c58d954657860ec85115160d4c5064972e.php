<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('news/title.newslist'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/datatables/css/dataTables.bootstrap4.css')); ?>"/>
    <link href="<?php echo e(asset('css/pages/tables.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('news/title.newslist'); ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    <?php echo app('translator')->get('general.dashboard'); ?>
                </a>
            </li>
            <li><a href="#"><?php echo app('translator')->get('news/title.news'); ?></a></li>
            <li class="active"><?php echo app('translator')->get('news/title.newslist'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-12">
            <div class="card ">
                <div class="card-header clearfix bg-primary text-white">
                    <span class="float-left"><i class="livicon" data-name="users" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        <?php echo app('translator')->get('news/title.newslist'); ?>
                    </span>
                    <div class="float-right">
                        <a href="<?php echo e(URL::to('admin/news/create')); ?>" class="btn btn-sm btn-secondary"><span
                                    class="fa fa-plus"></span> <?php echo app('translator')->get('button.create'); ?></a>
                    </div>
                </div>
                <br/>
                <div class="card-body">
                    <table class="table table-bordered" id="table">
                            <thead>
                            <tr class="filters">
                                <th><?php echo app('translator')->get('news/table.id'); ?></th>
                                <th><?php echo app('translator')->get('news/table.title'); ?></th>
                                <th><?php echo app('translator')->get('news/table.created_at'); ?></th>
                                <th style="width: 70px"><?php echo app('translator')->get('news/table.actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        </div><!-- row-->
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/jquery.dataTables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendors/datatables/js/dataTables.bootstrap4.js')); ?>"></script>

    <script>
        $(function () {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo route('admin.news.data'); ?>',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });
            table.on('draw', function () {
                $('.livicon').each(function () {
                    $(this).updateLivicon();
                });
            });
        });

    </script>
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete News</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this news category? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <script>
        $(function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });

        var $url_path = '<?php echo url('/'); ?>';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
            var button = $(event.relatedTarget);
            var $recipient = button.data('id');
            var modal = $(this);
            modal.find('.modal-footer a').prop("href",$url_path+"/admin/news/"+$recipient+"/delete");
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/news/index.blade.php ENDPATH**/ ?>