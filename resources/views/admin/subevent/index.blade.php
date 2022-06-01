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
                        <th>Buka Registrasi</th>
                        <th>Tutup Registrasi</th>
                        <th>Status Registrasi</th>

                        <th>Gambar</th>
                        <th>Role Book</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.subevent._form')
    @include('admin.subevent._addform')
    @include('admin.subevent._detailform')
    @include('admin.subevent._editform')
    @include('admin.subevent._detailresponden')
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
         var idForm=0;
         var urlform = '/admin/form';
         var urlresponden = '/admin/responden';
    </script>
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
                    data: 'start_regist',
                    orderable: true
                },

                {
                    data: 'end_regist',
                    orderable: true
                },
                {
                    data: 'status',
                    orderable: true
                },



                {
                    data: 'image',
                    orderable: true
                },
                {
                    data: 'rolebook',
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


        function addForm(id) {
            $('#modalAddForm').modal('show');
            idForm = id;
        }

        function deleteItem(id) {
            deleteConfirm(id)

        }

        function activateRegist(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: '/admin/subevent/activate',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            subevent: id
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
                        'Status Telah diganti',
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


        $('#type').on('change', function () {
            $('#addOpsi').empty()
            if (this.value == 'select') {
                $('#addOpsi').append(`<div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Pilihan Opsi</label>
                            <input type="text" class="form-control options" name="end" placeholder="Opsi Select" />
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group ">
                            <label for="type">Action</label>
                            <div class="btn btn-success " onClick='addOption()'>Tambah</div>
                        </div>
                    </div>
                </div>
                Pilihan<br><hr>
                <div id='valueOption'></div>

                `)
            }
        });

        function addOption() {
            $('#valueOption').append('<div>' + $('.options').val() + '</div><input type="hidden" class="form-control optionform" name="subform[]" value="' + $('.options').val() + '" />')
            $('.options').val('')
            console.log($("input[name='subform[]']")
                .map(function () {
                    return $(this).val();
                }).get())
        }

        function detailForm(id) {
            $('#modalDetailForm').modal('show');
            sessionStorage.setItem("idform", id)

            reloadDatatableForm()
        }

         async function detailResponden(id) {
            await $('#modalDetailResponden').modal('show');
            await sessionStorage.setItem("idresponden", id)
             await $('#headtable').empty()
             var data =await 0;
               await  $.ajax({
                        url: '/admin/componentform/'+id,
                        type: "get",
                        cache: false,

                        success: function (result) {
                            data = result
                            sessionStorage.setItem("headform", result)
                        },
                        error: function (result) {
                            $('#modalForm').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    }).then(function(){
                           $('#headtable').append(`   <th width="10%">No</th>`)
                        data.forEach(function(item){
                                $('#headtable').append(`<th>`+item+`</th>`)
                        })
                          $('#headtable').append(`<th width="20%">Action</th>`)

                    })

            reloadDatatableResponden()
        }

        $(function () {
            $('#modalAddForm form').on('submit', function (e) {
                e.preventDefault();
                saveForm();
            });
        });

        function saveForm() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Input!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var screen = $("#screen").val();

                    $.ajax({
                        url: '/admin/subevent/saveform',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            id: idForm,
                            input: $('.input').val(),
                            type: $('.type').val(),
                            require: $('.require').val(),
                            option: $("input[name='subform[]']")
                                .map(function () {
                                    return $(this).val();
                                }).get(),
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
                        'Input Berhasil ditambahkan',
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

        function deleteForm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Input Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var screen = $("#screen").val();

                    $.ajax({
                        url: '/admin/form/' + id,
                        type: "DELETE",

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableForm();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Input Berhasil dihapus',
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
        async function editForm(id) {
             $('#modalDetailForm').modal('hide');
            let data;
            await  $.ajax({
                        url: '/admin/subevent/getform/'+id,
                        type: "get",
                        cache: false,
                        dataType: 'json',

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            data = result;
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
                   await  console.log(data)
                   $('.inputEdit').val(data.name)
                   $('#idEdit').val(data.id)
                   $('.typeEdit option[value="' + data.type +'"]').prop("selected", true);
                   $('.requireEdit option[value="' + data.require+'"]').prop("selected", true);
                   $('#modalEditForm').modal('show');
        }

        $('#simpanEdit').on('click',function(e){
            e.preventDefault()
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Mengubah Input Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: '/admin/subevent/updateform/'+$('#idEdit').val(),
                        type: "put",
                        cache: false,
                        dataType: 'json',
                        data: {
                            id: $('#idEdit').val(),
                            input: $('.inputEdit').val(),
                            type: $('.typeEdit').val(),
                            require: $('.requireEdit').val(),
                            option: $("input[name='subform[]']")
                                .map(function () {
                                    return $(this).val();
                                }).get(),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                           $('#modalEditForm').modal('hide');
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
                        'Input Berhasil diubah',
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

        })

    </script>

    <script>
        /** set data untuk edit**/
        function setData(result) {
            $('input[name=id]').val(result.id);
            $('input[name=name]').val(result.name);
            $('.desc').val(result.description);
            $('input[name=start_regist]').val(result.start_regist);
            $('input[name=end_regist]').val(result.end_regist);
        }


        /** reload dataTable Setelah mengubah data**/
        function reloadDatatable() {
            dataTable.ajax.reload();
        }

        function reloadDatatableForm() {

         $('#detailForm').dataTable().fnClearTable();
             $('#detailForm').dataTable().fnDestroy();
        let dataTable2 = $('#detailForm').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                className: 'btn btn-warning btn-sm mr-2',
                text: 'Reload',
                action: function (e, dt, node, config) {
                    reloadDatatableForm();
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
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlform,
                 type: 'POST',
               data: {
                   id:sessionStorage.getItem("idform")
               },
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
                    data: 'type',
                    orderable: true
                },
                {
                    data: 'require_stat',
                    orderable: true
                },
                {
                    data: 'option',
                    orderable: true
                },
                {
                    data: 'action',
                    name: '#',
                    orderable: false
                },
            ]
        });
        }
        function deleteRespon(data){
             const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Responden Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var screen = $("#screen").val();

                    $.ajax({
                        url: '/admin/deleteresponden/' + data,
                        type: "DELETE",

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableResponden();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Responden Berhasil dihapus',
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

        async function reloadDatatableResponden() {
                var columner = await [
                {
                    data: 'DT_RowIndex',
                    orderable: false
                },
            ]
             var col = await sessionStorage.getItem('headform').split(",")
             await col.forEach(function(item){

                columner.push( {
                    data: item,
                    orderable: true
                      },
                        )
                        })
                     columner.push(
                            {
                    data: 'action',
                    name: '#',
                    orderable: false
                },
                 )
         $('#detailResponden').dataTable().fnClearTable();
            $('#detailResponden').dataTable().fnDestroy();
        let dataTable3 = await $('#detailResponden').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                className: 'btn btn-warning btn-sm mr-2',
                text: 'Reload',
                action: function (e, dt, node, config) {
                    reloadDatatableResponden();
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
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlresponden,
                 type: 'POST',
               data: {
                   id:sessionStorage.getItem("idresponden")
               },
                },
            columns: columner
        });
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
