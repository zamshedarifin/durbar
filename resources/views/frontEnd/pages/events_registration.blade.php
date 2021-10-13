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
                        <h2 class="breadcrumb__title">আইসিটি ক্যারিয়ার ক্যাম্প</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>আইসিটি ক্যারিয়ার ক্যাম্প</li>
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
                <div class="col-md-8 m-b mx-auto">
                    <div class="loading" style="display: none">Loading&#8230;</div>
                    <div class="card shadow-sm border-0">
                        <img id="am-form" src="{{asset("public/assets/img/banner/careerCamp.jpg")}}" class="card-img-top"
                             alt="...">
                        <div class="card-body" style="padding: 0">
                            <p class="card-text pl-3 pr-3 pt-3">ডিজিটাল ওয়ার্ল্ড-২০২০ এ  আয়োজিত "আইসিটি  ক্যারিয়ার ক্যাম্প" ও  "আমার মুজিব" ক্যাম্পেইনের উদ্বোধনী অনুষ্ঠানে যোগ দেয়ার জন্য নিবন্ধন ফর্ম। </p>
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
                            <div class="component-section no-code p-4">
                                <form id="career_camp">
                                    <h3>ফর্ম-ক</h3>
                                    <section class="p-0">
                                        <div class="row row-sm" id="first-step">
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
                                                <label for="divison"class="form-label">আপনি কোন বিভাগ থেকে অন্তর্গত? - Divison<span
                                                        class="text-danger">*</span></label>
                                                <select  autocomplete="off" name="divison" data-parsley-required-message="বিভাগ আবশ্যক।"
                                                         required id="divison" class="form-control">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    <option value="sylhet">সিলেট</option>
                                                    <option value="chittagong">চিটাগং</option>
                                                    <option value="dhaka">ঢাকা</option>
                                                    <option value="rajshashi">রাজশাহী</option>
                                                    <option value="mymensingh">ময়মনসিংহ</option>
                                                    <option value="khulna">খুলনা</option>
                                                    <option value="barisal">বরিশাল</option>
                                                    <option value="rangpur">রংপুর</option>
                                                </select>

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


                                            <div class="mb-3 col-md-12">
                                                <label for="address" class="form-label">আপনার পূর্ণ বর্তমান ঠিকানা ( বাড়ি/ফ্ল্যাট নং, রোড নম্বর, জেলা )<span
                                                        class="text-danger">*</span></label>
                                                <textarea autocomplete="off"  name="address" placeholder="বাড়ি/ফ্ল্যাট নং, রোড নম্বর, জেলা" data-parsley-required-message="বর্তমান ঠিকানা আবশ্যক।" required id="address" class="form-control"></textarea>
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
                                                <label for="profession" class="form-label">আপনার পেশা- Occupation<span
                                                        class="text-danger">*</span></label>
                                                <select autocomplete="off"  name="profession" data-parsley-required-message="পেশা আবশ্যক।"
                                                        required id="profession"
                                                        class="form-control @error('profession') is-invalid @enderror">
                                                    <option value="" disabled selected>নির্বাচন করুন</option>
                                                    <option
                                                        value="Student" {{old('profession')=='Student'?'selected':''}}>
                                                        ছাত্র (Student)
                                                    </option>
                                                    <option
                                                        value="Service Holder" {{old('profession')=='Service Holder'?'selected':''}}>
                                                        চাকরিজীবী (Service Holder)
                                                    </option>
                                                    <option
                                                        value="Self Employed" {{old('profession')=='Self Employed'?'selected':''}}>
                                                        স্বনির্ভর (Self-employed)
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
                                                <label for="join_with" id="join_with" class="">&#9635; <strong>আপনি ডিজিটাল ওয়ার্ল্ডের আওতায় আয়োজিত আইসিটি  ক্যারিয়ার ক্যাম্পে ও আমার মুজিব ক্যাম্পেইনের উদ্বোধনী অনুষ্ঠানে কীভাবে অংশগ্রহণ করতে চান?</strong><span
                                                        class="text-danger">*</span> </label>
                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-5"
                                                           class="form-check-input join_with"
                                                           {{old('join_with')=='1'?'checked':''}} type="radio"
                                                           name="join_with"
                                                           id="facebook" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">ফেইসবুক লাইভ</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input required data-parsley-errors-container=".error-message-5"
                                                           class="form-check-input join_with"
                                                           {{old('join_with')=='0'?'checked':''}} type="radio"
                                                           name="join_with"
                                                           id="zoom" value="0">
                                                    <label class="form-check-label" for="inlineRadio1">সরাসরি জুম (Zoom) এর মাধ্যমে</label>
                                                </div>

                                                <div class="error-message-5" style="margin-top: -8px"></div>
                                            </div>
                                        </div><!-- row -->
                                    </section>

                                    <h3>ফর্ম-খ</h3>

                                    <section class="row p-0">
                                        <p><h4 class="text-success">সরাসরি প্রোগ্রামে অংশগ্রহণ করতে হলে এই প্রশ্নগুলোর উত্তর দিন</h4></p>
                                        <p class="mb-2 text-success"><strong>প্রথম ১০০ জন যারা এই পাঁচটি প্রশ্নের সঠিক উত্তর স্বল্পসময়ের মধ্যে দিতে পারবেন, তাদের শর্ট লিস্ট করা হবে ডিজিটাল ওয়ার্ল্ডের আওতায় আইসিটি ক্যারিয়ার ক্যাম্প এবং আমার মুজিব ক্যাম্পেইনের উদ্বোধনী অনুষ্ঠানে</strong></p>
                                        <?php
                                        $name = 0;
                                        $i=1;
                                        ?>
                                        @foreach($data['quiz'] as $key=>$quiz)
                                            @php $name++ @endphp
                                        <div class="col-md-12 mb-3">
                                            <label style="font-weight: bold"
                                                   class="{{'qs_'.$name}}">&#9635;
                                                {{$quiz->title}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <br>
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="{{'question_'.$name}}" value="1">
                                                        <span>{{$quiz->option_one}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="{{'question_'.$name}}" value="2">
                                                        <span>{{$quiz->option_two}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="{{'question_'.$name}}" value="3">
                                                        <span>{{$quiz->option_three}}</span>
                                                    </div>
                                                </div>

                                                @if(!empty($quiz->option_four))
                                                <div class="col-sm-12">
                                                    <div class="radio">
                                                        <input type="radio" class="ques" name="{{'question_'.$name}}" value="4">
                                                        <span>{{$quiz->option_four}}</span>
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        @endforeach
                                    </section>
                                </form>
                            </div>
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
    <script src="{{asset("assets/js/ccamp.min.js")}}"></script>

    @if($errors->any())
        <script>
            $('html, body').animate({
                scrollTop: $("#am-form").offset().top
            }, 2000);
        </script>

    @endif
@stop
