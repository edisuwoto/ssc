@if(userPermission(900) && menuStatus(900))
<li  data-position="{{menuPosition(900)}}" class="sortable_li">
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        @lang('lang.chat')
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        @if(userPermission(901) && menuStatus(901))
        <li  data-position="{{menuPosition(901)}}" >
            <a href="{{ route('chat.index') }}">@lang('lang.chat') @lang('lang.box')</a>
        </li>
        @endif

        @if(userPermission(903) && menuStatus(903))
        <li data-position="{{menuPosition(903)}}" >
            <a href="{{ route('chat.invitation') }}">@lang('lang.invitation')</a>
        </li>
        @endif

        @if(userPermission(904) && menuStatus(904))
            <li data-position="{{menuPosition(904)}}" >
                <a href="{{ route('chat.blocked.users') }}">@lang('lang.blocked') @lang('lang.user')</a>
            </li>
        @endif

        @if(userPermission(905) && menuStatus(905))
            <li data-position="{{menuPosition(905)}}" >
                <a href="{{ route('chat.settings') }}">@lang('lang.settings')</a>
            </li>
        @endif
    </ul>
</li>
@endif