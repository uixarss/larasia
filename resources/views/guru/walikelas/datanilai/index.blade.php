@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Data Nilai</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Data Nilai</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Nilai</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Data Kelas"><span class="fa fa-print"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Kelas</th>
                          <th width="300">Jumlah siswa</th>
                          <th width="200">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_walikelas as $no => $walikelas)
                      @foreach($walikelas->kelas as $kelas)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$kelas->nama_kelas}}</td>
                            <td>{{$kelas->siswa->count()}} Siswa</td>
                            <td>
                              <form action="{{route('guru.walikelas.datanilai.show', $kelas->id)}}" method="get">
                                {{csrf_field()}}
                                @method('put')
                                <!-- Default untuk mata pelajaran ketika pas di klik yaitu matematika id = 1 -->
                                <input type="hidden" name="guru_id" value="1">
                                <button type="submit" class="btn btn-info">Lihat Nilai Siswa</button>
                              </form>
                            </td>
                        </tr>
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

@stop
