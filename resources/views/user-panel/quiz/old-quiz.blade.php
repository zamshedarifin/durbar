{{--@extends('frontEnd.layouts.app')--}}
@extends('user-panel.layouts.app')
@section('title','কুইজ')

@section('content')
{{--    <!-- ================================--}}
{{--    START BREADCRUMB AREA--}}
{{--================================= -->--}}
{{--    <section class="breadcrumb-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="breadcrumb-content">--}}
{{--                                                <h2 class="breadcrumb__title">কুইজ “আমার মুজিব- শতবর্ষের শত প্রশ্ন”</h2>--}}
{{--                                                <ul class="breadcrumb__list">--}}
{{--                                                    <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>--}}
{{--                                                    <li>আমার মুজিব- শতবর্ষের শত প্রশ্ন</li>--}}
{{--                                                </ul>--}}
{{--                    </div><!-- end breadcrumb-content -->--}}
{{--                </div><!-- end col-lg-12 -->--}}
{{--            </div><!-- end row -->--}}
{{--        </div><!-- end container -->--}}
{{--    </section><!-- end hero-area -->--}}
{{--    <!-- ================================--}}
{{--        END BREADCRUMB AREA--}}
{{--    ================================= -->--}}

    <section class="quiz-area section-padding quiz-shade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-4 p-2">
                    <h2 class="theme-color text-center font-weight-bold quiz-text f-24 "> <i class='bx bx-merge'></i> {{$quiz->title}}</h2>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <br>
                <div class="col-md-8 card shadow-sm quiz-border p-4">
                    <form method="post" class="form-row" name="myform" action="{{route('front.quiz',lock($quiz->id))}}">@csrf
                        @if($quiz['questions'])
                            @foreach($quiz['questions'] as $key=>$question)
                                <div class="col-md-12 p-2 mt-1">
                                    <label class="theme-color font-weight-bold mb-2" style="color: #2d317a"> <i class='bx bx-merge'></i> {{EnToBn($key+1)}}. {{$question->question}}</label>
                                    <div class="col-sm-10 ml-3">
                                        <div class="radio">
                                            @if(1 == $question->answer)
                                                <span class="text-success"><i class='fa fa-check font-weight-bold'></i> {{$question->option_one}}</span>
                                            @else
                                                <span class="text-dark"><i class='fa fa-times font-weight-bold'></i> {{$question->option_one}}</span>
                                            @endif
                                        </div>
                                    </div>
                                 <div class="col-sm-10 ml-3">
                                        <div class="radio">
                                            @if(2 == $question->answer)
                                                <span class="text-success"><i class='fa fa-check font-weight-bold'></i> {{$question->option_two}}</span>
                                            @else
                                                <span class="text-dark"><i class='fa fa-times font-weight-bold'></i> {{$question->option_two}}</span>
                                            @endif
                                        </div>
                                    </div>
                                 <div class="col-sm-10 ml-3">
                                        <div class="radio">
                                            @if(3 == $question->answer)
                                                <span class="text-success"><i class='fa fa-check font-weight-bold'></i> {{$question->option_three}}</span>
                                            @else
                                                <span class="text-dark"><i class='fa fa-times font-weight-bold'></i> {{$question->option_three}}</span>
                                            @endif
                                        </div>
                                    </div>
                                 <div class="col-sm-10 ml-3">
                                        <div class="radio">
                                            @if(4 == $question->answer)
                                                <span class="text-success"><i class='fa fa-check font-weight-bold'></i> {{$question->option_four}}</span>
                                            @else
                                                <span class="text-dark"><i class='fa fa-times font-weight-bold'></i> {{$question->option_four}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif
    {{--                        <div class="col-sm-12 d-flex justify-content-center mt-4">--}}
    {{--                            <button class="theme-btn btn-sm" id="btnSubmit" type="submit"><i--}}
    {{--                                    class="fa fa-paper-plane"></i> জমা দিন--}}
    {{--                            </button>--}}
    {{--                        </div>--}}

    </form>
    </div>

{{--                <div class="col-md-3">--}}

{{--                    @if(!empty($data['activeQuiz']['marks']))--}}
{{--                    <h5 class="text-center text-white font-weight-bold quiz-bg p-2 rounded">এ পর্বের সেরা</h5>--}}
{{--                        @foreach($data['activeQuiz']['marks'] as $key=>$mark)--}}
{{--                            <?php--}}
{{--                            $start_date = new DateTime($mark->start_time);--}}
{{--                            $since_start = $start_date->diff(new DateTime($mark->end_time));--}}
{{--                            $time=(($mark->seconds) / 60);--}}
{{--                            ?>--}}
{{--                            <div class="card mb-2 shadow-sm p-2 text-center quiz-border">--}}
{{--                                @if(!empty($mark['user']['avatar']))--}}
{{--                                    <img src="{{asset($mark['user']['avatar'])}}" style="height: 65px;width: 65px; object-fit: contain" class="card-img-top mx-auto" alt="...">--}}
{{--                                @else--}}
{{--                                    <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle mx-auto"  style="height: 65px;width: 65px; object-fit: contain" >--}}
{{--                                @endif--}}

{{--                                    <p class="quiz-text">@if($key+1 == 1) ১ম বিজয়ী @endif @if($key+1 == 2) ২য় বিজয়ী @endif @if($key+1 == 3) ৩য় বিজয়ী @endif  </p>--}}
{{--                                    <p class="font-weight-bold">ইমেইল: {{$mark['user']['email']}} <br> কুইজ প্রদান: {{date('D m Y', strtotime($mark->start_time))}} </p>--}}


{{--                                    --}}{{--                                @if(!empty($mark['user']['name'])) <p>{{$mark['user']['name']}}<br> @endif--}}
{{--                                    নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}}--}}
{{--                                    <br>--}}

{{--                                    --}}{{----}}{{--  সময়ঃ {{EnToBn($since_start->i.' মিনিট '.$mark->seconds. ' সেকেন্ড')}}--}}
{{--                                    @if($mark->seconds > 59)--}}
{{--                                        সময়ঃ {{EnToBn(round($time,2).' '.'মিনিট')}}--}}
{{--                                    @else--}}
{{--                                        সময়ঃ {{EnToBn($mark->seconds.' '. 'সেকেন্ড')}}--}}
{{--                                    @endif--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            @if($key==2)--}}
{{--                                @break;--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}

    </div><!-- end row -->
    </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $("form").submit(function () {--}}
{{--                @if(!$errors->any())--}}
{{--                clearTimeout(interval);--}}
{{--                localStorage.removeItem("end");--}}
{{--                localStorage.clear();--}}
{{--                @endif--}}
{{--            });--}}
{{--        });--}}
{{--        let minutesleft = {{$quiz->qz_time}};--}}
{{--        let secondsleft = 0;--}}
{{--        let end;--}}
{{--        if (localStorage.getItem("end")) {--}}
{{--            end = new Date(localStorage.getItem("end"));--}}
{{--        } else {--}}
{{--            end = new Date();--}}
{{--            end.setMinutes(end.getMinutes() + minutesleft);--}}
{{--            end.setSeconds(end.getSeconds() + secondsleft);--}}
{{--        }--}}
{{--        let counter = function () {--}}
{{--            let now = new Date();--}}
{{--            let diff = end - now;--}}
{{--            diff = new Date(diff);--}}
{{--            let sec = parseInt((diff / 1000) % 60)--}}
{{--            let mins = parseInt((diff / (1000 * 60)) % 60)--}}

{{--            if (mins < 10) {--}}
{{--                mins = "0" + mins;--}}
{{--            }--}}
{{--            if (sec < 10) {--}}
{{--                sec = "0" + sec;--}}
{{--            }--}}
{{--            if (now >= end) {--}}
{{--                clearTimeout(interval);--}}
{{--                // localStorage.setItem("end", null);--}}
{{--                localStorage.removeItem("end");--}}
{{--                localStorage.clear();--}}
{{--                document.myform.submit();--}}
{{--            } else {--}}
{{--                let value = mins + ":" + sec;--}}
{{--                localStorage.setItem("end", end);--}}
{{--                document.getElementById('time').innerHTML = 'TIME REMAINING# ' + value;--}}
{{--            }--}}
{{--        }--}}
{{--        let interval = setInterval(counter, 1000);--}}
{{--    </script>--}}
{{--@stop--}}
<?php
/*
if(!isset($_SESSION['js'])||$_SESSION['js']==""){
    echo "<noscript><meta http-equiv='refresh' content='0;url=/get-javascript-status.php&js=0'> </noscript>";
    $js = true;

}elseif(isset($_SESSION['js'])&& $_SESSION['js']=="0"){
    $js = false;
    $_SESSION['js']="";

}elseif(isset($_SESSION['js'])&& $_SESSION['js']=="1"){
    $js = true;
    $_SESSION['js']="";
}

if ($js) {
    echo 'Javascript is enabled';
} else {
    echo 'Javascript is disabled';
}

*/?>
