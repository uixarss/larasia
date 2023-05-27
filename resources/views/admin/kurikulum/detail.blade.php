@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Kurikulum
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="/admin/kurikulum" class="text-muted text-hover-primary">Kurikulum</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail</li>
    </ul>
@endsection

@section('content')
    <div class="card card-flush pb-0 mb-10">
        <div class="card-body pt-10">
            <div class="d-flex align-items-center">
                <div class="d-flex flex-column">
                    <h2 class="mb-2">Kurikulum {{ $kurikulum->nama_kurikulum }}</h2>
                    <div class="text-muted fw-bold">
                        <span>Tahun Ajar: <span class="text-primary">{{ $kurikulum->tahun->nama_tahun_ajaran }} /
                                {{ $kurikulum->semester->nama_semester }}</span></span>
                        <span class="mx-3 text-gray-300">|</span>
                        <span>Prodi: <span class="text-primary">{{ $kurikulum->fakultas->nama_fakultas }} /
                                {{ $kurikulum->jurusan->nama_jurusan }} /
                                {{ $kurikulum->prodi->nama_program_studi }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap flex-stack mb-5">
        <div class="d-flex align-items-center position-relative me-4">
            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
            <input type="text" id="table_search"
                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                placeholder="Search">
        </div>

        <div class="d-flex my-2 gap-2">
            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                data-bs-target="#tambah">Tambah</button>
        </div>
    </div>
    <table id="table_data"
        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
        <thead class="fs-5 fw-semibold bg-light">
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Mata Kuliah</th>
                <th class="text-end">Opsi</th>
            </tr>
        </thead>
        <tbody class="fs-6 fw-semibold text-gray-600">
            @foreach ($kurikulum_detail as $no => $detail)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $detail->dosen->nama_dosen }}</td>
                    <td>{{ $detail->mapel->nama_mapel }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editKurikulum{{ $detail->id }}">Edit</a>
                        <a href="{{ route('admin.kurikulum.detail.destroy', $detail->id) }}" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                </tr>
                <!-- Modal edit-->
                <div class="modal fade" id="editKurikulum{{ $detail->id }}" data-backdrop="static" tabindex="-1"
                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Kurikulum
                                    {{ $kurikulum->nama_kurikulum }} </h3>
                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-lg fs-3"></i>
                                </div>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('admin.kurikulum.detail.update', $detail->id) }}" method="post">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Kurikulum</label>
                                        <input name="nama_kurikulum" type="text" class="form-control"
                                            value="{{ $kurikulum->nama_kurikulum }}" placeholder="Nama Kurikulum" disabled>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Dosen</label>
                                        <select name="dosen_id" id="id_fakultas" class="form-control">
                                            @foreach ($data_dosen as $dosen)
                                                <option value="{{ $dosen->id }}"
                                                    {{ $dosen->id == $detail->dosen_id ? 'selected' : '' }}>
                                                    {{ $dosen->nama_dosen }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Mata Kuliah</label>
                                        <select name="mapel_id" id="mapel_id" class="form-control">
                                            @foreach ($data_mapel as $mapel)
                                                <option value="{{ $mapel->id }}"
                                                    {{ $mapel->id == $detail->mapel_id ? 'selected' : '' }}>
                                                    {{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.kurikulum.detail.add', ['id' => $kurikulum->id]) }}"
                method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Kurikulum</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Kurikulum</label>
                        <input name="nama_kurikulum" type="text" class="form-control"
                            value="{{ $kurikulum->nama_kurikulum }}" disabled>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Dosen</label>
                        <select name="dosen_id" id="id_fakultas" class="form-control">
                            @foreach ($data_dosen as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mapel_id" id="mapel_id" class="form-control">
                            @foreach ($data_mapel as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
                            targets: 3
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
