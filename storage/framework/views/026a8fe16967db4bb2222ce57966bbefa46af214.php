<!DOCTYPE html>
<?php
    App::setLocale(getUserLanguage());
?>
    <html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset(generalSetting()->favicon)); ?>" type="image/png"/>
    <title><?php echo app('translator')->get('lang.reset'); ?> <?php echo app('translator')->get('lang.password'); ?> </title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>

    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css"/>

    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@activeStyle()->path_main_style); ?>"/>
    <?php endif; ?>

    <style>
    html {
    visibility: visible;
    }
    </style>
</head>
<body class="login admin hight_100" style="<?php echo e($css); ?>">

<!--================ Start Login Area =================-->
<section class="login-area up_login">
    <div class="container">
        <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
        <div class="row login-height justify-content-center align-items-center">
            <div class="col-lg-5 col-md-8">
                <div class="form-wrap text-center">
                    <div class="logo-container">
                        <a href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset(@$setting->logo)); ?>" alt="" class="logoimage">
                        </a>
                    </div>
                    <div class="text-center">
                        <h5 class="text-uppercase font-bold"><?php echo app('translator')->get('lang.reset'); ?> <?php echo app('translator')->get('lang.password'); ?></h5>
                        <?php if(session()->has('message-success') != ""): ?>
                            <?php if(session()->has('message-success')): ?>
                                <p class="text-success"><?php echo e(session()->get('message-success')); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->has('message-danger') != ""): ?>
                            <?php if(session()->has('message-danger')): ?>
                                <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                    <form method="POST" class="" action="<?php echo e(route('email/verify')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group input-group mb-4 mx-3">
								<span class="input-group-addon">
									<i class="ti-email"></i>
								</span>
                            <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email"
                                   name='email' placeholder="<?php echo app('translator')->get('lang.enter'); ?> <?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.address'); ?>"/>
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>


                        <div class="form-group mt-30 mb-30">
                            <button type="submit" class="primary-btn fix-gr-bg">
                                <span class="ti-lock mr-2"></span>
                                <?php echo app('translator')->get('lang.next'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Start End Login Area =================-->

<!--================ Footer Area =================-->
<footer class="footer_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <p><?php echo e(generalSetting()->copyright_text); ?></p>
            </div>
        </div>
    </div>
</footer>
<!--================ End Footer Area =================-->


<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
<script>
    $('.primary-btn').on('click', function (e) {
        // Remove any old one
        $('.ripple').remove();

        // Setup
        var primaryBtnPosX = $(this).offset().left,
            primaryBtnPosY = $(this).offset().top,
            primaryBtnWidth = $(this).width(),
            primaryBtnHeight = $(this).height();

        // Add the element
        $(this).prepend("<span class='ripple'></span>");

        // Make it round!
        if (primaryBtnWidth >= primaryBtnHeight) {
            primaryBtnHeight = primaryBtnWidth;
        } else {
            primaryBtnWidth = primaryBtnHeight;
        }

        // Get the center of the element
        var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
        var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

        // Add the ripples CSS and start the animation
        $('.ripple')
            .css({
                width: primaryBtnWidth,
                height: primaryBtnHeight,
                top: y + 'px',
                left: x + 'px'
            })
            .addClass('rippleEffect');
    });
</script>
</body>
</html>
<?php /**PATH /var/www/ssc/resources/views/auth/recovery_password.blade.php ENDPATH**/ ?>