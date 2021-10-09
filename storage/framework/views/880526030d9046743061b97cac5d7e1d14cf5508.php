
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.details'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?> 
<?php
        function showTimelineDocName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
        function showDocumentName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
    ?> 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.human_resource'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href=""><?php echo app('translator')->get('lang.human_resource'); ?></a>
                <a href="<?php echo e(route('staff_directory')); ?>"><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.details'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <?php if(session()->has('message-success')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message-success')); ?>

    </div>
    <?php elseif(session()->has('message-danger')): ?>
    <div class="alert alert-danger">
        <?php echo e(session()->get('message-danger')); ?>

    </div>
    <?php endif; ?>
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3 mb-30">
            <!-- Start Student Meta Information -->
            <div class="main-title">
                <h3 class="mb-20"><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.details'); ?></h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>

                
                <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$staffDetails->staff_photo) ? asset($staffDetails->staff_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>"  alt="">
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                <?php echo app('translator')->get('lang.staff_name'); ?>
                            </div>
                            <div class="value">

                                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->full_name); ?><?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                <?php echo app('translator')->get('lang.role'); ?> 
                            </div>
                            <div class="value">
                               <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->roles->name); ?><?php endif; ?>
                           </div>
                       </div>
                   </div>
                   <div class="single-meta">
                    <div class="d-flex justify-content-between">
                        <div class="name">
                            <?php echo app('translator')->get('lang.designation'); ?>
                        </div>
                        <div class="value">
                           <?php if(isset($staffDetails)): ?><?php echo e(!empty($staffDetails->designations)?$staffDetails->designations->title:''); ?><?php endif; ?>
                            
                       </div>
                   </div>
               </div>
               <div class="single-meta">
                <div class="d-flex justify-content-between">
                    <div class="name">
                        <?php echo app('translator')->get('lang.department'); ?>
                    </div>
                    <div class="value">
                        
                           <?php if(isset($staffDetails)): ?><?php echo e(!empty($staffDetails->departments)?$staffDetails->departments->name:''); ?><?php endif; ?> 

                    </div>
                </div>
            </div>
            <div class="single-meta">
                <div class="d-flex justify-content-between">
                    <div class="name">
                        <?php echo app('translator')->get('lang.epf_no'); ?>
                    </div>
                    <div class="value">
                       <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->epf_no); ?><?php endif; ?>
                   </div>
               </div>
           </div>
           <div class="single-meta">
            <div class="d-flex justify-content-between">
                <div class="name">
                    <?php echo app('translator')->get('lang.basic_salary'); ?>
                </div>
                <div class="value">
                    (<?php echo e(generalSetting()->currency_symbol); ?>) <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->basic_salary); ?><?php endif; ?>
                </div>
            </div>
        </div>
        <div class="single-meta">
            <div class="d-flex justify-content-between">
                <div class="name">
                    <?php echo app('translator')->get('lang.contract_type'); ?>
                </div>
                <div class="value">
                   <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->contract_type); ?><?php endif; ?>
               </div>
           </div>
       </div>
       <div class="single-meta">
        <div class="d-flex justify-content-between">
            <div class="name">
                <?php echo app('translator')->get('lang.date_of_joining'); ?>
            </div>
            <div class="value">
                <?php if(isset($staffDetails)): ?>
                    <?php echo e($staffDetails->date_of_joining != ""? dateConvert($staffDetails->date_of_joining):''); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Student Meta Information -->

</div>

