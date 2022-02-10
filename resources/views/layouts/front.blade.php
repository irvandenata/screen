<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SCREEN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
h1,h2,h3,h4,h5,h6{
color: {{ $font_color }} !important ;
}
:root {
--primary: {{ $primary_color }} !important;
--light: #ffffff;
--dark: {{ $dark_color }};
}
.bg-darks{
background-color: var(--dark) !important;
}
.bg-color{
background-color: {{ $background_color }};
}
.hero-header {
background: linear-gradient( {{ $transparant_color }}, {{ $transparant_color }}),
url("{!! asset('storage').'/'.$background_header !!}");
background-position: center center;
background-repeat: no-repeat;
background-size: cover;
}

    </style>

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('landing') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('landing') }}/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->

    <link href="{{ asset('landing') }}/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('landing') }}/css/style.css" rel="stylesheet">



</head>

    <body>
    <div class="wrapper bg-color">
        <div class="container-fluid  p-0">
      <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                  <span class="sr-only">Loading...</span>
             </div>
        </div>
      <!-- Spinner End -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <img id="logo" src="{{ asset('storage').'/'. $logo }}" alt="">
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto  py-0 pe-4">
                <a href="/" class="nav-item nav-link ">Beranda</a>
                <a href="#contact" class="nav-item nav-link">Kontak</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pendaftaran</a>
                        <div class="dropdown-menu mt-2 ">
                        @foreach($registration as $item)
                            @foreach($item->subevents as $data)
                                @if($data->status)
                                    <a href="/event/{{ $data->slug }}" class="dropdown-item">{{ $data->name }}</a>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </nav>
@yield('content')


</div>



  </div>





  <!-- Footer Start -->
  <div class="container-fluid bg-darks text-light footer pt-5  wow fadeIn" id="contact" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">

              <div class="col-lg-8 col-md-6">
                  <h4 class="section-title ff-secondary text-start fw-normal mb-4">Kontak Kami</h4>
                  <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $address }}</p>
                  <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $phone }}</p>
                  <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $email }}</p>
                  <div class="d-flex pt-2">
                      @foreach($social_media as $item)
                          <a class="btn btn-outline-light btn-social" href="{{ $item->description }}"><i class="fab fa-{{ $item->config_value }}" target="_blank"></i></a>

                      @endforeach

                  </div>
              </div>

              <div class="col-lg-4 col-md-6">
                  <h4 class="section-title ff-secondary text-start  fw-normal mb-4">Lokasi Kami</h4>
                  {!! $location !!}

              </div>
          </div>
      </div>
      <div class="container">
          <div class="copyright">
              <div class="row">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      &copy; <a class="border-bottom" href="#">screen.himaster.id</a>, All Right Reserved. <br>
                      Designed By <a class="border-bottom" href="https://qodelight.com" target="_blank">QodeLight</a>
                  </div>

              </div>
          </div>
      </div>
    </div>
</div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('landing') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('landing') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('landing') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('landing') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('landing') }}/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('landing') }}/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('landing') }}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('landing') }}/js/main.js"></script>
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

    </script>
    @stack('script')
    @stack('js')
</body>

</html>
