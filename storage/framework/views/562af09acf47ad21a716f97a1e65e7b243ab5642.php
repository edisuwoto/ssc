

<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="10%"><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th width="20%"><?php echo app('translator')->get('lang.email'); ?></th>
                                        <th width="10%"><?php echo app('translator')->get('lang.subject'); ?></th>
                                        <th width="10%"><?php echo app('translator')->get('lang.message'); ?></th>
                                        <th width="10%"><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $contact_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact_message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td width="10%"><?php echo e($contact_message->name); ?></td>
                                        <td width="20%"><?php echo e($contact_message->email); ?></td>
                                        <td width="10%"><?php echo e($contact_message->subject); ?></td>
                                        <td width="10%"><?php echo e($contact_message->message); ?></td>
                                        <td width="10%">
                                            <?php if(userPermission(519)): ?>
                                                <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal"
                                                data-target="#deleteDocumentModal<?php echo e($contact_message->id); ?>" href="#">
                                                 <span class="ti-trash"></span>
                                                </a>
                                             <?php endif; ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteDocumentModal<?php echo e($contact_message->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.message'); ?></h4>
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
                                                                data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?>
                                                        </button>
                                                        <a class="primary-btn fix-gr-bg"
                                                           href="<?php echo e(route('delete-message', [$contact_message->id])); ?>">
                                                            <?php echo app('translator')->get('lang.delete'); ?>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/frontEnd/contact_message.blade.php ENDPATH**/ ?>