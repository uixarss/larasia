@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Jadwal Pelajaran Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Jadwal Pelajaran Siswa</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
        
        <ul class="nav nav-tabs" role="tablist">

          <!-- Kelas 10 Aktif -->
          <li class="active" role="tab" data-toggle="tab">
            <a href="" data-toggle="dropdown" class="dropdown-toggle">Kelas 10</span></a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation" class="dropdown-header">Pilih Kelas 10</li>
              @foreach($data_kelas as $key => $kelas)
              @if($kelas->tingkat == 10)
              @if($key == 0)
              <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @else
              <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @endif
              @endif
              @endforeach
            </ul>
          </li>
          <!-- Kelas 11 -->
          <li role="tab" data-toggle="tab">
            <a href="" data-toggle="dropdown" class="dropdown-toggle">Kelas 11</span></a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation" class="dropdown-header">Pilih Kelas 11</li>
              @foreach($data_kelas as $key => $kelas)
              @if($kelas->tingkat == 11)
              @if($key == 0)
              <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @else
              <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @endif
              @endif
              @endforeach
            </ul>
          </li>
          <!-- Kelas 12 -->
          <li role="tab" data-toggle="tab">
            <a href="" data-toggle="dropdown" class="dropdown-toggle">Kelas 12</span></a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation" class="dropdown-header">Pilih Kelas 12</li>
              @foreach($data_kelas as $key => $kelas)
              @if($kelas->tingkat == 12)
              @if($key == 0)
              <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @else
              <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @endif
              @endif
              @endforeach
            </ul>
          </li>

        </ul>

        <!-- Tabel Kontent Jadwal kelas 10 Sampai Kelas 12 -->
        <div class="panel-body tab-content">

          <!-- TAB KELAS 10 -->
          @foreach($data_kelas as $key => $kelas)
          @if($kelas->tingkat == 10)
          @if($key == 0)

          <div class="tab-pane active" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          @else

          <div class="tab-pane" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          @endif
          @endif
          @endforeach

          <!-- TABS KELAS 11 -->
          @foreach($data_kelas as $key => $kelas)
          @if($kelas->tingkat == 11)
          @if($key == 0)

          <div class="tab-pane active" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          @else

          <div class="tab-pane" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          @endif
          @endif
          @endforeach


          <!-- TABS KELAS 12  -->

          @foreach($data_kelas as $key => $kelas)
          @if($kelas->tingkat == 12)
          @if($key == 0)

          <div class="tab-pane active" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          @else

          <div class="tab-pane" id="{{$kelas->kode_kelas}}">
            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Jadwal Pelajaran {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Tahun Ajaran</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Tahun Ajaran-</option>

                            @foreach($tahun_ajaran as $tahunajaran)
                            <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mapel">Semester</label>
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Pilih Semester-</option>

                            @foreach($data_semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                            @endforeach

                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Waktu</th>
                          @foreach($data_hari as $hari)
                          <th>{{$hari->hari}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_waktu as $waktu)
                        <tr>
                          <td>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</td>
                          @foreach($data_hari as $hari)
                          <td><a class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}"><span class="fa fa-plus-square"></span>Tambah</a></td>

                          <!-- Modal TAMBAH JADWAL-->
                          <div class="modal fade" id="tambahJadwal{{$kelas->kode_kelas}}{{$waktu->id}}{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="" method="">
                                    <!-- @csrf
                                    {{method_field('PUT')}} -->

                                    <div class="row push-down-20">


                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kegiatan</label>
                                        <select class="form-control select">
                                          <option>Pilih Jenis Kegiatan</option>
                                          <option value="Up">Upacara</option>
                                          <option value="KBM">Belajar Mengajar</option>
                                          <option value="Exs">Ekstrakulikuler</option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Mata Pelajaran-</option>

                                          @foreach($mapel as $matpel)
                                          <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="mapel">Waktu</label>
                                        <select name="id_hari" class="form-control select" data-live-search="true" required>
                                          <option value="">-Masukan Waktu-</option>

                                          @foreach($data_waktu as $waktu)
                                          <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
                <!-- END DEFAULT DATATABLE -->

                <!-- Modal TAMBAH DataPegawai-->
                <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
                      </div>
                      <div class="modal-body">

                        <form action="" method="">
                          <!-- @csrf
                          {{method_field('PUT')}} -->

                          <div class="row push-down-20">


                            <div class="form-group">
                              <label for="kelas">Tahun Ajaran</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Tahun Ajaran-</option>

                                @foreach($tahun_ajaran as $tahunajaran)
                                <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                                @endforeach

                              </select>
                            </div>

                            <div class="form-group">
                              <label for="kelas">Semester</label>
                              <select name="id_kelas" class="form-control select" data-live-search="true" required>
                                <option value="">-Masukan Semester-</option>

                                @foreach($data_semester as $semester)
                                <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                                @endforeach

                              </select>
                            </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          @endif
          @endif
          @endforeach

        </div>

      </div>
      <!-- END TABS -->


    </div>
  </div>
</div>

@stop