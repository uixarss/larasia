@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Profil PT
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7">
            <div class="card-title">
                <h2>Profil Perguruan Tinggi</h2>
            </div>
            <div class="card-toolbar gap-3">
                <button data-bs-toggle="modal" data-bs-target="#editprofilpt"
                    class="btn btn-sm btn-light btn-active-light-primary">Edit</button>
            </div>
        </div>

        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kode Perguruan Tinggi</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->kode_perguruan_tinggi}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nama Perguruan Tinggi</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->nama_perguruan_tinggi}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Telepon</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->telepon}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Faximile</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->faximile}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->email}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Website</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->website}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jalan</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->jalan}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Dusun</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->dusun}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">RT/RW</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->rt_rw}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kelurahan</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->kelurahan}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kode POS</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->kode_pos}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nama Wilayah</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->nama_wilayah}}</span>
                </div>
            </div>            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Lintang Bujur</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->lintang_bujur}}</span>
                </div>
            </div>            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Bank</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->bank}}</span>
                </div>
            </div>            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Unit Cabang</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->unit_cabang}}</span>
                </div>
            </div>            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nomor Rekening</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->nomor_rekening}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">MBS</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->mbs}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Luas Tanah Milik</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->luas_tanah_milik}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Luas Tanah Bukan Milik</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->luas_tanah_bukan_milik}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">SK Pendirian</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->sk_pendirian}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Tanggal SK Pendirian</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->tanggal_sk_pendirian}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nama Status Milik</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->nama_status_milik}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Status Perguruan Tinggi</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->status_perguruan_tinggi}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">SK Izin Operasional</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->sk_izin_operasional}}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Tanggal Izin Operasional</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$profil_pt->tanggal_izin_operasional}}</span>
                </div>
            </div>
        </div>
    </div>


    <!-- MMODAL EDIT JADWAL UJIAN-->
    <div class="modal fade" id="editprofilpt" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Profil PT</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.profilpt.update', $profil_pt->id) }}" method="post"
                        enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="fv-row mb-5">
                            <label class="form-label">Kode Perguruan Tinggi</label>
                            <input name="kode_perguruan_tinggi" type="text" class="form-control"
                                value="{{ $profil_pt->kode_perguruan_tinggi }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Nama Perguruan Tinggi</label>
                            <input name="nama_perguruan_tinggi" type="text" class="form-control"
                                value="{{ $profil_pt->nama_perguruan_tinggi }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Telepon</label>
                            <input name="telepon" type="text" class="form-control" value="{{ $profil_pt->telepon }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Faximile</label>
                            <input name="faximile" type="text" class="form-control"
                                value="{{ $profil_pt->faximile }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Email</label>
                            <input name="email" type="text" class="form-control" value="{{ $profil_pt->email }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Website</label>
                            <input name="website" type="text" class="form-control" value="{{ $profil_pt->website }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Jalan</label>
                            <input name="jalan" type="text" class="form-control" value="{{ $profil_pt->jalan }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Dusun</label>
                            <input name="dusun" type="text" class="form-control" value="{{ $profil_pt->dusun }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">RT/RW</label>
                            <input name="rt_rw" type="text" class="form-control" value="{{ $profil_pt->rt_rw }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Kelurahan</label>
                            <input name="kelurahan" type="text" class="form-control"
                                value="{{ $profil_pt->kelurahan }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Kode POS</label>
                            <input name="kode_pos" type="text" class="form-control"
                                value="{{ $profil_pt->kode_pos }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Nama Wilayah</label>
                            <input name="nama_wilayah" type="text" class="form-control"
                                value="{{ $profil_pt->nama_wilayah }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Lintang Bujur</label>
                            <input name="lintang_bujur" type="text" class="form-control"
                                value="{{ $profil_pt->lintang_bujur }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Bank</label>
                            <input name="bank" type="text" class="form-control" value="{{ $profil_pt->bank }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Unit Cabang</label>
                            <input name="unit_cabang" type="text" class="form-control"
                                value="{{ $profil_pt->unit_cabang }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Nomor Rekening</label>
                            <input name="nomor_rekening" type="text" class="form-control"
                                value="{{ $profil_pt->nomor_rekening }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">MBS</label>
                            <input name="mbs" type="text" class="form-control" value="{{ $profil_pt->mbs }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Luas Tanah Milik</label>
                            <input name="luas_tanah_milik" type="text" class="form-control"
                                value="{{ $profil_pt->luas_tanah_milik }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Luas Tanah Bukan Milik</label>
                            <input name="luas_tanah_bukan_milik" type="text" class="form-control"
                                value="{{ $profil_pt->luas_tanah_bukan_milik }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">SK Pendirian</label>
                            <input name="sk_pendirian" type="text" class="form-control"
                                value="{{ $profil_pt->sk_pendirian }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Tanggal SK Pendirian</label>
                            <input name="tanggal_sk_pendirian" onkeydown="return false" type="datetime-local"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($profil_pt->tanggal_sk_pendirian)->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Nama Status Milik</label>
                            <select name="nama_status_milik" class="form-control">
                                @foreach ($status_milik as $status)
                                    <option value="{{ $status->status_milik }},{{ $status->id }}"
                                        {{ $status->id == $profil_pt->id_status_milik ? 'selected' : '' }}>
                                        {{ $status->status_milik }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Status Perguruan Tinggi</label>
                            <select name="status_perguruan_tinggi" class="form-control">
                                <option value="A" @if ($profil_pt->status_perguruan_tinggi == 'A') selected @endif>A</option>
                                <option value="B" @if ($profil_pt->status_perguruan_tinggi == 'B') selected @endif>B</option>
                                <option value="C" @if ($profil_pt->status_perguruan_tinggi == 'C') selected @endif>C</option>
                                <option value="D" @if ($profil_pt->status_perguruan_tinggi == 'D') selected @endif>D</option>
                            </select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">SK Izin Operasional</label>
                            <input name="sk_izin_operasional" type="text" class="form-control"
                                value="{{ $profil_pt->sk_izin_operasional }}">
                        </div>
                        <div class="fv-row">
                            <label class="form-label">Tanggal Izin Operasional</label>
                            <input name="tanggal_izin_operasional" onkeydown="return false" type="datetime-local"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($profil_pt->tanggal_izin_operasional)->format('Y-m-d\TH:i') }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
