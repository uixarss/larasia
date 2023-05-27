@extends('layouts.joliadmin-top')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('pegawai.kumpulansoal.index') }}">List Dosen</a></li>
      <li class="active">Kumpulan Soal</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Kumpulan Soal - {{$dosen->nama_dosen}} ({{$mapel->nama_mapel}})</h2>
  </div>
  <div class="page-title">
      <h4></span>{{$pengampu->prodi->nama_program_studi}} - Semester {{$pengampu->semester->nama_semester}} ({{$pengampu->tahunAjaran->nama_tahun_ajaran}})</h4>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-heading">
          <button class="btn btn-info pull-right" data-toggle="modal" data-target="#tambahSoal"><span class="fa fa-plus-circle"></span> Buat Soal</button>


        <!-- START VERTICAL TABS WITH HEADING -->
        <div class="panel panel-default tabs">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-kuis" data-toggle="tab">Soal KUIS</a></li>
            <li><a href="#tab-uts" data-toggle="tab">Soal UTS</a></li>
            <li><a href="#tab-uas" data-toggle="tab">Soal UAS</a></li>
          </ul>
            </div>
            <div class="panel-body tab-content">

                <div class="tab-pane active" id="tab-kuis">

                  <div class="row">
                    <div class="col-md-12">

                      <!-- START DEFAULT DATATABLE -->
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">Soal Soal KUIS</h3>
                              <ul class="panel-controls">
                                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                  <!-- <li><a href="#" data-toggle="modal" data-target="#tambahSoalUts"><span class="fa fa-plus-circle"></span></a></li> -->
                              </ul>
                          </div>
                          <div class="panel-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th width="70">No</th>
                                        <th width="100">Nama Dosen</th>
                                        <th width="100">Mata Kuliah</th>
                                        <th width="100">Program Studi</th>
                                        <th width="100">Semester</th>
                                        <th width="100">Tahun Ajaran</th>
                                        <th width="100">Kode Soal</th>
                                        <th width="100">Jenis Soal</th>
                                        <th>Nama Soal</th>
                                        <th width="100">Kelas</th>
                                        <th width="100">Jumlah</th>
                                        <th width="100">Waktu</th>
                                        <th width="100">Created</th>
                                        <th width="250">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($data_quiz as $no => $quiz)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$quiz->dosen->nama_dosen}}</td>
                                        <td>{{$quiz->mapel->nama_mapel}}</td>
                                        <td>{{$quiz->prodi->nama_program_studi}}</td>
                                        <td>{{$quiz->semester->nama_semester}}</td>
                                        <td>{{$quiz->tahunAjaran->nama_tahun_ajaran}}</td>
                                        <td>{{$quiz->kode_soal}}</td>
                                        <td>{{$quiz->jenis_ujians->nama_jenis_ujian}}</td>
                                        <td>{{$quiz->judul_kuis}}</td>
                                        <td>
                                          @foreach($quiz->kelas as $kelas)
                                          <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                          @endforeach
                                        </td>
                                        <td>{{$quiz->jumlah_soal}} Soal</td>
                                        <td>{{$quiz->durasi}} Menit</td>
                                        <td>{{$quiz->user->name}}</td>
                                        <td align="center">
                                          <form action="{{route('pegawai.kumpulansoal.destroy', $quiz->id)}}" method="post">
                                          {{ csrf_field() }}
                                          @method('delete')
                                            <a href="{{route('pegawai.kumpulansoal.show', $quiz->id)}}" type="button" class="btn btn-primary">Detail</a>
                                            <button data-toggle="modal" data-target="#editSoalQuiz{{$quiz->id}}" type="button" class="btn btn-success">Edit</button>
                                            <button href="#" type="submit" class="btn btn-danger">Hapus</button>
                                          </form>
                                        </td>

                                        <div class="modal fade" id="editSoalQuiz{{$quiz->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Soal Quiz</h4>
                                              </div>
                                              <div class="modal-body">

                                                <form action="{{route('pegawai.kumpulansoal.update', $quiz->id)}}" method="POST">
                                                  {{csrf_field()}}
                                                  @method('put')
                                                  <div class="form-group">
                                                    <label for="jenis_soal">Jenis Soal</label>
                                                      <select name="jenis_soal" class="form-control" data-live-search="true" required>
                                                        @foreach($jenis_soal as $jenis)
                                                            @if ($quiz->jenis_ujians->id == $jenis->id)
                                                                <option value="{{$jenis->id}}" selected>{{$jenis->nama_jenis_ujian}}</option>
                                                            @else
                                                                <option value="{{$jenis->id}}">{{$jenis->nama_jenis_ujian}}</option>
                                                            @endif
                                                        @endforeach

                                                      </select>
                                                  </div>

                                                  

                                                  <div class="form-group">
                                                    <label class="control-label">Masukan Kelas</label>
                                                    <select name="id_kelas[]" multiple class="form-control" data-live-search="true" required>
                                                      @foreach($data_kelas as $key => $kelas)
                                                          <option value="{{$kelas->kelas_id}}" @if($quiz->kelas->containsStrict('id', $kelas->kelas_id)) selected="selected" @endif> {{$kelas->nama_kelas}}</option>
                                                          {{$kelas->nama_kelas}}+{{$key}}
                                                      @endforeach

                                                    </select>
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="kode_soal">Kode Soal</label>
                                                    <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$quiz->kode_soal}}">
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="kode_soal">Judul Soal</label>
                                                    <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$quiz->judul_kuis}}">
                                                  </div>


                                                  <div class="form-group">
                                                    <label for="durasi">Durasi</label>
                                                    <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit" value="{{$quiz->durasi}}">
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                                    <input name="tanggal_mulai" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($quiz->tanggal_mulai)->format('Y-m-d\TH:i')}}"/>
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                                    <input name="tanggal_akhir" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($quiz->tanggal_akhir)->format('Y-m-d\TH:i')}}"/>
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

                <div class="tab-pane" id="tab-uts">

                  <div class="row">
                    <div class="col-md-12">

                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Soal Soal UTS</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <!-- <li><a href="#" data-toggle="modal" data-target="#tambahSoalUts"><span class="fa fa-plus-circle"></span></a></li> -->
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="70">No</th>  
                                            <th width="100">Nama Dosen</th>
                                            <th width="100">Mata Kuliah</th>
                                            <th width="100">Program Studi</th>
                                            <th width="100">Semester</th>
                                            <th width="100">Tahun Ajaran</th>
                                            <th width="100">Kode Soal</th>
                                            <th width="100">Jenis Soal</th>
                                            <th>Nama Soal</th>
                                            <th width="100">Kelas</th>
                                            <th width="100">Jumlah</th>
                                            <th width="100">Waktu</th>
                                            <th width="100">Created</th>
                                            <th width="250">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($data_uts as $no => $uts)
                                        <tr>
                                            <td>{{++$no}}</td>
                                            <td>{{$uts->dosen->nama_dosen}}</td>
                                            <td>{{$uts->mapel->nama_mapel}}</td>
                                            <td>{{$uts->prodi->nama_program_studi}}</td>
                                            <td>{{$uts->semester->nama_semester}}</td>
                                            <td>{{$uts->tahunAjaran->nama_tahun_ajaran}}</td>
                                            <td>{{$uts->kode_soal}}</td>
                                            <td>{{$uts->jenis_ujians->nama_jenis_ujian}}</td>
                                            <td>{{$uts->judul_kuis}}</td>
                                            <td>
                                              @foreach($uts->kelas as $kelas)
                                              <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                              @endforeach
                                            </td>
                                            <td>{{$uts->jumlah_soal}} Soal</td>
                                            <td>{{$uts->durasi}} Menit</td>
                                            <td>{{$uts->user->name}}</td>
                                            <td align="center">
                                              <form action="{{route('pegawai.kumpulansoal.destroy', $uts->id)}}" method="post">
                                              {{ csrf_field() }}
                                              @method('delete')
                                                <a href="{{route('pegawai.kumpulansoal.show', $uts->id)}}" type="button" class="btn btn-primary">Detail</a>
                                                <button data-toggle="modal" data-target="#editSoalUts{{$uts->id}}" type="button" class="btn btn-success">Edit</button>
                                                <button href="#" type="submit" class="btn btn-danger">Hapus</button>
                                              </form>
                                            </td>

                                            <div class="modal fade" id="editSoalUts{{$uts->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit Soal UTS</h4>
                                                  </div>
                                                  <div class="modal-body">

                                                    <form action="{{route('pegawai.kumpulansoal.update', $uts->id)}}" method="POST">
                                                      {{csrf_field()}}
                                                      @method('put')
                                                      <div class="form-group">
                                                        <label for="jenis_soal">Jenis Soal</label>
                                                          <select name="jenis_soal" class="form-control" data-live-search="true" required>
                                                            @foreach($jenis_soal as $jenis)
                                                                @if ($uts->jenis_ujians->id == $jenis->id)
                                                                    <option value="{{$jenis->id}}" selected>{{$jenis->nama_jenis_ujian}}</option>
                                                                @else
                                                                    <option value="{{$jenis->id}}">{{$jenis->nama_jenis_ujian}}</option>
                                                                @endif
                                                            @endforeach

                                                          </select>
                                                      </div>

                                                      <div class="form-group">
                                                        <label class="control-label">Masukan Kelas</label>
                                                        <select name="id_kelas[]" multiple class="form-control" data-live-search="true" required>
                                                          @foreach($data_kelas as $key => $kelas)
                                                              <option value="{{$kelas->kelas_id}}" @if($uts->kelas->containsStrict('id', $kelas->kelas_id)) selected="selected" @endif> {{$kelas->nama_kelas}}</option>
                                                              {{$kelas->nama_kelas}}+{{$key}}
                                                          @endforeach

                                                        </select>
                                                      </div>

                                                      <div class="form-group">
                                                        <label for="kode_soal">Kode Soal</label>
                                                        <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$uts->kode_soal}}">
                                                      </div>

                                                      <div class="form-group">
                                                        <label for="kode_soal">Judul Soal</label>
                                                        <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$uts->judul_kuis}}">
                                                      </div>


                                                      <div class="form-group">
                                                        <label for="durasi">Durasi</label>
                                                        <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit" value="{{$uts->durasi}}">
                                                      </div>

                                                      <div class="form-group">
                                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                                        <input name="tanggal_mulai" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($uts->tanggal_mulai)->format('Y-m-d\TH:i')}}"/>
                                                      </div>

                                                      <div class="form-group">
                                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                                        <input name="tanggal_akhir" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($uts->tanggal_akhir)->format('Y-m-d\TH:i')}}"/>
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

                <div class="tab-pane" id="tab-uas">

                  <div class="row">
                    <div class="col-md-12">

                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Soal Soal UAS</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <!-- <li><a href="#" data-toggle="modal" data-target="#tambahSoalUts"><span class="fa fa-plus-circle"></span></a></li> -->
                                </ul>
                            </div>
                            <div class="panel-body">
                              <table class="table datatable">
                                  <thead>
                                      <tr>
                                            <th width="70">No</th>  
                                            <th width="100">Nama Dosen</th>
                                            <th width="100">Mata Kuliah</th>
                                            <th width="100">Program Studi</th>
                                            <th width="100">Semester</th>
                                            <th width="100">Tahun Ajaran</th>
                                            <th width="100">Kode Soal</th>
                                            <th width="100">Jenis Soal</th>
                                            <th>Nama Soal</th>
                                            <th width="100">Kelas</th>
                                            <th width="100">Jumlah</th>
                                            <th width="100">Waktu</th>
                                            <th width="100">Created</th>
                                          <th width="250">Opsi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data_uas as $no => $uas)
                                      <tr>
                                          <td>{{++$no}}</td>
                                            <td>{{$uas->dosen->nama_dosen}}</td>
                                            <td>{{$uas->mapel->nama_mapel}}</td>
                                            <td>{{$uas->prodi->nama_program_studi}}</td>
                                            <td>{{$uas->semester->nama_semester}}</td>
                                            <td>{{$uas->tahunAjaran->nama_tahun_ajaran}}</td>
                                            <td>{{$uas->kode_soal}}</td>
                                            <td>{{$uas->jenis_ujians->nama_jenis_ujian}}</td>
                                            <td>{{$uas->judul_kuis}}</td>
                                          <td>
                                            @foreach($uas->kelas as $kelas)
                                            <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                            @endforeach
                                          </td>
                                          <td>{{$uas->jumlah_soal}} Soal</td>
                                          <td>{{$uas->durasi}} Menit</td>
                                          <td>{{$uas->user->name}}</td>
                                          <td align="center">
                                            <form action="{{route('pegawai.kumpulansoal.destroy', $uas->id)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('delete')
                                              <a href="{{route('pegawai.kumpulansoal.show', $uas->id)}}" type="button" class="btn btn-primary">Detail</a>
                                              <button data-toggle="modal" data-target="#editSoalUas{{$uas->id}}" type="button" class="btn btn-success">Edit</button>
                                              <button href="#" type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                          </td>

                                          <div class="modal fade" id="editSoalUas{{$uas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                  <h4 class="modal-title" id="staticBackdropLabel">Edit Soal UAS</h4>
                                                </div>
                                                <div class="modal-body">

                                                  <form action="{{route('pegawai.kumpulansoal.update', $uas->id)}}" method="POST">
                                                    {{csrf_field()}}
                                                    @method('put')
                                                    <div class="form-group">
                                                      <label for="jenis_soal">Jenis Soal</label>
                                                        <select name="jenis_soal" class="form-control" data-live-search="true" required>
                                                          @foreach($jenis_soal as $jenis)
                                                              @if ($uas->jenis_ujians->id == $jenis->id)
                                                                  <option value="{{$jenis->id}}" selected>{{$jenis->nama_jenis_ujian}}</option>
                                                              @else
                                                                  <option value="{{$jenis->id}}">{{$jenis->nama_jenis_ujian}}</option>
                                                              @endif
                                                          @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                      <label class="control-label">Masukan Kelas</label>
                                                      <select name="id_kelas[]" multiple class="form-control" data-live-search="true" required>
                                                        @foreach($data_kelas as $key => $kelas)
                                                            <option value="{{$kelas->kelas_id}}" @if($uas->kelas->containsStrict('id', $kelas->kelas_id)) selected="selected" @endif> {{$kelas->nama_kelas}}</option>
                                                            {{$kelas->nama_kelas}}+{{$key}}
                                                        @endforeach

                                                      </select>
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="kode_soal">Kode Soal</label>
                                                      <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$uas->kode_soal}}">
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="kode_soal">Judul Soal</label>
                                                      <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$uas->judul_kuis}}">
                                                    </div>


                                                    <div class="form-group">
                                                      <label for="durasi">Durasi</label>
                                                      <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit" value="{{$uas->durasi}}">
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="tanggal_mulai">Tanggal Mulai</label>
                                                      <input name="tanggal_mulai" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($uas->tanggal_mulai)->format('Y-m-d\TH:i')}}"/>
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="tanggal_akhir">Tanggal Akhir</label>
                                                      <input name="tanggal_akhir" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($uas->tanggal_akhir)->format('Y-m-d\TH:i')}}"/>
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

            </div>

        </div>
        <!-- END VERTICAL TABS WITH HEADING -->



    </div>
    </div>
  </div>

  <div class="modal fade" id="tambahSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="staticBackdropLabel">Tambah Soal</h4>
        </div>
        <div class="modal-body">

          <form action="{{route('pegawai.kumpulansoal.store', ['id' => $id_dosen, 'mapel'=>$mapel_id, 'id_prodi' => $id_prodi, 'semester' => $semester,'tahun_ajaran' => $tahun_ajaran  ] )}}" method="POST">
            {{csrf_field()}}

            <div class="form-group">
              <label for="jenis_soal">Jenis Soal</label>
                <select name="jenis_soal" class="form-control" data-live-search="true" required>

                  @foreach($jenis_soal as $jenis)
                    <option value="{{$jenis->id}}">{{$jenis->nama_jenis_ujian}}</option>
                  @endforeach

                </select>
            </div>

            <div class="form-group">
              <label class="control-label">Masukan Kelas</label>
              <select name="id_kelas[]" multiple class="form-control" data-live-search="true" required>

                @foreach($data_kelas as $kelas)
                <option value="{{$kelas->kelas_id}}">{{$kelas->nama_kelas}}</option>
                @endforeach

              </select>
            </div>


            <div class="form-group">
              <label for="kode_soal">Kode Soal</label>
              <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis">
            </div>

            <div class="form-group">
              <label for="kode_soal">Judul Soal</label>
              <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Kode Kuis">
            </div>


            <div class="form-group">
              <label for="durasi">Durasi</label>
              <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit">
            </div>

            <div class="form-group">
              <label for="tanggal_mulai">Tanggal Mulai</label>
              <input name="tanggal_mulai" type="datetime-local" class="form-control"/>
            </div>

            <div class="form-group">
              <label for="tanggal_akhir">Tanggal Akhir</label>
              <input name="tanggal_akhir" type="datetime-local" class="form-control"/>
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
@stop
