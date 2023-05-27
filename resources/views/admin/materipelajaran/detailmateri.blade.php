@extends('layouts.adtheme')

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item">
                    <a class="nav-link active text-active-primary py-5" data-bs-toggle="tab" href="#materi">Materi
                        Pelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#tugas">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#kuis">Kuis</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="materi" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-2x mb-1">Materi Pelajaran</span>
                        </h3>

                        <div class="d-flex align-items-center my-2">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_materi"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_materi">Tambah</button>
                        </div>
                    </div>
                    <table id="table_materi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>BAB Materi</th>
                                <th>Nama Materi</th>
                                <th>Deskripsi</th>
                                <th>Kelas</th>
                                <th>Tanggal Unggah</th>
                                <th>Terunduh</th>
                                <th>File Materi</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @php
                                $i = 1;
                                $j = 0;
                            @endphp
                            @foreach ($data_materi_pelajaran as $materi_pelajaran)
                                @php $j++; @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $materi_pelajaran->mapel->nama_mapel }}</td>
                                    <td>{{ $materi_pelajaran->bab_materi }}</td>
                                    <td>{{ $materi_pelajaran->nama_materi }}</td>
                                    <td>{{ $materi_pelajaran->deskripsi_materi }}</td>
                                    <td>
                                        @foreach ($materi_pelajaran->kelas as $kelas)
                                            <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                        @endforeach

                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ \Carbon\Carbon::parse($materi_pelajaran->created_at)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>{{ $materi_pelajaran->jumlah_unduh }} kali unduh</td>
                                    <td>
                                        @php
                                            $path = Storage::url('public/dokumen/' . $materi_pelajaran->file_materi);
                                        @endphp
                                        <span class="badge badge-info">{{ $materi_pelajaran->file_materi }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('unduh.dokumen', ['path' => $path, 'id' => $materi_pelajaran->id]) }}"
                                            class="btn btn-sm btn-info btn-sm" target="_blank">Download File</a>
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMateri{{ $j }}">Edit</a>
                                        <a href="{{ route('admin.materipelajaran.destroy', ['id' => $materi_pelajaran->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>

                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editMateri{{ $j }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    action="{{ route('admin.materipelajaran.update', ['id' => $materi_pelajaran->id, 'id_dosen' => $id_dosen]) }}"
                                                    method="POST" class="form-horizontal">
                                                    @csrf

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
                                                        <input name="deskripsi_materi" type="text" class="form-control"
                                                            value="{{ $materi_pelajaran->deskripsi_materi }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Kelas</label>
                                                        <select name="id_kelas[]" multiple class="form-control" required>
                                                            @php
                                                                $materi_kelas = $materi_pelajaran->kelas;
                                                            @endphp
                                                            @foreach ($data_kelas as $kelas)
                                                                <option value="{{ $kelas->kelas_id }}"
                                                                    {{ $materi_kelas->where('id', $kelas->kelas_id)->first() ? 'selected' : '' }}>
                                                                    {{ $kelas->nama_kelas }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Unggah Materi</label>
                                                        <input type="file" name="file_materi" class="form-control"/>
                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_materi">
                        <div class="modal-dialog">
                            <form class="modal-content"
                                action="{{ route('admin.materipelajaran.store', [
                                    'id' => $id_dosen,
                                    'mapel' => $mapel_id,
                                    'id_prodi' => $id_prodi,
                                    'semester' => $semester,
                                    'tahun_ajaran' => $tahun_ajaran,
                                ]) }}"
                                method="post" enctype="multipart/form-data">
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
                                        <label class="form-label" class="control-label">Masukan Kelas</label>
                                        <select name="id_kelas[]" multiple class="form-control" required>
                                            @foreach ($data_kelas as $kelas)
                                                <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Unggah Materi</label>
                                        <input type="file" multiple id="file-simple" name="file_materi" class="form-control"/>
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
                <div class="tab-pane fade" id="tugas" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-2x mb-1">Tugas</span>
                        </h3>
                        <div class="d-flex align-items-center my-2">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_tugas"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_tugas">Tambah</button>
                        </div>
                    </div>
                    <table id="table_tugas"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Kode Tugas</th>
                                <th>Nama Tugas</th>
                                <th>Deskripsi Tugas</th>
                                <th>Kelas</th>
                                <th>Tanggal Mulai</th>
                                <th>Deadline</th>
                                <th>File Tugas</th>
                                <th class="min-w-200px text-end">Opsi</th>
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
                                    <td>{{ $tugas->mapel->nama_mapel }}</td>
                                    <td>{{ $tugas->kode_tugas }}</td>
                                    <td>{{ $tugas->judul_tugas }}</td>
                                    <td>{{ $tugas->deskripsi_tugas }}</td>
                                    <td>
                                        @foreach ($tugas->kelas as $kelas)
                                            <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $path = Storage::url('public/tugas/' . $tugas->nama_file_tugas);
                                        @endphp
                                        <span class="badge badge-info">{{ $tugas->nama_file_tugas }}</span>
                                    </td>


                                    <td class="text-end">
                                        <a href="{{ route('tugas.download', ['path_tugas' => $path, $tugas->id]) }}"
                                            class="btn btn-info btn-sm" target="_blank">Download File</a>
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editTugas{{ $j }}">Edit</a>
                                        <a href="{{ route('admin.materipelajaran.tugasDestroy', ['id' => $tugas->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editTugas{{ $j }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Tugas</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.materipelajaran.updateTugas', ['id' => $tugas->id, 'id_dosen' => $tugas->created_by]) }}"
                                                    method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Kode Tugas</label>
                                                        <input name="kode_tugas" type="texts" class="form-control"
                                                            value="{{ $tugas->kode_tugas }}" placeholder="Kode Tugas">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Judul Tugas</label>
                                                        <input name="judul_tugas" type="text" class="form-control"
                                                            value="{{ $tugas->judul_tugas }}" placeholder="Judul Tugas">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Deksripsi Tugas</label>
                                                        <input name="deskripsi_tugas" type="text" class="form-control"
                                                            value="{{ $tugas->deskripsi_tugas }}"
                                                            placeholder="Deskripsi Tugas">
                                                    </div>

                                                    <div class="fv-row mb-5">

                                                        <label class="form-label">Tanggal Mulai</label>
                                                        <input name="tanggal_mulai" type="datetime-local"
                                                            class="form-control"
                                                            value="{{ \Carbon\Carbon::parse($tugas->tanggal_mulai)->format('Y-m-d\TH:i') }}"
                                                            placeholder="Tanggal Mulai">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Deadline</label>
                                                        <input name="tanggal_akhir" type="datetime-local"
                                                            class="form-control"
                                                            value="{{ \Carbon\Carbon::parse($tugas->tanggal_akhir)->format('Y-m-d\TH:i') }}"
                                                            placeholder="Deadline">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Kelas</label>
                                                        <select name="id_kelas[]" multiple class="form-control" required>
                                                            @php
                                                                $materi_kelas = $tugas->kelas;
                                                            @endphp
                                                            @foreach ($data_kelas as $kelas)
                                                                <option value="{{ $kelas->kelas_id }}"
                                                                    {{ $materi_kelas->where('id', $kelas->kelas_id)->first() ? 'selected' : '' }}>
                                                                    {{ $kelas->nama_kelas }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Unggah Materi</label>
                                                        <input type="file" name="file_tugas" class="form-control"/>
                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_tugas">
                        <div class="modal-dialog">
                            <form
                                class="modal-content"action="{{ route('admin.materipelajaran.storeTugas', ['id' => $id_dosen, 'mapel' => $mapel_id, 'id_prodi' => $id_prodi, 'semester' => $semester, 'tahun_ajaran' => $tahun_ajaran]) }}"
                                method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Tugas Baru</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Kode Tugas</label>
                                        <input name="kode_tugas" type="texts" class="form-control"
                                            placeholder="Kode Tugas">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Judul Tugas</label>
                                        <input name="judul_tugas" type="text" class="form-control"
                                            placeholder="Judul Tugas">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Deksripsi Tugas</label>
                                        <input name="deskripsi_tugas" type="text" class="form-control"
                                            placeholder="Deskripsi Tugas">
                                    </div>

                                    <div class="fv-row mb-5">

                                        <label class="form-label">Tanggal Mulai</label>
                                        <input name="tanggal_mulai" type="datetime-local" class="form-control"
                                            placeholder="Tanggal Mulai">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Deadline</label>
                                        <input name="tanggal_akhir" type="datetime-local" class="form-control"
                                            placeholder="Deadline">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" class="control-label">Masukan Kelas</label>
                                        <select name="id_kelas[]" multiple class="form-control" required>
                                            @foreach ($data_kelas as $kelas)
                                                <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }}</option>
                                            @endforeach

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
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Modal Tambah-->
                </div>
                <div class="tab-pane fade" id="kuis" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-2x mb-1">Kuis</span>
                        </h3>


                        <div class="d-flex my-2">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_kuis"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table id="table_kuis"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Kode Soal</th>
                                <th>Judul Kuis</th>
                                <th>Kelas</th>
                                <th>Tanggal Mulai</th>
                                <th>Batas Waktu</th>
                                <th>Jumlah Soal</th>
                                <th>Durasi Kuis</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_quiz as $no => $quiz)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $quiz->mapel->nama_mapel }}</td>
                                    <td>{{ $quiz->kode_soal }}</td>
                                    <td>{{ $quiz->judul_kuis }}</td>
                                    <td>
                                        @foreach ($quiz->kelas as $kelas)
                                            <span class="badge badge-warning">
                                                {{ $kelas->nama_kelas }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>{{ $quiz->tanggal_mulai }}</td>
                                    <td>{{ $quiz->tanggal_akhir }}</td>
                                    <td>{{ $quiz->jumlah_soal }} Soal</td>
                                    <td>{{ $quiz->durasi }} Menit</td>
                                    <!-- <td>
                                <button type="button" class="btn btn-success">Edit</button>
                                <button href="#" type="button" class="btn btn-danger">Hapus</button>
                              </td> -->
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
        var DataMateri = function() {
            var table = document.getElementById('table_materi');
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
                            targets: 9
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_materi');
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

        var DataTugas = function() {
            var table = document.getElementById('table_tugas');
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

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_tugas');
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

        var DataKuis = function() {
            var table = document.getElementById('table_kuis');
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
            DataMateri.init();
            DataTugas.init();
            DataKuis.init();
        });
    </script>
@endsection
