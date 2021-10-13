@extends('frontEnd.layouts.app')
@section('title','ফটো গ্যালারি')
@section('css')
    <style>
        .img-cover{
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
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
                        <h2 class="breadcrumb__title">ফটো গ্যালারি</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>ফটো গ্যালারি</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="section-padding">
        <div class="container">
            <div class="row">
                @if($albums)
                    @foreach($albums as $album)
                        <div class="col-lg-3 mb-15 col-md-4 m-b">
                            <div class="card shadow-sm border-0 h-100">
                                <img class="card-img-top img-cover"  alt="durbar album photo"
                                     src="{{asset("uploads/album/$album->thumbnail")}}">
                                <div class="card-body">
                                    <h6 class="card-title montserrat-bold">{{$album->title}}</h6>
{{--                                    <p class="card-text"></p>--}}
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="card-link"
                                           href="{{route('album.details',$album->slug)}}">
                                            দেখুন <i class="icofont icofont-long-arrow-right"></i> </a>
                                        <small class="text-muted">{{$album->created_at->diffForHumans()}}</small></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@stop

