<!DOCTYPE html>
<?php
$generalSetting = generalSetting();
?>
<?php App::setLocale(userLanguage()); ?>

<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(userRtlLtl()==1): ?> dir="rtl" class="rtl" <?php endif; ?>>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php if( ! is_null(schoolConfig()->favicon )): ?>
    <link rel="icon" href="<?php echo e(asset(schoolConfig()->favicon)); ?>" type="image/png" />
    <?php else: ?>
    <link rel="icon" href="<?php echo e(asset('public/uploads/settings/favicon.png')); ?>" type="image/png" />
    <?php endif; ?>

    <!-- <title><?php echo e(@schoolConfig()->school_name ? @schoolConfig()->school_name : 'Infix Edu ERP'); ?> |
        <?php echo e(schoolConfig()->site_title ? schoolConfig()->site_title : 'School Management System'); ?>

    </title> -->
    <title><?php echo e(@schoolConfig()->school_name ? @schoolConfig()->school_name : 'Infix Edu ERP'); ?> |
        <?php echo $__env->yieldContent('title'); ?>
    </title>
    
    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    <!-- Bootstrap CSS -->
    <?php if(userRtlLtl() ==1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css" />
    <?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <?php endif; ?>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/flaticon.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/toastr.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/chat/css/notification.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/editor/summernote-bs4.css">

    <?php if(request()->route()->getPrefix() == '/chat'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/chat/css/style.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldContent('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/css/loade.css')); ?>" />

    <?php if(userRtlLtl() ==1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/infix.css" />
    <?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(activeStyle()->path_main_style); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(activeStyle()->path_infix_style); ?>" />
    <?php endif; ?>

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: {
                    {
                    @activeStyle()->primary_color2
                }
            }

             !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: {
                    {
                    @activeStyle()->primary_color2
                }
            }

             !important;
        }

        ::placeholder {
            color: {
                    {
                    @activeStyle()->primary_color
                }
            }

             !important;
        }

        .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom {
            z-index: 99999999999 !important;
            background: #fff !important;
        }

        .input-effect {
            float: left;
            width: 100%;
        }
    </style>

    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js">
</script>
    <script>
        window.Laravel = {
            "baseUrl": '<?php echo e(url('/')); ?>'+'/',
            "current_path_without_domain": '<?php echo e(request()->path()); ?>'
        }
    </script>

    <script>
        window._locale = '<?php echo e(app()->getLocale()); ?>';
        window._translations = <?php echo cache('translations'); ?>;
    </script>
</head>
<?php
if (empty(dashboardBackground())) {
    $css = "background: url('/public/backEnd/img/body-bg.jpg')  no-repeat center; background-size: cover; ";
} else {
    if (!empty(dashboardBackground()->image)) {
        $css = "background: url('" . url(dashboardBackground()->image) . "')  no-repeat center; background-size: cover; ";
    } else {
        $css = "background:" . dashboardBackground()->color;
    }
}
?>
<?php

if(session()->has('homework_zip_file')){
    $file_path='public/uploads/homeworkcontent/'.session()->get('homework_zip_file');
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}
?>

<body class="admin" style=" <?php if(@activeStyle()->id==1): ?> <?php echo e($css); ?> <?php else: ?> background:<?php echo e(@activeStyle()->dashboardbackground); ?> !important; <?php endif; ?> ">
    <?php

        $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );

        if (file_exists($generalSetting->logo)) {
        $tt = file_get_contents(url('/').'/'.$generalSetting->logo, false, stream_context_create($arrContextOptions));
        } else {
        $tt = file_get_contents(url('/').'/public/uploads/settings/logo.png', false, stream_context_create($arrContextOptions));
        }
    ?>
    <input type="text" hidden value="<?php echo e(base64_encode($tt)); ?>" id="logo_img">
    <input type="text" hidden value="<?php echo e($generalSetting->school_name); ?>" id="logo_title">
    <div class="main-wrapper" style="min-height: 600px">
        <input type="hidden" id="nodata" value="<?php echo app('translator')->get('lang.no_data_available_in_table'); ?>">
        <!-- Sidebar  -->
        <?php if(moduleStatusCheck('SaasSubscription')== TRUE): ?>
        <?php if(\Modules\SaasSubscription\Entities\SmPackagePlan::isSubscriptionAutheticate()): ?>
        <?php echo $__env->make('backEnd.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
        <?php echo $__env->make('saassubscription::menu.SaasSubscriptionSchool_trial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php else: ?>
        <?php echo $__env->make('backEnd.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!-- Page Content  -->
        <div id="main-content">
            <input type="hidden" name="url" id="url" value="<?php echo e(url('/')); ?>">

         <?php echo $__env->make('backEnd.partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/partials/header.blade.php ENDPATH**/ ?>