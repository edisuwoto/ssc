@extends('backEnd.master')
@section('title')
@lang('lang.book_list')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-50 white-box">
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
    <div class="row mt-50">
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
                                <th>@lang('lang.sl')</th>
                                <th>@lang('lang.book_title')</th>
                                <th>@lang('lang.book') @lang('lang.no')</th>
                                <th>@lang('lang.isbn') @lang('lang.no')</th>
                                <th>@lang('lang.category')</th>
                                {{-- <th>@lang('lang.subject')</th> --}}
                                <th>@lang('lang.publisher') @lang('lang.name')</th>
                                <th>@lang('lang.author_name')</th>
                                <th>@lang('lang.quantity')</th>
                                <th>@lang('lang.price')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $count=1; @endphp
                            @foreach($books as $value)
                            <tr>
                                <td class="text-center">{{$count++}}</td>
                                <td class="text-center">{{$value->book_title}} </td>
                                <td class="text-center">{{$value->book_number}}</td>
                                <td class="text-center">{{$value->isbn_no}}</td>
                                <td class="text-center">
                                @if(!empty($value->book_category_id))
                                    {{(@$value->book_category_id != "")? $value->category_name:'' }}
                                @endif
                                </td>
                                {{-- <td class="text-center">
                                @if(!empty($value->subject_id))
                                    {{(@$value->subject_id != "")? $value->subject_name:'' }} 
                                @endif
                                </td> --}}
                                <td class="text-center">{{$value->publisher_name}}</td>
                                <td class="text-center">{{$value->author_name}}</td>
                                <td class="text-center">{{$value->quantity}}</td>
                               <td class="text-center">{{$value->book_price}}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                           @if(userPermission(302))
                                            <a class="dropdown-item" href="{{route('edit-book',$value->id)}}">@lang('lang.edit')</a>
                                        @endif
                                        @if(userPermission(303))
                                            <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Book" href="{{route('delete-book-view',$value->id   )}}">@lang('lang.delete')</a>
                                        @endif
                                       </div>
                                   </div>
                               </td>
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
