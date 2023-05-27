@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail  Jadwal Ujian
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="/admin/jadwalujian" class="text-muted text-hover-primary">Jadwal Ujian</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Jadwal Ujian {{ $jadwal_ujian->title }} {{ $jadwal_ujian->year }}</span>
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
                    Jadwal</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Tanggal Ujian</th>
                        <th>Kelas</th>
                        <th>Pelajaran</th>
                        <th>Waktu Ujian</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @php
                    $i = 1;
                @endphp
                @foreach ($data_jadwal_ujian_detail as $jadwal_ujian_detail)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $jadwal_ujian_detail->nama_ruangan }}</td>
                        <td>
                            <span class="badge badge-secondary">
                                {{ \Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('d M Y') }}
                            </span>
                        </td>
                        <td>{{ $jadwal_ujian_detail->kelas->nama_kelas }}</td>
                        <td>{{ $jadwal_ujian_detail->mapel->nama_mapel }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('H:i:s') }}
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editJadwalUjian{{ $jadwal_ujian_detail->id }}">Edit</a>
                            <a href="{{ route('admin.jadwalujian.destroyDetail', ['id' => $jadwal_ujian_detail->id]) }}"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            <!-- <a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Jadwal Ujian"><span class="fa fa-print"></span></a> -->
                        </td>
                    </tr>

                    <!-- MODAL EDIT JADWAL UJIAN-->
                    <div class="modal fade" id="editJadwalUjian{{ $jadwal_ujian_detail->id }}"
                        data-backdrop="static" tabindex="-1" role="dialog"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Jadwal Ujian</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>
                                <div class="modal-body">

                                    <form
                                        action="{{ route('admin.jadwalujian.updateDetail', ['id' => $jadwal_ujian_detail->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="kelas">Ruang Ujian</label>
                                                <select name="nama_ruangan" class="form-control select"
                                                    data-live-search="true" required>
                                                    <option value="">-Masukan Ruang Ujian-</option>

                                                    @foreach ($data_kelas as $kelas)
                                                        @if ($jadwal_ujian_detail->nama_ruangan == $kelas->nama_kelas)
                                                            <option value="{{ $kelas->nama_kelas }}"
                                                                selected>{{ $kelas->nama_kelas }}</option>
                                                        @else
                                                            <option value="{{ $kelas->nama_kelas }}">
                                                                {{ $kelas->nama_kelas }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Kelas</label>
                                                <select name="kelas_id" class="form-control select"
                                                    data-live-search="true" required>
                                                    <option value="">-Masukan Kelas-</option>

                                                    @foreach ($data_kelas as $kelas)
                                                        @if ($jadwal_ujian_detail->kelas_id == $kelas->id)
                                                            <option value="{{ $kelas->id }}" selected>
                                                                {{ $kelas->nama_kelas }}</option>
                                                        @else
                                                            <option value="{{ $kelas->id }}">
                                                                {{ $kelas->nama_kelas }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label" for="mapel">Masukan Mata Pelajaran</label>
                                                <select name="mapel_id" class="form-control select"
                                                    data-live-search="true" required>
                                                    <option value="">-Masukan Mata Pelajaran-</option>

                                                    @foreach ($data_mapel as $matpel)
                                                        @if ($jadwal_ujian_detail->mapel_id == $matpel->id)
                                                            <option value="{{ $matpel->id }}" selected>
                                                                {{ $matpel->nama_mapel }}</option>
                                                        @else
                                                            <option value="{{ $matpel->id }}">
                                                                {{ $matpel->nama_mapel }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="fv-row">
                                                <label class="form-label">Pilih Tanggal Ujian</label>
                                                <div class="input-group">
                                                    <input name="tanggal_ujian" type="datetime-local"
                                                        class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($jadwal_ujian_detail->tanggal_ujian)->format('Y-m-d\TH:i') }}">
                                                    <span class="input-group-addon add-on"><span
                                                            class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.jadwalujian.add', ['id' => $jadwal_ujian->id]) }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jadwal Ujian</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf


                    <div class="fv-row mb-5">
                        <label class="form-label" for="kelas">Ruang Ujian</label>
                        <select name="nama_ruangan" class="form-control select"
                            data-live-search="true" required>
                            <option value="">-Masukan Ruang Ujian-</option>

                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-control select" data-live-search="true"
                            required>
                            <option value="">-Masukan Kelas-</option>

                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="mapel">Masukan Mata Pelajaran</label>
                        <select name="mapel_id" class="form-control select" data-live-search="true"
                            required>
                            <option value="">-Masukan Mata Pelajaran-</option>

                            @foreach ($data_mapel as $matpel)
                                <option value="{{ $matpel->id }}">{{ $matpel->nama_mapel }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Pilih Tanggal Ujian</label>
                        <div class="input-group">
                            <input name="tanggal_ujian" type="datetime-local" class="form-control"
                                placeholder="Tanggal Mulai">
                            <span class="input-group-addon add-on"><span
                                    class="glyphicon glyphicon-calendar"></span></span>
                        </div>
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
                            targets: 3
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
@endsection
