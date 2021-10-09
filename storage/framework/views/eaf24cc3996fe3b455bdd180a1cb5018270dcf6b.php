
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.balance_fees_report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<input type="text" hidden value="<?php echo e(@$clas->class_name); ?>" id="cls">
<input type="text" hidden value="<?php echo e(@$clas->section_name->sectionName->section_name); ?>" id="sec">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.balance_fees_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.balance_fees_report'); ?></a>
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'balance_fees_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md col-md-6">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md col-md-6" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>*" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
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
            
            <?php if(isset($balance_students)): ?>

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.fees_report'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_ids" class="display school-table balance-custom-table" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.roll'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.father_name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?></th>
                                        <th><?php echo app('translator')->get('lang.discount'); ?></th>
                                        <th><?php echo app('translator')->get('lang.fine'); ?></th>
                                        <th><?php echo app('translator')->get('lang.paid_fees'); ?></th>
                                        <th><?php echo app('translator')->get('lang.balance'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $grand_total = 0;
                                        $grand_discount = 0;
                                        $grand_fine = 0;
                                        $grand_deposit = 0;
                                        $grand_balance = 0;
                                    ?>
                                    <?php $__currentLoopData = $balance_students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->full_name); ?></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->roll_no); ?></td>
                                        <td><?php echo e($student->parents!=""?$student->parents->fathers_name:""); ?></td>
                                        <td>
                                            <?php
                                            $total = App\SmStudent::totalFees($student->feesAssign);
                                            $grand_total += $total;
                                            echo $total;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $discount = App\SmStudent::totalDiscount($student->feesAssign, $student->id);
                                            $grand_discount += $discount;
                                            echo $discount;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $fine = App\SmStudent::totalFine($student->feesAssign, $student->id);
                                            $grand_fine += $fine;
                                            echo $fine;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $deposit = App\SmStudent::totalDeposit($student->feesAssign, $student->id);
                                            $grand_deposit += $deposit;
                                            echo $deposit;
                                            ?>
                                        </td>
                                        <td><?php
                                            $balance = App\SmStudent::totalFees($student->feesAssign) - App\SmStudent::totalDiscount($student->feesAssign, $student->id) - App\SmStudent::totalDeposit($student->feesAssign, $student->id) +  App\SmStudent::totalFine($student->feesAssign, $student->id);
                                            $grand_balance += $balance;
                                            echo $balance;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo app('translator')->get('lang.grand_total'); ?></th>
                                    <th><?php echo e($grand_total); ?> </th>
                                    <th><?php echo e($grand_discount); ?></th>
                                    <th><?php echo e($grand_fine); ?></th>
                                    <th><?php echo e($grand_deposit); ?></th>
                                    <th><?php echo e($grand_balance); ?></th>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/feesCollection/balance_fees_report.blade.php ENDPATH**/ ?>