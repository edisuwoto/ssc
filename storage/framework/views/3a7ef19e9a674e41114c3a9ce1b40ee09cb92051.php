
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.fees_discount'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.fees_discount'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_discount'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($fees_discount)): ?>
        <?php if(userPermission(132)): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('fees_discount')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php if(isset($fees_discount)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.fees_discount'); ?>
                            </h3>
                        </div>
                        <?php if(isset($fees_discount)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' =>
                        'fees_discount_update', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(132)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_discount_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($fees_discount)? $fees_discount->name: ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($fees_discount)? $fees_discount->id: ''); ?>">
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
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('code') ? ' is-invalid' : ''); ?>"
                                                type="text" name="code" autocomplete="off"
                                                value="<?php echo e(isset($fees_discount)? $fees_discount->code: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.discount'); ?> <?php echo app('translator')->get('lang.code'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('code')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('code')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 d-flex">
                                        
                                        <p class="text-uppercase fw-500"><?php echo app('translator')->get('lang.type'); ?></p>
                                        <div class="radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="type" id="once" value="once" class="common-radio relationButton" <?php echo e(isset($fees_discount)? ($fees_discount->type == "once"? 'checked':''):'checked'); ?>>
                                                <label for="once"><?php echo app('translator')->get('lang.once'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="type" id="year" value="year" class="common-radio relationButton" <?php echo e(isset($fees_discount)? ($fees_discount->type == "year"? 'checked':''):''); ?>>
                                                <label for="year"><?php echo app('translator')->get('lang.year'); ?></label>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                type="text" name="amount" autocomplete="off"
                                                value="<?php echo e(isset($fees_discount)? $fees_discount->amount: ''); ?>">
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
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                name="description"><?php echo e(isset($fees_discount)? $fees_discount->description: ''); ?></textarea>
                                                <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                            	<?php 
                                  $tooltip = "";
                                  if(userPermission(132)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($fees_discount)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.discount'); ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->get('lang.fees_discount'); ?>  <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="5">
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
                                    <th> <?php echo app('translator')->get('lang.name'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.discount'); ?>  <?php echo app('translator')->get('lang.code'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.discount'); ?> <?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $fees_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-toggle="tooltip" data-placement="top" title="<?php echo e($fees_discount->description); ?>"><?php echo e($fees_discount->name); ?></td>
                                    <td><?php echo e($fees_discount->code); ?></td>
                                    <td><?php echo e($fees_discount->type); ?></td>
                                    <td><?php echo e($fees_discount->amount); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(135)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('fees_discount_assign', [$fees_discount->id])); ?>"><?php echo app('translator')->get('lang.assign'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(133)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('fees_discount_edit', [$fees_discount->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(134)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteFeesDiscountModal<?php echo e($fees_discount->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                           <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteFeesDiscountModal<?php echo e($fees_discount->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.fees_discount'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                    <a href="<?php echo e(route('fees_discount_delete', [$fees_discount->id])); ?>"><button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button></a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/feesCollection/fees_discount.blade.php ENDPATH**/ ?>