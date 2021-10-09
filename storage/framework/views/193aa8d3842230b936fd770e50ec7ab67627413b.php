
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.topic'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.topic'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.lesson'); ?> <?php echo app('translator')->get('lang.plan'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.topic'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($data)): ?>
        <?php if(userPermission(806)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>

        <?php endif; ?>
        <?php endif; ?>

        <?php if(userPermission(806)): ?>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lesson.topic.store',
        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

        <?php endif; ?>
   

        <div class="row">
           
            <div class="col-lg-3">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($data)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.topic'); ?>
                            </h3>
                        </div>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                     <div class="col-lg-12">

                                       <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$class->id); ?>"  <?php echo e(( old('class') == @$class->id ? "selected":"")); ?>><?php echo e(@$class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>

                                </div>
                                </div> 
                                <div class="row mt-25">

                                        <div class="col-lg-12" id="select_section_div">

                                           <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                                <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                                </select>
                                                <div class="pull-right loader" id="select_section_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="<?php echo e(asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')); ?>" alt="" style="width: 28px;height:28px;">
                                                </div>  
                                                <?php if($errors->has('section')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                                </span>
                                                 <?php endif; ?>

                                        </div>
                                 </div>
                                <div class="row mt-25">
                                     <div class="col-lg-12" id="select_subject_div">
                                         <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?> select_subject" id="select_subject" name="subject">
                                            <option data-display="<?php echo app('translator')->get('lang.select_subject'); ?> *" value=""><?php echo app('translator')->get('lang.select_subject'); ?>*</option>
                                        </select>

                                         <div class="pull-right loader" id="select_subject_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="<?php echo e(asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')); ?>" alt="" style="width: 28px;height:28px;">
                                        </div>  
                                        <?php if($errors->has('subject')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('subject')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                      </div>  
                                </div>
                                <div class="row mt-25">

                                        <div class="col-lg-12" id="select_lesson_div">

                                           <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_lesson" id="select_lesson" name="lesson">
                                            <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.lesson'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.lesson'); ?>*</option>
                                                </select>

                                                 <div class="pull-right loader" id="select_lesson_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="<?php echo e(asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')); ?>" alt="" style="width: 28px;height:28px;">
                                                </div>  
                                                <?php if($errors->has('lesson')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('lesson')); ?></strong>
                                                </span>
                                            <?php endif; ?>

                                        </div>
                                 </div>

                             
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box mt-10">
                            <div class="row">
                                 <div class="col-lg-10">
                                    <div class="main-title">
                                        <h5><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.topic'); ?> </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowTopic();" id="addRowBtn">
                                    <span class="ti-plus pr-2"></span></button>
                                </div>
                            </div>
                            <table class="" id="productTable">
                                <thead>
                                    <tr>
                                  
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr id="row1" class="mt-40">
                                    <td >
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">  
                                           <input type="hidden"  id="lang" value="<?php echo app('translator')->get('lang.title'); ?>"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('topic') ? ' is-invalid' : ''); ?>"
                                                type="text" id="topic" name="topic[]" autocomplete="off" value="<?php echo e(isset($editData)? $editData->exam_title : ''); ?>" required="">
                                                <label><?php echo app('translator')->get('lang.title'); ?> *</label>
                                        </div>
                                    </td>
                                 
                                    <td >
                                         <button class="primary-btn icon-only fix-gr-bg" type="button">
                                             <span class="ti-trash"></span>
                                        </button>
                                       
                                    </td>
                                    </tr>
                                 
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                               <?php 
                                  $tooltip = "";
                                  if(userPermission(806)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="white-box">                               
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                  <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                        <span class="ti-check"></span>
                                                        <?php if(isset($data)): ?>
                                                            <?php echo app('translator')->get('lang.update'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('lang.save'); ?>
                                                        <?php endif; ?>
                                                        <?php echo app('translator')->get('lang.topic'); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            <?php echo e(Form::close()); ?>


            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.topic'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('lang.sl'); ?></th>                                      
                                            <th><?php echo app('translator')->get('lang.class'); ?></th>
                                            <th><?php echo app('translator')->get('lang.section'); ?></th>
                                            <th><?php echo app('translator')->get('lang.subject'); ?></th>
                                            <th><?php echo app('translator')->get('lang.lesson'); ?></th>
                                            <th><?php echo app('translator')->get('lang.topic'); ?></th>
                                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                                        </tr>
                            </thead>

                                     <tbody>
                                      <?php $count =1 ; ?>
                                        <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($count++); ?></td>

                                            <td><?php echo e($data->class !=""?$data->class->class_name:""); ?></td>
                                            <td><?php echo e($data->section !=""?$data->section->section_name:""); ?></td>
                                            <td><?php echo e($data->subject !=""?$data->subject->subject_name:""); ?></td>                                           
                                            <td><?php echo e($data->lesson !=""?$data->lesson->lesson_title:""); ?> </td>

                                            <td>
                                                <?php $__currentLoopData = $data->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($topicData->topic_title); ?>, <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                         

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                  
                                                       
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if(userPermission(807)): ?>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('topic-edit', $data->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                         <?php endif; ?>
                                                        <?php if(userPermission(808)): ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteExamModal<?php echo e($data->id); ?>"
                                                                href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                         <?php endif; ?>
                                                    </div>
                                                    
                                                </div> 
                                            </td>
                                        </tr>
                                            <div class="modal fade admin-query" id="deleteExamModal<?php echo e($data->id); ?>" >
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.topic'); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                            </div>

                                                            <div class="mt-40 d-flex justify-content-between">
                                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                                 <?php echo e(Form::open(['route' => array('topic-delete',$data->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                                <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
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
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(url('Modules\Lesson\Resources\assets\js\app.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Lesson/Resources/views/topic/topic.blade.php ENDPATH**/ ?>