
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.export'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.export'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('admin-dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.export'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">
                            <?php echo app('translator')->get('lang.all'); ?> <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.export'); ?>
                        </h3>
                    </div>
                    <div class="white-box">
                        <div class="add-visitor">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <?php if(userPermission(664)): ?>
                                            <a class="primary-btn small bg-success text-white border-0  tr-bg" href="<?php echo e(route('all-student-export-excel')); ?>">
                                                <?php echo app('translator')->get('lang.export_to_csv'); ?>
                                            </a>  
                                        <?php endif; ?>
                                        <?php if(userPermission(665)): ?>
                                            <a class="primary-btn small bg-success text-white border-0  tr-bg" href="<?php echo e(route('all-student-export-pdf')); ?>">
                                                <?php echo app('translator')->get('lang.export_to_pdf'); ?>
                                            </a>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/studentInformation/allStudentExport.blade.php ENDPATH**/ ?>