@extends('backEnd.master')
@section('title')
@lang('lang.exam_schedule') @lang('lang.create')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam_schedule') @lang('lang.create') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examination')</a>
                <a href="{{route('exam_schedule')}}">@lang('lang.exam_schedule')</a>
                <a href="{{route('exam_schedule_create')}}">@lang('lang.exam_schedule') @lang('lang.create')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                     @if(session()->has('message-danger') != "")
                        @if(session()->has('message-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('message-danger') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_schedule_create', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                        <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
                                        @foreach($exam_types as $exam)
                                            <option value="{{@$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{@$exam->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('exam'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('exam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{@$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{@$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section') " value="">@lang('lang.select_section') </option>
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
                                
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(isset($assign_subjects))
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.exam_schedule')</h3>
                </div>
            </div>
        </div>


    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_schedule_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'exam_schedule_store']) }} 
        <input type="hidden" name="class_id" id="class_id" value="{{ @$class_id}}">
        <input type="hidden" name="section_id" id="section_id" value="{{ @$section_id}}">
        <input type="hidden" name="exam_id" id="exam_id" value="{{ @$exam_id}}"> 


        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "" || session()->has('danger') != "")
                        <tr>
                            <td colspan="20">
                                @if(session()->has('success') != "")
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @else
                                <div class="alert alert-success">
                                    {{ session()->get('danger') }}
                                </div>
                            </td>
                                @endif
                        </tr>
                        @endif
                        <tr>
                            <th width="10%">@lang('lang.subject')</th>
                            <th width="10%">@lang('lang.class_Sec')</th>
                            @foreach($exam_periods as $exam_period)
                            <th>{{ @$exam_period->period}}<br>{{date('h:i A', strtotime(@$exam_period->start_time)).'-'.date('h:i A', strtotime(@$exam_period->end_time))}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                           $section_id_all = $section_id;
                        @endphp
                        @foreach($assign_subjects as $assign_subject)
                        
                        <tr>
                            <td>{{@$assign_subject->subject !=""?@$assign_subject->subject->subject_name:""}}</td>
                            <td>{{@$assign_subject->className !=""? @$assign_subject->className->class_name:""}}({{@$assign_subject->section !=""?@$assign_subject->section->section_name:""}})</td>
                            @foreach($exam_periods as $exam_period)
                                @php
                                
                                    // $section_id_form_assign=$assign_subject->section_id;
                                
                                    // $assigned_routine = assignedRoutine($class_id, $section_id_form_assign, $exam_id, $assign_subject->subject_id, $exam_period->id);
                                    $assigned_routine = App\SmExamSchedule::assignedRoutine($class_id, $assign_subject->section_id, $exam_id, $assign_subject->subject_id, $exam_period->id);
                                @endphp
                            <td>
                                @if(@$assigned_routine == "")
                                    @if(@$assigned_routine_subject == "")
                                        @if(userPermission(219))
                                        <div class="col-lg-6">
                                            <a href="{{route('add-exam-routine-modal', [$assign_subject->subject_id, $exam_period->id, $class_id, $assign_subject->section_id, $exam_id,$section_id_all])}}" class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-md" title="@lang('lang.create') @lang('lang.exam_routine')">
                                                <span class="ti-plus" id="addClassRoutine"></span>
                                            </a>
                                        </div>
                                        @endif
                                    @endif
                                @else
                                    <div class="col-lg-6">
                                        <span class="">
                                            {{@$assigned_routine->classRoom !=""?@$assigned_routine->classRoom->room_no:""}}</span>
                                            <br>
                                        <span class="">                                           
                                            {{@$assigned_routine->date != ""? dateConvert($assigned_routine->date):''}}
                                        </span>
                                        </br>
                                        <a href="{{route('edit-exam-routine-modal', [$assign_subject->subject_id, $exam_period->id, $class_id, $assign_subject->section_id, $exam_id, $assigned_routine->id,$section_id_all])}}" class="modalLink" data-modal-size="modal-md" title="@lang('lang.edit') @lang('lang.exam_routine')">
                                            <span class="ti-pencil-alt" id="addClassRoutine"></span>
                                        </a>
                                        <a href="{{route('delete-exam-routine-modal', [$assigned_routine->id,$section_id_all])}}" class="modalLink" data-modal-size="modal-md" title="@lang('lang.delete') @lang('lang.exam_routine')">
                                            <span class="ti-trash" id="addClassRoutine"></span>
                                        </a>
                                    </div>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    {{ Form::close() }}    
    </div>
</section>
@endif
@endsection