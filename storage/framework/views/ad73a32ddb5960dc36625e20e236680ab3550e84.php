
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.teacher'); ?> <?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.overview'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<link rel="stylesheet" href="<?php echo e(url('Modules/Lesson/Resources/assets/css/jquery-ui.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('Modules/Lesson/Resources/assets/css/lesson_plan.css')); ?>">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
      $( "#progressbar" ).progressbar({
        value: <?php if(isset($percentage)): ?> <?php echo e($percentage); ?> <?php endif; ?>
      });
    } );
</script>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.teacher'); ?> <?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.overview'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?> <?php echo app('translator')->get('lang.overview'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
  
    </div>

            <div class="row">
                <div class="col-lg-12">
         
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search-lesson-plan', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_lesson_Plan'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('teahcer') ? ' is-invalid' : ''); ?>" name="teacher">
                                        <option data-display="<?php echo app('translator')->get('lang.select_teacher'); ?> *" value=""><?php echo app('translator')->get('lang.select_teacher'); ?> *</option>
                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($teacher->id); ?>"  <?php echo e(isset($teacher_id)? ($teacher_id == $teacher->id? 'selected':''):''); ?>><?php echo e($teacher->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                    <?php if($errors->has('teacher')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('teacher')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
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
    
    
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                        <?php if(isset($sections)): ?>
                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($section->id); ?>"  <?php echo e(isset($section_id)? ($section_id == $section->id? 'selected':''):''); ?>><?php echo e($section->section_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="pull-right loader" id="select_section_loader" style="margin-top: -30px;padding-right: 21px;">
                                        <img src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="" style="width: 28px;height:28px;">
                                    </div> 
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
    
                                <div class="col-lg-3 mt-30-md" id="select_subject_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_subject" id="select_subject" name="subject">
                                        <option data-display="Select subject *" value=""><?php echo app('translator')->get('lang.select_subjects'); ?> *</option>
                                        <?php if(isset($subjects)): ?>
                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subject->id); ?>"  <?php echo e(isset($subject_id)? ($subject_id == $subject->id? 'selected':''):''); ?>><?php echo e($subject->subject_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="pull-right loader" id="select_subject_loader" style="margin-top: -30px;padding-right: 21px;">
                                        <img src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="" style="width: 28px;height:28px;">
                                    </div> 
                                    <?php if($errors->has('subject')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
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
            <?php if(isset($lessonPlanner)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title" style="padding-left: 15px;">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.progress'); ?> 
                                
                            
                            </h3><br><?php if(isset($total)): ?>
                            <?php echo e($completed_total); ?>/<?php echo e($total); ?>

                            <?php endif; ?>
                            
                            <div id="progressbar" style="height: 10px;margin-bottom:0px"></div>
                           <div class="pull-right" style="margin-top: -30px;">
                            <?php if(isset($percentage)): ?> <?php echo e((int)($percentage)); ?>  % <?php endif; ?>
                           </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%"> 
                        <thead>
                         
                            <tr>
                            <th><?php echo app('translator')->get('lang.lesson'); ?></th>
                            <th><?php echo app('translator')->get('lang.topic'); ?></th>
                            <th><?php echo app('translator')->get('lang.sup_topic'); ?></th>
                            <th><?php echo app('translator')->get('lang.completed'); ?> <?php echo app('translator')->get('lang.date'); ?> </th>
                            <th><?php echo app('translator')->get('lang.upcoming'); ?> <?php echo app('translator')->get('lang.date'); ?> </th>
                            <th><?php echo app('translator')->get('lang.status'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $lessonPlanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                       
                        <tr>
                            <td><?php echo e(@$data->lessonName !=""?@$data->lessonName->lesson_title:""); ?></td>

                            <td> 
                                <?php 
                                $alllessonPlannerTopic=DB::table('lesson_planners') 
                                                     ->join('sm_lessons','sm_lessons.id','=','lesson_planners.lesson_detail_id')
                                                    ->join('sm_lesson_topic_details','sm_lesson_topic_details.id','=','lesson_planners.topic_detail_id')                                                
                                                    ->where('lesson_detail_id',$data->lesson_detail_id) 
                                                    ->where('lesson_planners.active_status', 1)
                                                    ->select('lesson_planners.*','sm_lessons.lesson_title','sm_lesson_topic_details.topic_title')
                                                    ->get();                               
                                ?>
                                <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                             
                                <?php echo e(@$allData->topic_title); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </td>
                            <td>
                                <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $topicdate=DB::table('lesson_planners')->where('id',$allData->id)->first();                                  
                                ?> 
                                <?php echo e(@$topicdate->sub_topic !=""?@$topicdate->sub_topic:""); ?><br> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                            </td>

                                <td>
                                    <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $topicdate=DB::table('lesson_planners')->where('id',$allData->id)->first();                                  
                                    ?> 
                                    <?php echo e(@$topicdate->competed_date !=""?@$topicdate->competed_date:""); ?><br> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                </td>
                                <td>
                                    <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $topicdate=DB::table('lesson_planners')->where('id',$allData->id)->first();                                  
                                    ?> 
                                
                                      
                                           <?php if(date('Y-m-d')< $topicdate->lesson_date && $topicdate->competed_date==""): ?>
                                            Upcoming (<?php echo e($topicdate->lesson_date); ?>)<br>                                          
                                           <?php elseif($topicdate->competed_date==""): ?>
                                            Assigned Date (<?php echo e($topicdate->lesson_date); ?>)  
                                           <br>
                                           <?php endif; ?>
                                       
                                 
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                                </td>
                            <td>
                                <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $topicdate=DB::table('lesson_planners')->where('id',$allData->id)->first();                                  
                                ?> 
                                                                                
                                           <?php if($topicdate->competed_date==""): ?>
                                            Incomplete
                                           <br>
                                           <?php else: ?>
                                           Completed <br>
                                           <?php endif; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            
                            <td> 
                                <?php $__currentLoopData = $alllessonPlannerTopic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <label class="switch">
                                <input type="checkbox" data-id="<?php echo e($allData->id); ?>"  <?php echo e(@$allData->completed_status == 'completed'? 'checked':''); ?>

                                        class="weekend_switch_topic" ">
                                    <span class="slider round"></span>
                                </label> <br>
 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</section>



<div class="modal fade admin-query" id="showReasonModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.complete'); ?> <?php echo app('translator')->get('lang.date'); ?>  </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lessonPlan-complete-status',
                        'method' => 'POST',  'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"])); ?>

                <div class="form-group">
                    <input type="hidden" name="lessonplan_id" id="lessonplan_id">                   
                    <input class="primary-input date form-control<?php echo e($errors->has('complete_date') ? ' is-invalid' : ''); ?>" id="complete_date" type="text"
                    name="complete_date" value="<?php echo e(date('m/d/Y')); ?>">
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn fix-gr-bg" data-dismiss="modal">Close</button>
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.save'); ?> </button>
                    
                </div>
                <?php echo e(Form::close()); ?>

            </div>

        </div>
    </div>
</div>


<div class="modal fade admin-query" id="CancelModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.status'); ?>  </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <h1><?php echo app('translator')->get('lang.are_you_sure_to'); ?> <?php echo app('translator')->get('lang.incomplete'); ?>?</h1>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lessonPlan-complete-status',
                        'method' => 'POST',  'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"])); ?>

                <div class="form-group">
                    <input type="hidden" name="lessonplan_id" id="calessonplan_id">
                    <input type="hidden" name="cancel" value="incomplete">                   
                  
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn fix-gr-bg" data-dismiss="modal">Close</button>
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.yes'); ?> </button>
                    
                </div>
                <?php echo e(Form::close()); ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script>
    $(document).ready(function() {
            $(".weekend_switch_topic").on("change", function() {
                var id = $(this).data("id");              
                $('#lessonplan_id').val(id);
                $('#calessonplan_id').val(id);
  
                if ($(this).is(":checked")) {
                    var status = "1";                                       
                    var modal = $('#showReasonModal');                  
                    modal.modal('show');
                  
                } else {
                    var status = "0";                                                        
                    var modal = $('#CancelModal');                  
                    modal.modal('show');
                }


                

            });
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Lesson/Resources/views/lessonPlan/manage_lesson_planner.blade.php ENDPATH**/ ?>