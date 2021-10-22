
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.course'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<style>
    .invalid-select-label {
        position: absolute;
        bottom: 0px;
        margin-top: 0px !important;
    }
    .invalid-select-label strong{
        top: -7px;
    }
</style>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.course'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.course'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($add_course)): ?>
                <?php if(userPermission(511)): ?>
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="<?php echo e(route('course-list')); ?>" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                <?php echo app('translator')->get('lang.add'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php if(isset($add_course)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.course'); ?>
                            </h3>
                        </div>
                        <?php if(isset($add_course)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_course',
                            'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                            <?php if(userPermission(511)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_course',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                   type="text" name="title" autocomplete="off"
                                                   value="<?php echo e(isset($add_course)? $add_course->title: old('title')); ?>">
                                            <input type="hidden" name="id"
                                                   value="<?php echo e(isset($add_course)? $add_course->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.title'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('category_id') ? ' is-invalid' : ''); ?> mb-30" name="category_id">
                                                <option data-display="<?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?>*" value=""><?php echo app('translator')->get('lang.select'); ?> *</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e((@$add_course->category_id == $category->id) ? 'selected' :''); ?>><?php echo e($category->category_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('category_id')): ?>
                                                <span class="invalid-feedback invalid-select-label" role="alert">
                                                    <strong><?php echo e($errors->first('category_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col mb-30">
                                            <div class="row no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control<?php echo e($errors->has('image') ? ' is-invalid' : ''); ?>" type="text"
                                                                id="placeholderFileOneName"
                                                                placeholder="<?php echo e(isset($add_course)? ($add_course->image !="") ? getFilePath3($add_course->image) :trans('lang.image') .' *' :trans('lang.image') . '(' .trans('lang.min')." 1420*450 PX)"); ?>"
                                                                readonly
                                                        >
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('image')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('image')); ?></strong>
                                                </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="primary-btn-small-input" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                                for="document_file_1"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                        <input type="file" class="d-none" name="image"
                                                                id="document_file_1">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="row mt-20">
                                        <div class="col-md-12 mt-20">
                                            <div class="input-effect">
                                                <label><?php echo app('translator')->get('lang.overview'); ?> </label>
                                                <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                                                <textarea class="primary-input form-control<?php echo e($errors->has('overview') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="overview" maxlength="500"><?php echo e(isset($add_course)? $add_course->overview: old('overview')); ?></textarea>
                                                <span class="focus-border textarea"></span>
                                                <script>
                                                    CKEDITOR.replace("overview" );
                                                </script>
                                                <?php if($errors->has('overview')): ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($errors->first('overview')); ?></strong></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>      
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div class="input-effect">
                                                <label><?php echo app('translator')->get('lang.outline'); ?> <span></span></label>
                                                <textarea class="primary-input form-control<?php echo e($errors->has('outline') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="outline" maxlength="500"><?php echo e(isset($add_course)? $add_course->outline: old('outline')); ?></textarea>
                                                <span class="focus-border textarea"></span>
                                                <script>
                                                    CKEDITOR.replace( "outline" );
                                                </script>
                                                <?php if($errors->has('outline')): ?>
                                                    <span class="error text-danger">
                                                        <strong><?php echo e($errors->first('outline')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div class="input-effect">
                                                <label><?php echo app('translator')->get('lang.prerequisites'); ?> <span></span></label>
                                                <textarea class="primary-input form-control<?php echo e($errors->has('prerequisites') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="prerequisites" maxlength="500"><?php echo e(isset($add_course)? $add_course->prerequisites: old('prerequisites')); ?></textarea>
                                                <span class="focus-border textarea"></span>
                                                <script>
                                                    CKEDITOR.replace( "prerequisites" );
                                                </script>
                                                <?php if($errors->has('prerequisites')): ?>
                                                    <span class="error text-danger">
                                                        <strong><?php echo e($errors->first('prerequisites')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div class="input-effect">
                                                <label><?php echo app('translator')->get('lang.resources'); ?> <span></span></label>
                                                <textarea class="primary-input form-control<?php echo e($errors->has('resources') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="resources" maxlength="500"><?php echo e(isset($add_course)? $add_course->resources: old('resources')); ?></textarea>
                                                <span class="focus-border textarea"></span>
                                                <script>
                                                    CKEDITOR.replace( "resources" );
                                                </script>
                                                <?php if($errors->has('resources')): ?>
                                                    <span class="error text-danger">
                                                        <strong><?php echo e($errors->first('resources')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div class="input-effect">
                                                <label><?php echo app('translator')->get('lang.stats'); ?> <span></span></label>
                                                <textarea class="primary-input form-control<?php echo e($errors->has('stats') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="stats" maxlength="500"><?php echo e(isset($add_course)? $add_course->stats: old('stats')); ?></textarea>
                                                <span class="focus-border textarea"></span>
                                                <script>
                                                    CKEDITOR.replace( "stats" );
                                                </script>
                                                <?php if($errors->has('stats')): ?>
                                                    <span class="error text-danger">
                                                        <strong><?php echo e($errors->first('stats')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        $tooltip = "";
                        if(userPermission(511)){
                                $tooltip = "";
                            }else{
                                $tooltip = "You have no permission to add";
                            }
                    ?>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.course'); ?></button></span>
                                <?php else: ?>
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php if(isset($add_course)): ?>
                                        <?php echo app('translator')->get('lang.update'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.course'); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
        <div class="col-lg-12 mt-40">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.course_list'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang.title'); ?></th>
                                <th><?php echo app('translator')->get('lang.overview'); ?></th>
                                <th><?php echo app('translator')->get('lang.image'); ?></th>
                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($course)): ?>
                                <?php $__currentLoopData = $course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$value->title); ?></td>
                                        <td><?php echo substr($value->overview, 0, 50); ?></td>
                                        <td><img src="<?php echo e(asset(@$value->image)); ?>" width="60px" height="50px"></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(510)): ?>
                                                        <a href="<?php echo e(route('course-Details-admin',$value->id)); ?>"
                                                        class="dropdown-item small fix-gr-bg modalLink"
                                                        title="Course Details" data-modal-size="full-width-modal">
                                                            <?php echo app('translator')->get('lang.view'); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(userPermission(512)): ?>
                                                        <a class="dropdown-item"
                                                        href="<?php echo e(route('edit-course',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <?php endif; ?>

                                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                    <span  tabindex="0" data-toggle="tooltip" title="Disabled For Demo"> <a href="#" class="dropdown-item small fix-gr-bg  demo_view" style="pointer-events: none;" ><?php echo app('translator')->get('lang.delete'); ?></a></span>
                                                        <?php else: ?>
                                                            <?php if(userPermission(513)): ?>
                                                                <a href="<?php echo e(route('for-delete-course',$value->id)); ?>"
                                                                class="dropdown-item small fix-gr-bg modalLink"
                                                                title="Delete Course" data-modal-size="modal-md">
                                                                    <?php echo app('translator')->get('lang.delete'); ?>
                                                                </a>
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
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/course/course_page.blade.php ENDPATH**/ ?>