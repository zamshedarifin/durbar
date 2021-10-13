@extends('admin.layouts.app')
@section('title','Application Details')
@section('css')
    <style>
        .form-control {
            border: unset !important;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>

                @endif
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Ambassador Application Details<br>
                    <span class="font-14">Apply Date: {{date('j F,Y',strtotime($ambassador->created_at))}}</span>
                </h5>

                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-3 align-self-center text-center">

                            @if($ambassador->gender == 'male')

                                @if($ambassador->age == '18 to 24 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/1.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='25 to 34 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/2.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='35 to 44 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/3.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='45 to Above')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/4.png')}}" class="card-img mx-auto" alt="...">
                                @endif

                            @else
                                @if($ambassador->age == '18 to 24 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_1.jpg')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='25 to 34 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_2.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='35 to 44 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_3.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($ambassador->age =='45 to Above')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_4.png')}}" class="card-img mx-auto" alt="...">
                                @endif
                            @endif

                        </div>
                        <div class="col-md-5 border-right border-left">
                            <div class="card-body">
                                <h5 class="card-title">{{$ambassador->name}}</h5>
                                <p class="card-text"><strong>Gender:</strong> {{ucfirst($ambassador->gender)}}<br>
                                    <strong>Age:</strong> {{ucfirst($ambassador->age)}}<br>
                                    <strong>Profession:</strong> {{ucfirst($ambassador->profession)}}<br>
                                    <strong>Cell Phone:</strong> 0{{$ambassador->cell_phone}}<br>
                                    <strong>Email:</strong> {{strtolower($ambassador->email)}}<br>
                                    <strong>FB Link:</strong> <a href="{{addHttp($ambassador->fb_profile_link)}}"
                                                                 target="_blank">{{addHttp($ambassador->fb_profile_link)}}</a>

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h5 class="card-title">Contact Information</h5>
                                <p class="card-text">
                                    <strong>District:</strong> {{$ambassador['district']['bn_name']}}<br>
                                    <strong>Upazila:</strong> {{$ambassador['upazila']['bn_name']}}<br>
                                    <strong>Union/Ward:</strong> {{$ambassador['union']['bn_name']}}<br>
                                    <strong>Present Address:</strong> {{$ambassador->address}}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="card mb-3 border-0 shadow-sm" style="border-radius: 0">
                    <img
                        src="{{asset('admin/images/users/pp.png')}}"
                        class="card-img-top rounded-circle mx-auto d-block mt-2"
                        style="height: 150px;  width: 150px; object-fit: cover; object-position: top" alt="...">
                    <div class="card-body">


                    </div>
                </div>--}}
                <div class="form-row">
                    <div class="col-md-12">
                        <label style="font-weight: bold" for="is_work" class="@error('is_work') text-danger @enderror">▣
                            আপনি কি দুর্বার প্লাটফর্মের এম্বাসেডর হিসেবে কাজ করতে চান? </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   {{$ambassador->is_work=='1'?'checked':'disabled'}} type="radio"
                                   name="is_work" id="radio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">হ্যাঁ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   {{$ambassador->is_work=='0'?'checked':'disabled'}} type="radio"
                                   name="is_work" id="radio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">না</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight: bold" for="send_mail" class="@error('send_mail') text-danger @enderror">▣ আমরা কি আপনাকে ই-মেইল এবং এসএমএসের মাধ্যমে কোন সংবাদ বা কন্টেন্ট পাঠাতে পারি? </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                   {{$ambassador->send_mail=='1'?'checked':'disabled'}} name="send_mail" id="radio3"
                                   value="1">
                            <label class="form-check-label" for="inlineRadio1">হ্যাঁ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                   {{$ambassador->send_mail=='0'?'checked':'disabled'}} name="send_mail" id="radio4"
                                   value="0">
                            <label class="form-check-label" for="inlineRadio2">না</label>
                        </div>
                    </div>

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
                                    <span class="{!! $ambassador->question_10=='সমাজে আমার মর্যাদা বাড়াবে'?'fa fa-check-circle text-success':'' !!}"> সমাজে আমার মর্যাদা বাড়াবে</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_10"
                                           value="দেশের জন্য কাজ করার সুযোগ পাবো">
                                    <span class="{!! $ambassador->question_10=='দেশের জন্য কাজ করার সুযোগ পাবো'?'fa fa-check-circle text-success':'' !!}"> দেশের জন্য কাজ করার সুযোগ পাবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_10"
                                           value="নিজেকে সমৃদ্ধ করার সুযোগ পাবো">
                                    <span class="{!! $ambassador->question_10=='নিজেকে সমৃদ্ধ করার সুযোগ পাবো'?'fa fa-check-circle text-success':'' !!}"> নিজেকে সমৃদ্ধ করার সুযোগ পাবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_10"
                                           value="ব্যক্তিগত সুযোগ সুবিধা পাবো">
                                    <span class="{!! $ambassador->question_10=='ব্যক্তিগত সুযোগ সুবিধা পাবো'?'fa fa-check-circle text-success':'' !!}"> ব্যক্তিগত সুযোগ সুবিধা পাবো</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_2') text-danger @enderror">&#9635; সর্বশেষ কবে একটা ভাল কাজ
                            করেছেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_2"
                                           value="মনে করতে পারছিনা">
                                    <span class="{!! $ambassador->question_2=='মনে করতে পারছিনা'?'fa fa-check-circle text-success':'' !!}"> মনে করতে পারছিনা </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_2"
                                           value="গত এক সপ্তাহে">
                                    <span
                                        class="{!! $ambassador->question_2=='গত এক সপ্তাহে'?'fa fa-check-circle text-success':'' !!}"> গত এক সপ্তাহে</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_2"
                                           value="গত এক মাসে">
                                    <span
                                        class="{!! $ambassador->question_2=='গত এক মাসে'?'fa fa-check-circle text-success':'' !!}"> গত এক মাসে</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_2')=='গত এক বছরে'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_2"
                                           value="গত এক বছরে">
                                    <span
                                        class="{!! $ambassador->question_2=='গত এক বছরে'?'fa fa-check-circle text-success':'' !!}"> গত এক বছরে</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_1') text-danger @enderror">▣ আপনি রাস্তা দিয়ে হেঁটে যাচ্ছেন।
                            একসময় দেখলেন, ৫ বছর বয়সী একটা বাচ্চা ফুটপাতের উপর বসে খুব কাঁদছে। তার আশেপাশে কেউ নেই।
                            এরেকটু কাছে গিয়ে দেখলেন বাচ্চাটির পা থেকে রক্ত ঝরছে। সে জায়গায় হাত দিয়ে বাচ্চাটি মা মা বলে
                            চিৎকার করছে। এমন পরিস্থিতিতে আপনি কী করবেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_1"
                                           value="ছবি তুলে ফেসবুকে শেয়ার করবো">
                                    <span
                                        class="{!! $ambassador->question_1=='ছবি তুলে ফেসবুকে শেয়ার করবো'?'fa fa-check-circle text-success':'' !!}"> ছবি তুলে ফেসবুকে শেয়ার করবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_1"
                                           value="৯৯৯-এ ফোন করে সাহায্য চাইবো">
                                    <span
                                        class="{!! $ambassador->question_1=='৯৯৯-এ ফোন করে সাহায্য চাইবো'?'fa fa-check-circle text-success':'' !!}"> ৯৯৯-এ ফোন করে সাহায্য চাইবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_1"
                                           value="বাচ্চাটিকে দ্রুত ডাক্তারের কাছে নিবো">
                                    <span
                                        class="{!! $ambassador->question_1=='বাচ্চাটিকে দ্রুত ডাক্তারের কাছে নিবো'?'fa fa-check-circle text-success':'' !!}"> বাচ্চাটিকে দ্রুত ডাক্তারের কাছে নিবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_1"
                                           value="ঝামেলায় না জড়িয়ে দ্রুত সেখান থেকে চলে যাবো">
                                    <span
                                        class="{!! $ambassador->question_1=='ঝামেলায় না জড়িয়ে দ্রুত সেখান থেকে চলে যাবো'?'fa fa-check-circle text-success':'' !!}"> ঝামেলায় না জড়িয়ে দ্রুত সেখান থেকে চলে যাবো</span>
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
                                    <span class="{!! $ambassador->question_11=='দুইটি'?'fa fa-check-circle text-success':'' !!}">দুইটি</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_11"
                                           value="একটি">
                                    <span class="{!! $ambassador->question_11=='একটি'?'fa fa-check-circle text-success':'' !!}">একটি</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_11"
                                           value="একটিও না">
                                    <span class="{!! $ambassador->question_11=='একটিও না'?'fa fa-check-circle text-success':'' !!}">একটিও না</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques" name="question_11"
                                           value="দুইটির বেশি">
                                    <span class="{!! $ambassador->question_11=='দুইটির বেশি'?'fa fa-check-circle text-success':'' !!}">দুইটির বেশি</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_3') text-danger @enderror">&#9635; আপনার ফেসবুক নিউজফিডে অথবা
                            অপরিচিত একটি নিউজ পোর্টালে একটি সংবাদ দেখলেন। সংবাদটির শিরোনাম খুব চটকদার। পুরো সংবাদটি আপনি
                            পড়লেন, খুব মজা পেলেন কিন্তু সংবাদটি আপনার কাছে বিশ্বাসযোগ্য মনে হচ্ছেনা। কোথায় যেন একটু খটকা
                            লাগছে। এমন পরিস্থিতিতে আপনি কী করবেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_3"
                                           value="সাথে সাথে শেয়ার করবো">
                                    <span
                                        class="{!! $ambassador->question_3=='সাথে সাথে শেয়ার করবো'?'fa fa-check-circle text-success':'' !!}"> সাথে সাথে শেয়ার করবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_3"
                                           value="বন্ধু-বান্ধবের সাথে পরামর্শ করবো">
                                    <span
                                        class="{!! $ambassador->question_3=='বন্ধু-বান্ধবের সাথে পরামর্শ করবো'?'fa fa-check-circle text-success':'' !!}"> বন্ধু-বান্ধবের সাথে পরামর্শ করবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_3"
                                           value="অনলাইনে যাচাই করবো">
                                    <span
                                        class="{!! $ambassador->question_3=='অনলাইনে যাচাই করবো'?'fa fa-check-circle text-success':'' !!}"> অনলাইনে যাচাই করবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_3"
                                           value="গোপনে অন্যদের সাথে শেয়ার করবো">
                                    <span
                                        class="{!! $ambassador->question_3=='গোপনে অন্যদের সাথে শেয়ার করবো'?'fa fa-check-circle text-success':'' !!}"> গোপনে অন্যদের সাথে শেয়ার করবো</span>
                                </div>
                            </div>
                        </div>


                    </div>


                   {{-- <div class="col-md-12 mt-2">
                        <label class="@error('question_4') text-danger @enderror">&#9635; ধরা যাক, আপনি চাকুরীর জন্য একটি
                            প্রতিষ্ঠানে আবেদন করলেন। প্রতিষ্ঠানটির পক্ষ থেকে ই-মেইল করে আপনাকে পরীক্ষায় অংশ নেয়ার জন্য
                            আমন্ত্রণ জানানো হলো। আপনি ফিরতি ই-মেইলে জানিয়ে দিলেন যে, আপনি যথাসময়ে, যথাস্থানে উপস্থিত হয়ে
                            পরীক্ষায় অংশ নেবেন। পরীক্ষার দুইদিন আগে আপনাকে আবার ফোন করা হলো। এবারেও আপনি আপনার উপস্থিতির
                            বিষয়ে নিশ্চিত করলেন। পরীক্ষার ঠিক একদিন আগে এমন কিছু ঘটল যার ফলে আপনার পক্ষে আর পরীক্ষায় অংশ
                            নেয়া সম্ভব হবেনা। এমন অবস্থায় আপনি কী করবেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_4')=='ফোন বন্ধ রাখবো'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_4"
                                           value="ফোন বন্ধ রাখবো">
                                    <span
                                        class="{!! $ambassador->question_4=='ফোন বন্ধ রাখবো'?'fa fa-check-circle text-success':'' !!}"> ফোন বন্ধ রাখবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_4')=='ফোন করে জানিয়ে দিবো'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_4"
                                           value="ফোন করে জানিয়ে দিবো">
                                    <span
                                        class="{!! $ambassador->question_4=='ফোন করে জানিয়ে দিবো'?'fa fa-check-circle text-success':'' !!}"> ফোন করে জানিয়ে দিবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_4')=='কিছুই করবোনা'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_4"
                                           value="কিছুই করবোনা">
                                    <span
                                        class="{!! $ambassador->question_4=='কিছুই করবোনা'?'fa fa-check-circle text-success':'' !!}"> কিছুই করবোনা</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_4')=='ই-মেইল করে জানিয়ে দিব'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_4"
                                           value="ই-মেইল করে জানিয়ে দিব">
                                    <span
                                        class="{!! $ambassador->question_4=='ই-মেইল করে জানিয়ে দিব'?'fa fa-check-circle text-success':'' !!}"> ই-মেইল করে জানিয়ে দিব</span>
                                </div>
                            </div>
                        </div>
                    </div>--}}

                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_5') text-danger @enderror">&#9635; আপনাকে একটি কাজ দেয়া হলো। কাজটি আপনাকে এক মাসের মধ্যে শেষ করতে হবে। আপনি
                            দেখলেন, এটা আপনার পক্ষে মাত্র সাত দিনে শেষ করা সম্ভব। এসময় আপনার হাতে
                            তেমন কোনো গুরুত্বপূর্ণ কাজ নেই। কাজটি আপনি কবে থেকে শুরু করবেন?</label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_12"
                                           value="এক সপ্তাহ পরে">
                                    <span
                                        class="{!! $ambassador->question_12=='এক সপ্তাহ পরে'?'fa fa-check-circle text-success':'' !!}"> এক সপ্তাহ পরে</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           class="ques"
                                           name="question_12"
                                           value="প্রথম দিন থেকে">
                                    <span
                                        class="{!! $ambassador->question_12=='প্রথম দিন থেকে'?'fa fa-check-circle text-success':'' !!}"> প্রথম দিন থেকে </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           class="ques"
                                           name="question_12"
                                           value="দুই সপ্তাহ পরে">
                                    <span
                                        class="{!! $ambassador->question_12=='দুই সপ্তাহ পরে'?'fa fa-check-circle text-success':'' !!}"> দুই সপ্তাহ পরে </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_12"
                                           value="শেষ সপ্তাহে">
                                    <span
                                        class="{!! $ambassador->question_12=='শেষ সপ্তাহে'?'fa fa-check-circle text-success':'' !!}"> শেষ সপ্তাহে</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_6') text-danger @enderror">&#9635; আপনি একটি টিমের লিডার। আপনার
                            টিমে ৮ জন সদস্য আছে। একবার একটা মিটিং-এ বস টিমের সবার সামনে আপনার অনেক প্রশংসা করলেন। একটা
                            কাজ সফলভাবে সম্পন্ন করার জন্য আপনাকে কৃতিত্ব দেয়া হলো। মজার বিষয় হচ্ছে, এই কাজটি আসলে অন্য
                            একজন সদস্য করেছে। যাবতীয় কৃতিত্ব তার পাবার কথা। এমন পরিস্থিতিতে আপনি কী করবেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_6')=='চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_6"
                                           value="চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো">
                                    <span
                                        class="{!! $ambassador->question_6=='চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো'?'fa fa-check-circle text-success':'' !!}"> চুপচাপ থাকবো এবং মিটিং শেষে সেই সদস্যকে সরি বলবো</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           class="ques"
                                           name="question_6"
                                           value="সবার সামনে আসল বিষয়টি খুলে বলবো">
                                    <span
                                        class="{!! $ambassador->question_6=='সবার সামনে আসল বিষয়টি খুলে বলবো'?'fa fa-check-circle text-success':'' !!}"> সবার সামনে আসল বিষয়টি খুলে বলবো </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           class="ques"
                                           name="question_6"
                                           value="কাউকে কিছুই বলবো না">
                                    <span
                                        class="{!! $ambassador->question_6=='কাউকে কিছুই বলবো না'?'fa fa-check-circle text-success':'' !!}"> কাউকে কিছুই বলবো না</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_6"
                                           value="নিজের সাফল্য উদযাপন করবো">
                                    <span
                                        class="{!! $ambassador->question_6=='নিজের সাফল্য উদযাপন করবো'?'fa fa-check-circle text-success':'' !!}"> নিজের সাফল্য উদযাপন করবো</span>
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
                                    <span class="{!! $ambassador->question_13=='পদ্মা সেতু'?'fa fa-check-circle text-success':'' !!}"> পদ্মা সেতু</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           class="ques"
                                           name="question_13"
                                           value="স্বাধীনতা যুদ্ধ">
                                    <span class="{!! $ambassador->question_13=='স্বাধীনতা যুদ্ধ'?'fa fa-check-circle text-success':'' !!}"> স্বাধীনতা যুদ্ধ</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_13"
                                           value="কক্সবাজার সমুদ্র সৈকত">
                                    <span class="{!! $ambassador->question_13=='কক্সবাজার সমুদ্র সৈকত'?'fa fa-check-circle text-success':'' !!}"> কক্সবাজার সমুদ্র সৈকত</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_13"
                                           value="সুন্দরবন">
                                    <span class="{!! $ambassador->question_13=='সুন্দরবন'?'fa fa-check-circle text-success':'' !!}"> সুন্দরবন</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_7') text-danger @enderror">&#9635; নিচের কোনটি আপনার কাছে বেশি
                            গুরুত্বপূর্ণ? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_7"
                                           value="অনেক ক্ষমতা">
                                    <span
                                        class="{!! $ambassador->question_7=='অনেক ক্ষমতা'?'fa fa-check-circle text-success':'' !!}"> অনেক ক্ষমতা </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_7"
                                           value="অনেক ভালবাসা">
                                    <span
                                        class="{!! $ambassador->question_7=='অনেক ভালবাসা'?'fa fa-check-circle text-success':'' !!}"> অনেক ভালবাসা</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label style="font-weight: bold" class="@error('question_8') text-danger @enderror">&#9635; কোন গুণগুলি আপনার জন্য সবচেয়ে
                            বেশি প্রযোজ্য? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_8')=='পরিশ্রমী ও উদ্যমী'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_8"
                                           value="পরিশ্রমী ও উদ্যমী">
                                    <span
                                        class="{!! $ambassador->question_8=='পরিশ্রমী ও উদ্যমী'?'fa fa-check-circle text-success':'' !!}"> পরিশ্রমী ও উদ্যমী </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio"
                                           {{old('question_8')=='মেধাবী ও সৃজনশীল'?'fa fa-check-circle text-success':''}} class="ques"
                                           name="question_8"
                                           value="মেধাবী ও সৃজনশীল">
                                    <span
                                        class="{!! $ambassador->question_8=='মেধাবী ও সৃজনশীল'?'fa fa-check-circle text-success':'' !!}"> মেধাবী ও সৃজনশীল </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_8"
                                           value="সৎ ও আদর্শবান">
                                    <span
                                        class="{!! $ambassador->question_8=='সৎ ও আদর্শবান'?'fa fa-check-circle text-success':'' !!}"> সৎ ও আদর্শবান</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_8"
                                           value="বিশ্বাসী ও নির্ভরযোগ্য">
                                    <span
                                        class="{!! $ambassador->question_8=='বিশ্বাসী ও নির্ভরযোগ্য'?'fa fa-check-circle text-success':'' !!}"> বিশ্বাসী ও নির্ভরযোগ্য</span>
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
                                    <span class="{!! $ambassador->question_14=='হ্যাঁ'?'fa fa-check-circle text-success':'' !!}"> হ্যাঁ </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_14"
                                           value="না ">
                                    <span class="{!! $ambassador->question_14=='না '?'fa fa-check-circle text-success':'' !!}">না </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="col-md-12 mt-2">
                        <label class="@error('question_9') text-danger @enderror">&#9635; কখনও বিপদে পড়লে বা ব্যর্থ হলে
                            কী করেন? </label>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_9"
                                           value="ভেঙ্গে পড়ি">
                                    <span
                                        class="{!! $ambassador->question_9=='ভেঙ্গে পড়ি'?'fa fa-check-circle text-success':'' !!}"> ভেঙ্গে পড়ি  </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_9"
                                           value="নিজের ভাগ্যকে দোষ দিতে থাকি">
                                    <span
                                        class="{!! $ambassador->question_9=='নিজের ভাগ্যকে দোষ দিতে থাকি'?'fa fa-check-circle text-success':'' !!}"> নিজের ভাগ্যকে দোষ দিতে থাকি</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_9"
                                           value="সমস্যার কারণ খুঁজতে থাকি">
                                    <span
                                        class="{!! $ambassador->question_9=='সমস্যার কারণ খুঁজতে থাকি'?'fa fa-check-circle text-success':'' !!}"> সমস্যার কারণ খুঁজতে থাকি</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <input type="radio" class="ques"
                                           name="question_9"
                                           value="মাথা ঠাণ্ডা রেখে সমস্যা সমাধানের চেষ্টা করি">
                                    <span
                                        class="{!! $ambassador->question_9=='মাথা ঠাণ্ডা রেখে সমস্যা সমাধানের চেষ্টা করি'?'fa fa-check-circle text-success':'' !!}"> মাথা ঠাণ্ডা রেখে সমস্যা সমাধানের চেষ্টা করি </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>--}}

                    <div class="col-md-4 offset-md-4 mt-3 text-center">
                        @if($ambassador->status == 0)
                            <a href="{{route('admin.ambassador.status',[lock(2),lock($ambassador->id)])}}"
                               onclick="return confirm('Are you sure want to reject this?')"
                               class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Reject</a>
                            <a href="{{route('admin.ambassador.status',[lock(1),lock($ambassador->id)])}}"
                               onclick="return confirm('Are you sure want to approve this?')"
                               class="btn btn-sm btn-success"><i class="fa fa-check-circle-circle"></i> Approve</a>
                        @elseif($ambassador->status == 1)
                            <a href="{{route('admin.ambassador.status',[lock(2),lock($ambassador->id)])}}"
                               onclick="return confirm('Are you sure want to reject this?')"
                               class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Reject</a>
                        @else
                            <a href="{{route('admin.ambassador.status',[lock(1),lock($ambassador->id)])}}"
                               onclick="return confirm('Are you sure want to approve this?')"
                               class="btn btn-sm btn-success"><i class="fa fa-check-circle-circle"></i> Approve</a>

                        @endif
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
@stop

