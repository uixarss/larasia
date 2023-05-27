@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.krs.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li class="active">Pilih Prodi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Pilih Prodi</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fakultas / Jurusan / Prodi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_prodi as $no => $prodi)

                            <tr>
                                <td>{{++$no}}</td>
                                <td>
                                    {{$prodi->jurusan->fakultas->nama_fakultas}} /
                                    {{$prodi->jurusan->nama_jurusan}} /
                                    {{$prodi->nama_program_studi}}
                                </td>
                                <td align="center">
                                    <a href="{{route('admin.sp.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}" type="button" class="btn btn-primary">Pilih</a>
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