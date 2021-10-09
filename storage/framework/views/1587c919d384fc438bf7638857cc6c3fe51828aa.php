

<?php $__env->startSection('content'); ?>
<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase color-whitesmoke" ><?php echo e(__('service::install.environment_title')); ?>

        </h2>

    </div>
</div>

<div class="card-body">
    <div class="requirements">
        <div class="row">
            <div class="col-md-12">
                <h4>Serviver Requirements </h4>
                <hr class="mt-0">
            </div>
            <?php $__currentLoopData = $server_checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
                if(gv($server, 'type') == 'error' and !$has_false){
                    $has_false = true;
                }
            ?>
            <div class="col-md-6">
                <p
                    class="alert alert-font alert-<?php echo e(gv($server, 'type') == 'error' ? 'danger' : 'success'); ?>">
                    <i class="ti-<?php echo e(gv($server, 'type') == 'error' ? 'na' : 'check-box'); ?> mr-1"></i>
                    <?php echo e(gv($server, 'message')); ?>

                </p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <h4>Folder Requirements </h4>
                <hr class="mt-0">
            </div>
            <?php $__currentLoopData = $folder_checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                if(gv($folder, 'type') == 'error' and !$has_false){
                    $has_false = true;
                }
            ?>
            <div class="col-md-6">
                <p
                    class="alert-font alert alert-<?php echo e(gv($folder, 'type') == 'error' ? 'danger' : 'success'); ?>">
                    <i class="ti-<?php echo e(gv($folder, 'type') == 'error' ? 'na' : 'check-box'); ?> mr-1"></i>
                    <?php echo e(gv($folder, 'message')); ?>

                </p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php if($has_false): ?>
    <p class="text-center alert alert-danger mt-40">
        Please solve the requirements issue.
    </p>
    <a href="<?php echo e(route('service.preRequisite')); ?>" class="offset-3 col-sm-6 primary-btn fix-gr-bg mb-20 ">
        <?php echo e(__('service::install.refresh')); ?> </a>
    <?php else: ?>
    <p class="text-center alert alert-success mt-40">
        All The Requirements look's Fine. Let's Dig in
    </p>
    <a href="<?php echo e(route('service.license')); ?>" class="offset-3 col-sm-6 primary-btn fix-gr-bg  mb-20">
        <?php echo e(__('service::install.lets_go_next')); ?> </a>

    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('service::layouts.app_install', ['title' => __('service::install.environment')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources//views/vendors/service/install/preRequisite.blade.php ENDPATH**/ ?>