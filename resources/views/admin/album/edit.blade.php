@extends('admin.layouts.app')

@section('title') Edit albums @endsection
@section('css')
    <style>
        .img-custom{
            height: 130px;
            width: 150px;
            object-fit: cover;
            object-position: top;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start  -->
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3 text-uppercase">Update Album</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if($message= Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fa fa-check-circle"></i> Success!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-xl-8">
                <div class=" shadow-sm">
                    <div class="card-body">
                        <form action="{{route('admin.album.update',lock($album->id))}}" class="form-row" method="POST"
                              enctype="multipart/form-data" data-parsley-validate novalidate>@csrf
                            @method('PUT')
                            <div class="form-group col-xl-12">
                                <label for="name">Name*</label>
                                <input type="text" name="name" value="{{$album->title}}" required placeholder="Enter album name"
                                       class="form-control placement @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-xl-12">
                                <label for="description">Description*</label>
                                <textarea name="description" data-parsley-error-message="The description is required."
                                          maxlength="600" required
                                          placeholder="Enter description" rows="6"
                                          class="form-control placement @error('description') is-invalid @enderror"
                                          id="description">{{$album->description}}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="image">Image</label>
                                <input type="file" name="image" data-parsley-max-file-size="1024"
                                       class="form-control @error('image') is-invalid @enderror" id="image">
                                <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                    Max file Size: 1MB | Type: jpg,jpeg,png
                                </small>
                                @error('image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="status-">Status*</label>
                                <select required name="status"
                                        class="form-control @error('status') is-invalid @enderror" id="status-">
                                    <option value="">Select Status</option>
                                    <option value="1" {{$album->status=='1'?'selected':''}}>Published</option>
                                    <option value="0" {{$album->status=='0'?'selected':''}}>Unpublished</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group m-auto mb-0">
                                <a href="{{route('admin.album.index')}}" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-view-list"></i> List
                                </a>

                                <button class="btn btn-sm btn-success" type="submit">
                                    <i class="mdi mdi-content-save"></i> Update
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <h6 class="card-header">Album Thumbnail</h6>
                    <div class="card-body">
                        <img src="{{asset("uploads/album/$album->thumbnail")}}" class="img-fluid" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection

