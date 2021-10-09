
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.examination'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('lang.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('lang.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.format'); ?>
                                </h3>
                            </div>
                    <?php if(isset($editData)): ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => 'true', 'route' => 'update-exam-content', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <input type="hidden" name="id" value="<?php echo e($editData->id); ?>">
                    <?php else: ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => 'true', 'route' => 'save-exam-content', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mb-25">
                                        <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="col-lg-12 mb-30">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('exam_type') ? ' is-invalid' : ''); ?>" name="exam_type">
                                                <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.exam'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.exam'); ?>  *</option>
                                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!in_array($exam->id, $already_assigned)): ?>
                                                <?php if(isset($editData)): ?>
                                                <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($editData)? ($editData->exam_type == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->title); ?></option>
                                                <?php endif; ?>
                                                    
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('exam_type')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('exam_type')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="title" autocomplete="off"
                                                    value="<?php echo e(isset($editData)? @$editData->title:old('title')); ?>">
                                                <label> <?php echo app('translator')->get('lang.controller'); ?> <?php echo app('translator')->get('lang.title'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-10">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control <?php echo e($errors->has('file') ? ' is-invalid' : ''); ?>"
                                                    readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):trans('lang.signature')); ?>"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('file')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('file')); ?></strong>
                                                    </span>
                                                    </br>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none form-control" name="file" id="upload_content_file">
                                            </button>
                                        </div>
                                    </div>
                                    <code class="nowrap d-block mb-30">(Allow file jpg, png, jpeg, svg)</code>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('publish_date') ? ' is-invalid' : ''); ?>" id="upload_date" type="text"
                                                    name="publish_date"
                                                    value="<?php echo e(isset($editData)? date('m/d/Y', strtotime(@$editData->publish_date)): date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.publication_date'); ?>* <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('publish_date')): ?>
                                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($errors->first('publish_date')); ?></strong></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="apply_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <h4><?php echo app('translator')->get('lang.attendance'); ?></h4>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('start_date') ? ' is-invalid' : ''); ?>" id="start_date" type="text"
                                                    name="start_date"
                                                    value="<?php echo e(isset($editData)? date('m/d/Y', strtotime(@$editData->start_date)): date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->get('lang.start_date'); ?>* <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('start_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('start_date')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start_date"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('end_date') ? ' is-invalid' : ''); ?>" id="end_date" type="text"
                                                    name="end_date"
                                                    value="<?php echo e(isset($editData)? date('m/d/Y', strtotime(@$editData->end_date)): date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->get('lang.end'); ?> <?php echo app('translator')->get('lang.date'); ?>* <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('end_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('end_date')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="end_date"></i>
                                            </button>
                                        </div>
                                    </div>
                                        <?php 
                                            $tooltip = "";
                                            if(userPermission(708) ){
                                                    @$tooltip = "";
                                                }else{
                                                    @$tooltip = "You have no permission to add";
                                                }
                                        ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" type="submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($editData)): ?>
                                                    <?php echo app('translator')->get('lang.update'); ?> 
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('lang.save'); ?>
                                                <?php endif; ?>
                                                    <?php echo app('translator')->get('lang.content'); ?>
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
                                <h3 class="mb-0"> <?php echo app('translator')->get('lang.exam'); ?>  <?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                                    <th> <?php echo app('translator')->get('lang.exam'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.title'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.signature'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.publish'); ?> <?php echo app('translator')->get('lang.date'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.start_date'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.end'); ?> <?php echo app('translator')->get('lang.date'); ?></th>
                                    <th> <?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $content_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="nowrap"><?php echo e(@$content_info->examName->title); ?></td>
                                        <td class="nowrap"><?php echo e($content_info->title); ?></td>
                                        <td>
                                            <?php if($content_info->file): ?>
                                                <img src="<?php echo e(asset($content_info->file)); ?>" width="100px">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(dateConvert($content_info->publish_date)); ?></td>
                                        <td><?php echo e(dateConvert($content_info->start_date)); ?></td>
                                        <td><?php echo e(dateConvert($content_info->end_date)); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(708)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('edit-exam-settings',$content_info->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(709)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e($content_info->id); ?>" href="#">
                                                        <?php echo app('translator')->get('lang.delete'); ?>
                                                    </a>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e($content_info->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.upload_content'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                            <a href="<?php echo e(route('delete-content',$content_info->id)); ?>"
                                                               class="text-light">
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                            </a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/examination/exam_settings.blade.php ENDPATH**/ ?>