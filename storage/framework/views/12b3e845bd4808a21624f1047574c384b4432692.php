<?php if(userPermission(399) && menuStatus(399) ): ?>
                        <li  data-position="<?php echo e(menuPosition(399)); ?>">
                            <a href="<?php echo e(route('manage-adons')); ?>"><?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manager'); ?></a>
                        </li>
                    <?php endif; ?>

                        <?php if(userPermission(401) && menuStatus(401) ): ?>
                                <li  data-position="<?php echo e(menuPosition(401)); ?>">
                                    <a href="<?php echo e(route('manage-currency')); ?>"><?php echo app('translator')->get('lang.manage'); ?> <?php echo app('translator')->get('lang.currency'); ?></a>
                                </li>
                        <?php endif; ?>

                       <!-- <?php if(userPermission(410) && menuStatus(410) ): ?>

                            <li  data-position="<?php echo e(menuPosition(410)); ?>">
                                <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->


                       <?php if(userPermission(428) && menuStatus(428) ): ?>

                                <li  data-position="<?php echo e(menuPosition(428)); ?>">
                                    <a href="<?php echo e(route('base_setup')); ?>"><?php echo app('translator')->get('lang.base_setup'); ?></a>
                                </li>
                         <?php endif; ?>

                         <?php if(userPermission(549) && menuStatus(549) ): ?>

                            <li  data-position="<?php echo e(menuPosition(549)); ?>">
                                <a href="<?php echo e(route('language-list')); ?>"><?php echo app('translator')->get('lang.language'); ?></a>
                            </li>
                        <?php endif; ?>

                        <!-- <?php if(userPermission(451) && menuStatus(451) ): ?>

                            <li  data-position="<?php echo e(menuPosition(451)); ?>">
                                <a href="<?php echo e(route('language-settings')); ?>"><?php echo app('translator')->get('lang.language_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->
                        <?php if(userPermission(456) && menuStatus(465) ): ?>

                            <li  data-position="<?php echo e(menuPosition(465)); ?>">
                                <a href="<?php echo e(route('backup-settings')); ?>"><?php echo app('translator')->get('lang.backup_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        
                       <!-- <?php if(userPermission(444) && menuStatus(444) ): ?>

                            <li  data-position="<?php echo e(menuPosition(444)); ?>">
                                <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
                            </li>
                        <?php endif; ?> -->
                       
                        <?php if(userPermission(463) && menuStatus(463) ): ?>
                            <li  data-position="<?php echo e(menuPosition(463)); ?>">
                                <a href="<?php echo e(route('button-disable-enable')); ?>"><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.option'); ?> </a>
                            </li>
                        <?php endif; ?>


     

                        <?php if(userPermission(478) && menuStatus(478) ): ?>

                            <li  data-position="<?php echo e(menuPosition(478)); ?>">
                                <a href="<?php echo e(route('update-system')); ?>"> <?php echo app('translator')->get('lang.about'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.update'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(userPermission(4000) && menuStatus(4000)): ?>

                                    <li data-position="<?php echo e(menuPosition(4000)); ?>">
                                        <a href="<?php echo e(route('utility')); ?>"><?php echo app('translator')->get('lang.utilities'); ?></a>
                                    </li>
                                <?php endif; ?>

                        <?php if(userPermission(482) && menuStatus(482) ): ?>
                        <li  data-position="<?php echo e(menuPosition(482)); ?>">
                            <a href="<?php echo e(route('api/permission')); ?>"><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.permission'); ?> </a>
                        </li>
                    <?php endif; ?>
<?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/partials/without_saas_school_admin_menu.blade.php ENDPATH**/ ?>