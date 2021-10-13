@extends('frontEnd.layouts.app')
@section('title','প্রোফাইল আপডেট')
@section('content')

    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">প্রোফাইল আপডেট</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>প্রোফাইল আপডেট</li>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card shadow-sm">
                       <div class="card-body">
                            <div class="row justify-content-center">
                                <h5 class="text-center text-uppercase col-12 mb-3">প্রোফাইল আপডেট করুন</h5>

                                    @if($message = Session::get('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>ধন্যবাদ !</strong> {{$message}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                        <strong>Warning!</strong> বর্তমানে আপনার প্রোফাইলটি  অসম্পূর্ণ আছে,ক্যাম্পেইনে অংশগ্রহণ করতে হলে আপনার এই তথ্যগুলো দিয়ে সহায়তা করতে হবে। ধন্যবাদ।
                                        </div>
                                    @endif

                            </div>
                            <form method="POST" class="mt-2"  action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                                @csrf
{{--                                <input type="hidden" name="link" value="{{lock(Session('link'))}}">--}}
                                <div class="row justify-content-center">

                                    @if(Auth::user()->mobile == null)
                                    <div class="mb-3 col-md-12">
                                        <label for="mobile" class="col-form-label text-md-right">{{ __('মোবাইল') }}<span class="text-danger">*</span></label>
                                        <input id="mobile" type="text"
                                               class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                               value="{{ old('mobile') }}" placeholder="আপনার মোবাইল নম্বর দিন" autocomplete="mobile" autofocus>

                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endif

                                    @if(Auth::user()->avatar == null)
                                    <div class="mb-3 col-md-12">
                                        <label for="avatar" class="col-form-label text-md-right">{{ __('আপনার ছবি সিলেক্ট করুন ') }}<span class="text-danger">*</span></label>
                                        <input id="avatar" type="file"
                                               class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                                               value="{{ old('avatar') }}" autofocus>
                                                      <p class="text-danger" style="font-size: 12px">Supported file: (png,jpg,jpeg max 1024)</p>

                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endif

                                    @if(Auth::user()->address == null)
                                    <div class="mb-3 col-md-12">
                                        <label for="address" class="col-form-label text-md-right">{{ __('আপনার ঠিকানা ') }}<span class="text-danger">*</span></label>
                                        <textarea cols="40" rows="6" id="address" class="form-control " name="address" placeholder="আপনার ঠিকানা লিখুন">{{old('address')}}</textarea>

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                        @endif

                                    <div class="col-md-4">
                                        <button type="submit" class="btn theme-btn  btn-sm float-right">
                                            সেইভ <i class="fa fa-long-arrow-right"></i>
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


@stop

