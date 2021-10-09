@extends('backEnd.master')
@section('title') 
@lang('lang.add') @lang('lang.topic')
@endsection

@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.add') @lang('lang.topic')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.lesson') @lang('lang.plan')</a>
                <a href="#">@lang('lang.topic')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($data))
        @if(userPermission(806))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('exam')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>

        @endif
        @endif

        @if(userPermission(806))
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lesson.topic.store',
        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        @endif
   

        <div class="row">
           
            <div class="col-lg-3">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($data))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.topic')
                            </h3>
                        </div>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                     <div class="col-lg-12">

                                       <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{ @$class->id}}"  {{( old('class') == @$class->id ? "selected":"")}}>{{ @$class->class_name}}</option>
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

                                        <div class="col-lg-12" id="select_section_div">

                                           <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                                <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                                </select>
                                                <div class="pull-right loader" id="select_section_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="{{asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')}}" alt="" style="width: 28px;height:28px;">
                                                </div>  
                                                @if ($errors->has('section'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('section') }}</strong>
                                                </span>
                                                 @endif

                                        </div>
                                 </div>
                                <div class="row mt-25">
                                     <div class="col-lg-12" id="select_subject_div">
                                         <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} select_subject" id="select_subject" name="subject">
                                            <option data-display="@lang('lang.select_subject') *" value="">@lang('lang.select_subject')*</option>
                                        </select>

                                         <div class="pull-right loader" id="select_subject_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="{{asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')}}" alt="" style="width: 28px;height:28px;">
                                        </div>  
                                        @if ($errors->has('subject'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                        @endif
                                      </div>  
                                </div>
                                <div class="row mt-25">

                                        <div class="col-lg-12" id="select_lesson_div">

                                           <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_lesson" id="select_lesson" name="lesson">
                                            <option data-display="@lang('lang.select') @lang('lang.lesson') *" value="">@lang('lang.select') @lang('lang.lesson')*</option>
                                                </select>

                                                 <div class="pull-right loader" id="select_lesson_loader" style="margin-top: -30px;padding-right: 21px;">
                                                    <img src="{{asset('Modules/Lesson/Resources/assets/images/pre-loader.gif')}}" alt="" style="width: 28px;height:28px;">
                                                </div>  
                                                @if ($errors->has('lesson'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('lesson') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                 </div>

                             
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box mt-10">
                            <div class="row">
                                 <div class="col-lg-10">
                                    <div class="main-title">
                                        <h5>@lang('lang.add') @lang('lang.topic') </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowTopic();" id="addRowBtn">
                                    <span class="ti-plus pr-2"></span></button>
                                </div>
                            </div>
                            <table class="" id="productTable">
                                <thead>
                                    <tr>
                                  
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr id="row1" class="mt-40">
                                    <td >
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">  
                                           <input type="hidden"  id="lang" value="@lang('lang.title')"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}"
                                                type="text" id="topic" name="topic[]" autocomplete="off" value="{{isset($editData)? $editData->exam_title : '' }}" required="">
                                                <label>@lang('lang.title') *</label>
                                        </div>
                                    </td>
                                 
                                    <td >
                                         <button class="primary-btn icon-only fix-gr-bg" type="button">
                                             <span class="ti-trash"></span>
                                        </button>
                                       
                                    </td>
                                    </tr>
                                 
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                               @php 
                                  $tooltip = "";
                                  if(userPermission(806)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="white-box">                               
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                  <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{ @$tooltip}}">
                                                        <span class="ti-check"></span>
                                                        @if(isset($data))
                                                            @lang('lang.update')
                                                        @else
                                                            @lang('lang.save')
                                                        @endif
                                                        @lang('lang.topic')

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            {{ Form::close() }}

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.topic') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                        <tr>
                                            <th>@lang('lang.sl')</th>                                      
                                            <th>@lang('lang.class')</th>
                                            <th>@lang('lang.section')</th>
                                            <th>@lang('lang.subject')</th>
                                            <th>@lang('lang.lesson')</th>
                                            <th>@lang('lang.topic')</th>
                                            <th>@lang('lang.action')</th>
                                        </tr>
                            </thead>

                                     <tbody>
                                      @php $count =1 ; @endphp
                                        @foreach($topics as $data)

                                        <tr>
                                            <td>{{$count++}}</td>

                                            <td>{{$data->class !=""?$data->class->class_name:""}}</td>
                                            <td>{{$data->section !=""?$data->section->section_name:""}}</td>
                                            <td>{{$data->subject !=""?$data->subject->subject_name:""}}</td>                                           
                                            <td>{{$data->lesson !=""?$data->lesson->lesson_title:""}} </td>

                                            <td>
                                                @foreach($data->topics as $topicData)
                                                {{$topicData->topic_title}}, <br>
                                                @endforeach
                                            </td>
                                         

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                  
                                                       
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if(userPermission(807))
                                                            <a class="dropdown-item"
                                                                href="{{route('topic-edit', $data->id)}}">@lang('lang.edit')</a>
                                                         @endif
                                                        @if(userPermission(808))
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteExamModal{{$data->id}}"
                                                                href="#">@lang('lang.delete')</a>
                                                         @endif
                                                    </div>
                                                    
                                                </div> 
                                            </td>
                                        </tr>
                                            <div class="modal fade admin-query" id="deleteExamModal{{$data->id}}" >
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.topic')</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                            </div>

                                                            <div class="mt-40 d-flex justify-content-between">
                                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                                 {{ Form::open(['route' => array('topic-delete',$data->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                                 {{ Form::close() }}
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
@section('script')
<script type="text/javascript" src="{{url('Modules\Lesson\Resources\assets\js\app.js')}}"></script>
@stop

