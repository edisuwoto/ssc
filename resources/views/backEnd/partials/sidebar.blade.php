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
      
            @include('menumanage::menu.sidebar')

                @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 )
                   


                   
                        {{-- admin_section --}}
               


                    @if(userPermission(11) && menuStatus(11))
                        <li  data-position="{{menuPosition(11)}}" class="sortable_li">
                            <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-analytics"></span>
                                @lang('lang.admin_section')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAdmin">
                                @if(userPermission(12) && menuStatus(12))
                                    <li data-position="{{menuPosition(12)}}">
                                        <a href="{{route('admission_query')}}">@lang('lang.admission_query')</a>
                                    </li>
                                @endif

                                @if(userPermission(16) && menuStatus(16))
                                    <li data-position="{{menuPosition(16)}}">
                                        <a href="{{route('visitor')}}">@lang('lang.visitor_book') </a>
                                    </li>
                                @endif
                                
                                @if(userPermission(21) && menuStatus(21))
                                    <li data-position="{{menuPosition(21)}}">
                                        <a href="{{route('complaint')}}">@lang('lang.complaint')</a>
                                    </li>
                                @endif
                                @if(userPermission(27) && menuStatus(27))
                                    <li data-position="{{menuPosition(27)}}">
                                        <a href="{{route('postal-receive')}}">@lang('lang.postal_receive')</a>
                                    </li>
                                @endif
                                @if(userPermission(32) && menuStatus(32))
                                    <li data-position="{{menuPosition(32)}}">
                                        <a href="{{route('postal-dispatch')}}">@lang('lang.postal_dispatch')</a>
                                    </li>
                                @endif
                                @if(userPermission(36) && menuStatus(36))
                                    <li data-position="{{menuPosition(36)}}">
                                        <a href="{{route('phone-call')}}">@lang('lang.phone_call_log')</a>
                                    </li>
                                @endif
                                @if(userPermission(41) && menuStatus(41))
                                    <li data-position="{{menuPosition(41)}}">
                                        <a href="{{route('setup-admin')}}">@lang('lang.admin_setup')</a>
                                    </li>
                                @endif
                                @if(userPermission(49) && menuStatus(49))
                                    <li data-position="{{menuPosition(49)}}">
                                        <a href="{{route('student-certificate')}}">@lang('lang.student_certificate')</a>
                                    </li>
                                @endif
                                @if(userPermission(53) && menuStatus(53))
                                    <li data-position="{{menuPosition(53)}}">
                                        <a href="{{route('generate_certificate')}}">@lang('lang.generate_certificate')</a>
                                    </li>
                                @endif
                                @if(userPermission(45) && menuStatus(45))
                                    <li data-position="{{menuPosition(45)}}">
                                        <a href="{{route('student-id-card')}}">@lang('lang.id_card')</a>
                                    </li>
                                @endif
                                @if(userPermission(57) && menuStatus(57))
                                    <li data-position="{{menuPosition(57)}}">
                                        <a href="{{route('generate_id_card')}}">@lang('lang.generate_id_card')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- spmb --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuSPMB" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.spmb')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuSPMB">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.student_category')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.add') @lang('lang.student')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('calon_mahasiswa')}}"> @lang('lang.data_calon_mahasiswa')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.student_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.student_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.subject') @lang('lang.wise') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.subject_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.student_group')</a>
                                    </li>
                                @endif
                                @if(userPermission(81)  && menuStatus(81))
                                    <li data-position="{{menuPosition(81)}}">
                                        <a href="{{route('student_promote')}}">@lang('lang.student_promote')</a>
                                    </li>
                                @endif
                                @if(userPermission(83)  && menuStatus(83))
                                    <li data-position="{{menuPosition(83)}}">
                                        <a href="{{route('disabled_student')}}">@lang('lang.disabled_student')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.student') @lang('lang.export')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- SIMPEG --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuSIMPEG" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.simpeg')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuSIMPEG">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.dashboard')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.group_privilege')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('master_staff')}}"> @lang('lang.master_staff')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.absensi')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.list_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.profile') @lang('lang.staff') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.cuti')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.pembimbing_akademik')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.reports') @lang('lang.staffs')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- BKD --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuBKD" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.bkd')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuBKD">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.dashboard')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.group_privilege')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('student_list')}}"> @lang('lang.master_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.absensi')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.list_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.profile') @lang('lang.staff') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.cuti')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.pembimbing_akademik')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.reports') @lang('lang.staffs')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Akademik --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuAkademik" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.akademik')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuAkademik">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.dashboard')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.group_privilege')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('student_list')}}"> @lang('lang.master_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.absensi')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.list_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.profile') @lang('lang.staff') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.cuti')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.pembimbing_akademik')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.reports') @lang('lang.staffs')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- keuangan --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuKeuangan" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.keuangan')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuKeuangan">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.dashboard')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.group_privilege')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('student_list')}}"> @lang('lang.master_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.absensi')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.list_data')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.profile') @lang('lang.staff') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.cuti')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.pembimbing_akademik')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.reports') @lang('lang.staffs')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif


                    {{-- student -- }}
                    {{-- student_information --}}
                    @if(userPermission(61) && menuStatus(61))
                        <li data-position="{{menuPosition(61)}}" class="sortable_li">
                            <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-reading"></span>
                                @lang('lang.student')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuStudent">
                                @if(userPermission(71) && menuStatus(71))
                                    <li data-position="{{menuPosition(71)}}">
                                        <a href="{{route('student_category')}}"> @lang('lang.student_category')</a>
                                    </li>
                                @endif
                                @if(userPermission(62)  && menuStatus(62))
                                    <li data-position="{{menuPosition(62)}}">
                                        <a href="{{route('student_admission')}}">@lang('lang.add') @lang('lang.student')</a>
                                    </li>
                                @endif
                                @if(userPermission(64)  && menuStatus(64))
                                    <li data-position="{{menuPosition(64)}}">
                                        <a href="{{route('student_list')}}"> @lang('lang.student_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(68)  && menuStatus(68))
                                    <li data-position="{{menuPosition(68)}}">
                                        <a href="{{route('student_attendance')}}"> @lang('lang.student_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(70)  && menuStatus(70))
                                    <li data-position="{{menuPosition(70)}}">
                                        <a href="{{route('student_attendance_report')}}"> @lang('lang.student_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(533)  && menuStatus(533))
                                    <li data-position="{{menuPosition(533)}}">
                                        <a href="{{route('subject-wise-attendance')}}"> @lang('lang.subject') @lang('lang.wise') @lang('lang.attendance') </a>
                                    </li>
                                @endif
                                @if(userPermission(535)  && menuStatus(535))
                                  
                                    <li data-position="{{menuPosition(535)}}">
                                        <a href="{{url('subject-attendance-average-report')}}"> @lang('lang.subject_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(76)  && menuStatus(76))
                                    <li data-position="{{menuPosition(76)}}">
                                        <a href="{{route('student_group')}}">@lang('lang.student_group')</a>
                                    </li>
                                @endif
                                @if(userPermission(81)  && menuStatus(81))
                                    <li data-position="{{menuPosition(81)}}">
                                        <a href="{{route('student_promote')}}">@lang('lang.student_promote')</a>
                                    </li>
                                @endif
                                @if(userPermission(83)  && menuStatus(83))
                                    <li data-position="{{menuPosition(83)}}">
                                        <a href="{{route('disabled_student')}}">@lang('lang.disabled_student')</a>
                                    </li>
                                @endif
                                @if(userPermission(663)  && menuStatus(663))
                                    <li data-position="{{menuPosition(663)}}">
                                        <a href="{{route('all-student-export')}}">@lang('lang.student') @lang('lang.export')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('StudentAbsentNotification')== TRUE)
                                    <li>
                                        <a href="{{route('notification_time_setup')}}">@lang('lang.time_setup')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- academics --}}
                    @if(userPermission(245)  && menuStatus(245))
                        <li data-position="{{menuPosition(245)}}"  class="sortable_li">
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

                    {{-- study_material --}}
                    @if(userPermission(87) &&  menuStatus(87))
                        <li data-position="{{menuPosition(87)}}" class="sortable_li">
                            <a href="#subMenuTeacher" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-professor"></span>
                                @lang('lang.study_material')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuTeacher">
                                @if(userPermission(88) &&  menuStatus(87))
                                    <li data-position="{{menuPosition(88)}}">
                                        <a href="{{route('upload-content')}}"> @lang('lang.upload_content')</a>
                                    </li>
                                @endif
                                @if(userPermission(92) &&  menuStatus(92))
                                    <li data-position="{{menuPosition(92)}}">
                                        <a href="{{route('assignment-list')}}">@lang('lang.assignment')</a>
                                    </li>
                                @endif
                                @if(userPermission(100) &&  menuStatus(100))
                                    <li data-position="{{menuPosition(100)}}">
                                        <a href="{{route('syllabus-list')}}">@lang('lang.syllabus')</a>
                                    </li>
                                @endif
                                @if(userPermission(105) &&  menuStatus(105))
                                    <li data-position="{{menuPosition(105)}}">
                                        <a href="{{route('other-download-list')}}">@lang('lang.other_download')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Lesson Plan  --}}
                    @if(userPermission(800) && menuStatus(800))
                        <li data-position="{{menuPosition(800)}}" class="sortable_li">
                            <a href="#subMenuTeacherLesson" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-professor"></span>
                                @lang('lang.lesson') @lang('lang.plan')
                            </a>

                            <ul class="collapse list-unstyled" id="subMenuTeacherLesson">
                                @if(userPermission(801) && menuStatus(801))
                                    <li data-position="{{menuPosition(801)}}">
                                        <a href="{{route('lesson')}}"> @lang('lang.lesson')</a>
                                    </li>
                                @endif
                                @if(userPermission(805) && menuStatus(805))
                                    <li data-position="{{menuPosition(805)}}">
                                        <a href="{{route('lesson.topic')}}"> @lang('lang.topic')</a>
                                    </li>
                                @endif
                                @if(userPermission(809) && menuStatus(809))
                                    <li data-position="{{menuPosition(809)}}">
                                        <a href="{{route('topic-overview')}}"> @lang('lang.topic') @lang('lang.overview')</a>
                                    </li>
                                @endif
                                @if(userPermission(810) && menuStatus(810))
                                <li data-position="{{menuPosition(810)}}">
                                    <a href="{{route('lesson.lesson-planner')}}"> @lang('lang.lesson') @lang('lang.plan')</a>
                                </li>
                                @endif

                                @if(userPermission(815) && menuStatus(815) )
                                <li data-position="{{menuPosition(815)}}">
                                    <a href="{{route('lesson.lessonPlan-overiew')}}"> @lang('lang.lesson') @lang('lang.plan') @lang('lang.overview')</a>
                                </li>
                                @endif
                                @if(Auth::user()->role_id == 4)
                                <li> <a href="{{route('view-teacher-lessonPlan')}}">@lang('lang.my') @lang('lang.lesson') @lang('lang.plan') </a>  </li>               
                                <li> <a href="{{route('view-teacher-lessonPlan-overview')}}">@lang('lang.my')  @lang('lang.lesson') @lang('lang.plan') @lang('lang.overview')</a>
                                        </li>
                                    @endif

                            </ul>
                        </li>
                    @endif

                    {{-- FeesCollection --}}
                    @if(moduleStatusCheck('FeesCollection')== TRUE)
                        @include('feescollection::menu.FeesCollection')
                    @else
                        @if(userPermission(108) && menuStatus(108))
                            <li data-position="{{menuPosition(108)}}" class="sortable_li">
                                <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="flaticon-wallet"></span>
                                    @lang('lang.fees_collection')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenuFeesCollection">
                                    @if(userPermission(123) && menuStatus(123))
                                        <li data-position="{{menuPosition(123)}}" >
                                            <a href="{{route('fees_group')}}"> @lang('lang.fees_group')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(127) && menuStatus(127))
                                        <li data-position="{{menuPosition(127)}}" >
                                            <a href="{{route('fees_type')}}"> @lang('lang.fees_type')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(131) && menuStatus(131))
                                        <li data-position="{{menuPosition(131)}}" >
                                            <a href="{{route('fees-master')}}"> @lang('lang.fees_master')</a>
                                        </li>
                                    @endif
                                    

                                    @if(userPermission(118) && menuStatus(118))
                                        <li data-position="{{menuPosition(118)}}" >
                                            <a href="{{route('fees_discount')}}"> @lang('lang.fees_discount')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(109) && menuStatus(109))
                                        <li data-position="{{menuPosition(109)}}" >
                                            <a href="{{route('collect_fees')}}"> @lang('lang.collect_fees')</a>
                                        </li>
                                    @endif
                                   
                                    @if(userPermission(113) && menuStatus(113))
                                        <li data-position="{{menuPosition(113)}}" >
                                            <a href="{{route('search_fees_payment')}}"> @lang('lang.search_fees_payment')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(116) && menuStatus(116))
                                        <li data-position="{{menuPosition(116)}}" >
                                            <a href="{{route('search_fees_due')}}"> @lang('lang.search_fees_due')</a>
                                        </li>
                                    @endif
                                    <li >
                                        <a href="{{route('bank-payment-slip')}}"> @lang('lang.bank')  @lang('lang.payment')</a>
                                    </li>

                                    @if(userPermission(136) && menuStatus(136))
                                        <li data-position="{{menuPosition(136)}}" >
                                            <a href="{{route('fees_forward')}}"> @lang('lang.fees_forward')</a>
                                        </li>
                                    @endif

                                    @if(userPermission(383) && menuStatus(383))
                                        <li data-position="{{menuPosition(383)}}">
                                            <a href="{{route('transaction_report')}}">@lang('lang.collection') @lang('lang.report')</a>
                                        </li>
                                    @endif
                                 
                                    {{-- @if(userPermission(840))
                                    <li data-position="{{menuPosition(840)}}" class="sortable_li">
                                        <a href="#subMenuFeesReport" data-toggle="collapse" aria-expanded="false"
                                           class="dropdown-toggle">
                                            @lang('lang.report')
                                        </a>
                                        <ul class="collapse list-unstyled" id="subMenuFeesReport">
                                            @if(userPermission(383))
                                                <li data-position="{{menuPosition(383)}}">
                                                    <a href="{{route('transaction_report')}}">@lang('lang.collection') @lang('lang.report')</a>
                                                </li>
                                           @endif
                                         
                                        </ul>
                                    </li>
                                    @endif --}}
                                </ul>
                            </li>
                        @endif
                    @endif


                    
                @if(moduleStatusCheck('BulkPrint')== TRUE)
                    @include('bulkprint::menu.bulk_print_sidebar')
                @endif

                    {{-- accounts --}}
                    @if(userPermission(137) && menuStatus(137))
                        <li data-position="{{menuPosition(137)}}" class="sortable_li">
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
                    {{-- human_resource --}}
                    @if(userPermission(160) && menuStatus(160))
                        <li data-position="{{menuPosition(160)}}" class="sortable_li">
                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-consultation"></span>
                                @lang('lang.human_resource')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHumanResource">
                                @if(userPermission(180) && menuStatus(180))
                                    <li data-position="{{menuPosition(180)}}" >
                                        <a href="{{route('designation')}}"> @lang('lang.designation')</a>
                                    </li>
                                @endif
                                @if(userPermission(184) && menuStatus(184))
                                    <li data-position="{{menuPosition(184)}}">
                                        <a href="{{route('department')}}"> @lang('lang.department')</a>
                                    </li>
                                @endif
                                @if(userPermission(162) && menuStatus(162))
                                    <li data-position="{{menuPosition(162)}}">
                                        <a href="{{route('addStaff')}}"> @lang('lang.add')  @lang('lang.staff') </a>
                                    </li>
                                @endif
                                @if(userPermission(161) && menuStatus(161))
                                    <li data-position="{{menuPosition(161)}}">
                                        <a href="{{route('staff_directory')}}"> @lang('lang.staff_directory')</a>
                                    </li>
                                @endif
                                @if(userPermission(165) && menuStatus(162))
                                    <li data-position="{{menuPosition(165)}}">
                                        <a href="{{route('staff_attendance')}}"> @lang('lang.staff_attendance')</a>
                                    </li>
                                @endif
                                @if(userPermission(169) && menuStatus(169))
                                    <li data-position="{{menuPosition(169)}}">
                                        <a href="{{route('staff_attendance_report')}}"> @lang('lang.staff_attendance_report')</a>
                                    </li>
                                @endif
                                @if(userPermission(170) && menuStatus(170))
                                    <li data-position="{{menuPosition(170)}}">
                                        <a href="{{route('payroll')}}"> @lang('lang.payroll')</a>
                                    </li>
                                @endif
                                @if(userPermission(178) && menuStatus(178))
                                    <li data-position="{{menuPosition(178)}}">
                                        <a href="{{route('payroll-report')}}"> @lang('lang.payroll_report')</a>
                                    </li>
                                @endif

                                @if(userPermission(178))
                               
                               @endif
                            </ul>
                        </li>
                    @endif

                    {{-- leave --}}
                    @if(userPermission(188) && menuStatus(188))
                        <li data-position="{{menuPosition(188)}}" class="sortable_li">
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
                    {{-- Custom Field End --}}

                    {{-- Chat --}}
                    @include('chat::menu')

                    {{-- Examination --}}
                    @if(userPermission(207) && menuStatus(207))
                        <li data-position="{{menuPosition(207)}}" class="sortable_li">
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
                            <li data-position="{{menuPosition(875)}}" class="sortable_li">
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

                    {{-- HomeWork --}}
                    @if(userPermission(277) && menuStatus(277))
                        <li data-position="{{menuPosition(277)}}" class="sortable_li">
                            <a href="#subMenuHomework" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-book"></span>
                                @lang('lang.home_work')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuHomework">
                                @if(userPermission(278) && menuStatus(278))
                                    <li  data-position="{{menuPosition(278)}}" >
                                        <a href="{{route('add-homeworks')}}"> @lang('lang.add_homework')</a>
                                    </li>
                                @endif
                                @if(userPermission(280) && menuStatus(280))
                                    <li  data-position="{{menuPosition(280)}}" >
                                        <a href="{{route('homework-list')}}"> @lang('lang.homework_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(284) && menuStatus(284))
                                    <li  data-position="{{menuPosition(284)}}" >
                                        <a href="{{route('evaluation-report')}}"> @lang('lang.evaluation_report')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    {{-- Communicate --}}
                    @if(userPermission(286) && menuStatus(286))
                        <li data-position="{{menuPosition(286)}}" class="sortable_li">
                            <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-email"></span>
                                @lang('lang.communicate')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuCommunicate">
                                @if(userPermission(287) && menuStatus(287))
                                    <li  data-position="{{menuPosition(287)}}" >
                                        <a href="{{route('notice-list')}}">@lang('lang.notice_board')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('Saas') == true && Auth::user()->is_administrator != "yes" )
                                    <li>
                                        <a href="{{route('administrator-notice')}}">@lang('lang.administrator') @lang('lang.notice')</a>
                                    </li>
                                @endif
                                @if(userPermission(291) && menuStatus(291))
                                    <li  data-position="{{menuPosition(291)}}" >
                                        <a href="{{route('send-email-sms-view')}}">@lang('lang.send_email')</a>
                                    </li>
                                @endif
                                @if(userPermission(293) && menuStatus(293))
                                    <li  data-position="{{menuPosition(293)}}" >
                                        <a href="{{route('email-sms-log')}}">@lang('lang.email_sms_log')</a>
                                    </li>
                                @endif
                                @if(userPermission(294) && menuStatus(294))
                                    <li  data-position="{{menuPosition(294)}}" >
                                        <a href="{{route('event')}}">@lang('lang.event')</a>
                                    </li>
                                @endif
                                @if (moduleStatusCheck('Saas')== FALSE)
                                    @if(userPermission(710) && menuStatus(710))
                                    <li  data-position="{{menuPosition(710)}}" >
                                        <a href="{{route('sms-template-new')}}">@lang('lang.sms') @lang('lang.template')</a>
                                    </li>
                                    @endif
                                    @if(userPermission(480) && menuStatus(480))
                                    <li  data-position="{{menuPosition(480)}}" >
                                        <a href="{{route('templatesettings/email-template')}}">
                                            @lang('lang.email') @lang('lang.template')
                                        </a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
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

                    {{-- Inventory --}}
                    @if(userPermission(315) && menuStatus(315))
                        <li data-position="{{menuPosition(315)}}" class="sortable_li">
                            <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-inventory"></span>
                                @lang('lang.inventory')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuInventory">
                                @if(userPermission(316) && menuStatus(316))
                                    <li data-position="{{menuPosition(316)}}" >
                                        <a href="{{route('item-category')}}"> @lang('lang.item_category')</a>
                                    </li>
                                @endif
                                @if(userPermission(320) && menuStatus(320))
                                    <li data-position="{{menuPosition(320)}}" >
                                        <a href="{{route('item-list')}}"> @lang('lang.item_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(324) && menuStatus(324))
                                    <li data-position="{{menuPosition(324)}}" >
                                        <a href="{{route('item-store')}}"> @lang('lang.item_store')</a>
                                    </li>
                                @endif
                                @if(userPermission(328) && menuStatus(328))
                                    <li data-position="{{menuPosition(328)}}" >
                                        <a href="{{route('suppliers')}}"> @lang('lang.supplier')</a>
                                    </li>
                                @endif
                                @if(userPermission(332) && menuStatus(332))
                                    <li data-position="{{menuPosition(332)}}" >
                                        <a href="{{route('item-receive')}}"> @lang('lang.item_receive')</a>
                                    </li>
                                @endif
                                @if(userPermission(334) && menuStatus(334))
                                    <li data-position="{{menuPosition(334)}}" >
                                        <a href="{{route('item-receive-list')}}"> @lang('lang.item_receive_list')</a>
                                    </li>
                                @endif
                                @if(userPermission(339) && menuStatus(339))
                                    <li data-position="{{menuPosition(339)}}" >
                                        <a href="{{route('item-sell-list')}}"> @lang('lang.item_sell')</a>
                                    </li>
                                @endif
                                @if(userPermission(345) && menuStatus(345))
                                    <li data-position="{{menuPosition(345)}}" >
                                        <a href="{{route('item-issue')}}"> @lang('lang.item_issue')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Transport --}}
                    @if(userPermission(348) && menuStatus(348))
                        <li data-position="{{menuPosition(348)}}" class="sortable_li">
                            <a href="#subMenuTransport" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-bus"></span>
                                @lang('lang.transport')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuTransport">
                                @if(userPermission(349) && menuStatus(349))
                                    <li data-position="{{menuPosition(349)}}" >
                                        <a href="{{route('transport-route')}}"> @lang('lang.routes')</a>
                                    </li>
                                @endif
                                @if(userPermission(353) && menuStatus(353))
                                    <li data-position="{{menuPosition(353)}}" >
                                        <a href="{{route('vehicle')}}"> @lang('lang.vehicle')</a>
                                    </li>
                                @endif
                                @if(userPermission(357) && menuStatus(357))
                                    <li data-position="{{menuPosition(357)}}" >
                                        <a href="{{route('assign-vehicle')}}"> @lang('lang.assign_vehicle')</a>
                                    </li>
                                @endif
                                @if(userPermission(361) && menuStatus(361))
                                    <li data-position="{{menuPosition(361)}}" >
                                        <a href="{{route('student_transport_report')}}"> @lang('lang.student_transport_report')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Dormitory --}}
                    @if(userPermission(362) && menuStatus(362))
                        <li data-position="{{menuPosition(362)}}" class="sortable_li">
                            <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-hotel"></span>
                                @lang('lang.dormitory')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuDormitory">
                                @if(userPermission(371) && menuStatus(371))
                                    <li data-position="{{menuPosition(371)}}" >
                                        <a href="{{route('room-type')}}"> @lang('lang.room_type')</a>
                                    </li>
                                @endif
                                @if(userPermission(367) && menuStatus(367))
                                    <li data-position="{{menuPosition(367)}}" >
                                        <a href="{{route('dormitory-list')}}"> @lang('lang.dormitory')</a>
                                    </li>
                                @endif
                                @if(userPermission(363) && menuStatus(363))
                                    <li data-position="{{menuPosition(363)}}" >
                                        <a href="{{route('room-list')}}"> @lang('lang.dormitory_rooms')</a>
                                    </li>
                                @endif
                                @if(userPermission(375) && menuStatus(375))
                                    <li data-position="{{menuPosition(375)}}" >
                                        <a href="{{route('student_dormitory_report')}}"> @lang('lang.student_dormitory_report')</a>
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
                  
                    {{-- UserManagement --}}
                    @if(userPermission(417) && menuStatus(417))
                        <li data-position="{{menuPosition(417)}}" class="sortable_li" >
                            <a href="#subMenuUserManagement" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">
                                <span class="flaticon-authentication"></span>
                                @lang('lang.role') @lang('lang.&') @lang('lang.permission')
                            </a>
                            <ul class="collapse list-unstyled" id="subMenuUserManagement">
                                @if(userPermission(585) && menuStatus(585))
                                    <li data-position="{{menuPosition(585)}}" >
                                        <a href="{{route('rolepermission/role')}}">@lang('lang.role')</a>
                                    </li>
                                @endif
                                @if(userPermission(421) && menuStatus(421))
                                    <li data-position="{{menuPosition(421)}}" >
                                        <a href="{{route('login-access-control')}}">@lang('lang.login_permission')</a>
                                    </li>
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

                    {{-- Dormitory --}}
                    @if(moduleStatusCheck('Saas')== FALSE)
                        @if(userPermission(485) && menuStatus(485))
                            <li  data-position="{{menuPosition(485)}}" class="sortable_li">
                                <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <span class="flaticon-consultation"></span>
                                    @lang('lang.style')
                                </a>
                                <ul class="collapse list-unstyled" id="subMenusystemStyle">
                                    @if(userPermission(486) && menuStatus(486))
                                        <li data-position="{{menuPosition(486)}}">
                                            <a href="{{route('background-setting')}}">@lang('lang.background_settings')</a>
                                        </li>
                                    @endif
                                    @if(userPermission(490)  && menuStatus(490))
                                        <li data-position="{{menuPosition(490)}}">
                                            <a href="{{route('color-style')}}">@lang('lang.color') @lang('lang.theme')</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
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

                    {{-- Ticket --}}
                    @if(moduleStatusCheck('Saas')== TRUE  && Auth::user()->is_administrator != "yes" )
                        <li >
                            <a href="#Ticket" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <span class="flaticon-settings"></span>
                                @lang('lang.ticket_system')
                            </a>
                            <ul class="collapse list-unstyled" id="Ticket">
                                <li>
                                    <a href="{{ route('school/ticket-view') }}">@lang('lang.ticket_list')</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- Zoom Menu -->
                    @if(moduleStatusCheck('Zoom') == TRUE)
                       
                        @include('zoom::menu.Zoom')
                    @endif
                  
                    <!-- BBB Menu -->
                    @if(moduleStatusCheck('BBB') == true)
                        @include('bbb::menu.bigbluebutton_sidebar')
                    @endif

                    <!-- Jitsi Menu -->
                    @if(moduleStatusCheck('Jitsi')==true)
                        @include('jitsi::menu.jitsi_sidebar')
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