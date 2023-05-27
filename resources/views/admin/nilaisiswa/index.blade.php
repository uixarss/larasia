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
  <h2><span class="fa fa-arrow-circle-o-left"></span>Data Nilai Siswa</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#tab-nilaiharian" role="tab" data-toggle="tab">Nilai Harian</a></li>
          <li><a href="#tab-nilaikuis" role="tab" data-toggle="tab">Nilai KUIS</a></li>
          <li><a href="#tab-nilaiuts" role="tab" data-toggle="tab">NILAI UTS</a></li>
          <li><a href="#tab-nilaiuas" role="tab" data-toggle="tab">NILAI UAS</a></li>
        </ul>
        <div class="panel-body tab-content">

          <div class="tab-pane active" id="tab-nilaiharian">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data Nilai Harian</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
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
                    @if(isset($data_kelas_mapel))

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
                                  <input type="hidden" name="guru_id" value="1">

                                  <button type="submit" class="btn btn-info">Detail Siswa</button>
                                </form>

                            </td>
                        </tr>
                      @endforeach
                    @endforeach
                    @endif

                  </tbody>
                </table>

              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

          </div>

          <div class="tab-pane" id="tab-nilaikuis">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">

              <div class="panel-heading">
                <h3 class="panel-title">Data Nilai KUIS</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Nilai Akhir</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($data_quiz))
                    @foreach($data_quiz as $no => $quiz)
                      @foreach($quiz->result_quizzes as $nilai_quiz)
                      <tr>
                        <td align="center">{{++$no}}</td>
                        <td>{{$nilai_quiz->siswa->NIS}}</td>
                        <td>{{$nilai_quiz->siswa->nama_depan}} {{$nilai_quiz->siswa->nama_belakang}}</td>
                        <td>{{$nilai_quiz->siswa->kelas->nama_kelas}}</td>
                        <td>{{$nilai_quiz->nilai_akhir}}</td>
                      </tr>
                      @endforeach
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>

            </div>
            <!-- END DEFAULT DATATABLE -->

          </div>

          <div class="tab-pane" id="tab-nilaiuts">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data Nilai UTS</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($data_uts))
                    @foreach($data_uts as $no => $uts)
                      @foreach($uts->result_quizzes as $nilai_quiz)
                      <tr>
                        <td align="center">{{++$no}}</td>
                        <td>{{$nilai_quiz->siswa->NIS}}</td>
                        <td>{{$nilai_quiz->siswa->nama_depan}} {{$nilai_quiz->siswa->nama_belakang}}</td>
                        <td>{{$nilai_quiz->siswa->kelas->nama_kelas}}</td>
                        <td>{{$nilai_quiz->nilai_akhir}}</td>
                      </tr>
                      @endforeach
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>

            </div>
            <!-- END DEFAULT DATATABLE -->

          </div>

          <div class="tab-pane" id="tab-nilaiuas">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data Nilai UAS</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($data_uas))
                    @foreach($data_uas as $no => $uas)
                      @foreach($uas->result_quizzes as $nilai_quiz)
                      <tr>
                        <td align="center">{{++$no}}</td>
                        <td>{{$nilai_quiz->siswa->NIS}}</td>
                        <td>{{$nilai_quiz->siswa->nama_depan}} {{$nilai_quiz->siswa->nama_belakang}}</td>
                        <td>{{$nilai_quiz->siswa->kelas->nama_kelas}}</td>
                        <td>{{$nilai_quiz->nilai_akhir}}</td>
                      </tr>
                      @endforeach
                    @endforeach
                    @endif
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
