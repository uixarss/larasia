@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.nilaiakhir.index') }}">Nilai Akhir</a></li>
      <li class="active">Input Nilai Akhir</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Input Nilai Akhir</h2>
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
                            @if($nilai['id'] == $siswa->id && $nilai['mapel_id'] == $data_guru->mapel->id && $nilai['tahun_ajaran_id'] == $tahun_ajaran->id && $nilai['semester_id'] == $semester->id)
                              <p name="" aria-hidden="false">{{$nilai['nilai_rata2']}}</p>
                            @endif
                          @endforeach
                          </td>

                          <td align="center">
                            @foreach($siswa->nilai_akhir as $na)
                              @if($na->siswa_id == $siswa->id &&
                              $na->mapel_id == $data_guru->mapel->id &&
                              $na->tahun_ajaran_id == $tahun_ajaran->id &&
                              $na->semester_id == $semester->id &&
                              $na->guru_id == $data_guru->id
                              )
                                <p name="" aria-hidden="false"> <strong>{{$na->nilai_akhir}}</strong></p>
                              @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach($siswa->nilai_akhir as $na)
                              @if($na->siswa_id == $siswa->id &&
                              $na->mapel_id == $data_guru->mapel->id
                              && $na->tahun_ajaran_id == $tahun_ajaran->id &&
                              $na->semester_id == $semester->id &&
                              $na->guru_id == $data_guru->id
                              )
                              @foreach($grade_nilai as $gn)
                                @if($na->nilai_akhir >= $gn->nilai_rendah && $na->nilai_akhir <= $gn->nilai_tinggi)
                                  <p aria-hidden="false" class="form-control" align="center"> <strong> {{$gn->nama_grade}} </strong></p>
                                @endif
                              @endforeach
                              @endif
                            @endforeach
                          </td>
                          <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#tambahNilai{{$siswa->id}}"> <span class="fa fa-plus"></span> Input Nilai Akhir </button>
                          </td>
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

                                <form action="{{route('guru.nilaiakhir.updatenilaiakhir', $siswa->id)}}" method="post">
                                  {{csrf_field()}}

                                  <div class="form-group">
                                    <label for="">NIS</label>
                                    <input name="" type="text" class="form-control" value="{{$siswa->NIS}}" disabled>
                                  </div>

                                  <div class="form-group">
                                    <label for="kode_jenis_ujian">Nama Siswa</label>
                                    <input name="" type="text" class="form-control" value="{{$siswa->nama_depan}} {{$siswa->nama_belakang}}" disabled>
                                    <input name="siswa_id" type="hidden" class="form-control" value="{{$siswa->id}}">
                                    <input name="siswa_id" type="hidden" class="form-control" value="{{$siswa->id}}">
                                    <input name="mapel_id" type="hidden" class="form-control" value="{{$data_guru->mapel->id}}">
                                    <input name="tahun_ajaran_id" type="hidden" class="form-control" value="{{$tahun_ajaran->id}}">
                                    <input name="semester_id" type="hidden" class="form-control" value="{{$semester->id}}">
                                  </div>



                                    @foreach($siswa->nilai_akhir as $na)
                                      @if($na->siswa_id == $siswa->id &&
                                      $na->mapel_id == $data_guru->mapel->id &&
                                      $na->tahun_ajaran_id == $tahun_ajaran->id &&
                                      $na->semester_id == $semester->id &&
                                      $na->guru_id == $data_guru->id
                                      )
                                      <input name="id_na" type="number" class="form-control" value="{{$na->id}}" placeholder="Masukan Nilai Harian">
                                      <input name="" type="number" class="form-control" value="{{$na->nilai_akhir}}" placeholder="Masukan Nilai Harian">
                                      @endif
                                    @endforeach


                                  @foreach($arr as $nilai)
                                    @if($nilai['id'] == $siswa->id)
                                    <div class="form-group">
                                      <label for="">Nilai Harian</label>
                                      <input name="" type="number" class="form-control" value="{{$nilai['nilai_rata2']}}" placeholder="Masukan Nilai Harian" disabled>
                                      <input name="nilai_harian" type="hidden" class="form-control" value="{{$nilai['nilai_rata2']}}" placeholder="Masukan Nilai Harian">
                                    </div>


                                  <div class="form-group">
                                    <label for="">Nilai Keterampilan</label>
                                    <input name="nilai_keterampilan" type="number" class="form-control" value="" placeholder="Masukan Nilai Harian" required>
                                  </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                @if($nilai['nilai_rata2']?? '' != '' && $nilai['id_na']['nilai_akhir'] ?? '' != '')
                                <button type="submit" class="btn btn-success">Update</button>

                                @elseif($nilai['nilai_rata2'] != '')
                                <button type="submit" class="btn btn-success">Simpan</button>
                                @endif

                                @endif
                              @endforeach
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
              <a href="" class="btn btn-primary pull-right">Simpan</a>
          </div>
        </div>

      </div>
    </div>
  </div>

@stop
