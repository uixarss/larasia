@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Data Pelajaran</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Data Pelajaran</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <div class="col-md-5">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Jenis Mata Pelajaran</h3>
            <ul class="panel-controls">
              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              <li><a class="" data-toggle="modal" data-target="#tambahMapel"><span class="fa fa-plus-circle"></span></a></li>
            </ul>
          </div>
          <div class="panel-body table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th width="100">Nama Mapel</th>
                  <th width="100">Tipe Mata Pelajaran</th>
                  <th width="100">Jumlah Jam</th>
                  <th>Hari MGMP</th>
                  <th width="100">Keterangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_mapel as $mapel)
                <tr>
                  <td>{{$mapel->nama_mapel}}</td>
                  <td>{{$mapel->tipemapel->tipe_pelajaran ?? ''}}</td>
                  <td>{{$mapel->jumlah_jam}}</td>
                  <td>{{$mapel->hari->hari ?? ''}}</td>
                  <td>{{$mapel->keterangan ?? ''}}</td>
                  <td align="center">
                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#editMapel{{$mapel->id}}">Edit</a>
                    <a href="{{route('admin.matapelajaran.destroy',['id' => $mapel->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                  </td>
                </tr>

                <!-- MMODAL EDIT MATA PELAJARAN-->
                <div class="modal fade" id="editMapel{{$mapel->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Mata pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="{{route('admin.matapelajaran.update', $mapel->id)}}" method="post">
                          {{csrf_field()}}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Kode Mapel</label>
                            <input name="kode_mapel" type="text" class="form-control" value="{{$mapel->id}}" placeholder="Masukan ID" disabled>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mapel</label>
                            <input name="nama_mapel" type="texts" class="form-control" value="{{$mapel->nama_mapel}}" placeholder="Masukan Mata Pelajaran">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Tipe</label>
                            <select name="tipe_mapel_id" class="form-control select" data-live-search="true" required>
                              <option value="tipe_mapel_id">-Jenis Tipe Mata Pelajaran-</option>
                              @foreach($data_tipemapel as $tipemapel)
                              <option value="{{$tipemapel->id}}" {{($tipemapel->id == $mapel->tipe_mapel_id) ? 'selected' : ''}}>{{$tipemapel->tipe_pelajaran}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jumlah Jam</label>
                            <input name="jumlah_jam" type="number" class="form-control" value="{{$mapel->jumlah_jam}}" placeholder="Masukan Jumlah Jam">
                          </div>

                          <div class="form-group">
                            <label for="">Hari MGMP</label>
                            <select name="hari_id" id="hari_id" class="form-control select">
                              <option value="">-- Pilih hari MGMP --</option>
                              @foreach($data_hari as $hari)
                              <option value="{{$hari->id}}" {{($hari->id == $mapel->hari_id) ? 'selected' : ''}}>{{$hari->hari}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="">Keterangan</label>
                            <select name="keterangan" id="" class="form-control select">
                              <option value="">-- Pilih keterangan</option>
                              <option value="-"{{($mapel->keterangan == '-') ? 'selected' : ''}}>-</option>
                              <option value="Eksak" {{($mapel->keterangan == 'Eksak') ? 'selected' : ''}}>Eksak</option>
                            </select>
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

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
        <!-- END DEFAULT DATATABLE -->


        <!-- MODAL TAMBAH MAPEL-->
        <div class="modal fade" id="tambahMapel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Mata pelajaran</h5>
              </div>
              <div class="modal-body">

                <form action="{{route('admin.matapelajaran.create')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kode Mapel</label>
                    <input name="kode_mapel" type="text" class="form-control" placeholder="Masukan ID">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Mapel</label>
                    <input name="nama_mapel" type="texts" class="form-control" placeholder="Masukan Mata Pelajaran">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipe</label>
                    <select name="tipe_mapel_id" class="form-control select" data-live-search="true" required>
                      <option value="tipe_mapel_id">-Jenis Tipe Mata Pelajaran-</option>

                      @foreach($data_tipemapel as $tipemapel)
                      <option value="{{$tipemapel->id}}">{{$tipemapel->tipe_pelajaran}}</option>
                      @endforeach

                    </select>
                  </div>


                  <div class="form-group">
                    <label for="jumlah_jam">Jumlah Jam</label>
                    <input name="jumlah_jam" type="number" class="form-control" placeholder="Masukan Jumlah Jam">
                  </div>

                  <div class="form-group">
                    <label for="">Hari MGMP</label>
                    <select name="hari_id" id="hari_id" class="form-control select">
                      <option value="">-- Pilih hari MGMP --</option>
                      @foreach($data_hari as $hari)
                      <option value="{{$hari->id}}">{{$hari->hari}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Keterangan</label>
                    <select name="keterangan" id="" class="form-control select">
                      <option value="">-- Pilih keterangan</option>
                      <option value="-">-</option>
                      <option value="Eksak">Eksak</option>
                    </select>
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

      <div class="col-md-4">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Waktu Pelajaran</h3>
            <ul class="panel-controls">
              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              <li><a class="" data-toggle="modal" data-target="#tambahJamMapel"><span class="fa fa-plus-circle"></span></a></li>
            </ul>
          </div>
          <div class="panel-body table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_waktu as $waktu)
                <tr>
                  <td>{{$waktu->jam_masuk}}</td>
                  <td>{{$waktu->jam_keluar}}</td>
                  <td align="center">
                    <a class="btn btn-success" data-toggle="modal" data-target="#editJamMapel{{$waktu->id}}">Edit</a>
                    <a href="{{route('admin.waktu.destroy',['id' => $waktu->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                  </td>
                </tr>

                <!-- MODAL EDIT WAKTU PELAJARAN-->
                <div class="modal fade" id="editJamMapel{{$waktu->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Jam Mata pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="{{route('admin.waktu.update',['id' => $waktu->id])}}" method="post" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group">
                            <label for="exampleInputEmail1">Jam Masuk</label>
                            <input name="jam_masuk" type="time" class="form-control" value="{{$waktu->jam_masuk}}">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Jam Keluar</label>
                            <input name="jam_keluar" type="time" class="form-control" value="{{$waktu->jam_keluar}}">
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

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

        <!-- MODAL TAMBAH JAM MAPEL-->
        <div class="modal fade" id="tambahJamMapel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Jam Mata Pelajaran</h5>
              </div>
              <div class="modal-body">

                <form action="{{route('admin.waktu.add')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input name="jam_masuk" type="time" class="form-control" placeholder="-">
                  </div>

                  <div class="form-group">
                    <label for="jam_keluar">Jam Keluar</label>
                    <input name="jam_keluar" type="time" class="form-control" placeholder="-">
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

      <div class="col-md-3">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Hari Aktif</h3>
            <ul class="panel-controls">
              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              <li><a class="" data-toggle="modal" data-target="#tambahHari"><span class="fa fa-plus-circle"></span></a></li>
            </ul>
          </div>
          <div class="panel-body table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Hari</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_hari as $hari)
                <tr>
                  <td>{{$hari->id}}</td>
                  <td>{{$hari->hari}}</td>

                  <td align="center">
                    <a class="btn btn-success" data-toggle="modal" data-target="#editHari{{$hari->id}}">Edit</a>
                    <a href="{{route('admin.hari.destroy',['id' => $hari->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                  </td>
                </tr>

                <!-- MODAL EDIT HARI -->
                <div class="modal fade" id="editHari{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Hari</h5>
                      </div>
                      <div class="modal-body">

                        <form action="{{route('admin.hari.update',['id' => $hari->id])}}" method="post" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group">
                            <label for="hari">Hari</label>
                            <input name="hari" type="text" class="form-control" value="{{$hari->hari}}">
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

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

        <!-- MODAL TAMBAH HARI -->
        <div class="modal fade" id="tambahHari" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Hari</h5>
              </div>
              <div class="modal-body">

                <form action="{{route('admin.hari.add')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="hari">Hari</label>
                    <input name="hari" type="text" class="form-control" placeholder="">
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
  </div>
</div>

@stop