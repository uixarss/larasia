@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Tugas
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Tugas</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Tugas</span>
            </h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                <div class="bullet bg-secondary h-35px w-1px mx-3"></div>
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="min-w-50px">No</th>
                        <th class="min-w-150px">Program Studi</th>
                        <th class="min-w-100px">Semester</th>
                        <th class="min-w-150px">Tahun Ajaran</th>
                        <th class="min-w-150px">Mata Kuliah</th>
                        <th class="min-w-150px">Kode Tugas</th>
                        <th class="min-w-150px">Nama Tugas</th>
                        <th class="min-w-250px">Deskripsi Tugas</th>
                        <th class="min-w-150px">Tanggal Mulai</th>
                        <th class="min-w-150px">Deadline</th>
                        <th class="min-w-150px">Kelas</th>
                        <th class="min-w-150px">File Tugas</th>
                        <th class="min-w-150px text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @php
                        $i = 1;
                        $j = 0;
                    @endphp
                    @foreach ($data_tugas as $tugas)
                        @php $j++; @endphp
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $tugas->prodi->nama_program_studi }}</td>
                            <td>{{ $tugas->semester->nama_semester }}</td>
                            <td>{{ $tugas->tahunAjaran->nama_tahun_ajaran }}</td>
                            <td>{{ $tugas->mapel->nama_mapel }}</td>
                            <td>{{ $tugas->kode_tugas }}</td>
                            <td>{{ $tugas->judul_tugas }}</td>
                            <td>{{ $tugas->deskripsi_tugas }}</td>
                            <td>
                                <span class="badge badge-secondary">
                                    {{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('d M Y H:i:s') }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-danger">
                                    {{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('d M Y H:i:s') }}
                                </span>
                            </td>
                            <td>
                                @foreach ($tugas->kelas as $kelas)
                                    <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                @endforeach
                            </td>
                            <td>
                                @php
                                    $path = Storage::url('public/tugas/' . $tugas->nama_file_tugas);
                                @endphp
                                <a href="{{ route('guru.tugas.download', ['id' => $tugas->id, 'path_tugas' => $path]) }}" class="btn btn-success btn-sm" target="_blank">Download File</a>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTugas{{ $j }}">Edit</a>
                                <a href="{{ route('guru.tugas.destroy', ['id' => $tugas->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            </td>
                        </tr>


                        <!-- Modal EDIT-->
                        <div class="modal fade" id="editTugas{{ $j }}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Tugas</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('guru.tugas.update', ['id' => $tugas->id]) }}"
                                            method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf

                                            <input name="prodi" id="prodi{{ $j }}" type="text"
                                                value="{{ $tugas->id_prodi }}" hidden>
                                            <input name="semester" id="semester{{ $j }}" type="text"
                                                value="{{ $tugas->id_semester }}" hidden>
                                            <input name="tahun_ajaran" id="tahun_ajaran{{ $j }}" type="text"
                                                value="{{ $tugas->id_tahun_ajaran }}" hidden>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Mata Kuliah</label>
                                                <select name="mapel_id" id="mapel_id{{ $j }}"
                                                    class="form-control" required>

                                                    @foreach ($jenis_mapel as $map)
                                                        <option value="{{ $map->mapel_id }}"
                                                            {{ $tugas->mapel_id == $map->mapel_id ? 'selected' : '' }}>
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
                                                <select name="id_semester" id="id_semester{{ $j }}"
                                                    class="form-control" required>
                                                    <option value="">== Pilih Semester ==</option>
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <select name="id_tahun_ajaran" id="id_tahun_ajaran{{ $j }}"
                                                    class="form-control" required>
                                                    <option value="">== Pilih Tahun Ajaran ==</option>
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label for="exampleInputEmail1">Kode Tugas</label>
                                                <input name="kode_tugas" type="texts" class="form-control"
                                                    value="{{ $tugas->kode_tugas }}" placeholder="Kode Tugas">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label for="exampleInputEmail1">Judul Tugas</label>
                                                <input name="judul_tugas" type="text" class="form-control"
                                                    value="{{ $tugas->judul_tugas }}" placeholder="Judul Tugas">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label for="exampleInputEmail1">Deksripsi Tugas</label>
                                                <input name="deskripsi_tugas" type="text" class="form-control"
                                                    value="{{ $tugas->deskripsi_tugas }}" placeholder="Deskripsi Tugas">
                                            </div>

                                            <div class="fv-row mb-5">

                                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                                <input name="tanggal_mulai" type="datetime-local" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('Y-m-d\TH:i') }}"
                                                    placeholder="Tanggal Mulai">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label for="exampleInputEmail1">Deadline</label>
                                                <input name="tanggal_akhir" type="datetime-local" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('Y-m-d\TH:i') }}"
                                                    placeholder="Deadline">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label for="exampleInputEmail1">Kelas</label>
                                                <select name="id_kelas[]" id="kelas{{ $j }}" multiple
                                                    class="form-control" required>
                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                    <script>
                                                        jQuery.ajax({
                                                            url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + {{ $tugas->mapel_id }},
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
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Unggah Materi</label>
                                                <input type="file" name="file_tugas" class="form-control"/>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL Tambah-->
    <div class="modal fade" id="tambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Tugas Baru</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="fv-row mb-5">
                            <label class="form-label">Mata Kuliah</label>
                            <select name="mapel_id" id="mapel_id" class="form-control" required>
                                @foreach ($jenis_mapel as $mapel)
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
                            <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control" required>
                                <option value="">== Pilih Tahun Ajaran ==</option>
                            </select>
                        </div>

                        <div class="fv-row mb-5">
                            <label for="exampleInputEmail1">Kode Tugas</label>
                            <input name="kode_tugas" type="texts" class="form-control" placeholder="Kode Tugas">
                        </div>

                        <div class="fv-row mb-5">
                            <label for="exampleInputEmail1">Judul Tugas</label>
                            <input name="judul_tugas" type="text" class="form-control" placeholder="Judul Tugas">
                        </div>

                        <div class="fv-row mb-5">
                            <label for="exampleInputEmail1">Deksripsi Tugas</label>
                            <input name="deskripsi_tugas" type="text" class="form-control"
                                placeholder="Deskripsi Tugas">
                        </div>

                        <div class="fv-row mb-5">

                            <label for="exampleInputEmail1">Tanggal Mulai</label>
                            <input name="tanggal_mulai" type="datetime-local" class="form-control"
                                placeholder="Tanggal Mulai">
                        </div>

                        <div class="fv-row mb-5">
                            <label for="exampleInputEmail1">Deadline</label>
                            <input name="tanggal_akhir" type="datetime-local" class="form-control"
                                placeholder="Deadline">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Masukan Kelas</label>
                            <select name="id_kelas[]" id="kelas" multiple class="form-control" required>
                            </select>
                        </div>

                        <div class="fv-row">
                            <label class="form-label">Unggah Materi</label>
                            <input type="file" multiple id="file-simple" name="file_tugas" class="form-control"/>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL Tambah -->

    <input id="jumlah" name="jumlah" type="text" value="{{ $jumlah }}" hidden>
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
                            targets: 11
                        },
                        {
                            orderable: false,
                            targets: 12
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
