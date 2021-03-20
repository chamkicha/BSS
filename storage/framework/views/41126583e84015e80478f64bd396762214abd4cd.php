<?php $__env->startSection('title'); ?>
Color Picker
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>    

<link href="<?php echo e(asset('vendors/colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet" type="text/css"/>
<style>
    .colorpicker-right:after {
        top: -16px;
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content-header">
                <!--section starts-->
                <h1>Color picker slider</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">UI Features</a>
                    </li>
                    <li class="active">Color picker slider</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content pr-3 pl-3">
                <!--main content-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header bg-primary text-white">
                                <span>
                                    <i class="livicon" data-name="eyedropper" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Color Picker
                                </span>
                                <span class="float-right ">
                                    <i class="fa fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="card-body" id="card-bg">
                                <div class="paddingtopbottom_5px">
                                    <div class="form-group">
                                        <label class="control-label">Color picker with Hexa code:</label>
                                        <input type="text" id="picker1" class="form-control" value="#5367ce" />
                                    </div>
                                </div>
                                
                                    
                                    
                                        
                                        
                                    
                                
                                
                                    
                                    
                                        
                                        
                                    
                                
                                <div class="paddingtopbottom_5px">
                                    <div class="form-group">
                                        <label class="control-label"> Bootstrap Colors Picker</label>
                                        <input type="text" data-format="hex" class="form-control demo" id="picker4" value="success"/>
                                    </div>
                                </div>
                                <div class="paddingtopbottom_5px">
                                    <a href="#" class="btn small text-primary" id="bg-picker" data-color="rgb(255, 255, 255)"><strong>Change
                                            background color</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--main content ends-->
            </section>
            <!-- content -->
        
    <?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    
    <!--color picker slider-->

<script src="<?php echo e(asset('vendors/colorpicker/js/bootstrap-colorpicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/pages/color-picker.js')); ?>" type="text/javascript"></script>
<script>
    $(function () {
        $('#picker2').colorpicker({
            format: null
        });
    });
</script>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/color.blade.php ENDPATH**/ ?>