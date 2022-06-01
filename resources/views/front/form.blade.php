@extends('layouts.front')

@section('title', $title)

@push('css')

@endpush

@push('style')

@endpush

@section('content')

<!-- Navbar & Hero Start -->
<div style="min-height: 700px" class="container-xxl py-5  mb-5">
    <div class="container mt-5 py-5">
        <div class="row text-center">
            <h1 class="display-3 animated slideInLeft">Pendaftaran Lomba
                <br> {{ $subevent->name }}</h1>
            {{-- <h3 class=" text-white animated slideInLeft">{{ $subevent->description }}</h3> --}}
            <hr size='10' class="text-white">
        </div>
        <div class="row my-3  align-items-center g-5">
            <form method="post" enctype="multipart/form-data" action="/sendform/{{ $subevent->slug }}">
                @csrf
                <div class="row g-3">
                    @foreach($form as $item)
                        <div class="col-md-6">
                            @if($item->type=='select')
                                <div class="form-floating">
                                    <input name="{{ $item->name }}[]" type="hidden" class="form-control" id="name" value="{{ $item->id }}">

                                    <select class="form-control show-tick" name="{{ $item->name }}[]" id="typeID" @if ($item->require)
                                        required
                                    @endif>
                                        <option disabled selected value>---- Pilih Salah Satu ----</option>
                                        @foreach($item->subforms as $data)
                                            <option value="{!! $data->name !!}">{!! $data->name !!}</option>
                                        @endforeach
                                    </select>
                                    <input name="{{ $item->name }}[]" type="hidden" class="form-control" id="name" value="{{ $item->type }}">
                                    <label for="{{ $item->name }}">{{ $item->name }}</label>
                                </div>
                            @else
                                <div class=" form-floating">
                                    <input name="{{ $item->name }}[]" value="{{ $item->id }}" type="hidden" class="form-control" id="name" placeholder="{{ $item->name }}">
                                    <input name="{{ $item->name }}[]" type="{{ $item->type }}" accept="image/*" class="form-control" id="name" placeholder="{{ $item->name }}" @if ($item->require)
                                        required
                                    @endif>
                                    <input name="{{ $item->name }}[]" value="{{ $item->type }}" type="hidden" class="form-control" id="name">
                                     <input name="{{ $item->name }}[]" value="{{ $item->require }}" type="hidden" class="form-control" id="name">
                                    <label for="name">{{ $item->name }}</label>
                                </div>
                            @endif


                        </div>
                    @endforeach
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush

@push('script')
    @if(\Session::has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Melakukan Pendaftaran !'
            })

        </script>
    @endif
@endpush
