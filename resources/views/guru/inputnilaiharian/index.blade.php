@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Nilai Harian</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Input Nilai Harian</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Input Nilai Harian</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <!-- <li><a class="" data-toggle="modal" data-target="#tambahSoal"><span class="fa fa-plus-circle"></span></a></li> -->
          </ul>
        </div>
        <div class="panel-body">

          <!-- <div class="form-group">
                  <label class="col-md-3 control-label">Car Mata Pelajaran dan Kelas</label>
                  <div class="col-md-9">
                      <select name="id_kelas" class="form-control select" data-live-search="true" required>
                        <option value="">-Masukan Kelas-</option>

                        @foreach($data_kelas as $kelas)
                          @foreach($data_mapel as $mapel)
                            <option value="{{$kelas->id}}">{{$kelas->nama_kelas}} || {{$mapel->nama_mapel}} </option>
                          @endforeach
                        @endforeach

                      </select>
                  </div>
              </div><br><br> -->

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
              

              @foreach($data_jadwal as $no => $jadwal)
              <tr>
                <td>{{++$no}}</td>
                <td>{{$jadwal->kelas->nama_kelas}}</td>
                <td>{{$jadwal->kelas->siswa->count()}} Siswa</td>
                <td>
                  @foreach($data_kelas_mapel as $wali_kelas)
                  @if($jadwal->kelas_id === $wali_kelas->kelas_id)
                  {{$wali_kelas->getNamaLengkap($wali_kelas->guru_id)}}
                  @endif
                  @endforeach
                </td>
                <td align="center">
                  @can('edit-nilai')
                  <a href="{{route('guru.nilaiharian.edit', $jadwal->kelas_id)}}" type="button" class="btn btn-success">Input Nilai</a>
                  @endcan
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