<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') | Durbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("admin/images/favicon.ico")}}">
    <!-- App css -->
    @section('style')@show
    <link href="{{asset("admin/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
    <link href="{{asset("admin/css/icons.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <!-- Summernote css -->
    <link href="{{asset('admin/libs/summernote/summernote-bs4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/css/app.min.css")}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="{{asset("admin/css/custom.css")}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    @section('css') @show
    <style>
        .radio input[type=radio] {
            cursor: pointer;
             opacity: 2 !important;
            z-index: 1;
            outline: 0 !important;
        }
    </style>

</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <!-- Topbar Start -->
@include('user-panel.includes.topbar')
<!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
@include('user-panel.includes.sidebar')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start container-fluid -->
        @yield('content')
        <!-- end container-fluid -->
            <!-- Footer Start -->
        @include('user-panel.includes.footer')
        <!-- end Footer -->
        </div>
        <!-- end content -->
    </div>
    <!-- END content-page -->

</div>
<!-- END wrapper -->


<!-- Vendor js -->
<script src="{{asset("admin/js/vendor.min.js")}}"></script>
<script src="{{asset("admin/libs/moment/moment.min.js")}}"></script>
<script src="{{asset("admin/libs/morris-js/morris.min.js")}}"></script>
<script src="{{asset("admin/libs/raphael/raphael.min.js")}}"></script>
<script src="{{asset('admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Summernote js -->
<script src="{{asset('admin/libs/summernote/summernote-bs4.min.js')}}"></script>

@section('script') @show

<script src="{{asset("admin/js/pages/dashboard.init.js")}}"></script>

<!-- App js -->
<script src="{{asset("admin/js/app.min.js")}}"></script>
@section('js') @show
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight:true,
        autoclose:true
    });

</script>
</body>

</html>
