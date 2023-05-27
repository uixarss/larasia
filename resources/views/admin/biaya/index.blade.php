@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Komponen Biaya
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Komponen Biaya</li>
    </ul>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <div class="d-flex align-items-center position-relative me-4">
                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                <input type="text" id="table_search"
                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                    placeholder="Search">
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="min-w-50px">No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Jenis Biaya</th>
                        <th>Nominal</th>
                        <th class="text-end min-w-100px">Opsi</th>
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
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editBiaya{{ $biaya->id }}">Edit</a>
                                <a href="{{ route('admin.biaya.destroy', ['id' => $biaya->id]) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
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
                                        <form action="{{ route('admin.biaya.update', ['id' => $biaya->id]) }}"
                                            method="post">
                                            @csrf

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="nama">Nama Biaya</label>
                                                <input name="nama" type="text" class="form-control"
                                                    value="{{ $biaya->nama }}">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="deskripsi">Deskripsi Biaya</label>
                                                <input name="deskripsi" type="text" class="form-control"
                                                    value="{{ $biaya->deskripsi }}">
                                            </div>
                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="jenisbiaya">Jenis Biaya</label>
                                                <select name="jenis_biaya_id" id="jenis_biaya_id" class="form-control">
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
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.biaya.store') }}" method="post">
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

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            ListData.init();
        });
    </script>
@endsection
