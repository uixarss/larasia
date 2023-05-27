@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Dosen
                </h1>
            </div>
            @can('create-dosen')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button class="btn fw-bold btn-success" data-bs-toggle="modal" data-bs-target="#import">Import</button>
                    <button class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Dosen</span>
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
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach($data_dosen as $dosen)
                    <?php $no++ ;?>
                      <tr>
                          <td scope="row">{{ $no }}</td>
                          <td>{{$dosen->nidn}}</td>
                          <td>{{$dosen->nama_dosen}}</td>
                          <td>{{$dosen->tanggal_lahir}}</td>
                          <td>{{$dosen->email}}</td>
                          <td>{{$dosen->nama_status_aktif}}</td>
                          <td align="center">
                            @can('edit-dosen')
                            <a href="{{route('pegawai.dosen.edit',['id' => $dosen->id])}}" type="button" class="btn btn-sm btn-info">Detail</a>
                            @endcan
                            @can('delete-dosen')
                            <a href="{{route('pegawai.dosen.destroy',['id' => $dosen->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            @endcan
                          </td>

                      </tr>
                      @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('pegawai.dosen.create') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Dosen</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">NIDN</label>
                        <input name="nidn" type="text" class="form-control" placeholder="NIDN">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Dosen</label>
                        <input name="nama_dosen" type="text" class="form-control" placeholder="Nama Dosen">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Tempat lahir</label>
                        <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="datetime-local" class="form-control">
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="import">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('pegawai.dosen.import') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Import Excel Data Dosen</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row">
                        <label class="form-label">Pilih File Excel</label>
                        <input type="file" name="file" class="form-control" required="required">
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
                            targets: 6,
                            className: 'dt-body-right'
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
