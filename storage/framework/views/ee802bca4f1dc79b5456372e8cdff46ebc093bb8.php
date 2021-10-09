
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.final'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?>
                            </h3>
                        </div>
                        <?php if($edit_data > 1): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('custom-result-setting/update'), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                            <?php if(userPermission(437)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'custom-result-setting/store','method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mb-40 ">
                                <?php
                                    $average=0;
                                ?>
                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-12 mt-15">
                                            <div class="row">
                                                <div class="col-lg-7 d-flex">
                                                    <p class="text-uppercase fw-300 mb-10">
                                                        <?php echo app('translator')->get('lang.exam_type'); ?> <?php echo e($exam->title); ?> (%)
                                                        <input type="hidden" value="<?php echo e($exam->id); ?>" name="exam_type_id[]">
                                                    </p>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="radio-btn-flex ml-20">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect sm2_mb_20 md_mb_20">
                                                                    <input type="text" data-id="<?php echo e($exam->id); ?>"  name="exam_type_percent[<?php echo e($exam->id); ?>]" value="<?php echo e(isset($exam->id) == @$exam->examTerm->exam_type_id? $exam->examTerm->exam_percentage: $average); ?>" class="primary-input form-controll read-only-input has-content maxPercent">
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-12 mt-15 border-top">
                                    <div class="row">
                                        <div class="col-lg-7 d-flex">
                                            <strong>
                                                <p class="text-uppercase fw-300 mb-10">
                                                    <?php echo app('translator')->get('lang.total_mark'); ?> 100%
                                                </p>
                                            </strong>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="radio-btn-flex ml-20">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                                            <strong>
                                                                <p id="mark-calculate"></p>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <?php 
                                        $tooltip = "";
                                        if(userPermission(437)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to update";
                                            }
                                    ?>
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="primary-btn fix-gr-bg submit result_setup" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <?php if($edit_data > 1): ?>
                                                <span class="ti-check"></span><?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <span class="ti-check"></span><?php echo app('translator')->get('lang.store'); ?>
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        <?php echo app('translator')->get('lang.mark'); ?> <?php echo app('translator')->get('lang.contribution'); ?>
                    </h3>
                </div>
                <div class="white-box">
                    <table class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr class="border-bottom">
                                <th><?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.term'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang.percentage'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_percentage = 0;
                            ?>
                            <?php $__currentLoopData = $custom_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$custom_setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$key == 0): ?>
                                <tr>
                                    <td><?php echo e(@$custom_setting->examTypeName->title); ?></td>
                                    <td class="text-right"><?php echo e(@$custom_setting->exam_percentage); ?>%</td>
                                    <?php
                                        $total_percentage+=@$custom_setting->exam_percentage;
                                    ?>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="border-top">
                                <th><?php echo app('translator')->get('lang.total'); ?></th>
                                <th class="text-right"><?php echo e($total_percentage); ?>%</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            </div>

            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        <?php echo app('translator')->get('lang.merit_list'); ?> <?php echo app('translator')->get('lang.contribution'); ?> <?php echo app('translator')->get('lang.using'); ?>
                    </h3>
                </div>
                <div class="white-box">
                    <div class="d-flex radio-btn-flex">
                        <div class="mr-30">
                            <input type="radio" name="trueOrFalse" id="totalMark" value="total_mark" class="common-radio relationButton" <?php echo e(isset($meritListSettings)? $meritListSettings == "total_mark"? 'checked': '' : 'checked'); ?>>
                            <label for="totalMark"><?php echo app('translator')->get('lang.total_mark'); ?></label>
                        </div>
                        <div class="mr-30">
                            <input type="radio" name="trueOrFalse" id="grade" value="total_grade" class="common-radio relationButton" <?php echo e(isset($meritListSettings)? $meritListSettings == "total_grade"? 'checked': '' : 'checked'); ?>>
                            <label for="grade"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.grade'); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $( document ).ready(function() {
        $( ".relationButton" ).change(function() {
            let value = $( this ).val();
            $.ajax({
                type: "POST",
                data: {
                    value: value,
                },
                dataType: "json",
                url: "<?php echo e(route('merit-list-settings')); ?>",
                success: function(data) {
                    if (data == "success") {
                        toastr.success("Operation Successfull", "Successful", {
                            timeOut: 5000,
                        });
                    } else {
                        toastr.error("Operation Failed", "Failed!", {
                            timeOut: 5000,
                        });
                    }
                },
                error: function(data) {
                    console.log("Error:", data["error"]);
                },
            })
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/systemSettings/custom_result_setting_add.blade.php ENDPATH**/ ?>