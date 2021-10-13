@extends('admin.layouts.app')
@section('title','Edit Campaign')

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
                    <h4 class="header-title mb-3">Update Campaign</h4>
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
                        <form class="form-row" action="{{route('admin.edit.campaign',lock($campaign->id))}}" enctype="multipart/form-data" method="post">@csrf
                            <div class="form-group col-md-6">
                                <label for="title">Title<span class="text-danger">* [English]</span></label>
                                <input type="text" value="{{$campaign->title}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_bn">Title <span class="text-success">[বাংলা]</span></label>
                                <input type="text" value="{{$campaign->title_bn}}" name="title_bn" id="title_bn" class="form-control @error('title_bn') is-invalid @enderror">
                                @error('title_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="short_desc">Short Description<span class="text-danger">* [English]</span></label>
                                <textarea name="short_desc" rows="5" id="short_desc" class="form-control  @error('short_desc') is-invalid @enderror">{{$campaign->short_desc}}</textarea>
                                @error('short_desc')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="short_desc_bn">Short Description <span class="text-success">[বাংলা]</span></label>
                                <textarea name="short_desc_bn" rows="5" id="short_desc_bn" class="form-control  @error('short_desc_bn') is-invalid @enderror">{{$campaign->short_desc_bn}}</textarea>
                                @error('short_desc_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description<span class="text-danger">* [English]</span></label>
                                <textarea name="description" rows="5" id="description" class="form-control summernote  @error('description') is-invalid @enderror">{{$campaign->description}}</textarea>
                                @error('description')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description_bn">Description <span class="text-success">[বাংলা]</span></label>
                                <textarea name="description_bn" rows="5" id="short_desc_bn" class="form-control summernote  @error('description_bn') is-invalid @enderror">{{$campaign->description_bn}}</textarea>
                                @error('description_bn')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cam_date">Date<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="cam_date"  autocomplete="off" placeholder="DD-MM-YYYY" value="{{date('d-m-Y',strtotime($campaign->cam_date))}}" id="cam_date" class="form-control datepicker  @error('cam_date') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('cam_date')
                                    <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="cover">Cover</label>
                                <input type="file" name="cover" id="cover" class="form-control  @error('cover') is-invalid @enderror">
                                <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                    Max file Size: 1MB | Type: jpg,jpeg,png,svg
                                </small>
                                @error('cover')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control  @error('status') is-invalid @enderror">
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="0" {{$campaign->status == '0'?'selected':''}}>Pending</option>
                                    <option value="3" {{$campaign->status=='3'?'selected':''}}>Upcoming</option>
                                    <option value="4" {{$campaign->status=='4'?'selected':''}}>Previous</option>
                                    <option value="1" {{$campaign->status == '1'?'selected':''}}>Ongoing</option>
                                    <option value="2" {{$campaign->status == '2'?'selected':''}}>Closed</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}</div>
                                @enderror
                            </div>

                            {{--<div class="col-md-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox2" name="status" type="checkbox" checked="checked">
                                    <label for="checkbox2">
                                        Published
                                    </label>
                                </div>
                            </div>--}}
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('admin.campaign')}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Campaigns</a>&nbsp;&nbsp;
                                <button class="btn btn-success btn-sm"><i class="fa fa-sync-alt"></i> UPDATE</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <p>Campaign Cover</p>
                        <img src="{{asset("uploads/campaign/$campaign->cover")}}" class="img-fluid" alt="">
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
            height:"250px",
        });
    </script>
@stop
