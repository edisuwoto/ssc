@extends('backEnd.master')
@section('title') 
@lang('lang.student') @lang('lang.import')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student') @lang('lang.import')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.student_admission')</a>
                <a href="#">@lang('lang.student') @lang('lang.import')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3>@lang('lang.select_criteria')</h3>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-3 text-right mb-20">
                <a href="{{url('/public/backEnd/bulksample/students.xlsx')}}">
                    <button class="primary-btn tr-bg text-uppercase bord-rad">
                        @lang('lang.download_sample_file')
                        <span class="pl ti-download"></span>
                    </button>
                </a>
            </div>
        </div>

    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_bulk_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form']) }}
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

                <div class="white-box">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <div class="box-body">      
                                        <br>           
                                        1. @lang('lang.point1')<br>
                                        2. @lang('lang.point2')<br>
                                        3. @lang('lang.point3')<br>
                                        4. @lang('lang.point4')<br>
                                        
                                        5. @lang('lang.point6')(
                                        @foreach($genders as $gender)
                                            {{$gender->id.'='.$gender->base_setup_name.','}}

                                        @endforeach


                                        ).<br>
                                        6. @lang('lang.point7')(
                                        @foreach($blood_groups as $blood_group)
                                            {{$blood_group->id.'='.$blood_group->base_setup_name.','}}

                                        @endforeach
                                        ).<br>
                                        7. @lang('lang.point8')(
                                        @foreach($religions as $religion)
                                            {{$religion->id.'='.$religion->base_setup_name.','}}

                                        @endforeach
                                        ).<br>
                                        8. For relation with guardian (F=Father, M=Mother, O=Other)<br>
                                        9. Please follow this date format(2020-06-15) for Date of birth & Admission date<br>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="row mb-40 mt-30">

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('session') ? ' is-invalid' : '' }}" name="session" id="academic_year">
                                        <option data-display="@lang('lang.academic_year') *" value="">@lang('lang.academic_year') *</option>
                                        @foreach($sessions as $session)
                                        <option value="{{$session->id}}" {{old('session') == $session->id? 'selected': ''}}>{{$session->year}}[{{$session->title}}]</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('session'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('session') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect" id="class-div">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="classSelectStudent">
                                        <option data-display="@lang('lang.class') *" value="">@lang('lang.class') *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" id="sectionSelectStudent">
                                       <option data-display="@lang('lang.section') *" value="">@lang('lang.section') *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" type="text" id="placeholderPhoto" placeholder="Excel file"
                                                readonly>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('file'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" name="file" id="photo">
                                        </button>
                                    </div>
                                </div>
                            </div>
                                
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    @lang('lang.save_bulk_students')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    </div>
</section>
@endsection
