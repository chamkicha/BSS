<?php $__env->startSection('title'); ?>
Advanced Maps
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/gmaps/css/examples.css')); ?>" />
<link href="<?php echo e(asset('css/pages/advancedmaps_custom.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content pr-3 pl-3">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-3">
            <div class="card ">
                <div class="card-header bg-primary text-white">
                    <span><i class="livicon" data-name="search" data-c="#fff" data-hc="#fff" data-size="18"
                            data-loop="true"></i> Search Place</span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" id="geocoding_form">
                        <div class="input pl-4">
                            <input type="text" id="address" name="address" size="28" />
                            <input type="submit" value="Search" class="search_margin" />
                        </div>
                    </form>
                    <br />
                    <div id="map1" class="gmap responsive_map"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card ">
                <div class="card-header bg-danger text-white ">
                    <span><i class="livicon" data-name="search" data-c="#fff" data-hc="#fff" data-size="18"
                            data-loop="true"></i> Search Routes</span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <div id="map" class="large responsive_map"></div>
                    <div class="row">
                        <div class="col-md-12 mt-15 ml-4">
                            <a href="#" class="btn btns btn-small btn-primary btn_margin" id="get_route">Get route</a>
                            <a href="#" class="btn btns btn-small btn-primary btn_margin" id="back">&laquo; Back</a>
                            <a href="#" class="btn btns btn-small btn-primary btn_margin" id="forward">Forward
                                &raquo;</a>
                        </div>
                    </div>
                    <div class="row ml-1">
                        <ul id="steps"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
<script type="text/javascript"
    src="http://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=<?php echo e(env('GOOGLE_MAPS_API_KEY')); ?>">
</script>
<script type="text/javascript" src="<?php echo e(asset('vendors/gmaps/js/gmaps.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/pages/adv_maps.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/advancedmaps.blade.php ENDPATH**/ ?>