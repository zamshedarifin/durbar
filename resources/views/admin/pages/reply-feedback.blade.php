@extends('admin.layouts.app')
@section('title','Feedback')
@section('content')

    <div class="container-fluid">

        <!-- start  -->
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3">Edit Quiz</h4>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($message = Session::get('success'))
                    <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>

                @elseif($message = Session::get('danger'))
                    <div class="alert alert-icon alert-danger text-dark alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-close-box-outline mr-1"></i>
                        <strong>Danger!</strong> {{$message}}
                    </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form class="form-row" action="#" enctype="multipart/form-data" method="post">@csrf

                            <div class="input-group mb-2 col-md-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text font-weight-bold">User</div>
                                </div>
                                <input type="text" name="name" class="form-control" value="{{$feedback->name}}" id="inlineFormInputGroupUsername2" >
                            </div>

                            <div class="input-group mb-2 col-md-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text font-weight-bold">Email</div>
                                </div>
                                <input type="text" name="email" class="form-control" value="{{$feedback->email}}" id="inlineFormInputGroupUsername2" >
                            </div>

                            <div class="input-group mb-2 col-md-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text font-weight-bold">Subject</div>
                                </div>
                                <input type="text" name="subject" class="form-control" value="{{$feedback->subject}}" id="inlineFormInputGroupUsername2" >
                            </div>

                            <div class="form-group col-md-12 mt-3">
                                <label for="message">Message<span class="text-success">[বাংলা]</span></label>
                                <textarea name="message" rows="5" id="short_desc_bn" class="form-control summernote">{{$feedback->message}}</textarea>

                            </div>

                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('admin.feedback')}}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-list"></i>  Back</a>
                                <button class="btn btn-success btn-sm"><i class="fa fa-reply"></i> UPDATE</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <!-- end -->

        </div>
        <!-- end row -->
    </div>
@stop


@section('js')
    <script>
        $('.summernote').summernote({
            height: "200px",
        });
    </script>
@stop

