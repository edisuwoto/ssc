
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.upload_content'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.upload_content'); ?> <?php echo app('translator')->get('lang.list'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.study_material'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.upload_content'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.upload_content'); ?>
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-upload-content',@$editData->id, 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <input type="hidden" name="id" value="<?php echo e(@$editData->id); ?>">
                                <?php else: ?>
                             <?php if(userPermission(89)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'save-upload-content', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mb-25">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e($errors->has('content_title') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="content_title" autocomplete="off"
                                                    value="<?php echo e(isset($editData)? @$editData->content_title:''); ?>">
                                                <label> <?php echo app('translator')->get('lang.content_title'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('content_title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('content_title')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-30">
                                            <select
                                                class="niceSelect w-100 bb form-control<?php echo e($errors->has('content_type') ? ' is-invalid' : ''); ?>"
                                                name="content_type" id="content_type">
                                                <option data-display="<?php echo app('translator')->get('lang.content'); ?> <?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.content'); ?> <?php echo app('translator')->get('lang.type'); ?> *</option>
                                                <option value="as" <?php echo e(isset($editData) && @$editData->content_type == "as"? 'selected':''); ?>> <?php echo app('translator')->get('lang.assignment'); ?></option>
                                                
                                                <option value="sy" <?php echo e(isset($editData) && @$editData->content_type == "sy"? 'selected':''); ?>><?php echo app('translator')->get('lang.syllabus'); ?></option>
                                                <option value="ot" <?php echo e(isset($editData) && @$editData->content_type == "ot"? 'selected':''); ?>><?php echo app('translator')->get('lang.other_download'); ?></option>
                                            </select>
                                            <?php if($errors->has('content_type')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('content_type')); ?></strong>
                                        </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12 mb-30">
                                            <label><?php echo app('translator')->get('lang.available_for'); ?>*</label><br>
                                            <div class="">
                                                <input type="checkbox" id="all_admin"
                                                       class="common-checkbox form-control<?php echo e($errors->has('available_for') ? ' is-invalid' : ''); ?>"
                                                       name="available_for[]" value="admin"  <?php echo e(isset($editData) && @$editData->available_for_admin == "1"? 'checked':''); ?>>
                                                <label for="all_admin"><?php echo app('translator')->get('lang.all'); ?> <?php echo app('translator')->get('lang.admin'); ?></label>
                                                <input type="checkbox" id="student"
                                                       class="common-checkbox form-control<?php echo e($errors->has('available_for') ? ' is-invalid' : ''); ?>"
                                                       name="available_for[]" value="student" <?php echo e(isset($editData) && @$editData->available_for_all_classes == "1" || @$editData->class != "" || @$editData->section != ""? 'checked':''); ?>>
                                                <label for="student"><?php echo app('translator')->get('lang.student'); ?></label>
                                            </div>
                                            <?php if($errors->has('available_for')): ?>
                                                <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('available_for')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                            // if( @$editData->available_for_all_classes == "1" || @$editData->class != "" || @$editData->section != ""){
                                            if(@$editData->available_for_all_classes == "1"){
                                                $show = "";
                                                $show1 = "disabledbutton";
                                            }elseif(@$editData->class != "" || @$editData->section != ""){
                                                $show = "disabledbutton";
                                                $show1 = "";
                                            }else{
                                                $show = "disabledbutton";
                                                $show1 = "disabledbutton";
                                            }
                                        ?>
                                        <div class="col-lg-12 <?php echo e(@$show); ?> mb-30" id="availableClassesDiv">

                                            <div class="">
                                                <input type="checkbox" id="all_classes"
                                                       class="common-checkbox form-control" name="all_classes" <?php echo e(isset($editData) && @$editData->available_for_all_classes == "1"? 'checked':''); ?>>
                                                <label for="all_classes"><?php echo app('translator')->get('lang.available_for_all_classes'); ?></label>
                                            </div>
                                        </div>
                                        <div
                                            class="forStudentWrapper col-lg-12 mb-20 <?php echo e($errors->has('class') || $errors->has('section')? '':@$show1); ?>"
                                            id="contentDisabledDiv">
                                            <div class="row">
                                                <div class="col-lg-12 mb-20">
                                                    <div class="input-effect">
                                                        <select
                                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>"
                                                            name="class" id="classSelectStudent">
                                                            <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *"
                                                                    value=""><?php echo app('translator')->get('lang.select'); ?></option>
                                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e(@$class->id); ?>" <?php echo e(isset($editData) && $editData->class == $class->id? 'selected':''); ?>><?php echo e(@$class->class_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('class')): ?>
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-30">
                                                    <div class="input-effect" id="sectionStudentDiv">
                                                        <select
                                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>"
                                                            name="section" id="sectionSelectStudent">
                                                            <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> "
                                                                    value=""><?php echo app('translator')->get('lang.section'); ?> 
                                                            </option>
                                                            <?php if(isset($editData->section)): ?>
                                                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($section->id); ?>" <?php echo e($editData->section == $section->id? 'selected': ''); ?>><?php echo e($section->section_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <div class="pull-right loader loader_style" id="select_section_loader">
                                                            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                                        </div>
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('section')): ?>
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">

                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input date form-control<?php echo e($errors->has('upload_date') ? ' is-invalid' : ''); ?>"
                                                    id="upload_date" type="text"
                                                    name="upload_date"
                                                    value="<?php echo e(isset($editData)? date('m/d/Y', strtotime(@$editData->upload_date)): date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.date'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('upload_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('upload_date')); ?></strong>
                                        </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="apply_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    

                                    <div class="row mb-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="description"><?php echo e(@$editData->description); ?></textarea>
                                                <label><?php echo app('translator')->get('lang.description'); ?> <span></span> </label>
                                                <span class="focus-border textarea"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e($errors->has('source_url') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="source_url" autocomplete="off"
                                                    value="<?php echo e(isset($editData)? @$editData->source_url:''); ?>">
                                                <label> <?php echo app('translator')->get('lang.source_url'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('source_url')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('source_url')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control <?php echo e($errors->has('content_file') ? ' is-invalid' : ''); ?>"
                                                    readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->upload_file) && @$editData->upload_file != ""? getFilePath3(@$editData->upload_file):trans('lang.file').' *'); ?>"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('content_file')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('content_file')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    
                                                <input type="file" class="d-none form-control" name="content_file"
                                                       id="upload_content_file">
                                            </button>
                                            

                                        </div>
                                        <code>(jpg,png,jpeg,pdf,doc,docx,mp4,mp3 are allowed for upload)</code>
                                    </div>
                                      <?php 
                                  $tooltip = "";
                                  if(userPermission(89) ){
                                        @$tooltip = "";
                                    }else{
                                        @$tooltip = "You have no permission to add";
                                    }
                                ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php echo app('translator')->get('lang.upload_content'); ?>
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
                                <h3 class="mb-0"> <?php echo app('translator')->get('lang.upload_content'); ?>  <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.content_title'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.type'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.date'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.available_for'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.class_section'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($uploadContents)): ?>
                                    <?php $__currentLoopData = $uploadContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(@$value->content_title); ?></td>
                                            <td>
                                                <?php if(@$value->content_type == 'as'): ?>
                                                    <?php echo app('translator')->get('lang.assignment'); ?>
                                                <?php elseif(@$value->content_type == 'st'): ?>
                                                    <?php echo app('translator')->get('lang.study_material'); ?>
                                                <?php elseif(@$value->content_type == 'sy'): ?>
                                                    <?php echo app('translator')->get('lang.syllabus'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.other_download'); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td  data-sort="<?php echo e(strtotime(@$value->upload_date)); ?>" >
                                                <?php echo e(@$value->upload_date != ""? dateConvert(@$value->upload_date):''); ?> 
                                            </td>
                                            <td>
                                                <?php if(@$value->available_for_admin == 1): ?>
                                                    <?php echo app('translator')->get('lang.all_admins'); ?><br>
                                                <?php endif; ?>
                                                <?php if(@$value->available_for_all_classes == 1): ?>
                                                    <?php echo app('translator')->get('lang.all_classes_student'); ?>
                                                <?php endif; ?>
                                                <?php if(@$value->classes != "" && $value->sections != ""): ?>
                                                   <?php echo app('translator')->get('lang.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'.@$value->sections->section_name); ?>)
                                                <?php endif; ?>

                                                <?php if(@$value->classes != "" && $value->section ==Null): ?>
                                                <?php echo app('translator')->get('lang.all_students_of'); ?> ( <?php echo e(@$value->classes->class_name.'->'); ?> <?php echo app('translator')->get('lang.all_sections'); ?> )
                                             <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(@$value->classes != ""): ?>
                                                    <?php echo e(@$value->classes->class_name); ?>

                                                <?php endif; ?>
                                                <?php if($value->sections != ""): ?>
                                                    (<?php echo e(@$value->sections->section_name); ?>)
                                                <?php endif; ?>

                                                <?php if($value->section == Null): ?>
                                                ( <?php echo app('translator')->get('lang.all_sections'); ?> )
                                            <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <?php echo app('translator')->get('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="<?php echo e(route('upload-content-view', $value->id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                                        
                                                        <?php if(moduleStatusCheck('VideoWatch')== TRUE): ?>
                                                            <a class="dropdown-item" href="<?php echo e(url('videowatch/view-log/'.$value->id)); ?>"><?php echo app('translator')->get('lang.seen'); ?></a>
                                                        <?php endif; ?>

                                                        <a class="dropdown-item" href="<?php echo e(route('upload-content-edit',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>

                                                        <?php if(userPermission(91)): ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e(@$value->id); ?>" href="#">
                                                                <?php echo app('translator')->get('lang.delete'); ?>
                                                            </a>
                                                         <?php endif; ?>
                                                        <?php if(userPermission(90)): ?>
                                                            <?php if($value->upload_file != ""): ?>
                                                                <a class="dropdown-item" href="<?php echo e(url(@$value->upload_file)); ?>" download>
                                                                    <?php echo app('translator')->get('lang.download'); ?> 
                                                                    <span class="pl ti-download"></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e(@$value->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.upload_content'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                                    <?php echo e(Form::open(['route' =>'delete-upload-content', 'method' => 'POST'])); ?>

                                                                        <input type="hidden" name="id" value="<?php echo e(@$value->id); ?>">
                                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                                    <?php echo e(Form::close()); ?>

                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/teacher/uploadContentList.blade.php ENDPATH**/ ?>