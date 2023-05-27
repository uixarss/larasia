//GA DI PAKE

@extends('layouts.joliadmin')

@section('content')



  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{ route('admin.jadwalpelajaranguru.index') }}">Jadwal Guru</a></li>
    <li class="active">Buat Jadwal Guru</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Buat Jadwal Guru</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-success">
          <div class="panel-heading ui-draggable-handle">
            <div class="panel-title">
                <h3 class="panel-title">Herman Suherman S.Pd</h3>
            </div>
              <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                  <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                  <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
              </ul>
          </div>
          <div class="panel-heading">
            <div class="row push-down-20">
              <div class="col-md-4">

                <div class="form-group">
                    <label class="control-label">Masukan Hari</label>
                      <select class="form-control select" data-live-search="true">
                        <option>Pilih Hari Pelajaran</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jum'at">Jum'at</option>
                        <option value="Sabtu">JSabtu</option>
                      </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Masukan Jam</label>
                      <select class="form-control select" data-live-search="true">
                        <option>Pilih Jam Pelajaran</option>
                        <option value="Tugas">07:00-07:45</option>
                        <option value="Kuis">07:45-08:15</option>
                        <option value="UTS">08:15-08:45</option>
                        <option value="UTS">10:45-11:15</option>
                        <option value="UTS">11:15-12:00</option>
                      </select>
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Masukan Kelas</label>
                      <select class="form-control select" data-live-search="true">
                          <option>Pilih Kelas</option>
                          <option value="Tugas">10 MIA 1</option>
                          <option value="Kuis">10 MIA 2</option>
                          <option value="UTS">10 MIA 3</option>
                          <option value="UAS">10 IPS 1</option>
                          <option value="UAS">10 IPS 2</option>
                          <option value="UAS">11 MIA 1</option>
                          <option value="UAS">11 MIA 2</option>
                          <option value="UAS">11 MIA 3</option>
                          <option value="UAS">11 IPS 1</option>
                          <option value="UAS">11 IPS 2</option>
                          <option value="UAS">12 MIA 1</option>
                          <option value="UAS">12 IPS 1</option>
                      </select>
                </div>
              </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary pull-right">Simpan Jadwal</button>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">

              <!-- START DEFAULT DATATABLE -->
                  <div class="panel-body">
                      <table class="table datatable">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Hari</th>
                                  <th>Jam</th>
                                  <th>Kelas</th>
                                  <th>Opsi</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Senin</td>
                                  <td>07:00-07:45</td>
                                  <td>10 MIA 1</td>
                                  <td align="center">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#editjadwalguru">Edit</a>
                                    <a href="#" type="button" class="btn btn-danger">Hapus</a>
                                  </td>
                              </tr>

                          </tbody>
                      </table>
                  </div>
              <!-- END DEFAULT DATATABLE -->


              <!-- STRAT MODAL EDIT-->
              <div class="modal fade" id="editjadwalguru" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Pembayaran</h5>
                  </div>
                  <div class="modal-body">

                    <form  action="" method="">
                      <!-- @csrf
                      {{method_field('PUT')}} -->

                        <div class="form-group">
                            <label class="control-label">Masukan Hari</label>
                              <select class="form-control select" data-live-search="true">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                                <option value="Sabtu">JSabtu</option>
                              </select>
                        </div>



                        <div class="form-group">
                            <label class="control-label">Masukan Jam</label>
                              <select class="form-control select" data-live-search="true">
                                <option value="Tugas">07:00-07:45</option>
                                <option value="Kuis">07:45-08:15</option>
                                <option value="UTS">08:15-08:45</option>
                                <option value="UTS">10:45-11:15</option>
                                <option value="UTS">11:15-12:00</option>
                              </select>
                        </div>




                        <div class="form-group">
                            <label class="control-label">Masukan Kelas</label>
                              <select class="form-control select" data-live-search="true">
                                  <option value="Tugas">10 MIA 1</option>
                                  <option value="Kuis">10 MIA 2</option>
                                  <option value="UTS">10 MIA 3</option>
                                  <option value="UAS">10 IPS 1</option>
                                  <option value="UAS">10 IPS 2</option>
                                  <option value="UAS">11 MIA 1</option>
                                  <option value="UAS">11 MIA 2</option>
                                  <option value="UAS">11 MIA 3</option>
                                  <option value="UAS">11 IPS 1</option>
                                  <option value="UAS">11 IPS 2</option>
                                  <option value="UAS">12 MIA 1</option>
                                  <option value="UAS">12 IPS 1</option>
                              </select>
                        </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                  </div>
                </div>
              </div>
              </div>

              <!-- END MODAL EDIT -->

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@stop
