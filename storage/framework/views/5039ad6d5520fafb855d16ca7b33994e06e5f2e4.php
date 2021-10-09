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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($base_path . '/css/sweetalert2.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($base_path . '/css/sweet_alert2.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>


</head>

<body class="admin">
    <div class="container">
        <div class="col-md-8 offset-2  mt-40">
            <div class="card" id="content">
                <?php $__env->startSection('content'); ?>

                <?php echo $__env->yieldSection(); ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/jquery-3.6.0.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/bootstrap.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/toastr.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/parsley.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/sweetalert2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/function.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset($base_path . '/js/common.js')); ?>"></script>

    <?php if(session("message")): ?>
    <script>
        toastr. <?php echo e(session('status')); ?>('<?php echo e(session("message")); ?>', '<?php echo e(ucfirst(session('status ', 'error '))); ?>');
    </script>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH /var/www/ssc/resources//views/vendors/service/layouts/app.blade.php ENDPATH**/ ?>