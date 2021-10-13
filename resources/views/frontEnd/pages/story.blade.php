@extends('frontEnd.layouts.app')
@section('title',$campaign->title)
@section('css')
    <style>
        .story-content-wrap .card img {
            height: 180px !important;
            width: 100%;
            object-fit: cover;
        }


        @media only screen and (max-width: 479px) and (min-width: 320px) {

        }

        .text-break {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

/*Edited By Zamshed */
        button.selected{
          background:#ffa500;
          color:#fff;
        }
</style>
@stop
@section('content')
    ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">বিস্তারিত</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.campaign')}}">ক্যাম্পেইন</a></li>
                            <li>বিস্তারিত</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="campaign-section section-bg">
        <div class="container">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>ধন্যবাদ !</strong> {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>দুঃখিত !</strong> {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        {{--                        style="height: 450px;object-fit: cover;object-position: 10% 20%"--}}
                        <img src="{{asset("uploads/campaign/$campaign->cover")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> {{$campaign->title}}</h5>
                            <p class="text-dark" style="font-family: SolaimanLipi">{!! $campaign->description !!}</p>
                        </div>

                        @if($campaign->status == 1)
                            <div class="card-footer text-center bg-transparent border-0">
{{--                                @if(Auth::check())--}}
{{--                                    <a href="{{route('campaign.enroll',lock($campaign->id))}}" class="theme-btn btn-sm">অংশগ্রহণ--}}
{{--                                        করুন <i class="icofont icofont-long-arrow-right"></i></a>--}}
{{--                                @else--}}
{{--                                    <a href="{{route('login')}}" class="theme-btn btn-sm">অংশগ্রহণ করুন <i--}}
{{--                                            class="icofont icofont-long-arrow-right"></i></a>--}}
{{--                                @endif--}}
                                @if(count($quiz)>0)
                                    @if(Auth::check())
                                        @if(empty(Auth::user()->mobile) or empty(Auth::user()->address) or empty(Auth::user()->avatar))
                                        <a href="{{route('user.profile')}}{{--?campaign={{lock($campaign->title)}}--}}" class="theme-btn btn-sm quiz-bg">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                                        @else
                                        <a href="{{route('user.quiz')}}" class="theme-btn quiz-bg btn-sm">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                                        @endif
                                    @else
                                    <a href="{{route('login')}}" class="theme-btn quiz-bg btn-sm">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        </section>

       @if(count($campaign['competitions'])>0)
       <section class="event">
          <div class="event-wrapper">
             <div class="container">
                <div class="section-title">
                   <h2>প্রতিযোগিতা</h2>
                </div>
                <div class="row">
                   <div class="col-lg-12 text-center mb-4">
                      <div class="filter-div">
                         <button class="btn filter-button selected" data-filter="all" >সকল প্রতিযোগিতা</button>
                         @foreach($competitionDate as $comp)
                         <button class="btn filter-button" data-filter="{{date('M',strtotime($comp->start_date))}}">{{BnDate(date('F, Y',strtotime($comp->start_date)))}}</button>
                         @endforeach
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="event-content-wrapper">
             <div class="container">
                <div class="row">
                   @if($campaign['competitions'])
                   @foreach($campaign['competitions'] as $key=>$competition)
                       <div class="col-md-3 mb-3 filter {{date('M',strtotime($competition->start_date))}}">
                          <div class="each-item">
                             <div class="card shadow-sm h-100">
                                <img src="{{asset("uploads/competition/$competition->cover")}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                   <p class="card-text">
                                      <span class="float-left"><i class='text-primary bx bx-time'></i> {{BnDate(date('j F, Y',strtotime($competition->start_date)))}}</span>
                                      <span class="float-right"><i class='text-primary bx bx-current-location'></i> {{$competition->location}}</span>
                                   </p>
                                   <br>
                                   <h6 class="card-title">
                                      <a class="text-dark" href="{{route('front.competition-details',$competition->slug)}}"><strong>{{$competition->title_bn}}</strong></a>
                                   </h6>
                                   <p class="text-break">{!! strip_tags($competition->description)!!}</p>
                                   {{--                                    -->
                                   <p class="card-text">{!!Illuminate\Support\Str::limit(strip_tags($competition->description),500) !!}</p>-->
                                   --}}
                                </div>
                                <div class="card-footer bg-transparent">
                                   <a href="{{route('front.competition-details',$competition->slug)}}" class="card-link">বিস্তারিত
                                   পড়ুন <i class="icofont icofont-long-arrow-right"></i></a>
                                </div>
                             </div>
                          </div>
                       </div>
                   @endforeach
                   @endif
                </div>
             </div>
          </div>
       </section>
   @endif

    @if(count($campaign['stories'])>0)
    <section class="story-area section-bg">
        <div class="container">
            <div class="section-title">
                <h2>ক্যাম্পেইন স্টোরি</h2>
            </div>
            <div class="row story-content-wrap">

                    @foreach($campaign['stories'] as $key=>$story)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm h-100">
                                <img src="{{asset("uploads/story/$story->cover")}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title"><a class="text-dark"
                                                              href="{{route('front.story-details',$story->slug)}}"><strong>{{$story->title}}</strong></a>
                                    </h6>
                                    <p class="text-break">{!! strip_tags($story->description)!!}</p>
                                    {{--                                    <p class="card-text">{!!Illuminate\Support\Str::limit(strip_tags($story->description),500) !!}</p>--}}
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{route('front.story-details',$story->slug)}}" class="card-link">বিস্তারিত
                                        পড়ুন <i class="icofont icofont-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

            </div><!-- end row -->
            {{--<div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="pagination-wrap">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="la la-caret-left"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="la la-caret-right"></i></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- end pagination-wrap -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->--}}
        </div><!-- end container -->
    </section>
    @endif
@stop
@section('js')
    @if(Session::has('success') || Session::has('error'))
        <script>
            $('html, body').animate({
                scrollTop: $("#msg").offset().top + 310
            }, 2000);
        </script>

    @endif


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
