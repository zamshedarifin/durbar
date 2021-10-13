<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title') | ডিজিটাল বাংলাদেশে আমরা দুর্বার</title>
    <meta charset="utf-8">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://www.durbar21.org"/>
   @yield('meta')
    <meta property="og:image:alt" content="{{asset("assets/img/durbar-banner.jpg")}}"/>
    <meta property="og:site_name" content="দুর্বার"/>
    <meta property="og:description" content="“দুর্বার” প্লাটফর্মটি তথ্য ও যোগাযোগ প্রযুক্তি বিভাগের অধীনে বাংলাদেশ কম্পিউটার কাউন্সিলের আওতায় এলআইসিটি প্রকল্পের একটি উদ্যোগ। এলআইসিটি প্রকল্পের বিভিন্ন কাজের একটা বড় অংশ জুড়ে রয়েছে তরুণ প্রজন্ম।"/>
    <meta property="og:postal-code" content="1215"/>
    <meta property="og:country-name" content="Bangladesh"/>
    <meta property="og:email" content="info@durbar21.org"/>
    <meta name="description" content="“দুর্বার” প্লাটফর্মটি তথ্য ও যোগাযোগ প্রযুক্তি বিভাগের অধীনে বাংলাদেশ কম্পিউটার কাউন্সিলের আওতায় এলআইসিটি প্রকল্পের একটি উদ্যোগ। এলআইসিটি প্রকল্পের বিভিন্ন কাজের একটা বড় অংশ জুড়ে রয়েছে তরুণ প্রজন্ম।"/>
    <meta name="keywords" content="দুর্বার,durbar,Durbar Ambassador"/>
    <meta name="copyright" content="Copyright &copy; 2020 Durbar"/>
    <meta name="rating" content="general"/>
    <meta name="distribution" content="global"/>
    <meta name="robots" content="index,follow"/>
    <meta http-equiv="expires" content="3600"/>
    <meta name="revisit-after" content="1 days"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:updated_time" content="<?=time()?>" />

    <meta name="google-site-verification" content="tMuSP5LG6C3iipzzfPqIszzSRaVLJDFnjexOEHf_0Ew" />
    <!-- Favicons -->
    <link href="{{asset("assets/img/logo.png")}}" rel="icon">
    <link href="{{asset("assets/img/logo.png")}}" rel="apple-touch-icon">


    <!-- Vendor CSS Files -->
    <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/icofont/icofont.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/jquery.fancybox.css")}}" rel="stylesheet">
    @section('css-plugin') @show
    <link href="{{asset("assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/venobox/venobox.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/owl.carousel/assets/owl.carousel.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/aos/aos.css")}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset("assets/css/style.css")}}" rel="stylesheet">
@section('css') @show
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177629389-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-177629389-1');
    </script>

</head>

<body>


@include('frontEnd.includes.header')





<!-- ======= Hero Section ======= -->

@yield('banner')

<!-- End Hero -->

<main id="main">


    @yield('content')

    @include('frontEnd.includes.client')

</main><!-- End #main -->

<!-- ======= Footer ======= -->
@include('frontEnd.includes.footer')



<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<!--  <div id="preloader"></div>-->

<!-- Vendor JS Files -->
<script src="{{asset("assets/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/vendor/jquery.easing/jquery.easing.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/jquery.counterup.min.js")}}"></script>
{{--<script src="{{asset("")}}assets/vendor/php-email-form/validate.js"></script>--}}
@section('script') @show
<script src="{{asset("assets/js/jquery.fancybox.min.js")}}"></script>
<script src="{{asset("assets/vendor/waypoints/jquery.waypoints.min.js")}}"></script>
<script src="{{asset("assets/vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
<script src="{{asset("assets/vendor/venobox/venobox.min.js")}}"></script>

<script src="{{asset("assets/vendor/owl.carousel/owl.carousel.min.js")}}"></script>
<script src="{{asset("assets/vendor/aos/aos.js")}}"></script>
<!-- Template Main JS File -->
<script src="{{asset("assets/js/main.js")}}"></script>
@section('js') @show
<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('#event_popup_modal').modal({backdrop: 'static', keyboard: false});
        }, 3000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#SubscripButton').click(function(){
            //alert("dsafkldsa");
            var email = $("#email").val();
            if(IsEmail(email)==false){
                jQuery('#subscrip_status').text('Please Enter a Valid Email');
            }else{
                jQuery.ajax({
                    type:'POST',
                    dataType: 'JSON',
                    data:'email='+email,
                    url:"",
                    success:function(response){
                        jQuery('#subscrip_status').text(response.success);
                    },
                    error:function(){
                        alert(error);
                    }
                });
            }

        });
    });
</script>
</body>

</html>


