@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pangkat/Golongan
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Pangkat/Golongan</li>
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
                data-bs-target="#tambahpengumuman">Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <table id="table_data" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
            <thead>
                <tr class="fw-bold text-muted bg-light">
                    <th>No</th>
                    <th>Jabatan</th>
                    <th>Pangkat</th>
                    <th>Golongan</th>
                    <th>Angka Kredit</th>
                    <th class="text-end">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pangkat_golongan as $key => $panggol)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $panggol->jabatan }}</td>
                    <td>{{ $panggol->pangkat }}</td>
                    <td>{{ $panggol->golongan }}</td>
                    <td>{{ $panggol->angka_kredit }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editPangkat{{ $panggol->id }}">Edit</a>
                        <a href="{{ route('admin.pangkatgolongan.destroy', $panggol->id) }}"
                            class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    </td>
                </tr>
                <!-- Modal edit prodi-->
                <div class="modal fade" id="editPangkat{{ $panggol->id }}" data-backdrop="static" tabindex="-1"
                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Pangkat/Golongan</h3>
                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="bi bi-x-lg fs-3"></i>
                                </div>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('admin.pangkatgolongan.update', $panggol->id) }}"
                                    method="post">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Jabatan</label>
                                        <input name="jabatan" type="text" class="form-control"
                                            value="{{ $panggol->jabatan }}">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pangkat</label>
                                        <input name="pangkat" type="text" class="form-control"
                                            value="{{ $panggol->pangkat }}">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Golongan</label>
                                        <input name="golongan" type="text" class="form-control"
                                            value="{{ $panggol->golongan }}">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Angka Kredit</label>
                                        <input name="angka_kredit" type="number" class="form-control"
                                            value="{{ $panggol->angka_kredit }}">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
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
    <div class="modal fade" tabindex="-1" id="tambahpengumuman">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.pangkatgolongan.create') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pangkat/Golongan</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Jabatan</label>
                        <input name="jabatan" type="text" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Pangkat</label>
                        <input name="pangkat" type="text" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Golongan</label>
                        <input name="golongan" type="text" class="form-control">
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Angka Kredit</label>
                        <input name="angka_kredit" type="number" class="form-control">
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
        });
    </script>
@endsection
