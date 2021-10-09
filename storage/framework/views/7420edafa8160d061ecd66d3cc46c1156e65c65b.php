
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.sms'); ?>/<?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.template'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?></a>
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
                                    <?php echo app('translator')->get('lang.update'); ?>
                                <?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?>
                            </h3>
                        </div>
                          
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'sms-template-new', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-25">
                                    <div class="col-lg-12 mb-20">
                                        <span class="text-primary">[student_name] [parent_name] [due_amount] [fees_name] [due_date] [school_name]</span>
                                    </div>
                                    <div class="col-lg-8">
                                        
                                        <div class="input-effect">
                                            <label><?php echo app('translator')->get('lang.dues_fees_message'); ?> <span></span></label>
                                            <textarea class="primary-input form-control<?php echo e($errors->has('dues_fees_message') ? ' is-invalid' : ''); ?>" cols="0" rows="2" name="dues_fees_message_sms" maxlength="500"><?php echo e(isset($template)? $template->dues_fees_message_sms: old('dues_fees_message_sms')); ?></textarea>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('dues_fees_message_sms')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('dues_fees_message_sms')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class=" radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="">
                                                                <input type="radio" name="dues_fees_message_sms_status" id="dues_fees_message_smsF" value="1" class="common-radio relationButton"  <?php echo e(@$template->dues_fees_message_sms_status == 1? 'checked': ''); ?>>
                                                                <label for="dues_fees_message_smsF"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="">
                                                                <input type="radio" name="dues_fees_message_sms_status" id="dues_fees_message_smsM" value="2" class="common-radio relationButton"  <?php echo e(@$template->dues_fees_message_sms_status == 2? 'checked': ''); ?>>
                                                                <label for="dues_fees_message_smsM"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 mb-20">
                                        <span class="text-primary">[student_name] [parent_name] [number_of_subject] [subject_list] [due_date]</span>
                                    </div>
                                    <div class="col-lg-8">
                                        
                                        <div class="input-effect">
                                            <label><?php echo app('translator')->get('lang.student_absent_notification_sms'); ?> <span></span></label>
                                            <textarea class="primary-input form-control<?php echo e($errors->has('dues_fees_message') ? ' is-invalid' : ''); ?>" cols="0" rows="2" name="student_absent_notification_sms" maxlength="500"><?php echo e(isset($template)? $template->student_absent_notification_sms: old('dues_fees_message_sms')); ?></textarea>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('student_absent_notification_sms')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('student_absent_notification_sms')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class=" radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="">
                                                                <input type="radio" name="student_absent_notification_sms_status" id="student_absent_notification_sms_smsF" value="1" class="common-radio relationButton"  <?php echo e(@$template->student_absent_notification_sms_status == 1? 'checked': ''); ?>>
                                                                <label for="student_absent_notification_sms_smsF"><?php echo app('translator')->get('lang.enable'); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="">
                                                                <input type="radio" name="student_absent_notification_sms_status" id="student_absent_notification_sms_smsM" value="2" class="common-radio relationButton"  <?php echo e(@$template->student_absent_notification_sms_status == 2? 'checked': ''); ?>>
                                                                <label for="student_absent_notification_sms_smsM"><?php echo app('translator')->get('lang.disable'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
	                           <?php 
                                  $tooltip = "";
                                  if(userPermission(50)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                
                             
                                    
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>
                                                
                                                    <?php echo app('translator')->get('lang.update'); ?>
                                            </button>
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
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/communicate/sms_template.blade.php ENDPATH**/ ?>