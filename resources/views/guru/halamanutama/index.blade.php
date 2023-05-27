@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Halaman Utama
    </h1>
@endsection

@section('content')
    <div class="row g-5 g-xl-10 mb-xl-10">
        <div class="col-lg-12 col-xl-12 col-xxl-8 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Jadwal Hari Ini</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">{{ now()->format('l, d M Y') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="{{ route('guru.jadwalkelas.index') }}" class="btn btn-sm btn-light">Lainnya</a>
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
                                        <div class="text-gray-800 fw-semibold fs-2">{{ $jadwal->waktu->jam_masuk ?? '' }} -
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
        <div class="col-lg-12 col-xl-12 col-xxl-4 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Pengumuman</span>
                    </h3>
                </div>

                <div class="card-body pt-7 px-0">
                    <div class="mb-2 px-9">
                        @foreach ($data_pengumuman as $pengumuman)
                            <div class="d-flex align-items-center mb-6">
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <div class="flex-grow-1 me-5">
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $pengumuman->judul_pengumuman }}</a>
                                        <span class="text-gray-400 fw-bold">{{ $pengumuman->tanggal_pengumuman }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-gray-800">
                                            {!! $pengumuman->isi_pengumuman !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="pagination">
                        {{ $data_pengumuman->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>


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
                                <th>Keterangan</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_sp as $sp)
                                <tr>
                                    <td>{{ $sp->waktu->jam_masuk ?? '' }} - {{ $sp->waktu->jam_keluar ?? '' }}</td>

                                    <td>{{ $sp->mapel->nama_mapel ?? '' }}</td>
                                    <td></td>
                                    <td>
                                        <form action="{{ route('guru.absensp.masuk') }}" method="post">
                                            @csrf
                                            <input type="text" name="id_tahun_ajaran"
                                                value="{{ $sp->tahun_ajaran_id ?? '' }}" hidden>
                                            <input type="text" name="id_semester"
                                                value="{{ $sp->semester_id ?? '' }}" hidden>
                                            <input type="text" name="id_prodi" value="{{ $sp->prodi_id ?? '1' }}"
                                                hidden>
                                            <input type="text" name="mapel_id" value="{{ $sp->mapel_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="kelas_id" value="{{ $sp->kelas_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="waktu_id" value="{{ $sp->waktu_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="hari_id" value="{{ $sp->hari_id ?? '' }}"
                                                hidden>
                                            <input type="text" name="ruangan_id" value="{{ $sp->ruangan_id ?? '' }}"
                                                hidden>

                                            <button type="submit" class="btn btn-info">Masuk Kelas</button>

                                        </form>
                                        <form action="{{ route('guru.absensp.keluar') }} " method="post">
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
                                            <input type="text" name="ruangan_id"
                                                value="{{ $jadwal->ruangan_id ?? '' }}" hidden>

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
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Keterangan</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_jadwal_pengganti_hari_ini as $jadwal_pengganti)
                                <tr>
                                    <td>{{ $jadwal_pengganti->waktu->jam_masuk ?? '' }} -
                                        {{ $jadwal_pengganti->waktu->jam_keluar ?? '' }}</td>
                                    <td>{{ $jadwal_pengganti->kelas->nama_kelas ?? '' }}</td>
                                    <td>{{ $jadwal_pengganti->mapel->nama_mapel ?? '' }}</td>
                                    <td>Pengganti</td>
                                    <td>
                                        <form action="{{ route('guru.absen.pengganti.masuk') }}" method="post"
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
                                        <form action="{{ route('guru.absen.pengganti.keluar') }}" method="post"
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

    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Pengajuan Jadwal Pengganti</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Buat
                    Pengajuan</a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table
                    class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                    id="table_pengajuan">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="rounded-start">Tanggal</th>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th>
                            <th>Alasan</th>
                            <th class="min-w-200px text-end rounded-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_jadwal_pengganti as $jadwal_pengganti)
                            <tr>
                                <td>{{ $jadwal_pengganti->tanggal_pengganti }}</td>
                                <td>{{ $jadwal_pengganti->waktu->jam_masuk ?? '' }} -
                                    {{ $jadwal_pengganti->waktu->jam_keluar ?? '' }}</td>
                                <td>{{ $jadwal_pengganti->kelas->nama_kelas ?? '' }}</td>
                                <td>{{ $jadwal_pengganti->mapel->nama_mapel ?? '' }}</td>
                                <td>{{ $jadwal_pengganti->keterangan }}</td>
                                <td class="text-end">{{ $jadwal_pengganti->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('guru.pengajuan.jadwal' )}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Pengajuan Jadwal Pengganti</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="tanggal_pengganti">Tanggal Pengganti</label>
                        <input type="date" class="form-control date" name="tanggal_pengganti"
                            placeholder="Pilih tanggal pengganti">
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="kelas_id">Kelas</label>
                        <select name="kelas_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="kelas_id">Ruangan</label>
                        <select name="ruangan_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_ruangan as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="mapel_id">Mata Kuliah</label>
                        <select name="mapel_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_pengampu as $pengampu)
                                <option value="{{ $pengampu->mapel_id }}">{{ $pengampu->mapel->nama_mapel }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="hari_id">Hari</label>
                        <select name="hari_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_hari as $hari)
                                <option value="{{ $hari->id }}">{{ $hari->hari }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="waktu_id">Waktu</label>
                        <select name="waktu_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_waktu as $waktu)
                                <option value="{{ $waktu->id }}">{{ $waktu->jam_masuk }} -
                                    {{ $waktu->jam_keluar }}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="pertemuan_ke">Pertemuan Ke</label>
                        <input type="number" class="form-control date" name="pertemuan_ke"
                            placeholder="Pengganti pertemuan ke berapa?" required>
                    </div>
                    <div class="fv-row">
                        <label class="form-label" for="keterangan">Alasan Mengganti Jadwal</label>
                        <input type="text" class="form-control date" name="keterangan"
                            placeholder="Tulis alasan Anda..." required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Modal Tambah-->
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
        @if (count($data_jadwal_pengganti) > 0)
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
        var TablePengajuan = function() {
            var table = document.getElementById('table_pengajuan');
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

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            @if (count($data_sp) > 0)
                TableSP.init();
            @endif
            @if (count($data_jadwal_pengganti) > 0)
                TablePengganti.init();
            @endif
            TablePengajuan.init();
        });
    </script>
@endsection
