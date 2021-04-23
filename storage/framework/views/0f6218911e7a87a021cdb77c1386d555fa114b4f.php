<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>404 page | Welcome to Josh Frontend</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- global level css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- end of globallevel css-->
    <!-- page level styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/frontend/404.css')); ?>" />
    <!-- end of page level styles-->
</head>

<body>

    <div id="animate" class="row">
        <div class="number">4</div>
        <div class="icon"> <i class="livicon" data-name="pacman" data-size="105" data-c="#f6c500" data-hc="#f1b21d" data-eventtype="click" data-iteration="15"></i>
        </div>
        <div class="number">4</div>
    </div>
    <div class="hgroup">
        <h1>Page Not Found</h1>
        <h2>It seems that page you are looking for no longer exists.</h2>
        <a href="<?php echo e(route('home')); ?>">
            <button type="button" class="btn btn-primary button-alignment">Home</button>
        </a>
    </div>
    <!-- global js -->
    <script src="<?php echo e(asset('js/frontend/jquery.min.js')); ?>" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('js/frontend/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <!--livicons-->
    <script src="<?php echo e(asset('js/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/livicons-1.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/holder.js')); ?>"></script>
    <!-- begining of page level js-->
    <script src="<?php echo e(asset('js/frontend/404.js')); ?>"></script>
    <!-- end of page level js-->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/errors/404.blade.php ENDPATH**/ ?>