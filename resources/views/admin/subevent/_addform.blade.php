<div class="modal fade " id="modalAddForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('POST')
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Buat Form Pendaftaran</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Nama Input</label>
                                    <input type="text" class="form-control input" name="input" placeholder="Nama Input" required />
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group ">
                                    <label for="type">Jenis Input</label>
                                    <select class="form-control show-tick type" name="type_id" id="type" required>
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
                                    <label for="type">Action</label>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
