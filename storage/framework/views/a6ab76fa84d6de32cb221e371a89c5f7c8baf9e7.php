
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.pages'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.pages'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.front_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.pages'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <?php if(userPermission(656)): ?>
                    <a href="<?php echo e(route('create-page')); ?>" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('lang.add'); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-5">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.pages'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.sub_title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($page->title); ?></td>
                                    <td><?php echo e(@$page->sub_title); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                
                                                    <a class="dropdown-item" href="<?php echo e(route('view-page', ['slug'=>@$page->slug])); ?>"><?php echo app('translator')->get('lang.preview'); ?></a>
                                                

                                                <?php if(userPermission(657)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('edit-page', [@$page->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>

                                                <?php if(userPermission(658)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deletePages<?php echo e(@$page->id); ?>" href="#">
                                                        <?php echo app('translator')->get('lang.delete'); ?>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if(@$page->header_image): ?>
                                                    <?php if(userPermission(659)): ?>
                                                        <a class="dropdown-item" href="<?php echo e(url(@$page->header_image)); ?>" download>
                                                            <?php echo app('translator')->get('lang.download'); ?>  
                                                            <span class="pl ti-download"></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deletePages<?php echo e(@$page->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    <?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.pages'); ?>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => array('delete-page',@$page->id), 'method' => 'post',])); ?>

                                                        <button class="primary-btn fix-gr-bg" type="submit">
                                                            <?php echo app('translator')->get('lang.delete'); ?>
                                                        </button>
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
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/frontEnd/pageList.blade.php ENDPATH**/ ?>