
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.question_bank'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.examinations'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.examinations'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.question_bank'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($bank)): ?>
        <?php if(userPermission(235)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('question-bank')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php if(isset($bank)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.question_bank'); ?>
                            </h3>
                        </div>
                       
                    
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="white-box">
                            <?php if(isset($bank)): ?>

                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('question-bank-update',$bank->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'question_bank'])); ?>

    
                            <?php else: ?>
                             <?php if(userPermission(235)): ?>
    
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'question-bank',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'question_bank'])); ?>

    
                            <?php endif; ?>
                            <?php endif; ?>
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
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('group') ? ' is-invalid' : ''); ?>" name="group">
                                            <option data-display="<?php echo app('translator')->get('lang.select_group'); ?> *" value=""><?php echo app('translator')->get('lang.select_group'); ?> *</option>
                                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($bank)): ?>
                                                <option value="<?php echo e($group->id); ?>" <?php echo e($group->id == $bank->q_group_id? 'selected': ''); ?>><?php echo e($group->title); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($group->id); ?>" <?php echo e(old('group')!=''? (old('group') == $group->id? 'selected':''):''); ?> ><?php echo e($group->title); ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('group')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('group')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="class_id_email_sms" name="class">
                                            <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($bank)): ?>
                                                <option value="<?php echo e($class->id); ?>" <?php echo e($bank->class_id == $class->id? 'selected': ''); ?>><?php echo e($class->class_name); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($class->id); ?>" <?php echo e(old('class')!=''? (old('class') == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                                <?php endif; ?>

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
                                    <?php if(!isset($bank)): ?>        
                                        <div class="col-lg-12" id="selectSectionsDiv">
                                            <label for="checkbox" class="mb-2"><?php echo app('translator')->get('lang.section'); ?> *</label>
                                            <select multiple id="selectSectionss" name="section[]" style="width:300px">
                                               
                                            </select>
                                            <div class="">
                                                <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                                <label for="checkbox_section" class="mt-3"><?php echo app('translator')->get('lang.select_all'); ?></label>
                                            </div>
                                            <?php if($errors->has('section')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert" style="display: block">
                                                    <strong style="top:-25px"><?php echo e($errors->first('section')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                               <?php else: ?>
                              
                                        <div class="col-lg-12 mt-30-md" id="select_section_div">
                                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                                <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($bank)): ?>
                                                        <option value="<?php echo e($section->id); ?>" <?php echo e($bank->section_id == $section->id? 'selected': ''); ?>><?php echo e($section->section_name); ?></option>  
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                  <?php endif; ?>
                                  </div>
                             
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('question_type') ? ' is-invalid' : ''); ?>" name="question_type"  id="question-type">
                                            <option data-display="<?php echo app('translator')->get('lang.question_type'); ?> *" value=""><?php echo app('translator')->get('lang.question_type'); ?> *</option>
                                           
                                            <?php if(moduleStatusCheck('MultipleImageQuestion')== TRUE): ?>
                                                <option value="MI" <?php echo e(isset($bank)? $bank->type == "MI"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.multiple_image'); ?></option>
                                            <?php endif; ?>
                                            
                                            <option value="M" <?php echo e(isset($bank)? $bank->type == "M"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.multiple_choice'); ?></option>
                                            <option value="T" <?php echo e(isset($bank)? $bank->type == "T"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.true_false'); ?></option>
                                            <option value="F" <?php echo e(isset($bank)? $bank->type == "F"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.fill_in_the_blanks'); ?></option>
                                        </select>
                                        <?php if($errors->has('group')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('group')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('question') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="question"><?php echo e(isset($bank)? $bank->question:(old('question')!=''?(old('question')):'')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.question'); ?> *</label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('question')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('question')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('marks') ? ' is-invalid' : ''); ?>" type="text" name="marks" value="<?php echo e(isset($bank)? $bank->marks:(old('marks')!=''?(old('marks')):'')); ?>">
                                            <label><?php echo app('translator')->get('lang.marks'); ?> *</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('marks')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('marks')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if(!isset($bank)){
                                        if(old('question_type') == "M"){
                                            $multiple_choice = "";
                                        }
                                    }else{
                                        if($bank->type == "M" || old('question_type') == "M"){
                                            $multiple_choice = "";
                                        }
                                    }
                                ?>
                                <div class="multiple-choice" id="<?php echo e(isset($multiple_choice)? $multiple_choice: 'multiple-choice'); ?>">
                                    <div class="row  mt-25">
                                        <div class="col-lg-8">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('number_of_option') ? ' is-invalid' : ''); ?>"
                                                    type="number" min="2" name="number_of_option" autocomplete="off" id="number_of_option" value="<?php echo e(isset($bank)? $bank->number_of_option: ''); ?>">
                                                <label><?php echo app('translator')->get('lang.number_of_options'); ?> *</label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('number_of_option')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('number_of_option')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="primary-btn small fix-gr-bg" id="create-option"><?php echo app('translator')->get('lang.create'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if(!isset($bank)){
                                        if(old('question_type') == "M"){
                                            $multiple_options = "";
                                        }
                                    }else{
                                        if($bank->type == "M" || old('question_type') == "M"){
                                            $multiple_options = "";
                                        }
                                    }
                                ?>
                                <div class="multiple-options" id="<?php echo e(isset($multiple_options)? "": 'multiple-options'); ?>">
                                    <?php 
                                        $i=0;
                                        $multiple_options = [];

                                        if(isset($bank)){
                                            if($bank->type == "M"){
                                                $multiple_options = $bank->questionMu;
                                            }
                                        }
                                    ?>
                                    
                                    <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++; ?>
                                    <div class='row  mt-25'>
                                        <div class='col-lg-10'>
                                            <div class='input-effect'>
                                                <input class='primary-input form-control' type='text' name='option[]' autocomplete='off' required value="<?php echo e($multiple_option->title); ?>">
                                                <label><?php echo app('translator')->get('lang.option'); ?> <?php echo e($i); ?></label>
                                                <span class='focus-border'></span>
                                            </div>
                                        </div>
                                        <div class='col-lg-2'>
                                            <input type="checkbox" id="option_check_<?php echo e($i); ?>" class="common-checkbox" name="option_check_<?php echo e($i); ?>" value="1"
                                                <?php if($multiple_option->status==1): ?> checked <?php endif; ?>
                                            >
                                            <label for="option_check_<?php echo e($i); ?>"></label>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php
                                    if(!isset($bank)){
                                        if(old('question_type') == "T"){
                                            $true_false = "";
                                        }
                                    }else{
                                        if($bank->type == "T" || old('question_type') == "T"){
                                            $true_false = "";
                                        }
                                    }
                                ?>
                                <div class="true-false" id="<?php echo e(isset($true_false)? $true_false: 'true-false'); ?>">
                                    <div class="row  mt-25">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"></p>
                                            <div class="d-flex radio-btn-flex">
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse" id="relationFather" value="T" class="common-radio relationButton" <?php echo e(isset($bank)? $bank->trueFalse == "T"? 'checked': '' : 'checked'); ?>>
                                                    <label for="relationFather"><?php echo app('translator')->get('lang.true'); ?></label>
                                                </div>
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse" id="relationMother" value="F" class="common-radio relationButton" <?php echo e(isset($bank)? $bank->trueFalse == "F"? 'checked': '' : ''); ?>>
                                                    <label for="relationMother"><?php echo app('translator')->get('lang.false'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if(!isset($bank)){
                                        if(old('question_type') == "F"){
                                            $fill_in = "";
                                        }
                                    }else{
                                        if($bank->type == "F" || old('question_type') == "F"){
                                            $fill_in = "";
                                        }
                                    }
                                ?>
                                <div class="fill-in-the-blanks" id="<?php echo e(isset($fill_in)? $fill_in : 'fill-in-the-blanks'); ?>">
                                    <div class="row  mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control<?php echo e($errors->has('suitable_words') ? ' is-invalid' : ''); ?>" cols="0" rows="5" name="suitable_words"><?php echo e(isset($bank)? $bank->suitable_words: ''); ?></textarea>
                                                <label><?php echo app('translator')->get('lang.suitable_words'); ?> *</label>
                                                <span class="focus-border textarea"></span>
                                                <?php if($errors->has('suitable_words')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('suitable_words')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <?php
                                    if(!isset($bank)){
                                        if(old('question_type') == "MI"){
                                            $multiple_image = "";
                                        }
                                    }else{
                                        if($bank->type == "MI" || old('question_type') == "MI"){
                                            $multiple_image = "";
                                        }
                                    }
                                ?>
                                <div class="multiple-image-section mt-20" id="<?php echo e(isset($multiple_image)? $multiple_image : 'multiple-image-section'); ?>">
                                        
                                    <div class="row mt-25 mb-20">
                                        <div class="col-lg-12">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('answer_type') ? ' is-invalid' : ''); ?>" id="answer_type" name="answer_type" >
                                                <option data-display="<?php echo app('translator')->get('lang.answer_type'); ?> *" value=""><?php echo app('translator')->get('lang.answer_type'); ?> *</option>
                                                <option value="radio" <?php echo e(isset($bank)? $bank->answer_type == "radio"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.single_select'); ?></option>
                                                <option value="checkbox" <?php echo e(isset($bank)? $bank->answer_type == "checkbox"? 'selected': '' : ''); ?>><?php echo app('translator')->get('lang.multiple_select'); ?></option>
                                            </select>
                                            <?php if($errors->has('answer_type')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('answer_type')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-20">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input form-control <?php echo e($errors->has('question_image') ? ' is-invalid' : ''); ?>"
                                                        readonly="true" type="text"
                                                        placeholder="<?php echo e(isset($bank->question_image) && @$bank->question_image != ""? getFilePath3(@$bank->question_image):trans('lang.question_image').' *'); ?>  [650x450]"
                                                        id="placeholderUploadContent">
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('question_image')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('question_image')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                        
                                                    <input type="file" onclick="uploadQuestionImage()" class="d-none form-control" name="question_image"
                                                           id="upload_content_file">
                                                </button>
                                            </div>
                                            
                                        </div>
                                            <style>
                                        .multiple-images ::-webkit-file-upload-button {
                                            background: #8432FA;
                                            color: white;
                                            border: #8432FA;
                                            }
                                            </style>
                                            
                                            <div class="row  mt-25">
                                                <div class="col-lg-8">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control<?php echo e($errors->has('number_of_option') ? ' is-invalid' : ''); ?>"
                                                            type="number" min="2"  name="number_of_optionImg" autocomplete="off" id="number_of_image_option" value="<?php echo e(isset($bank)? $bank->number_of_option: ''); ?>">
                                                        <label><?php echo app('translator')->get('lang.number_of_options'); ?> *</label>
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('number_of_option')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('number_of_option')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="primary-btn small fix-gr-bg" id="create-image-option"><?php echo app('translator')->get('lang.create'); ?></button>
                                                </div>
                                            </div>

                                            <div class="multiple-images" id="multiple-images">
                                                <?php 
                                                    $i=0;
                                                    $multiple_options = [];
            
                                                    if(isset($bank)){
                                                        if($bank->type == "MI"){
                                                            $multiple_options = $bank->questionMu;
                                                        }
                                                    }
                                                ?>
                                                
                                                <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $i++; ?>
                                                <div class='row  mt-25'>
                                                    <div class='col-lg-10'>
                                                        <div class='input-effect'>
                                                            <label class="primary-btn fix-gr-bg multiple_images">
                                                                <i class="fa fa-image"></i> <span class="show_file_name"><?php echo e(\Illuminate\Support\Str::limit(showFileName($multiple_option->title), 10, '...')); ?></span> <input type="file" name='images[<?php echo e($multiple_option->id); ?>]' style="display: none;" name="image">
                                                            </label>
                                                            <input type="hidden" name="images_old[<?php echo e($multiple_option->id); ?>]" value="<?php echo e(@$multiple_option->title); ?>">
                                                            
                                                            
                                                            <span class='focus-border'></span>
                                                        </div>
                                                    </div>
                                                    <div class='col-lg-2 mt-10'>
                                                        <input type="checkbox" id="option_check_<?php echo e($i); ?>" class="common-checkbox" <?php echo e($multiple_option->status==1? 'checked':''); ?> name="option_check_<?php echo e($i); ?>" value="1">
                                                        <label for="option_check_<?php echo e($i); ?>"><?php echo app('translator')->get('lang.yes'); ?></label>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                </div>

                                 
                                 <?php echo e(Form::close()); ?>

                                 
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(235)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                            </div>
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg" id="question_bank_submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                        <span class="ti-check"></span>
                                        <?php if(isset($bank)): ?>
                                            <?php echo app('translator')->get('lang.update'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('lang.save'); ?>
                                        <?php endif; ?>
                                        <?php echo app('translator')->get('lang.question'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        
                            
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.question_bank'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <th><?php echo app('translator')->get('lang.group'); ?></th>
                                    <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                                    <th><?php echo app('translator')->get('lang.question'); ?></th>
                                    <th><?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e(($bank->questionGroup)!=''?$bank->questionGroup->title:''); ?></td>
                                    <td><?php echo e(($bank->class)!=''?$bank->class->class_name:''); ?> (<?php echo e(($bank->section)!=''?$bank->section->section_name:''); ?>)</td>
                                    <td><?php echo e($bank->question); ?></td>
                                    <td>
                                        <?php if($bank->type == "M"): ?>
                                        <?php echo e("Multiple Choice"); ?>

                                        <?php elseif($bank->type == "T"): ?>
                                        <?php echo e("True False"); ?>

                                        <?php elseif($bank->type == "MI"): ?>
                                        <?php echo e("Multiple Image Choice"); ?>

                                        <?php else: ?>
                                        <?php echo e("Fill in the blank"); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               <?php if(userPermission(236)): ?>

                                               <a class="dropdown-item" href="<?php echo e(route('question-bank-edit', [$bank->id
                                                    ])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(237)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteQuestionBankModal<?php echo e($bank->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <div class="modal fade admin-query" id="deleteQuestionBankModal<?php echo e($bank->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.question_bank'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('question-bank-delete',$bank->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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
<script> 
    $(document).ready(function() { 
        $('.multiple_images input[type="file"]').change(function() { 
            console.log($(this).closest('.multiple_images').find('.show_file_name'));
            $(this).closest('.multiple_images').find('.show_file_name').html('File Selected');
            
        }); 
    }); 
</script> 
<script> 

function uploadImage(id) {
    $('.show_file_name'+id).html('File Selected');
    var select_image= $('#question_image'+id);

    console.log('initial image value '+ select_image.val());
    var file = document.getElementById("question_image"+id).files[0];
    if (file) {
        if (file.type == "image/jpeg" || file.type == "image/png" || file.type == "image/jpg") {
            var img = new Image();

            img.src = window.URL.createObjectURL(file);

            img.onload = function() {
                var width = img.naturalWidth,
                    height = img.naturalHeight;
                window.URL.revokeObjectURL(img.src);
                if (width <= 650 && height <= 450) {
                    $('.show_file_name'+id).html(file.name.substr(0, 10));
                } else {
                    $('.show_file_name'+id).html("Invalid image dimension");
                    $('#question_image'+id).val(null);
                }
            };
        } else {
            $('.show_file_name'+id).html("Invalid file type");
            $('#question_image'+id).val(null);
        }

    }

}

    
</script> 

    <script>

        $('#question_bank_submit').click(function(e){
            e.preventDefault();
            console.log(e);
            var ck_box = $('.multiple-images input[type="checkbox"]:checked').length;
            var answer_type = $("#answer_type").val();
            var question_type = $("#question-type").val();
            console.log(answer_type); 

            if(ck_box > 0){
                    if($("input[name='images[]']" ).val()=="")
                    { // alert for "address_" input
                        toastr.warning('Please Select Valid Option Images', 'Warning', {
                                    timeOut: 5000 })
                    }else{
                        if (answer_type=='radio' && ck_box >1 ) {
                            toastr.warning('Please Select One Correct Answer', 'Warning', {
                                    timeOut: 5000
                                })
                        } else {
                            $('#question_bank').submit();
                        }
                       
                    }
            }else{
                
                if (question_type!='MI') {
                    $('#question_bank').submit();
                }else{

                    toastr.warning('Please Select Correct  Answer', 'Warning', {
                                timeOut: 5000
                            })
                }
            } 

        });



        $(document).on('click', '.common-checkbox', function(){

            var answer_type = $("#answer_type").val();
            
            if (answer_type=='radio') {
                $('.common-checkbox').prop('checked', false);
                $(this).prop('checked', true)
            }

            })
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/examination/question_bank.blade.php ENDPATH**/ ?>