<?php
$school_config = schoolConfig();
$isSchoolAdmin = Session::get('isSchoolAdmin');
?>
<nav id="sidebar">
    <div class="sidebar-header update_sidebar">
        <a href="<?php echo e(url('/')); ?>">
            <?php if(! is_null($school_config->logo)): ?>
                <img src="<?php echo e(asset($school_config->logo)); ?>" alt="logo">
            <?php else: ?>
                <img src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="logo">
            <?php endif; ?>
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    <?php if(Auth::user()->is_saas == 0): ?>
        <ul class="list-unstyled components" id="sidebar_menu">
            <input type="hidden" name="" id="default_position" value="<?php echo e(menuPosition('is_submit')); ?>">
            <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>
                <?php if(userPermission(1)): ?>
                    <li>
                        <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1): ?>
                            <a href="<?php echo e(route('superadmin-dashboard')); ?>" id="superadmin-dashboard">
                        <?php else: ?>
                            <a href="<?php echo e(route('admin-dashboard')); ?>" id="admin-dashboard">
                        <?php endif; ?>
                            <span class="flaticon-speedometer"></span><?php echo app('translator')->get('lang.dashboard'); ?>
                            </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li data-position="<?php echo e(menuPosition(101)); ?>" class="sortable_li">
                            <a href="#subMenuFeeder" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-test"></span>
                                Feeder
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuFeeder">
                                <?php if(userPermission(102)  && menuStatus(102)): ?>
                                    <li data-position="<?php echo e(menuPosition(102)); ?>" >
                                        <a href="#">EMIS</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(103)  && menuStatus(103)): ?>
                                    <li> <a href="#">PDDIKTI</a> </li>
                                <?php endif; ?>
                            </ul>
                        </li>
            
                    <?php if(userPermission(991) &&  menuStatus(991)): ?>
                        <li data-position="<?php echo e(menuPosition(22)); ?>" class="sortable_li">
                            <a href="#subMenuMaster" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-professor"></span>
                                <?php echo app('translator')->get('lang.master'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuMaster">
                                <?php if(userPermission(991)  && menuStatus(991)): ?>
                                    <li data-position="<?php echo e(menuPosition(991)); ?>" >
                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('lang.academic_year'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(991)  && menuStatus(991)): ?>
                                    <li> <a href="<?php echo e(route('base_group')); ?>"><?php echo app('translator')->get('lang.base_group'); ?></a> </li>
                                <?php endif; ?>
                                <?php if(userPermission(991) && menuStatus(991) ): ?>
                                    <li  data-position="<?php echo e(menuPosition(428)); ?>">
                                        <a href="<?php echo e(route('base_setup')); ?>"><?php echo app('translator')->get('lang.base_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

            <?php if(moduleStatusCheck('InfixBiometrics')== TRUE && Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('infixbiometrics::menu.InfixBiometrics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            

            <?php if(moduleStatusCheck('ParentRegistration')== TRUE): ?>
             <?php echo $__env->make('parentregistration::menu.ParentRegistration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            
            <?php if(moduleStatusCheck('SaasSubscription')== TRUE && Auth::user()->is_administrator != "yes"): ?>
                <?php echo $__env->make('saassubscription::menu.SaasSubscriptionSchool', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            
            <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator =="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1 ): ?>
                <?php echo $__env->make('saas::menu.Saas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>

            <!--<?php echo $__env->make('menumanage::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->
            <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>

                    
                    <?php if(userPermission(160) && menuStatus(160)): ?>
                        <li data-position="<?php echo e(menuPosition(22)); ?>" class="sortable_li">
                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-consultation"></span>
                                <?php echo app('translator')->get('lang.human_resource'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHumanResource">
                                <?php if(userPermission(161) && menuStatus(161)): ?>
                                    <li data-position="<?php echo e(menuPosition(161)); ?>">
                                        <a href="<?php echo e(route('department')); ?>"> <?php echo app('translator')->get('lang.department'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(162) && menuStatus(162)): ?>
                                    <li data-position="<?php echo e(menuPosition(162)); ?>" >
                                        <a href="<?php echo e(route('designation')); ?>"> Bagian</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(163) && menuStatus(163)): ?>
                                    <li data-position="<?php echo e(menuPosition(163)); ?>">
                                        <a href="<?php echo e(route('staff_directory')); ?>"> <?php echo app('translator')->get('lang.staff_directory'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(164) && menuStatus(164)): ?>
                                    <li data-position="<?php echo e(menuPosition(164)); ?>">
                                        <a href="<?php echo e(route('staff_attendance')); ?>"> <?php echo app('translator')->get('lang.staff_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(166) && menuStatus(166)): ?>
                                    <li data-position="<?php echo e(menuPosition(166)); ?>">
                                        <a href="<?php echo e(route('payroll')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(167) && menuStatus(167)): ?>
                                    <li data-position="<?php echo e(menuPosition(167)); ?>">
                                        <a href="#">BKD</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(168) && menuStatus(168)): ?>
                                    <li data-position="<?php echo e(menuPosition(168)); ?>">
                                        <a href="#">Laporan Kinerja</a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(169) && menuStatus(169)): ?>
                                    <li data-position="<?php echo e(menuPosition(169)); ?>">
                                        <a href="#">Penilaian Prestasi</a>
                                    </li>
                                <?php endif; ?>
                                <!--<?php if(userPermission(162) && menuStatus(162)): ?>
                                    <li data-position="<?php echo e(menuPosition(162)); ?>">
                                        <a href="<?php echo e(route('addStaff')); ?>"> <?php echo app('translator')->get('lang.add'); ?>  <?php echo app('translator')->get('lang.staff'); ?> </a>
                                    </li>
                                <?php endif; ?>-->
                                <!--
                                
                                <?php if(userPermission(169) && menuStatus(169)): ?>
                                    <li data-position="<?php echo e(menuPosition(169)); ?>">
                                        <a href="<?php echo e(route('staff_attendance_report')); ?>"> <?php echo app('translator')->get('lang.staff_attendance_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(178) && menuStatus(178)): ?>
                                    <li data-position="<?php echo e(menuPosition(178)); ?>">
                                        <a href="<?php echo e(route('payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                -->
                                
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    
                    <?php if(userPermission(33) && menuStatus(33)): ?>
                        <li data-position="<?php echo e(menuPosition(33)); ?>" class="sortable_li">
                            <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-slumber"></span>
                                <?php echo app('translator')->get('lang.leave'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                                <?php if(userPermission(203) && menuStatus(203)): ?>
                                    <li data-position="<?php echo e(menuPosition(203)); ?>" >
                                        <a href="<?php echo e(route('leave-type')); ?>"> <?php echo app('translator')->get('lang.leave_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(199) && menuStatus(199)): ?>
                                    <li data-position="<?php echo e(menuPosition(199)); ?>" >
                                        <a href="<?php echo e(route('leave-define')); ?>"> <?php echo app('translator')->get('lang.leave_define'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(189) && menuStatus(189)): ?>
                                    <li data-position="<?php echo e(menuPosition(189)); ?>" >
                                        <a href="<?php echo e(route('approve-leave')); ?>"><?php echo app('translator')->get('lang.approve_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(196) && menuStatus(196)): ?>
                                    <li data-position="<?php echo e(menuPosition(196)); ?>" >
                                        <a href="<?php echo e(route('pending-leave')); ?>"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id!=1): ?>

                                    <?php if(userPermission(193) && menuStatus(193)): ?>
                                        <li data-position="<?php echo e(menuPosition(193)); ?>" >
                                            <a href="<?php echo e(route('apply-leave')); ?>"><?php echo app('translator')->get('lang.apply_leave'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(44)  && menuStatus(44)): ?>
                        <li data-position="<?php echo e(menuPosition(44)); ?>"  class="sortable_li">
                            <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-book"></span>
                                <?php echo app('translator')->get('lang.academics'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAcademic">
                                <?php if(userPermission(537) && menuStatus(537)): ?>
                                    <li data-position="<?php echo e(menuPosition(537)); ?>" >
                                        <a href="<?php echo e(route('optional-subject')); ?>"> <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(265) && menuStatus(265)): ?>
                                    <li data-position="<?php echo e(menuPosition(265)); ?>" >
                                        <a href="<?php echo e(route('section')); ?>"> <?php echo app('translator')->get('lang.section'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(261) && menuStatus(261)): ?>
                                    <li data-position="<?php echo e(menuPosition(261)); ?>" >
                                        <a href="<?php echo e(route('class')); ?>"> <?php echo app('translator')->get('lang.class'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(257) && menuStatus(257)): ?>
                                    <li data-position="<?php echo e(menuPosition(257)); ?>" >
                                        <a href="<?php echo e(route('subject')); ?>"> <?php echo app('translator')->get('lang.subjects'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(253) && menuStatus(253)): ?>
                                    <li data-position="<?php echo e(menuPosition(253)); ?>" >
                                        <a href="<?php echo e(route('assign-class-teacher')); ?>"> <?php echo app('translator')->get('lang.assign_class_teacher'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(250) && menuStatus(250)): ?>
                                    <li data-position="<?php echo e(menuPosition(250)); ?>" >
                                        <a href="<?php echo e(route('assign_subject')); ?>"> <?php echo app('translator')->get('lang.assign_subject'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(269) && menuStatus(269)): ?>
                                    <li data-position="<?php echo e(menuPosition(269)); ?>" >
                                        <a href="<?php echo e(route('class-room')); ?>"> <?php echo app('translator')->get('lang.class_room'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(273) && menuStatus(273)): ?>
                                    <li data-position="<?php echo e(menuPosition(273)); ?>" >
                                        <a href="<?php echo e(route('class-time')); ?>"> <?php echo app('translator')->get('lang.class_time_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(246) && menuStatus(246)): ?>
                                    <li data-position="<?php echo e(menuPosition(246)); ?>" >
                                        <a href="<?php echo e(route('class_routine_new')); ?>"> <?php echo app('translator')->get('lang.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                            <!-- only for teacher -->
                                <?php if(Auth::user()->role_id == 4): ?>
                                    <li>
                                        <a href="<?php echo e(route('view-teacher-routine')); ?>"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(55) && menuStatus(55)): ?>
                        <li data-position="<?php echo e(menuPosition(55)); ?>" class="sortable_li">
                            <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-accounting"></span>
                                <?php echo app('translator')->get('lang.accounts'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAccount">
                                <?php if(userPermission(148) && menuStatus(148)): ?>
                                    <li data-position="<?php echo e(menuPosition(148)); ?>" >
                                        <a href="<?php echo e(route('chart-of-account')); ?>"> <?php echo app('translator')->get('lang.chart_of_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(156) && menuStatus(156)): ?>
                                    <li data-position="<?php echo e(menuPosition(156)); ?>" >
                                        <a href="<?php echo e(route('bank-account')); ?>"> <?php echo app('translator')->get('lang.bank_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(139) && menuStatus(139)): ?>
                                    <li data-position="<?php echo e(menuPosition(139)); ?>" >
                                        <a href="<?php echo e(route('add_income')); ?>"> <?php echo app('translator')->get('lang.income'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(138) && menuStatus(138)): ?>
                                    <li data-position="<?php echo e(menuPosition(138)); ?>" >
                                        <a href="<?php echo e(route('profit')); ?>"> <?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(143) && menuStatus(143)): ?>
                                    <li data-position="<?php echo e(menuPosition(143)); ?>" >
                                        <a href="<?php echo e(route('add-expense')); ?>"> <?php echo app('translator')->get('lang.expense'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(704) && menuStatus(704)): ?>
                                    <li data-position="<?php echo e(menuPosition(704)); ?>" >
                                        <a href="<?php echo e(route('fund-transfer')); ?>"><?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(700) && menuStatus(700)): ?>
                                    <li data-position="<?php echo e(menuPosition(700)); ?>">
                                        <a href="#subMenuAccountReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            <?php echo app('translator')->get('lang.report'); ?>
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuAccountReport">
                                            <?php if(userPermission(701) && menuStatus(701)): ?>
                                                <li >
                                                    <a href="<?php echo e(route('fine-report')); ?>"> <?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(702) && menuStatus(702)): ?>
                                                <li >
                                                    <a href="<?php echo e(route('accounts-payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(703) && menuStatus(703)): ?>
                                                <li >
                                                    <a href="<?php echo e(route('transaction')); ?>"> <?php echo app('translator')->get('lang.transaction'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(66) && menuStatus(66)): ?>
                        <li data-position="<?php echo e(menuPosition(66)); ?>" class="sortable_li">
                            <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-test"></span>
                                <?php echo app('translator')->get('lang.examination'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuExam">
                                <?php if(userPermission(225) && menuStatus(225)): ?>
                                    <li  data-position="<?php echo e(menuPosition(225)); ?>" >
                                        <a href="<?php echo e(route('marks-grade')); ?>"> <?php echo app('translator')->get('lang.marks_grade'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(571) && menuStatus(571)): ?>
                                    <li  data-position="<?php echo e(menuPosition(571)); ?>" >
                                        <a href="<?php echo e(route('exam-time')); ?>"> <?php echo app('translator')->get('lang.exam_time'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(208) && menuStatus(208)): ?>
                                    <li  data-position="<?php echo e(menuPosition(208)); ?>" >
                                        <a href="<?php echo e(route('exam-type')); ?>"> <?php echo app('translator')->get('lang.exam_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(214) && menuStatus(214)): ?>
                                    <li  data-position="<?php echo e(menuPosition(214)); ?>" >
                                        <a href="<?php echo e(route('exam')); ?>"> <?php echo app('translator')->get('lang.exam_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(217) && menuStatus(217)): ?>
                                    <li  data-position="<?php echo e(menuPosition(217)); ?>" >
                                        <a href="<?php echo e(route('exam_schedule')); ?>"> <?php echo app('translator')->get('lang.exam_schedule'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(221) && menuStatus(221)): ?>
                                    <li  data-position="<?php echo e(menuPosition(221)); ?>" >
                                        <a href="<?php echo e(route('exam_attendance')); ?>"> <?php echo app('translator')->get('lang.exam_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(222) && menuStatus(222)): ?>
                                    <li  data-position="<?php echo e(menuPosition(222)); ?>" >
                                        <a href="<?php echo e(route('marks_register')); ?>"> <?php echo app('translator')->get('lang.marks_register'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(229) && menuStatus(229)): ?>
                                    <li  data-position="<?php echo e(menuPosition(229)); ?>" >
                                        <a href="<?php echo e(route('send_marks_by_sms')); ?>"> <?php echo app('translator')->get('lang.send_marks_by_sms'); ?></a>
                                    </li>
                                <?php endif; ?>
                                

                                <li>
                                    <a href="#examSettings" data-toggle="collapse" aria-expanded="false"
                                       class="dropdown-toggle">
                                        <?php echo app('translator')->get('lang.settings'); ?>
                                    </a>
                                    <ul class="collapse list-unstyled" id="examSettings">
                                        <?php if(userPermission(436) && menuStatus(436)): ?>
                                            <li  data-position="<?php echo e(menuPosition(436)); ?>">
                                                <a href="<?php echo e(route('custom-result-setting')); ?>"><?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(userPermission(706) && menuStatus(706)): ?>
                                            <li  data-position="<?php echo e(menuPosition(706)); ?>">
                                                <a href="<?php echo e(route('exam-settings')); ?>"><?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('OnlineExam')== true): ?>
                        <?php echo $__env->make('onlineexam::menu_onlineexam', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php if(userPermission(875) && menuStatus(875)): ?>
                            <li data-position="<?php echo e(menuPosition(91)); ?>" class="sortable_li">
                                <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <span class="flaticon-book-1"></span>
                                    <?php echo app('translator')->get('lang.online_exam'); ?>
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuOnlineExam">
                                    <?php if(userPermission(230) && menuStatus(230)): ?>
                                        <li  data-position="<?php echo e(menuPosition(230)); ?>">
                                            <a href="<?php echo e(route('question-group')); ?>"><?php echo app('translator')->get('lang.question_group'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(234) && menuStatus(234)): ?>
                                        <li  data-position="<?php echo e(menuPosition(234)); ?>">
                                            <a href="<?php echo e(route('question-bank')); ?>"><?php echo app('translator')->get('lang.question_bank'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(238) && menuStatus(238)): ?>
                                        <li  data-position="<?php echo e(menuPosition(238)); ?>">
                                            <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if(userPermission(298) && menuStatus(298)): ?>
                        <li data-position="<?php echo e(menuPosition(298)); ?>" class="sortable_li">
                            <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-book-1"></span>
                                <?php echo app('translator')->get('lang.library'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenulibrary">
                                <?php if(userPermission(304) && menuStatus(304)): ?>
                                    <li  data-position="<?php echo e(menuPosition(304)); ?>">
                                        <a href="<?php echo e(route('book-category-list')); ?>"> <?php echo app('translator')->get('lang.book_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(579) && menuStatus(579)): ?>
                                    <li  data-position="<?php echo e(menuPosition(529)); ?>">
                                        <a href="<?php echo e(route('library_subject')); ?>"> <?php echo app('translator')->get('lang.subject'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(299) && menuStatus(299)): ?>
                                    <li  data-position="<?php echo e(menuPosition(299)); ?>">
                                        <a href="<?php echo e(route('add-book')); ?>"> <?php echo app('translator')->get('lang.add_book'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(301) && menuStatus(301)): ?>
                                    <li  data-position="<?php echo e(menuPosition(301)); ?>">
                                        <a href="<?php echo e(route('book-list')); ?>"> <?php echo app('translator')->get('lang.book_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(308) && menuStatus(308)): ?>
                                    <li  data-position="<?php echo e(menuPosition(308)); ?>">
                                        <a href="<?php echo e(route('library-member')); ?>"> <?php echo app('translator')->get('lang.library_member'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(311) && menuStatus(311)): ?>
                                    <li  data-position="<?php echo e(menuPosition(311)); ?>">
                                        <a href="<?php echo e(route('member-list')); ?>"> <?php echo app('translator')->get('lang.member_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(314) && menuStatus(314)): ?>
                                    <li  data-position="<?php echo e(menuPosition(314)); ?>">
                                        <a href="<?php echo e(route('all-issed-book')); ?>"> <?php echo app('translator')->get('lang.all_issued_book'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(376) && menuStatus(376)): ?>
                        <li data-position="<?php echo e(menuPosition(376)); ?>" class="sortable_li">
                            <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-analysis"></span>
                                <?php echo app('translator')->get('lang.reports'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemReports">
                                <?php if(userPermission(538) && menuStatus(538)): ?>
                                    <li data-position="<?php echo e(menuPosition(538)); ?>" >
                                        <a href="<?php echo e(route('student_report')); ?>"><?php echo app('translator')->get('lang.student_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(377) && menuStatus(377)): ?>
                                    <li data-position="<?php echo e(menuPosition(377)); ?>" >
                                        <a href="<?php echo e(route('guardian_report')); ?>"><?php echo app('translator')->get('lang.guardian_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(378) && menuStatus(378)): ?>
                                    <li data-position="<?php echo e(menuPosition(378)); ?>" >
                                        <a href="<?php echo e(route('student_history')); ?>"><?php echo app('translator')->get('lang.student_history'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(379) && menuStatus(379)): ?>
                                    <li data-position="<?php echo e(menuPosition(379)); ?>" >
                                        <a href="<?php echo e(route('student_login_report')); ?>"><?php echo app('translator')->get('lang.student_login_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(381) && menuStatus(381)): ?>
                                    <li data-position="<?php echo e(menuPosition(381)); ?>" >
                                        <a href="<?php echo e(route('fees_statement')); ?>"><?php echo app('translator')->get('lang.fees_statement'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(382) && menuStatus(382)): ?>
                                    <li data-position="<?php echo e(menuPosition(382)); ?>" >
                                        <a href="<?php echo e(route('balance_fees_report')); ?>"><?php echo app('translator')->get('lang.balance_fees_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(384) && menuStatus(384)): ?>
                                    <li data-position="<?php echo e(menuPosition(384)); ?>" >
                                        <a href="<?php echo e(route('class_report')); ?>"><?php echo app('translator')->get('lang.class_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(385) && menuStatus(385)): ?>
                                    <li data-position="<?php echo e(menuPosition(385)); ?>" >
                                        <a href="<?php echo e(route('class_routine_report')); ?>"><?php echo app('translator')->get('lang.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(386) && menuStatus(386)): ?>
                                    <li data-position="<?php echo e(menuPosition(386)); ?>" >
                                        <a href="<?php echo e(route('exam_routine_report')); ?>"><?php echo app('translator')->get('lang.exam_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(387) && menuStatus(387)): ?>
                                    <li data-position="<?php echo e(menuPosition(387)); ?>" >
                                        <a href="<?php echo e(route('teacher_class_routine_report')); ?>"><?php echo app('translator')->get('lang.teacher'); ?> <?php echo app('translator')->get('lang.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(388) && menuStatus(388)): ?>
                                    <li data-position="<?php echo e(menuPosition(388)); ?>" >
                                        <a href="<?php echo e(route('merit_list_report')); ?>"><?php echo app('translator')->get('lang.merit_list_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(389) && menuStatus(389)): ?>
                                    <li data-position="<?php echo e(menuPosition(389)); ?>" >
                                        <a href="<?php echo e(route('online_exam_report')); ?>"><?php echo app('translator')->get('lang.online_exam_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(390) && menuStatus(390)): ?>
                                    <li data-position="<?php echo e(menuPosition(390)); ?>" >
                                        <a href="<?php echo e(route('mark_sheet_report_student')); ?>"><?php echo app('translator')->get('lang.mark_sheet_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(391) && menuStatus(391)): ?>
                                    <li data-position="<?php echo e(menuPosition(391)); ?>" >
                                        <a href="<?php echo e(route('tabulation_sheet_report')); ?>"><?php echo app('translator')->get('lang.tabulation_sheet_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(392) && menuStatus(392)): ?>
                                    <li data-position="<?php echo e(menuPosition(392)); ?>" >
                                        <a href="<?php echo e(route('progress_card_report')); ?>"><?php echo app('translator')->get('lang.progress_card_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php if(userPermission(394) && menuStatus(394)): ?>
                                    <li data-position="<?php echo e(menuPosition(394)); ?>" >
                                        <a href="<?php echo e(route('user_log')); ?>"><?php echo app('translator')->get('lang.user_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(539) && menuStatus(539)): ?>
                                    <li data-position="<?php echo e(menuPosition(539)); ?>" >
                                        <a href="<?php echo e(route('previous-class-results')); ?>"><?php echo app('translator')->get('lang.previous'); ?> <?php echo app('translator')->get('lang.result'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(540) && menuStatus(540)): ?>
                                    <li data-position="<?php echo e(menuPosition(540)); ?>" >
                                        <a href="<?php echo e(route('previous-record')); ?>"><?php echo app('translator')->get('lang.previous'); ?> <?php echo app('translator')->get('lang.record'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(Auth::user()->role_id == 1): ?>
                                    <?php if(moduleStatusCheck('ResultReports')== TRUE): ?>
                                        
                                        <li>
                                            <a href="<?php echo e(route('resultreports/cumulative-sheet-report')); ?>"><?php echo app('translator')->get('lang.cumulative'); ?> <?php echo app('translator')->get('lang.sheet'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/continuous-assessment-report')); ?>"><?php echo app('translator')->get('lang.contonuous'); ?> <?php echo app('translator')->get('lang.assessment'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/termly-academic-report')); ?>"><?php echo app('translator')->get('lang.termly'); ?> <?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/academic-performance-report')); ?>"><?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.performance'); ?> <?php echo app('translator')->get('lang.report'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/terminal-report-sheet')); ?>"><?php echo app('translator')->get('lang.terminal'); ?> <?php echo app('translator')->get('lang.report'); ?> <?php echo app('translator')->get('lang.sheet'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/continuous-assessment-sheet')); ?>"><?php echo app('translator')->get('lang.continuous'); ?> <?php echo app('translator')->get('lang.assessment'); ?> <?php echo app('translator')->get('lang.sheet'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/result-version-two')); ?>"><?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.version'); ?>
                                                V2</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/result-version-three')); ?>"><?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.version'); ?>
                                                V3
                                            </a>
                                        </li>
                                        
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(398) && menuStatus(398)): ?>
                        <li  data-position="<?php echo e(menuPosition(398)); ?>" class="sortable_li">
                            <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-settings"></span>
                                <?php echo app('translator')->get('lang.system_settings'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemSettings">
                                   
                                <?php if((moduleStatusCheck('Saas')== TRUE) && (auth()->user()->is_administrator=="yes")): ?>
                                    <li>
                                        <a href="<?php echo e(route('school-general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>
                                    </li>
                                <?php else: ?>
                                    <?php if(userPermission(405)  && menuStatus(405)): ?>

                                        <li data-position="<?php echo e(menuPosition(405)); ?>" >
                                            <a href="<?php echo e(route('general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php if(userPermission(424)  && menuStatus(424)): ?>
                                    <li data-position="<?php echo e(menuPosition(424)); ?>" >
                                        <a href="<?php echo e(route('class_optional')); ?>"><?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(121)  && menuStatus(121)): ?>
                                    
                                <?php endif; ?>

                                <?php if(userPermission(432)  && menuStatus(432)): ?>
                                    <li data-position="<?php echo e(menuPosition(432)); ?>" >
                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('lang.academic_year'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(440)  && menuStatus(440)): ?>
                                    <li data-position="<?php echo e(menuPosition(440)); ?>" >
                                        <a href="<?php echo e(route('holiday')); ?>"><?php echo app('translator')->get('lang.holiday'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(448)  && menuStatus(448)): ?>
                                    <li data-position="<?php echo e(menuPosition(448)); ?>" >
                                        <a href="<?php echo e(url('weekend')); ?>"><?php echo app('translator')->get('lang.weekend'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(451)  && menuStatus(451)): ?>

                                    <li data-position="<?php echo e(menuPosition(451)); ?>" >
                                        <a href="<?php echo e(route('language-settings')); ?>"><?php echo app('translator')->get('lang.language_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(412)  && menuStatus(412)): ?>
                                    <li data-position="<?php echo e(menuPosition(412)); ?>">
                                        <a href="<?php echo e(route('payment-method-settings')); ?>"><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(410)  && menuStatus(410)): ?>

                                    <li data-position="<?php echo e(menuPosition(410)); ?>">
                                        <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(444)  && menuStatus(444)): ?>

                                    <li data-position="<?php echo e(menuPosition(444)); ?>">
                                        <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                
                                <?php if(moduleStatusCheck('Saas')== FALSE   ): ?>
                                    <?php echo $__env->make('backEnd/partials/without_saas_school_admin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(moduleStatusCheck('Saas')== FALSE): ?>
                        <?php if(userPermission(492) &&  menuStatus(492)): ?>
                            <li  data-position="<?php echo e(menuPosition(492)); ?>" class="sortable_li">
                                <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="flaticon-software"></span>
                                    <?php echo app('translator')->get('lang.front_settings'); ?>
                                </a>
                                <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
                                    <?php if(userPermission(650)  && menuStatus(650)): ?>
                                        <li  data-position="<?php echo e(menuPosition(650)); ?>">
                                            <a href="<?php echo e(route('header-menu-manager')); ?>"><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.menu'); ?> <?php echo app('translator')->get('lang.manager'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(493) && menuStatus(493)): ?>
                                        <li  data-position="<?php echo e(menuPosition(498)); ?>">
                                            <a href="<?php echo e(route('admin-home-page')); ?>"> <?php echo app('translator')->get('lang.home_page'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(523) && menuStatus(523)): ?>
                                        <li  data-position="<?php echo e(menuPosition(528)); ?>">
                                            <a href="<?php echo e(route('news-heading-update')); ?>"><?php echo app('translator')->get('lang.news_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(500)  && menuStatus(500)): ?>
                                        <li  data-position="<?php echo e(menuPosition(500)); ?>">
                                            <a href="<?php echo e(route('news-category')); ?>"><?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(495)  && menuStatus(495)): ?>
                                        <li  data-position="<?php echo e(menuPosition(495)); ?>">
                                            <a href="<?php echo e(route('news_index')); ?>"><?php echo app('translator')->get('lang.news_list'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(525)  && menuStatus(525)): ?>
                                        <li  data-position="<?php echo e(menuPosition(525)); ?>">
                                            <a href="<?php echo e(route('course-heading-update')); ?>"><?php echo app('translator')->get('lang.course_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(525)  && menuStatus(525)): ?>
                                        <li  data-position="<?php echo e(menuPosition(525)); ?>">
                                            <a href="<?php echo e(route('course-details-heading')); ?>"><?php echo app('translator')->get('lang.course_details_heading'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(673)  && menuStatus(673)): ?>
                                        <li  data-position="<?php echo e(menuPosition(673)); ?>">
                                            <a href="<?php echo e(route('course-category')); ?>"><?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(509)  && menuStatus(509)): ?>
                                        <li  data-position="<?php echo e(menuPosition(509)); ?>">
                                            <a href="<?php echo e(route('course-list')); ?>"><?php echo app('translator')->get('lang.course_list'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(504)  && menuStatus(504)): ?>
                                        <li  data-position="<?php echo e(menuPosition(504)); ?>">
                                            <a href="<?php echo e(route('testimonial_index')); ?>"><?php echo app('translator')->get('lang.testimonial'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(514) && menuStatus(514)): ?>
                                        <li  data-position="<?php echo e(menuPosition(514)); ?>">
                                            <a href="<?php echo e(route('conpactPage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.page'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(517) && menuStatus(517)): ?>
                                        <li  data-position="<?php echo e(menuPosition(517)); ?>">
                                            <a href="<?php echo e(route('contactMessage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(520) && menuStatus(520)): ?>
                                        <li  data-position="<?php echo e(menuPosition(520)); ?>">
                                            <a href="<?php echo e(route('about-page')); ?>"> <?php echo app('translator')->get('lang.about_us'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(529) && menuStatus(529)): ?>
                                        <li  data-position="<?php echo e(menuPosition(529)); ?>">
                                            <a href="<?php echo e(route('social-media')); ?>"> <?php echo app('translator')->get('lang.social_media'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(654) && menuStatus(654)): ?>
                                        <li  data-position="<?php echo e(menuPosition(654)); ?>">
                                            <a href="<?php echo e(route('page-list')); ?>"><?php echo app('translator')->get('lang.pages'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(527) && menuStatus(527)): ?>
                                        <li  data-position="<?php echo e(menuPosition(527)); ?>">
                                            <a href="<?php echo e(route('custom-links')); ?>"> <?php echo app('translator')->get('lang.footer_widget'); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(userPermission(1100) && menuStatus(1100)): ?>
                        <li data-position="<?php echo e(menuPosition(1100)); ?>" class="sortable_li">
                            <a href="#subMenuCustomField" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-slumber"></span>
                                <?php echo app('translator')->get('lang.custom'); ?> <?php echo app('translator')->get('lang.field'); ?>
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuCustomField">
                                <?php if(userPermission(1101) && menuStatus(1101)): ?>
                                    <li data-position="<?php echo e(menuPosition(1101)); ?>">
                                        <a href="<?php echo e(route('student-reg-custom-field')); ?>">
                                            <?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.registration'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(1105) && menuStatus(1105)): ?>
                                    <li data-position="<?php echo e(menuPosition(1105)); ?>">
                                        <a href="<?php echo e(route('staff-reg-custom-field')); ?>">
                                            <?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.registration'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

            <?php endif; ?>
                <!-- Student Panel -->
                    <?php if(Auth::user()->role_id == 2): ?>                   
                        <?php echo $__env->make('backEnd/partials/student_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <!-- Parents Panel Menu -->
                    <?php if(Auth::user()->role_id == 3): ?>
                        <?php echo $__env->make('backEnd/partials/parents_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
            <?php endif; ?>

        </ul>
    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1): ?>
    
        <?php echo $__env->make('saasrolepermission::menu.SaasAdminMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1 && Auth::user()->role_id != 1): ?>
        <ul class="list-unstyled components">
            <li>
                <a href="<?php echo e(route('saas/institution-list')); ?>" id="superadmin-dashboard">
                    <span class="flaticon-analytics"></span>
                    <?php echo app('translator')->get('lang.institution'); ?> <?php echo app('translator')->get('lang.list'); ?> 
                </a>
            </li>
        </ul>
    <?php endif; ?>
</nav><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/partials/sidebar.blade.php ENDPATH**/ ?>