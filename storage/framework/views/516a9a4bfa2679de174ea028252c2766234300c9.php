
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style>
    table.dataTable thead th {
        padding: 10px 30px !important;
    }

    table.dataTable tbody th, table.dataTable tbody td {
        padding: 20px 30px 20px 30px !important;
    }

    table.dataTable tfoot th, table.dataTable tfoot td {
        padding: 10px 30px 6px 30px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php  @$setting = app('school_info'); if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fund-transfer-store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="mb-10"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.information'); ?></h3>
                                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e(@$errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="amount" step="0.1" autocomplete="off" value="<?php echo e(old('amount')); ?>">
                                                <label><?php echo app('translator')->get('lang.amount'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('amount')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('amount')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mt-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e(@$errors->has('purpose') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="purpose" autocomplete="off" value="<?php echo e(old('purpose')); ?>">
                                                <label><?php echo app('translator')->get('lang.purpose'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('purpose')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('purpose')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $tooltip = "";
                                        if(userPermission(705)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?>
                                        </button>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <h3><?php echo app('translator')->get('lang.from'); ?></h3>
                                <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="CustomPaymentMethod">
                                        <div class="input-effect custom-transfer-account">
                                            <input type="radio" name="from_payment_method" data-id="<?php echo e($payment_method->method); ?>" id="from_method<?php echo e($payment_method->id); ?>" value="<?php echo e($payment_method->id); ?>" class="common-radio relation">
                                            <label for="from_method<?php echo e($payment_method->id); ?>"><?php echo e($payment_method->method); ?>

                                            <?php
                                                $total=$payment_method->IncomeAmount-$payment_method->ExpenseAmount;
                                            ?>
                                            <?php if($payment_method->method !="Bank"): ?>
                                                (<?php echo e($total); ?>)
                                            <?php else: ?>
                                                (<?php echo e($bank_amount); ?>)
                                            <?php endif; ?>
                                            </label>
                                        </div>
                                        <?php if($payment_method->method =="Bank"): ?>
                                            <div class="d-none pl-3" id="bankList">
                                                <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="input-effect custom-transfer-account">
                                                    <input type="radio" name="from_bank_name" id="from_bank<?php echo e($bank_account->id); ?>" value="<?php echo e($bank_account->id); ?>" class="common-radio">
                                                    <label for="from_bank<?php echo e($bank_account->id); ?>"><?php echo e($bank_account->bank_name); ?> (<?php echo e($bank_account->current_balance); ?>)</label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($errors->has('from_payment_method')): ?>
                                <span class="invalid-feedback d-block mt-0" role="alert">
                                        <strong><?php echo e(@$errors->first('from_payment_method')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4">
                                <h3><?php echo app('translator')->get('lang.to'); ?></h3>
                                <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="CustomPaymentMethod">
                                        <div class="input-effect custom-transfer-account remove<?php echo e($payment_method->id); ?>">
                                            <input type="radio" name="to_payment_method" data-id="<?php echo e($payment_method->method); ?>" id="to_method<?php echo e($payment_method->id); ?>" value="<?php echo e($payment_method->id); ?>" class="common-radio toRelation">
                                            <label for="to_method<?php echo e($payment_method->id); ?>"><?php echo e($payment_method->method); ?> 
                                            <?php
                                            $total=$payment_method->IncomeAmount-$payment_method->ExpenseAmount;
                                            ?>
                                            <?php if($payment_method->method !="Bank"): ?>
                                                (<?php echo e($total); ?>)
                                            <?php else: ?>
                                                (<?php echo e($bank_amount); ?>)
                                            <?php endif; ?>
                                            </label>
                                        </div>
                                        <?php if($payment_method->method =="Bank"): ?>
                                            <div class="d-none pl-3" id="toBankList">
                                                <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="input-effect custom-transfer-account">
                                                    <input type="radio" name="to_bank_name" id="tobank<?php echo e($bank_account->id); ?>" value="<?php echo e($bank_account->id); ?>" class="common-radio">
                                                    <label for="tobank<?php echo e($bank_account->id); ?>"><?php echo e($bank_account->bank_name); ?> (<?php echo e($bank_account->current_balance); ?>)</label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($errors->has('to_payment_method')): ?>
                                    <span class="invalid-feedback d-block mt-0" role="alert">
                                        <strong><?php echo e(@$errors->first('to_payment_method')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.amount'); ?> <?php echo app('translator')->get('lang.transfer'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="tableWithoutSort" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.purpose'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?></th>
                                        <th><?php echo app('translator')->get('lang.from'); ?></th>
                                        <th><?php echo app('translator')->get('lang.to'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total=0;
                                ?>                                
                                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total=$total+$transfer->amount;
                                ?>
                                <tr>
                                    <td><?php echo e($transfer->purpose); ?></td>
                                    <td><?php echo e($transfer->amount); ?></td>
                                    <td><?php echo e($transfer->fromPaymentMethodName->method); ?></td>
                                    <td><?php echo e($transfer->toPaymentMethodName->method); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><?php echo app('translator')->get('lang.total'); ?></td>
                                        <td><?php echo e(@generalSetting()->currency_symbol); ?><?php echo e($total); ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
        $(document).on('change','.relation',function (){
            let from_account_id = $(this).data('id');
            if (from_account_id=="Bank")
            {
                $("#bankList").addClass("d-block");
            }else{
                $("#bankList").removeClass("d-block");
            }
           
        })

        $(document).on('change','.toRelation',function (){
            let to_account_id = $(this).data('id');
            if (to_account_id=="Bank")
            {
                $("#toBankList").addClass("d-block");
            }else{
                $("#toBankList").removeClass("d-block");
            }
           
        })

        // $(document).on('change','.relation',function (){
        //     let from_account_id = $(this).data('id');
        //     alert(from_account_id);
        //     if($(this).is(':checked')){
        //         $('.remove'+from_account_id).hide();
        //     }else{
        //         $('.remove'+from_account_id).show();
        //     }
        // })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/accounts/fund_transfer.blade.php ENDPATH**/ ?>