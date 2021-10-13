<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if(Auth()->user()->avatar)
                    <img src="{{asset(Auth()->user()->avatar)}}" alt="" class="avatar-md rounded-circle">
                @else
                    <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle">
                @endif
                <span class="pro-user-name ml-1">
                                    {{Auth()->user()->name}}  <i class="mdi mdi-chevron-down"></i>
                            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <a href="{{route('user.profile')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-outline"></i>
                    <span>Profile</span>
                </a>

                <div class="dropdown-divider"></div>
                <!-- item-->
                <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout-variant"></i>  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('front.index')}}" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{{asset("frontEnd/images/logo.png")}}" alt="" height="50">
                            <!-- <span class="logo-lg-text-dark">Simple</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">S</span> -->
                            <img src="{{asset("frontEnd/images/logo.png")}}" alt="" height="22">
                        </span>
        </a>

        <a href="{{route('front.index')}}" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{{asset("frontEnd/images/logo.png")}}" alt="" height="40">
                            <!-- <span class="logo-lg-text-light">Simple</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                            <img src="{{asset("frontEnd/images/logo.png")}}" alt="" height="22">
                        </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>
</div>
