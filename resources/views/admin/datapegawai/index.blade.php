@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Kepegawaian
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Kepegawaian</li>
    </ul>
@endsection

@section('content')

    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <div class="d-flex align-items-center position-relative">
                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                <input type="text" id="table_search"
                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                    placeholder="Search">
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah Pegawai</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="w-50px pe-5">No</th>
                        <th class="min-w-250px">Pegawai</th>
                        <th class="min-w-150px">Bagian Pegawai</th>
                        <th class="min-w-150px">Jabatan Pegawai</th>
                        <th class="min-w-150px">Status Pegawai</th>
                        <th class="min-w-125px">Agama</th>
                        <th class="min-w-300px">Alamat</th>
                        <th class="min-w-150px text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($data_pegawai as $pegawai)
                        <tr>
                            <td>{{ $pegawai->id }}</td>
                            <td class="d-flex align-items-center">
                                <div class="symbol symbol-50px overflow-hidden me-3">
                                    <a href="{{ route('admin.nonakademik.detail', ['id' => $pegawai->id]) }}">
                                        <div class="symbol-label">
                                            @if ($pegawai->photo != null)
                                                <img src="{{ asset('admin/assets/images/users/pegawai/' . $pegawai->photo) }}" class="w-100">
                                            @else
                                                    <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}" class="w-100">
                                            @endif
                                        </div>
                                    </a>
                                </div>


                                <div class="d-flex flex-column">
                                    <a href="{{ route('admin.nonakademik.detail', ['id' => $pegawai->id]) }}"
                                        class="text-gray-800 text-hover-primary mb-1">{{ $pegawai->nama_pegawai }}</a>
                                    <span>{{ $pegawai->NIP }}</span>
                                </div>
                            </td>
                            <td>{{ $pegawai->bagian_pegawai }}</td>
                            <td>{{ $pegawai->jabatan_pegawai }}</td>
                            <td>{{ $pegawai->status_pegawai }}</td>
                            <td>{{ $pegawai->agama }}</td>
                            <td>{{ $pegawai->alamat }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.nonakademik.detail', ['id' => $pegawai->id]) }}" type="button"
                                    class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('admin.nonakademik.hapus', ['id' => $pegawai->id]) }}" type="button"
                                    class="btn btn-sm btn-danger"onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.datapegawai.create') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pegawai</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">NIP</label>
                        <input name="nip" type="text" class="form-control" placeholder="NIP">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Nama Pegawai</label>
                        <input name="nama_pegawai" type="text" class="form-control" placeholder="Nama Pegawai">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="fv-row mb-5">
                        <label>Agama</label>
                        <select name="agama" class="form-control">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label>Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="date" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                        <label>Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label>No Handphone</label>
                        <input name="no_hp" type="text" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" class="col-md-3 control-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat Lengkap"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Bagian Pegawai</label>
                        <input name="bagian_pegawai" type="texts" class="form-control" placeholder="Bagian Pegawai">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Jabatan Pegawai</label>
                        <input name="jabatan_pegawai" type="texts" class="form-control" placeholder="Jabatan Pegawai">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Status Pegawai</label>
                        <select name="status_pegawai" class="form-control">
                            <option value="PNS">PNS</option>
                            <option value="Honorer">Honorer</option>
                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="exampleInputEmail1">Tanggal Masuk</label>
                        <input name="tanggal_masuk" type="date" class="form-control" placeholder="Tanggal Masuk">
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
