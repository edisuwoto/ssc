
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.fees_master'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style>
    .custom_fees_master{
        border-bottom: 1px solid #d9dce7; 
        padding-top: 5px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php  $setting = app('school_info'); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.fees_master'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_master'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($fees_master)): ?>
         <?php if(userPermission(119)): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('fees-master')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
           

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php if(isset($fees_master)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                    <?php echo app('translator')->get('lang.fees_master'); ?>
                            </h3>
                        </div>
                        <?php if(isset($fees_master)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true,  'route' => array('fees-master-update',$fees_master->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(119)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees-master',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">                               
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('fees_type') ? ' is-invalid' : ''); ?>" name="fees_type">
                                            <option data-display="<?php echo app('translator')->get('lang.fees_type'); ?> *" value=""><?php echo app('translator')->get('lang.fees_type'); ?> *</option>
                                            <?php $__currentLoopData = $fees_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!in_array($fees_type->id, $already_assigned)): ?>
                                                <?php if(isset($fees_master)): ?>
                                                    <option value="<?php echo e($fees_type->id); ?>" <?php echo e($fees_type->id == $fees_master->fees_type_id? 'selected':''); ?>><?php echo e(@$fees_type->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($fees_type->id); ?>"><?php echo e(@$fees_type->name); ?></option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('fees_type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('fees_type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e(isset($fees_master)? $fees_master->id: ''); ?>">
                                <input type="hidden" name="fees_group_id" value="<?php echo e(isset($fees_master)? $fees_master->fees_group_id: ''); ?>">

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" value="<?php echo e(isset($fees_master)? date('m/d/Y', strtotime($fees_master->date)) : date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->get('lang.due'); ?> <?php echo app('translator')->get('lang.date'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
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
                                    <?php if(isset($fees_master)): ?>
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                        type="text" name="amount" autocomplete="off" value="<?php echo e(isset($fees_master)? $fees_master->amount:''); ?>">
                                                        <label><?php echo app('translator')->get('lang.amount'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('amount')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                        type="text" name="amount" autocomplete="off" value="<?php echo e(isset($fees_master)? $fees_master->amount:''); ?>">
                                                    <label><?php echo app('translator')->get('lang.amount'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('amount')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
	                            <?php 
                                  $tooltip = "";
                                  if(userPermission(119)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($fees_master)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.master'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.fees_master'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="3">
                                        <?php if(session()->has('message-success-delete')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success-delete')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger-delete')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.group'); ?></th>
                                    <th><?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $fees_masters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                <tr>
                                    <td valign="top">
                                        <?php $i = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i++; ?>
                                        <?php if($i == 1): ?>
                                            <?php echo e(@$fees_master->feesGroups->name); ?>  
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
                                        <div class="row">
                                                <div class="col-sm-6 custom_fees_master">
                                                    <?php echo e($fees_master->feesTypes !=""?@$fees_master->feesTypes->name:''); ?> 
                                                </div>
                                                <div class="col-sm-2 custom_fees_master nowrap">
                                                    <?php echo e(generalSetting()->currency_symbol); ?> <?php echo e(number_format((float)$fees_master->amount, 2, '.', '')); ?>

                                                </div>
                                            <div class="col-sm-2">
                                                <div class="dropdown mb-20">
                                                    <button type="button" class="btn dropdown-toggle ml-20" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       <?php if(userPermission(120)): ?>

                                                        <a class="dropdown-item" href="<?php echo e(route('fees-master-edit', [$fees_master->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                       <?php endif; ?>
                                                        <?php if(userPermission(121)): ?>

                                                        <a class="dropdown-item deleteFeesMasterSingle" data-toggle="modal" data-target="#deleteFeesMasterSingle<?php echo e($fees_master->id); ?>"
                                                            href="#" data-id="<?php echo e($fees_master->id); ?>"><?php echo app('translator')->get('lang.delete'); ?> </a>
                                                   <?php endif; ?>
                                                        </div>
                                                </div>
 
                                            </div>
                                        </div>

                                        <div class="modal fade admin-query" id="deleteFeesMasterSingle<?php echo e($fees_master->id); ?>" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.type'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                                <?php echo e(Form::open(['url' => 'fees-master-single-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                                <input type="hidden" name="id" id="" value="<?php echo e($fees_master->id); ?>">
                                                                <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                                <?php echo e(Form::close()); ?>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td valign="top">
                                        <?php $i = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i++; ?>
                                        <?php if($i == 1): ?>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if(userPermission(122)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('fees_assign', [$fees_master->fees_group_id])); ?>"><?php echo app('translator')->get('lang.assign'); ?>/<?php echo app('translator')->get('lang.view'); ?></a>
                                                <?php endif; ?>
                                                <a class="dropdown-item deleteFeesMasterGroup" data-toggle="modal" href="#" data-id="<?php echo e($fees_master->fees_group_id); ?>" data-target="#deleteFeesMasterGroup<?php echo e($fees_master->fees_group_id); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="modal fade admin-query" id="deleteFeesMasterGroup<?php echo e($fees_master->fees_group_id); ?>" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.master'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                            <?php echo e(Form::open(['url' => 'fees-master-group-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                            <input type="hidden" name="id" value="<?php echo e($fees_master->fees_group_id); ?>">
                                                            <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                            <?php echo e(Form::close()); ?>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </td>
                                </tr>
                                   
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




            

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/feesCollection/fees_master.blade.php ENDPATH**/ ?>