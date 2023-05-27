@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Pilih Tahun Ajaran</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Pilih Tahun Ajaran</h2>
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
                                <th>Tahun Ajaran / Semester</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_tahun as $no => $tahun)
                            @foreach($data_semester as $semester)
                            <tr>
                                <td>{{++$no}}</td>
                                <td>
                                    {{$tahun->nama_tahun_ajaran}} 
                                    {{$semester->nama_semester}}
                                </td>
                                <td align="center">
                                    <a href="{{route('admin.krs.pilih.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}" type="button" class="btn btn-primary">Pilih Prodi</a>
                                </td>
                            </tr>
                            @endforeach
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