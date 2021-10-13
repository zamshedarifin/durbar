@extends('admin.layouts.app')

@section('title','Add album')

@section('content')
    <div class="container-fluid">
        <!-- start  -->
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3 text-uppercase">Add Album</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-xl-7">
                @if($message= Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fa fa-check-circle"></i> Success!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{route('admin.album.store')}}" class="form-row" method="POST"
                              enctype="multipart/form-data" data-parsley-validate novalidate>@csrf
                            <div class="form-group col-xl-12">
                                <label for="title">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       data-parsley-error-message="The name is required." maxlength="200" required
                                       placeholder="Enter album name"
                                       class="form-control placement @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-xl-12">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                <textarea name="description" data-parsley-error-message="The description is required."
                                          maxlength="600" required
                                          placeholder="Enter description" rows="6"
                                          class="form-control placement @error('description') is-invalid @enderror"
                                          id="description">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="image">Cover<span class="text-danger">*</span></label>
                                <input type="file" required name="image" data-parsley-max-file-size="2048"
                                       class="form-control @error('image') is-invalid @enderror" id="image">
                                <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                    Max file Size: 1MB | Type: jpg,jpeg,png
                                </small>
                                @error('image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="status-">Status<span class="text-danger">*</span></label>
                                <select required name="status"
                                        class="form-control @error('status') is-invalid @enderror" id="status-">
                                    <option value="">Select Status</option>
                                    <option value="1" {{old('status')=='1'?'selected':''}}>Published</option>
                                    <option value="0" {{old('status')=='0'?'selected':''}}>Unpublished</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group m-auto mb-0">
                                <a href="{{route('admin.album.index')}}" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-view-list"></i> List
                                </a>
                                <button class="btn btn-success btn-sm" type="submit">
                                    <i class="mdi mdi-content-save"></i> SAVE
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>


@endsection

@section('script')

@endsection




