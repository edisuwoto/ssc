
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.base_setup'); ?>
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.base_setup'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.base_setup'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($base_setup)): ?>
            <?php if(userPermission(429)): ?>
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('base_setup')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($base_setup)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>

                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.base_setup'); ?>
                            </h3>
                        </div>
                        <?php if(isset($base_setup)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'base_setup_update',
                        'method' => 'POST'])); ?>

                        <?php else: ?>
                            <?php if(userPermission(429)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'base_setup_store',
                            'method' => 'POST'])); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('base_group') ? ' is-invalid' : ''); ?>"
                                            name="base_group">
                                            <option data-display="<?php echo app('translator')->get('lang.base_group'); ?> *" value=""><?php echo app('translator')->get('lang.base_group'); ?>*</option>
                                            <?php $__currentLoopData = $base_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $base_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($base_setup)): ?>
                                            <option value="<?php echo e(@$base_group->id); ?>"
                                                <?php echo e(@$base_group->id == @$base_setup->base_group_id? 'selected': ''); ?>><?php echo e(@$base_group->name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e(@$base_group->id); ?>"><?php echo e(@$base_group->name); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('base_group')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('base_group')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" value="<?php echo e(isset($base_setup)? @$base_setup->base_setup_name: ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($base_setup)? @$base_setup->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(429)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($base_setup)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.base_setup'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.base_setup'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row base-setup">
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
                                    <th width="33%"><?php echo app('translator')->get('lang.base'); ?> <?php echo app('translator')->get('lang.type'); ?></th>
                                    <th width="33%"><?php echo app('translator')->get('lang.label'); ?></th>
                                    <th width="33%"><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            <?php $i = 0; ?>
                                            <?php $__currentLoopData = $base_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $base_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="card mr-4">
                                                <div class="card-header d-flex justify-content-between" role="tab" id="headingOne<?php echo e(@$base_group->id); ?>">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-6">
                                                            <a data-toggle="collapse" href="#collapseOne<?php echo e(@$base_group->id); ?>" aria-expanded="true" aria-controls="collapseOne<?php echo e(@$base_group->id); ?>">
                                                            <?php echo e($base_group->name); ?>

                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6 text-right">
                                                            <a class="primary-btn icon-only tr-bg" data-toggle="collapse" href="#collapseOne<?php echo e(@$base_group->id); ?>" aria-expanded="true" aria-controls="collapseOne">
                                                                <span class="ti-arrow-down"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                @$base_setups = @$base_group->baseSetups;
                                                ?>
                                                <div id="collapseOne<?php echo e(@$base_group->id); ?>" class="collapse <?php echo e($i++ == 0? 'show':''); ?>" role="tabpanel" aria-labelledby="headingOne<?php echo e(@$base_group->id); ?>" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php $__currentLoopData = $base_setups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $base_setup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="row py-3 border-bottom align-items-center">
                                                            <div class="offset-lg-4 col-lg-4"><?php echo e(@$base_setup->base_setup_name); ?></div>
                                                            <div class="col-lg-4">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <?php if(userPermission(430)): ?>
                                                                            <a class="dropdown-item" href="<?php echo e(route('base_setup_edit', [@$base_setup->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                                        <?php endif; ?>
                                                                        <?php if(userPermission(431)): ?>
                                                                            <a class="dropdown-item deleteBaseSetupModal" href="#" data-toggle="modal" data-target="#deleteBaseSetupModal" data-id="<?php echo e(@$base_setup->id); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </div>
                                    </td>
                                    <td class="d-none p-0"></td>
                                    <td class="d-none p-0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<div class="modal fade admin-query" id="deleteBaseSetupModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.base_setup'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'base_setup_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" value="" id="base_setup_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/systemSettings/baseSetup/base_setup.blade.php ENDPATH**/ ?>