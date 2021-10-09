<?php $__env->startSection('content'); ?>

<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase" style="color: whitesmoke"><?php echo e(__('school::install.welcome_title')); ?>

        </h2>

    </div>
</div>

<div class="card-body">
    <p style="text-align: center">
        <?php echo __('school::install.welcome_description'); ?>

    </p>

    <a href="<?php echo e(route('service.preRequisite')); ?>" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 mb-20">
        <?php echo e(__('service::install.get_started')); ?> </a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('service::layouts.app_install', ['title' => __('school::install.welcome')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/vendor/spondonit/school-service/src/../resources/views/install/welcome.blade.php ENDPATH**/ ?>