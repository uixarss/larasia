@extends('layouts.adtheme')

@section('content')
    <div class="d-flex flex-column flex-lg-row">

        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5 pb-0">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if($guru->photo != null)
                                <img src="{{ asset('admin/assets/images/users/guru/'.$guru->photo) }}">
                            @else
                                <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}">
                            @endif
                        </div>
                        <h3 class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{$guru->nama_dosen}}</h3>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-primary d-inline">{{$guru->nidn}}</div>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="pb-5 fs-6">
                            <div class="fw-bold mt-5">Jenis Kelamin</div>
                            <div class="text-gray-600">{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                            <div class="text-gray-600">{{ $guru->tempat_lahir }}, {{ $guru->tanggal_lahir }}</div>
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $guru->email }}</a>
                            </div>
                            <div class="fw-bold mt-5">No. HP</div>
                            <div class="text-gray-600">
                                <a href="#"
                                    class="text-gray-600 text-hover-primary">{{ $guru->handphone == null ? '-' : $guru->handphone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <form class="card pt-4 mb-6 mb-xl-9" action="{{ route('guru.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Ubah Profil</h2>
                    </div>
                </div>
                <div class="card-body pt-0 pb-5">
                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Lengkap</label>
                        <input name="nama_lengkap" type="text" class="form-control" value="{{ $guru->nama_dosen }}">
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
                        <label class="form-label">Photo Profil</label>
                        <input name="photo_guru" type="file" class="form-control mb-2">
                        <div class="text-muted fs-7">* Format Gambar Harus .PNG</div>
                    </div>
                </div>
                <div class="card-footer border-0 text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
