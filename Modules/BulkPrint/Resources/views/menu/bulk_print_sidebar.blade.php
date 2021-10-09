@if(userPermission(920) && menuStatus(920))
<li data-position="{{menuPosition(920)}}" class="sortable_li">
    <a href="#subMenuBulkPrint" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        @lang('lang.bulk_print')
    </a>
    <ul class="collapse list-unstyled" id="subMenuBulkPrint">
        @if(userPermission(921)  && menuStatus(921))
            <li data-position="{{menuPosition(921)}}">
                <a href="{{route('student-id-card-bulk-print')}}">@lang('lang.id_card')</a>
            </li>
       @endif
        @if(userPermission(922)  && menuStatus(922))
            <li data-position="{{menuPosition(922)}}">
                <a href="{{route('certificate-bulk-print')}}">  @lang('lang.student')  @lang('lang.certificate')</a>
            </li>
          @endif
 

     @if(userPermission(924)  && menuStatus(924))
        <li data-position="{{menuPosition(924)}}">
            <a href="{{route('payroll-bulk-print')}}"> @lang('lang.payroll') @lang('lang.bulk_print')</a>
        </li>
    @endif

      @if(userPermission(926)  && menuStatus(926))
        <li data-position="{{menuPosition(926)}}">
            <a href="{{route('fees-bulk-print')}}"> @lang('lang.fees') @lang('lang.invoice') @lang('lang.bulk')   @lang('lang.print')</a>
        </li>
    @endif
    
     @if(userPermission(925)  && menuStatus(925))
        <li data-position="{{menuPosition(925)}}">
            <a href="{{route('invoice-settings')}}"> @lang('lang.fees') @lang('lang.invoice') @lang('lang.settings')</a>
        </li>
      @endif
       
    </ul>
</li>
@endif
