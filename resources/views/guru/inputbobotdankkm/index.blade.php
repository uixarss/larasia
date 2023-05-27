@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Nilai Bobot dan KKM</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Nilai Bobot dan KKM</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nilai Bobot dan KKM</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Bobot Pengetahuan</th>
                            <th>Bobot Keterampilan</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($data_bobot as $no => $bobot)

                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$bobot->mapel->nama_mapel}}</td>
                            <td>10 MIA</td>
                            <td>{{$bobot->bobot_pengetahuan->nilai_harian}} - {{$bobot->bobot_pengetahuan->nilai_akhir}}</td>
                            <td>{{$bobot->bobot_keterampilan->nilai_praktek}} - {{$bobot->bobot_keterampilan->nilai_project}}</td>
                            @foreach($data_guru->mapel->kkms as $kkm)
                            <td>{{$kkm->nilai}}</td>
                            @endforeach
                            <td align="center">
                              @can('edit-nilai')
                              <a  class="btn btn-success" data-toggle="modal" data-target="#editbobotdankkm{{$bobot->id}}">Edit</a>
                              @endcan
                            </td>
                        </tr>

                        <!-- Modal EDIT-->
                        <div class="modal fade" id="editbobotdankkm{{$bobot->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h5 class="modal-title" id="staticBackdropLabel">Edit Bobot dan KKM</h5>
                            </div>
                            <div class="modal-body">

                              <form  action="{{route('guru.bobotdankkm.update', $bobot->id)}}" method="post">
                                @csrf
                                {{method_field('PUT')}}

                                <div class="row">
                                  <h5 class="modal-title">Bobot Nilai Pengetahuan</h5>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="nilai_harian">Bobot Nilai Harian</label>
                                        <input name="nilai_harian" type="number" class="form-control" value="{{$bobot->bobot_pengetahuan->nilai_harian}}" placeholder="50">
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="nilai_akhir">Bobot Nilai Akhir</label>
                                        <input name="nilai_akhir" type="number" class="form-control" value="{{$bobot->bobot_pengetahuan->nilai_akhir}}" placeholder="50">
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="total_bobot">Total Bobot</label>
                                        <input name="total_bobot" type="number" class="form-control"  value="100" disabled>
                                      </div>
                                    </div>
                                </div> <br><br>

                                <div class="row">
                                  <h5 class="modal-title">Bobot Nilai Keterampilan</h5>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="nilai_praktek">Bobot Nilai Praktek</label>
                                        <input name="nilai_praktek" type="number" class="form-control" value="{{$bobot->bobot_keterampilan->nilai_praktek}}"  placeholder="50">
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="nilai_project">Bobot Nilai Projek</label>
                                        <input name="nilai_project" type="number" class="form-control" value="{{$bobot->bobot_keterampilan->nilai_project}}"  placeholder="50">
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="total_bobot">Total Bobot</label>
                                        <input name="total_bobot" type="number" class="form-control"  value="100" disabled>
                                      </div>
                                    </div>
                                </div> <br><br><br>

                                <div class="row">
                                  <h5 class="modal-title">Kriteria Ketuntasan Minimal</h5>
                                  @foreach($data_guru->mapel->kkms as $kkm)
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">KKM</label>
                                        <input name="" type="number" class="form-control" value="{{$kkm->nilai}}" disabled>
                                      </div>
                                    </div>
                                  @endforeach

                                    <div class="col-md-8">

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Predikat</label>
                                        </div>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Nilai Rendah</label>
                                        </div>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Nilai Tinggi</label>
                                        </div>
                                      </div>

                                      @foreach($grade_nilai as $nilai)

                                      <!-- Nilai KKM Pertama -->

                                      <div class="col-md-4 push-down-10">
                                        <div class="form-group">
                                          <input name="" type="text" class="form-control"  value="{{$nilai->nama_grade}}" disabled>
                                        </div>
                                      </div>

                                      <div class="col-md-4 push-down-10">
                                        <div class="form-group">
                                          <input name="" type="number" class="form-control"  value="{{$nilai->nilai_rendah}}" disabled>
                                        </div>
                                      </div>

                                      <div class="col-md-4 push-down-10">
                                        <div class="form-group">
                                          <input name="" type="number" class="form-control"  value="{{$nilai->nilai_tinggi}}" disabled>
                                        </div>
                                      </div>

                                      @endforeach

                                    </div>
                                </div> <br><br>


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
    </div>
  </div>

@stop
