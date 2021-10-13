@extends('frontEnd.layouts.app')
@section('title','কুইজ')

@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">কুইজ</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>কুইজ</li>
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
    <section class="quiz-area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h4>{{$quiz->title}}</h4>
                    <h6 class="text-danger text-center mt-2" id="time"></h6>
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
                <div class="col-md-8">
                    <hr>
                    <form method="post" class="form-row" name="myform" action="{{route('front.quiz',lock($quiz->id))}}">@csrf
                        @if($quiz['questions'])
                            @foreach($quiz['questions'] as $key=>$question)
                                <div class="col-md-6">
                                    <label class="text-primary">{{EnToBn($key+1)}}. {{$question->question}}</label>
                                    <br>
                                    @foreach($question['answers'] as $option)
                                        <div class="col-sm-12">
                                            <div class="radio">
                                                <input type="radio" class="ques"
                                                       name="ans[{{$key+1}}]"
                                                       value="{{lock($option->id)}}">
                                                <span>{{$option->option}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @endforeach
                        @endif
                        <div class="col-sm-12 d-flex justify-content-center mt-4">
                            <button class="theme-btn btn-sm" id="btnSubmit" type="submit"><i
                                    class="fa fa-paper-plane"></i> জমা দিন
                            </button>
                        </div>

                    </form>
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
        $(document).ready(function () {
            $("form").submit(function () {
                @if(!$errors->any())
                clearTimeout(interval);
                localStorage.removeItem("end");
                localStorage.clear();
                @endif
            });
        });
        let minutesleft = {{$quiz->qz_time}};
        let secondsleft = 0;
        let end;
        if (localStorage.getItem("end")) {
            end = new Date(localStorage.getItem("end"));
        } else {
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
                document.getElementById('time').innerHTML = 'TIME REMAINING# ' + value;
            }
        }
        let interval = setInterval(counter, 1000);
    </script>
@stop
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
