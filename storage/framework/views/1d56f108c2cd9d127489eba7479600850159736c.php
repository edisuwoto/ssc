
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.view'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.student_details'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="<?php echo e(url('parentregistration/student-list')); ?>"><?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.registration'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.student_details'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20"><?php echo app('translator')->get('lang.student_details'); ?></h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?>
                                    </div>
                                
                                    <div class="value">
                                        <?php echo e($student_detail->first_name.' '.$student_detail->last_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.class'); ?>
                                    </div>
                                    <div class="value">
                                        
                                            <?php echo e(@$student_detail->class->class_name); ?>

                                           
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.section'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->section->section_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.gender'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e($student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                             <?php if(moduleStatusCheck('Saas') == TRUE): ?>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.school'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->school->school_name); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('lang.academic_year'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->academicYear->year); ?>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End Student Meta Information -->

                </div>

                <!-- Start Student Details -->
                <div class="col-lg-9 student-details up_admin_visitor">
                    

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head"><?php echo app('translator')->get('lang.personal'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>
                               

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.date_of_birth'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(!empty($student_detail->date_of_birth)? dateConvert($student_detail->date_of_birth):''); ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.age'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->age); ?> <?php echo app('translator')->get('lang.year'); ?>
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
                                                <?php echo e($student_detail->student_email); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.mobile'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->student_mobile); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <h4 class="stu-sub-head mt-20"><?php echo app('translator')->get('lang.guardian'); ?> <?php echo app('translator')->get('lang.info'); ?></h4>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.name'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->guardian_name); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.mobile'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->guardian_mobile); ?>

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
                                                <?php echo e($student_detail->guardian_email); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.relation'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                               <?php if($student_detail->guardian_relation == 'F'): ?>
                                               <?php echo e('Father'); ?>

                                               <?php elseif($student_detail->guardian_relation == 'M'): ?>
                                               <?php echo e('Mother'); ?>

                                               <?php else: ?>
                                               <?php echo e('Other'); ?>

                                               <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lang.how_do_you_know_us'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->how_do_know_us); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- End Profile Tab -->
                        <!-- delete document modal -->

                        <!-- delete document modal -->
                    </div>
                </div>
                <!-- End Student Details -->
            </div>


        </div>
    </section>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/modules/parentregistration/student_view.blade.php ENDPATH**/ ?>