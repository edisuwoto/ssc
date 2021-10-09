<style>
    .footer-list ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 50px;
    }

    .footer-list ul li {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .f_title {
        margin-bottom: 40px;
    }

    .f_title h4 {
        color: #415094;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
    }
</style>
<?php
    if(moduleStatusCheck('ParentRegistration')){
        $is_registration_permission = Modules\ParentRegistration\Entities\SmRegistrationSetting::first('position');
    }

    $setting  = generalSetting();
    App::setLocale(getUserLanguage());
?>
<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="Infix is 100+ unique feature enable school management software system. It can manage all type of school, academy and any educational institution"/>
    <link rel="icon" href="<?php echo e(asset($setting->favicon)); ?>" type="image/png"/>
    <title><?php echo e($setting->site_title ? $setting->site_title :  'Infix Edu ERP'); ?></title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <!-- Bootstrap CSS -->
    <?php if( $setting->site_title == 1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css"/>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->

    <?php if($setting->site_title ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@activeStyle()->path_main_style); ?>"/>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.print.css">

    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/infix.css"/>
    
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="client light">
<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/home">
                    <img class="w-75"
                         src="<?php echo e(asset($setting->logo ? $setting->logo : 'public/uploads/settings/logo.png')); ?>"
                         alt="Infix Logo" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">

                        <?php if(moduleStatusCheck('Saas')== FALSE): ?>
                            
                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($menu->childs) > 0 ): ?>
                                    <li class="nav-item submenu_left_control">
                                        <a class="nav-link" href="#"><?php echo e($menu->title); ?></a>
                                        <ul class="sumbmenu">
                                            <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="<?php echo e($sub_menu->show == 1? 'menu_list_left': ''); ?>">
                                                    <a <?php echo e($sub_menu->is_newtab ? 'target="_blank"' : ''); ?>

                                                    <?php if($sub_menu->type == "dPages"): ?>
                                                        href="<?php echo e(route('view-page',$sub_menu->link)); ?>"
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "sPages"): ?>
                                                        <?php if($sub_menu->link == "/login"): ?>
                                                            <?php if(!auth()->check()): ?>
                                                                href="<?php echo e(url('/')); ?><?php echo e($sub_menu->link); ?>"
                                                            <?php else: ?>
                                                                href="<?php echo e(url('/')); ?><?php echo e($sub_menu->link); ?>"
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            href="<?php echo e(url('/')); ?><?php echo e($sub_menu->link); ?>"
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "dCourse"): ?>
                                                        href="<?php echo e(route('course-Details',$sub_menu->element_id)); ?>"
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "dCourseCategory"): ?>
                                                        href="<?php echo e(route('view-course-category',$sub_menu->element_id)); ?>"
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "dNewsCategory"): ?>
                                                        href="<?php echo e(route('view-news-category',$sub_menu->element_id)); ?>"
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "dNews"): ?>
                                                        href="<?php echo e(route('news-Details',$sub_menu->element_id)); ?>"
                                                    <?php endif; ?>
                                                    <?php if($sub_menu->type == "customLink"): ?>
                                                        href="<?php echo e($sub_menu->link); ?>"
                                                    <?php endif; ?>
                                                    >
                                                    <?php if($sub_menu->link == "/login"): ?>
                                                        <?php if(!auth()->check()): ?>
                                                            <?php echo e($sub_menu->title); ?>

                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('lang.dashboard'); ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo e($sub_menu->title); ?>

                                                    <?php endif; ?>
                                                    </a>
                                                    <ul class="sumbmenu">
                                                        <?php $__currentLoopData = $sub_menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child_sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a <?php echo e($child_sub_menu->is_newtab ? 'target="_blank"' : ''); ?> 
                                                                <?php if($child_sub_menu->type == "dPages"): ?>
                                                                    href="<?php echo e(route('view-page',$child_sub_menu->link)); ?>"
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "sPages"): ?>
                                                                    <?php if($child_sub_menu->link == "/login"): ?>
                                                                        <?php if(!auth()->check()): ?>
                                                                            href="<?php echo e(url('/')); ?><?php echo e($child_sub_menu->link); ?>"
                                                                        <?php else: ?>
                                                                            href="<?php echo e(url('/')); ?><?php echo e($child_sub_menu->link); ?>"
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        href="<?php echo e(url('/')); ?><?php echo e($child_sub_menu->link); ?>"
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "dCourse"): ?>
                                                                    href="<?php echo e(route('course-Details',$child_sub_menu->element_id)); ?>"
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "dCourseCategory"): ?>
                                                                    href="<?php echo e(route('view-course-category',$child_sub_menu->element_id)); ?>"
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "dNewsCategory"): ?>
                                                                    href="<?php echo e(route('view-news-category',$child_sub_menu->element_id)); ?>"
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "dNews"): ?>
                                                                    href="<?php echo e(route('news-Details',$child_sub_menu->element_id)); ?>"
                                                                <?php endif; ?>
                                                                <?php if($child_sub_menu->type == "customLink"): ?>
                                                                    href="<?php echo e($child_sub_menu->link); ?>"
                                                                <?php endif; ?>
                                                                >
                                                                <?php if($child_sub_menu->link == "/login"): ?>
                                                                    <?php if(!auth()->check()): ?>
                                                                        <?php echo e($child_sub_menu->title); ?>

                                                                    <?php else: ?>
                                                                        <?php echo app('translator')->get('lang.dashboard'); ?>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php echo e($child_sub_menu->title); ?>

                                                                <?php endif; ?>
                                                            </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                    <?php else: ?>
                                    <li class="nav-item">
                                        <a class="nav-link" <?php echo e($menu->is_newtab ? 'target="_blank"' : ''); ?>

                                            <?php if($menu->type == "dPages"): ?>
                                                href="<?php echo e(route('view-page',$menu->link)); ?>"
                                            <?php endif; ?>
                                            <?php if($menu->type == "sPages"): ?>
                                                <?php if($menu->link == "/login"): ?>
                                                    <?php if(!auth()->check()): ?>
                                                        href="<?php echo e(url('/')); ?><?php echo e($menu->link); ?>"
                                                    <?php else: ?>
                                                        href="<?php echo e(url('/')); ?><?php echo e($menu->link); ?>"
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    href="<?php echo e(url('/')); ?><?php echo e($menu->link); ?>"
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($menu->type == "dCourse"): ?>
                                                href="<?php echo e(route('course-Details',$menu->element_id)); ?>"
                                            <?php endif; ?>
                                            <?php if($menu->type == "dCourseCategory"): ?>
                                                href="<?php echo e(route('view-course-category',$menu->element_id)); ?>"
                                            <?php endif; ?>
                                            <?php if($menu->type == "dNewsCategory"): ?>
                                                href="<?php echo e(route('view-news-category',$menu->element_id)); ?>"
                                            <?php endif; ?>
                                            <?php if($menu->type == "dNews"): ?>
                                                href="<?php echo e(route('news-Details',$menu->element_id)); ?>"
                                            <?php endif; ?>
                                            <?php if($menu->type == "customLink"): ?>
                                                href="<?php echo e($menu->link); ?>"
                                            <?php endif; ?>
                                        >
                                        <?php if($menu->link == "/login"): ?>
                                            <?php if(!auth()->check()): ?>
                                                <?php echo e($menu->title); ?>

                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.dashboard'); ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($menu->title); ?>

                                        <?php endif; ?>
                                    </a>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            
                                
                            

                            

                            <?php if(moduleStatusCheck('ParentRegistration')== TRUE): ?>
                                <?php if(isset($is_registration_permission) && $is_registration_permission->position==1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(url('/parentregistration/registration')); ?>">Student
                                            Registration</a>
                                        </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(url('/login')); ?>" target="_blank">Demo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#Support">Support</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#Price">Price</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#Contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/login')); ?>" target="_blank">LOGIN</a>
                            </li>
                            <?php if(moduleStatusCheck('ParentRegistration')== TRUE): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/parentregistration/registration')); ?>"
                                       target="_blank">Student
                                        Signup</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/institution-register-new')); ?>" target="_blank">School
                                    Signup</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav mr-auto search-bar">
                            <li class=""></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->

<?php echo $__env->yieldContent('main_content'); ?>

<!--================Footer Area =================-->
<footer class="footer_area section-gap-top">
    <div class="container">
        <div class="row footer_inner">
            <?php if(@$custom_link!=''): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4><?php echo e($custom_link->title1); ?></h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                    <?php if(moduleStatusCheck('ParentRegistration')== TRUE): ?>
                                        <?php if(isset($is_registration_permission) && $is_registration_permission->position==2): ?>
                                            <li>
                                                <a href="<?php echo e(url('/parentregistration/registration')); ?>">
                                                    <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.registration'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href1!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href1); ?>">
                                                <?php echo e($custom_link->link_label1); ?> 
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href5!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href5); ?>">
                                                <?php echo e($custom_link->link_label5); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href9!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href9); ?>">
                                                <?php echo e($custom_link->link_label9); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href13!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href13); ?>">
                                                <?php echo e($custom_link->link_label13); ?> 
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4><?php echo e($custom_link->title2); ?></h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                    <?php if($custom_link->link_href2!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href2); ?>">
                                                <?php echo e($custom_link->link_label2); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href6!=''): ?>
                                        <li>
                                            <a href="<?php echo e(url($custom_link->link_href6)); ?>">
                                                <?php echo e($custom_link->link_label6); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href10!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href10); ?>">
                                                <?php echo e($custom_link->link_label10); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href14!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href14); ?>">
                                                <?php echo e($custom_link->link_label14); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4><?php echo e($custom_link->title3); ?></h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                    <?php if($custom_link->link_href3!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href3); ?>">
                                                <?php echo e($custom_link->link_label3); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href7!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href7); ?>">
                                                <?php echo e($custom_link->link_label7); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href11!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href11); ?>">
                                                <?php echo e($custom_link->link_label11); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href15!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href15); ?>">
                                                <?php echo e($custom_link->link_label15); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="f_title">
                            <h4><?php echo e($custom_link->title4); ?></h4>
                        </div>
                        <div class="footer-list">
                            <nav>
                                <ul>
                                    <?php if($custom_link->link_href4!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href4); ?>">
                                                <?php echo e($custom_link->link_label4); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href8!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href8); ?>">
                                                <?php echo e($custom_link->link_label8); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href12!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href12); ?>">
                                                <?php echo e($custom_link->link_label12); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($custom_link->link_href16!=''): ?>
                                        <li>
                                            <a href="<?php echo e($custom_link->link_href16); ?>">
                                                <?php echo e($custom_link->link_label16); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">
                    <?php if($setting->copyright_text): ?>
                        <p><?php echo $setting->copyright_text; ?></p>
                    <?php else: ?>
                        Copyright © 2019 All rights reserved | This application is made with by Codethemes
                    <?php endif; ?>
                </div>
            </div>
            <?php if($social_permission): ?>
                <div class="col-lg-4 col-md-3">
                    <div class="social_widget">
                        <?php $__currentLoopData = $social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(@$social_icon->url != ""): ?>
                                <a href="<?php echo e(@$social_icon->url); ?>">
                                    <i class="<?php echo e($social_icon->icon); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<!--================End Footer Area =================-->


<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/owl.carousel.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/moment.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/print/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/frontEnd/home/front_master.blade.php ENDPATH**/ ?>