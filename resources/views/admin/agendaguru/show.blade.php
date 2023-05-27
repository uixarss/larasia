@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Kurikulum
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="/admin/kurikulum" class="text-muted text-hover-primary">Kurikulum</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail</li>
    </ul>
@endsection

@section('content')
    <div class="card card-flush pb-0 mb-10">
        <div class="card-body pt-10">
            <div class="d-flex align-items-center">
                <div class="d-flex flex-column">
                    <h2 class="mb-2">{{$guru->nama_dosen}} - <strong>{{$agenda->mapel->nama_mapel ?? 'Tidak ada data'}}</h2>
                    <div class="text-muted fw-bold">
                        <span>Tahun Ajar (Semester): <span class="text-primary">{{$agenda->tahun_ajaran }} ({{$agenda->semester }})</span></span>
                        <span class="mx-3 text-gray-300">|</span>
                        <span>Satuan Pendidikan: <span class="text-primary">{{$data_sekolah->nama_sekolah ?? 'Tidak ada data'}}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap flex-stack mb-5">

        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-2 mb-1">Data Agenda Pelajaran</span>
        </h3>
        <div class="d-flex my-2 gap-2">
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
                <th>No</th>
                <th>Hari / Tanggal</th>
                <th>Jam</th>
                <th>Kelas</th>
                <th>Kegiatan</th>
                <th>Penugasan</th>
                <th width="150">Peserta didik yang tidak hadir</th>
                <th width="100">Keterangan</th>
            </tr>
        </thead>
        <tbody class="fs-6 fw-semibold text-gray-600">
            @if(!empty($agenda->agendaDetail))
            @forelse($agenda->agendaDetail as $key_detail => $detail )
            <tr>
                <td>{{++$key_detail }}</td>
                <td>{{ Carbon\Carbon::parse($detail->tanggal_kbm)->format('d F Y') }}</td>
                <td>{{$detail->jam_kbm }}</td>
                <td>{{$detail->nama_kelas }}</td>
                <td>{{$detail->kegiatan }}</td>
                <td>{{$detail->penugasan }}</td>
                <td>
                  @foreach($detail->agendaDetailSiswa as $siswa)
                      <span class="label label-info label-form"> {{$siswa->nama_siswa}}</span> <br>
                  @endforeach
                </td>
                <td>
                  @foreach($detail->agendaDetailSiswa as $siswa)
                      <span class="label label-info label-form"> {{$siswa->keterangan}}</span> <br>
                  @endforeach
                </td>
            </tr>
            @empty
            @endforelse
            @endif
        </tbody>
    </table>
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
                            targets: 7
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
