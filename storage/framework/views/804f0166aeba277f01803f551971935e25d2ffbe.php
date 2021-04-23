<?php $__env->startSection('title'); ?>
    Gallery
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <!-- Add fancyBox main CSS files -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/fancybox/css/jquery.fancybox.css')); ?>"
          media="screen"/>
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('vendors/fancybox/helpers/css/jquery.fancybox-buttons.css')); ?>"/>
    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('vendors/fancybox/helpers/css/jquery.fancybox-thumbs.css')); ?>"/>


    <style>
        #fancybox-thumbs ul li a{

            background-image: url('<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>');
        }
        #fancybox-thumbs ul li img {
            display: block;
            position: relative;
            border: 0;
            padding: 0;
            max-width: none !important; /* ADD THIS LINE*/
        }
    </style>

    <!--page level css end-->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>Gallery</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Gallery</a>
            </li>
            <li class="active">
                Gallery
            </li>
        </ol>
    </section>
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card tabtop">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">
                            <i class="livicon" data-name="image" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Gallery
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-lg">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#tab_1"  class="nav-link active" data-toggle="tab">Basic Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_2" class="nav-link" data-toggle="tab">Standard Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_3"  class="nav-link" data-toggle="tab">Button Helper</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_4" class="nav-link" data-toggle="tab">Thubnail Helper</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="clothing-nav-content">

                                    <div class="tab-pane fade show active p-3" id="tab_1">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-b"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-c"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click on popup for exit">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6 col-sm-3 p-2">
                                                <a class="fancybox-effects-a"
                                                   href="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                   title="Click aside to exit popup">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/1.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /basic gallery -->
                                    <div class="tab-pane  fade p-3" id="tab_2">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12 col-12 ">
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 1">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 2">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 3">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 1">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 2">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 3">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 1">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 ol-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 2">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                                </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 3">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 1">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 2">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 3">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                                </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox"
                                                   href="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                   data-fancybox-group="gallery" title="Image Title 4">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/2.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                        </div>
                                    <!-- /standard gallery -->
                                    <div class="tab-pane fade p-3" id="tab_3">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-buttons" data-fancybox-group="button"
                                                   href="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/3.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                            </div>
                                        </div>
                                    <!-- /button helper gallery -->
                                    <div class="tab-pane fade p-3" id="tab_4">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12 col-12">
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 col-sm-3 p-2">
                                                <a class="fancybox-thumbs" data-fancybox-group="thumb"
                                                   href="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>">
                                                    <img src="<?php echo e(asset('img/img_holder/gal/4.jpg')); ?>"
                                                         class="img-fluid gallery-style" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                    <!-- /thumnail helper gallery -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- row-->
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript"
            src="<?php echo e(asset('vendors/fancybox/js/jquery.mousewheel.pack.js')); ?>"></script>
    <script type="text/javascript"
            src="<?php echo e(asset('vendors/fancybox/js/jquery.fancybox.pack.js')); ?>"></script>
    <script type="text/javascript"
            src="<?php echo e(asset('vendors/fancybox/helpers/js/jquery.fancybox-buttons.js')); ?>"></script>
    <script type="text/javascript"
            src="<?php echo e(asset('vendors/fancybox/helpers/js/jquery.fancybox-thumbs.js')); ?>"></script>
    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript"
            src="<?php echo e(asset('vendors/fancybox/helpers/js/jquery.fancybox-media.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/pages/jquery_fancy_thumb.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('js/pages/gallery.js')); ?>"></script>


<script>
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
        $("#clothing-nav-content .tab-pane").removeClass("show active");
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/gallery.blade.php ENDPATH**/ ?>