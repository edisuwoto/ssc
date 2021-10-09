
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.blocked'); ?> <?php echo app('translator')->get('lang.user'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor" id="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-xl-12">

                    <div class="box_header">
                        <div class="main-title">
                            <h3 class="m-0"><?php echo app('translator')->get('lang.blocked'); ?> <?php echo app('translator')->get('lang.user'); ?> </h3>
                        </div>
                    </div>
                    <div class="chat_flow_list crm_full_height">

                        <div class="main-title2 mt-0">
                            <h4 class=""><?php echo app('translator')->get('lang.people'); ?></h4>
                        </div>

                        <div class="chat_flow_list_inner">
                            <ul>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <div class="single_list d-flex align-items-center">
                                            <div class="thumb">
                                                <a href="#" data-toggle="modal" data-target="#profileEditForm<?php echo e($index); ?>"><img src="<?php echo e(asset('frontend/img/chat/1.png')); ?>" alt=""></a>
                                            </div>
                                            <div class="list_name">
                                                <a href="#"><h4><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> <span class="active_chat" ></span> </h4></a>
                                            </div>
                                            <div>
                                                <a href="<?php echo e(route('chat.user.block', ['type' => 'unblock', 'user' => $user->id])); ?>" class="primary-btn small fix-gr-bg"><span class="ripple rippleEffect" style="width: 30px; height: 30px; top: -6.99219px; left: 19.2578px;"></span>
                                                    <?php echo app('translator')->get('lang.unblock'); ?> 
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="modal fade admin-query" id="profileEditForm<?php echo e($index); ?>" aria-modal="true">
                                        <div class="modal-dialog modal_800px modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        <div class="thumb" style="display: inline">
                                                            <a href="#"><img src="<?php echo e(asset($user->avatar)); ?>" height="50" width="50" alt=""></a>
                                                        </div>
                                                        <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <i class="ti-close "></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('lang.username'); ?> <span class="text-danger">*</span></label>
                                                                <input name="name" disabled class="primary_input_field name" placeholder="Name" value="<?php echo e($user->username); ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('lang.email'); ?> <span class="text-danger">*</span></label>
                                                                <input name="email" class="primary_input_field name" disabled placeholder="Email" value="<?php echo e($user->email); ?>" type="email" readonly="">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('lang.phone'); ?></label>
                                                                <input name="username" class="primary_input_field name" disabled value="<?php echo e($user->phone); ?>" type="text" readonly="">
                                                            </div>
                                                            <?php if($user->blockedByMe()): ?>
                                                                <a href="<?php echo e(route('chat.user.block', ['type' => 'unblock', 'user' => $user->id])); ?>" class="primary-btn small fix-gr-bg"><span class="ripple rippleEffect" style="width: 30px; height: 30px; top: -6.99219px; left: 19.2578px;"></span>
                                                                    <?php echo app('translator')->get('lang.unblock'); ?> <?php echo app('translator')->get('lang.user'); ?>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?php echo e(route('chat.user.block', ['type' => 'block', 'user' => $user->id])); ?>" class="primary-btn small fix-gr-bg"><span class="ripple rippleEffect" style="width: 30px; height: 30px; top: -6.99219px; left: 19.2578px;"></span>
                                                                    <?php echo app('translator')->get('lang.block'); ?> <?php echo app('translator')->get('lang.user'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('lang.description'); ?></label>
                                                                <p>
                                                                    <?php echo e($user->description); ?>

                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.found'); ?>!</p>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Chat/Resources/views/user/blocked.blade.php ENDPATH**/ ?>