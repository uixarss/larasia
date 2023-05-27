@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Jadwal Kelas
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Jadwal Kelas</li>
    </ul>
@endsection

@section('content')
@if (count($data_jadwal) > 0)
<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Jadwal</span>
        </h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body py-3">
        <div class="table-responsive">
            <table
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-0 gy-4"
                id="table_pengajuan">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="ps-4 rounded-start">Hari</th>
                        <th>Waktu</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Absensi Mahasiswa</th>
                        <th class="pe-4 text-end rounded-end">Pengumuman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_jadwal as $jadwal)
                    <tr>
                      <td class="ps-4">{{$jadwal->hari->hari}}</td>
                      <td>{{$jadwal->waktu->jam_masuk}} - {{$jadwal->waktu->jam_keluar}}</td>
                      <td>{{$jadwal->mapel->nama_mapel}}</td>
                      <td>{{$jadwal->kelas->nama_kelas}}</td>
                      <td><a href="{{route('guru.absensi.siswa.index', $jadwal->id)}}" class="btn btn-sm btn-warning">Ubah Absen</a></td>
                      <td class="pe-4 text-end"><a href="{{route('guru.pengumuman.kelas.index', $jadwal->id)}}" class="btn btn-sm btn-info">Pengumuman</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


@if (count($data_jadwal_pengganti) > 0)
<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Jadwal Pengganti</span>
        </h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body py-3">
        <div class="table-responsive">
            <table
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-0 gy-4"
                id="table_pengajuan">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="ps-4 rounded-start">Hari</th>
                        <th>Waktu</th>
                        <th>Mata Kuliah</th>
                        <th class="pe-4 min-w-200px text-end rounded-end">Absensi Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_jadwal_pengganti as $pengganti)
                    <tr>
                      <td class="ps-4">{{$pengganti->hari->hari}}</td>
                      <td>{{$pengganti->waktu->jam_masuk}} - {{$pengganti->waktu->jam_keluar}}</td>
                      <td>{{$pengganti->mapel->nama_mapel}}</td>
                      <td class="pe-4 text-end"><a href="{{route('guru.absensipengganti.siswa.index', $pengganti->id)}}" class="btn btn-sm btn-warning">Ubah Absen</a></td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


@if (count($data_jadwal_sp) > 0)
<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Jadwal Kelas SP</span>
        </h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body py-3">
        <div class="table-responsive">
            <table
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-0 gy-4"
                id="table_pengajuan">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="ps-4 rounded-start">Hari</th>
                        <th>Waktu</th>
                        <th>Mata Kuliah</th>
                        <th class="pe-4 min-w-200px text-end rounded-end">Absensi Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_jadwal_sp as $sp)
                    <tr>
                      <td class="ps-4">{{$sp->hari->hari}}</td>
                      <td>{{$pengganti->waktu->jam_masuk}} - {{$pengganti->waktu->jam_keluar}}</td>
                      <td>{{$pengganti->mapel->nama_mapel}}</td>
                      <td class="pe-4 text-end"><a href="{{route('guru.absensisp.siswa.index', $sp->id)}}" class="btn btn-sm btn-warning">Ubah Absen</a></td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
