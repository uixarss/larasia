@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-5 g-xl-10 mb-xl-10">
        <div class="col-lg-12 col-xl-12 col-xxl-7 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Jadwal Hari Ini</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">{{ now()->format('l, d M Y') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="{{ route('siswa.jadwalpelajaran.index') }}" class="btn btn-sm btn-light">Lainnya</a>
                    </div>
                </div>

                <!--begin::Body-->
                <div class="card-body pt-7 px-0">
                    <div class="mb-2 px-9">
                        @if (isset($data_jadwal))
                            @foreach ($data_jadwal as $jadwal)
                                <div class="d-flex align-items-center mb-6">
                                    <span data-kt-element="bullet"
                                        class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                    <div class="flex-grow-1 me-5">
                                        <div class="text-gray-800 fw-semibold fs-2">{{ $jadwal->waktu->jam_masuk ?? '' }}
                                            -
                                            {{ $jadwal->waktu->jam_keluar ?? '' }}</div>
                                        <div class="text-gray-700 fw-semibold fs-6">{{ $jadwal->mapel->nama_mapel ?? '' }}
                                        </div>
                                        <div class="text-gray-400 fw-semibold fs-7">Kelas: <span
                                                class="text-primary opacity-75-hover fw-semibold">{{ $jadwal->kelas->nama_kelas ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <form action="{{ route('guru.absen.masuk') }}" method="post">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $jadwal->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $jadwal->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi" value="{{ $jadwal->prodi_id ?? '1' }}"
                                                hidden>
                                            <input type="text" name="mapel_id" value="{{ $jadwal->mapel_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="kelas_id" value="{{ $jadwal->kelas_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="waktu_id" value="{{ $jadwal->waktu_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="hari_id" value="{{ $jadwal->hari_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="ruangan_id" value="{{ $jadwal->ruangan_id ?? '' }}"
                                                hidden>

                                            <button type="submit" class="btn btn-sm btn-info">Masuk</button>
                                        </form>
                                        <form action="{{ route('guru.absen.keluar') }} " method="post">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $jadwal->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $jadwal->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi" value="{{ $jadwal->prodi_id ?? '1' }}"
                                                hidden>
                                            <input type="text" name="mapel_id" value="{{ $jadwal->mapel_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="kelas_id" value="{{ $jadwal->kelas_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="waktu_id" value="{{ $jadwal->waktu_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="hari_id" value="{{ $jadwal->hari_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="ruangan_id" value="{{ $jadwal->ruangan_id ?? '' }}"
                                                hidden>

                                            <button type="submit" class="btn btn-sm btn-danger">Selesai</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 col-xxl-5 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Kalender Akademik</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="{{ route('siswa.kalenderakademik.index') }}" class="btn btn-sm btn-light">Lainnya</a>
                    </div>
                </div>


                <div class="card-body pt-7 px-0">
                    <div class="mb-2 px-9">
                        @foreach ($events as $event)
                            <div class="d-flex align-items-center mb-6">
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4"
                                    style="background-color: {{ $event->color }}"></span>
                                <div class="flex-grow-1 me-5">
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $event->title }}</a>
                                        <span class="text-gray-400 fw-bold">{{ $event->start }} -
                                            {{ $event->end }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-gray-800">
                                            {{ $event->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="pagination">
                        {{ $events->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Pengumuman</span>
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table
                    class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                    id="table_pengumuman">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="rounded-start">No</th>
                            <th>Judul</th>
                            <th>Pengumuman</th>
                            <th>Mata Kuliah</th>
                            <th class="rounded-end">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (count($data_jadwal_pengganti_hari_ini) > 0)
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Jadwal Pengganti</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">{{ now()->format('l, d M Y') }}</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_pengganti">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-325px rounded-start">Waktu</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Keterangan</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_jadwal_pengganti_hari_ini as $jadwal_pengganti)
                                <tr>
                                    <td>{{ $jadwal_pengganti->waktu->jam_masuk ?? '' }} -
                                        {{ $jadwal_pengganti->waktu->jam_keluar ?? '' }}</td>
                                    <td>{{ $jadwal_pengganti->mapel->nama_mapel ?? '' }}</td>
                                    <td>{{ $jadwal_pengganti->dosen->nama_dosen ?? '' }}</td>
                                    <td>Pengganti</td>
                                    <td>
                                        <form action="{{ route('siswa.absen.pengganti.masuk') }}" method="post"
                                            id="pengganti_masuk">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $jadwal_pengganti->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $jadwal_pengganti->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi"
                                                value="{{ $jadwal_pengganti->prodi_id ?? '1' }}" hidden>
                                            <input type="text" name="mapel_id"
                                                value="{{ $jadwal_pengganti->mapel_id ?? '' }}" hidden>
                                            <input type="text" name="id_dosen"
                                                value="{{ $jadwal_pengganti->id_dosen ?? '' }}" hidden>

                                            <input type="text" name="kelas_id"
                                                value="{{ $jadwal_pengganti->kelas_id ?? '' }}" hidden>
                                            <input type="text" name="waktu_id"
                                                value="{{ $jadwal_pengganti->waktu_id ?? '' }}" hidden>
                                            <input type="text" name="hari_id"
                                                value="{{ $jadwal_pengganti->hari_id ?? '' }}" hidden>
                                            <input type="text" name="pertemuan_ke"
                                                value="{{ $jadwal_pengganti->pertemuan_ke ?? '' }}" hidden>

                                            <button type="submit" class="btn btn-info">Masuk Kelas</button>

                                        </form>
                                        <form action="{{ route('siswa.absen.pengganti.keluar') }}" method="post"
                                            id="pengganti_keluar">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $jadwal_pengganti->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $jadwal_pengganti->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi"
                                                value="{{ $jadwal_pengganti->prodi_id ?? '1' }}" hidden>
                                            <input type="text" name="mapel_id"
                                                value="{{ $jadwal_pengganti->mapel_id ?? '' }}" hidden>
                                            <input type="text" name="id_dosen"
                                                value="{{ $jadwal_pengganti->id_dosen ?? '' }}" hidden>
                                            <input type="text" name="kelas_id"
                                                value="{{ $jadwal_pengganti->kelas_id ?? '' }}" hidden>
                                            <input type="text" name="waktu_id"
                                                value="{{ $jadwal_pengganti->waktu_id ?? '' }}" hidden>
                                            <input type="text" name="hari_id"
                                                value="{{ $jadwal_pengganti->hari_id ?? '' }}" hidden>
                                            <input type="text" name="pertemuan_ke"
                                                value="{{ $jadwal_pengganti->pertemuan_ke ?? '' }}" hidden>

                                            <button type="submit" class="btn btn-danger">Selesai Kelas</button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if (count($data_sp) > 0)
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Jadwal SP</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">{{ now()->format('l, d M Y') }}</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_sp">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-325px rounded-start">Waktu</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_sp as $sp)
                                <tr>
                                    <td>{{ $sp->waktu->jam_masuk }} - {{ $sp->waktu->jam_keluar }}</td>
                                    <td>{{ $sp->mapel->nama_mapel ?? '' }}</td>
                                    <td>{{ $sp->dosen->nama_dosen ?? '' }}</td>
                                    <td>
                                        <form action="{{ route('siswa.absensp.masuk') }}" method="post">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $sp->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $sp->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi" value="{{ $sp->prodi_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="mapel_id" value="{{ $sp->mapel_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="id_dosen" value="{{ $sp->id_dosen ?? '' }}"
                                                hidden>
                                            <input type="text" name="kelas_id" value="{{ $sp->kelas_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="waktu_id" value="{{ $sp->waktu_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="hari_id" value="{{ $sp->hari_id ?? '' }}"
                                                hidden>
                                            <input type="number" name="pertemuan_ke" value="1" hidden>
                                            <button type="submit" class="btn btn-info">Masuk Kelas</button>
                                        </form>
                                        <form action="{{ route('siswa.absensp.keluar') }}" method="post">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $sp->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $sp->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi" value="{{ $sp->prodi_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="mapel_id" value="{{ $sp->mapel_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="id_dosen" value="{{ $sp->id_dosen ?? '' }}"
                                                hidden>
                                            <input type="text" name="kelas_id" value="{{ $sp->kelas_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="waktu_id" value="{{ $sp->waktu_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="hari_id" value="{{ $sp->hari_id ?? '' }}"
                                                hidden>
                                            <input type="number" name="pertemuan_ke" value="1" hidden>
                                            <button type="submit" class="btn btn-danger">Selesai Kelas</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        @if (count($data_sp) > 0)
            var TableSP = function() {
                var table = document.getElementById('table_sp');
                var datatable;
                var toolbarBase;

                // Private functions
                var initDataTable = function() {
                    // Set date data order
                    const tableRows = table.querySelectorAll('tbody tr');

                    // Init datatable --- more info on datatables: https://datatables.net/manual/
                    datatable = $(table).DataTable({
                        'order': [],
                        "pageLength": 10,
                        "lengthChange": true,
                        "info": true,
                        'columnDefs': [{
                                orderable: false,
                                targets: 3
                            }, // Disable ordering on column 6 (actions)
                        ]
                    });
                }


                return {
                    // Public functions
                    init: function() {
                        if (!table) {
                            return;
                        }

                        initDataTable();

                    }
                }
            }();
        @endif
        @if (count($data_jadwal_pengganti_hari_ini) > 0)
            var TablePengganti = function() {
                var table = document.getElementById('table_pengganti');
                var datatable;
                var toolbarBase;

                // Private functions
                var initDataTable = function() {
                    // Set date data order
                    const tableRows = table.querySelectorAll('tbody tr');

                    // Init datatable --- more info on datatables: https://datatables.net/manual/
                    datatable = $(table).DataTable({
                        'order': [],
                        "pageLength": 10,
                        "lengthChange": true,
                        "info": true,
                        'columnDefs': [{
                                orderable: false,
                                targets: 4
                            }, // Disable ordering on column 6 (actions)
                        ]
                    });
                }


                return {
                    // Public functions
                    init: function() {
                        if (!table) {
                            return;
                        }

                        initDataTable();
                    }
                }
            }();
        @endif

        @if ((count($data_sp) > 0) | (count($data_jadwal_pengganti_hari_ini) > 0))
            // On document ready
            KTUtil.onDOMContentLoaded(function() {
                @if (count($data_sp) > 0)
                    TableSP.init();
                @endif
                @if (count($data_jadwal_pengganti_hari_ini) > 0)
                    TablePengganti.init();
                @endif
            });
        @endif
    </script>
    <script>
        var LoadPage = function() {
            var arrows;
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }

            var initTable1 = function() {

                $('#btn-clear').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search').click(function() {
                    $('#table_list').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_pengumuman').DataTable({
                    responsive: true,
                    bDestroy: true,
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    ordering: false,

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/student/get_data_pengumuman') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'judul'
                        },
                        {
                            data: 'isi'
                        },
                        {
                            data: 'mapel'
                        },
                        {
                            data: 'kelas'
                        },

                    ],
                });

            };


            return {

                //main function to initiate the module
                init: function() {
                    initTable1();

                }
            };
        }();

        jQuery(document).ready(function() {
            LoadPage.init();
        });
    </script>
@endsection
