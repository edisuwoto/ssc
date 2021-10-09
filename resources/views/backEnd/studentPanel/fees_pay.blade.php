@extends('backEnd.master')
@section('title')
@lang('lang.pay_fees')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.fees')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.fees')</a>
                    <a href="{{route('student_fees')}}">@lang('lang.pay_fees')</a>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="url" value="{{URL::to('/')}}">
    <input type="hidden" id="student_id" value="{{@$student->id}}">
    <section class="full_wide_table ">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="d-flex justify-content-between">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.add_fees') </h3>
                        </div>
                    </div>
                </div>
            </div>
            @if(session()->has('message-success'))
                <div class="alert alert-success">
                    {{ session()->get('message-success') }}
                </div>
            @elseif(session()->has('message-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12" id="myFrame">
                    <div class="table-responsive">
                        <table id="" class="display school-table school-table-style-parent-fees" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="nowrap">@lang('lang.fees_group') </th>
                                <th class="nowrap">@lang('lang.fees_code') </th>
                                <th class="nowrap">@lang('lang.due_date') </th>
                                <th class="nowrap">@lang('lang.status')</th>
                                <th class="nowrap">@lang('lang.amount') ({{@generalSetting()->currency_symbol}})</th>
                                <th class="nowrap">@lang('lang.payment_id')</th>
                                <th class="nowrap">@lang('lang.mode')</th>
                                <th class="nowrap">@lang('lang.date')</th>
                                <th class="nowrap">@lang('lang.discount') ({{@generalSetting()->currency_symbol}})</th>
                                <th class="nowrap">@lang('lang.fine') ({{@generalSetting()->currency_symbol}})</th>
                                <th class="nowrap">@lang('lang.paid') ({{@generalSetting()->currency_symbol}})</th>
                                <th class="nowrap">@lang('lang.balance')</th>
                                <th class="nowrap">@lang('lang.payment')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                @$grand_total = 0;
                                @$total_fine = 0;
                                @$total_discount = 0;
                                @$total_paid = 0;
                                @$total_grand_paid = 0;
                                @$total_balance = 0;


                                $count = 0;
                            @endphp

                            @foreach($fees_assigneds as $fees_assigned)
                                @php
                                    $count++;

                                     @$grand_total += @$fees_assigned->feesGroupMaster->amount;


                                @endphp

                                @php
                                    @$discount_amount = $fees_assigned->applied_discount;
                                    @$total_discount += @$discount_amount;
                                    @$student_id = @$fees_assigned->student_id;
                                @endphp
                                @php
                                    //Sum of total paid amount of single fees type
                                     $paid = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('amount');
                                    
                                     @$total_grand_paid += @$paid;
                                @endphp
                                @php
                                    //Sum of total fine for single fees type
                                    $fine = \App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id,$fees_assigned->student_id)->sum('fine');
               
                                    @$total_fine += $fine;
                                @endphp

                                @php
                                    @$total_paid = @$discount_amount + @$paid;
                                @endphp
                                <tr>
                                    <td>
                                        {{@$fees_assigned->feesGroupMaster->feesGroups != ""? @$fees_assigned->feesGroupMaster->feesGroups->name:""}}
                                    </td>
                                    <td>
                                        {{@$fees_assigned->feesGroupMaster->feesTypes->name}}
                                    </td>
                                    <td class="nowrap">
                                        {{@$fees_assigned->feesGroupMaster->date != ""? dateConvert(@$fees_assigned->feesGroupMaster->date):''}}
                                    </td>

                                    <td>
                                        @php
                                            // $total_payable_amount=$fees_assigned->feesGroupMaster->amount+$fine;
                                            $total_payable_amount=$fees_assigned->feesGroupMaster->amount;
                                            $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                            $balance_amount=number_format($rest_amount+$fine, 2, '.', '');
                                            $total_balance +=  $balance_amount;
                                        @endphp
                                        @if($balance_amount ==0)
                                            <button class="primary-btn small bg-success text-white border-0">@lang('lang.paid')</button>
                                        @elseif($paid != 0)
                                            <button class="primary-btn small bg-warning text-white border-0">@lang('lang.partial')</button>
                                        @elseif($paid == 0)
                                            <button class="primary-btn small bg-danger text-white border-0">@lang('lang.unpaid')</button>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            echo @$total_payable_amount;
                                        @endphp
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> {{@$discount_amount}} </td>
                                    <td>{{@$fine}}</td>
                                    <td>{{@$paid}}</td>
                                    <td>
                                        @php
                                            @$rest_amount = $fees_assigned->fees_amount;
                                            echo @$balance_amount;
                                        @endphp
                                    </td>
                                    <td>

                                        @if($rest_amount =! 0)
                                            @php
                                                $already_add = $student->bankSlips->where('fees_type_id', $fees_assigned->feesGroupMaster->fees_type_id)->first();
                                                
                                            @endphp
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">


                                                    @if($already_add=="" && $balance_amount !=0)

                                                        @if(@$data['bank_info']->active_status == 1 || @$data['cheque_info']->active_status == 1 )
                                                            
                                                            <a class="dropdown-item modalLink"
                                                               data-modal-size="modal-lg"
                                                               title="{{$fees_assigned->feesGroupMaster->feesGroups->name.': '. $fees_assigned->feesGroupMaster->feesTypes->name}}"
                                                               href="{{route('fees-generate-modal-child', [@$balance_amount, $fees_assigned->student_id, $fees_assigned->feesGroupMaster->fees_type_id,$fees_assigned->id])}}"> @lang('lang.add') @lang('lang.bank') @lang('lang.payment')</a>

                                                        @endif

                                                    @else
                                                        @if($balance_amount !=0)
                                                            <a class="dropdown-item modalLink"
                                                               data-modal-size="modal-lg"
                                                               title="{{$fees_assigned->feesGroupMaster->feesGroups->name.': '. $fees_assigned->feesGroupMaster->feesTypes->name}}"
                                                               href="{{route('fees-generate-modal-child', [@$balance_amount, $fees_assigned->student_id, $fees_assigned->feesGroupMaster->fees_type_id,$fees_assigned->id])}}">  @lang('lang.add') @lang('lang.bank') @lang('lang.payment')</a>
                                                                 
                                                                 @if ($already_add!="")
                                                                    <a class="dropdown-item modalLink" data-modal-size="modal-lg"
                                                                    title="{{$fees_assigned->feesGroupMaster->feesGroups->name.': '. $fees_assigned->feesGroupMaster->feesTypes->name}}"
                                                                    href="{{route('fees-generate-modal-child-view', [$fees_assigned->student_id,$fees_assigned->feesGroupMaster->fees_type_id,$fees_assigned->id])}}">@lang('lang.view') @lang('lang.bank') @lang('lang.payment')</a>


                                                                    @if(@$already_add->approve_status == 0)
                                                                        <a onclick="deleteId({{@$already_add->id}});"
                                                                        class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#deleteStudentModal"
                                                                        data-id="{{@$already_add->id}}">@lang('lang.delete') @lang('lang.bank') @lang('lang.payment')</a>

                                                                    @endif
                                                        
                                                                 @endif
                                                        @else
                                                            @if ($already_add!="")
                                                                <a class="dropdown-item modalLink" data-modal-size="modal-lg"
                                                                title="{{$fees_assigned->feesGroupMaster->feesGroups->name.': '. $fees_assigned->feesGroupMaster->feesTypes->name}}"
                                                                href="{{route('fees-generate-modal-child-view', [$fees_assigned->student_id,$fees_assigned->feesGroupMaster->fees_type_id,$fees_assigned->id])}}">@lang('lang.view') @lang('lang.bank') @lang('lang.payment')</a>
  
                                                            @else
                                                                <a class="dropdown-item">@lang('lang.paid')</a>
                                                            @endif
                                                           
                                                        @endif
                                                    @endif
                                                    @php
                                                    $is_paypal = DB::table('sm_payment_methhods')->where('method','PayPal')->where('active_status',1)->first();
                                                    @endphp
                                                    @if(!empty($is_paypal) && $balance_amount !=0)
                                                        <form method="POST" action="{{ route('studentPayByPaypal') }}"
                                                            accept-charset="UTF-8" class="form-horizontal" role="form">
                                                                    @csrf
                                                                <input type="hidden" name="assign_id" id="assign_id" value="{{$fees_assigned->id}}">                                                                
                                                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                                                <input type="hidden" name="real_amount" id="real_amount" value="{{$balance_amount}}">
                                                                <input type="hidden" name="student_id" value="{{$student->id}}">
                                                                <input type="hidden" name="fees_type_id" value="{{$fees_assigned->feesGroupMaster->fees_type_id}}"> 


                                                            <button type="submit" class=" dropdown-item">
                                                            @lang('lang.pay_with') @lang('lang.paypal')
                                                            </button>

                                                        </form>
                                                    @endif
                                                    @php
                                                    $is_paystack = DB::table('sm_payment_methhods')->where('method','Paystack')->where('active_status',1)->first();
                                                    @endphp
                                                    @if(!empty($is_paystack) && $balance_amount !=0)
                                                        <form method="POST" action="{{ route('pay-with-paystack') }}"
                                                              accept-charset="UTF-8" class="form-horizontal"
                                                              role="form">
                                                           <input type="hidden" name="assign_id" id="assign_id" value="{{$fees_assigned->id}}">
                                                           
                                                    @if(($student->email == ""))
                                                        <input type="hidden" name="email"
                                                               value="{{ @$student->parents->guardians_email }}"> 
                                                    @else 
                                                    <input type="hidden" name="email"
                                                               value="{{ auth()->user()->email }}">

                                                               @endif
                                                            <input type="hidden" name="orderID" value="345">
                                                            <input type="hidden" name="amount"
                                                                   value="{{$balance_amount * 100}}"> {{-- required in kobo --}}
                                                            <input type="hidden" name="quantity" value="3">
                                                            <input type="hidden" name="fees_type_id"
                                                                   value="{{$fees_assigned->feesGroupMaster->fees_type_id}}">
                                                            <input type="hidden" name="student_id"
                                                                   value="{{$student->id}}">
                                                            <input type="hidden" name="payment_mode"
                                                                   value="{{@$payment_gateway->id}}">
                                                            <input type="hidden" name="metadata"
                                                                   value="{{ json_encode($array = ['key_name' => 'value',]) }}"> {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                                            <input type="hidden" name="reference"
                                                                   value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                            <input type="hidden" name="key"
                                                                   value="{{ @$paystack_info->gateway_secret_key }}"> {{-- required --}}
                                                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                                            <button type="submit" class=" dropdown-item">
                                                                @lang('lang.pay_via_paystack')
                                                            </button>

                                                        </form>
                                                    @endif
                                                    @php
                                                        $is_stripe = DB::table('sm_payment_methhods')->where('method','Stripe')->where('active_status',1)->where('school_id', Auth::user()->school_id)->first();
                                                    @endphp
                                                    @if(!empty($is_stripe) && $balance_amount !=0)


                                                        <a class="dropdown-item modalLink" data-modal-size="modal-lg"
                                                           title="@lang('lang.pay') @lang('lang.fees') "
                                                           href="{{route('fees-payment-stripe', [@$fees_assigned->feesGroupMaster->fees_type_id, $student->id, $balance_amount,$fees_assigned->id])}}">
                                                           @lang('lang.pay_with') @lang('lang.stripe')
                                                        </a>
                                                    @endif


                                                    {{-- Start Xendit Payment --}}

                                                    @if( (moduleStatusCheck('XenditPayment') == TRUE) && ($balance_amount != 0) )

                                                            <form action="{!!route('xenditpayment.feesPayment')!!}"
                                                                  method="POST"
                                                                  style="width: 100%; text-align: center">
                                                                @csrf

                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount * 1000}}"/>

                                                                <input type="hidden" name="fees_type_id"
                                                                       id="fees_type_id"
                                                                       value="{{$fees_assigned->feesGroupMaster->fees_type_id}}">
                                                                <input type="hidden" name="student_id" id="student_id"
                                                                       value="{{$student->id}}">
                                                                <input type="hidden" name="payment_mode"
                                                                       id="payment_mode"
                                                                       value="{{$payment_gateway->id}}">

                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount * 1000}}"/>
                                                                <div class="pay">
                                                                    <button class="dropdown-item razorpay-payment-button btn filled small"
                                                                             type="submit">
                                                                            @lang('lang.pay_with') @lang('lang.xendit')
                                                                    </button>
                                                                </div>
                                                            </form>
                                                     
                                                    @endif

                                                    {{-- Start Razorpay Checking --}}

                                                    @if(moduleStatusCheck('RazorPay') == TRUE)

                                                        @if(!empty($is_RazorPay))
                                                            <form id="rzp-footer-form_{{$count}}"
                                                                  action="{!!route('razorpay/dopayment')!!}"
                                                                  method="POST"
                                                                  style="width: 100%; text-align: center">
                                                                @csrf
                                                                <input type="hidden" name="assign_id" id="assign_id" value="{{$fees_assigned->id}}">
                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount * 100}}"/>

                                                                <input type="hidden" name="fees_type_id"
                                                                       id="fees_type_id"
                                                                       value="{{$fees_assigned->feesGroupMaster->fees_type_id}}">
                                                                <input type="hidden" name="student_id" id="student_id"
                                                                       value="{{$student->id}}">
                                                                <input type="hidden" name="payment_mode"
                                                                       id="payment_mode"
                                                                       value="{{$payment_gateway->id}}">

                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount}}"/>
                                                                <div class="pay">
                                                                    <button class="dropdown-item razorpay-payment-button btn filled small"
                                                                            id="paybtn_{{$count}}" type="button">
                                                                            @lang('lang.pay_with') @lang('lang.razorpay')
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        @endif

                                                        {{-- Start Xendit Checking --}}

                                                    @if(moduleStatusCheck('XenditPayment') == TRUE)

                                                            <form id="xend-footer-form_{{$count}}"
                                                                  action="{!!route('xenditpayment.studentPayt')!!}"
                                                                  method="POST"
                                                                  style="width: 100%; text-align: center">
                                                                @csrf

                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount * 1000}}"/>

                                                                <input type="hidden" name="fees_type_id"
                                                                       id="fees_type_id"
                                                                       value="{{$fees_assigned->feesGroupMaster->fees_type_id}}">
                                                                <input type="hidden" name="student_id" id="student_id"
                                                                       value="{{$student->id}}">
                                                                <input type="hidden" name="payment_mode"
                                                                       id="payment_mode"
                                                                       value="{{$payment_gateway->id}}">

                                                                <input type="hidden" name="amount" id="amount"
                                                                       value="{{$balance_amount}}"/>
                                                                <div class="pay">
                                                                    <button class="dropdown-item razorpay-payment-button btn filled small"
                                                                            id="paybtn_{{$count}}" type="button">
                                                                            @lang('lang.pay_with') @lang('lang.xendit')
                                                                    </button>
                                                                </div>
                                                            </form>
                                                     
                                                    @endif
                                                </div>
                                            </div>

                                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                                            <!-- start razorpay code -->

                                            <script>

                                                $('#rzp-footer-form_<?php echo $count; ?>').submit(function (e) {
                                                    var button = $(this).find('button');
                                                    var parent = $(this);
                                                    button.attr('disabled', 'true').html('Please Wait...');
                                                    $.ajax({
                                                        method: 'get',
                                                        url: this.action,
                                                        data: $(this).serialize(),
                                                        complete: function (r) {
                                                            console.log('complete');
                                                            console.log(r);
                                                        }
                                                    })
                                                    return false;
                                                })
                                            </script>

                                            <script>
                                                function padStart(str) {
                                                    return ('0' + str).slice(-2)
                                                }

                                                function demoSuccessHandler(transaction) {
                                                    // You can write success code here. If you want to store some data in database.
                                                    $("#paymentDetail").removeAttr('style');
                                                    $('#paymentID').text(transaction.razorpay_payment_id);
                                                    var paymentDate = new Date();
                                                    $('#paymentDate').text(
                                                        padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                                                    );

                                                    $.ajax({
                                                        method: 'post',
                                                        url: "{!!url('razorpay/dopayment')!!}",
                                                        data: {
                                                            "_token": "{{ csrf_token() }}",
                                                            "razorpay_payment_id": transaction.razorpay_payment_id,
                                                            "amount": <?php echo $rest_amount * 100; ?>,
                                                            "fees_type_id": <?php echo $fees_assigned->feesGroupMaster->fees_type_id; ?>,
                                                            "student_id": <?php echo $student->id; ?>
                                                        },
                                                        complete: function (r) {
                                                            console.log('complete');
                                                            console.log(r);

                                                            setTimeout(function () {
                                                                toastr.success('Operation successful', 'Success', {
                                                                    "iconClass": 'customer-info'
                                                                }, {
                                                                    timeOut: 2000
                                                                });
                                                            }, 500);

                                                            location.reload();
                                                        }
                                                    })
                                                }
                                            </script>
                                            <script>
                                                var options_<?php echo $count; ?> = {
                                                    key: "{{ @$razorpay_info->gateway_secret_key }}",
                                                    amount: <?php echo $rest_amount * 100; ?>,
                                                    name: 'Online fee payment',
                                                    image: 'https://i.imgur.com/n5tjHFD.png',
                                                    handler: demoSuccessHandler
                                                }
                                            </script>
                                            <script>
                                                window.r_<?php echo $count; ?> = new Razorpay(options_<?php echo $count; ?>);
                                                document.getElementById('paybtn_<?php echo $count; ?>').onclick = function () {
                                                    r_<?php echo $count; ?>.open()
                                                }
                                            </script>
                                            <!-- end razorpay code -->
                                        @endif
                                        @endif

                                        {{-- End Razorpay checking --}}

                                    </td>

                                </tr>
                                @php
                                    @$payments =$student->feesPayment->where('active_status', 1)->where('fees_type_id',$fees_assigned->feesGroupMaster->feesTypes->id);
                                    $i = 0;
                                @endphp

                                @foreach($payments as $payment)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><img
                                                    src="{{asset('public/backEnd/img/table-arrow.png')}}"></td>
                                        <td>
                                            @php
                                                @$created_by = App\User::find($payment->created_by);
                                            @endphp
                                            @if(@$created_by != "")


                                                <a href="#" data-toggle="tooltip" data-placement="right"
                                                   title="{{'Collected By: '.@$created_by->full_name}}">{{@$payment->fees_type_id.'/'.@$payment->id}}</a>
                                        </td>
                                        @endif
                                        <td>
                                            {{$payment->payment_mode}}
                                        </td>
                                        <td class="nowrap">
                                            {{@$payment->payment_date != ""? dateConvert(@$payment->payment_date):''}}
                                        </td>
                                        <td>
                                            {{@$payment->discount_amount}}
                                        </td>
                                        <td>
                                            {{@$payment->fine}}
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
                                            {{@$payment->amount}}
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                            @foreach($fees_discounts as $fees_discount)
                                <tr>
                                    <td>@lang('lang.discount')</td>
                                    <td>{{@$fees_discount->feesDiscount!=""?@$fees_discount->feesDiscount->name:""}}</td>
                                    <td></td>
                                    <td>@if(in_array(@$fees_discount->id, @$applied_discount))
                                            @php
                                                // $createdBy = App\SmFeesAssign::createdBy($student_id, $fees_discount->id);
                                                // $created_by = App\User::find($createdBy->created_by);

                                            @endphp
                                            {{--  <a href="#" data-toggle="tooltip" data-placement="right" title="{{'Collected By: '.$created_by->full_name}}">Discount of ${{$fees_discount->feesDiscount->amount}} Applied : {{$createdBy->id.'/'.$createdBy->created_by}}</a> --}}

                                        @else
                                            @lang('lang.discount_of')
                                             {{@generalSetting()->currency_symbol}}{{@$fees_discount->feesDiscount->amount}}
                                            @lang('lang.assigned')
                                        @endif
                                    </td>
                                    <td>{{@$fees_discount->name}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    @lang('lang.grand') @lang('lang.total') ({{@generalSetting()->currency_symbol}})
                                </th>
                                <th></th>
                                <th>
                                    {{@$grand_total}}
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    {{@$total_discount}}
                                </th>
                                <th>
                                    {{@$total_fine}}
                                </th>
                                <th>
                                    {{@$total_grand_paid}}
                                </th>
                                <th>
                                    {{number_format($total_balance, 2, '.', '')}}

                                </th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade admin-query" id="deleteFeesPayment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <h4>@lang('lang.are_you_sure_to_detete_this_item')?</h4>
                    </div>

                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal">@lang('lang.cancel')</button>
                        {{ Form::open(['route' => 'fees-payment-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" id="feep_payment_id">
                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade admin-query" id="deleteStudentModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                    </div>

                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal">@lang('lang.cancel')</button>
                        {{ Form::open(['url' => 'child-bank-slip-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" value="" id="student_delete_i"> {{-- using js in main.js --}}
                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
