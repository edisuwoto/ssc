
<?php $__env->startSection('title'); ?>
 <?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
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
                        <?php if(userPermission(674)): ?>
                            <a href="<?php echo e(route('course-category')); ?>" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                <?php echo app('translator')->get('lang.add'); ?>
                            </a>
                        <?php endif; ?>
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
                                    <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.category'); ?>
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-course-category',
                            'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                            <?php if(userPermission(501)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store-course-category',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

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
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input form-control <?php echo e($errors->has('category_image') ? ' is-invalid' : ''); ?>"
                                                        readonly="true" type="text"
                                                        placeholder="<?php echo e(isset($editData->category_image) && @$editData->category_image != ""? getFilePath3(@$editData->category_image):trans('lang.image')); ?> *"
                                                        id="placeholderUploadContent">
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('category_image')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('category_image')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    <input type="file" class="d-none form-control" name="category_image"
                                                           id="upload_content_file">
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center mt-10">
                                            <code><?php echo app('translator')->get('lang.min'); ?> (1420*450 px)</code>
                                        </div>
                                    <?php
                                        $tooltip = "";
                                        if(userPermission(674)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                        if(isset($editData)){
                                            if(userPermission(675)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to edit";
                                            }
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
                                <h3 class="mb-0"> <?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th> <?php echo app('translator')->get('lang.category'); ?>  <?php echo app('translator')->get('lang.title'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.image'); ?> </th>
                                    <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($course_categories)): ?>
                                    <?php $__currentLoopData = $course_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($value->category_name); ?></td>
                                            <td>
                                                <img src="<?php echo e(asset($value->category_image)); ?>" height="100" width="200">
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if(userPermission(675)): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('edit-course-category',$value->id)); ?>"> <?php echo app('translator')->get('lang.edit'); ?></a>
                                                        <?php endif; ?>
                                                        
                                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                            <span  tabindex="0" data-toggle="tooltip" title="Disabled For Demo"> <a href="#" class="dropdown-item small fix-gr-bg  demo_view" style="pointer-events: none;" ><?php echo app('translator')->get('lang.delete'); ?></a></span>
                                                        <?php else: ?>
                                                            <?php if(userPermission(676)): ?>
                                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteCourseCategory<?php echo e($value->id); ?>" href="#">
                                                                    <?php echo app('translator')->get('lang.delete'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteCourseCategory<?php echo e($value->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            <?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>
        
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                             <?php echo e(Form::open(['route' => array('delete-course-category',$value->id), 'method' => 'post',])); ?>

                                                                <button class="primary-btn fix-gr-bg" type="submit">
                                                                    <?php echo app('translator')->get('lang.delete'); ?>
                                                                </button>
                                                             <?php echo e(Form::close()); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/course/course_category.blade.php ENDPATH**/ ?>