@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.walikelas.datarapor.index') }}">Data Rapor</a></li>
      <li class="active">Rapor Siswa</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Rapor Siswa</h2>
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
                </ul>
            </div>


            <!-- <div class="panel-heading">
                <form action="#" method="post">
                    {{csrf_field()}}
                    @method('get')
                    <label class="control-label block">Pilih Tahun Ajaran Dan Semester</label>
                    <div class="form-group">

                      <div class="col-md-4">
                        <select name="guru_id" class="form-control select" data-live-search="true" required>
                          <option value="">-Pilih Tahun Ajaran-</option>
                              <option value="">1 ssssssssssss</option>
                              <option value="">2 ssssssssssss</option>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <select name="guru_id" class="form-control select" data-live-search="true" required>
                          <option value="">-Pilih Semester-</option>
                              <option value="">1 ssssssssssss</option>
                              <option value="">2 ssssssssssss</option>
                        </select>
                      </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
                        </div>
                    </div>

                </form>
            </div> -->


            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th width="60">No</th>
                          <th width="100">NIS</th>
                          <th width="100">Photo</th>
                          <th>Nama Lengkap Siswa</th>
                          <th>Tahun Ajaran</th>
                          <th>Semester</th>
                          <th>Keterangan</th>
                          <th width="100">Action</th>

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
                            <td>{{$tahun_ajaran->nama_tahun_ajaran}}</td>
                            <td>{{$semester->nama_semester}}</td>
                            <td>
                              @foreach($ket_data_rapor as $ket)
                                @if($ket['nis'] == $siswa->NIS)
                                  @if($ket['keterangan'])
                                    <span class="label label-info label-form">Data Rapor <strong>Sudah Ada</strong></span>
                                  @else
                                    <span class="label label-warning label-form">Data Rapor <strong>Belum Ada</strong></span>
                                  @endif
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($ket_data_rapor as $ket)
                                @if($ket['nis'] == $siswa->NIS)
                                  @if($ket['keterangan'])
                                    <a href="{{route('guru.walikelas.datarapor.raporsiswa', $siswa->id)}}" class="btn btn-info"> <span class="fa fa-eye"></span> Lihat Rapor</a>
                                  @else
                                    <button class="btn btn-success" data-toggle="modal" data-target="#inputnilairapor{{$siswa->id}}"> <span class="fa fa-edit"></span> Buat Rapor</button>
                                  @endif
                                @endif
                              @endforeach
                            </td>
                        </tr>

                        <div class="modal fade" id="inputnilairapor{{$siswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">Input Rapor <strong>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</strong></h5>
                              </div>
                              <div class="modal-body">

                                <form action="{{route('guru.walikelas.datarapor.store', $siswa->id)}}" method="post">
                                {{csrf_field()}}

                                  <div class="form-group">
                                    <label for="">Wali Kelas</label>
                                    <input name="wali_kelas" type="text" class="form-control" value="{{$data_walikelas->getNamaLengkap($data_walikelas->guru_id)}}" placeholder="Masukan Wali Kelas">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Kelas</label>
                                    <input name="nis" type="hidden" class="form-control" value="{{$siswa->NIS}}">
                                    <input name="nama_siswa" type="hidden" class="form-control" value="{{$siswa->nama_depan}} {{$siswa->nama_belakang}}">
                                    <input name="kelas_siswa" type="hidden" class="form-control" value="{{$siswa->kelas->nama_kelas}}">
                                    <input name="" type="text" class="form-control" value="{{$siswa->kelas->nama_kelas}}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Tahun Ajaran</label>
                                    <input name="tahun_ajaran" type="text" class="form-control" value="{{$tahun_ajaran->nama_tahun_ajaran}}" placeholder="Masukan Tahun Ajaran">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Semester</label>
                                    <input name="semester" type="text" class="form-control" value="{{$semester->nama_semester}}" placeholder="Masukan Semester">
                                  </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Buat Rapor</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
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
