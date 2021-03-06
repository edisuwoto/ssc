@extends('backEnd.master')
@section('title') 
@lang('lang.book_list')
@endsection

@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.book_list')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.library')</a>
                <a href="#">@lang('lang.book_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
    <div class="row mt-40">
        <div class="col-lg-12">
           <div class="row">
               <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead> 
                            @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                            <tr>
                                <td colspan="10">
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
                                <th>@lang('lang.book_title')</th>
                                <th>@lang('lang.book') @lang('lang.none')</th>
                                <th>@lang('lang.isbn') @lang('lang.none')</th>
                                <th>@lang('lang.category')</th>
                                <th>@lang('lang.subject')</th>
                                <th>@lang('lang.publisher') @lang('lang.name')</th>
                                <th>@lang('lang.author_name')</th>
                                <th>@lang('lang.quantity')</th>
                                <th>@lang('lang.price')</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            @foreach($books as $value)
                            <tr>
                                <td>{{$value->book_title}}</td>
                                <td>{{$value->book_number}}</td>
                                <td>{{$value->isbn_no}}</td>
                                <td>
                                @if(!empty($value->book_category_id))
                                    {{$value->bookCategory->category_name}}
                                @endif
                                </td>
                                <td>
                                @if(!empty($value->subject))
                                 {{$value->bookSubject->subject_name}}
                                @endif
                                </td>
                                <td>{{$value->publisher_name}}</td>
                                <td>{{$value->author_name}}</td>
                                <td>{{$value->quantity}}</td>
                               <td>{{$value->book_price}}</td>
                           </tr>
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