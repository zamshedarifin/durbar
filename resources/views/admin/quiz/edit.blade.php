@extends('admin.layouts.app')
@section('title','Edit Quiz')

@section('css')
    <style>
        #cover{
            padding:4px .9rem;
        }
    </style>
@stop

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
                @endif
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form class="form-row" action="{{route('admin.edit.quiz',lock($quiz->id))}}" enctype="multipart/form-data" method="post">@csrf
                            <div class="form-group col-md-6">
                                <label for="title">Title<span class="text-danger">* [English]</span></label>
                                <input type="text" value="{{$quiz->title}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_bn">Title <span class="text-success">[বাংলা]</span></label>
                                <input type="text" value="{{$quiz->title_bn}}" name="title_bn" id="title_bn" class="form-control @error('title_bn') is-invalid @enderror">
                                @error('title_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="quiz_rules">Quiz Rules <span class="text-danger">[English]</span></label>
                                <textarea name="quiz_rules" rows="5" id="quiz_rules" class="form-control summernote  @error('quiz_rules') is-invalid @enderror">{{$quiz->rules}}</textarea>
                                @error('quiz_rules')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="quiz_rules_bn">Quiz Rules <span class="text-success">[বাংলা]</span></label>
                                <textarea name="quiz_rules_bn" rows="5" id="short_desc_bn" class="form-control summernote  @error('quiz_rules_bn') is-invalid @enderror">{{$quiz->rules_bn}}</textarea>
                                @error('quiz_rules_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="campaign">Campaign<span class="text-danger">*</span></label>
                                <select name="campaign" id="campaign"
                                        class="form-control @error('campaign') is-invalid @enderror">
                                    <option value="" disabled selected>Choose...</option>
                                    @if($campaigns)
                                        @foreach($campaigns as $campaign)
                                            <option value="{{$campaign->id}}" @if($quiz->campaign_id == $campaign->id) selected @endif>{{$campaign->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('campaign')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date">Quiz Start & End Date<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="date" autocomplete="off" placeholder="DD-MM-YYYY"
                                           value="{{old('date')}}" id="date"
                                           class="form-control input-daterange-timepicker  @error('date') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('date')
                                    <div class="invalid-feedback"><i
                                            class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="time">Time<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="tel" name="time" autocomplete="off"  value="{{$quiz->qz_time}}" id="time" class="form-control  @error('time') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Minutes</span>
                                    </div>
                                    @error('time')
                                    <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control  @error('status') is-invalid @enderror">
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="1" {{$quiz->status=='1'?'selected':''}}>Active</option>
                                    <option value="0" {{$quiz->status=='0'?'selected':''}}>Inactive</option>
                                    <option value="2" {{$quiz->status=='2'?'selected':''}}>Upcoming</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('admin.quiz.list')}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Quizzes</a>&nbsp;&nbsp;
                                <button class="btn btn-success btn-sm"><i class="fa fa-sync-alt"></i> UPDATE</button>
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
