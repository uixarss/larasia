@extends('layouts.adtheme')



@section('content')
    <div class="row g-5 g-xl-8">
        @can('view-fakultas')
            <div class="col-xl-3">
                <a href="{{ route('admin.jurusan.index') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-building-fill fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($fakultas) }}</div>
                        <div class="fw-semibold text-white">Jumlah Fakultas</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-jurusan')
            <div class="col-xl-3">
                <a href="{{ route('admin.jurusan.index') }}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-bullseye fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($jurusan) }}</div>
                        <div class="fw-semibold text-white">Jumlah Jurusan</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-prodi')
            <div class="col-xl-3">
                <a href="{{ route('admin.prodi.index') }}" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-briefcase-fill fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($prodi) }}</div>
                        <div class="fw-semibold text-white">Jumlah Program Studi</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-ruangan')
            <div class="col-xl-3">
                <a href="#" class="card bg-warning hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-mortarboard-fill fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($ruangan) }}</div>
                        <div class="fw-semibold text-white">Jumlah Ruangan</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-mahasiswa')
            <div class="col-xl-3">
                <a href="{{ route('admin.mahasiswa.index') }}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-mortarboard-fill fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($siswa) }}</div>
                        <div class="fw-semibold text-white">Jumlah Mahasiswa</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-dosen')
            <div class="col-xl-3">
                <a href="{{ route('admin.dosen.index') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-person-fill fs-2x text-white ms-n1"></i>
                        <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ count($dosen) }}</div>
                        <div class="fw-semibold text-gray-100">Jumlah Dosen</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-pegawai')
            <div class="col-xl-3">
                <a href="{{ route('admin.datapegawai.index') }}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-people-fill fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($pegawai) }}</div>
                        <div class="fw-semibold text-white">Jumlah Pegawai</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-kelas')
            <div class="col-xl-3">
                <a href="{{ route('admin.kelas.index') }}" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-person-workspace fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ count($kelas) }}</div>
                        <div class="fw-semibold text-white">Jumlah Kelas</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-mata-kuliah')
            <div class="col-xl-3">
                <a href="{{ route('admin.matakuliah.index') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-bookmark-star-fill fs-2x text-primary ms-n1"></i>
                        <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ count($matkul) }}</div>
                        <div class="fw-semibold text-gray-400">Jumlah Mata Kuliah</div>
                    </div>
                </a>
            </div>
        @endcan

        @can('view-keuangan')
            <div class="col-xl-3">
                <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-cash-coin fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">
                            {{ number_format($pemasukan->sum->amount - $pengeluaran->sum->amount) }}</div>
                        <div class="fw-semibold text-white">Jumlah Saldo</div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-journal-arrow-up fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ number_format($pengeluaran->sum->amount) }}</div>
                        <div class="fw-semibold text-white">Jumlah Pengeluaran</div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="bi bi-journal-arrow-down fs-2x text-white ms-n1"></i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ number_format($pemasukan->sum->amount) }}</div>
                        <div class="fw-semibold text-white">Jumlah Pemasukan</div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
@endsection
