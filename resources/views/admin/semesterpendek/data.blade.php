@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.sp.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.sp.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li class="active">Data Semester Pendek</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Data Semester Pendek {{$prodi->nama_program_studi}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-title">
                        <a href="{{route('admin.sp.create',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi])}}" class=" btn btn-success">Buat KRS</a>
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
                                <th>Fakultas / Jurusan / Prodi</th>
                                <th>Tingkat (Semester)</th>
                                <th>Mata Kuliah</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_krs as $no => $krs)

                            <tr>
                                <td>{{++$no}}</td>
                                <td>{{$krs->mahasiswa->nim}}</td>
                                <td>{{$krs->mahasiswa->nama_mahasiswa}}</td>
                                <td>
                                    {{$krs->jurusan->fakultas->nama_fakultas}} 
                                    {{$krs->jurusan->nama_jurusan}} /
                                    {{$krs->prodi->nama_program_studi}}
                                </td>
                                <td>Semester {{$krs->tingkat_semester}}</td>
                                <td>{{$krs->mapel->nama_mapel}}</td>
                                <td>{{$krs->status}}</td>
                                <td align="center">
                                    <a href="{{route('admin.sp.update',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'id_fakultas' => $krs->jurusan->fakultas->id, 'id_jurusan' => $krs->jurusan->id, 'id' => $krs->id, 'tingkat_semester'=> $krs->tingkat_semester, 'mapel_id'=> $krs->mapel->id, 'id_mahasiswa'=> $krs->mahasiswa->id])}}" class="btn btn-info">Update</a>
                                    <a href="{{route('admin.sp.destroy',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'tingkat_semester'=> $krs->tingkat_semester, 'id' => $krs->id, 'id_mahasiswa'=> $krs->mahasiswa->id, 'mapel_id'=> $krs->mapel->id ])}}" class="btn btn-danger">Delete</a>
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