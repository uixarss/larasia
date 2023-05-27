@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Evaluasi Soal
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Evaluasi Soal</li>
    </ul>
@endsection

@section('content')
    <form action="#" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-10">
                        <label class="fs-6 form-label fw-bold text-dark">Judul Soal</label>
                        <select class="form-select" data-control="select2" data-hide-search="false" name="id_tugas"
                            id="get_kuis" required>
                            @foreach ($data_kuis as $kuis)
                                <option value="{{ $kuis->id }}">{{ $kuis->prodi->nama_program_studi }} |
                                    {{ $kuis->mapel->nama_mapel }} | {{ $kuis->judul_kuis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <div class="d-grid">
                            <a href="#" id="tampil-kuis" class="btn btn-primary">Tampilkan Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card mt-5 mb-xl-8">
        <div class="card-body pt-10 pb-3">
            <div class="table-responsive">
                <table
                    class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                    id="kuis_table">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-325px rounded-start">Nama Kelas</th>
                            <th class="min-w-200px text-end rounded-end">Opsi</th>
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

            $("#tampil-kuis").click(function() {

                var $this = $(this);

                var kuis_id = $('#get_kuis').val();

                console.log(kuis_id);
                $.post('evaluasisoal/ambil-kelas', {

                    'kuis_id': kuis_id,
                    '_token': $('input[name=_token]').val()
                }, function(data) {
                    var kuis_id = $('#get_kuis').val();
                    console.log(kuis_id);
                    var url = '{{ route('guru.evaluasi.detail', [':kuis_id', ':kelas_id']) }}';


                    kuis_table = $('#kuis_table').DataTable({
                        paging: true,
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            "url": "{!! url('dosen/evaluasisoal/ambil-kelas') !!}",
                            "type": "POST",
                            "_token": $('input[name=_token]').val(),
                            "data": function(d) {

                                d.kuis_id = $('#get_kuis').val();
                            },
                        },
                        columns: [{
                                data: 'kelas',
                                name: 'kelas'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                render: function(data) {
                                    url = url.replace(':kuis_id', kuis_id);
                                    url = url.replace(':kelas_id', data);
                                    return data;
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
