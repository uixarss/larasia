@extends('layouts.joliadmin')


@section('content')

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
        <li class="active">Data Siswa</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Data Siswa</h2>
    </div>
    <!-- END PAGE TITLE -->

    <div class="page-content-wrap">
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Siswa <strong>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</strong></h3>
              <ul class="panel-controls" style="margin-top: 2px;">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              </ul>
            </div>

            <div class="panel-body">

              <form action="{{route('admin.siswa.update', ['id' => $siswa->id])}}" method="POST">
            {{csrf_field()}}

            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_depan">NISN</label>
                <input name="NISN" type="text" class="form-control"  placeholder="Masukan NISN" value="{{$siswa->NISN ?? ''}}">
              </div>
            </div>

            <div class="col-md-6 push-down-15">
              <div class="form-group">
                <label for="nama_belakang">NIS</label>
                <input name="NIS" type="text" class="form-control"  placeholder="Masukan NIS Siswa" value="{{$siswa->NIS ?? ''}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_depan">Nama Depan</label>
                <input name="nama_depan" type="text" class="form-control"  placeholder="Masukan Nama Depan" value="{{$siswa->nama_depan ?? ''}}">
              </div>
            </div>

            <div class="col-md-6 push-down-15">
              <div class="form-group">
                <label for="nama_belakang">Nama Belakang</label>
                <input name="nama_belakang" type="text" class="form-control"  placeholder="Masukan Nama Belakang" value="{{$siswa->nama_belakang ?? ''}}">
              </div>
            </div>

            <div class="col-md-12 push-down-15">
              <div class="form-group">
                  <label for="nama_belakang">Kelas Siswa</label>
                  <select name="kelas_id" class="form-control select">
                      @foreach($data_kelas as $kelas)
                      <option value="{{$kelas->id}}" {{($kelas->id == $siswa->kelas_id) ? 'selected' : '' }}>{{$kelas->nama_kelas}}</option>
                      @endforeach
                  </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_belakang">Tempat Lahir</label>
                <input name="tempat_lahir" type="text" class="form-control"  placeholder="Masukan Tempat Lahir" value="{{$siswa->tempat_lahir ?? ''}}">
              </div>
            </div>

            <div class="col-md-6  push-down-15">
              <div class="form-group">
                <label for="nama_depan">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" class="form-control"  placeholder="Masukan Tanggal Lahir" value="{{$siswa->tanggal_lahir ?? ''}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control select" id="exampleFormControlSelect1">
                  <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif >Laki-Laki</option>
                  <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif >Perempuan</option>
                </select>
              </div>
            </div>

            <div class="col-md-6  push-down-15">
              <div class="form-group">
                <label for="nama_depan">Golongan Darah</label>
                <input name="golongan_darah" type="text" class="form-control"  placeholder="Masukan Golongan Darah" value="{{$siswa->golongan_darah ?? ''}}">
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label for="agama">Agama</label>
                <input name="agama" type="texts" class="form-control"  placeholder="Agama" value="{{$siswa->agama ?? ''}}">
              </div>
            </div>

            <div class="col-md-6  push-down-15">
              <div class="form-group">
                <label for="nama_depan">Kebangsaan</label>
                <input name="kebangsaan" type="text" class="form-control"  placeholder="Masukan Kebangsaan" value="{{$siswa->kebangsaan ?? ''}}">
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label for="agama">Alamat Email</label>
                <input name="email_siswa" type="email" class="form-control"  placeholder="Masukan Email Siswa" value="{{$siswa->email_siswa ?? ''}}">
              </div>
            </div>

            <div class="col-md-6  push-down-15">
              <div class="form-group">
                <label for="nama_depan">No Telephon</label>
                <input name="no_phone" type="tel" class="form-control"  placeholder="Masukan No Telephon" value="{{$siswa->no_phone ?? ''}}">
              </div>
            </div>


            <div class="col-md-12 push-down-15">
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$siswa->alamat_sekarang ?? ''}}</textarea>
              </div>
            </div>

            </div>

            <div class="panel-footer">
              <a href="{{route('admin.siswa.show',['id' => $siswa->id])}}" type="button" class="btn btn-success">Lihat Detail Siswa</a>
              <button type="submit" class="btn btn-info pull-right">Update Data</button>
            </form>
            </div>

          </div>
        </div>
      </div>
    </div>

@stop
