@extends('backEnd.master')
@section('mainContent')
@section('title') 
@lang('lang.subject') @lang('lang.wise') @lang('lang.attendance')
@endsection
<link rel="stylesheet" href="{{asset('public/backEnd/css/login_access_control.css')}}"/>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_attendance')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.student_information')</a>
                <a href="#">@lang('lang.student_attendance')</a>
            </div>
        </div>
    </div>
</section>
<style>
    .dataTables_wrapper .dataTables_paginate {
    text-align: right;
}
</style>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-md-6">
                    <a href="{{url('student-attendance-import')}}" class="primary-btn small fix-gr-bg pull-right"><span class="ti-plus pr-2"></span>Import Attendance</a>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-lg-12">  
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject-attendance-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select_class')*" value="">@lang('lang.select_class') *</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}"  {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div> 
                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div> 
                            <div class="col-lg-3 mt-30-md" id="select_subject_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} select_subject" id="select_subject" name="subject">
                                    <option data-display="Select subject *" value="">Select subject *</option>
                                </select>
                                @if ($errors->has('subject'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div> 
                            <div class="col-lg-3 mt-30-md">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('attendance_date') ? ' is-invalid' : '' }} {{isset($date)? 'read-only-input': ''}}" id="startDate" type="text"
                                                name="attendance_date" autocomplete="off" value="{{isset($date)? $date: date('m/d/Y')}}">
                                            <label for="startDate">@lang('lang.attendance') @lang('lang.date')*</label>
                                            <span class="focus-border"></span>
                                            
                                            @if ($errors->has('attendance_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('attendance_date') }}</strong>
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


            @if(isset($already_assigned_students))
                {{-- {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject-attendance-store-second', 'method' => 'POST', 'enctype' => 'multipart/form-data'])}} --}}

 
        <input class="subject_class" type="hidden" name="class" value="{{$input['class']}}">
        <input class="subject_section" type="hidden" name="section" value="{{$input['section']}}">
        <input class="subject" type="hidden" name="subject" value="{{$input['subject']}}">
        <input class="subject_attendance_date" type="hidden" name="attendance_date" value="{{$input['attendance_date']}}">
                    <div class="row mt-40">
                        <div class="col-lg-12 ">
                            <div class=" white-box mb-40">
                                <div class="row"> 
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30 text-center">@lang('lang.subject') @lang('lang.wise') @lang('lang.attendance') </h3>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <b> @lang('lang.class'): </b> {{$search_info['class_name']}}
                                    </div>
                                    <div class="col-lg-3">
                                        <b> @lang('lang.section'): </b> {{$search_info['section_name']}}
                                    </div>
                                    <div class="col-lg-3">
                                        <b> @lang('lang.subject'): </b> {{$search_info['subject_name']}}
                                    </div>
                                    <div class="col-lg-3">
                                        <b> @lang('lang.date'): </b> {{dateConvert($search_info['date'])}}
                                    </div>
                                </div> 
                            </div> 

                            <div class="row">
                                <div class="col-lg-12 col-md-12 no-gutters">
                                    @if($attendance_type != "" && $attendance_type == "H")
                                    <div class="alert alert-warning">@lang('lang.attendance_already_submitted_as_holiday')</div>
                                    @elseif($attendance_type != "" && $attendance_type != "H")
                                    <div class="alert alert-success">@lang('lang.attendance_already_submitted')</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-20">
                                <div class="col-lg-6  col-md-6 no-gutters text-md-left mark-holiday ">
                                @if($attendance_type != "H")
                                    <form action="{{route('student-subject-holiday-store')}}" method="POST">
                                        @csrf
                                    <input type="hidden" name="purpose" value="mark">
                                    <input type="hidden" name="class_id" value="{{$input['class']}}">
                                    <input type="hidden" name="section_id" value="{{$input['section']}}">
                                    <input type="hidden" name="subject_id" value="{{$input['subject']}}">
                                    <input type="hidden" name="attendance_date" value="{{$input['attendance_date']}}">
                                        <button type="submit" class="primary-btn fix-gr-bg mb-20">
                                            @lang('lang.mark_holiday')
                                        </button>
                                </form>
                                @else
                                <form action="{{route('student-subject-holiday-store')}}" method="POST">
                                        @csrf
                                    <input type="hidden" name="purpose" value="unmark">
                                    <input type="hidden" name="class_id" value="{{$input['class']}}">
                                    <input type="hidden" name="section_id" value="{{$input['section']}}">
                                    <input type="hidden" name="subject_id" value="{{$input['subject']}}">
                                    <input type="hidden" name="attendance_date" value="{{$input['attendance_date']}}">
                                        <button type="submit" class="primary-btn fix-gr-bg mb-20">
                                            @lang('lang.unmark_holiday')
                                        </button>
                                </form>
                                @endif
                            </div>
                            </div> 
                            <input type="hidden" name="date" value="{{isset($date)? $date: ''}}">

                            {{-- <div class="d-flex justify-content-between mb-20">
                                <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='{{url('student-attendance-holiday')}}'">
                                    <span class="ti-hand-point-right pr"></span>
                                    mark as holiday
                                </button>
                            </div>
                             --}}
                            <div class="row ">
                                <div class="col-lg-12">
                                    <form name="frm-example" id="frm-example" method="POST">
                                      
                                        @csrf
                                        
                                    <table id="default_table" class="display school-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.sl')</th>
                                                <th>@lang('lang.admission') @lang('lang.no')</th>
                                                <th>@lang('lang.student') @lang('lang.name')</th>
                                                <th>@lang('lang.roll') @lang('lang.number')</th>
                                                <th>@lang('lang.attendance')</th>
                                                <th>@lang('lang.note')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $count=1; @endphp
                                            @foreach($already_assigned_students as $already_assigned_student)
                                            @php
                                                $studentInfo=App\SmStudent::where('id','=',$already_assigned_student->student_id)->first();
                                            @endphp
                                            <tr>
                                                <td> STD- {{$count++}}
                                                    <input type="text" hidden name="class_id" value="{{$input['class']}}">
                                                    <input type="text" hidden name="section_id" value="{{$input['section']}}">
                                                    <input type="text" hidden name="subject_id" value="{{$input['subject']}}">
                                                    <input type="text" hidden name="attendance_date" value="{{$input['attendance_date']}}">
                                                 </td>
                                                <td>{{$studentInfo->admission_no}}<input type="hidden" name="id[]" value="{{$studentInfo->id}}"></td>
                                                <td>
                                                    @if(!empty($studentInfo))
                                                    {{$studentInfo->first_name.' '.$studentInfo->last_name}}
                                                    @endif
                                                </td>
                                                <td>{{$studentInfo!=""?$studentInfo->roll_no:""}}</td>
                                                <td>
                                                   
                                                    <label class="switch">
                                                        <input type="checkbox" value="P" name="status[{{$studentInfo->id}}]" {{$already_assigned_student->attendance_type == "P"? 'checked':''}}  class="switch-input11">
                                                        <span class="slider round"></span>
                                                      </label>
                                                </td>
                                                <td>
                                                    <div class="input-effect">
                                                        <textarea class="primary-input form-control note_{{$studentInfo->id}}" cols="0" rows="2" name="note[{{$studentInfo->id}}]" id="">{{$already_assigned_student->notes}}</textarea>
                                                        <label>@lang('lang.add_note_here')</label>
                                                        <span class="focus-border textarea"></span>
                                                        <span class="invalid-feedback">
                                                            <strong>@lang('lang.error')</strong>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @foreach($new_students as $student)
                                            <tr>
                                                <td>{{$count++}}
                                                    <input type="text" hidden name="class_id" value="{{$input['class']}}">
                                                    <input type="text" hidden name="section_id" value="{{$input['section']}}">
                                                    <input type="text" hidden name="subject_id" value="{{$input['subject']}}">
                                                    <input type="text" hidden name="attendance_date" value="{{$input['attendance_date']}}">
                                                 </td>
                                                <td>{{$student->admission_no}}<input type="hidden" name="id[]" value="{{$student->id}}"></td>
                                                <td>{{$student->first_name.' '.$student->last_name}}</td>
                                                <td>{{$student->roll_no}}</td>
                                                <td>
                                                

                                                    <label class="switch">
                                                        <input type="checkbox" value="P" name="status[{{$student->id}}]" checked  class="switch-input11">
                                                        <span class="slider round"></span>
                                                      </label>
                                                </td>
                                                <td>
                                                    <div class="input-effect">
                                                        <textarea class="primary-input form-control note_{{$student->id}}" cols="0" rows="2" name="note[{{$student->id}}]" id=""></textarea>
                                                        <label>@lang('lang.add_note_here')</label>
                                                        <span class="focus-border textarea"></span>
                                                        <span class="invalid-feedback">
                                                            <strong>@lang('lang.error')</strong>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <div class="col-lg-12 mt-20 text-center">
                                        <button type="submit" class="primary-btn small fix-gr-bg">
                                            <span class="ti-search pr-2"></span>
                                            @lang('lang.save')
                                        </button>
                                    </div> --}}
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                
                                                <button type="submit" class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    @lang('lang.save')
                                                </button>
                
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- {{ Form::close() }} --}}

            
            @endif

    </div>
</section>


@endsection
@push('script')
<script>
  $(document).ready(function (){
   var table = $('#default_table').DataTable();
   
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      e.preventDefault();


      // Serialize form data
      var data = table.$('input,select,textarea').serialize();
      // Submit form data via Ajax
      $.ajax({
        url : "{{route('subject-attendance-store-second')}}",
        method : "POST",
         data: data,
         success : function (result){
             console.log(result);
                    toastr.success('Attendance Has Been Saved', 'Successful', {
                    timeOut: 5000
            })
        }
      });
      
   });      
});
    </script>

    <script>
        $(document).on('change','.subject_attendance_type',function (){
            let studentId = $(this).data('id');
            let subjectAttendanceType ='';
            if ($(this).is(':checked'))
            {
                subjectAttendanceType = $(this).val();
            }
            let subjectClass = $('.subject_class').val();
            let subjectSection = $('.subject_section').val();
            let subject = $('.subject').val();
            let subjectAttendanceDate = $('.subject_attendance_date').val();
            let notes = $('.note_'+studentId).val();
            $.ajax({
                url : "{{route('subject-attendance-store-second')}}",
                method : "POST",
                data : {
                    class : subjectClass,
                    section : subjectSection,
                    subject : subject,
                    student_id : studentId,
                    attendance_type : subjectAttendanceType,
                    date : subjectAttendanceDate,
                    notes : notes,
                },
                success : function (result){
                    toastr.success('Attendance Has Been Saved', 'Successful', {
                        timeOut: 5000
                    })
                }
            })
        })
    </script>
    @endpush
