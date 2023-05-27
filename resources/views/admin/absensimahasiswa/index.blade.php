@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Absensi Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="/admin/absensi/prodi" class="text-muted text-hover-primary">Pilih Prodi</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Absensi Mahasiswa</li>
    </ul>
@endsection

@section('content')


    <div class="card">
        <div class="card-header border-0">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#harian">Absensi Harian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-active-primary py-5" data-bs-toggle="tab" href="#laporan">Laporan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade" id="harian" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="d-flex flex-column justify-content-center flex-wrap mb-0">
                            <span class="card-label fw-bold fs-3 mb-2">Absensi Hari Ini</span>
                            <span class="text-muted fw-semibold fs-7">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</span>
                        </h3>

                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                    </div>
                    <table id="table_data"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>NIM Mahasiswa</th>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Pertemuan Ke</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($absensi_mahasiswa as $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswa->mahasiswa->nim ?? '' }}</td>
                                <td>{{ $mahasiswa->mahasiswa->nama_mahasiswa }}</td>
                                <td>{{ $mahasiswa->mapel->nama_mapel }}</td>
                                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                                <td>{{ $mahasiswa->pertemuan_ke }}</td>
                                <td>{{ $mahasiswa->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show active" id="laporan" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="d-flex flex-column justify-content-center flex-wrap mb-0">
                            <span class="card-label fw-bold fs-3 mb-2">Laporan Absensi</span>
                            <span class="text-muted fw-semibold fs-7">{{ \Carbon\Carbon::parse($tanggal_absen)->format('d M Y') }}</span>
                        </h3>

                        <div class="d-flex align-items-center">
                                <a href="{{ route('admin.absensi.mahasiswa.laporan', ['tanggal_absen' => $tanggal_absen, 'id_prodi' => $id_prodi]) }}" class="btn btn-sm btn-success btn-icon">
                                    <span class="fa fa-cloud-download"></span>
                                </a>
                                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <form action="{{ route('admin.absensi.mahasiswa.cari', ['id_prodi' => $id_prodi]) }}" method="POST" class="d-flex my-2">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <input type="date" name="tanggal_absen" class="form-control" value="{{ $tanggal_absen }}" />
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-search"></i>Rekap</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <table id="table_rekap"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>NIM Mahasiswa</th>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Pertemuan Ke</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($absensi_mahasiswa_tanggal as $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswa->mahasiswa->nim ?? '' }}</td>
                                <td>{{ $mahasiswa->mahasiswa->nama_mahasiswa }}</td>
                                <td>{{ $mahasiswa->mapel->nama_mapel }}</td>
                                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                                <td>{{ $mahasiswa->pertemuan_ke }}</td>
                                <td>{{ $mahasiswa->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ListData = function() {
            var table = document.getElementById('table_data');
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
                            targets: 5
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search');
                filterSearch.addEventListener('keyup', function(e) {
                    datatable.search(e.target.value).draw();
                });
            }

            return {
                // Public functions
                init: function() {
                    if (!table) {
                        return;
                    }

                    initDataTable();
                    handleSearchDatatable();

                }
            }
        }();

        var ListRekap = function() {
            var table = document.getElementById('table_rekap');
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
            ListData.init();
            ListRekap.init();
        });
    </script>
@endsection
