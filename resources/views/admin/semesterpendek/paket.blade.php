@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.paket.semesterpendek.index')}}">Data Prodi</a></li>
    <li class="active">Data Mata Kuliah Semester Antara Prodi {{$prodi->nama_program_studi}}</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Data Mata Kuliah Semester Antara Prodi {{$prodi->nama_program_studi}}</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">

                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a class="" data-toggle="modal" data-target="#tambahPaketKRS"><span class="fa fa-plus-circle"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Tahun Ajaran</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_paket as $no => $paket)

                            <tr>
                                <td>{{++$no}}</td>
                                <td>
                                    {{$paket->mapel->nama_mapel}}
                                </td>
                                <td>{{$paket->tahun->nama_tahun_ajaran}}</td>
                                <td align="center">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#editPaket{{$paket->id}}">Edit</a>
                                    <a href="{{route('admin.paket.sp.destroy', [ 'id_prodi' => $prodi->id_prodi,'id'=>$paket->id])}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                </td>
                                <!-- MODAL EDIT SEMESTER-->
                                <div class="modal fade" id="editPaket{{$paket->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Data Paket</h5>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('admin.paket.sp.update', ['id_prodi' => $prodi->id_prodi,'id'=>$paket->id])}}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label>Pilih Mata Kuliah</label>
                                                        <select name="mapel_id" id="mapel_id{{$paket->id}}" class="form-control select" data-live-search="true" required>
                                                            @foreach($data_mapel as $mapel)
                                                            <option value="{{$mapel->id}}" {{($mapel->id == $paket->mapel_id) ? 'selected' : ''}}>{{$mapel->nama_mapel}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Pilih Tahun Ajaran</label>
                                                        <select name="tingkat_semester" id="tingkat_semester{{$paket->id}}" class="form-control select" data-live-search="true" required>
                                                            @foreach($data_tahun as $tahun)
                                                            <option value="{{$tahun->id}}" {{($tahun->id == $paket->tingkat_semester_id) ? 'selected' : ''}}>{{$tahun->nama_tahun_ajaran}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL EDIT SEMESTER-->
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
            <!-- Modal Tambah Prodi-->
            <div class="modal fade" id="tambahPaketKRS" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Paket KRS</h5>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('admin.paket.sp.store',[ 'id_prodi' => $prodi->id_prodi ])}}" method="post">
                                @csrf


                                <div class="form-group">
                                    <label>Pilih Mata Kuliah</label>
                                    <select name="mapel_id[]" id="mapel_id" class="form-control select" data-live-search="true" multiple required>
                                        @foreach($data_mapel as $mapel)
                                        <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Tahun Ajaran</label>
                                    <select name="tingkat_semester" id="tingkat_semester_id" class="form-control select" data-live-search="true" required>
                                        @foreach($data_tahun as $tahun)
                                        <option value="{{$tahun->id}}">{{$tahun->nama_tahun_ajaran}}</option>
                                        @endforeach
                                    </select>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end-->


        </div>
    </div>
</div>


@stop