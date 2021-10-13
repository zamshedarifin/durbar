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


        <div class="row about-container">
            <div class="col-md-12 mt-1">
                  <div class="card">
                      <div class="card-body text-center font-weight-bold text-dark" style="padding: 60px; font-size: 22px;">
                        <div class="alert alert-warning" role="alert">
                        "ডিজিটাল ওয়ার্ল্ড-২০২০ এ আয়োজিত "আইসিটি ক্যারিয়ার ক্যাম্প" ও "আমার মুজিব" ক্যাম্পেইনের উদ্বোধনী অনুষ্ঠানে যোগ দেয়ার জন্য নিবন্ধন করার নির্ধারিত সময় শেষ হয়েছে।
                        সরাসরি লাইভে অনুষ্ঠানটি সম্প্রচার হবে দুর্বার এর অফিশিয়াল ফেইসবুক পেইজ থেকে।
                        দেখার জন্য চোখ রাখুন এখানে-"<br>

                        <a href="https://www.facebook.com/durbar21" target="_blank" class="btn btn-primary btn-sm mt-4"><i class="bx bxl-facebook-circle"></i>&nbsp;Facebook </a>
                        </div>
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
