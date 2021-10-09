
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.invitation'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor" id="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="chat_flow_list_wrapper ">
                            <div class="box_header">
                                <div class="main-title">
                                    <h3 class="m-0"><?php echo app('translator')->get('lang.your'); ?> <?php echo app('translator')->get('lang.requests'); ?></h3>
                                </div>
                            </div>
                            <!-- chat_list  -->
                            <div class="chat_flow_list crm_full_height">
                                <div class="chat_flow_list_inner">
                                    <ul>
                                        <?php $__empty_1 = true; $__currentLoopData = $ownRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li class="list-unstyled">
                                                <div class="single_list d-flex align-items-center">
                                                    <div class="thumb">
                                                        <?php if($myRequest->requestTo->avatar): ?>
                                                            <a><img src="<?php echo e(asset($myRequest->requestTo->avatar)); ?>" alt=""></a>
                                                        <?php elseif($myRequest->requestTo->avatar_url): ?>
                                                            <a><img src="<?php echo e(asset($myRequest->requestTo->avatar_url)); ?>" alt=""></a>
                                                        <?php else: ?>
                                                            <a><img src="<?php echo e(asset('images/spondon-icon.png')); ?>" alt=""></a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="list_name">
                                                        <a>
                                                            <h4><?php echo e($myRequest->requestTo->first_name); ?>

                                                                <?php if($myRequest->requestTo->activeStatus->isActive()): ?>
                                                                    <span class="active_chat" ></span>
                                                                <?php elseif($myRequest->requestTo->activeStatus->isInactive()): ?>
                                                                    <span class="inactive_chat" ></span>
                                                                <?php elseif($myRequest->requestTo->activeStatus->isBusy()): ?>
                                                                    <span class="busy_chat" ></span>
                                                                <?php else: ?>
                                                                    <span class="away_chat" ></span>
                                                                <?php endif; ?>
                                                            </h4>
                                                        </a>
                                                        <p>Your request to <?php echo e($myRequest->requestTo->first_name); ?> </p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <p><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.connection'); ?> <?php echo app('translator')->get('lang.request'); ?> <?php echo app('translator')->get('lang.found'); ?>!</p>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <!--/ chat_list  -->
                        </div>
                </div>
                <div class="col-xl-6">
                    <div class="chat_flow_list_wrapper">
                        <div class="box_header">
                            <div class="main-title">
                                <h3 class="m-0"><?php echo app('translator')->get('lang.people'); ?> <?php echo app('translator')->get('lang.requests'); ?> <?php echo app('translator')->get('lang.you'); ?> <?php echo app('translator')->get('lang.to'); ?> <?php echo app('translator')->get('lang.connect'); ?></h3>
                            </div>
                        </div>
                        <!-- chat_list  -->
                        <div class="chat_flow_list crm_full_height">
                            <div class="chat_flow_list_inner">
                                <ul>
                                    <?php $__empty_1 = true; $__currentLoopData = $peopleRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li class="list-unstyled">
                                            <div class="single_list d-flex align-items-center">
                                                <div class="thumb">
                                                    <?php if($request->requestFrom->avatar): ?>
                                                        <a><img src="<?php echo e(asset($request->requestFrom->avatar)); ?>" alt=""></a>
                                                    <?php elseif($request->requestFrom->avatar_url): ?>
                                                        <a><img src="<?php echo e(asset($request->requestFrom->avatar_url)); ?>" alt=""></a>
                                                    <?php else: ?>
                                                        <a><img src="<?php echo e(asset('images/spondon-icon.png')); ?>" alt=""></a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="list_name w-50">
                                                    <a>
                                                        <h4><?php echo e($request->requestFrom->first_name); ?>

                                                            <?php if($request->requestFrom->activeStatus->isActive()): ?>
                                                                <span class="active_chat" ></span>
                                                            <?php elseif($request->requestFrom->activeStatus->isInactive()): ?>
                                                                <span class="inactive_chat" ></span>
                                                            <?php elseif($request->requestFrom->activeStatus->isBusy()): ?>
                                                                <span class="busy_chat" ></span>
                                                            <?php else: ?>
                                                                <span class="away_chat" ></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                    </a>
                                                    <p><?php echo e($request->requestFrom->first_name); ?> requested to connect..</p>
                                                </div>
                                                <div>
                                                    <a href="<?php echo e(route('chat.invitation.action',['type' => 'accept', 'id' => $request->id])); ?>" class="single-icon primary-btn small fix-gr-bg text-white" title="Accept">
                                                        <span class="ti-check pr-2"></span>
                                                    </a>

                                                    <a href="<?php echo e(route('chat.invitation.action',['type' => 'reject', 'id' => $request->id])); ?>" class="single-icon primary-btn small fix-gr-bg text-white" title="Reject">
                                                        <span class="ti-close pr-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.connection'); ?> <?php echo app('translator')->get('lang.request'); ?> <?php echo app('translator')->get('lang.found'); ?>!</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <!--/ chat_list  -->
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-6">
                    <div class="chat_flow_list_wrapper ">
                        <div class="box_header">
                            <div class="main-title">
                                <h3 class="m-0"><?php echo app('translator')->get('lang.connection'); ?> <?php echo app('translator')->get('lang.connected'); ?> <?php echo app('translator')->get('lang.with'); ?> <?php echo app('translator')->get('lang.you'); ?></h3>
                            </div>
                        </div>
                        <!-- chat_list  -->
                        <div class="chat_flow_list crm_full_height">
                            <div class="chat_flow_list_inner">
                                <ul>
                                    <?php $__empty_1 = true; $__currentLoopData = $connectedPeoples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li class="list-unstyled">
                                            <div class="single_list d-flex align-items-center">
                                                <div class="thumb">
                                                    <?php if($request->avatar): ?>
                                                        <a><img src="<?php echo e(asset($request->avatar)); ?>" alt=""></a>
                                                    <?php elseif($request->avatar_url): ?>
                                                        <a><img src="<?php echo e(asset($request->avatar_url)); ?>" alt=""></a>
                                                    <?php else: ?>
                                                        <a><img src="<?php echo e(asset('images/spondon-icon.png')); ?>" alt=""></a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="list_name w-50">
                                                    <a>
                                                        <h4><?php echo e($request->first_name); ?>

                                                            <?php if($request->activeStatus->isActive()): ?>
                                                                <span class="active_chat" ></span>
                                                            <?php elseif($request->activeStatus->isInactive()): ?>
                                                                <span class="inactive_chat" ></span>
                                                            <?php elseif($request->activeStatus->isBusy()): ?>
                                                                <span class="busy_chat" ></span>
                                                            <?php else: ?>
                                                                <span class="away_chat" ></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                    </a>

                                                    <p><?php echo e($request->first_name); ?> <?php echo app('translator')->get('lang.connected'); ?> <?php echo app('translator')->get('lang.with'); ?> <?php echo app('translator')->get('lang.you'); ?>.</p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.connection'); ?> <?php echo app('translator')->get('lang.connected'); ?> <?php echo app('translator')->get('lang.request'); ?> <?php echo app('translator')->get('lang.found'); ?>!</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <!--/ chat_list  -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Chat/Resources/views/invitation.blade.php ENDPATH**/ ?>