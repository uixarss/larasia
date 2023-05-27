@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.nilaiharian.index') }}">Nilai Harian</a></li>
      <li class="active">Input Nilai Harian</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Input Nilai Harian</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div id="timer"  class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Input Nilai</h3>
              <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              </ul>
          </div>

          <div class="panel-body">

            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="col-md-6">
                  <h3>Mata Pelajaran</h3>
                  <h4><p class="text-info">{{$data_guru->mapel->nama_mapel}}</p></h4>
                  <h3>Kelas</h3>
                  <h4><p class="text-info">{{$data_kelas->nama_kelas}}</p></h4>
                </div>

                <div class="col-md-6">
                  <h3>Semester</h3>
                  <h4><p class="text-info">Semester {{$semester->nama_semester}}</p></h4>
                  <h3>Tahun Ajaran</h3>
                  <h4><p class="text-info">{{$tahun_ajaran->nama_tahun_ajaran}}</p></h4>
                </div>
              </div>
            </div>

            <!-- START DEFAULT DATATABLE -->
            <div class="panel-body table-responsive">
              <div class="table-responsive">
                  <table class="table datatable table-bordered table-striped table-actions">
                      <thead>
                          <tr>
                              <th width="50">No</th>
                              <th width="100">NIS</th>
                              <th>Nama Siswa</th>
                              <th width="450">Nilai Harian</th>
                              <th width="100">Opsi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($data_siswa as $no => $siswa)
                          <tr>
                            <td>{{++$no}}</td>
                            <td>{{$siswa->NIS}}</td>
                            <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                            <td>
                              @foreach($siswa->nilai_harian as $nilai_harian)
                                @if($nilai_harian->siswa_id == $siswa->id &&
                                 $nilai_harian->mapel_id == $data_guru->mapel->id &&
                                 $nilai_harian->tahun_ajaran_id == $tahun_ajaran->id &&
                                 $nilai_harian->semester_id == $semester->id)

                                  <div class="col-md-2">
                                    <p aria-hidden="false" class="form-control" data-toggle="modal" data-target="#editNilai{{$siswa->id}}{{$nilai_harian->id}}">{{$nilai_harian->nilai_harian}} </p>
                                  </div>

                                  <div class="modal fade" id="editNilai{{$siswa->id}}{{$nilai_harian->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h5 class="modal-title" id="staticBackdropLabel">Tambah Nilai Harian</h5>
                                        </div>
                                        <div class="modal-body">

                                          <form action="{{URL::route('guru.nilaiharian.updatenilai', [$siswa->id , $nilai_harian->id])}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                              <label for="">NIS</label>
                                              <input name="" type="text" class="form-control" value="{{$siswa->NIS}}" disabled>
                                            </div>

                                            <div class="form-group">
                                              <label for="kode_jenis_ujian">Nama Siswa</label>
                                              <input name="" type="text" class="form-control" value="{{$siswa->nama_depan}} {{$siswa->nama_belakang}}" disabled>
                                              <input name="siswa_id" type="hidden" class="form-control" value="{{$siswa->id}}">
                                              <input name="mapel_id" type="hidden" class="form-control" value="{{$data_guru->mapel->id}}">
                                              <input name="tahun_ajaran_id" type="hidden" class="form-control" value="{{$tahun_ajaran->id}}">
                                              <input name="semester_id" type="hidden" class="form-control" value="{{$semester->id}}">
                                            </div>

                                            <div class="form-group">
                                              <label for="">Nilai Harian</label>
                                              <input name="nilai_harian" type="number" class="form-control" value="{{$nilai_harian->nilai_harian}}" placeholder="Masukan Nilai Harian" autofocus>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <a href="{{URL::route('guru.nilaiharian.destroynilai', [$siswa->id , $nilai_harian->id])}}" type="submit" class="btn btn-danger">Hapus</a>
                                          <button type="submit" class="btn btn-success">Ubah</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                @endif
                              @endforeach

                            </td>
                            <td><button class="btn btn-warning" data-toggle="modal" data-target="#tambahNilai{{$siswa->id}}"> <span class="fa fa-plus"></span> Tambah</td>
                          </tr>

                          <div class="modal fade" id="tambahNilai{{$siswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Nilai Harian</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="{{route('guru.nilaiharian.update', $siswa->id)}}" method="post">
                                    {{csrf_field()}}
                                    @method('put')
                                    <div class="form-group">
                                      <label for="">NIS</label>
                                      <input name="" type="text" class="form-control" value="{{$siswa->NIS}}" disabled>
                                    </div>

                                    <div class="form-group">
                                      <label for="kode_jenis_ujian">Nama Siswa</label>
                                      <input name="" type="text" class="form-control" value="{{$siswa->nama_depan}} {{$siswa->nama_belakang}}" disabled>
                                      <input name="siswa_id" type="hidden" class="form-control" value="{{$siswa->id}}">
                                      <input name="mapel_id" type="hidden" class="form-control" value="{{$data_guru->mapel->id}}">
                                      <input name="tahun_ajaran_id" type="hidden" class="form-control" value="{{$tahun_ajaran->id}}">
                                      <input name="semester_id" type="hidden" class="form-control" value="{{$semester->id}}">
                                    </div>

                                    <div class="form-group">
                                      <label for="">Nilai Harian</label>
                                      <input name="nilai_harian" type="number" class="form-control" placeholder="Masukan Nilai Harian" autofocus required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
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

          <div class="panel-footer">
              <button class="btn btn-primary pull-right">Simpan</button>
          </div>
        </div>

      </div>
    </div>
  </div>


@stop
