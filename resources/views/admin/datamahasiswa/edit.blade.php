@extends('layouts.adtheme')


@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Detail Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-muted text-hover-primary">Mahasiswa</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Detail Mahasiswa</li>
    </ul>
@endsection

@section('content')
    <div class="d-flex flex-column flex-lg-row">

        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if ($mahasiswa->photo != null)
                                <img src="{{ asset('admin/assets/images/users/siswa/' . $mahasiswa->photo) }}">
                            @else
                                <img src="{{ asset('admin/assets/images/users/pegawai/no-image.jpg') }}">
                            @endif
                        </div>
                        <a href="#"
                            class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $mahasiswa->nama_mahasiswa }}</a>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-primary d-inline">{{ $mahasiswa->nim }}</div>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="pb-5 fs-6">
                            <div class="fw-bold mt-5">Jenis Kelamin</div>
                            <div class="text-gray-600">{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <div class="fw-bold mt-5">Agama</div>
                            <div class="text-gray-600">{{ $mahasiswa->nama_agama }}</div>
                            <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                            <div class="text-gray-600">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</div>
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $mahasiswa->email }}</a>
                            </div>
                            <div class="fw-bold mt-5">No. HP</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $mahasiswa->handphone }}</a>
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
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#orangtua">Data Orang Tua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#other">Lainnya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#ektensi">Eketensi/Pindahan/Ulang</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="kampus" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9"
                        action="{{ route('admin.mahasiswa.updatedatakampus', $mahasiswa->id) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Kampus</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="fv-row mb-5">
                                <label class="form-label">NIM</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nim" type="text" class="form-control" value="{{ $mahasiswa->nim }}"
                                        required>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">NISN</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nisn" type="text" class="form-control"
                                        value="{{ $mahasiswa->nisn ?? '' }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_mahasiswa" type="text" class="form-control"
                                        value="{{ $mahasiswa->nama_mahasiswa }}" required>
                                </div>
                            </div>



                            <div class="fv-row mb-5">
                                <label class="form-label">No Hp</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="handphone" type="tel" class="form-control"
                                        value="{{ $mahasiswa->handphone }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="email" type="email" class="form-control"
                                        value="{{ $mahasiswa->email }}" required>
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">Kelas</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kelas_id" class="form-control">
                                        <option value="">--Tidak ada kelas--</option>
                                        @foreach ($data_kelas as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $k->id == $mahasiswa->kelas_id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="fv-row mb-5">
                                <label class="form-label">Fakultas</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="id_fakultas" id="id_fakultas" class="form-control">
                                        @foreach ($fakultas as $fakul)
                                            <option value="{{ $fakul->id }}"
                                                {{ $mahasiswa->prodi->jurusan->fakultas->id ?? '' == $fakul->id ? 'selected' : '' }}>
                                                {{ $fakul->nama_fakultas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jurusan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select id="id_jurusan" name="id_jurusan" class="form-control">
                                        <option value="">== Pilih Jurusan ==</option>
                                        @foreach ($data_jurusan as $jurusan)
                                            <option value="{{ $jurusan->id }}"
                                                {{ $mahasiswa->prodi->jurusan->id ?? '' == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="fv-row mb-5">
                                <label class="form-label">Program Studi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="id_prodi" class="form-control">
                                        <option value="">--Kosong--</option>
                                        @foreach ($data_prodi as $prodi)
                                            <option value="{{ $prodi->id_prodi }}"
                                                {{ $prodi->id_prodi == $mahasiswa->id_prodi ?? '' ? 'selected' : '' }}>
                                                {{ $prodi->nama_program_studi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Semester</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="id_semester" class="form-control">
                                        @if ($kelas_mahasiswa != null)
                                            @foreach ($data_semester as $semester)
                                                <option value="{{ $semester->id }}"
                                                    {{ $semester->id == $kelas_mahasiswa->id_semester ? 'selected' : '' }}>
                                                    {{ $semester->nama_semester }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($data_semester as $semester)
                                                <option value="{{ $semester->id }}">
                                                    {{ $semester->nama_semester }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tahun Ajaran</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="id_tahun_ajaran" class="form-control">
                                        @if ($kelas_mahasiswa != null)
                                            @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                                <option value="{{ $tahun_ajaran->id }}"
                                                    {{ $tahun_ajaran->id == $kelas_mahasiswa->id_tahun_ajaran ? 'selected' : '' }}>
                                                    {{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                                <option value="{{ $tahun_ajaran->id }}">
                                                    {{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Status Mahasiswa</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="status" class="form-control">
                                        <option value="1,Aktif" @if ($mahasiswa->id_status_mahasiswa == '1' || $mahasiswa->nama_status_mahasiswa == 'Aktif') selected @endif>Aktif
                                        </option>
                                        <option value="2,Cuti" @if ($mahasiswa->id_status_mahasiswa == '2' || $mahasiswa->nama_status_mahasiswa == 'Cuti') selected @endif>Cuti
                                        </option>
                                        <option value="3,Lulus" @if ($mahasiswa->id_status_mahasiswa == '3' || $mahasiswa->nama_status_mahasiswa == 'Lulus') selected @endif>Lulus
                                        </option>
                                        <option value="4,Tidak Lulus" @if ($mahasiswa->id_status_mahasiswa == '4' || $mahasiswa->nama_status_mahasiswa == 'Tidak Lulus') selected @endif>
                                            Tidak Lulus</option>
                                        <option value="0,Non Aktif" @if ($mahasiswa->id_status_mahasiswa == '0' || $mahasiswa->id_status_mahasiswa == 'Non Aktif') selected @endif>
                                            Non Aktif</option>
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
                        action="{{ route('admin.mahasiswa.updatedatadiri', $mahasiswa->id) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Pribadi</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="fv-row mb-5">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nama_mahasiswa" type="text" class="form-control"
                                        value="{{ $mahasiswa->nama_mahasiswa }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                    <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tempat Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="tempat_lahir" type="text" class="form-control"
                                        value="{{ $mahasiswa->tempat_lahir }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                    <input name="tanggal_lahir" type="date" class="form-control"
                                        value="{{ $mahasiswa->tanggal_lahir }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Agama</label>
                                <div class="input-group">
                                    <select name="nama_agama" class="form-control">
                                        <option value="1,Islam" @if ($mahasiswa->nama_agama == 'Islam') selected @endif>Islam
                                        </option>
                                        <option value="2,Kristen" @if ($mahasiswa->nama_agama == 'Kristen') selected @endif>
                                            Kristen
                                        </option>
                                        <option value="3,Katolik" @if ($mahasiswa->nama_agama == 'Katolik') selected @endif>
                                            Katolik
                                        </option>
                                        <option value="4,Hindu" @if ($mahasiswa->nama_agama == 'Hindu') selected @endif>
                                            Hindu
                                        </option>
                                        <option value="5,Budha" @if ($mahasiswa->nama_agama == 'Budha') selected @endif>
                                            Budha
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">No Hp</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="handphone" type="tel" class="form-control"
                                        value="{{ $mahasiswa->handphone }}">
                                </div>
                            </div>



                            <div class="fv-row mb-5">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="email" type="email" class="form-control"
                                        value="{{ $mahasiswa->email }}">
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">Jalan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="jalan" type="text" class="form-control"
                                        value="{{ $mahasiswa->jalan }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Dusun</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="dusun" type="text" class="form-control"
                                        value="{{ $mahasiswa->dusun }}">
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">RT/RW</label>
                                <div class="row">
                                    <div class="input-group col-sm">
                                        <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                        <input name="rt" type="text" class="form-control"
                                            value="{{ $mahasiswa->rt }}">
                                    </div>
                                    <div class="input-group col-sm">
                                        <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                        <input name="rw" type="text" class="form-control"
                                            value="{{ $mahasiswa->rw }}">
                                    </div>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kelurahan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="kelurahan" type="text" class="form-control"
                                        value="{{ $mahasiswa->kelurahan }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kode POS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="kode_pos" type="text" class="form-control"
                                        value="{{ $mahasiswa->kode_pos }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kota</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select id="nama_kota" name="nama_kota" class="form-control">
                                        @foreach ($data_kota as $kota)
                                            <option value="{{ $kota->id }},{{ $kota->name }}"
                                                {{ $kota->id == $mahasiswa->id_wilayah || $kota->name == $mahasiswa->nama_wilayah ? 'selected' : '' }}>
                                                {{ $kota->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <input name="id_kecamatan" id="id_kecamatan" type="text"
                                value="{{ $mahasiswa->id_kecamatan }}" hidden>
                            <div class="fv-row mb-5">
                                <label class="form-label">Kecamatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="">== Pilih Kecamatan ==</option>
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kewarganegaraan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select id="kewarganegaraan" name="kewarganegaraan" class="form-control">
                                        @foreach ($data_negara as $negara)
                                            <option value="{{ $negara->kode_negara }},{{ $negara->nama_negara }}"
                                                {{ $negara->kode_negara == $mahasiswa->id_negara || $negara->nama_negara == $mahasiswa->kewarganegaraan ? 'selected' : '' }}>
                                                {{ $negara->nama_negara }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="fv-row">
                                <label class="form-label">NPWP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="npwp" type="text" class="form-control"
                                        value="{{ $mahasiswa->npwp }}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="orangtua" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9"
                        action="{{ route('admin.mahasiswa.updatedataorangtua', $mahasiswa->id) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Orang Tua</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="fv-row mb-5">
                                        <label class="form-label">NIK Ayah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="nik_ayah" type="text" class="form-control"
                                                value="{{ $mahasiswa->nik_ayah ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Ayah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_ayah" type="text" class="form-control"
                                                value="{{ $mahasiswa->nama_ayah ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="tanggal_lahir_ayah" onkeydown="return false" type="datepicker"
                                                class="form-control datepicker"
                                                value="{{ $mahasiswa->tanggal_lahir_ayah }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pendidikan Terakhir</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pendidikan_ayah" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pendidikan as $pendidikan)
                                                    <option
                                                        value="{{ $pendidikan->id }},{{ $pendidikan->jenis_pendidikan }}"
                                                        {{ $pendidikan->id == $mahasiswa->id_pendidikan_ayah || $pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ayah ? 'selected' : '' }}>
                                                        {{ $pendidikan->jenis_pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pekerjaan</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pekerjaan_ayah" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pekerjaan as $pekerjaan)
                                                    <option
                                                        value="{{ $pekerjaan->id }},{{ $pekerjaan->jenis_pekerjaan }}"
                                                        {{ $pekerjaan->id == $mahasiswa->id_pekerjaan_ayah || $pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ayah ? 'selected' : '' }}>
                                                        {{ $pekerjaan->jenis_pekerjaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Penghasilan Ayah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="penghasilan_ayah" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_penghasilan as $penghasilan)
                                                    <option
                                                        value="{{ $penghasilan->id }},{{ $penghasilan->jenis_penghasilan }}"
                                                        {{ $penghasilan->id == $mahasiswa->id_penghasilan_ayah || $penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ayah ? 'selected' : '' }}>
                                                        Rp. {{ $penghasilan->jenis_penghasilan }} /Bln</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="fv-row mb-5">
                                        <label class="form-label">NIK Ibu</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="nik_ibu" type="text" class="form-control"
                                                value="{{ $mahasiswa->nik_ibu ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Ibu</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_ibu" type="text" class="form-control"
                                                value="{{ $mahasiswa->nama_ibu ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="tanggal_lahir_ibu" onkeydown="return false" type="datepicker"
                                                class="form-control datepicker"
                                                value="{{ $mahasiswa->tanggal_lahir_ibu }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pendidikan Terakhir</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pendidikan_ibu" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pendidikan as $pendidikan)
                                                    <option
                                                        value="{{ $pendidikan->id }},{{ $pendidikan->jenis_pendidikan }}"
                                                        {{ $pendidikan->id == $mahasiswa->id_pendidikan_ibu || $pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ibu ? 'selected' : '' }}>
                                                        {{ $pendidikan->jenis_pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pekerjaan</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pekerjaan_ibu" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pekerjaan as $pekerjaan)
                                                    <option
                                                        value="{{ $pekerjaan->id }},{{ $pekerjaan->jenis_pekerjaan }}"
                                                        {{ $pekerjaan->id == $mahasiswa->id_pekerjaan_ibu || $pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ibu ? 'selected' : '' }}>
                                                        {{ $pekerjaan->jenis_pekerjaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label">Penghasilan Ibu</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="penghasilan_ibu" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_penghasilan as $penghasilan)
                                                    <option
                                                        value="{{ $penghasilan->id }},{{ $penghasilan->jenis_penghasilan }}"
                                                        {{ $penghasilan->id == $mahasiswa->id_penghasilan_ibu || $penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ibu ? 'selected' : '' }}>
                                                        Rp. {{ $penghasilan->jenis_penghasilan }} /Bln</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="fv-row mb-5">
                                        <label class="form-label">Nama Wali <span
                                                class="text-danger fst-italic">(Optional)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_wali" type="text" class="form-control"
                                                value="{{ $mahasiswa->nama_wali ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Tanggal Lahir <span
                                                class="text-danger fst-italic">(Optional)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <input name="tanggal_lahir_wali" onkeydown="return false" type="datepicker"
                                                class="form-control datepicker"
                                                value="{{ $mahasiswa->tanggal_lahir_wali }}">
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pendidikan Terakhir <span
                                                class="text-danger fst-italic">(Optional)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pendidikan_wali" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pendidikan as $pendidikan)
                                                    <option
                                                        value="{{ $pendidikan->id }},{{ $pendidikan->jenis_pendidikan }}"
                                                        {{ $pendidikan->id == $mahasiswa->id_pendidikan_wali || $pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_wali ? 'selected' : '' }}>
                                                        {{ $pendidikan->jenis_pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Pekerjaan <span
                                                class="text-danger fst-italic">(Optional)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="pekerjaan_wali" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_pekerjaan as $pekerjaan)
                                                    <option
                                                        value="{{ $pekerjaan->id }},{{ $pekerjaan->jenis_pekerjaan }}"
                                                        {{ $pekerjaan->id == $mahasiswa->id_pekerjaan_wali || $pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_wali ? 'selected' : '' }}>
                                                        {{ $pekerjaan->jenis_pekerjaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label">Penghasilan Wali <span
                                                class="text-danger fst-italic">(Optional)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                            <select name="penghasilan_wali" class="form-control" onfocus='this.size=3;'
                                                onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                @foreach ($jenis_penghasilan as $penghasilan)
                                                    <option
                                                        value="{{ $penghasilan->id }},{{ $penghasilan->jenis_penghasilan }}"
                                                        {{ $penghasilan->id == $mahasiswa->id_penghasilan_wali || $penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_wali ? 'selected' : '' }}>
                                                        Rp. {{ $penghasilan->jenis_penghasilan }} /Bln</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="other" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9"
                        action="{{ route('admin.mahasiswa.updatedatalain', $mahasiswa->id) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Data Lainnya</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">

                            <div class="fv-row mb-5">
                                <label class="form-label">Jenis Tinggal</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="jenis_tinggal" class="form-control">
                                        @foreach ($jenis_tinggal as $j)
                                            <option value="{{ $j->id }},{{ $j->jenis_tinggal }}"
                                                {{ $j->id == $mahasiswa->id_jenis_tinggal || $j->jenis_tinggal == $mahasiswa->nama_jenis_tinggal ? 'selected' : '' }}>
                                                {{ $j->jenis_tinggal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Alat Transportasi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="alat_transportasi" class="form-control">
                                        @foreach ($alat_transportasi as $alat)
                                            <option value="{{ $alat->id }},{{ $alat->alat_transportasi }}"
                                                {{ $alat->id == $mahasiswa->id_alat_transportasi || $alat->alat_transportasi == $mahasiswa->nama_alat_transportasi ? 'selected' : '' }}>
                                                {{ $alat->alat_transportasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="fv-row mb-5">
                                <label class="form-label">Penerima KPS</label>
                                <div class="input-group">
                                    <div class="form-check form-check-custom form-check-solid me-7">
                                        <input id="ya" class="form-check-input" type="radio"
                                            name="penerima_kps" value="1"
                                            {{ $mahasiswa->penerima_kps == 1 || $mahasiswa->nomor_kps != null ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input id="ya" class="form-check-input" type="radio"
                                            name="penerima_kps" value="0"
                                            {{ $mahasiswa->penerima_kps == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <div class="fv-row mb-5" id="no_kps"
                                {{ $mahasiswa->penerima_kps == 0 ? 'hidden="hidden"' : '' }}>
                                <label class="form-label">No KPS</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="nomor_kps" type="text" class="form-control"
                                        value="{{ $mahasiswa->nomor_kps }}">
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kebutuhan Khusus Mahasiswa</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_mahasiswa" class="form-control">
                                        @foreach ($kebutuhan_khusus as $kebutuhan)
                                            <option value="{{ $kebutuhan->id }},{{ $kebutuhan->kebutuhan_khusus }}"
                                                {{ $kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_mahasiswa || $kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_mahasiswa ? 'selected' : '' }}>
                                                {{ $kebutuhan->kebutuhan_khusus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kebutuhan Khusus Ayah</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_ayah" class="form-control">
                                        @foreach ($kebutuhan_khusus as $kebutuhan)
                                            <option value="{{ $kebutuhan->id }},{{ $kebutuhan->kebutuhan_khusus }}"
                                                {{ $kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_ayah || $kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_ayah ? 'selected' : '' }}>
                                                {{ $kebutuhan->kebutuhan_khusus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Kebutuhan Khusus Ibu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_ibu" class="form-control">
                                        @foreach ($kebutuhan_khusus as $kebutuhan)
                                            <option value="{{ $kebutuhan->id }},{{ $kebutuhan->kebutuhan_khusus }}"
                                                {{ $kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_ibu || $kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_ibu ? 'selected' : '' }}>
                                                {{ $kebutuhan->kebutuhan_khusus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="ektensi" role="tabpanel">
                    <form class="card pt-4 mb-6 mb-xl-9"
                        action="{{ route('admin.mahasiswa.ekstensi.store', ['id' => $mahasiswa->id]) }}" method="POST">
                        @csrf
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Tambah Data Ektensi/Pindahan/Ulang</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="fv-row mb-5">
                                <label class="form-label">Tahun Ajaran</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="tahun_ajaran_id" class="form-control" id="tahun_ajaran_id" required>
                                        @foreach ($data_tahun_ajaran as $tahun)
                                            <option value="{{ $tahun->id }}"
                                                {{ $tahun->status == '1' ? 'selected' : '' }}>
                                                {{ $tahun->nama_tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Program Studi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="prodi_id" class="form-control" id="prodi_id" required>
                                        <option value="">--Pilih Program Studi--</option>
                                        @foreach ($data_prodi as $prodi)
                                            <option value="{{ $prodi->id_prodi }}"
                                                {{ $mahasiswa->id_prodi == $prodi->id_prodi ? 'selected' : '' }}>
                                                {{ $prodi->nama_program_studi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Dosen</label>
                                <div class="input-group">
                                    <button class="input-group-text" onclick="getDosenMataKuliah()">Cari</button>
                                    <select name="dosen_id" class="form-control" id="dosen_id" required>
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Tingkat Semester</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <input name="tingkat_semester" type="number" class="form-control" min="1"
                                        max="14" placeholder="Contoh: 3" required>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Semester</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="semester_id" class="form-control" id="semester_id" required>
                                        @foreach ($data_semester as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ $semester->status == '1' ? 'selected' : '' }}>
                                                {{ $semester->nama_semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Mata Kuliah</label>
                                <div class="input-group">
                                    <button class="input-group-text" onclick="getDataMataKuliah()">Cari</button>
                                    <select name="mapel_id" class="form-control" id="mapel_id" required>
                                    </select>
                                </div>
                            </div>

                            <div class="fv-row mb-5">
                                <label class="form-label">Kelas</label>
                                <div class="input-group">
                                    <button class="input-group-text" onclick="getKelasDosenMataKuliah()">Cari</button>
                                    <select name="kelas_id" class="form-control" id="kelas_id" required>
                                    </select>
                                </div>
                            </div>
                            <div class="fv-row">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fa fa-pencil"></span></span>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-2 mb-1">Data KRS Ekstensi/Pindahan/Ulang</span>
                        </h3>
                        <div class="d-flex my-2 gap-2">
                            <div class="d-flex align-items-center position-relative me-4">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <table id="table_data"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                 <th width="50">Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Tingkat</th>
                                    <th>Mata Kuliah</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Status</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                                @foreach ($data_krs_ekstensi as $key_ekstensi => $ekstensi)
                                    <tr>
                                        <td>{{ $ekstensi->tahun->nama_tahun_ajaran ?? '' }}</td>
                                        <td>{{ $ekstensi->semester->nama_semester }}</td>
                                        <td>
                                            {{ $ekstensi->tingkat_semester }}
                                        </td>
                                        <td>{{ $ekstensi->mapel->nama_mapel ?? '' }}</td>
                                        <td>{{ $ekstensi->kelas->nama_kelas ?? '' }}</td>
                                        <td>{{ $ekstensi->dosen->nama_dosen ?? '' }}</td>
                                        <td>
                                            {{ $ekstensi->status == '1' ? 'Aktif' : 'Tidak Aktif' }}
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $ekstensi->id }}">Edit</a>
                                            <a href="{{ route('admin.mahasiswa.ekstensi.delete', ['id' => $ekstensi->id]) }}"
                                                class="btn btn-sm btn-danger">Hapus</a>
                                            <div class="modal fade" id="edit{{ $ekstensi->id }}"
                                                data-backdrop="static" tabindex="-1" role="dialog"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data
                                                                Ekstensi</h5>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form
                                                                action="{{ route('admin.mahasiswa.ekstensi.update', ['id' => $ekstensi->id]) }}" method="POST">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <label for="nama_tahun_ajaran">Tahun Ajaran</label>
                                                                    <select name="tahun_ajaran_id" id="tahunajaran_id_edit"
                                                                        class="form-control" required>
                                                                        @foreach ($data_tahun_ajaran as $ajaran)
                                                                            <option value="{{ $tahun->id }}"
                                                                                {{ $ajaran->id == $ekstensi->tahun_ajaran_id ? 'selected' : '' }}>
                                                                                {{ $ajaran->nama_tahun_ajaran }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nama_semester">Semester</label>
                                                                    <select name="semester_id" id="smster_id_edit"
                                                                        class="form-control" required>
                                                                        @foreach ($data_semester as $semester)
                                                                            <option value="{{ $semester->id }}"
                                                                                {{ $semester->id == $ekstensi->semester_id ? 'selected' : '' }}>
                                                                                {{ $semester->nama_semester }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="prodi_id">Program Studi</label>
                                                                    <select name="prodi_id" class="form-control" id="prodi_id" required>
                                                                        <option value="">--Pilih Program Studi--</option>
                                                                        @foreach ($data_prodi as $prodi)
                                                                            <option value="{{ $prodi->id_prodi }}"
                                                                                {{ $mahasiswa->id_prodi == $prodi->id_prodi ? 'selected' : '' }}>
                                                                                {{ $prodi->nama_program_studi }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nama_semester">Mata Kuliah</label>
                                                                    <select name="mapel_id" id="mapel_id_edit"
                                                                        class="form-control" data-live-search="true" required>
                                                                        @foreach ($data_mata_kuliah as $mapel)
                                                                            <option value="{{ $mapel->id }}"
                                                                                {{ $mapel->id == $ekstensi->mapel_id ? 'selected' : '' }}>
                                                                                {{ $mapel->nama_mapel }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nama_semester">Nama Dosen</label>
                                                                    <select name="dosen_id" id="dosen_id_edit"
                                                                        class="form-control" data-live-search="true" required>
                                                                        @foreach ($data_dosen as $dosen)
                                                                            <option value="{{$dosen->id}}"
                                                                                {{$ekstensi->dosen_id == $dosen->id ? 'selected' : '' }}
                                                                                >
                                                                            {{ $dosen->nama_dosen }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nama_semester">Kelas</label>
                                                                    <select name="kelas_id" id="kelas_id_edit"
                                                                        class="form-control" data-live-search="true" required>
                                                                        @foreach ($data_kelas as $kelas)
                                                                            <option value="{{$kelas->id}}"
                                                                                {{$ekstensi->kelas_id == $kelas->id ? 'selected' : '' }}
                                                                                >
                                                                            {{ $kelas->nama_kelas }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nama_semester">Tingkat Semester</label>
                                                                    <input name="tingkat_semester" id="tingkat_semester"
                                                                        class="form-control"
                                                                        value="{{ $ekstensi->tingkat_semester }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="status"> Status</label>
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="1"
                                                                            {{ ($ekstensi->status = "1") ? 'selected' : '' }}>
                                                                            Aktif</option>
                                                                        <option value="0"
                                                                            {{ ($ekstensi->status = "0") ? 'selected' : '' }}>
                                                                            Tidak Aktif</option>
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            $("input[name='penerima_kps']").click(function() {
                if ($("#ya").is(":checked")) {
                    $("#no_kps").removeAttr("hidden");
                    $("#no_kps").focus();
                } else {
                    $("#no_kps").attr("hidden", "hidden");
                }
            });
        });

        var myInput = document.getElementById("nama_kota");
        var kecamatan = document.getElementById("id_kecamatan");
        if (myInput && myInput.value) {
            var kota = myInput.value.split(',');
            if (kota[0]) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.store', '') }}" + "/" + kota[0],
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
            console.log(id_kota[0]);
            if (id_kota[0]) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.store', '') }}" + "/" + id_kota[0],
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

        //Jurusan & Prodi

        var fakultas = document.getElementById("id_fakultas");
        if (fakultas && fakultas.value) {
            values = fakultas.value;
            if (values) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + values,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_jurusan').append('<option value="' + value + '">' + key +
                                '</option>');
                        });

                    }
                });
            } else {
                $('select[name="id_jurusan"]').empty();
            }
        }

        $(document).on('change', '#id_fakultas', function() {
            var fakultas = jQuery(this).val();
            if (fakultas) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + fakultas,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_jurusan').append('<option value="' + value + ' ">' + key +
                                '</option>');

                        });

                        var jurusan = document.getElementById("id_jurusan");
                        jQuery.ajax({
                            url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan
                                .value,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                jQuery('#prodi').empty();
                                jQuery.each(data, function(key, value) {
                                    $('#prodi').append('<option value="' + value +
                                        '">' + key + '</option>');
                                });
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_jurusan"]').empty();
            }


        });

        var myInput2 = document.getElementById("id_fakultas");
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var prodi = document.getElementById('jurusan');
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key, value) {
                            if (prodi.value != value) {
                                $('#id_jurusan').append('<option value="' + value + '" >' + key +
                                    '</option>');
                            } else {
                                $('#id_jurusan').append('<option value="' + value + '" selected >' +
                                    key + '</option>');
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_jurusan"]').empty();
            }
        }


        $(document).on('change', '#id_jurusan', function() {
            var jurusan = jQuery(this).val();
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#prodi').empty();
                        jQuery.each(data, function(key, value) {
                            $('#prodi').append('<option value="' + value + '">' + key +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        });

        var myInput2 = document.getElementById("id_jurusan");
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var prodi = document.getElementById('id_prodi');
                        console.log(data);
                        jQuery('#prodi').empty();
                        jQuery.each(data, function(key, value) {
                            if (prodi.value != value) {
                                $('#prodi').append('<option value="' + value + '" >' + key +
                                    '</option>');
                            } else {
                                $('#prodi').append('<option value="' + value + '" selected >' + key +
                                    '</option>');
                            }
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        }

        // Data Ekstensi
        $(document).on('change', '#tahun_ajaran_id', function() {
            getDataMataKuliah();
        });
        $(document).on('change', '#semester_id', function() {
            getDataMataKuliah();
        });
        $(document).on('change', '#prodi_id', function() {
            getDataMataKuliah();
        });

        $(document).on('change', '#mapel_id', function() {
            getDosenMataKuliah();
            getKelasDosenMataKuliah();
        });

        $(document).on('change', '#dosen_id', function() {
            getKelasDosenMataKuliah();
        });

        $(document).on('change', '#mapel_id_edit', function() {
            getDosen();
        });


        function getDataMataKuliah() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tahun = jQuery('#tahun_ajaran_id').val();
            var semester = jQuery('#semester_id').val();
            var prodi_id = jQuery('#prodi_id').val();
            if (tahun) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.getMataKuliah') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tahun_ajaran_id: tahun,
                        semester_id: semester,
                        prodi_id: prodi_id
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery('#mapel_id').empty();
                        jQuery.each(response, function(key, value) {
                            $('#mapel_id').append('<option value="' + value.id + '">' + value
                                .nama_mapel +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        }

        function getDosenMataKuliah() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tahun = jQuery('#tahun_ajaran_id').val();
            var semester = jQuery('#semester_id').val();
            var prodi_id = jQuery('#prodi_id').val();
            var mapel = jQuery('#mapel_id').val();
            if (tahun) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.getDosenMataKuliah') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tahun_ajaran_id: tahun,
                        semester_id: semester,
                        prodi_id: prodi_id,
                        mapel_id: mapel
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery('#dosen_id').empty();
                        jQuery.each(response, function(key, value) {
                            $('#dosen_id').append('<option value="' + value.id + '">' + value
                                .nama_dosen +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        }

        function getDosen() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tahun = jQuery('#tahunajaran_id_edit').val();
            var semester = jQuery('#semester_id_edit').val();
            var prodi_id = jQuery('#prodi_id_edit').val();
            var mapel = jQuery('#mapel_id_edit').val();
            if (tahun) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.getDosen') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tahun_ajaran_id: tahun,
                        semester_id: semester,
                        prodi_id: prodi_id,
                        mapel_id: mapel
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery('#dosen_id').empty();
                        jQuery.each(response, function(key, value) {
                            $('#dosen_id').append('<option value="' + value.id + '">' + value
                                .nama_dosen +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        }

        function getPaketKrs() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var prodi_id = jQuery('#prodi_id_khs').val();
            var tingkat_semester = jQuery('#tingkat_semester_khs').val();
            if (prodi_id) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.getPaketKrs') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        prodi_id: prodi_id,
                        tingkat_semester: tingkat_semester
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery('#matkul_id').empty();
                        jQuery.each(response, function(key, value) {
                            $('#matkul_id').append('<option value="' + value.id + '">' + '[' + value
                                .kode_mapel + '] ' + value.nama_mapel +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="matkul_id"]').empty();
            }
        }

        function getKelasDosenMataKuliah() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tahun = jQuery('#tahun_ajaran_id').val();
            var semester = jQuery('#semester_id').val();
            var prodi_id = jQuery('#prodi_id').val();
            var mapel = jQuery('#mapel_id').val();
            var dosen = jQuery('#dosen_id').val();
            if (tahun) {
                jQuery.ajax({
                    url: "{{ route('admin.mahasiswa.getKelasDosenMataKuliah') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tahun_ajaran_id: tahun,
                        semester_id: semester,
                        prodi_id: prodi_id,
                        mapel_id: mapel,
                        dosen_id: dosen
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery('#kelas_id').empty();
                        jQuery.each(response, function(key, value) {
                            $('#kelas_id').append('<option value="' + value.id + '">' + value
                                .nama_kelas + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="prodi"]').empty();
            }
        }
    </script>
    <script>
        var ListData = function() {
            var table = document.getElementById('table_data');
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
                const filterSearch = document.getElementById('table_search');
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
            ListData.init();
        });
    </script>
@endsection
