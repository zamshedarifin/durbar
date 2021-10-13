@extends('frontEnd.layouts.app')
@section('title','বিস্তারিত')
@section('css')

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
                        <h2 class="breadcrumb__title">বিস্তারিত</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.event')}}">ইভেন্ট</a></li>
                            <li>বিস্তারিত</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="event-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card mb-0">
                        <img src="{{asset("uploads/event/$event->cover")}}" class="card-img-top" alt="" style="height: 350px;width: 463px;margin: auto;">
                        <div class="card-body">
                            <h5>{{$event->title}}</h5>
                            <p><i class="fa fa-calendar"></i> {{date('F j, Y',strtotime($event->event_date))}}</p>
                            @php echo $event->description @endphp
                        </div>
                    </div><!-- end card-item -->
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection
