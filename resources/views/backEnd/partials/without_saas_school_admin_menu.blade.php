@if(userPermission(399) && menuStatus(399) )
                        <li  data-position="{{menuPosition(399)}}">
                            <a href="{{route('manage-adons')}}">@lang('lang.module') @lang('lang.manager')</a>
                        </li>
                    @endif

                        @if(userPermission(401) && menuStatus(401) )
                                <li  data-position="{{menuPosition(401)}}">
                                    <a href="{{route('manage-currency')}}">@lang('lang.manage') @lang('lang.currency')</a>
                                </li>
                        @endif

                       <!-- @if(userPermission(410) && menuStatus(410) )

                            <li  data-position="{{menuPosition(410)}}">
                                <a href="{{route('email-settings')}}">@lang('lang.email_settings')</a>
                            </li>
                        @endif -->

                        <!--
                       @if(userPermission(428) && menuStatus(428) )

                                <li  data-position="{{menuPosition(428)}}">
                                    <a href="{{route('base_setup')}}">@lang('lang.base_setup')</a>
                                </li>
                         @endif-->

                         @if(userPermission(549) && menuStatus(549) )

                            <li  data-position="{{menuPosition(549)}}">
                                <a href="{{route('language-list')}}">@lang('lang.language')</a>
                            </li>
                        @endif

                        <!-- @if(userPermission(451) && menuStatus(451) )

                            <li  data-position="{{menuPosition(451)}}">
                                <a href="{{route('language-settings')}}">@lang('lang.language_settings')</a>
                            </li>
                        @endif -->
                        @if(userPermission(456) && menuStatus(465) )

                            <li  data-position="{{menuPosition(465)}}">
                                <a href="{{route('backup-settings')}}">@lang('lang.backup_settings')</a>
                            </li>
                        @endif
                        
                       <!-- @if(userPermission(444) && menuStatus(444) )

                            <li  data-position="{{menuPosition(444)}}">
                                <a href="{{route('sms-settings')}}">@lang('lang.sms_settings')</a>
                            </li>
                        @endif -->
                       
                        @if(userPermission(463) && menuStatus(463) )
                            <li  data-position="{{menuPosition(463)}}">
                                <a href="{{route('button-disable-enable')}}">@lang('lang.header') @lang('lang.option') </a>
                            </li>
                        @endif


     

                        @if(userPermission(478) && menuStatus(478) )

                            <li  data-position="{{menuPosition(478)}}">
                                <a href="{{route('update-system')}}"> @lang('lang.about') @lang('lang.&') @lang('lang.update')</a>
                            </li>
                        @endif

                        @if(userPermission(4000) && menuStatus(4000))

                                    <li data-position="{{menuPosition(4000)}}">
                                        <a href="{{route('utility')}}">@lang('lang.utilities')</a>
                                    </li>
                                @endif

                        @if(userPermission(482) && menuStatus(482) )
                        <li  data-position="{{menuPosition(482)}}">
                            <a href="{{route('api/permission')}}">@lang('lang.api') @lang('lang.permission') </a>
                        </li>
                    @endif
