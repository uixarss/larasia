@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Data Pribadi
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{route('siswa.datapribadi.editing')}}" class="btn fw-bold btn-warning text-dark">Edit</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5 pb-0">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if ($mahasiswa->photo != null)
                                <img src="{{ asset('admin/assets/images/users/siswa/' . $mahasiswa->photo) }}">
                            @else
                                <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}">
                            @endif
                        </div>
                        <h3 class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $mahasiswa->nama_mahasiswa }}
                        </h3>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-primary d-inline">{{ $mahasiswa->nim }}</div>
                        </div>
                    </div>
                    <div class="pb-5 fs-6">
                        <div class="fw-bold mt-5">Status Mahasiswa</div>
                        <div class="text-gray-600">{{ $mahasiswa->nama_status_mahasiswa ?? 'Tidak Aktif' }}</div>
                        <div class="fw-bold mt-5">Jenis Kelamin</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600">{{ $mahasiswa->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600">{{ $mahasiswa->tempat_lahir ?? '-' }}, {{ $mahasiswa->tanggal_lahir ?? '-' }}
                            </div>
                        </div>
                        <div class="fw-bold mt-5">Agama</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600">{{ $mahasiswa->nama_agama ?? '-' }}</div>
                        </div>
                        <div class="fw-bold mt-5">Kewarganegaraan</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600">{{ $mahasiswa->kewarganegaraan ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Keterangan Tempat Tinggal</h2>
                    </div>
                </div>

                <div class="card-body pt-0 pb-5">
                    <div class="table-responsive">
                        <table class="table align-middle gy-5">
                            <tbody class="fs-6 fw-semibold text-gray-600">
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $mahasiswa->jalan ?? '-' }} {{ $mahasiswa->dusun }} RT
                                        {{ $mahasiswa->rt ?? '-' }} RW {{ $mahasiswa->rw ?? '-' }} Kelurahan/Desa
                                        {{ $mahasiswa->kelurahan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>{{ $mahasiswa->kode_pos ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>{{ $mahasiswa->nama_kecamatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>{{ $mahasiswa->nama_wilayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Hp</td>
                                    <td>{{ $mahasiswa->handphone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Email</td>
                                    <td>{{ $mahasiswa->email ?? '-' }}
                                    <td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Keterangan Orang Tua</h2>
                    </div>
                </div>
                <div class="card-body pt-0 pb-5">
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table align-middle gy-5">
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>Nama Ayah</td>
                                            <td>{{ $mahasiswa->nama_ayah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK Ayah</td>
                                            <td>{{ $mahasiswa->nik_ayah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>{{ $mahasiswa->nama_pekerjaan_ayah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td>
                                            <td>{{ $mahasiswa->nama_pendidikan_ayah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penghasilan</td>
                                            <td>Rp. {{ $mahasiswa->nama_penghasilan_ayah ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table align-middle gy-5">
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>{{ $mahasiswa->nama_ibu ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK Ibu</td>
                                            <td>{{ $mahasiswa->nik_ibu ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>{{ $mahasiswa->nama_pekerjaan_ibu ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td>
                                            <td>{{ $mahasiswa->nama_pendidikan_ibu ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penghasilan</td>
                                            <td>Rp. {{ $mahasiswa->nama_penghasilan_ibu ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
