@extends('backEnd.master')
@section('title')
@lang('lang.format') @lang('lang.settings')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.format') @lang('lang.settings')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.examination')</a>
                    <a href="#">@lang('lang.settings')</a>
                <a href="#">@lang('lang.format') @lang('lang.settings')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    @if(isset($editData))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.exam') @lang('lang.format')
                                </h3>
                            </div>
                    @if(isset($editData))
                    {{ Form::open(['class' => 'form-horizontal', 'files' => 'true', 'route' => 'update-exam-content', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" value="{{$editData->id}}">
                    @else
                    {{ Form::open(['class' => 'form-horizontal', 'files' => 'true', 'route' => 'save-exam-content', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mb-25">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif

                                        <div class="col-lg-12 mb-30">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('exam_type') ? ' is-invalid' : '' }}" name="exam_type">
                                                <option data-display="@lang('lang.select') @lang('lang.exam') *" value="">@lang('lang.select') @lang('lang.exam')  *</option>
                                                @foreach($exams as $exam)
                                                @if(!in_array($exam->id, $already_assigned))
                                                @if(isset($editData))
                                                <option value="{{$exam->id}}" {{isset($editData)? ($editData->exam_type == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                                @else
                                                    <option value="{{$exam->id}}">{{$exam->title}}</option>
                                                @endif
                                                    
                                                @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('exam_type'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('exam_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    type="text" name="title" autocomplete="off"
                                                    value="{{isset($editData)? @$editData->title:old('title')}}">
                                                <label> @lang('lang.controller') @lang('lang.title') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-10">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                    readonly="true" type="text"
                                                    placeholder="{{isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):trans('lang.signature')}}"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('file'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                    </br>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="upload_content_file">@lang('lang.browse')</label>
                                                <input type="file" class="d-none form-control" name="file" id="upload_content_file">
                                            </button>
                                        </div>
                                    </div>
                                    <code class="nowrap d-block mb-30">(Allow file jpg, png, jpeg, svg)</code>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('publish_date') ? ' is-invalid' : '' }}" id="upload_date" type="text"
                                                    name="publish_date"
                                                    value="{{isset($editData)? date('m/d/Y', strtotime(@$editData->publish_date)): date('m/d/Y')}}">
                                                <label>@lang('lang.result') @lang('lang.publication_date')* <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('publish_date'))
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('publish_date') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="apply_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <h4>@lang('lang.attendance')</h4>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" id="start_date" type="text"
                                                    name="start_date"
                                                    value="{{isset($editData)? date('m/d/Y', strtotime(@$editData->start_date)): date('m/d/Y')}}">
                                                <label>@lang('lang.start_date')* <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('start_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start_date"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" id="end_date" type="text"
                                                    name="end_date"
                                                    value="{{isset($editData)? date('m/d/Y', strtotime(@$editData->end_date)): date('m/d/Y')}}">
                                                <label>@lang('lang.end') @lang('lang.date')* <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('end_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="end_date"></i>
                                            </button>
                                        </div>
                                    </div>
                                        @php 
                                            $tooltip = "";
                                            if(userPermission(708) ){
                                                    @$tooltip = "";
                                                }else{
                                                    @$tooltip = "You have no permission to add";
                                                }
                                        @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" type="submit" data-toggle="tooltip" title="{{@$tooltip}}">
                                                <span class="ti-check"></span>
                                                @if(isset($editData))
                                                    @lang('lang.update') 
                                                @else
                                                    @lang('lang.save')
                                                @endif
                                                    @lang('lang.content')
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
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"> @lang('lang.exam')  @lang('lang.format') @lang('lang.list')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                    <tr>
                                        <td colspan="6">
                                            @if(session()->has('message-success-delete'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success-delete') }}
                                                </div>
                                            @elseif(session()->has('message-danger-delete'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger-delete') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> @lang('lang.exam')</th>
                                    <th> @lang('lang.title')</th>
                                    <th> @lang('lang.signature')</th>
                                    <th> @lang('lang.publish') @lang('lang.date')</th>
                                    <th> @lang('lang.start_date')</th>
                                    <th> @lang('lang.end') @lang('lang.date')</th>
                                    <th> @lang('lang.action')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($content_infos as $content_info)
                                    <tr>
                                        <td class="nowrap">{{@$content_info->examName->title}}</td>
                                        <td class="nowrap">{{$content_info->title}}</td>
                                        <td>
                                            @if ($content_info->file)
                                                <img src="{{asset($content_info->file)}}" width="100px">
                                            @endif
                                        </td>
                                        <td>{{dateConvert($content_info->publish_date)}}</td>
                                        <td>{{dateConvert($content_info->start_date)}}</td>
                                        <td>{{dateConvert($content_info->end_date)}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                @if(userPermission(708))
                                                <a class="dropdown-item" href="{{route('edit-exam-settings',$content_info->id)}}">@lang('lang.edit')</a>
                                                @endif
                                                @if(userPermission(709))
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal{{$content_info->id}}" href="#">
                                                        @lang('lang.delete')
                                                    </a>
                                                @endif
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteApplyLeaveModal{{$content_info->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.delete') @lang('lang.upload_content')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">@lang('lang.cancel')</button>
                                                            <a href="{{route('delete-content',$content_info->id)}}"
                                                               class="text-light">
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit">@lang('lang.delete')</button>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
