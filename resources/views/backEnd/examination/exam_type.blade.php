@extends('backEnd.master')
@section('title')
@lang('lang.exam_type')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam_type')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examination')</a>
                <a href="#">@lang('lang.exam_type')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="offset-lg-9 col-lg-3 text-right col-md-12 mb-20">
                <a href="{{route('exam')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.exam_setup')
                </a>
            </div>

        </div>
        @if(isset($exam_type_edit))
         @if(userPermission(209))
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('exam-type')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
           

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($exam_type_edit))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.exam_type')
                            </h3>
                        </div>
                        @if(isset($exam_type_edit))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_update', 'method' => 'POST']) }}
                        @else
                         @if(userPermission(209))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_store', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success') }}
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger') }}
                                          </div>
                                        @endif
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('exam_type_title') ? ' is-invalid' : '' }}" type="text" name="exam_type_title" autocomplete="off" value="{{isset($exam_type_edit)? $exam_type_edit->title : ''}}">
                                            <input type="hidden" name="id" value="{{isset($exam_type_edit)? $exam_type_edit->id: Request::old('exam_type_title')}}">
                                            <label> @lang('lang.exam_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('exam_type_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('exam_type_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                    </div>
                                </div>  

                                {{-- <div class="row mt-25">
                                    @if(isset($exam_type_edit))
                                        <div class="col-lg-12 mt-30-md">
                                            <select class="w-100 bb niceSelect form-control {{ $errors->has('active_status') ? ' is-invalid' : '' }}" id="active_status" name="active_status">
                                                <option data-display=" @lang('lang.select_status') *" value="">@lang('lang.select_status') *</option>
                                                <option value="1" {{ (@$exam_type_edit->active_status ==1) ? 'selected' :''}}> @lang('lang.active')</option> 
                                                <option value="0" {{ (@$exam_type_edit->active_status ==0) ? 'selected' :''}}> @lang('lang.inactive')</option> 
                                            </select>
                                            @if ($errors->has('active_status'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('active_status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    @endif
                                </div> --}}

	                            @php 
                                  $tooltip = "";
                                  if(userPermission(209)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{@$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($exam_type_edit))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.exam_type')

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
                            <h3 class="mb-0 ">@lang('lang.exam_type') @lang('lang.list')</h3>
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
                                    <td colspan="5">
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
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.exam_name')</th>
                                    {{-- <th>@lang('lang.Status')</th> --}}
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=0; @endphp
                                @foreach($exams_types as $exams_type)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ @$exams_type->title}}</td>
                                    {{-- <td>{{( @$exams_type->active_status == 1) ? 'Active' : 'Inactive'}}</td>  --}}
                                    <td>
                                        <div class="dropdown-widget d-flex align-items-center flex-wrap">
                                                <div class="dropdown mr-1 mb-1">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        @if(userPermission(210))

                                                        <a class="dropdown-item" href="{{route('exam_type_edit', [$exams_type->id])}}">@lang('lang.edit')</a>
                                                        @endif
                                                        @if(userPermission(211))

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal{{@$exams_type->id}}"  href="#">@lang('lang.delete')</a>
                                                   @endif
                                                    </div>
                                                </div>
                                                 <a  class="primary-btn small tr-bg" href="{{route('exam-marks-setup',$exams_type->id)}}">
                                                    <span class="pl ti-settings"></span> @lang('lang.exam_setup')
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal{{@$exams_type->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.exam_type')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{route('exam_type_delete', [@$exams_type->id])}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
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
