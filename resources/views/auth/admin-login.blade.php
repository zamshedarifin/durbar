
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Page | Durbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("frontEnd/images/logo.png")}}">
    <!-- App css -->
    <link href="{{asset("admin")}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset("admin")}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4 mt-3">
                            <a href="index.html">
                                <span><img src="{{asset("frontEnd/images/logo.png")}}" alt="" height="80"></span>
                            </a>

                        </div>
                        <form action="{{ route('admin.login') }}" method="post" class="p-2">@csrf
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4 pb-3">
                                <div class="custom-control custom-checkbox checkbox-primary">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{asset("admin")}}/js/vendor.min.js"></script>

<!-- App js -->
<script src="{{asset("admin")}}/js/app.min.js"></script>

</body>

</html>
