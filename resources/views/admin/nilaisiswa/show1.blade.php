@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('admin.nilaisiswa.index') }}">Nilai Siswa</a></li>
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
                  <h4><p class="text-info"> <strong> {{$data_kelas->nama_kelas}}</strong></p></h4>

                  <h5><p class="text-success">Semester {{$semester->nama_semester}} -
                    Tahun Ajaran {{$tahun_ajaran->nama_tahun_ajaran}}
                  </p></h5>
                </div>

              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <select name="mapel_id" class="form-control select pilihMataPelajaran" data-live-search="true" required>
                  <option value="">-Masukan Mata Pelajaran-</option>

                  @foreach($data_mapel as $mapel)
                    <option name="mapel_id" mapel_id="{{$mapel->id}}" value="{{$mapel->id}}">{{$mapel->nama_mapel}} || {{$mapel->id}}</option>
                  @endforeach

                </select>

                <input id="mapel_id" type="hidden" name="" value="">
              </div>
            </div>

            <!-- START DEFAULT DATATABLE -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table datatable table-bordered table-striped table-actions">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <!-- <th>coba</th> -->
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
                              @if($nilai['id'] == $siswa->id && $nilai['mapel_id'] == $nilai['id_na']['mapel_id'] && $nilai['tahun_ajaran_id'] == $tahun_ajaran->id && $nilai['semester_id'] == $semester->id)
                                <p name="" aria-hidden="false">{{$nilai['nilai_rata2']}}</p>
                              @endif
                            @endforeach
                          </td>

                          <td align="center">
                            @foreach($arr as $nilai)
                              @if($nilai['id'] == $siswa->id && $nilai['mapel_id'] == $nilai['id_na']['mapel_id'] && $nilai['tahun_ajaran_id'] == $tahun_ajaran->id && $nilai['semester_id'] == $semester->id)
                                <p name="" aria-hidden="false">{{$nilai['id_na']['nilai_akhir']}}</p>
                              @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach($arr as $nilai)
                              @if($nilai['id'] == $siswa->id && $nilai['mapel_id'] == $nilai['id_na']['mapel_id'] && $nilai['tahun_ajaran_id'] == $tahun_ajaran->id && $nilai['semester_id'] == $semester->id)

                              @foreach($grade_nilai as $gn)
                                @if($nilai['id_na']['nilai_akhir'] >= $gn->nilai_rendah && $nilai['id_na']['nilai_akhir'] <= $gn->nilai_tinggi)
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

                                  @foreach($data_nilai_harian as $nilai_harian)
                                    @if($nilai_harian->siswa_id == $siswa->id &&
                                     $nilai_harian->tahun_ajaran_id == $tahun_ajaran->id &&
                                     $nilai_harian->semester_id == $semester->id)

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
