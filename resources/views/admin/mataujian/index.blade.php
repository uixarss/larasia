@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Mata Ujian
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Mata Ujian</li>
    </ul>
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Jenis Ujian</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahJenisUjian">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_visi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Ujian</th>
                                <th>Nama Ujian</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_jenis_ujian as $jenis_ujian)
                                <tr>
                                    <td>{{ $jenis_ujian->kode_jenis_ujian }}</td>
                                    <td>{{ $jenis_ujian->nama_jenis_ujian }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editJenisUjian{{ $jenis_ujian->id }}">Edit</a>
                                        <a href="{{ route('admin.jenisujian.destroy', ['id' => $jenis_ujian->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>
                                <!-- MODAL EDIT JENIS UJIAN-->
                                <div class="modal fade" id="editJenisUjian{{ $jenis_ujian->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Jenis Ujian</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.jenisujian.update', ['id' => $jenis_ujian->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="kode_jenis_ujian">ID Ujian</label>
                                                        <input name="kode_jenis_ujian" type="text" class="form-control"
                                                            value="{{ $jenis_ujian->kode_jenis_ujian }}">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label" for="nama_jenis_ujian">Nama Ujian</label>
                                                        <input name="nama_jenis_ujian" type="text" class="form-control"
                                                            value="{{ $jenis_ujian->nama_jenis_ujian }}">
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

                </div>
            </div>
            <!-- BEGIN Modal Tambah-->
            <div class="modal fade" tabindex="-1" id="tambahJenisUjian">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.jenisujian.add') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Jenis Ujian</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" for="kode_jenis_ujian">Kode Jenis Ujian</label>
                                <input name="kode_jenis_ujian" type="text" class="form-control"
                                    placeholder="Masukan Kode Jenis Ujian">
                            </div>

                            <div class="fv-row">
                                <label class="form-label" for="nama_jenis_ujian">Nama Jenis Ujian</label>
                                <input name="nama_jenis_ujian" type="texts" class="form-control"
                                    placeholder="Masukan Nama Ujian">
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
                        <span class="card-label fw-bold fs-2x mb-1">Aturan Penilaian Grade</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahGrade">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_misi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>ID Grade</th>
                                <th>Grade</th>
                                <th>Nilai</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_grade_nilai as $grade_nilai)
                                <tr>
                                    <td>{{ $grade_nilai->kode_grade_nilai }}</td>
                                    <td>{{ $grade_nilai->nama_grade }}</td>
                                    <td>{{ $grade_nilai->nilai_rendah }} - {{ $grade_nilai->nilai_tinggi }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editGrade{{ $grade_nilai->id }}">Edit</a>
                                        <a href="{{ route('admin.grade.destroy', ['id' => $grade_nilai->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- MMODAL EDIT JENIS UJIAN-->
                                <div class="modal fade" id="editGrade{{ $grade_nilai->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Aturan Penilaian Grade</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.grade.update', ['id' => $grade_nilai->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="kode_grade_nilai">ID Grade</label>
                                                        <input name="kode_grade_nilai" type="text"
                                                            class="form-control"
                                                            value="{{ $grade_nilai->kode_grade_nilai }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="nama_grade">Grade</label>
                                                        <input name="nama_grade" type="text" class="form-control"
                                                            value="{{ $grade_nilai->nama_grade }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" for="nilai_rendah">Nilai Rendah</label>
                                                        <input name="nilai_rendah" type="number" class="form-control"
                                                            value="{{ $grade_nilai->nilai_rendah }}">
                                                    </div>
                                                    <div class="fv-row">
                                                        <label class="form-label" for="nilai_tinggi">Nilai Tinggi</label>
                                                        <input name="nilai_tinggi" type="number" class="form-control"
                                                            value="{{ $grade_nilai->nilai_tinggi }}">
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

                </div>
            </div>
            <!-- BEGIN Modal Tambah-->
            <div class="modal fade" tabindex="-1" id="TambahGrade">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.grade.add') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Hari</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>


                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" for="kode_grade_nilai">ID Grade</label>
                                <input name="kode_grade_nilai" type="text" class="form-control"
                                    placeholder="Masukan ID Grade">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label" for="nama_grade">Grade</label>
                                <input name="nama_grade" type="text" class="form-control"
                                    placeholder="Masukan Grade">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label" for="nilai_rendah">Nilai Rendah</label>
                                <input name="nilai_rendah" type="decimal" class="form-control"
                                    placeholder="Masukan Nilai">
                            </div>

                            <div class="fv-row">
                                <label class="form-label" for="nilai_tinggi">Nilai Tinggi</label>
                                <input name="nilai_tinggi" type="decimal" class="form-control"
                                    placeholder="Masukan Nilai">
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
        <div class="col-xxl-12 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Aturan Penilaian Rapor</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahPenilian">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_visi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai KKM</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_kkm_rapor as $rapor)
                                <tr>
                                    <td>{{ $rapor->mapel->nama_mapel }}</td>
                                    <td>{{ $rapor->nilai }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editRapor{{ $rapor->id }}">Edit</a>
                                        <a href="{{ route('admin.rapor.destroy', ['id' => $rapor->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- MMODAL EDIT JENIS UJIAN-->
                                <div class="modal fade" id="editRapor{{ $rapor->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Aturan Penilaian Rapor</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('admin.rapor.update', ['id' => $rapor->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label" class="control-label">Masukan Mata
                                                            Pelajaran</label>
                                                        <select name="mapel_id" class="form-control select"
                                                            data-live-search="true" required>
                                                            <option value="">-Masukan Mata Pelajaran-</option>

                                                            @foreach ($data_mapel as $mapel)
                                                                @if ($rapor->mapel_id == $mapel->id)
                                                                    <option value="{{ $mapel->id }}" selected>
                                                                        {{ $mapel->nama_mapel }}</option>
                                                                @else
                                                                    <option value="{{ $mapel->id }}">
                                                                        {{ $mapel->nama_mapel }}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label" for="nilai">Grade</label>
                                                        <input name="nilai" type="text" class="form-control"
                                                            value="{{ $rapor->nilai }}">
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

                </div>
            </div>
            <!-- BEGIN Modal Tambah-->
            <div class="modal fade" tabindex="-1" id="tambahPenilian">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.rapor.add') }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Jenis Ujian</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" class="control-label">Masukan Mata Pelajaran</label>
                                <select name="mapel_id" class="form-control select" data-live-search="true" required>
                                    <option value="">-Masukan Mata Pelajaran-</option>

                                    @foreach ($data_mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="fv-row">
                                <label class="form-label" for="nilai">Grade</label>
                                <input name="nilai" type="text" class="form-control" placeholder="Masukkan nilai">
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
