<?php $__env->startSection('title'); ?>
    Vector Maps
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <link href="<?php echo e(asset('css/pages/jqvmap.css')); ?>" media="screen" rel="stylesheet" type="text/css"/>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-6 col-12 col-md-6 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-success text-white">
                        <span>World</span>
                        <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <div id="vmapworld" class="map_size" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-info text-white">
                        <span>USA</span>
                        <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <div id="vmapusa" class="map_size" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-warning text-white">
                        <span>Europe</span>
                        <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <div id="vmapeurope" class="map_size" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-danger text-white ">
                        <span>Germany</span>
                        <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <div id="vmapgermany" class="map_size" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-12 col-md-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        <span>Russia</span>
                        <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <div id="vmaprussia" class="map_size" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </section>
    <!--page wrapper-->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.world.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.usa.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.europe.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.germany.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.russia.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/js/jquery.vmap.sampledata.js')); ?>"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#vmapworld').vectorMap({
                map: 'world_en',
                backgroundColor: '#ffffff',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#045707', '#84F088'],
                normalizeFunction: 'polynomial'
            });
            jQuery('#vmaprussia').vectorMap({
                map: 'russia_en',
                backgroundColor: '#ffffff',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#094980', '#ACD2F2'],
                normalizeFunction: 'polynomial'
            });
            jQuery('#vmapgermany').vectorMap({
                map: 'germany_en',
                backgroundColor: '#ffffff',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#d84a38', '#F5B4AB'],
                normalizeFunction: 'polynomial'
            });
            jQuery('#vmapeurope').vectorMap({
                map: 'europe_en',
                backgroundColor: '#ffffff',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#ffb848', '#F5D5A4'],
                normalizeFunction: 'polynomial'
            });
            jQuery('#vmapusa').vectorMap({
                map: 'usa_en',
                backgroundColor: '#ffffff',
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#5bc0de', '#D6DBDE'],
                normalizeFunction: 'polynomial'
            });
        });
        $('.map_size').closest('.card-body').on('resize', function () {
            $(window).trigger('resize');
        });
        $('#slim1').slimscroll({
            height: '500px',
            size: '3px',
            color: '#D84A38',
            opacity: 1
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/vectormaps.blade.php ENDPATH**/ ?>