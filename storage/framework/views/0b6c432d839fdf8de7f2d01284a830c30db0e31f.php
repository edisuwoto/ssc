<?php if(userPermission(900) && menuStatus(900)): ?>
<li  data-position="<?php echo e(menuPosition(900)); ?>" class="sortable_li">
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        <?php echo app('translator')->get('lang.chat'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        <?php if(userPermission(901) && menuStatus(901)): ?>
        <li  data-position="<?php echo e(menuPosition(901)); ?>" >
            <a href="<?php echo e(route('chat.index')); ?>"><?php echo app('translator')->get('lang.chat'); ?> <?php echo app('translator')->get('lang.box'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(903) && menuStatus(903)): ?>
        <li data-position="<?php echo e(menuPosition(903)); ?>" >
            <a href="<?php echo e(route('chat.invitation')); ?>"><?php echo app('translator')->get('lang.invitation'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(904) && menuStatus(904)): ?>
            <li data-position="<?php echo e(menuPosition(904)); ?>" >
                <a href="<?php echo e(route('chat.blocked.users')); ?>"><?php echo app('translator')->get('lang.blocked'); ?> <?php echo app('translator')->get('lang.user'); ?></a>
            </li>
        <?php endif; ?>

        <?php if(userPermission(905) && menuStatus(905)): ?>
            <li data-position="<?php echo e(menuPosition(905)); ?>" >
                <a href="<?php echo e(route('chat.settings')); ?>"><?php echo app('translator')->get('lang.settings'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/Chat/Resources/views/menu.blade.php ENDPATH**/ ?>