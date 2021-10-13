@extends('frontEnd.layouts.app')
@section('title','ক্যাম্পেইন')

@section('css')
    <style>
        .campaign-img-box img {
            height: 200px;
            width: 100%;
            object-fit: cover;
            border-radius: unset;
        }
        .campaign-block .image-box .image {
            background: unset !important;
        }

        /*Edited By Zamshed */
        button.selected{
            background:#ffa500;
            color:#fff;
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
                        <h2 class="breadcrumb__title">ক্যাম্পেইন</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>ক্যাম্পেইন</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    {{--    <section class="campaign-area section-padding">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row campaign-content-wrap">--}}
    {{--                @if($campaigns)--}}
    {{--                    @foreach($campaigns as $key=>$campaign)--}}
    {{--                       --}}{{-- <div class="col-lg-4 col-sm-6">--}}
    {{--                            <div class="card-item h-100">--}}
    {{--                                <div class="campaign-img-box">--}}
    {{--                                    <img src="{{asset("uploads/campaign/$campaign->cover")}}" alt="">--}}
    {{--                                    <span class="campaign__date"> <i class="la la-calendar"></i> {{BnDate(date('d F, Y',strtotime($campaign->cam_date)))}}</span>--}}
    {{--                                </div>--}}
    {{--                                <div class="campaign-content">--}}
    {{--                                    <h3 class="campaign__title"><a href="{{route('front.campaign-details',$campaign->slug)}}">{{$campaign->title}}</a></h3>--}}
    {{--                                    <div class="theme-shape"></div>--}}
    {{--                                    <p class="campaign__desc">--}}
    {{--                                        {{$campaign->short_desc}}--}}
    {{--                                    </p>--}}
    {{--                                    --}}{{----}}{{--                        <a href="#" class="read-more">বিস্তারিত <span class="la la-long-arrow-right"></span></a>--}}{{----}}{{----}}
    {{--                                </div><!-- end campaign-content -->--}}
    {{--                            </div><!-- end card-item -->--}}
    {{--                        </div>--}}{{--<!-- end col-lg-4 -->--}}
    {{--                           <div class="campaign-block col-lg-4 col-md-4  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">--}}
    {{--                               <div class="inner-box">--}}
    {{--                                   <div class="image-box">--}}
    {{--                                       <figure class="image"><a href="{{route('front.campaign-details',$campaign->slug)}}"><img src="{{asset("uploads/campaign/$campaign->cover")}}" alt="" style="height: 180px; width: 333px"></a></figure>--}}
    {{--                                   </div>--}}
    {{--                                   <div class="lower-content">--}}
    {{--                                       <div class="info-box">--}}
    {{--                                           <span class="date">{{BnDate(date('d F, Y',strtotime($campaign->cam_date)))}}</span>--}}
    {{--                                           <span class="author">দুর্বার</span>--}}
    {{--                                       </div>--}}
    {{--                                       <h4><a href="{{route('front.campaign-details',$campaign->slug)}}">{{$campaign->title}}</a></h4>--}}
    {{--                                       <div class="text"> {{description_shortener($campaign->short_desc,200)}} </div>--}}
    {{--                                       <div class="link-box"><a href="{{route('front.campaign-details',$campaign->slug)}}">» বিস্তারিত পড়ুন</a></div>--}}
    {{--                                   </div>--}}
    {{--                               </div>--}}
    {{--                           </div>--}}

    {{--                        @endforeach--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div><!-- end container -->--}}
    {{--    </section>--}}
    {{--    <!-- end campaign-area -->--}}

    <section class="event">
        <div class="event-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <div class="filter-div">
                            <button class="btn filter-button selected" data-filter="all" >সকল ক্যাম্পেইন</button>
                            <button class="btn filter-button" data-filter="1" >চলমান ক্যাম্পেইন</button>
                            <button class="btn filter-button " data-filter="4" >পুর্ববর্তী ক্যাম্পেইন</button>
                            <button class="btn filter-button" data-filter="3" >আসন্ন ক্যাম্পেইন</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-content-wrapper">
            <div class="container">
                <div class="row">
                    @if($campaigns)
                        @foreach($campaigns as $key=>$campaign)
                            <div class="campaign-block col-lg-4 col-md-4  wow fadeInUp animated filter {{$campaign->status}}" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a href="{{route('front.campaign-details',$campaign->slug)}}"><img src="{{asset("uploads/campaign/$campaign->cover")}}" alt="" style="height: 180px; width: 333px"></a></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="info-box">
                                            <span class="date">{{BnDate(date('d F, Y',strtotime($campaign->cam_date)))}}</span>
                                            <span class="author">দুর্বার</span>
                                        </div>
                                        <h4><a href="{{route('front.campaign-details',$campaign->slug)}}">{{$campaign->title}}</a></h4>
                                        <div class="text"> {{description_shortener($campaign->short_desc,200)}} </div>
                                        <div class="link-box"><a href="{{route('front.campaign-details',$campaign->slug)}}">» বিস্তারিত পড়ুন</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop


@section('js')

    <script type="text/javascript">

        $(document).ready(function(){

            $(".filter-button").click(function(){
                var value = $(this).attr('data-filter');

                if(value == "all")
                {
                    //$('.filter').removeClass('hidden');
                    $('.filter').show('1000');
                }
                else
                {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');

                }
            });

        });


        $('button').on('click', function(){
            $('button').removeClass('selected');
            $(this).addClass('selected');
        });
    </script>
@stop
