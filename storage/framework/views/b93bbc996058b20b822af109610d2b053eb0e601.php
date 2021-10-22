<?php
$setting = generalSetting();
App::setLocale(getUserLanguage());
 
if (isset($setting->copyright_text)) {
    $copyright_text = $setting->copyright_text;
} else {
    $copyright_text = 'Copyright © 2020 All rights reserved | This template is made with by Codethemes';
}
if (isset($setting->logo)) {
    $logo = $setting->logo;
} else {
    $logo = 'public/uploads/settings/logo.png';
}

if (isset($setting->favicon)) {
    $favicon = $setting->favicon;
} else {
    $favicon = 'public/backEnd/img/favicon.png';
}

$login_background = App\SmBackgroundSetting::where([['is_default', 1], ['title', 'Login Background']])->first();

if (empty($login_background)) {
    $css = "background: url(" . url('public/backEnd/img/in_registration.png') . ")  no-repeat center; background-size: cover; ";
} else {
    if (!empty($login_background->image)) {
        $css = "background: url('" . url($login_background->image) . "')  no-repeat center;  background-size: cover;";
    } else {
        $css = "background:" . $login_background->color;
    }
}
?>


<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('public/')); ?>/uploads/settings/favicon.png" type="image/png" />
    <title><?php echo e(@schoolConfig()->school_name ? @schoolConfig()->school_name : 'Infix Edu ERP'); ?> | <?php echo app('translator')->get('lang.student'); ?>  <?php echo app('translator')->get('lang.registration'); ?> </title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(url('/public/')); ?>/landing/css/toastr.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('public/backEnd/')); ?>/css/style.css"/>
		<link rel="stylesheet" href="<?php echo e(url('Modules/ParentRegistration/Resources/assets/css/style.css')); ?>">

</head>

