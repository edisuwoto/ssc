@extends('backEnd.master')
@section('title') 
@lang('lang.fees_statement')
@endsection
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.fees_statement')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.fees_statement')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success') != "")
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                    @endif
                @endif

                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_statement_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-4 mt-30-md md_mb_20">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md md_mb_20" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section')*" value="">@lang('lang.select_section') *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md md_mb_20" id="select_student_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                        <option data-display="@lang('lang.select_student') *" value="">@lang('lang.select_student') *</option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_student_loader">
                                        <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                                    </div>
                                    @if ($errors->has('student'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('student') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
            
    @if(isset($fees_assigneds))
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.fees_statement')</h3>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{asset($student->student_photo)}}" alt="">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.name')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->full_name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.father_name')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->parents !=""?$student->parents->fathers_name:""}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.mobile')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->mobile}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.category')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->category!=""?$student->category->category_name:""}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-2 col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.class') @lang('lang.section')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @if($student->className !="" && $student->section !="")
                                                {{$student->className->class_name .'('.$student->section->section_name.')'}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.admission') @lang('lang.no')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->admission_no}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @lang('lang.roll') @lang('lang.no')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                {{$student->roll_no}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>             
    </div>
</div>

@endif

    </div>
</section>

@if(isset($fees_assigneds))

<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('message-success') != "" ||
                            session()->get('message-danger') != "")
                        <tr>
                            <td colspan="14">
                                @if(session()->has('message-success'))
                                <div class="alert alert-success">
                                    {{ session()->get('message-success') }}
                                </div>
                                @elseif(session()->has('message-danger'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message-danger') }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('lang.fees_group')</th>
                            <th>@lang('lang.due_date')</th>
                            <th>@lang('lang.Status')</th>
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
                            <td>
                                {{@$fees_assigned->feesGroupMaster->feesGroups->name}} / {{@$fees_assigned->feesGroupMaster->feesTypes->name}}
                            </td>
                            <td>
                                @if($fees_assigned->feesGroupMaster !="")
                                    {{$fees_assigned->feesGroupMaster->date != ""? dateConvert($fees_assigned->feesGroupMaster->date):''}}
                                @endif
                            </td>
                            <td>
  
                                @php
                                    $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    
                                    $total_balance +=  $rest_amount;
                                    
                                    $balance_amount = number_format($rest_amount+$fine, 2, '.', '');
                                   
                                @endphp
                                
                                @if($balance_amount == 0)
                                    <button class="primary-btn small bg-success text-white border-0">@lang('lang.paid')</button>
                                @elseif($paid != 0)
                                    <button class="primary-btn small bg-warning text-white border-0">@lang('lang.partial')</button>
                                @elseif($paid == 0)
                                    <button class="primary-btn small bg-danger text-white border-0">@lang('lang.unpaid')</button>
                                @endif
                            </td>
                            <td>{{$fees_assigned->feesGroupMaster->amount}}</td>
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
                                    echo $balance_amount;
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
                                <td class="text-right">
                                    <img src="{{asset('public/backEnd/img/table-arrow.png')}}">
                                </td>
                                <td>
                                    @php
                                        $created_by = App\User::find($payment->created_by);
                                    @endphp
                                    @if($created_by != "")
                                        <a href="#" data-toggle="tooltip" data-placement="right" title="{{'Collected By: '.$created_by->full_name}}">{{$payment->fees_type_id.'/'.$payment->id}}</a>
                                </td>
                                    @endif
                                <td>{{$payment->payment_mode}}</td>
                                <td class="nowrap">{{$payment->payment_date != ""? dateConvert($payment->payment_date):''}}</td>
                                <td class="text-center">{{$payment->discount_amount}}</td>
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
                                <td>{{$payment->amount}}</td>
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
                            <th>{{ number_format($grand_total, 2, '.', '') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($total_discount, 2, '.', '') }}</th>
                            <th>{{ number_format($total_fine, 2, '.', '') }}</th>
                            <th>{{ number_format($total_grand_paid, 2, '.', '') }}</th>
                                @php
                                    $show_balance=$grand_total+$total_fine-$total_discount;
                                @endphp
                            <th>{{ number_format($show_balance-$total_grand_paid, 2, '.', '') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

@endif


@endsection
