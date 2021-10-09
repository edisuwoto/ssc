@extends('backEnd.master')
@section('title') 
@lang('lang.email_sms_log')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.email_sms_log') @lang('lang.list') </h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.email_sms_log')</a>
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
                <a href="{{route('send-email-sms-view')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.send_email')
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">

                    <thead>
                        @if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != "")
                        <tr>
                            <td colspan="2">
                                @if(session()->has('message-success-delete'))
                                <div class="alert alert-success">
                                    {{ session()->get('message-success-delete') }}
                                </div>
                                @elseif(session()->has('message-danger-delete'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message-danger-delete') }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th> Si</th>
                            <th> @lang('lang.title')</th>
                            <th> @lang('lang.description')</th>
                            <th> @lang('lang.date')</th>
                            <th> @lang('lang.type')</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @if(isset($emailSmsLogs))
                        @foreach($emailSmsLogs as $value)
                        <tr>
                            <td>{{ @$value->title}}</td>
                            <td>{{ @$value->description}}</td>
                            <td  data-sort="{{strtotime(@$value->send_date)}}" >  
                                {{@$value->send_date != ""? dateConvert(@$value->send_date):''}}
                            </td>
                            <td>@if(@$value->send_through == 'E')
                            <button class="primary-btn small bg-warning text-white border-0"> @lang('lang.email')</button>
                            @else
                            <button class="primary-btn small bg-success text-white border-0"> @lang('lang.sms')</button>
                            @endif
                            </td>
                            <td>
                            @if(@$value->send_to == 'G')
                            <input type="checkbox" id="asdasd" class="" value="1" name="send_to" checked>
                            @endif
                            </td>
                            <td>
                            @if(@$value->send_to == 'I')
                            <input type="checkbox" id=""  value="" checked>
                            @endif
                            </td>
                            <td>
                            @if(@$value->send_to != 'G' && @$value->send_to != 'I')
                            <input type="checkbox" id=""  value="" checked>
                            @endif
                            </td>
                        </tr>
                            @endforeach
                            @endif --}}
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
@include('backEnd.partials.server_side_datatable')

<script>
//
// DataTables initialisation
//
$(document).ready(function() {
   $('.data-table').DataTable({
                 processing: true,
                 serverSide: true,
                 "ajax": $.fn.dataTable.pipeline( {
                       url: "{{url('email-sms-log-ajax')}}",
                       data: { 
                            
                        },
                       pages: "{{generalSetting()->ss_page_load}}" // number of pages to cache
                       
                   } ),
                   columns: [
                        {data: 'id', name: 'id'},
                       {data: 'title', name: 'title'},
                       {data: 'description', name: 'description'},
                       {data: 'date', name: 'date'},
                       {data: 'send_via', name: 'type'},
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
   


@endsection
