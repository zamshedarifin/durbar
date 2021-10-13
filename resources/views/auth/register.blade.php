@extends('frontEnd.layouts.app')
@section('title','রেজিস্ট্রেশন')
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

        .horizontal-line {
            width: 100%;
            text-align: center;
            border-bottom: 1px solid #eee;
            line-height: 0.1em;
            margin-top: 20px;
        }

        .horizontal-line span {
            background: #fff;
            padding: 0 10px;
        }

        #pswd_info {
            position: absolute;
            bottom: 12px;
            /*bottom: -115px\9;*/
            /* right: 111px; */
            width: 45%;
            left: 16px;
            padding: 15px;
            background: #fefefe;
            font-size: .875em;
            border-radius: 5px;
            box-shadow: 0 1px 3px #ccc;
            border: 1px solid #ddd;
            z-index: 1;
        }
        #pswd_info {
            display:none;
        }
        #pswd_info h4 {
            margin:0 0 10px 0;
            padding:0;
            font-weight:normal;
        }
        #pswd_info::before {
            content: "\25B2";
            position:absolute;
            top:-12px;
            left:45%;
            font-size:14px;
            line-height:14px;
            color:#ddd;
            text-shadow:none;
            display:block;
        }
        .invalid {
            background:url({{asset("assets/img/invalid.png")}}) no-repeat  0 50%;
            padding-left:22px;
            height: 16px;
            background-size: contain;
            line-height:14px;
            color:#ec3f41;
            margin-top:2px;
        }
        .valid {
            background:url({{asset("assets/img/valid.png")}}) no-repeat 0 50%;
            padding-left:22px;
            height: 16px;
            background-size: contain;
            line-height:14px;
            color:#3a7d34;
            margin-top:2px;
        }
        .or {
            width: 100%;
            text-align: center;
            border-bottom: 1px solid #000;
            line-height: 0.1em;
            margin: 20px 0 20px;
        }

        .or span {
            background:#fff;
            padding:0 10px;
        }

        @media(max-width: 768px){
            #pswd_info {
                bottom: 36px;
                width: 90%;
                z-index: 999;
            }
            .g-cap{
                margin-left: unset !important;
            }
        }
            .g-cap{
                margin-left: -96px
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
                        <h2 class="breadcrumb__title">রেজিস্ট্রেশন</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>রেজিস্ট্রেশন</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="register section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    {{--@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif--}}
                    <div class="card shadow-sm">
{{--                        <div class="card-header text-dark">রেজিস্ট্রেশন করুন</div>--}}
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <h5 class="text-center text-uppercase col-12 mb-3">রেজিস্ট্রেশন করুন</h5>
                                <div class="col text-right">
                                    <a href="{{ route('social.oauth', 'facebook') }}"
                                       class="btn btn-primary btn-sm"><i class="icofont icofont-facebook"></i>
                                        Facebook</a>
                                </div>
                                <div class="col text-left">
                                    <a href="{{ route('social.oauth', 'google') }}"
                                       class="btn btn-default btn-sm google-btn"><img
                                            src="{{asset("frontEnd/images/icons/icon-google.png")}}"
                                            alt="GOOGLE">Google</a>
                                </div>
                                <h5 class="horizontal-line"><span>অথবা</span></h5>
                            </div>
                            <form method="POST" class="mt-2"  action="{{ route('register') }}">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="col-form-label text-md-right">{{ __('নাম') }}<span class="text-danger">*</span></label>

                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" placeholder="আপনার পুরো নাম" autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email"
                                               class="col-form-label text-md-right">{{ __('ই-মেইল') }}<span class="text-danger">*</span></label>

                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" placeholder="আপনার ই-মেইল" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">

                                        <label for="password"
                                               class="col-form-label text-md-right">{{ __('পাসওয়ার্ড') }}<span class="text-danger">*</span></label>

                                        <input id="password" type="password" placeholder="নতুন পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)"
                                               class="form-control @error('password') is-invalid @enderror" name="password"
                                               autocomplete="off">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                    <div id="pswd_info">

                                        <ul class="list-unstyled">
                                            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                            <li id="number" class="invalid">At least <strong>one number</strong></li>
                                            <li id="special" class="invalid">At least <strong>one special character</strong></li>
                                            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                                        </ul>
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="password-confirm"
                                               class="col-form-label text-md-right">{{ __('কনফার্ম পাসওয়ার্ড') }}<span class="text-danger">*</span></label>
                                        <input id="password-confirm" placeholder="পাসওয়ার্ড নিশ্চিত করুন" type="password" class="form-control"
                                               name="password_confirmation" autocomplete="new-password">
                                    </div>

                                    <div class="col-md-12">
                                        <div  class="mb-3 g-cap {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            {{--                                    <label class="col-md-4 control-label">Captcha</label>--}}
                                            <div class="col-md-4 offset-md-4">
                                                {!! app('captcha')->display() !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                       আপনার অ্যাকাউন্ট থাকলে <a id="login" href="{{route('login')}}"> লগইন করুন
                                        </a>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn theme-btn  btn-sm float-right">
                                            রেজিস্ট্রেশন <i class="fa fa-long-arrow-right"></i>
                                        </button>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </section>

@endsection

@section('js')
    {!! NoCaptcha::renderJs() !!}
    <script>
        $('input[type=password]').keyup(function() {
            var pswd = $(this).val();
            //validate letter
            if ( pswd.match(/[A-z]/) ) {
                $('#letter').removeClass('invalid').addClass('valid');
            } else {
                $('#letter').removeClass('valid').addClass('invalid');
            }
            if ( pswd.match(/\W+/) ) {
                $('#special').removeClass('invalid').addClass('valid');
            } else {
                $('#special').removeClass('valid').addClass('invalid');
            }

            //validate capital letter
            if ( pswd.match(/[A-Z]/) ) {
                $('#capital').removeClass('invalid').addClass('valid');
            } else {
                $('#capital').removeClass('valid').addClass('invalid');
            }

            //validate number
            if ( pswd.match(/\d/) ) {
                $('#number').removeClass('invalid').addClass('valid');
            } else {
                $('#number').removeClass('valid').addClass('invalid');
            }
            if ( pswd.length < 8 ) {
                $('#length').removeClass('valid').addClass('invalid');
            } else {
                $('#length').removeClass('invalid').addClass('valid');
            }
        }).focus(function() {
            $('#pswd_info').show();
        }).blur(function() {
            $('#pswd_info').hide();
        });

    </script>
@stop

