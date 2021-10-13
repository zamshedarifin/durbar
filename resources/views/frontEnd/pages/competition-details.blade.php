@extends('frontEnd.layouts.app')
@section('title',$competition->title)
@section('meta')
    <meta property="og:title" content="{{$competition->title_bn}}"/>
    <meta property="og:image" content="{{asset("uploads/competition/$competition->cover")}}"/>
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
                        <h2 class="breadcrumb__title">বিস্তারিত</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="#">প্রতিযোগিতা</a></li>
                            <li>বিস্তারিত</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div>
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="story-area section-padding ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-3 shadow-sm">
                        <img src="{{asset("uploads/competition/$competition->cover")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$competition->title_bn}}</h5>
                            <p>প্রতিযোগিতার সময়ঃ <strong> <span class="text-success">{{BnDate(date('j F, Y',strtotime($competition->start_date)))}}</span> হতে <span class="text-danger"> {{BnDate(date('j F, Y',strtotime($competition->end_date)))}}</span> </strong><br></p>
                            <hr>
                            {!! $competition->description !!}
                            <hr>

                            <div class="social-links mt-3">
                                <a target="_blank"
                                   href="http://www.facebook.com/sharer.php?u={{route('front.competition-details',$competition->slug)}}"
                                   class="facebook"><i class="icofont icofont-facebook"></i></a>
                                <a target="_blank"
                                   href="https://twitter.com/intent/tweet?original_referer={{route('front.story-details',$competition->slug)}}"
                                   class="twitter"><i class="icofont icofont-twitter"></i></a>
                                <a target="_blank"
                                   href="https://www.linkedin.com/sharing/share-offsite/?url={{route('front.story-details',$competition->slug)}}"
                                   class="linkdin"><i class="icofont icofont-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end container -->
    </section>

@stop
@section('js')

@stop
