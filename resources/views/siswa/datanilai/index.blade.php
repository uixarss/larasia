@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Data Nilai</li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h3><span class="fa fa-sort-numeric-asc"></span> Data Nilai</h3>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <div class="panel-body ">
      <div class="col-md-12">

        <div class="panel panel-deafult push-up-20">
          <div class="panel-heading push-down-10">
            <div class="col-md-12">
              <form action="{{route('siswa.datanilai.carinilai')}}" method="post">
              {{csrf_field()}}
                <div class="form-group">
                  <div class="col-md-12 push-up-10 push-down-10">
                    <h3>Pilih Guru untuk menampilkan <span class="text-info">Nilai</span> Mata Pelajaran lainnya</h3>
                  </div>
                  <div class="col-md-4">
                    <select name="guru_id" class="form-control" data-live-search="true" required>

                        @foreach($data_guru as $guru)
                          <option value="{{$guru->id_dosen}}">{{$guru->dosen->nama_dosen}} || {{$guru->mapel->nama_mapel ?? ''}}</option>
                        @endforeach

                    </select>
                  </div>

                  <!-- <div class="col-md-4">
                    <select name="mapel_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Pilih Mata Pelajaran-</option>

                      @foreach($data_guru as $guru)
                        <option value="{{$guru->mapel_id}}">{{$guru->mapel->nama_mapel ?? ''}}</option>
                      @endforeach

                    </select>
                  </div> -->

                  <button class="col-md-2 btn btn-primary"><i class="fa fa-search"></i>Cari Nilai</button>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading push-down-15">
              <div class="img-header-guru">
                  <a href="#" class="pull-left">
                    @if($guru_id->photo != null)
                      <img src="{{asset('admin/assets/images/users/guru/'.$guru_id->photo)}}">
                    @else
                      <img src="{{asset('admin/assets/images/users/guru/no-image.jpg')}}">
                    @endif
                  </a>

                   <div class="panel-title push-up-20">
                    <h3> <strong>{{$guru_id->nama_lengkap}}</strong></h3>
                    <p class="text-info">{{$guru_id->mapel->nama_mapel ?? ''}}</p>
                   </div>

              </div>
          </div>

          <ul class="nav nav-tabs push-left-20" role="tablist">
            <li class="active"><a href="#tab-semester1" role="tab" data-toggle="tab"> Semester Ganjil</a></li>
            <li><a href="#tab-semester2" role="tab" data-toggle="tab"> Semester Genap</a></li>
          </ul>

          <div class="panel-body tab-content">

            <div class="tab-pane active" id="tab-semester1">

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>Tugas</h3>
                      <span>Semseter 1</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata Tugas = <span> {{$nilai_harian_rata_rata}}</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM Tugas</th>
                            <th>Nilai Tugas</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i = 1; @endphp
                          @foreach($data_nilai_harian as $no => $nilai_harian)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>Senin</td>
                            <td>08 Juni 2019</td>
                            <td>07:00 WIB</td>
                            <td>
                              @foreach($nilai_harian->mapel->kkms as $kkm)
                              {{$kkm->nilai}}
                              @endforeach
                            </td>
                            <td>{{$nilai_harian->nilai_harian}}</td>
                            <td></td>
                          </tr>

                          @endforeach




                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>Kuis</h3>
                      <span>Semseter 1</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata Kuis = <span>{{$avg_quiz ?? ''}}</span>

                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM Kuis</th>
                            <th>Nilai Kuis</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data_quiz as $no => $quiz)
                          @php $i = 1; @endphp
                          @foreach($quiz->result_quizzes as $nilai_quiz)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>Senin</td>
                            <td>08 Juni 2019</td>
                            <td>07:00 WIB</td>
                            <td>
                              @foreach($quiz->mapel->kkms as $kkm)
                              {{$kkm->nilai}}
                              @endforeach
                            </td>
                            <td>{{$nilai_quiz->nilai_akhir}}</td>
                            <td></td>
                          </tr>
                          @endforeach
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>UTS</h3>
                      <span>Semseter 1</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata UTS = <span>{{$avg_uts ?? ''}}</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM UTS</th>
                            <th>Nilai UTS</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data_uts as $no => $uts)
                          @foreach($uts->result_quizzes as $nilai_uts)
                          <tr>
                            <td>{{++$no}}</td>
                            <td>Senin</td>
                            <td>08 Juni 2019</td>
                            <td>07:00 WIB</td>
                            <td>
                              @foreach($uts->mapel->kkms as $kkm)
                              {{$kkm->nilai}}
                              @endforeach
                            </td>
                            <td>{{$nilai_uts->nilai_akhir}}</td>
                            <td>-</td>
                          </tr>
                          @endforeach
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>UAS</h3>
                      <span>Semseter 1</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata UAS = <span>{{$avg_uas ?? ''}}</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM UAS</th>
                            <th>Nilai UAS</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data_uas as $no => $uas)
                          @foreach($uas->result_quizzes as $nilai_uas)
                          <tr>
                            <td>{{++$no}}</td>
                            <td>Senin</td>
                            <td>08 Juni 2019</td>
                            <td>07:00 WIB</td>
                            <td>
                              @foreach($uas->mapel->kkms as $kkm)
                              {{$kkm->nilai}}
                              @endforeach
                            </td>
                            <td>{{$nilai_uas->nilai_akhir}}</td>
                            <td>-</td>
                          </tr>
                          @endforeach
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

            </div>

            <div class="tab-pane" id="tab-semester2">

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>Tugas</h3>
                      <span>Semseter 2</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata Tugas = <span> -</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM Tugas</th>
                            <th>Nilai Tugas</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>Kuis</h3>
                      <span>Semseter 2</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata Kuis = <span></span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM Kuis</th>
                            <th>Nilai Kuis</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>UTS</h3>
                      <span>Semseter 2</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata UTS = <span> -</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM UTS</th>
                            <th>Nilai UTS</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>


                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="col-md-12 push-up-20">

                  <div class="panel-heading">
                    <div class="panel-title">
                      <h3>UAS</h3>
                      <span>Semseter 2</span>
                    </div>
                    <div class="pull-right push-up-15">
                      <span class="badge badge-success">
                        <div class="panel-title">
                          Nilai rata-rata UAS = <span> -</span>
                        </div>
                      </span>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="table datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>KKM UAS</th>
                            <th>Nilai UAS</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

            </div>

          </div>
        </div>

      </div>
    </div>

</div>
<!-- END CONTENT FRAME -->

@stop
