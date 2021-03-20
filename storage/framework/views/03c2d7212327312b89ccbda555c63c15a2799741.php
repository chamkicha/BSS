<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Welcome to Josh Frontend</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/all.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('vendors/iCheck/css/all.css')); ?>" />
    <link href="<?php echo e(asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/buttons.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/frontend/login.css')); ?>">
    <!--end of page level css-->
</head>

<body>
    <div class="container">
        <!--Content Section Start -->
        <div class="row">
            <div class="box animation flipInX">
                <div class="box1">
                    <div class="text-center">
                        <img src="<?php echo e(asset('images/josh-new.png')); ?>" alt="logo" class="img-fluid mar"></div>
                    <h3 class="text-primary">Log In</h3>
                    <!-- Notifications -->
                    <div id="notific">
                        <?php echo $__env->make('notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <form action="<?php echo e(route('login')); ?>" class="omb_loginForm" autocomplete="off" method="POST">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group <?php echo e($errors->first('email', 'has-error')); ?>">
                            <label class="sr-only">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                value="<?php echo old('email'); ?>" required>
                            <span class="help-block"><?php echo e($errors->first('email', ':message')); ?></span>
                        </div>
                        <div class="form-group <?php echo e($errors->first('password', 'has-error')); ?>">
                            <label class="sr-only">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <span class="help-block"><?php echo e($errors->first('password', ':message')); ?></span>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember-me"> Remember Password
                            </label>

                        </div>
                        <input type="submit" class="btn btn-block btn-primary" value="Log In">
                        Don't have an account? <a href="<?php echo e(route('register')); ?>"><strong> Sign Up</strong></a>
                    </form>
                    <br />
                    <div class="row">
                        <div class="col-lg-12 text-center social_login mb-3">
                            <a class="btn btn-block btn-social btn-facebook social" href="<?php echo e(url('/facebook')); ?>">
                                <i class="fab fa-facebook-f"></i> Sign in with Facebook
                            </a>
                            <a class="btn btn-block btn-social btn-google social" href="<?php echo e(url('/google')); ?>">
                                <i class="fab fa-google-plus-g"></i> Sign in with Google
                            </a>
                            <a class="btn btn-block btn-social btn-linkedin social" href="<?php echo e(url('/linkedin')); ?>">
                                <i class="fab fa-linkedin-in"></i> Sign in with LinkedIn
                            </a>
                        </div>
                    </div>
                    <div class="bg-transparent animation flipInX">
                        <a href="<?php echo e(route('forgot-password')); ?>">Forgot Password?</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- //Content Section End -->
    </div>
    <!--global js starts-->
    <script type="text/javascript" src="<?php echo e(asset('js/frontend/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>" type="text/javascript">
    </script>
    <script type="text/javascript" src="<?php echo e(asset('vendors/iCheck/js/icheck.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/frontend/login_custom.js')); ?>"></script>
    <!--global js end-->
</body>

</html>
<?php /**PATH C:\xampp\htdocs\BSS\resources\views/login.blade.php ENDPATH**/ ?>