@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Data Absensi</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Data Absensi</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title"> <strong>Absensi Kelas {{$data_kelas->nama_kelas}}</strong><span>
                      <h5>Data Absensi {{\Carbon\Carbon::parse($tanggal_absen)->format('d M Y')}}</h5>
                  </span> </h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <!-- <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Data Kelas"><span class="fa fa-print"></span></a></li> -->
                    <li><a href="{{route('guru.walikelas.dataabsensi.laporan', [$kelas_id , 'tanggal_absen' => $tanggal_absen] )}}"><span class="fa fa-cloud-download"></span></a></li>
                </ul>
            </div>

            <div class="panel-heading">
                <form action="{{route('guru.walikelas.dataabsensi.show', $data_kelas->id)}}" method="post">
                    {{csrf_field()}}
                    @method('get')
                    <label class="control-label block">Pilih Tanggal Untuk Menampilkan Data Absensi</label>
                    <div class="form-group">


                        <div class="col-md-5">
                            <div class="input-group">
                                <input placeholder="Pilih Tanggal Disini" type="text" name="tanggal_absen" class="form-control datepicker" value="{{$tanggal_absen}}" id="dp-4" data-date="2020-04-13" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>No. Hp</th>
                            <th>Absensi</th>
                            <th>Jam Absen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi_siswa_t as $absensi_siswa)
                        @if($absensi_siswa->siswa->kelas_id == $kelas_id)

                        <tr>
                            <td>{{$absensi_siswa->siswa->NIS}}</td>
                            <td>{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}</td>
                            <td>{{$absensi_siswa->siswa->kelas->nama_kelas}}</td>
                            <td>{{$absensi_siswa->siswa->no_phone}}</td>

                            @switch($absensi_siswa->keterangan)
                            @case('Hadir')
                            <td><span class="label label-info label-form">Hadir</span></td>
                            <td>{{$absensi_siswa->jam_masuk}} WIB</td>
                            @break
                            @case('Izin')
                            <td><span class="label label-warning label-form">Izin</span></td>
                            <td>{{$absensi_siswa->jam_masuk}} WIB</td>
                            @break

                            @case('Sakit')
                            <td><span class="label label-default label-form">Sakit</span></td>
                            <td>{{$absensi_siswa->jam_masuk}} WIB</td>
                            @break

                            @default
                            <td><span class="label label-danger label-form">Alpha</span></td>
                            <td>{{$absensi_siswa->jam_masuk}} WIB</td>
                            @endswitch

                            <td>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editAbsen{{$absensi_siswa->id}}"> <span class="fa fa-edit"></span> Edit</a>
                            </td>


                            <div class="modal fade" id="editAbsen{{$absensi_siswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Absensi Siswa</h5>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{route('guru.walikelas.dataabsensi.update', [$kelas_id , 'tanggal_absen' => $tanggal_absen])}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('PUT')}}

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">NIS</label>
                                      <input name="" type="text" class="form-control" value="{{$absensi_siswa->siswa->NIS}}" disabled>
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Siswa</label>
                                      <input name="nama_orangtua" type="text" class="form-control"  placeholder="Nama Orang Tua" value="{{$absensi_siswa->siswa->nama_depan}} {{$absensi_siswa->siswa->nama_belakang}}" disabled>
                                      <input type="hidden" name="siswa_id" value="{{$absensi_siswa->siswa->id}}">
                                    </div>

                                    <div class="form-group">
                                      <label for="mapel">Keterangan Absensi</label>
                                      <select name="ket_absen" class="form-control select" data-live-search="true" required>
                                        <option value="">-Pilih Keterangan Absensi-</option>

                                        @switch($absensi_siswa->keterangan)
                                        @case('Hadir')
                                        <option value="Hadir" selected>Hadir</option>
                                        <!-- <option value="Hadir">Hadir</option> -->
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alpha">Alpha</option>
                                        @break
                                        @case('Sakit')
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit" selected>Sakit</option>
                                        <!-- <option value="Sakit">Sakit</option> -->
                                        <option value="Izin">Izin</option>
                                        <option value="Alpha">Alpha</option>
                                        @break
                                        @case('Izin')
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin" selected>Izin</option>
                                        <!-- <option value="Izin">Izin</option> -->
                                        <option value="Alpha">Alpha</option>
                                        @break
                                        @case('Alpha')
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alpha" selected>Alpha</option>
                                        <!-- <option value="Alpha">Alpha</option> -->
                                        @break
                                        @default
                                        <option value="" selected>Masukan Keterangan Absensi</option>
                                        @endswitch

                                      </select><br><br><br><br><br>
                                    </div>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

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

@stop
