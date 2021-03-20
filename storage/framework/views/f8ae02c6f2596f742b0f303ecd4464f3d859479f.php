<?php $__env->startSection('title'); ?>
Database Charts
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content-header">
    <!--section starts-->
    <h1>Database Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#">Laravel Charts</a>
        </li>
        <li class="active">Database Charts</li>
    </ol>
</section>
<!-- Main content -->
<section class="content pr-3 pl-3">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 my-3">
            <div class="card">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Bar chart (by age)
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <?php echo $bar->container(); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12 my-3">
            <!-- Stack charts strats here-->
            <div class="card">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Bar chart (by country)
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <div class="app">

                        <?php echo $country->container(); ?>


                    </div>
                    <!-- End Of Main Application -->

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 my-3">
            <div class="card ">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Pie Chart
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <?php echo $pie->container(); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 my-3">
            <div class="card ">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Donut chart
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <?php echo $donut->container(); ?>

                </div>
            </div>
        </div>


        <div class="col-lg-12 my-3">
            <div class="card">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Area Chart
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <?php echo $area->container(); ?>

                </div>
            </div>
        </div>

        <div class="col-lg-12 my-3">
            <div class="card ">
                <div class="card-header bg-primary text-white ">
                    <span>
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff"
                            data-hc="#fff"></i> Line Chart
                    </span>
                    <span class="float-right">
                        <i class="fa fa-chevron-up showhide clickable"></i>
                        <i class="fa fa-times removepanel clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <?php echo $line->container(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('vendors/frappe/frappe-charts.min.iife.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/highcharts/highcharts.js')); ?>" charset="utf-8"></script>
<script src="<?php echo e(asset('vendors/chartjs/js/Chart.js')); ?>" charset="utf-8"></script>
<?php echo $bar->script(); ?>

<?php echo $country->script(); ?>

<?php echo $pie->script(); ?>

<?php echo $donut->script(); ?>

<?php echo $area->script(); ?>

<?php echo $line->script(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/database_charts.blade.php ENDPATH**/ ?>