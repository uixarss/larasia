@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.walikelas.datanilai.index') }}">Nilai Siswa</a></li>
      <li class="active">Detail Nilai Harian</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Detail Nilai Harian</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Input Nilai</h3>
              <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              </ul>
          </div>

          <div id="timer" class="panel-body">

            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="col-md-6">
                  <h3>Kelas</h3>
                  <h4><p kelas_id="{{$data_kelas->id}}" class="text-info"> <strong> {{$data_kelas->nama_kelas}}</strong></p></h4>

                  <h5><p class="text-success">Semester {{$semester->nama_semester}} -
                    Tahun Ajaran {{$tahun_ajaran->nama_tahun_ajaran}}
                  </p></h5>
                </div>

              </div>
            </div>

            <div class="col-md-12 push-down-10">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel-subtitle">
                      <p>Pilih Guru Pengajar untuk melihat nilai di pelajaran yang lain :</p>
                  </div>
                </div>
              </div>
              <div class="row push-up-20">
                <label class="col-md-2 control-label">Pilih Guru Pengajar</label>

                <div class="col-md-7">
                  <form action="{{route('guru.walikelas.datanilai.show', $data_kelas->id)}}" method="get">
                    {{csrf_field()}}
                    @method('put')
                    <div class="form-group">
                      <select name="guru_id" class="form-control select pilihMataPelajaran" data-live-search="true" required>
                        <option value="">-Pilih Guru Pengajar-</option>

                        @foreach($data_guru as $guru)
                        @if ($guru_id->id == $guru->id)
                        <option value="{{$guru->id}}" selected>{{$guru->nama_lengkap}} || {{$guru->mapel->nama_mapel ?? ''}}</option>
                        @else
                        <option value="{{$guru->id}}">{{$guru->nama_lengkap}} || {{$guru->mapel->nama_mapel ?? ''}}</option>
                        @endif
                        @endforeach

                      </select>

                    </div>

                  </div>

                <div class="col-md-2">
                  <button type="submit" class="btn btn-info"> <span class="fa fa-search"></span> Cari</button>
                  </form>
                </div>
              </div>
            </div>


            <!-- START DEFAULT DATATABLE -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table datatable table-bordered table-striped table-actions">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="100">NIS</th>
                            <th>Nama Siswa</th>
                            <th width="150">Nilai Rata-Rata Harian</th>
                            <th width="150">Hasil Nilai Akhir</th>
                            <th width="100">Huruf Mutu</th>
                            <th width="100">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($data_siswa as $no => $siswa)


                        <tr>
                          <td>{{++$no}}</td>
                          <td>{{$siswa->NIS}}</td>
                          <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                          <td align="center">
                            @foreach($arr as $nilai)
                              @if($nilai['id'] == $siswa->id &&
                              $nilai['guru_id'] == $guru_id->id &&
                              $nilai['mapel_id'] == $guru_id->mapel_id &&
                              $nilai['tahun_ajaran_id'] == $tahun_ajaran->id &&
                              $nilai['semester_id'] == $semester->id)
                                <p name="" aria-hidden="false">{{$nilai['nilai_rata2']}}</p>
                              @endif
                            @endforeach
                          </td>

                          <td align="center">
                            @foreach($siswa->nilai_akhir as $nilai_akhir)
                            @if($nilai_akhir->guru_id == $guru_id->id && $nilai_akhir->mapel_id == $guru_id->mapel_id)
                            <!-- <p name="" aria-hidden="false">{{$nilai_akhir->nilai_akhir}} || {{$nilai_akhir->mapel->nama_mapel}} || {{$nilai_akhir->guru->nama_lengkap}}</p> -->
                            <p name="" aria-hidden="false"> <strong>{{$nilai_akhir->nilai_akhir}}</strong></p>
                            @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach($siswa->nilai_akhir as $nilai_akhir)
                              @if($nilai_akhir->guru_id == $guru_id->id && $nilai_akhir->mapel_id == $guru_id->mapel_id)
                                @foreach($grade_nilai as $gn)
                                  @if($nilai_akhir->nilai_akhir >= $gn->nilai_rendah && $nilai_akhir->nilai_akhir <= $gn->nilai_tinggi)
                                    <p aria-hidden="false" class="form-control" align="center"> <strong> {{$gn->nama_grade}} </strong></p>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          </td>
                          <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#list_nilai_harian{{$siswa->id}}"> <span class="fa fa-list"></span> Detail Nilai Harian</button>
                          </td>
                        </tr>

                        <div class="modal fade" id="list_nilai_harian{{$siswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">List Nilai Harian</h5>
                              </div>
                              <div class="modal-body">
                                @foreach($siswa->nilai_harian as $nilai_harian)
                                  @if($nilai_harian->mapel_id == $guru_id->mapel_id )
                                     <p aria-hidden="false" class="form-control"> <strong> {{$nilai_harian->nilai_harian}} </strong></p>
                                  @endif
                                @endforeach
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    </div>
  </div>

@stop
