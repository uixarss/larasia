@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li class="active">Jadwal Pelajaran Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Jadwal Pelajaran Siswa</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Jadwal Pelajaran </h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li><a class="" data-toggle="modal" data-target="#tambahDatajadwalpelajaran"><span class="fa fa-plus-circle"></span></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Pelajaran"><span class="fa fa-print"></span></a></li>
          </ul>
        </div>

        <div class="panel-heading">
          <div class="row">
            @if(session()->has('error'))
            <div class="alert alert-warning">
              {{ session()->get('error') }}
            </div>
            @endif
            <form action="#" method="post" enctype="multipart/form-data">
              @csrf
              <div class="col-md-3">
                <div class="form-group">
                  <label for="mapel">Kelas</label>
                  <select name="id_mapel" id="get_kelas" class="form-control select" data-live-search="true" required>
                    <option value="">-Pilih Kelas-</option>

                    @foreach($data_kelas as $kelas)
                    <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                    @endforeach

                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="mapel">Hari</label>
                  <select name="id_hari" id="get_hari" class="form-control select" data-live-search="true" required>
                    <option value="">-Pilih Hari-</option>

                    @foreach($data_hari as $hari)
                    <option value="{{$hari->id}}">{{$hari->hari}}</option>
                    @endforeach

                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="mapel">Tahun Ajaran</label>
                  <select name="id_mapel" id="get_tahun_ajaran" class="form-control select" data-live-search="true" required>
                    <option value="">-Pilih Tahun Ajaran-</option>

                    @foreach($tahun_ajaran as $tahunajaran)
                    <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                    @endforeach

                  </select>
                </div>

              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="mapel">Semester</label>
                  <select name="id_mapel" id="get_semester" class="form-control select" data-live-search="true" required>
                    <option value="">-Pilih Semester-</option>

                    @foreach($data_semester as $semester)
                    <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                    @endforeach

                  </select>
                </div>

                <a href="#" id="tampil-jadwal" class="btn btn-success btn-block">Tampilkan data</a>


              </div>

            </form>
          </div>
        </div>

        <div class="panel-body table-responsive">
          <table id="jadwal_table" class="table table-hover text-center table-condensed table-striped">
            <thead>
              <th style="text-align: center;">Jam Pelajaran</th>
              <th style="text-align: center;">Mata Pelajaran</th>
              <th style="text-align: center;">Guru</th>
              <th style="width: 130px; text-align: center;">Action</th>
            </thead>
          </table>
        </div>

      </div>
      <!-- END DEFAULT DATATABLE -->

      <!-- Modal TAMBAH DataPegawai-->
      <div class="modal fade" id="tambahDatajadwalpelajaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="staticBackdropLabel">Buat Jadwal Pelajaran</h5>
            </div>
            <div class="modal-body">

              <form action="{{route('admin.tambah.jadwal.pelajaran')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row push-down-20">


                  <div class="form-group">
                    <label for="kelas">Tahun Ajaran</label>
                    <select name="tahunajaran_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan Tahun Ajaran-</option>

                      @foreach($tahun_ajaran as $tahunajaran)
                      <option value="{{$tahunajaran->id}}">{{$tahunajaran->nama_tahun_ajaran}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="kelas">Semester</label>
                    <select name="semester_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan Semester-</option>

                      @foreach($data_semester as $semester)
                      <option value="{{$semester->id}}">{{$semester->nama_semester}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="kelas">Hari</label>
                    <select name="hari_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan hari-</option>

                      @foreach($data_hari as $hari)
                      <option value="{{$hari->id}}">{{$hari->hari}}</option>
                      @endforeach

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kelas">Waktu</label>
                    <select name="waktu_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan waktu-</option>

                      @foreach($data_waktu as $waktu)
                      <option value="{{$waktu->id}}">{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select name="kelas_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan kelas-</option>

                      @foreach($data_kelas as $kelas)
                      <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="kelas">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control select" data-live-search="true" required>
                      <option value="">-Masukan mapel-</option>

                      @foreach($data_mapel as $mapel)
                      <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="keterangan" class="kelas">Keterangan</label>
                    <select name="keterangan" class="form-control select" data-live-search="true" required>
                      <option value="">-Keterangan-</option>
                      <option value="KBM">KBM</option>

                    </select>
                  </div>


                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Buat Jadwal</button>
              </form>
            </div>
          </div>
        </div>
      </div>



      <!-- Edit Jadwal -->
      <div class="modal fade" id="editJadwal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="staticBackdropLabel"></h5>
            </div>
            <div class="modal-body">

              <form action="{{route('admin.tambah.jadwal.pelajaran')}}" id="form-edit" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row push-down-20">


                  <div class="form-group" id="jam_kbm">
                  </div>

                  <div class="form-group" id="mapel">
                  </div>
                  <div class="form-group" id="guru">
                  </div>

                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger" id="deleteJadwal">Delete</button>
              <button type="submit" class="btn btn-primary" id="updateJadwal">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>

@stop

@section('data-scripts')
<script type="text/javascript">
  $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // tampilkan jadwal setelah tombol tampil jadwal di tekan
    $("#tampil-jadwal").click(function() {

      var $this = $(this);
      var kelas_id = $('#get_kelas').val();
      var hari_id = $('#get_hari').val();
      var tahunajaran_id = $('#get_tahun_ajaran').val();
      var semester_id = $('#get_semester').val();

      console.log(kelas_id, tahunajaran_id, semester_id);
      $.post('jadwalpelajaransiswa/ambil', {
        'kelas_id': kelas_id,
        'hari_id': hari_id,
        'tahunajaran_id': tahunajaran_id,
        'semester_id': semester_id,
        '_token': $('input[name=_token]').val()
      }, function(data) {
        console.log(data);

        jadwal_table = $('#jadwal_table').DataTable({
          paging: true,
          searching: true,
          destroy: true,
          processing: true,
          serverSide: true,
          ajax: {
            "url": "{!! url('admin/jadwalpelajaransiswa/ambil') !!}",
            "type": "POST",
            "_token": $('input[name=_token]').val(),
            "data": function(d) {
              d.kelas_id = $('#get_kelas').val();
              d.hari_id = $('#get_hari').val();
              d.tahunajaran_id = $('#get_tahun_ajaran').val();
              d.semester_id = $('#get_semester').val();
            },
          },
          columns: [{
              data: 'waktu',
              name: 'waktu'
            },
            {
              data: 'mapel',
              name: 'mapel'
            },
            {
              data: 'guru',
              name: 'guru'
            }, {
              data: 'type',
              name: 'type',
              render: function(data, type, row, meta) {
                return '<button class="btn btn-sm btn-success" data-name="' + row[0] + '"  >Edit</button>';
                // return 'tipe'+ data;
              }
            }
          ]
        });



      });
    });

    // edit data dalam table jadwal dalam bentuk form modal 
    $('#jadwal_table').on('click', 'tr', function() {
      // data source
      var kelas_id = $('#get_kelas').val();
      var semester_id = $('#get_semester').val();
      var hari_id = $('#get_hari').val();
      var tahun_ajaran_id = $('#get_tahun_ajaran').val();


      // 
      var jam_kbm = $('td', this).eq(0).text();
      var mapel = $('td', this).eq(1).text();
      var guru = $('td', this).eq(2).text();

      console.log('jam_kbm ' + jam_kbm);
      console.log('mapel ' + mapel);
      console.log('guru ' + guru);

      $("#editJadwal .modal-title").html(' <span class="fa fa-edit"></span> Edit Jadwal ' + jam_kbm);

      $("#editJadwal #jam_kbm").html('<label for="kelas">Jam</label>' +
        '<select class="form-control select" name="waktu_id" id="val_jam_kbm" data-live-search="true" required>' +
        '@foreach($data_waktu as $waktu)' +
        '<option value="{{$waktu->id}}" >{{$waktu->jam_masuk}} - {{$waktu->jam_keluar}}</option>' +
        '@endforeach' +
        '</select>');
      $("#editJadwal #mapel").html('<label for="kelas">Mata Pelajaran</label>' +
        '<select class="form-control select" name="mapel_id" id="val_mapel" data-live-search="true" required>' +
        '@foreach($data_mapel as $mapel)' +
        '<option value="{{$mapel->id}}" {{ ($mapel->nama_mapel == ' + mapel + ') ? select : "" }} >{{$mapel->nama_mapel}}</option>' +
        '@endforeach' +
        '</select>');

      $("#editJadwal #guru").html('<label for="kelas">Guru</label>' +
        '<select class="form-control select" name="guru_id" id="val_guru" data-live-search="true" required>' +
        '@foreach($data_guru as $guru)' +
        '<option value="{{$guru->id}}" >{{$guru->nama_lengkap}} ({{$guru->mapel->nama_mapel ?? ""}})</option>' +
        '@endforeach' +
        '</select>');

      $("#editJadwal #val_jam_kbm").val(jam_kbm);
      $("#editJadwal #val_mapel").val(mapel);
      $("#editJadwal #val_guru").val(guru);

      // action form post
      var url = '{{route("admin.jadwal.update",[":tahun_ajaran_id",":semester_id",":kelas_id",":hari_id"])}}';
      url = url.replace(':tahun_ajaran_id', tahun_ajaran_id);
      url = url.replace(':hari_id', hari_id);
      url = url.replace(':semester_id', semester_id);
      url = url.replace(':kelas_id', kelas_id);

      $('#editJadwal').find('#form-edit').attr("action", url);





      $('#editJadwal').modal("show");

      
    });


    $('#deleteJadwal').click(function(){
      alert('delete');
    });

  });


  $(document).ready(function() {
    function checkconnection() {
      var status = navigator.onLine;
      if (status) {
        alert("online");
      } else {
        alert("offline");
      }
    }
  });
</script>
@endsection