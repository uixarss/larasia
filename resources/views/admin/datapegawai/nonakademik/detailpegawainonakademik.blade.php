@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Pegawai
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.datapegawai.index') }}" class="text-muted text-hover-primary">Kepegawaian</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail Pegawai</li>
    </ul>
@endsection

@section('content')
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#pribadi" role="tab">Data
                Pribadi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#gaji" role="tab">Gaji Pegawai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#sertifikat"role="tab">Data
                Sertifikasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#pendidikan"role="tab">Data
                Pendidikan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#pekerjaan"role="tab">Data
                Pekerjaan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#mutasi"role="tab">Riwayat
                Mutasi</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pribadi" role="tabpanel">
            <form class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                action="{{ route('admin.nonakademik.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Photo Profil</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ $pegawai->photo != null ? asset('admin/assets/images/users/pegawai/' . $pegawai->photo) : asset('admin/assets/images/users/pegawai/no-image.jpg') }}');
                                }
                            </style>
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="photo_pegawai" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                            <div class="text-muted fs-7">Set the photo profile. Only *.png, *.jpg and *.jpeg image
                                files are accepted</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Data Diri</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">NIP Pegawai</label>
                                <input name="NIP" type="text" class="form-control" value="{{ $pegawai->NIP }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Nama Pegawai</label>
                                <input name="nama_pegawai" type="text" class="form-control"
                                    value="{{ $pegawai->nama_pegawai }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Bagian</label>
                                <input name="bagian_pegawai" type="text" class="form-control"
                                    value="{{ $pegawai->bagian_pegawai }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jabatan Pegawai</label>
                                <input name="jabatan_pegawai" type="text" class="form-control"
                                    value="{{ $pegawai->jabatan_pegawai }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Agama</label>
                                <select name="agama" class="form-control">
                                    <option value="Islam" @if ($pegawai->agama == 'Islam') selected @endif>Islam</option>
                                    <option value="Kristen" @if ($pegawai->agama == 'Kristen') selected @endif>Kristen
                                    </option>
                                    <option value="Katolik" @if ($pegawai->agama == 'Katolik') selected @endif>Katolik
                                    </option>
                                    <option value="Hindu" @if ($pegawai->agama == 'Hindu') selected @endif>Hindu</option>
                                    <option value="Budha" @if ($pegawai->agama == 'Budha') selected @endif>Budha</option>
                                </select>
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Status Pegawai</label>
                                <select name="status_pegawai" class="form-control">
                                    <option value="Honorer" @if ($pegawai->status_pegawai == 'Honorer') selected @endif>Honorer
                                    </option>
                                    <option value="PNS" @if ($pegawai->status_pegawai == 'PNS') selected @endif>PNS</option>
                                </select>
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Tanggal Masuk</label>
                                <input name="tanggal_masuk" type="date" class="form-control"
                                    value="{{ $pegawai->tanggal_masuk }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Mulai Tugas</label>
                                <input name="mulai_tugas" type="date" class="form-control"
                                    value="{{ $pegawai->mulai_tugas }}">
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Akhir Tugas</label>
                                <input name="akhir_tugas" type="date" class="form-control"
                                    value="{{ $pegawai->akhir_tugas }}">
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="5">{{ $pegawai->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="gaji" role="tabpanel">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Gaji Pegawai</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_gaji"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>
                        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahgaji">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_gaji"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah Gaji</th>
                                <th>Status</th>
                                <th>Jadwal Kenaikan Gaji</th>
                                <th>Jumlah Gaji</th>
                                <th>Keterangan</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($pegawai->gajis as $gaji)
                                <tr>
                                    <td>{{ $gaji->tanggal }}</td>
                                    <td>Rp {{ $gaji->jumlah_gaji }}</td>
                                    <td>{{ $gaji->status }}</td>
                                    <td>{{ $gaji->tanggal_kenaikan_gaji }}</td>
                                    <td>Rp. {{ $gaji->jumlah_kenaikan_gaji }}-</td>
                                    <td>{{ $gaji->keterangan }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editGaji{{ $gaji->id }}">Edit</a>
                                        <a href="{{ route('admin.nonakademik.delete.gaji', ['id' => $pegawai->id, 'id_gaji' => $gaji->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editGaji{{ $gaji->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Gaji</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.nonakademik.update.gaji', ['id' => $pegawai->id, 'id_gaji' => $gaji->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tanggal</label>
                                                        <input name="tanggal" type="date" class="form-control"
                                                            value="{{ $gaji->tanggal }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jumlah Gaji</label>
                                                        <input name="jumlah_gaji" type="number" class="form-control"
                                                            value="{{ $gaji->jumlah_gaji }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jadwal Kenaikan Gaji</label>
                                                        <input name="tanggal_kenaikan_gaji" type="date"
                                                            class="form-control"
                                                            value="{{ $gaji->tanggal_kenaikan_gaji }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jumlah Gaji</label>
                                                        <input name="jumlah_kenaikan_gaji" type="number"
                                                            class="form-control"
                                                            value="{{ $gaji->jumlah_kenaikan_gaji }}">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input name="keterangan" type="text" class="form-control"
                                                            value="{{ $gaji->keterangan }}">
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
            <div class="modal fade" tabindex="-1" id="tambahgaji">
                <div class="modal-dialog">
                    <form class="modal-content"
                        action="{{ route('admin.nonakademik.tambah.gaji', ['id' => $pegawai->id]) }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Gaji</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal</label>
                                <input name="tanggal" type="date" class="form-control" placeholder="Tanggal">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jumlah Gaji</label>
                                <input name="jumlah_gaji" type="number" class="form-control" placeholder="Jumlah Gaji">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jadwal Kenaikan Gaji</label>
                                <input name="tanggal_kenaikan_gaji" type="date" class="form-control"
                                    placeholder="Jadwal Kenaikan Gaji">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jumlah Gaji</label>
                                <input name="jumlah_kenaikan_gaji" type="number" class="form-control"
                                    placeholder="Jumlah Gaji">
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Keterangan</label>
                                <input name="keterangan" type="text" class="form-control" placeholder="Keterangan">
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
        <div class="tab-pane fade" id="sertifikat" role="tabpanel">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Sertifikat</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_sertifikat"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>
                        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahsertifikat">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_sertifikat"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>Sertifikasi</th>
                                <th>Lembaga</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($pegawai->sertifikats as $sertifikat)
                                <tr>
                                    <td>{{ $sertifikat->sertifikasi }}</td>
                                    <td>{{ $sertifikat->lembaga }}</td>
                                    <td>{{ $sertifikat->tahun }}</td>
                                    <td>{{ $sertifikat->status }}</td>
                                    <td>{{ $sertifikat->keterangan }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editSertifikasi{{ $sertifikat->id }}">Edit</a>
                                        <a href="{{ route('admin.nonakademik.delete.sertifikat', ['id' => $pegawai->id, 'id_sertifikat' => $sertifikat->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editSertifikasi{{ $sertifikat->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Sertifikasi</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.nonakademik.update.sertifikat', ['id' => $pegawai->id, 'id_sertifikat' => $sertifikat->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Sertifikasi</label>
                                                        <input name="sertifikasi" type="text" class="form-control"
                                                            value="{{ $sertifikat->sertifikasi }}r">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Lembaga</label>
                                                        <input name="lembaga" type="text" class="form-control"
                                                            value="{{ $sertifikat->lembaga }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tahun</label>
                                                        <input name="tahun" type="year" class="form-control"
                                                            value="{{ $sertifikat->tahun }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Non Aktif">Non Aktif</option>
                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input name="keterangan" type="text" class="form-control"
                                                            value="{{ $sertifikat->keterangan }}">
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
            <div class="modal fade" tabindex="-1" id="tambahsertifikat">
                <div class="modal-dialog">
                    <form class="modal-content"
                        action="{{ route('admin.nonakademik.tambah.sertifikat', ['id' => $pegawai->id]) }}"
                        method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Sertifikasi</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf

                            <div class="fv-row mb-5">
                                <label class="form-label">Sertifikasi</label>
                                <input name="sertifikasi" type="text" class="form-control" placeholder="Pengajar">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Lembaga</label>
                                <input name="lembaga" type="text" class="form-control" placeholder="Pendidikan">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tahun</label>
                                <input name="tahun" type="year" class="form-control" placeholder="2019">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Keterangan</label>
                                <input name="keterangan" type="text" class="form-control" placeholder="-">
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
        <div class="tab-pane fade" id="pendidikan" role="tabpanel">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Pendidikan</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_pendidikan"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>
                        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahpendidikan">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_pendidikan"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>tingkat</th>
                                <th>Nama Pendidikan</th>
                                <th>Lulus</th>
                                <th>Status</th>
                                <th>Surat Keputusan</th>
                                <th>Keterangan</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($pegawai->pendidikans as $pendidikan)
                                <tr>
                                    <td>{{ $pendidikan->tingkat }}</td>
                                    <td>{{ $pendidikan->nama_pendidikan }}</td>
                                    <td>{{ $pendidikan->tahun_lulus }}</td>
                                    <td>{{ $pendidikan->status }}</td>
                                    <td>{{ $pendidikan->surat_keputusan }}</td>
                                    <td>{{ $pendidikan->keterangan }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPendidikan{{ $pegawai->id }}">Edit</a>
                                        <a href="{{ route('admin.nonakademik.delete.pendidikan', ['id' => $pegawai->id, 'id_pendidikan' => $pendidikan->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editPendidikan{{ $pegawai->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Pendidikan</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.nonakademik.update.pendidikan', ['id' => $pegawai->id, 'id_pendidikan' => $pendidikan->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tingkat</label>
                                                        <input name="tingkat" type="text" class="form-control"
                                                            value="{{ $pendidikan->tingkat }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Nama Pendidikan</label>
                                                        <input name="nama_pendidikan" type="texts" class="form-control"
                                                            value="{{ $pendidikan->nama_pendidikan }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Lulus</label>
                                                        <input name="tahun_lulus" type="text" class="form-control"
                                                            value="{{ $pendidikan->tahun_lulus }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Non Aktif">Non Aktif</option>
                                                        </select>
                                                    </div>


                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Surat Keputusan</label>
                                                        <input name="surat_keputusan" type="texts" class="form-control"
                                                            value="{{ $pendidikan->surat_keputusan }}">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input name="keterangan" type="texts" class="form-control"
                                                            value="{{ $pendidikan->keterangan }}">
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
            <div class="modal fade" tabindex="-1" id="tambahpendidikan">
                <div class="modal-dialog">
                    <form class="modal-content"
                        action="{{ route('admin.nonakademik.tambah.pendidikan', ['id' => $pegawai->id]) }}"
                        method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Pendidikan</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf


                            <div class="fv-row mb-5">
                                <label class="form-label">Tingkat</label>
                                <input name="tingkat" type="text" class="form-control" placeholder="Tingkat">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Pendidikan</label>
                                <input name="nama_pendidikan" type="texts" class="form-control"
                                    placeholder="Nama Pendidikan">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Lulus</label>
                                <input name="tahun_lulus" type="text" class="form-control" placeholder="Lulus">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">Surat Keputusan</label>
                                <input name="surat_keputusan" type="texts" class="form-control"
                                    placeholder="Surat Keputusan">
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Keterangan</label>
                                <input name="keterangan" type="texts" class="form-control" placeholder="Keterangan">
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
        <div class="tab-pane fade" id="pekerjaan" role="tabpanel">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Pekerjaan</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_pekerjaan"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>
                        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahpekerjaan">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_pekerjaan"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>Tahun Awal</th>
                                <th>Tahun Akhir</th>
                                <th>Tempat</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($pegawai->pekerjaans as $pekerjaan)
                                <tr>
                                    <td>{{ $pekerjaan->tahun_awal }}</td>
                                    <td>{{ $pekerjaan->tahun_akhir }}</td>
                                    <td>{{ $pekerjaan->tempat }}</td>
                                    <td>{{ $pekerjaan->jabatan }}</td>
                                    <td>{{ $pekerjaan->status }}</td>
                                    <td>{{ $pekerjaan->keterangan }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPekerjaan{{ $pegawai->id }}">Edit</a>
                                        <a href="{{ route('admin.nonakademik.delete.pekerjaan', ['id' => $pegawai->id, 'id_pekerjaan' => $pekerjaan->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editPekerjaan{{ $pegawai->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Pekerjaan</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.nonakademik.update.pekerjaan', ['id' => $pegawai->id, 'id_pekerjaan' => $pekerjaan->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tahun Awal</label>
                                                        <input name="tahun_awal" type="number" class="form-control"
                                                            value="{{ $pekerjaan->tahun_awal }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tahun Akhir</label>
                                                        <input name="tahun_akhir" type="number" class="form-control"
                                                            value="{{ $pekerjaan->tahun_akhir }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tempat</label>
                                                        <input name="tempat" type="text" class="form-control"
                                                            value="{{ $pekerjaan->tempat }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jabatan</label>
                                                        <input name="jabatan" type="text" class="form-control"
                                                            value="{{ $pekerjaan->jabatan }}">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Non Aktif">Non Aktif</option>
                                                        </select>
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input name="keterangan" type="texts" class="form-control"
                                                            value="{{ $pekerjaan->keterangan }}">
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
            <div class="modal fade" tabindex="-1" id="tambahpekerjaan">
                <div class="modal-dialog">
                    <form class="modal-content"
                        action="{{ route('admin.nonakademik.tambah.pekerjaan', ['id' => $pegawai->id]) }}"
                        method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Pekerjaan</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf


                            <div class="fv-row mb-5">
                                <label class="form-label">Tahun Awal</label>
                                <input name="tahun_awal" type="number" class="form-control" placeholder="2017">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tahun Akhir</label>
                                <input name="tahun_akhir" type="number" class="form-control" placeholder="2019">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tempat</label>
                                <input name="tempat" type="text" class="form-control" placeholder="SMA 1 Cirebon">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jabatan</label>
                                <input name="jabatan" type="text" class="form-control" placeholder="Wakasek">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Keterangan</label>
                                <input name="keterangan" type="texts" class="form-control" placeholder="-">
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
        <div class="tab-pane fade" id="mutasi" role="tabpanel">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Riwayat Mutasi</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_mutasi"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>
                        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahmutasi">Tambah</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_mutasi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
                                <th>Prodi</th>
                                <th>Bagian</th>
                                <th>Jabatan</th>
                                <th>Tanggal Mutasi</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            <?php $no = 1;
                            $f = 1;
                            $j = 1;
                            $p = 1;
                            ?>
                            @foreach ($data_mutasi as $mutasi)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $mutasi->nama_fakultas }}</td>
                                    <td>{{ $mutasi->nama_jurusan }}</td>
                                    <td>{{ $mutasi->nama_program_studi }}</td>
                                    <td>{{ $mutasi->bagian }}</td>
                                    <td>{{ $mutasi->jabatan }}</td>
                                    <td>{{ $mutasi->tanggal_mutasi }}</td>
                                    <td>{{ $mutasi->keterangan }}</td>
                                    <td>{{ $mutasi->status }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMutasi{{ $pegawai->id }}">Edit</a>
                                        <a href="{{ route('admin.nonakademik.delete.mutasi', ['id' => $pegawai->id, 'id_mutasi' => $mutasi->id]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="editMutasi{{ $pegawai->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Mutasi</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('admin.nonakademik.update.mutasi', ['id' => $pegawai->id, 'id_mutasi' => $mutasi->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Fakultas</label>
                                                        <select name="id_fakultas" id="id_fakultas{{ $f }}"
                                                            class="form-control">
                                                            @foreach ($data_fakultas as $fakul)
                                                                <option value="{{ $fakul->id }}"
                                                                    {{ $mutasi->id_fakultas == $fakul->id ? 'selected' : '' }}>
                                                                    {{ $fakul->nama_fakultas }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input name="jurusan" id="jurusan{{ $j }}" type="text"
                                                        value="{{ $mutasi->id_jurusan }}" hidden>
                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jurusan</label>
                                                        <select name="id_jurusan" id="id_jurusan{{ $j }}"
                                                            class="form-control">
                                                            <option value="">== Pilih Jurusan ==</option>
                                                        </select>
                                                    </div>

                                                    <input name="prodi" id="prodi{{ $p }}" type="text"
                                                        value="{{ $mutasi->id_prodi }}" hidden>
                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Program Studi</label>
                                                        <select name="id_prodi" id="id_prodi{{ $p }}"
                                                            class="form-control">
                                                            <option value="">== Pilih Prodi ==</option>
                                                        </select>
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Bagian</label>
                                                        <input name="bagian" type="texts" class="form-control"
                                                            value="{{ $mutasi->bagian }}" placeholder="Bagian">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Jabatan</label>
                                                        <input name="jabatan" type="texts" class="form-control"
                                                            value="{{ $mutasi->jabatan }}" placeholder="Jabatan">
                                                    </div>

                                                    <div class="fv-row mb-5">
                                                        <label class="form-label">Tanggal Mutasi</label>
                                                        <input name="tanggal_mutasi" type="date"
                                                            value="{{ $mutasi->tanggal_mutasi }}" class="form-control">
                                                    </div>

                                                    <div class="fv-row">
                                                        <label class="form-label">Keterangan</label>
                                                        <input name="keterangan" type="texts" class="form-control"
                                                            value="{{ $mutasi->keterangan }}" placeholder="Keterangan">
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
            <div class="modal fade" tabindex="-1" id="tambahmutasi">
                <div class="modal-dialog">
                    <form class="modal-content"
                        action="{{ route('admin.nonakademik.tambah.mutasi', ['id' => $pegawai->id]) }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Mutasi</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf


                            <div class="fv-row mb-5">
                                <label class="form-label">Fakultas</label>
                                <select name="id_fakultas" id="id_fakultas" class="form-control">
                                    @foreach ($data_fakultas as $fakultas)
                                        <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jurusan</label>
                                <select name="id_jurusan" id="id_jurusan" class="form-control">
                                    <option value="">== Pilih Jurusan ==</option>
                                </select>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Program Studi</label>
                                <select name="id_prodi" id="id_prodi" class="form-control">
                                    <option value="">== Pilih Prodi ==</option>
                                </select>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Bagian</label>
                                <input name="bagian" type="texts" class="form-control" placeholder="Bagian">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jabatan</label>
                                <input name="jabatan" type="texts" class="form-control" placeholder="Jabatan">
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal Mutasi</label>
                                <input name="tanggal_mutasi" type="date" class="form-control">
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Keterangan</label>
                                <input name="keterangan" type="texts" class="form-control" placeholder="Keterangan">
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

    <input id="jumlah" name="jumlah" type="text" value="{{ $jumlah }}" hidden>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var fakultas = document.getElementById("id_fakultas");
        if (fakultas && fakultas.value) {
            values = fakultas.value;
            if(values)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.jurusan', '')}}"+"/"+values,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key,value){
                          $('#id_jurusan').append('<option value="'+ value +'">'+ key +'</option>');
                        });

                        var jurusan = document.getElementById("id_jurusan");

                        jQuery.ajax({
                          url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan.value,
                          type : "GET",
                          dataType : "json",
                          success:function(data)
                          {
                              console.log(data);
                              jQuery('#id_prodi').empty();
                              jQuery.each(data, function(key,value){
                                $('#id_prodi').append('<option value="'+ value +'">'+ key +'</option>');
                              });
                          }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_jurusan"]').empty();
            }
        }



    $(document).on('change','#id_fakultas',function(){
            var fakultas = jQuery(this).val();
                  if(fakultas)
                  {
                      jQuery.ajax({
                        url :"{{ route( 'admin.kurikulum.jurusan', '')}}"+"/"+fakultas,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            jQuery('#id_jurusan').empty();
                            jQuery.each(data, function(key,value){
                              $('#id_jurusan').append('<option value="'+ value +' ">'+ key +'</option>');

                            });

                            var jurusan = document.getElementById("id_jurusan");
                              jQuery.ajax({
                                url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan.value,
                                type : "GET",
                                dataType : "json",
                                success:function(data)
                                {
                                    console.log(data);
                                    jQuery('#id_prodi').empty();
                                    jQuery.each(data, function(key,value){
                                      $('#id_prodi').append('<option value="'+ value +'">'+ key +'</option>');
                                    });
                                }
                              });
                        }
                      });
                  }
                  else
                  {
                      $('select[name="id_jurusan"]').empty();
                  }


        });


      $(document).on('change','#id_jurusan',function(){
            var jurusan = jQuery(this).val();
                  if(jurusan)
                  {
                      jQuery.ajax({
                        url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('#id_prodi').empty();
                            jQuery.each(data, function(key,value){
                              $('#id_prodi').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                      });
                  }
                  else
                  {
                      $('select[name="id_prodi"]').empty();
                  }
        });


        var jumlah = document.getElementById("jumlah");
    for (let i = 1; i <= jumlah.value; i++) {
      //jurusan
      $(document).on('change','#id_fakultas'+i+'',function(){
        var id_jurusan = jQuery(this).val();
               if(id_jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.jurusan', '')}}"+"/"+id_jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#id_jurusan'+i+'').empty();
                        jQuery.each(data, function(key,value){
                           $('#id_jurusan'+i+'').append('<option value="'+ value +'">'+ key +'</option>');
                        });

                        var jurusan = document.getElementById("id_jurusan"+i);
                              jQuery.ajax({
                                url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan.value,
                                type : "GET",
                                dataType : "json",
                                success:function(data)
                                {
                                    console.log(data);
                                    jQuery('#id_prodi'+i).empty();
                                    jQuery.each(data, function(key,value){
                                      $('#id_prodi'+i).append('<option value="'+ value +'">'+ key +'</option>');
                                    });
                                }
                              });
                     }
                  });
               }
               else
               {
                  $('select[name="id_jurusan'+i+'"]').empty();
               }

        var myInput2 = document.getElementById("id_jurusan"+i);
        if (myInput2 && myInput2.value) {
          console.log("jurusan = " +myInput2.value);
            var jurusan = myInput2.value;
            if(jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        var prodi = document.getElementById('prodi'+i);
                        jQuery('#id_prodi'+i).empty();
                        jQuery.each(data, function(key,value){
                            if(prodi.value!=value){
                                $('#id_prodi'+i).append('<option value="'+ value +'" >'+ key +'</option>');
                            }else{
                                $('#id_prodi'+i).append('<option value="'+ value +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_prodi"'+i+']').empty();
            }
        }

    });

    var myInput2 = document.getElementById("id_fakultas"+i);
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if(jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.jurusan', '')}}"+"/"+jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        var prodi = document.getElementById('jurusan'+i);
                        jQuery('#id_jurusan'+i).empty();
                        jQuery.each(data, function(key,value){
                            if(prodi.value!=value){
                                $('#id_jurusan'+i).append('<option value="'+ value +'" >'+ key +'</option>');
                            }else{
                                $('#id_jurusan'+i).append('<option value="'+ value +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_jurusan"'+i+']').empty();
            }
        }

    //prodi
    $(document).on('change','#id_jurusan'+i+'',function(){
        var id_jurusan = jQuery(this).val();
               if(id_jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+id_jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#id_prodi'+i+'').empty();
                        jQuery.each(data, function(key,value){
                           $('#id_prodi'+i+'').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_prodi'+i+'"]').empty();
               }
    });

    var myInput2 = document.getElementById("jurusan"+i);
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if(jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'admin.kurikulum.prodi', '')}}"+"/"+jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        var prodi = document.getElementById('prodi'+i);
                        jQuery('#id_prodi'+i).empty();
                        jQuery.each(data, function(key,value){
                            if(prodi.value!=value){
                                $('#id_prodi'+i).append('<option value="'+ value +'" >'+ key +'</option>');
                            }else{
                                $('#id_prodi'+i).append('<option value="'+ value +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_prodi"'+i+']').empty();
            }
        }


    }

        var DataGaji = function() {
            var table = document.getElementById('table_gaji');
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
                            targets: 6
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_gaji');
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

        var DataSertifikat = function() {
            var table = document.getElementById('table_sertifikat');
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
                const filterSearch = document.getElementById('table_search_sertifikat');
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

        var DataPendidikan = function() {
            var table = document.getElementById('table_pendidikan');
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
                            targets: 6
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_pendidikan');
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

        var DataPekerjaan = function() {
            var table = document.getElementById('table_pekerjaan');
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
                            targets: 6
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_pekerjaan');
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

        var DataMutasi = function() {
            var table = document.getElementById('table_mutasi');
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
                            targets: 9
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_mutasi');
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
            DataGaji.init();
            DataSertifikat.init();
            DataPendidikan.init();
            DataPekerjaan.init();
            DataMutasi.init();
        });
    </script>
@endsection
