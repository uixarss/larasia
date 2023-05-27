@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
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

            <!-- START TABS -->
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Absensi Hari Ini</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Data Absensi</a></li>
                    <li><a href="#tab-third" role="tab" data-toggle="tab">Laporan Absensi</a></li>
                </ul>
                <div class="panel-body tab-content">

                    <div class="tab-pane active" id="tab-first">

                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Absensi Hari Ini <span>
                                                <h5 class="plugin-date"></h5>
                                            </span> </h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>NIP Guru</th>
                                                    <th>Nama Guru</th>
                                                    <th>Jabatan</th>
                                                    <th>No. Hp</th>
                                                    <th>Absensi</th>
                                                    <th>Jam Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($absensi_gurus as $guru)
                                                <tr>
                                                    <td>{{$guru->guru->NIP}}</td>
                                                    <td>{{$guru->guru->nama_lengkap}}</td>
                                                    <td>{{$guru->guru->jabatan_pegawai}}</td>
                                                    <td>{{$guru->guru->phone_no}}</td>

                                                    @switch($guru->keterangan)
                                                    @case('Hadir')
                                                    <td><span class="label label-info label-form">Hadir</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break
                                                    @case('Izin')
                                                    <td><span class="label label-warning label-form">Izin</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @case('Sakit')
                                                    <td><span class="label label-default label-form">Sakit</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @default
                                                    <td><span class="label label-danger label-form">Alpha</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>

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

                    <div class="tab-pane" id="tab-second">

                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Data Absensi {{\Carbon\Carbon::parse($tanggal_absen)->format('d M Y')}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-heading">
                                        <form action="{{route('admin.absensi.guru.cari')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-md-4 panel-title">
                                                    <h5>Pilih Tanggal Untuk Menampilkan Data Absensi</h5>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="tanggal_absen" class="form-control datepicker" value="{{$tanggal_absen}}" id="dp-4" data-date="2020-04-13" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
                                                </div>
                                            </div>

                                        </form>




                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>NIP Guru</th>
                                                    <th>Nama Guru</th>
                                                    <th>Jabatan</th>
                                                    <th>No. Hp</th>
                                                    <th>Absensi</th>
                                                    <th>Jam Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($absensi_gurus_t as $guru)
                                                <tr>
                                                    <td>{{$guru->guru->NIP}}</td>
                                                    <td>{{$guru->guru->nama_lengkap}}</td>
                                                    <td>{{$guru->guru->jabatan_pegawai}}</td>
                                                    <td>{{$guru->guru->phone_no}}</td>

                                                    @switch($guru->keterangan)
                                                    @case('Hadir')
                                                    <td><span class="label label-info label-form">Hadir</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break
                                                    @case('Izin')
                                                    <td><span class="label label-warning label-form">Izin</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @case('Sakit')
                                                    <td><span class="label label-default label-form">Sakit</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @default
                                                    <td><span class="label label-danger label-form">Alpha</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>

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

                    <div class="tab-pane" id="tab-third">

                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Laporan Absensi</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#"><span class="fa fa-print"></span></a></li>
                                            <li><a href="{{route('admin.absensi.guru.laporan',['tanggal_absen' => $tanggal_absen])}}"><span class="fa fa-cloud-download"></span></a></li>
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>

                                    <div class="panel-heading">

                                        <form action="{{route('admin.absensi.guru.cari')}}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label class="col-md-4 panel-title">
                                                    <h5>Pilih Tanggal Untuk Menampilkan Laporan Absensi</h5>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="tanggal_absen" class="form-control datepicker" value="{{$tanggal_absen}}" id="dp-4" data-date="{{$tanggal_absen}}" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
                                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>

                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>NIP Guru</th>
                                                    <th>Nama Guru</th>
                                                    <th>Jabatan</th>
                                                    <th>No. Hp</th>
                                                    <th>Absensi</th>
                                                    <th>Jam Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($absensi_gurus_t as $guru)
                                                <tr>
                                                    <td>{{$guru->guru->NIP}}</td>
                                                    <td>{{$guru->guru->nama_lengkap}}</td>
                                                    <td>{{$guru->guru->jabatan_pegawai}}</td>
                                                    <td>{{$guru->guru->phone_no}}</td>

                                                    @switch($guru->keterangan)
                                                    @case('Hadir')
                                                    <td><span class="label label-info label-form">Hadir</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break
                                                    @case('Izin')
                                                    <td><span class="label label-warning label-form">Izin</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @case('Sakit')
                                                    <td><span class="label label-default label-form">Sakit</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>
                                                    @break

                                                    @default
                                                    <td><span class="label label-danger label-form">Alpha</span></td>
                                                    <td>{{$guru->jam_masuk}}</td>

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

                </div>
            </div>
            <!-- END TABS -->

        </div>
    </div>
</div>

@stop