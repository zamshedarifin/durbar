@extends('frontEnd.layouts.app')
@section('title','Reset Password')
@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">পাসওয়ার্ড রিসেট করুন</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('login')}}">লগিন</a></li>
                            <li>পাসওয়ার্ড রিসেট করুন</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 shadow-sm">
                        <div class="card-header">{{ __('পাসওয়ার্ড রিসেট করুন') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="bx bx-envelope"></i></span>
                                            <input id="email" type="email" placeholder="ই-মেইল" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="theme-btn btn-sm" style="text-transform: unset">
                                            {{ __('সাবমিট করুন') }} <i class="icofont icofont-long-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>


                            </form>
                            <hr>
                            <p class="card-text text-danger"> আপনার মেইলটি স্প্যামে যেতে পারে । অনুগ্রহপূর্বক স্প্যাম চেক করুন এবং ভবিষ্যতে ইনবক্সে মেইল পেতে নট স্প্যাম করুন।</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
