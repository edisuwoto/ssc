@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.exam_result')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.examinations')</a>
                    <a href="{{route('parent_examination', [$student_detail->id])}}">@lang('lang.exam_result')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-6 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.student_information')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100" src="{{asset($student_detail->student_photo)}}" alt="">
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.student_name')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->first_name.' '.$student_detail->last_name}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.admission_no')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->admission_no}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.roll_number')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->roll_no}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.class')
                                    </div>
                                    <div class="value">
                                        @if($student_detail->className !="" && $student_detail->session !="")
                                            {{$student_detail->className->class_name}}
                                            ({{$student_detail->session->session}})
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.section')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->section !=""?$student_detail->section->section_name:""}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        @lang('lang.gender')
                                    </div>
                                    <div class="value">
                                        {{$student_detail->gender !=""?$student_detail->gender->base_setup_name:""}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Student Meta Information -->
                </div>
                <div class="col-lg-9">
                    <div class="no-search no-paginate no-table-info mb-2">
                        @php
                            $today = date('Y-m-d H:i:s');
                        @endphp
                        @foreach($exam_terms as $exam)
                            @php
                                $get_results = App\SmStudent::getExamResult(@$exam->id, @$student_detail);
                            @endphp
                            @if($get_results)
                                <div class="main-title">
                                    <h3 class="mb-0">{{@$exam->title}}</h3>
                                </div>
                                @php
                                    $grand_total = 0;
                                    $grand_total_marks = 0;
                                    $result = 0;
                                    $temp_grade=[];
                                    $total_gpa_point = 0;
                                    $total_subject = count($get_results);
                                    $optional_subject = 0;
                                    $optional_gpa = 0;
                                @endphp
                                @if($exam->examSettings->publish_date)
                                    @if($exam->examSettings->publish_date <=  $today)
                                        <table id="table_id" class="display school-table mb-5" cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th>
                                                    @lang('lang.date')
                                                </th>
                                                <th>
                                                    @lang('lang.subject') ( @lang('lang.full_marks'))
                                                </th>
                                                <th>
                                                    @lang('lang.obtained_marks')
                                                </th>
                                                <th>
                                                    @lang('lang.grade')
                                                </th>
                                                <th>
                                                    @lang('lang.gpa')
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($get_results as $mark)
                                                @php
                                                    if((!is_null($optional_subject_setup)) && (!is_null($student_optional_subject))){
                                                        if($mark->subject_id != @$student_optional_subject->subject_id){
                                                            $temp_grade[]=$mark->total_gpa_grade;
                                                        }
                                                    }else{
                                                        $temp_grade[]=$mark->total_gpa_grade;
                                                    }
                                                    $total_gpa_point += $mark->total_gpa_point;
                                                    if(! is_null(@$student_optional_subject)){
                                                        if(@$student_optional_subject->subject_id == $mark->subject->id && $mark->total_gpa_point  < @$optional_subject_setup->gpa_above ){
                                                            $total_gpa_point = $total_gpa_point - $mark->total_gpa_point;
                                                        }
                                                    }
                                                    $temp_gpa[]=$mark->total_gpa_point;
                                                    $get_subject_marks =  subjectFullMark ($mark->exam_type_id, $mark->subject_id );

                                                    $subject_marks = App\SmStudent::fullMarksBySubject($exam->id, $mark->subject_id);
                                                    $schedule_by_subject = App\SmStudent::scheduleBySubject($exam->id, $mark->subject_id, @$student_detail);
                                                    $result_subject = 0;
                                                    $grand_total_marks += $get_subject_marks;
                                                    if(@$mark->is_absent == 0){
                                                        $grand_total += @$mark->total_marks;
                                                        if($mark->marks < $subject_marks->pass_mark){
                                                        $result_subject++;
                                                        $result++;
                                                        }
                                                    }else{
                                                        $result_subject++;
                                                        $result++;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ !empty($schedule_by_subject->date)? dateConvert($schedule_by_subject->date):''}}
                                                    </td>
                                                    <td>
                                                        {{@$mark->subject->subject_name}}
                                                        ({{ @subjectFullMark($mark->exam_type_id, $mark->subject_id )}})
                                                    </td>
                                                    <td>
                                                        {{@$mark->total_marks}}
                                                    </td>
                                                    <td>
                                                        {{@$mark->total_gpa_grade}}
                                                    </td>
                                                    <td>
                                                        {{number_format(@$mark->total_gpa_point, 2, '.', '')}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    @lang('lang.grand_total'): {{$grand_total}}/{{$grand_total_marks}}
                                                </th>
                                                <th>
                                                    @lang('lang.grade'):
                                                    @php
                                                        if(in_array($failgpaname->grade_name,$temp_grade)){
                                                            echo $failgpaname->grade_name;
                                                            }else {
                                                                $final_gpa_point = ($total_gpa_point- $optional_gpa) /  ($total_subject - $optional_subject);
                                                                $average_grade=0;
                                                                $average_grade_max=0;
                                                                if($result == 0 && $grand_total_marks != 0){
                                                                    $gpa_point=number_format($final_gpa_point, 2, '.', '');
                                                                    if($gpa_point >= $maxgpa){
                                                                        $average_grade_max = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                        ->where('academic_id', getAcademicId() )
                                                                        ->where('from', '<=', $maxgpa )
                                                                        ->where('up', '>=', $maxgpa )
                                                                        ->first('grade_name');

                                                                        echo  @$average_grade_max->grade_name;
                                                                    } else {
                                                                        $average_grade = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                        ->where('academic_id', getAcademicId() )
                                                                        ->where('from', '<=', $final_gpa_point )
                                                                        ->where('up', '>=', $final_gpa_point )
                                                                        ->first('grade_name');
                                                                        echo  @$average_grade->grade_name;
                                                                    }
                                                            }else{
                                                                echo $failgpaname->grade_name;
                                                            }
                                                        }
                                                    @endphp
                                                </th>
                                                <th>
                                                    @lang('lang.gpa')
                                                    @php
                                                        $final_gpa_point = 0;
                                                        $final_gpa_point = ($total_gpa_point - $optional_gpa)/  ($total_subject - $optional_subject);
                                                        $float_final_gpa_point=number_format($final_gpa_point,2);
                                                        if($float_final_gpa_point >= $maxgpa){
                                                            echo $maxgpa;
                                                        }else {
                                                            echo $float_final_gpa_point;
                                                        }
                                                    @endphp
                                                </th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <div class="white-box mt-3">
                                            <table class="display school-table">
                                                <tr>
                                                    <th colspan="4" class="text-center">
                                                        {{ __('lang.Your result is not published yet.') }} {{ __('Your result publication date is: ')}}  {{ dateConvert($exam->examSettings->publish_date) }}
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                @else
                                    <div class="white-box mt-3">
                                        <table class="display school-table">
                                            <tr>
                                                <th colspan="4" class="text-center">
                                                    {{ __('lang.Your result is not published yet.')}}
                                                </th>
                                            </tr>
                                        </table>
                                    </div>

                                @endif
                            @else
                                <div class="white-box mt-3">
                                    <table class="display school-table">
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                {{ __('lang.No Result found')}}
                                            </th>
                                        </tr>
                                    </table>
                                </div>

                            @endif

                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
