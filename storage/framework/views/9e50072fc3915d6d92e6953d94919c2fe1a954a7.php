
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.chat'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor" id="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="chat_main_wrapper">
                        <div class="chat_flow_list_wrapper ">
                            <div class="box_header">
                                <div class="main-title">
                                    <h3 class="m-0"><?php echo app('translator')->get('lang.chat'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                                </div>
                                <a class="primary-btn radius_30px  fix-gr-bg" href="<?php echo e(route('chat.new')); ?>"><i class="ti-plus"></i><?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.chat'); ?></a>
                            </div>
                            <!-- chat_list  -->
                            <side-panel-component
                                :search_url="<?php echo e(json_encode(route('chat.user.search'))); ?>"
                                :single_chat_url="<?php echo e(json_encode(route('chat.index'))); ?>"
                                :chat_block_url="<?php echo e(json_encode(route('chat.user.block'))); ?>"
                                :create_group_url="<?php echo e(json_encode(route('chat.group.create'))); ?>"
                                :group_chat_show="<?php echo e(json_encode(route('chat.group.show'))); ?>"
                                :users="<?php echo e(json_encode($users)); ?>"
                                :groups="<?php echo e(json_encode($groups)); ?>"
                                :all_users="<?php echo e(json_encode(\App\Models\User::where('id', '!=', auth()->id())->get())); ?>"
                                :can_create_group="<?php echo e(json_encode(app('general_settings')->get('chat_can_make_group')== 'yes')); ?>"
                                :asset_type="<?php echo e(json_encode('/public')); ?>"
                            ></side-panel-component>
                            <!--/ chat_list  -->
                        </div>

                        <div class="chat_flow_list_wrapper ">
                            <div class="box_header">
                                <div class="main-title">
                                    <h3 class="m-0"><?php echo app('translator')->get('lang.list'); ?></h3>
                                </div>
                            </div>
                            <!-- chat_list  -->
                            <div class="chat_flow_list crm_full_height">
                                <div class="chat_flow_list_inner">
                                    <ul>
                                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li>
                                                <div class="single_list d-flex align-items-center">
                                                    <div class="thumb">
                                                        <a href="<?php echo e(route('chat.index', $user->id)); ?>">
                                                            <?php if($user->avatar): ?>
                                                                <img src="<?php echo e(asset($user->avatar)); ?>" alt="">
                                                            <?php elseif($user->avatar_url): ?>
                                                                <img src="<?php echo e(asset($user->avatar_url)); ?>" alt="">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('chat/images/spondon-icon.png')); ?>" alt="">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <div class="list_name">
                                                        <a href="<?php echo e(route('chat.index', $user->id)); ?>">
                                                            <h4><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                                <span class="active_chat"></span>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <a style="padding: 7px 40px 7px 25px;" href="<?php echo e(route('chat.index', $user->id)); ?>" class="primary-btn radius_30px fix-gr-bg"><?php echo app('translator')->get('lang.start'); ?></a>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <p><?php echo app('translator')->get('lang.no'); ?> <?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.found'); ?> <?php echo app('translator')->get('lang.to'); ?> <?php echo app('translator')->get('lang.chat'); ?>!</p>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <!--/ chat_list  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/Modules/Chat/Resources/views/new-chat.blade.php ENDPATH**/ ?>