@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="">Jadwal Pengganti</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Jadwal Pengganti</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  

</div>

<div class="panel panel-success">
  <div class="panel-heading ui-draggable-handle">
    <div class="panel-title">
      Jadwal Pengganti dari Dosen
    </div>
    <ul class="panel-controls">
      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
    </ul>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <!-- JADWAL NEW -->
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-3 push-down-20">
            <a href="#" class="btn btn-sm btn-info" id="tampil">Tampilkan Jadwal</a>
            <a href="#" class="btn btn-sm btn-info" id="sembunyi">Sembunyikan Jadwal</a>
          </div>
          <table class="table datatable" id="jadwal_table">
            <thead>
              <tr>
                <th>No</th>
                <th>Prodi</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Ruangan</th>
                <th>Pertemuan ke-</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Action</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data_jadwal_pengganti as $no => $jadwal)
              <tr>
                <td>{{++$no}}</td>
                <td>{{$jadwal->prodi->nama_program_studi ?? ''}}</td>
                <td>{{$jadwal->tanggal_pengganti}}</td>
                <td>{{$jadwal->waktu->jam_masuk}} - {{$jadwal->waktu->jam_keluar}}</td>
                <td>{{$jadwal->mapel->nama_mapel}}</td>
                <td>{{$jadwal->dosen->nama_dosen ?? ''}}</td>
                <td>{{$jadwal->kelas->nama_kelas}}</td>
                <td>{{$jadwal->ruang->nama_ruangan ?? ''}}</td>
                <td>
                {{$jadwal->pertemuan_ke}}
                </td>
                <td>
                {{$jadwal->keterangan}}
                </td>
                <td>{{$jadwal->status}}</td>
                <td align="center"><a class="btn btn-primary" data-toggle="modal" data-target="#editJadwal{{$jadwal->id}}"><span class="fa fa-edit"></span>Edit</a></td>
              </tr>

              <div class="modal fade" id="editJadwal{{$jadwal->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="staticBackdropLabel">Edit Jadwal Pengganti</h5>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.jadwal.pengganti.update',['id' => $jadwal->id] )}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                          <div class="form-group">
                            <label for="tahun_ajaran_id">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Tahun Ajaran-</option>

                              @foreach($data_tahun_ajaran as $tahun_ajaran)
                              <option value="{{$tahun_ajaran->id}}" {{$tahun_ajaran->id == $jadwal->tahun_ajaran_id ? 'selected' : ' ' }}>{{$tahun_ajaran->nama_tahun_ajaran}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="nama_kelas">Semester</label>
                            <select name="semester_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Semester-</option>

                              @foreach($data_semester as $semester)
                              <option value="{{$semester->id}}" {{$semester->id == $jadwal->semester_id ? 'selected' : ' ' }}>{{$semester->nama_semester}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="nama_kelas">Program Studi</label>
                            <select name="prodi_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Program Studi-</option>

                              @foreach($data_prodi as $prodi)
                              <option value="{{$prodi->id_prodi}}" {{$prodi->id_prodi == $jadwal->prodi_id ? 'selected' : ' ' }}>{{$prodi->nama_program_studi ??''}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Kelas-</option>

                              @foreach($data_kelas as $kelas)
                              <option value="{{$kelas->id}}" {{$kelas->id == $jadwal->kelas_id ? 'selected' : ' ' }}>{{$kelas->nama_kelas}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="kelas_id">Ruangan</label>
                            <select name="ruangan_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Ruangan-</option>

                              @foreach($data_ruangan as $ruangan)
                              <option value="{{$ruangan->id}}" {{$ruangan->id == $jadwal->ruangan_id ? 'selected' : ' ' }}>{{$ruangan->nama_ruangan}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="guru_id">Dosen</label>
                            <select name="guru_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Dosen-</option>

                              @foreach($data_dosen as $guru)
                              <option value="{{$guru->id}}" {{$guru->id == $jadwal->id_dosen ? 'selected' : ' ' }}>{{$guru->nama_dosen}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="mapel_id">Mata Kuliah</label>
                            <select name="mapel_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Mata Kuliah-</option>

                              @foreach($data_mapel as $mapel)
                              <option value="{{$mapel->id}}" {{$mapel->id == $jadwal->mapel_id ? 'selected' : ' ' }}>{{$mapel->nama_mapel}}</option>
                              @endforeach

                            </select>
                          </div>


                          <div class="form-group">
                            <label for="hari_id">Hari</label>
                            <select name="hari_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Hari-</option>

                              @foreach($data_hari as $hari)
                              <option value="{{$hari->id}}" {{$hari->id == $jadwal->hari_id ? 'selected' : ' ' }}>{{$hari->hari}}</option>
                              @endforeach

                            </select>
                          </div>

                          <div class="form-group">
                            <label for="waktu_id">Waktu</label>
                            <select name="waktu_id" class="form-control" data-live-search="true" disabled>
                              <option value="">-Masukan Waktu-</option>

                              @foreach($data_waktu as $waktu)
                              <option value="{{$waktu->id}}" {{$waktu->id == $jadwal->waktu_id ? 'selected' : ' ' }}>{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                              @endforeach

                            </select>

                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" data-live-search="true" required>

                              <option value="pending" {{($jadwal->status == 'pending' )? 'selected' : ' ' }}>Pending</option>
                              <option value="ditolak" {{($jadwal->status == 'ditolak' )? 'selected' : ' ' }}>Ditolak</option>
                              <option value="diterima" {{($jadwal->status == 'diterima' )? 'selected' : ' ' }}>Diterima</option>


                            </select>

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
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

@stop

@section('data-scripts')
<script>
  $(function() {
    $('#jadwal_table').hide();
    $('#sembunyi').hide();

    $('#tampil').click(function() {
      $('#sembunyi').show();
      $('#tampil').hide();


      $('#jadwal_table').show();
    });

    $('#sembunyi').click(function() {
      $('#tampil').show();
      $('#sembunyi').hide();


      $('#jadwal_table').hide();
    });

    $('#generate-button').click(function() {
      var jumlah_kromosom = $('#jumlah_kromosom').val();
      var jumlah_crossover = $('#jumlah_crossover').val();
      var jumlah_generasi = $('#jumlah_generasi').val();
      var jumlah_mutasi = $('#jumlah_mutasi').val();





      console.log('kr: ' + jumlah_kromosom + ' , cr: ' + jumlah_crossover + ' , gen : ' + jumlah_generasi + ', mut: ' + jumlah_mutasi)


    });


  });
</script>
@stop