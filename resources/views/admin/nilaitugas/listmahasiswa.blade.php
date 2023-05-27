@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Data Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.nilaitugas.index') }}" class="text-muted text-hover-primary">Pilih Matkul</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.nilaitugas.listKelas', ['dosen' => $dosen, 'id' => $mapel_id, 'kelas' => $id_kelas ])}}" class="text-muted text-hover-primary">Pilih Kelas</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.nilaitugas.listTugas', ['dosen' => $dosen, 'id' => $mapel_id, 'kelas' => $id_kelas]) }}" class="text-muted text-hover-primary">Pilih Tugas</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Data Mahasiswa</li>
    </ul>
@endsection


@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Mahasiswa</span>
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
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="min-w-50px">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>File Tugas</th>
                        <th>Tanggal Deadline</th>
                        <th>Nilai Tugas</th>
                        <th>Penilai</th>
                        <th class="text-end min-w-100px">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($data_mahasiswa as $no => $mahasiswa)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                        <td>

                            <?php

                            // $data_upload_tugas = App\Models\HasilTugas::where('siswa_id', $mahasiswa->id)
                            //                     ->where('tugas_id', $tugas_id)->get();

                            // $tugas = App\Models\Tugas::where('id', $tugas_id)->first();

                            $hasil = App\Models\NilaiTugas::where('mahasiswa_id', $mahasiswa->id)
                                ->where('tugas_id', $tugas_id)
                                ->join('users', 'users.id', '=', 'nilai_tugas.created_by')
                                ->first();
                            ?>

                            @foreach ($data_upload_tugas as $upload_tugas)
                                @if ($upload_tugas->siswa_id == $mahasiswa->id)
                                    @php
                                        $path_upload = Storage::url('public/upload/tugas/' . $upload_tugas->nama_file_tugas);
                                    @endphp
                                    <a href="#" target="_blank" class="btn btn-sm btn-success"
                                        data-toggle="modal"
                                        data-target="#uploadTugas{{ $upload_tugas->id }}">
                                        {{ $upload_tugas->nama_file_tugas }}
                                    </a>
                                    <!-- MODAL EDIT UPLOAD-->
                                    <div class="modal fade" id="uploadTugas{{ $upload_tugas->id }}"
                                        data-backdrop="static" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="staticBackdropLabel">File
                                                        yang sudah diupload</h5>
                                                </div>

                                                <div class="modal-body table-responsive">

                                                    <table class="table datatable table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID Upload Tugas</th>
                                                                <th>File Upload</th>
                                                                <th>Tanggal Upload</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $upload_tugas->id }}</td>
                                                                <td>{{ $upload_tugas->nama_file_tugas }}
                                                                </td>
                                                                <td>{{ $upload_tugas->created_at }}</td>
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
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $tugas->tanggal_akhir ?? '' }}</td>

                        <td>

                            @if (isset($hasil))
                                {{ $hasil->nilai_tugas }}
                            @endif

                        </td>
                        <td>

                            @if (isset($hasil))
                                {{ $hasil->user->name }}
                            @else
                                {{-- Belum dinilai --}}
                            @endif
                        </td>
                        <td class="text-end">
                            @can('manage-nilai')
                                @isset($hasil)
                                    <a data-bs-toggle="modal" data-bs-target="#editNilai{{ $mahasiswa->id }}" type="button" class="btn btn-sm btn-warning">Edit Nilai</a>
                                @else
                                    <a data-bs-toggle="modal" data-bs-target="#inputNilai{{ $mahasiswa->id }}" type="button" class="btn btn-sm btn-primary">Input Nilai</a>
                                @endisset
                            @endcan
                        </td>
                    </tr>
                    <!-- MODAL Nilai-->
                    <div class="modal fade" id="inputNilai{{ $mahasiswa->id }}"
                        data-backdrop="static" tabindex="-1" role="dialog"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title"><span class="fa fa-book"></span> Input Nilai Tugas</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <form
                                        action="{{ route('admin.nilaitugas.store', ['dosen' => $dosen, 'id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id, 'mahasiswa' => $mahasiswa->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">Nilai Tugas
                                                ({{ $mahasiswa->nama_mahasiswa }})</label>
                                            <input name="nilai_tugas" type="text" class="form-control"
                                                placeholder="Nilai Tugas">
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

                    <!-- MODAL Edit Nilai-->
                    <div class="modal fade" id="editNilai{{ $mahasiswa->id }}" data-backdrop="static"
                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title"><span class="fa fa-book"></span> Edit Nilai Tugas</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <form
                                        action="{{ route('admin.nilaitugas.update', ['dosen' => $dosen_id, 'id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id, 'mahasiswa' => $mahasiswa->id]) }}"
                                        method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">Nilai Tugas
                                                ({{ $mahasiswa->nama_mahasiswa }})</label>
                                            <input name="nilai_tugas" type="text" class="form-control"
                                                value="{{ $hasil->nilai_tugas ?? 0 }}"
                                                placeholder="Nilai Tugas">
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
