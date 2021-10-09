
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.add_testimonial'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.add_testimonial'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.add_testimonial'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($add_testimonial)): ?>
            <?php if(userPermission(506)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('testimonial_index')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('lang.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($add_testimonial)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.testimonial'); ?>
                            </h3>
                        </div>
                        <?php if(isset($add_testimonial)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_testimonial',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(506)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_testimonial',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income'])); ?>

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
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off"
                                                value="<?php echo e(isset($add_testimonial)? @$add_testimonial->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($add_testimonial)? @$add_testimonial->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>



                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('designation') ? ' is-invalid' : ''); ?>"
                                                   type="text" name="designation" autocomplete="off"
                                                   value="<?php echo e(isset($add_testimonial)? @$add_testimonial->designation: old('designation')); ?>">
                                            <label><?php echo app('translator')->get('lang.designation'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('designation')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('designation')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('institution_name') ? ' is-invalid' : ''); ?>"
                                                   type="text" name="institution_name" autocomplete="off"
                                                   value="<?php echo e(isset($add_testimonial)? @$add_testimonial->institution_name: old('institution_name')); ?>">
                                            <label><?php echo app('translator')->get('lang.institution_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('institution_name')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('institution_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName"
                                                           placeholder="<?php echo e(isset($add_testimonial)? (@$add_testimonial->image !="") ? getFilePath3(@$add_testimonial->image) :trans('lang.image') .' *' :trans('lang.image') .' *'); ?>"
                                                           readonly
                                                    >
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('image')): ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong><?php echo e($errors->first('image')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="document_file_1"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    <input type="file" class="d-none" name="image" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="description"><?php echo e(isset($add_testimonial)? @$add_testimonial->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> *<span></span></label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('description')): ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong><?php echo e($errors->first('description')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $tooltip = "";
                                    if(userPermission(506)){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       
                                            <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.submit'); ?> </button></span>
                                            <?php else: ?>
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <?php if(isset($add_testimonial)): ?>
                                                    <?php echo app('translator')->get('lang.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.add'); ?>
                                                <?php endif; ?>
                                            </button>

                                            <?php endif; ?>
                                        
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.testimonial_list'); ?></h3>
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
                                <th><?php echo app('translator')->get('lang.name'); ?></th>
                                <th><?php echo app('translator')->get('lang.designation'); ?></th>
                                <th><?php echo app('translator')->get('lang.institution_name'); ?></th>
                                <th><?php echo app('translator')->get('lang.image'); ?></th>
                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$value->name); ?></td>
                                    <td><?php echo e(@$value->designation); ?></td>
                                    <td><?php echo e(@$value->institution_name); ?></td>
                                    <td><img src="<?php echo e(asset(@$value->image)); ?>" width="60px" height="50px"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(505)): ?>
                                                <a href="<?php echo e(route('testimonial-details',@$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="Testimonial Details" data-modal-size="modal-lg">
                                                    <?php echo app('translator')->get('lang.view'); ?>
                                                </a>
                                                <?php endif; ?>
                                                <?php if(userPermission(507)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('edit-testimonial',@$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>

                                                <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                            <span  tabindex="0" data-toggle="tooltip" title="Disabled For Demo"> <a href="#" class="dropdown-item small fix-gr-bg  demo_view" style="pointer-events: none;" ><?php echo app('translator')->get('lang.delete'); ?></a></span>
                                                        <?php else: ?>

                                                        <?php if(userPermission(508)): ?>
                                                        <a href="<?php echo e(route('for-delete-testimonial',@$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="Delete Testimonial" data-modal-size="modal-md">
                                                            <?php echo app('translator')->get('lang.delete'); ?>
                                                        </a>
                                                        <?php endif; ?>      
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
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/testimonial/testimonial_page.blade.php ENDPATH**/ ?>