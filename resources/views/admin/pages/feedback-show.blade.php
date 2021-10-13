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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Feedback Details<br>
                    <span class="font-14">Apply Date: {{date('j F,Y',strtotime($feedback->created_at))}}</span>
                </h5>

                <div class="card mb-3">
                    <div class="row no-gutters">

                        <div class="col-md-4 border-right border-left">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-user"></i> &nbsp; {{$feedback->name}}</h5>
                                     <strong><i class="fa fa-envelope"></i> &nbsp;</strong> {{$feedback->email}}<br><br>
                                     <strong>Subject:&nbsp;</strong> {{$feedback->subject}}<br>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <strong>Feedback:</strong> <br> {{$feedback->message}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mx-auto">
                <div class="col-md-12">
                    <a href="{{route('admin.feedback')}}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>  List</a>
                    <a href="{{route('admin.feedback.reply',lock($feedback->id))}}" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Reply</a>
                    <a href="{{route('admin.feedback.destroy',lock($feedback->id))}}" onclick="return confirm('are you want to sure delete this feedback?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

