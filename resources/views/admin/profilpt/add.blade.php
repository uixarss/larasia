@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Profil PT
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Profil PT</li>
    </ul>
@endsection


@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7">
            <div class="card-title">
                <i class="bi bi-pencil-square fs-2 me-2"></i>
                <h2>Profil Perguruan Tinggi</h2>
            </div>
        </div>

        <div class="card-body pt-5">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.profilpt.create') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Kode Perguruan Tinggi</label>
                        <input name="kode_perguruan_tinggi" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Nama Perguruan Tinggi</label>
                        <input name="nama_perguruan_tinggi" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Telepon</label>
                        <input name="telepon" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Faximile</label>
                        <input name="faximile" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Email</label>
                        <input name="email" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Website</label>
                        <input name="website" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Jalan</label>
                        <input name="jalan" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Dusun</label>
                        <input name="dusun" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">RT/RW</label>
                        <input name="rt_rw" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Kelurahan</label>
                        <input name="kelurahan" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Kode POS</label>
                        <input name="kode_pos" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Nama Wilayah</label>
                        <input name="nama_wilayah" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Lintang Bujur</label>
                        <input name="lintang_bujur" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Bank</label>
                        <input name="bank" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Unit Cabang</label>
                        <input name="unit_cabang" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Nomor Rekening</label>
                        <input name="nomor_rekening" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">MBS</label>
                        <input name="mbs" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Luas Tanah Milik</label>
                        <input name="luas_tanah_milik" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Luas Tanah Bukan Milik</label>
                        <input name="luas_tanah_bukan_milik" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">SK Pendirian</label>
                        <input name="sk_pendirian" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Tanggal SK Pendirian</label>
                        <input name="tanggal_sk_pendirian" onkeydown="return false" type="datetime-local"
                            class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Nama Status Milik</label>
                        <select name="nama_status_milik" class="form-control">
                            @foreach ($status_milik as $status)
                                <option value="{{ $status->id }},{{ $status->status_milik }}">
                                    {{ $status->status_milik }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Status Perguruan Tinggi</label>
                        <select name="status_perguruan_tinggi" class="form-control">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">SK Izin Operasional</label>
                        <input name="sk_izin_operasional" type="text" class="form-control">
                    </div>
                </div>

                <div class="fv-row mb-7">
                    <div class="col-md-12">
                        <label class="form-label">Tanggal Izin Operasional</label>
                        <input name="tanggal_izin_operasional" onkeydown="return false" type="datetime-local"
                            class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <button type="reset" class="btn btn-light me-3">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
