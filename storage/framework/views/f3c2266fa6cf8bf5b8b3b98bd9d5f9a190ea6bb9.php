
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.import'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.import'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_admission'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.import'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-3 text-right mb-20">
                <a href="<?php echo e(url('/public/backEnd/bulksample/students.xlsx')); ?>">
                    <button class="primary-btn tr-bg text-uppercase bord-rad">
                        <?php echo app('translator')->get('lang.download_sample_file'); ?>
                        <span class="pl ti-download"></span>
                    </button>
                </a>
            </div>
        </div>

    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_bulk_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form'])); ?>

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

                <div class="white-box">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <div class="box-body">      
                                        <br>           
                                        1. <?php echo app('translator')->get('lang.point1'); ?><br>
                                        2. <?php echo app('translator')->get('lang.point2'); ?><br>
                                        3. <?php echo app('translator')->get('lang.point3'); ?><br>
                                        4. <?php echo app('translator')->get('lang.point4'); ?><br>
                                        
                                        5. <?php echo app('translator')->get('lang.point6'); ?>(
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($gender->id.'='.$gender->base_setup_name.','); ?>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        ).<br>
                                        6. <?php echo app('translator')->get('lang.point7'); ?>(
                                        <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($blood_group->id.'='.$blood_group->base_setup_name.','); ?>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        ).<br>
                                        7. <?php echo app('translator')->get('lang.point8'); ?>(
                                        <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($religion->id.'='.$religion->base_setup_name.','); ?>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        ).<br>
                                        8. For relation with guardian (F=Father, M=Mother, O=Other)<br>
                                        9. Please follow this date format(2020-06-15) for Date of birth & Admission date<br>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="row mb-40 mt-30">

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session') ? ' is-invalid' : ''); ?>" name="session" id="academic_year">
                                        <option data-display="<?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.academic_year'); ?> *</option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(old('session') == $session->id? 'selected': ''); ?>><?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('session')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('session')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect" id="class-div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                        <option data-display="<?php echo app('translator')->get('lang.class'); ?> *" value=""><?php echo app('translator')->get('lang.class'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control <?php echo e($errors->has('file') ? ' is-invalid' : ''); ?>" type="text" id="placeholderPhoto" placeholder="Excel file"
                                                readonly>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('file')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="file" id="photo">
                                        </button>
                                    </div>
                                </div>
                            </div>
                                
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.save_bulk_students'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/studentInformation/import_student.blade.php ENDPATH**/ ?>