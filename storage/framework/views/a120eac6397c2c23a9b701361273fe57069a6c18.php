
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.edit_staff'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .form-control:disabled{
        background-color: #FFFFFF;
    }
</style>
<input type="text" hidden id="urlStaff" value="<?php echo e(route('staffProfileUpdate',$editData->id)); ?>">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.edit_staff'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('staff_directory')); ?>"><?php echo app('translator')->get('lang.staff_list'); ?></a>
                <a href="<?php echo e(route('editStaff', $editData->id)); ?>"><?php echo app('translator')->get('lang.edit_staff'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.edit_staff'); ?></h3>
                </div>
            </div>
        </div>
        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

    <?php else: ?>
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staffUpdate', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

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
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h4><?php echo app('translator')->get('lang.basic_info'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>

                    <input type="hidden" name="staff_id" value="<?php echo e(@$editData->id); ?>" id="_id"> 
                    <div class="row mb-30 mt-20">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('staff_no') ? ' is-invalid' : ''); ?>" type="text"  name="staff_no" readonly value="<?php if(isset($editData)): ?><?php echo e($editData->staff_no); ?> <?php endif; ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('lang.staff_number'); ?></label>
                                <?php if($errors->has('staff_no')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('staff_no')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="role_id" >
                                    <?php if($editData->role_id != 1): ?>
                                    <option data-display="<?php echo app('translator')->get('lang.role'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?></option>

                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" 
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->role_id == $value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>

                                        <option value="1">Superadmin</option>

                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('role_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('role_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('department_id') ? ' is-invalid' : ''); ?>" name="department_id" id="department_id">
                                        <option data-display="<?php echo app('translator')->get('lang.department'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> </option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"
                                            <?php if(isset($editData)): ?>
                                            <?php if($editData->department_id == $value->id): ?>
                                            selected
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            ><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('department_id')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('department_id')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('designation_id') ? ' is-invalid' : ''); ?>" name="designation_id" id="designation_id">
                                            <option data-display="<?php echo app('translator')->get('lang.designation'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> </option>
                                            <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                <?php if(isset($editData)): ?>
                                                <?php if($editData->designation_id == $value->id): ?>
                                                selected
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                ><?php echo e($value->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('designation_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('designation_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-30">
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" value="<?php if(isset($editData)): ?><?php echo e($editData->first_name); ?> <?php endif; ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.first'); ?> <?php echo app('translator')->get('lang.name'); ?>*</label>
                                            <?php if($errors->has('first_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" value="<?php if(isset($editData)): ?><?php echo e($editData->last_name); ?><?php endif; ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.last'); ?> <?php echo app('translator')->get('lang.name'); ?>*</label>
                                            <?php if($errors->has('last_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>" type="text"  name="fathers_name" value="<?php if(isset($editData)): ?><?php echo e($editData->fathers_name); ?><?php endif; ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.father_name'); ?></label>
                                            <?php if($errors->has('fathers_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('fathers_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>" type="text" name="mothers_name" value="<?php if(isset($editData)): ?><?php echo e($editData->mothers_name); ?><?php endif; ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.mother_name'); ?></label>
                                            <?php if($errors->has('mothers_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('mothers_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                 <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email" name="email" value="<?php if(isset($editData)): ?><?php echo e($editData->email); ?><?php endif; ?>">
                                        <span class="focus-border"></span>
                                        <label><?php echo app('translator')->get('lang.email'); ?>*</label>
                                        <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender_id') ? ' is-invalid' : ''); ?>" name="gender_id">
                                            <option data-display="<?php echo app('translator')->get('lang.gender'); ?> *" value=""><?php echo app('translator')->get('lang.gender'); ?> *</option>
                                            <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gender->id); ?>"
                                                <?php if(isset($editData)): ?>
                                                <?php if($editData->gender_id == $gender->id): ?>
                                                selected
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                ><?php echo e($gender->base_setup_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('gender_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('gender_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                    name="date_of_birth" value="<?php echo e(date('m/d/Y', strtotime($editData->date_of_birth))); ?>">
                                                    <span class="focus-border"></span>
                                                    <label><?php echo app('translator')->get('lang.date_of_birth'); ?></label>
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
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_joining') ? ' is-invalid' : ''); ?>" id="date_of_joining" type="text"
                                                    name="date_of_joining" value="<?php echo e(date('m/d/Y', strtotime($editData->date_of_joining))); ?> ">
                                                    <span class="focus-border"></span>
                                                    <label><?php echo app('translator')->get('lang.date_of_joining'); ?></label>
                                                    <?php if($errors->has('date_of_joining')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('date_of_joining')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="date_of_joining"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                   <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" type="text" name="mobile" value="<?php if(isset($editData)): ?><?php echo e($editData->mobile); ?><?php endif; ?>">
                                        <span class="focus-border"></span>
                                        <label><?php echo app('translator')->get('lang.mobile'); ?>*</label>
                                        <?php if($errors->has('mobile')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mobile')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="marital_status">
                                            <option data-display="Marital Status" value=""><?php echo app('translator')->get('lang.marital_status'); ?></option>
                                            
                                            <option value="married" <?php echo e($editData->marital_status == "married"? 'selected':''); ?>><?php echo app('translator')->get('lang.married'); ?></option>
                                            <option value="unmarried" <?php echo e($editData->marital_status == "unmarried"? 'selected':''); ?>><?php echo app('translator')->get('lang.unmarried'); ?></option>
                                            
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('emergency_mobile') ? ' is-invalid' : ''); ?>" type="text"  name="emergency_mobile" value="<?php if(isset($editData)): ?><?php echo e($editData->emergency_mobile); ?> <?php endif; ?>">
                                        <span class="focus-border"></span>
                                        <label><?php echo app('translator')->get('lang.emergency_mobile'); ?></label>
                                        <?php if($errors->has('emergency_mobile')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('emergency_mobile')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input class="primary-input form-control<?php echo e($errors->has('driving_license') ? ' is-invalid' : ''); ?>" type="text"  name="driving_license" value="<?php echo e($editData->driving_license); ?>">
                                        <span class="focus-border"></span>
                                        <label><?php echo app('translator')->get('lang.driving_license'); ?> </label>
                                        <?php if($errors->has('driving_license')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('driving_license')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="row mb-20">
                            <div class="col-lg-6">
                                 <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control <?php echo e($errors->has('staff_photo') ? ' is-invalid' : ''); ?>" id="placeholderStaffsName" type="text" placeholder="<?php echo e($editData->staff_photo != ""? getFilePath3($editData->staff_photo):'Staff Photo'); ?>"
                                            readonly >
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('staff_photo')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('staff_photo')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button" id="pic">
                                            <label class="primary-btn small fix-gr-bg" for="staff_photo"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none form-control" name="staff_photo" id="staff_photo">
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4" name="current_address" id="current_address"><?php if(isset($editData)): ?><?php echo e($editData->current_address); ?><?php endif; ?></textarea>
                                    <label><?php echo app('translator')->get('lang.current_address'); ?>*</label>
                                    <span class="focus-border textarea "></span>
                                    <?php if($errors->has('current_address')): ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($errors->first('current_address')); ?></strong>
                                    </span>
                                    <?php endif; ?> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="permanent_address" id="permanent_address"><?php if(isset($editData)): ?><?php echo e($editData->permanent_address); ?><?php endif; ?></textarea>
                                    <span class="focus-border textarea"></span>
                                    <label><?php echo app('translator')->get('lang.permanent_address'); ?></label>
                                    <?php if($errors->has('permanent_address')): ?>
                                    <span class="danger text-danger">
                                        <strong><?php echo e($errors->first('permanent_address')); ?></strong>
                                    </span>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="qualification" id="qualification"><?php if(isset($editData)): ?><?php echo e($editData->qualification); ?><?php endif; ?></textarea>
                                    <span class="focus-border textarea"></span>
                                    <label><?php echo app('translator')->get('lang.qualifications'); ?></label>
                                    <?php if($errors->has('qualification')): ?>
                                    <span class="danger text-danger">
                                        <strong><?php echo e($errors->first('qualification')); ?></strong>
                                    </span>
                                    <?php endif; ?> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="experience" id="experience"><?php if(isset($editData)): ?><?php echo e($editData->experience); ?><?php endif; ?>
                                    </textarea>
                                    <span class="focus-border textarea"></span>
                                    <label><?php echo app('translator')->get('lang.experience'); ?></label>
                                    <?php if($errors->has('experience')): ?>
                                    <span class="danger text-danger">
                                        <strong><?php echo e($errors->first('experience')); ?></strong>
                                    </span>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>


                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4><?php echo app('translator')->get('lang.payroll_details'); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row mb-30 mt-20">
                            <div class="col-lg-3">
                             <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('epf_no') ? ' is-invalid' : ''); ?>" type="text"  name="epf_no" value="<?php echo e($editData->epf_no); ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('lang.epf_no'); ?></label>
                                <?php if($errors->has('epf_no')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('epf_no')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                         <div class="input-effect">
                             <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('basic_salary')? ' is-invalid' : ''); ?>" type="text"  name="basic_salary" value="<?php echo e($editData->basic_salary); ?>">
                             <span class="focus-border"></span>
                             <label><?php echo app('translator')->get('lang.basic_salary'); ?>*</label>
                             <?php if($errors->has('basic_salary')): ?>
                             <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('basic_salary')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="input-effect">
                            <select class="niceSelect w-100 bb form-control" name="contract_type">
                                <option data-display="<?php echo app('translator')->get('lang.select'); ?>" value=""><?php echo app('translator')->get('lang.select'); ?></option>
                                <option value="permanent"
                                <?php if(isset($editData)): ?>
                                <?php if($editData->contract_type == 'permanent'): ?>
                                selected
                                <?php endif; ?>
                                <?php endif; ?>
                                ><?php echo app('translator')->get('lang.permanent'); ?> </option>
                                <option value="contract"
                                <?php if(isset($editData)): ?>
                                <?php if($editData->contract_type == 'contract'): ?>
                                selected
                                <?php endif; ?>
                                <?php endif; ?>
                                > <?php echo app('translator')->get('lang.contract'); ?></option>
                            </select>
                            <span class="focus-border"></span>

                        </div>
                    </div>

                    <div class="col-lg-3">
                     <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('location') ? ' is-invalid' : ''); ?>" type="text"  name="location" value="<?php echo e($editData->location); ?>">
                        <span class="focus-border"></span>
                        <label><?php echo app('translator')->get('lang.location'); ?></label>
                        <?php if($errors->has('location')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('location')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mt-40 mt-20">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h4><?php echo app('translator')->get('lang.location'); ?></h4>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-3">
                 <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('bank_account_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_name" value="<?php echo e($editData->bank_account_name); ?>">
                    <span class="focus-border"></span>
                    <label><?php echo app('translator')->get('lang.bank_account_name'); ?></label>
                </div>
            </div>

            <div class="col-lg-3">
             <div class="input-effect">
                <input class="primary-input form-control<?php echo e($errors->has('bank_account_no') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_no" value="<?php echo e($editData->bank_account_no); ?>">
                <span class="focus-border"></span>
                <label><?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.no'); ?></label>
            </div>
        </div>

        <div class="col-lg-3">
         <div class="input-effect">
            <input class="primary-input form-control<?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_name" value="<?php echo e($editData->bank_name); ?>">
            <span class="focus-border"></span>
            <label><?php echo app('translator')->get('lang.bank_name'); ?></label>
        </div>
    </div>

    <div class="col-lg-3">
     <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('bank_brach') ? ' is-invalid' : ''); ?>" type="text" name="bank_brach" value="<?php echo e($editData->bank_brach); ?>">
        <span class="focus-border"></span>
        <label><?php echo app('translator')->get('lang.branch_name'); ?></label>
    </div>
</div>

</div>

<div class="row mt-40 mt-20">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('lang.social_links_details'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
     <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('facebook_url') ? ' is-invalid' : ''); ?>" type="text"  name="facebook_url" value="<?php echo e($editData->facebook_url); ?>">
        <span class="focus-border"></span>
        <label><?php echo app('translator')->get('lang.facebook_url'); ?></label>
    </div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('twiteer_url') ? ' is-invalid' : ''); ?>" type="text" name="twiteer_url" value="<?php echo e($editData->twiteer_url); ?>">
    <span class="focus-border"></span>
    <label><?php echo app('translator')->get('lang.twitter_url'); ?></label>
</div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('linkedin_url') ? ' is-invalid' : ''); ?>" type="text"  name="linkedin_url" value="<?php echo e($editData->linkedin_url); ?>">
    <span class="focus-border"></span>
    <label><?php echo app('translator')->get('lang.linkedin_url'); ?></label>
</div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('instragram_url') ? ' is-invalid' : ''); ?>" type="text"  name="instragram_url" value="<?php echo e($editData->instragram_url); ?>">
    <span class="focus-border"></span>
    <label><?php echo app('translator')->get('lang.instragram_url'); ?></label>
</div>
</div>

</div>

<div class="row mt-40 mt-20">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('lang.document_info'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-4">
     <div class="row no-gutters input-right-icon mb-20">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input form-control <?php echo e($errors->has('resume') ? ' is-invalid' : ''); ?>" type="text" placeholder="<?php echo e(isset($editData->resume) && $editData->resume != ""? getFilePath3($editData->resume):'Resume'); ?>"
                readonly  id="placeholderResume">
                <span class="focus-border"></span>
                <?php if($errors->has('resume')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('resume')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="resume"><?php echo app('translator')->get('lang.browse'); ?></label>
                <input type="file" class="d-none form-control" name="resume" id="resume">
            </button>

        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon mb-20">
            <div class="col">
                <div class="input-effect">
                    <input class="primary-input form-control <?php echo e($errors->has('joining_letter') ? ' is-invalid' : ''); ?>" type="text" placeholder="<?php echo e(isset($editData->joining_letter) && $editData->joining_letter != ""? getFilePath3($editData->joining_letter):'Joining Letter'); ?>"
                    readonly  id="placeholderJoiningLetter">
                    <span class="focus-border"></span>
                    <?php if($errors->has('joining_letter')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('joining_letter')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <button class="primary-btn-small-input" type="button">
                    <label class="primary-btn small fix-gr-bg" for="joining_letter"><?php echo app('translator')->get('lang.browse'); ?></label>
                    <input type="file" class="d-none form-control" name="joining_letter" id="joining_letter">
                </button>

            </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="row no-gutters input-right-icon mb-20">
            <div class="col">
                <div class="input-effect">
                    <input class="primary-input form-control <?php echo e($errors->has('other_document') ? ' is-invalid' : ''); ?>" type="text" placeholder="<?php echo e(isset($editData->other_document) && $editData->other_document != ""? getFilePath3($editData->joining_letter):'Others Documents'); ?>"
                    readonly  id="placeholderOthersDocument">
                    <span class="focus-border"></span>
                    <?php if($errors->has('other_document')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('other_document')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <button class="primary-btn-small-input" type="button">
                    <label class="primary-btn small fix-gr-bg" for="other_document"><?php echo app('translator')->get('lang.browse'); ?></label>
                    <input type="file" class="d-none form-control" name="other_document" id="other_document">
                </button>

            </div>
    </div>
</div>
</div>

    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="main-title">
                <h4><?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></h4>
            </div>
        </div>
    </div>
    <div class="row mb-30">
        <div class="col-lg-12">
            <hr>
        </div>
    </div>
    <?php echo $__env->make('backEnd.studentInformation._custom_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="row mt-40">
    <div class="col-lg-12 text-center">
            <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" > <?php echo app('translator')->get('lang.update_staff'); ?></button></span>
        <?php else: ?>
        <button class="primary-btn fix-gr-bg submit">
                <span class="ti-check"></span>
                <?php echo app('translator')->get('lang.update_staff'); ?>
            </button>
        <?php endif; ?> 
        
    </div>
</div>
</div>
</div>
</div>
</div>
<?php echo e(Form::close()); ?>

</div>
</section>


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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/editStaff.js"></script>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/backEnd/humanResource/editStaff.blade.php ENDPATH**/ ?>