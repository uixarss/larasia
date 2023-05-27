@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li> <a href="{{ route('admin.datapegawai.index') }}">pegawai</a></li>
      <li class="active">Detail</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Detail</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-conent-wrap">
    <div class="row">
      <div class="col-md-6">

          <div class="panel panel-default">
            <div class="panel-body profile">
                <div class="profile-image">
                    <img src="{{$pegawai->getAvatar()}}" alt="Nadia Ali">
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">{{$pegawai->nama_pegawai}}</div>
                    <div class="profile-data-title" style="color: #FFF;">{{$pegawai->NIP}}</div>
                </div>
                <div class="profile-controls">
                    <a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-check"></span> Following</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-comments"></span> Chat</button>
                    </div>
                </div>
            </div>
            <div class="panel-body list-group border-bottom">
                <a href="#" class="list-group-item active"><span class="fa fa-list"></span> Data Guru</a>
                <a href="#" class="list-group-item"><span class="fa fa-user"></span> Biodata Guru</a>
                <a href="#" class="list-group-item"><span class="fa fa-cloud"></span> Materi Peajaran</span></a>
                <a href="#" class="list-group-item"><span class="fa fa-hospital-o"></span> RPP</a>
            </div>

          </div>

      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title">Data Lengkap pegawai</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span> Refresh</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">

              <div class="contact-info">
                  <h5>NIP</h5> <h3 class="push-up-0">{{$pegawai->NIP}}</h3>
                  <h5>Nama Belakang</h5> <h3 class="push-up-0">{{$pegawai->nama_pegawai}}</h3>
                  <h5>Bagian Pegawai</h5> <h3 class="push-up-0">{{$pegawai->bagian_pegawai}}</h3>
                  <h5>Jabatan Pegawai</h5> <h3 class="push-up-0">{{$pegawai->jabatan_pegawai}}</h3>
                  <h5>Status Pegawai</h5> <h3 class="push-up-0">{{$pegawai->status_pegawai}}</h3>
              </div>

            </div>
            <div class="panel-footer">
                <a href="{{url('/pegawai/{{$pegawai->id}}/edit')}}" class="btn btn-warning pull-right">Edit</a>
            </div>
        </div>

      </div>

    </div>

  </div>



@stop
