
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.optional_subject'); ?>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.assign_optional_subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
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
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.assign_optional_subject'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"> 
                <div class="white-box">
                    <?php if(userPermission(425)): ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'optional_subject_setup_post', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                    <?php endif; ?>    
                    <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-4">
                                    <label><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.class'); ?> *</label>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="input-effect">
                                            <input type="checkbox" id="class<?php echo e(@$class->id); ?>" class="common-checkbox exam-checkbox" name="class[]" value="<?php echo e(@$class->id); ?>" <?php echo e(isset($editData)? (@$class->id == @$editData->class_id? 'checked':''):''); ?>>
                                            <label for="class<?php echo e(@$class->id); ?>"><?php echo e(@$class->class_name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-effect">
                                    <input type="checkbox" id="all_exams" class="common-checkbox" name="all_exams[]" value="0" <?php echo e((is_array(old('class')) and in_array(@$class->id, old('class'))) ? ' checked' : ''); ?>>
                                    <label for="all_exams"><?php echo app('translator')->get('lang.all'); ?> <?php echo app('translator')->get('lang.select'); ?></label>
                                </div>
                                <?php if($errors->has('class')): ?>
                                <span class="text-danger validate-textarea-checkbox" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                            <?php endif; ?>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input oninput= "numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('gpa_above') ? ' is-invalid' : ''); ?>"
                                             name="gpa_above" id="exam_mark_main" autocomplete="off" value="<?php echo e(isset($editData)?  number_format(@$editData->gpa_above, 2, '.', ' ') : 0); ?>" >
                                            <label><?php echo app('translator')->get('lang.gpa_above'); ?> *</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('gpa_above')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('gpa_above')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                               <?php 
                                    $tooltip = "";
                                    if(userPermission(425)){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                ?>
                                <div class="col-lg-4 mt-30-md" id="select_subject_div">
                                    <button type="submit" class="primary-btn small fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                        <span class="pr-2"></span>
                                        <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('lang.update'); ?>
                                        <?php else: ?>
                                        <?php echo app('translator')->get('lang.save'); ?>
                                        <?php endif; ?>
                                    </button>
                                </div> 
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</section>
 <?php if(isset($class_optionals)): ?>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-12 col-md-12">
                    <div class="main-title">
                        <h3 class="mb-30"> <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?>  </h3>
                    </div>
                </div>
                
            </div>
            <div class="row"> 
                <div class="col-lg-12">

               
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                       <?php if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != ""): ?>
                        <tr>
                            <td colspan="5">
                                 <?php if(session()->has('message-success-delete')): ?>
                                  <div class="alert alert-success">
                                      <?php echo e(session()->get('message-success-delete')); ?>

                                  </div>
                                <?php elseif(session()->has('message-danger-delete')): ?>
                                  <div class="alert alert-danger">
                                      <?php echo e(session()->get('message-danger-delete')); ?>

                                  </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php echo app('translator')->get('lang.sl'); ?></th>
                            <th><?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                            <th><?php echo app('translator')->get('lang.gpa_above'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $class_optionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_optional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$i); ?></td>
                            <td><?php echo e(@$class_optional->class_name); ?></td>
                            <td><?php echo e(number_format(@$class_optional->gpa_above, 2, '.', ' ')); ?></td>
                           
                            <td>
                                <div class="row">
                                   
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(426)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('class_optional_edit', [@$class_optional->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(427)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e(@$class_optional->id); ?>"  href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    
                                </div>


                               

                            </td>
                        </tr>
                         <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e(@$class_optional->id); ?>" >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="text-center">
                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                        </div>

                                        <div class="mt-40 d-flex justify-content-between">
                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                            <a href="<?php echo e(route('delete_optional_subject', [@$class_optional->id])); ?>" class="text-light">
                                            <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                             </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>
<?php endif; ?>
  
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/systemSettings/optional_subject_setup.blade.php ENDPATH**/ ?>