@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Data Buku
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="m-0">
                    <button class="btn fw-bold btn-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">Tambah</button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 p-3 w-100px"
                        data-kt-menu="true">
                        <div class="menu-item">
                            <a href="{{ route('perpustakaan.databuku.tambahbuku') }}" class="menu-link px-3">Buku</a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('perpustakaan.databuku.tambahebook') }}" class="menu-link px-3">Ebook</a>
                        </div>
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahcategory"
                                class="menu-link px-3">Kategori</a>
                        </div>
                        <div class="menu-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahdistributor"
                                class="menu-link px-3">Distributor</a>
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
                <li class="nav-item col-3 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#book" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            List Buku
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-3 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#ebook" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            List E-Book
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-3 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#rebook" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Review E-Book
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-3 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#category" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            List Kategori & Distributor
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
                <div class="tab-pane fade active show" id="book" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Buku Perpustakaan
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="search_filter" name="search_filter"
                                    class="form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                            <button type="button" class="ms-2 btn btn-icon btn-sm btn-primary" id="btn-search"><i
                                    class="bi bi-search"></i></button>
                            <button type="button" class="ms-1 btn btn-icon btn-sm btn-danger" id="btn-clear"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_list">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Jml Pinjam</th>
                                <th>Jml Kembali</th>
                                <th>Sisa Stok</th>
                                <th class="min-w-50px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="ebook" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data List E-Book
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="search_filter2" name="search_filter"
                                    class="form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                            <button type="button" class="ms-2 btn btn-icon btn-sm btn-primary" id="btn-search2"><i
                                    class="bi bi-search"></i></button>
                            <button type="button" class="ms-1 btn btn-icon btn-sm btn-danger" id="btn-clear2"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_list2">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Nama File</th>
                                <th>Download</th>
                                <th>Status</th>
                                <th class="min-w-100px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="rebook" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Review E-Book
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="search_filter3" name="search_filter"
                                    class="form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                            <button type="button" class="ms-2 btn btn-icon btn-sm btn-primary" id="btn-search3"><i
                                    class="bi bi-search"></i></button>
                            <button type="button" class="ms-1 btn btn-icon btn-sm btn-danger" id="btn-clear3"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <table
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                        id="table_list3">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-30px text-start rounded-start">No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th class="min-w-50px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="category" role="tabpanel">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-wrap flex-stack pb-7">
                                <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                                    <h3 class="fw-bold me-5 my-1">
                                        Data List Kategori
                                    </h3>
                                </div>
                                <div class="d-flex flex-wrap align-items-center my-1">
                                    <div class="d-flex align-items-center position-relative">
                                        <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                        <input type="text" id="search_filter4" name="search_filter"
                                            class="form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                            placeholder="Search">
                                    </div>
                                    <button type="button" class="ms-2 btn btn-icon btn-sm btn-primary"
                                        id="btn-search4"><i class="bi bi-search"></i></button>
                                    <button type="button" class="ms-1 btn btn-icon btn-sm btn-danger" id="btn-clear4"><i
                                            class="bi bi-trash"></i></button>
                                </div>
                            </div>
                            <table
                                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                                id="table_list4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-30px text-start rounded-start">No</th>
                                        <th>Kode Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th class="min-w-100px text-end">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-6">
                            <div class="d-flex flex-wrap flex-stack pb-7">
                                <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                                    <h3 class="fw-bold me-5 my-1">
                                        Data List Distributor
                                    </h3>
                                </div>
                                <div class="d-flex flex-wrap align-items-center my-1">
                                    <div class="d-flex align-items-center position-relative">
                                        <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                        <input type="text" id="search_filter5" name="search_filter"
                                            class="form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                            placeholder="Search">
                                    </div>
                                    <button type="button" class="ms-2 btn btn-icon btn-sm btn-primary"
                                        id="btn-search5"><i class="bi bi-search"></i></button>
                                    <button type="button" class="ms-1 btn btn-icon btn-sm btn-danger" id="btn-clear5"><i
                                            class="bi bi-trash"></i></button>
                                </div>
                            </div>
                            <table
                                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                                id="table_list5">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-30px text-start rounded-start">No</th>
                                        <th>Kode Distributor</th>
                                        <th>Nama Distributor</th>
                                        <th class="min-w-50px text-end">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambahcategory">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('perpustakaan.databuku.datakategori.tambah') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Kategori</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label" for="kode_kategori">Kode Kategori</label>
                        <input name="kode_kategori" type="text" class="form-control" value=""
                            placeholder="Masukan Kode Kategori Buku">
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="nama_kategori">Nama Kategori</label>
                        <input name="nama_kategori" type="text" class="form-control" value=""
                            placeholder="Masukan Nama Kategori Buku">
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
    <div class="modal fade" tabindex="-1" id="tambahdistributor">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('perpustakaan.databuku.datadistributor.tambah') }}"
                method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Distributor</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label" for="kode_distributor">Kode Distributor</label>
                        <input name="kode_distributor" type="text" class="form-control" value=""
                            placeholder="Masukan Kode Distributor Buku">
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="nama_distributor">Nama Distributor</label>
                        <input name="nama_distributor" type="text" class="form-control" value=""
                            placeholder="Masukan Nama Distributor Buku">
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


    <div class="modal fade" id="ubahDistributor" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Distributor Buku Perpustakaan</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{ route('perpustakaan.databuku.datadistributor.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">

                        <div class="fv-row mb-5">
                            <label class="form-label" for="kode_kategori">Kode Distributor</label>
                            <input name="kode_distributor" id="edit_kode_distributor" type="text"
                                class="form-control">
                        </div>

                        <div class="fv-row">
                            <label class="form-label" for="nama_kategori">Nama Distributor</label>
                            <input name="nama_distributor" id="edit_nama_distributor" type="text"
                                class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahKategori" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Kategori Buku Perpustakaan</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{ route('perpustakaan.databuku.datakategori.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_kategori_id">

                        <div class="fv-row mb-5">
                            <label class="form-label" for="kode_kategori">Kode Kategori</label>
                            <input name="kode_kategori" id="edit_kode_kategori" type="text" class="form-control">
                        </div>

                        <div class="fv-row">
                            <label class="form-label" for="nama_kategori">Nama Kategori</label>
                            <input name="nama_kategori" id="edit_nama_kategori" type="text" class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
                    </form>
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
    <script type="text/javascript">
        _user_id = {{ Illuminate\Support\Facades\Auth::id() }};


        function hapus(id) {
            swal.fire({
                title: 'Konfirmasi?',
                text: "Yakin akan hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!'
            }).then(function(result) {
                if (result.value) {

                    url = "<?php echo URL::to('perpustakaan/databuku/destroy'); ?>";

                    $.ajax({
                        url: url + '/' + id,
                        method: 'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data, status) {
                            $('#alertvalidate').html('');
                            swal.fire("Berhasil!", "Data Berhasil dihapus!!", "success");
                            LoadPage.init();

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 404) {
                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + jqXHR.responseJSON.message +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);
                                swal.fire("Gagal!", "Data Gagal dihapus!!", "error");

                            } else if (jqXHR.status == 422) {
                                var response = JSON.parse(jqXHR.responseText);
                                var errorString = '<ul>';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';

                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + errorString +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);

                                swal.fire("Gagal!", "Data Gagal dihapus, Periksa Inputan!!", "error");
                            } else {
                                swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");

                            }
                        }
                    });
                }
            });
        }

        function hapus2(id) {
            swal.fire({
                title: 'Konfirmasi?',
                text: "Yakin akan hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!'
            }).then(function(result) {
                if (result.value) {

                    url = "<?php echo URL::to('perpustakaan/databuku/destroyEBook'); ?>";

                    $.ajax({
                        url: url + '/' + id,
                        method: 'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data, status) {
                            $('#alertvalidate').html('');
                            swal.fire("Berhasil!", "Data Berhasil dihapus!!", "success");
                            LoadPage.init();

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 404) {
                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + jqXHR.responseJSON.message +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);
                                swal.fire("Gagal!", "Data Gagal dihapus!!", "error");

                            } else if (jqXHR.status == 422) {
                                var response = JSON.parse(jqXHR.responseText);
                                var errorString = '<ul>';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';

                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + errorString +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);

                                swal.fire("Gagal!", "Data Gagal dihapus, Periksa Inputan!!", "error");
                            } else {
                                swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");

                            }
                        }
                    });
                }
            });
        }

        function hapus3(id) {
            swal.fire({
                title: 'Konfirmasi?',
                text: "Yakin akan hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!'
            }).then(function(result) {
                if (result.value) {

                    url = "<?php echo URL::to('perpustakaan/databuku/datakategori/delete'); ?>";

                    $.ajax({
                        url: url,
                        method: 'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data, status) {
                            $('#alertvalidate').html('');
                            swal.fire("Berhasil!", "Data Berhasil dihapus!!", "success");
                            LoadPage.init();

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 404) {
                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + jqXHR.responseJSON.message +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);
                                swal.fire("Gagal!", "Data Gagal dihapus!!", "error");

                            } else if (jqXHR.status == 422) {
                                var response = JSON.parse(jqXHR.responseText);
                                var errorString = '<ul>';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';

                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + errorString +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);

                                swal.fire("Gagal!", "Data Gagal dihapus, Periksa Inputan!!", "error");
                            } else {
                                swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");

                            }
                        }
                    });
                }
            });
        }

        function hapus4(id) {
            swal.fire({
                title: 'Konfirmasi?',
                text: "Yakin akan hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!'
            }).then(function(result) {
                if (result.value) {

                    url = "<?php echo URL::to('perpustakaan/databuku/datadistributor/delete'); ?>";

                    $.ajax({
                        url: url,
                        method: 'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data, status) {
                            $('#alertvalidate').html('');
                            swal.fire("Berhasil!", "Data Berhasil dihapus!!", "success");
                            LoadPage.init();

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 404) {
                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + jqXHR.responseJSON.message +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);
                                swal.fire("Gagal!", "Data Gagal dihapus!!", "error");

                            } else if (jqXHR.status == 422) {
                                var response = JSON.parse(jqXHR.responseText);
                                var errorString = '<ul>';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';

                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + errorString +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);

                                swal.fire("Gagal!", "Data Gagal dihapus, Periksa Inputan!!", "error");
                            } else {
                                swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");

                            }
                        }
                    });
                }
            });
        }

        var ubahDistributor = function(id, kode_distributor, nama_distributor) {
            $('#edit_id').val(id);
            $('#edit_kode_distributor').val(kode_distributor);
            $('#edit_nama_distributor').val(nama_distributor);
            $('#ubahDistributor').modal('show');
        }

        var ubahKategori = function(id, kode_kategori, nama_kategori) {
            $('#edit_kategori_id').val(id);
            $('#edit_kode_kategori').val(kode_kategori);
            $('#edit_nama_kategori').val(nama_kategori);
            $('#ubahKategori').modal('show');
        }




        var LoadPage = function() {

            // $.fn.dataTable.Api.register('column().title()', function() {
            //     return $(this.header()).text().trim();
            // });


            var arrows;

            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }


            var initTable1 = function() {

                $('#btn-clear').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search').click(function() {
                    $('#table_list').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list').DataTable({
                    responsive: true,
                    bDestroy: true,
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    language: {
                        'lengthMenu': '_MENU_',
                    },
                    ordering: false,
                    columnDefs: [{
                        targets: 10,
                        className: 'dt-body-right'
                    }],

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/perpustakaan/get_data_buku') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'judul_buku'
                        },
                        {
                            data: 'penulis'
                        },
                        {
                            data: 'penerbit'
                        },
                        {
                            data: 'ISBN'
                        },
                        {
                            data: 'nama_kategori'
                        },
                        {
                            data: 'stok_buku'
                        },
                        {
                            data: 'jumlah_peminjaman'
                        },
                        {
                            data: 'jumlah_pengembalian'
                        },
                        {
                            data: 'sisa_stok'
                        },

                        {
                            data: {
                                id: 'id',
                                ISBN: 'ISBN',
                            },
                            render: function(data, type, full, meta) {
                                var url = "{{ url('perpustakaan/databuku/show') }}/" + data.ISBN;
                                var url2 = "{{ url('perpustakaan/databuku/editbuku') }}/" + data
                                    .id;

                                return '<a class="me-2 btn btn-sm btn-icon btn-info" href="'+url+'"><i class="bi bi-box-arrow-up-right"></i></a>'+
                                        '<a class="me-2 btn btn-sm btn-icon btn-warning" href="' + url2 + '"><i class="bi bi-pencil-square"></i></a>' +
                                        '<a class="btn btn-sm btn-icon btn-danger" href="javascript:hapus(' + data.id + ');"><i class="bi bi-trash"></i></a>';
                            },
                        },
                    ],
                });

            };

            var initTable2 = function() {

                $('#btn-clear2').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search2').click(function() {
                    $('#table_list2').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list2').DataTable({
                    responsive: true,
                    bDestroy: true,

                    lengthMenu: [5, 10, 25, 50],

                    pageLength: 10,

                    language: {
                        'lengthMenu': '_MENU_',
                    },
                    ordering: false,
                    columnDefs: [{
                        targets: 8,
                        className: 'dt-body-right'
                    }],

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/perpustakaan/get_data_ebook') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter2').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'judul_ebook'
                        },
                        {
                            data: 'penulis'
                        },
                        {
                            data: 'penerbit'
                        },
                        {
                            data: 'ISBN'
                        },
                        {
                            data: 'file_ebook'
                        },
                        {
                            data: 'jml_download'
                        },
                        {
                            data: {
                                status: 'status'
                            },
                            render: function(data, type, full, meta) {

                                var sts = {
                                    0: {
                                        'title': 'Belum Review',
                                        'class': 'label label-danger'
                                    },
                                    1: {
                                        'title': 'Publish',
                                        'class': 'label label-primary'
                                    }
                                };

                                var status = data.status ? data.status : 0;

                                return '<span class="' + sts[status].class + '">' + sts[status]
                                    .title + '</span>';
                            },
                        },
                        {
                            data: {
                                id: 'id',
                                ISBN: 'ISBN',
                                file_ebook: 'file_ebook',
                            },
                            render: function(data, type, full, meta) {
                                console.log(_user_id);
                                var url1 = "{{ Storage::url('public/ebook') }}/" + data
                                    .file_ebook + "/" + _user_id + "/" + data.id;
                                var url2 = "{{ url('perpustakaan/databuku/editebook') }}/" + data
                                    .id;
                                var url3 = "{{ url('perpustakaan//{id}/ebook/') }}/" + data.id;

                                return '<a class="me-2 btn btn-sm btn-icon btn-success"  href="' +
                                    url1 + '"><i class="bi bi-cloud-arrow-down"></i></a>' +
                                    '<a class="me-2 btn btn-sm btn-icon btn-warning" href="' +
                                    url2 + '"><i class="bi bi-pencil-square"></i></a>' +
                                    '<a class="btn btn-sm btn-icon btn-danger" href="javascript:hapus2(' +
                                    data.id + ');"><i class="bi bi-trash"></i></a>';
                            },
                        },
                    ],
                });

            };

            var initTable3 = function() {

                $('#btn-clear3').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search3').click(function() {
                    $('#table_list3').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list3').DataTable({
                    responsive: true,
                    bDestroy: true,

                    lengthMenu: [5, 10, 25, 50],

                    pageLength: 10,

                    language: {
                        'lengthMenu': '_MENU_',
                    },
                    ordering: false,
                    columnDefs: [{
                        targets: 5,
                        className: 'dt-body-right'
                    }],

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/perpustakaan/get_data_review') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter3').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'judul_ebook'
                        },
                        {
                            data: 'penulis'
                        },
                        {
                            data: 'penerbit'
                        },
                        {
                            data: 'ISBN'
                        },

                        {
                            data: {
                                id: 'id'
                            },
                            render: function(data, type, full, meta) {
                                var url = "{{ url('unduh/ebook') }}/" + data.ISBN;
                                var url2 = "{{ url('perpustakaan/databuku/publish') }}/" + data.id;

                                return '<span class="dropdown">' +
                                    '<a href="#" class="btn btn-sm btn-label-brand btn-bold" data-toggle="dropdown" aria-expanded="true">' +
                                    '<i class="fa fa-list"></i>' +
                                    '</a>' +
                                    '<div class="dropdown-menu dropdown-menu-right">' +
                                    '<a class="btn btn-success" href="' + url2 +
                                    '"><i class="fa fa-pencil"></i>Publish</a>' +
                                    '<a class="btn btn-danger" href="' + url +
                                    '" class="btn btn-danger"><i class="fa fa-trash-o" ></i> Hapus</a>' +
                                    '</div>' +
                                    '</span>';
                            },
                        },
                    ],
                });

            };

            var initTable4 = function() {

                $('#btn-clear4').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search4').click(function() {
                    $('#table_list4').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list4').DataTable({
                    responsive: true,
                    bDestroy: true,

                    lengthMenu: [5, 10, 25, 50],

                    pageLength: 10,

                    language: {
                        'lengthMenu': '_MENU_',
                    },
                    ordering: false,
                    columnDefs: [{
                        targets: 3,
                        className: 'dt-body-right'
                    }],

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/perpustakaan/get_kategori') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter4').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'kode_kategori'
                        },
                        {
                            data: 'nama_kategori'
                        },

                        {
                            data: {
                                id: 'id'
                            },
                            render: function(data, type, full, meta) {

                                var url2 = "{{ url('perpustakaan/databuku/editkategori') }}/" +
                                    data.id;

                                return '<a class="me-2 btn btn-sm btn-icon btn-warning" onclick="ubahKategori(' +
                                    data.id + ', \'' + data.kode_kategori + '\', \'' + data
                                    .nama_kategori +
                                    '\')"><i class="bi bi-pencil-square"></i></a>' +
                                    '<a class="btn btn-sm btn-icon btn-danger" href="javascript:hapus3(' +
                                    data.id + ');"><i class="bi bi-trash"></i></a>';
                            },
                        },
                    ],
                });

            };

            var initTable5 = function() {

                $('#btn-clear5').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search5').click(function() {
                    $('#table_list5').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list5').DataTable({
                    responsive: true,
                    bDestroy: true,

                    lengthMenu: [5, 10, 25, 50],

                    pageLength: 10,

                    language: {
                        'lengthMenu': '_MENU_',
                    },
                    ordering: false,
                    columnDefs: [{
                        targets: 3,
                        className: 'dt-body-right'
                    }],

                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/perpustakaan/get_distributor') }}",
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter5').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'kode_distributor'
                        },
                        {
                            data: 'nama_distributor'
                        },
                        {
                            data: {
                                id: 'id'
                            },
                            render: function(data, type, full, meta) {
                                // var url2 = "{{ url('perpustakaan/databuku/editdistributor') }}/" + data.id;
                                return '<a class="me-2 btn btn-sm btn-icon btn-warning" onclick="ubahDistributor(' + data.id + ', \'' + data.kode_distributor + '\', \'' + data.nama_distributor + '\')"><i class="bi bi-pencil-square"></i></a>' +
                                        '<a class="btn btn-sm btn-icon btn-danger" href="javascript:hapus4(' + data.id + ');"><i class="bi bi-trash"></i></a>';
                            },
                        },
                    ],
                });

            };
            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                    initTable2();
                    initTable3();
                    initTable4();
                    initTable5();

                }
            };
        }();

        jQuery(document).ready(function() {
            LoadPage.init();
        });
    </script>
@endsection
