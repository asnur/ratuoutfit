<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:46:55 GMT -->

<head>
    <title>Ratu Outfit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    @yield('master-style')
    <link rel="icon" href="{{ asset('vendor/themes/images/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('vendor/themes') }}/images/favicon/favicon.png" type="image/x-icon">

    <!--Google font-->
    <link href="fonts.googleapis.com/css0679.css?family=PT+Sans:400,700&amp;display=swap" rel="stylesheet">
    <link href="fonts.googleapis.com/csse7ca.css?family=Raleway&amp;display=swap" rel="stylesheet">

    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/themify.css">


    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/slick-theme.css">

    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/animate.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/themes') }}/css/color2.css" media="screen" id="color">
    @livewireStyles
    <style>
        .custom-right {
            background: url('https://images.unsplash.com/photo-1626497361649-81cc097e9bfd?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80') no-repeat;
            background-size: cover;
            height: 70vh;
        }
    </style>
</head>

<body class="bg-light">
    @include('master.nav')
    <!-- loader start -->
    <div class="loader-wrapper">
        <div>
            <img src="{{ asset('vendor/themes') }}/images/loader.gif" alt="loader">
        </div>
    </div>
    <!-- loader end -->
    @yield('master-page')

    @include('master.footer')
    <script src="https://use.fontawesome.com/bb34672705.js"></script>
    
    <!-- latest jquery-->
    <script src="{{ asset('vendor/themes') }}/js/jquery-3.3.1.min.js"></script>

    <!-- slick js-->
    <script src="{{ asset('vendor/themes') }}/js/slick.js"></script>

    <!-- popper js-->
    <script src="{{ asset('vendor/themes') }}/js/popper.min.js"></script>
    <script src="{{ asset('vendor/themes') }}/js/bootstrap-notify.min.js"></script>

    <!-- menu js-->
    <script src="{{ asset('vendor/themes') }}/js/menu.js"></script>

    <!-- timer js -->
    <script src="{{ asset('vendor/themes') }}/js/timer2.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('vendor/themes') }}/js/bootstrap.js"></script>

    <!-- tool tip js -->
    <script src="{{ asset('vendor/themes') }}/js/tippy-popper.min.js"></script>
    <script src="{{ asset('vendor/themes') }}/js/tippy-bundle.iife.min.js"></script>
    <!-- range slider -->
    <script src="{{ asset('vendor/themes') }}/js/ion.rangeSlider.js"></script>
    <script src="{{ asset('vendor/themes') }}/js/rangeslidermain.js"></script>

    <!-- father icon -->
    <script src="{{ asset('vendor/themes') }}/js/feather.min.js"></script>
    <script src="{{ asset('vendor/themes') }}/js/feather-icon.js"></script>

    <!-- Theme js-->
    <script src="{{ asset('vendor/themes') }}/js/modal.js"></script>
    <script src="{{ asset('vendor/themes') }}/js/script.js"></script>
    @livewireScripts
    <script>
        $(document).ready(function () {
            $('.color-picker').hide()
        })
        $(document).ready(function () {
            $('#rtl_btn').hide()
        })

    </script>
</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:46:55 GMT -->

</html>
