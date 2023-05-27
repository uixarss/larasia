@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li>Data Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h3><span class="fa fa-users"></span> Data siswa</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
    <!-- START Kontent -->
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

                    <!-- TABS KELAS 10 -->
                    @foreach($data_kelas as $key => $kelas)
                    @if($kelas->tingkat == 10)
                    @if($key == 0)
                    <div class="tab-pane active" id="{{$kelas->kode_kelas}}">

                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                                        <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">

                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Photo</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No Hp</th>
                                                    <th>Email Siswa</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_siswa as $key_siswa => $siswa)
                                                @if($kelas->id == $siswa->kelas_id)
                                                <tr>
                                                    <td>{{$siswa->NIS}}</td>
                                                    <td>
                                                      <div class="photo-table">
                                                        @if($siswa->photo != null)
                                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                                        @else
                                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                                        @endif
                                                      </div>
                                                    </td>
                                                    <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                    <td>{{$siswa->jenis_kelamin}}</td>
                                                    <td>{{$siswa->no_phone}}</td>
                                                    <td>{{$siswa->email_siswa}}</td>
                                                    <td>2015/2016</td>
                                                    <td align="center">
                                                        <a href="{{route('pegawai.datasiswa.detail',['id' => $siswa->id])}}" type="button" class="btn btn-success">Detail</a>
                                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                                    </td>
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
                    @endif

                    @endif
                    @endforeach

                </div>

            </div>
            <!-- END TABS -->

        </div>
    </div>
    <!-- END Kontent -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

@stop
