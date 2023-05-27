@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.pilih.matkul.khs') }}" class="text-muted text-hover-primary">Pilih Mata Kuliah</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted text-hover-primary">Pilih Kelas</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Mahasiswa</li>
    </ul>
@endsection

@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2 mb-1">{{$mapel->nama_mapel}}</></span>
                <span class="mt-1">{{$tahun->nama_tahun_ajaran}} - {{$semester->nama_semester}}</span>
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
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mutu</th>
                        <th>Nilai</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach($data_mahasiswa as $no => $mahasiswa)
                    <tr>
                        <td>{{$mahasiswa->nim}}</td>
                        <td>
                            {{$mahasiswa->nama_mahasiswa}}
                        </td>
                        <td>{{$mahasiswa->mutu}}</td>
                        <td>{{$mahasiswa->nilai}}</td>
                        <td align="center">
                            @role('dosen')
                            @if(!$mahasiswa->nilai)
                            <a data-toggle="modal" data-target="#inputNilai{{$mahasiswa->id}}" type="button" class="btn btn-primary">Input Nilai</a>
                            @else
                            <a data-toggle="modal" data-target="#editNilai{{$mahasiswa->id}}" type="button" class="btn btn-primary">Edit Nilai</a>
                            @endif
                            @endrole
                        </td>
                    </tr>
                    <!-- MODAL Nilai-->
                    <div class="modal fade" id="inputNilai{{$mahasiswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="staticBackdropLabel">Input Nilai Kartu Hasil Studi</h5>
                                </div>

                                <div class="modal-body">
                                    <h3><span class="fa fa-book"></span> Input Nilai Kartu Hasil Studi ({{$mahasiswa->nama_mahasiswa}})</h3>
                                    <form action="{{route('guru.input.mahasiswa.khs.detail',['kode_mapel' => $mapel->kode_mapel, 'kelas_id' => $mahasiswa->kelas_id, 'id_mahasiswa' => $mahasiswa->id_mahasiswa,'id' => $mahasiswa->id])}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mutu Kartu Hasil Studi ({{$mahasiswa->nama_mahasiswa}})</label>
                                            <input name="mutu" type="text" class="form-control" placeholder="Contoh : A/B/C" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nilai Kartu Hasil Studi ({{$mahasiswa->nama_mahasiswa}})</label>
                                            <input name="nilai" type="text" class="form-control" placeholder="Contoh : 4.00 / 3.50" required>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Input</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- MODAL Edit Nilai-->
                     <div class="modal fade" id="editNilai{{$mahasiswa->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="staticBackdropLabel">Input Nilai Tugas</h5>
                                </div>

                                <div class="modal-body">
                                    <h3><span class="fa fa-book"></span> Edit Nilai</h3>
                                    <form action="{{route('guru.update.mahasiswa.khs.detail',['kode_mapel' => $mapel->kode_mapel, 'kelas_id' => $mahasiswa->kelas_id, 'id_mahasiswa' => $mahasiswa->id_mahasiswa,'id' => $mahasiswa->id])}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mutu Kartu Hasil Studi ({{$mahasiswa->nama_mahasiswa}})</label>
                                            <input name="mutu" type="text" class="form-control" value="{{$mahasiswa->mutu}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nilai Kartu Hasil Studi ({{$mahasiswa->nama_mahasiswa}})</label>
                                            <input name="nilai" type="text" class="form-control" value="{{$mahasiswa->nilai}}">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Input</button>
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