<body class="reg_bg" style="<?php echo e(@$css); ?>"> 
    <!--================ Start Login Area =================-->
    <div class="reg_bg">

    </div>
    <section class="login-area  registration_area ">
        <div class="container">
            <div class="registration_area_logo">
                 <?php if(!empty($setting->logo)): ?><img src="<?php echo e(asset($setting->logo)); ?>" alt="Login Panel"><?php endif; ?>
            </div>
            <?php if(\Session::has('success')): ?>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <h1><?php echo e(__('Thank You')); ?></h1>
                        <h3><?php echo \Session::get('success'); ?></h3>
                        <a href="<?php echo e(url('/')); ?>" class="primary-btn small fix-gr-bg"> 
                            <?php echo app('translator')->get('lang.home'); ?>
                        </a>
                    </div>

                </div>
            </div>
            <?php else: ?>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <div class="reg_tittle mt-20 mb-20">
                            <h2><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.registration'); ?></h2>
                        </div>
                        <div class="reg_tittle mt-40">
                            <h5><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.info'); ?></h5>
                        </div>
                        <?php if($reg_setting->registration_permission == 1): ?>
                            <form method="POST" class="" action="<?php echo e(route('parentregistration-student-store')); ?>" id="parent-registration">
                        <?php endif; ?>
                             <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="url" value="<?php echo e(url('/')); ?>"> 
                            <div class="row">
                                <?php if(moduleStatusCheck('Saas')== TRUE): ?> 
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="school" id="select-school">
                                            <option data-display="Select School *" value=""> <?php echo app('translator')->get('lang.select'); ?>  <?php echo app('translator')->get('lang.school'); ?>  *</option>
                                            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($school->id); ?>"> <?php echo e($school->school_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-lg-6">
                                    <div class="input-effect" id="academic-year-div">
                                        <select class="niceSelect w-100 bb form-control" name="academic_year" id="select-academic-year">
                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.year'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.year'); ?></option>
                                            <?php if(moduleStatusCheck('Saas')== FALSE): ?> 
                                            <?php $__currentLoopData = $academic_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <option value="<?php echo e($academic_year->id); ?>"><?php echo e($academic_year->year); ?> [<?php echo e($academic_year->title); ?>]</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                       
                                    </div>
                                     <?php if($errors->has('academic_year')): ?>
                                        <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('academic_year')); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-effect" id="class-div">
                                        <select class="niceSelect w-100 bb form-control" name="class" id="select-class">
                                            <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        </select>
                                        <div class="loader loader_style_parent_reg" id="select_class_loader">
                                            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                        </div>
                                    </div>
                                    <?php if($errors->has('class')): ?>
                                        <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('class')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='first_name' id="school_name" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.first_name'); ?> *" value="<?php echo e(old('first_name')); ?>" />
                                    </div>
                                    <?php if($errors->has('first_name')): ?>
                                            <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('first_name')); ?></div>
                                        <?php endif; ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='last_name' id="school_name" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.last_name'); ?> *" value="<?php echo e(old('student_email')); ?>" />
                                    </div>
                                    <?php if($errors->has('last_name')): ?>
                                            <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('last_name')); ?></div>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control" name="gender">
                                            <option data-display="<?php echo app('translator')->get('lang.gender'); ?> *" value=""><?php echo app('translator')->get('lang.gender'); ?> *</option>
                                            <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php if($errors->has('gender')): ?>
                                        <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('gender')); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input mydob date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                    name="date_of_birth" value="<?php echo e(date('d/m/Y')); ?>" autocomplete="off" id="date_of_birth">
                                                    <label><?php echo app('translator')->get('lang.date_of_birth'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                <?php if($errors->has('date_of_birth')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='age' id="age" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.age'); ?>*" readonly=""  value="<?php echo e(old('age')); ?>" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="email" name='student_email' id="student_email" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.email'); ?>" value="<?php echo e(old('student_email')); ?>"/>
                                    </div>
                                    <span class="text-danger error-message" id="student_email_error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='student_mobile' id="student_mobile" placeholder="<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.mobile'); ?>" value="<?php echo e(old('student_mobile')); ?>" />
                                    </div>
                                    <span class="text-danger error-message" id="student_mobile_error"></span>
                                </div>
                            </div>
                            <div class="mt-40">
                                <h5><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.info'); ?></h5>
                            </div>
                             <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_name' id="school_name" placeholder="<?php echo app('translator')->get('lang.guardian_name'); ?> *" value="<?php echo e(old('guardian_name')); ?>" />
                                    </div>
                                    <?php if($errors->has('guardian_name')): ?>
                                        <div class="text-danger error-message invalid-select mb-10"><?php echo e($errors->first('guardian_name')); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 d-flex relation-button">
                                    <p class="text-uppercase mb-0">
                                        <?php echo app('translator')->get('lang.guardian_relation'); ?>
                                    </p>
                                    <div class="d-flex radio-btn-flex ml-30">
                                        <div class="mr-20">
                                            <input type="radio" name="relationButton" id="relationFather" value="F" class="common-radio relationButton" <?php echo e(old('relationButton') == "F"? 'checked': ''); ?>>
                                            <label for="relationFather"><?php echo app('translator')->get('lang.father'); ?></label>
                                        </div>
                                        <div class="mr-20">
                                            <input type="radio" name="relationButton" id="relationMother" value="M" class="common-radio relationButton" <?php echo e(old('relationButton') == "M"? 'checked': ''); ?>>
                                            <label for="relationMother"><?php echo app('translator')->get('lang.mother'); ?></label>
                                        </div>
                                        <div>
                                            <input type="radio" name="relationButton" id="relationOther" value="O" class="common-radio relationButton"  <?php echo e(old('relationButton') != ""? (old('relationButton') == "O"? 'checked': ''): 'checked'); ?>>
                                            <label for="relationOther"><?php echo app('translator')->get('lang.Other'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_email' id="guardian_email" placeholder="<?php echo app('translator')->get('lang.guardian_email'); ?> *" value="<?php echo e(old('guardian_email')); ?>"/>
                                    </div>
                                    <?php if($errors->has('guardian_email')): ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error"><?php echo e($errors->first('guardian_email')); ?></div>
                                        <?php else: ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_email_error"></div>
                                        <?php endif; ?>

                                    </span>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group">
                                        <input class="form-control" type="text" name='guardian_mobile' id="guardian_mobile" placeholder="<?php echo app('translator')->get('lang.guardian_mobile'); ?> *" value="<?php echo e(old('guardian_mobile')); ?>"/>
                                    </div>
                                    <?php if($errors->has('guardian_mobile')): ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error"><?php echo e($errors->first('guardian_mobile')); ?></div>
                                        <?php else: ?>
                                            <div class="text-danger error-message invalid-select mb-10" id="guardian_mobile_error"></div>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                             <div class="row mt-20">
                                <div class="col-lg-12">
                                    <div class="form-group input-group">
                                        <textarea class="form-control" name='how_do_know_us' id="school_name" placeholder="<?php echo app('translator')->get('lang.how_do_you_know_us'); ?> ?"><?php echo e(old('how_do_know_us')); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php if($reg_setting->recaptcha == 1): ?>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                      <?php echo NoCaptcha::renderJs(); ?>

                                      <?php echo NoCaptcha::display(); ?>

                                    <span class="text-danger" id="g-recaptcha-error"><?php echo e($errors->first('g-recaptcha-response')); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php 
                                $tooltip = "";
                                if($reg_setting->registration_permission == 1){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You Can't Registration Now";
                                }
                            ?>
                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="login_button text-center">
                                        <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                           <?php echo app('translator')->get('lang.submit'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-30">
                                        <?php echo app('translator')->get('lang.note_for_multiple_child_registration'); ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        </form>
    </section>
    <!--================ Start End Login Area =================-->
    <!--================ Footer Area =================-->
    <footer class="footer_area registration_footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                <p><?php echo $copyright_text; ?></p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End Footer Area =================-->
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/popper.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/bootstrap.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/nice-select.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/login.js"></script>
    <script src="<?php echo e(url('public/backEnd/js/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/main.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backEnd/js/custom.js"></script>
    <script src="<?php echo e(url('/public/js/registration_custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/toastr.min.js"></script> 
    <?php echo Toastr::message(); ?>

    <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/ParentRegistration/Resources/views/registration.blade.php ENDPATH**/ ?>