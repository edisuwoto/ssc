

<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.optional_subject'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.optional_subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.academics'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.optional_subject'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"> 
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'assign_optional_subject_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                          
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>*" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>


                                <div class="col-lg-4 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-4 mt-30-md" id="select_subject_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e(@$errors->has('subject') ? ' is-invalid' : ''); ?> select_subject" id="select_subject" name="subject">
                                        <option data-display="<?php echo app('translator')->get('lang.select_subjects'); ?> *" value=""><?php echo app('translator')->get('lang.select_subjects'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_subject_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('subject')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('subject')); ?></strong>
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
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-6 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.assign'); ?> <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?> - (<?php echo e(@$subject_info->subject_name); ?>)  </h3>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                     
                </div>
            </div>
            <style>
            .all_check{
                background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
                color: #ffffff;
                background-size: 200% auto;
            }
            </style>
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="white-box"> 
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'assign-optional-subject-store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'formid'])); ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="assign-subject" id="assign-subject">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                        <input type="hidden" name="class_id" id="class_id" value="<?php echo e(@$class_id); ?>">
                                        <input type="hidden" name="section_id" id="class_id" value="<?php echo e(@$section_id); ?>">
                                        <input type="hidden" name="subject_id" id="" value="<?php echo e(@$subject_id); ?>">
                                        <input type="hidden" name="update" value="1"> 
                                        <div class="table-responsive">
                                        
                                        <table id="" class="display school-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><span class="all_check btn btn-sm fix-gr-bg" id="all_check" tyle="width: 143.715px; height: 143.715px; top: -48.611px; left: -26.5173px;" > Select All </span> </th> 
                                                    <th class="nowrap p-2" ><?php echo app('translator')->get('lang.admission_no'); ?>.</th>
                                                    <th class="nowrap p-2"><?php echo app('translator')->get('lang.name'); ?></th>
                                                    <th class="nowrap p-2"><?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?></th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1; ?>
                                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php 
                                                    $subjects =  DB::table('sm_optional_subject_assigns')
                                                    ->leftjoin('sm_subjects', 'sm_subjects.id', 'sm_optional_subject_assigns.subject_id')
                                                    ->select('sm_optional_subject_assigns.*', 'sm_subjects.subject_name')
                                                    ->where('sm_optional_subject_assigns.student_id', '=', @$student->id)
                                                    ->first();
                                                ?> 
                                                <tr>
                                                    <td>  
                                                        <div class="col-lg-12"> 
                                                            <div class="input-effect">
                                                                <input type="checkbox" id="optional_subject_<?php echo e(@$count); ?>" class="common-checkbox optional_subject fix-gr-bg small" name="student_id[]" <?php echo e((@$subjects->subject_name == @$subject_info->subject_name? 'checked': '' )); ?> value="<?php echo e(@$student->id); ?>">
                                                                <label for="optional_subject_<?php echo e(@$count); ?>"><?php echo e(@$count++); ?></label>
                                                            </div> 
                                                        </div> 
                                                    </td> 
                                                    <td><?php echo e(@$student->admission_no); ?></td>
                                                    <td class="nowrap"><?php echo e(@$student->full_name); ?></td> 
                                                    <td>
                                                        <span class="" style="border-bottom: 2px dashed #ddd !important;"><?php echo e(@$subjects->subject_name); ?></span>
                                                    </td>   
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table> 
                                        </div>
                                    </div>
                                </div>
                                <?php if(userPermission(251)): ?>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-save pr-2"></span>
                                        <?php echo app('translator')->get('lang.assign'); ?>  <?php echo app('translator')->get('lang.subject'); ?>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<script language="JavaScript">
function checkAll() {
    console.log("clicked");
        
        $('input:checkbox').prop('checked', this.checked);
} 


</script>
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/academics/assign_optional_subject.blade.php ENDPATH**/ ?>