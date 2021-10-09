<?php if(isset($custom_field_values)): ?>
    <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?></h4>
    <?php $__currentLoopData = $custom_field_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$custom_field_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="">
                        <?php echo e($key); ?>

                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <?php if(is_array($custom_field_info)): ?>
                        <?php echo e(implode(', ', $custom_field_info)); ?>

                    <?php else: ?>
                        <?php
                            $file = pathinfo($custom_field_info, PATHINFO_EXTENSION);
                        ?>
                        <?php if($file && file_exists($custom_field_info)): ?>
                        <div class="d-flex align-items-center">
                            <span>
                                <?php
                                    $name = explode('/', $custom_field_info);
                                    $number = array_key_last($name);
                                    echo explode('.',$name[$number])[0];
                                ?>
                            </span>
                            <a href="<?php echo e(url($custom_field_info)); ?>" download>
                                <span class="ti-download ml-3 d-inline-block"></span>
                            </a>
                        </div>
                        <?php else: ?>
                            <?php echo e($custom_field_info); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/customField/_coutom_field_show.blade.php ENDPATH**/ ?>