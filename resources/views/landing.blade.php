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
        --primary: {{ $primary_color }};
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

        .timeline-section{

        min-height: 100vh;
        padding: 100px 15px;
        }
        .timeline-items{
        max-width: 1000px;
        margin:auto;
        display: flex;
        flex-wrap: wrap;
        position: relative;
        }
        .timeline-items::before{
        content: '';
        position: absolute;
        width: 2px;
        height: 100%;
        background-color: #2f363e;
        left: calc(50% - 1px);
        }
        .timeline-item{
        margin-bottom: 40px;
        width: 100%;
        position: relative;
        }
        .timeline-item:last-child{
        margin-bottom: 0;
        }
        .timeline-item:nth-child(odd){
        padding-right: calc(50% + 30px);
        text-align: right;
        }
        .timeline-item:nth-child(even){
        padding-left: calc(50% + 30px);
        }
        .timeline-dot{
        height: 16px;
        width: 16px;
        background-color: var(--dark);
        position: absolute;
        left: calc(50% - 8px);
        border-radius: 50%;
        top:10px;
        }
        .timeline-date{
        font-size: 18px;
        color: var(--dark);
        margin:6px 0 15px;
        }
        .timeline-content{
        background-color: var(--dark);
        padding: 30px;
        border-radius: 5px;
        }
        .timeline-content h3{
        font-size: 20px;
        color: #ffffff;
        margin:0 0 10px;
        text-transform: capitalize;
        font-weight: 500;
        }
        .timeline-content p{
        color: #c8c8c8;
        font-size: 16px;
        font-weight: 300;
        line-height: 22px;
        }

        /* responsive */
        @media(max-width: 767px){
            .timeline-items::before{
            left: 7px;
            }
            .timeline-item:nth-child(odd){
            padding-right: 0;
            text-align: left;
            }
            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even){
            padding-left: 37px;
            }
            .timeline-dot{
            left:0;
            }
            }

             .service-item {
             box-shadow: 0 0 45px rgba(0, 0, 0, 0.329) !important;
             transition: .5s;
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

  <div class="container-fluid bg-white p-0">
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
          <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>
      <!-- Spinner End -->
      <!-- Navbar & Hero Start -->
      <div class="bg-color">
 <div class="container-fluid bg-dark position-relative p-0">
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
                 <a href="#home" class="nav-item nav-link active">Beranda</a>
                 <a href="#agenda" class="nav-item nav-link">Agenda</a>
                 <a href="#sejarah" class="nav-item nav-link">Sejarah</a>
                 <a href="#contact" class="nav-item nav-link">Kontak</a>
                 <div class="nav-item dropdown">
                     <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pendaftaran</a>
                     <div class="dropdown-menu mt-1 ">
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

     <div style="height: 800px" class="container-fluid py-5  hero-header mb-5">
         <div class="container my-5 py-5">
             <div class="row align-items-center g-5">
                 <div class="col-lg-6 text-center text-lg-start">
                     <h1 class="display-3 text-white animated slideInLeft">{{ $screen->name }}</h1>
                     <h3 class=" text-white animated slideInLeft">{{ $screen->theme }}</h3>
                     <hr size='10' class="text-white">
                     <h6 class="text-white animated slideInLeft mb-4 pb-2">{{ $screen->description }}</h6>

                 </div>
                 <div class="col-lg-6 text-center text-lg-end wow fadeInUp" data-wow-delay="0.5s">
                     <img class="img-fluid" style="width: 100%" src="{{ asset('storage') .'/'. $banner }}" alt="">
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Navbar & Hero End -->
 <div class="container-xxl  py-5" id="agenda">
     <div class="container py-5">
         <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
             <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Event & Competition</h5>
             <h3 class="mb-5">{!! $word_event->description !!}</h3>
         </div>
         <div class="container-xxl wow fadeInUp py-5">
             <div class="container">
                 <div class="row g-4 justify-content-center">
                     @foreach($event as $item)
                         @if($highlight_event != null && $highlight_event->config_value == $item->name )
                             <div class="col-lg-12 ol-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                                 <div class="service-item rounded pt-3">
                                     <div class="p-4">
                                         <div class="row">
                                             <div class="col-lg-8 col-sm-12 mb-4">
                                                 @if(count($item->files)>0)
                                                     <img style="width: 100%" src="{{ asset('storage').'/'. $item->files->first()->link }}" alt="">
                                                 @else
                                                     <img style="width: 100%" src="{{ asset('landing/img/noimage.png') }}" alt="">
                                                 @endif

                                             </div>
                                             <div class="col-lg-4 col-sm-12">
                                                 <h2>{{ $item->name }}</h2>
                                                 <h5>{{ $item->theme }}</h5>
                                                 <h6 class="text-secondary">{{ $item->description }}</h6>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @else
                             <div class="col-lg-4  col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                                 <div class="service-item rounded">
                                     <div class="p-3">
                                         <div class="row">
                                             <div class="col-lg-5 col-sm-12">
                                                 @if(count($item->files)>0)
                                                     <img style="width: 100%" src="{{ asset('storage').'/'. $item->files->first()->link }}" alt="">


                                                 @else
                                                     <img style="max-width: 100%" src="{{ asset('landing/img/noimage.png') }}" alt="">
                                                 @endif

                                             </div>
                                             <div class="col-lg-7 col-sm-12">
                                                 <h5>{{ $item->name }}</h5>
                                                 <h6>{{ $item->theme }}</h6>
                                                 <p class="text-secondary">{{ $item->description }}</p>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endif
                     @endforeach

                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="container-xxl bg-main pt-5 mt-5" id="sejarah">
     <div class="container mt-4 py-5">
         <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
             <h1>SCREEN HISTORIES</h1>
         </div>
         <div class="container-xxl pb-5 wow fadeInUp">
             <div class="container ">
                 <section class="timeline-section ">
                     <div class="timeline-items">
                         @foreach($leader as $item)
                             <div class="timeline-item">
                                 <div class="timeline-dot"></div>

                                 <div class="timeline-date">{{ $item->year }}</div>
                                 <div class="timeline-content  service-item">
                                     <div class="row">

                                         <div class="col-8">
                                             <h1 class="text-white">{{ $item->name }}</h1>
                                             <h6 class="text-white">{{ $item->leader }}</h6>
                                         </div>
                                         <div class="col-4">
                                             @if(count($item->files)>0)
                                                 <img style="max-width: 100%" src="{{ asset('storage').'/'. $item->files->first()->link }}" alt="">


                                             @else
                                                 <img style="max-width: 100%" src="{{ asset('landing/img/noimage.png') }}" alt="">
                                             @endif
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         @endforeach

                     </div>
                 </section>
             </div>
         </div>
     </div>
 </div>
 <div class="container-xxl  py-5">
     <div class="container py-5">
         <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
             <h1 class="mb-5">SUPPORTED BY</h1>
         </div>
         <div class="container-xxl py-5 wow fadeInUp">
             <div class="container ">
                 <div class="row justify-content-center">
                     @foreach($sponsor as $item)
                         <div class="col-lg-3 col-sm-12 text-center">
                             @if(count($item->files)>0)
                                 <img class="service-item" style="max-width: 100%" src="{{ asset('storage').'/'. $item->files->first()->link }}" alt="">
                             @else
                                 <img style="max-width: 100%" src="{{ asset('landing/img/noimage.png') }}" alt="">
                             @endif
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="container-xxl  py-5">
     <div class="container py-5">
         <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
             <h1 class="mb-5">MEDIA PARTNERS</h1>
         </div>
         <div class="container-xxl wow fadeInUp py-5">
             <div class="row justify-content-center">
                 @foreach($mediapartner as $item)
                     <div class="col-lg-2 col-sm-6 my-4 text-center">
                         @if(count($item->files)>0)
                             <img class="service-item" style="max-width: 100%" src="{{ asset('storage').'/'. $item->files->first()->link }}" alt="">
                         @else
                             <img style="max-width: 100%" src="{{ asset('landing/img/noimage.png') }}" alt="">
                         @endif
                     </div>
                 @endforeach
             </div>
         </div>
     </div>
 </div>
      </div>

  </div>





  <!-- Footer Start -->
  <div class="container-fluid bg-darks text-light footer pt-5  wow fadeIn" id="contact" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">

              <div class="col-lg-8 col-md-6">
                  <h4 class="section-title ff-secondary text-start  fw-normal mb-4">Kontak Kami</h4>
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

    <!-- Template Javascript -->
    <script src="{{ asset('landing') }}/js/main.js"></script>
</body>

</html>
