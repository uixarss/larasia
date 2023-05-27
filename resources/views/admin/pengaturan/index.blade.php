@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Data Tahun Ajar & Semester
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Data Tahun Ajar & Semester</li>
    </ul>
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2 mb-1">Data Data Tahun Ajaran</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahWaktu">Tambah Tahun Ajaran</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_visi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th class="min-w-50px">No</th>
                                <th class="min-w-100px">Tahun Ajaran</th>
                                <th class="min-w-100px">Tahun Mulai</th>
                                <th class="min-w-100px">Tahun Akhir</th>
                                <th class="min-w-50px">Status</th>
                                <th class="min-w-150px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_tahun_ajaran as $no => $tahun_ajaran)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $tahun_ajaran->nama_tahun_ajaran }}</td>
                                    <td>{{ $tahun_ajaran->start_date }}</td>
                                    <td>{{ $tahun_ajaran->end_date }}</td>
                                    <td>
                                        @if ($tahun_ajaran->status != 0)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edittahunajaran{{ $tahun_ajaran->id }}">Edit</a>
                                        <a href="{{ route('admin.pengaturan.deletetahunajaran', $tahun_ajaran->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>

                                    <!-- MODAL EDIT TAHUN AJARAN-->
                                    <div class="modal fade" id="edittahunajaran{{ $tahun_ajaran->id }}"
                                        data-backdrop="static" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Data Tahun Ajaran</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('admin.pengaturan.updatetahunajaran', $tahun_ajaran->id) }}"
                                                        method="post">
                                                        @csrf

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama_tahun_ajaran">Tahun Ajaran</label>
                                                            <input name="nama_tahun_ajaran" type="text"
                                                                class="form-control"
                                                                value="{{ $tahun_ajaran->nama_tahun_ajaran }}"
                                                                placeholder="Masukan Tahun Ajaran Exa : 2020/2021" required>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="start_date">Tahun Mulai</label>
                                                            <input name="start_date" type="date" class="form-control"
                                                                value="{{ $tahun_ajaran->start_date }}"
                                                                placeholder="Masukan Tahun Mulai" required>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="end_date"> Tahun Akhir</label>
                                                            <input name="end_date" type="date" class="form-control"
                                                                value="{{ $tahun_ajaran->end_date }}"
                                                                placeholder="Masukan Tahun Akhir" required>
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="status"> Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="1"
                                                                    @if ($tahun_ajaran->status == '1') selected @endif>Aktif
                                                                </option>
                                                                <option value="0"
                                                                    @if ($tahun_ajaran->status == '0') selected @endif>Tidak
                                                                    Aktif</option>
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL EDIT TAHUN AJARAN-->

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- BEGIN Modal Tambah-->
            <div class="modal fade" tabindex="-1" id="tambahWaktu">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.pengaturan.tambahtahunajaran') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Data Tahun Ajaran</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" for="nama_tahun_ajaran">Tahun Ajaran</label>
                                <input name="nama_tahun_ajaran" type="text" class="form-control"
                                    placeholder="Masukan Tahun Ajaran Exa : 2020/2021" required>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label" for="start_date">Tahun Mulai</label>
                                <input name="start_date" type="date" class="form-control"
                                    placeholder="Masukan Tahun Mulai" required>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label" for="end_date"> Tahun Akhir</label>
                                <input name="end_date" type="date" class="form-control"
                                    placeholder="Masukan Tahun Akhir" required>
                            </div>

                            <div class="fv-row">
                                <label class="form-label" for="status"> Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
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
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2 mb-1">Data Semester</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahHari">Tambah Semester</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_misi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Semester</th>
                                <th>Status</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_semester as $no => $semester)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $semester->nama_semester }}</td>
                                    <td>
                                        @if ($semester->status != 0)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editsemester{{ $semester->id }}">Edit</a>
                                        <a href="{{ route('admin.pengaturan.deletesemester', $semester->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>

                                    <!-- MODAL EDIT SEMESTER-->
                                    <div class="modal fade" id="editsemester{{ $semester->id }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Data Semester</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('admin.pengaturan.updatesemester', $semester->id) }}"
                                                        method="post">
                                                        @csrf

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama_semester">Semester</label>
                                                            <input name="nama_semester" type="text"
                                                                class="form-control"
                                                                value="{{ $semester->nama_semester }}"
                                                                placeholder="Masukan Nama Semester" required>
                                                        </div>
                                                        <div class="fv-row">
                                                            <label class="form-label" for="status"> Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="1"
                                                                    @if ($semester->status == '1') selected @endif>Aktif
                                                                </option>
                                                                <option value="0"
                                                                    @if ($semester->status == '0') selected @endif>Tidak
                                                                    Aktif</option>
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL EDIT SEMESTER-->

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- BEGIN Modal Tambah-->
            <div class="modal fade" tabindex="-1" id="tambahHari">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.pengaturan.tambahsemester') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Semester</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>


                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" for="nama_semester">Semester</label>
                                <input name="nama_semester" type="text" class="form-control"
                                    placeholder="Masukan Nama Semester" required>
                            </div>
                            <div class="fv-row">
                                <label class="form-label" for="status"> Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
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
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#table_visi").DataTable({
            'order': [],
            "info": false,
            'columnDefs': [{
                    orderable: false,
                    targets: 2
                }, // Disable ordering on column 6 (actions)
            ]
        });
        $("#table_misi").DataTable({
            'order': [],
            "info": false,
            'columnDefs': [{
                    orderable: false,
                    targets: 2
                }, // Disable ordering on column 6 (actions)
            ]
        });
    </script>
@endsection
