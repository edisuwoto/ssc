@extends('backEnd.master')
@section('title')
@lang('lang.about')  @lang('lang.system')
@endsection
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.about')  @lang('lang.system') </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.about')  @lang('lang.system') </a>
                </div>
            </div>
        </div>
    </section>
    @php
    $data = generalSetting();
    @endphp


    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                            <div class="white-box">
                                <h1>@lang('lang.about')  @lang('lang.system') </h1>
                                <div class="add-visitor">
                                    <table style="width:100%; box-shadow: none;" class="display school-table school-table-style">
                                        @php 
                                            @$data = DB::table('sm_general_settings')->first();
                                        @endphp
                                        <tr>
                                            <td>@lang('lang.software_version')</td>
                                            <td>{{(@$data->system_version)}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('lang.check_update')</td>
                                            <td><a href="https://codecanyon.net/user/codethemes/portfolio" target="_blank"> <i class="ti-new-window"> </i> Update </a> </td>
                                        </tr> 
                                        <tr>
                                            <td> @lang('lang.PHP_version')</td>
                                            <td>{{phpversion() }}</td>
                                        </tr>
                                        <tr>
                                            <td> @lang('lang.curl_enable')</td>
                                            <td>@php
                                            if  (in_array  ('curl', get_loaded_extensions())) {
                                                echo 'enable';
                                            }
                                            else {
                                                echo 'disable';
                                            }
                                            @endphp</td>
                                        </tr>
                           
                                        
                                        <tr>
                                            <td> @lang('lang.purchase_code')</td>
                                            <td>{{__('Verified')}}
                                            @if(! Illuminate\Support\Facades\Config::get('app.app_sync'))
                                                 @includeIf('service::license.revoke')
                                             @endif 
                                             </td>
                                        </tr>
                           

                                        <tr>
                                            <td> @lang('lang.install_domain')</td>
                                            <td>{{@$data->system_domain}}</td>
                                        </tr>

                                        <tr>
                                            <td> @lang('lang.system_activation_date')</td>
                                            <td>{{@$data->system_activated_date}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script language="JavaScript">

        $('#selectAll').click(function () {
            $('input:checkbox').prop('checked', this.checked);

        });


    </script>
@endsection


