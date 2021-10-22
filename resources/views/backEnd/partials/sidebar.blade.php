@php
$school_config = schoolConfig();
$isSchoolAdmin = Session::get('isSchoolAdmin');
@endphp
<nav id="sidebar">
    <div class="sidebar-header update_sidebar">
        <a href="{{url('/')}}">
            @if(! is_null($school_config->logo))
                <img src="{{ asset($school_config->logo)}}" alt="logo">
            @else
                <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo">
            @endif
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    @if(Auth::user()->is_saas == 0)
        <ul class="list-unstyled components" id="sidebar_menu">
            <input type="hidden" name="" id="default_position" value="{{menuPosition('is_submit')}}">
            @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 )
                @if(userPermission(1))
                    <li>
                        @if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1)
                            <a href="{{route('superadmin-dashboard')}}" id="superadmin-dashboard">
                        @else
                            <a href="{{route('admin-dashboard')}}" id="admin-dashboard">
                        @endif
                            <span class="flaticon-speedometer"></span>@lang('lang.dashboard')
                            </a>
                    </li>
                @endif
            @endif
            <li data-position="{{menuPosition(101)}}" class="sortable_li">
                            <a href="#subMenuFeeder" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-test"></span>
                                Feeder
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuFeeder">
                                @if(userPermission(102)  && menuStatus(102))
                                    <li data-position="{{menuPosition(102)}}" >
                                        <a href="#">EMIS</a>
                                    </li>
                                @endif
                                @if(userPermission(103)  && menuStatus(103))
                                    <li> <a href="#">PDDIKTI</a> </li>
                                @endif
                            </ul>
                        </li>
            {{-- master --}}
                    @if(userPermission(991) &&  menuStatus(991))
                        <li data-position="{{menuPosition(22)}}" class="sortable_li">
                            <a href="#subMenuMaster" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-professor"></span>
                                @lang('lang.master')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuMaster">
                                @if(userPermission(991)  && menuStatus(991))
                                    <li data-position="{{menuPosition(991)}}" >
                                        <a href="{{route('academic-year')}}">@lang('lang.academic_year')</a>
                                    </li>
                                @endif
                                @if(userPermission(991)  && menuStatus(991))
                                    <li> <a href="{{route('base_group')}}">@lang('lang.base_group')</a> </li>
                                @endif
                                @if(userPermission(991) && menuStatus(991) )
                                    <li  data-position="{{menuPosition(428)}}">
                                        <a href="{{route('base_setup')}}">@lang('lang.base_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

            @if(moduleStatusCheck('InfixBiometrics')== TRUE && Auth::user()->role_id == 1)
                @include('infixbiometrics::menu.InfixBiometrics')
            @endif

            {{-- Parent Registration Menu --}}

            @if(moduleStatusCheck('ParentRegistration')== TRUE)
             @include('parentregistration::menu.ParentRegistration')
            @endif

            {{-- Saas Subscription Menu --}}
            @if(moduleStatusCheck('SaasSubscription')== TRUE && Auth::user()->is_administrator != "yes")
                @include('saassubscription::menu.SaasSubscriptionSchool')
            @endif

            {{-- Saas Module Menu --}}
            @if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator =="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1 )
                @include('saas::menu.Saas')
            @else

            <!--@include('menumanage::menu.sidebar')-->
            @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 )

                    {{-- human_resource --}}
                    @if(userPermission(160) && menuStatus(160))
                        <li data-position="{{menuPosition(22)}}" class="sortable_li">
                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-consultation"></span>
                                @lang('lang.human_resource')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHumanResource">
                                @if(userPermission(161) && menuStatus(161))
                                    <li data-position="{{menuPosition(161)}}">
                                        <a href="{{route('department')}}"> @lang('lang.department')</a>
                                    </li>
                                @endif
                                @if(userPermission(162) && menuStatus(162))
                                    <li data-position="{{menuPosition(162)}}" >
                                        <a href="{{route('designation')}}"> Bagian</a>
                                    </li>
                                @endif
                                @if(userPermission(163) && menuStatus(163))
                                    <li data-position="{{menuPosition(163)}}">
                                        <a href="{{route('staff_directory')}}"> @lang('lang.staff_directory')</a>
                                    </li>
                                @endif
                                @if(userPermission(164) && menuStatus(164))
                                    <li data-position="{{menuPosition(164)}}">
                                        <a href="{{route('staff_attendance')}}"> @lang('lang.staff_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(166) && menuStatus(166))
                                    <li data-position="{{menuPosition(166)}}">
                                        <a href="{{route('payroll')}}"> @lang('lang.payroll')</a>
                                    </li>
                                @endif
                                @if(userPermission(167) && menuStatus(167))
                                    <li data-position="{{menuPosition(167)}}">
                                        <a href="#">BKD</a>
                                    </li>
                                @endif
                                @if(userPermission(168) && menuStatus(168))
                                    <li data-position="{{menuPosition(168)}}">
                                        <a href="#">Laporan Kinerja</a>
                                    </li>
                                @endif
                                @if(userPermission(169) && menuStatus(169))
                                    <li data-position="{{menuPosition(169)}}">
                                        <a href="#">Penilaian Prestasi</a>
                                    </li>
                                @endif
                                <!--@if(userPermission(162) && menuStatus(162))
                                    <li data-position="{{menuPosition(162)}}">
                                        <a href="{{route('addStaff')}}"> @lang('lang.add')  @lang('lang.staff') </a>
                                    </li>
                                @endif-->
                                <!--
                                
                                @if(userPermission(169) && menuStatus(169))
                                    <li data-position="{{menuPosition(169)}}">
                                        <a href="{{route('staff_attendance_report')}}"> @lang('lang.staff_attendance_report')</a>
                                    </li>
                                @endif
                                
                                @if(userPermission(178) && menuStatus(178))
                                    <li data-position="{{menuPosition(178)}}">
                                        <a href="{{route('payroll-report')}}"> @lang('lang.payroll_report')</a>
                                    </li>
                                @endif
                                -->
                                
                            </ul>
                        </li>
                    @endif
                    
                    {{-- leave --}}
                    @if(userPermission(33) && menuStatus(33))
                        <li data-position="{{menuPosition(33)}}" class="sortable_li">
                            <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-slumber"></span>
                                @lang('lang.leave')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                                @if(userPermission(203) && menuStatus(203))
                                    <li data-position="{{menuPosition(203)}}" >
                                        <a href="{{route('leave-type')}}"> @lang('lang.leave_type')</a>
                                    </li>
                                @endif
                                @if(userPermission(199) && menuStatus(199))
                                    <li data-position="{{menuPosition(199)}}" >
                                        <a href="{{route('leave-define')}}"> @lang('lang.leave_define')</a>
                                    </li>
                                @endif
                                @if(userPermission(189) && menuStatus(189))
                                    <li data-position="{{menuPosition(189)}}" >
                                        <a href="{{route('approve-leave')}}">@lang('lang.approve_leave_request')</a>
                                    </li>
                                @endif
                                @if(userPermission(196) && menuStatus(196))
                                    <li data-position="{{menuPosition(196)}}" >
                                        <a href="{{route('pending-leave')}}">@lang('lang.pending_leave_request')</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role_id!=1)

                                    @if(userPermission(193) && menuStatus(193))
                                        <li data-position="{{menuPosition(193)}}" >
                                            <a href="{{route('apply-leave')}}">@lang('lang.apply_leave')</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- academics --}}
                    @if(userPermission(44)  && menuStatus(44))
                        <li data-position="{{menuPosition(44)}}"  class="sortable_li">
                            <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-book"></span>
                                @lang('lang.academics')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAcademic">
                                @if(userPermission(537) && menuStatus(537))
                                    <li data-position="{{menuPosition(537)}}" >
                                        <a href="{{route('optional-subject')}}"> @lang('lang.optional') @lang('lang.subject') </a>
                                    </li>
                                @endif
                                @if(userPermission(265) && menuStatus(265))
                                    <li data-position="{{menuPosition(265)}}" >
                                        <a href="{{route('section')}}"> @lang('lang.section')</a>
                                    </li>
                                @endif
                                @if(userPermission(261) && menuStatus(261))
                                    <li data-position="{{menuPosition(261)}}" >
                                        <a href="{{route('class')}}"> @lang('lang.class')</a>
                                    </li>
                                @endif
                                @if(userPermission(257) && menuStatus(257))
                                    <li data-position="{{menuPosition(257)}}" >
                                        <a href="{{route('subject')}}"> @lang('lang.subjects')</a>
                                    </li>
                                @endif
                                @if(userPermission(253) && menuStatus(253))
                                    <li data-position="{{menuPosition(253)}}" >
                                        <a href="{{route('assign-class-teacher')}}"> @lang('lang.assign_class_teacher')</a>
                                    </li>
                                @endif
                                @if(userPermission(250) && menuStatus(250))
                                    <li data-position="{{menuPosition(250)}}" >
                                        <a href="{{route('assign_subject')}}"> @lang('lang.assign_subject')</a>
                                    </li>
                                @endif
                                @if(userPermission(269) && menuStatus(269))
                                    <li data-position="{{menuPosition(269)}}" >
                                        <a href="{{route('class-room')}}"> @lang('lang.class_room')</a>
                                    </li>
                                @endif
                                @if(userPermission(273) && menuStatus(273))
                                    <li data-position="{{menuPosition(273)}}" >
                                        <a href="{{route('class-time')}}"> @lang('lang.class_time_setup')</a>
                                    </li>
                                @endif
                                @if(userPermission(246) && menuStatus(246))
                                    <li data-position="{{menuPosition(246)}}" >
                                        <a href="{{route('class_routine_new')}}"> @lang('lang.class_routine')</a>
                                    </li>
                                @endif
                            <!-- only for teacher -->
                                @if(Auth::user()->role_id == 4)
                                    <li>
                                        <a href="{{route('view-teacher-routine')}}">@lang('lang.view') @lang('lang.class_routine')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- accounts --}}
                    @if(userPermission(55) && menuStatus(55))
                        <li data-position="{{menuPosition(55)}}" class="sortable_li">
                            <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-accounting"></span>
                                @lang('lang.accounts')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAccount">
                                @if(userPermission(148) && menuStatus(148))
                                    <li data-position="{{menuPosition(148)}}" >
                                        <a href="{{route('chart-of-account')}}"> @lang('lang.chart_of_account')</a>
                                    </li>
                                @endif
                                @if(userPermission(156) && menuStatus(156))
                                    <li data-position="{{menuPosition(156)}}" >
                                        <a href="{{route('bank-account')}}"> @lang('lang.bank_account')</a>
                                    </li>
                                @endif
                                @if(userPermission(139) && menuStatus(139))
                                    <li data-position="{{menuPosition(139)}}" >
                                        <a href="{{route('add_income')}}"> @lang('lang.income')</a>
                                    </li>
                                @endif
                                @if(userPermission(138) && menuStatus(138))
                                    <li data-position="{{menuPosition(138)}}" >
                                        <a href="{{route('profit')}}"> @lang('lang.profit') @lang('lang.&') @lang('lang.loss')</a>
                                    </li>
                                @endif
                                @if(userPermission(143) && menuStatus(143))
                                    <li data-position="{{menuPosition(143)}}" >
                                        <a href="{{route('add-expense')}}"> @lang('lang.expense')</a>
                                    </li>
                                @endif
                                {{-- @if(userPermission(147))
                                    <li>
                                        <a href="{{route('search_account')}}"> @lang('lang.search')</a>
                                    </li>
                                @endif --}}
                                @if(userPermission(704) && menuStatus(704))
                                    <li data-position="{{menuPosition(704)}}" >
                                        <a href="{{route('fund-transfer')}}">@lang('lang.fund') @lang('lang.transfer')</a>
                                    </li>
                                @endif
                                @if(userPermission(700) && menuStatus(700))
                                    <li data-position="{{menuPosition(700)}}">
                                        <a href="#subMenuAccountReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            @lang('lang.report')
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuAccountReport">
                                            @if(userPermission(701) && menuStatus(701))
                                                <li >
                                                    <a href="{{route('fine-report')}}"> @lang('lang.fine') @lang('lang.report')</a>
                                                </li>
                                            @endif
                                            @if(userPermission(702) && menuStatus(702))
                                                <li >
                                                    <a href="{{route('accounts-payroll-report')}}"> @lang('lang.payroll') @lang('lang.report')</a>
                                                </li>
                                            @endif
                                            @if(userPermission(703) && menuStatus(703))
                                                <li >
                                                    <a href="{{route('transaction')}}"> @lang('lang.transaction')</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Examination --}}
                    @if(userPermission(66) && menuStatus(66))
                        <li data-position="{{menuPosition(66)}}" class="sortable_li">
                            <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-test"></span>
                                @lang('lang.examination')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuExam">
                                @if(userPermission(225) && menuStatus(225))
                                    <li  data-position="{{menuPosition(225)}}" >
                                        <a href="{{route('marks-grade')}}"> @lang('lang.marks_grade')</a>
                                    </li>
                                @endif
                                @if(userPermission(571) && menuStatus(571))
                                    <li  data-position="{{menuPosition(571)}}" >
                                        <a href="{{route('exam-time')}}"> @lang('lang.exam_time')</a>
                                    </li>
                                @endif
                                @if(userPermission(208) && menuStatus(208))
                                    <li  data-position="{{menuPosition(208)}}" >
                                        <a href="{{route('exam-type')}}"> @lang('lang.exam_type')</a>
                                    </li>
                                @endif
                                @if(userPermission(214) && menuStatus(214))
                                    <li  data-position="{{menuPosition(214)}}" >
                                        <a href="{{route('exam')}}"> @lang('lang.exam_setup')</a>
                                    </li>
                                @endif
                                @if(userPermission(217) && menuStatus(217))
                                    <li  data-position="{{menuPosition(217)}}" >
                                        <a href="{{route('exam_schedule')}}"> @lang('lang.exam_schedule')</a>
                                    </li>
                                @endif
                                @if(userPermission(221) && menuStatus(221))
                                    <li  data-position="{{menuPosition(221)}}" >
                                        <a href="{{route('exam_attendance')}}"> @lang('lang.exam_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(222) && menuStatus(222))
                                    <li  data-position="{{menuPosition(222)}}" >
                                        <a href="{{route('marks_register')}}"> @lang('lang.marks_register')</a>
                                    </li>
                                @endif
                                @if(userPermission(229) && menuStatus(229))
                                    <li  data-position="{{menuPosition(229)}}" >
                                        <a href="{{route('send_marks_by_sms')}}"> @lang('lang.send_marks_by_sms')</a>
                                    </li>
                                @endif
                                {{-- @if(userPermission(230))
                                    <li>
                                        <a href="{{route('question-group')}}">@lang('lang.question_group')</a>
                                    </li>
                                @endif
                                @if(userPermission(234))
                                    <li>
                                        <a href="{{route('question-bank')}}">@lang('lang.question_bank')</a>
                                    </li>
                                @endif
                                @if(userPermission(238))
                                    <li>
                                        <a href="{{route('online-exam')}}">@lang('lang.online_exam')</a>
                                    </li>
                                @endif --}}

                                <li>
                                    <a href="#examSettings" data-toggle="collapse" aria-expanded="false"
                                       class="dropdown-toggle">
                                        @lang('lang.settings')
                                    </a>
                                    <ul class="collapse list-unstyled" id="examSettings">
                                        @if(userPermission(436) && menuStatus(436))
                                            <li  data-position="{{menuPosition(436)}}">
                                                <a href="{{route('custom-result-setting')}}">@lang('lang.setup') @lang('lang.exam') @lang('lang.rule')</a>
                                            </li>
                                        @endif

                                        @if(userPermission(706) && menuStatus(706))
                                            <li  data-position="{{menuPosition(706)}}">
                                                <a href="{{route('exam-settings')}}">@lang('lang.format') @lang('lang.settings')</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    @endif

                    {{-- online Exam --}}
                    @if(moduleStatusCheck('OnlineExam')== true)
                        @include('onlineexam::menu_onlineexam')
                    @else
                        @if(userPermission(875) && menuStatus(875))
                            <li data-position="{{menuPosition(91)}}" class="sortable_li">
                                <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <span class="flaticon-book-1"></span>
                                    @lang('lang.online_exam')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuOnlineExam">
                                    @if(userPermission(230) && menuStatus(230))
                                        <li  data-position="{{menuPosition(230)}}">
                                            <a href="{{route('question-group')}}">@lang('lang.question_group')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(234) && menuStatus(234))
                                        <li  data-position="{{menuPosition(234)}}">
                                            <a href="{{route('question-bank')}}">@lang('lang.question_bank')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(238) && menuStatus(238))
                                        <li  data-position="{{menuPosition(238)}}">
                                            <a href="{{route('online-exam')}}">@lang('lang.online_exam')</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif

                    {{-- Library --}}
                    @if(userPermission(298) && menuStatus(298))
                        <li data-position="{{menuPosition(298)}}" class="sortable_li">
                            <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-book-1"></span>
                                @lang('lang.library')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenulibrary">
                                @if(userPermission(304) && menuStatus(304))
                                    <li  data-position="{{menuPosition(304)}}">
                                        <a href="{{route('book-category-list')}}"> @lang('lang.book_category')</a>
                                    </li>
                                @endif
                                @if(userPermission(579) && menuStatus(579))
                                    <li  data-position="{{menuPosition(529)}}">
                                        <a href="{{route('library_subject')}}"> @lang('lang.subject')</a>
                                    </li>
                                @endif
                                @if(userPermission(299) && menuStatus(299))
                                    <li  data-position="{{menuPosition(299)}}">
                                        <a href="{{route('add-book')}}"> @lang('lang.add_book')</a>
                                    </li>
                                @endif
                                @if(userPermission(301) && menuStatus(301))
                                    <li  data-position="{{menuPosition(301)}}">
                                        <a href="{{route('book-list')}}"> @lang('lang.book_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(308) && menuStatus(308))
                                    <li  data-position="{{menuPosition(308)}}">
                                        <a href="{{route('library-member')}}"> @lang('lang.library_member')</a>
                                    </li>
                                @endif
                                @if(userPermission(311) && menuStatus(311))
                                    <li  data-position="{{menuPosition(311)}}">
                                        <a href="{{route('member-list')}}"> @lang('lang.member_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(314) && menuStatus(314))
                                    <li  data-position="{{menuPosition(314)}}">
                                        <a href="{{route('all-issed-book')}}"> @lang('lang.all_issued_book')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Reports --}}
                    @if(userPermission(376) && menuStatus(376))
                        <li data-position="{{menuPosition(376)}}" class="sortable_li">
                            <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-analysis"></span>
                                @lang('lang.reports')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemReports">
                                @if(userPermission(538) && menuStatus(538))
                                    <li data-position="{{menuPosition(538)}}" >
                                        <a href="{{route('student_report')}}">@lang('lang.student_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(377) && menuStatus(377))
                                    <li data-position="{{menuPosition(377)}}" >
                                        <a href="{{route('guardian_report')}}">@lang('lang.guardian_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(378) && menuStatus(378))
                                    <li data-position="{{menuPosition(378)}}" >
                                        <a href="{{route('student_history')}}">@lang('lang.student_history')</a>
                                    </li>
                                @endif
                                @if(userPermission(379) && menuStatus(379))
                                    <li data-position="{{menuPosition(379)}}" >
                                        <a href="{{route('student_login_report')}}">@lang('lang.student_login_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(381) && menuStatus(381))
                                    <li data-position="{{menuPosition(381)}}" >
                                        <a href="{{route('fees_statement')}}">@lang('lang.fees_statement')</a>
                                    </li>
                                @endif
                                @if(userPermission(382) && menuStatus(382))
                                    <li data-position="{{menuPosition(382)}}" >
                                        <a href="{{route('balance_fees_report')}}">@lang('lang.balance_fees_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(384) && menuStatus(384))
                                    <li data-position="{{menuPosition(384)}}" >
                                        <a href="{{route('class_report')}}">@lang('lang.class_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(385) && menuStatus(385))
                                    <li data-position="{{menuPosition(385)}}" >
                                        <a href="{{route('class_routine_report')}}">@lang('lang.class_routine')</a>
                                    </li>
                                @endif
                                @if(userPermission(386) && menuStatus(386))
                                    <li data-position="{{menuPosition(386)}}" >
                                        <a href="{{route('exam_routine_report')}}">@lang('lang.exam_routine')</a>
                                    </li>
                                @endif
                                @if(userPermission(387) && menuStatus(387))
                                    <li data-position="{{menuPosition(387)}}" >
                                        <a href="{{route('teacher_class_routine_report')}}">@lang('lang.teacher') @lang('lang.class_routine')</a>
                                    </li>
                                @endif
                                @if(userPermission(388) && menuStatus(388))
                                    <li data-position="{{menuPosition(388)}}" >
                                        <a href="{{route('merit_list_report')}}">@lang('lang.merit_list_report')</a>
                                    </li>
                                @endif
                                {{-- @if(userPermission(583))
                                    <li>
                                        <a href="{{route('custom-merit-list')}}">@lang('lang.custom') @lang('lang.merit_list_report')</a>
                                    </li>
                                @endif --}}
                                @if(userPermission(389) && menuStatus(389))
                                    <li data-position="{{menuPosition(389)}}" >
                                        <a href="{{route('online_exam_report')}}">@lang('lang.online_exam_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(390) && menuStatus(390))
                                    <li data-position="{{menuPosition(390)}}" >
                                        <a href="{{route('mark_sheet_report_student')}}">@lang('lang.mark_sheet_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(391) && menuStatus(391))
                                    <li data-position="{{menuPosition(391)}}" >
                                        <a href="{{route('tabulation_sheet_report')}}">@lang('lang.tabulation_sheet_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(392) && menuStatus(392))
                                    <li data-position="{{menuPosition(392)}}" >
                                        <a href="{{route('progress_card_report')}}">@lang('lang.progress_card_report')</a>
                                    </li>
                                @endif
                                {{-- @if(userPermission(584))
                                    <li>
                                        <a href="{{route('custom-progress-card')}}"> @lang('lang.custom') @lang('lang.progress_card_report')</a>
                                    </li>
                                @endif --}}
                                {{-- @if(userPermission(393))
                                    <li>
                                        <a href="{{route('student_fine_report')}}">@lang('lang.student_fine_report')</a>
                                    </li>
                                @endif --}}
                                @if(userPermission(394) && menuStatus(394))
                                    <li data-position="{{menuPosition(394)}}" >
                                        <a href="{{route('user_log')}}">@lang('lang.user_log')</a>
                                    </li>
                                @endif
                                @if(userPermission(539) && menuStatus(539))
                                    <li data-position="{{menuPosition(539)}}" >
                                        <a href="{{route('previous-class-results')}}">@lang('lang.previous') @lang('lang.result') </a>
                                    </li>
                                @endif
                                @if(userPermission(540) && menuStatus(540))
                                    <li data-position="{{menuPosition(540)}}" >
                                        <a href="{{route('previous-record')}}">@lang('lang.previous') @lang('lang.record') </a>
                                    </li>
                                @endif
                                {{-- New Client report start --}}
                                @if(Auth::user()->role_id == 1)
                                    @if(moduleStatusCheck('ResultReports')== TRUE)
                                        {{-- ResultReports --}}
                                        <li>
                                            <a href="{{route('resultreports/cumulative-sheet-report')}}">@lang('lang.cumulative') @lang('lang.sheet') @lang('lang.report')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/continuous-assessment-report')}}">@lang('lang.contonuous') @lang('lang.assessment') @lang('lang.report')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/termly-academic-report')}}">@lang('lang.termly') @lang('lang.academic') @lang('lang.report')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/academic-performance-report')}}">@lang('lang.academic') @lang('lang.performance') @lang('lang.report')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/terminal-report-sheet')}}">@lang('lang.terminal') @lang('lang.report') @lang('lang.sheet')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/continuous-assessment-sheet')}}">@lang('lang.continuous') @lang('lang.assessment') @lang('lang.sheet')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/result-version-two')}}">@lang('lang.result') @lang('lang.version')
                                                V2</a>
                                        </li>
                                        <li>
                                            <a href="{{route('resultreports/result-version-three')}}">@lang('lang.result') @lang('lang.version')
                                                V3
                                            </a>
                                        </li>
                                        {{--End New result result report --}}
                                    @endif
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- System Settings --}}
                    @if(userPermission(398) && menuStatus(398))
                        <li  data-position="{{menuPosition(398)}}" class="sortable_li">
                            <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-settings"></span>
                                @lang('lang.system_settings')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenusystemSettings">
                                   
                                @if((moduleStatusCheck('Saas')== TRUE) && (auth()->user()->is_administrator=="yes"))
                                    <li>
                                        <a href="{{route('school-general-settings')}}"> @lang('lang.general_settings')</a>
                                    </li>
                                @else
                                    @if(userPermission(405)  && menuStatus(405))

                                        <li data-position="{{menuPosition(405)}}" >
                                            <a href="{{route('general-settings')}}"> @lang('lang.general_settings')</a>
                                        </li>
                                    @endif
                                @endif
                                {{-- @if(userPermission(417))
                                    <li>
                                        <a href="{{route('rolepermission/role')}}">@lang('lang.role')</a>
                                    </li>
                                @endif
                                @if(userPermission(421))
                                    <li>
                                        <a href="{{route('login-access-control')}}">@lang('lang.login_permission')</a>
                                    </li>
                                @endif --}}
                                @if(userPermission(424)  && menuStatus(424))
                                    <li data-position="{{menuPosition(424)}}" >
                                        <a href="{{route('class_optional')}}">@lang('lang.optional') @lang('lang.subject')</a>
                                    </li>
                                @endif

                                @if(userPermission(121)  && menuStatus(121))
                                    {{--    <li> <a href="{{route('base_group')}}">@lang('lang.base_group')</a> </li>--}}
                                @endif

                                @if(userPermission(432)  && menuStatus(432))
                                    <li data-position="{{menuPosition(432)}}" >
                                        <a href="{{route('academic-year')}}">@lang('lang.academic_year')</a>
                                    </li>
                                @endif

                                @if(userPermission(440)  && menuStatus(440))
                                    <li data-position="{{menuPosition(440)}}" >
                                        <a href="{{route('holiday')}}">@lang('lang.holiday')</a>
                                    </li>
                                @endif

                                @if(userPermission(448)  && menuStatus(448))
                                    <li data-position="{{menuPosition(448)}}" >
                                        <a href="{{url('weekend')}}">@lang('lang.weekend')</a>
                                    </li>
                                @endif

                                @if(userPermission(451)  && menuStatus(451))

                                    <li data-position="{{menuPosition(451)}}" >
                                        <a href="{{route('language-settings')}}">@lang('lang.language_settings')</a>
                                    </li>
                                @endif

                                @if(userPermission(412)  && menuStatus(412))
                                    <li data-position="{{menuPosition(412)}}">
                                        <a href="{{route('payment-method-settings')}}">@lang('lang.payment') @lang('lang.settings')</a>
                                    </li>
                                @endif

                                @if(userPermission(410)  && menuStatus(410))

                                    <li data-position="{{menuPosition(410)}}">
                                        <a href="{{route('email-settings')}}">@lang('lang.email_settings')</a>
                                    </li>
                                @endif

                                @if(userPermission(444)  && menuStatus(444))

                                    <li data-position="{{menuPosition(444)}}">
                                        <a href="{{route('sms-settings')}}">@lang('lang.sms_settings')</a>
                                    </li>
                                @endif

                                {{-- SAAS DISABLE --}}
                                @if(moduleStatusCheck('Saas')== FALSE   )
                                    @include('backEnd/partials/without_saas_school_admin_menu')
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Front Settings --}}
                    @if(moduleStatusCheck('Saas')== FALSE)
                        @if(userPermission(492) &&  menuStatus(492))
                            <li  data-position="{{menuPosition(492)}}" class="sortable_li">
                                <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="flaticon-software"></span>
                                    @lang('lang.front_settings')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
                                    @if(userPermission(650)  && menuStatus(650))
                                        <li  data-position="{{menuPosition(650)}}">
                                            <a href="{{route('header-menu-manager')}}">@lang('lang.header') @lang('lang.menu') @lang('lang.manager')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(493) && menuStatus(493))
                                        <li  data-position="{{menuPosition(498)}}">
                                            <a href="{{route('admin-home-page')}}"> @lang('lang.home_page') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(523) && menuStatus(523))
                                        <li  data-position="{{menuPosition(528)}}">
                                            <a href="{{route('news-heading-update')}}">@lang('lang.news_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(500)  && menuStatus(500))
                                        <li  data-position="{{menuPosition(500)}}">
                                            <a href="{{route('news-category')}}">@lang('lang.news') @lang('lang.category')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(495)  && menuStatus(495))
                                        <li  data-position="{{menuPosition(495)}}">
                                            <a href="{{route('news_index')}}">@lang('lang.news_list')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(525)  && menuStatus(525))
                                        <li  data-position="{{menuPosition(525)}}">
                                            <a href="{{route('course-heading-update')}}">@lang('lang.course_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(525)  && menuStatus(525))
                                        <li  data-position="{{menuPosition(525)}}">
                                            <a href="{{route('course-details-heading')}}">@lang('lang.course_details_heading')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(673)  && menuStatus(673))
                                        <li  data-position="{{menuPosition(673)}}">
                                            <a href="{{route('course-category')}}">@lang('lang.course') @lang('lang.category')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(509)  && menuStatus(509))
                                        <li  data-position="{{menuPosition(509)}}">
                                            <a href="{{route('course-list')}}">@lang('lang.course_list')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(504)  && menuStatus(504))
                                        <li  data-position="{{menuPosition(504)}}">
                                            <a href="{{route('testimonial_index')}}">@lang('lang.testimonial')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(514) && menuStatus(514))
                                        <li  data-position="{{menuPosition(514)}}">
                                            <a href="{{route('conpactPage')}}">@lang('lang.contact') @lang('lang.page') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(517) && menuStatus(517))
                                        <li  data-position="{{menuPosition(517)}}">
                                            <a href="{{route('contactMessage')}}">@lang('lang.contact') @lang('lang.message')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(520) && menuStatus(520))
                                        <li  data-position="{{menuPosition(520)}}">
                                            <a href="{{route('about-page')}}"> @lang('lang.about_us') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(529) && menuStatus(529))
                                        <li  data-position="{{menuPosition(529)}}">
                                            <a href="{{route('social-media')}}"> @lang('lang.social_media') </a>
                                        </li>
                                    @endif
                                    @if(userPermission(654) && menuStatus(654))
                                        <li  data-position="{{menuPosition(654)}}">
                                            <a href="{{route('page-list')}}">@lang('lang.pages')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(527) && menuStatus(527))
                                        <li  data-position="{{menuPosition(527)}}">
                                            <a href="{{route('custom-links')}}"> @lang('lang.footer_widget') </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif
                    {{-- Custom Field Start --}}
                    @if(userPermission(1100) && menuStatus(1100))
                        <li data-position="{{menuPosition(1100)}}" class="sortable_li">
                            <a href="#subMenuCustomField" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-slumber"></span>
                                @lang('lang.custom') @lang('lang.field')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuCustomField">
                                @if(userPermission(1101) && menuStatus(1101))
                                    <li data-position="{{menuPosition(1101)}}">
                                        <a href="{{route('student-reg-custom-field')}}">
                                            @lang('lang.student') @lang('lang.registration')
                                        </a>
                                    </li>
                                @endif
                                @if(userPermission(1105) && menuStatus(1105))
                                    <li data-position="{{menuPosition(1105)}}">
                                        <a href="{{route('staff-reg-custom-field')}}">
                                            @lang('lang.staff') @lang('lang.registration')
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

            @endif
                <!-- Student Panel -->
                    @if(Auth::user()->role_id == 2)                   
                        @include('backEnd/partials/student_sidebar')
                    @endif

                    <!-- Parents Panel Menu -->
                    @if(Auth::user()->role_id == 3)
                        @include('backEnd/partials/parents_sidebar')
                    @endif
            @endif

        </ul>
    @endif

    @if(Auth::user()->is_saas == 1)
    
        @include('saasrolepermission::menu.SaasAdminMenu')
    @endif

    @if(Auth::user()->is_saas == 1 && Auth::user()->role_id != 1)
        <ul class="list-unstyled components">
            <li>
                <a href="{{route('saas/institution-list')}}" id="superadmin-dashboard">
                    <span class="flaticon-analytics"></span>
                    @lang('lang.institution') @lang('lang.list') 
                </a>
            </li>
        </ul>
    @endif
</nav>