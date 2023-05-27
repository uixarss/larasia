@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="active">Data Orang Tua</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2></span>Data Orang Tua</h2>
</div>
<!-- END PAGE TITLE -->


<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Data Semua Orang Tua</h3>
              <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#tambahOrangTua"><span class="fa fa-plus-circle"></span></a></li>
                  <!-- <li><a href="{{url('/admin/dataorangtua/uploaddataorangtua')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Upload Data Orang Tua"><span class="fa fa-cloud-upload"></span></a></li> -->
              </ul>
          </div>
          <div class="panel-body">
              <table class="table datatable table-hover">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Orang Tua</th>
                          <th>Nama Siswa</th>
                          <th>Kelas</th>
                          <th>Email</th>
                          <th>No Hp</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($dataorangtua as $orangtua)
                      <tr>
                          <td scope="row">{{$orangtua->id}}</td>

                          <td>{{$orangtua->nama_orangtua}}</td>
                          <td>{{$orangtua->siswa->nama_depan}} {{$orangtua->siswa->nama_belakang}}</td>
                          <td>{{$orangtua->siswa->kelas->nama_kelas}}</td>
                          <td>{{$orangtua->email_orangtua}}</td>
                          <td>{{$orangtua->nohp_orangtua}}</td>
                          <td align="center">
                            <a type="button" class="btn btn-success" data-toggle="modal" data-target="#editOrangTua{{$orangtua->id}}">
                              Edit
                            </a>
                            <a href="{{route('admin.dataorangtua.destroy',['id' => $orangtua->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                            <a href="{{route('admin.dataorangtua.detailorangtua', $orangtua->id)}}" type="button" class="btn btn-info">Detail</a>

                          </td>

                          <!-- Modal EDIT-->
                          <div class="modal fade" id="editOrangTua{{$orangtua->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Data Orang Tua</h5>
                              </div>
                              <div class="modal-body">

                                <form  action="{{route('admin.dataorangtua.update', $orangtua->id )}}" method="POST">
                                  @csrf
                                  {{method_field('PUT')}}
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Orang Tua</label>
                                      <input name="nama_orangtua" type="text" class="form-control"  placeholder="Nama Orang Tua" value="{{ $orangtua->nama_orangtua }}">
                                    </div>

                                    <div class="form-group">
                                      <label for="mapel">Nama Siswa</label>
                                      <select name="siswa_id" class="form-control select" data-live-search="true" required>
                                        @foreach($data_siswa as $siswa)
                                        <option value="{{$siswa->id}}"
                                          @if($orangtua->siswa->id == $siswa->id) selected @endif>
                                          {{$siswa->nama_depan}} {{$siswa->nama_belakang}}</option>
                                        @endforeach
                                      </select>
                                    </div>


                                    <div class="form-group">
                                      <label for="mapel">Kelas Siswa</label>
                                      <select name="" class="form-control select" data-live-search="true" required>
                                        @foreach($data_kelas as $kelas)
                                        <option value="{{$kelas->id}}"
                                          @if($orangtua->siswa->kelas->id == $kelas->id) selected @endif>
                                          {{$kelas->nama_kelas}}</option>
                                        @endforeach
                                      </select>
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Email</label>
                                      <input name="email_orangtua" type="email" class="form-control"  placeholder="Email Orang Tua" value="{{ $orangtua->email_orangtua }}">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">No Hp</label>
                                      <input name="nohp_orangtua" type="texts" class="form-control"  placeholder="No Hp Orang Tua" value="{{ $orangtua->nohp_orangtua }}">
                                    </div>

                                    <div class="form-group">
                                      <label for="alamat">Alamat</label>
                                      <textarea name="alamat" class="form-control" rows="3" placeholder="Masukan Alamat Orang Tua">{{$orangtua->alamat}}</textarea>
                                    </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Update</button>
                              </form>
                              </div>
                            </div>
                          </div>
                          </div>

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
<!-- PAGE CONTENT WRAPPER -->

<div class="modal fade" id="tambahOrangTua" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Orang Tua</h5>
      </div>
      <div class="modal-body">

        <form method="post" action="{{route('admin.dataorangtua.create')}}" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-group">
            <label for="exampleInputEmail1">Nama Orang Tua</label>
            <input name="nama_orangtua" type="text" class="form-control"  placeholder="Nama Orang Tua">
          </div>

          <div class="form-group">
            <label for="mapel">Masukan Nama Siswa</label>
            <select name="siswa_id" class="form-control select" data-live-search="true" required>
              <option value="">-Masukan Nama Siswa-</option>
              @foreach($data_siswa as $siswa)
              <option value="{{$siswa->id}}">{{$siswa->nama_depan}} {{$siswa->nama_belakang}} </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email_orangtua" type="email" class="form-control"  placeholder="Email Orang Tua">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">No Hp</label>
            <input name="nohp_orangtua" type="texts" class="form-control"  placeholder="No Hp Orang Tua">
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukna Alamat Orang Tua"></textarea>
          </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>

    </div>
  </div>
</div>

@endsection
