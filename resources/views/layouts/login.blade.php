<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('cms') }}/images/favicon.ico">

    <title>Adminto - Responsive Admin Dashboard Template</title>

    <!-- App css -->
    <link href="{{ asset('cms') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms') }}/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms') }}/css/style.css" rel="stylesheet" type="text/css" />

    <script src="{{ asset('cms') }}/js/modernizr.min.js"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            <a href="index.html" class="logo"><span>SCREEEN<span></span></span></a>
        </div>
        <div class="m-t-40 card-box">
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
            </div>
            <div class="p-20">
                @yield('content')

            </div>
        </div>
        <!-- end card-box-->

        {{-- <div class="row">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
            </div>
        </div> --}}

    </div>
    <!-- end wrapper page -->



    <!-- jQuery  -->
    <script src="{{ asset('cms') }}/js/jquery.min.js"></script>
    <script src="{{ asset('cms') }}/js/popper.min.js"></script>
    <script src="{{ asset('cms') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('cms') }}/js/detect.js"></script>
    <script src="{{ asset('cms') }}/js/fastclick.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.blockUI.js"></script>
    <script src="{{ asset('cms') }}/js/waves.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.nicescroll.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.slimscroll.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('cms') }}/js/jquery.core.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.app.js"></script>

</body>

</html>
