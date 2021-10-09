@extends('backEnd.master')
@section('title')
@lang('lang.dormitory_rooms')
@endsection
@section('mainContent')
@php  $setting = app('school_info');
 if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } 
@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.dormitory_rooms')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.dormitory')</a>
                <a href="#">@lang('lang.dormitory_rooms')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($room_list))
        @if(userPermission(364))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('room-list')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
           
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($room_list))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.dormitory_rooms')
                            </h3>
                        </div>
                        @if(isset($room_list))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('room-list-update',$room_list->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(userPermission(364))

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'room-list',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                
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
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('dormitory') ? ' is-invalid' : '' }}" name="dormitory">
                                            <option data-display="@lang('lang.dormitory') *" value="">@lang('lang.dormitory') *</option>
                                            @foreach($dormitory_lists as $dormitory_list)
                                                @if(isset($room_list))
                                                <option value="{{@$dormitory_list->id}}" {{@$dormitory_list->id == @$room_list->dormitory_id? 'selected': ''}}>{{@$dormitory_list->dormitory_name}}</option>
                                                @else
                                                <option value="{{@$dormitory_list->id}}" {{old('dormitory') == @$dormitory_list->id? 'selected':''}}>{{@$dormitory_list->dormitory_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('dormitory'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('dormitory') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($room_list)? $room_list->name: old('name')}}">
                                            <input type="hidden" name="id" value="{{isset($room_list)? $room_list->id: ''}}">
                                            <label>@lang('lang.room_number') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('room_type') ? ' is-invalid' : '' }}" name="room_type">
                                            <option data-display="@lang('lang.room_type') *" value="">@lang('lang.room_type') *</option>
                                            @foreach($room_types as $room_type)
                                                 @if(isset($room_list))
                                                <option value="{{@$room_type->id}}" {{@$room_type->id == @$room_list->room_type_id? 'selected': ''}}>{{ @$room_type->type}}</option>
                                                @else
                                                <option value="{{@$room_type->id}}" {{old('room_type') == @$room_type->id? 'selected':''}}>{{@$room_type->type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('room_type'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('room_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control{{ $errors->has('number_of_bed') ? ' is-invalid' : '' }}" type="text" name="number_of_bed" value="{{isset($room_list)? $room_list->number_of_bed: old('number_of_bed')}}">
                                            <label>@lang('lang.number_of_bed') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('number_of_bed'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number_of_bed') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheck(this)" class="primary-input form-control{{ $errors->has('cost_per_bed') ? ' is-invalid' : '' }}" type="text" step="0.1" name="cost_per_bed" value="{{isset($room_list)? $room_list->cost_per_bed: old('cost_per_bed')}}">
                                            <label>@lang('lang.cost_per_bed')<span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('cost_per_bed'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cost_per_bed') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description">{{isset($room_list)? $room_list->description: old('description')}}</textarea>
                                            <label>@lang('lang.description') <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                 @php 
                                  $tooltip = "";
                                  if(userPermission(364)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{ @$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($room_list))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.room')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"> @lang('lang.dormitory') @lang('lang.room') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>@lang('lang.dormitory')</th>
                                    <th>@lang('lang.room') @lang('lang.number')</th>
                                    <th>@lang('lang.room_type')</th>
                                    <th>@lang('lang.no_of_bed')</th>
                                    <th>@lang('lang.cost_per_bed') ({{generalSetting()->currency_symbol}})</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($room_lists as $room_list)
                                <tr>
                                    <td>{{isset($room_list->dormitory->dormitory_name)? $room_list->dormitory->dormitory_name:''}}</td>
                                    <td>{{ @$room_list->name}}</td>
                                    <td>{{isset($room_list->roomType->type)? $room_list->roomType->type: ''}}</td>
                                    <td>{{ @$room_list->number_of_bed}}</td>
                                    <td>{{ @$room_list->cost_per_bed}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(userPermission(365))

                                                <a class="dropdown-item" href="{{route('room-list-edit', [$room_list->id])}}">@lang('lang.edit')</a>
                                                @endif
                                                @if(userPermission(366))

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteRoomTypeModal{{$room_list->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                            @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRoomTypeModal{{@$room_list->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.room')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['route' => array('room-list-delete',$room_list->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
