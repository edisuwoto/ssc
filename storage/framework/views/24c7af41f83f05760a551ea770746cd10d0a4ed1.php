<?php 

$setting  = generalSetting()
?>


<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.option'); ?>
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
        /* .buttons_div_one{
        border: 4px solid #FFFFFF;
        border-radius:12px;

        padding-top: 0px;
        padding-right: 5px;
        padding-bottom: 0px;
        margin-bottom: 4px;
        padding-left: 0px;
         } */
        .buttons_div{
        border: 4px solid #19A0FB;
        border-radius:12px
        }
    </style>
    <?php
    $settings = $setting;
    ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.option'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.option'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6  buttons_div_one mb-30">
                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

                    <?php else: ?>
                        <?php if(userPermission(464)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-website-url', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                            <?php if(session()->has('message-success')): ?>
                                <div class="alert alert-success">
                                    <?php echo app('translator')->get('lang.inserted_message'); ?>
                                </div>
                            <?php elseif(session()->has('message-danger')): ?>
                                <div class="alert alert-danger">
                                    <?php echo app('translator')->get('lang.error_message'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="row p-0">
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center justify-content-left">
                                        <span style="font-size: 17px; padding-right: 15px;"><?php echo app('translator')->get('lang.website'); ?>  </span>
                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No action For Demo "> 
                                            <?php
                                                if(@$settings->website_btn == 0){
                                                        $permission_id=465;
                                                }else{
                                                        $permission_id=466;
                                                }
                                            ?>
                                            <?php if(userPermission($permission_id)): ?>
                                            <label class="switch">
                                                <input type="checkbox"
                                                    class="switch-website_btn_demo" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                            <?php endif; ?>
                                        </span>
                                        <?php else: ?>
                                        <?php
                                            if(@$settings->website_btn == 0){
                                                    $permission_id=465;
                                            }else{
                                                    $permission_id=466;
                                            }
                                        ?>
                                            <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch-website_btn" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p> <?php echo app('translator')->get('lang.csu'); ?></p>
                            <div class="row mt-20">
                            
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center justify-content-center mb-20">

                                        <?php
                                                if($settings->website_url==''){
                                                    $website_url=URL('home');
                                                }else{
                                                    $website_url=$settings->website_url;
                                                }
                                            ?>
                                            <input type="text" class="form-control<?php echo e($errors->has('website_url') ? ' is-invalid' : ''); ?>" name="website_url" value="<?php echo e(@$website_url); ?>">
                                            <?php if($errors->has('website_url')): ?>
                                        
                                            <p class="text-danger"><?php echo e($errors->first('website_url')); ?></p>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center justify-content-center mb-20">
                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                        <button  style="pointer-events: none;" class="primary-btn fix-gr-bg" type="button" > <?php echo app('translator')->get('lang.update'); ?> </button>
                                        </span>
                                    <?php else: ?>
                                        <?php if(userPermission(464)): ?>
                                        <button type="submit" class="primary-btn fix-gr-bg" id="search_promote">
                                            <span class=" pr-2"></span><?php echo app('translator')->get('lang.update'); ?></button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                    </div>
                
                </div>
                <div class="col-lg-6  ">
                <div class="buttons_div">
                    <div class="white-box">
                        
                            <div class="row">
                            
                            
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center justify-content-left">
                                        
                                        <span style="font-size: 17px; padding-right: 15px;"><?php echo app('translator')->get('lang.dashboard'); ?>  </span>

                                    
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                        
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No action For Demo "> 
                                        <?php
                                            if(@$settings->website_btn == 0){
                                                    $permission_id=465;
                                            }else{
                                                    $permission_id=466;
                                            }
                                        ?>
                                        <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch-website_btn_demo" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                        </span>

                                    
                                    <?php else: ?>
                                    <?php
                                        if(@$settings->dashboard_btn == 0){
                                                $permission_id=467;
                                        }else{
                                                $permission_id=468;
                                        }
                                    ?>
                                        <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch_dashboard_btn" <?php echo e(@$settings->dashboard_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center justify-content-center">

                                        <span style="font-size: 17px; padding-right: 15px;"><?php echo app('translator')->get('lang.style'); ?>  </span>

                                        
                                    
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                        
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No action For Demo ">
                                        <?php
                                            if(@$settings->website_btn == 0){
                                                    $permission_id=465;
                                            }else{
                                                    $permission_id=466;
                                            }
                                        ?>
                                        <?php if(userPermission($permission_id)): ?> 
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch-website_btn_demo" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                        </span>

                                    
                                    <?php else: ?>
                                    <?php
                                        if(@$settings->style_btn == 0){
                                                $permission_id=473;
                                        }else{
                                                $permission_id=474;
                                        }
                                    ?>
                                        <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch-style_btn" <?php echo e(@$settings->style_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center justify-content-left">

                                        <span style="font-size: 17px; padding-right: 15px;"><?php echo app('translator')->get('lang.report'); ?>   </span>

                                    
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                        
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No action For Demo "> 
                                        <?php
                                            if(@$settings->website_btn == 0){
                                                    $permission_id=465;
                                            }else{
                                                    $permission_id=466;
                                            }
                                        ?>
                                        <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch-website_btn_demo" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                        </span>

                                    
                                    <?php else: ?>
                                        <?php
                                            if(@$settings->report_btn == 0){
                                                    $permission_id=469;
                                            }else{
                                                    $permission_id=470;
                                            }
                                        ?>
                                        <?php if(userPermission($permission_id)): ?>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="switch_report_btn" <?php echo e(@$settings->report_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center justify-content-left">
    
                                            <span style="font-size: 17px; padding-right: 15px;"><?php echo app('translator')->get('lang.language'); ?>   </span>
    
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                            
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No action For Demo ">
                                            <?php
                                                if(@$settings->website_btn == 0){
                                                        $permission_id=465;
                                                }else{
                                                        $permission_id=466;
                                                }
                                            ?>
                                            <?php if(userPermission($permission_id)): ?> 
                                            <label class="switch">
                                                <input type="checkbox"
                                                    class="switch-website_btn_demo" <?php echo e(@$settings->website_btn == 0? '':'checked'); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                            <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                        <label class="switch">
                                            <?php
                                                if(@$settings->lang_btn == 0){
                                                        $permission_id=471;
                                                }else{
                                                        $permission_id=472;
                                                }
                                            ?>
                                            <?php if(userPermission($permission_id)): ?>
                                            <input type="checkbox"
                                                class="switch_lang_btn" <?php echo e(@$settings->lang_btn == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                            </div>
                    </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/systemSettings/buttonDisableEnable.blade.php ENDPATH**/ ?>