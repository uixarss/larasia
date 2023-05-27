@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Jadwal Dosen
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Jadwal Dosen</li>
    </ul>
@endsection


@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Jadwal</span>
            </h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                    Jadwal</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="min-w-50px">No</th>
                        <th class="min-w-150px">Tahun Ajaran</th>
                        <th class="min-w-150px">Semester</th>
                        <th class="min-w-250px">Prodi</th>
                        <th class="min-w-100px">Hari</th>
                        <th class="min-w-200px">Jam</th>
                        <th class="min-w-150px">Mata Kuliah</th>
                        <th class="min-w-150px">Dosen</th>
                        <th class="min-w-150px">Kelas</th>
                        <th class="min-w-150px">Ruangan</th>
                        <th class="min-w-200px text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($data_jadwal as $no => $jadwal)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $jadwal->tahunajaran->nama_tahun_ajaran }}</td>
                            <td>{{ $jadwal->semester->nama_semester }}</td>
                            <td>{{ $jadwal->prodi->nama_program_studi ?? '' }}</td>
                            <td>{{ $jadwal->hari->hari }}</td>
                            <td>{{ $jadwal->waktu->jam_masuk }} - {{ $jadwal->waktu->jam_keluar }}</td>
                            <td>{{ $jadwal->mapel->nama_mapel }}</td>
                            <td>{{ $jadwal->dosen->nama_dosen ?? '' }}</td>
                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                            <td>{{ $jadwal->ruang->nama_ruangan ?? '' }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editJadwal{{ $jadwal->id }}"><i
                                        class="bi bi-pencil-square"></i>Edit</a>
                                <a href="{{ route('admin.jadwal.kelas.delete', ['id' => $jadwal->id]) }}"
                                    class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i>Delete</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editJadwal{{ $jadwal->id }}" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Jadwal Kelas</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>

                                    <div class="modal-body">

                                        <form action="{{ route('admin.jadwal.kelas.update', ['id' => $jadwal->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="tahun_ajaran_id">Tahun Ajaran</label>
                                                    <select name="tahun_ajaran_id" class="form-control"
                                                        data-live-search="true" required>
                                                        <option value="">-Masukan Tahun Ajaran-</option>

                                                        @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                                            <option value="{{ $tahun_ajaran->id }}"
                                                                {{ $tahun_ajaran->id == $jadwal->tahun_ajaran_id ? 'selected' : ' ' }}>
                                                                {{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="nama_kelas">Semester</label>
                                                    <select name="semester_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Semester-</option>

                                                        @foreach ($data_semester as $semester)
                                                            <option value="{{ $semester->id }}"
                                                                {{ $semester->id == $jadwal->semester_id ? 'selected' : ' ' }}>
                                                                {{ $semester->nama_semester }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="nama_kelas">Program Studi</label>
                                                    <select name="prodi_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Program Studi-</option>

                                                        @foreach ($data_prodi as $prodi)
                                                            <option value="{{ $prodi->id_prodi }}"
                                                                {{ $prodi->id_prodi == $jadwal->prodi_id ? 'selected' : ' ' }}>
                                                                {{ $prodi->nama_program_studi ?? '' }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="kelas_id">Kelas</label>
                                                    <select name="kelas_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Kelas-</option>

                                                        @foreach ($data_kelas as $kelas)
                                                            <option value="{{ $kelas->id }}"
                                                                {{ $kelas->id == $jadwal->kelas_id ? 'selected' : ' ' }}>
                                                                {{ $kelas->nama_kelas }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="kelas_id">Ruangan</label>
                                                    <select name="ruangan_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Ruangan-</option>

                                                        @foreach ($data_ruangan as $ruangan)
                                                            <option value="{{ $ruangan->id }}"
                                                                {{ $ruangan->id == $jadwal->ruangan_id ? 'selected' : ' ' }}>
                                                                {{ $ruangan->nama_ruangan }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="guru_id">Dosen</label>
                                                    <select name="guru_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Dosen-</option>

                                                        @foreach ($data_guru as $guru)
                                                            <option value="{{ $guru->id }}"
                                                                {{ $guru->id == $jadwal->id_dosen ? 'selected' : ' ' }}>
                                                                {{ $guru->nama_dosen }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="mapel_id">Mata Kuliah</label>
                                                    <select name="mapel_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Mata Kuliah-</option>

                                                        @foreach ($data_mapel as $mapel)
                                                            <option value="{{ $mapel->id }}"
                                                                {{ $mapel->id == $jadwal->mapel_id ? 'selected' : ' ' }}>
                                                                {{ $mapel->nama_mapel }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="fv-row mb-5">
                                                    <label class="form-label" for="hari_id">Hari</label>
                                                    <select name="hari_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Hari-</option>

                                                        @foreach ($data_hari as $hari)
                                                            <option value="{{ $hari->id }}"
                                                                {{ $hari->id == $jadwal->hari_id ? 'selected' : ' ' }}>
                                                                {{ $hari->hari }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="fv-row">
                                                    <label class="form-label" for="waktu_id">Waktu</label>
                                                    <select name="waktu_id" class="form-control" data-live-search="true"
                                                        required>
                                                        <option value="">-Masukan Waktu-</option>

                                                        @foreach ($data_waktu as $waktu)
                                                            <option value="{{ $waktu->id }}"
                                                                {{ $waktu->id == $jadwal->waktu_id ? 'selected' : ' ' }}>
                                                                {{ $waktu->jam_masuk }} -
                                                                {{ $waktu->jam_keluar }}</option>
                                                        @endforeach

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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('admin.jadwal.create')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jadwal Kelas</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Tahun Ajaran-</option>
                            @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->nama_tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Semester</label>
                        <select name="semester_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Semester-</option>

                            @foreach ($data_semester as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->nama_semester }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Program Studi</label>
                        <select name="prodi_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Program Studi-</option>

                            @foreach ($data_prodi as $prodi)
                                <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_program_studi }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Kelas</label>
                        <select name="kelas_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Kelas-</option>

                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Ruangan</label>
                        <select name="ruangan_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Ruangan-</option>

                            @foreach ($data_ruangan as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Dosen</label>
                        <select name="guru_id" class="form-control" data-live-search="true" required>
                            <option value="">-Masukan Dosen-</option>

                            @foreach ($data_guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama_dosen }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Mata Kuliah</label>
                        <select name="mapel_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Mata Kuliah-</option>

                            @foreach ($data_mapel as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Hari</label>
                        <select name="hari_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Hari-</option>

                            @foreach ($data_hari as $hari)
                                <option value="{{ $hari->id }}">{{ $hari->hari }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Masukan Waktu</label>
                        <select name="waktu_id" class="form-control " data-live-search="true" required>
                            <option value="">-Masukan Waktu-</option>

                            @foreach ($data_waktu as $waktu)
                                <option value="{{ $waktu->id }}">{{ $waktu->jam_masuk }} -
                                    {{ $waktu->jam_keluar }}</option>
                            @endforeach

                        </select>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check" {{ $data_jadwal->count() > 0 ? 'disabled' : '' }}></i>
                        Tambah
                    </button>
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

            return {
                // Public functions
                init: function() {
                    if (!table) {
                        return;
                    }

                    initDataTable();

                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            ListData.init();
        });
    </script>
@endsection
