@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Agenda
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.agendaguru.index') }}" class="text-muted text-hover-primary">Pilih Tahun Ajaran &
                Semester</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.agendaguru.prodi', ['id_tahun_ajaran' => $tahun_ajaran->id, 'id_semester' => $semester->id]) }}" class="text-muted text-hover-primary">Pilih Prodi</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail Agenda</li>


    </ul>
@endsection


@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2 mb-1">Data Agenda</span>
                {{ $tahun_ajaran->nama_tahun_ajaran }} / {{ $semester->nama_semester }} - {{ $prodi->nama_program_studi }}
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
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Mata Kuliah</th>
                        <th>Keterangan</th>
                        <th class="text-end min-w-80px">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @php $no = 0; @endphp
                    @foreach ($data_guru as $guru)
                        @php $no++ @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $guru->nidn }}</td>
                            <td>{{ $guru->nama_dosen }}</td>
                            <td>{{ $guru->nama_mapel ?? '' }}</td>
                            <td align="center">
                                @if ($guru->agendas->where('mapel_id', $guru->mapel_id)->where('tahun_ajaran', $tahun_ajaran->nama_tahun_ajaran)->where('semester', $semester->nama_semester)->where('id_prodi', $prodi->id_prodi)->count() > 0)
                                    <span class="badge badge-info">
                                        <strong>{{ $guru->agendas->where('mapel_id', $guru->mapel_id)->where('tahun_ajaran', $tahun_ajaran->nama_tahun_ajaran)->where('semester', $semester->nama_semester)->where('id_prodi', $prodi->id_prodi)->count() }}
                                            Agenda</strong> </span>
                                @else
                                    <span class="badge badge-warning">
                                        <strong>{{ $guru->agendas->where('mapel_id', $guru->mapel_id)->where('tahun_ajaran', $tahun_ajaran->nama_tahun_ajaran)->where('semester', $semester->nama_semester)->where('id_prodi', $prodi->id_prodi)->count() }}
                                            Agenda</strong> </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#lihatagenda{{ $no }}">Lihat Agenda</button>
                            </td>
                        </tr>

                        <!-- MODAL EDIT SEMESTER-->
                        <div class="modal fade" id="lihatagenda{{ $no }}" data-backdrop="static"
                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title"><strong>{{ $guru->nama_dosen }} ({{ $guru->nama_mapel }})</strong></h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>

                                    <div class="modal-body">
                                        <label class="form-label" for="nama_semester"> Pilih Tahun Ajaran dan Semester : </    label>


                                        <div class="form-control">
                                            @php $a = 1; @endphp
                                            @forelse($guru->agendas->where('mapel_id', $guru->mapel_id)->where('tahun_ajaran', $tahun_ajaran->nama_tahun_ajaran)->where('semester', $semester->nama_semester)->where('id_prodi', $prodi->id_prodi) as $agenda)
                                                <a href="{{ route('admin.agendaguru.lihatagenda', [$guru->id, $agenda->id]) }}"
                                                    class="list-group-item">{{ $a++ }}.
                                                    {{ $agenda->tahun_ajaran ?? '' }} ||
                                                    {{ $agenda->semester ?? '' }} </a>

                                            @empty
                                                <p class="list-group-item">Tidak Ada Agenda</p>
                                            @endforelse
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL EDIT SEMESTER-->
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
                            targets: 5
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
