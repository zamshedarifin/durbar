@extends('frontEnd.layouts.app')
@section('title','দুর্বার')
@section('css')
    <style>
        .glide__slide {
            background: black !important;
        }

        .glide__slide img {
            opacity: 0.5;
        }

        .glide__slide[class*=active] {
            background: unset !important;
        }

        .glide__slide[class*=active] img {
            opacity: unset !important;
        }

        .gutter-2.row {
            margin-right: -6px;
            margin-left: -6px;
        }

        .gutter-2 > [class^="col-"], .gutter-2 > [class^=" col-"] {
            padding-right: 6px;
            padding-left: 6px;
        }


    </style>
@stop
@section('css-plugin')
    <link rel="stylesheet" href="{{asset("assets/css/glide.core.min.css")}}">
@stop
@section('banner')
    <section id="hero" class="d-flex align-items-center"></section>
@stop
@section('content')


    <section id="campaign" class="campaign">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="section-title">
                <h2>চলমান ক্যাম্পেইন </h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for($i=0;@count($data['campaigns'])>$i;$i++)
                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}"
                                    class="{{$i==0?'active':''}}"></li>
                            @endfor
                        </ol>


                        <div class="carousel-inner shadow">
                            @if($data['campaigns'])
                                @foreach($data['campaigns'] as $key=>$campaign)
                                    <div class="carousel-item {{$key==0?'active':''}}">
                                        <div class="card border-0">
                                            <div class="row no-gutters">
                                                <div class="col-md-7">
                                                    <img src="{{asset("uploads/campaign/$campaign->cover")}}"
                                                         class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-5 align-self-center text-center">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><strong>{{$campaign->title}}</strong>
                                                        </h5>
                                                        <p class="card-text">{{$campaign->short_desc}} <a
                                                                href="{{route('front.campaign-details',$campaign->slug)}}">বিস্তারিত
                                                                <i
                                                                    class="icofont icofont-long-arrow-right"></i> </a>
                                                        </p>
                                                        {{--<a href="{{route('front.campaign-details',$campaign->slug)}}"
                                                           class="theme-btn btn-sm">বিস্তারিত <i
                                                                class="icofont icofont-long-arrow-right"></i></a>--}}
                                                        @if(@count($campaign['competitions'])>0)
                                                            <div class="row gutter-2">
                                                                <div class="col-12">
                                                                    <h5 class="card-title"><strong>প্রতিযোগিতা</strong>
                                                                    </h5>
                                                                </div>
                                                                @foreach($campaign['competitions'] as $key=>$competition)
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="card shadow-sm border-0">
                                                                            <a href="{{route('front.competition-details',$competition->slug)}}"
                                                                               data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="{{$competition->title_bn}}">
                                                                                <img
                                                                                    src="{{asset("uploads/competition/$competition->cover")}}"
                                                                                    class="img-thumbnail" alt="...">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@if(count($data['previous_campaigns'])>0)
    <section id="campaign" class="campaign">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="section-title">
                <h2>পুর্ববর্তী ক্যাম্পেইন</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for($i=0;@count($data['previous_campaigns'])>$i;$i++)
                                <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}"
                                    class="{{$i==0?'active':''}}"></li>
                            @endfor
                        </ol>


                        <div class="carousel-inner shadow">
                            @if($data['previous_campaigns'])
                                @foreach($data['previous_campaigns'] as $key=>$campaign)
                                    <div class="carousel-item {{$key==0?'active':''}}">
                                        <div class="card border-0">
                                            <div class="row no-gutters">
                                                <div class="col-md-7">
                                                    <img src="{{asset("uploads/campaign/$campaign->cover")}}"
                                                         class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-5 align-self-center text-center">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><strong>{{$campaign->title}}</strong>
                                                        </h5>
                                                        <p class="card-text">{{$campaign->short_desc}} <a
                                                                href="{{route('front.campaign-details',$campaign->slug)}}">বিস্তারিত
                                                                <i
                                                                    class="icofont icofont-long-arrow-right"></i> </a>
                                                        </p>
                                                        {{--<a href="{{route('front.campaign-details',$campaign->slug)}}"
                                                           class="theme-btn btn-sm">বিস্তারিত <i
                                                                class="icofont icofont-long-arrow-right"></i></a>--}}
                                                        @if(@count($campaign['competitions'])>0)
                                                            <div class="row gutter-2">
                                                                <div class="col-12">
                                                                    <h5 class="card-title"><strong>প্রতিযোগিতা</strong>
                                                                    </h5>
                                                                </div>
                                                                @foreach($campaign['competitions'] as $key=>$competition)
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="card shadow-sm border-0">
                                                                            <a href="{{route('front.competition-details',$competition->slug)}}"
                                                                               data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="{{$competition->title_bn}}">
                                                                                <img
                                                                                    src="{{asset("uploads/competition/$competition->cover")}}"
                                                                                    class="img-thumbnail" alt="...">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    @endif

    {{--@if($data['competitions'])
        <section id="competition" class="competition">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="section-title">
                    <h2>প্রতিযোগিতা</h2>
                </div>
                <div class="row">
                    @foreach($data['competitions'] as $competition)
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{asset("uploads/competition/$competition->cover")}}" alt="{{$competition->title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$competition->title_bn}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif--}}

    @if(@count($data['upcomingCampaign'])>0)
        <section id="event" class="event section-bg">
            <div class="container aos-init aos-animate" data-aos-delay="150" data-aos="fade-up">
                <div class="section-title">
                    <h2>আসন্ন ক্যাম্পেইন</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="row no-gutters">
                                <div class="col-md-6">

                                    <img src="{{asset("uploads/campaign")}}/{{$data['upcomingCampaign']['cover']}}"
                                         class="card-img"
                                         alt="...">
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">

                                            <strong>{{$data['upcomingCampaign']['title']}}</strong></h5>
                                        <p class="card-text">{{$data['upcomingCampaign']['short_desc']}}
                                        </p>

                                        <div class="countdown-timer mt-2">
                                            <ul class="countdown-list"
                                                data-countdown="{{$data['upcomingCampaign']['cam_date']}}"></ul>
                                        </div>
                                        <a href="{{route('front.campaign')}}"
                                           class="btn btn-outline-info mt-3 btn-sm"><i
                                                class="icofont icofont-list"></i> সবগুলো ক্যাম্পেইন </a>
                                        <a href="{{route('front.campaign-details',$data['upcomingCampaign']['slug_bn'])}}"
                                           class="btn btn-outline-dark btn-sm mt-3">বিস্তারিত
                                            <i class="icofont icofont-long-arrow-right"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    @endif

    {{--<section class="gallery-area  text-center">
        <div class="container">
            <div class="section-title">
                <h2>ছবি সমূহ</h2>
            </div>
            <div class="row image-gallery-wrap">
                @if($data['photos'])
                    @foreach($data['photos'] as $key=>$photo)
                        @if($key==0)
                            <div class="col-lg-6">
                                <figure>
                                    <div class="image-gallery-item">
                                        <a href="{{asset("uploads/photo/$photo->photo")}}" data-fancybox="gallery"
                                           data-caption="{{$photo->description}}">
                                            <img src="{{asset("uploads/photo/$photo->photo")}}" class="img-fluid"
                                                 id="img-left" alt=""/>
                                            <div class="gallery-icon">
                                                <i class="icofont icofont-eye"></i>
                                            </div>
                                        </a>
                                    </div><!-- end gallery-item -->
                                </figure>
                            </div><!-- end col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="row">
                                    @else
                                        <div class="col-lg-6 col-6">
                                            <figure>
                                                <div class="image-gallery-item">
                                                    <a href="{{asset("uploads/photo/$photo->photo")}}"
                                                       data-fancybox="gallery"
                                                       data-caption="{{$photo->description}}">
                                                        <img src="{{asset("uploads/photo/$photo->photo")}}"
                                                             class="img-fluid img-right" alt=""/>
                                                        <div class="gallery-icon">
                                                            <i class="icofont icofont-eye"></i>
                                                        </div>
                                                    </a>
                                                </div><!-- end gallery-item -->
                                            </figure>
                                        </div><!-- end col-lg-3 -->
                                    @endif
                                    @endforeach
                                    @endif
                                </div><!-- end row -->
                            </div><!-- end container -->
                            <div class="col-md-12 mt-2">
                                <a href="{{route('photo.gallery')}}"
                                   class="theme-btn btn-sm">আরো দেখুন <i
                                        class="icofont icofont-long-arrow-right"></i></a>
                            </div>
            </div><!-- end container -->
        </div><!-- end container -->
    </section>--}}

    @if(!empty($data['gallery']['photos']))
        <section class="text-center">
            <div class="container">
                <div class="section-title">
                    <h2>ছবি সমূহ</h2>
                </div>
                <div class="glide" id="intro">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            @foreach($data['gallery']['photos'] as $photo)
                                <li class="glide__slide">
                                    <a href="{{asset("uploads/photo/$photo->photo")}}" data-fancybox="gallery"
                                       data-caption="{{$photo->description}}">
                                        <img src="{{asset("uploads/photo/$photo->photo")}}" class="img-fluid"
                                             id="img-left" alt=""/>
                                    </a>
                                    {{--<img src="https://durbar21.org/uploads/photo/LXEkpneIdnWiePmXnrPmCe.jpg" class="img-fluid"
                                         alt="">--}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <a href="{{route('photo.gallery')}}"
                       class="theme-btn btn-sm">আরো দেখুন <i
                            class="icofont icofont-long-arrow-right"></i></a>
                </div>
            </div>
        </section>
    @endif

    <section class="press section-bg" id="press">
        <div class="container">
            <div class="section-title aos-init aos-animate" data-aos="fadeIn">
                <h2>নিউজ</h2>
            </div>
            <div class="row">
                <div class="owl-carousel press-carousel" data-aos="fadeIn" data-aos-delay="200">

                    <div class="item">
                        <div class="single-press card h-100 border-0">
                            <div class="post-image">
                                <img src="{{asset("uploads/news/kaler.jpg")}}" alt="">
                            </div><!-- .post-image end -->
                            <div class="post-body card-body">
                                <div class="entry-header text-center">
                                    <h6 class="entry-title">
                                        <a class="text-dark"
                                           href="https://www.kalerkantho.com/online/info-tech/2020/09/08/953413"
                                           target="_blank">অনলাইনে গুজবের ভিড়ে সত্য জানতে ‘আসল চিনি’</a>
                                    </h6>
                                    <div class="entry-meta">
                                        <i class="icofont icofont-newspaper"></i> কালেরকন্ঠ
                                    </div>
                                </div>
                            </div><!-- .post-body end -->
                        </div><!-- .single-blog post end -->
                    </div>
                    <div class="item">
                        <div class="single-press card h-100 border-0">
                            <div class="post-image">
                                <img src="{{asset("uploads/news/bangla-tribune.jpg")}}" alt="">
                            </div><!-- .post-image end -->
                            <div class="post-body card-body">
                                <div class="entry-header text-center">
                                    <h6 class="entry-title">
                                        <a class="text-dark"
                                           href="https://www.banglatribune.com/tech-and-gadget/news/641287/%E0%A6%85%E0%A6%A8%E0%A6%B2%E0%A6%BE%E0%A6%87%E0%A6%A8%E0%A7%87-%E0%A6%AE%E0%A6%BF%E0%A6%A5%E0%A7%8D%E0%A6%AF%E0%A6%BE-%E0%A6%97%E0%A7%81%E0%A6%9C%E0%A6%AC%E0%A7%87%E0%A6%B0-%E0%A6%AD%E0%A6%BF%E0%A6%A1%E0%A6%BC%E0%A7%87-%E0%A6%B8%E0%A6%A4%E0%A7%8D%E0%A6%AF-%E0%A6%9C%E0%A6%BE%E0%A6%A8%E0%A6%A4%E0%A7%87-%E2%80%98%E0%A6%86%E0%A6%B8%E0%A6%B2-%E0%A6%9A%E0%A6%BF%E0%A6%A8%E0%A6%BF%E2%80%99"
                                           target="_blank">অনলাইনে মিথ্যা-গুজবের ভিড়ে সত্য জানতে ‘আসল চিনি’</a>
                                    </h6>
                                    <div class="entry-meta">
                                        <i class="icofont icofont-newspaper"></i> বাংলা ট্রিবিউন
                                    </div>
                                </div>
                            </div><!-- .post-body end -->
                        </div><!-- .single-blog post end -->
                    </div>

                    <div class="item">
                        <div class="single-press card h-100 border-0">
                            <div class="post-image">
                                <img src="{{asset("uploads/news/somoy.jpg")}}" alt="">
                            </div><!-- .post-image end -->
                            <div class="post-body card-body">
                                <div class="entry-header text-center">
                                    <h6 class="entry-title">
                                        <a class="text-dark" href="https://m.somoynews.tv/pages/details/234635"
                                           target="_blank">গুজবের ভিড়ে সত্য জানতে ‘আসল চিনি’ ক্যাম্পেইন</a>
                                    </h6>
                                    <div class="entry-meta">
                                        <i class="icofont icofont-newspaper"></i> সময় নিউজ
                                    </div>
                                </div>
                            </div><!-- .post-body end -->
                        </div><!-- .single-blog post end -->
                    </div>
                    <div class="item">
                        <div class="single-press card h-100 border-0">
                            <div class="post-image">
                                <img src="{{asset("uploads/news/prothom-alo.jpg")}}" alt="">
                            </div><!-- .post-image end -->
                            <div class="post-body card-body">
                                <div class="entry-header text-center">
                                    <h6 class="entry-title">
                                        <a class="text-dark"
                                           href="https://en.prothomalo.com/science-technology/govt-launches-campaign-to-make-people-aware-of-fake-info"
                                           target="_blank">Govt launches campaign to make people aware of fake info</a>
                                    </h6>
                                    <div class="entry-meta">
                                        <i class="icofont icofont-newspaper"></i> প্রথম আলো

                                    </div>
                                </div>
                            </div><!-- .post-body end -->
                        </div><!-- .single-blog post end -->
                    </div>

                    <div class="item">
                        <div class="single-press card h-100 border-0">
                            <div class="post-image">
                                <img src="{{asset("uploads/news/techsohor.jpg")}}" alt="">
                            </div><!-- .post-image end -->
                            <div class="post-body card-body">
                                <div class="entry-header text-center">
                                    <h6 class="entry-title">
                                        <a class="text-dark"
                                           href="https://techshohor.com/177953/%E0%A6%B8%E0%A6%9A%E0%A7%87%E0%A6%A4%E0%A6%A8%E0%A6%A4%E0%A6%BE-%E0%A6%AC%E0%A6%BE%E0%A7%9C%E0%A6%BE%E0%A6%A4%E0%A7%87-%E0%A6%A4%E0%A6%A5%E0%A7%8D%E0%A6%AF%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%AF%E0%A7%81/"
                                           target="_blank">সচেতনতা বাড়াতে তথ্যপ্রযুক্তি বিভাগের 'আসল চিনি'</a>
                                    </h6>
                                    <div class="entry-meta">
                                        <i class="icofont icofont-newspaper"></i> টেকশহর
                                    </div>
                                </div>
                            </div><!-- .post-body end -->
                        </div><!-- .single-blog post end -->
                    </div>

                </div>

            </div><!-- .row END -->
        </div>
    </section>



    <section class="">
        <div class="container">
            <div class="section-title">
                <h2>সাম্প্রতিক ভিডিও</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3 ">
                    <div class="card shadow-sm h-100">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/k0KIPE1oTDU?rel=0"
                                    title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <p class="card-text">অনলাইনে মিথ্যা আর গুজব চিনতে শুরু আসল চিনি</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 ">
                    <div class="card shadow-sm h-100">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TR6xXqKGlL4?rel=0"
                                    title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <p class="card-text">“যদি আমার খালার প্রাণের বিনিময়ে একটা সুন্দর দেশ পায় ক্ষতি কী”- নাসির
                                উদ্দিন টিটু</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 ">
                    <div class="card shadow-sm h-100">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/jK1hefOR6dY?rel=0"
                                    title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <p class="card-text">মিথ্যা, গুজব বন্ধ করতে আসল চিনি</p>
                        </div>
                    </div>

                </div>


            </div><!-- end row -->
        </div><!-- end container -->
    </section>


<!--<div id="event_popup_modal" class="modal fade">-->
<!--    <div class="modal-dialog" style="max-width:1000px; margin:0 auto;">-->
<!--        <div class="modal-content" style="margin-top: 75px;">-->
<!--            <span class="close" style="font-weight: normal; text-align: right; font-size: 18px;" data-dismiss="modal"><img src="https://www.startupbangladesh.gov.bd/front/img/cross-icon.png" width="30px" style="margin-top:10px; margin-right: 10px;margin-bottom: 5px;" /></span>-->
<!--            <a href="{{route('front.career-camp')}}">-->
<!--                <img src="{{asset("assets/img/banner/popup.jpg")}}" width="100%"  />-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

@stop
@section('script')
    <script src="{{asset("assets/js/glide.min.js")}}"></script>
@stop
@section('js')
    <script>
        var glide = new Glide('#intro', {
            type: 'carousel',
            perView: 2,
            focusAt: 'center',
            autoplay: 5000,
            breakpoints: {
                800: {
                    perView: 2
                },
                480: {
                    perView: 2
                }
            }
        })

        glide.mount()
    </script>
    <script>

        $(".press-carousel").owlCarousel({
            autoplay: true,
            dots: true,
            loop: true,
            margin: 15,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                900: {
                    items: 4
                }
            }
        });

        $('.countdown-list').each(function () {
            $('[data-countdown]').each(function () {
                let $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    let $this = $(this).html(event.strftime(''
                        + '<li class="timer-item days"><strong>%D</strong><small>days</small></li>'
                        + '<li class="timer-item hours"><strong>%H</strong><small>hours</small></li>'
                        + '<li class="timer-item mins"><strong>%M</strong><small>mins</small></li>'
                        + '<li class="timer-item seco"><strong>%S</strong><small>seco</small></li>'));
                });
            });

        });
    </script>
@stop
