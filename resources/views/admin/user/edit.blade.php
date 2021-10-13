@extends('admin.layouts.app')
@section('title','Update User')


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        @if($message = Session::get('success'))
                            <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="mdi mdi-check-all mr-2"></i>
                                <strong>Success!</strong> {{$message}}
                            </div>
                        @elseif($message = Session::get('error'))
                            <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="mdi mdi-check-all mr-2"></i>
                                <strong>Success!</strong> {{$message}}
                            </div>
                        @endif

                        <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Edit User</h5>
                        <hr>

                        <form method="post" action="{{route('admin.user.edit',lock($user->id))}}" class="form-row">@csrf
                            <div class="form-group col-md-6">
                                <label for="">Name*</label>
                                <input type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Email*</label>
                                <input type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" name="email">
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                          {{--  <div class="form-group col-md-6">
                                <label for="">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">
                                @error('confirm_password')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>--}}
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{route('admin.user.list')}}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> User List</a>&nbsp;
                                <button class="btn btn-sm btn-success"><i class="fa fa-sync"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@stop

@section('css')

@stop
