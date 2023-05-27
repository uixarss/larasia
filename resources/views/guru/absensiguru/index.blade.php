@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Absensi Guru</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Absensi Guru</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Data Absensi Guru</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
          </ul>
        </div>
        <div class="panel-body">
          <table class="table datatable">
            <thead>
              <tr>

                <th>Tanggal Absen</th>
                <th>Hari</th>
                <th>Jam Datang</th>
                <th>Jam Pulang</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data_absensi as $absensi)
              <tr>

                <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absen)->format('d M Y')}}</td>
                <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absen)->format('l')}}</td>
                <td>{{$absensi->jam_masuk}}</td>
                <td>{{$absensi->jam_pulang}}</td>

                @switch($absensi->keterangan)
                @case('Hadir')
                <td><span class="label label-info label-form">Hadir</span></td>
                @break
                @case('Izin')
                <td><span class="label label-warning label-form">Izin</span></td>
                @break
                @case('Sakit')
                <td><span class="label label-default label-form">Sakit</span></td>
                @break
                @default
                <td><span class="label label-danger label-form">Alpha</span></td>

                @endswitch

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