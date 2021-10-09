
<style>
    span#twilio_account_sid-error,span#twilio_authentication_token-error,span#twilio_registered_no-error{
    color: red;
}
</style>
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.sms_settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.sms_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Start Sms Details -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs tab_column" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('twilio_settings') != 'active' && Session::get('msg91_settings') != 'active' && Session::get('textlocal_settings') != 'active' && Session::get('HimalayaSms') != 'active' && Session::get('africatalking_settings') != 'active'): ?> active <?php endif; ?>" href="#select_sms_service" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.select_a_SMS_service'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('twilio_settings') == 'active'): ?> active <?php endif; ?> " href="#twilio_settings" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.twilio'); ?> </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('msg91_settings') == 'active'): ?> active <?php endif; ?> " href="#msg91_settings" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.msg91'); ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('textlocal_settings') == 'active'): ?> active <?php endif; ?> " href="#textlocal_settings" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.textlocal'); ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('africatalking_settings') == 'active'): ?> active <?php endif; ?> " href="#africatalking_settings" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.africatalking'); ?> </a>
                    </li>  

                    <?php if(moduleStatusCheck('HimalayaSms')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('HimalayaSms') == 'active'): ?> active <?php endif; ?> " href="#HimalayaSms" role="tab" data-toggle="tab">HimalayaSms </a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?php if(Session::get('Mobile_SMS') == 'active'): ?> active <?php endif; ?> " href="#Mobile_SMS" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.mobile'); ?> <?php echo app('translator')->get('lang.sms'); ?></a>
                    </li> 
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade <?php if(Session::get('twilio_settings') != 'active' && Session::get('msg91_settings') != 'active' && Session::get('HimalayaSms') != 'active'  && Session::get('Mobile_SMS') != 'active' && Session::get('textlocal_settings') != 'active' && Session::get('africatalking_settings') != 'active'): ?> show active <?php endif; ?>" id="select_sms_service">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-clickatell-data', 'id' => 'select_a_service'])); ?>

                        <div class="white-box mt-2">
                            <div class="row">
                                <div class="col-lg-4 select_sms_services">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('book_category_id') ? ' is-invalid' : ''); ?>" name="sms_service" id="sms_service">
                                            <option data-display="<?php echo app('translator')->get('lang.select_a_SMS_service'); ?>" value=""><?php echo app('translator')->get('lang.select_a_SMS_service'); ?></option>
                                            <?php if(isset($all_sms_services)): ?>
                                            <?php $__currentLoopData = $all_sms_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(@$value->id); ?>"  <?php if(isset($active_sms_service)): ?> <?php if(@$active_sms_service->id == @$value->id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(@$value->gateway_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('book_category_id')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('book_category_id')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div> 
                                <div class="col-lg-8">
                                </div>
                            </div>   
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

            <!-- Start Exam Tab -->
            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('twilio_settings') == 'active'): ?> show active <?php endif; ?> " id="twilio_settings">
            <?php if(userPermission(446)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-twilio-data', 'id' => 'twilio_form'])); ?>

            <?php endif; ?>
                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="twilio_form" id="twilio_form_url" value="update-twilio-data">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="1"> 
                            <input type="hidden" name="gateway_name" value="Twilio">
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('twilio_account_sid') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_account_sid" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Twilio']->twilio_account_sid : ''); ?>" id="twilio_account_sid">
                                                <label><?php echo app('translator')->get('lang.twilio'); ?> <?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.sid'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('twilio_account_sid')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('twilio_account_sid')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('twilio_authentication_token') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_authentication_token" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Twilio']->twilio_authentication_token : ''); ?>" id="twilio_authentication_token">
                                                <label><?php echo app('translator')->get('lang.authentication'); ?> <?php echo app('translator')->get('lang.token'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('twilio_authentication_token')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('twilio_authentication_token')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('twilio_registered_no') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_registered_no" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Twilio']->twilio_registered_no : ''); ?>" id="twilio_registered_no">
                                                <label><?php echo app('translator')->get('lang.registered_phone_number'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('twilio_registered_no')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('twilio_registered_no')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/twilio.png')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $tooltip = "";
                            if(userPermission(446)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php echo e(Form::close()); ?>

            </div>
            

            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('msg91_settings') == 'active'): ?> show active <?php endif; ?> " id="msg91_settings"> 
                <?php if(userPermission(447)): ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-msg91-data', 'method'=>'POST'])); ?>

                <?php endif; ?>
                <div class="white-box">  
                    <input type="hidden" name="msg91_form" id="msg91_form_url" value="update-msg91-data">
                    <input type="hidden" name="gateway_id" id="gateway_id" value="2"> 
                    <input type="hidden" name="gateway_name" value="Msg91">
                            <div class="row mb-30">
                               <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('msg91_authentication_key_sid') ? ' is-invalid' : ''); ?>"
                                                type="text" id="msg91_authentication_key_sid" name="msg91_authentication_key_sid" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Msg91']->msg91_authentication_key_sid : ''); ?>"> 
                                                <label><?php echo app('translator')->get('lang.authentication'); ?> <?php echo app('translator')->get('lang.key'); ?> <?php echo app('translator')->get('lang.sid'); ?> <span>*</span> </label> 
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('msg91_authentication_key_sid')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('msg91_authentication_key_sid')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('msg91_sender_id') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_sender_id" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Msg91']-> msg91_sender_id : ''); ?>" id="msg91_sender_id">
                                                <label><?php echo app('translator')->get('lang.sender'); ?> <?php echo app('translator')->get('lang.id'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('msg91_sender_id')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('msg91_sender_id')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('msg91_route') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_route" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Msg91']-> msg91_route : ''); ?>" id="msg91_route">
                                                <label><?php echo app('translator')->get('lang.route'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('msg91_route')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('msg91_route')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('msg91_country_code') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_country_code" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['Msg91']-> msg91_country_code : ''); ?>" id="msg91_country_code">
                                                <label><?php echo app('translator')->get('lang.country_code'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('msg91_country_code')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('msg91_country_code')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="" height="" src="<?php echo e(URL::asset('public/backEnd/img/MSG91-logo.png')); ?>">
                                    </div>
                                </div>
                            </div>
                        
                        <?php 
                            $tooltip = "";
                            if(userPermission(447)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center"> 
                                <button class="primary-btn fix-gr-bg" type="submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>"> 
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

                    <!-- Start Exam Tab -->
            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('textlocal_settings') == 'active'): ?> show active <?php endif; ?> " id="textlocal_settings">
            <?php if(userPermission(446)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-textlocal-data', 'id' => 'textlocal_form', 'method'=>'POST'])); ?>

            <?php endif; ?>
                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="3"> 
                            <input type="hidden" name="gateway_name" value="TextLocal">
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('textlocal_username') ? ' is-invalid' : ''); ?>"
                                                type="text" name="textlocal_username" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['TextLocal']->textlocal_username : ''); ?>" id="textlocal_username">
                                                <label><?php echo app('translator')->get('lang.textlocal'); ?> <?php echo app('translator')->get('lang.username'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('textlocal_username')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('textlocal_username')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('textlocal_hash') ? ' is-invalid' : ''); ?>"
                                                type="text" name="textlocal_hash" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['TextLocal']->textlocal_hash : ''); ?>" id="textlocal_hash">
                                                <label><?php echo app('translator')->get('lang.textlocal'); ?> <?php echo app('translator')->get('lang.hash'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('textlocal_hash')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('textlocal_hash')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('textlocal_sender') ? ' is-invalid' : ''); ?>"
                                                type="text" name="textlocal_sender" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['TextLocal']->textlocal_sender : ''); ?>" id="textlocal_sender">
                                                <label><?php echo app('translator')->get('lang.textlocal'); ?> <?php echo app('translator')->get('lang.sender'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('textlocal_sender')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('textlocal_sender')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/twilio.png')); ?>">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Start Exam Tab -->
                        <?php 
                            $tooltip = "";
                            if(userPermission(447)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center"> 
                                <button class="primary-btn fix-gr-bg" type="submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>"> 
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

            <!-- Mobile_SMS Tab -->
            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('Mobile_SMS') == 'active'): ?> show active <?php endif; ?> " id="Mobile_SMS">
                <div class="white-box">
                    <div class="row mb-30">
                        <ul class="list-unstyled">
                        <?php    
                            if( $sms_services['Mobile SMS']->device_info){
                                $data = json_decode( $sms_services['Mobile SMS']->device_info );
                            }
                        ?>

                        <?php if($sms_services['Mobile SMS']->device_info): ?>
                            
                                
                            <li>Device ID : <?php echo e(($data->deviceId)); ?></li>
                            <br>
                            <li>Device Model :<?php echo e(($data->deviceName)); ?> </li>
                            <br>
                            <li>
                                <strong><?php echo app('translator')->get('lang.status'); ?> :</strong>
                                <?php if($data->status==0): ?>
                                    <button class="primary-btn small bg-danger text-white border-0">offline</button>
                                <?php else: ?>
                                    <button class="primary-btn small bg-success text-white border-0  tr-bg"><?php echo app('translator')->get('lang.online'); ?></button>
                                <?php endif; ?>
                            </li>
                        
                        <?php else: ?>
                            <li>No Device Connected !</li>
                        
                        <?php endif; ?>
                                
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Start Himalaya Sms  -->
            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('HimalayaSms') == 'active'): ?> show active <?php endif; ?> " id="HimalayaSms">
            <?php if(userPermission(446) && moduleStatusCheck('HimalayaSms') ): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'himalayasms.update-setting', 'id' => 'textlocal_form', 'method'=>'POST'])); ?>

            <?php endif; ?>
                <div class="white-box">
                        <div class="">

                            <div class="row mb-30">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-6 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('himalayasms_senderId') ? ' is-invalid' : ''); ?>"
                                                type="text" name="himalayasms_senderId" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['HimalayaSms']->himalayasms_senderId : ''); ?>" id="himalayasms_senderId">
                                                <label><?php echo app('translator')->get('lang.sender'); ?> <?php echo app('translator')->get('lang.id'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('himalayasms_senderId')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('himalayasms_senderId')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('himalayasms_key') ? ' is-invalid' : ''); ?>"
                                                type="text" name="himalayasms_key" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['HimalayaSms']->himalayasms_key : ''); ?>" id="himalayasms_key">
                                                <label><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.key'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('himalayasms_key')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('himalayasms_key')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('himalayasms_routeId') ? ' is-invalid' : ''); ?>"
                                                type="text" name="himalayasms_routeId" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['HimalayaSms']->himalayasms_routeId : ''); ?>" id="himalayasms_routeId">
                                                <label><?php echo app('translator')->get('lang.route'); ?> <?php echo app('translator')->get('lang.id'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('himalayasms_routeId')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('himalayasms_routeId')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-20">
                                        <div class="col-lg-6 mb-30">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control<?php echo e($errors->has('himalayasms_campaign') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="himalayasms_campaign" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['HimalayaSms']->himalayasms_campaign : ''); ?>" id="himalayasms_campaign">
                                                    <label>Campaign  <?php echo app('translator')->get('lang.id'); ?><span>*</span> </label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('himalayasms_campaign')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('himalayasms_campaign')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    </div>

                                </div>

                                <!-- <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/twilio.png')); ?>">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Start Exam Tab -->
                        <?php 
                            $tooltip = "";
                            if(userPermission(447)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center"> 
                                <button class="primary-btn fix-gr-bg" type="submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>"> 
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

            <div role="tabpanel" class="tab-pane fade <?php if(Session::get('africatalking_settings') == 'active'): ?> show active <?php endif; ?>" id="africatalking_settings">
            <?php if(userPermission(446)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-africatalking-data', 'id' => 'textlocal_form', 'method'=>'POST'])); ?>

            <?php endif; ?>
                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="4"> 
                            <input type="hidden" name="gateway_name" value="AfricaTalking">
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('africatalking_username') ? ' is-invalid' : ''); ?>"
                                                type="text" name="africatalking_username" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['AfricaTalking']->africatalking_username : ''); ?>" id="textlocal_username">
                                                <label><?php echo app('translator')->get('lang.africatalking'); ?> <?php echo app('translator')->get('lang.username'); ?><span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('africatalking_username')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('africatalking_username')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('africatalking_api_key') ? ' is-invalid' : ''); ?>"
                                                type="text" name="africatalking_api_key" autocomplete="off" value="<?php echo e(isset($sms_services)? @$sms_services['AfricaTalking']->africatalking_api_key : ''); ?>" id="africatalking_api_key">
                                                <label><?php echo app('translator')->get('lang.africatalking_api_key'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('africatalking_api_key')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('africatalking_api_key')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/twilio.png')); ?>">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <?php 
                            $tooltip = "";
                            if(userPermission(446)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php echo e(Form::close()); ?>

            </div>
                   </div>
     
                </div>
            </div>
          </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/systemSettings/smsSettings.blade.php ENDPATH**/ ?>