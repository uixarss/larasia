@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Evaluasi Soal
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-4 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#quiz" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal Quiz
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#uts" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal UTS
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#uas" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal UAS
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
                <div class="tab-pane fade active show" id="quiz" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal Quiz
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_quiz"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4" id="table_quiz">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Pelajaran</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_kuis as $no => $kuis)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$kuis->kode_soal}}</td>
                                        <td>{{$kuis->judul_kuis}}</td>
                                        <td>{{$kuis->mapel->nama_mapel}}</td>
                                        <td>
                                        @foreach($kuis->kelas as $kelas)
                                        <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                        @endforeach
                                        </td>
                                        <td class="text-end">
                                        <button data-bs-toggle="modal" data-bs-target="#lihatevaluasi{{$kuis->id}}" type="button" class="btn btn-sm btn-primary">Lihat</button>
                                        </td>
                                    </tr>

                                    <!-- MODAL EDIT SEMESTER-->
                                    <div class="modal fade" id="lihatevaluasi{{$kuis->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Pilih Kelas</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                        <div class="modal-body">

                                            <label class="form-label" for="nama_semester"> Evaluasi Berdasarkan Kelas : </label>

                                            <div class="list-group border-bottom push-up-15 push-down-0">
                                                @foreach($kuis->kelas as $kelas)
                                                <a href="{{route('admin.evaluasisoal.detailevaluasi', [$kuis->id,  $kelas->id])}}" class="list-group-item">{{$kelas->nama_kelas}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
                <div class="tab-pane fade" id="uts" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal UTS
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_uts"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4" id="table_uts">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Pelajaran</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_uts as $no => $uts)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$uts->kode_soal}}</td>
                                        <td>{{$uts->judul_kuis}}</td>
                                        <td>{{$uts->mapel->nama_mapel}}</td>
                                        <td>
                                        @foreach($uts->kelas as $kelas)
                                        <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                        @endforeach
                                        </td>
                                        <td class="text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#lihatevaluasi{{$uts->id}}" type="button" class="btn btn-sm btn-primary">Lihat</button>
                                        </td>
                                    </tr>


                                    <!-- MODAL EDIT SEMESTER-->
                                    <div class="modal fade" id="lihatevaluasi{{$uts->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Pilih Kelas</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                        <div class="modal-body">

                                            <label class="form-label" for="nama_semester"> Evaluasi Berdasarkan Kelas : </label>

                                            <div class="list-group border-bottom push-up-15 push-down-0">
                                                @foreach($uts->kelas as $kelas)
                                                <a href="{{route('admin.evaluasisoal.detailevaluasi', [$uts->id,  $kelas->id])}}" class="list-group-item">{{$kelas->nama_kelas}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
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
                <div class="tab-pane fade" id="uas" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal UAS
                            </h3>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_uas"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4" id="table_uas">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Pelajaran</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_uas as $no => $uas)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$uas->kode_soal}}</td>
                                        <td>{{$uas->judul_kuis}}</td>
                                        <td>{{$uas->mapel->nama_mapel}}</td>
                                        <td>
                                        @foreach($uas->kelas as $kelas)
                                        <span class="badge badge-warning">{{$kelas->nama_kelas}} </span>
                                        @endforeach
                                        </td>
                                        <td class="text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#lihatevaluasi{{$uas->id}}" type="button" class="btn btn-sm btn-primary">Lihat</button>
                                        </td>
                                    </tr>


                                    <!-- MODAL EDIT SEMESTER-->
                                    <div class="modal fade" id="lihatevaluasi{{$uas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Pilih Kelas</h3>
                                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-lg fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body">

                                            <label class="form-label" for="nama_semester"> Evaluasi Berdasarkan Kelas : </label>

                                            <div class="list-group border-bottom push-up-15 push-down-0">
                                                @foreach($uas->kelas as $kelas)
                                                <a href="{{route('admin.evaluasisoal.detailevaluasi', [$uas->id,  $kelas->id])}}" class="list-group-item">{{$kelas->nama_kelas}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
        var DataQuiz = function() {
            var table = document.getElementById('table_quiz');
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
                            targets: 5,
                            className: 'dt-body-right'
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_quiz');
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

        var DataUTS = function() {
            var table = document.getElementById('table_uts');
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
                            targets: 5,
                            className: 'dt-body-right'
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_uts');
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

        var DataUAS = function() {
            var table = document.getElementById('table_uas');
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
                            targets: 5,
                            className: 'dt-body-right'
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_uas');
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
            DataQuiz.init();
            DataUTS.init();
            DataUAS.init();
        });
    </script>
@endsection
