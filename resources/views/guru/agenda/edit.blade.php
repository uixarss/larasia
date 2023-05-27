@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Agenda
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
        <li class="breadcrumb-item text-muted">
            <a href="{{route('guru.agenda.detail', [ 'id_tahun_ajaran' => $tahun_ajaran->id ,'id_semester' => $semester->id, 'id_prodi' => $id_prodi ])}}" class="text-muted text-hover-primary">Agenda</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail Agenda</li>
    </ul>
@endsection

@section('content')
    <div class="card card-flush pb-0 mb-10">
        <div class="card-body pt-10">
            <div class="d-flex align-items-center">
                <div class="d-flex flex-column">
                    <h2 class="mb-2">{{ $agenda->mapel->nama_mapel }}</h2>
                    <div class="text-muted fw-bold">
                        <span>Tahun Ajar (Semester): <span class="text-primary">{{ $agenda->tahun_ajaran }}
                                ({{ $agenda->semester }})</span></span>
                        <span class="mx-3 text-gray-300">|</span>
                        <span>Satuan Pendidikan: <span
                                class="text-primary">{{ $data_sekolah->nama_sekolah ?? 'Tidak ada data' }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap flex-stack mb-5">

        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-2 mb-1">Data Agenda Pelajaran</span>
        </h3>
        <div class="d-flex my-2 gap-2 align-items-center">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
            <div class="bullet bg-secondary h-35px w-1px mx-3"></div>
            <div class="d-flex align-items-center position-relative me-4">
                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                <input type="text" id="table_search"
                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                    placeholder="Search">
            </div>
        </div>
    </div>
    <table id="table_data"
        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
        <thead class="fs-5 fw-semibold bg-light">
            <tr>
                <th class="min-w-50px">No</th>
                <th class="min-w-200px">Hari / Tanggal</th>
                <th class="min-w-100px">Jam</th>
                <th class="min-w-100px">Kelas</th>
                <th class="min-w-250px">Kegiatan</th>
                <th class="min-w-250px">Penugasan</th>
                <th colspan="2" class="min-w-300px">Peserta didik yang tidak hadir</th>
                <th class="min-w-250px">Keterangan</th>
                <th class="min-w-50px text-end">Opsi</th>
            </tr>
        </thead>
        <tbody class="fs-6 fw-semibold text-gray-600">

            @if (!empty($agenda->agendaDetail))
                @forelse($agenda->agendaDetail as $key_detail => $detail)
                    <tr class="baris-data" id="baris-data" no-baris="{{ $detail->id }}">
                        <td>{{ ++$key_detail }}</td>
                        <td>{{ Carbon\Carbon::parse($detail->tanggal_kbm)->format('D , d F Y') }}</td>
                        <td>{{ $detail->jam_kbm }}</td>
                        <td>{{ $detail->nama_kelas }}</td>
                        <td>{{ $detail->kegiatan }}</td>
                        <td>{{ $detail->penugasan }}</td>
                        <td class="data_detail_siswa" id-detail="{{ $detail->id }}">
                            <button class="btn btn-sm btn-info btn-icon" data-bs-toggle="modal" data-bs-target="#tambahAgendaDetail{{ $detail->id }}"><i class="bi bi-plus-lg"></i></button>

                            <!-- MODAL ADD AGENDA DETAIL SISWA-->
                            <div class="modal fade" id="tambahAgendaDetail{{ $detail->id }}" data-backdrop="static"
                                tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Agenda
                                                {{ Carbon\Carbon::parse($detail->tanggal_kbm)->format('d F Y') }}</h3>
                                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="bi bi-x-lg fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('guru.agenda.detail.siswa.add', ['id' => $detail->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf

                                                @php
                                                    $kelas = App\Models\Kelas::where('nama_kelas', $detail->nama_kelas)->first();
                                                    $data_siswa = App\Models\Mahasiswa::where('kelas_id', $kelas->id)->get();
                                                @endphp
                                                <div class="row">

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Mahasiswa</label>
                                                        <select name="nama_siswa" class="form-control">
                                                            @foreach ($data_siswa as $siswa)
                                                                <option value="{{ $siswa->nama_mahasiswa }}">
                                                                    {{ $siswa->nama_mahasiswa }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input type="text" type="hidden" name="keterangan"
                                                            class="form-control" placeholder="Keterangan">
                                                    </div>


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
                            <!-- END MODAL ADD AGENDA DETAIL SISWA -->
                        </td>
                        <td>
                            @if (!empty($detail->agendaDetailSiswa))
                                @forelse($detail->agendaDetailSiswa as $agendaDetailSiswa)
                                    <span class="badge badge-primary">{{ $agendaDetailSiswa->nama_siswa }}</span>
                                @empty
                                @endforelse
                            @endif
                        </td>
                        <td>
                            @if (!empty($detail->agendaDetailSiswa))
                                @forelse($detail->agendaDetailSiswa as $agendaDetailSiswa)
                                    <span class="badge badge-info mr-3">{{ $agendaDetailSiswa->keterangan }}</span>
                                    <a href="{{ route('guru.agenda.detail.siswa.delete', ['id' => $agendaDetailSiswa->id]) }}"
                                        onclick="return confirm('Yakin Mau di Hapus ?')"><span
                                            class="badge badge-danger">x</span></a> <br>

                                @empty
                                @endforelse
                            @endif
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editAgenda{{ $detail->id }}">Edit</a>
                        </td>
                    </tr>
                    <!-- MODAL EDIT AGENDA DETAIL-->
                    <div class="modal fade" id="editAgenda{{ $detail->id }}" data-backdrop="static" tabindex="-1"
                        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Agenda
                                        {{ Carbon\Carbon::parse($detail->tanggal_kbm)->format('d F Y') }}</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('guru.agenda.detail.update', ['id' => $detail->id]) }}"
                                        method="post">
                                        @csrf

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="fv-row">
                                                    <label class="form-label">Kegiatan / Materi</label>
                                                    <textarea name="kegiatan" id="data_kegiatan" cols="30" rows="12" class="form-control">{{ $detail->kegiatan }}</textarea>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="fv-row mb-5">
                                                    <label class="form-label">Tanggal</label>
                                                    <input type="date" name="tanggal_kbm" id="tanggal_kbm"
                                                        class="form-control" value="{{ $detail->tanggal_kbm }}">
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label">Jam KBM</label>
                                                    <input type="text" name="jam_kbm" id="data_jam"
                                                        class="form-control" placeholder="Contoh: 1 - 3"
                                                        value="{{ $detail->jam_kbm }}">
                                                </div>

                                                <div class="fv-row mb-5">
                                                    <label class="form-label">Kelas</label>
                                                    <select name="nama_kelas" id="nama_kelas"
                                                        class="form-control select">
                                                        @foreach ($data_kelas as $kelas)
                                                            <option value="{{ $kelas->nama_kelas }}"
                                                                {{ $detail->nama_kelas == $kelas->nama_kelas ? 'selected' : '' }}>
                                                                {{ $kelas->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="fv-row">
                                                    <label class="form-label">Penugasan</label>
                                                    <input type="text" name="penugasan" id="data_penugasan"
                                                        class="form-control" value="{{ $detail->penugasan }}">
                                                </div>
                                            </div>



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
                    <!-- END MODAL EDIT AGENDA DETAIL -->
                @empty
                @endforelse
            @endif
        </tbody>
    </table>

    <!-- MODAL Tambah-->
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Agenda</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.agenda.detail.store', ['id' => $agenda->id]) }}" method="post">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="fv-row">
                                    <label class="form-label">Kegiatan / Materi</label>
                                    <textarea name="kegiatan" id="data_kegiatan" cols="30" rows="12" class="form-control"></textarea>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="fv-row mb-5">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal_kbm" id="tanggal_kbm" class="form-control"
                                        value="">
                                </div>

                                <div class="fv-row mb-5">
                                    <label class="form-label">Jam KBM</label>
                                    <input type="text" name="jam_kbm" id="data_jam" class="form-control"
                                        placeholder="Contoh: 1 - 3" value="">
                                </div>

                                <div class="fv-row mb-5">
                                    <label class="form-label">Kelas</label>
                                    <select name="nama_kelas" id="nama_kelas" class="form-control select">
                                        @foreach ($data_kelas as $kelas)
                                            <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row">
                                    <label class="form-label">Penugasan</label>
                                    <input type="text" name="penugasan" id="data_penugasan" class="form-control"
                                        value="">
                                </div>
                            </div>



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
    <!-- END MODAL Tambah -->
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
                    'columnDefs': [
                        { orderable: false, targets: 7 },
                        { orderable: false, targets: 8 }, //
                        { orderable: false, targets: 9 }, // Disable ordering on column 6 (actions)
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
