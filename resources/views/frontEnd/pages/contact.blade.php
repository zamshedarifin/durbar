@extends('frontEnd.layouts.app')
@section('title','যোগাযোগ')
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
                        <h2 class="breadcrumb__title">যোগাযোগ</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>যোগাযোগ</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <section class="contact section-padding bg-color">
        <div class="container">
            <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 d-flex align-items-stretch m-b">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>ঠিকানাঃ</h4>
                            <p>৩য় তলা
                                বাংলাদেশ কম্পিউটার কাউন্সিল
                                আইসিটি টাওয়ার
                                ই-১৪/এক্স, আগারগাঁও
                                শের-ই-বাংলা নগর
                                ঢাকা-১২০৭ </p>
                        </div>

                        <div class="email">
                            <i class="icofont-envelope"></i>
                            <h4>ই-মেইলঃ</h4>
                            <p>info@durbar21.org</p>
                        </div>

                        <div class="phone">
                            <i class="icofont-phone"></i>
                            <h4>ফোনঃ</h4>
                            <p>+৮৮০২৮১৮১৩৮১</p>
                        </div>

                         <iframe frameborder="0" style="border:0; width: 100%; height: 175px;" scrolling="no" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Bangladesh+Computer+Council,+Dhaka&amp;aq=&amp;sll=23.779356,90.374415&amp;sspn=0.011055,0.013797&amp;ie=UTF8&amp;hq=Bangladesh+Computer+Council,&amp;hnear=Dhaka,+Dhaka+Division,+Bangladesh&amp;ll=23.778818,90.374458&amp;spn=0.011055,0.013797&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=986101539219257989&amp;output=embed" width="425"></iframe>
                    </div>

                </div>


                <div class="col-lg-6 d-flex align-items-stretch">
                    <form action="{{route('front.contact')}}" method="post" role="form" class="php-email-form">@csrf
                        <h5 class="mb-3">যোগাযোগ করুন</h5>
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa fa-check-circle"></i> ধন্যবাদ !</strong> {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="name" placeholder="আপনার নাম লিখুন*" data-rule="minlen:4"
                                       data-msg="Please enter at least 4 chars">
                                @error('name')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                       name="email" id="email" placeholder="আপনার ই-মেইল ঠিকানা লিখুন*" data-rule="email"
                                       data-msg="Please enter a valid email">
                                @error('email')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control  @error('subject') is-invalid @enderror"
                                   name="subject" id="subject" placeholder="বিষয়*" data-rule="minlen:4"
                                   data-msg="Please enter at least 8 chars of subject">
                            @error('subject')
                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control  @error('message') is-invalid @enderror" name="message"
                                      rows="5" data-rule="required" data-msg="Please write something for us"
                                      placeholder="বার্তা*"></textarea>
                            @error('message')
                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="theme-btn btn-sm"><i class="icofont icofont-envelope"></i> বার্তা পাঠান</button>
                        </div>
                    </form>

                </div>

            </div>
        </div><!-- end container -->
    </section>



@stop
@section('js')

@stop
