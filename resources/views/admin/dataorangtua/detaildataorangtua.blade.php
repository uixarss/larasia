@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{ route('admin.dataorangtua.index') }}">Data Orang Tua</a></li>
    <li>Detail Data Orang Tua</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detail Data Orang Tua</h3>
    </div>
    <div class="panel-body">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
          <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Data Pribadi</a></li>
              <li><a href="#tab-second" role="tab" data-toggle="tab">Data Pendidikan</a></li>
              <li><a href="#tab-third" role="tab" data-toggle="tab">Data Pembayaran</a></li>
          </ul>
          <div class="panel-body tab-content">

              <div class="tab-pane active" id="tab-first">

                <div class="row">

                  <div class="col-md-3">

                      <div class="panel panel-default">
                          <div class="panel-body profile">
                              <div class="profile-image">
                                  <img src="{{asset('admin/assets/images/users/user.jpg')}}" alt="Nadia Ali">
                              </div>
                              <div class="profile-data">
                                  <div class="profile-data-name">Supratman Herman</div>
                                  <div class="profile-data-title" style="color: #FFF;">Nama Siswa</div>
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

                    <div class="panel-body">

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-4 control-label">ID Orang Tua</label>
                                <div class="col-md-">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"  value="2">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Lengkap</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"  value="Supratman Herman">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Jenis Kelamin</label>
                                <div class="col-md-9">
                                    <select class="form-control select" style="display: none;">
                                        <option>Laki-Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">No Hp</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="number" class="form-control datepicker" value="08976527322">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="email" class="form-control"  value="herman@gmail.com">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"  value="S1">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                              </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Pekerjaan</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"  value="Polisi">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Penghasilan</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"  value="Rp 7.500.000,-">
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Alamat Lengkap</label>
                                <div class="col-md-9 col-xs-12">
                                    <textarea class="form-control" rows="5">jln Cirebon 1 Tuparev </textarea>
                                </div>
                                <span class="help-block">.</span>
                            </div>

                          </div>

                        </div>

                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update Data</button>
                </div>

              </div>

              <div class="tab-pane" id="tab-second">
                  <div class="row">

                    <div class="col-md-6">

                      <div class="form-group">
                          <label class="col-md-3 control-label">Asal Sekolah SD/MI</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="SD Negeri 1 Cirebon">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Asal Sekolah SMP/MTs</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="SMP Negeri 1 Cirebon">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Asal Sekolah SMA/MA/SMK</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="SMA Negeri 1 Cirebon">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">S1</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="Universitas Teknologi Bandung">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">S2</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="-">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">S3</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="-">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </div>
              </div>

              <div class="tab-pane" id="tab-third">

                <!-- START TABS -->
                <div class="panel panel-default tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tab-pembayaran" role="tab" data-toggle="tab">Pembayaran</a></li>
                        <li><a href="#tab-riwayat" role="tab" data-toggle="tab">Riwayat Pembayaran</a></li>
                    </ul>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="tab-pembayaran">

                          <!-- START DEFAULT DATATABLE -->
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Data Pembayaran</h3>
                                  <ul class="panel-controls">
                                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                  </ul>
                              </div>
                              <div class="panel-body">
                                  <table class="table datatable">
                                      <thead>
                                          <tr>
                                              <th>Nama Siswa</th>
                                              <th>Kelas</th>
                                              <th>Nama Pembayaran</th>
                                              <th>Jumlah Pembayaran</th>
                                              <th>Tanggal Deadline</th>
                                              <th>Status Pembayaran</th>

                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>Maman Suherman</td>
                                              <td>10 MIA 1</td>
                                              <td>SPP Bulan Maret</td>
                                              <td>Rp 500.000,-</td>
                                              <td>25 Maret 2020</td>
                                              <td>Belum Lunas</td>

                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!-- END DEFAULT DATATABLE -->

                        </div>
                        <div class="tab-pane " id="tab-riwayat">

                          <!-- START DEFAULT DATATABLE -->
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Data Riwayat Pembayaran</h3>
                                  <ul class="panel-controls">
                                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                  </ul>
                              </div>
                              <div class="panel-body">
                                  <table class="table datatable">
                                      <thead>
                                          <tr>
                                              <th>Nama Siswa</th>
                                              <th>Kelas</th>
                                              <th>Nama Pembayaran</th>
                                              <th>Jumlah Pembayaran</th>
                                              <th>Tanggal Deadline</th>
                                              <th>Status Pembayaran</th>

                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>Herman Suherman</td>
                                              <td>10 MIA 1</td>
                                              <td>SPP Bulan Maret</td>
                                              <td>Rp 500.000,-</td>
                                              <td>25 Maret 2020</td>
                                              <td>Lunas</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!-- END DEFAULT DATATABLE -->

                        </div>
                    </div>
                </div>
                <!-- END TABS -->


              </div>

          </div>
      </div>
      <!-- END TABS -->

    </div>
</div>
<!-- END DEFAULT DATATABLE -->

@stop
