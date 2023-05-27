@extends('layouts.adtheme')


@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Edit Akun
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-lg-row">

        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5 pb-0">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if ($pegawai->photo != null)
                                <img src="{{ asset('admin/assets/images/users/pegawai/' . $pegawai->photo) }}">
                            @else
                                <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}">
                            @endif
                        </div>
                        <h3 class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $pegawai->nama_pegawai }}</h3>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-primary d-inline">{{ $pegawai->NIP }}</div>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="pb-5 fs-6">
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $pegawai->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <form class="card pt-4 mb-6 mb-xl-9" action="{{ route('pegawai.pengaturan.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Ubah Profil</h2>
                    </div>
                </div>
                <div class="card-body pt-0 pb-5">
                    <div class="fv-row mb-5">
                        <label class="form-label">NIP</label>
                        <input name="" type="text" class="form-control" value="{{ $pegawai->NIP }}" disabled>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Pegawai</label>
                        <input name="nama_pegawai" type="text" class="form-control" value="{{ $pegawai->nama_pegawai }}">
                    </div>


                    <div class="fv-row mb-5">
                        <label class="form-label">Alamat Email</label>
                        <input name="email" type="text" class="form-control" value="{{ auth()->user()->email }}">
                    </div>

                <div class="fv-row mb-5">
                    <label class="form-label">Kata Sandi</label>
                    <input name="password" type="password" class="form-control" value="">
                </div>


                <div class="fv-row">
                    <label class="form-label">Pilih Gambar</label>
                    <input type="file" class="form-control mb-1" name="photo_pegawai" id="filename" title="Browse file">
                    <span class="fs-7 text-muted">* Format Gambar Harus .PNG</span>
                </div>

        </div>
        <div class="card-footer border-0 text-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
    </div>
    </div>
@endsection
