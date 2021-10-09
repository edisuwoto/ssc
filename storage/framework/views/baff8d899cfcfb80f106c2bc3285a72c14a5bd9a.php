
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.general_settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.general_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.general_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="student-details">
    <div class="container-fluid p-0">
        <?php echo $__env->make('backEnd.partials.alertMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xl-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.change_logo'); ?></h3>
                        </div>
                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

                    <?php else: ?>
                        <?php if(userPermission(406)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                      

                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="text-center">
                                
                            <?php if(isset($editData->logo)): ?>
                                                      
                                <img class="img-fluid Img-100" src="<?php echo e(asset($editData->logo)); ?>" alt="" >
                            <?php else: ?>
                                <img class="img-fluid" src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="">
                            <?php endif; ?>
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_logo"><?php echo app('translator')->get('lang.upload'); ?></label>
                                    <input type="file" class="d-none form-control" name="main_school_logo" id="upload_logo">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                    
                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.change_logo'); ?></button></span>
                                <?php else: ?>
                                    <?php if(userPermission(406)): ?>
                                    <button class="primary-btn fix-gr-bg small  "    >
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.save'); ?> 
                                    </button>
                                    <?php endif; ?> 
                                <?php endif; ?> 
                             
                                <?php if($errors->has('main_school_logo')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('main_school_logo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>


                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="main-title">

                            <h3 class="mb-30"><?php echo app('translator')->get('lang.change_fav'); ?> </h3>
                        </div>

                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

                    <?php else: ?>
                    <?php if(userPermission(406)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-school-logo', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


                        <?php endif; ?>
                    <?php endif; ?>
                       
                        <div class="white-box">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="text-center">
                            <?php if(isset($editData->favicon) && !empty(@$editData->favicon)): ?>                            
                                <img class="img-fluid Img-50" src="<?php echo e(@$editData->favicon); ?>" alt="" >
                            <?php else: ?>
                                <img class="img-fluid" src="<?php echo e(asset('public/uploads/settings/favicon.png')); ?>" alt="">
                            <?php endif; ?>
                            </div>

                            <div class="mt-40">
                                <div class="text-center">
                                    <label class="primary-btn small fix-gr-bg" for="upload_favicon"><?php echo app('translator')->get('lang.upload'); ?></label>
                                    <input type="file" class="d-none form-control" name="main_school_favicon" id="upload_favicon">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.change_fav'); ?></button></span>
                                <?php else: ?>
                                <?php if(userPermission(407)): ?>
                                    <button class="primary-btn fix-gr-bg small white_space">
                                            <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.save'); ?>
                                    </button>
                                    <?php endif; ?>  
                                <?php endif; ?>  
                                <?php if($errors->has('main_school_favicon')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('main_school_favicon')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>

                
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="row xm_3">
                    <div class="col-lg-7 col-xl-7 no-apadmin col-sm-6">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.general_settings'); ?> <?php echo app('translator')->get('lang.view'); ?></h3>
                        </div>
                    </div>
                    <div class=" col-lg-5 col-xl-5 text-right col-md-6 col-sm-6 sm2_10">
                        <?php if(userPermission(408)): ?>
                            <a href="<?php echo e(route('update-general-settings')); ?>" class="primary-btn small fix-gr-bg "> <span class="ti-pencil-alt"></span> <?php echo app('translator')->get('lang.edit'); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="student-meta-box">
                                
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.school_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->school_name); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.site_title'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->site_title); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.address'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->address); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.no'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->phone); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.address'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->email); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.income'); ?> <?php echo app('translator')->get('lang.head'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->incomeHead->head); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.school_code'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->school_code); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.academic_year'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                               
                                                   <?php echo e(@$editData->academic_Year->year); ?> - 
                                                    [ <?php echo e(@$editData->academic_Year->title); ?>  ]
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.language'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">

                                                <?php if(isset($editData)): ?>

                                                <?php echo e(@$editData->languages != ""? @$editData->languages->language_name:""); ?>


                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.date_format'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->dateFormats != ""? @$editData->dateFormats->normal_view:""); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.week'); ?> <?php echo app('translator')->get('lang.start'); ?> <?php echo app('translator')->get('lang.day'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->week_start_id != ""? @$editData->weekStartDay->name:""); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.time_zone'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->timeZone->time_zone); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.currency'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->currency); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.currency'); ?> <?php echo app('translator')->get('lang.symbol'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->currency_symbol); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.max_upload_file_size'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                <?php echo e(@$editData->file_size); ?> MB
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.promossion_without'); ?> <?php echo app('translator')->get('lang.exam'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                    <?php if(@$editData->promotionSetting != "" && @$editData->promotionSetting == 1): ?>
                                                        Enable
                                                    <?php else: ?>
                                                        Disable
                                                    <?php endif; ?>
                                                
                                                
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.subject_attendance_layout'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(isset($editData)): ?>
                                                    <?php if(@$editData->attendance_layout != "" && @$editData->attendance_layout == 1): ?>
                                                        <img src="<?php echo e(asset('public/backEnd/img/first_layout.png')); ?>" width="200px" height="auto" class="layout_image" for="first_layout" alt="">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('public/backEnd/img/second_layout.png')); ?>" width="200px" height="auto" class="layout_image" for="second_layout" alt="">
                                                    <?php endif; ?>
                                                
                                                
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lang.copyright_text'); ?> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php if(! is_null($editData->copyright_text)): ?>
                                                <?php echo @$editData->copyright_text; ?>


                                                <?php else: ?>

                                                Copyright 2019 All rights reserved by Codethemes
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade admin-query question_image_preview"  >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.layout'); ?> <?php echo app('translator')->get('lang.image'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <img src="" width="100%" class="question_image_url" alt="">
            </div>

        </div>
    </div>
</div>
<script>
    
    $(document).on('click', '.layout_image', function(){

         console.log(this.src);
            // $('.question_image_url').src(this.src);
            $('.question_image_url').attr('src',this.src);   
            $('.question_image_preview').modal('show');
        })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/backEnd/systemSettings/generalSettingsView.blade.php ENDPATH**/ ?>