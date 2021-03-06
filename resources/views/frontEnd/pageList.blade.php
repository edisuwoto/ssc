@extends('backEnd.master')
@section('title')
@lang('lang.pages')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.pages')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.front_settings')</a>
                <a href="#">@lang('lang.pages')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                @if(userPermission(656))
                    <a href="{{route('create-page')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </a>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-5">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.pages') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.sub_title')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{$page->title}}</td>
                                    <td>{{@$page->sub_title}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                {{-- @if(userPermission(655)) --}}
                                                    <a class="dropdown-item" href="{{route('view-page', ['slug'=>@$page->slug])}}">@lang('lang.preview')</a>
                                                {{-- @endif --}}

                                                @if(userPermission(657))
                                                    <a class="dropdown-item" href="{{route('edit-page', [@$page->id])}}">@lang('lang.edit')</a>
                                                @endif

                                                @if(userPermission(658))
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deletePages{{@$page->id}}" href="#">
                                                        @lang('lang.delete')
                                                    </a>
                                                @endif

                                                @if (@$page->header_image)
                                                    @if(userPermission(659))
                                                        <a class="dropdown-item" href="{{url(@$page->header_image)}}" download>
                                                            @lang('lang.download')  
                                                            <span class="pl ti-download"></span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deletePages{{@$page->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    @lang('lang.delete') @lang('lang.pages')
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['route' => array('delete-page',@$page->id), 'method' => 'post',]) }}
                                                        <button class="primary-btn fix-gr-bg" type="submit">
                                                            @lang('lang.delete')
                                                        </button>
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