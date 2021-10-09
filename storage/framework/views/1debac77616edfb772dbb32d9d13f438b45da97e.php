
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.registration'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.registration'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.registration'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($v_custom_field)): ?>
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('staff-reg-custom-field')); ?>" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('lang.add'); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="main-title mt_0_sm mt_0_md">
                        <h3 class="mb-30">
                            <?php if(isset($v_custom_field)): ?>
                                <?php echo app('translator')->get('lang.edit'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('lang.add'); ?>
                            <?php endif; ?>
                                <?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <?php if(isset($v_custom_field)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal','route' =>'update-staff-custom-field', 'method' => 'POST'])); ?>

                            <input type="hidden" name="id" value="<?php echo e($v_custom_field->id); ?>">
                        <?php else: ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal','route' =>'store-staff-registration-custom-field', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php echo $__env->make('backEnd.customField._custom_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            <div class="row mt-40 full_wide_table">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row  ">
                        <div class="col-lg-12">
                            <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                        <th><?php echo app('translator')->get('lang.label'); ?></th>
                                        <th><?php echo app('translator')->get('lang.type'); ?></th>
                                        <th><?php echo app('translator')->get('lang.width'); ?></th>
                                        <th><?php echo app('translator')->get('lang.required'); ?></th>
                                        <th><?php echo app('translator')->get('lang.value'); ?></th>
                                        <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$custom_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $v_lengths = json_decode($custom_field->min_max_length);
                                            $v_values = json_decode($custom_field->min_max_value);
                                            $v_name_values = json_decode($custom_field->name_value);
                                        ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($custom_field->label); ?></td>
                                            <td>
                                                <?php if($custom_field->type == "textInput"): ?>
                                                    <?php echo app('translator')->get('lang.text'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "numericInput"): ?>
                                                    <?php echo app('translator')->get('lang.numeric'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "multilineInput"): ?>
                                                    <?php echo app('translator')->get('lang.multiline'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "datepickerInput"): ?>
                                                    <?php echo app('translator')->get('lang.datepicker'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "checkboxInput"): ?>
                                                    <?php echo app('translator')->get('lang.checkbox'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "radioInput"): ?>
                                                    <?php echo app('translator')->get('lang.radio'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php elseif($custom_field->type == "dropdownInput"): ?>
                                                    <?php echo app('translator')->get('lang.dropdown'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.file'); ?> <?php echo app('translator')->get('lang.input'); ?>
                                                <?php endif; ?>
                                            </br>
                                                <?php if($custom_field->type == "textInput" || $custom_field->type == "multilineInput"): ?>
                                                    <small>
                                                        <?php echo app('translator')->get('lang.min'); ?> <?php echo app('translator')->get('lang.length'); ?> : <?php echo e($v_lengths[0]); ?>

                                                    </small>
                                                    </br>
                                                    <small>
                                                        <?php echo app('translator')->get('lang.max'); ?> <?php echo app('translator')->get('lang.length'); ?> : <?php echo e($v_lengths[1]); ?>

                                                    </small>
                                                    </br>
                                                <?php endif; ?>
    
                                                <?php if($custom_field->type == "numericInput"): ?>
                                                    <small>
                                                        <?php echo app('translator')->get('lang.min'); ?> <?php echo app('translator')->get('lang.value'); ?> : <?php echo e($v_values[0]); ?>

                                                    </small>
                                                    </br>
                                                    <small>
                                                        <?php echo app('translator')->get('lang.max'); ?> <?php echo app('translator')->get('lang.value'); ?> : <?php echo e($v_values[1]); ?>

                                                    </small>
                                                    </br>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($custom_field->width == "col-12"): ?>
                                                    <?php echo app('translator')->get('lang.full'); ?> <?php echo app('translator')->get('lang.width'); ?>
                                                <?php elseif($custom_field->width == "col-6"): ?>
                                                    <?php echo app('translator')->get('lang.half'); ?> <?php echo app('translator')->get('lang.width'); ?>
                                                <?php elseif($custom_field->width == "col-4"): ?>
                                                    <?php echo app('translator')->get('lang.one_fourth'); ?> <?php echo app('translator')->get('lang.width'); ?>
                                                <?php elseif($custom_field->width == "col-3"): ?>
                                                    <?php echo app('translator')->get('lang.one_thired'); ?> <?php echo app('translator')->get('lang.width'); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($custom_field->required == 1): ?>
                                                    <?php echo app('translator')->get('lang.required'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.not'); ?> <?php echo app('translator')->get('lang.required'); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($custom_field->type == "checkboxInput" || $custom_field->type == "radioInput" || $custom_field->type == "dropdownInput"  ): ?>
                                                    <?php $__currentLoopData = $v_name_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_name_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($v_name_value); ?>,
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if(userPermission(1107)): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('edit-staff-custom-field',['id' => @$custom_field->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(userPermission(1108)): ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteCustomField<?php echo e(@$custom_field->id); ?>" href="#">
                                                                <?php echo app('translator')->get('lang.delete'); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <div class="modal fade admin-query" id="deleteCustomField<?php echo e(@$custom_field->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">
                                                                <?php echo app('translator')->get('lang.cancel'); ?>
                                                            </button>
                                                            <?php echo e(Form::open(['route' =>'delete-staff-custom-field', 'method' => 'POST'])); ?>

                                                                <input type="hidden" name="id" value="<?php echo e(@$custom_field->id); ?>">
                                                                <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                            <?php echo e(Form::close()); ?>

                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/customField/staffRegistration.blade.php ENDPATH**/ ?>