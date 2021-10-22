<?php if(userPermission(542) && menuStatus(542) ): ?>
    <li data-position="<?php echo e(menuPosition(21)); ?>" class="sortable_li">
        <a href="#subMenuStudentRegistration" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-reading"></span>
            <?php echo app('translator')->get('lang.registration'); ?>
        </a>
        <ul class="collapse list-unstyled" id="subMenuStudentRegistration">
            <?php if(userPermission(543) && menuStatus(543)): ?>
                <li data-position="<?php echo e(menuPosition(543)); ?>">
                    <a href="<?php echo e(url('parentregistration/student-list')); ?>"> <?php echo app('translator')->get('lang.student_list'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(moduleStatusCheck('Saas') == FALSE): ?>
                <?php if(userPermission(547) && menuStatus(547)): ?>
                    <li data-position="<?php echo e(menuPosition(547)); ?>">
                        <a href="<?php echo e(url('parentregistration/settings')); ?>"> <?php echo app('translator')->get('lang.settings'); ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/ParentRegistration/Resources/views/menu/ParentRegistration.blade.php ENDPATH**/ ?>