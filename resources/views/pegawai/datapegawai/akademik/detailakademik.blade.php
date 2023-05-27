@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="{{ route('pegawai.datapegawai.index') }}">Data Pegawai</a></li>
  <li>Detail Pegawai Akademik</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Detail Pegawai Akademik</h3>
  </div>
  <div class="panel-body">

    <!-- START TABS -->
    <div class="panel panel-default tabs">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Data Pribadi</a></li>
        <li><a href="#tab-second" role="tab" data-toggle="tab">Gaji Pegawai</a></li>
        <li><a href="#tab-third" role="tab" data-toggle="tab">Data Sertifikasi</a></li>
        <li><a href="#tab-fourth" role="tab" data-toggle="tab">Data Pendidikan</a></li>
        <li><a href="#tab-five" role="tab" data-toggle="tab">Data Pekerjaan</a></li>
      </ul>
      <div class="panel-body tab-content">
        <div class="tab-pane active" id="tab-first">

          <div class="row">

            <div class="col-md-3">

              <div class="panel panel-default">
                <div class="panel-body profile">
                  <div class="profile-image">
                    <img src="{{asset('admin/assets/images/users/user4.jpg')}}" alt="Nadia Ali">
                  </div>
                  <div class="profile-data">
                    <div class="profile-data-name">{{$guru->nama_lengkap}}</div>
                    <div class="profile-data-title" style="color: #FFF;">Singer-Songwriter</div>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-camera"></span>
                        <input class="fileinput btn-info" type="file" name="filename3" id="filename3" data-filename-placement="inside" title=" Pilih Foto">
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-8">
              <form action="{{route('pegawai.akademik.update',['id' => $guru->id])}}" id="form_update_data" method="post">
                @csrf
                <div class="panel-body">

                  <div class="form-group">
                    <label class="col-md-3 control-label">NIP Pegawai</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="text" class="form-control" id="NIP" name="NIP" value="{{$guru->NIP}}">
                      </div>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Nama Pegawai</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$guru->nama_lengkap}}">
                      </div>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Bagian Akademik</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="text" class="form-control" id="bagian_akademik" name="bagian_akademik" value="{{$guru->bagian_pegawai}}" disabled>
                      </div>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Jabatan Pegawai</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="text" class="form-control" id="jabatan_pegawai" name="jabatan_pegawai" value="{{$guru->jabatan_pegawai}}">
                      </div>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Status Pegawai</label>
                    <div class="col-md-9">
                      <select class="form-control select" id="status" name="status" style="display: none;">
                        <option value="PNS" {{($guru->status_pegawai == 'PNS') ? 'selected' : ''}}>PNS</option>
                        <option value="CPNS" {{($guru->status_pegawai == 'CPNS') ? 'selected' : ''}}>CPNS</option>
                        <option value="HONORER " {{($guru->status_pegawai == 'HONORER') ? 'selected' : ''}}>HONORER</option>
                      </select>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal Masuk</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{$guru->tanggal_masuk}}">
                      </div>
                      <span class="help-block">.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Alamat Lengkap</label>
                    <div class="col-md-9 col-xs-12">
                      <textarea class="form-control" id="alamat" name="alamat" rows="5">{{$guru->alamat}}</textarea>
                    </div>
                    <span class="help-block">.</span>
                  </div>

                </div>


            </div>
            <div class="panel-footer">
              <button class="btn btn-primary pull-right" id="submit">Update Data</button>
            </div>
            </form>
          </div>

        </div>

        <div class="tab-pane " id="tab-second">

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Gaji Pegawai</h3>
              <ul class="panel-controls">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a class="" data-toggle="modal" data-target="#tambahGaji"><span class="fa fa-plus-circle"></span></a></li>
              </ul>
            </div>
            <div class="panel-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Gaji</th>
                    <th>Status</th>
                    <th>Jadwal Kenaikan Gaji</th>
                    <th>Jumlah Gaji</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($guru->gajis as $gaji)
                  <tr>
                    <td>{{$gaji->tanggal}}</td>
                    <td>Rp {{number_format($gaji->jumlah_gaji,2)}}</td>
                    <td>{{$gaji->status}}</td>
                    <td>{{$gaji->tanggal_kenaikan_gaji}}</td>
                    <td>Rp. {{number_format($gaji->jumlah_kenaikan_gaji,2)}}-</td>
                    <td>{{$gaji->keterangan}}</td>
                    <td align="center">
                      <a class="btn btn-success" data-toggle="modal" data-target="#editGaji{{$gaji->id}}">Edit</a>
                      <a href="{{route('pegawai.akademik.delete.gaji', ['id' => $guru->id , 'id_gaji' => $gaji->id] )}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal EDIT-->
                  <div class="modal fade" id="editGaji{{$gaji->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h5 class="modal-title" id="staticBackdropLabel">Edit Gaji</h5>
                        </div>
                        <div class="modal-body">

                          <form action="{{route('pegawai.akademik.update.gaji', ['id' => $guru->id , 'id_gaji' => $gaji->id] )}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                              <label for="exampleInputEmail1">Tanggal</label>
                              <input name="tanggal" type="date" class="form-control" value="{{$gaji->tanggal}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Jumlah Gaji</label>
                              <input name="jumlah_gaji" type="number" class="form-control" value="{{$gaji->jumlah_gaji}}">
                            </div>

                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control select" id="status" name="status" style="display: none;">
                                <option value="Aktif" {{($gaji->status == 'Aktif') ? 'selected' : ''}}>Aktif</option>
                                <option value="Non Aktif" {{($gaji->status == 'Non Aktif') ? 'selected' : ''}}>Non Aktif</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Jadwal Kenaikan Gaji</label>
                              <input name="tanggal_kenaikan_gaji" type="date" class="form-control" value="{{$gaji->tanggal_kenaikan_gaji}}">
                            </div>



                            <div class="form-group">
                              <label for="exampleInputEmail1">Jumlah Gaji</label>
                              <input name="jumlah_kenaikan_gaji" type="number" class="form-control" value="{{$gaji->jumlah_kenaikan_gaji}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <input name="keterangan" type="text" class="form-control" value="{{$gaji->keterangan}}">
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
                  @endforeach


                </tbody>
              </table>
            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

          <!-- Modal Tambah Gaji-->
          <div class="modal fade" id="tambahGaji" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Gaji</h5>
                </div>
                <div class="modal-body">

                  <form action="{{route('pegawai.akademik.tambah.gaji', ['id' => $guru->id] )}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal</label>
                      <input name="tanggal" type="date" class="form-control" placeholder="Tanggal">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Gaji</label>
                      <input name="jumlah_gaji" type="number" class="form-control" placeholder="Jumlah Gaji">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jadwal Kenaikan Gaji</label>
                      <input name="tanggal_kenaikan_gaji" type="date" class="form-control" placeholder="Jadwal Kenaikan Gaji">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Gaji</label>
                      <input name="jumlah_kenaikan_gaji" type="number" class="form-control" placeholder="Jumlah Gaji">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
                      <input name="keterangan" type="text" class="form-control" placeholder="Keterangan">
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

        <div class="tab-pane" id="tab-third">

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Data Sertifikasi</h3>
              <ul class="panel-controls">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a class="" data-toggle="modal" data-target="#tambahSertifikasi"><span class="fa fa-plus-circle"></span></a></li>
              </ul>
            </div>
            <div class="panel-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Sertifikasi</th>
                    <th>Lembaga</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($guru->sertifikats as $sertifikat)
                  <tr>
                    <td>{{$sertifikat->sertifikasi}}</td>
                    <td>{{$sertifikat->lembaga}}</td>
                    <td>{{$sertifikat->tahun}}</td>
                    <td>{{$sertifikat->status}}</td>
                    <td>{{$sertifikat->keterangan}}</td>
                    <td align="center">
                      <a class="btn btn-success" data-toggle="modal" data-target="#editSertifikasi{{$sertifikat->id}}">Edit</a>
                      <a href="{{route('pegawai.akademik.delete.sertifikat', ['id' => $guru->id , 'id_sertifikat' => $sertifikat->id] )}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal EDIT-->
                  <div class="modal fade" id="editSertifikasi{{$sertifikat->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h5 class="modal-title" id="staticBackdropLabel">Edit Sertifikasi</h5>
                        </div>
                        <div class="modal-body">

                          <form action="{{route('pegawai.akademik.update.sertifikat', ['id' => $guru->id, 'id_sertifikat' => $sertifikat->id] )}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                              <label for="exampleInputEmail1">Sertifikasi</label>
                              <input name="sertifikasi" type="text" class="form-control" value="{{$sertifikat->sertifikasi }}r">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Lembaga</label>
                              <input name="lembaga" type="text" class="form-control" value="{{$sertifikat->lembaga}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Tahun</label>
                              <input name="tahun" type="year" class="form-control" value="{{$sertifikat->tahun }}">
                            </div>

                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Status</label>
                              <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <input name="keterangan" type="text" class="form-control" value="{{$sertifikat->keterangan }}">
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

                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

          <!-- Modal Tambah Sertifikasi-->
          <div class="modal fade" id="tambahSertifikasi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Sertifikasi

                  </h5>
                </div>
                <div class="modal-body">

                  <form action="{{route('pegawai.akademik.tambah.sertifikat', ['id' => $guru->id] )}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="exampleInputEmail1">Sertifikasi</label>
                      <input name="sertifikasi" type="text" class="form-control" placeholder="Pengajar">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Lembaga</label>
                      <input name="lembaga" type="text" class="form-control" placeholder="Pendidikan">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun</label>
                      <input name="tahun" type="year" class="form-control" placeholder="2019">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Status</label>
                      <select class="form-control" name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Non Aktif">Non Aktif</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
                      <input name="keterangan" type="text" class="form-control" placeholder="-">
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

        <div class="tab-pane" id="tab-fourth">

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Data Pendidikan</h3>
              <ul class="panel-controls">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a class="" data-toggle="modal" data-target="#tambahPendidikan"><span class="fa fa-plus-circle"></span></a></li>
              </ul>
            </div>
            <div class="panel-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>tingkat</th>
                    <th>Nama Pendidikan</th>
                    <th>Lulus</th>
                    <th>Status</th>
                    <th>Surat Keputusan</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($guru->pendidikans as $pendidikan)
                  <tr>
                    <td>{{$pendidikan->tingkat}}</td>
                    <td>{{$pendidikan->nama_pendidikan}}</td>
                    <td>{{$pendidikan->tahun_lulus}}</td>
                    <td>{{$pendidikan->status}}</td>
                    <td>{{$pendidikan->surat_keputusan}}</td>
                    <td>{{$pendidikan->keterangan}}</td>
                    <td align="center">
                      <a class="btn btn-success" data-toggle="modal" data-target="#editPendidikan{{$pendidikan->id}}">Edit</a>
                      <a href="{{route('pegawai.akademik.delete.pendidikan', ['id' => $guru->id , 'id_pendidikan' => $pendidikan->id] )}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal EDIT-->
                  <div class="modal fade" id="editPendidikan{{$pendidikan->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h5 class="modal-title" id="staticBackdropLabel">Edit Pendidikan</h5>
                        </div>
                        <div class="modal-body">

                          <form action="{{route('pegawai.akademik.update.pendidikan', ['id' => $guru->id , 'id_pendidikan' => $pendidikan->id ] )}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Tingkat</label>
                              <input name="tingkat" type="text" class="form-control" value="{{$pendidikan->tingkat}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Nama Pendidikan</label>
                              <input name="nama_pendidikan" type="texts" class="form-control" value="{{$pendidikan->nama_pendidikan}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Lulus</label>
                              <input name="tahun_lulus" type="text" class="form-control" value="{{$pendidikan->tahun_lulus}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Status</label>
                              <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                              </select>
                            </div>


                            <div class="form-group">
                              <label for="exampleInputEmail1">Surat Keputusan</label>
                              <input name="surat_keputusan" type="texts" class="form-control" value="{{$pendidikan->surat_keputusan}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <input name="keterangan" type="texts" class="form-control" value="{{$pendidikan->keterangan}}">
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
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

          <!-- Modal Tambah Pendidikan-->
          <div class="modal fade" id="tambahPendidikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Pendidikan</h5>
                </div>
                <div class="modal-body">

                  <form action="{{route('pegawai.akademik.tambah.pendidikan', ['id' => $guru->id] )}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                      <label for="exampleInputEmail1">Tingkat</label>
                      <input name="tingkat" type="text" class="form-control" placeholder="Tingkat">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pendidikan</label>
                      <input name="nama_pendidikan" type="texts" class="form-control" placeholder="Nama Pendidikan">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Lulus</label>
                      <input name="tahun_lulus" type="text" class="form-control" placeholder="Lulus">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Status</label>
                      <select class="form-control" name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Non Aktif">Non Aktif</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Surat Keputusan</label>
                      <input name="surat_keputusan" type="texts" class="form-control" placeholder="Surat Keputusan">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
                      <input name="keterangan" type="texts" class="form-control" placeholder="Keterangan">
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

        <div class="tab-pane" id="tab-five">

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Data Pekerjaan</h3>
              <ul class="panel-controls">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a class="" data-toggle="modal" data-target="#tambahPekerjaan"><span class="fa fa-plus-circle"></span></a></li>
              </ul>
            </div>
            <div class="panel-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Tahun Awal</th>
                    <th>Tahun Akhir</th>
                    <th>Tempat</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($guru->pekerjaans as $pekerjaan)
                  <tr>
                    <td>{{$pekerjaan->tahun_awal}}</td>
                    <td>{{$pekerjaan->tahun_akhir}}</td>
                    <td>{{$pekerjaan->tempat}}</td>
                    <td>{{$pekerjaan->jabatan}}</td>
                    <td>{{$pekerjaan->status}}</td>
                    <td>{{$pekerjaan->keterangan}}</td>
                    <td align="center">
                      <a class="btn btn-success" data-toggle="modal" data-target="#editPekerjaan{{$pekerjaan->id}}">Edit</a>
                      <a href="{{route('pegawai.akademik.delete.pekerjaan', ['id' => $guru->id , 'id_pekerjaan' => $pekerjaan->id] )}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal EDIT-->
                  <div class="modal fade" id="editPekerjaan{{$pekerjaan->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h5 class="modal-title" id="staticBackdropLabel">Edit Pekerjaan</h5>
                        </div>
                        <div class="modal-body">

                          <form action="{{route('pegawai.akademik.update.pekerjaan' , ['id' => $guru->id ,'id_pekerjaan' => $pekerjaan->id ] )}}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                              <label for="exampleInputEmail1">Tahun Awal</label>
                              <input name="tahun_awal" type="number" class="form-control" value="{{$pekerjaan->tahun_awal}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Tahun Akhir</label>
                              <input name="tahun_akhir" type="number" class="form-control" value="{{$pekerjaan->tahun_akhir}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Tempat</label>
                              <input name="tempat" type="text" class="form-control" value="{{$pekerjaan->tempat}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Jabatan</label>
                              <input name="jabatan" type="text" class="form-control" value="{{$pekerjaan->jabatan}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Status</label>
                              <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <input name="keterangan" type="texts" class="form-control" value="{{$pekerjaan->keterangan}}">
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
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

          <!-- Modal Tambah Pekerjaan-->
          <div class="modal fade" id="tambahPekerjaan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Pekerjaan</h5>
                </div>
                <div class="modal-body">

                  <form action="{{route('pegawai.akademik.tambah.pekerjaan' , ['id' => $guru->id ] )}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun Awal</label>
                      <input name="tahun_awal" type="number" class="form-control" placeholder="2017">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun Akhir</label>
                      <input name="tahun_akhir" type="number" class="form-control" placeholder="2019">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tempat</label>
                      <input name="tempat" type="text" class="form-control" placeholder="SMA 1 Cirebon">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan</label>
                      <input name="jabatan" type="text" class="form-control" placeholder="Wakasek">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Status</label>
                      <select class="form-control" name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Non Aktif">Non Aktif</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
                      <input name="keterangan" type="texts" class="form-control" placeholder="-">
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
    <!-- END TABS -->


  </div>
</div>
<!-- END DEFAULT DATATABLE -->

@stop

@section('data-scripts')
<script>
  var form = $('form_update_data');
  $(document).ready(function() {


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // form.submit(function(e) {
    //   e.preventDefault();


    // });

    // $('#submit').click(function() {
    //   console.log('click');

    //   var nama_lengkap = document.getElementById('nama_lengkap').value;
    //   var bagian_akademik = document.getElementById('bagian_akademik').value;
    //   var jabatan_pegawai = document.getElementById('jabatan_pegawai').value;
    //   var status = document.getElementById('status').value;
    //   var tanggal_masuk = document.getElementById('tanggal_masuk').value;
    //   var alamat = document.getElementById('alamat').value;

    //   $.ajax({
    //     type: form.attr('method'),
    //     url: form.attr('action'),
    //     data: form.serialize(),
    //     success: function(data) {

    //       console.log('Submission was successful.');
    //       console.log(data);
    //       alert(data);
    //     },
    //     error: function(data) {
    //       console.log('An error occurred.');
    //       console.log(data);
    //     },
    //   });





    //   console.log(nama_lengkap, bagian_akademik, jabatan_pegawai, status, tanggal_masuk, alamat);

    // });
  });
</script>
@stop