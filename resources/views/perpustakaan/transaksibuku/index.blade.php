@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Transaksi Buku
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn fw-bold btn-primary">Tambah Peminjam
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-4 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#pinjam" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Peminjaman
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#kembali" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Pengembalian
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#denda" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Denda Buku
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
                <div class="tab-pane fade active show" id="pinjam" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Peminjaman Buku
                            </h3>
                            <span class="text-gray-400 fs-6"></span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_pinjam"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_pinjam">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Tanggal</th>
                                <th>NIS</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th class="text-end rounded-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data_peminjaman as $peminjaman)
                                @if ($peminjaman->status == 1)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $peminjaman->tanggal_mulai }}</td>
                                        <td>{{ $peminjaman->tanggal_selesai }}</td>
                                        <td>{{ $peminjaman->siswa->nim }}</td>
                                        <td>{{ $peminjaman->siswa->nama_mahasiswa }}</td>
                                        <td>{{ $peminjaman->data_buku->judul_buku }}</td>
                                        <td>{{ $peminjaman->data_buku->kategori_buku->nama_kategori }}</td>
                                        <td>{{ $peminjaman->jumlah }} Buku</td>
                                        <td>
                                            @if ($peminjaman->status == 1)
                                                <span class="badge badge-info"> <strong>Dipinjam</strong></span>
                                            @else
                                                <span class="badge badge-success"> <strong>Dikembalikan</strong></span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                                data-bs-target="#editPeminjaman{{ $peminjaman->id }}">Selesai</a>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIT PEMINJAMAN BUKU-->
                                    <div class="modal fade" id="editPeminjaman{{ $peminjaman->id }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Form Pengembalian Buku</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('perpustakaan.transaksibuku.update', $peminjaman->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="siswa_id"
                                                            value="{{ $peminjaman->siswa->id }}">
                                                        <input type="hidden" name="data_buku_id"
                                                            value="{{ $peminjaman->data_buku->id }}">
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="">NIM / Nama
                                                                Mahasiswa</label>
                                                            <select name="" class="form-control"
                                                                ata-live-search="true" required disabled>
                                                                <option>-Masukan NIM / Nama Mahasiswa-</option>
                                                                @foreach ($data_siswa as $siswa)
                                                                    @if ($siswa->id == $peminjaman->siswa->id)
                                                                        <option value="{{ $siswa->id }}" selected>
                                                                            {{ $siswa->nim }} ||
                                                                            {{ $siswa->nama_mahasiswa }}</option>
                                                                    @else
                                                                        <option value="{{ $siswa->id }}">
                                                                            {{ $siswa->nim }} ||
                                                                            {{ $siswa->nama_mahasiswa }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="">ISBN</label>
                                                            <select name="" class="form-control select"
                                                                data-live-search="true" required disabled>
                                                                <option>-Masukan ISBN / Judul Buku-</option>
                                                                @foreach ($data_buku as $buku)
                                                                    @if ($buku->id == $peminjaman->data_buku->id)
                                                                        <option value="{{ $buku->id }}" selected>
                                                                            {{ $buku->ISBN }} ||
                                                                            {{ $buku->judul_buku }}</option>
                                                                    @else
                                                                        <option value="{{ $buku->id }}">
                                                                            {{ $buku->ISBN }} ||
                                                                            {{ $buku->judul_buku }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kondisi_id">Keterangan
                                                                Kondisi</label>
                                                            <select name="kondisi_id" class="form-control"
                                                                data-live-search="true" required>
                                                                @foreach ($list_kondisi as $kondisi)
                                                                    <option value="{{ $kondisi->id }}">
                                                                        {{ $kondisi->nama_kondisi }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="d-flex flex-wrap gap-5">
                                                            <div class="fv-row w-100 flex-md-root mb-5">
                                                                <label class="form-label" for="jumlah">Jumlah
                                                                    Buku</label>
                                                                <input type="number" class="form-control"
                                                                    value="{{ $peminjaman->jumlah }}" disabled>
                                                                <input name="jumlah" type="hidden" class="form-control"
                                                                    value="{{ $peminjaman->jumlah }}">
                                                            </div>
                                                            <div class="fv-row w-100 flex-md-root mb-5">
                                                                <label class="form-label" for="tanggal_kembali">Tanggal
                                                                    Kembali</label>
                                                                <input name="tanggal_kembali" type="date"
                                                                    class="form-control" value=""
                                                                    placeholder="Masukan Tanggal Selesai">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL EDIT PEMINJAMAN BUKU -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kembali" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Pengembalian Buku
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_kembali"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_kembali">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th class="min-w-200px">Penerima</th>
                                <th class="min-w-150px">Tanggal Pinjam</th>
                                <th class="min-w-150px">Tanggal Kembali</th>
                                <th class="min-w-100px">NIM</th>
                                <th class="min-w-200px">Nama Mahasiswa</th>
                                <th class="min-w-150px">Judul Buku</th>
                                <th class="min-w-100px">Kategori</th>
                                <th class="min-w-100px">Jumlah</th>
                                <th class="min-w-100px">Ket. Kondisi</th>
                                <th class="rounded-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data_peminjaman as $no => $peminjaman)
                                @if ($peminjaman->status == 0)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $peminjaman->user->name }}</td>
                                        <td>{{ $peminjaman->tanggal_mulai }}</td>
                                        <td>{{ $peminjaman->tanggal_kembali }}</td>
                                        <td>{{ $peminjaman->siswa->nim }}</td>
                                        <td>{{ $peminjaman->siswa->nama_mahasiswa }}</td>
                                        <td>{{ $peminjaman->data_buku->judul_buku }}</td>
                                        <td>{{ $peminjaman->data_buku->kategori_buku->nama_kategori }}</td>
                                        <td>{{ $peminjaman->jumlah }} Buku</td>
                                        <td>{{ $peminjaman->list_kondisi->nama_kondisi }}</td>
                                        <td>
                                            @if ($peminjaman->status == 1)
                                                <span class="badge badge-info"> <strong>Dipinjam</strong></span>
                                            @else
                                                <span class="badge badge-success"> <strong>Dikembalikan</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="denda" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Daftar Nama-nama Mahasiswa Denda Buku
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_denda"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_denda">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Telat Pengembalian</th>
                                <th class="rounded-end">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_denda as $no => $denda)
                                @php
                                    $jlm_denda = 'Rp ' . number_format($denda->jumlah_denda, 2, ',', '.');
                                @endphp
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $denda->siswa->nim }}</td>
                                    <td>{{ $denda->siswa->nama_mahasiswa }}</td>
                                    <td>{{ $denda->data_buku->judul_buku }}</td>
                                    <td>{{ $denda->data_buku->kategori_buku->nama_kategori }}</td>
                                    <td>{{ $denda->jumlah_telat }} Hari</td>
                                    <td>{{ $jlm_denda }},-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('perpustakaan.transaksibuku.store') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Peminjaman Buku</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="siswa_id">NIM / Nama Mahasiswa</label>
                        <select name="siswa_id" class="form-control" data-control="select2" data-dropdown-parent="#tambah" required>
                            @foreach ($data_siswa as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nim }} || {{ $siswa->nama_mahasiswa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="add_input_fields">
                        <div class="d-flex flex-wrap gap-5">
                            <div class="fv-row w-100 flex-md-root mb-5">
                                <label class="form-label" for="data_buku_id">ISBN</label>
                                <select name="data_buku_id[]" class="form-control" data-control="select2" data-dropdown-parent="#tambah" data-placeholder="-Masukan ISBN / Judul Buku-" required>
                                    @foreach ($data_buku as $buku)
                                        <option value="{{ $buku->id }}">{{ $buku->ISBN }} || {{ $buku->judul_buku }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row w-100px mb-5">
                                <label class="form-label" for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" value="1" disabled>
                                <input name="jumlah[]" type="hidden" class="form-control" value="1">
                            </div>
                        </div>
                    </div>

                    <a class="button_add_filed btn btn-info mb-5"> <span class="fa fa-plus"></span> Tambah Pinjam Buku</a>

                    <div class="d-flex flex-wrap gap-5">
                        <div class="fv-row w-100 flex-md-root mb-5">
                            <label class="form-label" for="tanggal_mulai">Mulai Tanggal</label>
                            <input name="tanggal_mulai" type="date" class="form-control" placeholder="Masukan Tanggal Mulai">
                        </div>
                        <div class="fv-row w-100 flex-md-root mb-5">
                            <label class="form-label" for="tanggal_selesai">Sampai Tanggal</label>
                            <input name="tanggal_selesai" type="date" class="form-control" placeholder="Masukan Tanggal Selesai">
                        </div>
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
            var table = document.getElementById('table_pinjam');
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
                            targets: 9
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_pinjam');
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

        var DataKembali = function() {
            var table = document.getElementById('table_kembali');
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
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_kembali');
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

        var DataDenda = function() {
            var table = document.getElementById('table_denda');
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
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_denda');
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
            DataKembali.init();
            DataDenda.init();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".add_input_fields"); //Fields wrapper
            var add_button = $(".button_add_filed"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment


                    $(wrapper).append(
                        '<div class="d-flex flex-wrap gap-5 mb-5">' +
                        '<div class="fv-row w-100 flex-md-root">' +
                        '<label class="form-label" for="data_buku_id">ISBN</label>' +
                        '<select name="data_buku_id[]" class="form-control" data-control="select2" data-placeholder="-Masukan ISBN / Judul Buku-" data-dropdown-parent="#tambah" required>' +
                        '@foreach ($data_buku as $buku)' +
                        '<option value="{{ $buku->id }}">{{ $buku->ISBN }} || {{ $buku->judul_buku }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</div>' +

                        '<div class="fv-row w-100px">' +
                        '<label class="form-label" for="jumlah">Jumlah</label>' +
                        '<input type="number" class="form-control" value="1" disabled>' +
                        '<input name="jumlah[]" type="hidden" class="form-control" value="1">' +
                        '</div>' +
                        '<a href="#" class="d-flex w-100 align-self-center remove_field btn btn-icon btn-danger"> <span class="fa fa-times me-2"></span> Remove</a>' +
                        '</div>');

                }
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;

            })
        });
    </script>
@endsection
