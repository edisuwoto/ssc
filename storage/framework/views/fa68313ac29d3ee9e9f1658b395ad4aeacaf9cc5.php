
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
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
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fine-report-search', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-md-6">
                                <input placeholder="" class="primary_input_field primary-input form-control" type="text" name="date_range" value="">
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
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
        <?php if(isset($fine_info)): ?>
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id_al" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.id'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.class'); ?></th>
                                    <th><?php echo app('translator')->get('lang.fees_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.mode'); ?></th>
                                    <th><?php echo app('translator')->get('lang.fine'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $grand_amount = 0;
                                    $grand_total = 0;
                                    $grand_fine = 0;
                                ?>
                                <?php $__currentLoopData = $fine_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $students): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total = 0; ?>
                                    <?php if($fees_payment->fine>0): ?>
                                    <tr>
                                        <td><?php echo e($fees_payment->fees_type_id.'/'.$fees_payment->id); ?></td>
                                        <td  data-sort="<?php echo e(strtotime($fees_payment->payment_date)); ?>" >
                                        <?php echo e($fees_payment->payment_date != ""? dateConvert($fees_payment->payment_date):''); ?>

                                        </td>
                                        <td><?php echo e($fees_payment->studentInfo !=""?$fees_payment->studentInfo->full_name:""); ?></td>
                                        <td>
                                        <?php if($fees_payment->studentInfo!="" && $fees_payment->studentInfo->className!=""): ?>
                                            <?php echo e($fees_payment->studentInfo->className->class_name); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($fees_payment->feesType!=""?$fees_payment->feesType->name:""); ?></td>
                                        <td>
                                        <?php echo e(@$fees_payment->payment_mode); ?>

                                        </td>
                                        <td>
                                            <?php
                                                $total =  $total + $fees_payment->fine;
                                                $grand_fine =  $grand_fine + $fees_payment->fine;
                                                echo generalSetting()->currency_symbol.$fees_payment->fine;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo app('translator')->get('lang.grand_total'); ?> </th>
                                <th><?php echo e(generalSetting()->currency_symbol); ?><?php echo e($grand_fine); ?></th>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/accounts/fine_report.blade.php ENDPATH**/ ?>