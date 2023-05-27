@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Dosen
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Dosen</li>
    </ul>
@endsection

@section('content')
<div class="d-flex flex-wrap flex-stack mb-5">
    <div class="d-flex align-items-center position-relative me-4">
        <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
        <input type="text" id="table_search"
            class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
            placeholder="Search">
    </div>

    <div class="d-flex my-2 gap-2">
        <a href="{{route('admin.dosen.export')}}" class="btn btn-icon btn-success fw-bolder" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download to Excel"><i class="bi bi-cloud-arrow-down-fill"></i></a>
        <button type="button" class="btn btn-icon btn-info fw-bolder" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-cloud-arrow-up-fill"></i></button>
        <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    </div>
</div>
<table id="table_data"
    class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
    <thead class="fs-5 fw-semibold bg-light">
        <tr>
            <th>No</th>
            <th>NIDN/NIDK/NIP</th>
            <th>Nama Dosen</th>
            <th>Tanggal Lahir</th>
            <th>Email</th>
            <th>Status</th>
            <th class="text-end">Opsi</th>
        </tr>
    </thead>
    <tbody class="fs-6 fw-semibold text-gray-600">
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
              <td class="text-end">
                <a href="{{route('admin.dosen.edit',['id' => $dosen->id])}}" type="button" class="btn btn-sm btn-info">Detail</a>
                <a href="{{route('admin.dosen.destroy',['id' => $dosen->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
              </td>
          </tr>
          @endforeach
    </tbody>
</table>
<!-- BEGIN Modal Tambah-->
<div class="modal fade" tabindex="-1" id="tambah">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('admin.dosen.create')}}" method="post">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Dosen</h3>
                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg fs-3"></i>
                </div>
            </div>

            <div class="modal-body">
                @csrf

                <div class="fv-row mb-5">
                    <label class="form-label" for="exampleInputEmail1">NIDN/NIDK/NIP</label>
                    <input name="nidn" type="text" class="form-control"  placeholder="NIDN">
                  </div>

                  <div class="fv-row mb-5">
                    <label class="form-label" for="exampleInputEmail1">Nama Dosen</label>
                    <input name="nama_dosen" type="text" class="form-control"  placeholder="Nama Dosen">
                  </div>

                  <div class="fv-row mb-5">
                    <label>Pilih Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                      <option value="L">Laki-Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>

                  <div class="fv-row mb-5">
                    <label class="form-label" for="text">Tempat lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir">
                  </div>

                  <div class="fv-row mb-5">
                    <label>Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="datetime-local" class="form-control">
                  </div>

                  <div class="fv-row">
                    <label class="form-label" for="text">Email</label>
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
        <form class="modal-content" action="{{route('admin.dosen.import')}}" enctype="multipart/form-data" method="post">
            <div class="modal-header">
                <h3 class="modal-title">Import Data Dosen</h3>
                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg fs-3"></i>
                </div>
            </div>

            <div class="modal-body">
                @csrf

                <div class="fv-row mb-5">
                    <label class="form-label" for="name">File Excel</label>
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