<!-- Start Student Details -->
<div class="col-lg-9 staff-details">
    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php if(Session::get('staffDocuments') != 'active' && Session::get('staffTimeline') != 'active'): ?> active <?php endif; ?>" href="#studentProfile" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.profile'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#payroll" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.payroll'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#leaves" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.leave'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Session::get('staffDocuments') == 'active'? 'active':''); ?>" href="#staffDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.documents'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Session::get('staffTimeline') == 'active'? 'active':''); ?>" href="#staffTimeline" role="tab" data-toggle="tab"><?php echo app('translator')->get('lang.timeline'); ?></a>
        </li>
        <li class="nav-item edit-button d-flex align-items-center justify-content-end">
            <a href="<?php echo e(route('editStaff',$staffDetails->id)); ?>" class="primary-btn small fix-gr-bg"><?php echo app('translator')->get('lang.edit'); ?>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Start Profile Tab -->
        <div role="tabpanel" class="tab-pane fade <?php if(Session::get('staffDocuments') != 'active' && Session::get('staffTimeline') != 'active'): ?> show active <?php endif; ?>" id="studentProfile">
            <div class="white-box">
                <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                                <?php echo app('translator')->get('lang.mobile'); ?> <?php echo app('translator')->get('lang.no'); ?>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="">
                                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->mobile); ?><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="">
                               <?php echo app('translator')->get('lang.emergency_mobile'); ?>
                           </div>
                       </div>
                       <div class="col-lg-7 col-md-7">
                        <div class="">
                         <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->emergency_mobile); ?><?php endif; ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        <?php echo app('translator')->get('lang.email'); ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="">
                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->email); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
         <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        <?php echo app('translator')->get('lang.driving_license'); ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="">
                        <?php if(isset($staffDetails)): ?><?php echo e(@$staffDetails->driving_license); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        <?php echo app('translator')->get('lang.gender'); ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="">
                        <?php if(isset($staffDetails)): ?> <?php echo e(@$staffDetails->genders->base_setup_name); ?> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        <?php echo app('translator')->get('lang.date_of_birth'); ?>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="">
                        <?php if(isset($staffDetails)): ?>
                            <?php echo e($staffDetails->date_of_birth != ""? dateConvert($staffDetails->date_of_birth):''); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                       <?php echo app('translator')->get('lang.marital_status'); ?>
                   </div>
               </div>
               <div class="col-lg-7 col-md-7">
                <div class="">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->marital_status); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    <?php echo app('translator')->get('lang.father_name'); ?>
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->fathers_name); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    <?php echo app('translator')->get('lang.mother_name'); ?>
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->mothers_name); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    <?php echo app('translator')->get('lang.qualifications'); ?>
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->qualification); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                   <?php echo app('translator')->get('lang.work_experience'); ?>
               </div>
           </div>

           <div class="col-lg-7 col-md-7">
            <div class="">
                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->experience); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Start Parent Part -->
<h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.address'); ?></h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.current_address'); ?>
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->current_address); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
             <?php echo app('translator')->get('lang.permanent_address'); ?>
         </div>
     </div>

     <div class="col-lg-7 col-md-6">
        <div class="">
            <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->permanent_address); ?><?php endif; ?>
        </div>
    </div>
</div>
</div>
<!-- End Parent Part -->

<!-- Start Transport Part -->
<h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.details'); ?></h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.account_name'); ?>
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->bank_account_name); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.bank_account_number'); ?>
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->bank_account_no); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.bank_name'); ?>
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->bank_name); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
               <?php echo app('translator')->get('lang.branch_name'); ?>
           </div>
       </div>

       <div class="col-lg-7 col-md-6">
        <div class="">
            <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->bank_brach); ?><?php endif; ?>
        </div>
    </div>
</div>
</div>


<!-- End Transport Part -->

