@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pimpinan
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Pimpinan</li>
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
            <table id="table_data" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="min-w-50px">No</th>
                        <th class="min-w-150px">Nama Fakultas</th>
                        <th class="min-w-150px">Nama Jurusan</th>
                        <th class="min-w-150px">Nama Prodi</th>
                        <th class="min-w-150px">Nama Lengkap</th>
                        <th class="min-w-150px">Posisi</th>
                        <th class="min-w-250px">Periode</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-100px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($data_pimpinan as $pimpinan)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $pimpinan->fakultas->nama_fakultas }}</td>
                            <td>{{ $pimpinan->jurusan->nama_jurusan }}</td>
                            <td>{{ $pimpinan->prodi->nama_program_studi }}</td>
                            <td>{{ $pimpinan->dosen->nama_dosen }}</td>
                            <td>{{ $pimpinan->posisi_jabatan }}</td>
                            <td>
                                {{ $pimpinan->mulai_menjabat }} <b>s/d</b> {{ $pimpinan->akhir_menjabat }}
                            </td>
                            <td>{{ $pimpinan->status == '0' ? 'Tidak Aktif' : 'Aktif' }}
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editpimpinan{{ $pimpinan->id }}"><i
                                        class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('admin.pimpinan.destroy', $pimpinan->id) }}"class="btn btn-sm btn-icon btn-danger"
                                    onclick="return confirm('Yakin Mau di Hapus ?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Modal edit pimpinan-->
                        <div class="modal fade" id="editpimpinan{{ $pimpinan->id }}" tabindex="-1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Pimpinan</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.pimpinan.update', $pimpinan->id) }}" method="post">
                                            @csrf

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Fakultas</label>
                                                <select name="id_fakultas" id="id_fakultas{{ $pimpinan->id }}"
                                                    class="form-control">
                                                    @foreach ($data_fakultas as $fakultas)
                                                        <option value="{{ $fakultas->id }}"
                                                            {{ $fakultas->id == $pimpinan->fakultas_id ? 'selected' : '' }}>
                                                            {{ $fakultas->nama_fakultas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex gap-5 mb-5">
                                                <div class="fv-row w-100 flex-md-root">
                                                    <label class="form-label">Jurusan</label>
                                                    <select name="id_jurusan" id="id_jurusan{{ $pimpinan->id }}"
                                                        class="form-control">
                                                        @foreach ($data_jurusan as $jurusan)
                                                            <option value="{{ $jurusan->id }}"
                                                                {{ $jurusan->id == $pimpinan->jurusan_id ? 'selected' : '' }}>
                                                                {{ $jurusan->nama_jurusan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="fv-row w-100 flex-md-root">
                                                    <label class="form-label">Prodi</label>
                                                    <select name="id_prodi" id="id_prodi{{ $pimpinan->id }}"
                                                        class="form-control">

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="fv-row mb-5">
                                                <label class="form-label">Nama pimpinan</label>
                                                <select name="dosen_id" id="dosen_id{{ $pimpinan->id }}"
                                                    class="form-control">
                                                    @foreach ($data_dosen as $dosen)
                                                        <option value="{{ $dosen->id }}"
                                                            {{ $dosen->id == $pimpinan->dosen_id ? 'selected' : '' }}>
                                                            {{ $dosen->nama_dosen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex flex-wrap gap-5 mb-5">
                                                <div class="fv-row w-100 flex-md-root">
                                                    <label class="form-label">Mulai Menjabat</label>
                                                    <input type="date" name="mulai_menjabat"
                                                        id="mulai_menjabat{{ $pimpinan->id }}" class="form-control"
                                                        value="{{ $pimpinan->mulai_menjabat }}" required>
                                                </div>

                                                <div class="fv-row w-100 flex-md-root">
                                                    <label class="form-label">Akhir Menjabat</label>
                                                    <input type="date" name="akhir_menjabat"
                                                        id="akhir_menjabat{{ $pimpinan->id }}" class="form-control"
                                                        value="{{ $pimpinan->akhir_menjabat }}" required>
                                                </div>
                                            </div>
                                            <div class="fv-row">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="0"
                                                        @if ($pimpinan->status == '0') selected @endif>Tidak Aktif
                                                    </option>
                                                    <option value="1"
                                                        @if ($pimpinan->status == '1') selected @endif>Aktif</option>
                                                </select>
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
                        <!-- Modal end-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.pimpinan.store') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pimpinan</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Fakultas</label>
                        <select name="fakultas_id" id="id_fakultas" class="form-control" required>
                            @foreach ($data_fakultas as $fakultas)
                                <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-5 mb-5">
                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan_id" id="id_jurusan" class="form-control" required>
                                <option value="">== Pilih Jurusan ==</option>
                                @foreach ($data_jurusan as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label">Prodi</label>
                            <select name="prodi_id" id="id_prodi" class="form-control" required>
                                <option value="">== Pilih Prodi ==</option>
                            </select>
                        </div>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama pimpinan</label>
                        <select name="dosen_id" id="dosen_id" class="form-control" data-live-search="true" required>
                            @foreach ($data_dosen as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Posisi Jabatan</label>
                        <input type="text" class="form-control" name="posisi_jabatan"
                            placeholder="Contoh : Ketua Prodi / Ketua Jurusan" required>

                    </div>

                    <div class="d-flex flex-wrap gap-5 mb-5">
                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label">Mulai Menjabat</label>
                            <input type="date" name="mulai_menjabat" id="mulai_menjabat" class="form-control"
                                required>
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label">Akhir Menjabat</label>
                            <input type="date" name="akhir_menjabat" id="akhir_menjabat" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
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
                            targets: 8
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
    <script>
        // Fakultas => Jurusan
        // $(document).on('change', '#id_fakultas', function() {
        //     var id_fakultas = jQuery(this).val();
        //     console.log(id_fakultas);
        //     if (id_fakultas) {
        //         jQuery.ajax({
        //             url: "{{ route('admin.pimpinan.jurusan', '') }}" + "/" + id_fakultas,
        //             type: "GET",
        //             dataType: "json",
        //             success: function(data) {
        //                 console.log(data);
        //                 jQuery('#id_jurusan').empty();
        //                 jQuery.each(data, function(key, value) {
        //                     $('#id_jurusan').append('<option value"' + value + '">' + key + '</option>');
        //                 });
        //             }
        //         });
        //     } else {
        //         $('select[name="id_jurusan"]').empty();
        //     }
        // });

        //Jurusan => Prodi
        $(document).on('change', '#id_jurusan', function() {
            var id_jurusan = jQuery(this).val();
            console.log(id_jurusan);
            if (id_jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.pimpinan.prodi', '') }}" + "/" + id_jurusan,
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
    </script>
@endsection
