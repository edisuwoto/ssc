
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.guardian_report'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<input type="text" hidden value="<?php echo e(@$clas->class_name); ?>" id="cls">
<input type="text" hidden value="<?php echo e(@$clas->section_name->sectionName->section_name); ?>" id="sec">
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.guardian_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.guardian_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'guardian_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <div class="row">
                <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>*" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
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
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

            <?php if(isset($students)): ?>
            <div class="row mt-40"> 
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.guardian_report'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_ids" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="10">
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
                                        <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                                        <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.mobile'); ?></th>
                                        <th><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.relation_with_guardian'); ?></th>
                                        <th><?php echo app('translator')->get('lang.guardian_phone'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.father_name'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.father_phone'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.mother_name'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.mother_phone'); ?> </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($student->class)){ echo $student->class->class_name; }else { echo ''; } ?> 
                                            <?php if(!empty($student->section)){ echo $student->section->section_name; }else { echo ''; } ?>
                                        </td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td>
                                        <td><?php echo e($student->mobile); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->guardians_name:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->guardians_relation:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->guardians_mobile:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->fathers_name:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->fathers_mobile:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->mothers_name:""); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->mothers_mobile:""); ?></td>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/studentInformation/guardian_report.blade.php ENDPATH**/ ?>