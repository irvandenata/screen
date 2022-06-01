<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('cms') }}/images/favicon.ico">

    <title>Adminto</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('cms') }}/plugins/morris/morris.css">

    <!-- App css -->
    <link href="{{ asset('cms') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms') }}/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms') }}/css/style.css" rel="stylesheet" type="text/css" />

    <script src="{{ asset('cms') }}/js/modernizr.min.js"></script>
    @stack('css')
    @stack('style')

    <style>
        .modal-lg {
    max-width: 80%;
}
    </style>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left ">
                <h3 class="text-primary mt-4">SCREEN - ADMIN</h3>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">

                    <!-- Page title -->
                    <ul class="nav navbar-nav list-inline navbar-left">
                        <li class="list-inline-item">
                            <button class="button-menu-mobile open-left">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <h3 class="page-title">{{ isset($title) ? $title : '' }}</h4>
                        </li>
                    </ul>

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a href="javascript:void(0);"
                                            onclick="readNotif()"
                                            class="right-bar-toggle">
                                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                            </a>
                                            @if (count(auth()->user()->unreadNotifications)>0)
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                        </ul>
                    </nav>
                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">

                <!-- User -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="{{ asset('cms') }}/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                        <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                    </div>
                    <h5><a href="#">{{ Auth::user()->name }}</a> </h5>

                </div>
                <!-- End User -->

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul>
                        <li class="text-muted menu-title">Navigation</li>
                        <li>
                            <a href="/admin" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span>Dashboard </span> </a>
                        </li>
                        <li>
                            <a href="/admin/screen" class="waves-effect"><i class="fa fa-bullseye"></i><span>Screen</span></a>
                        </li>
                        <li>
                            <a href="/admin/event" class="waves-effect"><i class="fa fa-code-fork"></i><span>Event</span></a>
                        </li>
                        <li>
                            <a href="/admin/profile" class="waves-effect"><i class="fa fa-user"></i><span>Akun</span></a>
                        </li>
                        <li>
                            <a href="/admin/setting" class="waves-effect"><i class="fa fa-cogs"></i><span>Settings</span></a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="waves-effect" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i><span>Logout</span></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    @yield('content')

                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
                2016 - 2018 © Adminto. Coderthemes.com
            </footer>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <a href="javascript:void(0);" class="right-bar-toggle">
                <i class="mdi mdi-close-circle-outline"></i>
            </a>
            <h4 class="">Notifications</h4>
            <div class="notification-list nicescroll">
                <ul class="list-group list-no-border user-list">
                    @foreach (auth()->user()->unreadNotifications as $notif)
                    <li class="list-group-item
                    ">
                        <a href="#" class="user-list-item">
                            <div class="user-desc">
                                <span class="name">{{ $notif->data['subevent'] }}</span>
                                <span class="desc">Terdapat Peserta Mendaftar</span>
                                <span class="time">{{ $notif->data['date'] }}</span>
                            </div>
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->


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


    <script src="{{ asset('cms') }}/plugins/jquery-knob/jquery.knob.js"></script>

    <!--Morris Chart-->
    <script src="{{ asset('cms') }}/plugins/morris/morris.min.js"></script>
    <script src="{{ asset('cms') }}/plugins/raphael/raphael-min.js"></script>

    <!-- Dashboard init -->


    <!-- App js -->
    <script src="{{ asset('cms') }}/js/jquery.core.js"></script>
    <script src="{{ asset('cms') }}/js/jquery.app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        function readNotif(){
                  $.ajax({
                        url: '/admin/readnotif',
                        type: "get",
                        success: function (result) {

                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    console.log('success')
        }

    </script>
    @stack('js')
    @stack('script')


</body>

</html>
