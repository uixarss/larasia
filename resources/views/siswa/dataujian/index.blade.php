@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Data Ujian</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h3><span class="fa fa-columns"></span> Data Ujian</h3>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default tabs">
          <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#tab-uts" role="tab" data-toggle="tab">Ujian Tengah Semester</a></li>
              <li><a href="#tab-uas" role="tab" data-toggle="tab">Ujian Akhir Semester</a></li>
          </ul>
          <div class="panel-body tab-content">
              <div class="tab-pane active" id="tab-uts">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Ujian Mahasiswa Tengah Semester</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th width="200">Nama Dosen</th>
                          <th>Mata Kuliah</th>
                          <th>Judul Ujian</th>
                          <th width="100">Tanggal Mulai</th>
                          <th width="100">Tanggal Selesai</th>
                          <th>Kode Soal</th>
                          <th>Jumlah Soal</th>
                          <th width="100">Waktu</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_uts as $no => $uts)
                        @foreach($uts->kelas as $kelas)
                        @if($siswa->kelas_id == $kelas->id)
                        <tr>
                          <td>{{++$no}}</td>
                          <td>{{$uts->dosen->nama_dosen}}</td>
                          <td>{{$uts->mapel->nama_mapel}}</td>
                          <td>{{$uts->judul_kuis}}</td>
                          <td>{{$uts->tanggal_mulai}}</td>
                          <td>{{$uts->tanggal_akhir}}</td>
                          <td>{{$uts->kode_soal}}</td>
                          <td>{{$uts->jumlah_soal}}</td>
                          <td>{{$uts->durasi}} Menit</td>
                          <td>

                            @foreach($arruts as $btn)
                            @if($btn['id'] == $uts->id)
                            @if($btn['ngerjain'])
                            <a href="#" class="btn btn-success"  disabled> <span class="fa fa-check"></span> Selesai</a>
                            @else
                            <a href="{{url('/student/dataujian/mulaiujian', $uts->id)}}" class="btn btn-danger"> <span class="fa fa-play"></span> Mulai</a>
                            @endif
                            @endif
                            @endforeach


                          </td>

                        @endif
                        @endforeach
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- END DEFAULT DATATABLE -->

              </div>
              <div class="tab-pane " id="tab-uas">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Ujian Mahasiswa Akhir Semester</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th width="200">Nama Dosen</th>
                          <th>Mata Kuliah</th>
                          <th>Judul Ujian</th>
                          <th width="100">Tanggal Mulai</th>
                          <th width="100">Tanggal Selesai</th>
                          <th>Kode Soal</th>
                          <th>Jumlah Soal</th>
                          <th width="100">Waktu</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_uas as $no => $uas)
                        @foreach($uas->kelas as $kelas)
                        @if($siswa->kelas_id == $kelas->id)
                        <tr>
                          <td>{{++$no}}</td>
                          <td>{{$uas->dosen->nama_dosen}}</td>
                          <td>{{$uas->mapel->nama_mapel}}</td>
                          <td>{{$uas->judul_kuis}}</td>
                          <td>{{$uas->tanggal_mulai}}</td>
                          <td>{{$uas->tanggal_akhir}}</td>
                          <td>{{$uas->kode_soal}}</td>
                          <td>{{$uas->jumlah_soal}}</td>
                          <td>{{$uas->durasi}} Menit</td>
                          <td>

                            @foreach($arruas as $btn)
                            @if($btn['id'] == $uas->id)
                            @if($btn['ngerjain'])
                            <a href="#" class="btn btn-success"  disabled> <span class="fa fa-check"></span> Selesai</a>
                            @else
                            <a href="{{url('/student/dataujian/mulaiujian', $uas->id)}}" class="btn btn-danger"> <span class="fa fa-play"></span> Mulai</a>
                            @endif
                            @endif
                            @endforeach

                          </td>

                        @endif
                        @endforeach
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- END DEFAULT DATATABLE -->

              </div>
          </div>
      </div>



    </div>

  </div>
</div>


@stop
