@php
    if(session('userInfo')){
    $username = session('userInfo')['username'];
    $avatar = asset('admin/img/user') . '/' . session('userInfo')['avatar'];
}
@endphp
<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href='{{ route("auth/logout")}}'><i class="fa fa-sign-out"></i> Log Out</a></li>
            <li><a href='{{ route("home")}}'><i class="fa fa-home"></i> HomePage</a></li>
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ $avatar }}" alt="">{!! $username !!}
                    <span class=" fa fa-angle-down"></span>
                </a>
                
                {{-- <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href='{{ route("auth/logout")}}'><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul> --}}
            </li>
            
        </ul>
    </nav>
</div>