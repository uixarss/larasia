@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Kartu Hasil Studi
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">{{$mahasiswa->nama_mahasiswa}}</span>
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
                        <th class="min-w-50px rounded-start">Tingkat</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Mutu</th>
                        <th class="rounded-end">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_khs as $no => $khs)
                    @foreach($khs->detail as $detail)
                    <tr>
                        <td>{{$khs->tingkat_semester}}</td>
                        <td>{{$detail->mapel->kode_mapel}}</td>
                        <td>{{$detail->mapel->nama_mapel}}</td>
                        <td>{{$detail->mapel->jumlah_sks}}</td>
                        <td>
                            {{$detail->mutu ?? '-'}}
                        </td>
                        <td>
                            {{$detail->nilai ?? '-'}}
                        </td>

                    </tr>
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
                    "pageLength": 10,
                    "lengthChange": true,
                    "info": true,
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
