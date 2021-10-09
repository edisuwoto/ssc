
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.login_permission'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/css/login_access_control.css')); ?>"/>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.login_permission'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.login_permission'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'login-access-control', 'enctype' => 'multipart/form-data', 'method' => 'POST'])); ?>

                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role') ? ' is-invalid' : ''); ?>" name="role" id="member_type">
                                            <option data-display=" <?php echo app('translator')->get('lang.select_role'); ?> *" value=""><?php echo app('translator')->get('lang.select_role'); ?> *</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(@$value->id); ?>"><?php echo e(@$value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-30">
                                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?>*</option>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e(@$class->id); ?>"  <?php echo e(( old("class") == @$class->id ? "selected":"")); ?>><?php echo e(@$class->class_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section_member" name="section">
                                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>



                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                </div>

                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($students)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-3"><?php echo app('translator')->get('lang.student_list'); ?> (<?php echo e(@$students->count()); ?>)</h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="" class="display school-table school-table-style" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.admission'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.roll'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.class'); ?></th>

                                        <th><?php echo app('translator')->get('lang.student'); ?>  <?php echo app('translator')->get('lang.permission'); ?></th>
                                        <th><?php echo app('translator')->get('lang.student'); ?>  <?php echo app('translator')->get('lang.password'); ?></th>

                                        <th><?php echo app('translator')->get('lang.parents'); ?>  <?php echo app('translator')->get('lang.permission'); ?></th>
                                        <th><?php echo app('translator')->get('lang.parents'); ?>  <?php echo app('translator')->get('lang.password'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo e(@$student->user_id); ?>">
                                        
                                        <td>
                                            <input type="hidden" id="id" value="<?php echo e(@$student->user_id); ?>">
                                            <input type="hidden" id="role" value="<?php echo e(@$role); ?>">
                                             <?php echo e(@$student->admission_no); ?>

                                        </td>
                                        <td> <?php echo e(@$student->roll_no); ?></td>
                                        <td><?php echo e(@$student->first_name.' '.@$student->last_name); ?>  </td>
                                        <td><?php echo e(!empty(@$student->className)?@$student->className->class_name:''); ?> (<?php echo e(!empty(@$student->className)?@$student->section->section_name:''); ?>)</td>
                                        <td>
                                            <input type="hidden" name="id" value="<?php echo e($student->user_id); ?>">
                                            <label class="switch">
                                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                     <input type="checkbox" disabled id="ch<?php echo e(@$student->user_id); ?>" onclick="lol(<?php echo e(@$student->user_id); ?>,<?php echo e(@$role); ?>)" class="switch-input11" <?php echo e(@$student->user->access_status == 0? '':'checked'); ?> >
                                                        <span class="slider round" data-toggle="tooltip" title="Disabled For Demo"></span>
                                                        <?php else: ?> 
                                                        <input type="checkbox" id="ch<?php echo e(@$student->user_id); ?>" onclick="lol(<?php echo e(@$student->user_id); ?>,<?php echo e(@$role); ?>)" class="switch-input11" <?php echo e(@$student->user->access_status == 0? '':'checked'); ?>>
                                                        <span class="slider round"></span>
                                                     <?php endif; ?>
                                            
                                            </label>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'reset-student-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                <input type="hidden" name="id" value="<?php echo e(@$student->user_id); ?>">
                                                <div class="row mt-10">
                                                    <div class="col-lg-6">
                                                        <div class="input-effect md_mb_20">
                                                            <input class="primary-input read-only-input" type="text" name="new_password" required="true" minlength="6">
                                                            <label><?php echo app('translator')->get('lang.password'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                                            <button class="primary-btn small tr-bg icon-only mt-10" style="pointer-events: none;" type="button" ><span class="ti-save"> </button>
                                                        </span>
                                                    
                                                        <?php else: ?> 
        
                                                        <button type="submit" class="primary-btn small tr-bg icon-only mt-10"  data-toggle="tooltip" title="Update Password" >
                                                            <span class="ti-save"></span>
                                                        </button>
        
                                                        <?php endif; ?>

                                                        <button data-toggle="tooltip" title="Reset Password as Default" type="button" class="primary-btn small tr-bg icon-only mt-10" onclick="changePassword(<?php echo e(@$student->user_id); ?>,<?php echo e(@$role); ?>)" >
                                                            <span class="ti-reload"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php echo e(Form::close()); ?>

                                        </td>
                                        <td>
                                            <?php $parent = App\SmParent::where('id',$student->parent_id)->first();?>
                                            <input type="hidden" name="ParentID" value="<?php echo e($parent->user_id); ?>" id="ParentID">
                                           
                                            <label class="switch">
                                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                    <input type="checkbox" disabled class="parent-login-disable" <?php echo e(@$parent->parent_user->access_status == 0? '':'checked'); ?>>
                                                     <span class="slider round" data-toggle="tooltip" title="Disabled For Demo"></span>
                                                    <?php else: ?> 

                                                    <input type="checkbox" class="parent-login-disable" <?php echo e(@$parent->parent_user->access_status == 0? '':'checked'); ?>>
                                                     <span class="slider round"></span>

                                                <?php endif; ?>
                                            </label>

                                        </td>
                                        <td style="white-space: nowrap;">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'reset-student-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                <input type="hidden" name="id" value="<?php echo e(@$student->parents->user_id); ?>">
                                                <div class="row mt-10">
                                                    <div class="col-lg-6">
                                                        <div class="input-effect md_mb_20">
                                                            <input class="primary-input read-only-input" type="text" name="new_password" required="true" minlength="6">
                                                            <label><?php echo app('translator')->get('lang.password'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                         <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                                    <button class="primary-btn small tr-bg icon-only mt-10" style="pointer-events: none;" type="button" ><span class="ti-save"> </button>
                                                </span>
                                            
                                                <?php else: ?> 

                                                <button type="submit" class="primary-btn small tr-bg icon-only mt-10"  data-toggle="tooltip" title="Update Password" >
                                                    <span class="ti-save"></span>
                                                </button>

                                                <?php endif; ?>
                                                        <button data-toggle="tooltip" title="Reset Password as Default" type="button" class="primary-btn small tr-bg icon-only mt-10"
                                                        onclick="changePassword(<?php echo e(@$student->parents->user_id); ?>,<?php echo e(@$role); ?>)" >
                                                            <span class="ti-reload"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php echo e(Form::close()); ?>

                                        </td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($staffs)): ?>
             <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.staff_list'); ?></h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                <th><?php echo app('translator')->get('lang.name'); ?></th>
                                <th><?php echo app('translator')->get('lang.role'); ?></th>
                                <th><?php echo app('translator')->get('lang.email'); ?></th>
                                <th><?php echo app('translator')->get('lang.login_permission'); ?></th>
                                <th><?php echo app('translator')->get('lang.password'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e(@$value->user_id); ?>">
                                <input type="hidden" id="id" value="<?php echo e(@$value->user_id); ?>">
                                <input type="hidden" id="role" value="<?php echo e(@$role); ?>">
                                <td><?php echo e(@$value->staff_no); ?></td>
                                <td><?php echo e(@$value->first_name); ?>&nbsp;<?php echo e(@$value->last_name); ?></td>
                                <td><?php echo e(!empty(@$value->roles->name)?@$value->roles->name:''); ?></td>
                                <td><?php echo e(@$value->email); ?></td>
                                <td>
                                    <?php
                                        if(@$value->staff_user->access_status == 0){
                                                $permission_id=422;
                                        }else{
                                                $permission_id=423;
                                        }
                                    ?>
                                    <?php if(userPermission($permission_id)): ?>
                                    <label class="switch">
                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                            <input type="checkbox" disabled class="switch-input" <?php echo e(@$value->staff_user->access_status == 0? '':'checked'); ?>>
                                            <span class="slider round" data-toggle="tooltip" title="Disabled For Demo"></span>
                                            <?php else: ?> 
                                            <input type="checkbox" class="switch-input" <?php echo e(@$value->staff_user->access_status == 0? '':'checked'); ?>>
                                            <span class="slider round"></span>
                                            <?php endif; ?>
                                    </label>
                                    <?php endif; ?>
                                </td>
                                <td style="white-space: nowrap;">
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'reset-student-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                        <input type="hidden" name="id" value="<?php echo e($value->user_id); ?>">
                                        <div class="row mt-10">
                                            <div class="col-lg-6">
                                                <div class="input-effect md_mb_20">
                                                    <input class="primary-input read-only-input" type="text" name="new_password" required="true" minlength="6">
                                                    <label><?php echo app('translator')->get('lang.password'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                                    <button class="primary-btn small tr-bg icon-only mt-10" style="pointer-events: none;" type="button" ><span class="ti-save"> </button>
                                                </span>
                                            
                                                <?php else: ?> 

                                                <button type="submit" class="primary-btn small tr-bg icon-only mt-10"  data-toggle="tooltip" title="Update Password" >
                                                    <span class="ti-save"></span>
                                                </button>

                                                <?php endif; ?>

                                                <button data-toggle="tooltip" title="Reset Password as Default" type="button" class="primary-btn small tr-bg icon-only mt-10"
                                                onclick="changePassword(<?php echo e(@$value->user_id); ?>,<?php echo e(@$role); ?>)" >
                                                    <span class="ti-reload"></span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php echo e(Form::close()); ?>

                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <?php endif; ?>

        <?php if(isset($parents)): ?>
            <div class="row mt-40">


                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.parents'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="10">
                                            <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.guardian_phone'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.father_name'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.father_phone'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.mother_name'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.mother_phone'); ?> </th>
                                        <th><?php echo app('translator')->get('lang.login_permission'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo e(@$parent->user_id); ?>">
                                        <input type="hidden" id="id" value="<?php echo e(@$parent->user_id); ?>">
                                        <input type="hidden" id="role" value="<?php echo e(@$role); ?>">
                                        <td><?php echo e(@$parent->guardians_mobile); ?></td>
                                        <td><?php echo e(@$parent->fathers_name); ?></td>
                                        <td><?php echo e(@$parent->fathers_mobile); ?></td>
                                        <td><?php echo e(@$parent->mothers_name); ?></td>
                                        <td><?php echo e(@$parent->mothers_mobile); ?></td>
                                        <td>
                                            <?php
                                                if(@$value->staff_user->access_status == 0){
                                                    $permission_id=422;
                                                }else{
                                                    $permission_id=423;
                                                }
                                            ?>
                                            <?php if(userPermission($permission_id)): ?>
                                            <label class="switch">
                                              <input type="checkbox" class="switch-input" <?php echo e(@$parent->parent_user->access_status == 0? '':'checked'); ?>>
                                              <span class="slider round"></span>
                                            </label>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>
</div>
</div>
</div>
</section>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/systemSettings/login_access_control.blade.php ENDPATH**/ ?>