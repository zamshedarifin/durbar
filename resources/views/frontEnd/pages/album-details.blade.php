@extends('frontEnd.layouts.app')
@section('title','ফটো সমূহ')
@section('css-plugin')
    <link href="{{asset("assets/css/grid-gallery.css")}}" rel="stylesheet">
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
                        <h2 class="breadcrumb__title">ফটো সমূহ</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('photo.gallery')}}">ফটো গ্যালারি</a></li>
                            <li>ফটো সমূহ</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="section-padding bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="section-title pb-3">
                        <h4 class=" text-center text-uppercase">{{$album->title}}</h4>
                        <p class="text-center">{{$album->description}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="gg-screen"></div>
                    <div class="gg-box">
                        @if($album['photos'])
                            @foreach($album['photos'] as $key=>$photo)
                                <div class="gg-element">
                                    <img src="{{asset("uploads/photo/$photo->photo")}}">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </section>
@stop

@section('script')
    <script src="{{asset("assets/js/grid-gallery.js")}}"></script>
@stop
