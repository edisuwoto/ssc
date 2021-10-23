    <li data-position="{{menuPosition(22)}}" class="sortable_li">
        <a href="#subMenuBebanKerjaDosen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-reading"></span>
             Beban Kerja Dosen
        </a>
        <ul class="collapse list-unstyled" id="subMenuBebanKerjaDosen">
            @if(userPermission(543) && menuStatus(543))
                <li data-position="{{menuPosition(543)}}">
                    <a href="{{url('bebankerjadosen/list')}}"> BKD</a>
                </li>
            @endif
            @if(moduleStatusCheck('Saas') == FALSE)
                @if(userPermission(547) && menuStatus(547))
                    <li data-position="{{menuPosition(547)}}">
                        <a href="{{url('bebankerjadosen/settings')}}"> BKD non SAS</a>
                    </li>
                @endif
            @endif
        </ul>
    </li>
