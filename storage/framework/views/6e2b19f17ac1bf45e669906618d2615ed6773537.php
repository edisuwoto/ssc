

<?php $__env->startSection('content'); ?>

<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase color-whitesmoke" ><?php echo e(__('service::install.welcome_title')); ?>

        </h2>

    </div>
</div>

<div class="card-body">
    <p class="text-center">
        <?php echo e(__('service::install.confirm_description')); ?>

    </p>
    <p class="text-center">
        Your Super Admin email : <b> <?php echo e($user); ?> </b> <br>
        Your Super Admin password : <b> <?php echo e($pass); ?> </b>
    </p>

    <a href="<?php echo e(url('/')); ?>" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 mb-20">
        <?php echo e(__('service::install.goto_home')); ?> </a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('service::layouts.app', ['title' => __('service::install.welcome')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources//views/vendors/service/install/done.blade.php ENDPATH**/ ?>