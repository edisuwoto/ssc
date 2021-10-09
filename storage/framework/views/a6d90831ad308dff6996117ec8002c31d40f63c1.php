
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.chart_of_account'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.chart_of_account'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.chart_of_account'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($chart_of_account)): ?>
         <?php if(userPermission(149)): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('chart-of-account')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($chart_of_account)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.chart_of_account'); ?>
                            </h3>
                        </div>
                        <?php if(isset($chart_of_account)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true,  'route' => array('chart-of-account-update',@$chart_of_account->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                          <?php if(userPermission(149)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'chart-of-account',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger')); ?>

                                        </div>
                                        <?php endif; ?>
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('head') ? ' is-invalid' : ''); ?>"
                                                type="text" name="head" autocomplete="off" value="<?php echo e(isset($chart_of_account)? $chart_of_account->head: old('head')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($chart_of_account)? $chart_of_account->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.head'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('head')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('head')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('type') ? ' is-invalid' : ''); ?>" name="type">
                                            <option data-display="<?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.type'); ?> *</option>
                                            <option value="A" <?php echo e(@$chart_of_account->type == 'A'? 'selected':old('type') == ('A'? 'selected':'')); ?>><?php echo app('translator')->get('lang.asset'); ?></option>
                                            <option value="E" <?php echo e(@$chart_of_account->type == 'E'? 'selected':old('type') == ('E'? 'selected':'')); ?>><?php echo app('translator')->get('lang.expense'); ?></option>
                                            <option value="I" <?php echo e(@$chart_of_account->type == 'I'? 'selected':old('type') == ('I'? 'selected':'' )); ?>><?php echo app('translator')->get('lang.income'); ?></option>
                                            <option value="L" <?php echo e(@$chart_of_account->type == 'L'? 'selected':old('type') == ('L'? 'selected':'')); ?>><?php echo app('translator')->get('lang.liability'); ?></option>
                                        </select>

                                         
                                        <?php if($errors->has('type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            	<?php
                                  $tooltip = "";
                                  if(userPermission(149)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($chart_of_account)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.head'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.chart_of_account'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $chart_of_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chart_of_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$chart_of_account->head); ?></td>
                                            
                                    <td>
                                        <?php if($chart_of_account->type=="A"): ?><?php echo app('translator')->get('lang.asset'); ?> <?php endif; ?>
                                        <?php if($chart_of_account->type=="E"): ?><?php echo app('translator')->get('lang.expense'); ?> <?php endif; ?>
                                        <?php if($chart_of_account->type=="I"): ?><?php echo app('translator')->get('lang.income'); ?> <?php endif; ?>
                                        <?php if($chart_of_account->type=="L"): ?><?php echo app('translator')->get('lang.liability'); ?> <?php endif; ?>

                                        
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               <?php if(userPermission(150)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('chart-of-account-edit', [@$chart_of_account->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                               <?php if(userPermission(151)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteChartOfAccountModal<?php echo e(@$chart_of_account->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                           <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteChartOfAccountModal<?php echo e(@$chart_of_account->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.chart_of_account'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('chart-of-account-delete',@$chart_of_account->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/accounts/chart_of_account.blade.php ENDPATH**/ ?>