<!-- Start Other Information Part -->
<h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('lang.social_links_details'); ?></h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.facebook_url'); ?>
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <div class="">
                <a href="<?php echo e($staffDetails->facebook_url); ?>" target="_blank">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->facebook_url); ?><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.twitter_url'); ?>
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <div class="">
                <a href="<?php echo e($staffDetails->twiteer_url); ?>" target="_blank">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->twiteer_url); ?><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.linkedin_url'); ?>
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <div class="">
                <a href="<?php echo e($staffDetails->linkedin_url); ?>" target="_blank">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->linkedin_url); ?><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                <?php echo app('translator')->get('lang.instragram_url'); ?>
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                <a href="<?php echo e($staffDetails->instragram_url); ?>" target="_blank">
                    <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->instragram_url); ?><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Other Information Part -->

    <?php echo $__env->make('backEnd.customField._coutom_field_show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</div>
</div>
<!-- End Profile Tab -->

<!-- Start payroll Tab -->
<div role="tabpanel" class="tab-pane fade" id="payroll">
    <div class="white-box">
        <table id="" class="table simple-table table-responsive school-table"
        cellspacing="0">
        <thead>
            <tr>
                <th width="5%"><?php echo app('translator')->get('lang.payslip'); ?> <?php echo app('translator')->get('lang.id'); ?></th>
                <th width="20%"><?php echo app('translator')->get('lang.month'); ?>-<?php echo app('translator')->get('lang.year'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.date'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.mode_of_payment'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.net_salary'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                <th width="12%"><?php echo app('translator')->get('lang.status'); ?></th>
                <th width="20%"><?php echo app('translator')->get('lang.action'); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php if(count($staffPayrollDetails)>0): ?>
            <?php $__currentLoopData = $staffPayrollDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->id); ?></td>
                <td><?php echo e($value->payroll_month); ?> - <?php echo e($value->payroll_year); ?></td>
                <td>
                    
<?php echo e($value->created_at != ""? dateConvert($value->created_at):''); ?>


                </td>
                <td><?php $payment_mode = ''; 
                    if(!empty($value->payment_mode)){
                        $payment_mode = App\SmHrPayrollGenerate::getPaymentMode($value->payment_mode);
                    }else{
                        $payment_mode = '';
                    }
                    ?>
                    <?php echo e($payment_mode); ?>

                </td>
                <td><?php echo e($value->net_salary); ?></td>
                <td>
                    <?php if($value->payroll_status == 'G'): ?>
                    <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('lang.generated'); ?></button>
                    <?php endif; ?>

                    <?php if($value->payroll_status == 'P'): ?>
                    <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('lang.paid'); ?> </button>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($value->payroll_status == 'P'): ?>
                    <a class="modalLink" data-modal-size="modal-lg" title="<?php echo app('translator')->get('lang.view_payslip'); ?> <?php echo app('translator')->get('lang.details'); ?>" href="<?php echo e(route('view-payslip', $value->id)); ?>"><button class="primary-btn small tr-bg"> <?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.payslip'); ?></button></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr class="justify-content-center">
                <td colspan="7" class="justify-content-center text-center"><?php echo app('translator')->get('lang.no_payroll_data'); ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
<!-- End payroll Tab -->

<!-- Start leave Tab -->
<div role="tabpanel" class="tab-pane fade" id="leaves">
    <div class="white-box">
        <div class="row mt-30">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang.leave_type'); ?></th>
                            <th><?php echo app('translator')->get('lang.leave_from'); ?> </th>
                            <th><?php echo app('translator')->get('lang.leave_to'); ?></th>
                            <th><?php echo app('translator')->get('lang.apply_date'); ?></th>
                            <th><?php echo app('translator')->get('lang.status'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $diff = ''; ?>
                       <?php if(count($staffLeaveDetails)>0): ?>
                       <?php $__currentLoopData = $staffLeaveDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <tr>
                        <td><?php echo e(@$value->leaveDefine->leaveType->type); ?></td>
                        <td>
                            
<?php echo e($value->leave_from != ""? dateConvert($value->leave_from):''); ?>



                        </td>
                        <td>
                           
<?php echo e($value->leave_to != ""? dateConvert($value->leave_to):''); ?>


                        </td>
                        <td>
                            
<?php echo e($value->apply_date != ""? dateConvert($value->apply_date):''); ?>


                        </td>
                        <td>

                            <?php if($value->approve_status == 'P'): ?>
                            <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('lang.pending'); ?></button>
                            <?php endif; ?>

                            <?php if($value->approve_status == 'A'): ?>
                            <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('lang.approved'); ?></button>
                            <?php endif; ?>

                            <?php if($value->approve_status == 'C'): ?>
                            <button class="primary-btn small bg-danger text-white border-0"> <?php echo app('translator')->get('lang.cancelled'); ?></button>
                            <?php endif; ?>

                        </td>
                        <td>
                            <a class="modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.leave'); ?> <?php echo app('translator')->get('lang.details'); ?>" href="<?php echo e(url('view-leave-details-apply', $value->id)); ?>"><button class="primary-btn small tr-bg"> <?php echo app('translator')->get('lang.view'); ?> </button></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo app('translator')->get('lang.not_leaves_data'); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endif; ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- End leave Tab -->

<!-- Start Documents Tab -->
<div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('staffDocuments') == 'active'? 'show active':''); ?>" id="staffDocuments">
    <div class="white-box">
        <div class="text-right mb-20">
            <button type="button" data-toggle="modal" data-target="#add_document_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                                    <?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.document'); ?>
                                    <span class="pl ti-upload"></span>
                                </button>
        </div>
        <table id="" class="table simple-table table-responsive school-table"
        cellspacing="0">
            <thead class="d-block">
                <tr class="d-flex">
                    <th class="col-7"><?php echo app('translator')->get('lang.document'); ?> <?php echo app('translator')->get('lang.title'); ?></th>
                    <th class="col-5"><?php echo app('translator')->get('lang.action'); ?></th>
                </tr>
            </thead>
            <tbody class="d-block">
                <?php if($staffDetails->joining_letter != ''): ?>
                <tr class="d-flex">
                    <td class="col-7"><?php echo app('translator')->get('lang.joining_letter'); ?></td>
                    <td class="col-5 d-flex align-itemd-center">
                        <a href="<?php echo e(url($staffDetails->joining_letter)); ?>" download>
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                <?php echo app('translator')->get('lang.download'); ?>
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                        <a class="primary-btn icon-only fix-gr-bg ml-2" onclick="deleteStaffDoc(<?php echo e($staffDetails->id); ?>,1)"  data-id="1"  href="#">
                            <span class="ti-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if($staffDetails->resume != ''): ?>
                <tr class="d-flex">
                    <td class="col-7"><?php echo app('translator')->get('lang.resume'); ?></td>
                    <td class="col-5 d-flex align-itemd-center">
                        <a href="<?php echo e(url($staffDetails->resume)); ?>" download>
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                <?php echo app('translator')->get('lang.download'); ?>
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                        <a class="primary-btn icon-only fix-gr-bg ml-2" onclick="deleteStaffDoc(<?php echo e($staffDetails->id); ?>,2)"  data-id="2"  href="#">
                            <span class="ti-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if($staffDetails->other_document != ''): ?>
                <tr class="d-flex">
                    <td class="col-7"><?php echo app('translator')->get('lang.other_documents'); ?></td>
                    <td class="col-5 d-flex align-itemd-center">
                        <a href="<?php echo e(url($staffDetails->other_document)); ?>" download>
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                <?php echo app('translator')->get('lang.download'); ?>
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                        <a class="primary-btn icon-only fix-gr-bg ml-2" onclick="deleteStaffDoc(<?php echo e($staffDetails->id); ?>,3)"  data-id="3"  href="#">
                            <span class="ti-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if(isset($staffDocumentsDetails)): ?>
                <?php $__currentLoopData = $staffDocumentsDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="d-flex">
                    <td class="col-7"><?php echo e($value->title); ?></td>
                    <td class="col-5 d-flex align-itemd-center">
                        <a class="primary-btn tr-bg text-uppercase bord-rad" href="<?php echo e(url($value->file)); ?>" download>
                            <?php echo app('translator')->get('lang.download'); ?>
                                <span class="pl ti-download"></span>
                        </a>
                        <a class="primary-btn icon-only fix-gr-bg modalLink ml-2" title="Delete Document" data-modal-size="modal-md"  href="<?php echo e(route('delete-staff-document-view',$value->student_staff_id)); ?>">
                            <span class="ti-trash pt-30"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- End Documents Tab -->


<div class="modal fade admin-query" id="delete-staff-doc" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <form action="<?php echo e(route('staff-document-delete')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="staff_id" >
                        <input type="hidden" name="doc_id">
                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                        <button type="submit" class="primary-btn fix-gr-bg"><?php echo app('translator')->get('lang.delete'); ?></button>
                        
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Add Document modal form start-->
    <div class="modal fade admin-query" id="add_document_madal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.document'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                   <div class="container-fluid">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'save_upload_document',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                            <div class="row">
                                <div class="col-lg-12">
                                <input type="hidden" name="staff_id" value="<?php echo e($staffDetails->id); ?>">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="title" id="title" required>
                                                <label><?php echo app('translator')->get('lang.title'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>

                                                <span class=" text-danger" role="alert" id="amount_error">

                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-30">
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text"
                                                       placeholder="<?php echo app('translator')->get('lang.new_document'); ?>*"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="browseFile"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" id="browseFile" name="staff_upload_document" required>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                    <!-- <div class="col-lg-12 text-center mt-40">
                                        <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                            <span class="ti-check"></span>
                                            save information
                                        </button>
                                    </div> -->
                                    <div class="col-lg-12 text-center mt-40">
                                        <div class="mt-40 d-flex justify-content-between">
                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>

                                            <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                              
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Add Document modal form end-->

<!-- Start Timeline Tab -->
            <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('staffTimeline') == 'active'? 'show active':''); ?>" id="staffTimeline">
                <div class="white-box">
                    <div class="text-right mb-20">
                    <button type="button" data-toggle="modal" data-target="#add_timeline_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                        <?php echo app('translator')->get('lang.add'); ?>
                        <span class="pl ti-plus"></span>
                    </button>
                    </div>
                    <?php if(isset($timelines)): ?>
                    <?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="student-activities">
                        <div class="single-activity">
                            <h4 class="title text-uppercase">
                                <?php echo e($timeline->date != ""? dateConvert($timeline->date):''); ?>

                            </h4>
                            <div class="sub-activity-box d-flex">
                                <h6 class="time text-uppercase"><?php echo e(date('h:i a', strtotime($timeline->created_at))); ?></h6>
                                <div class="sub-activity">
                                    <h5 class="subtitle text-uppercase"> <?php echo e($timeline->title); ?></h5>
                                    <p>
                                        <?php echo e($timeline->description); ?>

                                    </p>
                                </div>
                                <div class="close-activity">
                                    <a class="primary-btn icon-only fix-gr-bg modalLink" title="Delete Timeline" data-modal-size="modal-md"  href="<?php echo e(route('delete-staff-timeline-view',$timeline->id)); ?>">
                                        <span class="ti-trash"></span>
                                    </a>
                                    <?php if($timeline->file != ""): ?>
                                    <a href="<?php echo e(url($timeline->file)); ?>" class="primary-btn tr-bg text-uppercase bord-rad" download> 
                                        <?php echo app('translator')->get('lang.download'); ?>
                                        <span class="pl ti-download"></span>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                          </div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php endif; ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- End Timeline Tab -->
         <!-- timeline form modal start-->
        <div class="modal fade admin-query" id="add_timeline_madal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.timeline'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                       <div class="container-fluid">
                                                
                             <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staff_timeline_store',
                             'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                             <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="staff_student_id" value="<?php echo e($staffDetails->id); ?>">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title" required>
                                                <span class="focus-border"></span>
                                                <label><?php echo app('translator')->get('lang.title'); ?> <span>*</span> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                name="date" autocomplete="off" value="<?php echo e(date('m/d/Y')); ?>" required>
                                                <span class="focus-border"></span>
                                                <label><?php echo app('translator')->get('lang.date'); ?> <span>*</span> </label>
                                                <?php if($errors->has('date_of_birth')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description" required></textarea>
                                        <label><?php echo app('translator')->get('lang.description'); ?> <span>*</span> </label>
                                        <span class="focus-border textarea"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-30">
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderFileFourName" type="text"
                                                       placeholder="<?php echo app('translator')->get('lang.document'); ?>"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="document_file_4"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                <input type="file" class="d-none" id="document_file_4" name="document_file_4">
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-30">

                                    <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
                                    <label for="currentAddressCheck"><?php echo app('translator')->get('lang.visible_to_this_person'); ?></label>
                                </div>


                                <!-- <div class="col-lg-12 text-center mt-40">
                                    <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                        <span class="ti-check"></span>
                                        save information
                                    </button>
                                </div> -->
                                <div class="col-lg-12 text-center mt-40">
                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>

                                        <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('lang.save'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
<!-- timeline form modal end-->
    </div>
</div>
</section>
<script>
    function deleteStaffDoc(id,doc){
        // alert(doc);
        var modal = $('#delete-staff-doc');
         modal.find('input[name=staff_id]').val(id)
         modal.find('input[name=doc_id]').val(doc)
         modal.modal('show');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/humanResource/viewStaff.blade.php ENDPATH**/ ?>