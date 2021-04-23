<?php $__env->startSection('title'); ?>
    Google Maps
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/gmaps/css/examples.css')); ?>"/>
    <link href="<?php echo e(asset('css/pages/googlemaps_custom.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>Google Maps</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">Maps</a></li>
            <li class="active">Google Maps</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        <span>Basic</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-top" class="gmap"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <span>Terrain</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-terrain" class="gmap"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <span>Satellite</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-satellite" class="gmap"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-warning text-white">
                        <span>Markers</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-markers" class="gmap"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-danger text-white ">
                        <span>Styled Maps</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-styled" class="gmap"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 my-3">
                <!-- Basic charts strats here-->
                <div class="card ">
                    <div class="card-header bg-success text-white">
                        <span>Map Types</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-up showhide clickable"></i>
                                    <i class="fa fa-times removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="card-body" style="padding:10px !important;">
                        <div id="gmap-types" class="gmap"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?libraries=geometry&key=<?php echo e(env('GOOGLE_MAPS_API_KEY')); ?>">
    </script>
    <script type="text/javascript" src="<?php echo e(asset('vendors/gmaps/js/gmaps.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/pages/custommaps.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/googlemaps.blade.php ENDPATH**/ ?>