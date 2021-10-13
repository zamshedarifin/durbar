@extends('frontEnd.layouts.app')
@section('title','এম্বাসেডর')
@section('css')
    <style>
        #ambassadorForm-h-0 {
            display: none;
        }

        #ambassadorForm-h-1 {
            display: none;
        }
    </style>
@stop
@section('banner')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">এম্বাসেডর</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>এম্বাসেডর</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@stop
@section('content')

    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    <section class="ambassador section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-b">
                    <div class="loading" style="display: none">Loading&#8230;</div>
                    <div class="card shadow-sm border-0">
                        <img id="am-form" src="{{asset("frontEnd/images/banner/ambassador.jpg")}}" class="card-img-top"
                             alt="...">
                        <div class="card-body" style="padding: 0">
                            <p class="card-text pl-3 pr-3 pt-3">দুর্বার প্লাটফর্মের সাথে যুক্ত হয়ে বিভিন্ন কর্মসূচিতে
                                অংশগ্রহণ করতে চাইলে আপনাকে এম্বাসেডর হতে হবে। এম্বাসেডর হতে চাইলে আপনাকে অবশ্যই নিচের
                                দুটি ফর্ম (ক ও খ) পূরণ করতে হবে। </p>
                            <div class="alert alert-danger" style="display:none">
                                <ul id="errors"></ul>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" style="display: none"
                                 role="alert">
                                <strong><i class="fa fa-check-circle"></i> অভিনন্দন!</strong> আপনার আবেদনটি সফলভাবে জমা
                                হয়েছে।
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="component-section no-code">
                                <form id="ambassadorForm">
                                    <h3>ফর্ম-ক</h3>
                                    <section style="padding:0">
                                        <div class="row row-sm" id="first-step">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">নাম<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" autocomplete="off" data-parsley-required-message="নাম আবশ্যক।" required
                                                       value="{{old('name')}}"
                                                       placeholder="আপনার পুরো নাম লিখুন (ইংরেজীতে)"
                                                       id="name"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name">

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="gender" class="form-label">লিঙ্গ<span
                                                        class="text-danger">*</span></label>
                                                <select name="gender" autocomplete="off" data-parsley-required-message="লিঙ্গ আবশ্যক।"
                                                        required id="gender"
                                                        class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    <option value="male" {{old('gender')=='male'?'selected':''}}>পুরুষ
                                                    </option>
                                                    <option value="female" {{old('gender')=='female'?'selected':''}}>
                                                        নারী
                                                    </option>
                                                    <option value="other" {{old('gender')=='other'?'selected':''}}>
                                                        অনান্য
                                                    </option>
                                                </select>
                                                @error('gender')
                                                <div class="invalid-feedback"><i
                                                        class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="age" class="form-label">বয়স<span
                                                        class="text-danger">*</span></label>
                                                <select name="age" autocomplete="off" data-parsley-required-message="বয়স আবশ্যক।" required
                                                        id="age"
                                                        class="form-control">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    <option value="18 to 24 Years">১৮
                                                        থেকে ২৪ বছর
                                                    </option>
                                                    <option value="25 to 34 Years">২৫
                                                        থেকে ৩৪ বছর
                                                    </option>
                                                    <option value="35 to 44 Years">৩৫
                                                        থেকে ৪৪ বছর
                                                    </option>
                                                    <option value="45 to Above">৪৫ বছর ঊর্দ্ধ
                                                    </option>
                                                </select>

                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="district"class="form-label">জেলা<span
                                                        class="text-danger">*</span></label>
                                                <select  autocomplete="off" name="district" data-parsley-required-message="জেলা আবশ্যক।"
                                                        required id="district" class="form-control">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    @if($districts)
                                                        @foreach($districts as $district)
                                                            <option
                                                                value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="upazila" class="form-label">উপজেলা<span
                                                        class="text-danger">*</span></label>
                                                <select autocomplete="off"  name="upazila" data-parsley-required-message="উপজেলা আবশ্যক।"
                                                        required id="upazila" class="form-control">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                </select>

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="union" class="form-label">ইউনিয়ন/ওয়ার্ড</label>
                                                <select autocomplete="off"  name="union" id="union" class="form-control">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                <label for="address" class="form-label">বর্তমান ঠিকানা<span
                                                        class="text-danger">*</span></label>
                                                <textarea autocomplete="off"  name="address" placeholder="পুরো ঠিকানা লিখুন (ইংরেজীতে)" data-parsley-required-message="বর্তমান ঠিকানা আবশ্যক।" required id="address" class="form-control"></textarea>
                                                {{--<div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="icofont icofont-location-pin"></i></span>
                                                    <input type="text"
                                                           data-parsley-required-message="বর্তমান ঠিকানা আবশ্যক।"
                                                           data-parsley-errors-container=".error-message-1" required
                                                           value="{{old('address')}}"
                                                           placeholder="পুরো ঠিকানা লিখুন (ইংরেজীতে)"
                                                           name="address" id="address" class="form-control">
                                                    <div class="invalid-feedback"></div>
                                                    <div class="error-message-1 col-md-12"></div>
                                                </div>--}}
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">ই-মেইল ঠিকানা <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                    <input autocomplete="off"  type="email"
                                                           data-parsley-required-message="ই-মেইল ঠিকানা আবশ্যক।"
                                                           data-parsley-errors-container=".error-message-2" required
                                                           value="{{old('email')}}" placeholder="example@mail.com"
                                                           name="email" id="email"
                                                           class="form-control @error('email') is-invalid @enderror">
                                                    <div class="invalid-feedback"></div>
                                                    <div class="error-message-2 col-md-12"></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="cell_phone" class="form-label">মোবাইল ফোন<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">+88</span>
                                                    </div>
                                                    <input autocomplete="off"  type="tel" data-parsley-required-message="মোবাইল ফোন আবশ্যক।"
                                                           data-parsley-errors-container=".error-message-3" required
                                                           value="{{old('cell_phone')}}" name="cell_phone"
                                                           placeholder="01X XXX XXX XX" id="cell_phone"
                                                           class="form-control @error('cell_phone') is-invalid @enderror">
                                                    <div class="error-message-3 col-md-12"></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="fb_profile_link" class="form-label">ফেসবুক প্রোফাইল লিঙ্ক
                                                    <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="icofont icofont-facebook"></i></span>
                                                    <input autocomplete="off"  type="text"
                                                           data-parsley-required-message="ফেসবুক প্রোফাইল লিঙ্ক আবশ্যক।"
                                                           data-parsley-errors-container=".error-message-4"
                                                           value="{{old('fb_profile_link')}}"
                                                           placeholder="https://www.facebook.com/durbar21" required
                                                           name="fb_profile_link"
                                                           id="fb_profile_link"
                                                           class="form-control @error('fb_profile_link') is-invalid @enderror">
                                                    <div class="error-message-4 col-md-12"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="profession" class="form-label">পেশা<span
                                                        class="text-danger">*</span></label>
                                                <select autocomplete="off"  name="profession" data-parsley-required-message="পেশা আবশ্যক।"
                                                        required id="profession"
                                                        class="form-control @error('profession') is-invalid @enderror">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    <option
                                                        value="Student" {{old('profession')=='Student'?'selected':''}}>
                                                        শিক্ষার্থী
                                                    </option>
                                                    <option
                                                        value="Service Holder" {{old('profession')=='Service Holder'?'selected':''}}>
                                                        চাকুরিজীবী
                                                    </option>
                                                    <option
                                                        value="Self Employed" {{old('profession')=='Self Employed'?'selected':''}}>
                                                        ব্যবসায়ী/উদ্যোক্তা
                                                    </option>
                                                    <option
                                                        value="Un-Employed" {{old('profession')=='Un-Employed'?'selected':''}}>
                                                        বেকার
                                                    </option>
                                                </select>
                                                @error('profession')
                                                <div class="invalid-feedback"><i
                                                        class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="is_work" id="work" class="">&#9635; <strong>আপনি কি দুর্বার
                                                        প্লাটফর্মের এম্বাসেডর হিসেবে কাজ করতে চান?</strong><span
                                                        class="text-danger">*</span> </label>
                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-5"
                                                           class="form-check-input is_work"
                                                           {{old('is_work')=='1'?'checked':''}} type="radio"
                                                           name="is_work"
                                                           id="is_work" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">হ্যাঁ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-5"
                                                           class="form-check-input is_work" type="radio" name="is_work"
                                                           id="is_work" value="0">
                                                    <label class="form-check-label" for="inlineRadio2">না</label>
                                                </div>
                                                <div class="error-message-5" style="margin-top: -8px"></div>
                                            </div>
                                            <div class="col-md-12" style="margin-bottom: 70px;">
                                                <label for="send_mail" id="mail" class="form-label">&#9635;
                                                    <strong>আমরা কি আপনাকে ই-মেইল এবং এসএমএসের মাধ্যমে কোন সংবাদ বা
                                                        কন্টেন্ট পাঠাতে পারি?</strong><span class="text-danger">*</span>
                                                </label>
                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-6"
                                                           class="form-check-input" type="radio" name="send_mail"
                                                           id="send_mail"
                                                           value="1">
                                                    <label class="form-check-label" for="inlineRadio1">হ্যাঁ</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-6"
                                                           class="form-check-input" type="radio" name="send_mail"
                                                           id="send_mail"
                                                           value="0">
                                                    <label class="form-check-label" for="inlineRadio2">না</label>
                                                </div>
                                            </div>
                                        </div><!-- row -->
                                    </section>
                                    <h3>ফর্ম-খ</h3>
                                    <section style="padding:0" class="row">
                                        <p class="mb-2 text-success"><strong>আপনাকে আমরা আরও ভালভাবে জানতে আপনার
                                                ব্যক্তিত্ব যাচাই করতে চাই। তাই নিচের প্রশ্নের উত্তর দিয়ে আমাদের সহায়তা
                                                করুন। এখানে সঠিক বা ভুল উত্তর বলে কিছু নাই। আপনার কাছে যে উত্তরটি সঠিক
                                                বলে মনে হবে, আপনি সেটি নির্বাচন করবেন। এম্বাসেডর হিসেবে কাজ করার সুযোগ
                                                পেতে হলে আপনাকে অবশ্যই এই অংশে অংশগ্রহণ করতে হবে। চলুন শুরু করা
                                                যাকঃ </strong></p>
                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold"
                                                   class="qs_10">&#9635;
                                                আপনি কেন দুর্বার এম্বাসেডর হিসেবে কাজ করতে চান? এম্বাসেডর হলে </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_10"
                                                               value="সমাজে আমার মর্যাদা বাড়াবে">
                                                        <span>সমাজে আমার মর্যাদা বাড়াবে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_10"
                                                               value="দেশের জন্য কাজ করার সুযোগ পাবো">
                                                        <span>দেশের জন্য কাজ করার সুযোগ পাবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_10"
                                                               value="নিজেকে সমৃদ্ধ করার সুযোগ পাবো">
                                                        <span>নিজেকে সমৃদ্ধ করার সুযোগ পাবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_10"
                                                               value="ব্যক্তিগত সুযোগ সুবিধা পাবো">
                                                        <span>ব্যক্তিগত সুযোগ সুবিধা পাবো</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold"
                                                   class="qs_2">&#9635;
                                                সর্বশেষ কবে একটা ভাল কাজ করেছেন? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_2"
                                                               value="মনে করতে পারছিনা">
                                                        <span>মনে করতে পারছিনা </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_2"
                                                               value="গত এক সপ্তাহে">
                                                        <span>গত এক সপ্তাহে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_2"
                                                               value="গত এক মাসে">
                                                        <span>গত এক মাসে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_2"
                                                               value="গত এক বছরে">
                                                        <span>গত এক বছরে</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_1">&#9635;
                                                আপনি রাস্তা দিয়ে হেঁটে যাচ্ছেন। একসময় দেখলেন, ৫ বছর বয়সী একটা বাচ্চা
                                                ফুটপাতের
                                                উপর বসে খুব কাঁদছে। তার আশেপাশে কেউ নেই। এরেকটু কাছে গিয়ে দেখলেন
                                                বাচ্চাটির পা
                                                থেকে রক্ত ঝরছে। সে জায়গায় হাত দিয়ে বাচ্চাটি মা মা বলে চিৎকার করছে। এমন
                                                পরিস্থিতিতে আপনি কী করবেন? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_1"
                                                               value="ছবি তুলে ফেসবুকে শেয়ার করবো">
                                                        <span>ছবি তুলে ফেসবুকে শেয়ার করবো </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_1"
                                                               value="৯৯৯-এ ফোন করে সাহায্য চাইবো">
                                                        <span>৯৯৯-এ ফোন করে সাহায্য চাইবো </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_1"
                                                               value="বাচ্চাটিকে দ্রুত ডাক্তারের কাছে নিবো">
                                                        <span>বাচ্চাটিকে দ্রুত ডাক্তারের কাছে নিবো </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio"
                                                               name="question_1"
                                                               value="ঝামেলায় না জড়িয়ে দ্রুত সেখান থেকে চলে যাবো">
                                                        <span>ঝামেলায় না জড়িয়ে দ্রুত সেখান থেকে চলে যাবো</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_11">&#9635;
                                                ফেসবুকে আপনার কয়টি একাউন্ট আছে? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_11"
                                                               value="দুইটি">
                                                        <span>দুইটি</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_11"
                                                               value="একটি">
                                                        <span>একটি</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_11"
                                                               value="একটিও না">
                                                        <span>একটিও না</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_11"
                                                               value="দুইটির বেশি">
                                                        <span>দুইটির বেশি</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_3">&#9635;
                                                আপনার ফেসবুক নিউজফিডে অথবা অপরিচিত একটি নিউজ পোর্টালে একটি সংবাদ দেখলেন।
                                                সংবাদটির শিরোনাম খুব চটকদার। পুরো সংবাদটি আপনি পড়লেন, খুব মজা পেলেন
                                                কিন্তু
                                                সংবাদটি আপনার কাছে বিশ্বাসযোগ্য মনে হচ্ছেনা। কোথায় যেন একটু খটকা লাগছে।
                                                এমন
                                                পরিস্থিতিতে আপনি কী করবেন? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_3"
                                                               value="সাথে সাথে শেয়ার করবো">
                                                        <span>সাথে সাথে শেয়ার করবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_3"
                                                               value="বন্ধু-বান্ধবের সাথে পরামর্শ করবো">
                                                        <span>বন্ধু-বান্ধবের সাথে পরামর্শ করবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_3"
                                                               value="অনলাইনে যাচাই করবো">
                                                        <span>অনলাইনে যাচাই করবো </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_3"
                                                               value="গোপনে অন্যদের সাথে শেয়ার করবো">
                                                        <span>গোপনে অন্যদের সাথে শেয়ার করবো</span>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_12">&#9635;
                                                আপনাকে একটি কাজ দেয়া হলো। কাজটি আপনাকে এক মাসের মধ্যে শেষ করতে হবে। আপনি
                                                দেখলেন, এটা আপনার পক্ষে মাত্র সাত দিনে শেষ করা সম্ভব। এসময় আপনার হাতে
                                                তেমন কোনো গুরুত্বপূর্ণ কাজ নেই। কাজটি আপনি কবে থেকে শুরু করবেন? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_12"
                                                               value="এক সপ্তাহ পরে">
                                                        <span>এক সপ্তাহ পরে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_12"
                                                               value="প্রথম দিন থেকে">
                                                        <span>প্রথম দিন থেকে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_12"
                                                               value="দুই সপ্তাহ পরে">
                                                        <span>দুই সপ্তাহ পরে</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="question_12"
                                                               value="শেষ সপ্তাহে">
                                                        <span>শেষ সপ্তাহে</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_6">&#9635;
                                                আপনি একজন টিম লিডার। টিমে ৮ জন সদস্য আছেন। একটা মিটিং-এ বস টিমের সবার
                                                সামনে আপনার অনেক প্রশংসা করলেন। একটা কাজ সফলভাবে সম্পন্ন করার জন্য
                                                আপনাকে কৃতিত্ব দেয়া হলো। মজার বিষয় হচ্ছে, এই কাজটি আসলে টিমের অন্য একজন
                                                সদস্য করেছেন। যাবতীয় কৃতিত্ব তার পাবার কথা। এমন পরিস্থিতিতে আপনি কী
                                                করবেন? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_6"
                                                               value="চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো">
                                                        <span>চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_6"
                                                               value="সবার সামনে আসল বিষয়টি খুলে বলবো">
                                                        <span>সবার সামনে আসল বিষয়টি খুলে বলবো</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_6"
                                                               value="কাউকে কিছুই বলবো না">
                                                        <span>কাউকে কিছুই বলবো না</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_6"
                                                               value="নিজের সাফল্য উদযাপন করবো">
                                                        <span>নিজের সাফল্য উদযাপন করবো</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_13">&#9635;
                                                কোনটি আপনার কাছে সবচেয়ে গৌরবের? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_13"
                                                               value="পদ্মা সেতু">
                                                        <span>পদ্মা সেতু</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio"
                                                               class="ques"
                                                               name="question_13"
                                                               value="স্বাধীনতা যুদ্ধ">
                                                        <span>স্বাধীনতা যুদ্ধ</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_13"
                                                               value="কক্সবাজার সমুদ্র সৈকত">
                                                        <span>কক্সবাজার সমুদ্র সৈকত</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_13"
                                                               value="সুন্দরবন">
                                                        <span>সুন্দরবন</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_7">&#9635;
                                                নিচের কোনটি আপনার কাছে বেশি গুরুত্বপূর্ণ? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_7"
                                                               value="অনেক ক্ষমতা">
                                                        <span>অনেক ক্ষমতা</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_7"
                                                               value="অনেক ভালবাসা">
                                                        <span>অনেক ভালবাসা</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold"
                                                   class="qs_8">&#9635;
                                                কোন গুণগুলি আপনার জন্য সবচেয়ে বেশি প্রযোজ্য? </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_8"
                                                               value="পরিশ্রমী ও উদ্যমী">
                                                        <span>পরিশ্রমী ও উদ্যমী</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_8"
                                                               value="মেধাবী ও সৃজনশীল">
                                                        <span>মেধাবী ও সৃজনশীল</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_8"
                                                               value="সৎ ও আদর্শবান">
                                                        <span>সৎ ও আদর্শবান</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_8"
                                                               value="বিশ্বাসী ও নির্ভরযোগ্য">
                                                        <span>বিশ্বাসী ও নির্ভরযোগ্য</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold" class="qs_14">&#9635;
                                                একজন সচেতন, দায়িত্বশীল এবং মুক্তিযুদ্ধের চেতনায় বিশ্বাসী দেশপ্রেমিক
                                                নাগরিক হিসেবে আমি দেশের বৃহত্তর কল্যাণে কাজ করে যাবো। জাতি, ধর্ম, বর্ণ,
                                                বয়স, লিঙ্গ নির্বিশেষে সবার প্রতি সমান শ্রদ্ধাশীল থেকে মানুষের সেবায় কাজ
                                                করে যাবো। যেকোনো উপায়ে আমি নারী ও শিশুদের প্রতি সহিংসতা, মানবতা বিরোধী
                                                অপরাধ, গুজব, মিথ্যাচার, হিংসা-বিদ্বেষ ছড়ানো ও মাদক সেবন থেকে
                                                সম্পূর্ণরূপে বিরত থাকবো। অন্যেরাও যেন এসব কর্মকাণ্ডের সাথে যুক্ত না হয়
                                                সে বিষয়ে আমি তাদের সচেতন করে তুলতে কাজ করবো। ব্যক্তি জীবনে অথবা সামাজিক
                                                মাধ্যমে আমি কোনো অপরাধী কর্মকাণ্ডের সাথে যুক্ত হলে বা অন্যের ক্ষতি হয়
                                                এমন কাজ করলে তার দায় সম্পূর্ণভাবে আমার। এখানে দুর্বার কর্তৃপক্ষে কোনো
                                                দায় থাকবে না।

                                                উপরে বর্ণিত বিষয়বস্তুর (শপথ) সাথে আপনি কি একমত?
                                            </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_14"
                                                               value="হ্যাঁ ">
                                                        <span>হ্যাঁ </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio">
                                                        <input type="radio" class="ques"
                                                               name="question_14"
                                                               value="না ">
                                                        <span>না </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body" style="padding: 13px;">
                            <h5>#এম্বাসেডরঃ</h5>
                            <p class="card-text" style="font-size:15px">স্বেচ্ছাশ্রমের ভিত্তিতে এম্বাসেডর নিয়োগের
                                মাধ্যমে দুর্বার প্লাটফরমে বিভিন্ন উদ্যোগ নেয়া হবে এবং বাস্তবায়ন করা হবে।
                            </p>

                            <h5 class="mt-1">#কারা এম্বাসেডর হতে পারবেনঃ</h5>
                            <ul class="list-unstyled" style="margin-left:22px; font-size:15px">
                                <li>» ১৮ বছরের ঊর্ধ্বে যেকোনো বাংলাদেশী নাগরিক</li>
                                <li>» মুক্তিযুদ্ধের চেতনায় বিশ্বাসী</li>
                                <li>» সমাজ-দেশের জন্য কাজ করতে আগ্রহী ও উদ্যোমী</li>
                                <li>» দলভুক্ত হয়ে কাজ করার ইতিবাচক মানসিকতা</li>
                                <li>» সামাজিক যোগাযোগ মাধ্যম ব্যবহারে অভ্যস্ত</li>
                            </ul>

                            <h5 class="mt-1">#এম্বাসেডর কী করবেনঃ </h5>
                            <ul class="list-unstyled" style="margin-left:22px; font-size:15px">
                                <li>» দুর্বার আয়োজিত অনলাইন-অফলাইন ক্যাম্পেইনে সক্রিয় অংশগ্রহণ</li>
                                <li>» সামাজিক ইস্যুতে নিজ নিজ পরিসরে মানুষকে সচেতন করা</li>
                                <li>» সামাজিক মাধ্যমে উপযোগী বিষয়ভিত্তিক কন্টেন্ট (স্ট্যাটাস, ছবি, ব্লগ, ভিডিও) তৈরি
                                </li>
                                <li>» কন্টেন্ট শেয়ার করা এবং বিভিন্ন আলোচনায় অংশ নেয়া</li>
                                <li>» নিয়মিত যোগাযোগ ও সমন্বয় সাধন করা</li>
                            </ul>

                            <h5 class="mt-1">#এম্বাসেডর কী পাবেন? </h5>
                            <ul class="list-unstyled" style="margin-left:22px; font-size:15px">
                                <li>»এম্বাসেডর হিসেবে সার্টিফিকেট</li>
                                <li>» বিষয়ভিত্তিক প্রশিক্ষণ</li>
                                <li>» জাতীয় ও আন্তর্জাতিক নেটওয়ার্কের সাথে যুক্ত হওয়ার সুযোগ</li>
                                <li>» গুরুত্বপূর্ণ অনুষ্ঠানের আমন্ত্রণ</li>
                                <li>» নিজের গল্প বলার একটি প্লাটফরম পাবেন</li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
