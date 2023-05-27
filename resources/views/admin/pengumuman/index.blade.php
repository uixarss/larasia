@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pengumuman
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Pengumuman</li>
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
        <table id="table_data" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
            <thead>
                <tr class="fw-bold text-muted bg-light">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                    <th class="text-end">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                @foreach ($data_pengumuman as $pengumuman)
                    <?php $no++; ?>
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $pengumuman->judul_pengumuman }}</td>
                        <td>{{ $pengumuman->isi_pengumuman }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d M Y') }}
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editpengumuman{{ $pengumuman->id }}">Edit</a>

                            <a href="{{ route('admin.pengumuman.delete', $pengumuman->id) }}"
                                class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                        </td>
                    </tr>
                    <!-- Modal edit prodi-->
                    <div class="modal fade" id="editpengumuman{{ $pengumuman->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Pengumuman</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-5">
                                            <label class="form-label">Judul</label>
                                            <input name="judul_pengumuman" id="judul_pengumuman" type="text"
                                                class="form-control" value="{{ $pengumuman->judul_pengumuman }}">
                                        </div>

                                        <div class="mb-5">
                                            <label class="form-label">Isi</label>
                                            <input name="isi_pengumuman" id="isi_pengumuman" type="text"
                                                class="form-control" value="{{ $pengumuman->isi_pengumuman }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Tanggal</label>
                                            <input name="tanggal_pengumuman" id="tanggal_pengumuman" type="date"
                                                class="form-control" value="{{ $pengumuman->tanggal_pengumuman }}">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
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
            <form class="modal-content" action="{{ route('admin.pengumuman.add') }}" method="post"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pengumuman</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="mb-5">
                        <label class="form-label">Judul</label>
                        <input name="judul_pengumuman" id="judul_pengumuman" type="text" class="form-control"
                            required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Isi</label>
                        <input name="isi_pengumuman" id="isi_pengumuman" type="text" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal</label>
                        <input name="tanggal_pengumuman" id="tanggal_pengumuman" type="date" class="form-control"
                            required>
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
                            targets: 4
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
