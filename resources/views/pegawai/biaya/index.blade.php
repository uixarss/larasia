@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Data Biaya
                </h1>
            </div>
            @can('create-keuangan')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button class="btn fw-bold btn-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">Tambah</button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 p-3 w-150px"
                        data-kt-menu="true">
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="menu-link px-3">Master
                                Biaya</a>
                        </div>
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahJenisBiaya"
                                class="menu-link px-3">Jenis Biaya</a>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#master" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Master Biaya
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>
                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#jenis" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Jenis Biaya
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="master" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Biaya
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_master"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_master">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Jenis Biaya</th>
                                    <th>Nominal</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_biaya as $key => $biaya)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $biaya->nama }}</td>
                                        <td>{{ $biaya->deskripsi }}</td>
                                        <td>{{ $biaya->jenis->nama }}</td>
                                        <td>Rp {{ number_format($biaya->jumlah) }}</td>
                                        <td>
                                            @can('edit-keuangan')
                                                <a href="#" class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#editBiaya{{ $biaya->id }}">Edit</a>
                                            @endcan
                                            @can('delete-keuangan')
                                                <a href="{{ route('pegawai.biaya.destroy', ['id' => $biaya->id]) }}"
                                                    class="btn btn-sm btn-danger">Hapus</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Modal edit prodi-->
                                    <div class="modal fade" id="editBiaya{{ $biaya->id }}" tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Tambah Jenis Biaya</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('pegawai.biaya.update',['id' => $biaya->id])}}"
                                                        method="post">
                                                        @csrf

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama">Nama Biaya</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                value="{{ $biaya->nama }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="deskripsi">Deskripsi
                                                                Biaya</label>
                                                            <input name="deskripsi" type="text" class="form-control"
                                                                value="{{ $biaya->deskripsi }}">
                                                        </div>
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="jenisbiaya">Jenis Biaya</label>
                                                            <select name="jenis_biaya_id" id="jenis_biaya_id"
                                                                class="form-control">
                                                                @foreach ($data_jenis_biaya as $jenis_biaya)
                                                                    <option value="{{ $jenis_biaya->id }}"
                                                                        {{ $biaya->jenis_biaya_id == $jenis_biaya->id ? 'selected' : '' }}>
                                                                        {{ $jenis_biaya->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="jumlah">Nominal Biaya</label>
                                                            <input name="jumlah" type="number" class="form-control"
                                                                value="{{ $biaya->jumlah }}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal end-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="jenis" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Jenis Biaya
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_jenis"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_jenis">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th>Nama</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_jenis_biaya as $key => $jenis_biaya)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $jenis_biaya->nama }}</td>
                                        <td>
                                            @can('delete-keuangan')
                                                <a href="{{ route('pegawai.hapus.jenisbiaya', ['id' => $jenis_biaya->id]) }}"
                                                    class="btn btn-sm btn-danger">Hapus</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" id="tambahJenisBiaya" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jenis Biaya</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">

                    <form action="{{ route('pegawai.tambah.jenisbiaya') }}" method="post">
                        @csrf

                        <div class="fv-row">
                            <label class="form-label">Nama Jenis Biaya</label>
                            <input name="nama" type="text" class="form-control" placeholder="Contoh : SPP">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('pegawai.biaya.store') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Komponen Biaya</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="nama">Nama Biaya</label>
                        <input name="nama" type="text" class="form-control" placeholder="Contoh : SPP">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="deskripsi">Deskripsi Biaya</label>
                        <input name="deskripsi" type="text" class="form-control" placeholder="....">
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label" for="jenisbiaya">Jenis Biaya</label>
                        <select name="jenis_biaya_id" id="jenis_biaya_id" class="form-control">
                            @foreach ($data_jenis_biaya as $jenis_biaya)
                                <option value="{{ $jenis_biaya->id }}">{{ $jenis_biaya->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="jumlah">Nominal Biaya</label>
                        <input name="jumlah" type="number" class="form-control" placeholder="....">
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
        var DataMaster = function() {
            var table = document.getElementById('table_master');
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
                            targets: 5,
                            className: 'dt-body-right'
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_master');
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

        var DataJenis = function() {
            var table = document.getElementById('table_jenis');
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
                            targets: 2,
                            className: 'dt-body-right'
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_jenis');
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
            DataMaster.init();
            DataJenis.init();
        });
    </script>
@endsection
