
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.designation'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.designation'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.designation'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor up_st_admin_visitor pl_22">
    <div class="container-fluid p-0">
        <?php if(isset($designation)): ?>
         <?php if(userPermission(181)): ?>
                      
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('designation')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($designation)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.designation'); ?>
                            </h3>
                        </div>
                        <?php if(isset($designation)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('designation-update',$designation->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                          <?php if(userPermission(181) ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'designation',
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
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="title" autocomplete="off" value="<?php echo e(isset($designation)? $designation->title:Request::old('title')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($designation)? $designation->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.designation'); ?> <?php echo app('translator')->get('lang.title'); ?> <span>*</span></label>

                                            <span class="focus-border"></span>
                                            <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(181)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php echo e(isset($designation)? 'update':'save'); ?> <?php echo app('translator')->get('lang.designation'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.designation'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <td colspan="2">
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
                                    <th><?php echo app('translator')->get('lang.designation'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($designation->title); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               <?php if(userPermission(182)): ?>

                                               <a class="dropdown-item" href="<?php echo e(route('designation-edit', [$designation->id
                                                    ])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                               <?php endif; ?>
                                               <?php if(userPermission(183)): ?>

                                               <a class="dropdown-item" data-toggle="modal" data-target="#deleteDesignationModal<?php echo e($designation->id); ?>"
                                                    href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteDesignationModal<?php echo e($designation->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.designation'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('designation-delete',$designation->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/humanResource/designation.blade.php ENDPATH**/ ?>