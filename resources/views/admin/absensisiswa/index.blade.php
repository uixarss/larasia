@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Absensi Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Absensi Siswa</h2>
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

                        <!-- Data Absensi Hari Ini -->
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
                                                <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
                                                @else
                                                <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
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
                                                <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
                                                @else
                                                <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
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
                                                <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
                                                @else
                                                <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">Kelas {{$kelas->nama_kelas}}</a></li>
                                                @endif
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>

                                    </ul>

                                    <!-- Tabel Kontent kelas 10-12 -->
                                    <div class="panel-body tab-content">

                                        <!-- KELAS 10 -->
                                        @foreach($data_kelas as $key => $kelas)
                                        @if($kelas->tingkat == 10)
                                        @if($key == 0)


                                        <div class="tab-pane active" id="{{$kelas->kode_kelas}}">

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <!-- START DEFAULT DATATABLE -->
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach($absensi_siswas as $absensi_siswa)
                                                                    @if($absensi_siswa->siswa->kelas_id == $kelas->id)

                                                                    <tr>
                                                                        <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                                        <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                                        <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                                        <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                                        @switch($absensi_siswa->keterangan)
                                                                        @case('Hadir')
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break
                                                                        @case('Izin')
                                                                        <td><span class="label label-warning label-form">Izin</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @case('Sakit')
                                                                        <td><span class="label label-default label-form">Sakit</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @default
                                                                        <td><span class="label label-danger label-form">Alpha</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>

                                                                        @endswitch

                                                                    </tr>
                                                                    @endif
                                                                    @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($absensi_siswas as $absensi_siswa)
                                                                    @if($absensi_siswa->siswa->kelas_id == $kelas->id)

                                                                    <tr>
                                                                        <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                                        <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                                        <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                                        <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                                        @switch($absensi_siswa->keterangan)
                                                                        @case('Hadir')
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break
                                                                        @case('Izin')
                                                                        <td><span class="label label-warning label-form">Izin</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @case('Sakit')
                                                                        <td><span class="label label-default label-form">Sakit</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @default
                                                                        <td><span class="label label-danger label-form">Alpha</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>

                                                                        @endswitch

                                                                    </tr>
                                                                    @endif
                                                                    @endforeach

                                                                </tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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


                                        <div class="tab-pane" id="{{$kelas->kode_kelas}}">

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <!-- START DEFAULT DATATABLE -->
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>8769709775</td>
                                                                        <td>Doni Supratman</td>
                                                                        <td>10 MIA 1</td>
                                                                        <td>0896542736</td>
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>07:40 WIB</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>0809765</td>
                                                                        <td>Alvy Fajri</td>
                                                                        <td>10 MIA 1</td>
                                                                        <td>0896542736</td>
                                                                        <td><span class="label label-warning label-form">Ijin</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>9798656</td>
                                                                        <td>Ade Saprudin</td>
                                                                        <td>10 MIA 1</td>
                                                                        <td>0896542736</td>
                                                                        <td><span class="label label-danger label-form">Alfa</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>9709679</td>
                                                                        <td>Perdi Supriadi</td>
                                                                        <td>10 MIA 1</td>
                                                                        <td>0896542736</td>
                                                                        <td><span class="label label-sakit label-form">Sakit</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>9507896</td>
                                                                        <td>Agung Firmansyahs</td>
                                                                        <td>10 MIA 1</td>
                                                                        <td>0896542736</td>
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>08:00 WIB</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($absensi_siswas as $absensi_siswa)
                                                                    @if($absensi_siswa->siswa->kelas_id == $kelas->id)

                                                                    <tr>
                                                                        <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                                        <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                                        <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                                        <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                                        @switch($absensi_siswa->keterangan)
                                                                        @case('Hadir')
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break
                                                                        @case('Izin')
                                                                        <td><span class="label label-warning label-form">Izin</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @case('Sakit')
                                                                        <td><span class="label label-default label-form">Sakit</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @default
                                                                        <td><span class="label label-danger label-form">Alpha</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>

                                                                        @endswitch

                                                                    </tr>
                                                                    @endif
                                                                    @endforeach

                                                                </tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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


                                        <div class="tab-pane" id="{{$kelas->kode_kelas}}">

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <!-- START DEFAULT DATATABLE -->
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($absensi_siswas as $absensi_siswa)
                                                                    @if($absensi_siswa->siswa->kelas_id == $kelas->id)

                                                                    <tr>
                                                                        <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                                        <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                                        <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                                        <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                                        @switch($absensi_siswa->keterangan)
                                                                        @case('Hadir')
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break
                                                                        @case('Izin')
                                                                        <td><span class="label label-warning label-form">Izin</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @case('Sakit')
                                                                        <td><span class="label label-default label-form">Sakit</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @default
                                                                        <td><span class="label label-danger label-form">Alpha</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>

                                                                        @endswitch

                                                                    </tr>
                                                                    @endif
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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
                                                            <h3 class="panel-title">Absensi Hari Ini Kelas {{$kelas->nama_kelas}}<span>
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
                                                                        <th>NISN</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Kelas</th>
                                                                        <th>No. Hp</th>
                                                                        <th>Absensi</th>
                                                                        <th>Jam Absen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($absensi_siswas as $absensi_siswa)
                                                                    @if($absensi_siswa->siswa->kelas_id == $kelas->id)

                                                                    <tr>
                                                                        <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                                        <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                                        <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                                        <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                                        @switch($absensi_siswa->keterangan)
                                                                        @case('Hadir')
                                                                        <td><span class="label label-info label-form">Hadir</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break
                                                                        @case('Izin')
                                                                        <td><span class="label label-warning label-form">Izin</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @case('Sakit')
                                                                        <td><span class="label label-default label-form">Sakit</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>
                                                                        @break

                                                                        @default
                                                                        <td><span class="label label-danger label-form">Alpha</span></td>
                                                                        <td>{{$absensi_siswa->jam_masuk}}</td>

                                                                        @endswitch

                                                                    </tr>
                                                                    @endif
                                                                    @endforeach

                                                                </tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- END DEFAULT DATATABLE -->

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

                    <div class="tab-pane" id="tab-second">

                        <!-- Data Absensi -->
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
                                        <form action="{{route('admin.absensi.siswa.cari')}}" method="post">
                                            @csrf
                                            <label class="control-label block">Pilih Tanggal Untuk Menampilkan Data Absensi</label>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <select class="form-control select" name="kelas_id" data-live-search="true">
                                                            <option>Pilih Kelas</option>
                                                            @foreach($data_kelas as $kelas)
                                                            <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

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
                                                    <th>NISN</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>No. Hp</th>
                                                    <th>Absensi</th>
                                                    <th>Jam Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($absensi_siswa_t as $absensi_siswa)
                                                @if($absensi_siswa->siswa->kelas_id == $kelas_id)

                                                <tr>
                                                    <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                    <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                    <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                    <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                    @switch($absensi_siswa->keterangan)
                                                    @case('Hadir')
                                                    <td><span class="label label-info label-form">Hadir</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break
                                                    @case('Izin')
                                                    <td><span class="label label-warning label-form">Izin</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break

                                                    @case('Sakit')
                                                    <td><span class="label label-default label-form">Sakit</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break

                                                    @default
                                                    <td><span class="label label-danger label-form">Alpha</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>

                                                    @endswitch

                                                </tr>
                                                @endif
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

                        <!-- Laporan Absensi -->
                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Laporan Absensi</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#"><span class="fa fa-print"></span></a></li>
                                            <li><a href="{{route('admin.absensi.siswa.laporan',['tanggal_absen' => $tanggal_absen,'kelas_id' => $kelas_id])}}"><span class="fa fa-cloud-download"></span></a></li>
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>

                                    <div class="panel-heading">

                                        <form action="{{route('admin.absensi.siswa.cari')}}" method="post">
                                        @csrf

                                            <label class="control-label block">Pilih Tanggal Untuk Menampilkan Laporan Absensi</label>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <select class="form-control select" name="kelas_id" data-live-search="true">
                                                            <option>Pilih Kelas</option>
                                                            @foreach($data_kelas as $kelas)
                                                            <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

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
                                                    <th>NISN</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>No. Hp</th>
                                                    <th>Absensi</th>
                                                    <th>Jam Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($absensi_siswa_t as $absensi_siswa)
                                                @if($absensi_siswa->siswa->kelas_id == $kelas_id)

                                                <tr>
                                                    <td>{{$absensi_siswa->siswa->NISN}}</td>
                                                    <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                                                    <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                                                    <td>{{$absensi_siswa->siswa->no_phone}}</td>

                                                    @switch($absensi_siswa->keterangan)
                                                    @case('Hadir')
                                                    <td><span class="label label-info label-form">Hadir</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break
                                                    @case('Izin')
                                                    <td><span class="label label-warning label-form">Izin</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break

                                                    @case('Sakit')
                                                    <td><span class="label label-default label-form">Sakit</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>
                                                    @break

                                                    @default
                                                    <td><span class="label label-danger label-form">Alpha</span></td>
                                                    <td>{{$absensi_siswa->jam_masuk}}</td>

                                                    @endswitch

                                                </tr>
                                                @endif
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