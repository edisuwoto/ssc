@extends('backEnd.master')
@section('title')
@lang('lang.online_exam')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.online_exam')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.online_exam')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($online_exam))
         @if(userPermission(239))    
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('online-exam')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($online_exam))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.online_exam')
                            </h3>
                        </div>
                        @if(isset($online_exam))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('online-exam-update',$online_exam->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(userPermission(239))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online-exam',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
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
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                type="text" name="title" autocomplete="off"  value="{{isset($online_exam)? $online_exam->title: old('title')}}">
                                            <input type="hidden" name="id"  value="{{isset($online_exam)? $online_exam->id: ''}}">
                                            <label>@lang('lang.exam_title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="classSelectStudentHomeWork" name="class">
                                            <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}" {{isset($online_exam)? ($class->id == $online_exam->class_id? 'selected':''): (old('class') == $class->id? 'selected':'')}}>{{$class->class_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                   
                                </div>
                           
                                <div class="row mt-25">
                                    <div class="col-lg-12" id="subjectSelecttHomeworkDiv">
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subjectSelect" name="subject">
                                            <option data-display="@lang('lang.select_subjects') *" value="">@lang('lang.select_subjects')  *</option>
                                            @if(isset($online_exam))
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->subject_id}}" {{$online_exam->subject_id == $subject->subject_id? 'selected': ''}}>{{$subject->subject->subject_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="pull-right loader loader_style" id="select_subject_loader">
                                            <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                        </div>
                                        @if ($errors->has('subject'))
                                        <span class="invalid-feedback invalid-select" role="alert" >
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    @if(isset($online_exam)) 
                                    <div class="col-lg-12 mt-30-md" id="select_section_div">
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                            <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                            @if(isset($online_exam))
                                                @foreach($sections as $section)
                                                    <option value="{{$section->section_id}}" {{$online_exam->section_id == $section->section_id? 'selected': ''}}>{{$section->section->section_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="pull-right loader loader_style" id="select_section_loader">
                                            <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                        </div>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                   @else

                                    <div class="col-lg-12" id="selectSectionsDiv">
                                        <label for="checkbox" class="mb-2">@lang('lang.section') *</label>
                                        <select multiple id="selectSectionss" name="section[]" style="width:300px">
                                                                                  

                                         </select>
                                        <div class="">
                                            <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                            <label for="checkbox_section" class="mt-3">@lang('lang.select_all')</label>
                                        </div>
                                        @if ($errors->has('section'))
                                            <span class="invalid-feedback invalid-select" role="alert" style="display:block">
                                                <strong style="top:-25px">{{ $errors->first('section') }}</strong>
                                            </span>
                                        @endif
                                     </div>    
                                     @endif                               
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" name="date" autocomplete="off" value="{{isset($online_exam)? date('m/d/Y', strtotime($online_exam->date)): (old('date') != ""? old('date'): date('m/d/Y'))}}" >
                                            <label>@lang('lang.date')  <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" id="end_date" type="text" name="date" autocomplete="off" value="{{isset($online_exam)? date('m/d/Y', strtotime($online_exam->end_date)): (old('end_date') != ""? old('end_date'): date('m/d/Y'))}}" >
                                            <label>@lang('lang.end') @lang('lang.date') <span>*</span></label>
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
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" type="text" name="start_time" value="{{isset($online_exam)? $online_exam->start_time: old('start_time')}}">
                                            <label>@lang('lang.start_time')</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('start_time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start_time') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-timer"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input time  form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" type="text" name="end_time"  value="{{isset($online_exam)? $online_exam->end_time: old('end_time')}}">
                                                <label>@lang('lang.end_time')</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('end_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_time') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </div>
                                    </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control{{ $errors->has('percentage') ? ' is-invalid' : '' }}"
                                                type="text" name="percentage" autocomplete="off" value="{{isset($online_exam)? $online_exam->percentage: old('percentage')}}">
                                            <input type="hidden" name="id" value="{{isset($group)? $group->id: ''}}">
                                            <label>@lang('lang.minimum_percentage') *</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('percentage'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percentage') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('instruction') ? ' is-invalid' : '' }}" cols="0" rows="4" name="instruction">{{isset($online_exam)? $online_exam->instruction: old('instruction')}}</textarea>
                                            <label>@lang('lang.instruction') <span>*</span></label>
                                            <span class="focus-border textarea"></span>
                                            @if($errors->has('instruction'))
                                                <span class="error text-danger"><strong>{{ $errors->first('instruction') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- For next update --}}
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input type="checkbox" id="auto_mark"
                                                    class="common-checkbox form-control{{ @$errors->has('auto_mark') ? ' is-invalid' : '' }}" {{isset($online_exam) && $online_exam->auto_mark == 1? 'checked': ''}}  name="auto_mark" value="1">
                                            <label for="auto_mark">@lang('lang.Auto_Mark_Register')</label>
                                            <span> (@lang('lang.Only_for_Multiple'))</span>
                                        </div>
                                    </div>
                                </div>
                                
                                 @php 
                                  $tooltip = "";
                                  if(userPermission(239)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($online_exam))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.online_exam')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="url" value="{{Request::url()}}">
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.online_exam') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.class_Sec')</th>
                                    <th>@lang('lang.subject')</th>
                                    <th>@lang('lang.exam_date')</th>
                                    <th>@lang('lang.duration')</th>
                                    <th>@lang('lang.minimum_percentage')</th>
                                    <th>@lang('lang.Status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($online_exams as $online_exam)
                                <tr>
                                    <td>{{$online_exam->title}}</td>
                                    <td>
                                        @php
                                        if($online_exam->class !="" && $online_exam->section !="" ){
                                         echo $online_exam->class->class_name.'  ('.$online_exam->section->section_name.')';
                                        }
                                        @endphp
                                       </td>
                                    <td>{{$online_exam->subject!=""?$online_exam->subject->subject_name:""}}</td>
                                    <td>
                                        
                                    {{$online_exam->date != ""? dateConvert($online_exam->date):''}}

                                     <br> @lang('lang.time'): {{date("h:i A", strtotime($online_exam->start_time)).' - '.date("h:i A", strtotime($online_exam->end_date_time))}}</td>

                                     @php 
                                      $totalDuration = Carbon::parse($online_exam->end_time)->diffinminutes( Carbon::parse($online_exam->start_time) );
                                      @endphp
                                    <td>
                                        {{gmdate($totalDuration)}} Min
                                    </td>
                                    <td>
                                        {{@$online_exam->percentage}}
                                    </td>
                                    <td>
                                        @if($online_exam->status == 0)
                                         <button class="primary-btn small bg-warning text-white border-0">@lang('lang.pending')</button>
                                         @else
                                         <button class="primary-btn small bg-success text-white border-0">@lang('lang.published')</button>
                                         @endif
                                    </td>
                                    <td style="width: 30%">
                                        <div class="dropdown d-flex">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @php 
                                                    $is_set_online_exam_questions = DB::table('sm_online_exam_question_assigns')->where('online_exam_id', $online_exam->id)->first();
                                                    $startTime = strtotime($online_exam->date . ' ' . $online_exam->start_time);
                                                    $endTime = strtotime($online_exam->date . ' ' . $online_exam->end_time);
                                                    $now = date('h:i:s');
                                                    $now =  strtotime("now");
                                                @endphp
                                                @if ($startTime < $now && $online_exam->status == 1)
                                                    
                                                @else
                                                    @if(!empty($is_set_online_exam_questions)) 
                                                        @if(userPermission(242)) 
                                                        <a class="dropdown-item" href="{{route("manage_online_exam_question", [$online_exam->id])}}">@lang('lang.manage_question')</a>
                                                        
                                                        @endif
                                                    @endif
                                                @endif
                                                
                                                @if($startTime < $now && $online_exam->status == 1)
                                                    @if(userPermission(243))

                                                    <a class="dropdown-item" href="{{route("online_exam_marks_register", [$online_exam->id])}}">@lang('lang.marks_register')</a>
                                                    @endif
                                                @endif

                                                @if ($startTime < $now && $online_exam->status == 1)
                                                    
                                                @else
                                                    @if(userPermission(240))

                                                    <a class="dropdown-item" href="{{route("online-exam-edit",$online_exam->id)}}">@lang('lang.edit')</a>

                                                    @endif
                                                    @if(userPermission(241))
                                                
                                                    <a onclick="examDelete({{$online_exam->id}})" href="javascript:void(0)" class="dropdown-item "  >@lang('lang.delete')</a>
                                                    @endif
                                                @endif
                                                @if(!empty($is_set_online_exam_questions)) 
                                                        @if(userPermission(242)) 
                                                            <a class="dropdown-item" href="{{route("online-exam-question-view", [$online_exam->id])}}">@lang('lang.view') @lang('lang.question')</a>
                                                        @endif
                                                @endif
                                                @if($online_exam->end_date_time < $present_date_time && $online_exam->status == 1)
                                                @if(userPermission(244))
                                                <a class="dropdown-item" href="{{route('online_exam_result', [$online_exam->id])}}">@lang('lang.result')</a>
                                                @endif
                                            @endif
                                            </div> 
                                            @if(empty($is_set_online_exam_questions)) 
                                                @if(userPermission(242)) 
                                                    <a class="primary-btn small bg-success text-white border-0 ml-3" href="{{route("manage_online_exam_question", [$online_exam->id])}}">
                                                        {{__('Set')}} @lang('lang.question')
                                                    </a>
                                                @endif
                                            @else
                                            
                                                @if($online_exam->status == 0)
                                                    <a class="ml-3" href="{{route('online_exam_publish', [$online_exam->id])}}">
                                                        <button class="primary-btn small bg-success text-white border-0">@lang('lang.published_now') </button>
                                                    </a> 
                                                @endif
                                             @endif
                                        </div>
                                        
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteOnlineExam">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.online_exam')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="online_exam_id" id="online_exam_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
@push('script')
<script>
    function examDelete(id){
        var modal = $('#deleteOnlineExam');
         modal.find('input[name=online_exam_id]').val(id)
         modal.modal('show');
    }
</script>    
@endpush
