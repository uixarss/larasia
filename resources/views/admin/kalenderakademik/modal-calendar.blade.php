
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Title Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="message"></div>

        <form id="formEvent">
          <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Judul Kalender Akademik</label>
            <div class="col-sm-8">
              <input type="hidden" name="id">
              <input type="text" name="title" class="form-control" id="title">
            </div>
          </div>
          <div class="form-group row">
            <label for="start" class="col-sm-4 col-form-label">Tanggal Mulai</label>
            <div class="col-sm-8">
              <input type="text" name="start" class="form-control date-time" id="start">
            </div>
          </div>
          <div class="form-group row">
            <label for="end" class="col-sm-4 col-form-label">Tanggal Selesai</label>
            <div class="col-sm-8">
              <input type="text" name="end" class="form-control date-time" id="end">
            </div>
          </div>
          <div class="form-group row">
            <label for="color" class="col-sm-4 col-form-label">Warna Kalender Akademik</label>
            <div class="col-sm-8">
              <input type="color" name="color" class="form-control" id="color">
            </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-sm-4 col-form-label">Deskripsi Kalender Akademik</label>
            <div class="col-sm-8">
              <textarea name="description" rows="4" cols="40" id="description"></textarea>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger deleteEvent">Hapus</button>
        <button type="submit" class="btn btn-primary saveEvent">Simpan</button>
      </div>
    </div>
  </div>
</div>
