
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.dormitory_rooms'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = app('school_info');
 if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } 
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.dormitory_rooms'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.dormitory'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.dormitory_rooms'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($room_list)): ?>
        <?php if(userPermission(364)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('room-list')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($room_list)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.dormitory_rooms'); ?>
                            </h3>
                        </div>
                        <?php if(isset($room_list)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('room-list-update',$room_list->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(364)): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'room-list',
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
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('dormitory') ? ' is-invalid' : ''); ?>" name="dormitory">
                                            <option data-display="<?php echo app('translator')->get('lang.dormitory'); ?> *" value=""><?php echo app('translator')->get('lang.dormitory'); ?> *</option>
                                            <?php $__currentLoopData = $dormitory_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dormitory_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($room_list)): ?>
                                                <option value="<?php echo e(@$dormitory_list->id); ?>" <?php echo e(@$dormitory_list->id == @$room_list->dormitory_id? 'selected': ''); ?>><?php echo e(@$dormitory_list->dormitory_name); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e(@$dormitory_list->id); ?>" <?php echo e(old('dormitory') == @$dormitory_list->id? 'selected':''); ?>><?php echo e(@$dormitory_list->dormitory_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('dormitory')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('dormitory')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($room_list)? $room_list->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($room_list)? $room_list->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.room_number'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('room_type') ? ' is-invalid' : ''); ?>" name="room_type">
                                            <option data-display="<?php echo app('translator')->get('lang.room_type'); ?> *" value=""><?php echo app('translator')->get('lang.room_type'); ?> *</option>
                                            <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <?php if(isset($room_list)): ?>
                                                <option value="<?php echo e(@$room_type->id); ?>" <?php echo e(@$room_type->id == @$room_list->room_type_id? 'selected': ''); ?>><?php echo e(@$room_type->type); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e(@$room_type->id); ?>" <?php echo e(old('room_type') == @$room_type->id? 'selected':''); ?>><?php echo e(@$room_type->type); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('room_type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('room_type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('number_of_bed') ? ' is-invalid' : ''); ?>" type="text" name="number_of_bed" value="<?php echo e(isset($room_list)? $room_list->number_of_bed: old('number_of_bed')); ?>">
                                            <label><?php echo app('translator')->get('lang.number_of_bed'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('number_of_bed')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('number_of_bed')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('cost_per_bed') ? ' is-invalid' : ''); ?>" type="text" step="0.1" name="cost_per_bed" value="<?php echo e(isset($room_list)? $room_list->cost_per_bed: old('cost_per_bed')); ?>">
                                            <label><?php echo app('translator')->get('lang.cost_per_bed'); ?><span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('cost_per_bed')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('cost_per_bed')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($room_list)? $room_list->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(364)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($room_list)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.room'); ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.room'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.dormitory'); ?></th>
                                    <th><?php echo app('translator')->get('lang.room'); ?> <?php echo app('translator')->get('lang.number'); ?></th>
                                    <th><?php echo app('translator')->get('lang.room_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.no_of_bed'); ?></th>
                                    <th><?php echo app('translator')->get('lang.cost_per_bed'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $room_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(isset($room_list->dormitory->dormitory_name)? $room_list->dormitory->dormitory_name:''); ?></td>
                                    <td><?php echo e(@$room_list->name); ?></td>
                                    <td><?php echo e(isset($room_list->roomType->type)? $room_list->roomType->type: ''); ?></td>
                                    <td><?php echo e(@$room_list->number_of_bed); ?></td>
                                    <td><?php echo e(@$room_list->cost_per_bed); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(365)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('room-list-edit', [$room_list->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(366)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteRoomTypeModal<?php echo e($room_list->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRoomTypeModal<?php echo e(@$room_list->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.room'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('room-list-delete',$room_list->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/dormitory/room_list.blade.php ENDPATH**/ ?>