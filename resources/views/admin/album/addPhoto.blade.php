@extends('admin.layouts.app')

@section('title') Add Photo @endsection
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
                <div class="card">
                    <h6 class="card-header">Add Photo</h6>
                    <div class="card-body">
                        <form action="{{route('admin.photo.store')}}" class="form-row" method="POST"
                              enctype="multipart/form-data" data-parsley-validate novalidate>@csrf
                            <div class="form-group col-xl-12">
                                <label for="description">Caption</label>
                                <textarea name="description"
                                          maxlength="600"
                                          placeholder="Enter photo caption  " rows="6"
                                          class="form-control placement @error('description') is-invalid @enderror"
                                          id="description">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-xl-6">
                                <label for="image">Photo*</label>
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
                                <label for="status-">Album*</label>
                                <select required name="album"
                                        class="form-control @error('album') is-invalid @enderror" id="album-">
                                    <option value="{{$album->id}}">{{$album->title}}</option>
                                </select>
                                @error('album')
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

