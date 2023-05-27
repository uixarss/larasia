@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Tugas Mahasiswa
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Tugas</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                id="table_data">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="rounded-start">Nama Dosen</th>
                        <th>Mata Kuliah</th>
                        <th>Judul Tugas</th>
                        <th>Deskripsi Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>File Upload Tugas</th>
                        <th class="text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_tugas as $tugas)
                        @foreach ($tugas->kelas as $kelas)
                            @if ($mahasiswa->kelas_id == $kelas->id)
                                <tr>
                                    <td>{{ $tugas->dosen->nama_dosen }}</td>
                                    <td>{{ $tugas->mapel->nama_mapel }}</td>
                                    <td>{{ $tugas->judul_tugas }}</td>
                                    <td>{{ $tugas->deskripsi_tugas }}</td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('d M Y H:i:s') }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($data_upload_tugas as $upload_tugas)
                                            @if ($upload_tugas->tugas_id == $tugas->id)
                                                @php
                                                    $path_upload = Storage::url('public/upload/tugas/' . $upload_tugas->nama_file_tugas);
                                                @endphp
                                                <a href="#" target="_blank" class="btn btn-sm btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#uploadTugas{{ $upload_tugas->id }}">
                                                    {{ $upload_tugas->nama_file_tugas }}
                                                </a>
                                                <!-- MODAL EDIT UPLOAD-->
                                                <div class="modal fade" id="uploadTugas{{ $upload_tugas->id }}"
                                                    data-backdrop="static" tabindex="-1" role="dialog"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h3 class="modal-title">File yang sudah diupload</h3>
                                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i class="bi bi-x-lg fs-3"></i>
                                                                </div>
                                                            </div>

                                                            <div class="modal-body table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead class="bg-light">
                                                                        <tr>
                                                                            <th>ID Upload Tugas</th>
                                                                            <th>File Upload</th>
                                                                            <th>Download</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{ $upload_tugas->id }}</td>
                                                                            <td>{{ $upload_tugas->nama_file_tugas }}</td>
                                                                            <td>
                                                                                <a href="{{ url($path_upload) }}"
                                                                                    class="btn btn-sm btn-success"
                                                                                    target="_blank"
                                                                                    rel="noopener noreferrer">Download</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $path = Storage::url('public/tugas/' . $tugas->nama_file_tugas);
                                        @endphp
                                        <a href="{{ route('tugas.download', ['id' => $tugas->id, 'path_tugas' => $path]) }}"
                                            class="btn btn-sm btn-info" target="_blank"><span
                                                class="fa fa-cloud-download"></span></a>
                                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#unggahTugas{{ $tugas->id }}"><span
                                                class="fa fa-cloud-upload"></span></a>
                                    </td>
                                </tr>
                                <!-- MODAL TAMBAH MAPEL-->
                                <div class="modal fade" id="unggahTugas{{ $tugas->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title"><span class="fa fa-cloud-upload"></span> Upload
                                                    Tugasmu Disini</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('siswa.upload.tugas', ['id' => $tugas->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="file_tugas" id="file_tugas"
                                                        class="form-control" required>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @foreach ($data_ekstensi as $ekstensi)
                                @if ($ekstensi->kelas_id == $kelas->id)
                                    <tr>
                                        <td>{{ $tugas->dosen->nama_dosen }}</td>
                                        <td>{{ $tugas->mapel->nama_mapel }}</td>
                                        <td>{{ $tugas->judul_tugas }}</td>
                                        <td>{{ $tugas->deskripsi_tugas }}</td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                {{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger">
                                                {{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('d M Y H:i:s') }}
                                            </span>
                                        </td>
                                        <td>
                                            @foreach ($data_upload_tugas as $upload_tugas)
                                                @if ($upload_tugas->tugas_id == $tugas->id)
                                                    @php
                                                        $path_upload = Storage::url('public/upload/tugas/' . $upload_tugas->nama_file_tugas);
                                                    @endphp
                                                    <a href="#" target="_blank" class="btn btn-sm btn-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#uploadTugas{{ $upload_tugas->id }}">
                                                        {{ $upload_tugas->nama_file_tugas }}
                                                    </a>
                                                    <!-- MODAL EDIT UPLOAD-->
                                                    <div class="modal fade" id="uploadTugas{{ $upload_tugas->id }}"
                                                        data-backdrop="static" tabindex="-1" role="dialog"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title">File yang sudah diupload</h3>
                                                                    <div class="btn btn-icon btn-sm btn-danger ms-2"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="bi bi-x-lg fs-3"></i>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-body table-responsive">
                                                                    <table class="table datatable table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID Upload Tugas</th>
                                                                                <th>File Upload</th>
                                                                                <th>Download</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{ $upload_tugas->id }}</td>
                                                                                <td>{{ $upload_tugas->nama_file_tugas }}
                                                                                </td>
                                                                                <td>
                                                                                    <a href="{{ url($path_upload) }}"
                                                                                        class="btn btn-sm btn-success"
                                                                                        target="_blank"
                                                                                        rel="noopener noreferrer">Download</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $path = Storage::url('public/tugas/' . $tugas->nama_file_tugas);
                                            @endphp
                                            <a href="{{ route('tugas.download', ['id' => $tugas->id, 'path_tugas' => $path]) }}"
                                                class="btn btn-sm btn-info" target="_blank"><span
                                                    class="fa fa-cloud-download"></span></a>
                                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#unggahTugas{{ $tugas->id }}"><span
                                                    class="fa fa-cloud-upload"></span></a>
                                        </td>
                                    </tr>
                                    <!-- MODAL TAMBAH MAPEL-->
                                    <div class="modal fade" id="unggahTugas{{ $tugas->id }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="staticBackdropLabel">Upload Tugas</h5>
                                                </div>

                                                <div class="modal-body">
                                                    <h3><span class="fa fa-cloud-upload"></span> Upload Tugasmu Disini</h3>
                                                    <form
                                                        action="{{ route('siswa.upload.tugas', ['id' => $tugas->id]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="file_tugas" id="file_tugas" required>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                    "pageLength": 100,
                    "lengthChange": false,
                    "info": true,
                    'columnDefs': [{
                        orderable: false,
                        targets: 7,
                        className: 'dt-body-right'
                    }, {
                        orderable: false,
                        targets: 6,
                    }]
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
