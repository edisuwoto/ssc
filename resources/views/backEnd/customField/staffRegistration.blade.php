@extends('backEnd.master')
@section('title') 
    @lang('lang.staff') @lang('lang.registration')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.staff') @lang('lang.registration')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.custom') @lang('lang.field')</a>
                <a href="#">@lang('lang.staff') @lang('lang.registration')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if (isset($v_custom_field))
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="{{route('staff-reg-custom-field')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </a>
                </div>
            </div>
        @endif
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="main-title mt_0_sm mt_0_md">
                        <h3 class="mb-30">
                            @if (isset($v_custom_field))
                                @lang('lang.edit')
                            @else
                                @lang('lang.add')
                            @endif
                                @lang('lang.custom') @lang('lang.field')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        @if (isset($v_custom_field))
                            {{ Form::open(['class' => 'form-horizontal','route' =>'update-staff-custom-field', 'method' => 'POST']) }}
                            <input type="hidden" name="id" value="{{$v_custom_field->id}}">
                        @else
                            {{ Form::open(['class' => 'form-horizontal','route' =>'store-staff-registration-custom-field', 'method' => 'POST']) }}
                        @endif
                        @include('backEnd.customField._custom_form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="row mt-40 full_wide_table">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.custom') @lang('lang.field') @lang('lang.list')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row  ">
                        <div class="col-lg-12">
                            <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.sl')</th>
                                        <th>@lang('lang.label')</th>
                                        <th>@lang('lang.type')</th>
                                        <th>@lang('lang.width')</th>
                                        <th>@lang('lang.required')</th>
                                        <th>@lang('lang.value')</th>
                                        <th>@lang('lang.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($custom_fields as $key=>$custom_field)
                                        @php
                                            $v_lengths = json_decode($custom_field->min_max_length);
                                            $v_values = json_decode($custom_field->min_max_value);
                                            $v_name_values = json_decode($custom_field->name_value);
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$custom_field->label}}</td>
                                            <td>
                                                @if ($custom_field->type == "textInput")
                                                    @lang('lang.text') @lang('lang.input')
                                                @elseif ($custom_field->type == "numericInput")
                                                    @lang('lang.numeric') @lang('lang.input')
                                                @elseif ($custom_field->type == "multilineInput")
                                                    @lang('lang.multiline') @lang('lang.input')
                                                @elseif ($custom_field->type == "datepickerInput")
                                                    @lang('lang.datepicker') @lang('lang.input')
                                                @elseif ($custom_field->type == "checkboxInput")
                                                    @lang('lang.checkbox') @lang('lang.input')
                                                @elseif ($custom_field->type == "radioInput")
                                                    @lang('lang.radio') @lang('lang.input')
                                                @elseif ($custom_field->type == "dropdownInput")
                                                    @lang('lang.dropdown') @lang('lang.input')
                                                @else
                                                    @lang('lang.file') @lang('lang.input')
                                                @endif
                                            </br>
                                                @if ($custom_field->type == "textInput" || $custom_field->type == "multilineInput")
                                                    <small>
                                                        @lang('lang.min') @lang('lang.length') : {{$v_lengths[0]}}
                                                    </small>
                                                    </br>
                                                    <small>
                                                        @lang('lang.max') @lang('lang.length') : {{$v_lengths[1]}}
                                                    </small>
                                                    </br>
                                                @endif
    
                                                @if ($custom_field->type == "numericInput")
                                                    <small>
                                                        @lang('lang.min') @lang('lang.value') : {{$v_values[0]}}
                                                    </small>
                                                    </br>
                                                    <small>
                                                        @lang('lang.max') @lang('lang.value') : {{$v_values[1]}}
                                                    </small>
                                                    </br>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($custom_field->width == "col-12")
                                                    @lang('lang.full') @lang('lang.width')
                                                @elseif ($custom_field->width == "col-6")
                                                    @lang('lang.half') @lang('lang.width')
                                                @elseif ($custom_field->width == "col-4")
                                                    @lang('lang.one_fourth') @lang('lang.width')
                                                @elseif($custom_field->width == "col-3")
                                                    @lang('lang.one_thired') @lang('lang.width')
                                                @endif
                                            </td>
                                            <td>
                                                @if ($custom_field->required == 1)
                                                    @lang('lang.required')
                                                @else
                                                    @lang('lang.not') @lang('lang.required')
                                                @endif
                                            </td>
                                            <td>
                                                @if ($custom_field->type == "checkboxInput" || $custom_field->type == "radioInput" || $custom_field->type == "dropdownInput"  )
                                                    @foreach ($v_name_values as $v_name_value)
                                                        {{$v_name_value}},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if(userPermission(1107))
                                                            <a class="dropdown-item" href="{{route('edit-staff-custom-field',['id' => @$custom_field->id])}}">@lang('lang.edit')</a>
                                                        @endif
                                                        @if(userPermission(1108))
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteCustomField{{@$custom_field->id}}" href="#">
                                                                @lang('lang.delete')
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <div class="modal fade admin-query" id="deleteCustomField{{@$custom_field->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.delete') @lang('lang.custom') @lang('lang.field')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                        </div>
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">
                                                                @lang('lang.cancel')
                                                            </button>
                                                            {{ Form::open(['route' =>'delete-staff-custom-field', 'method' => 'POST']) }}
                                                                <input type="hidden" name="id" value="{{@$custom_field->id}}">
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