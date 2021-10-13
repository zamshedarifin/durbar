@extends('admin.layouts.app')
@section('title','Add Competition')

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
                    <h4 class="header-title mb-3 text-uppercase">ADD Competition

                    </h4>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
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
                        <form class="form-row" action="{{route('admin.create.competition')}}"
                              enctype="multipart/form-data" method="post">@csrf
                            <div class="form-group col-md-6">
                                <label for="title">Title<span class="text-danger">* [English]</span></label>
                                <input type="text" value="{{old('title')}}" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_bn">Title<span class="text-danger">*</span> <span class="text-success">[বাংলা]</span></label>
                                <input type="text" value="{{old('title_bn')}}" name="title_bn" id="title_bn"
                                       class="form-control @error('title_bn') is-invalid @enderror">
                                @error('title_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description<span class="text-danger">* [English]</span></label>
                                <textarea name="description" rows="5" id="description"
                                          class="form-control summernote  @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description_bn">Description<span class="text-danger">*</span> <span
                                        class="text-success">[বাংলা]</span></label>
                                <textarea name="description_bn" rows="5" id="short_desc_bn"
                                          class="form-control summernote  @error('description_bn') is-invalid @enderror">{{old('description_bn')}}</textarea>
                                @error('description_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="campaign">Campaign<span class="text-danger">*</span></label>
                                <select name="campaign" id="campaign"
                                        class="form-control @error('campaign') is-invalid @enderror">
                                    <option value="" disabled selected>Choose...</option>
                                    @if($campaigns)
                                        @foreach($campaigns as $campaign)
                                            <option value="{{$campaign->id}}">{{$campaign->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('campaign')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date">Competition Start & End Date<span class="text-danger">*</span></label>
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


                            <div class="form-group col-md-4">
                                <label for="location">Location<span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location"
                                       class="form-control  @error('location') is-invalid @enderror">
                                @error('location')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="thumbnail">Thumbnail<span class="text-danger">*</span></label>
                                <input type="file" name="thumbnail" id="thumbnail"
                                       class="form-control  @error('thumbnail') is-invalid @enderror">
                                <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                    Max file Size: 1MB | Type: jpg,jpeg,png
                                </small>
                                @error('thumbnail')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status"
                                        class="form-control  @error('status') is-invalid @enderror">
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('admin.competitions')}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Competitions</a>&nbsp;&nbsp;
                                <button class="btn btn-success btn-sm"><i class="fa fa-save"></i> SAVE</button>
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
