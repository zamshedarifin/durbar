{{--@extends('frontEnd.layouts.app')--}}
@extends('user-panel.layouts.app')
@section('title','ড্যাশবোর্ড')

@section('content')

{{--    --}}
{{--    <section class="breadcrumb-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="breadcrumb-content">--}}
{{--                        <h2 class="breadcrumb__title">কুইজ “আমার মুজিব- শতবর্ষের শত প্রশ্ন”</h2>--}}
{{--                        <ul class="breadcrumb__list">--}}
{{--                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>--}}
{{--                            <li>আমার মুজিব- শতবর্ষের শত প্রশ্ন</li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- end breadcrumb-content -->--}}
{{--                </div><!-- end col-lg-12 -->--}}
{{--            </div><!-- end row -->--}}
{{--        </div><!-- end container -->--}}
{{--    </section><!-- end hero-area -->--}}


    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    <section class="quiz-area section-padding quiz-shade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mx-auto mb-0">
                    <h2 class="text-center font-weight-bold">কুইজ “আমার মুজিব- শতবর্ষের শত প্রশ্ন”</h2>
                </div>


                <div class="col-md-9 mt-3">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>দুঃখিত!</strong> {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>ধন্যবাদ!</strong> {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card quiz-border shadow-sm">
                        <div class="card-body ">
                            @if(@count($data['activeQuiz'])>0)
                            <h5 class="card-title theme-color font-weight-bold quiz-text"><i class='fa fa-book-reader'></i> কুইজ “আমার মুজিব- শতবর্ষের শত প্রশ্ন”</h5>
                            
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header p-0" id="headingOne">
                                        <h2 class="mb-0 m-0 p-1">
                                            <button class="btn btn-link text-dark text-decoration-none" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                {{$data['activeQuiz']->title}}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body">
                                            {!! $data['activeQuiz']->rules !!}

                                            @if(!empty($mark))
                                                <?php
                                                $start_date = new DateTime($mark->start_time);
                                                $since_start = $start_date->diff(new DateTime($mark->end_time));
                                                $time=(($mark->seconds) / 60);
                                                ?>
                                                <h6 class="theme-color font-weight-bold f-22 quiz-text"><i class="fa fa-book-open"></i> ফলাফল</h6>
                                                <hr>
{{--                                                    <span class="bg bg-success text-white p-2 mb-1 rounded font-weight-bold">নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}} </span>--}}

{{--                                                    সময়ঃ {{EnToBn(round($time,2).' '. 'মিনিট')}}--}}
                                                    @if($mark->seconds > 59)
                                                        <span class="bg bg-danger text-white p-2 mt-2 rounded font-weight-bold ml-3 btn-sm">  সময়ঃ {{EnToBn(round($time,2). 'মিনিট')}}</span>
                                                    @else
                                                        <span class="bg bg-danger text-white p-2 mt-2 rounded font-weight-bold ml-3 btn-sm">  সময়ঃ {{EnToBn($mark->seconds. ' '.'সেকেন্ড')}} </span>
                                                    @endif
                                                    <div class="btn-group dropup">
                                                        <button type="button" class="btn btn-primary dropdown-toggle ml-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class='fa fa-share-alt' ></i> Share
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a target="_blank"
                                                               href="http://www.facebook.com/sharer.php?u={{route('share.result',lock($data['activeQuiz']->id.'-'.Auth::id()))}}"
{{--                                                               href="{{route('share.result',lock($data['activeQuiz']->id.'-'.Auth::id()))}}"--}}
                                                               class="facebook dropdown-item"><i class="fab fa-facebook"></i> Facebook</a>
                                                            <a target="_blank"
                                                               href="https://twitter.com/intent/tweet?original_referer={{route('share.result',lock($data['activeQuiz']->id.'-'.Auth::id()))}}"
                                                               class="twitter dropdown-item"><i class="fab fa-twitter"></i> Twitter</a>
                                                            <a target="_blank"
                                                               href="https://www.linkedin.com/sharing/share-offsite/?url={{route('share.result',lock($data['activeQuiz']->id.'-'.Auth::id()))}}"
                                                               class="linkdin dropdown-item"><i class="fab fa-linkedin"></i> Linkedin</a>
                                                        </div>
                                                    </div>
                                            @endif
                                            @if(empty($mark->user_id))
                                                @if($data['activeQuiz']->status == 1)
                                                <div class="text-center mt-3">
                                                    <a href="{{route('front.quiz',lock($data['activeQuiz']->id))}}"
                                                       class="btn btn-sm font-weight-bold quiz-bg">পরীক্ষা দিন <i
                                                            class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endif
{{--                            <hr>--}}
                            @if(@count($data['quizzes'])>0)
                            <h5 class="card-title theme-color font-weight-bold mt-4 mb-3 quiz-text"><i class='fa fa-book-reader'></i> সমাপ্ত কুইজ সমূহ</h5>
                            <div class="accordion" id="accordionExample">
                                    @foreach($data['quizzes'] as $key=>$quiz)
                                        <div class="card mt-2">
                                            <div class="card-header p-0" id="heading{{$key}}">
                                                <h2 class="mb-1 m-0 p-1">
                                                    <button class="btn btn-link collapsed text-dark text-decoration-none" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{$key}}" aria-expanded="false"
                                                            aria-controls="collapse{{$key}}">
                                                        {{$quiz->title}}
                                                    </button>

                                                    <a href="{{route('previous.quiz',lock($quiz->id))}}" class="btn btn-sm theme-btn  text-white font-weight-bold quiz-bg"><i class="fa fa-eye"></i>&nbsp; প্রশ্ন দেখুন  </a>
                                                </h2>
                                            </div>
                                            <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    {!! $quiz->rules !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
{{--                @if(@count($data['activeQuiz'])>0)--}}
{{--                <div class="col-md-3">--}}
{{--                    <h5 class="mt-3 text-center text-white font-weight-bold quiz-bg p-2 rounded">লিডার বোর্ড</h5>--}}
{{--                    @if($data['activeQuiz']['marks'])--}}
{{--                        @foreach($data['activeQuiz']['marks'] as $key=>$mark)--}}
{{--                            <?php--}}
{{--                            $start_date = new DateTime($mark->start_time);--}}
{{--                            $since_start = $start_date->diff(new DateTime($mark->end_time));--}}
{{--                            $time=(($mark->seconds) / 60);--}}
{{--                            ?>--}}
{{--                            <div class="card mb-2 shadow-sm p-2 text-center quiz-border">--}}
{{--                                @if(!empty($mark['user']['avatar']))--}}
{{--                                <img src="{{asset($mark['user']['avatar'])}}" style="height: 65px;width: 65px; object-fit: contain" class="card-img-top mx-auto" alt="...">--}}
{{--                                @else--}}
{{--                                    <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle mx-auto"  style="height: 65px;width: 65px; object-fit: contain" >--}}
{{--                                @endif--}}
{{--                                    <p class="quiz-text">@if($key+1 == 1) ১ম বিজয়ী @endif @if($key+1 == 2) ২য় বিজয়ী @endif @if($key+1 == 3) ৩য় বিজয়ী @endif  </p>--}}
{{--                                    <p class="font-weight-bold">ইমেইল: {{$mark['user']['email']}}  <br> কুইজ প্রদান: {{date('D m Y', strtotime($mark->start_time))}} </p>--}}


{{--                                        @if(!empty($mark['user']['name'])) <p>{{$mark['user']['name']}}<br> @endif--}}
{{--                                        নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}}--}}
{{--                                        <br>--}}
{{--                                        @if($mark->seconds > 59)--}}
{{--                                            সময়ঃ {{EnToBn(round($time,2).' '.'মিনিট')}}--}}
{{--                                        @else--}}
{{--                                        সময়ঃ {{EnToBn($mark->seconds.' '. 'সেকেন্ড')}}--}}
{{--                                        @endif</p>--}}
{{--                            </div>--}}
{{--                            @if($key==2)--}}
{{--                                @break;--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                @else--}}
{{--                <div class="col-md-3">--}}
{{--                    <h5 class="mt-3 text-center text-white font-weight-bold quiz-bg p-2 rounded">গত পর্বের সেরা</h5>--}}
{{--                    @if($data['end_Quiz']['marks'])--}}
{{--                        @foreach($data['end_Quiz']['marks'] as $key=>$mark)--}}
{{--                            <?php--}}
{{--                            $start_date = new DateTime($mark->start_time);--}}
{{--                            $since_start = $start_date->diff(new DateTime($mark->end_time));--}}
{{--                            $time=(($mark->seconds) / 60);--}}
{{--                            ?>--}}
{{--                            <div class="card mb-2 shadow-sm p-2 text-center quiz-border">--}}
{{--                                @if(!empty($mark['user']['avatar']))--}}
{{--                                <img src="{{asset($mark['user']['avatar'])}}" style="height: 65px;width: 65px; object-fit: contain" class="card-img-top mx-auto" alt="...">--}}
{{--                                @else--}}
{{--                                    <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle mx-auto"  style="height: 65px;width: 65px; object-fit: contain" >--}}
{{--                                @endif--}}
{{--                                    <p class="quiz-text">@if($key+1 == 1) ১ম বিজয়ী @endif @if($key+1 == 2) ২য় বিজয়ী @endif @if($key+1 == 3) ৩য় বিজয়ী @endif  </p>--}}
{{--                                    <p class="font-weight-bold">ইমেইল: {{$mark['user']['email']}}  <br> কুইজ প্রদান: {{date('D m Y', strtotime($mark->start_time))}} </p>--}}


{{--                                        @if(!empty($mark['user']['name'])) <p>{{$mark['user']['name']}}<br> @endif--}}
{{--                                        নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}}--}}
{{--                                        <br>--}}
{{--                                        @if($mark->seconds > 59)--}}
{{--                                            সময়ঃ {{EnToBn(round($time,2).' '.'মিনিট')}}--}}
{{--                                        @else--}}
{{--                                        সময়ঃ {{EnToBn($mark->seconds.' '. 'সেকেন্ড')}}--}}
{{--                                        @endif</p>--}}
{{--                            </div>--}}
{{--                            @if($key==2)--}}
{{--                                @break;--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                @endif--}}
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
