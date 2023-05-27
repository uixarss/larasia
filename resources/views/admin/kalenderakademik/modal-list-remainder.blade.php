<div class="modal fade" id="modalListRemainder" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Title Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="message"></div>

                <form id="formListRemainder">
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Judul List Kalender Akademik</label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" id="title">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start" class="col-sm-4 col-form-label">Mulai</label>
                        <div class="col-sm-8">
                            <input type="text" name="start" class="form-control time" id="start" placeholder="07:00:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-4 col-form-label">Selesai</label>
                        <div class="col-sm-8">
                            <input type="text" name="end" class="form-control time" id="end" placeholder="09:00:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color" class="col-sm-4 col-form-label">Warna List Kalender Akademik</label>
                        <div class="col-sm-8">
                            <input type="color" name="color" class="form-control" id="color">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger deleteListRemainder">Hapus</button>
                <button type="button" class="btn btn-success saveListRemainder">Simpan</button>
            </div>
        </div>
    </div>
</div>
