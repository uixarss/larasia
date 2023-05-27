@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.walikelas.datakelas.index') }}">Data Kelas</a></li>
      <li class="active">Data Siswa</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Data Siswa</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Siswa Kelas {{$data_kelas->nama_kelas}}</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Data Kelas"><span class="fa fa-print"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th width="60">No</th>
                          <th>NIS</th>
                          <th>Photo</th>
                          <th>Nama Lengkap Siswa</th>
                          <th>JK</th>
                          <th>Agama</th>
                          <th width="70">Tempat Lahir</th>
                          <th width="150">Alamat</th>
                          <th width="50">Email</th>
                          <th>No. Hp</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_siswa as $no => $siswa)
                        <tr>
                            <td>{{++$no}}</td>
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
                            <td>{{$siswa->agama}}</td>
                            <td>{{$siswa->tempat_lahir}}</td>
                            <td>{{$siswa->alamat_sekarang}}</td>
                            <td>{{$siswa->email_siswa}}</td>
                            <td>{{$siswa->no_phone}}</td>
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
