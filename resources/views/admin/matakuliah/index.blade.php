@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Mata Kuliah
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Mata Kuliah</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Jenis Mata Kuliah</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                <button type="button" class="btn btn-icon btn-success me-2" data-bs-toggle="modal"
                    data-bs-target="#import"><i class="bi bi-cloud-arrow-up-fill"></i></button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                    Matkul</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Tipe Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Jumlah Jam</th>
                        <th>Keterangan</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    <?php
                    $no = 1;
                    ?>
                    @foreach ($data_mapel as $mapel)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $mapel->kode_mapel }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td>{{ $mapel->type ?? '' }}</td>
                            <td>{{ $mapel->jumlah_sks }}</td>
                            <td>{{ $mapel->jumlah_jam }}</td>
                            <td>{{ $mapel->keterangan ?? '' }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editMapel{{ $mapel->id }}">Edit</a>
                                <a href="{{ route('admin.matakuliah.destroy', ['id' => $mapel->id]) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            </td>
                        </tr>

                        <!-- MMODAL EDIT MATA PELAJARAN-->
                        <div class="modal fade" id="editMapel{{ $mapel->id }}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Mata Kuliah</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.matakuliah.update', $mapel->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="exampleInputEmail1">Kode Mapel</label>
                                                <input name="kode_mapel" type="text" class="form-control"
                                                    value="{{ $mapel->kode_mapel }}"
                                                    placeholder="Masukan Kode Mata Kuliah">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="exampleInputEmail1">Nama Mapel</label>
                                                <input name="nama_mapel" type="texts" class="form-control"
                                                    value="{{ $mapel->nama_mapel }}" placeholder="Masukan Mata Kuliah">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="exampleInputEmail1">Tipe</label>
                                                <input name="type" type="text" class="form-control"
                                                    value="{{ $mapel->type }}" required>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jumlah SKS</label>
                                                <input name="jumlah_sks" type="number" class="form-control"
                                                    value="{{ $mapel->jumlah_sks }}" placeholder="Masukan Jumlah SKS">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jumlah Jam</label>
                                                <input name="jumlah_jam" type="number" class="form-control"
                                                    value="{{ $mapel->jumlah_jam }}" placeholder="Masukan Jumlah Jam">
                                            </div>

                                            <div class="fv-row">
                                                <label class="form-label">Keterangan</label>
                                                <textarea name="keterangan" type="text" class="form-control">{{ $mapel->keterangan }}</textarea>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
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
            <form class="modal-content" action="{{ route('admin.matakuliah.create') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Matkul</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Kode Mata Kuliah</label>
                        <input name="kode_mapel" type="text" class="form-control" placeholder="Masukan Mata Kuliah">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Nama Mata Kuliah</label>
                        <input name="nama_mapel" type="texts" class="form-control" placeholder="Masukan Mata Kuliah">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Tipe</label>
                        <input name="type" type="text" class="form-control"
                            placeholder="Contoh : Teori / Praktikum" required>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="jumlah_sks">Jumlah SKS</label>
                        <input name="jumlah_sks" type="number" class="form-control" placeholder="Masukan Jumlah SKS">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="jumlah_jam">Jumlah Jam</label>
                        <input name="jumlah_jam" type="number" class="form-control" placeholder="Masukan Jumlah Jam">
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" type="text" class="form-control"></textarea>
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

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="import">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.matakuliah.import') }}" method="POST"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Import Matkul</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row">
                        <label class="form-label">File excel</label>
                        <input type="file" name="file" class="form-control" required="required">
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
                            targets: 7
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
