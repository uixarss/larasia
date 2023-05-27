@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Info Kondisi Buku
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="m-0">
                    <button class="btn fw-bold btn-primary"data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">Tambah</button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 p-3 w-150px"
                        data-kt-menu="true">
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahkondisi"
                                class="menu-link px-3">Kondisi Buku</a>
                        </div>
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahlist"
                                class="menu-link px-3">List Kondisi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#kondisi" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Kondisi Buku
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#list" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            List Buku
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
                <div class="tab-pane fade active show" id="kondisi" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Kondisi Buku
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_kondisi">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th width="120">Kategori</th>
                                <th width="130">ISBN</th>
                                <th>Judul Buku</th>
                                <th width="120">Gambar</th>
                                <th width="120">Kondisi</th>
                                <th width="100">Jumlah</th>
                                <th class="min-w-100px text-end rounded-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_kondisi_buku as $no => $kondisi_buku)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $kondisi_buku->data_buku->kategori_buku->nama_kategori }}</td>
                                    <td>{{ $kondisi_buku->data_buku->ISBN }}</td>
                                    <td>{{ $kondisi_buku->data_buku->judul_buku }}</td>
                                    <td>
                                        <div class="photo-table">
                                            <a href="#">
                                                <img src="{{ asset('admin/assets/images/users/siswa/no-image.jpg') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $kondisi_buku->list_kondisi->nama_kondisi }}</td>
                                    <td>{{ $kondisi_buku->jumlah }} Buku</td>
                                    <td class="text-end">
                                        <form action="{{ route('perpustakaan.kondisibuku.destroy', $kondisi_buku->id) }}"
                                            method="post">
                                            {{ csrf_field() }}
                                            @method('delete')
                                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editKondisiBuku{{ $kondisi_buku->id }}">Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT KONDISI BUKU-->
                                <div class="modal fade" id="editKondisiBuku{{ $kondisi_buku->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Kondisi Buku</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('perpustakaan.kondisibuku.update', $kondisi_buku->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">

                                                        <div class="form-group col-md-12 mb-5">
                                                            <label class="form-label" for="data_buku_id">ISBN</label>
                                                            <select name="data_buku_id" class="form-control" data-dropdown-parent="#editKondisiBuku{{ $kondisi_buku->id }}"
                                                                data-control="select2" data-placeholder="-Pilih-" required>
                                                                @foreach ($data_buku as $buku)
                                                                    @if ($buku->id == $kondisi_buku->data_buku->id)
                                                                        <option value="{{ $buku->id }}" selected>
                                                                            {{ $buku->ISBN }} || {{ $buku->judul_buku }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $buku->id }}">
                                                                            {{ $buku->ISBN }} || {{ $buku->judul_buku }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="kode_kondisi">Keterangan
                                                                Kondisi</label>
                                                            <select name="kode_kondisi" class="form-control" data-control="select2" data-dropdown-parent="#editKondisiBuku{{ $kondisi_buku->id }}" data-placeholder="-Pilih-" required>
                                                                @foreach ($list_kondisi as $kondisi)
                                                                    @if ($kondisi->id == $kondisi_buku->list_kondisi->id)
                                                                        <option value="{{ $kondisi->id }}" selected>
                                                                            {{ $kondisi->nama_kondisi }}</option>
                                                                    @else
                                                                        <option value="{{ $kondisi->id }}">
                                                                            {{ $kondisi->nama_kondisi }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="jumlah">Jumlah Buku</label>
                                                            <input name="jumlah" type="number" class="form-control"
                                                                value="{{ $kondisi_buku->jumlah }}"
                                                                placeholder="Masukan jumlah_buku">
                                                        </div><br>

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
                                <!-- END MODAL EDIT KONDISI BUKU -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="list" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                List Kondisi
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_list"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_list">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>Kode Kondisi</th>
                                <th>Nama Kondisi</th>
                                <th class="min-w-250px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kondisi as $no => $kondisi)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $kondisi->kode_kondisi }}</td>
                                    <td>{{ $kondisi->nama_kondisi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editLitsKondisi{{ $kondisi->id }}">Edit</a>
                                        <a href="{{ route('perpustakaan.databuku.listkondisi.delete', $kondisi->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- MODAL TAMBAH LIST KONDISI-->
                                <div class="modal fade" id="editLitsKondisi{{ $kondisi->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit List Kondisi</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>

                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('perpustakaan.databuku.listkondisi.update', $kondisi->id) }}"
                                                    method="post">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="kode_kondisi">Kode
                                                            Kondisi</label>
                                                        <input name="kode_kondisi" type="text" class="form-control"
                                                            value="{{ $kondisi->kode_kondisi }}"
                                                            placeholder="Masukan Kode Kondisi">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label" for="nama_kondisi">Nama
                                                            Kondisi</label>
                                                        <input name="nama_kondisi" type="text" class="form-control"
                                                            value="{{ $kondisi->nama_kondisi }}"
                                                            placeholder="Masukan Nama Kondisi Buku">
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
                                <!-- END MODAL TAMBAH LIST KONDISI -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambahkondisi">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('perpustakaan.kondisibuku.store')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Kondisi Buku</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-12 mb-5">
                          <label class="form-label" for="data_buku_id">ISBN</label>
                          <select name="data_buku_id" class="form-control" data-control="select2" data-dropdown-parent="#tambahkondisi" data-placeholder="-Pilih-" required>
                            @foreach($data_buku as $buku)
                            <option value="{{$buku->id}}">{{$buku->ISBN}} || {{$buku->judul_buku}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-6">
                          <label class="form-label" for="kode_kondisi">Keterangan Kondisi</label>
                          <select name="kode_kondisi" class="form-control" data-control="select2" data-dropdown-parent="#tambahkondisi" data-placeholder="-Pilih-" required>
                            @foreach($list_kondisi as $kondisi)
                            <option value="{{$kondisi->id}}">{{$kondisi->nama_kondisi}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-6">
                          <label class="form-label" for="jumlah">Jumlah Buku</label>
                          <input name="jumlah" type="number" class="form-control" value=""  placeholder="Masukan Jumlah Buku">
                        </div><br>

                      </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="tambahlist">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('perpustakaan.databuku.listkondisi.tambah')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah List Kondisi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="kode_kondisi">Kode Kondisi</label>
                        <input name="kode_kondisi" type="text" class="form-control" value="" placeholder="Masukan Kode Kondisi">
                      </div>

                      <div class="fv-row">
                        <label class="form-label" for="nama_kondisi">Nama Kondisi</label>
                        <input name="nama_kondisi" type="text" class="form-control" value="" placeholder="Masukan Nama Kondisi Buku">
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
            var table = document.getElementById('table_kondisi');
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

        var DataKembali = function() {
            var table = document.getElementById('table_list');
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
                const filterSearch = document.getElementById('table_search_list');
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
        });
    </script>
@endsection
