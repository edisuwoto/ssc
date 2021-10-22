
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.other_downloads_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.other_downloads_list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.study_material'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.other_downloads_list'); ?></a>
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
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.other_downloads_list'); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                
                        <tr>
                            <th><?php echo app('translator')->get('lang.content_title'); ?></th>
                            <th><?php echo app('translator')->get('lang.type'); ?></th>
                            <th><?php echo app('translator')->get('lang.date'); ?></th>
                            <th><?php echo app('translator')->get('lang.available_for'); ?></th>
                            <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($uploadContents)): ?>
                        <?php $__currentLoopData = $uploadContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e(@$value->content_title); ?></td>
                            <td>
                                <?php if(@$value->content_type == 'as'): ?>
                                    <?php echo e('Assignment'); ?>

                                <?php elseif(@$value->content_type == 'st'): ?>
                                    <?php echo e('Study Material'); ?>

                                <?php elseif(@$value->content_type == 'sy'): ?>
                                    <?php echo e('Syllabus'); ?>

                                <?php else: ?>
                                    <?php echo e('Others Download'); ?>

                                <?php endif; ?>
                            </td>
                            <td data-sort="<?php echo e(strtotime(@$value->upload_date)); ?>" >
                               <?php echo e(@$value->upload_date != ""? dateConvert(@$value->upload_date):''); ?>

                            </td>
                            <td>
                                <?php if(@$value->available_for_admin == 1): ?>
                                    <?php echo app('translator')->get('lang.all_admins'); ?><br>
                                <?php endif; ?>
                                <?php if(@$value->available_for_all_classes == 1): ?>
                                    <?php echo app('translator')->get('lang.all_classes_student'); ?>
                                <?php endif; ?>

                                <?php if(@$value->classes != "" && $value->sections != ""): ?>
                                    <?php echo app('translator')->get('lang.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'.@$value->sections->section_name); ?>)
                                <?php endif; ?>
                                <?php if(@$value->classes != "" && $value->section ==null): ?>
                                <?php echo app('translator')->get('lang.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'); ?> <?php echo app('translator')->get('lang.all_sections'); ?>)
                            <?php endif; ?>
                            </td>
                            <td>

                            <?php if(@$value->class != ""): ?>
                                <?php echo e(@$value->classes->class_name); ?>

                            <?php endif; ?> 

                            <?php if(@$value->section != ""): ?>
                                (<?php echo e(@$value->sections->section_name); ?>)
                            <?php endif; ?>
                            <?php if(@$value->section ==null): ?>
                            ( <?php echo app('translator')->get('lang.all_sections'); ?>)
                        <?php endif; ?>


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                     <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="<?php echo e(route('upload-content-view', $value->id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                        <?php if(userPermission(588)): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('upload-content-edit',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                        <?php endif; ?>

                                     <?php if(userPermission(107)): ?>

                                    

                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e(@$value->id); ?>"
                                            href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>

                                            <?php if(userPermission(106)): ?>

                                           

                                        <?php if(@$value->upload_file != ""): ?>
                                         <a class="dropdown-item" href="<?php echo e(url(@$value->upload_file)); ?>" download>
                                             <?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e(@$value->id); ?>" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.other_download'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                <a href="<?php echo e(route('delete-upload-content', [@$value->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/teacher/otherDownloadList.blade.php ENDPATH**/ ?>