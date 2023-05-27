@extends('layouts.joliadmin')

@section('content')


<!-- Modal 10 MIA 1-->
<div class="modal fade" id="tambahSiswa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Siswa</h5>
      </div>
      <div class="modal-body">

        <form action="{{route('admin.siswa.create')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="exampleInputEmail1">NIS</label>
            <input name="NIS" type="text" class="form-control" placeholder="NIS">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Nama Depan</label>
            <input name="nama_depan" type="text" class="form-control" placeholder="Nama Depan">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Nama Belakang</label>
            <input name="nama_belakang" type="text" class="form-control" placeholder="Nama Belakang">
          </div>

          <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" class="form-control select" data-live-search="true" required>
              <option value="" disabled>-Masukan Nama Kelas-</option>

              @foreach($data_kelas as $kelas)
              <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
              @endforeach

            </select>
          </div>

          <div class="form-group">
            <label for="email_siswa">Email</label>
            <input name="email_siswa" type="email" class="form-control" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Agama</label>
            <input name="agama" type="texts" class="form-control" placeholder="Agama">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Modal 10 MIA 1-->

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Data Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Data Siswa</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap push-up-10">
  <div class="row">
    <div class="col-md-12">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">

          <!-- Kelas 10 Aktif -->
          <li class="active" role="tab" data-toggle="tab">
            <a href="" data-toggle="dropdown" class="dropdown-toggle">Kelas</span></a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation" class="dropdown-header">Pilih Kelas </li>
              @foreach($data_kelas as $key => $kelas)

              @if($key == 0)
              <li class="active"><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @else
              <li><a href="#{{$kelas->kode_kelas}}" role="tab" data-toggle="tab">{{$kelas->nama_kelas}}</a></li>
              @endif

              @endforeach

            </ul>
          </li>
          

        </ul>

        <!-- Tabel Kontent kelas 10-12 -->
        <div class="panel-body tab-content">

          <!-- TABS KELAS 10 -->
          @foreach($data_kelas as $key => $kelas)

          @if($key == 0)
          <div class="tab-pane active" id="{{$kelas->kode_kelas}}">

            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE 10 MIA 1-->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Data Kelas {{$kelas->nama_kelas}}</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahSiswa"><span class="fa fa-plus-circle"></span></a></li>
                      <!-- <li><a href="{{url('/admin/datasiswa/uploaddatasiswa')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Upload Data Siswa"><span class="fa fa-cloud-upload"></span></a></li> -->
                    </ul>
                  </div>

                  <div class="panel-body">
                    <table class="table datatable table-hover">
                      <thead>
                        <tr>
                          <th width="50">NIS</th>
                          <th>Photo</th>
                          <th>Nama Lengkap</th>
                          <th>Kelas</th>
                          <th>JK</th>
                          <th>Agama</th>
                          <th width="100">email</th>
                          <th width="100">Alamat</th>
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
                              <a href="{{route('admin.siswa.show',['id' => $siswa->id])}}">
                                @if($siswa->photo != null)
                                <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                @else
                                <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                @endif
                              </a>
                            </div>
                          </td>
                          <td><a href="{{route('admin.siswa.show',['id' => $siswa->id])}}"> <p class="text-primary">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</p> </a></td>
                          <td>{{$siswa->kelas->nama_kelas}}</td>
                          <td>{{$siswa->jenis_kelamin}}</td>
                          <td>{{$siswa->agama}}</td>
                          <td>{{$siswa->email_siswa}}</td>
                          <td>{{$siswa->alamat_sekarang}}</td>
                          <td align="center">
                            <a href="{{route('admin.siswa.edit',['id' => $siswa->id])}}" class="btn btn-success">Edit</a>
                            <a href="{{route('admin.siswa.delete',['id' => $siswa->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
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
                      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahSiswa"><span class="fa fa-plus-circle"></span></a></li>
                      <li><a href="{{url('/admin/datasiswa/uploaddatasiswa')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Upload Data Siswa"><span class="fa fa-cloud-upload"></span></a></li>
                    </ul>
                  </div>

                  <div class="panel-body">
                    <table class="table datatable table-hover">
                      <thead>
                        <tr>
                          <th width="50">NIS</th>
                          <th>Photo</th>
                          <th>Nama Lengkap</th>
                          <th>Kelas</th>
                          <th>JK</th>
                          <th>Agama</th>
                          <th>email</th>
                          <th width="70">Alamat</th>
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
                              <a href="{{route('admin.siswa.show',['id' => $siswa->id])}}">
                                @if($siswa->photo != null)
                                <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                @else
                                <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                @endif
                              </a>
                            </div>
                          </td>
                          <td><a href="{{route('admin.siswa.show',['id' => $siswa->id])}}"><p class="text-primary">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</p></a></td>
                          <td>{{$siswa->kelas->nama_kelas}}</td>
                          <td>{{$siswa->jenis_kelamin}}</td>
                          <td>{{$siswa->agama}}</td>
                          <td>{{$siswa->email_siswa}}</td>
                          <td>{{$siswa->alamat_sekarang}}</td>
                          <td align="center">
                            <a href="{{route('admin.siswa.edit',['id' => $siswa->id])}}" class="btn btn-success">Edit</a>
                            <a href="{{route('admin.siswa.delete',['id' => $siswa->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
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
          @endforeach

          

        </div>

      </div>
      <!-- END TABS -->


    </div>
  </div>
</div>


@stop
