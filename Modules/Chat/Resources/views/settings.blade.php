@extends('backEnd.master')
@section('title')
    @lang('lang.settings')
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor" id="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="white_box_30px">
                                    <!-- SMTP form  -->
                                    <div class="main-title mb-25">
                                        <h3 class="mb-0">
                                            @lang('lang.chatting') @lang('lang.method') @lang('lang.settings')
                                        </h3>
                                    </div>

                                    <form action="{{ route('chat.settings') }}" method="post" class="bg-white p-4 rounded">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.chat') @lang('lang.settings')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="chat_method" id="relationFather6343" value="pusher" class="common-radio relationButton" {{ env('BROADCAST_DRIVER') == 'pusher' ? 'checked' : ''}}>
                                                        <label for="relationFather6343">Pusher</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="chat_method" id="relationMother733" value="jquery" class="common-radio relationButton" {{ env('BROADCAST_DRIVER') == null || env('BROADCAST_DRIVER') == 'log' ? 'checked' : ''}}>
                                                        <label for="relationMother733">jQuery</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="pusher" style="display: none">
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">pusher app id *</label>
                                                    <input required class="primary_input_field" placeholder="-" type="text" name="pusher_app_id" value="{{ env('PUSHER_APP_ID') }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">pusher app key *</label>
                                                    <input required class="primary_input_field" placeholder="-" type="text" name="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">pusher app secret *</label>
                                                    <input required class="primary_input_field" placeholder="-" type="text" name="pusher_app_secret" value="{{ env('PUSHER_APP_SECRET') }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">pusher app cluster *</label>
                                                    <input required class="primary_input_field" placeholder="-" type="text" name="pusher_app_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="primary-btn small fix-gr-bg"><i class="ti-check"></i>@lang('lang.update')</button>
                                    </form>
                                </div>

                                <div class="white_box_30px mt-5">
                                    <!-- SMTP form  -->
                                    <div class="main-title mb-25">
                                        <h3 class="mb-0">@lang('lang.chat') @lang('lang.settings')</h3>
                                    </div>
                                    <form action="{{ route('chat.settings.permission.store') }}" method="post" class="bg-white p-4 rounded">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3 justify-content-between">
                                                <p class="text-uppercase mb-0">@lang('lang.can_teacher_chat_with_parents')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_teacher_chat_with_parents" id="relationFather" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_teacher_chat_with_parents') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_teacher_chat_with_parents" id="relationMother" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_teacher_chat_with_parents') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.can_student_chat_with_admin_accounts')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_student_chat_with_admin_account" id="relationFather1" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_student_chat_with_admin_account') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather1">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_student_chat_with_admin_account" id="relationMother2" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_student_chat_with_admin_account') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother2">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.admin_can_chat_without_invitation')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="admin_can_chat_without_invitation" id="relationFather3" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_admin_can_chat_without_invitation') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather3">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="admin_can_chat_without_invitation" id="relationMother4" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_admin_can_chat_without_invitation') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother4">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.open_chat_system')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="open_chat_system" id="relationFather5" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_open') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather5">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="open_chat_system" id="relationMother6" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_open') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother6">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-xl-12">--}}
                                            {{--                                                <div class="primary_input">--}}
                                            {{--                                                    <label class="primary_input_label" for="">Everyone to Everyone Chat</label>--}}
                                            {{--                                                    <select class="primary_select mb-25" name="everyone_to_everyone">--}}
                                            {{--                                                        <option value="yes" {{ app('general_settings')->get('chat_everyone_to_everyone') == 'yes' ? 'selected' : ''}}>Yes</option>--}}
                                            {{--                                                        <option value="no" {{ app('general_settings')->get('chat_everyone_to_everyone') == 'no' ? 'selected' : ''}}>No</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                            {{--                                            <div class="col-xl-12">--}}
                                            {{--                                                <div class="primary_input">--}}
                                            {{--                                                    <label class="primary_input_label" for="">Teacher can chat with parent on respective class</label>--}}
                                            {{--                                                    <select class="primary_select mb-25" name="teacher_can_chat_with_parents">--}}
                                            {{--                                                        <option value="yes" {{ app('general_settings')->get('chat_teacher_can_chat_with_parents') == 'yes' ? 'selected' : ''}}>Yes</option>--}}
                                            {{--                                                        <option value="no" {{ app('general_settings')->get('chat_teacher_can_chat_with_parents') == 'no' ? 'selected' : ''}}>No</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                        </div>
                                        <button class="primary-btn small fix-gr-bg"><i class="ti-check"></i>@lang('lang.update')</button>
                                    </form>
                                </div>


                                <div class="white_box_30px mt-5">
                                    <!-- SMTP form  -->
                                    <div class="main-title mb-25">
                                        <h3 class="mb-0">@lang('lang.invitation') @lang('lang.settings')</h3>
                                    </div>
                                    <form action="{{ route('chat.invitation.requirement') }}" method="post" class="bg-white p-4 rounded">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.invitation') @lang('lang.requirement')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="invitation_requirement" id="relationFather6" value="required" class="common-radio relationButton" {{ app('general_settings')->get('chat_invitation_requirement') == 'required' ? 'checked' : ''}}>
                                                        <label for="relationFather6">@lang('lang.required')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="invitation_requirement" id="relationMother7" value="none" class="common-radio relationButton" {{ app('general_settings')->get('chat_invitation_requirement') == 'none' ? 'checked' : ''}}>
                                                        <label for="relationMother7">@lang('lang.not') @lang('lang.required')</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <button class="primary-btn small fix-gr-bg"><i class="ti-check"></i>@lang('lang.update')</button>
                                    </form>
                                </div>

                                @if( is_null(app('general_settings')->get('chat_generate')) || app('general_settings')->get('chat_generate') != 'generated')
                                    <div class="white_box_30px mt-5">
                                        <div class="main-title mb-25">
                                            <h3 class="mb-0">@lang('lang.generate') @lang('lang.connections')</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <form action="{{ route('chat.invitation.generate','single') }}" method="get" class="bg-white p-4 rounded">
                                                    <p class="text-uppercase mb-0">
                                                        @lang('lang.generate') @lang('lang.teacher') @lang('lang.and') @lang('lang.student') @lang('lang.connection') @lang('lang.for') @lang('lang.old') @lang('lang.class') @lang('lang.&') @lang('lang.subjects')
                                                    </p>
                                                    <br>
                                                    <button class="primary-btn radius_30px  fix-gr-bg"><i class="ti-check"></i>@lang('lang.generate')</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="white_box_30px mt-5">
                                    <!-- SMTP form  -->
                                    <div class="main-title mb-25">
                                        <h3 class="mb-0">@lang('lang.permission') @lang('lang.settings')</h3>
                                    </div>
                                    <form action="{{ route('chat.settings.edu') }}" method="post" class="bg-white p-4 rounded">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.can_upload_file')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_upload_file" id="relationFather6334" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_upload_file') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather6334">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_upload_file" id="relationMother7334" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_upload_file') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother7334">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <div class="primary_input">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="primary_input_label" for="">@lang('lang.upload_file_limit') (@lang('lang.mb'))</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="primary_input_field" placeholder="-" type="number" name="file_upload_limit" value="{{ app('general_settings')->get('chat_file_limit') ?? 0 }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.can_make_group')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_make_group" id="relationFather63" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_make_group') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather63">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="can_make_group" id="relationMother73" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_can_make_group') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother73">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.can_staff_or_teacher_ban_tudent')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="staff_or_teacher_can_ban_student" id="relationFather33" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_staff_or_teacher_can_ban_student') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather33">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="staff_or_teacher_can_ban_student" id="relationMother22" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_staff_or_teacher_can_ban_student') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother22">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex relation-button justify-content-between mb-3">
                                                <p class="text-uppercase mb-0">@lang('lang.teacher_can_pinned_top_message')</p>
                                                <div class="d-flex radio-btn-flex ml-30">
                                                    <div class="mr-20">
                                                        <input type="radio" name="teacher_can_pin_top_message" id="relationFather11" value="yes" class="common-radio relationButton" {{ app('general_settings')->get('chat_teacher_can_pin_top_message') == 'yes' ? 'checked' : ''}}>
                                                        <label for="relationFather11">@lang('lang.yes')</label>
                                                    </div>
                                                    <div class="mr-20">
                                                        <input type="radio" name="teacher_can_pin_top_message" id="relationMother00" value="no" class="common-radio relationButton" {{ app('general_settings')->get('chat_teacher_can_pin_top_message') == 'no' ? 'checked' : ''}}>
                                                        <label for="relationMother00">@lang('lang.no')</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="primary-btn small fix-gr-bg"><i class="ti-check"></i>@lang('lang.update')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
            let method = $('input[name="chat_method"]:checked').val();
            if (method == 'pusher') {
                $('#pusher').css('display','');
                $('#jquery').hide();
                $('#pusher').show();
            }else{
                $('#pusher').hide();
            }
            $('input[name=chat_method]').change(function () {
                let method = $('input[name="chat_method"]:checked').val();
                if (method == 'pusher') {
                    $('#jquery').hide();
                    $('#pusher').show();
                }else{
                    $('#pusher').hide();
                }
            });
        });
    </script>
@endpush
