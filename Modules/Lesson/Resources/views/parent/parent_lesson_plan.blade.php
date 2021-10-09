@extends('backEnd.master')
@section('title') 
@lang('lang.lesson') @lang('lang.plan') 
@endsection
@section('mainContent')
<link rel="stylesheet" href="{{url('Modules/Lesson/Resources/assets/css/lesson_plan.css')}}">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{$student_detail->full_name}} - @lang('lang.lesson') @lang('lang.plan') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.lesson') @lang('lang.plan')</a>
                <a href="#">@lang('lang.lesson') @lang('lang.plan')</a>
            </div>
        </div>
    </div>
</section>

@if(isset($class_times))
<section class="mt-20">
    <div class="container-fluid p-0">
                <div class="row mt-40">
                    <div class="col-lg-12 col-md-12">
                        <div class="main-title">
                            <?php 
                            $dates[6];
                            if(isset($week_number)){
                                $week_number=$week_number;
                            } else{
                                $week_number=$this_week;
                            } 

                             ?>

                    <h3 class="text-center "><a href="{{url('/lesson/parent/dicrease-week/'.$student_detail->id.'/'.$dates[0])}}"><</a> week {{$week_number}} | <span class="yearColor"> {{date('Y', strtotime($dates[0]))}} </span> <a href="{{url('/lesson/parent/change-week/'.$student_detail->id.'/'.$dates[6])}}"> > </a></h3> 
                        
                        </div>
                    </div>
             </div>


        <div class="row">
            <div class="col-lg-12">
               
                <table id="default_table" class="display school-table " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> @lang('lang.class_period') </th>
                            @php
                            $i=0;
                             @endphp
                            @foreach($sm_weekends as $sm_weekend)
                            <th>{{@$sm_weekend->name}} <br>
                            {{date('d-M-y', strtotime($dates[$i++]))}}
                        </th>
                            @endforeach
                        </tr>
                    </thead>
                  
                    <tbody>
                            
                                
                       
                        @foreach($class_times as $class_time)
 
                        <tr>
                            <td>{{@$class_time->period}}<br>{{date('h:i A', strtotime(@$class_time->start_time)).' - '.date('h:i A', strtotime(@$class_time->end_time))}}</td>
                            @php
                            $j=0;
                            @endphp
                            @foreach($sm_weekends as $sm_weekend)
                            @php
                            $lesson_date=$dates[$j++];
                             @endphp 

                            <td>
                                @if(@$class_time->is_break == 0)
                                @if(@$sm_weekend->is_weekend != 1)
                                

                                @php
                                    @$assinged_class_routine = App\SmClassRoutineUpdate::assingedClassRoutine($class_time->id, $sm_weekend->id, $class_id, $section_id);

                                @endphp
                                @if(@$assinged_class_routine != "")
                                    <span class="">{{@$assinged_class_routine->subject->subject_name}}</span>
                                    <br>
                                    <span class="">{{@$assinged_class_routine->classRoom->room_no}}</span></br>
                                    <span class="tt">{{@$assinged_class_routine->teacherDetail->full_name}}</span></br>
                                

                                                                @php
                                       
                                $lessonPlan=DB::table('lesson_planners')
                                        ->join('sm_lessons','sm_lessons.id','=','lesson_planners.lesson_detail_id')
                                        ->join('sm_lesson_topic_details','sm_lesson_topic_details.id','=','lesson_planners.topic_detail_id')
                                        ->where('lesson_date',$lesson_date)
                                        ->where('class_period_id',$class_time->id)
                                        ->select('lesson_planners.id','sm_lessons.lesson_title','sm_lesson_topic_details.topic_title')
                                        ->first();
                               
                                @endphp
                                @if($lessonPlan)
                                <span class="tt" style="color: #212529;font-weight: 600;">@lang('lang.lesson') : {{@$lessonPlan->lesson_title}}</span><br>
                                <span class="tt" style="color: #212529;font-weight: 600;"> @lang('lang.topic') : {{@$lessonPlan->topic_title}}</span><br>
                                 <a href="{{route('view-lesson-planner-lesson', [$lessonPlan->id,$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])}}" 
                                                class="primary-btn small tr-bg icon-only mr-10 modalLink"
                                                title="@lang('lang.lesson') @lang('lang.overview') " data-modal-size="modal-lg" >
                                                <span class="ti-eye" id=""></span>
                                            </a>
                                             @endif
                                             @endif
                                @else

                                @lang('lang.weekend')

                                @endif
                                @endif



                            </td>
                               
           

                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               

            </div>
        </div>
    </div>
</section>

@endif



@endsection
