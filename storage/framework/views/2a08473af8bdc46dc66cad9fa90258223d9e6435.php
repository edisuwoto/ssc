
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.time'); ?> <?php echo app('translator')->get('lang.setup'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.time_setup'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.time_setup'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($online_exam)): ?>
         <?php if(userPermission(239)): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('online-exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
       
          <div class="row">
              <div class="col-lg-10">
              </div>
              <div class="col-lg-2">
                <a class="primary-btn fix-gr-bg" data-toggle="modal" data-target="#commandModal"
                    href="#">Cron Command
                </a>
              </div>
          </div>

          <div class="modal fade admin-query" id="commandModal" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Cron Jobs Command</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center">
                            <h4><code>artisan absent_notification:sms</code> </h4>
                           
                        </div>

                        <div class="mt-40 d-flex ">
                            Example: <code>/opt/cpanel/ea-php74/root/usr/bin/php /home/[HOSTING_USERNAME]/public_html/artisan absent_notification:sms > /dev/null 2>&1</code>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-20">
           

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($editData)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.time_setup'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'absent_time_setup_update', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        
                        <input type="hidden" name="id" value="<?php echo e($editData->id); ?>">
                        <?php else: ?>
                         <?php if(userPermission(239)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'absent_time_setup',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="white-box">
                            <div class="add-visitor">
                       
                         
                           
                                
                             
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time form-control<?php echo e($errors->has('start_time') ? ' is-invalid' : ''); ?>" type="text" name="start_time" value="<?php echo e(isset($editData)? $editData->time_from: old('start_time')); ?>">
                                            <label><?php echo app('translator')->get('lang.start_time'); ?>*</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('start_time')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('start_time')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-timer"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon d-none mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input time  form-control<?php echo e($errors->has('end_time') ? ' is-invalid' : ''); ?>" type="text" name="end_time"  value="<?php echo e(isset($editData)? $editData->time_to: old('end_time')); ?>">
                                                <label><?php echo app('translator')->get('lang.end_time'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('end_time')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12" >
                                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?>"  name="active_status">
                                                <option data-display="<?php echo app('translator')->get('lang.status'); ?> *" value=""><?php echo app('translator')->get('lang.status'); ?>  *</option>
                                                <option value="1" <?php echo e(isset($editData)? ($editData->active_status == 1? 'selected' : ''):""); ?> ><?php echo app('translator')->get('lang.active'); ?></option>
                                                <option value="0" <?php echo e(isset($editData)? ($editData->active_status == 0? 'selected' : ''):""); ?>><?php echo app('translator')->get('lang.pending'); ?></option>
                                            </select>
                                            <?php if($errors->has('active_status')): ?>
                                                <span class="invalid-feedback invalid-select d-block" role="alert">
                                                    <strong><?php echo e($errors->first('active_status')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                            
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="">
                                            <span class="ti-check"></span>
                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.time_setup'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="url" value="<?php echo e(Request::url()); ?>">
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.time_setup'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.time'); ?></th>
                                    
                                    <th><?php echo app('translator')->get('lang.Status'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $setups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$item->time_from); ?></td>
                                        
                                        <td>
                                            <?php if($item->active_status==1): ?>
                                                <?php echo app('translator')->get('lang.active'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.pending'); ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo e(route('absent_time_edit', [$item->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteStudentTypeModal<?php echo e($item->id); ?>"
                                                        href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteStudentTypeModal<?php echo e($item->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.time_setup'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                        <a href="<?php echo e(route('time_setup_delete', [$item->id])); ?>"><button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button></a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/StudentAbsentNotification/Resources/views/index.blade.php ENDPATH**/ ?>