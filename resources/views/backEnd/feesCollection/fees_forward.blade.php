@extends('backEnd.master')
@section('title') 
@lang('lang.fees_forward')
@endsection
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); 
if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }
else{ $currency = '$'; } 
@endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.fees_forward')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="#">@lang('lang.fees_forward')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees-forward-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
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
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                    </select>
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
    @if(isset($students))

        
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'route' => 'fees-forward-store', 'enctype' => 'multipart/form-data'])}}
       


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.previous_Session_Balance_Fees')</h3>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="update" value="{{isset($update)? 1: ''}}">
                      
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                
                                <thead>
                                    @if(isset($update))
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert">
                                            <h4 class="mb-0"> @lang('lang.previous_balance_can_only_update_now.') </h4>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th width="15%">@lang('lang.student') @lang('lang.name')</th>
                                        <th width="15%">@lang('lang.admission') @lang('lang.no')</th>
                                        <th width="15%">@lang('lang.roll') @lang('lang.no')</th>
                                        <th width="15%">@lang('lang.father_name')</th>
                                        <th width="15%">@lang('lang.balance') ({{generalSetting()->currency_symbol}})</th>
                                        <th width="25%">@lang('lang.short') @lang('lang.note')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->first_name.' '.$student->last_name}} <input type="hidden" name="id[]" value="{{isset($update)? $student->forwardBalance->id: $student->id}}"></td>
                                        <td>{{$student->admission_no}}</td>
                                        <td>{{$student->roll_no}}</td>
    
                                        <td>{{$student->parents !=""?$student->parents->fathers_name:""}}</td>
                                        <td>
                                            <div class="input-effect">
                                                <input oninput="numberCheckWithDot(this)" type="text" class="primary-input form-control" cols="0" rows="1" name="balance[{{isset($update)? $student->forwardBalance->id:$student->id}}]" maxlength="8" value="{{isset($update)?
                                                $student->forwardBalance->balance: ''}}">
                                                <label>@lang('lang.balance') <span></span></label>
                                                <span class="focus-border"></span>
                                                <span class="invalid-feedback">
                                                    <strong>@lang('lang.error')</strong>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-effect">
                                                <input type="text" class="primary-input form-control" cols="0" rows="1" name="notes[{{isset($update)? $student->forwardBalance->id:$student->id}}]" value="{{isset($update)?
                                                $student->forwardBalance->notes: 'Fees Carry Forward'}}">
                                                <label>@lang('lang.short') @lang('lang.note')<span></span></label>
                                                <span class="focus-border"></span>
                                                <span class="invalid-feedback">
                                                    <strong>@lang('lang.error')</strong>
                                                </span>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <button type="submit" class="primary-btn fix-gr-bg mb-0 submit">
                                                <span class="ti-save pr"></span>
                                                @lang('lang.save')
                                            </button>
                                        </div>
                                    </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    {{ Form::close() }}
    @endif

    </div>
</section>

@endsection
