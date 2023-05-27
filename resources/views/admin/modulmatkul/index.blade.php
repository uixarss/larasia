@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Modul Mata Kuliah
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Modul Mata Kuliah <input id="jumlah" name="jumlah" type="text"
                value="{{ $jumlah }}" hidden></li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Modul Mata Kuliah</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
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
                        <th>Jurusan</th>
                        <th>Program Studi</th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    <?php
                    $no = 1;
                    $jur = 1;
                    $pro = 1;
                    $pr = 1;
                    ?>
                    @foreach ($modul_matkul as $modul_matkul)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $modul_matkul->nama_jurusan }}</td>
                            <td>{{ $modul_matkul->nama_program_studi }}</td>
                            <td>{{ $modul_matkul->nama_mapel }}</td>
                            <td>{{ $modul_matkul->nama_semester }}</td>
                            <td>{{ $modul_matkul->nama_tahun_ajaran }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModul{{ $modul_matkul->id }}">Edit</a>
                                <a href="{{ route('admin.modulmatkul.destroy', ['id' => $modul_matkul->id]) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            </td>
                        </tr>

                        <!-- MMODAL EDIT MATA PELAJARAN-->
                        <div class="modal fade" id="editModul{{ $modul_matkul->id }}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Mata Kuliah</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.modulmatkul.update', $modul_matkul->id) }}"
                                            method="post">
                                            @csrf

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jurusan</label>
                                                <select id="id_jurusan{{ $jur++ }}" name="id_jurusan"
                                                    class="form-control" data-live-search="true" required>
                                                    @foreach ($data_jurusan as $jurusan)
                                                        <option
                                                            value="{{ $jurusan->id }}"{{ $jurusan->id == $modul_matkul->id_jurusan ? 'selected' : '' }}>
                                                            {{ $jurusan->nama_jurusan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input name="prodi" id="prodi{{ $pr++ }}" type="text"
                                                value="{{ $modul_matkul->id_prodi }}" hidden>
                                            <div class="fv-row mb-5">
                                                <label class="form-label">Prodi</label>
                                                <select name="id_prodi" id="id_prodi{{ $pro++ }}"
                                                    class="form-control">
                                                    <option value="">== Pilih Prodi ==</option>
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="">Mata Kuliah</label>
                                                <select name="id_matkul" class="form-control" data-live-search="true"
                                                    required>
                                                    @foreach ($data_matkul as $matkul)
                                                        <option value="{{ $matkul->id }}"
                                                            {{ $matkul->id == $modul_matkul->id_matkul ? 'selected' : '' }}>
                                                            {{ $matkul->nama_mapel }} - {{ $matkul->jumlah_sks }} SKS
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="">Semester</label>
                                                <select name="id_semester" class="form-control" data-live-search="true"
                                                    required>
                                                    @foreach ($data_semester as $semester)
                                                        <option value="{{ $semester->id }}"
                                                            {{ $semester->id == $modul_matkul->id_semester ? 'selected' : '' }}>
                                                            {{ $semester->nama_semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="fv-row">
                                                <label class="form-label" for="">Tahun Ajaran</label>
                                                <select name="id_tahun_ajaran" class="form-control" data-live-search="true"
                                                    required>
                                                    @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                                        <option
                                                            value="{{ $tahun_ajaran->id }}"{{ $tahun_ajaran->id == $modul_matkul->id_tahun_ajaran ? 'selected' : '' }}>
                                                            {{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                                                    @endforeach
                                                </select>
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
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.modulmatkul.create') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Mata Kuliah</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="exampleInputEmail1">Jurusan</label>
                        <select id="id_jurusan" name="id_jurusan" class="form-control" data-live-search="true" required>
                            @foreach ($data_jurusan as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-control">
                            <option value="">== Pilih Prodi ==</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="">Mata Kuliah</label>
                        <select id="id_matkul" name="id_matkul" class="form-control" data-live-search="true" required>
                            @foreach ($data_matkul as $matkul)
                                <option value="{{ $matkul->id }}">{{ $matkul->nama_mapel }} -
                                    {{ $matkul->jumlah_sks }} SKS</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="">Semester</label>
                        <select id="id_semester" name="id_semester" class="form-control" data-live-search="true"
                            required>
                            @foreach ($data_semester as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->nama_semester }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="">Tahun Ajaran</label>
                        <select id="id_tahun_ajaran" name="id_tahun_ajaran" class="form-control" data-live-search="true"
                            required>
                            @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->nama_tahun_ajaran }}</option>
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
        //Jurusan & Prodi

        $(document).on('change', '#id_jurusan', function() {
            var id_jurusan = jQuery(this).val();
            console.log(id_jurusan);
            if (id_jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.modulmatkul.prodi', '') }}" + "/" + id_jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#id_prodi').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_prodi').append('<option value="' + value + '">' + key +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"]').empty();
            }
        });

        var myInput2 = document.getElementById("id_jurusan");
        var prodi = document.getElementById("id_prodi");
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.modulmatkul.prodi', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        jQuery('#id_prodi').empty();
                        jQuery.each(data, function(key, value) {
                            if (prodi.value != value) {
                                $('#id_prodi').append('<option value="' + value + '" >' + key +
                                    '</option>');
                            } else {
                                $('#id_prodi').append('<option value="' + value + '" selected >' + key +
                                    '</option>');
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"]').empty();
            }
        }

        var jumlah = document.getElementById("jumlah");
        for (let i = 1; i <= jumlah.value; i++) {
            $(document).on('change', '#id_jurusan' + i + '', function() {
                var id_jurusan = jQuery(this).val();
                if (id_jurusan) {
                    jQuery.ajax({
                        url: "{{ route('admin.modulmatkul.prodi', '') }}" + "/" + id_jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('#id_prodi' + i + '').empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_prodi' + i + '').append('<option value="' + value +
                                    '">' + key + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_prodi' + i + '"]').empty();
                }
            });

            var myInput2 = document.getElementById("id_jurusan" + i);
            // console.log(prodi.id);
            if (myInput2 && myInput2.value) {
                var jurusan = myInput2.value;
                if (jurusan) {
                    values = prodi.value;
                    jQuery.ajax({
                        url: "{{ route('admin.modulmatkul.prodi', '') }}" + "/" + jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var prodi = document.getElementById('prodi' + i);
                            jQuery('#id_prodi' + i).empty();
                            jQuery.each(data, function(key, value) {
                                if (prodi.value != value) {
                                    $('#id_prodi' + i).append('<option value="' + value + '" >' + key +
                                        '</option>');
                                } else {
                                    $('#id_prodi' + i).append('<option value="' + value +
                                        '" selected >' + key + '</option>');
                                }
                            });
                        }
                    });
                } else {
                    $('select[name="id_prodi"' + i + ']').empty();
                }
            }

        }
    </script>
@endsection
