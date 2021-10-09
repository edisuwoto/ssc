<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $base_path = 'public/vendor/spondonit';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo e(isset($title) ? $title .' | '. config('app.name') :  config('app.name')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset($base_path . '/img/favicon.png')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset($base_path . '/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($base_path . '/css/spondonit.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($base_path . '/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($base_path . '/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($base_path . '/css/parsley.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>


</head>

<body class="admin">
    <div class="preloader">
        <div class="loader_img">
            <img src="<?php echo e(asset($base_path . '/loader.gif')); ?>" alt="loading..." height="64" width="64">
            <h2>Please Wait</h2>
        </div>
    </div>
    <div class="container">
        <div class="col-md-8 offset-2  mt-40">
            <ul id="progressbar">
                <li class="<?php echo e(active_progress_bar(['service.install', 'service.preRequisite','service.license',  'service.database', 'service.user', 'service.done'])); ?>"><?php echo e(__('service::install.welcome')); ?></li>
                <li class="<?php echo e(active_progress_bar(['service.preRequisite','service.license',  'service.database', 'service.user', 'service.done'])); ?> <?php echo e(active_link('service.license')); ?>"><?php echo e(__('service::install.environment')); ?></li>
                <li class="<?php echo e(active_progress_bar(['service.license',  'service.database', 'service.user', 'service.done'])); ?>"><?php echo e(__('service::install.license')); ?></li>
                <li class="<?php echo e(active_progress_bar([ 'service.database', 'service.user', 'service.done'])); ?>"><?php echo e(__('service::install.database')); ?></li>
                <li class="<?php echo e(active_progress_bar([ 'service.user', 'service.done'])); ?>"><?php echo e(__('service::install.admin_setup')); ?></li>
                <li class="<?php echo e(active_progress_bar([ 'service.done'])); ?>"><?php echo e(__('service::install.done')); ?></li>

            </ul>
            <div class="card" id="content">
                <?php $__env->startSection('content'); ?>

                <?php echo $__env->yieldSection(); ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/jquery-3.6.0.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset($base_path . '/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset($base_path . '/js/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset($base_path . '/js/function.js')); ?>"></script>
    <script src="<?php echo e(asset($base_path . '/js/common.js')); ?>"></script>

    <?php if(session("message")): ?>
    <script>
        toastr.<?php echo e(session('status')); ?>('<?php echo e(session("message")); ?>', '<?php echo e(ucfirst(session('status', 'error'))); ?>');
    </script>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH /var/www/ssc/resources//views/vendors/service/layouts/app_install.blade.php ENDPATH**/ ?>