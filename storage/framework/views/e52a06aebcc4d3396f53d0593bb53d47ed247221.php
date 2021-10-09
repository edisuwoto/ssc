
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.marks_grade'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.marks_grade'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.marks_grade'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($marks_grade)): ?>
             <?php if(userPermission(226)): ?>

                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('marks-grade')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('lang.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="row">
                
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30"><?php if(isset($marks_grade)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.grade'); ?>
                                </h3>
                            </div>
                            <?php if(isset($marks_grade)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('marks-grade-update',$marks_grade->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                            <?php if(userPermission(226)): ?>

                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks-grade',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
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
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e($errors->has('grade_name') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="grade_name" autocomplete="off"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->grade_name:Request::old('grade_name')); ?>">
                                                <input type="hidden" name="id"
                                                       value="<?php echo e(isset($marks_grade)? $marks_grade->id: ''); ?>">
                                                <label> <?php echo app('translator')->get('lang.grade'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('grade_name')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('grade_name')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)"
                                                    class="primary-input form-control<?php echo e($errors->has('gpa') ? ' is-invalid' : ''); ?>"
                                                    type="text" step="0.1" name="gpa" autocomplete="off"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->gpa:Request::old('gpa')); ?>">
                                                <input type="hidden" name="id"
                                                       value="<?php echo e(isset($marks_grade)? $marks_grade->id: Request::old('gpa')); ?>">
                                                <label><?php echo app('translator')->get('lang.gpa'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('gpa')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('gpa')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)"
                                                    class="primary-input form-control<?php echo e($errors->has('percent_from') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="percent_from" autocomplete="off" onkeypress="return isNumberKey(event)"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->percent_from:Request::old('percent_from')); ?>">
                                                <label><?php echo app('translator')->get('lang.percent_from'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('percent_from')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('percent_from')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)"
                                                    class="primary-input form-control<?php echo e($errors->has('percent_upto') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="percent_upto" autocomplete="off" onkeypress="return isNumberKey(event)"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->percent_upto:Request::old('percent_upto')); ?>">
                                                <input type="hidden" name="id"
                                                       value="<?php echo e(isset($marks_grade)? $marks_grade->id: ''); ?>">
                                                <label><?php echo app('translator')->get('lang.percent'); ?> <?php echo app('translator')->get('lang.to'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('percent_upto')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('percent_upto')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)"
                                                    class="primary-input form-control<?php echo e($errors->has('grade_from') ? ' is-invalid' : ''); ?>"
                                                    type="text" step="0.1" name="grade_from" autocomplete="off"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->from:Request::old('grade_from')); ?>">
                                                <label><?php echo app('translator')->get('lang.gpa'); ?> <?php echo app('translator')->get('lang.from'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('grade_from')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('grade_from')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)"
                                                    class="primary-input form-control<?php echo e($errors->has('grade_upto') ? ' is-invalid' : ''); ?>"
                                                    type="text" step="0.1" name="grade_upto" autocomplete="off"
                                                    value="<?php echo e(isset($marks_grade)? $marks_grade->up: ''); ?>">
                                                <input type="hidden" name="id"
                                                       value="<?php echo e(isset($marks_grade)? $marks_grade->id: ''); ?>">
                                                <label><?php echo app('translator')->get('lang.gpa'); ?> <?php echo app('translator')->get('lang.to'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('grade_upto')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('grade_upto')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="4"
                                                          name="description"><?php echo e(isset($marks_grade)? $marks_grade->description: Request::old('description')); ?></textarea>
                                                <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                                <span class="focus-border textarea"></span>
                                                <?php if($errors->has('description')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('description')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
	                                <?php 
                                        $tooltip = "";
                                      if(userPermission(226)){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                    ?>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                           <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>

                                                <?php if(isset($marks_grade)): ?>
                                                    <?php echo app('translator')->get('lang.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.save'); ?>
                                                <?php endif; ?>
                                                <?php echo app('translator')->get('lang.grade'); ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.grade'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                        <td colspan="4">
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
                                    <th>
                                        <?php echo app('translator')->get('lang.sl'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('lang.grade'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('lang.gpa'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('lang.percent'); ?> (<?php echo app('translator')->get('lang.from'); ?>-<?php echo app('translator')->get('lang.to'); ?>)
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('lang.gpa'); ?> (<?php echo app('translator')->get('lang.from'); ?>-<?php echo app('translator')->get('lang.to'); ?>)
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('lang.action'); ?>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $i=1;
                                    ?>
                                <?php $__currentLoopData = $marks_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marks_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e(@$i++); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$marks_grade->grade_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$marks_grade->gpa); ?>

                                        </td>
                                        <td>
                                            <?php echo e(@$marks_grade->percent_from); ?>-<?php echo e(@$marks_grade->percent_upto); ?>%
                                        </td>
                                        <td>
                                            <?php echo e(@$marks_grade->from); ?>-<?php echo e(@$marks_grade->up); ?>

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                   <?php if(userPermission(227)): ?>

                                                   <a class="dropdown-item" href="<?php echo e(route('marks-grade-edit', [$marks_grade->id
                                                    ])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                   <?php endif; ?>
                                                   <?php if(userPermission(228)): ?>

                                                   <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deleteMarksGradeModal<?php echo e(@$marks_grade->id); ?>"
                                                       href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                               <?php endif; ?>
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteMarksGradeModal<?php echo e(@$marks_grade->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.grade'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                        <?php echo e(Form::open(['route' => array('marks-grade-delete',$marks_grade->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                        <button class="primary-btn fix-gr-bg"
                                                                type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                        <?php echo e(Form::close()); ?>

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
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/examination/marks_grade.blade.php ENDPATH**/ ?>