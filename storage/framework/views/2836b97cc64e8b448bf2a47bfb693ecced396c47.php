
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student_admission'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.student_admission'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_admission'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="main-title xs_mt_0 mt_0_sm">
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.student'); ?></h3>
                </div>
            </div>
              <?php if(userPermission(63)): ?>
               <div class="offset-lg-3 col-lg-3 text-right mb-20 col-sm-6">
                <a href="<?php echo e(route('import_student')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.import'); ?> <?php echo app('translator')->get('lang.student'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php if(userPermission(65)): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal studentadmission', 'files' => true, 'route' => 'student_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form'])); ?>

        <?php endif; ?>
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
                <div class="white-box">
                    <div class="">
                        <div class="row">
            
                            <div class="col-lg-12 text-center">
                                <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($error == "The email address has already been taken."): ?>
                                        <div class="error text-danger "><?php echo e('The email address has already been taken, You can find out in student list or disabled student list'); ?></div>
                                    <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($errors->any()): ?>
                                     <div class="error text-danger "><?php echo e('Something went wrong, please try again'); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                </div>
                            </div>
                        </div>
 
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="row mb-40 mt-30">
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session') ? ' is-invalid' : ''); ?>" name="session" id="academic_year">
                                        <option data-display="<?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.academic_year'); ?> *</option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(old('session') == $session->id? 'selected': ''); ?>><?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('session')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('session')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="class-div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                        <option data-display="<?php echo app('translator')->get('lang.class'); ?> *" value=""><?php echo app('translator')->get('lang.class'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                           
                           
                            <?php if(!empty(old('class'))): ?>
                            <?php
                                $old_sections = DB::table('sm_class_sections')->where('class_id', '=', old('class'))
                                ->join('sm_sections','sm_class_sections.section_id','=','sm_sections.id')
                                ->get();
                            ?>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section"
                                        id="sectionSelectStudent" >
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                        <?php $__currentLoopData = $old_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($old_section->id); ?>" <?php echo e(old('section')==$old_section->id ? 'selected' : ''); ?> >
                                            <?php echo e($old_section->section_name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php else: ?>

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                       <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
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
                            <?php endif; ?>

                            <div class="col-lg-2">
                                <div class="input-effect">
                                    <input class="primary-input  form-control<?php echo e($errors->has('admission_number') ? ' is-invalid' : ''); ?>" type="text" onkeyup="GetAdmin(this.value)" name="admission_number"
                                     value="<?php echo e($max_admission_id != ''? $max_admission_id + 1 : 1); ?>" >

                                   <label><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.number'); ?></label>
                                    <span class="focus-border"></span>
                                    <span class="invalid-feedback" id="Admission_Number" role="alert">
                                    </span>
                                    <?php if($errors->has('admission_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('admission_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                           
                                
                            
                            

                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="numberCheck(this)" class="primary-input read-only-input" readonly type="text" id="roll_number" name="roll_number"  value="<?php echo e(old('roll_number')); ?>">
                                    <label><?php echo app('translator')->get('lang.roll'); ?></label>
                                    <span class="focus-border"></span>
                                    <span class="text-danger" id="roll-error" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.first'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('first_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.last'); ?> <?php echo app('translator')->get('lang.name'); ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('last_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" name="gender">
                                        <option data-display="<?php echo app('translator')->get('lang.gender'); ?> *" value=""><?php echo app('translator')->get('lang.gender'); ?> *</option>
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('gender')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('gender')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                 name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" autocomplete="off">
                                                <label><?php echo app('translator')->get('lang.date_of_birth'); ?> *</label>
                                                <span class="focus-border"></span>
                                            <?php if($errors->has('date_of_birth')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                             <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('blood_group') ? ' is-invalid' : ''); ?>" name="blood_group">
                                        <option data-display="<?php echo app('translator')->get('lang.blood_group'); ?>" value=""><?php echo app('translator')->get('lang.blood_group'); ?></option>
                                        <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($blood_group->id); ?>" <?php echo e(old('blood_group') == $blood_group->id? 'selected': ''); ?>><?php echo e($blood_group->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('blood_group')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('blood_group')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('religion') ? ' is-invalid' : ''); ?>" name="religion">
                                        <option data-display="<?php echo app('translator')->get('lang.religion'); ?>" value=""><?php echo app('translator')->get('lang.religion'); ?></option>
                                        <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($religion->id); ?>" <?php echo e(old('religion') == $religion->id? 'selected': ''); ?>><?php echo e($religion->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('religion')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('religion')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="caste" value="<?php echo e(old('caste')); ?>">
                                    <label><?php echo app('translator')->get('lang.caste'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('email_address') ? ' is-invalid' : ''); ?>" type="text" name="email_address" value="<?php echo e(old('email_address')); ?>">
                                    <label><?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.address'); ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email_address')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" type="tel" name="phone_number" value="<?php echo e(old('phone_number')); ?>">
                                    <label><?php echo app('translator')->get('lang.phone'); ?> <?php echo app('translator')->get('lang.number'); ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone_number')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-2">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input date" id="" type="text"
                                                name="admission_date" value="<?php echo e(old('admission_date') != ""? old('admission_date'):date('m/d/Y')); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.date'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="admission-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('student_category_id') ? ' is-invalid' : ''); ?>" name="student_category_id">
                                        <option data-display="<?php echo app('translator')->get('lang.category'); ?>" value=""><?php echo app('translator')->get('lang.category'); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('student_category_id') == $category->id? 'selected': ''); ?>><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_category_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('student_category_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('student_group_id') ? ' is-invalid' : ''); ?>" name="student_group_id">
                                        <option data-display="<?php echo app('translator')->get('lang.group'); ?>" value=""><?php echo app('translator')->get('lang.group'); ?></option>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($group->id); ?>" <?php echo e(old('student_group_id') == $group->id? 'selected': ''); ?>><?php echo e($group->group); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_group_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('student_group_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="height" value="<?php echo e(old('height')); ?>">
                                    <label><?php echo app('translator')->get('lang.height'); ?> (<?php echo app('translator')->get('lang.in'); ?>) <span></span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="weight" value="<?php echo e(old('weight')); ?>">
                                    <label><?php echo app('translator')->get('lang.Weight'); ?> (<?php echo app('translator')->get('lang.kg'); ?>) <span></span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderPhoto" placeholder="<?php echo app('translator')->get('lang.student_photo'); ?>"
                                                readonly="">
                                            <span class="focus-border"></span>

                                            <?php if($errors->has('file')): ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                </span>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" value="<?php echo e(old('photo')); ?>" name="photo" id="photo">
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-right">
                                <div class="row">
                                    <div class="col-lg-7 text-left" id="parent_info">
                                        <input type="hidden" name="parent_id" value="">

                                    </div>
                                    <div class="col-lg-5">
                                        <button class="primary-btn-small-input primary-btn small fix-gr-bg" type="button" data-toggle="modal" data-target="#editStudent">
                                            <span class="ti-plus pr-2"></span>
                                            <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.parents'); ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Start Sibling Add Modal -->
                        <div class="modal fade admin-query" id="editStudent">
                            <div class="modal-dialog small-modal modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.sibling'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12" id="sibling_required_error">

                                                            </div>
                                                        </div>
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_class_div">
                                                                <select class="niceSelect w-100 bb" name="sibling_class" id="select_sibling_class">
                                                                    <option data-display="<?php echo app('translator')->get('lang.class'); ?> *" value=""><?php echo app('translator')->get('lang.class'); ?> *</option>
                                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($class->id); ?>" <?php echo e(old('sibling_class') == $class->id? 'selected': ''); ?> ><?php echo e($class->class_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_section_div">
                                                                <select class="niceSelect w-100 bb" name="sibling_section" id="select_sibling_section">
                                                                    <option data-display="<?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.section'); ?> *</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_name_div">
                                                                <select class="niceSelect w-100 bb" name="select_sibling_name" id="select_sibling_name">
                                                                    <option data-display="<?php echo app('translator')->get('lang.sibling'); ?> *" value=""><?php echo app('translator')->get('lang.sibling'); ?> *</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 text-center mt-40">
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>

                                                            <button class="primary-btn fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.information'); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Sibling Add Modal -->
                        <div class="parent_details" id="parent_details">
                            
                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.parents_and_guardian_info'); ?> </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-40 mt-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>" type="text" name="fathers_name" id="fathers_name" value="<?php echo e(old('fathers_name')); ?>">
                                        <label><?php echo app('translator')->get('lang.father'); ?> <?php echo app('translator')->get('lang.name'); ?> <span></span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('fathers_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fathers_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="fathers_occupation" id="fathers_occupation" value="<?php echo e(old('fathers_occupation')); ?>">
                                        <label><?php echo app('translator')->get('lang.occupation'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('fathers_phone') ? ' is-invalid' : ''); ?>" type="text" name="fathers_phone" id="fathers_phone" value="<?php echo e(old('fathers_phone')); ?>">
                                        <label><?php echo app('translator')->get('lang.father'); ?> <?php echo app('translator')->get('lang.phone'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('fathers_phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fathers_phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFathersName" placeholder="<?php echo app('translator')->get('lang.photo'); ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="fathers_photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" name="fathers_photo" id="fathers_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>" type="text" name="mothers_name" id="mothers_name" value="<?php echo e(old('mothers_name')); ?>">
                                        <label><?php echo app('translator')->get('lang.mother'); ?> <?php echo app('translator')->get('lang.name'); ?> <span></span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('mothers_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mothers_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="mothers_occupation" id="mothers_occupation" value="<?php echo e(old('mothers_occupation')); ?>">
                                        <label><?php echo app('translator')->get('lang.occupation'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('mothers_phone') ? ' is-invalid' : ''); ?>" type="text" name="mothers_phone" id="mothers_phone" value="<?php echo e(old('mothers_phone')); ?>">
                                        <label><?php echo app('translator')->get('lang.mother'); ?> <?php echo app('translator')->get('lang.phone'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('mothers_phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mothers_phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderMothersName" placeholder="<?php echo app('translator')->get('lang.photo'); ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="mothers_photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" name="mothers_photo" id="mothers_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-40">
                                <div class="col-lg-12 d-flex flex-wrap">
                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.relation_with_guardian'); ?></p>
                                    <div class="d-flex radio-btn-flex ml-40">
                                        <div class="mr-30">
                                            <input type="radio" name="relationButton" id="relationFather" value="F" class="common-radio relationButton" <?php echo e(old('relationButton') == "F"? 'checked': ''); ?>>
                                            <label for="relationFather"><?php echo app('translator')->get('lang.father'); ?></label>
                                        </div>
                                        <div class="mr-30">
                                            <input type="radio" name="relationButton" id="relationMother" value="M" class="common-radio relationButton" <?php echo e(old('relationButton') == "M"? 'checked': ''); ?>>
                                            <label for="relationMother"><?php echo app('translator')->get('lang.mother'); ?></label>
                                        </div>
                                        <div>
                                            <input type="radio" name="relationButton" id="relationOther" value="O" class="common-radio relationButton"  <?php echo e(old('relationButton') != ""? (old('relationButton') == "O"? 'checked': ''): 'checked'); ?>>
                                            <label for="relationOther"><?php echo app('translator')->get('lang.Other'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-40">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardians_name') ? ' is-invalid' : ''); ?>" type="text" name="guardians_name" id="guardians_name" value="<?php echo e(old('guardians_name')); ?>">
                                        <label><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.name'); ?> <span></span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardians_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input read-only-input" type="text" placeholder="Relation" name="relation" id="relation" value="Other" readonly>
                                        <label><?php echo app('translator')->get('lang.relation_with_guardian'); ?> </label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('guardians_email') ? ' is-invalid' : ''); ?>" type="text" name="guardians_email" id="guardians_email" value="<?php echo e(old('guardians_email')); ?>">
                                        <label><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.email'); ?></span>* </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardians_email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderGuardiansName" placeholder="<?php echo app('translator')->get('lang.photo'); ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="guardians_photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" name="guardians_photo" id="guardians_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardians_phone') ? ' is-invalid' : ''); ?>" type="text" name="guardians_phone" id="guardians_phone" value="<?php echo e(old('guardians_phone')); ?>">
                                        <label><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.phone'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="guardians_occupation" id="guardians_occupation" value="<?php echo e(old('guardians_occupation')); ?>">
                                        <label><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.occupation'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-40 mt-40">
                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="guardians_address" id="guardians_address"><?php echo e(old('guardians_address')); ?></textarea>
                                        <label><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.address'); ?> <span></span> </label>
                                        <span class="focus-border textarea"></span>
                                       <?php if($errors->has('guardians_address')): ?>
                                        <span class="invalid-feedback">
                                            <strong><?php echo e($errors->first('guardians_address')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.address'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30 mt-30">
                            <div class="col-lg-6">

                                <div class="input-effect sm2_mb_20 md_mb_20 mt-20">
                                    <textarea class="primary-input form-control<?php echo e($errors->has('current_address') ? ' is-invalid' : ''); ?>" cols="0" rows="3" name="current_address" id="current_address"><?php echo e(old('current_address')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.current'); ?> <?php echo app('translator')->get('lang.address'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                   <?php if($errors->has('current_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('current_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="input-effect sm2_mb_20 md_mb_20 mt-20">
                                    <textarea class="primary-input form-control<?php echo e($errors->has('current_address') ? ' is-invalid' : ''); ?>" cols="0" rows="3" name="permanent_address" id="permanent_address"><?php echo e(old('permanent_address')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.permanent'); ?> <?php echo app('translator')->get('lang.address'); ?>  <span></span> </label>
                                    <span class="focus-border textarea"></span>
                                   <?php if($errors->has('permanent_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('permanent_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.transport'); ?></h4>
                                </div>
                            </div>
                        </div>

                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="route" id="route">
                                        <option data-display="<?php echo app('translator')->get('lang.route_list'); ?>" value=""><?php echo app('translator')->get('lang.route_list'); ?></option>
                                        <?php $__currentLoopData = $route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($route_list->id); ?>" <?php echo e(old('route') == $route_list->id? 'selected': ''); ?>><?php echo e($route_list->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('route')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('route')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="select_vehicle_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('vehicle') ? ' is-invalid' : ''); ?>" name="vehicle" id="selectVehicle">
                                        <option data-display="<?php echo app('translator')->get('lang.vehicle'); ?> <?php echo app('translator')->get('lang.number'); ?>" value=""><?php echo app('translator')->get('lang.vehicle'); ?> <?php echo app('translator')->get('lang.number'); ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_transport_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('vehicle')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('vehicle')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div> 
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.Other'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                                </div>
                            </div>
                        </div>
                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('dormitory_name') ? ' is-invalid' : ''); ?>" name="dormitory_name" id="SelectDormitory">
                                        <option data-display="<?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.name'); ?>" value=""><?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.name'); ?></option >
                                        <?php $__currentLoopData = $dormitory_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dormitory_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($dormitory_list->id); ?>" <?php echo e(old('dormitory_name') == $dormitory_list->id? 'selected': ''); ?>><?php echo e($dormitory_list->dormitory_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('dormitory_name')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('dormitory_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="roomNumberDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('room_number') ? ' is-invalid' : ''); ?>" name="room_number" id="selectRoomNumber">
                                        <option data-display="<?php echo app('translator')->get('lang.room'); ?> <?php echo app('translator')->get('lang.number'); ?>" value=""><?php echo app('translator')->get('lang.room'); ?> <?php echo app('translator')->get('lang.number'); ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_dormitory_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('room_number')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('room_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.document_info'); ?></h4>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-30 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('national_id_number') ? ' is-invalid' : ''); ?>" type="text" name="national_id_number" value="<?php echo e(old('national_id_number')); ?>">
                                    <label><?php echo app('translator')->get('lang.national_id'); ?> <?php echo app('translator')->get('lang.number'); ?> <span></span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('national_id_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('national_id_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="local_id_number" value="<?php echo e(old('local_id_number')); ?>">
                                    <label> <?php echo app('translator')->get('lang.birth_certificate'); ?> <?php echo app('translator')->get('lang.number'); ?><span></span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="bank_account_number" value="<?php echo e(old('bank_account_number')); ?>">
                                    <label><?php echo app('translator')->get('lang.bank_account'); ?> <?php echo app('translator')->get('lang.number'); ?><span></span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="bank_name" value="<?php echo e(old('bank_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.name'); ?> <span></span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="previous_school_details"><?php echo e(old('previous_school_details')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.previous_school_details'); ?></label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="additional_notes"><?php echo e(old('additional_notes')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.additional_notes'); ?></label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect mt-30">
                                    <input class="primary-input form-control" type="text" name="ifsc_code" value="<?php echo e(old('ifsc_code')); ?>">
                                    <label><?php echo app('translator')->get('lang.IFSC_Code'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>

                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control" type="text" name="document_title_1" value="<?php echo e(old('document_title_1')); ?>">
                                    <label><?php echo app('translator')->get('lang.document_01_title'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_2" value="<?php echo e(old('document_title_2')); ?>">
                                    <label><?php echo app('translator')->get('lang.document_02_title'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_3" value="<?php echo e(old('document_title_3')); ?>">
                                    <label><?php echo app('translator')->get('lang.document_03_title'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_4" value="<?php echo e(old('document_title_4')); ?>">
                                    <label><?php echo app('translator')->get('lang.document_04_title'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                         <div class="row mb-30">
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="01"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_1" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="02"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_2"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_2" id="document_file_2">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileThreeName" placeholder="03"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_3"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_3" id="document_file_3">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="04"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_4" id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('backEnd.studentInformation._custom_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        

	                        <?php 
                                  $tooltip = "";
                                  if(userPermission(65)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>


                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                               <button class="primary-btn fix-gr-bg submit" id="_submit_btn_admission" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.student'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</section>
 
<input type="text" id="STurl" value="<?php echo e(route('student_admission_pic')); ?>" hidden>
 <div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.crop_image_and_upload'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="upload_logo"><?php echo app('translator')->get('lang.crop'); ?></a>
            </div>
        </div>
    </div>
</div>


 

 <div class="modal" id="FatherPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.crop_image_and_upload'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="fa_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="FatherPic_logo"><?php echo app('translator')->get('lang.crop'); ?></a>
            </div>
        </div>
    </div>
</div>

 

 <div class="modal" id="MotherPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="ma_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Mother_logo">Crop</a>
            </div>
        </div>
    </div>
</div>

 

 <div class="modal" id="GurdianPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="Gu_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Gurdian_logo">Crop</a>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/st_addmision.js"></script>
<script>
    $(document).ready(function(){
        
        $(document).on('change','.cutom-photo',function(){
            let v = $(this).val();
            let v1 = $(this).data("id");
            console.log(v,v1);
            getFileName(v, v1);

        });

        function getFileName(value, placeholder){
            if (value) {
                var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                var filename = value.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                $(placeholder).attr('placeholder', '');
                $(placeholder).attr('placeholder', filename);
            }
        }

        
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/studentInformation/student_admission.blade.php ENDPATH**/ ?>