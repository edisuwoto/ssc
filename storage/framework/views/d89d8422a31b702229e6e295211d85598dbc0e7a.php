
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.add_homework'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.add_homework'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.home_work'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.add_homework'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">

        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.add_homework'); ?></h3>
                    </div>
                </div>
            </div>
            <?php if(userPermission(279)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'saveHomeworkData', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="row mb-30">
                                <div class="col-lg-4">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>"
                                                name="class_id" id="classSelectStudentHomeWork">
                                            <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *"
                                                    value=""><?php echo app('translator')->get('lang.select'); ?></option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>" <?php echo e(old('class_id') != ""? 'selected':''); ?>><?php echo e($value->class_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('class_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class_id')); ?></strong>
                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-effect sm2_mb_20 md_mb_20" id="subjectSelecttHomeworkDiv">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('subject_id') ? ' is-invalid' : ''); ?>"
                                                name="subject_id" id="subjectSelect">
                                            <option data-display="<?php echo app('translator')->get('lang.select_subjects'); ?> *"
                                                    value=""><?php echo app('translator')->get('lang.subject'); ?> *
                                            </option>
                                        </select>
                                        <div class="pull-right loader loader_style" id="select_subject_loader">
                                            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                        </div>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('subject_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('subject_id')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    
                                    <div class="col-lg-12 " id="selectSectionsDiv" style="margin-top: -25px;">
                                        <label for="checkbox" class="mb-2"><?php echo app('translator')->get('lang.section'); ?> *</label>
                                            <select multiple id="selectSectionss" name="section_id[]" style="width:300px">
                                              
                                            </select>
                                            <div class="">
                                            <input type="checkbox" id="checkbox_section" class="common-checkbox homework-section">
                                            <label for="checkbox_section" class="mt-3"><?php echo app('translator')->get('lang.select_all'); ?></label>
                                            </div>
                                            <?php if($errors->has('section_id')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert" style="display:block">
                                                    <strong style="top:-25px"><?php echo e($errors->first('section_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                         
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input date form-control<?php echo e($errors->has('homework_date') ? ' is-invalid' : ''); ?>"
                                                       id="homework_date" type="text" name="homework_date"
                                                       value="<?php echo e(old('homework_date') != ""? old('homework_date'): date('m/d/Y')); ?>"
                                                       readonly>
                                                <label><?php echo app('translator')->get('lang.home_work'); ?> <?php echo app('translator')->get('lang.date'); ?>
                                                    <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('homework_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('homework_date')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="homework_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input date form-control<?php echo e($errors->has('submission_date') ? ' is-invalid' : ''); ?>"
                                                       id="submission_date" type="text" name="submission_date"
                                                       value="<?php echo e(old('submission_date') != ""? old('submission_date') : date('m/d/Y')); ?>"
                                                       readonly>
                                                <label><?php echo app('translator')->get('lang.submission'); ?> <?php echo app('translator')->get('lang.date'); ?>
                                                    <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('submission_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('submission_date')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="submission_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('marks') ? ' is-invalid' : ''); ?>"
                                                       type="text" name="marks" value="<?php echo e(old('marks')); ?>">
                                                <label><?php echo app('translator')->get('lang.marks'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('marks')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('marks')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text"
                                                       id="placeholderHomeworkName"
                                                       placeholder="<?php echo app('translator')->get('lang.attach_file'); ?>"
                                                       disabled>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('homework_file')): ?>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e($errors->first('homework_file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="homework_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" name="homework_file"
                                                       id="homework_file">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row md-20">
                                <div class="col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                            <textarea
                                                    class="primary-input form-control<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>"
                                                    cols="0" rows="4" name="description"
                                                    id="description *"><?php echo e(old('description')); ?></textarea>
                                        <label><?php echo app('translator')->get('lang.description'); ?> <span>*</span> </label>
                                        <span class="focus-border textarea"></span>
                                        <?php if($errors->has('description')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('description')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $tooltip = "";
                            if(userPermission(279)){
                                  $tooltip = "";
                              }else{
                                  $tooltip = "You have no permission to add";
                              }
                        ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.home_work'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/homework/addHomework.blade.php ENDPATH**/ ?>