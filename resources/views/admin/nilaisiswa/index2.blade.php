@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Nilai Siswa</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Nilai Siswa</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Nilai Harian</a></li>
                <li><a href="#tab-second" role="tab" data-toggle="tab">Nilai KUIS</a></li>
                <li><a href="#tab-third" role="tab" data-toggle="tab">Nilai UTS</a></li>
                <li><a href="#tab-fourth" role="tab" data-toggle="tab">Nilai UAS</a></li>
                <li><a href="#tab-five" role="tab" data-toggle="tab">Nilai Akhir</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-first">
                  <!-- START DEFAULT DATATABLE -->
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table datatable">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kelas</th>
                              <th>Jumlah Siswa</th>
                              <th>Wali Kelas</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($data_kelas_mapel as $no => $kelas_mapel)
                          @foreach($kelas_mapel->kelas as $kelas)
                            <tr>
                                <td>{{++$no}}</td>
                                <td>{{$kelas->nama_kelas}}</td>
                                <td>{{$kelas->siswa->count()}} Siswa</td>
                                <td>
                                  @foreach($data_kelas_mapel as $wali_kelas)
                                    @if($kelas_mapel->id === $wali_kelas->kelas_id)
                                    {{$wali_kelas->getNamaLengkap($wali_kelas->guru_id)}}
                                    @endif
                                  @endforeach
                                </td>
                                <td align="center">

                                    <form action="{{route('admin.nilaisiswa.show', $kelas->id)}}" method="get">
                                      {{csrf_field()}}
                                      @method('put')
                                      <!-- Degault untuk mata pelajaran ketika pas di klik yaitu matematika id = 1 -->
                                      <input type="hidden" name="mapel_id" value="1">

                                      <button type="submit" class="btn btn-info">Detail Siswa</button>
                                    </form>

                                </td>
                            </tr>
                          @endforeach
                        @endforeach
                      </tbody>
                  </table>
                  </div>
                </div>

                </div>

                <div class="tab-pane" id="tab-second">

                  <div class="col-md-12 push-down-20">


                      <div class="col-md-12">
                        <div class="panel-subtitle">
                            <p>Masukan Kelas dan Mata Pelajaran untuk Menampilkan Data Nilai Kuis Siswa</p>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                            <select name="id_kelas" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                                <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                              @endforeach

                            </select>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Masukan Mata Pelajaran-</option>

                            @foreach($data_mapel as $matpel)
                            <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary pull-right">Cari Data Nilai Kuis</button>
                      </div>

                  </div>

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="push-up-10 push-left-20">Data Nilai Kuis</h3>
                    </div>
                    <ul class="panel-controls push-up-5">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="text-primary  push-left-20">Kelas 10 MIA 1</h3>
                      <h3 class="text-info push-left-20">Matematika</h3>
                        <div class="col-md-12 push-down-0">
                            <div class="col-md-2 col-xs-2">
                                <a href="#" class="friend">
                                    <img src="{{asset('admin/assets/images/users/user7.jpg')}}">
                                </a>
                            </div>
                            <div class="col-md-10 col-xs-10 push-up-10">
                                <h5>Herman Suherman S.Pd</h5>
                            </div>
                        </div>
                    </div>
                  </div>

                  <!-- START DEFAULT DATATABLE -->
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="65">No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th width="100">NK1</th>
                                    <th width="100">NK2</th>
                                    <th width="100">NK3</th>
                                    <th width="100">NK4</th>
                                    <th width="100">NK5</th>
                                    <th width="100">NK6</th>
                                    <th width="100">NK7</th>
                                    <th width="100">Nilai Akhir Kuis</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data_siswa as $no => $siswa)
                                <tr>
                                  <td align="center">1</td>
                                  <td>14515738</td>
                                  <td>Maman Suherman</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <!-- END DEFAULT DATATABLE -->

                </div>

                <div class="tab-pane" id="tab-third">

                  <div class="col-md-12 push-down-20">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel-subtitle">
                            <p>Masukan Kelas dan Mata Pelajaran untuk Menampilkan Data Nilai UTS Siswa</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                            <select name="id_kelas" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                                <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                              @endforeach

                            </select>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Masukan Mata Pelajaran-</option>

                            @foreach($data_mapel as $matpel)
                            <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary pull-right">Cari Data Nilai UTS</button>
                      </div>
                    </div>
                  </div>

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="push-up-10 push-left-20">Data Nilai UTS</h3>
                    </div>
                    <ul class="panel-controls push-up-5">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="text-primary  push-left-20">Kelas 10 MIA 1</h3>
                      <h3 class="text-info push-left-20">Matematika</h3>
                        <div class="col-md-12 push-down-0">
                            <div class="col-md-2 col-xs-2">
                                <a href="#" class="friend">
                                    <img src="{{asset('admin/assets/images/users/user7.jpg')}}">
                                </a>
                            </div>
                            <div class="col-md-10 col-xs-10 push-up-10">
                                <h5>Herman Suherman S.Pd</h5>
                            </div>
                        </div>
                    </div>
                  </div>

                  <!-- START DEFAULT DATATABLE -->
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="65">No</th>
                                    <th width="100">NIS</th>
                                    <th>Nama Siswa</th>
                                    <th >Nilai UTS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td align="center">1</td>
                                  <td>14515738</td>
                                  <td>Maman Suherman</td>
                                  <td>80</td>
                                </tr>
                                <tr>
                                <td align="center">2</td>
                                <td>14526839</td>
                                <td>Herman Suherman</td>
                                <td>80</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <!-- END DEFAULT DATATABLE -->

                </div>

                <div class="tab-pane" id="tab-fourth">


                  <div class="col-md-12 push-down-20">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel-subtitle">
                            <p>Masukan Kelas dan Mata Pelajaran untuk Menampilkan Data Nilai UAS Siswa</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                            <select name="id_kelas" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                                <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                              @endforeach

                            </select>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Masukan Mata Pelajaran-</option>

                            @foreach($data_mapel as $matpel)
                            <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary pull-right">Cari Data Nilai UAS</button>
                      </div>
                    </div>
                  </div>

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="push-up-10 push-left-20">Data Nilai UAS</h3>
                    </div>
                    <ul class="panel-controls push-up-5">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="text-primary  push-left-20">Kelas 10 MIA 1</h3>
                      <h3 class="text-info push-left-20">Matematika</h3>
                        <div class="col-md-12 push-down-0">
                            <div class="col-md-2 col-xs-2">
                                <a href="#" class="friend">
                                    <img src="{{asset('admin/assets/images/users/user7.jpg')}}">
                                </a>
                            </div>
                            <div class="col-md-10 col-xs-10 push-up-10">
                                <h5>Herman Suherman S.Pd</h5>
                            </div>
                        </div>
                    </div>
                  </div>

                  <!-- START DEFAULT DATATABLE -->
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="65">No</th>
                                    <th width="100">NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td align="center">1</td>
                                  <td>14515738</td>
                                  <td>Maman Suherman</td>
                                  <td>80</td>
                                </tr>
                                <tr>
                                <td align="center">2</td>
                                <td>14526839</td>
                                <td>Herman Suherman</td>
                                <td>80</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <!-- END DEFAULT DATATABLE -->

                </div>

                <div class="tab-pane" id="tab-five">


                  <div class="col-md-12 push-down-20">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel-subtitle">
                            <p>Masukan Kelas dan Mata Pelajaran untuk Menampilkan Data Nilai Akhir Siswa</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                            <select name="id_kelas" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                                <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                              @endforeach

                            </select>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <select name="id_mapel" class="form-control select" data-live-search="true" required>
                            <option value="">-Masukan Mata Pelajaran-</option>

                            @foreach($data_mapel as $matpel)
                            <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary pull-right">Cari Data Nilai Akhir</button>
                      </div>
                    </div>
                  </div>

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="push-up-10 push-left-20">Data Nilai Akhir</h3>
                    </div>
                    <ul class="panel-controls push-up-5">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3 class="text-primary  push-left-20">Kelas 10 MIA 1</h3>
                      <h3 class="text-info push-left-20">Matematika</h3>
                        <div class="col-md-12 push-down-0">
                            <div class="col-md-2 col-xs-2">
                                <a href="#" class="friend">
                                    <img src="{{asset('admin/assets/images/users/user7.jpg')}}">
                                </a>
                            </div>
                            <div class="col-md-10 col-xs-10 push-up-10">
                                <h5>Herman Suherman S.Pd</h5>
                            </div>
                        </div>
                    </div>
                  </div>

                  <!-- START DEFAULT DATATABLE -->
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="65">No</th>
                                    <th width="100">NIS</th>
                                    <th>Nama Siswa</th>
                                    <th width="100">Nilai Harian</th>
                                    <th width="100">Nilai UAS</th>
                                    <th width="100">Nilai UAS</th>
                                    <th width="100">Nilai Akhir</th>
                                    <th width="100">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td align="center">1</td>
                                  <td>14515738</td>
                                  <td>Maman Suherman</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>80</td>
                                  <td>B</td>
                                </tr>
                                <tr>
                                <td align="center">2</td>
                                <td>14526839</td>
                                <td>Herman Suherman</td>
                                <td>70</td>
                                <td>70</td>
                                <td>70</td>
                                <td>70</td>
                                <td>C</td>
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

@stop
