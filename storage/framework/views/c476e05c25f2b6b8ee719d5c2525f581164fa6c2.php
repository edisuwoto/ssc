
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.dormitory_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.dormitory_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.dormitory'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.dormitory_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($dormitory_list)): ?>
         <?php if(userPermission(368)): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('dormitory-list')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($dormitory_list)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.dormitory'); ?>
                            </h3>
                        </div>
                        <?php if(isset($dormitory_list)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('dormitory-list-update',$dormitory_list->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(368)): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'dormitory-list',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('dormitory_name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="dormitory_name" autocomplete="off" value="<?php echo e(isset($dormitory_list)? $dormitory_list->dormitory_name:old('dormitory_name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($dormitory_list)? $dormitory_list->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('dormitory_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('dormitory_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>" name="type">
                                            <option data-display="<?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.type'); ?> *</option>
                                            <?php if(isset($dormitory_list)): ?>
                                            <option value="B" <?php echo e(@$dormitory_list->type == "B"? 'selected': ''); ?>><?php echo app('translator')->get('lang.boys'); ?></option>
                                            <option value="G" <?php echo e(@$dormitory_list->type == "G"? 'selected': ''); ?>><?php echo app('translator')->get('lang.girls'); ?></option>
                                            <?php else: ?> 
                                            <option value="B"><?php echo app('translator')->get('lang.boys'); ?></option>
                                            <option value="G"}}><?php echo app('translator')->get('lang.girls'); ?></option>
                                            <?php endif; ?>

                                        </select>

                                        <?php if($errors->has('type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" name="address" value="<?php echo e(isset($dormitory_list)? $dormitory_list->address:old('address')); ?>">
                                            <label><?php echo app('translator')->get('lang.address'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('intake') ? ' is-invalid' : ''); ?>" type="text" name="intake" 
                                            value="<?php echo e(isset($dormitory_list)? $dormitory_list->intake: old('intake')); ?>">
                                            <label><?php echo app('translator')->get('lang.intake'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('intake')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('intake')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($dormitory_list)? $dormitory_list->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(368)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($dormitory_list)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.dormitory'); ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="6">
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
                                    <th><?php echo app('translator')->get('lang.dormitory'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.address'); ?></th>
                                    <th><?php echo app('translator')->get('lang.intake'); ?> </th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $dormitory_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dormitory_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$dormitory_list->dormitory_name); ?></td>
                                    <td><?php echo e(@$dormitory_list->type =='B'? 'Boys': 'Girls'); ?></td>
                                    <td><?php echo e(@$dormitory_list->address); ?></td>
                                    <td><?php echo e(@$dormitory_list->intake); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               <?php if(userPermission(369)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('dormitory-list-edit', [$dormitory_list->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                               <?php if(userPermission(370)): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteDormitoryListModal<?php echo e(@$dormitory_list->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteDormitoryListModal<?php echo e(@$dormitory_list->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.dormitory'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('dormitory-list-delete',$dormitory_list->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/dormitory/dormitory_list.blade.php ENDPATH**/ ?>