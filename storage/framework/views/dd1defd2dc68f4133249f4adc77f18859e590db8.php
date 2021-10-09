

<?php $__env->startSection('content'); ?>
<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase color-whitesmoke" ><?php echo e(__('service::install.license_verification')); ?>

        </h2>

    </div>
</div>

<div class="card-body">
    <div class="requirements">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?php echo e(route('service.license')); ?>" id="content_form">
                    <div class="form-group">
                        <label class="required" for="access_code"><?php echo e(__('service::install.access_code')); ?></label>
                        <input type="text" class="form-control " name="access_code" id="access_code"  required="required" autofocus=""  placeholder="<?php echo e(__('service::install.access_code')); ?>" >
                    </div>
                    <div class="form-group">
                        <label class="required" for="envato_email"><?php echo e(__('service::install.envato_email')); ?></label>
                        <input type="email" class="form-control" name="envato_email" id="envato_email" required="required" placeholder="<?php echo e(__('service::install.envato_email')); ?>" >
                    </div>

                    <div class="form-group">
                        <label class="required" for="installed_domain"><?php echo e(__('service::install.installed_domain')); ?></label>
                        <input type="text" class="form-control" name="installed_domain" id="installed_domain" required="required" readonly value="<?php echo e(app_url()); ?>" >
                    </div>
                    <?php if($reinstall): ?>
                   <div class="form-group">
                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12 ">
                            <input name="re_install" type="checkbox">
                            <span class="checkmark"></span>
                            <span class="ml-2">Re install System</span>
                        </label>
                    </div>
                    <?php endif; ?>

                   <button type="submit" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 submit bc-color" ><?php echo e(__('service::install.lets_go_next')); ?></button>
                   <button type="button" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 submitting bc-color" disabled style="display:none"><?php echo e(__('service::install.submitting')); ?></button>
                </form>
            </div>



        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        _formValidation('content_form');
         $(document).ready(function(){
            setTimeout(function(){
                $('.preloader h2').text('We are validating your license. Please do not refresh or close the browser')
            }, 2000);
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('service::layouts.app_install', ['title' => __('service::install.license')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources//views/vendors/service/install/license.blade.php ENDPATH**/ ?>