@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pilih Tugas
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.nilaitugas.index') }}" class="text-muted text-hover-primary">Pilih Matkul</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.nilaitugas.listKelas', ['dosen' => $dosen, 'id' => $mapel_id, 'kelas' => $id_kelas ])}}" class="text-muted text-hover-primary">Pilih Kelas</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Pilih Tugas</li>
    </ul>
@endsection


@section('content')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-2x mb-1">Data Tugas</span>
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
                        <th>Mata Kuliah</th>
                        <th>Kode Tugas</th>
                        <th>Nama Tugas</th>
                        <th>Deskripsi Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Deadline</th>
                        <th class="text-end min-w-100px">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach($data_tugas as $no => $tugas)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$tugas->mapel->nama_mapel}}</td>
                      <td>{{$tugas->kode_tugas}}</td>
                      <td>{{$tugas->judul_tugas}}</td>
                      <td>{{$tugas->deskripsi_tugas}}</td>
                      <td>
                          <span class="badge badge-secondary">
                              {{$tugas->tanggal_mulai}}
                          </span>
                      </td>
                      <td>
                          <span class="badge badge-danger">
                              {{$tugas->tanggal_akhir}}
                          </span>
                      </td>
                      <td class="text-end">
                        @can('manage-nilai')
                        <a href="{{route('admin.nilaitugas.listMahasiswa',['dosen' => $dosen ,'id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas->tugas_id  ])}}" type="button" class="btn btn-sm btn-primary">List Mahasiswa</a>
                        @endcan
                      </td>
                    </tr>
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
                            targets: 3
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
