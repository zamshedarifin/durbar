@extends('admin.layouts.app')
@section('title','Profile')
@section('css')

@stop

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="p-0 text-center">
                    <div class="member-card">
                        <div class="avatar-xxl member-thumb mb-2 center-page mx-auto">
                            @if(empty($profile->photo))
                                <img src="{{asset("admin/images/users/pp.png")}}" class="rounded-circle img-thumbnail"
                                     alt="profile-image">
                            @else
                                <img src="{{asset("uploads/profile/$profile->photo")}}"
                                     style="height: 118px;width: 150px; object-fit: cover;object-position: center"
                                     class="rounded-circle img-thumbnail"
                                     alt="profile-image">
                            @endif
                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                        </div>

                        <div class="">
                            <h5 class="mt-3">{{$profile->name}}</h5>
                            <p class="text-muted">{{$profile->email}}</p>
                        </div>
                    </div>
                </div>
                <!-- end card-box -->
            </div>
            <!-- end col -->
            <div class="mt-1 col-md-8">
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
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                            Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home-b1">
                        <div class="row">
                            <div class="panel card panel-fill">
                                <div class="card-header">
                                    <h5 class="font-16 m-1">Edit Profile</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('admin.profile')}}"
                                          enctype="multipart/form-data" class="form-row">@csrf
                                        <div class="form-group col-md-6">
                                            <label for="">Name*</label>
                                            <input type="text" value="{{$profile->name}}"
                                                   class="form-control @error('name') is-invalid @enderror" name="name">
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Email*</label>
                                            <input type="email" value="{{$profile->email}}"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email">
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Photo</label>
                                            <input type="file" style="padding:4px .9rem" value="{{$profile->email}}"
                                                   class="form-control @error('photo') is-invalid @enderror"
                                                   name="photo">
                                            <small id="photoHelpBlock" class="form-text text-danger text-muted">
                                                Max file Size: 200KB | Type: jpg,jpeg,png
                                            </small>
                                            @error('photo')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <button class="btn btn-sm btn-success"><i class="fa fa-sync"></i> Update
                                            </button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile-b1">
                        <!-- Personal-Information -->
                        <div class="panel card panel-fill">
                            <div class="card-header">
                                <h5 class="font-16 m-1">Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route('admin.change.password')}}" class="form-row">@csrf

                                    <div class="form-group col-md-12">
                                        <label for="">Current Password*</label>
                                        <input type="password"
                                               class="form-control @error('current_password') is-invalid @enderror"
                                               name="current_password">
                                        @error('current_password')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">New Password*</label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password">
                                        @error('password')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Confirm Password*</label>
                                        <input type="password"
                                               class="form-control @error('confirm_password') is-invalid @enderror"
                                               name="confirm_password">
                                        @error('confirm_password')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-sync"></i> Change
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Personal-Information -->
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop

@section('script')
    <script>
        @if(Session::get('data') == 'profile' || $errors->first('name') || $errors->first('email') || $errors->first('photo'))
        $('.nav-tabs a[href="#home-b1"]').tab('show')
        $('html, body').animate({
            scrollTop: $("#home-b1").offset().top
        }, 2000);
        @elseif(Session::get('data') == 'setting' || $errors->first('current_password') || $errors->first('password') || $errors->first('confirm_password'))
        $('.nav-tabs a[href="#profile-b1"]').tab('show')
        $('html, body').animate({
            scrollTop: $("#profile-b1").offset().top
        }, 2000);
        @endif
    </script>
@stop
