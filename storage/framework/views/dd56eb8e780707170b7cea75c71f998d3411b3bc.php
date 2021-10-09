
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.vehicle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1> <?php echo app('translator')->get('lang.vehicle'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.transport'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.vehicle'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($assign_vehicle)): ?>
        <?php if(userPermission(354)): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('vehicle')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($assign_vehicle)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.vehicle'); ?>
                            </h3>
                        </div>
                        <?php if(isset($assign_vehicle)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('vehicle-update',@$assign_vehicle->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(354)): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'vehicle',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('vehicle_number') ? ' is-invalid' : ''); ?>"
                                                type="text" name="vehicle_number" autocomplete="off" value="<?php echo e(isset($assign_vehicle)? @$assign_vehicle->vehicle_no:old('vehicle_number')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($assign_vehicle)? @$assign_vehicle->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.vehicle'); ?> <?php echo app('translator')->get('lang.number'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('vehicle_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('vehicle_number')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('vehicle_model') ? ' is-invalid' : ''); ?>"
                                                type="text" name="vehicle_model" autocomplete="off" value="<?php echo e(isset($assign_vehicle)? @$assign_vehicle->vehicle_model:old('vehicle_model')); ?>">
                                            <label><?php echo app('translator')->get('lang.vehicle'); ?> <?php echo app('translator')->get('lang.model'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('vehicle_model')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('vehicle_model')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('year_made') ? ' is-invalid' : ''); ?>"
                                                type="text" onkeypress="return isNumberKey(event)" name="year_made" autocomplete="off" value="<?php echo e(isset($assign_vehicle)? @$assign_vehicle->made_year:old('year_made')); ?>">
                                            <label><?php echo app('translator')->get('lang.year_made'); ?></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('year_made')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('year_made')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                          

                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('driver_id') ? ' is-invalid' : ''); ?>" id="select_class" name="driver_id">
                                        <option data-display="<?php echo app('translator')->get('lang.select_driver'); ?> *" value=""><?php echo app('translator')->get('lang.select_driver'); ?> *</option>
                                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($driver->id); ?>" <?php echo e(isset($assign_vehicle)? (@$assign_vehicle->driver_id == @$driver->id? 'selected':''):''); ?> > <?php echo e(@$driver->full_name); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('driver_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('driver_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="note"><?php echo e(isset($assign_vehicle)? @$assign_vehicle->note:old('note')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.note'); ?></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(354)){
                                        @$tooltip = "";
                                    }else{
                                        @$tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($assign_vehicle)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.vehicle'); ?>
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
                            <h3 class="mb-0">  <?php echo app('translator')->get('lang.vehicle'); ?>  <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="7">
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
                                    <th> <?php echo app('translator')->get('lang.vehicle'); ?>  <?php echo app('translator')->get('lang.no'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.model'); ?>  <?php echo app('translator')->get('lang.no'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.year_made'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.driver'); ?>  <?php echo app('translator')->get('lang.name'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.driver'); ?>  <?php echo app('translator')->get('lang.license'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.phone'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $assign_vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign_vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$assign_vehicle->vehicle_no); ?></td>
                                    <td><?php echo e(@$assign_vehicle->vehicle_model); ?></td>
                                    <td><?php echo e(@$assign_vehicle->made_year); ?></td>
                                    <td><?php echo e((empty(@$assign_vehicle->driver->full_name))?'-':@$assign_vehicle->driver->full_name); ?>   </td> 

                                    <td><?php echo e((empty(@$assign_vehicle->driver->driving_license))?'-':@$assign_vehicle->driver->driving_license); ?>   </td> 
                                    <td><?php echo e((empty(@$assign_vehicle->driver->mobile))?'-':@$assign_vehicle->driver->mobile); ?>   </td> 

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if(userPermission(355)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('vehicle-edit', [@$assign_vehicle->id])); ?>"> <?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                               
                                                <?php if(userPermission(356)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteRoomTypeModal<?php echo e(@$assign_vehicle->id); ?>"
                                                    href="#"> <?php echo app('translator')->get('lang.delete'); ?></a>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRoomTypeModal<?php echo e(@$assign_vehicle->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> <?php echo app('translator')->get('lang.delete'); ?>  <?php echo app('translator')->get('lang.vehicle'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> <?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> <?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('vehicle-delete',@$assign_vehicle->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                    <button class="primary-btn fix-gr-bg" type="submit"> <?php echo app('translator')->get('lang.delete'); ?></button>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/transport/vehicle.blade.php ENDPATH**/ ?>