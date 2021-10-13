@extends('frontEnd.layouts.app')
@section('title','ড্যাশবোর্ড')
@section('meta')
    <meta property="og:title" content="{{$data['result']->quiz->title}}"/>
    <meta property="og:image" content="{{asset($user->avatar)}}"/>
@stop
@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">{{ $data['result']->quiz->title}}</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>{{ $data['result']->quiz->title}}</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <?php
    $time=(($data['result']->seconds) / 60);
    ?>
    <section class="quiz-area section-padding quiz-shade">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-3 mx-auto">
                    <div class="card p-4 quiz-border">
                        <p class="mt-2 text-center font-weight-bold f-24"> দূর্বার <span class="quiz-text font-weight-bold"> “আমার মুজিব” </span> কুইজ প্রতিযোগীতা </p>
                        @if(asset($user->avatar) != null)
                            <img src="{{asset($user->avatar)}}"  class="src card-image mx-auto shadow-sm mt-1 p-2" style="height: 120px; width: 120px">
                        @elseif($user->avatar)
                            <img src="{{$user->avatar}}"  class="src card-image mx-auto shadow-sm mt-1 p-2" style="height: 120px; width: 120px">
                        @else
                            <img src="{{asset('public/admin/images/users/pp.png')}}"  class="src card-image mx-auto shadow-sm mt-1 p-2" style="height: 120px; width: 120px">
                        @endif
                        <span class="p-1 font-18 mt-2 font-weight-bold"><i class="bx bx-user"></i> নামঃ {{$data['result']->user->name}} </span>
{{--                        <span class="p-1 font-18 font-weight-bold"><i class="bx bx-clipboard"></i> নম্বরঃ {{EnToBn($data['result']->mark.'/'.@count($data['activeQuiz']['questions']))}} </span>--}}
                       @if($data['result']->seconds > 59)
                            <span class="p-1 font-18 text-danger font-weight-bold mb-3"><i class="bx bx-time"></i> সময়ঃ {{EnToBn(round($time,2). 'মিনিট')}}</span>
                        @else
                            <span class="p-1 font-18 text-danger font-weight-bold mb-3"><i class="bx bx-time"></i> সময়ঃ {{EnToBn($data['result']->seconds. ' '.'সেকেন্ড')}} </span>
                        @endif
                        <p class="mt-2 text-center"> দূর্বার <span class="quiz-text font-weight-bold">{{ $data['result']->quiz->title}} </span> কুইজে অংশগ্রহন করার জন্য <span class="text-dark font-weight-bold"> “{{$data['result']->user->name}}” </span> কে আন্তরিক ধন্যবাদ। </p>
                        <p class="mt-2 text-center font-weight-bold text-danger"> ফলাফল ও পরবর্তী কার্যক্রম জানার জন্য চোখ রাখুন দুর্বার এর ফেইসবুক পেইজে।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
