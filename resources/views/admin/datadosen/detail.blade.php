@extends('layouts.adtheme')


@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Dosen
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dosen.index') }}" class="text-muted text-hover-primary">Dosen</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail Dosen</li>
    </ul>
@endsection

@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if ($dosen->photo != null)
                                <img src="{{ asset('admin/assets/images/users/guru/'.$dosen->photo) }}">
                            @else
                                <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}">
                            @endif
                        </div>
                        <a href="#"
                            class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $dosen->nama_dosen }}</a>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-primary d-inline">{{ $dosen->nidn }}</div>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="pb-5 fs-6">
                            <div class="fw-bold mt-5">Jenis Kelamin</div>
                            <div class="text-gray-600">{{ $dosen->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                            <div class="text-gray-600">{{ $dosen->tempat_lahir }}, {{ $dosen->tanggal_lahir }}</div>
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $dosen->email }}</a>
                            </div>
                            <div class="fw-bold mt-5">No. HP</div>
                            <div class="text-gray-600">
                                <a href="#"
                                    class="text-gray-600 text-hover-primary">{{ $dosen->handphone == null ? '-' : $dosen->handphone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kampus">Data Kampus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#pribadi">Data Pribadi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#other">Lainnya</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="kampus" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9" action="{{ route('admin.dosen.updatedatakampus', $dosen->id) }}"
                        method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Kampus</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="fv-row mb-5">
                                <label class="form-label">NIDN</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nidn" type="text" class="form-control" value="{{ $dosen->nidn }}"
                                        required>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">NIP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nip" type="text" class="form-control" value="{{ $dosen->nip }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_dosen" type="text" class="form-control"
                                        value="{{ $dosen->nama_dosen }}" required>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">No SK CPNS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="no_sk_cpns" type="tel" class="form-control"
                                        value="{{ $dosen->no_sk_cpns }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal SK CPNS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="tanggal_sk_cpns" type="datepicker" onkeydown="return false"
                                        class="form-control datepicker" value="{{ $dosen->tanggal_sk_cpns }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">No SK Pengangkatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="no_sk_pengangkatan" type="text" class="form-control"
                                        value="{{ $dosen->no_sk_pengangkatan }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Mulai SK Pengangkatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="mulai_sk_pengangkatan" type="datepicker" class="form-control datepicker"
                                        value="{{ $dosen->mulai_sk_pengangkatan }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Lembaga Pengangkatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="lembaga" class="form-control">
                                        @foreach ($data_lembaga as $lembaga)
                                            <option value="{{ $lembaga->id }},{{ $lembaga->nama_lembaga }}"
                                                {{ $lembaga->id == $dosen->id_lembaga_pengangkatan ? 'selected' : '' }}>
                                                {{ $lembaga->nama_lembaga }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Pangkat / Golongan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="pangkat_golongan" class="form-control" onfocus='this.size=3;'
                                        onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                        @foreach ($pangkat_golongan as $panggol)
                                            <option
                                                value="{{ $panggol->id }},{{ $panggol->pangkat }} - {{ $panggol->golongan }}"
                                                {{ $panggol->id == $dosen->id_pangkat_golongan ? 'selected' : '' }}>
                                                {{ $panggol->pangkat }} - {{ $panggol->golongan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Sumber Gaji</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="sumber_gaji" class="form-control">
                                        @foreach ($sumber_gaji as $sumber)
                                            <option value="{{ $sumber->id }},{{ $sumber->status_milik }}"
                                                {{ $sumber->id == $dosen->id_sumber_gaji ? 'selected' : '' }}>
                                                {{ $sumber->status_milik }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal Mulai PNS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="tanggal_mulai_pns" onkeydown="return false" type="datepicker"
                                        class="form-control datepicker" value="{{ $dosen->tanggal_mulai_pns }}">
                                </div>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Status Dosen</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="status" class="form-control">
                                        <option value="1,Aktif" @if ($dosen->id_status_aktif == '1') selected @endif>Aktif
                                        </option>
                                        <option value="0,Tidak Aktif" @if ($dosen->id_status_aktif == '0') selected @endif>
                                            Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pribadi" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9"
                        action="{{ route('admin.dosen.updatedatapribadi', $dosen->id) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Pribadi</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">

                            <div class="fv-row mb-5">
                                <label class="form-label">NIK</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nik" type="text" class="form-control"
                                        value="{{ $dosen->nik }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_dosen" type="text" class="form-control"
                                        value="{{ $dosen->nama_dosen }}" required>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                    <option value="L" @if ($dosen->jenis_kelamin == 'L') selected @endif>Laki-Laki
                                    </option>
                                    <option value="P" @if ($dosen->jenis_kelamin == 'P') selected @endif>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tempat Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="tempat_lahir" type="text" class="form-control"
                                        value="{{ $dosen->tempat_lahir }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                    <input name="tanggal_lahir" onkeydown="return false" type="datepicker"
                                        class="form-control datepicker" value="{{ $dosen->tanggal_lahir }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Agama</label>
                                <div class="input-group">
                                    <select name="nama_agama" class="form-control">
                                        <option value="1,Islam" @if ($dosen->id_agama == 1) selected @endif>Islam
                                        </option>
                                        <option value="2,Kristen" @if ($dosen->id_agama == 2) selected @endif>Kristen
                                        </option>
                                        <option value="3,Katolik" @if ($dosen->id_agama == 3) selected @endif>Katolik
                                        </option>
                                        <option value="4,Hindu" @if ($dosen->id_agama == 4) selected @endif>Hindu
                                        </option>
                                        <option value="5,Budha" @if ($dosen->id_agama == 5) selected @endif>Budha
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Ibu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_ibu" type="text" class="form-control"
                                        value="{{ $dosen->nama_ibu }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">NPWP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="npwp" type="text" class="form-control"
                                        value="{{ $dosen->npwp }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="email" type="email" class="form-control"
                                        value="{{ $dosen->email }}" required>
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="telepon" type="tel" class="form-control"
                                        value="{{ $dosen->telepon }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Handphone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="handphone" type="tel" class="form-control"
                                        value="{{ $dosen->handphone }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jalan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="jalan" type="text" class="form-control"
                                        value="{{ $dosen->jalan }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Dusun</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="dusun" type="text" class="form-control"
                                        value="{{ $dosen->dusun }}">
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">RT/RW</label>
                                <div class="row">
                                    <div class="input-group col-sm">
                                        <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                        <input name="rt" type="text" class="form-control"
                                            value="{{ $dosen->rt }}">
                                    </div>
                                    <div class="input-group col-sm">
                                        <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                        <input name="rw" type="text" class="form-control"
                                            value="{{ $dosen->rw }}">
                                    </div>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Desa / Kelurahan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="ds_kel" type="text" class="form-control"
                                        value="{{ $dosen->ds_kel }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kode POS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="kode_pos" type="text" class="form-control"
                                        value="{{ $dosen->kode_pos }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kota</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select id="nama_kota" name="nama_kota" class="form-control">
                                        @foreach ($data_kota as $kota)
                                            <option value="{{ $kota->id }},{{ $kota->name }}"
                                                {{ $kota->id == $dosen->id_wilayah ? 'selected' : '' }}>
                                                {{ $kota->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <input name="id_kecamatan" id="id_kecamatan" type="text" class="form-control"
                                value="{{ $dosen->id_kecamatan }}" hidden>
                            <div class="fv-row">
                                <label class="form-label">Kecamatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="">== Pilih Kecamatan ==</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="other" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9" action="{{ route('admin.dosen.updatelainnya', $dosen->id) }}"
                        method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Lainnya</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="form-group mb-5">
                                <label class="form-label">Status Pernikahan</label>
                                <div class="input-group">
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="belum" class="form-check-input" type="radio"
                                            name="status_pernikahan" value="0"
                                            {{ $dosen->status_pernikahan == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Belum</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="menikah" class="form-check-input" type="radio"
                                            name="status_pernikahan" value="1"
                                            {{ $dosen->status_pernikahan == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Menikah</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input id="cerai" class="form-check-input" type="radio"
                                            name="status_pernikahan" value="2"
                                            {{ $dosen->status_pernikahan == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label">Cerai</label>
                                    </div>
                                </div>
                            </div>

                            <div class="fv-row my-5" id="nama_suami_istri"
                                {{ $dosen->status_pernikahan == 0 || $dosen->status_pernikahan == 2 ? 'hidden="hidden"' : '' }}>
                                <label class="form-label">Nama Suami/Istri</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_suami_istri" type="text" class="form-control"
                                        value="{{ $dosen->nama_suami_istri }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5" id="nip_suami_istri"
                                {{ $dosen->status_pernikahan == 0 || $dosen->status_pernikahan == 2 ? 'hidden="hidden"' : '' }}>
                                <label class="form-label">NIP Suami/Istri</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nip_suami_istri" type="text" class="form-control"
                                        value="{{ $dosen->nip_suami_istri }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5" id="pekerjaan_suami_istri"
                                {{ $dosen->status_pernikahan == 0 || $dosen->status_pernikahan == 2 ? 'hidden="hidden"' : '' }}>
                                <label class="form-label">Pekerjaan Suami/Istri</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="pekerjaan_suami_istri" class="form-control">
                                        @foreach ($jenis_pekerjaan as $pekerjaan)
                                            <option value="{{ $pekerjaan->id }},{{ $pekerjaan->jenis_pekerjaan }}"
                                                {{ $pekerjaan->id == $dosen->id_pekerjaan_suami_istri ? 'selected' : '' }}>
                                                {{ $pekerjaan->jenis_pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="form-label">Mampu Handle Kebutuhan Khusus</label>
                                <div class="input-group">
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="ya" class="form-check-input" type="radio" name="mampu_handle_kebutuhan_khusus" value="1" {{ $dosen->mampu_handle_kebutuhan_khusus == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Ya</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="tidak" class="form-check-input" type="radio"name="mampu_handle_kebutuhan_khusus" value="0"{{ $dosen->mampu_handle_kebutuhan_khusus == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="form-label">Mampu Handle Braille</label>
                                <div class="input-group">
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="ya" class="form-check-input" type="radio" name="mampu_handle_braille" value="1" {{ $dosen->mampu_handle_braille == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Ya</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="tidak" class="form-check-input" type="radio"name="mampu_handle_braille" value="0"{{ $dosen->mampu_handle_braille == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="form-label">Mampu Handle Kebutuhan Khusus</label>
                                <div class="input-group">
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="ya" class="form-check-input" type="radio" name="mampu_handle_bahasa_isyarat" value="1" {{ $dosen->mampu_handle_bahasa_isyarat == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Ya</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="tidak" class="form-check-input" type="radio"name="mampu_handle_bahasa_isyarat" value="0"{{ $dosen->mampu_handle_bahasa_isyarat == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('data-scripts')
    <script>
        $(function() {
            $("input[name='status_pernikahan']").click(function() {
                if ($("#menikah").is(":checked")) {
                    $("#nama_suami_istri").removeAttr("hidden");
                    $("#nip_suami_istri").removeAttr("hidden");
                    $("#pekerjaan_suami_istri").removeAttr("hidden");
                } else {
                    $("#nama_suami_istri").attr("hidden", "hidden");
                    $("#nip_suami_istri").attr("hidden", "hidden");
                    $("#pekerjaan_suami_istri").attr("hidden", "hidden");
                }
            });
        });

        var myInput = document.getElementById("nama_kota");
        var kecamatan = document.getElementById("id_kecamatan");
        if (myInput && myInput.value) {
            var kota = myInput.value.split(',');
            if (kota[0]) {
                jQuery.ajax({
                    url: "{{ route('admin.dosen.store', '') }}" + "/" + kota[0],
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#kecamatan').empty();
                        jQuery.each(data, function(key, value) {
                            if (kecamatan.value != value) {
                                $('#kecamatan').append('<option value="' + value + ',' + key + '" >' +
                                    key + '</option>');
                            } else {
                                $('#kecamatan').append('<option value="' + value + ',' + key +
                                    '" selected >' + key + '</option>');
                            }
                        });
                    }
                });
            } else {
                $('select[name="kecamatan"]').empty();
            }
        }

        $(document).on('change', '#nama_kota', function() {
            var kota = jQuery(this).val();
            var id_kota = kota.split(',');
            var url =
                console.log(id_kota[0]);
            if (id_kota[0]) {
                jQuery.ajax({
                    url: "{{ route('admin.dosen.store', '') }}" + "/" + id_kota[0],
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#kecamatan').empty();
                        jQuery.each(data, function(key, value) {
                            $('#kecamatan').append('<option value="' + value + ',' + key +
                                '">' + key + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="kecamatan"]').empty();
            }
        });
    </script>
@endsection
