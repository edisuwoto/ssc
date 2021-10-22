
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.search_fees_due'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.search_fees_due'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.search_fees_due'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_due_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('fees_group') ? ' is-invalid' : ''); ?>" name="fees_group">
                                        <option data-display="<?php echo app('translator')->get('lang.fees_group'); ?>*" value=""><?php echo app('translator')->get('lang.fees_group'); ?> *</option>
                                        <?php $__currentLoopData = $fees_masters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="" disabled><?php echo e(@$fees_master->feesGroups->name); ?></option>
                                             <?php $__currentLoopData = $fees_master->feesTypeIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feesTypeId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($fees_master->fees_group_id.'-'.$feesTypeId->feesTypes->id); ?>" <?php echo e(isset($fees_group_id)? ($fees_group_id == $feesTypeId->feesTypes->id? 'selected':''):''); ?>><?php echo e($feesTypeId->feesTypes->name); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('fees_group')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('fees_group')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 mt-30-md">
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
                                <div class="col-lg-4 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
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
            
        



             <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'send-dues-fees-email', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                    <div class="col-12">
                        <div class="main-title d-flex align-items-center flex-wrap mb_sm_75">
                            <h3 class="mb-0 mb-2 mt-2 mr-2"> <?php echo app('translator')->get('lang.fees_due_list'); ?></h3>
                            <div class="fes_lag_btn d-flex align-items-center">
                                <button name="send_email" type="submit" class="primary-btn small fix-gr-bg mr-2">
                                    <span class="ti-envelope pr-2"></span>
                                    <?php echo app('translator')->get('lang.send'); ?> <?php echo app('translator')->get('lang.email'); ?>
                                </button>
                                <button name="send_sms" type="submit" class="primary-btn small fix-gr-bg ">
                                    <span class="ti-envelope pr-2"></span>
                                    <?php echo app('translator')->get('lang.send'); ?> <?php echo app('translator')->get('lang.sms'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                        <!-- <div class="col-lg-6 no-gutters">
                            <div class="row">
                                <div class="col-md-3">
                                    
                                </div>
                                <div class="col-md-3">
                                    
                                </div>
                                <div class="col-md-3">
                                    
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12 search_hide_md">

                            <table id="table_id" class="display school-table " cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th> <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.roll'); ?>  <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th> <?php echo app('translator')->get('lang.name'); ?></th>
                                        
                                        <th><?php echo app('translator')->get('lang.due_date'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th><?php echo app('translator')->get('lang.deposit'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th><?php echo app('translator')->get('lang.discount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th><?php echo app('translator')->get('lang.fine'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th><?php echo app('translator')->get('lang.balance'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                        <th><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $__currentLoopData = $fees_dues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_due): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <tr>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->admission_no:""); ?></td>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->roll_no:""); ?></td>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->full_name:""); ?></td>
                                        
                                        <td>
                                            <?php if($fees_due->feesGroupMaster !=""): ?>
                                            
                                                <?php echo e($fees_due->feesGroupMaster->date != ""? dateConvert($fees_due->feesGroupMaster->date):''); ?>


                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                                    echo $fees_due->feesGroupMaster->amount;
                                                
                                                
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $amount = App\SmFeesAssign::discountSum($fees_due->student_id, $fees_due->feesGroupMaster->feesTypes->id, 'amount');
                                                echo $amount;
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            $discount_amount = $fees_due->applied_discount;
                                            if ($discount_amount>0) {
                                                echo $discount_amount;
                                            } else {
                                               echo 0.00;
                                            }
                                            
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                            $fine = App\SmFeesAssign::discountSum($fees_due->student_id, $fees_due->feesGroupMaster->feesTypes->id, 'fine');
                                            echo $fine;
                                        ?>
                                        </td>
                                        <td>
                                            <?php
                                                   echo $fees_due->feesGroupMaster->amount - $discount_amount - $amount+$fine;
                                                    $dues_amount = $fees_due->feesGroupMaster->amount - $discount_amount - $amount;
                                               
                                                
                                            ?>
                                            <input type="hidden" name="dues_amount[<?php echo e($fees_due->studentInfo->id); ?>]" value="<?php echo e($dues_amount); ?>">
                                             <input type="hidden" name="student_list[]" value="<?php echo e($fees_due->studentInfo->id); ?>">
                                                <input type="hidden" name="fees_master" value="<?php echo e($fees_due->feesGroupMaster->id); ?>">
                                        </td>
                                        <td><div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>


                                                <?php if(userPermission(117)): ?>

                                            

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo e(route('fees_collect_student_wise', [$fees_due->student_id])); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                                </div>

                                                <?php endif; ?>
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
            <?php echo e(Form::close()); ?>




    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/feesCollection/search_fees_due.blade.php ENDPATH**/ ?>