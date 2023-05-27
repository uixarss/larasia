@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Program Studi
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Program Studi</li>
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
                        <th class="min-w-200px">Nama Jurusan</th>
                        <th class="min-w-100px">Kode Prodi</th>
                        <th class="min-w-150px">Nama Prodi</th>
                        <th class="min-w-10px">Status</th>
                        <th class="min-w-80px">Jenjang</th>
                        <th class="text-end min-w-100px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($prodi as $prodi)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $prodi->nama_jurusan }}</td>
                            <td>{{ $prodi->kode_program_studi }}</td>
                            <td>{{ $prodi->nama_program_studi }}</td>
                            <td>{{ $prodi->status }}</td>
                            <td>{{ $prodi->nama_jenjang_pendidikan }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.prodi.visi.index', $prodi->id) }}" class="btn btn-sm btn-info">Visi & Misi</a>
                                <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editProdi{{ $prodi->id_prodi }}"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('admin.prodi.destroy', $prodi->id_prodi) }}" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Modal edit prodi-->
                        <div class="modal fade" id="editProdi{{ $prodi->id_prodi }}" tabindex="-1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Prodi</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.prodi.update', $prodi->id_prodi) }}" method="post">
                                            @csrf

                                            <div class="mb-5">
                                                <label class="form-label">Jurusan</label>
                                                <select name="id_jurusan" class="form-control">
                                                    @foreach ($jurusan as $jur)
                                                        <option value="{{ $jur->id }}"
                                                            {{ $jur->id == $prodi->id_jurusan ? 'selected' : '' }}>
                                                            {{ $jur->nama_jurusan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-5">
                                                <label class="form-label">Kode Prodi</label>
                                                <input name="kode_program_studi" type="text" class="form-control"
                                                    value="{{ $prodi->kode_program_studi }}">
                                            </div>

                                            <div class="mb-5">
                                                <label class="form-label">Nama Prodi</label>
                                                <input name="nama_program_studi" type="text" class="form-control"
                                                    value="{{ $prodi->nama_program_studi }}">
                                            </div>

                                            <div class="mb-5">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="A"
                                                        @if ($prodi->status == 'A') selected @endif>A</option>
                                                    <option value="B"
                                                        @if ($prodi->status == 'B') selected @endif>B</option>
                                                    <option value="C"
                                                        @if ($prodi->status == 'C') selected @endif>C</option>
                                                    <option value="D"
                                                        @if ($prodi->status == 'D') selected @endif>D</option>
                                                    <option value="Belum Terakreditasi"
                                                        @if ($prodi->status == 'Belum Terakreditasi') selected @endif>Belum
                                                        Terakreditasi</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Jenjang Pendidikan</label>
                                                <select name="nama_jenjang_pendidikan" class="form-control">
                                                    @foreach ($jenjang as $jen)
                                                        <option value="{{ $jen->nama_jenjang }},{{ $jen->id }}"
                                                            {{ $jen->id == $prodi->id_jenjang_pendidikan ? 'selected' : '' }}>
                                                            {{ $jen->nama_jenjang }}</option>
                                                    @endforeach
                                                </select>
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
            <form class="modal-content" action="{{ route('admin.prodi.create') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Prodi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="mb-5">
                        <label class="form-label">Jurusan</label>
                        <select name="id_jurusan" class="form-control">
                            @foreach ($jurusan as $jur)
                                <option value="{{ $jur->id }}">{{ $jur->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Kode Prodi</label>
                        <input name="kode_program_studi" type="text" class="form-control">
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Nama Prodi</label>
                        <input name="nama_program_studi" type="text" class="form-control">
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="Belum Terakreditasi">Belum Terakreditasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenjang Pendidikan</label>
                        <select name="nama_jenjang_pendidikan" class="form-control">
                            @foreach ($jenjang as $jen)
                                <option value="{{ $jen->nama_jenjang }},{{ $jen->id }}">{{ $jen->nama_jenjang }}
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
                            targets: 6
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
