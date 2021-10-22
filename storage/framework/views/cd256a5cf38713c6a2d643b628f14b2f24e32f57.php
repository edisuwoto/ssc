
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.phone_call_log'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.phone_call_log'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.phone_call_log'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($phone_call_log)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('phone-call')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($phone_call_log)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.phone_call'); ?>
                            </h3>
                        </div>
                        <?php if(isset($phone_call_log)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('phone-call_update',@$phone_call_log->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(37)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'phone-call',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('name') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="name" value="<?php echo e(isset($phone_call_log)? $phone_call_log->name: old('name')); ?>">
                                            <label><?php echo app('translator')->get('lang.name'); ?></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e(isset($phone_call_log)? $phone_call_log->id: ''); ?>">
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e(@$errors->has('phone') ? ' is-invalid' : ''); ?>"
                                                   id="apply_date" type="tel"
                                                name="phone" value="<?php echo e(isset($phone_call_log)? $phone_call_log->phone: old('phone')); ?>">
                                            <label><?php echo app('translator')->get('lang.phone'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('phone')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('phone')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e(@$errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" value="<?php echo e(isset($phone_call_log)? $phone_call_log->date: date('m/d/Y')); ?>" autocomplete="off">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.date'); ?> <span></span></label>
                                             <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('date')); ?></strong>
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
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e(@$errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="follow_up_date" value="<?php echo e(isset($phone_call_log)? $phone_call_log->date: date('m/d/Y')); ?>" autocomplete="off">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('lang.follow_up_date'); ?> <span></span></label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('call_duration') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="call_duration" value="<?php echo e(isset($phone_call_log)? $phone_call_log->call_duration: old('call_duration')); ?>">
                                            <label><?php echo app('translator')->get('lang.call_duration'); ?></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('call_duration')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('call_duration')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <?php if(isset($phone_call_log)): ?>
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="description"> <?php echo e(@$phone_call_log->description); ?></textarea>
                                            <?php else: ?>
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="description"><?php echo e(old('description')); ?></textarea>
                                            <?php endif; ?>
                                            <span class="focus-border textarea"></span>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.type'); ?></p>
                                        <div class=" radio-btn-flex ml-20">
                                            <?php if(isset($phone_call_log)): ?>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationFather" value="I" <?php echo e(@$phone_call_log->call_type == 'I'? 'checked': ''); ?> class="common-radio relationButton">
                                                <label for="relationFather"><?php echo app('translator')->get('lang.incoming'); ?></label>
                                            </div><br>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationMother" value="O" <?php echo e(@$phone_call_log->call_type == 'O'? 'checked': ''); ?> class="common-radio relationButton">
                                                <label for="relationMother"><?php echo app('translator')->get('lang.outgoing'); ?></label>
                                            </div>
                                            <?php else: ?>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationFather" value="I" class="common-radio relationButton" checked>
                                                <label for="relationFather"><?php echo app('translator')->get('lang.incoming'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationMother" value="O" class="common-radio relationButton">
                                                <label for="relationMother"><?php echo app('translator')->get('lang.outgoing'); ?></label>
                                            </div>
                                            <?php endif; ?>                                            
                                        </div>
                                    </div>
                                </div>
                                  <?php 
                                  $tooltip = "";
                                  if(userPermission(37)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($phone_call_log)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.phone_call'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.phone_call'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="8">
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
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.follow_up_date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.call_duration'); ?></th>
                                    <th><?php echo app('translator')->get('lang.description'); ?></th>
                                    <th><?php echo app('translator')->get('lang.call'); ?> <?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $phone_call_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone_call_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$phone_call_log->name); ?></td>
                                    <td><?php echo e(@$phone_call_log->phone); ?></td>
                                    <td>
                                        <?php echo e(@$phone_call_log->date != ""? dateConvert(@$phone_call_log->date):''); ?>                                   
                                    </td>
                                    <td>
                                        <?php echo e(@$phone_call_log->next_follow_up_date != ""? dateConvert(@$phone_call_log->next_follow_up_date):''); ?>                                       
                                    </td>
                                    <td><?php echo e(@$phone_call_log->call_duration); ?></td>
                                    <td><?php echo e(@$phone_call_log->description); ?></td>
                                    <td><?php echo e(@$phone_call_log->call_type == "I"? 'Incoming': 'outgoing'); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(38)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('phone-call_edit', @$phone_call_log->id
                                                    )); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                     <?php if(userPermission(39)): ?>
                                               
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteCallLogModal<?php echo e(@$phone_call_log->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteCallLogModal<?php echo e(@$phone_call_log->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.phone_call'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('phone-call_delete',@$phone_call_log->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/admin/phone_call.blade.php ENDPATH**/ ?>