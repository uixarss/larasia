@extends('layouts.joliadmin-top')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('siswa.raporsiswa.index') }}">Data Rapor</a></li>
      <li class="active">Nilai Rapor</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Nilai Rapor </h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Rapor Siswa {{$nilai_rapor->nama_siswa}}</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
            </div>

            <div class="panel-body table-responsive">

              <div class="col-md-6">
                <table class="table">
                  <body>
                  <tr>
                    <th>NIS</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->nis}}</th>
                  </tr>

                  <tr>
                    <th>Nama</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->nama_siswa}}</th>
                  </tr>

                  <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->kelas_siswa}}</th>
                  </tr>

                  <tr><th colspan="3"></th></tr>

                </body>
                </table>
              </div>

              <div class="col-md-6">
                <table class="table">
                  <body>
                  <tr>
                    <th>Wali Kelas</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->wali_kelas}}</th>
                  </tr>

                  <tr>
                    <th>Tahun Ajaran</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->tahun_ajaran}}</th>
                  </tr>

                  <tr>
                    <th>Semester</th>
                    <th>:</th>
                    <th>{{$nilai_rapor->semester}}</th>
                  </tr>

                  <tr><th colspan="3"></th></tr>

                </body>
                </table>
              </div>

              <table class="table">
                <thead>
                    <tr>
                      <th width="60">No</th>
                      <th>Mata Pelajaran</th>
                      <th width="100">KKM</th>
                      <th width="100">Nilai</th>
                      <th width="100">Huruf Mutu</th>
                      <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai_rapor_siswa as $no => $rapor_siswa)
                    <tr>
                      <td>{{++$no}}</td>
                      <td> {{$rapor_siswa->nama_mapel}} </td>
                      <td>
                          <p aria-hidden="false" class="form-control" > {{$rapor_siswa->kkm ?? '75'}}  </p>
                      </td>
                      <td>
                        <p aria-hidden="false" class="form-control" > {{$rapor_siswa->nilai_akhir ?? '0'}} </p>
                      </td>
                      <td align="center">
                        @foreach($grade_nilai as $gn)
                          @if($rapor_siswa->nilai_akhir >= $gn->nilai_rendah && $rapor_siswa->nilai_akhir <= $gn->nilai_tinggi)
                            <p aria-hidden="false" class="form-control" align="center"> <strong> {{$gn->nama_grade}} </strong></p>
                          @endif
                        @endforeach
                      </td>
                      <td>
                        <p aria-hidden="false" class="form-control" > {{$rapor_siswa->keterangan ?? '-'}} </p>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

      </div>
    </div>
  </div>

@stop
