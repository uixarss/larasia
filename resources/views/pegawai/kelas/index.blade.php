@extends('layouts.joliadmin-top')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Home</a></li>
  <li class="active">Data Kelas</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Data Kelas</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Data Kelas</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            @can('create-kelas')
            <li><a class="" data-toggle="modal" data-target="#tambahKelas"><span class="fa fa-plus-circle"></span></a></li>
            @endcan
          </ul>
        </div>
        <div class="panel-body">
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Kelas</th>
                <th>Kelas</th>
                <th>Kapasitas</th>
                <th>Jurusan</th>
                <th>Tingkat</th>
                <th>Wali Kelas</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kelas as $tiap_kelas)
              <tr>
                <td>{{$tiap_kelas->id}}</td>
                <td>{{$tiap_kelas->kode_kelas}}</td>
                <td>{{$tiap_kelas->nama_kelas}}</td>
                <td>{{$tiap_kelas->kapasitas}} orang</td>
                <td>{{$tiap_kelas->jurusan}}</td>
                <td>{{$tiap_kelas->tingkat}}</td>
                <td>
                  @foreach($data_wali_kelas as $wali_kelas)
                    @if($tiap_kelas->id === $wali_kelas->kelas_id)
                    {{$wali_kelas->getNamaLengkap($wali_kelas->guru_id)}}
                    @endif
                  @endforeach</td>
                <td align="center">
                  @can('edit-kelas')
                  <a class="btn btn-success" data-toggle="modal" data-target="#editKelas{{$tiap_kelas->id}}">Edit</a>
                  @endcan
                  @can('delete-kelas')
                  <a href="{{route('pegawai.kelas.destroy',['id' => $tiap_kelas->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                  @endcan
                </td>
              </tr>
              <!-- Modal edit kelas-->
              <div class="modal fade" id="editKelas{{$tiap_kelas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="staticBackdropLabel">Edit Kelas</h5>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('pegawai.kelas.update', $tiap_kelas->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="kode_kelas">Kode Kelas</label>
                          <input name="kode_kelas" type="text" class="form-control" value="{{$tiap_kelas->kode_kelas}}">
                        </div>

                        <div class="form-group">
                          <label for="nama_kelas">Nama Kelas</label>
                          <input name="nama_kelas" type="text" class="form-control" value="{{$tiap_kelas->nama_kelas}}">
                        </div>

                        <div class="form-group">
                          <label for="kapasitas">Kapasitas Kelas</label>
                          <input name="kapasitas" type="number" class="form-control" value="{{$tiap_kelas->kapasitas}}">
                        </div>

                        <div class="form-group">
                          <label for="jurusan">Jurusan</label>
                          <input name="jurusan" type="text" class="form-control" value="{{$tiap_kelas->jurusan}}">
                        </div>

                        <div class="form-group">
                          <label for="tingkat">Tingkat</label>
                          <input name="tingkat" type="number" class="form-control" value="{{$tiap_kelas->tingkat}}">
                        </div>

                        <div class="form-group">
                          <label for="guru_id">Masukan Nama Guru</label>
                          <select name="guru_id" class="form-control select" data-live-search="true" required>
                            <option>-Masukan Nama Guru-</option>

                            @foreach($data_guru as $guru)
                            <option value="{{$guru->id}}">{{$guru->nama_lengkap}}</option>
                            @endforeach

                          </select>
                        </div>



                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal end-->
              @endforeach
            </tbody>
          </table>

          <!-- Modal Tambah Kelas-->
          <div class="modal fade" id="tambahKelas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Kelas</h5>
                </div>
                <div class="modal-body">

                  <form action="{{route('pegawai.kelas.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Kelas</label>
                      <input name="kode_kelas" type="text" class="form-control" placeholder="Kode Kelas">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kelas</label>
                      <input name="nama_kelas" type="text" class="form-control" placeholder="Kelas">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kapasitas</label>
                      <input name="kapasitas" type="number" class="form-control" placeholder="Kapasitas">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jurusan</label>
                      <input name="jurusan" type="text" class="form-control" placeholder="Jurusan">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tingkat</label>
                      <input name="tingkat" type="number" class="form-control" placeholder="Tingkat">

                    </div>

                    <div class="form-group">
                      <label for="guru_id">Masukan Nama Guru</label>
                      <select name="guru_id" class="form-control select" data-live-search="true" required>
                        <option>-Masukan Nama Guru-</option>

                        @foreach($data_guru as $guru)
                        <option value="{{$guru->id}}">{{$guru->nama_lengkap}}</option>
                        @endforeach

                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal end-->

        </div>
      </div>
      <!-- END DEFAULT DATATABLE -->

    </div>
  </div>
</div>

@stop
