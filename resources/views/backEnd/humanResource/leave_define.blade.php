@extends('backEnd.master')
@section('title')
@lang('lang.leave_define')
@endsection
@section('mainContent')
@if(isset($leave_define))
    @if( is_null($staff) ) 
        <style>
            #selectStaffsDiv{
                display: none;
            }
            .forStudentWrapper{
                display:block;
            }
        </style>
    @endif
    @if( is_null($student)) 
        <style>
            #selectStaffsDiv{
                display: block;
            }
            .forStudentWrapper{
                display:none;
            }
        </style>
    @endif
@else 
<style type="text/css">
    #selectStaffsDiv, .forStudentWrapper{
        display: none;
    }
</style>
@endif 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.leave_define')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.leave')</a>
                <a href="#">@lang('lang.leave_define')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($leave_define))
            @if(userPermission(200))  
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{route('leave-define')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">
                                @if(isset($leave_define))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                    @lang('lang.leave_define')
                            </h3>
                        </div>
                            @if(isset($leave_define))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('leave-define-update',$leave_define->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                                @if(userPermission(200))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'leave-define',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @endif
                            @endif
                            <input type="hidden" name="id" value="{{isset($leave_define)? $leave_define->id:''}}">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12 mb-30">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('member_type') ? ' is-invalid' : '' }}" name="member_type" id="member_type">
                                            <option data-display=" @lang('lang.select_role') *" value="">@lang('lang.select_role') *</option>
                                                @if(isset($leave_define))
                                                    @if(! is_null($student)) 
                                                        <option value="{{@$student->role_id}}" selected >{{@$student->roles->name}}</option>
                                                    @endif

                                                    @if(! is_null($staff)) 
                                                        <option value="{{@$staff->role_id}}" selected>{{@$staff->roles->name}}</option>
                                                    @endif
                                                @else 
                                                    @foreach($roles as $value)
                                                        <option value="{{$value->id}}" >{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                        @if ($errors->has('member_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('member_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 mb-30">
                                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                                    <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
                                                    @if(! isset($leave_define))
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}"  {{( old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>    
                                                        @endforeach
                                                    @else
                                                        <option value="{{@$student->class_id}}"  selected }}>{{@$student->className->class_name}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section_member" name="section">
                                                    <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                                    @if(isset($leave_define))
                                                        <option value="{{@$student->user_id}}"  selected >{{@$student->section->section_name}}</option>
                                                    @endif
                                                </select>
                                                <div class="pull-right loader loader_style" id="select_section_loader">
                                                    <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-30" id="select_student_div">
                                                <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                                    <option data-display="@lang('lang.select_student') " value="">@lang('lang.select_student')</option>
                                                    @if(isset($leave_define))
                                                        <option value="{{@$student->user_id}}"  selected >{{@$student->full_name}}</option>
                                                    @endif
                                                </select>
                                                <div class="pull-right loader loader_style" id="select_student_loader">
                                                    <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('staff_id') ? ' is-invalid' : '' }}" name="staff" id="selectStaffs">
                                            <option data-display="@lang('lang.name') " value="">@lang('lang.name') </option>
                                            @if(! isset($leave_define))
                                                @foreach($roles as $value)
                                                    <option value="{{$value->id}}" >{{$value->full_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="{{@$staff->user_id}}" selected >{{@$staff->full_name}}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}" name="leave_type">
                                            <option data-display="@lang('lang.leave_type')  *" value="">@lang('lang.leave_type') *</option>
                                            @foreach($leave_types as $leave_type)
                                                <option value="{{$leave_type->id}}" {{isset($leave_define)? ($leave_define->type_id == $leave_type->id? 'selected':''):''}}>{{$leave_type->type}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('leave_type'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('leave_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" type="text" name="days" autocomplete="off" value="{{isset($leave_define)? $leave_define->days:''}}">
                                            <label>@lang('lang.days') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('days'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('days') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 @php
                                  $tooltip = "";
                                    if(userPermission(309) ){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
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
                            <h3 class="mb-0">@lang('lang.leave_define') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>@lang('lang.user')</th>
                                    <th>@lang('lang.role')</th>
                                    <th>@lang('lang.leave_type')</th>
                                    <th>@lang('lang.days')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @foreach($leave_defines as $leave_define)
                                <tr>
                                    <td>{{$leave_define->user !=""?$leave_define->user->full_name:""}}</td>
                                    <td>{{$leave_define->role !=""?$leave_define->role->name:""}}</td>
                                    <td>{{$leave_define->leaveType !=""?$leave_define->leaveType->type:""}}</td>
                                    <td>{{$leave_define->days}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @if(userPermission(201))

                                                <a class="dropdown-item" href="{{route('leave-define-edit', [@$leave_define->id
                                                    ])}}">@lang('lang.edit')</a>
                                                    @endif
                                                    @if(userPermission(202))

                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteLeaveDefineModal{{$leave_define->id}}"
                                                        href="#">@lang('lang.delete')</a>
                                                    @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        @endforeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- MOdal Here  -->
<div class="modal fade admin-query" id="deleteLeaveDefineModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.leave_define')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                        @lang('lang.are_you_sure_to_delete')
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    {{ Form::open(['route' => array('leave-define-delete'), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                    <input type="hidden" name="id" id="showId">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add Days Modal  -->
<div class="modal fade admin-query" id="addLeaveDayModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.update') @lang('lang.leave_define') </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'leave-define-updateLeave', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <div class="form-group">
                    <input type="hidden" name="id" id="showId">
                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input form-control has-content" type="text" name="days" autocomplete="off" id="showDays">
                                <label>@lang('lang.days') <span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('days'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('days') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.close')</button>
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.update')</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        function deleteLeaveDefine(id){
            var modal = $('#deleteLeaveDefineModal');
            modal.find('#showId').val(id)
            modal.modal('show');

        }

        function addLeaveDay(id){ 
            var modal = $('#addLeaveDayModal');
            var total_days = $('.reason'+ id).data('total_days');
            modal.find('#showId').val(id);
            modal.find('#showDays').val(total_days);
            modal.modal('show');
        }
        
    </script>
@endpush


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
                       url: "{{url('leave-define-ajax')}}",
                       data: { 
                            
                        },
                       pages: "{{generalSetting()->ss_page_load}}" // number of pages to cache
                       
                   } ),
                   columns: [
                       {data: 'user.full_name', name: 'userName'},
                       {data: 'role.name', name: 'role'},
                       {data: 'leave_type.type', name: 'leaveType'},
                       {data: 'days', name: 'totalDays'},
                       {data: 'action', name: 'action', orderable: true, searchable: true},
                       
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
