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
                <span class="card-label fw-bold text-dark">Data Quiz</span>
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
                        <th class="min-w-50px rounded-start">No</th>
                        <th>Nama Dosen</th>
                        <th>Mata Kuliah</th>
                        <th>Judul Kuis</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Kode Soal</th>
                        <th>Jumlah Soal</th>
                        <th width="100">Waktu</th>
                        <th class="text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_kuis as $no => $kuis)
                    @php $no =1; @endphp
                    @foreach($kuis->kelas as $kelas)
                    @if($siswa->kelas_id == $kelas->id)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$kuis->dosen->nama_dosen}}</td>
                      <td>{{$kuis->mapel->nama_mapel}}</td>
                      <td>{{$kuis->judul_kuis}}</td>
                      <td>{{$kuis->tanggal_mulai}}</td>
                      <td>{{$kuis->tanggal_akhir}}</td>
                      <td>{{$kuis->kode_soal}}</td>
                      <td>{{$kuis->jumlah_soal}}</td>
                      <td>{{$kuis->durasi}} Menit</td>
                      <td>

                        @foreach($arr as $btn)
                        @if($btn['id'] == $kuis->id)
                        @if($btn['ngerjain'])
                        <a href="#" class="btn btn-success"  disabled> <span class="fa fa-check"></span> Selesai</a>
                        @else
                        <a href="{{url('/student/datakuis/mulaikuis', $kuis->id)}}" class="btn btn-danger"> <span class="fa fa-play"></span> Mulai</a>
                        @endif
                        @endif
                        @endforeach

                      </td>

                    @endif
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
                        targets: 9,
                        className: 'dt-body-right'
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
