@extends('admin.layouts.app')
@section('title','Application Details')
@section('css')
    <style>
        .form-control {
            border: unset !important;
        }
    </style>
@stop

@section('content')
    <?php
    $time=(($careerCamp->seconds) / 60);
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>

                @endif
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Career Camp Application Details<br>
                    <span class="font-14">Apply Date: {{date('j F,Y',strtotime($careerCamp->created_at))}}</span>
                </h5>

                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-3 align-self-center text-center">

                            @if($careerCamp->gender == 'male')

                                @if($careerCamp->age == '18 to 24 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/1.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='25 to 34 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/2.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='35 to 44 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/3.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='45 to Above')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/4.png')}}" class="card-img mx-auto" alt="...">
                                @endif

                            @else
                                @if($careerCamp->age == '18 to 24 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_1.jpg')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='25 to 34 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_2.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='35 to 44 Years')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_3.png')}}" class="card-img mx-auto" alt="...">
                                @elseif($careerCamp->age =='45 to Above')
                                    <img style="height: 200px;  width: 200px; border-radius: 100%; object-fit: cover; object-position: top"
                                         src="{{asset('admin/images/avatar/fe_4.png')}}" class="card-img mx-auto" alt="...">
                                @endif
                            @endif

                        </div>
                        <div class="col-md-5 border-right border-left">
                            <div class="card-body">
                                <h5 class="card-title">{{$careerCamp->name}}</h5>
                                <p class="card-text p-2"><strong>Gender:</strong> {{ucfirst($careerCamp->gender)}}<br>
                                    <strong>Age:</strong> {{ucfirst($careerCamp->age)}}<br>
                                    <strong>Profession:</strong> {{ucfirst($careerCamp->profession)}}<br>
                                    <strong>Cell Phone:</strong> {{$careerCamp->cell_phone}}<br>
                                    <strong>Email:</strong> {{strtolower($careerCamp->email)}}<br>
                                    <strong>FB Link:</strong> <a href="{{addHttp($careerCamp->fb_profile_link)}}"
                                                                 target="_blank">{{addHttp($careerCamp->fb_profile_link)}}</a><br>
                                    <strong>Address:</strong>{{$careerCamp->address}}

                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-body">
                                <h5 class="card-title">Result</h5>
                                <p class="card-text font-weight-bold  text-success">নম্বরঃ  {{$careerCamp->mark}}</p>
                                <p class="card-text font-weight-bold text-danger">
                                    @if($careerCamp->seconds > 59)
                                        সময়ঃ {{EnToBn(round($time,2).' '.'মিনিট')}}
                                    @else
                                        সময়ঃ {{EnToBn($careerCamp->seconds.' '. 'সেকেন্ড')}}
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                    <div class="col-md-4 offset-md-4 mt-3 text-center">
                            <a href="{{route('admin.careercamp.list')}}" class="btn btn-sm btn-dark"><i class="fa fa-list"></i> Back</a>

                    </div>


            </div>
        </div>
        <!-- end row -->
    </div>
@stop

