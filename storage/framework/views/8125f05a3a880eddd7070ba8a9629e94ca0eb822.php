
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.room_type'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.room_type'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.dormitory'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.room_type'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($room_type)): ?>
        <?php if(userPermission(372)): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('room-type')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($room_type)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.room_type'); ?>
                            </h3>
                        </div>
                        <?php if(isset($room_type)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('room-type-update',$room_type->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(372)): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'room-type',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>"
                                                type="text" name="type" autocomplete="off" value="<?php echo e(isset($room_type)? $room_type->type:old('type')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($room_type)? $room_type->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.room_type'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('type')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('type')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($room_type)? $room_type->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(372)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($room_type)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>

                                            <?php echo app('translator')->get('lang.room_type'); ?>
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
                            <h3 class="mb-0">  <?php echo app('translator')->get('lang.room_type'); ?>  <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                              
                                <tr>
                                    <th> <?php echo app('translator')->get('lang.room_type'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.description'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$room_type->type); ?></td>
                                    <td><?php echo e(@$room_type->description); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               <?php if(userPermission(373)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('room-type-edit', [$room_type->id])); ?>"> <?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                               <?php if(userPermission(374)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteRoomTypeModal<?php echo e(@$room_type->id); ?>"
                                                    href="#"> <?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRoomTypeModal<?php echo e(@$room_type->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> <?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.room_type'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> <?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> <?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('room-type-delete',$room_type->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/dormitory/room_type.blade.php ENDPATH**/ ?>