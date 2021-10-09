
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.approve_leave_request'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid p-0">
            <div class="row justify-content-between">
                <?php $pending = Illuminate\Support\Str::contains(Request::path(), 'pending');  ?>
                <h1>
                    <?php if($pending): ?>
                        <?php echo app('translator')->get('lang.pending_leave_request'); ?>
                    <?php else: ?>
                        <?php echo app('translator')->get('lang.approve_leave_request'); ?>
                    <?php endif; ?>
                </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.leave'); ?></a>
                    <?php $pending = Illuminate\Support\Str::contains(Request::path(), 'pending');  ?>

                    <?php if($pending): ?>
                        <a href="#"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>
                    <?php else: ?>
                        <a href="#"><?php echo app('translator')->get('lang.approve_leave_request'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <?php $pending = Illuminate\Support\Str::contains(Request::path(), 'pending');  ?>

                        <?php if($pending): ?>
                            <h3><?php echo app('translator')->get('lang.pending_leave_request'); ?>
                                <h3>
                                    <?php else: ?>
                                        <h3><?php echo app('translator')->get('lang.approve_leave_request'); ?><h3>
                        <?php endif; ?>
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
                            <th><?php echo app('translator')->get('lang.type'); ?></th>
                            <th><?php echo app('translator')->get('lang.from'); ?></th>
                            <th><?php echo app('translator')->get('lang.to'); ?></th>
                            <th><?php echo app('translator')->get('lang.apply_date'); ?></th>
                            <th><?php echo app('translator')->get('lang.Status'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $__currentLoopData = $apply_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apply_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($apply_leave->role_id == 2): ?>
                                    <td><?php echo e($apply_leave->student != ""? $apply_leave->student->full_name:''); ?></td>
                                <?php else: ?>
                                    <td><?php echo e($apply_leave->staffs != ""? $apply_leave->staffs->full_name:''); ?></td>
                                <?php endif; ?>
                                <td>
                                    <?php if($apply_leave->leaveDefine !="" && $apply_leave->leaveDefine->leaveType !=""): ?>
                                        <?php echo e($apply_leave->leaveDefine->leaveType->type); ?>

                                    <?php endif; ?>
                                </td>
                                <td data-sort="<?php echo e(strtotime($apply_leave->leave_from)); ?>">
                                    <?php echo e($apply_leave->leave_from != ""? dateConvert($apply_leave->leave_from):''); ?>


                                </td>
                                <td data-sort="<?php echo e(strtotime($apply_leave->leave_to)); ?>">
                                    <?php echo e($apply_leave->leave_to != ""? dateConvert($apply_leave->leave_to):''); ?>


                                </td>
                                <td data-sort="<?php echo e(strtotime($apply_leave->apply_date)); ?>">
                                    <?php echo e($apply_leave->apply_date != ""? dateConvert($apply_leave->apply_date):''); ?>


                                </td>
                                <td>

                                    <?php if($apply_leave->approve_status == 'P'): ?>
                                        <button class="primary-btn bg-warning text-white border-0 small tr-bg"><?php echo app('translator')->get('lang.pending'); ?></button><?php endif; ?>

                                    <?php if($apply_leave->approve_status == 'A'): ?>
                                        <button class="primary-btn bg-success text-white border-0 small tr-bg"><?php echo app('translator')->get('lang.approved'); ?></button>
                                    <?php endif; ?>

                                    <?php if($apply_leave->approve_status == 'C'): ?>
                                        <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('lang.cancelled'); ?></button>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->get('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php if(userPermission(191)): ?>

                                                <a data-modal-size="modal-lg" title="View/Edit Leave Details"
                                                   class="dropdown-item modalLink"
                                                   href="<?php echo e(route('view-leave-details-approve', [@$apply_leave->id])); ?>"><?php echo app('translator')->get('lang.view'); ?>
                                                    /<?php echo app('translator')->get('lang.approved'); ?></a>

                                            <?php endif; ?>

                                            <?php if(userPermission(192)): ?>

                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>"
                                                   href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.item'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg"
                                                        data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                <?php echo e(Form::open(['route' => array('apply-leave-delete',$apply_leave->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                <button class="primary-btn fix-gr-bg"
                                                        type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/humanResource/approveLeaveRequest.blade.php ENDPATH**/ ?>