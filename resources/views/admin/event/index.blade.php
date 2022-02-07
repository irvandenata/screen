@extends('layouts.admin')

@section('title', $title)

@push('css')
    <link href="{{ asset('cms/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cms/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('cms/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Multi Item Selection examples -->
    <link href="{{ asset('cms/plugins/datatables/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
        <div class="card-box table-responsive">
            <table id="datatable" class="table table-bordered  m-t-30">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th>Tema</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.event._form')
</div>
@endsection

@push('js')

    <script src="{{ asset('cms/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('cms/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    {{-- sweat allert --}}

    <!-- Responsive examples -->
    <script src="{{ asset('cms/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cms') }}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Selection table -->
    <script src="{{ asset('cms/plugins/datatables/dataTables.select.min.js') }}"></script>

@endpush

@push('script')

    @include('crud.js')
    <script>
        $('.activatedScreen').select2();
        let dataTable = $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                className: 'btn btn-success btn-sm mr-2',
                text: 'Create',
                action: function (e, dt, node, config) {
                    createItem();
                }
            }, {
                className: 'btn btn-warning btn-sm mr-2',
                text: 'Reload',
                action: function (e, dt, node, config) {
                    reloadDatatable();
                    Toast.fire({
                        icon: 'success',
                        title: 'Reload'
                    })
                }
            }],
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            ajax: {
                url: child_url,
                type: 'GET',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'name',
                    orderable: true
                },
                {
                    data: 'theme',
                    orderable: true
                },
                {
                    data: 'description',
                    orderable: true
                },
                {
                    data: 'contest_date',
                    orderable: true
                },



                {
                    data: 'image',
                    orderable: true
                },

                {
                    data: 'action',
                    name: '#',
                    orderable: false
                },
            ]
        });

    </script>

    <script>
        function createItem() {
            setForm('create', 'POST', ('Create {{ $title }}'), true)

        }

        function editItem(id) {
            setForm('update', 'PUT', 'Edit {{ $title }}', true)
            editData(id)


        }

        function deleteItem(id) {
            deleteConfirm(id)

        }

    </script>

    <script>
        /** set data untuk edit**/
        function setData(result) {
            $('input[name=id]').val(result.id);
            $('input[name=name]').val(result.name);
            $('.desc').val(result.description);
            $('input[name=theme]').val(result.theme);
            $('input[name=contest_date]').val(result.contest_date);
        }


        /** reload dataTable Setelah mengubah data**/
        function reloadDatatable() {
            dataTable.ajax.reload();
        }

        function activateScreen() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Mengganti Screen yang Aktif!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var screen = $("#screen").val();

                    $.ajax({
                        url: '/admin/screen/activate',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            screen: screen
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatable();
                        },
                        error: function (result) {
                            $('#modalForm').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    })
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Screen Telah diganti',
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


        $('#datepicker').datepicker();
        $('#date-range').datepicker({
            toggleActive: true
        });

    </script>

@endpush
