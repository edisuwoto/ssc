
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.social_media'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.social_media'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.social_media'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($visitor)): ?>
        <?php if(userPermission(530)): ?>
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('social-media')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php if(isset($visitor)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.social_media'); ?>
                            </h3>
                        </div>
                        <?php if(isset($visitor)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'social-media-update',
                            'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                            <?php if(in_array(530, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'social-media-store',
                            'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning">
                                            Note: Font awesome icon enter only e.g. fa fa-facebook.
                                        </div>
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('icon') ? ' is-invalid' : ''); ?>"  type="text" id="icon" name="icon" autocomplete="off" value="<?php echo e(isset($visitor)? $visitor->icon: old('icon')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($visitor)? $visitor->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.icon'); ?>(fa fa-facebook)<span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('icon')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('icon')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('url') ? ' is-invalid' : ''); ?>"  type="text" name="url" autocomplete="off" value="<?php echo e(isset($visitor)? $visitor->url: old('url')); ?>">
                                            <input type="hidden" name="id"
                                                    value="<?php echo e(isset($visitor)? $visitor->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.url'); ?><span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('url')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('url')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('status') ? ' is-invalid' : ''); ?>" name="status">
                                                <option data-display="<?php echo app('translator')->get('lang.status'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?>*</option>
                                                <option value="1" <?php echo e(isset($visitor)? ($visitor->status == 1? 'selected':''):'selected'); ?>><?php echo app('translator')->get('lang.active'); ?></option>
                                                <option value="0"  <?php echo e(isset($visitor)? ($visitor->status == 0? 'selected':''):''); ?>><?php echo app('translator')->get('lang.inactive'); ?></option>
                                        </select>
                                        <?php if($errors->has('status')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('status')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                    <?php 
                                        $tooltip = "";
                                        if(userPermission(530)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($visitor)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.social_media'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.url'); ?></th>
                                    <th><?php echo app('translator')->get('lang.icon'); ?></th>
                                    <th><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(@$value->url); ?>"> 
                                                <?php echo e(@$value->url); ?>

                                            </a>
                                        </td>
                                        <td><i class="<?php echo e($value->icon); ?>"></td>
                                        <td><?php echo e(@$value->status == 1? 'active':'inactive'); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(531)): ?>

                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('social-media-edit', [@$value->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(userPermission(532)): ?>

                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deleteVisitorModal<?php echo e(@$value->id); ?>"
                                                            href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                        
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteVisitorModal<?php echo e(@$value->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.social_media'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?>
                                                        </button>
                                                        <a href="<?php echo e(route('social-media-delete', [@$value->id])); ?>"
                                                            class="primary-btn fix-gr-bg"><?php echo app('translator')->get('lang.delete'); ?></a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/frontEnd/socialMedia.blade.php ENDPATH**/ ?>