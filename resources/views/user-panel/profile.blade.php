@extends('user-panel.layouts.app')
@section('title','Update Profile')
@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="p-0 text-center">
                    <div class="member-card">
                        <div class="avatar-xxl member-thumb mb-2 center-page mx-auto">
                            @if(asset(Auth::user()->avatar) != null)
                                <img src="{{asset(Auth::user()->avatar)}}" style="height: 118px;width: 150px; object-fit: cover;object-position: center"
                                     class="rounded-circle img-thumbnail"
                                     alt="profile-image">
                            @elseif(Auth::user()->avatar)
                                <img src="{{Auth::user()->avatar}}" style="height: 118px;width: 150px; object-fit: cover;object-position: center"
                                     class="rounded-circle img-thumbnail"
                                     alt="profile-image">
                            @else
                                <img src="{{asset('public/admin/images/users/pp.png')}}" class="rounded-circle img-thumbnail"  alt="profile-image">
                            @endif

                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                        </div>

                        <div class="">
                            <h5 class="mt-3">{{Auth::user()->name}}</h5>
                            <p class="text-muted">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                </div>
                <!-- end card-box -->
            </div>
            <!-- end col -->
            <div class="mt-1 col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>ধন্যবাদ !</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Auth::user()->mobile == null || Auth::user()->avatar == null || Auth::user()->facebook == null || Auth::user()->father_name == null || Auth::user()->mother_name == null || Auth::user()->address == null)
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> বর্তমানে আপনার প্রোফাইলটি  অসম্পূর্ণ আছে,ক্যাম্পেইনে অংশগ্রহণ করতে হলে আপনার এই তথ্যগুলো দিয়ে সহায়তা করতে হবে। ধন্যবাদ।
                    </div>
                @endif
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Profile Update
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                            Change Password
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
                                    <form class="form-row" action="{{route('user.profile')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <label for="name">Name<span class="text-danger"></span></label>
                                            <input type="text"  value="{{Auth::user()->name}}" name="name" id="name"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="email">Email<span class="text-danger"></span></label>
                                            <input type="email" name="email" id="email"  value="{{Auth::user()->email}}"
                                                   class="form-control @error('email') is-invalid @enderror" disabled>
                                            @error('email')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="mother_name">Mother Name<span class="text-danger"></span></label>
                                            <input type="text" name="mother_name" id="mother_name"  value="{{Auth::user()->mother_name}}"
                                                   class="form-control @error('mother_name') is-invalid @enderror">
                                            @error('mother_name')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="father_name">Father Name<span class="text-danger"></span></label>
                                            <input type="text" name="father_name" id="father_name"  value="{{Auth::user()->father_name}}"
                                                   class="form-control @error('father_name') is-invalid @enderror">
                                            @error('father_name')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="mobile">Mobile<span class="text-danger"></span></label>
                                            <input type="text" name="mobile" id="mobile"  value="{{Auth::user()->mobile}}"
                                                   class="form-control @error('mobile') is-invalid @enderror">
                                            @error('mobile')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="address">Address<span class="text-danger"></span></label>
                                            <input type="text" name="address" id="address"  value="{{Auth::user()->address}}"
                                                   class="form-control @error('address') is-invalid @enderror">
                                            @error('address')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="facebook">Facebook<span class="text-danger"></span></label>
                                            <input type="text" name="facebook" id="facebook"  value="{{Auth::user()->facebook}}"
                                                   class="form-control @error('facebook') is-invalid @enderror">
                                            @error('facebook')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="avatar">Profile picture<span class="text-danger">*</span></label>
                                            <input type="file" name="avatar" id="avatar"
                                                   class="form-control  @error('avatar') is-invalid @enderror">
                                            <p class="text-danger font-weight-bold mb-0" style="font-size: 12px">Supported file type: png,jpg,jpeg</p>
                                            <p class="text-danger font-weight-bold" style="font-size: 12px ">Max Size: 1MB</p>
                                            @error('avatar')
                                            <div class="invalid-feedback"><i class="fa fa-exclamation-triangle"></i> {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button class="btn btn-success btn-sm"><i class="fa fa-save"></i> SAVE</button>
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
                                <form method="post" action="{{route('user.change.password')}}" class="form-row">@csrf

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

