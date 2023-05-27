@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pemasukan
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Pemasukan</li>
    </ul>
@endsection

@section('content')

    <div class="row">
        <div class="col">
            <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                <span class="fs-4 fw-semibold text-info pb-1 px-2">Total Saldo</span>
                <span class="fs-lg-2tx fw-bold d-flex justify-content-center">Rp. {{ number_format($data_revenue->sum->amount - $data_bills->sum->amount) }}</span>
            </div>
        </div>

        <div class="col">
            <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                <span class="fs-4 fw-semibold text-success pb-1 px-2">Total Pemasukan</span>
                <span class="fs-lg-2tx fw-bold d-flex justify-content-center">Rp. {{ number_format($data_revenue->sum->amount) }}</span>
            </div>
        </div>

        <div class="col">
            <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                <span class="fs-4 fw-semibold text-danger pb-1 px-2">Total Pengeluaran</span>
                <span class="fs-lg-2tx fw-bold d-flex justify-content-center">Rp. {{ number_format($data_bills->sum->amount) }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header pt-7 border-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#data" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Data
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#rekap" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Rekap
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="data" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <a href="{{ route('admin.pemasukan.create') }}" class="btn btn-primary fw-bolder">Tambah</a>
                        </div>
                    </div>
                    <table id="table_data" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <td>Nama</td>
                                <td>Deskripsi</td>
                                <td>Tanggal</td>
                                <td>Jumlah</td>
                                <td>Transfer Via</td>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_revenue as $revenue)
                                <tr>
                                    <td>{{ $revenue->nama }}</td>
                                    <td>{{ $revenue->deskripsi }}</td>
                                    <td> {{ \Carbon\Carbon::parse($revenue->tanggal)->format('d M Y H:i') }}</td>
                                    <td>{{ number_format($revenue->amount) }}</td>
                                    <td>{{ $revenue->transfer_via }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.pemasukan.edit', [$revenue]) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="rekap" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="d-flex flex-column justify-content-center flex-wrap mb-0">
                            <span class="card-label fw-bold fs-3 mb-2">Rekap Pemasukan</span>
                            <span
                                class="text-muted fw-semibold fs-7">{{ \Carbon\Carbon::parse($start ?? '')->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($end ?? '')->format('d M Y') }}</span>
                        </h3>

                        <div class="d-flex align-items-center">
                            @if ($start ?? ('' != null && $end ?? '' != null))
                            <a href="{{ route('admin.pemasukan.rekap', ['start' => $start ?? '', 'end' => $end ?? '']) }}" class="btn btn-sm btn-success btn-icon"><span class="fa fa-cloud-download"></span></a>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        @endif
                            <form action="{{ route('admin.pemasukan.cari.rekap') }}" method="POST" class="d-flex my-2">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <input type="date" name="start" class="form-control"
                                            value="{{ $start ?? '' }}" />
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="end" class="form-control"
                                            value="{{ $end ?? '' }}" />
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-search"></i>Rekap</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <table id="table_rekap" class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <td>Nama</td>
                                <td>Deskripsi</td>
                                <td>Tanggal</td>
                                <td>Jumlah</td>
                                <td>Transfer Via</td>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data_bills)
                                @foreach ($data_pemasukan as $revenue)
                                    <tr>
                                        <td>{{ $revenue->nama }}</td>
                                        <td>{{ $revenue->deskripsi }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($revenue->tanggal)->format('d M Y H:i') }}
                                        </td>
                                        <td>{{ number_format($revenue->amount) }}</td>
                                        <td>{{ $revenue->transfer_via }}</td>

                                    </tr>
                                @endforeach
                            @endisset
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

        var ListRekap = function() {
            var table = document.getElementById('table_rekap');
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
            ListRekap.init();
        });
    </script>
@endsection
