
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.class_routine_create'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.class_routine_create'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.academics'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.class_routine_create'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class_routine_new', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id?'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6 mt-30-md" id="select_section_div">
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

    <?php if(isset($class_times)): ?>
        <section class="mt-20">
            <div class="container-fluid p-0">
                <div class="row mt-40">
                    <div class="col-lg-6 col-md-6">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('lang.class_routine_create'); ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 pull-right">
                        <a href="<?php echo e(route('classRoutinePrint', [$class_id, $section_id])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="display school-table school-table-style" cellspacing="0" width="100%">
                            <thead>
                            <?php if(session()->has('success') != "" || session()->has('danger') != ""): ?>
                                <tr>
                                    <td colspan="8">
                                        <?php if(session()->has('success') != ""): ?>

                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('success')); ?>

                                            </div>

                                        <?php else: ?>

                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('danger')); ?>

                                            </div>

                                    </td>

                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.period'); ?></th>
                                <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e(@$sm_weekend->name); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $class_times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($class_time->period); ?>

                                        <br>
                                        <?php echo e(date('h:i A', strtotime($class_time->start_time)).' - '.date('h:i A', strtotime($class_time->end_time))); ?>

                                    </td>

                                    <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <td>
                                            <?php if(@$class_time->is_break == 0): ?>
                                                <?php if(@$sm_weekend->is_weekend != 1): ?>


                                                    <?php
                                                        $assinged_class_routine = App\SmClassRoutineUpdate::assingedClassRoutine($class_time->id, $sm_weekend->id, $class_id, $section_id);
                                                    ?>
                                                    <?php if(@$assinged_class_routine == ""): ?>

                                                        <?php if(userPermission(247)): ?>

                                                            <div class="col-lg-6 text-right">
                                                                <a href="<?php echo e(route('add-new-routine', [$class_time->id, $sm_weekend->id, $class_id, $section_id])); ?>" class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('lang.create_class_routine'); ?>">
                                                                    <span class="ti-plus" id="addClassRoutine"></span>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <span class=""><?php echo e(@$assinged_class_routine->subject !=""?@$assinged_class_routine->subject->subject_name:""); ?></span>
                                                        <br>
                                                        <span class=""><?php echo e(@$assinged_class_routine->classRoom!=""?@$assinged_class_routine->classRoom->room_no:""); ?></span></br>
                                                        <span class="tt"><?php echo e(@$assinged_class_routine->teacherDetail!=""?@$assinged_class_routine->teacherDetail->full_name:""); ?></span></br>
                                                        <?php if(userPermission(248)): ?>

                                                            <a href="<?php echo e(route('edit-class-routine', [$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id])); ?>" class="modalLink" data-modal-size="modal-md" title="Edit Class routine"><span class="ti-pencil-alt" id="addClassRoutine"></span></a>
                                                        <?php endif; ?>
                                                        <?php if(userPermission(249)): ?>

                                                            <a href="<?php echo e(route('delete-class-routine-modal', [@$assinged_class_routine->id])); ?>" class="modalLink" data-modal-size="modal-md" title="Delete Class routine"><span class="ti-trash" id="addClassRoutine"></span></a>

                                                        <?php endif; ?>
                                                    <?php endif; ?>


                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.weekend'); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/academics/class_routine_new.blade.php ENDPATH**/ ?>