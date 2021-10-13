@extends('admin.layouts.app')
@section('title','Edit Event')

@section('css')
    <style>
        #thumbnail {
            padding: 4px .9rem;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">

        <!-- start  -->
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3 text-uppercase">Edit Event</h4>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-9">
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
                        <form class="form-row" action="{{route('admin.edit.event',lock($event->id))}}"
                              enctype="multipart/form-data" method="post">@csrf
                            <div class="form-group col-md-6">
                                <label for="title">Title<span class="text-danger">* [English]</span></label>
                                <input type="text" value="{{$event->title}}" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_bn">Title <span class="text-success">[বাংলা]</span></label>
                                <input type="text" value="{{$event->title_bn}}" name="title_bn" id="title_bn"
                                       class="form-control @error('title_bn') is-invalid @enderror">
                                @error('title_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description<span class="text-danger">* [English]</span></label>
                                <textarea name="description" rows="5" id="description"
                                          class="form-control summernote  @error('description') is-invalid @enderror">{{$event->description}}</textarea>
                                @error('description')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description_bn">Description <span
                                        class="text-success">[বাংলা]</span></label>
                                <textarea name="description_bn" rows="5" id="description_bn"
                                          class="form-control summernote  @error('description_bn') is-invalid @enderror">{{$event->description_bn}}</textarea>
                                @error('description_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="location">Location<span class="text-danger">* [English]</span></label>
                                <input type="text" value="{{$event->location}}" name="location" id="location"
                                       class="form-control  @error('location') is-invalid @enderror">
                                @error('location')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="location_bn">Location <span
                                        class="text-success">[বাংলা]</span></label>
                                <input type="text" value="{{$event->location_bn}}" name="location_bn" id="location_bn"
                                       class="form-control  @error('location_bn') is-invalid @enderror">
                                @error('Location_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event_date">Event Date<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="event_date" autocomplete="off" placeholder="DD-MM-YYYY"
                                           value="{{date('d-m-Y',strtotime($event->event_date))}}" id="event_date"
                                           class="form-control datepicker  @error('event_date') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('event_date')
                                    <div class="invalid-feedback"><i
                                            class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="cover">Cover</label>
                                <input type="file" name="cover" id="cover"
                                       class="form-control  @error('cover') is-invalid @enderror">
                                <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                    Max file Size: 1MB | Type: jpg,jpeg,png
                                </small>
                                @error('cover')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event_link">Event Link</label>
                                <input value="{{$event->event_link}}" type="text" name="event_link" id="event_link"
                                       class="form-control  @error('event_link') is-invalid @enderror">
                                @error('event_link')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status"
                                        class="form-control  @error('status') is-invalid @enderror">
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="1" {{$event->status=='1'?'selected':''}}>Active</option>
                                    <option value="0" {{$event->status=='0'?'selected':''}}>Inactive</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('admin.events')}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Events</a>&nbsp;&nbsp;
                                <button class="btn btn-success btn-sm"><i class="fa fa-sync-alt"></i> UPDATE</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="col-lg-3">
                <div class="card">

                    <div class="card-body">
                        <h6 class="card-title">Cover</h6>
                        <hr>
                        <img src="{{asset("uploads/event/$event->cover")}}" class="img-thumbnail" alt="">

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
