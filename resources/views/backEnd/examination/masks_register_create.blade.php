@extends('backEnd.master')
@section('title')
@lang('lang.fill_marks')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.marks_register')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examination')</a>
                <a href="{{route('marks_register')}}">@lang('lang.marks_register')</a>
                <a href="{{route('marks_register_create')}}">@lang('lang.fill_marks')</a>
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
           
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks_register_create', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_subject']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
                                    @foreach($exam_types as $exam_type)
                                        <option value="{{$exam_type->id}}" {{isset($exam_id)? ($exam_id == $exam_type->id? 'selected':''):''}}>{{$exam_type->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="class_subject" name="class">
                                    <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-lg-3 mt-30-md" id="select_class_subject_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} select_class_subject" id="select_class_subject" name="subject">
                                    <option data-display="@lang('lang.select_subject') *" value="">@lang('lang.select_subject') *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_subject_loader">
                                    <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                </div>
                                @if ($errors->has('subject'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md" id="m_select_subject_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} m_select_subject_section" id="m_select_subject_section" name="section">
                                    <option data-display="@lang('lang.select_section') " value=" ">@lang('lang.select_section') </option>
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

@if(isset($students))
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.fill_marks') | 
                    <small>@lang('lang.exam'): {{$search_info['exam_name']}}, @lang('lang.class'): {{$search_info['class_name']}}, @lang('lang.section'): {{$search_info['section_name']}}
                    </h3>
                </div>
            </div>
        </div>


    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks_register_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'marks_register_store']) }} 


        <input type="hidden" name="exam_id" value="{{$exam_id}}">
        <input type="hidden" name="class_id" value="{{$class_id}}">
        <input type="hidden" name="section_id" value="{{$section_id}}">
        <input type="hidden" name="subject_id" value="{{$subject_id}}"> 

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th rowspan="2" >@lang('lang.admission_no').</th>
                            <th rowspan="2" >@lang('lang.roll_no').</th>
                            <th rowspan="2" >@lang('lang.class_Sec')</th>
                            <th rowspan="2" >@lang('lang.student')</th>
                            <th class="text-center" colspan="{{$number_of_exam_parts + 1}}"> {{$subjectNames->subject_name}}</th> 
                            <th rowspan="2">@lang('lang.is_present')</th>
                        </tr>
                        <tr>
                            @foreach($marks_entry_form as $part)
                            <th>{{$part->exam_title}} ( {{$part->exam_mark}} ) </th>
                            @endforeach
                            <th>@lang('lang.teacher') @lang('lang.remarks')</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @php $colspan = 3; $counter = 0;  @endphp
                        @foreach($students as $student)
                        @php
                            $absent_check = App\SmMarksRegister::is_absent_check($exam_id, $class_id, $student->section_id, $subject_id, $student->id);
                        @endphp
                        <tr>
                            <td>
                                <input type="hidden" name="student_ids[]" value="{{$student->id}}">
                                <input type="hidden" name="student_rolls[{{$student->id}}]" value="{{$student->roll_no}}">
                                <input type="hidden" name="student_admissions[{{$student->id}}]" value="{{$student->admission_no}}">
                                {{$student->admission_no}}
                            </td>
                            <td>{{$student->roll_no}}</td>
                            <td>{{$student->class->class_name.'('.$student->section->section_name .')' }}</td>
                            <td>{{$student->full_name}}</td>
                            @php $entry_form_count=0; @endphp
                            @foreach($marks_entry_form as $part)
                        
                            @php $d = 5 + rand()%5;   @endphp
                            <td>
                                <div class="input-effect mt-10">
                                <input type="hidden" name="exam_setup_ids[]" value="{{$part->id}}">
                                <?php 
                                $search_mark = App\SmMarkStore::get_mark_by_part($student->id, $part->exam_term_id, $part->class_id, $part->section_id, $part->subject_id, $part->id); 
                                ?>
                                    <input oninput="numberCheckWithDot(this)" class="primary-input marks_input" type="text" step="any" max="{{@$part->exam_mark}}"
                                    name="marks[{{$student->id}}][{{$part->id}}]" value="{{!empty($search_mark)?$search_mark:0}}" {{@$absent_check->attendance_type == 'A' || @$absent_check->attendance_type == ''? 'readonly':''}}>
                                    
                                    <input class="primary-input" type="hidden" name="exam_Sids[{{$student->id}}][{{$entry_form_count++}}]" value="{{$part->id}}">
                                    
                                    <input type="hidden" id="part_marks" name="part_marks" value="{{$part->exam_mark}}">
                                    
                                    <label>{{$part->exam_title}} Mark</label>
                                    <span class="focus-border"></span>
                                </div>                                
                            </td>
                            @endforeach
                            <?php 
                             $teacher_remarks = App\SmMarkStore::teacher_remarks($student->id, $exam_id, $student->class_id, $student->section_id, $subject_id); 
                            ?>
                            <td>
                                <div class="input-effect mt-10">
                                <input class="primary-input" type="text" name="teacher_remarks[{{$student->id}}][{{$part->subject_id}}]" value="{{$teacher_remarks}}" {{@$absent_check->attendance_type == 'A' || @$absent_check->attendance_type == ''? 'readonly':''}} >
                                <label>@lang('teacher') @lang('remarks')</label>
                                <span class="focus-border"></span>
                            </div>
                            </td>

                             <?php $is_absent_check = App\SmMarkStore::is_absent_check($student->id, $part->exam_term_id, $part->class_id, $part->section_id, $part->subject_id); ?>

                            <td>
                                <div class="input-effect">
                                    @if(@$absent_check->attendance_type == 'P')
                                    <button class="primary-btn small fix-gr-bg" type="button">@lang('lang.present')</button>
                                    @else
                                    <button class="primary-btn small bg-danger text-white border-0" type="button">@lang('lang.absent')</button>
                                    @endif                              


                                    @if(@$absent_check->attendance_type == 'A')
                                    <input type="text" name="absent_students[]" value="{{$student->id}}">
                                    @endif
                                </div>
                                    
                            </td>

                        </tr>
                        @endforeach 
                         @if(userPermission(224))
                        <tr>
                            <td colspan="{{count($marks_entry_form) + 5}}" class="text-center">
                                <button type="submit" class="primary-btn fix-gr-bg mt-20 submit">
                                    <span class="ti-check"></span>
                                    @lang('lang.save') @lang('lang.marks')
                                </button>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

               
         
            </div>
        </div>
    </div>
</section>

@endif

@endsection
