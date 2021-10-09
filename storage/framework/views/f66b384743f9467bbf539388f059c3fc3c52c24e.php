
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.visitor_book'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.visitor_book'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.admin_section'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.visitor_book'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($visitor)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('visitor')); ?>" class="primary-btn small fix-gr-bg">
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
                                    <h3 class="mb-30">
                                        <?php if(isset($visitor)): ?>
                                            <?php echo app('translator')->get('lang.edit'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('lang.add'); ?>
                                        <?php endif; ?>
                                        <?php echo app('translator')->get('lang.visitor'); ?>
                                    </h3>
                                </div>
                                <?php if(isset($visitor)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_update',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php else: ?>
                                  <?php if(userPermission(17)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                                <?php endif; ?>
                                <div class="white-box">
                                    <div class="add-visitor">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control<?php echo e($errors->has('purpose') ? ' is-invalid' : ''); ?>"
                                                            type="text" name="purpose" autocomplete="off"
                                                            value="<?php echo e(isset($visitor)? $visitor->purpose: old('purpose')); ?>">

                                                    <input type="hidden" name="id"
                                                           value="<?php echo e(isset($visitor)? $visitor->id: ''); ?>">
                                                    <label><?php echo app('translator')->get('lang.purpose'); ?><span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('purpose')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('purpose')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                            type="text" name="name" autocomplete="off"
                                                            value="<?php echo e(isset($visitor)? $visitor->name: old('name')); ?>">
                                                    <label><?php echo app('translator')->get('lang.name'); ?><span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                                            type="tel" name="phone"
                                                            value="<?php echo e(isset($visitor)? $visitor->phone: old('phone')); ?>">
                                                    <label><?php echo app('translator')->get('lang.phone'); ?></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control<?php echo e($errors->has('visitor_id') ? ' is-invalid' : ''); ?>" type="text" name="visitor_id"
                                                           value="<?php echo e(isset($visitor)? $visitor->visitor_id: old('visitor_id')); ?>">
                                                    <label><?php echo app('translator')->get('lang.id'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('visitor_id')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('visitor_id')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input  form-control<?php echo e($errors->has('no_of_person') ? ' is-invalid' : ''); ?>" type="text" onkeypress="return isNumberKey(event)" name="no_of_person"
                                                           value="<?php echo e(isset($visitor)? $visitor->no_of_person: old('no_of_person')); ?>">
                                                    <label><?php echo app('translator')->get('lang.no_of_person'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('no_of_person')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('no_of_person')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date <?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                           name="date"
                                                           value="<?php echo e(isset($visitor)? date('m/d/Y', strtotime($visitor->date)): date('m/d/Y')); ?>">
                                                    <label><?php echo app('translator')->get('lang.date'); ?></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('date')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('date')); ?></strong>
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
                                                    <input class="primary-input time form-control<?php echo e($errors->has('in_time') ? ' is-invalid' : ''); ?>"
                                                           type="text" name="in_time"
                                                           value="<?php echo e(isset($visitor)? $visitor->in_time: old('in_time')); ?>">
                                                    <label><?php echo app('translator')->get('lang.in_time'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('in_time')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('in_time')); ?></strong>
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
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time  form-control<?php echo e($errors->has('out_time') ? ' is-invalid' : ''); ?>"
                                                           type="text" name="out_time"
                                                           value="<?php echo e(isset($visitor)? $visitor->out_time: old('out_time')); ?>">
                                                    <label><?php echo app('translator')->get('lang.out_time'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('out_time')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('out_time')); ?></strong>
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

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" id="placeholderInput" type="text"
                                                           placeholder="<?php echo e(isset($visitor)? ($visitor->file != ""? getFilePath3($visitor->file):trans('lang.file')):trans('lang.file')); ?>"
                                                           readonly>
                                                    <span class="focus-border"></span>

                                                    <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                                
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="browseFile"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    <input type="file" class="d-none" id="browseFile" name="file">
                                                </button>
                                            </div>
                                        </div>
	                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(17) ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                               <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                    <span class="ti-check"></span>
                                                    <?php if(isset($visitor)): ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.visitor_list'); ?></h3>
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
                                                    <?php echo app('translator')->get('lang.deleted_message'); ?>
                                                </div>
                                            <?php elseif(session()->has('message-danger-delete')): ?>
                                                <div class="alert alert-danger">
                                                    <?php echo app('translator')->get('lang.error_message'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.no_of_person'); ?></th>
                                    <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                    <th><?php echo app('translator')->get('lang.purpose'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.in_time'); ?></th>
                                    <th><?php echo app('translator')->get('lang.out_time'); ?></th>
                                    <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $count=1; ?>
                                <?php $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visitor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($count++); ?></td>
                                        <td><?php echo e(@$visitor->name); ?></td>
                                        <td><?php echo e(@$visitor->no_of_person); ?></td>
                                        <td><?php echo e(@$visitor->phone); ?></td>
                                        <td><?php echo e(@$visitor->purpose); ?></td>
                                        <td  data-sort="<?php echo e(strtotime(@$visitor->date)); ?>" ><?php echo e(!empty($visitor->date)? dateConvert(@$visitor->date):''); ?></td>
                                        <td><?php echo e(@$visitor->in_time); ?></td>
                                        <td><?php echo e(@$visitor->out_time); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(18)): ?>

                                                        <a class="dropdown-item"
                                                           href="<?php echo e(route('visitor_edit', [@$visitor->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(userPermission(19)): ?>

                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteVisitorModal<?php echo e(@$visitor->id); ?>"
                                                           href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                        <?php if(@$visitor->file != ""): ?>
                                                            <?php if(userPermission(20)): ?>
                                                                <?php if(@file_exists($visitor->file)): ?>
                                                                        <a class="dropdown-item"
                                                                        href="<?php echo e(url($visitor->file)); ?>" download>
                                                                            <?php echo app('translator')->get('lang.download'); ?> <span
                                                                                    class="pl ti-download"></span>
                                                                        </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteVisitorModal<?php echo e(@$visitor->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.visitor'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?>
                                                        </button>

                                                        <a href="<?php echo e(route('visitor_delete', [@$visitor->id])); ?>"
                                                           class="primary-btn fix-gr-bg"><?php echo app('translator')->get('lang.delete'); ?></a>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/admin/visitor.blade.php ENDPATH**/ ?>