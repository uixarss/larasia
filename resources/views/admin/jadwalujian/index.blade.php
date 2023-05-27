@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Jadwal Ujian
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Jadwal Ujian</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Jadwal Ujian</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                    Jadwal</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tahun</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($data_jadwal_ujian as $jadwal_ujian)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $jadwal_ujian->title }}</td>
                            <td>{{ $jadwal_ujian->year }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.jadwalujian.show', ['id' => $jadwal_ujian->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-original-title="Lihat Jadwal Ujian">Detail</a>
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJadwalUjian">Edit</a>
                                <a href="{{ route('admin.jadwalujian.destroy', ['id' => $jadwal_ujian->id]) }}"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin Mau di Hapus ?')"data-toggle="tooltip"
                                    data-placement="bottom" data-original-title="Hapus Jadwal Ujian">Hapus</a>
                            </td>
                        </tr>

                        <!-- MMODAL EDIT JADWAL UJIAN-->
                        <div class="modal fade" id="editJadwalUjian" data-backdrop="static" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Jadwal Ujian</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.jadwalujian.update', ['id' => $jadwal_ujian->id]) }}"
                                            method="post">
                                            @csrf

                                            <div class="row">

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="title">Judul</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="{{ $jadwal_ujian->title }}">
                                                </div>
                                                <div class="fv-row">
                                                    <label class="form-label" for="year">Tahun</label>
                                                    <input type="text" name="year" class="form-control" id="year"
                                                        value="{{ $jadwal_ujian->year }}">
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.jadwalujian.store') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jadwal Ujian</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="title">Judul</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="fv-row">
                        <label class="form-label" for="year">Tahun</label>
                        <input type="text" name="year" class="form-control" id="year">
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
                            targets: 3
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }


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

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            ListData.init();
        });
    </script>
@endsection
