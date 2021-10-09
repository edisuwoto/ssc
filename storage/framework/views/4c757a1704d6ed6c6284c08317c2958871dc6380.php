
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.homework_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php
    $DATE_FORMAT = systemDateFormat();   
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.homework_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.home_work'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.homework_list'); ?></a>
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
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('add-homeworks')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add_homework'); ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'homework-list', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>" name="class_id"  id="class_subject">
                                <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?></option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->class_name); ?></option>
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
                            <div class="input-effect" id="select_class_subject_div">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('subject_id') ? ' is-invalid' : ''); ?> select_class_subject" name="subject_id" id="select_class_subject">
                                    <option data-display="<?php echo app('translator')->get('lang.select_subjects'); ?>" value=""><?php echo app('translator')->get('lang.subject'); ?></option>
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
                            <div class="input-effect" id="m_select_subject_section_div">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?> m_select_subject_section" name="section_id" id="m_select_subject_section">
                                     <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.section'); ?></option>
                                 </select>
                                 <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                 <span class="focus-border"></span>
                                 <?php if($errors->has('section_id')): ?>
                                 <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
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
    <?php if(@$homeworkLists): ?>                                
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.homework_list'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang.class'); ?></th>
                                <th><?php echo app('translator')->get('lang.section'); ?></th>
                                <th><?php echo app('translator')->get('lang.subject'); ?></th>
                                <th><?php echo app('translator')->get('lang.marks'); ?></th>
                                <th><?php echo app('translator')->get('lang.home_work'); ?> <?php echo app('translator')->get('lang.date'); ?></th>
                                <th><?php echo app('translator')->get('lang.submission'); ?> <?php echo app('translator')->get('lang.date'); ?></th>
                                <th><?php echo app('translator')->get('lang.evaluation'); ?> <?php echo app('translator')->get('lang.date'); ?></th>
                                <th><?php echo app('translator')->get('lang.created_by'); ?></th>
                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = @$homeworkLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->classes  !=""?$value->classes->class_name:""); ?></td>
                                <td><?php echo e($value->sections !=""?$value->sections->section_name:""); ?></td>
                                <td><?php echo e($value->subjects !=""?$value->subjects->subject_name:""); ?></td>
                                <td><?php echo e($value->marks); ?></td>
                                <td data-sort="<?php echo e(strtotime($value->homework_date)); ?>">
                                    <?php echo e($value->homework_date != ""? date_format(date_create($value->homework_date), $DATE_FORMAT):''); ?>

                                </td>
                                <td data-sort="<?php echo e(strtotime($value->submission_date)); ?>">
                                    <?php echo e($value->submission_date != ""? date_format(date_create($value->submission_date), $DATE_FORMAT):''); ?>

                                </td>
                                <td  data-sort="<?php echo e(strtotime($value->evaluation_date)); ?>" >
                                <?php if(!empty($value->evaluation_date)): ?>
                                <?php echo e($value->evaluation_date != ""? date_format(date_create($value->evaluation_date), $DATE_FORMAT):''); ?>

                                <?php endif; ?>
                                </td>
                                <td><?php echo e($value->users !=""? $value->users->full_name:""); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->get('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                          <?php if(userPermission(281)): ?>
                                          <a class="dropdown-item" title="Evaluation Homework" 
                                                href="<?php echo e(route('evaluation-homework',[@$value->class_id,@$value->section_id,@$value->id])); ?>">
                                                <?php echo app('translator')->get('lang.evaluation'); ?>
                                          </a>
                                         <?php endif; ?>
                                          <?php if(userPermission(282)): ?>
                                           <a class="dropdown-item" href="<?php echo e(route('homework_edit', [$value->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                           <?php endif; ?>
                                            <?php if(userPermission(283)): ?>
                                            <a onclick="GlobaldeleteId();" class="dropdown-item"  data-url="<?php echo e(route('homework_delete',$value->id)); ?>"  href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                        <?php endif; ?>
                                        </div>
                                    </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/homework/homeworkList.blade.php ENDPATH**/ ?>