@extends('backEnd.master')
@section('title') 
@lang('lang.syllabus') @lang('lang.list')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.syllabus') @lang('lang.list') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.study_material')</a>
                <a href="#">@lang('lang.syllabus') @lang('lang.list')</a>
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
                    <h3 class="mb-0">@lang('lang.syllabus') @lang('lang.list')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">

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
                        <!-- @if(isset($uploadContents))
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
                            <td  data-sort="{{strtotime(@$value->upload_date)}}" >
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
                             </td>
                            <td>

                            @if(@$value->class != "")
                                {{@$value->classes->class_name}}
                            @endif 

                            @if(@$value->section != "")
                                ({{@$value->sections->section_name}})
                            @endif


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        @lang('lang.select')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"> 
                                        <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="{{route('upload-content-view', $value->id)}}">@lang('lang.view')</a>

                                        @if (moduleStatusCheck('VideoWatch')== TRUE)
                                            <a class="dropdown-item" href="{{url('videowatch/view-log/'.$value->id)}}">@lang('lang.seen') /@lang('lang.unseen')</a>
                                            <a class="dropdown-item" href="{{url('study-content-watch-log/'.$value->id)}}">@lang('lang.seen') /@lang('lang.unseen') @lang('lang.upload')</a>
                                        @endif
                                            <a class="dropdown-item" href="{{route('upload-content-edit',$value->id)}}">@lang('lang.edit')</a>

                                     @if(userPermission(103))

                                    
                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal{{@$value->id}}"
                                            href="#">@lang('lang.delete')</a>
                                            @endif

                                            @if(userPermission(104))

                                        @if($value->upload_file != "")
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
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.syllabus')</h4>
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
                            @endif -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<div class="modal fade admin-query" id="showReasonModal" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.syllabus')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        {{ Form::open(['route' => 'delete-upload-content', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                   
                                                <input type="hidden" name="id"> 
                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                   
                                            </div>
                                        </div>
                                        {{ Form::close() }}


                                    </div>
                                </div>
                    </div>

@endsection


@section('script')  
    @include('backEnd.partials.server_side_datatable')
 
   <script>

$(document).ready(function() {
       $('.data-table').DataTable({
                     processing: true,
                     serverSide: true,
                     "ajax": $.fn.dataTable.pipeline( {
                           url: "{{route('syllabus-list-ajax')}}",
                           data: { 
                               
                            },
                           pages: "{{generalSetting()->ss_page_load}}" // number of pages to cache
                           
                       } ),
                       columns: [
                           {data: 'content_title', name: 'content_title'},
                           {data: 'type', name: 'type'},
                           {data: 'date', name: 'date'},
                           {data: 'avaiable', name: 'avaiable'},
                           {data: 'class_sections', name: 'class_sections'},
                           {data: 'action', name: 'action', orderable: false, searchable: true},
                        ],
                        bLengthChange: false,
                        bDestroy: true,
                        language: {
                            search: "<i class='ti-search'></i>",
                            searchPlaceholder: window.jsLang('quick_search'),
                            paginate: {
                                next: "<i class='ti-arrow-right'></i>",
                                previous: "<i class='ti-arrow-left'></i>",
                            },
                        },
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "copyHtml5",
                            text: '<i class="fa fa-files-o"></i>',
                            title: $("#logo_title").val(),
                            titleAttr: window.jsLang('copy_table'),
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            },
                        },
                        {
                            extend: "excelHtml5",
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: window.jsLang('export_to_excel'),
                            title: $("#logo_title").val(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            },
                        },
                        {
                            extend: "csvHtml5",
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: window.jsLang('export_to_csv'),
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            },
                        },
                        {
                            extend: "pdfHtml5",
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            title: $("#logo_title").val(),
                            titleAttr: window.jsLang('export_to_pdf'),
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            },
                            orientation: "landscape",
                            pageSize: "A4",
                            margin: [0, 0, 0, 12],
                            alignment: "center",
                            header: true,
                            customize: function(doc) {
                                doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
                                doc.content.splice(1, 0, {
                                    margin: [0, 0, 0, 12],
                                    alignment: "center",
                                    image: "data:image/png;base64," + $("#logo_img").val(),
                                });
                            },
                        },
                        {
                            extend: "print",
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: window.jsLang('print'),
                            title: $("#logo_title").val(),
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            },
                        },
                        {
                            extend: "colvis",
                            text: '<i class="fa fa-columns"></i>',
                            postfixButtons: ["colvisRestore"],
                        },
                    ],
                    columnDefs: [{
                        visible: false,
                    }, ],
                    responsive: true,
                });
            } );
            </script>
       
            <script>
            
                function deleteAssignMent(id){
                    var modal = $('#showReasonModal');
                    modal.find('input[name=id]').val(id)
                    modal.modal('show');
                }
            </script>
   
   @endsection