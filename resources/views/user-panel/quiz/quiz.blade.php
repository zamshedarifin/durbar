{{--@extends('frontEnd.layouts.app')--}}
@extends('user-panel.layouts.app')
@section('title','কুইজ')

@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
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
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    <section class="quiz-area section-padding quiz-shade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="mb-3 text-center quiz-text f-24"> <i class='bx bx-merge'></i> {{$quiz->title}}</h4>
                    <div class="card bg-danger text-white">
                        <h6 class="text-white text-center mt-2 font-weight-bold" id="time"></h6>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="col-md-8 offset-md-2">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <br>

                <div class="col-md-8 card offset-md-2 p-3">
                    <form method="post" class="form-row" name="myform" action="{{route('front.quizGive')}}">@csrf
                        @if($question)
                            <div class="col-md-12 p-3 mt-1">
                                <input type="hidden" id="test" name="question_id" value="{{$question->id }}">
                                <input type="hidden" id="test" name="quiz" value="{{$quiz->id }}">
                                <label class="font-weight-bold" style="color: #2d317a">{{@count(session('question_id')) + 1 }}. {{$question->question}}</label>
                                <br>

                                <div class="col-sm-10 ml-3">
                                    <div class="radio">
                                        {{--                                            <input type="radio" class="ques" name="{{'radio_'.$name}}" value="{{$question->option_one}}" required>--}}
                                        <input type="radio" class="ques" name="answer" value="1" required>
                                        <span>{{$question->option_one}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-10 ml-3">
                                    <div class="radio">
                                        <input type="radio" class="ques" name="answer" value="2" required>
                                        <span>{{$question->option_two}}</span>
                                    </div>
                                </div>

                                <div class="col-sm-10 ml-3">
                                    <div class="radio">
                                        <input type="radio" class="ques" name="answer" value="3" required>
                                        <span>{{$question->option_three}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-10 ml-3">
                                    <div class="radio">
                                        <input type="radio" class="ques" name="answer" value="4" required>
                                        <span>{{$question->option_four}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12 d-flex justify-content-center mt-4">
                            @if(@count(Session('question_id')) == 19)
                                <button class="btn btn-sm font-weight-bold quiz-bg " id="btnSubmitOk" type="submit">
                                    <i class="fa fa-paper-plane"></i>  জমা দিন
                                </button>
                            @else
                                <button class="btn btn-sm font-weight-bold quiz-bg " id="btnSubmit" type="submit">
                                    Next <i class="fa fa-arrow-right"></i>
                                </button>
                            @endif
                        </div>

                    </form>
                </div>

                <div class="col-md-2">
                    {{--                    <div class="card bg-danger text-white">--}}
                    {{--                        <h6 class="text-white text-center mt-2 font-weight-bold" id="time"></h6>--}}
                    {{--                    </div>--}}
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
@section('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $("form").submit(function () {--}}
        {{--        @if(!$errors->any())--}}
        {{--        clearTimeout(interval);--}}
        {{--        localStorage.removeItem("end");--}}
        {{--        localStorage.clear();--}}
        {{--        @endif--}}
        {{--    });--}}
        {{--});--}}


        $(document).ready(function () {

            // $("form").submit(function () {
            $("#btnSubmitOk").click(function () {
                // alert('ok');
                @if(!$errors->any())
                clearTimeout(interval);
                localStorage.removeItem("end");
                localStorage.clear();
                @endif
            });
        });

        let minutesleft ={{$quiz->qz_time}};
        let secondsleft = 0;
        let end;
        if (localStorage.getItem("end")) {
            end = new Date(localStorage.getItem("end"));
        }
        else {
            end = new Date();
            end.setMinutes(end.getMinutes() + minutesleft);
            end.setSeconds(end.getSeconds() + secondsleft);
        }
        let counter = function () {
            let now = new Date();
            let diff = end - now;
            diff = new Date(diff);
            let sec = parseInt((diff / 1000) % 60)
            let mins = parseInt((diff / (1000 * 60)) % 60)

            if (mins < 10) {
                mins = "0" + mins;
            }
            if (sec < 10) {
                sec = "0" + sec;
            }
            if (now >= end) {
                clearTimeout(interval);
                // localStorage.setItem("end", null);
                localStorage.removeItem("end");
                localStorage.clear();
                document.myform.submit();
            } else {
                let value = mins + ":" + sec;
                localStorage.setItem("end", end);
                document.getElementById('time').innerHTML = 'TIME REMAINING ' + value;
            }
        }
        let interval = setInterval(counter, 1000);

        $(function() {
            $("button").attr("disabled", "disabled");
            setTimeout(function() {
                $("button").removeAttr("disabled");
            }, 10000);
        });
    </script>
@stop
