
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        .bg-color{
            width: 20px;
            height: 20px;
            text-align: center;
            padding: 0px;
            margin: 0 auto;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.style'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.style'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.style'); ?></a>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.style'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                        <th><?php echo app('translator')->get('lang.title'); ?></th>
                                        <th><?php echo app('translator')->get('lang.primary_color'); ?></th>
                                        <th><?php echo app('translator')->get('lang.primary_color2'); ?></th>
                                        <th><?php echo app('translator')->get('lang.primary_color3'); ?></th>
                                        <th><?php echo app('translator')->get('lang.title_color'); ?></th>
                                        <th><?php echo app('translator')->get('lang.text_color'); ?></th>
                                        <th><?php echo app('translator')->get('lang.sidebar_bg'); ?></th>
                                        <th><?php echo app('translator')->get('lang.status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php @$count=1; ?>
                                <?php $__currentLoopData = $color_styles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background_setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$count++); ?></td>
                                        <td><?php echo e(@$background_setting->style_name); ?></td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color2); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color2); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color3); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color3); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->title_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->title_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->text_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->text_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->sidebar_bg); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->sidebar_bg); ?></div>
                                            </div>
                                        </td>
                                        <td>

                                            <?php if($background_setting->is_active==1): ?>
                                                <label class="primary-btn small fix-gr-bg "><?php echo app('translator')->get('lang.activated'); ?></label>
                                            <?php else: ?>
                                                <?php if(userPermission(491)): ?>
                                                    <a class="primary-btn small tr-bg"
                                                    href="<?php echo e(route('make-default-theme',@$background_setting->id)); ?>">
                                                        <?php echo app('translator')->get('lang.make_default'); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/backEnd/systemSettings/color_theme.blade.php ENDPATH**/ ?>