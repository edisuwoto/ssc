
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.profit'); ?> & <?php echo app('translator')->get('lang.loss'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></a>
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search_profit_by_date', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-md-6 offset-md-3 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input placeholder="" class="primary_input_field primary-input form-control text-center" type="text" name="date_range" value="">
                                            </div>
                                            <?php if($errors->has('date_range')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('date_range')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-center">
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
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></h3>
                            </div>
                        </div>
                    </div>                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.time'); ?></th>
                                        <th><?php echo app('translator')->get('lang.income'); ?></th>
                                        <th><?php echo app('translator')->get('lang.expense'); ?></th>
                                        <th><?php echo app('translator')->get('lang.profit'); ?>/<?php echo app('translator')->get('lang.loss'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    <tr>
                                        <td >
                                            <?php echo e(isset($date_time_from)? dateConvert($date_time_from).' - '.dateConvert($date_time_to): "All"); ?>  
                                        </td>
                                        <td>
                                            <?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format(@$total_income, 2)); ?>

                                        </td>
                                        <td>
                                            <?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format(@$total_expense, 2)); ?>

                                        </td>
                                        <td>
                                            <?php
                                                $total=@$total_income-@$total_expense;
                                            ?>
                                            <?php echo e(generalSetting()->currency_symbol); ?>

                                            <?php echo e(@$total); ?>

                                        </td>
                                    </tr>
                                    
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/accounts/profit.blade.php ENDPATH**/ ?>