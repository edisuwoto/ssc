
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.create'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<link rel="stylesheet" href="<?php echo e(url('Modules/Lesson/Resources/assets/css/lesson_plan.css')); ?>">

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.create'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.create'); ?></a>
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
                  
                   <?php if(userPermission(810) ): ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lesson-planner', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="teacher">
                                    <option data-display="<?php echo app('translator')->get('lang.select_teacher'); ?> *" value=""><?php echo app('translator')->get('lang.select_teacher'); ?> *</option>
                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$teacher->id); ?>"  <?php echo e(isset($teacher_id)? ($teacher_id == $teacher->id?'selected':''):''); ?>><?php echo e(@$teacher->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('teacher')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('teacher')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-6 mt-20 text-left">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if(isset($class_times)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-12 col-md-12">
                <div class="main-title">
                    <?php
                  
                     $dates[6];
                    if(isset($week_number)){
                        $week_number=$week_number;
                    } else{
                        $week_number=$this_week;
                    } 

                     ?>

                    <h3 class="text-center "><a href="<?php echo e(url('/lesson/dicrease-week/'.$teacher_id.'/'.$dates[0])); ?>"><</a> Week <?php echo e($week_number); ?> | <span class="yearColor"> <?php echo e(date('Y', strtotime($dates[0]))); ?> </span><a href="<?php echo e(url('/lesson/change-week/'.$teacher_id.'/'.$dates[6])); ?>"> > </a></h3> 
                
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <?php if(session()->has('success') != ""): ?>
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('success')); ?>

                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Class Period</th>

                            <?php
                                $i=0;
                            ?>
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e(@$sm_weekend->name); ?> <br>
                             
                                <?php echo e(date('d-M-y', strtotime($dates[$i++]))); ?>

                                

                        </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tr>
                    </thead>

                    <tbody>
                       
                            
                        
                        <?php $__currentLoopData = $class_times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                       
                  
                        <tr>
                            <td><?php echo e(@$class_time->period); ?><br><?php echo e(date('h:i A', strtotime(@$class_time->start_time)).' - '.date('h:i A', strtotime(@$class_time->end_time))); ?></td>
                            <?php
                                $j=0;
                            ?>
                          
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                           
                            <td>
                                <?php
                                    $lesson_date=$dates[$j++];
                                ?>                                
                                
                                <?php if(@$class_time->is_break == 0): ?>

                                <?php if(@$sm_weekend->is_weekend != 1): ?>

                                <?php
                                    @$assinged_class_routine = App\SmClassRoutineUpdate::teacherAssingedClassRoutine(@$class_time->id, @$sm_weekend->id, $teacher_id);

                                ?>
                              
                                <?php if(@$assinged_class_routine == ""): ?>
                                            <?php echo app('translator')->get('lang.n_a'); ?>
                                            
                                <?php else: ?>
                                <?php
                                $class_id=$assinged_class_routine->class_id;
                                $section_id=$assinged_class_routine->section_id;   
                                $subject_id=$assinged_class_routine->subject_id;
                                ?>
                              
                                    <span class=""><strong><?php echo e(@$assinged_class_routine->subject->subject_name); ?> </strong></span>
                                    
                                    <br>
                                    <span class="">class: <?php echo e(@$assinged_class_routine->class->class_name); ?></span><br>
                                    <span class="">section : <?php echo e(@$assinged_class_routine->section->section_name); ?></span></br>
                                    <span class="">Room:<?php echo e(@$assinged_class_routine->classRoom->room_no); ?></span></br>
                                        <?php
                                       
                                        $lessonPlan=DB::table('lesson_planners')
                                                ->where('lesson_date',$lesson_date) 
                                                ->where('class_id',$class_id)     
                                                ->where('section_id',$section_id)    
                                                ->where('subject_id',$subject_id)                                             
                                                ->where('academic_id', getAcademicId())
                                                 ->where('school_id',Auth::user()->school_id)
                                                ->first();
                                                ?>
                                        <?php if($lessonPlan): ?>
                                        <div class="row">
                                               <?php if(userPermission(814)): ?>
                                            <div class="col-lg-2 text-right">
                                                <a href="<?php echo e(route('view-lesson-planner-lesson', [$lessonPlan->id,$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])); ?>" 
                                                    class="primary-btn small tr-bg icon-only modalLink"
                                                    title="<?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.overview'); ?> " data-modal-size="modal-lg" >
                                                    <span class="ti-eye" id=""></span>
                                                </a>
                                            </div>
                                             <?php endif; ?>
                                               <?php if(userPermission(813)): ?>
                                                     <div class="col-lg-2 text-right">
                                                        <a href="<?php echo e(route('delete-lesson-planner-lesson', [$lessonPlan->id])); ?>" 
                                                            class="primary-btn small tr-bg icon-only  modalLink" data-modal-size="modal-md" 
                                                            title="<?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?>">
                                                            <span class="ti-close" id=""></span>
                                                        </a>
                                                    </div>
                                             <?php endif; ?>
                                               <?php if(userPermission(812)): ?>
                                                    <div class="col-lg-2 text-right">
                                                        <a href="<?php echo e(route('edit-lesson-planner-lesson', [$lessonPlan->id,$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])); ?>" 
                                                            class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                            title="<?php echo app('translator')->get('lang.edit'); ?> <?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo e(date('d-M-y',strtotime($lesson_date))); ?> ( <?php echo e(date('h:i A', strtotime(@$assinged_class_routine->classTime->start_time))); ?>-<?php echo e(date('h:i A', strtotime(@$assinged_class_routine->classTime->end_time))); ?> )">
                                                            <span class="ti-pencil" id=""></span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                        </div>
                                        <?php else: ?>
                                       
                                            <?php if(userPermission(811)): ?>
                                                <div class="col-lg-6 text-right">
                                                    <a href="<?php echo e(route('add-lesson-planner-lesson', [$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])); ?>" 
                                                        class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                        title="<?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo e(date('d-M-y',strtotime($lesson_date))); ?> ( <?php echo e(date('h:i A', strtotime(@$assinged_class_routine->classTime->start_time))); ?>-<?php echo e(date('h:i A', strtotime(@$assinged_class_routine->classTime->end_time))); ?> )">
                                                        <span class="ti-plus" id="addClassRoutine"></span>
                                                    </a>
                                                </div>
                                             <?php endif; ?>
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


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Lesson/Resources/views/lessonPlan/lesson_planner.blade.php ENDPATH**/ ?>