@php $name = Route::currentRouteName(); @endphp
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <a href="{{route('front.index')}}" class="logo">
            <img src="{{asset("assets/img/logo.png")}}" alt="" class="img-fluid"></a>

        <nav class="nav-menu d-none d-lg-block m-auto">
            <ul>
                <li class="{{$name=='front.about'?'active':""}}"><a href="{{route('front.about')}}">আমাদের সম্পর্কে</a></li>
                <li class="{{$name=='front.campaign'?'active':""}}"><a href="{{route('front.campaign')}}">ক্যাম্পেইন</a></li>
                <li class="{{$name=='front.training'?'active':""}}"><a href="{{route('front.training')}}">প্রশিক্ষণ</a></li>
                <li class="{{$name=='front.ambassador'?'active':""}}"><a href="{{route('front.ambassador')}}">এম্বাসেডর</a></li>
                <li class="{{$name=='photo.gallery'?'active':""}}"><a href="{{route('photo.gallery')}}">ফটো গ্যালারি</a></li>
                <li class="{{$name=='front.contact'?'active':""}}"><a href="{{route('front.contact')}}">যোগাযোগ</a></li>
{{--                <li><a href="javascript:void(0)">ব্লগ</a></li>--}}
                @if(Auth::check())
                    <li>
                        <a href="{{ route('dashboard') }}">
                            @if(asset(Auth::user()->avatar) != null)
                            <img src="{{asset(Auth::user()->avatar)}}" style="height: 18px;width: 18px;object-fit: contain" alt="user-image" class="rounded-circle">
                            @elseif(Auth::user()->avatar)
                                <img src="{{Auth::user()->avatar}}" style="height: 18px;width: 18px;object-fit: contain" alt="user-image" class="rounded-circle">
                            @else
                                <img src="{{asset('public/admin/images/users/pp.png')}}" style="height: 18px;width: 18px;object-fit: contain" alt="user-image" class="rounded-circle">
                            @endif
                            {{Auth()->user()->name}}</a>
                    </li>
                @else
                    <li class="{{$name=='login'?'active':""}}"><a href="{{route('login')}}">লগইন</a></li>
                @endif

            </ul>
        </nav><!-- .nav-menu -->

        <a href="{{route('front.index')}}" class="logo"><img src="{{asset("assets/img/mujib100.png")}}" alt=""
                                                             class="img-fluid"></a>
    </div>
</header><!-- End Header -->
