@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="{{ route('guru.jadwalujian.index') }}">Jadwal Ujian</a></li>
  <li class="active">Jadwal Ujian Detail</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Jadwal Ujian {{$jadwal_ujian->title}} {{$jadwal_ujian->year}}</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Jadwal Ujian {{$jadwal_ujian->title}} {{$jadwal_ujian->year}}</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalujian"><span class="fa fa-plus-circle"></span></a></li>
          </ul>
        </div>
        <div class="panel-body">
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Tanggal Ujian</th>
                <th>Kelas</th>
                <th>Pelajaran</th>
                <th>Waktu Ujian</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @php
              $i = 1;
              @endphp
              @foreach($data_jadwal_ujian_detail as $jadwal_ujian_detail)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$jadwal_ujian_detail->nama_ruangan}}</td>
                <td>
                  <span class="badge badge-secondary">
                    {{\Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('d M Y')}}
                  </span>
                </td>
                <td>{{$jadwal_ujian_detail->kelas->nama_kelas}}</td>
                <td>{{$jadwal_ujian_detail->mapel->nama_mapel}}</td>
                <td>
                  {{\Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('H:i:s')}}
                </td>
                <td align="center">
                  <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#editJadwalUjian{{$jadwal_ujian_detail->id}}">Edit</a>
                  <a href="{{route('guru.jadwalujian.destroyDetail',['id' => $jadwal_ujian_detail->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                  <!-- <a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Ujian"><span class="fa fa-print"></span></a> -->
                </td>
              </tr>

              <!-- MODAL EDIT JADWAL UJIAN-->
              <div class="modal fade" id="editJadwalUjian{{$jadwal_ujian_detail->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="staticBackdropLabel">Edit Jadwal Ujian</h5>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('guru.jadwalujian.updateDetail',[ 'id' => $jadwal_ujian_detail->id ] ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="form-group">
                            <label for="kelas">Ruang Ujian</label>
                            <select name="nama_ruangan" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Ruang Ujian-</option>

                              @foreach($data_kelas as $kelas)
                              @if($jadwal_ujian_detail->nama_ruangan == $kelas->nama_kelas)
                              <option value="{{$kelas->nama_kelas}}" selected>{{$kelas->nama_kelas}}</option>
                              @else
                              <option value="{{$kelas->nama_kelas}}">{{$kelas->nama_kelas}}</option>
                              @endif

                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <select name="kelas_id" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                              @if($jadwal_ujian_detail->kelas_id == $kelas->id)
                              <option value="{{$kelas->id}}" selected>{{$kelas->nama_kelas}}</option>
                              @else
                              <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                              @endif
                              
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="mapel">Masukan Mata Pelajaran</label>
                            <select name="mapel_id" class="form-control select" data-live-search="true" required>
                              <option value="">-Masukan Mata Pelajaran-</option>

                              @foreach($data_mapel as $matpel)
                              @if($jadwal_ujian_detail->mapel_id == $matpel->id)
                              <option value="{{$matpel->id}}" selected>{{$matpel->nama_mapel}}</option>
                              @else
                              <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                              @endif
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Tanggal Ujian</label>
                            <div class="input-group">
                              <input name="tanggal_ujian" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('Y-m-d\TH:i')}}">
                              <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </tbody>
          </table>
        </div>
      </div>
      <!-- END DEFAULT DATATABLE -->


      <!-- Modal TAMBAH JADWAL-->
      <div class="modal fade" id="tambahDatajadwalujian" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Ujian</h5>
            </div>
            <div class="modal-body">

              <form action="{{route('guru.jadwalujian.add',[ 'id' => $jadwal_ujian->id ] ) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="form-group">
                    <label for="kelas">Ruang Ujian</label>
                    <select name="nama_ruangan" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan Ruang Ujian-</option>

                      @foreach($data_kelas as $kelas)
                      <option value="{{$kelas->nama_kelas}}">{{$kelas->nama_kelas}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kelas</label>
                    <select name="kelas_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan Kelas-</option>

                      @foreach($data_kelas as $kelas)
                      <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="mapel">Masukan Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan Mata Pelajaran-</option>

                      @foreach($data_mapel as $matpel)
                      <option value="{{$matpel->id}}">{{$matpel->nama_mapel}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Tanggal Ujian</label>
                    <div class="input-group">
                      <input name="tanggal_ujian" type="datetime-local" class="form-control" placeholder="Tanggal Mulai">
                      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                  </div>








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
</div>

@stop