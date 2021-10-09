
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.exam_attendance'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.exam_attendance'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.exam_attendance'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-title sm_mb_20">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>

                <?php if(userPermission(221)): ?>
                    <div class="col-lg-6 text-right col-md-6 text_xs_left col-sm-6">
                        <a href="<?php echo e(route('exam_attendance_create')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('lang.attendance_create'); ?>
                        </a>
                    </div>
                <?php endif; ?>
       
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_attendance', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                    <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                        <option data-display="<?php echo app('translator')->get('lang.select_exam'); ?> *" value=""><?php echo app('translator')->get('lang.select_exam'); ?> *</option>
                                        <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(@$exam->id); ?>"><?php echo e(@$exam->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('exam')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('exam')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="class_subject" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-lg-3 mt-30-md" id="select_class_subject_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_class_subject" id="select_class_subject" name="subject">
                                        <option data-display="<?php echo app('translator')->get('lang.select_subject'); ?> *" value=""><?php echo app('translator')->get('lang.select_subject'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_subject_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('subject')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md" id="m_select_subject_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> m_select_subject_section" id="m_select_subject_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> " value=" "><?php echo app('translator')->get('lang.select_section'); ?> </option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        <?php if(isset($exam_attendance_childs)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30"><?php echo app('translator')->get('lang.exam_attendance'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id_table" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php if(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th width="20%"><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th width="20%"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                        <th width="20%"><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                                        <th width="20%"><?php echo app('translator')->get('lang.roll'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th width="20%"><?php echo app('translator')->get('lang.attendance'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $exam_attendance_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->admission_no:""); ?><input type="hidden" name="id[]" value="<?php echo e(@$student->student_id); ?>"></td>
                                        <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->first_name.' '.@$student->studentInfo->last_name:""); ?></td>
                                        <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->class->class_name.'('.@$student->studentInfo->section->section_name.')':""); ?></td>
                                        <td><?php echo e(@$student->studentInfo !=""?@$student->studentInfo->roll_no:""); ?></td>
                                        <td>
                                            <?php if(@$student->attendance_type == 'P'): ?>
                                             <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('lang.present'); ?></button>
                                             <?php else: ?>
                                             <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('lang.absent'); ?></button>
                                             <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/examination/exam_attendance.blade.php ENDPATH**/ ?>