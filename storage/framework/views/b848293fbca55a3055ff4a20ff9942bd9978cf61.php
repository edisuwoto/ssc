
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.access'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
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
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
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
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.access'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.access'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.access'); ?>
                            </h3>
                        </div>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'background-settings-update', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex align-items-center justify-content-center">

                                            <span style="font-size: 22px; padding-right: 15px;"><?php echo app('translator')->get('lang.enable'); ?> <?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.access'); ?> </span>
                                             <?php
                                                if(@$value->staff_user->access_status == 0){
                                                        $permission_id=483;
                                                }else{
                                                        $permission_id=484;
                                                }
                                            ?>
                                            <?php if(userPermission($permission_id)): ?>
                                            <label class="switch">
                                                <input type="checkbox"
                                                       class="switch-input2" <?php echo e(@$settings->api_url == 0? '':'checked'); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-20">
        <div class="white-box">
            <form action="<?php echo e(route('set_fcm_key')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="col-lg-12 d-flex">

                    
                <div class="col-lg-6 mb-20">
                            <div class="input-effect ">
                                <input  class="primary-input form-control<?php echo e($errors->has('fcm_key') ? ' is-invalid' : ''); ?>"
                                       type="text" name="fcm_key" value="<?php echo e(env('FCM_SECRET_KEY')); ?>">
                                <label><?php echo app('translator')->get('lang.fcm_key'); ?> <span>*</span></label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('fcm_key')): ?>
                                    <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fcm_key')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                </div>
            
                <div class="col-lg-4 mt-10">
                    <button type="submit" class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="">
                        <span class="ti-check"></span>
                        <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.fcm_key'); ?>
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/systemSettings/apiPermission.blade.php ENDPATH**/ ?>