@php
    $quiz=App\Quiz::latest()->where('status', '1')->first();
@endphp

<div class="left-side-menu">
    <div class="user-box">
        <div class="float-left">
            @if(Auth()->user()->avatar)
                <img src="{{asset(Auth()->user()->avatar)}}" alt="" class="avatar-md rounded-circle">
            @else
                <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle">
            @endif
        </div>
        <div class="user-info">
            <a href="#">{{Auth()->user()->name}}</a>
            <p class="text-muted m-0">Member</p>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">
            <li class="menu-title">Navigation</li>

            <li>
                <a href="{{route('dashboard')}}">
                    <i class="ti-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li>
                @if(empty(Auth::user()->father_name) or empty(Auth::user()->mother_name) or empty(Auth::user()->mobile) or empty(Auth::user()->address) or empty(Auth::user()->facebook) or empty(Auth::user()->avatar))
                   <a href="{{route('user.profile')}}">
                        <i class="fa fa-question"></i>
                        <span> Quiz </span>
                    </a>
                @else

                @if($quiz)
                <a href="{{route('user.quiz')}}">
                 @else  <a href="#"> @endif
                        <i class="fa fa-question"></i>
                        <span> Quiz </span>
                    </a>
                @endif
            </li>

            <li>


                <a href="{{route('result')}}">
                    <!--<a href="#">-->
                    <i class="ti-home"></i>
                    <span> Result </span>
                </a>
            </li>

            {{-- <li>
                 <a href="javascript: void(0);">
                     <i class="ti-light-bulb"></i>
                     <span> Quiz </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <ul class="nav-second-level" aria-expanded="false">
                     <li><a href="{{route('admin.create.campaign')}}">Create Campaign</a></li>
                     <li><a href="{{route('admin.campaign')}}">Manage Campaign</a></li>
 --}}{{--                    <li><a href="{{route('admin.campaign.enroll')}}">Campaign Enroll</a></li>--}}{{--
                 </ul>
             </li>--}}

        </ul>
    </div>
<div class="clearfix"></div>
</div>
