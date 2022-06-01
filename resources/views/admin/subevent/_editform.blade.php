<div class="modal fade " id="modalEditForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <form method="PUT">
                @csrf
                @method('PUT')
                <input id="idEdit" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Edit Form Pendaftaran</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Nama Input</label>
                                    <input type="text" class="form-control inputEdit" name="input" placeholder="Nama Input" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group ">
                                    <label for="type">Jenis Input</label>
                                    <select class="form-control show-tick typeEdit" name="type_id" id="type" required>
                                        <option disabled selected value>---- Pilih Salah Satu ----</option>
                                        <option value="text">Text</option>
                                        <option value="select">Select</option>
                                        <option value="number">Number</option>
                                        <option value="file">File</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <label for="type">Status Isi</label>
                                    <select class="form-control show-tick requireEdit" name="require"  required>
                                        <option disabled selected value>---- Pilih Salah Satu ----</option>
                                        <option value="1">Wajib di Isi</option>
                                        <option value="0">Optional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group ">
                                    <label for="type">Action</label>
                                    <button type="submit" id="simpanEdit"  class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div id="addOpsi">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
