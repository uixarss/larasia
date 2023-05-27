@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Hasil Tugas
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Hasil Tugas</li>
    </ul>
@endsection

@section('content')
    <form action="#" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-5">
                        <label class="fs-6 form-label fw-bold text-dark">Kelas</label>
                        <select class="form-select" data-control="select2" data-hide-search="false" name="id_kelas"
                            id="get_kelas" required>
                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5">
                        <label class="fs-6 form-label fw-bold text-dark">Tugas</label>
                        <select class="form-select" data-control="select2" data-hide-search="false" name="id_tugas"
                            id="get_tugas" required>
                            @foreach ($data_tugas as $tugas)
                                <option value="{{ $tugas->id }}">{{ $tugas->judul_tugas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <div class="d-grid">
                            <a href="#" id="tampil-tugas" class="btn btn-primary">Tampilkan Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card mt-5 mb-xl-8">
        <div class="card-body pt-10 pb-3">
            <div class="table-responsive">
                <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4" id="tugas_table">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-325px rounded-start">Nama Mahasiswa</th>
                            <th>File Tugas</th>
                            <th>Tanggal</th>
                            <th class="min-w-200px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
<script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
  $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#tampil-tugas").click(function() {

      var $this = $(this);
      var kelas_id = $('#get_kelas').val();
      var tugas_id = $('#get_tugas').val();

      console.log(kelas_id, tugas_id);
      $.post('hasiltugas/ambil', {
        'kelas_id': kelas_id,
        'tugas_id': tugas_id,
        '_token': $('input[name=_token]').val()
      }, function(data) {

        tugas_table = $('#tugas_table').DataTable({
          paging: true,
          searching: true,
          destroy: true,
          processing: true,
          serverSide: true,
          ajax: {
            "url": "{!! url('dosen/hasiltugas/ambil') !!}",
            "type": "POST",
            "_token": $('input[name=_token]').val(),
            "data": function(d) {
              d.kelas_id = $('#get_kelas').val();
              d.tugas_id = $('#get_tugas').val();
            },
          },
          columns: [{
              data: 'siswa',
              name: 'siswa'
            }, {
            //   data: 'kelas',
            //   name: 'kelas'
            // },
            // {
              data: 'nama',
              name: 'nama'
            },
            {
              data: 'tanggal',
              name: 'tanggal'
            },
            {
              data: 'action',
              name: 'action',
              render: function(data, type, row, meta){
                url = '{{route("guru.hasiltugas.download",[":hasil_tugas_id"])}}';
                url = url.replace(':hasil_tugas_id', data);
                return '<a href="'+url+'"class="btn btn-sm btn-primary">Download</a>';
              }
            }
          ]
        });



      });
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
