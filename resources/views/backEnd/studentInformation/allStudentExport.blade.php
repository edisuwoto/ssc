@extends('backEnd.master')
@section('title') 
@lang('lang.student') @lang('lang.export')
@endsection

@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student') @lang('lang.export')</h1>
            <div class="bc-pages">
                <a href="{{url('admin-dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.student_information')</a>
                <a href="#">@lang('lang.student') @lang('lang.export')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">
                            @lang('lang.all') @lang('lang.student') @lang('lang.export')
                        </h3>
                    </div>
                    <div class="white-box">
                        <div class="add-visitor">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        @if (userPermission(664))
                                            <a class="primary-btn small bg-success text-white border-0  tr-bg" href="{{route('all-student-export-excel')}}">
                                                @lang('lang.export_to_csv')
                                            </a>  
                                        @endif
                                        @if (userPermission(665))
                                            <a class="primary-btn small bg-success text-white border-0  tr-bg" href="{{route('all-student-export-pdf')}}">
                                                @lang('lang.export_to_pdf')
                                            </a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
