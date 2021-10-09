@extends('backEnd.master')
@section('title') 
@lang('lang.lesson') @lang('lang.plan') @lang('lang.create')
@endsection
@section('mainContent')

<link rel="stylesheet" href="{{url('Modules/Lesson/Resources/assets/css/lesson_plan.css')}}">

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.lesson') @lang('lang.plan') @lang('lang.create')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.lesson') @lang('lang.plan')</a>
                    <a href="#">@lang('lang.lesson') @lang('lang.plan') @lang('lang.create')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  
                   @if(userPermission(810) )
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lesson-planner', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            {{-- <input type="text" name="teacher_id" value="{{$teacher_id}}"> --}}
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="teacher">
                                    <option data-display="@lang('lang.select_teacher') *" value="">@lang('lang.select_teacher') *</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ @$teacher->id }}"  {{isset($teacher_id)? ($teacher_id == $teacher->id?'selected':''):''}}>{{ @$teacher->full_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('teacher'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('teacher') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-6 mt-20 text-left">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    @endif
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

                    <h3 class="text-center "><a href="{{url('/lesson/dicrease-week/'.$teacher_id.'/'.$dates[0])}}"><</a> Week {{$week_number}} | <span class="yearColor"> {{date('Y', strtotime($dates[0]))}} </span><a href="{{url('/lesson/change-week/'.$teacher_id.'/'.$dates[6])}}"> > </a></h3> 
                {{-- {{ $dt =Carbon::now()->dayOfWeekIso}} --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "")
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Class Period</th>

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
                            <td>
                                @php
                                    $lesson_date=$dates[$j++];
                                @endphp                                
                                {{-- <input type="hidden" name="lesson_date" id="" value=" {{$dates[$j++]}}"> --}}
                                @if(@$class_time->is_break == 0)

                                @if(@$sm_weekend->is_weekend != 1)

                                @php
                                    @$assinged_class_routine = App\SmClassRoutineUpdate::teacherAssingedClassRoutine(@$class_time->id, @$sm_weekend->id, $teacher_id);

                                @endphp
                              
                                @if(@$assinged_class_routine == "")
                                            @lang('lang.n_a')
                                            
                                @else
                                @php
                                $class_id=$assinged_class_routine->class_id;
                                $section_id=$assinged_class_routine->section_id;   
                                $subject_id=$assinged_class_routine->subject_id;
                                @endphp
                              
                                    <span class=""><strong>{{@$assinged_class_routine->subject->subject_name}} </strong></span>
                                    
                                    <br>
                                    <span class="">class: {{@$assinged_class_routine->class->class_name}}</span><br>
                                    <span class="">section : {{@$assinged_class_routine->section->section_name}}</span></br>
                                    <span class="">Room:{{@$assinged_class_routine->classRoom->room_no}}</span></br>
                                        @php
                                       
                                        $lessonPlan=DB::table('lesson_planners')
                                                ->where('lesson_date',$lesson_date) 
                                                ->where('class_id',$class_id)     
                                                ->where('section_id',$section_id)    
                                                ->where('subject_id',$subject_id)                                             
                                                ->where('academic_id', getAcademicId())
                                                 ->where('school_id',Auth::user()->school_id)
                                                ->first();
                                                @endphp
                                        @if($lessonPlan)
                                        <div class="row">
                                               @if(userPermission(814))
                                            <div class="col-lg-2 text-right">
                                                <a href="{{route('view-lesson-planner-lesson', [$lessonPlan->id,$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])}}" 
                                                    class="primary-btn small tr-bg icon-only modalLink"
                                                    title="@lang('lang.lesson') @lang('lang.overview') " data-modal-size="modal-lg" >
                                                    <span class="ti-eye" id=""></span>
                                                </a>
                                            </div>
                                             @endif
                                               @if(userPermission(813))
                                                     <div class="col-lg-2 text-right">
                                                        <a href="{{route('delete-lesson-planner-lesson', [$lessonPlan->id])}}" 
                                                            class="primary-btn small tr-bg icon-only  modalLink" data-modal-size="modal-md" 
                                                            title="@lang('lang.delete') @lang('lang.lesson') @lang('lang.plan')">
                                                            <span class="ti-close" id=""></span>
                                                        </a>
                                                    </div>
                                             @endif
                                               @if(userPermission(812))
                                                    <div class="col-lg-2 text-right">
                                                        <a href="{{route('edit-lesson-planner-lesson', [$lessonPlan->id,$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])}}" 
                                                            class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                            title="@lang('lang.edit') @lang('lang.lesson') @lang('lang.plan') {{date('d-M-y',strtotime($lesson_date))}} ( {{date('h:i A', strtotime(@$assinged_class_routine->classTime->start_time))}}-{{date('h:i A', strtotime(@$assinged_class_routine->classTime->end_time))}} )">
                                                            <span class="ti-pencil" id=""></span>
                                                        </a>
                                                    </div>
                                                @endif
                                        </div>
                                        @else
                                       
                                            @if(userPermission(811))
                                                <div class="col-lg-6 text-right">
                                                    <a href="{{route('add-lesson-planner-lesson', [$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id,$lesson_date])}}" 
                                                        class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                        title="@lang('lang.add') @lang('lang.lesson') @lang('lang.plan') {{date('d-M-y',strtotime($lesson_date))}} ( {{date('h:i A', strtotime(@$assinged_class_routine->classTime->start_time))}}-{{date('h:i A', strtotime(@$assinged_class_routine->classTime->end_time))}} )">
                                                        <span class="ti-plus" id="addClassRoutine"></span>
                                                    </a>
                                                </div>
                                             @endif
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

