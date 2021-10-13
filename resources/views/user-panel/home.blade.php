@extends('user-panel.layouts.app')
@section('title','Dashboard')
@section('content')

    @if(!empty($quiz))
    <div class="container-fluid">
        <!-- end row -->
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto card p-3">
            <div class="card-title quiz-bg p-4 rounded text-white text-center font-weight-bold f-22">{{$quiz->title}}</div>
            <div class="card-body">
                {!! $quiz->rules !!}
            </div>

            @if($quiz->status == 1)
            <div class="col-md-12 text-center p-2">
                @if(Auth::check())
                    @if(empty(Auth::user()->mobile) or empty(Auth::user()->address) or empty(Auth::user()->avatar))
                        <a href="{{route('user.profile')}}?campaign={{lock($campaign->title)}}" class="text-white btn-sm quiz-bg">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                    @else
                        <a href="{{route('user.quiz')}}" class="quiz-bg text-white font-weight-bold  btn-sm">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                    @endif
                @else
                    <a href="{{route('login')}}" class="quiz-bg text-white font-weight-bold  btn-sm">অংশগ্রহণ করুন <i class="icofont icofont-long-arrow-right"></i></a>
                @endif
            </div>
            @endif


        </div>
    </div>
</div>

    {{-- <div class="row">
         <div class="col-12">
             <div>
                 <div class="card-box widget-inline">
                     <div class="row">
                         <div class="col-xl-3 col-sm-6 widget-inline-box">
                             <div class="text-center p-3">
                                 <h2 class="mt-2"><i
                                         class="text-primary mdi mdi-access-point-network mr-2"></i>
                                     <b>8954</b></h2>
                                 <p class="text-muted mb-0">Lifetime total sales</p>
                             </div>
                         </div>

                         <div class="col-xl-3 col-sm-6 widget-inline-box">
                             <div class="text-center p-3">
                                 <h2 class="mt-2"><i class="text-teal mdi mdi-airplay mr-2"></i> <b>7841</b>
                                 </h2>
                                 <p class="text-muted mb-0">Income amounts</p>
                             </div>
                         </div>

                         <div class="col-xl-3 col-sm-6 widget-inline-box">
                             <div class="text-center p-3">
                                 <h2 class="mt-2"><i class="text-info mdi mdi-black-mesa mr-2"></i>
                                     <b>6521</b></h2>
                                 <p class="text-muted mb-0">Total users</p>
                             </div>
                         </div>

                         <div class="col-xl-3 col-sm-6">
                             <div class="text-center p-3">
                                 <h2 class="mt-2"><i class="text-danger mdi mdi-cellphone-link mr-2"></i> <b>325</b>
                                 </h2>
                                 <p class="text-muted mb-0">Total visits</p>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>--}}
    <!--end row -->
    {{-- <div class="row">
         <div class="col-sm-12">
             <div class="card-box">
                 <h5 class="mt-0 font-14 mb-3">Contacts</h5>
                 <div class="table-responsive">
                     <table class="table table-hover mails m-0 table table-actions-bar table-centered">
                         <thead>
                         <tr>
                             <th style="min-width: 95px;">

                                 <div class="checkbox checkbox-single checkbox-primary">
                                     <input type="checkbox" class="custom-control-input"
                                            id="action-checkbox">
                                     <label class="custom-control-label" for="action-checkbox">&nbsp;</label>
                                 </div>
                             </th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Products</th>
                             <th>Start Date</th>
                         </tr>
                         </thead>

                         <tbody>
                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox2" type="checkbox">
                                     <label for="checkbox2"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-2.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Tomaslau
                             </td>

                             <td>
                                 <a href="#" class="text-muted">tomaslau@dummy.com</a>
                             </td>

                             <td>
                                 <b><a href="" class="text-dark"><b>356</b></a>
                                 </b>
                             </td>

                             <td>
                                 01/11/2003
                             </td>

                         </tr>

                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox1" type="checkbox">
                                     <label for="checkbox1"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-1.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Chadengle
                             </td>

                             <td>
                                 <a href="#" class="text-muted">chadengle@dummy.com</a>
                             </td>

                             <td>
                                 <b><a href="" class="text-dark"><b>568</b></a>
                                 </b>
                             </td>

                             <td>
                                 01/11/2003
                             </td>

                         </tr>

                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox3" type="checkbox">
                                     <label for="checkbox3"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-3.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Stillnotdavid
                             </td>

                             <td>
                                 <a href="#" class="text-muted">stillnotdavid@dummy.com</a>
                             </td>
                             <td>
                                 <b><a href="" class="text-dark"><b>201</b></a>
                                 </b>
                             </td>

                             <td>
                                 12/11/2003
                             </td>

                         </tr>

                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox4" type="checkbox">
                                     <label for="checkbox4"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-4.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Kurafire
                             </td>

                             <td>
                                 <a href="#" class="text-muted">kurafire@dummy.com</a>
                             </td>

                             <td>
                                 <b><a href="" class="text-dark"><b>56</b></a>
                                 </b>
                             </td>

                             <td>
                                 14/11/2003
                             </td>

                         </tr>

                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox5" type="checkbox">
                                     <label for="checkbox5"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-5.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Shahedk
                             </td>

                             <td>
                                 <a href="#" class="text-muted">shahedk@dummy.com</a>
                             </td>

                             <td>
                                 <b><a href="" class="text-dark"><b>356</b></a>
                                 </b>
                             </td>

                             <td>
                                 20/11/2003
                             </td>

                         </tr>

                         <tr>
                             <td>
                                 <div class="checkbox checkbox-primary mr-2 float-left">
                                     <input id="checkbox6" type="checkbox">
                                     <label for="checkbox6"></label>
                                 </div>

                                 <img src="{{asset("admin")}}/images/users/avatar-6.jpg" alt="contact-img"
                                      title="contact-img" class="rounded-circle avatar-sm"/>
                             </td>

                             <td>
                                 Adhamdannaway
                             </td>

                             <td>
                                 <a href="#" class="text-muted">adhamdannaway@dummy.com</a>
                             </td>

                             <td>
                                 <b><a href="" class="text-dark"><b>956</b></a>
                                 </b>
                             </td>

                             <td>
                                 24/11/2003
                             </td>

                         </tr>

                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>--}}
    <!-- end row -->
@endif
    </div>
@stop
