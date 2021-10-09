
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.generate_payroll'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.generate_payroll'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.generate_payroll'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(userPermission(173)): ?>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-lg-12">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('success')); ?>

                </div>
            <?php elseif(session()->has('danger')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('danger')); ?>

                </div>
            <?php endif; ?>
            <div class="white-box">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'payroll', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <div class="row">
                    <div class="col-lg-4 mt-30-md">
                        <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="role_id">
                            <option data-display="<?php echo app('translator')->get('lang.role'); ?> *" value=""><?php echo app('translator')->get('lang.select_role'); ?> *</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php echo e(isset($role_id)? ($role_id == $value->id? 'selected':''):''); ?>><?php echo e($value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('role_id')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong><?php echo e($errors->first('role_id')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php $month = date('F'); ?>
                    <div class="col-lg-4 mt-30-md">
                      <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('payroll_month') ? 'is-invalid' : ''); ?>" name="payroll_month" id="payroll_month">
                        <option data-display="<?php echo app('translator')->get('lang.select_month'); ?> *" value=""><?php echo app('translator')->get('lang.select_month'); ?> *</option>
                        <option value="January" <?php echo e(isset($payroll_month)? ($payroll_month == "January"? 'selected':''):($month == "January"? 'selected':'')); ?>><?php echo app('translator')->get('lang.january'); ?></option>
                        <option value="February"  <?php echo e(isset($payroll_month)? ($payroll_month == "February"? 'selected':''):($month == "February"? 'selected':'')); ?>><?php echo app('translator')->get('lang.february'); ?></option>
                        <option value="March"  <?php echo e(isset($payroll_month)? ($payroll_month == "March"? 'selected':''):($month == "March"? 'selected':'')); ?>><?php echo app('translator')->get('lang.march'); ?></option>
                        <option value="April" <?php echo e(isset($payroll_month)? ($payroll_month == "April"? 'selected':''):($month == "April"? 'selected':'')); ?>><?php echo app('translator')->get('lang.april'); ?></option>
                        <option value="May" <?php echo e(isset($payroll_month)? ($payroll_month == "May"? 'selected':''):($month == "May"? 'selected':'')); ?>><?php echo app('translator')->get('lang.may'); ?></option>
                        <option value="June" <?php echo e(isset($payroll_month)? ($payroll_month == "June"? 'selected':''):($month == "June"? 'selected':'')); ?>><?php echo app('translator')->get('lang.june'); ?></option>
                        <option value="July" <?php echo e(isset($payroll_month)? ($payroll_month == "July"? 'selected':''):($month == "July"? 'selected':'')); ?>><?php echo app('translator')->get('lang.july'); ?></option>
                        <option value="August" <?php echo e(isset($payroll_month)? ($payroll_month == "August"? 'selected':''):($month == "August"? 'selected':'')); ?>><?php echo app('translator')->get('lang.august'); ?></option>
                        <option value="September" <?php echo e(isset($payroll_month)? ($payroll_month == "September"? 'selected':''):($month == "September"? 'selected':'')); ?>><?php echo app('translator')->get('lang.september'); ?></option>
                        <option value="October" <?php echo e(isset($payroll_month)? ($payroll_month == "October"? 'selected':''):($month == "October"? 'selected':'')); ?>><?php echo app('translator')->get('lang.october'); ?></option>
                        <option value="November" <?php echo e(isset($payroll_month)? ($payroll_month == "November"? 'selected':''):($month == "November"? 'selected':'')); ?>><?php echo app('translator')->get('lang.november'); ?></option>
                        <option value="December" <?php echo e(isset($payroll_month)? ($payroll_month == "December"? 'selected':''):($month == "December"? 'selected':'')); ?>><?php echo app('translator')->get('lang.december'); ?></option>
                    </select>
                    <?php if($errors->has('payroll_month')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong><?php echo e($errors->first('payroll_month')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('payroll_year') ? 'is-invalid' : ''); ?>" name="payroll_year" id="payroll_year">
                        <option data-display="<?php echo app('translator')->get('lang.select_year'); ?> *" value=""><?php echo app('translator')->get('lang.select_year'); ?> *</option>
                        <?php 
                            $year = date('Y');
                            $ini = date('y');
                            $limit = $ini + 30;
                        ?>
                        <?php for($i = $ini; $i <= $limit; $i++): ?>
                        <option value="<?php echo e($year); ?>" <?php echo e(isset($payroll_year)? ($payroll_year == $year? 'selected':''):(date('Y') == $year? 'selected':'')); ?>><?php echo e($year--); ?></option>
                        <?php endfor; ?>
                    </select>
                    <?php if($errors->has('payroll_year')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong><?php echo e($errors->first('payroll_year')); ?></strong>
                    </span>
                    <?php endif; ?>
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
<?php endif; ?>
<?php if(isset($staffs)): ?>
<div class="row mt-40">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.staff_list'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                            <th><?php echo app('translator')->get('lang.name'); ?></th>
                            <th><?php echo app('translator')->get('lang.role'); ?></th>
                            <th><?php echo app('translator')->get('lang.department'); ?></th>
                            <th><?php echo app('translator')->get('lang.description'); ?></th>
                            <th><?php echo app('translator')->get('lang.mobile'); ?></th>
                            <th><?php echo app('translator')->get('lang.Status'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($value->staff_no); ?></td>
                        <td><?php echo e($value->first_name); ?>&nbsp;<?php echo e($value->last_name); ?></td>
                        <td><?php echo e($value->roles !=""?$value->roles->name:""); ?></td>
                        <td><?php echo e($value->departments !=""?$value->departments->name:""); ?></td>
                        <td><?php echo e($value->designations !=""?$value->designations->title:""); ?></td>
                        <td><?php echo e($value->mobile); ?></td>
                        <td>
                            <?php
                                $getPayrollDetails = App\SmHrPayrollGenerate::getPayrollDetails($value->id, $payroll_month, $payroll_year);
                            ?>
                            <?php if(!empty($getPayrollDetails)): ?>
                                <?php if($getPayrollDetails->payroll_status == 'G'): ?>
                                    <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('lang.generated'); ?></button>
                                <?php endif; ?>
                                <?php if($getPayrollDetails->payroll_status == 'P'): ?>
                                    <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('lang.paid'); ?> </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="primary-btn small bg-danger text-white border-0 nowrap"><?php echo app('translator')->get('lang.not'); ?> <?php echo app('translator')->get('lang.generated'); ?></button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                    <?php echo app('translator')->get('lang.select'); ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                <?php if(!empty($getPayrollDetails)): ?>
                                    <?php if($getPayrollDetails->payroll_status == 'G'): ?>
                                        <?php if(userPermission(176)): ?>
                                            <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="<?php echo app('translator')->get('lang.proceed_to_pay'); ?>" href="<?php echo e(route('pay-payroll',[$getPayrollDetails->id,$value->role_id])); ?>"><?php echo app('translator')->get('lang.proceed_to_pay'); ?></a>
                                        <?php endif; ?>
                                            <a class="dropdown-item" href="<?php echo e(route('print-payslip', $getPayrollDetails->id)); ?>"><?php echo app('translator')->get('lang.print'); ?></a>
                                    <?php endif; ?>
                                    <?php if($getPayrollDetails->payroll_status == 'P'): ?>
                                        <?php if(userPermission(177)): ?>
                                            <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="<?php echo app('translator')->get('lang.view_payslip'); ?>" href="<?php echo e(route('view-payslip', $getPayrollDetails->id)); ?>"><?php echo app('translator')->get('lang.view_payslip'); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(userPermission(174)): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('generate-Payroll',[@$value->id,@$payroll_month,@$payroll_year])); ?>"><?php echo app('translator')->get('lang.generate_payroll'); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/humanResource/payroll/index.blade.php ENDPATH**/ ?>