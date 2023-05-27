@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
       Agenda
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('guru.agenda.index')}}" class="text-muted text-hover-primary">Pilih Tahun Ajaran & Semester</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('guru.agenda.prodi', [ 'id_tahun_ajaran' => $tahun_ajaran->id ,'id_semester' => $semester->id])}}" class="text-muted text-hover-primary">Pilih Prodi</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Agenda</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2 mb-1">Data Matkul</span>
                {{ $tahun_ajaran->nama_tahun_ajaran }} / {{ $semester->nama_semester }} - {{ $prodi->nama_program_studi }}
            </h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search" class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="min-w-50px">No</th>
                        <th>Mata Kuliah</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th class="text-end min-w-80px">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($data_agenda as $agenda)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $agenda->nama_mapel }}</td>
                            <td>{{ $agenda->tahun_ajaran }}</td>
                            <td>{{ $agenda->semester }}</td>
                            <td class="text-end">
                                @role('dosen')
                                    <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editAgenda{{ $agenda->id }}">Edit</a>
                                    <a href="{{ route('guru.agenda.edit', ['id_tahun_ajaran' => $tahun_ajaran->id, 'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'id' => $agenda->id]) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                @endrole
                            </td>
                        </tr>

                        <!-- MODAL EDIT JADWAL UJIAN-->
                        <div class="modal fade" id="editAgenda{{ $agenda->id }}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Agenda</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('guru.agenda.update', ['id' => $agenda->id]) }}"
                                            method="post">
                                            @csrf

                                                <input type="text" name="id_prodi" value="{{ $prodi->id_prodi }}"
                                                    hidden>
                                                <div class="fv-row mb-5">
                                                    <label class="form-label">Mata Kuliah</label>
                                                    <select name="mapel_id" class="form-control" data-live-search="true"
                                                        required>
                                                        @foreach ($mapel as $map)
                                                            <option value="{{ $map->mapel_id }}"
                                                                {{ $agenda->mapel_id == $map->mapel_id ? 'selected' : '' }}>
                                                                {{ $map->nama_mapel }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label">Tahun Ajaran</label>
                                                    <select name="tahun_ajaran" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="{{ $tahun_ajaran->nama_tahun_ajaran }}"
                                                            {{ $agenda->tahun_ajaran == $tahun_ajaran->nama_tahun_ajaran ? 'selected' : '' }}>
                                                            {{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                                                    </select>
                                                </div>

                                                <div class="fv-row">
                                                    <label class="form-label">Semester</label>
                                                    <select name="semester" class="form-control" data-live-search="true"
                                                        required>

                                                        <option value="{{ $semester->nama_semester }}"
                                                            {{ $agenda->semester == $semester->nama_semester ? 'selected' : '' }}>
                                                            {{ $semester->nama_semester }}</option>

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
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('guru.agenda.store') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Agenda</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <input type="text" name="id_prodi" value="{{ $prodi->id_prodi }}" hidden>
                    <div class="fv-row mb-5">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mapel_id" class="form-control" data-live-search="true" required>
                            @foreach ($mapel as $map)
                                <option value="{{ $map->mapel_id }}"> {{ $map->nama_mapel }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control" data-live-search="true" required>

                            <option value="{{ $tahun_ajaran->nama_tahun_ajaran }}">
                                {{ $tahun_ajaran->nama_tahun_ajaran }}</option>

                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-control" data-live-search="true" required>
                            <option value="{{ $semester->nama_semester }}">{{ $semester->nama_semester }}</option>
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
                            targets: 4
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
