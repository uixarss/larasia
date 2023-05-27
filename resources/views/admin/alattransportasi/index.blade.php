@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Alat Transportasi
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Alat Transportasi</li>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahpengumuman">Tambah Transporasi</button>
            </div>
        </div>
        <div class="card-body">
            <table id="table_data" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th>No</th>
                        <th>Nama</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transportasi as $key => $transport)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $transport->alat_transportasi }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editTransportasi{{ $transport->id }}">Edit</a>
                                <a href="{{ route('admin.transportasi.destroy', $transport->id) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            </td>
                        </tr>
                        <!-- Modal edit prodi-->
                        <div class="modal fade" id="editTransportasi{{ $transport->id }}" data-backdrop="static"
                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Transporasi</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.transportasi.update', $transport->id) }}"
                                            method="post">
                                            @csrf

                                            <div class="fv-row">
                                                <label class="form-label">Nama</label>
                                                <input name="alat_transportasi" type="text" class="form-control"
                                                    value="{{ $transport->alat_transportasi }}">
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
    <div class="modal fade" tabindex="-1" id="tambahpengumuman">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.transportasi.create') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Transporasi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row">
                        <label class="form-label">Nama</label>
                        <input name="alat_transportasi" type="text" class="form-control">
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
                            targets: 2
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
