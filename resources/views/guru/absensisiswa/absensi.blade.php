@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Absensi Mahasiswa
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.absensi.mahasiswa.kelas') }}" class="text-muted text-hover-primary">Pilih Kelas</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Absensi Mahasiswa</li>
    </ul>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#laporan" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Laporan Absensi
                        </span>
                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#absen" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Absensi Hari Ini
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
            </ul>
        </div>


        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="laporan" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Laporan Absensi
                            </h3>
                            <span class="text-gray-400 fs-6">{{\Carbon\Carbon::parse($tanggal_absen)->format('d M Y')}}</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <a href="{{route('guru.absensi.mahasiswa.laporan',['tanggal_absen' => $tanggal_absen, 'kelas_id' => $kelas_id ])}}" class="btn btn-sm btn-success btn-icon">
                                <span class="fa fa-cloud-download"></span>
                            </a>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <form action="{{route('guru.absensi.mahasiswa.cari', [ 'kelas_id' => $kelas_id ] )}}" method="POST" class="d-flex my-2">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <input type="date" name="tanggal_absen" class="form-control" value="{{ $tanggal_absen }}" />
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_quiz">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="text-start rounded-start">NIM Mahasiswa</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Mata Kuliah</th>
                                    <th>Kelas</th>
                                    <th>Pertemuan Ke</th>
                                    <th class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensi_mahasiswa_tanggal as $mahasiswa)
                                <tr>
                                    <td>{{$mahasiswa->mahasiswa->nim ?? ''}}</td>
                                    <td>{{$mahasiswa->mahasiswa->nama_mahasiswa}}</td>
                                    <td>{{$mahasiswa->mapel->nama_mapel}}</td>
                                    <td>{{$mahasiswa->kelas->nama_kelas}}</td>
                                    <td>{{$mahasiswa->pertemuan_ke}}</td>
                                    <td class="text-end">
                                        @switch($mahasiswa->status)
                                        @case('Hadir')
                                        <span class="badge badge-primary">Hadir</span>
                                        @break
                                        @case('Izin')
                                        <span class="badge badge-warning">Izin</span>
                                        @break
                                        @case('Sakit')
                                        <span class="badge badge-info">Sakit</span>
                                        @break
                                        @default
                                        <span class="badge badge-danger">Alpha</span>
                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="absen" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Absensi Harian
                            </h3>
                            <span class="text-gray-400 fs-6">{{ now()->format('l, d M Y')}}</span>
                        </div>
                        <div class="d-flex flex-wrap my-1">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_absen">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-30px text-start rounded-start">NIM Mahasiswa</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Mata Kuliah</th>
                                    <th>Kelas</th>
                                    <th>Pertemuan Ke</th>
                                    <th class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi_mahasiswa as $mahasiswa)
                                    <tr>
                                        <td>{{ $mahasiswa->mahasiswa->nim ?? '' }}</td>
                                        <td>{{ $mahasiswa->mahasiswa->nama_mahasiswa }}</td>
                                        <td>{{ $mahasiswa->mapel->nama_mapel }}</td>
                                        <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                                        <td>{{ $mahasiswa->pertemuan_ke }}</td>
                                        <td class="text-end">
                                            @switch($mahasiswa->status)
                                            @case('Hadir')
                                            <span class="badge badge-primary">Hadir</span>
                                            @break
                                            @case('Izin')
                                            <span class="badge badge-warning">Izin</span>
                                            @break
                                            @case('Sakit')
                                            <span class="badge badge-info">Sakit</span>
                                            @break
                                            @default
                                            <span class="badge badge-danger">Alpha</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
