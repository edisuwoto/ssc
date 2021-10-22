
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.transaction'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style>
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 20px 30px 20px 30px !important;
    }

    table.dataTable tfoot th, table.dataTable tfoot td {
        padding: 10px 30px 6px 30px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php  @$setting = App\SmGeneralSettings::find(1); if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.transaction'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.transaction'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'transaction-search', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input placeholder="" class="primary_input_field primary-input form-control" type="text" name="date_range" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>" name="type" id="account-type">
                                        <option data-display="<?php echo app('translator')->get('lang.search'); ?> <?php echo app('translator')->get('lang.type'); ?>" value="all"><?php echo app('translator')->get('lang.search'); ?> <?php echo app('translator')->get('lang.type'); ?></option>
                                        <option value="In"><?php echo app('translator')->get('lang.income'); ?></option>
                                        <option value="Ex"><?php echo app('translator')->get('lang.expense'); ?></option>
                                    </select>
                                    <?php if($errors->has('type')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e(@$errors->first('type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="payment_method" id="payment_method">
                                            <option data-display="<?php echo app('translator')->get('lang.all'); ?>" value="all"><?php echo app('translator')->get('lang.all'); ?></option>
                                            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                <?php echo e(isset($search_info)? ($search_info['method_id'] == $value->id? 'selected':''):''); ?>

                                                ><?php echo e($value->method); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>            
        <?php if(isset($add_incomes)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.income'); ?> <?php echo app('translator')->get('lang.result'); ?></h3>
                            </div>
                        </div>
                    </div>                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.income_head'); ?></th>
                                        <th><?php echo app('translator')->get('lang.payment_method'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_income=0;
                                    ?>
                                    <?php $__currentLoopData = $add_incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        @$total_income = @$total_income + @$add_income->amount; 
                                    ?>
                                    <tr>
                                        <td><?php echo e(dateConvert(@$add_income->date)); ?></td>
                                        <td><?php echo e(@$add_income->name); ?></td>
                                        <td><?php echo e(@$add_income->ACHead->head); ?></td>
                                        <td>
                                        <?php echo e(@$add_income->paymentMethod->method); ?>

                                        <?php if(@$add_income->payment_method_id==3): ?>
                                            (<?php echo e(@$add_income->account->bank_name); ?>)
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo e(@$add_income->amount); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang.grand_total'); ?>:</th>
                                        <th><?php echo e(@generalSetting()->currency_symbol); ?><?php echo e($total_income); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(isset($add_expenses)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.expense'); ?> <?php echo app('translator')->get('lang.result'); ?></h3>
                            </div>
                        </div>
                    </div>               
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.expense_head'); ?></th>
                                        <th><?php echo app('translator')->get('lang.payment_method'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total_expense=0;
                                ?>
                                    <?php $__currentLoopData = $add_expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        @$total_expense = @$total_expense + @$add_expense->amount; 
                                    ?>
                                    <tr>
                                        <td><?php echo e(dateConvert(@$add_expense->date)); ?></td>
                                        <td><?php echo e(@$add_expense->name); ?></td>
                                        <td><?php echo e(@$add_expense->ACHead->head); ?></td>
                                        <td>
                                        <?php echo e(@$add_expense->paymentMethod->method); ?>

                                        <?php if(@$add_expense->payment_method_id==3): ?>
                                            (<?php echo e(@$add_expense->account->bank_name); ?>)
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo e(@generalSetting()->currency_symbol); ?><?php echo e(@$add_expense->amount); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang.grand_total'); ?>:</th>
                                        <th><?php echo e(@generalSetting()->currency_symbol); ?><?php echo e($total_expense); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $('input[name="date_range"]').daterangepicker({
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "startDate": moment().subtract(7, 'days'),
        "endDate": moment()
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/accounts/transaction.blade.php ENDPATH**/ ?>