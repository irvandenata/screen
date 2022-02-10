@extends('layouts.front')

@section('title', $title)

@push('css')

@endpush

@push('style')

@endpush

@section('content')
<!-- Navbar & Hero Start -->
<div style="height: 900px;" class="container-fluid py-5 hero-header mb-5">
    <div class="container-xxl mt-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">{{ $subevent->name }}</h1>
                <h3 class=" text-white animated slideInLeft">{{ $subevent->description }}</h3>
                <hr size='10' class="text-white">
                <h6 class="text-white animated slideInLeft mb-4 pb-2">awdaw</h6>
                <div class="row justify-content-center animated slideInLeft">
                    <div class="col-lg-4 text-center my-2">
                        <div class="btn btn-primary pt-3 rounded-pill">
                            @if($subevent->files->where('type','rolebook')->first()!=null)
                                <a href="{{ asset('storage').'/'.$subevent->files->where('type','rolebook')->first()->link }}" target="_blank">
                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;Rolebook&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                </a>
                            @else
                                <a href="#">
                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;Rolebook&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 text-center my-2">
                        <div class="btn btn-primary pt-3 rounded-pill">
                            <a href="/form/{{ $subevent->slug }}">
                                <h6>&nbsp;&nbsp;&nbsp;&nbsp;Daftar&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6  text-center text-lg-end wow fadeInRight " data-wow-delay="0.6s">
                @if(count($subevent->files)>0)
                    <img class="img-fluid" style="width: 100%" src="{{ asset('storage') .'/'. $subevent->files->first()->link }}" alt="">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush

@push('script')
    <script>

    </script>
@endpush
