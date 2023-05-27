@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Peminjaman Buku
                </h1>
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
                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#denda" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Denda Buku
                        </span>
                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
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
                                Data Pembayaran
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
                    <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4" id="table_pinjam">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="text-start rounded-start">No</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Tanggal</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Jumlah</th>
                                <th class="rounded-end">Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_peminjaman as $peminjaman)
                              <tr>
                                <td>{{$no++}}</td>
                                <td>{{$peminjaman->tanggal_mulai}}</td>
                                <td>{{$peminjaman->tanggal_selesai}}</td>
                                <td>{{$peminjaman->data_buku->judul_buku}}</td>
                                <td>{{$peminjaman->data_buku->kategori_buku->nama_kategori}}</td>
                                <td>
                                  <div class="photo-table">
                                    <a href="#">
                                      <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                    </a>
                                  </div>
                                </td>
                                <td>{{$peminjaman->jumlah}} Buku</td>
                                <td>
                                  @if($peminjaman->status == 1)
                                    <span class="badge badge-info"> <strong>Dipinjam</strong></span>
                                  @else
                                    <span class="badge badge-success"> <strong>Dikembalikan</strong></span>
                                  @endif
                                </td>
                              @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kembali" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Riwayat Pembayaran
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
                                <th class="text-start rounded-start">No</th>
                                <th>Penerima</th>
                                <th>Tanggal Kembali</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Jumlah</th>
                                <th>Ket. Kondisi</th>
                                <th class="rounded-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_pengembalian as $pengembalian)
                              <tr>
                                <td>{{$no++}}</td>
                                <td>{{$pengembalian->user->name}}</td>
                                <td>{{$pengembalian->tanggal_kembali}}</td>
                                <td>{{$pengembalian->data_buku->judul_buku}}</td>
                                <td>{{$pengembalian->data_buku->kategori_buku->nama_kategori}}</td>
                                <td>
                                  <div class="photo-table">
                                    <a href="#">
                                      <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                    </a>
                                  </div>
                                </td>
                                <td>{{$pengembalian->jumlah}} Buku</td>
                                <td>{{$pengembalian->list_kondisi->nama_kondisi}}</td>
                                <td>
                                  @if($pengembalian->status == 1)
                                    <span class="badge badge-info"> <strong>Dipinjam</strong></span>
                                  @else
                                    <span class="badge badge-success"> <strong>Dikembalikan</strong></span>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="denda" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Riwayat Pembayaran
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
                                <th class="text-start rounded-start">No</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Telat Pengembalian</th>
                                <th class="rounded-end">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_denda as $no => $denda)
                            <tr>
                              <td>{{++$no}}</td>
                              <td>{{$denda->data_buku->judul_buku}}</td>
                              <td>{{$denda->data_buku->kategori_buku->nama_kategori}}</td>
                              <td>
                                <div class="photo-table">
                                  <a href="#">
                                    <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                  </a>
                                </div>
                              </td>
                              <td>{{$denda->jumlah_telat}} Hari</td>
                              <td>Rp. {{$denda->jumlah_denda}}.00,-</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var DataPinjam = function() {
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
            DataPinjam.init();
            DataKembali.init();
            DataDenda.init();
        });
    </script>
@endsection
