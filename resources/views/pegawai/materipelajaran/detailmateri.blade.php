@extends('layouts.joliadmin-top')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="{{ route('pegawai.materipelajaran.index') }}">Materi Pelajaran</a></li>
  <li class="active">Detail Materi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span>Detail Materi Pelajaran</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Materi Pelajaran</a></li>
          <li><a href="#tab-second" role="tab" data-toggle="tab">Tugas</a></li>
          <li><a href="#tab-third" role="tab" data-toggle="tab">Kuis</a></li>
          <!-- <li><a href="#tab-fourd" role="tab" data-toggle="tab">RPP</a></li> -->
        </ul>
        <div class="panel-body tab-content">

          <div class="tab-pane active" id="tab-first">

            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Materi Pelajaran </h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a class="" data-toggle="modal" data-target="#tambahMateri"><span class="fa fa-plus-circle"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Mata Kuliah</th>
                          <th>BAB Materi</th>
                          <th>Nama Materi</th>
                          <th>Deskripsi</th>
                          <th>Kelas</th>
                          <th>Tanggal Unggah</th>
                          <th>Terunduh</th>
                          <th>File Materi</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i=1; $j=0; @endphp
                        @foreach($data_materi_pelajaran as $materi_pelajaran)
                        @php $j++; @endphp
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$materi_pelajaran->mapel->nama_mapel}}</td>
                          <td>{{$materi_pelajaran->bab_materi}}</td>
                          <td>{{$materi_pelajaran->nama_materi}}</td>
                          <td>{{$materi_pelajaran->deskripsi_materi}}</td>
                          <td>
                            @foreach($materi_pelajaran->kelas as $kelas)
                            <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                            @endforeach

                          </td>
                          <td>
                            <span class="badge badge-secondary">
                              {{\Carbon\Carbon::parse($materi_pelajaran->created_at)->format('d M Y')}}
                            </span>
                          </td>
                          <td>{{$materi_pelajaran->jumlah_unduh}} kali unduh</td>
                          <td>
                            @php
                            $path = Storage::url('public/dokumen/' . $materi_pelajaran->file_materi);
                            @endphp
                            <span class="badge badge-info">{{$materi_pelajaran->file_materi}}</span>
                          </td>
                          <td>
                            <a href="{{route('unduh.dokumen', [ 'path' => $path , 'id' => $materi_pelajaran->id ] )}}" class="btn btn-info btn-sm" target="_blank">Download File</a>
                            @can('edit-materi-pelajaran')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editMateri{{$j}}">Edit</a>
                            @endcan
                            @can('delete-materi-pelajaran')
                            <a href="{{route('pegawai.materipelajaran.destroy',['id' => $materi_pelajaran->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            @endcan
                          </td>

                        </tr>

                        <!-- Modal EDIT-->
                        <div class="modal fade" id="editMateri{{$j}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Materi Pelajaran</h5>
                              </div>
                              <div class="modal-body">

                                <form action="{{route('pegawai.materipelajaran.update',['id' => $materi_pelajaran->id, 'id_dosen' => $id_dosen] )}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                  @csrf

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">BAB Materi</label>
                                    <input name="bab_materi" type="texts" class="form-control" value="{{$materi_pelajaran->bab_materi}}">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Materi</label>
                                    <input name="nama_materi" type="text" class="form-control" value="{{$materi_pelajaran->nama_materi}}">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <input name="deskripsi_materi" type="text" class="form-control" value="{{$materi_pelajaran->deskripsi_materi}}">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kelas</label>
                                    <select name="id_kelas[]" multiple class="form-control" required>
                                      @php
                                      $materi_kelas = $materi_pelajaran->kelas;
                                      @endphp
                                      @foreach($data_kelas as $kelas)
                                      <option value="{{$kelas->kelas_id}}" {{$materi_kelas->where('id', $kelas->kelas_id)->first() ? 'selected' : ''}}> {{$kelas->nama_kelas}}</option>
                                      @endforeach

                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Unggah Materi</label><br />
                                    <input type="file" name="file_materi" />
                                  </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach

                  
                      </tbody>
                    </table>

                    <!-- Modal TAMBAH Materi Pelajaran-->
                    <div class="modal fade" id="tambahMateri" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Materi Pelajaran</h5>
                          </div>
                          <div class="modal-body">

                            <form action="{{route('pegawai.materipelajaran.store', [ 'id' => $id_dosen , 'mapel' => $mapel_id, 'id_prodi' => $id_prodi, 
                              'semester'=> $semester, 'tahun_ajaran' => $tahun_ajaran] )}}" method="post" enctype="multipart/form-data">
                              @csrf
                    
                              <div class="form-group">
                                <label for="exampleInputEmail1">BAB Materi</label>
                                <input name="bab_materi" type="texts" class="form-control" placeholder="Nama Bab Materi">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Nama Materi</label>
                                <input name="nama_materi" type="text" class="form-control" placeholder="Nama Materi">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi Materi</label>
                                <input name="deskripsi_materi" type="text" class="form-control" placeholder="Deskripsi Materi">
                              </div>

                              <div class="form-group">
                                <label class="control-label">Masukan Kelas</label>
                                <select name="id_kelas[]" multiple class="form-control" required>
                                  @foreach($data_kelas as $kelas)
                                  <option value="{{$kelas->kelas_id}}">{{$kelas->nama_kelas}}</option>
                                  @endforeach

                                </select>
                              </div>

                              <div class="form-group">
                                <label>Unggah Materi</label><br />
                                <input type="file" multiple id="file-simple" name="file_materi" />
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
                <!-- END DEFAULT DATATABLE -->

              </div>
            </div>

          </div>
          <div class="tab-pane" id="tab-second">

            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"> Tugas </h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      @can('create-tugas')
                      <li><a class="" data-toggle="modal" data-target="#tambahTugas"><span class="fa fa-plus-circle"></span></a></li>
                      @endcan
                    </ul>
                  </div>
                  <div class="panel-body">
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Mata Kuliah</th>
                          <th>Kode Tugas</th>
                          <th>Nama Tugas</th>
                          <th>Deskripsi Tugas</th>
                          <th>Kelas</th>
                          <th>Tanggal Mulai</th>
                          <th>Deadline</th>
                          <th>File Tugas</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 1; $j = 0; @endphp
                        @foreach($data_tugas as $tugas)
                        @php $j++; @endphp
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$tugas->mapel->nama_mapel}}</td>
                          <td>{{$tugas->kode_tugas}}</td>
                          <td>{{$tugas->judul_tugas}}</td>
                          <td>{{$tugas->deskripsi_tugas}}</td>
                          <td>
                            @foreach($tugas->kelas as $kelas)
                            <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                            @endforeach
                          </td>
                          <td>
                            <span class="badge badge-secondary">
                              {{\Carbon\Carbon::parse($tugas->tanggal_mulai)->format('d M Y')}}
                            </span>
                          </td>

                          <td>
                            <span class="badge badge-danger">
                              {{\Carbon\Carbon::parse($tugas->tanggal_akhir)->format('d M Y')}}
                            </span>
                          </td>
                          <td>
                            @php
                            $path = Storage::url('public/tugas/' . $tugas->nama_file_tugas);
                            @endphp
                            <span class="badge badge-info">{{$tugas->nama_file_tugas}}</span>
                          </td>


                          <td>
                            <a href="{{route('tugas.download', [ 'path_tugas' => $path,  $tugas->id ] )}}" class="btn btn-info btn-sm" target="_blank">Download File</a>
                            @can('edit-tugas')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editTugas{{$j}}">Edit</a>
                            @endcan
                            @can('delete-tugas')
                            <a href="{{route('pegawai.materipelajaran.tugasDestroy',['id' => $tugas->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            @endcan
                          </td>
                        </tr>

                         <!-- Modal EDIT-->
                         <div class="modal fade" id="editTugas{{$j}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Tugas</h5>
                              </div>
                              <div class="modal-body">

                                <form action="{{route('pegawai.materipelajaran.updateTugas',['id' => $tugas->id, 'id_dosen' => $tugas->created_by ] )}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                  @csrf
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Tugas</label>
                                    <input name="kode_tugas" type="texts" class="form-control" value="{{$tugas->kode_tugas}}" placeholder="Kode Tugas">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Judul Tugas</label>
                                    <input name="judul_tugas" type="text" class="form-control" value="{{$tugas->judul_tugas}}" placeholder="Judul Tugas">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Deksripsi Tugas</label>
                                    <input name="deskripsi_tugas" type="text" class="form-control" value="{{$tugas->deskripsi_tugas}}" placeholder="Deskripsi Tugas">
                                  </div>

                                  <div class="form-group">

                                    <label for="exampleInputEmail1">Tanggal Mulai</label>
                                    <input name="tanggal_mulai" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($tugas->tanggal_mulai)->format('Y-m-d\TH:i')}}" placeholder="Tanggal Mulai">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Deadline</label>
                                    <input name="tanggal_akhir" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($tugas->tanggal_akhir)->format('Y-m-d\TH:i')}}" placeholder="Deadline">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Kelas</label>
                                    <select name="id_kelas[]" multiple class="form-control" required>
                                      @php
                                      $materi_kelas = $tugas->kelas;
                                      @endphp
                                      @foreach($data_kelas as $kelas)
                                      <option value="{{$kelas->kelas_id}}" {{$materi_kelas->where('id', $kelas->kelas_id)->first() ? 'selected' : ''}}> {{$kelas->nama_kelas}}</option>
                                      @endforeach

                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Unggah Materi</label><br />
                                    <input type="file" name="file_tugas" />
                                  </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach

                      </tbody>
                    </table>
                     <!-- Modal TAMBAH Tugas -->
                     <div class="modal fade" id="tambahTugas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Tugas Baru</h5>
                          </div>
                          <div class="modal-body">

                            <form action="{{route('pegawai.materipelajaran.storeTugas',['id' => $id_dosen, 'mapel'=>$mapel_id, 'id_prodi' => $id_prodi, 'semester'=> $semester, 'tahun_ajaran' => $tahun_ajaran ] )}}" method="post" enctype="multipart/form-data">
                              @csrf

                              <div class="form-group">
                                <label for="exampleInputEmail1">Kode Tugas</label>
                                <input name="kode_tugas" type="texts" class="form-control" placeholder="Kode Tugas">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Judul Tugas</label>
                                <input name="judul_tugas" type="text" class="form-control" placeholder="Judul Tugas">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Deksripsi Tugas</label>
                                <input name="deskripsi_tugas" type="text" class="form-control" placeholder="Deskripsi Tugas">
                              </div>

                              <div class="form-group">

                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                <input name="tanggal_mulai" type="datetime-local" class="form-control" placeholder="Tanggal Mulai">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Deadline</label>
                                <input name="tanggal_akhir" type="datetime-local" class="form-control" placeholder="Deadline">
                              </div>

                              <div class="form-group">
                                <label class="control-label">Masukan Kelas</label>
                                <select name="id_kelas[]" multiple class="form-control" required>
                                  @foreach($data_kelas as $kelas)
                                  <option value="{{$kelas->kelas_id}}">{{$kelas->nama_kelas}}</option>
                                  @endforeach

                                </select>
                              </div>

                              <div class="form-group">
                                <label>Unggah Materi</label><br />
                                <input type="file" multiple id="file-simple" name="file_tugas" />
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- END DEFAULT DATATABLE -->

              </div>
            </div>

          </div>
          <div class="tab-pane" id="tab-third">

            <div class="row">
              <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"> Kuis</h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Soal</th>
                          <th>Judul Kuis</th>
                          <th>Kelas</th>
                          <th>Tanggal Mulai</th>
                          <th>Batas Waktu</th>
                          <th>Jumlah Soal</th>
                          <th>Durasi Kuis</th>
                          <!-- <th>Opsi</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_quiz as $no => $quiz)
                        <tr>
                          <td>{{++$no}}</td>
                          <td>{{$quiz->kode_soal}}</td>
                          <td>{{$quiz->judul_kuis}}</td>
                          <td>
                            @foreach($quiz->kelas as $kelas)
                            <span class="badge badge-warning">
                              {{$kelas->nama_kelas}}
                            </span>
                            @endforeach
                          </td>
                          <td>{{$quiz->tanggal_mulai}}</td>
                          <td>{{$quiz->tanggal_akhir}}</td>
                          <td>{{$quiz->jumlah_soal}} Soal</td>
                          <td>{{$quiz->durasi}} Menit</td>
                          <!-- <td>
                            <button type="button" class="btn btn-success">Edit</button>
                            <button href="#" type="button" class="btn btn-danger">Hapus</button>
                          </td> -->
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

          <!-- <div class="tab-pane" id="tab-fourd">

            <div class="row">
              <div class="col-md-12"> -->

                <!-- START DEFAULT DATATABLE -->
                <!-- <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"> RPP (Rencana Program Pelajaran) </h3>
                    <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th>ID RPP</th>
                          <th>BAB</th>
                          <th>Judul</th>
                          <th>Deskripsi RPP</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data_rpp as $rpp)

                        <tr>
                          <td>{{$rpp->id_rpp}}</td>
                          <td>{{$rpp->bab}}</td>
                          <td>{{$rpp->judul}}</td>
                          <td>{!!$rpp->deskripsi!!}</td>
                          <td>
                            <a class="btn btn-success" data-toggle="modal" data-target="#editRPP">Edit</a>
                            <a href="{{route('guru.destroy.rpp',['id' => $rpp->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                          </td>
 -->

                          <!-- Modal EDIT-->
                          <!-- <div class="modal fade" id="editRPP" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Materi Pelajaran</h5>
                                </div>
                                <div class="modal-body">

                                  <form action="{{route('guru.update.rpp', ['id' => $rpp->id])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf

                                    <div class="form-group">
                                      <label for="id_rpp">ID RPP</label>
                                      <input name="id_rpp" type="text" class="form-control" placeholder="ID Pelajaran" value="{{$rpp->id_rpp}}">
                                    </div>

                                    <div class="form-group">
                                      <label for="bab">BAB</label>
                                      <input name="bab" type="text" class="form-control" placeholder="ID Pelajaran" value="{{$rpp->bab}}">
                                    </div>

                                    <div class="form-group">
                                      <label for="judul">Judul</label>
                                      <input name="judul" type="text" class="form-control" placeholder="ID Pelajaran" value="{{$rpp->judul}}">
                                    </div>

                                    <div class="form-group">
                                      <label for="deskripsi">Deskripsi RPP</label>
                                      <textarea class="summernote" name="deskripsi">
                                      {{$rpp->deskripsi}}
                                      </textarea>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Edit</button>
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
                </div> -->
                <!-- END DEFAULT DATATABLE -->

              </div>
            </div>

          </div>

        </div>
      </div>
      <!-- END TABS -->

    </div>
  </div>
</div>

@stop
