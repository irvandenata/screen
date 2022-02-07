@extends('layouts.admin')

@section('title', $title)

@push('css')


    <!-- App css -->
    <link href="{{ asset('cms/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('cms/js/modernizr.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .mtop-100 {
            margin-top: 150px !important;
        }

    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive profile">
            <form action="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <div class="form-line">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control name" value="{{ $user->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="email">email</label>
                        <input type="email" name="email" class="form-control email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect btn-primary" onclick="saveConfirm()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @include('admin.setting._form')
</div>
@endsection

@push('js')

    <script src="{{ asset('cms/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    {{-- sweat allert --}}


@endpush

@push('script')



    <script>
        const child_url = "{!! Request::url() !!}/{!! Auth::user()->id !!}";



        function saveProfile() {
            console.log($('.profile form')[0]);
            Swal.fire({
                type: 'warning',
                text: 'Please wait.',
                showCancelButton: false,
                confirmButtonText: "ok",
                allowOutsideClick: false,
                allowEscapeKey: false
            })
            Swal.showLoading()
            $.ajax({
                url: child_url,
                type: "put",
                cache: false,
                dataType: 'json',
                data: {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'password': $('.password').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Profile Telah diganti',
                        'success'
                    )

                },
                error: function (result) {
                    swalWithBootstrapButtons.fire(
                        'Warning!',
                        'Terjadi Kesalahan',
                        'warning'
                    )


                    if (result.responseJSON) {
                        getError(result.responseJSON.errors);
                    } else {
                        console.log(result);
                    }
                },
            })
        }


        function saveConfirm() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Mengubah Data!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes !',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    saveProfile();
                    swalWithBootstrapButtons.fire(
                        'Data Telah di Ubah!',
                        'success'
                    )

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush
