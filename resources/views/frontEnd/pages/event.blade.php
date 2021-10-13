@extends('frontEnd.layouts.app')
@section('title','ইভেন্ট সমূহ')
@section('css')
    <style>
        .event-img{ height: 150px !important; object-fit: contain; width: 100%; }
    </style>
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
                        <h2 class="breadcrumb__title">ইভেন্ট সমূহ</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>ইভেন্ট সমূহ</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    <section class="events section-padding bg-color">
        <div class="container">
            <div class="row">
                @if($events)
                    @foreach ($events as $event)
                        <div class="col-md-6">
                            <div class="card mb-3 shadow-sm border-0">
                                <div class="row no-gutters">
                                    <div class="col-3 col-md-4 align-self-center">
                                        <img src="{{asset("uploads/event/$event->cover")}}"
                                            class="card-img event-img" alt="..."></div>
                                    <div class="col-9 col-md-8">
                                        <div class="card-body"><h5 class="card-title"><a href="{{route('event.details',$event->slug)}}" class="text-dark">{{$event->title}}</a></h5>
                                            <p class="card-text"><span class="fa fa-calendar"></span> {{BnDate(date("j F, Y",strtotime($event->event_date)))}}
                                                <br><span class="fa fa-map-marker"></span> {{$event->location}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
@section('js')

@stop
