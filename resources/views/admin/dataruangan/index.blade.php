@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Data Ruangan
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Data Ruangan</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item">
                    <a class="nav-link active text-active-primary py-5" data-bs-toggle="tab" href="#kelas">Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#pegawai">Pegawai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#lab">Lab</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#ukm">UKM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#umum">Umum</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="kelas" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_kelas"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_kelas">Tambah</button>
                        </div>
                    </div>
                    <table id="table_kelas"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Kondisi Ruangan</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_ruangan as $ruangan)
                                <tr>
                                    <td>{{ $ruangan->kode_ruangan }}</td>
                                    <td>{{ $ruangan->nama_ruangan }}</td>
                                    <td>{{ $ruangan->kondisi_ruangan }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editruangkelas{{ $ruangan->id }}">Edit</a>
                                        <a href="{{ route('admin.ruangan.destroy', ['id' => $ruangan->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                                    </td>
                                </tr>

                                <!-- MODAL EDIT RUANG KELAS-->
                                <div class="modal fade" id="editruangkelas{{ $ruangan->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('admin.ruangan.update', ['id' => $ruangan->id]) }}"
                                            method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Ruang Kelas</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    @csrf


                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="kode_kelas">ID Ruangan</label>
                                                        <input name="kode_ruangan" type="text" class="form-control"
                                                            value="{{ $ruangan->kode_ruangan }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="nama_kelas">Nama Ruangan</label>
                                                        <input name="nama_ruangan" type="text" class="form-control"
                                                            value="{{ $ruangan->nama_ruangan }}">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                                        <input name="kondisi_ruangan" type="text" class="form-control"
                                                            value="{{ $ruangan->kondisi_ruangan }}">
                                                    </div>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_kelas">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.ruangan.store') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Ruang Kelas</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="kode_kelas">ID Ruangan</label>
                                        <input name="kode_ruangan" type="text" class="form-control"
                                            placeholder="Contoh : RA001">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="nama_kelas">Nama Ruangan</label>
                                        <input name="nama_ruangan" type="text" class="form-control"
                                            placeholder="Ruang A001">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                        <input name="kondisi_ruangan" type="text" class="form-control"
                                            placeholder="Contoh : Baik">
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
                <div class="tab-pane fade" id="pegawai" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_pegawai"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_pegawai">Tambah</button>
                        </div>
                    </div>
                    <table id="table_pegawai"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Bagian Ruangan</th>
                                <th>Kondisi Ruangan</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_ruang_pegawai as $ruang_pegawai)
                                <tr>
                                    <td>{{ $ruang_pegawai->kode }}</td>
                                    <td>{{ $ruang_pegawai->nama }}</td>
                                    <td>{{ $ruang_pegawai->bagian }}</td>
                                    <td>{{ $ruang_pegawai->kondisi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editruangpegawai{{ $ruang_pegawai->id }}">Edit</a>
                                        <a href="{{ route('admin.ruang.pegawai.destroy', ['id' => $ruang_pegawai->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT RUANG KELAS-->
                                <div class="modal fade" id="editruangpegawai{{ $ruang_pegawai->id }}"
                                    data-backdrop="static" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Ruang Pegawai</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.ruang.pegawai.update', ['id' => $ruang_pegawai->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode">ID Ruangan</label>
                                                            <input name="kode" type="text" class="form-control"
                                                                value="{{ $ruang_pegawai->kode }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama">Nama Ruangan</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                value="{{ $ruang_pegawai->nama }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="bagian">Bagian
                                                                Ruangan</label>
                                                            <input name="bagian" type="text" class="form-control"
                                                                value="{{ $ruang_pegawai->bagian }}">
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="kondisi">Kondisi
                                                                Ruangan</label>
                                                            <input name="kondisi" type="text" class="form-control"
                                                                value="{{ $ruang_pegawai->kondisi }}">
                                                        </div>


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
                            @endforeach


                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_pegawai">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.ruang.pegawai.store') }}"
                                method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Ruang Pegawai</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="kode">ID Ruangan</label>
                                        <input name="kode" type="text" class="form-control"
                                            placeholder="ID Ruangan">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="nama">Nama Ruangan</label>
                                        <input name="nama" type="text" class="form-control"
                                            placeholder="Nama Ruangan">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="bagian">Bagian Ruangan</label>
                                        <input name="bagian" type="text" class="form-control"
                                            placeholder="Bagian Ruangan">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                        <input name="kondisi" type="text" class="form-control"
                                            placeholder="Kondisi Ruangan">
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
                <div class="tab-pane fade" id="lab" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_lab"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_lab">Tambah</button>
                        </div>
                    </div>
                    <table id="table_lab"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Kondisi Ruangan</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_ruang_lab as $ruang_lab)
                                <tr>
                                    <td>{{ $ruang_lab->kode }}</td>
                                    <td>{{ $ruang_lab->nama }}</td>
                                    <td>{{ $ruang_lab->kondisi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editruanglab{{ $ruang_lab->id }}">Edit</a>
                                        <a href="{{ route('admin.ruang.lab.destroy', ['id' => $ruang_lab->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                                    </td>
                                </tr>

                                <!-- MODAL EDIT RUANG LAB-->
                                <div class="modal fade" id="editruanglab{{ $ruang_lab->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Ruang Lab</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.ruang.lab.update', ['id' => $ruang_lab->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode">ID Ruangan</label>
                                                            <input name="kode" type="text" class="form-control"
                                                                value="{{ $ruang_lab->kode }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama">Nama Ruangan</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                value="{{ $ruang_lab->nama }}">
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="kondisi">Kondisi
                                                                Ruangan</label>
                                                            <input name="kondisi" type="text" class="form-control"
                                                                value="{{ $ruang_lab->kondisi }}">
                                                        </div>

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
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" tabindex="-1" id="tambah_lab">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.ruang.lab.store') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Ruang Lab</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="kode">ID Ruangan</label>
                                        <input name="kode" type="text" class="form-control"
                                            placeholder="ID Ruangan">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="nama">Nama Ruangan</label>
                                        <input name="nama" type="text" class="form-control"
                                            placeholder="Nama Ruangan">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                        <input name="kondisi" type="text" class="form-control"
                                            placeholder="Kondisi Ruangan">
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
                <div class="tab-pane fade" id="ukm" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_ukm"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_ukm">Tambah</button>
                        </div>
                    </div>
                    <table id="table_ukm"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Kondisi Ruangan</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_ruang_ekstra as $ruang_ekstra)
                                <tr>
                                    <td>{{ $ruang_ekstra->kode }}</td>
                                    <td>{{ $ruang_ekstra->nama }}</td>
                                    <td>{{ $ruang_ekstra->kondisi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editruangekstra{{ $ruang_ekstra->id }}">Edit</a>
                                        <a href="{{ route('admin.ruang.ekstra.destroy', ['id' => $ruang_ekstra->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                                    </td>
                                </tr>

                                <!-- MODAL EDIT RUANG ESKUL-->
                                <div class="modal fade" id="editruangekstra{{ $ruang_ekstra->id }}"
                                    data-backdrop="static" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Ruang UKM</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.ruang.ekstra.update', ['id' => $ruang_ekstra->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode">ID Ruangan</label>
                                                            <input name="kode" type="text" class="form-control"
                                                                value="{{ $ruang_ekstra->kode }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama">Nama Ruangan</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                value="{{ $ruang_ekstra->nama }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kondisi">Kondisi
                                                                Ruangan</label>
                                                            <input name="kondisi" type="text" class="form-control"
                                                                value="{{ $ruang_ekstra->kondisi }}">
                                                        </div>

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
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" tabindex="-1" id="tambah_ukm">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.ruang.ekstra.store') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Ruang UKM</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="kode">ID Ruangan</label>
                                        <input name="kode" type="text" class="form-control"
                                            placeholder="ID Ruangan">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="nama">Nama Ruangan</label>
                                        <input name="nama" type="text" class="form-control"
                                            placeholder="Nama Ruangan">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                        <input name="kondisi" type="text" class="form-control"
                                            placeholder="Kondisi Ruangan">
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
                <div class="tab-pane fade" id="umum" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_umum"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_umum">Tambah</button>
                        </div>
                    </div>
                    <table id="table_umum"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Kondisi Ruangan</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_ruang_umum as $ruang_umum)
                                <tr>
                                    <td>{{ $ruang_umum->kode }}</td>
                                    <td>{{ $ruang_umum->nama }}</td>
                                    <td>{{ $ruang_umum->kondisi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editruangumum{{ $ruang_umum->id }}">Edit</a>
                                        <a href="{{ route('admin.ruang.umum.destroy', ['id' => $ruang_umum->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                                    </td>
                                </tr>

                                <!-- MMODAL EDIT RUANG ESKUL-->
                                <div class="modal fade" id="editruangumum{{ $ruang_umum->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Ruang Umum</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.ruang.umum.update', ['id' => $ruang_umum->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode">ID Ruangan</label>
                                                            <input name="kode" type="text" class="form-control"
                                                                value="{{ $ruang_umum->kode }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="nama">Nama Ruangan</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                value="{{ $ruang_umum->nama }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kondisi">Kondisi
                                                                Ruangan</label>
                                                            <input name="kondisi" type="text" class="form-control"
                                                                value="{{ $ruang_umum->kondisi }}">
                                                        </div>

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
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" tabindex="-1" id="tambah_umum">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.ruang.umum.store') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Ruang Umum</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="kode">ID Ruangan</label>
                                        <input name="kode" type="text" class="form-control"
                                            placeholder="ID Ruangan">
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="nama">Nama Ruangan</label>
                                        <input name="nama" type="text" class="form-control"
                                            placeholder="Nama Ruangan">
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="kondisi">Kondisi Ruangan</label>
                                        <input name="kondisi" type="text" class="form-control"
                                            placeholder="Kondisi Ruangan">
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

        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ListKelas = function() {
            var table = document.getElementById('table_kelas');
            var datatable;
            var toolbarBase;

            // Private functions
            var initDataTable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
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
                const filterSearch = document.getElementById('table_search_kelas');
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

        var ListPegawai = function() {
            var table = document.getElementById('table_pegawai');
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
                const filterSearch = document.getElementById('table_search_pegawai');
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

        var ListLab = function() {
            var table = document.getElementById('table_lab');
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
                const filterSearch = document.getElementById('table_search_lab');
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

        var ListUKM = function() {
            var table = document.getElementById('table_ukm');
            var datatable;
            var toolbarBase;

            // Private functions
            var initDataTable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
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
                const filterSearch = document.getElementById('table_search_ukm');
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

        var ListUmum = function() {
            var table = document.getElementById('table_umum');
            var datatable;
            var toolbarBase;

            // Private functions
            var initDataTable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
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
                const filterSearch = document.getElementById('table_search_umum');
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
            ListKelas.init();
            ListPegawai.init();
            ListLab.init();
            ListUKM.init();
            ListUmum.init();
        });
    </script>
@endsection
