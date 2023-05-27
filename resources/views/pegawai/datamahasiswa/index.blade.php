@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Mahasiswa
                </h1>
            </div>
            @can('create-mahasiswa')
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
                <span class="card-label fw-bold text-dark">Data Mahasiswa</span>
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
                        <th class="min-w-200px rounded-start">NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>JK</th>
                        <th>Agama</th>
                        <th>Email</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_kelas_mahasiswa as $kelas_mahasiswa)
                        @if($kelas->id == $kelas_mahasiswa->id_kelas)
                            @foreach($data_mahasiswa as $key_mahasiswa => $mahasiswa)
                                @if($kelas_mahasiswa->user_id == $mahasiswa->user_id)
                                <tr>
                                <td>{{$mahasiswa->nim}}</td>
                                <td>{{$mahasiswa->nama_mahasiswa}}</td>
                                <td>{{$kelas->nama_kelas}}</td>
                                <td>{{$mahasiswa->jenis_kelamin}}</td>
                                <td>{{$mahasiswa->nama_agama}}</td>
                                <td>{{$mahasiswa->email}}</td>
                                <td align="center">
                                    @can('edit-mahasiswa')
                                    <a href="{{route('pegawai.mahasiswa.edit',['id' => $mahasiswa->id])}}" class="btn btn-success">Edit</a>
                                    @endcan
                                    @can('delete-mahasiswa')
                                    <a href="{{route('pegawai.mahasiswa.delete',['id' => $mahasiswa->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    @endcan
                                </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('pegawai.mahasiswa.create') }}" method="POST">
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

                    <div class="fv-row mb-5">
                        <label class="form-label">Tempat lahir</label>
                        <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="datetime-local" class="form-control">
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
                        <label class="form-label">Nomor Handphone</label>
                        <input name="handphone" type="text" class="form-control" placeholder="Nomor Handphone">
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
            <form class="modal-content" action="{{ route('pegawai.mahasiswa.import') }}" enctype="multipart/form-data"
                method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Import Excel Data Mahasiswa</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row">
                        <label class="form-label">Pilih file excel</label>
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
