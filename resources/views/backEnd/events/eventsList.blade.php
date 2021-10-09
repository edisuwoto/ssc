@extends('backEnd.master')
@section('title') 
@lang('lang.event') @lang('lang.list')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.event') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.event') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($editData))
        @if(userPermission(295))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('event')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.event')
                            </h3>
                        </div>
                        @if(isset($editData))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('event-update',$editData->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                        @if(userPermission(295))
             
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'event',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    @if(session()->has('message-success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message-success') }}
                                    </div>
                                    @elseif(session()->has('message-danger'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('message-danger') }}
                                    </div>
                                    @endif

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('event_title') ? ' is-invalid' : '' }}"
                                            type="text" name="event_title" autocomplete="off" value="{{isset($editData)? $editData->event_title : '' }}">
                                            <label>@lang('lang.event') @lang('lang.title') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('event_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('event_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-20">

                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('for_whom') ? ' is-invalid' : '' }}" id="for_whom" name="for_whom">
                                            <option data-display="@lang('lang.for_whom') *" value="">@lang('lang.for_whom') *</option>
                                            
                                            <option value="All" {{isset($editData)? ($editData->for_whom == 'All'? 'selected' : ''):"" }}>@lang('lang.all')</option>
                                            <option value="Teacher" {{isset($editData)? ($editData->for_whom == 'Teacher'? 'selected' : ''):"" }}>@lang('lang.teacher')</option>
                                            <option value="Student" {{isset($editData)? ($editData->for_whom == 'Student'? 'selected' : ''):"" }}>@lang('lang.student')</option>
                                            <option value="Parents" {{isset($editData)? ($editData->for_whom == 'Parents'? 'selected' : ''):"" }}>@lang('lang.parents')</option>
                                            
                                            
                                        </select>
                                        @if ($errors->has('for_whom'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('for_whom') }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('event_location') ? ' is-invalid' : '' }}"
                                            type="text" name="event_location" autocomplete="off" value="{{isset($editData)? $editData->event_location : '' }}">
                                            <label>@lang('lang.event') @lang('lang.location') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('event_location'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('event_location') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>

                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}" id="event_from_date" type="text"
                                            name="from_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->from_date)): ''}}" autocomplete="off">
                                            <label>@lang('lang.start_date')<span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('from_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('from_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_start_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('to_date') ? ' is-invalid' : '' }}" id="event_to_date" type="text"
                                            name="to_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->to_date)): '' }}" autocomplete="off">
                                            <label>@lang('lang.to_date')<span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('to_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('to_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_end_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control {{ $errors->has('event_des') ? ' is-invalid' : '' }}" cols="0" rows="4" name="event_des">{{isset($editData)? $editData->event_des: ''}}</textarea>
                                            <label>@lang('lang.description') <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('event_des'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('event_des') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control {{ $errors->has('upload_file_name') ? ' is-invalid' : '' }}" type="text" 
                                            placeholder="{{isset($editData->uplad_image_file) && $editData->uplad_image_file != ""? getFilePath3($editData->uplad_image_file): trans('lang.attach_file').'*'}}"
                                              id="placeholderEventFile" readonly>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('upload_file_name'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('upload_file_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="upload_event_image">@lang('lang.browse')</label>
                                            <input type="file" class="d-none form-control" name="upload_file_name" id="upload_event_image" readonly="">
                                        </button>

                                    </div>
                                </div>
                                  @php 
                                  $tooltip = "";
                                  if(userPermission(295)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{ @$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
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
                @if(session()->has('message-success-delete'))
                <div class="alert alert-success">
                   {{ session()->get('message-success-delete') }}
               </div>
               @elseif(session()->has('message-danger-delete'))
               <div class="alert alert-danger">
                  {{ session()->get('message-danger-delete') }}
              </div>
              @endif
              <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">@lang('lang.event') @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                            <th>@lang('lang.event') @lang('lang.title')</th>
                            <th>@lang('lang.for_whom')</th>
                            <th>@lang('lang.from_date')</th>
                            <th>@lang('lang.to_date')</th>
                            <th>@lang('lang.location')</th>
                            <th>@lang('lang.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($events))
                        @foreach($events as $value)
                        <tr>

                            <td>{{ @$value->event_title}}</td>
                            <td>{{ @$value->for_whom}}</td>
                           
                            <td>{{ @$value->from_date != ""? dateConvert(@$value->from_date):''}}</td>

                          
                            <td  data-sort="{{strtotime(@$value->to_date)}}" >{{$value->to_date != ""? dateConvert(@$value->to_date):''}}</td>

                            <td>{{ @$value->event_location}}</td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        @lang('lang.select')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                         @if(userPermission(296))
                                         <a class="dropdown-item" href="{{route('event-edit',$value->id)}}">@lang('lang.edit')</a>
                                        @endif
                                         @if(userPermission(297) )
                                          <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Event" href="{{route('delete-event-view',$value->id)}}">@lang('lang.delete')</a>
                                        @endif
                                        @if($value->uplad_image_file != "")
                                                <a class="dropdown-item"
                                                    href="{{url(@$value->uplad_image_file)}}" download>
                                                    @lang('lang.download') <span class="pl ti-download"></span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
