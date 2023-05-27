@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Mahasiswa</li>
    </ul>
@endsection

@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-4">
            <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">1</div>
                    <div class="fw-semibold text-gray-100">Total Mahasiswa</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="#" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <div class="text-white fw-bold fs-2 mb-2 mt-5">2</div>
                    <div class="fw-semibold text-white">Mahasiswa Aktif</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="#" class="card bg-danger hoverable card-xl-stretch mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="text-white fw-bold fs-2 mb-2 mt-5">3</div>
                    <div class="fw-semibold text-white">Mahasiswa Tidak Aktif</div>
                </div>
            </a>
        </div>
    </div>
    <div class="d-flex flex-wrap flex-stack mb-5">
        <div class="d-flex align-items-center position-relative me-4">
            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
            <input type="text" id="table_search"
                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                placeholder="Search">
        </div>

        <div class="d-flex my-2 gap-2">
            <a href="{{ route('admin.mahasiswa.export', ['id' => $kelas->id ?? '', 'nama_kelas' => $kelas->nama_kelas ?? '']) }}"
                class="btn btn-icon btn-success fw-bolder" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="Download to Excel"><i class="bi bi-cloud-arrow-down-fill"></i></a>
            <button type="button" class="btn btn-icon btn-info fw-bolder" data-bs-toggle="modal"
                data-bs-target="#import"><i class="bi bi-cloud-arrow-up-fill"></i></button>
            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                data-bs-target="#tambah">Tambah</button>
        </div>
    </div>
    <table id="table_data"
        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
        <thead class="fs-5 fw-semibold bg-light">
            <tr>
                <th width="50">NIM</th>
                <th class="min-w-250px">Nama Lengkap</th>
                <th class="min-w-150px">Program Studi</th>
                <th class="min-w-50px">Kelas</th>
                <th class="min-w-50px">JK</th>
                <th class="min-w-50px">Agama</th>
                <th class="min-w-250px">Email</th>
                @canany(['edit-mahasiswa', 'delete-mahasiswa'])
                    <th class="min-w-200px text-end">Opsi</th>
                @endcanany
            </tr>
        </thead>
        <tbody class="fs-6 fw-semibold text-gray-600">
            @foreach ($data_mahasiswa as $key_mahasiswa => $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->nim ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->nama_mahasiswa ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->prodi->nama_program_studi ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->kelas->nama_kelas ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->jenis_kelamin ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->nama_agama ?? 'Kosong! Harap diupdate' }}</td>
                    <td>{{ $mahasiswa->email ?? 'Kosong! Harap diupdate' }}</td>
                    @canany(['edit-mahasiswa', 'delete-mahasiswa'])
                        <td class="text-end">
                            @can('edit-mahasiswa')
                                <a href="{{ route('admin.mahasiswa.edit', ['id' => $mahasiswa->id]) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('delete-mahasiswa')
                                <a href="{{ route('admin.mahasiswa.delete', ['id' => $mahasiswa->id]) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.mahasiswa.create') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Mahasiswa</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label">NIM Mahasiswa</label>
                        <input name="nim" type="text" class="form-control" placeholder="NIM">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Mahasiswa</label>
                        <input name="nama_mahasiswa" type="text" class="form-control" placeholder="Nama Lengkap">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-5 mb-5">
                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label" for="text">Tempat lahir</label>
                            <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir">
                        </div>

                        <div class="fv-row w-100 flex-md-root">
                            <label class="form-label">Tanggal Lahir</label>
                            <input name="tanggal_lahir" type="datetime-local" class="form-control">
                        </div>

                    </div>


                    <div class="fv-row mb-5">
                        <label class="form-label">Agama</label>
                        <select name="nama_agama" class="form-control">
                            <option value="1,Islam">Islam</option>
                            <option value="2,Kristen">Kristen</option>
                            <option value="3,Katolik">Katolik</option>
                            <option value="4,Hindu">Hindu</option>
                            <option value="5,Budha">Budha</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="text">Nomor Handphone</label>
                        <input name="handphone" type="text" class="form-control" placeholder="Nomor Handphone">
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
            <form class="modal-content" action="{{ route('admin.mahasiswa.import') }}" enctype="multipart/form-data"
                method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Import Data Mahasiswa</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row">
                        <label class="form-label" for="password">File Excel</label>
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
