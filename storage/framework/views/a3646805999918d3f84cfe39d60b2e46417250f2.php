
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
 <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .buttons_div_one{
        /* border: 4px solid #FFFFFF; */
        border-radius:12px;

        padding-top: 0px;
        padding-right: 5px;
        padding-bottom: 0px;
        margin-bottom: 4px;
        padding-left: 0px;
         }
        .buttons_div{
        border: 4px solid #19A0FB;
        border-radius:12px
        }
    </style>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.registration'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.settings'); ?></a>
            </div>
        </div>
    </div>
</section> 
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'parentregistration/settings', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                  
                    <div class="white-box"> 
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <h3 class="text-center"><?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.settings'); ?></h3>
                                    <hr>


                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.registration'); ?> </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_permission" id="relationFather" value="1" class="common-radio relationButton" <?php echo e(@$setting->registration_permission == 1? 'checked': ''); ?>>
                                                                    <label for="relationFather"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_permission" id="relationMother" value="2" class="common-radio relationButton" <?php echo e(@$setting->registration_permission == 2? 'checked': ''); ?>>
                                                                    <label for="relationMother"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.button'); ?></p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class=" radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="position" id="positionF" value="1" class="common-radio relationButton"  <?php echo e(@$setting->position == 1? 'checked': ''); ?>>
                                                                    <label for="positionF"><?php echo app('translator')->get('lang.header'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="position" id="positionM" value="2" class="common-radio relationButton"  <?php echo e(@$setting->position == 2? 'checked': ''); ?>>
                                                                    <label for="positionM"><?php echo app('translator')->get('lang.footer'); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mb-40 mt-40">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.after'); ?> <?php echo app('translator')->get('lang.registration'); ?> <?php echo app('translator')->get('lang.mail'); ?>  <?php echo app('translator')->get('lang.send'); ?> </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_after_mail" id="registration_after_mailF" value="1" class="common-radio relationButton"  <?php echo e(@$setting->registration_after_mail == 1? 'checked': ''); ?>>
                                                                    <label for="registration_after_mailF"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="registration_after_mail" id="registration_after_mailM" value="2" class="common-radio relationButton"  <?php echo e(@$setting->registration_after_mail == 2? 'checked': ''); ?>>
                                                                    <label for="registration_after_mailM"><?php echo app('translator')->get('lang.no'); ?></label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.after'); ?> <?php echo app('translator')->get('lang.registration'); ?>  <?php echo app('translator')->get('lang.approve'); ?> <?php echo app('translator')->get('lang.mail'); ?>  <?php echo app('translator')->get('lang.send'); ?> </p>
                                                </div>
                                               <div class="col-lg-7">
                                                   
                                                        <div class="radio-btn-flex ml-20">
                                                             <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="approve_after_mail" id="approve_after_mailF" value="1" class="common-radio relationButton"  <?php echo e(@$setting->approve_after_mail == 1? 'checked': ''); ?>>
                                                                    <label for="approve_after_mailF"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="approve_after_mail" id="approve_after_mailM" value="2" class="common-radio relationButton"  <?php echo e(@$setting->approve_after_mail == 2? 'checked': ''); ?>>
                                                                    <label for="approve_after_mailM"><?php echo app('translator')->get('lang.no'); ?></label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex">
                                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.recaptcha'); ?> </p>
                                                </div>
                                                <div class="col-lg-7">
                                                    
                                                        <div class="radio-btn-flex ml-20">
                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="recaptcha" id="recaptchaF" value="1" class="common-radio relationButton" <?php echo e(@$setting->recaptcha == 1? 'checked': ''); ?>>
                                                                    <label for="recaptchaF"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="">
                                                                    <input type="radio" name="recaptcha" id="recaptchaM" value="2" class="common-radio relationButton" <?php echo e(@$setting->recaptcha == 2? 'checked': ''); ?>>
                                                                    <label for="recaptchaM"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="https://www.google.com/recaptcha/admin/create" target="_blank"><?php echo app('translator')->get('lang.click_for_recaptcha_create'); ?></a>
                                        </div>

                                    </div>

                                    <div class="row mb-40 mt-40">
                                        
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('nocaptcha_sitekey') ? ' is-invalid' : ''); ?>" type="text" name="nocaptcha_sitekey" value="<?php echo e(@$setting->nocaptcha_sitekey); ?>">
                                                <label><?php echo app('translator')->get('lang.nocaptcha_sitekey'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('nocaptcha_sitekey')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('nocaptcha_sitekey')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input form-control<?php echo e($errors->has('nocaptcha_secret') ? ' is-invalid' : ''); ?>" type="text" name="nocaptcha_secret" value="<?php echo e(@$setting->nocaptcha_secret); ?>">
                                                <label><?php echo app('translator')->get('lang.nocaptcha_secret'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('nocaptcha_secret')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('nocaptcha_secret')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(userPermission(548)): ?>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" id="_submit_btn_admission">
                                                <span class="ti-check"></span>
                                                <?php echo app('translator')->get('lang.save'); ?> 
                                            </button>
                                        </div>
                                    </div>

                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/modules/parentregistration/settings.blade.php ENDPATH**/ ?>