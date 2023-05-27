@extends('layouts.joliadmin')


@section('content')

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
        <li class="active"> Pegawai</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Data pegawai</h2>
    </div>
    <!-- END PAGE TITLE -->

    <div class="page-content-wrap">
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Hover rows</h3>
              <ul class="panel-controls" style="margin-top: 2px;">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#staticBackdrop"><span class="fa fa-plus-circle"></span></a></li>
              </ul>
            </div>

            <div class="panel-body">

              <form action="/pegawai/{{$pegawai->id}}/update" method="POST">
              {{csrf_field()}}
                <div class="form-group">
                  <label for="exampleInputEmail1">NIP</label>
                  <input name="NIP" type="text" class="form-control"  placeholder="Nama Depan" value="{{$pegawai->NIP}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Unggah Gambar</label>
                  <input name="avatar" type="file" class="form-control" value="{{$pegawai->getAvatar()}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pegawai</label>
                  <input name="nama_pegawai" type="text" class="form-control"  placeholder="Nama Pegawai" value="{{$pegawai->nama_pegawai}}">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Bagian Pegawai</label>
                  <select name="bagian_pegawai" class="form-control" id="exampleFormControlSelect1">
                    <option value="Akademik" @if($pegawai->bagian_pegawai == 'Akademik') selected @endif >Akademik</option>
                    <option value="Non Akademik" @if($pegawai->bagian_pegawai == 'Non Akademik') selected @endif >Non Akademik</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Jabatan Pegawai</label>
                  <input name="jabatan_pegawai" type="texts" class="form-control"  placeholder="Jabatan Pegawai" value="{{$pegawai->jabatan_pegawai}}">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect2">Bagian Pegawai</label>
                  <select name="status_pegawai" class="form-control" id="exampleFormControlSelect2">
                    <option value="PNS" @if($pegawai->status_pegawai == 'PNS') selected @endif >PNS</option>
                    <option value="Non PNS" @if($pegawai->status_pegawai == 'Non PNS') selected @endif >Non PNS</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-warning btn-">Update</button>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>

@stop


@section('content1')

      @if(session('sukses'))
      <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>
      @endif

      <div class="row">
        <div class="col-md-12">
          <h2>Data pegawai</h2>



@endsection
