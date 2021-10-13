@extends('frontEnd.layouts.app')
@section('title','ড্যাশবোর্ড')

@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">ড্যাশবোর্ড</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>ড্যাশবোর্ড</li>
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
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="{{asset("frontEnd/images/pp.png")}}"
                             style="height: 120px;width: 100%;object-fit: contain" class="card-img-top mt-2" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{Auth::User()->name}}</h5>
                            <hr>
                            <p class="card-text"><i class="fa fa-envelope"></i> Email: {{Auth::user()->email}} <br>
                                <i class="fa fa-mobile"></i> Mobile:<br>
                                <i class="fa fa-map-marker"></i> Address:
                            </p>

                        </div>
                        <div class="card-footer bg-transparent">
                            Joined {{Auth::user()->created_at->diffForHumans()}}
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
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
                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title">চলমান কুইজ</h5>
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                {{$data['activeQuiz']->title}}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body row">
                                            <div class="col-md-8">
                                                {!! $data['activeQuiz']->rules !!}

                                                @if(!empty($mark))
                                                    <?php
                                                    $start_date = new DateTime($mark->start_time);
                                                    $since_start = $start_date->diff(new DateTime($mark->end_time));
                                                    ?>
                                                    <h5>ফলাফল</h5>
                                                    <hr>
                                                    নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}}
                                                    <br>
                                                    সময়ঃ {{EnToBn($since_start->i.' মিনিট '.$since_start->s. ' সেকেন্ড')}}
                                                @endif
                                                <div class="text-center mt-3">
                                                    <a href="{{route('front.quiz',lock($data['activeQuiz']->id))}}"
                                                       class="btn btn-primary btn-sm">পরীক্ষা দিন <i
                                                            class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 border-left">
                                                <h5 class="mb-1">লিডারবোর্ড</h5>
                                                @if($data['activeQuiz']['marks'])
                                                    @foreach($data['activeQuiz']['marks'] as $key=>$mark)
                                                        <?php
                                                        $start_date = new DateTime($mark->start_time);
                                                        $since_start = $start_date->diff(new DateTime($mark->end_time));
                                                        ?>

                                                        <div class="card mb-3 shadow-sm p-2 text-center">
                                                            <img src="{{asset("frontEnd/images/pp.png")}}"
                                                                 style="height: 65px;width: 65px; object-fit: contain"
                                                                 class="card-img-top mx-auto" alt="...">

                                                            <p>{{$mark['user']->name}}<br>
                                                                নম্বরঃ {{EnToBn($mark->mark.'/'.@count($data['activeQuiz']['questions']))}}
                                                                <br>
                                                                সময়ঃ {{EnToBn($since_start->i.' মিনিট '.$since_start->s. ' সেকেন্ড')}}
                                                            </p>
                                                        </div>
                                                        @if($key==2)
                                                        @break;
                                                            @endif
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h5 class="card-title">সমাপ্ত কুইজ সমূহ</h5>
                            <div class="accordion" id="accordionExample">
                                @if($data['quizzes'])
                                    @foreach($data['quizzes'] as $key=>$quiz)
                                        <div class="card">
                                            <div class="card-header" id="heading{{$key}}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{$key}}" aria-expanded="false"
                                                            aria-controls="collapse{{$key}}">
                                                        {{$quiz->title}}
                                                    </button>
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
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop
