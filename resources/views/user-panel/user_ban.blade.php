@extends('frontEnd.layouts.app')
@section('title','ব্যান')

@section('banner')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">ব্যান</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>ব্যান</li>
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
                <div class="col-md-10 mt-1 mx-auto">
                    <div class="card">
                        <div class="card-body text-center font-weight-bold text-dark" style="padding: 60px; font-size: 22px;">
                            <div class="alert alert-warning" role="alert">
                                একাধিক আইডি খুলে কুইজে অংশগ্রহণ করার কারণে আপনার সমস্ত আইডি এই প্ল্যাটফর্মে ব্যান করা হয়েছে।<br>
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
