@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Data Kelas</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Data Kelas</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Kelas</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a class="" data-toggle="modal" data-target="#tambahKelas"><span class="fa fa-plus-circle"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kelas</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tingkat</th>
                            <th>Kapasitas</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>K10MIA1</td>
                            <td>10</td>
                            <td>MIA</td>
                            <td>1</td>
                            <td>32 Siswa</td>
                            <td align="center">
                              <a class="btn btn-success" data-toggle="modal" data-target="#editKelas">Edit</a>
                              <button href="#" type="button" class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <!-- Modal EDIT-->
                        <div class="modal fade" id="editKelas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h5 class="modal-title" id="staticBackdropLabel">Edit Kelas</h5>
                            </div>
                            <div class="modal-body">

                              <form  action="{{ route('admin.kelas.update') }}" method="post">
                              {{csrf_field()}}

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Kelas</label>
                                    <input name="kode_kelas" type="text" class="form-control"  value="K10MIA1">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kelas</label>
                                    <input name="nama_kelas" type="number" class="form-control"  value="10">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <input name="nama_jurusan" type="text" class="form-control"  value="MIA">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tingkat</label>
                                    <input name="tingkat" type="number" class="form-control"  value="1">
                                  </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            </div>
                          </div>
                        </div>
                        </div>
                    </tbody>
                </table>

                <!-- Modal Tambah Kelas-->
                <div class="modal fade" id="tambahKelas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="staticBackdropLabel">Tambah Kelas</h5>
                    </div>
                    <div class="modal-body">

                      <form  action="{{ route('admin.kelas.create') }}" method="post">
                      {{csrf_field()}}
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kode Kelas</label>
                          <input name="" type="text" class="form-control"  placeholder="Kode Kelas">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Kelas</label>
                          <input name="" type="number" class="form-control"  placeholder="Kelas">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Jurusan</label>
                          <input name="" type="text" class="form-control"  placeholder="Jurusan">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Tingkat</label>
                          <input name="" type="number" class="form-control" placeholder="Tingkat">
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                    </div>
                  </div>
                </div>
                </div>

            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

      </div>
    </div>
  </div>

@stop
