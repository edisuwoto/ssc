@extends('backEnd.master')

@section('title')
@lang('lang.update')  @lang('lang.system')
@endsection

@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.update')  @lang('lang.system') </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.update')  @lang('lang.system') </a>
                </div>
            </div>
        </div>
    </section>   

    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">

        {{-- <div class="row">
            <div class="offset-lg-8 col-lg-4 text-right col-md-12">
                <a href="{{route('database-upgrade')}}" class="primary-btn small fix-gr-bg  demo_view">
                    <span class="ti-support"></span>
                    @lang('lang.database')   {{__('sync')}}
                </a>
            </div>
        </div> --}}

            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-40 cust-lawngreen">@lang('lang.upload_from_local_directory')</h3>
                            </div>
                            @if(userPermission(479))
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'versionUpdateInstall', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif   
                            <div class="white-box sm_mb_20 sm2_mb_20 md_mb_20 ">
                                    <div class="add-visitor">

                                        <div class="row no-gutters input-right-icon mb-20">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control {{ $errors->has('updateFile') ? ' is-invalid' : '' }}" readonly="true" type="text"
                                                    placeholder="{{isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):'Upload File'}} "  id="placeholderUploadContent" name="updateFile">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('updateFile'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('updateFile') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="upload_content_file">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none form-control" name="updateFile" id="upload_content_file">
                                                </button>

                                            </div>
                                        </div>
                                        @php 
                                            $tooltip = "";
                                            if(userPermission(479)){
                                                    $tooltip = "";
                                                }else{
                                                    $tooltip = "You have no permission to add";
                                                }
                                        @endphp
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center"> 
                                                <button class="primary-btn fix-gr-bg submit"  data-toggle="tooltip" title="{{@$tooltip}}">
                                                    <span class="ti-check"></span>
                                                    @if(isset($session))
                                                        @lang('lang.update')
                                                    @else
                                                        @lang('lang.save')
                                                    @endif
                                                    @lang('lang.file')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="main-title mb-20" >
                                <h3 >@lang('lang.update') @lang('lang.details')</h3>
                            </div>
                        </div>

                        <div class="col-lg-9 text-right mb-20 title_custom_margin">
                            <div class="main-title">
                                <h3>
                                    <a href="{{route('database-upgrade')}}" class="primary-btn small fix-gr-bg  demo_view">
                                        <span class="ti-support"></span>
                                        @lang('lang.database')   {{__('sync')}}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <h1> @lang('lang.system') @lang('lang.info') </h1>
                                <div class="add-visitor">
                                    <table style="width:100%; box-shadow: none;" class="display school-table school-table-style">
                                      
                                        <tr>
                                            <td>@lang('lang.software_version')</td>
                                            <td>{{@file_get_contents('storage/app/.version')}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('lang.check_update')</td>
                                            <td><a href="#" target="_blank"> <i class="ti-new-window"> </i> Update </a> </td>
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
                                            <!--@if(! Illuminate\Support\Facades\Config::get('app.app_sync'))
                                                 @includeIf('service::license.revoke')
                                             @endif -->
                                             </td>
                                        </tr>
                            

                                        <tr>
                                            <td> @lang('lang.install_domain')</td>
                                            <td>{{@$data->system_domain}}</td>
                                        </tr>

                                        <tr>
                                            <td> @lang('lang.system_activation_date')</td>
                                            <td>{{@dateConvert($data->system_activated_date)}}</td>
                                        </tr>
                                        <tr>
                                            <td> @lang('lang.last') @lang('lang.update')</td>
                                            <td>
                                            @if(is_null($data->last_update))
                                                 {{@dateConvert($data->system_activated_date)}}
                                            @else
                                                    {{@dateConvert($data->last_update)}}
                                            @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                           
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


