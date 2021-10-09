
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.assign_vehicle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-25 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.assign_vehicle'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.transport'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.assign_vehicle'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($assign_vehicle)): ?>
         <?php if(userPermission(358) ): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('assign-vehicle')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php echo app('translator')->get('lang.assign_vehicle'); ?>
                            </h3>
                        </div>
                        <?php if(isset($assign_vehicle)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('assign-vehicle-update',@$assign_vehicle->id), 'method' => 'PUT'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(358) ): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'assign-vehicle', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <input type="hidden" name="id" value="<?php echo e(isset($assign_vehicle)? @$assign_vehicle->id:''); ?>">
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

                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="route">
                                            <option data-display="<?php echo app('translator')->get('lang.select_route'); ?> *" value=""><?php echo app('translator')->get('lang.select_route'); ?> *</option>
                                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($assign_vehicle)): ?>
                                                    <option value="<?php echo e(@$routes->id); ?>" <?php echo e(@$assign_vehicle->route_id == @$routes->id? 'selected':''); ?>><?php echo e(@$routes->title); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e(@$routes->id); ?>"><?php echo e(@$routes->title); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('route')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('route')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <label><?php echo app('translator')->get('lang.vehicle'); ?> *</label><br>
                                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($assign_vehicle)): ?>
                                                <div class="">
                                                    <input type="radio" id="vehicle<?php echo e(@$vehicle->id); ?>" class="common-checkbox" name="vehicles[]" value="<?php echo e(@$vehicle->id); ?>" <?php echo e(in_array(@$vehicle->id, @$vehiclesIds)? 'checked': ''); ?>>
                                                    <label for="vehicle<?php echo e(@$vehicle->id); ?>"><?php echo e(@$vehicle->vehicle_no); ?></label>
                                                </div>
                                            <?php else: ?>
                                                <div class="">
                                                    <input type="radio" id="vehicle<?php echo e(@$vehicle->id); ?>" class="common-checkbox" name="vehicles[]" value="<?php echo e(@$vehicle->id); ?>">
                                                    <label for="vehicle<?php echo e(@$vehicle->id); ?>"><?php echo e(@$vehicle->vehicle_no); ?></label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($errors->has('vehicles')): ?>
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('vehicles')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(358)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.assign_vehicle'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="3">
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
                                    <th><?php echo app('translator')->get('lang.route'); ?></th>
                                    <th><?php echo app('translator')->get('lang.vehicle'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $assign_vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign_vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td valign="top"><?php echo e(@$assign_vehicle->route !=""? @$assign_vehicle->route->title:""); ?></td>
                                    <td>
                                        <table>
                                            <?php
                                              @$vehicles = explode(",",@$assign_vehicle->vehicle_id);
                                            ?>
                                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="pt-0 border-0">
                                                    <?php @$vehicle = App\SmVehicle::find(@$vehicle);
                                                   
                                                    ?>
                                                    
                                                    <?php echo e(@$vehicle->vehicle_no); ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </table>
                                    </td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                               <?php if(userPermission(259)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('assign-vehicle-edit',@$assign_vehicle->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                               
                                                <?php if(userPermission(360)): ?>
                                                <a class="dropdown-item deleteAssignVehicle" data-toggle="modal" href="#" data-id="<?php echo e(@$assign_vehicle->id); ?>" data-target="#deleteAssignVehicle"><?php echo app('translator')->get('lang.delete'); ?></a>
                                           <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteAssignVehicle" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.assign_vehicle'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'assign-vehicle-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="assign_vehicle_id" >
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/transport/assign_vehicle.blade.php ENDPATH**/ ?>