
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($editData)): ?>
            <?php if(userPermission(501)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('news-category')); ?>" class="primary-btn small fix-gr-bg">
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
                                <h3 class="mb-30"><?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.category'); ?>
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_news_category',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update'])); ?>

                            <?php else: ?>
                            <?php if(userPermission(501)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_news_category',
                                'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income'])); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-12 mb-20">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('category_name') ? ' is-invalid' : ''); ?>"
                                                       type="text" name="category_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->category_name : ''); ?>">
                                                <input type="hidden" name="id" value="<?php echo e(isset($editData)? $editData->id: ''); ?>">
                                                <label><?php echo app('translator')->get('lang.category'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('category_name')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('category_name')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                        $tooltip = "";
                                        if(userPermission(501)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($editData)): ?>
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
                                <h3 class="mb-0"> <?php echo app('translator')->get('lang.news'); ?>  <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                <?php if(session()->has('message-success') != "" ||
                                        session()->get('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="2">
                                            <?php if(session()->has('message-success')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo e(session()->get('message-success')); ?>

                                                </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                                <div class="alert alert-danger">
                                                    <?php echo e(session()->get('message-danger')); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th> <?php echo app('translator')->get('lang.category'); ?>  <?php echo app('translator')->get('lang.title'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if(isset($newsCategories)): ?>
                                    <?php $__currentLoopData = $newsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e($value->category_name); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if(userPermission(502)): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('edit-news-category',$value->id)); ?>"> <?php echo app('translator')->get('lang.edit'); ?></a>
                                                        <?php endif; ?>
                                                        
                                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                            <span  tabindex="0" data-toggle="tooltip" title="Disabled For Demo"> <a href="#" class="dropdown-item small fix-gr-bg  demo_view" style="pointer-events: none;" ><?php echo app('translator')->get('lang.delete'); ?></a></span>
                                                        <?php else: ?>
                                                            <?php if(userPermission(503)): ?>
                                                                <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete News Category" href="<?php echo e(route('for-delete-news-category',$value->id)); ?>"> <?php echo app('translator')->get('lang.delete'); ?></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/news/news_category.blade.php ENDPATH**/ ?>