@if(userPermission(542) && menuStatus(542) )
    <li data-position="{{menuPosition(542)}}" class="sortable_li">
        <a href="#subMenuStudentRegistration" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-reading"></span>
            @lang('lang.registration')
        </a>
        <ul class="collapse list-unstyled" id="subMenuStudentRegistration">
            @if(userPermission(543) && menuStatus(543))
                <li data-position="{{menuPosition(543)}}">
                    <a href="{{url('parentregistration/student-list')}}"> @lang('lang.student_list')</a>
                </li>
            @endif
            @if(moduleStatusCheck('Saas') == FALSE)
                @if(userPermission(547) && menuStatus(547))
                    <li data-position="{{menuPosition(547)}}">
                        <a href="{{url('parentregistration/settings')}}"> @lang('lang.settings')</a>
                    </li>
                @endif
            @endif
        </ul>
    </li>
@endif
