<div class="modal fade " id="modalDetailForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('POST')
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Form Pendaftaran</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="detailForm" class="table table-bordered  m-t-30" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Nama Input</th>
                                        <th>Jenis Input</th>
                                        <th>Opsi</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
