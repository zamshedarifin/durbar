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


        <div class="row about-container">
            <div class="col-md-8 mt-1">
                  <div class="card">
                      <div class="card-body text-center font-weight-bold text-dark" style="padding: 60px; font-size: 22px;">

                      <div class="alert alert-warning" role="alert">

                        প্রাথমিকভাবে এম্বাসেডর নির্বাচনের কার্যক্রম আপাতত স্থগিত করা হয়েছে। কার্যক্রম শুরু হলে সবাইকে জানিয়ে দেয়া হবে। আমাদের সাথেই থাকুন।

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
