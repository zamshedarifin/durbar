@extends('frontEnd.layouts.app')

@section('title','পাসওয়ার্ড রিসেট করুন')
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
                <div class="col-md-7">
                    <div class="card shadow-sm">
                        <div class="card-header">{{ __('পাসওয়ার্ড রিসেট করুন') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3 row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('ই-মেইল') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('পাসওয়ার্ড') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror" name="password"
                                               required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-right">{{ __('পাসওয়ার্ড নিশ্চিত') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="theme-btn btn-sm">
                                            {{ __('পাসওয়ার্ড পরিবর্তন') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
