<?php $__env->startSection('title'); ?>
    Drop Zone
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <link href="<?php echo e(asset('vendors/dropzone/css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        .dropzone .dz-preview .dz-image img {
            width :100%;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>File Drop Zone</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">Laravel Examples</a></li>
            <li class="active">File Drop Zone</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    This plugins works only on Latest Chrome, Firefox, Safari, Opera & Internet Explorer 10.
                </div>
                <!-- First Basic Table strats here-->
                <div class="card " style="overflow-y:auto; overflow-x: hidden">
                    <div class="card-header bg-info text-white">
                        <span>
                            <i class="livicon" data-name="upload-alt" data-size="20" data-loop="true" data-c="#fff" data-hc="white"></i>
                            File Drop Zone
                        </span>
                    </div>
                    <div class="card-body" style="padding:0px !important;">
                        <div class="col-md-12" style="padding:30px;">
                            <?php echo Form::open(['url' => URL::to('admin/file/create'), 'method' => 'post', 'id'=>'myDropzone','class' => 'dropzone', 'files'=> true]); ?>

                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

    <script type="text/javascript" src="<?php echo e(asset('vendors/dropzone/js/dropzone.js')); ?>" ></script>
    <script>
        var FormDropzone = function() {
            return {
                //main function to initiate the module
                init: function() {
                    Dropzone.options.myDropzone = {
                        init: function() {
                            this.on("success", function(file,responseText) {
                                var obj = jQuery.parseJSON(responseText);
                                file.id = obj.id;
                                file.filename = obj.filename;
                                // Create the remove button
                                var removeButton = Dropzone.createElement("<button style='margin: 10px 0 0 15px;'>Remove file</button>");

                                // Capture the Dropzone instance as closure.
                                var _this = this;

                                // Listen to the click event
                                removeButton.addEventListener("click", function(e) {
                                    // Make sure the button click doesn't submit the form:
                                    e.preventDefault();
                                    e.stopPropagation();

                                    $.ajax({
                                        url: "file/delete",
                                        type: "DELETE",
                                        data: { "id" : file.id, "_token": '<?php echo e(csrf_token()); ?>' }
                                    });
                                    // Remove the file preview.
                                    _this.removeFile(file);
                                });

                                // Add the button to the file preview element.
                                file.previewElement.appendChild(removeButton);

                            });

                        }
                    }
                }
            };
        }();
        jQuery(document).ready(function() {

            FormDropzone.init();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/dropzone.blade.php ENDPATH**/ ?>