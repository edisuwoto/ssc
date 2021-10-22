@extends('backEnd.master')
@section('title') 
@lang('lang.student') @lang('lang.profile')
@endsection

@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3 mb-30">
                <!-- Start Student Meta Information -->
                <div class="main-title">
                    <h3 class="mb-20">@lang('lang.student') @lang('lang.profile')</h3>
                </div>
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{ file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/student.jpg')}}" alt="">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.student_name')
                                </div>
                                <div class="value">
                                    {{$student_detail->first_name.' '.$student_detail->last_name}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.admission_no')
                                </div>
                                <div class="value">
                                    {{$student_detail->admission_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.roll_number')
                                </div>
                                <div class="value">
                                    {{$student_detail->roll_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.class')
                                </div>
                                <div class="value">
                                    @if($student_detail->className !="" )
                                        {{$student_detail->className->class_name}} ({{@$academic_year->year}})
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.section')
                                </div>
                                <div class="value">
                                    {{$student_detail->section !=""?$student_detail->section->section_name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.gender')
                                </div>
                                <div class="value">
                                    {{@$student_detail->gender !=""?@$student_detail->gender->base_setup_name:""}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Student Meta Information -->
            </div>
            <!-- Start Student Details -->
            <div class="col-lg-9">
                <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#studentProfile" role="tab" data-toggle="tab">@lang('lang.profile')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentFees" role="tab" data-toggle="tab">@lang('lang.fees')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#leaves" role="tab" data-toggle="tab">@lang('lang.leave')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentExam" role="tab" data-toggle="tab">@lang('lang.exam')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentDocuments" role="tab" data-toggle="tab">@lang('lang.documents')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentTimeline" role="tab" data-toggle="tab">@lang('lang.timeline')</a>
                    </li>

                    


                    <li class="nav-item edit-button">
                        <a href="{{route('update-my-children',$student_detail->id)}}" class="primary-btn small fix-gr-bg pull-right">{{__('Update Profile')}}</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                <!-- Start Profile Tab -->
                    <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
                        <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.personal') @lang('lang.info')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.admission') @lang('lang.date')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                        {{@$student_detail->admission_date != ""? dateConvert(@$student_detail->admission_date):''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.date_of_birth')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                          {{@$student_detail->date_of_birth != ""? dateConvert(@$student_detail->date_of_birth ):''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.type')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{@$student_detail->category->category_name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.religion')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(!empty($student_detail->religion))
                                            {{@$student_detail->religion->base_setup_name}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.phone_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{$student_detail->mobile}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.email') @lang('lang.address')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{$student_detail->email}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.present') @lang('lang.address')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                           {{$student_detail->current_address}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.permanent_address')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{$student_detail->permanent_address}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Parent Part -->
                            <h4 class="stu-sub-head mt-40">@lang('lang.Parent_Guardian_Details')</h4>
                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="{{ file_exists(@$student_detail->parents->fathers_photo) ? asset($student_detail->parents->fathers_photo) : asset('public/uploads/staff/demo/father.png') }}" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.father_name')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->fathers_name}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.occupation')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->fathers_occupation}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.phone_number')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->fathers_mobile}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="{{ file_exists(@$student_detail->parents->mothers_photo) ? asset($student_detail->parents->mothers_photo) : asset('public/uploads/staff/demo/mother.jpg')}}" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.mother_name')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->mothers_name}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.occupation')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->mothers_occupation}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.phone_number')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->mothers_mobile}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="{{ file_exists(@$student_detail->parents->guardians_photo) ? asset($student_detail->parents->guardians_photo) : asset('public/uploads/staff/demo/guardian.jpg')}}" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.guardian_name')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_name}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.email') @lang('lang.address')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_email}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.phone_number')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_mobile}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.relation_with_guardian')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_relation}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.occupation')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_occupation}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    @lang('lang.guardian_address')
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    @if(!empty($student_detail->parents))
                                                    {{$student_detail->parents->guardians_address}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Parent Part -->
                            <!-- Start Transport Part -->
                            <h4 class="stu-sub-head mt-40">@lang('lang.transport_and_dormitory_details')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.route')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->route_list_id)? $student_detail->route->title: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.vehicle_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->vechile_id)? $student_detail->vehicle->vehicle_no: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.driver_name')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->vechile_id)? $driver->full_name: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.driver_phone_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{$student_detail->vechile_id != ""? $driver->mobile: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.dormitory') @lang('lang.name')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{$student_detail->dormitory_id != ""? $student_detail->dormitory->dormitory_name: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Transport Part -->
                            <!-- Start Other Information Part -->
                            <h4 class="stu-sub-head mt-40">@lang('lang.other') @lang('lang.information')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.blood_group')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                           {{isset($student_detail->bloodgroup_id)? @$student_detail->bloodGroup->base_setup_name: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.height')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->height)? $student_detail->height: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.Weight')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->weight)? $student_detail->weight: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.previous_school_details')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->previous_school_details)? $student_detail->previous_school_details: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.national_identification_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->national_id_no)? $student_detail->national_id_no: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.local_identification_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->local_id_no)? $student_detail->local_id_no: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.bank_account_number')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->bank_account_no)? $student_detail->bank_account_no: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.bank_name')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->bank_name)? $student_detail->bank_name: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.IFSC_Code')
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            {{isset($student_detail->ifsc_code)? $student_detail->ifsc_code: ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Custom field start --}}
                                @include('backEnd.customField._coutom_field_show')
                            {{-- Custom field end --}}
                        <!-- End Other Information Part -->
                        
                        {{-- Custom field start --}}
                            @include('backEnd.customField._coutom_field_show')
                        {{-- Custom field end --}}

                        </div>
                    </div>
                    <!-- End Profile Tab -->
                    <!-- Start Fees Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentFees">
                        <div class="table-responsive">
                            <table class="display school-table school-table-style table_not_fixed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.fees_group')</th>
                                        <th>@lang('lang.fees_code')</th>
                                        <th>@lang('lang.due_date')</th>
                                        <th>@lang('lang.status')</th>
                                        <th>@lang('lang.amount') ({{generalSetting()->currency_symbol}})</th>
                                        <th>@lang('lang.payment_id')</th>
                                        <th>@lang('lang.mode')</th>
                                        <th>@lang('lang.date')</th>
                                        <th>@lang('lang.discount') ({{generalSetting()->currency_symbol}})</th>
                                        <th>@lang('lang.fine') ({{generalSetting()->currency_symbol}})</th>
                                        <th>@lang('lang.paid') ({{generalSetting()->currency_symbol}})</th>
                                        <th>@lang('lang.balance')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $grand_total = 0;
                                        $total_fine = 0;
                                        $total_discount = 0;
                                        $total_paid = 0;
                                        $total_grand_paid = 0;
                                        $total_balance = 0;
                                    @endphp
                                    @foreach($fees_assigneds as $fees_assigned)
                                        @php
                                            $grand_total += $fees_assigned->feesGroupMaster->amount;
                                            $discount_amount = $fees_assigned->applied_discount;
                                            $total_discount += $discount_amount;
                                            $student_id = $fees_assigned->student_id;
                                            $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                            $total_grand_paid += $paid;
                                            $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                            $total_fine += $fine;
                                            $total_paid = $discount_amount + $paid;
                                        @endphp
                                    <tr>
                                        <td>{{@$fees_assigned->feesGroupMaster !=""?@$fees_assigned->feesGroupMaster->feesGroups->name:""}}</td>
                                        <td>
                                            @if($fees_assigned->feesGroupMaster !="" && $fees_assigned->feesGroupMaster->feesTypes !="")
                                                {{$fees_assigned->feesGroupMaster->feesTypes->name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($fees_assigned->feesGroupMaster !="")
                                                {{$fees_assigned->feesGroupMaster->date != ""? dateConvert($fees_assigned->feesGroupMaster->date):''}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($fees_assigned->fees_amount == 0)
                                                <button class="primary-btn small bg-success text-white border-0">@lang('lang.paid')</button>
                                                @elseif($paid != 0)
                                                <button class="primary-btn small bg-warning text-white border-0">@lang('lang.partial_paid')</button>
                                                @elseif($paid == 0)
                                                <button class="primary-btn small bg-danger text-white border-0">@lang('lang.unpaid')</button>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                echo $fees_assigned->feesGroupMaster->amount;
                                            @endphp
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$discount_amount}}</td>
                                        <td>{{$fine}}</td>
                                        <td>{{$paid}}</td>
                                        <td>
                                            @php
                                                $rest_amount = $fees_assigned->fees_amount;
                                                $total_balance +=  $rest_amount;
                                                echo $rest_amount;
                                            @endphp
                                        </td>
                                    </tr>
                                        @php
                                            $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                            $i = 0;
                                        @endphp
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><img src="{{asset('public/backEnd/img/table-arrow.png')}}"></td>
                                            <td>
                                                @php
                                                    $created_by = App\User::find($payment->created_by);
                                                @endphp
                                                @if($created_by != "")
                                                    <a href="#" data-toggle="tooltip" data-placement="right" title="{{'Collected By: '.$created_by->full_name}}">{{$payment->fees_type_id.'/'.$payment->id}}</a>
                                            </td>
                                                @endif
                                            <td>
                                                {{$payment->payment_mode}}
                                            </td>
                                            <td class="nowrap">
                                                {{$payment->payment_date != ""? dateConvert($payment->payment_date):''}}
                                            </td>
                                            <td>
                                                {{$payment->discount_amount}}
                                            </td>
                                            <td>
                                                {{$payment->fine}}
                                                @if($payment->fine!=0)
                                                    @if (strlen($payment->fine_title) > 14)
                                                        <spna class="text-danger nowrap" title="{{$payment->fine_title}}">
                                                            ({{substr($payment->fine_title, 0, 15) . '...'}})
                                                        </spna>
                                                    @else
                                                        @if ($payment->fine_title=='')
                                                            {{$payment->fine_title}}
                                                        @else
                                                            <spna class="text-danger nowrap">
                                                                ({{$payment->fine_title}})
                                                            </spna>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{$payment->amount}}
                                            </td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>@lang('lang.grand_total') ({{generalSetting()->currency_symbol}})</th>
                                        <th></th>
                                        <th>{{$grand_total}}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>{{$total_discount}}</th>
                                        <th>{{$total_fine}}</th>
                                        <th>{{$total_grand_paid}}</th>
                                        <th>{{$total_balance}}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- End Profile Tab -->
                     <!-- Start leave Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="leaves">
                            <div class="white-box">
                                <div class="row mt-30">
                                    <div class="col-lg-12">
                                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang.leave_type')</th>
                                                    <th>@lang('lang.leave_from') </th>
                                                    <th>@lang('lang.leave_to')</th>
                                                    <th>@lang('lang.apply_date')</th>
                                                    <th>@lang('lang.status')</th>
                                                    <th>@lang('lang.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $diff = ''; @endphp
                                            @if(count($leave_details)>0)
                                            @foreach($leave_details as $value)
                                            <tr>
                                                <td>{{@$value->leaveType->type}}</td>
                                                <td>
                                                    
                        {{$value->leave_from != ""? dateConvert($value->leave_from):''}}

                                                </td>
                                                <td>
                                                
                        {{$value->leave_to != ""? dateConvert($value->leave_to):''}}

                                                </td>
                                                <td>
                                                    
                        {{$value->apply_date != ""? dateConvert($value->apply_date):''}}

                                                </td>
                                                <td>

                                                    @if($value->approve_status == 'P')
                                                    <button class="primary-btn small bg-warning text-white border-0"> @lang('lang.pending')</button>
                                                    @endif

                                                    @if($value->approve_status == 'A')
                                                    <button class="primary-btn small bg-success text-white border-0"> @lang('lang.approved')</button>
                                                    @endif

                                                    @if($value->approve_status == 'C')
                                                    <button class="primary-btn small bg-danger text-white border-0"> @lang('lang.cancelled')</button>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a class="modalLink" data-modal-size="modal-md" title="@lang('lang.view') @lang('lang.leave') @lang('lang.details')" href="{{url('view-leave-details-apply', $value->id)}}"><button class="primary-btn small tr-bg"> @lang('lang.view') </button></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else 
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>@lang('lang.not_leaves_data')</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @endif 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- End leave Tab -->

                    <!-- Start Exam Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentExam">
                        @php
                            $today = date('Y-m-d H:i:s');
                            $exam_count= count($exam_terms);
                        @endphp
                        @if($exam_count < 1)
                        <div class="white-box no-search no-paginate no-table-info mb-2">
                           <table class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            @lang('lang.subject')
                                        </th>
                                        <th>
                                            @lang('lang.full_marks')
                                        </th>
                                        <th>
                                            @lang('lang.passing_marks')
                                        </th>
                                        <th>
                                            @lang('lang.obtained_marks')
                                        </th>
                                        <th>
                                            @lang('lang.results')
                                        </th>
                                    </tr>
                                </thead>
                           </table>
                        </div>
                        @endif
                        <div class="white-box no-search no-paginate no-table-info mb-2">
                            @foreach($exam_terms as $exam)
                            @php
                                $get_results = App\SmStudent::getExamResult(@$exam->id, @$student_detail);
                            @endphp
                            @if($get_results)
                            <div class="main-title">
                                <h3 class="mb-0">{{@$exam->title}}</h3>
                            </div>
                            @php
                                $grand_total = 0;
                                $grand_total_marks = 0;
                                $result = 0;
                                $temp_grade=[];
                                $total_gpa_point = 0;
                                $total_subject = count($get_results);
                                $optional_subject = 0;
                                $optional_gpa = 0;
                            @endphp
                            @if($exam->examSettings->publish_date)
                                @if($exam->examSettings->publish_date <=  $today)
                                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.date')</th>
                                                <th>
                                                    @lang('lang.subject') ( @lang('lang.full_marks'))
                                                </th>
                                                <th>
                                                    @lang('lang.obtained_marks')
                                                </th>
                                                <th>
                                                    @lang('lang.grade')
                                                </th>
                                                <th>
                                                    @lang('lang.gpa')
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($get_results as $mark)
                                            @php
                                                if((!is_null($optional_subject_setup)) && (!is_null($student_optional_subject))){
                                                    if($mark->subject_id != @$student_optional_subject->subject_id){
                                                        $temp_grade[]=$mark->total_gpa_grade;
                                                    }
                                                }else{
                                                    $temp_grade[]=$mark->total_gpa_grade;
                                                }
                                                $total_gpa_point += $mark->total_gpa_point;
                                                if(! is_null(@$student_optional_subject)){
                                                    if(@$student_optional_subject->subject_id == $mark->subject->id && $mark->total_gpa_point  < @$optional_subject_setup->gpa_above ){
                                                        $total_gpa_point = $total_gpa_point - $mark->total_gpa_point;
                                                    }
                                                }
                                                $temp_gpa[]=$mark->total_gpa_point;
                                                $get_subject_marks =  subjectFullMark ($mark->exam_type_id, $mark->subject_id );
                                                
                                                $subject_marks = App\SmStudent::fullMarksBySubject($exam->id, $mark->subject_id);
                                                $schedule_by_subject = App\SmStudent::scheduleBySubject($exam->id, $mark->subject_id, @$student_detail);
                                                $result_subject = 0;
                                                $grand_total_marks += $get_subject_marks;
                                                if(@$mark->is_absent == 0){
                                                    $grand_total += @$mark->total_marks;
                                                    if($mark->marks < $subject_marks->pass_mark){
                                                    $result_subject++;
                                                    $result++;
                                                    }
                                                }else{
                                                    $result_subject++;
                                                    $result++;
                                                }
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ !empty($schedule_by_subject->date)? dateConvert($schedule_by_subject->date):''}}
                                                </td>
                                                <td>
                                                    {{@$mark->subject->subject_name}} ({{ @subjectFullMark($mark->exam_type_id, $mark->subject_id )}})
                                                    {{-- @if (@$optional_subject_setup!='' && @$student_optional_subject!='')
                                                        @if ($student_optional_subject->subject_id==$mark->subject->id)
                                                            <small>(@lang('lang.optional'))</small>
                                                        @endif
                                                    @endif --}}
                                                </td>
                                                <td>
                                                    {{@$mark->total_marks}}
                                                </td>
                                                <td> 
                                                    {{@$mark->total_gpa_grade}} 
                                                </td>
                                                <td>
                                                {{number_format(@$mark->total_gpa_point, 2, '.', '')}}
                                                    {{-- @php
                                                        if (@$student_optional_subject!='') {
                                                            
                                                            if (@$student_optional_subject->subject_id == $mark->subject->id) {
                                                        
                                                                $optional_subject = 1;
                                                            if ($mark->total_gpa_point > @$optional_subject_setup->gpa_above) {
                                                                $optional_gpa = @$optional_subject_setup->gpa_above;
                                                            echo "GPA Above ".@$optional_subject_setup->gpa_above;
                                                            echo "<hr>";
                                                            echo $mark->total_gpa_point  - @$optional_subject_setup->gpa_above;
                                                            } else {
                                                                echo "GPA Above ".@$optional_subject_setup->gpa_above;
                                                                echo "<hr>";
                                                                echo "0";
                                                            }
                                                        }
                                                    }
                                                    @endphp --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        
                                        </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    @lang('lang.grand_total'): {{$grand_total}}/{{$grand_total_marks}}
                                                </th>
                                                <th>@lang('lang.grade'): 
                                                @php
                                                    if(in_array($failgpaname->grade_name,$temp_grade)){
                                                        echo $failgpaname->grade_name;
                                                        }else {
                                                            $final_gpa_point = ($total_gpa_point- $optional_gpa) /  ($total_subject - $optional_subject);
                                                            $average_grade=0;
                                                            $average_grade_max=0;
                                                            if($result == 0 && $grand_total_marks != 0){
                                                                $gpa_point=number_format($final_gpa_point, 2, '.', '');
                                                                if($gpa_point >= $maxgpa){
                                                                    $average_grade_max = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                    ->where('academic_id', getAcademicId() )
                                                                    ->where('from', '<=', $maxgpa )
                                                                    ->where('up', '>=', $maxgpa )
                                                                    ->first('grade_name');

                                                                    echo  @$average_grade_max->grade_name;
                                                                } else {
                                                                    $average_grade = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                    ->where('academic_id', getAcademicId() )
                                                                    ->where('from', '<=', $final_gpa_point )
                                                                    ->where('up', '>=', $final_gpa_point )
                                                                    ->first('grade_name');
                                                                    echo  @$average_grade->grade_name;  
                                                                }
                                                        }else{
                                                            echo $failgpaname->grade_name;
                                                        }
                                                    }
                                                    @endphp
                                                </th>
                                                <th> 
                                                    @lang('lang.gpa')
                                                    @php
                                                        $final_gpa_point = 0;
                                                        $final_gpa_point = ($total_gpa_point - $optional_gpa)/  ($total_subject - $optional_subject);
                                                        $float_final_gpa_point=number_format($final_gpa_point,2);
                                                        if($float_final_gpa_point >= $maxgpa){
                                                            echo $maxgpa;
                                                        }else {
                                                            echo $float_final_gpa_point;
                                                        }
                                                    @endphp
                                                </th>
                                            </tr>
                                            </tfoot>
                                    </table>
                                        @else
                                            <div class="white-box mt-3">
                                                <table class="display school-table">
                                                    <tr>
                                                        <th colspan="4" class="text-center">
                                                            {{ __('lang.Your result is not published yet.') }} {{ __('Your result publication date is: ')}}  {{ dateConvert($exam->examSettings->publish_date) }}
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        @endif
                                    @else
                                        <div class="white-box mt-3">
                                            <table class="display school-table">
                                                <tr>
                                                    <th colspan="4" class="text-center">
                                                        {{ __('lang.Your result is not published yet.')}}
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>

                                    @endif
                                @else
                                    <div class="white-box mt-3">
                                        <table class="display school-table">
                                            <tr>
                                                <th colspan="4" class="text-center">
                                                    {{ __('lang.No Result found')}}
                                                </th>
                                            </tr>
                                        </table>
                                    </div>

                                @endif

                            @endforeach
                        </div>
                    </div>
                    <!-- End Exam Tab -->


                        <!-- Start Documents Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentDocuments">
                        <div class="white-box">
                            <table id="" class="table simple-table table-responsive school-table"
                                cellspacing="0">
                                <thead class="d-block">
                                    <tr class="d-flex">
                                        <th class="col-3">@lang('lang.document_title')</th>
                                        <th class="col-6">@lang('lang.name')</th>
                                        <th class="col-3">@lang('lang.action')</th>
                                    </tr>
                                </thead>

                                <tbody class="d-block">
                                    @if($student_detail->document_file_1 != "")
                                    <tr class="d-flex">
                                        <td class="col-3">{{$student_detail->document_title_1}} </td>
                                        <td class="col-6">{{showDocument(@$student_detail->document_file_1)}}</td>
                                        <td class="col-3 d-flex align-items-center">
                                            {{-- @if(userPermission(17)) --}}
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="{{asset($student_detail->document_file_1)}}" download>@lang('lang.download')</a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($student_detail->document_file_2 != "")
                                    <tr class="d-flex">
                                        <td class="col-3">{{$student_detail->document_title_2}}</td>
                                        <td class="col-6">{{showDocument(@$student_detail->document_file_2)}}</td>
                                        <td class="col-3 d-flex align-items-center">
                                            {{-- @if(userPermission(17)) --}}
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="{{asset($student_detail->document_file_2)}}" download>@lang('lang.download')</a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($student_detail->document_file_3 != "")
                                    <tr class="d-flex">
                                        <td class="col-3">{{$student_detail->document_title_3}}</td>
                                        <td class="col-6">{{showDocument(@$student_detail->document_file_3)}}</td>
                                        <td class="col-3 d-flex align-items-center">
                                            {{-- @if(userPermission(17)) --}}
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="{{asset($student_detail->document_file_3)}}" download>@lang('lang.download')</a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($student_detail->document_file_4 != "")
                                    <tr class="d-flex">
                                        <td class="col-3">{{$student_detail->document_title_4}}</td>
                                        <td class="col-6">{{showDocument(@$student_detail->document_file_4)}}</td>
                                        <td class="col-3 d-flex align-items-center">
                                            {{-- @if(userPermission(17)) --}}
                                                <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                    <a href="{{asset($student_detail->document_file_4)}}" download>@lang('lang.download')</a>
                                                    <span class="pl ti-download"></span>
                                                </button>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach($documents as $document)
                                    <tr class="d-flex">
                                        <td class="col-3">{{@$document->title}}</td>
                                        <td class="col-6">{{showDocument(@$document->file)}}</td>
                                        <td class="col-3">
                                            {{-- @if(userPermission(17)) --}}
                                                <a class="primary-btn tr-bg text-uppercase bord-rad" href="{{url(@$document->file)}}" download>
                                                    @lang('lang.download')<span class="pl ti-download"></span>
                                                </a>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Documents Tab -->


                    <!-- Add Document modal form start-->
                    <div class="modal fade admin-query" id="add_document_madal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">@lang('lang.upload') @lang('lang.documents')</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                   <div class="container-fluid">
                                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'upload_document',
                                                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload']) }}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="student_id" value="{{$student_detail->id}}">
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                                                <label>@lang('lang.title') <span>*</span> </label>
                                                                <span class="focus-border"></span>

                                                                <span class=" text-danger" role="alert" id="amount_error">

                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-30">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text" id="placeholderPhoto" placeholder="Document"
                                                                    disabled>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                                                <input type="file" class="d-none" name="photo" id="photo">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-lg-12 text-center mt-40">
                                                    <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                                        <span class="ti-check"></span>
                                                        save information
                                                    </button>
                                                </div> -->
                                                <div class="col-lg-12 text-center mt-40">
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                                                        <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Add Document modal form end-->
                    <!-- delete document modal -->

                    <!-- delete document modal -->
                    <!-- Start Timeline Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentTimeline">
                        <div class="white-box">
                            @foreach($timelines as $timeline)
                            <div class="student-activities">
                                <div class="single-activity">
                                    <h4 class="title text-uppercase">
                                    {{$timeline->date != ""? dateConvert($timeline->date):''}}
                                    </h4>
                                    <div class="sub-activity-box d-flex">
                                        <h6 class="time text-uppercase">10.30 pm</h6>
                                        <div class="sub-activity">
                                            <h5 class="subtitle text-uppercase"> {{$timeline->title}}</h5>
                                            <p>{{$timeline->description}}</p>
                                        </div>
                                        <div class="close-activity">
                                            @if(file_exists($timeline->file))
                                             @if (@Auth::user()->role_id == 1)
                                                <a href="{{url($timeline->file)}}" class="primary-btn tr-bg text-uppercase bord-rad" download>
                                                    @lang('lang.download')<span class="pl ti-download"></span>
                                                </a>
                                                @else
                                                <a href="{{url($timeline->file)}}" class="primary-btn tr-bg text-uppercase bord-rad" download>
                                                    @lang('lang.download')<span class="pl ti-download"></span>
                                                </a>
                                             @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Timeline Tab -->

                    

                </div>
            </div>
            <!-- End Student Details -->
        </div>


    </div>
</section>

<!-- timeline form modal start-->
<div class="modal fade admin-query" id="add_timeline_madal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.add') @lang('lang.timeline')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
               <div class="container-fluid">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_timeline_store',
                                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload']) }}
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="student_id" value="{{$student_detail->id}}">
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                            <label>@lang('lang.title') <span>*</span> </label>
                                            <span class="focus-border"></span>

                                            <span class=" text-danger" role="alert" id="amount_error">

                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control" id="startDate" type="text"
                                                 name="date">
                                                <label>@lang('lang.date')</label>
                                                <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description"></textarea>
                                    <label>@lang('lang.description')<span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-30">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="Document"
                                                disabled>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" name="document_file_4" id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">

                                <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
                                <label for="currentAddressCheck">@lang('lang.visible_to_this_person')</label>
                            </div>


                            <!-- <div class="col-lg-12 text-center mt-40">
                                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                    <span class="ti-check"></span>
                                    save information
                                </button>
                            </div> -->
                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                                    <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save')</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
<!-- timeline form modal end-->




@endsection
