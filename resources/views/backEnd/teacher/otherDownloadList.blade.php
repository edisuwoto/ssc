@extends('backEnd.master')
@section('title') 
@lang('lang.other_downloads_list')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.other_downloads_list') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.study_material')</a>
                <a href="#">@lang('lang.other_downloads_list')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.other_downloads_list')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                
                        <tr>
                            <th>@lang('lang.content_title')</th>
                            <th>@lang('lang.type')</th>
                            <th>@lang('lang.date')</th>
                            <th>@lang('lang.available_for')</th>
                            <th>@lang('lang.class_Sec')</th>
                            <th>@lang('lang.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($uploadContents))
                        @foreach($uploadContents as $value)
                        <tr>

                            <td>{{@$value->content_title}}</td>
                            <td>
                                @if(@$value->content_type == 'as')
                                    {{'Assignment'}}
                                @elseif(@$value->content_type == 'st')
                                    {{'Study Material'}}
                                @elseif(@$value->content_type == 'sy')
                                    {{'Syllabus'}}
                                @else
                                    {{'Others Download'}}
                                @endif
                            </td>
                            <td data-sort="{{strtotime(@$value->upload_date)}}" >
                               {{@$value->upload_date != ""? dateConvert(@$value->upload_date):''}}
                            </td>
                            <td>
                                @if(@$value->available_for_admin == 1)
                                    @lang('lang.all_admins')<br>
                                @endif
                                @if(@$value->available_for_all_classes == 1)
                                    @lang('lang.all_classes_student')
                                @endif

                                @if(@$value->classes != "" && $value->sections != "")
                                    @lang('lang.all_students_of') ({{@$value->classes->class_name.'->'.@$value->sections->section_name}})
                                @endif
                                @if(@$value->classes != "" && $value->section ==null)
                                @lang('lang.all_students_of') ({{@$value->classes->class_name.'->'}} @lang('lang.all_sections'))
                            @endif
                            </td>
                            <td>

                            @if(@$value->class != "")
                                {{@$value->classes->class_name}}
                            @endif 

                            @if(@$value->section != "")
                                ({{@$value->sections->section_name}})
                            @endif
                            @if(@$value->section ==null)
                            ( @lang('lang.all_sections'))
                        @endif


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        @lang('lang.select')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                     <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="{{route('upload-content-view', $value->id)}}">@lang('lang.view')</a>
                                        @if(userPermission(588))
                                            <a class="dropdown-item" href="{{route('upload-content-edit',$value->id)}}">@lang('lang.edit')</a>
                                        @endif

                                     @if(userPermission(107))

                                    

                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal{{@$value->id}}"
                                            href="#">@lang('lang.delete')</a>
                                            @endif

                                            @if(userPermission(106))

                                           

                                        @if(@$value->upload_file != "")
                                         <a class="dropdown-item" href="{{url(@$value->upload_file)}}" download>
                                             @lang('lang.download') <span class="pl ti-download"></span>
                                        @endif
                                        @endif
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteApplyLeaveModal{{@$value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.other_download')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                <a href="{{route('delete-upload-content', [@$value->id])}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
