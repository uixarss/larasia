@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Materi Pelajaran
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Materi Pelajaran</li>
        <input id="jumlah" name="jumlah" type="text" value="{{ $jumlah }}" hidden>
    </ul>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#materi" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Materi Pelajaran
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#rpp" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            RPP
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
                <div class="tab-pane fade active show" id="materi" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Materi Pelajaran
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <button data-bs-toggle="modal" data-bs-target="#tambahmapel"
                                class="btn btn-primary">Tambah</button>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_mapel">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-30px rounded-start">No</th>
                                    <th class="min-w-150px">Mata Kuliah</th>
                                    <th class="min-w-150px">Program Studi</th>
                                    <th class="min-w-100px">Semester</th>
                                    <th class="min-w-150px">Tahun Ajaran</th>
                                    <th class="min-w-100px">BAB Materi</th>
                                    <th class="min-w-100px">Nama Materi</th>
                                    <th class="min-w-100px">Deskripsi</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-150px">Materi</th>
                                    <th class="min-w-150px">Terunduh</th>
                                    <th class="min-w-200px text-end rounded-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $j = 0;
                                @endphp
                                @foreach ($data_materi_pelajaran as $materi_pelajaran)
                                    @php $j++; @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $materi_pelajaran->mapel->nama_mapel }}</td>
                                        <td>{{ $materi_pelajaran->prodi->nama_program_studi }}</td>
                                        <td>{{ $materi_pelajaran->semester->nama_semester }}</td>
                                        <td>{{ $materi_pelajaran->tahunAjaran->nama_tahun_ajaran }}</td>
                                        <td>{{ $materi_pelajaran->bab_materi }}</td>
                                        <td>{{ $materi_pelajaran->nama_materi }}</td>
                                        <td>{{ $materi_pelajaran->deskripsi_materi }}</td>
                                        <td>
                                            @foreach ($materi_pelajaran->kelas as $kelas)
                                                <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $path = Storage::url('public/dokumen/' . $materi_pelajaran->file_materi);
                                            @endphp
                                            <a href="{{ route('unduh.dokumen', ['path' => $path, 'id' => $materi_pelajaran->id]) }}"
                                                class="btn btn-success btn-sm" target="_blank">Download File</a>
                                        </td>
                                        <td>{{ $materi_pelajaran->jumlah_unduh }} kali terunduh</td>
                                        <td class="text-end">
                                            @role('dosen')
                                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editmapel{{ $j }}">Edit</a>
                                            @endrole
                                            @role('dosen')
                                                <a href="{{ route('guru.materipelajaran.destroy', ['id' => $materi_pelajaran->id]) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                            @endrole
                                        </td>
                                    </tr>


                                    <!-- Modal EDIT-->
                                    <div class="modal fade" id="editmapel{{ $j }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Materi Pelajaran</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('guru.materipelajaran.update', ['id' => $materi_pelajaran->id]) }}"
                                                        method="POST" enctype="multipart/form-data"
                                                        class="form-horizontal">
                                                        @csrf

                                                        <input name="mapel" id="mapel{{ $j }}"
                                                            type="text" value="{{ $materi_pelajaran->mapel_id }}"
                                                            hidden>
                                                        <input name="prodi" id="prodi{{ $j }}"
                                                            type="text" value="{{ $materi_pelajaran->id_prodi }}"
                                                            hidden>
                                                        <input name="semester" id="semester{{ $j }}"
                                                            type="text" value="{{ $materi_pelajaran->id_semester }}"
                                                            hidden>
                                                        <input name="tahun_ajaran" id="tahun_ajaran{{ $j }}"
                                                            type="text"
                                                            value="{{ $materi_pelajaran->id_tahun_ajaran }}" hidden>

                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                        <script>
                                                            jQuery.ajax({
                                                                url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + {{ $materi_pelajaran->mapel_id }},
                                                                type: "GET",
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    jQuery('#kelas' + {{ $j }}).empty();

                                                                    jQuery.each(data, function(key, value) {

                                                                        $('#kelas' + {{ $j }}).append('<option value="' + value + '" >' + key +
                                                                            '</option>');

                                                                    });

                                                                }
                                                            });

                                                            $(document).on('change', '#mapel_id' + {{ $j }}, function() {
                                                                var mapel = jQuery(this).val();
                                                                jQuery.ajax({
                                                                    url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + mapel,
                                                                    type: "GET",
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                        jQuery('#kelas' + {{ $j }}).empty();
                                                                        jQuery.each(data, function(key, value) {
                                                                            $('#kelas' + {{ $j }}).append('<option value="' + value +
                                                                                '" >' + key + '</option>');
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Mata Kuliah</label>
                                                            <select name="mapel_id" id="mapel_id{{ $j }}"
                                                                class="form-control" required>

                                                                @foreach ($data_mapel as $map)
                                                                    <option value="{{ $map->mapel_id }}"
                                                                        {{ $materi_pelajaran->mapel_id == $map->mapel_id ? 'selected' : '' }}>
                                                                        {{ $map->nama_mapel }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Program Studi</label>
                                                            <select name="id_prodi" id="id_prodi{{ $j }}"
                                                                class="form-control" required>
                                                                <option value="">== Pilih Program Studi ==</option>
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Semester</label>
                                                            <select name="id_semester"
                                                                id="id_semester{{ $j }}" class="form-control"
                                                                required>
                                                                <option value="">== Pilih Semester ==</option>
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Tahun Ajaran</label>
                                                            <select name="id_tahun_ajaran"
                                                                id="id_tahun_ajaran{{ $j }}"
                                                                class="form-control" required>
                                                                <option value="">== Pilih Tahun Ajaran ==</option>
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">BAB Materi</label>
                                                            <input name="bab_materi" type="texts" class="form-control"
                                                                value="{{ $materi_pelajaran->bab_materi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Nama Materi</label>
                                                            <input name="nama_materi" type="text" class="form-control"
                                                                value="{{ $materi_pelajaran->nama_materi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Deskripsi</label>
                                                            <input name="deskripsi_materi" type="text"
                                                                class="form-control"
                                                                value="{{ $materi_pelajaran->deskripsi_materi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Kelas</label>
                                                            <select name="id_kelas[]" id="kelas{{ $j }}"
                                                                class="form-control" multiple required>

                                                            </select>
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label">Unggah Materi</label><br />
                                                            <input type="file" name="file_materi"
                                                                class="form-control" />
                                                        </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
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
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambahmapel">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('guru.materipelajaran.store') }}"
                                method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Materi Pelajaran</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label">Mata Kuliah</label>
                                        <select name="mapel_id" id="mapel_id" class="form-control" required>
                                            @foreach ($data_mapel as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Program Studi</label>
                                        <select name="id_prodi" id="id_prodi" class="form-control" required>
                                            <option value="">== Pilih Program Studi ==</option>
                                        </select>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Semester</label>
                                        <select name="id_semester" id="id_semester" class="form-control" required>
                                            <option value="">== Pilih Semester ==</option>
                                        </select>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control"
                                            required>
                                            <option value="">== Pilih Tahun Ajaran ==</option>
                                        </select>
                                    </div>


                                    <div class="fv-row mb-5">
                                        <label class="form-label">BAB Materi</label>
                                        <input name="bab_materi" type="texts" class="form-control"
                                            placeholder="Nama Bab Materi">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Materi</label>
                                        <input name="nama_materi" type="text" class="form-control"
                                            placeholder="Nama Materi">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Deskripsi Materi</label>
                                        <input name="deskripsi_materi" type="text" class="form-control"
                                            placeholder="Deskripsi Materi">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Masukan Kelas</label>
                                        <select id="kelas" name="id_kelas[]" class="form-select"
                                            data-control="select2" data-close-on-select="false"
                                            data-placeholder="== Pilih Kelas ==" data-allow-clear="true"
                                            multiple="multiple" required>
                                        </select>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Unggah Materi</label>
                                        <input type="file" multiple id="file-simple" name="file_materi"
                                            class="form-control" />
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
                </div>
                <div class="tab-pane fade" id="rpp" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                RPP (Rencana Program Pelajaran)
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <button data-bs-toggle="modal" data-bs-target="#tambahrpp"
                                class="btn btn-primary">Tambah</button>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_rpp"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_rpp">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-30px rounded-start">ID RPP</th>
                                    <th>BAB</th>
                                    <th>Judul</th>
                                    <th>Deskripsi RPP</th>
                                    <th class="text-end rounded-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_rpp as $rpp)
                                    <tr>
                                        <td>{{ $rpp->id_rpp }}</td>
                                        <td>{{ $rpp->bab }}</td>
                                        <td>{{ $rpp->judul }}</td>
                                        <td>{!! $rpp->deskripsi !!}</td>
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editRPP">Edit</a>
                                            <a href="{{ route('guru.destroy.rpp', ['id' => $rpp->id]) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                        </td>


                                        <!-- Modal EDIT-->
                                        <div class="modal fade" id="editRPP" data-backdrop="static" tabindex="-1"
                                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Edit RPP</h3>
                                                        <div class="btn btn-icon btn-sm btn-danger ms-2"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-lg fs-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('guru.update.rpp', ['id' => $rpp->id]) }}"
                                                            method="post" enctype="multipart/form-data"
                                                            class="form-horizontal">
                                                            @csrf

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label" for="id_rpp">ID RPP</label>
                                                                <input name="id_rpp" type="text" class="form-control"
                                                                    placeholder="ID Pelajaran"
                                                                    value="{{ $rpp->id_rpp }}">
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label" for="bab">BAB</label>
                                                                <input name="bab" type="text" class="form-control"
                                                                    placeholder="ID Pelajaran"
                                                                    value="{{ $rpp->bab }}">
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label" for="judul">Judul</label>
                                                                <input name="judul" type="text" class="form-control"
                                                                    placeholder="ID Pelajaran"
                                                                    value="{{ $rpp->judul }}">
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label" for="deskripsi">Deskripsi
                                                                    RPP</label>
                                                                <textarea class="ckeditoredit" name="deskripsi">{{ $rpp->deskripsi }}</textarea>
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


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambahrpp">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('guru.tambah.rpp') }}" method="POST">
                                <div class="modal-header">
                                    <h3 class="modal-title">Buat RPP</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="id_rpp">ID RPP</label>
                                        <input name="id_rpp" type="text" class="form-control"
                                            placeholder="ID Pelajaran">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="bab">BAB</label>
                                        <input name="bab" type="text" class="form-control"
                                            placeholder="ID Pelajaran">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="judul">Judul</label>
                                        <input name="judul" type="text" class="form-control"
                                            placeholder="ID Pelajaran">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="deskripsi">Deskripsi RPP</label>
                                        <textarea class="ckeditor" name="deskripsi"></textarea>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var DataMateri = function() {
            var table = document.getElementById('table_mapel');
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
                            targets: 11
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

        var DataRPP = function() {
            var table = document.getElementById('table_rpp');
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
                const filterSearch = document.getElementById('table_search_rpp');
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
            DataMateri.init();
            DataRPP.init();
        });
        ClassicEditor.create(document.querySelector('.ckeditor'));
        ClassicEditor.create(document.querySelector('.ckeditoredit'));
    </script>
    <script>
        var mapel_id = document.getElementById("mapel_id").value;
        if (mapel_id) {
            jQuery.ajax({
                url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    jQuery('#id_prodi').empty();
                    jQuery.each(data, function(key, value) {
                        $('#id_prodi').append('<option value="' + value + '">' + key + '</option>');
                    });

                    var id_prodi = document.getElementById("id_prodi").value;
                    var mapel = document.getElementById("mapel_id").value;

                    jQuery.ajax({
                        url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel +
                            "/prodi/" + id_prodi,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('#id_semester').empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_semester').append('<option value="' + value + '">' +
                                    key + '</option>');
                            });

                            var semester = document.getElementById("id_semester").value;
                            jQuery.ajax({
                                url: "{{ route('guru.materipelajaran.mapel', '') }}" +
                                    "/" + mapel + "/prodi/" + id_prodi + "/semester/" +
                                    semester,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    jQuery('#id_tahun_ajaran').empty();
                                    jQuery.each(data, function(key, value) {
                                        $('#id_tahun_ajaran').append(
                                            '<option value="' + value +
                                            '">' + key + '</option>');
                                    });

                                    var map = document.getElementById("mapel_id").value;

                                    jQuery.ajax({
                                        url: "{{ route('guru.materipelajaran.kelas', '') }}" +
                                            "/" + map,
                                        type: "GET",
                                        dataType: "json",
                                        success: function(data) {
                                            console.log(data);
                                            jQuery('#kelas').empty();
                                            jQuery.each(data, function(key,
                                                value) {
                                                $('#kelas').append(
                                                    '<option value="' +
                                                    value +
                                                    '">' + key +
                                                    '</option>');
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        } else {
            $('select[name="id_prodi"]').empty();
        }

        $(document).on('change', '#mapel_id', function() {
            var jurusan = jQuery(this).val();
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('#id_prodi').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_prodi').append('<option value="' + value + '">' + key +
                                '</option>');
                        });
                        var id_prodi = document.getElementById("id_prodi").value;

                        jQuery.ajax({
                            url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" +
                                jurusan + "/prodi/" + id_prodi,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('#id_semester').empty();
                                jQuery.each(data, function(key, value) {
                                    $('#id_semester').append('<option value="' +
                                        value + '">' + key + '</option>');
                                });

                                var semester = document.getElementById("id_semester").value;
                                jQuery.ajax({
                                    url: "{{ route('guru.materipelajaran.mapel', '') }}" +
                                        "/" + jurusan + "/prodi/" + id_prodi +
                                        "/semester/" + semester,
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        jQuery('#id_tahun_ajaran').empty();
                                        jQuery.each(data, function(key, value) {
                                            $('#id_tahun_ajaran')
                                                .append(
                                                    '<option value="' +
                                                    value + '">' + key +
                                                    '</option>');
                                        });

                                        var mapel_id = document.getElementById(
                                            "mapel_id").value;

                                        jQuery.ajax({
                                            url: "{{ route('guru.materipelajaran.kelas', '') }}" +
                                                "/" + mapel_id,
                                            type: "GET",
                                            dataType: "json",
                                            success: function(data) {
                                                console.log(data);
                                                jQuery('#kelas')
                                                    .empty();
                                                jQuery.each(data,
                                                    function(
                                                        key,
                                                        value) {
                                                        $('#kelas')
                                                            .append(
                                                                '<option value="' +
                                                                value +
                                                                '">' +
                                                                key +
                                                                '</option>'
                                                            );
                                                    });
                                            }
                                        });

                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"]').empty();
            }
        });

        $(document).on('change', '#id_prodi', function() {
            var jurusan = jQuery(this).val();
            var mapel_id = document.getElementById("mapel_id").value;
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id + "/prodi/" +
                        jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('#id_semester').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_semester').append('<option value="' + value + '">' + key +
                                '</option>');
                        });

                        var semester = document.getElementById("id_semester").value;
                        jQuery.ajax({
                            url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" +
                                mapel_id + "/prodi/" + jurusan + "/semester/" + semester,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                jQuery('#id_tahun_ajaran').empty();
                                jQuery.each(data, function(key, value) {
                                    $('#id_tahun_ajaran').append('<option value="' +
                                        value + '">' + key + '</option>');
                                });
                            }
                        });

                    }
                });
            } else {
                $('select[name="id_semester"]').empty();
            }
        });

        $(document).on('change', '#id_semester', function() {
            var semester = jQuery(this).val();
            var mapel_id = document.getElementById("mapel_id").value;
            var id_prodi = document.getElementById("id_prodi").value;
            if (semester) {
                jQuery.ajax({
                    url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id + "/prodi/" +
                        id_prodi + "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('#id_tahun_ajaran').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_tahun_ajaran').append('<option value="' + value + '">' +
                                key + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_tahun_ajaran"]').empty();
            }
        });

        // Select Option Edit
        var jumlah = document.getElementById("jumlah");
        for (let i = 1; i <= jumlah.value; i++) {

            var mapel_id = document.getElementById("mapel_id" + i).value;

            // jQuery.ajax({
            //   url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + mapel_id,
            //   type: "GET",
            //   dataType: "json",
            //   success: function(data) {
            //     jQuery('#kelas'+i).empty();
            //         // let materi = document.getElementById("materipelajaran"+i).value;
            //         // console.log(materi);
            //     jQuery.each(data, function(key, value) {
            //         $('#kelas'+i).append('<option value="' + value + '" >'+ key +'</option>');
            //     });
            //   }
            // });

            if (mapel_id) {
                jQuery.ajax({
                    url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var prodi = document.getElementById('prodi' + i);
                        jQuery('#id_prodi' + i).empty();
                        jQuery.each(data, function(key, value) {
                            if (prodi.value != value) {
                                $('#id_prodi' + i).append('<option value="' + value + '">' + key +
                                    '</option>');
                            } else {
                                $('#id_prodi' + i).append('<option value="' + value + '" selected >' +
                                    key + '</option>');
                            }
                        });

                        var id_prodi = document.getElementById("prodi" + i).value;
                        var mapel = document.getElementById("mapel_id" + i).value;

                        jQuery.ajax({
                            url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel +
                                "/prodi/" + id_prodi,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var semester = document.getElementById('semester' + i);
                                jQuery('#id_semester' + i).empty();
                                jQuery.each(data, function(key, value) {
                                    if (semester.value != value) {
                                        $('#id_semester' + i).append('<option value="' +
                                            value + '">' + key + '</option>');
                                    } else {
                                        $('#id_semester' + i).append('<option value="' +
                                            value + '" selected>' + key + '</option>');
                                    }
                                });

                                var semester = document.getElementById("id_semester" + i).value;
                                jQuery.ajax({
                                    url: "{{ route('guru.materipelajaran.mapel', '') }}" +
                                        "/" + mapel + "/prodi/" + id_prodi + "/semester/" +
                                        semester,
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        var tahun_ajaran = document.getElementById(
                                            'tahun_ajaran' + i);
                                        jQuery('#id_tahun_ajaran' + i).empty();
                                        jQuery.each(data, function(key, value) {
                                            if (tahun_ajaran.value != value) {
                                                $('#id_tahun_ajaran' + i)
                                                    .append('<option value="' +
                                                        value + '">' + key +
                                                        '</option>');
                                            } else {
                                                $('#id_tahun_ajaran' + i)
                                                    .append('<option value="' +
                                                        value + '"selected>' +
                                                        key + '</option>');
                                            }
                                        });

                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"]' + i).empty();
            }

            $(document).on('change', '#mapel_id' + i, function() {
                var jurusan = jQuery(this).val();

                if (jurusan) {
                    jQuery.ajax({
                        url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('#id_prodi' + i).empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_prodi' + i).append('<option value="' + value + '">' +
                                    key + '</option>');
                            });

                            var id_prodi = document.getElementById("id_prodi" + i).value;

                            jQuery.ajax({
                                url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" +
                                    jurusan + "/prodi/" + id_prodi,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    jQuery('#id_semester' + i).empty();
                                    jQuery.each(data, function(key, value) {
                                        $('#id_semester' + i).append(
                                            '<option value="' + value + '">' +
                                            key + '</option>');
                                    });

                                    var semester = document.getElementById("id_semester" +
                                        i).value;
                                    jQuery.ajax({
                                        url: "{{ route('guru.materipelajaran.mapel', '') }}" +
                                            "/" + jurusan + "/prodi/" + id_prodi +
                                            "/semester/" + semester,
                                        type: "GET",
                                        dataType: "json",
                                        success: function(data) {
                                            jQuery('#id_tahun_ajaran' + i)
                                                .empty();
                                            jQuery.each(data, function(key,
                                                value) {
                                                $('#id_tahun_ajaran' +
                                                    i).append(
                                                    '<option value="' +
                                                    value + '">' +
                                                    key +
                                                    '</option>');
                                            });
                                        }
                                    });
                                }
                            });

                        }
                    });
                } else {
                    $('select[name="id_prodi"]' + i).empty();
                }
            });


            $(document).on('change', '#id_prodi' + i, function() {
                var jurusan = jQuery(this).val();
                var mapel_id = document.getElementById("mapel_id" + i).value;
                if (jurusan) {
                    jQuery.ajax({
                        url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id +
                            "/prodi/" + jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('#id_semester' + i).empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_semester' + i).append('<option value="' + value + '">' +
                                    key + '</option>');
                            });

                            var semester = document.getElementById("id_semester" + i).value;
                            jQuery.ajax({
                                url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" +
                                    mapel_id + "/prodi/" + jurusan + "/semester/" + semester,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    jQuery('#id_tahun_ajaran' + i).empty();
                                    jQuery.each(data, function(key, value) {
                                        $('#id_tahun_ajaran' + i).append(
                                            '<option value="' + value + '">' +
                                            key + '</option>');
                                    });
                                }
                            });

                        }
                    });
                } else {
                    $('select[name="id_semester"]' + i).empty();
                }
            });

            $(document).on('change', '#id_semester' + i, function() {
                var semester = jQuery(this).val();
                var mapel_id = document.getElementById("mapel_id" + i).value;
                var id_prodi = document.getElementById("id_prodi" + i).value;
                if (semester) {
                    jQuery.ajax({
                        url: "{{ route('guru.materipelajaran.mapel', '') }}" + "/" + mapel_id +
                            "/prodi/" + id_prodi + "/semester/" + semester,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            jQuery('#id_tahun_ajaran' + i).empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_tahun_ajaran' + i).append('<option value="' + value +
                                    '">' + key + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_tahun_ajaran"]' + i).empty();
                }
            });


        }
    </script>
@endsection
