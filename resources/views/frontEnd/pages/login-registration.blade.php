@extends('frontEnd.layouts.app')
@section('title','লগিন/রেজিস্ট্রেশন')
@section('css')
    <style>
        .google-btn {
            box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
            -webkit-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
            -o-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
            -ms-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
        }

        .google-btn img {
            width: 15px;
            margin-right: 10px;
            padding-bottom: 3px;
        }
    </style>
@stop
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">লগিন/রেজিস্ট্রেশন</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>লগিন/রেজিস্ট্রেশন</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START LOGIN REGISTRATION AREA
    ======================================-->
    <section class="login-registration section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">

                            {{-- <nav>
                                 <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                     <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">Home</a>
                                     <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab" aria-controls="nav-reg" aria-selected="false">Profile</a>
                                 </div>
                             </nav>--}}

                            <div id="nav-login">
                                <div class="row justify-content-center">
                                    <h5 class="text-center text-uppercase col-12 mb-3">Sign In With</h5>
                                    <div class="col text-right">
                                        <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-sm"><i class="fa fa-facebook"></i>
                                            Facebook</a>
                                    </div>
                                    <div class="col text-left">
                                        <a href="{{ route('social.oauth', 'google') }}" class="btn btn-default btn-sm google-btn"><img
                                                src="{{asset("frontEnd/images/icons/icon-google.png")}}"
                                                alt="GOOGLE">Google</a>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <form method="POST" action="{{ route('login') }}">@csrf
                                            <div class="form-group">
                                                <label for="email">{{ __('E-Mail') }}</label>
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                            {{--@if (Route::has('password.request'))
                                                <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif--}}

                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="theme-btn btn-sm btn-block">
                                                    {{ __('Login') }} <i class="fa fa-long-arrow-right"></i>
                                                </button>
                                            </div>
                                            <p class="text-center mt-4">Not a member? <a id="signUp"
                                                                                         href="{{route('register')}}"
                                                                                         style="border-bottom: 1px solid black;color:black">Sign
                                                    up now</a></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </section>
    <!--======================================
            END LOGIN REGISTRATION AREA
    ======================================-->
@stop
@section('js')
    <script>
        /*$('#signUp').click(function () {
            $('#nav-reg').fadeIn();
            $('#nav-login').hide();
        })
        $('#login').click(function () {
            $('#nav-reg').hide();
            $('#nav-login').fadeIn();
        })

        @if($errors->first('email') || $errors->first('password'))
        $('#nav-reg').hide();
        $('#nav-login').show();
        @elseif($errors->first('email_address') || $errors->first('reg_password') || $errors->first('name'))
        $('#nav-reg').show();
        $('#nav-login').hide();*/
        @endif

    </script>
@stop
