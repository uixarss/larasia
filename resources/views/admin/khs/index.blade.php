@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.khs.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.khs.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li class="active">Kartu Hasil Studi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Kartu Hasil Studi {{$prodi->nama_program_studi}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-title">
                        <a href="{{route('admin.khs.create',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi])}}" class=" btn btn-success">Buat KHS</a>
                    </ul>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                @include('layouts.alert')
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Lengkap Mahasiswa</th>
                                <!-- <th>Fakultas / Jurusan / Prodi</th> -->
                                <!-- <th>Tingkat (Semester)</th> -->
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_mahasiswa as $no => $mahasiswa)
                            <tr>
                                <td>{{++$no}}</td>
                                <td>{{$mahasiswa->nim}}</td>
                                <td>{{$mahasiswa->nama_mahasiswa}}</td>
                                <!-- <td>
                                    {{$mahasiswa->prodi->jurusan->fakultas->nama_fakultas}} /
                                    {{$mahasiswa->prodi->jurusan->nama_jurusan}} /
                                    {{$mahasiswa->prodi->nama_program_studi}}
                                </td> -->
                                <!-- <td>Semester {{$mahasiswa->tingkat_semester}}</td> -->
                                <td align="center">
                                    <a href="{{route('admin.khs.show',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'id' => $mahasiswa->id])}}" class="btn btn-warning">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



        </div>
    </div>
</div>


@stop