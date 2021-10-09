
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.class_report'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 



<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.class_report'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.class_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                </div>
            </div>
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
                <?php if(session()->has('message-danger') != ""): ?>
                    <?php if(session()->has('message-danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session()->get('message-danger')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-6 mt-30-md col-md-6">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6 mt-30-md col-md-6" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
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
    </div>
</section>
<?php if(isset($students)): ?>
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30"><?php echo app('translator')->get('lang.class_report_for_class'); ?> <?php echo e(@$search_class->class_name); ?> <?php echo e($section != ""? 'section ('. $section->section_name.')': ''); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.information'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.quantity'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.number_of_student'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($students->count()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.total_subjects_assigned'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e(count($assign_subjects)); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.subjects'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.teacher'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $__currentLoopData = $assign_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign_subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($assign_subject->subject !=""?$assign_subject->subject->subject_name:""); ?>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php if($assign_subject->teacher_id != ""): ?>
                                            <?php echo e($assign_subject->teacher->full_name); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    <?php if($assign_class_teachers != ""): ?>

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.class_teacher'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        <?php echo app('translator')->get('lang.information'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.name'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->full_name:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.mobile'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($assign_class_teachers !=""?$assign_class_teachers->teacher->mobile:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.email'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->email:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo app('translator')->get('lang.address'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        <?php echo e($assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->current_address:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="student-meta-box">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                <?php echo app('translator')->get('lang.type'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                <?php echo app('translator')->get('lang.collection'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                <?php echo app('translator')->get('lang.due'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                <?php echo app('translator')->get('lang.fees_collection'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                <?php echo e(number_format($total_collection, 2)); ?><input type="hidden" id="total_collection" name="total_collection" value="<?php echo e($total_collection); ?>">
                                            </div>
                                        </div>
                                     
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                <?php echo e(number_format(@$total_due, 2)); ?>

                                                <input type="hidden" id="total_assign" name="total_assign" value="<?php echo e(@$total_due); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="value text-left text-uppercase bb-15 pb-7">
                                                <?php echo app('translator')->get('lang.fees_details'); ?>
                                            </div>

                                            <!-- <div id="commonBarChart" height="150px"></div> -->
                                            <div id="donutChart" height="200px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/reports/class_report.blade.php ENDPATH**/ ?>