@section('js')
    <script src="{{asset("assets/js/jquery.step.min.js")}}"></script>
    <script src="{{asset("assets/js/parsley.min.js")}}"></script>
    <script src="{{asset("assets/js/amb.min.js")}}"></script>
    <script type="text/javascript">
        $('#district').change(function () {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    type: "GET",
                    url: "{{url('upazila')}}/" + districtId,
                    success: function (res) {
                        if (res) {
                            $("#upazila").empty();
                            $("#union").empty();
                            $("#union").append('<option disabled selected>নির্বাচন করুন</option>');
                            $("#upazila").append('<option disabled selected>নির্বাচন করুন</option>');
                            $.each(res, function (key, value) {
                                $("#upazila").append('<option value="' + value.id + '">' + value.bn_name + '</option>');
                            });
                        } else {
                            $("#upazila").empty();
                            $("#union").empty();
                        }
                    }
                });
            } else {
                $("#upazila").empty();
                $("#union").empty();
            }
        });
        $('#upazila').on('change', function () {
            var upazilaId = $(this).val();
            if (upazilaId) {
                $.ajax({
                    type: "GET",
                    url: "{{url('union')}}/" + upazilaId,
                    success: function (res) {
                        if (res) {
                            $("#union").empty();
                            $("#union").append('<option disabled selected>নির্বাচন করুন</option>');
                            $.each(res, function (key, value) {
                                $("#union").append('<option value="' + value.id + '">' + value.bn_name + '</option>');
                            });

                        } else {
                            $("#union").empty();
                        }
                    }
                });
            } else {
                $("#union").empty();
            }

        });
    </script>
    @if($errors->any())
        <script>
            $('html, body').animate({
                scrollTop: $("#am-form").offset().top
            }, 2000);
        </script>

    @endif
@stop
