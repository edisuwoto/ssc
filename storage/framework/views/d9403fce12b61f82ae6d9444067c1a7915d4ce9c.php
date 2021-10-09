
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($editData)): ?>
        <?php if(userPermission(295)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('event')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
              <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($editData)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.event'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('event-update',$editData->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(295)): ?>
             
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'event',
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

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('event_title') ? ' is-invalid' : ''); ?>"
                                            type="text" name="event_title" autocomplete="off" value="<?php echo e(isset($editData)? $editData->event_title : ''); ?>">
                                            <label><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.title'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('event_title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('event_title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-20">

                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('for_whom') ? ' is-invalid' : ''); ?>" id="for_whom" name="for_whom">
                                            <option data-display="<?php echo app('translator')->get('lang.for_whom'); ?> *" value=""><?php echo app('translator')->get('lang.for_whom'); ?> *</option>
                                            
                                            <option value="All" <?php echo e(isset($editData)? ($editData->for_whom == 'All'? 'selected' : ''):""); ?>><?php echo app('translator')->get('lang.all'); ?></option>
                                            <option value="Teacher" <?php echo e(isset($editData)? ($editData->for_whom == 'Teacher'? 'selected' : ''):""); ?>><?php echo app('translator')->get('lang.teacher'); ?></option>
                                            <option value="Student" <?php echo e(isset($editData)? ($editData->for_whom == 'Student'? 'selected' : ''):""); ?>><?php echo app('translator')->get('lang.student'); ?></option>
                                            <option value="Parents" <?php echo e(isset($editData)? ($editData->for_whom == 'Parents'? 'selected' : ''):""); ?>><?php echo app('translator')->get('lang.parents'); ?></option>
                                            
                                            
                                        </select>
                                        <?php if($errors->has('for_whom')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('for_whom')); ?></strong>
                                        </span>
                                        <?php endif; ?>

                                    </div>
                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('event_location') ? ' is-invalid' : ''); ?>"
                                            type="text" name="event_location" autocomplete="off" value="<?php echo e(isset($editData)? $editData->event_location : ''); ?>">
                                            <label><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.location'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('event_location')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('event_location')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('from_date') ? ' is-invalid' : ''); ?>" id="event_from_date" type="text"
                                            name="from_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->from_date)): ''); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->get('lang.start_date'); ?><span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('from_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('from_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_start_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('to_date') ? ' is-invalid' : ''); ?>" id="event_to_date" type="text"
                                            name="to_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->to_date)): ''); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->get('lang.to_date'); ?><span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('to_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('to_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_end_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control <?php echo e($errors->has('event_des') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="event_des"><?php echo e(isset($editData)? $editData->event_des: ''); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('event_des')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('event_des')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control <?php echo e($errors->has('upload_file_name') ? ' is-invalid' : ''); ?>" type="text" 
                                            placeholder="<?php echo e(isset($editData->uplad_image_file) && $editData->uplad_image_file != ""? getFilePath3($editData->uplad_image_file): trans('lang.attach_file').'*'); ?>"
                                              id="placeholderEventFile" readonly>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('upload_file_name')): ?>
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><?php echo e($errors->first('upload_file_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="upload_event_image"><?php echo app('translator')->get('lang.browse'); ?></label>
                                            <input type="file" class="d-none form-control" name="upload_file_name" id="upload_event_image" readonly="">
                                        </button>

                                    </div>
                                </div>
                                  <?php 
                                  $tooltip = "";
                                  if(userPermission(295)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
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
                <?php if(session()->has('message-success-delete')): ?>
                <div class="alert alert-success">
                   <?php echo e(session()->get('message-success-delete')); ?>

               </div>
               <?php elseif(session()->has('message-danger-delete')): ?>
               <div class="alert alert-danger">
                  <?php echo e(session()->get('message-danger-delete')); ?>

              </div>
              <?php endif; ?>
              <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                            <th><?php echo app('translator')->get('lang.event'); ?> <?php echo app('translator')->get('lang.title'); ?></th>
                            <th><?php echo app('translator')->get('lang.for_whom'); ?></th>
                            <th><?php echo app('translator')->get('lang.from_date'); ?></th>
                            <th><?php echo app('translator')->get('lang.to_date'); ?></th>
                            <th><?php echo app('translator')->get('lang.location'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($events)): ?>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e(@$value->event_title); ?></td>
                            <td><?php echo e(@$value->for_whom); ?></td>
                           
                            <td><?php echo e(@$value->from_date != ""? dateConvert(@$value->from_date):''); ?></td>

                          
                            <td  data-sort="<?php echo e(strtotime(@$value->to_date)); ?>" ><?php echo e($value->to_date != ""? dateConvert(@$value->to_date):''); ?></td>

                            <td><?php echo e(@$value->event_location); ?></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                         <?php if(userPermission(296)): ?>
                                         <a class="dropdown-item" href="<?php echo e(route('event-edit',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                        <?php endif; ?>
                                         <?php if(userPermission(297) ): ?>
                                          <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Event" href="<?php echo e(route('delete-event-view',$value->id)); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                        <?php endif; ?>
                                        <?php if($value->uplad_image_file != ""): ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(url(@$value->uplad_image_file)); ?>" download>
                                                    <?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/events/eventsList.blade.php ENDPATH**/ ?>