<?php if(userPermission(920) && menuStatus(920)): ?>
<li data-position="<?php echo e(menuPosition(920)); ?>" class="sortable_li">
    <a href="#subMenuBulkPrint" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        <?php echo app('translator')->get('lang.bulk_print'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuBulkPrint">
        <?php if(userPermission(921)  && menuStatus(921)): ?>
            <li data-position="<?php echo e(menuPosition(921)); ?>">
                <a href="<?php echo e(route('student-id-card-bulk-print')); ?>"><?php echo app('translator')->get('lang.id_card'); ?></a>
            </li>
       <?php endif; ?>
        <?php if(userPermission(922)  && menuStatus(922)): ?>
            <li data-position="<?php echo e(menuPosition(922)); ?>">
                <a href="<?php echo e(route('certificate-bulk-print')); ?>">  <?php echo app('translator')->get('lang.student'); ?>  <?php echo app('translator')->get('lang.certificate'); ?></a>
            </li>
          <?php endif; ?>
 

     <?php if(userPermission(924)  && menuStatus(924)): ?>
        <li data-position="<?php echo e(menuPosition(924)); ?>">
            <a href="<?php echo e(route('payroll-bulk-print')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?> <?php echo app('translator')->get('lang.bulk_print'); ?></a>
        </li>
    <?php endif; ?>

      <?php if(userPermission(926)  && menuStatus(926)): ?>
        <li data-position="<?php echo e(menuPosition(926)); ?>">
            <a href="<?php echo e(route('fees-bulk-print')); ?>"> <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.bulk'); ?>   <?php echo app('translator')->get('lang.print'); ?></a>
        </li>
    <?php endif; ?>
    
     <?php if(userPermission(925)  && menuStatus(925)): ?>
        <li data-position="<?php echo e(menuPosition(925)); ?>">
            <a href="<?php echo e(route('invoice-settings')); ?>"> <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.invoice'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
        </li>
      <?php endif; ?>
       
    </ul>
</li>
<?php endif; ?>
<?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/BulkPrint/Resources/views/menu/bulk_print_sidebar.blade.php ENDPATH**/ ?>