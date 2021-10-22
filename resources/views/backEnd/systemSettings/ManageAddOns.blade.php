@extends('backEnd.master')

@section('title')
@lang('lang.module') @lang('lang.manage')
@endsection 

@section('mainContent')
   <link rel="stylesheet" href="{{ asset('public/vendor/spondonit/css/parsley.css') }}">
    <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        #waiting_loader{
            display: none;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.module') @lang('lang.manage')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.module') @lang('lang.manage')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 col-xs-6 col-md-6 col-6 no-gutters ">
                            <div class="main-title sm_mb_20 sm2_mb_20 md_mb_20 mb-30 ">
                                <h3 class="mb-0"> @lang('lang.module') @lang('lang.manage')</h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-xs-6 col-md-6 col-6 no-gutters mb-30 breadcumb-lawngreen">
                            <div class="row">
                                    <div class="col-lg-12">
                                    <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg" data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
                                        <span class="ti-plus pr-2"></span>
                                        @lang('lang.add') @lang('lang.module')
                                        </a>
                                   </div>
                             </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="default_table" class="display school-table school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.sl')</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.status')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    @php
                                        $modules= App\InfixModuleManager::get();
                                        $count=1;
                                        $module_array=[];
                                    @endphp
                                    @foreach($modules as $module)
                                        @php
                                            $is_module_available = 'Modules/' . $module->name. '/Providers/' .$module->name. 'ServiceProvider.php';
                                            $configName = $module->name;
                                            $module_array[]=$module->name;
                                            $version = @moduleVersion($module->name);
                                            if(is_null($version)){
                                                $version = $module->version;
                                            }
                                        @endphp
                                        <tr>
                                            @if($module->is_default==0)
                                                <td>{{$count++}}</td>
                                                <td>
                                                    @if($module->name == "Saas")
                                                    <strong>@lang('lang.saas')</strong>
                                                    @else
                                                    <strong>{{$module->name}}</strong>
                                                    @endif
                                                    <small class="text-success text-bold"> ( Version: {{ $version }}</small> )
                                                    <p>{{$module->notes}}</p>

                                                    @if(!empty($module->purchase_code)) 
                                                        <p class="text-success">
                                                            Verified | Published on 
                                                        {{date("F jS, Y", strtotime($module->activated_date))}}</p> 
                                                    @elseif(file_exists($is_module_available))
                                                        <p class="text-success"> Purchased </p> 
                                                    @else
                                                        <p class="text-danger"> Not Purchase </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if( moduleStatusCheck($module->name) == False) 
                                                        <a class="primary-btn small {{$module->name}} bg-warning text-white border-0"href="#">@lang('lang.disable')</a>
                                                    @elseif(moduleStatusCheck($module->name) == True)
                                                        <a class="primary-btn small {{$module->name}} bg-success text-white border-0" href="#">@lang('lang.active') </a>
                                                    @else
                                                        <a class="primary-btn small {{$module->name}} bg-success text-white border-0" href="#">Purchased</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(is_null($module->purchase_code) && (!file_exists($is_module_available)))
                                                        <a class="primary-btn fix-gr-bg" href="{{$module->addon_url}}" target="_blank">Buy Now</a>
                                                    @elseif(is_null($module->purchase_code) && (moduleStatusCheck($module->name) == False) && (file_exists($is_module_available) ))
                                                        <input type="hidden" name="name" value="{{$configName}}">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="col-lg-12 text-center">
                                                                    @if(userPermission(400))
                                                                        @if(Illuminate\Support\Facades\Config::get('app.app_pro'))
                                                                            <a class="primary-btn fix-gr-bg" data-toggle="modal" data-target="#proVerify{{$configName}}" href="#">@lang('lang.verify')</a>
                                                                        @else
                                                                            <a class="primary-btn fix-gr-bg" data-toggle="modal" data-target="#Verify{{$configName}}" href="#">@lang('lang.verify')</a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div id="waiting_loader" class="waiting_loader{{$module->name}}"><img src="{{asset('public/backEnd/img/demo_wait.gif')}}" width="44" height="44" /><br>Installing..</div>
                                                        @if(! Illuminate\Support\Facades\Config::get('app.app_sync'))
                                                            <label class="switch module_switch_label{{$module->name}}">
                                                                <input type="checkbox" data-id="{{$module->name}}" id="ch{{$module->name}}" class="switch-input1 module_switch" {{moduleStatusCheck($module->name) == false? '':'checked'}}>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        @endif 
                                                        @if( Illuminate\Support\Facades\Config::get('app.app_sync'))
                                                            <label class="switch module_switch_demo">
                                                                <input  type="checkbox" onClick="module_switch_demo()"  class="switch-input1 module_switch_demo" {{moduleStatusCheck($module->name) == false? '':'checked'}}>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        @endif 
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                        <div class="modal fade admin-query" id="proVerify{{$configName}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Module Verification</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST']) }}
                                                            <input type="hidden" name="name" value="{{$configName}}">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label for="user">Email :</label>
                                                                <input type="text" class="form-control " name="email" required="required" placeholder="Enter Your Email" value="{{old('email')}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="purchasecode">Purchase Code:</label>
                                                                <input type="text" class="form-control" name="purchase_code" required="required" placeholder="Enter Your Purchase Code" value="{{old('purchasecode')}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="domain">Installation Path:</label>
                                                                <input type="text" class="form-control" name="domain" required="required" value="{{url('/')}}" readonly>
                                                            </div>
                                                            <div class="row mt-40">
                                                                <div class="col-lg-12 text-center">
                                                                    <button class="primary-btn fix-gr-bg"><span class="ti-check"></span>@lang('lang.verify') </button>
                                                                </div>
                                                            </div>
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade admin-query" id="Verify{{$configName}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Module Verification</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ Form::open(['class' => 'form-horizontal', 'id' => 'content_form_'.$count , 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST']) }}
                                                            <input type="hidden" name="name" value="{{$configName}}">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label for="user">Envato Email :</label>
                                                                <input type="email" class="form-control" name="envatouser" required="required" placeholder="Enter Your Envato Email" value="{{old('envatouser')}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="purchasecode">Purchase Code:</label>
                                                                <input type="text" class="form-control" name="purchase_code" required id="purchase_code" placeholder="Enter Your Purchase Code" value="{{old('purchase_code')}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="domain">Installation Domain:</label>
                                                                <input type="text" class="form-control" name="installationdomain" required="required" placeholder="Enter Your Installation Domain" value="{{url('/')}}" readonly>
                                                            </div>
                                                            <div class="row mt-40">
                                                                <div class="col-lg-12 text-center">
                                                                    <button class="primary-btn fix-gr-bg"><span class="ti-check"></span>@lang('lang.verify')</button>
                                                                </div>
                                                            </div>
                                                        {{ Form::close() }}

                                                        @push('script')
                                                        @if($count == 2)
                                                            <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/parsley.min.js') }}"></script>
                                                            <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/function.js') }}"></script>
                                                            <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/common.js') }}"></script>
                                                        @endif
                                                            <script type="text/javascript">
                                                                _formValidation('content_form_{{$count}}');
                                                            </script>
                                                        @endpush
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                        
                                                    {{-- @foreach($is_module_available as $row)
                                                    @php
                                                        $is_module_available = 'Modules/' . $row->getName(). '/Providers/' .$row->getName(). 'ServiceProvider.php';
                                                        if (! file_exists($is_module_available)){
                                                            continue;
                                                        }
                                                        $is_data = \App\InfixModuleManager::where('name', $row->getName())->first();
                                                        

                                                    @endphp

                                                
                                                    {{-- @if('RolePermission' != $row->getName() && 'TemplateSettings' != $row->getName() && 'Lesson' != $row->getName()  && 'MenuManage' != $row->getName() && 'Chat' != $row->getName() )       
                                                    <tr>
                                                        <td>{{@$count++}}</td>
                                                        <td>
                                                        <strong> {{@$row->getName()}} </strong>
                                                            @if(!empty($is_data->purchase_code)) 
                                                            <p class="text-success">Verified |
                                                                Published
                                                                on {{date("F jS, Y", strtotime(@$is_data->activated_date))}}</p> 
                                                                @else<p
                                                                    class="text-danger"> Not Purchased @endif  </p>
                                                        </td>
                                                        <td>
                                                        
                                                            @if( moduleStatusCheck($row->getName() ) == False) 
                                                                <a class="primary-btn small {{@$row->getName()}} bg-warning text-white border-0"
                                                                href="#"> @lang('lang.disable') </a>
                                                            @else
                                                                <a class="primary-btn small {{@$row->getName()}} bg-success text-white border-0"
                                                                href="#"> @lang('lang.enable') </a>
                                                            @endif
                                                        </td>

                                                        <td>
                                                        
                                                            @if (file_exists($is_module_available))
                                                                @php
                                                                    $system_settings= App\SmGeneralSettings::first();
                                                                
                                                                    $is_moduleV= $is_data;
                                                                    $configName = $row->getName();
                                                                    $availableConfig= $system_settings->$configName;
                                                                    $check = App\InfixModuleManager::where('name', $row->getName())->first();
                                                                @endphp

                                                                @if(is_null( $check))
                                                                <a class="primary-btn fix-gr-bg" href="#">Buy Now</a>
                                                                

                                                                @elseif(@$availableConfig==0 || @@$is_moduleV->purchase_code== null)
                                                                    <input type="hidden" name="name" value="{{@$configName}}">
                                                                    <div class="row">

                                                                        <div class="col-lg-6">
                                                                            <div class="col-lg-12 text-center">
                                                                                @if(userPermission(400))
                                                                                    @if(Illuminate\Support\Facades\Config::get('app.app_pro'))
                                                                                    
                                                                                        <a class="primary-btn fix-gr-bg"
                                                                                        data-toggle="modal"
                                                                                        data-target="#proVerify{{@$configName}}"
                                                                                        href="#">@lang('lang.verify')</a>
                                                                                    @else
                                                                                
                                                                                        <a class="primary-btn fix-gr-bg"
                                                                                        data-toggle="modal"
                                                                                        data-target="#Verify{{@$configName}}"
                                                                                        href="#">@lang('lang.verify')</a>

                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @else
                                                                
                                                                    @if('RolePermission' != $row->getName() && 'TemplateSettings' != $row->getName() )
                                                                        <div id="waiting_loader" class="waiting_loader{{@$row->getName()}}"><img src="{{asset('public/backEnd/img/demo_wait.gif')}}" width="44" height="44" /><br>Installing..</div>
                                                                        <label class="switch module_switch_label{{@$row->getName()}}">

                                                                            <input type="checkbox" data-id="{{@$row->getName()}}" id="ch{{@$row->getName()}}" class="switch-input1 module_switch" {{moduleStatusCheck($row->getName() ) == false? '':'checked'}}>
                                                                            <span class="slider round"></span>

                                                                        </label>
                                                                    @else
                                                                        <p class="primary-btn fix-gr-bg small">Default</p>
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        </td>


                                                    </tr>
                                                    @endif --}}
                                                    
                                                    {{-- <div class="modal fade admin-query" id="proVerify{{@$configName}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Module Verification</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST']) }}
                                                                    <input type="hidden" name="name" value="{{@$configName}}">

                                                                    {{csrf_field()}}
                                                                    <div class="form-group">
                                                                        <label for="user">Email :</label>
                                                                        <input type="text" class="form-control " name="email"
                                                                            required="required" placeholder="Enter Your Email"
                                                                            value="{{old('email')}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="purchasecode">Purchase Code:</label>
                                                                        <input type="text" class="form-control" name="purchase_code"
                                                                            required="required"
                                                                            placeholder="Enter Your Purchase Code"
                                                                            value="{{old('purchasecode')}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="domain">Installation Path:</label>
                                                                        <input type="text" class="form-control" name="domain"
                                                                            required="required" value="{{url('/')}}" readonly>
                                                                    </div>
                                                                    <div class="row mt-40">
                                                                        <div class="col-lg-12 text-center">
                                                                            <button class="primary-btn fix-gr-bg">
                                                                                <span class="ti-check"></span>
                                                                                @lang('lang.verify') 
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    {{ Form::close() }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="modal fade admin-query" id="Verify{{@$configName}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Module Verification</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    {{ Form::open(['class' => 'form-horizontal', 'id' => 'content_form_'.$count , 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST']) }}
                                                                    <input type="hidden" name="name" value="{{@$configName}}">


                                                                    {{csrf_field()}} --}}
                                                                {{--  <div class="form-group">
                                                                        <label for="user">Envato Username :</label>
                                                                        <input type="text" class="form-control " name="envatouser"
                                                                            required="required"
                                                                            placeholder="Enter Your Envato User Name"
                                                                            value="{{old('envatouser')}}">
                                                                    </div> --}}
                                                                    {{-- <div class="form-group">
                                                                        <label for="purchasecode">Purchase Code:</label>
                                                                        <input type="text" class="form-control" name="purchase_code"
                                                                            required id="purchase_code" 
                                                                            placeholder="Enter Your Purchase Code"
                                                                            value="{{old('purchase_code')}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="domain">Installation Domain:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="installationdomain" required="required"
                                                                            placeholder="Enter Your Installation Domain"
                                                                            value="{{url('/')}}" readonly>
                                                                    </div>
                                                                    <div class="row mt-40">
                                                                        <div class="col-lg-12 text-center">
                                                                            <button class="primary-btn fix-gr-bg">
                                                                                <span class="ti-check"></span>
                                                                                @lang('lang.verify')
                                                                            </button>

                                                                        </div>
                                                                    </div> --}}

                                                                    {{-- {{ Form::close() }}

                                                                    @push('script')

                                                                    @if($count == 2)
                                                                        <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/parsley.min.js') }}"></script>
                                                                        <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/function.js') }}"></script>
                                                                        <script type="text/javascript" src="{{ asset('public/vendor/spondonit/js/common.js') }}"></script>
                                                                    @endif
                                                                    <script type="text/javascript">
                                                                        _formValidation('content_form_{{$count}}');
                                                                    </script>
                                                                    @endpush
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Module Add Modal Start Here -->
         <div class="modal fade admin-query" id="add_to_do">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('lang.add') @lang('lang.new') @lang('lang.module')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid"> 
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'moduleFileUpload', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()']) }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input form-control {{ $errors->has('module_file') ? ' is-invalid' : '' }}" readonly="true" type="text"
                                                    placeholder="{{isset($editData->upload_file) && @$editData->upload_file != ""? getFilePath3(@$editData->upload_file):trans('lang.file').' *'}}"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('module_file'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('module_file') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                        for="upload_content_file">@lang('lang.browse')</label>
                                                    
                                                <input type="file" class="d-none form-control" name="module_file"
                                                        id="upload_content_file">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="mt-40 d-flex justify-content-between">
                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                            <input class="primary-btn fix-gr-bg submit" type="submit" value="@lang('lang.submit')">
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- Module Add Modal End Here -->
    </section>
@endsection
@push('script')
    <script>
    function module_switch_demo(){
        toastr.warning("This function disabled for demo mode");
    }

        $(document).on('click','.module_switch',function (){
            var url = $("#url").val();
            var module = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                    $(".module_switch_label"+module).hide();
                    $(".waiting_loader"+module).show();
                },
                url: url + "/" + "manage-adons-enable/" + module,
                success: function(data) {
                    $(".waiting_loader"+module).hide();
                    $(".module_switch_label"+module).show();
                    if (data["success"]) {
                        if (data["data"] == "enable") {
                            $(`.${module}`).removeClass("bg-warning");
                            $(`.${module}`).addClass("bg-success");
                            $(`.${module}`).text("Enable");
                        } else {
                            $(`.${module}`).removeClass("bg-success");
                            $(`.${module}`).addClass("bg-warning");
                            $(`.${module}`).text("Disable");
                        }
                        toastr.success(data["success"], "Success Alert");
                        location.reload();
                    } else {
                        toastr.error(data["error"], "Faild Alert");
                    }
                },
                error: function(data) {
                    console.log("Error:", data["error"]);
                },
            })
        })

    </script>
    @endpush
