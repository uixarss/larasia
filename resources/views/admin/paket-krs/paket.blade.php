@extends('layouts.joliadmin')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
        <li><a href="{{ route('admin.paket.krs.index') }}">Data Prodi</a></li>
        <li class="active">Data Paket KRS Prodi {{ $prodi->nama_program_studi }}</li>
    </ul>
    <!-- END BREADCRUMB -->
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Data Paket KRS Prodi {{ $prodi->nama_program_studi }}</h2>
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
                            <li><a class="" data-toggle="modal" data-target="#tambahPaketKRS"><span
                                        class="fa fa-plus-circle"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Mata Kuliah</th>
                                    <th>Tingkat</th>
                                    @canany(['edit-paket-krs', 'delete-paket-krs'])
                                    <th>Opsi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_paket as $no => $paket)
                                    <tr>
                                        <td>
                                            {{ ++$no }}
                                        </td>
                                        <td>
                                            {{ $paket->mapel->kode_mapel ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paket->mapel->nama_mapel ?? '' }}
                                        </td>
                                        <td>
                                            Semester {{ $paket->tingkat_semester ?? '' }}
                                        </td>
                                        @canany(['edit-paket-krs', 'delete-paket-krs'])
                                        <td align="center">
                                            @can('edit-paket-krs')
                                                <a class="btn btn-success" data-toggle="modal"
                                                    data-target="#editPaket{{ $paket->id }}">Edit</a>
                                            @endcan

                                            @can('delete-paket-krs')
                                                <a href="{{ route('admin.paket.krs.destroy', ['id_prodi' => $prodi->id_prodi, 'id' => $paket->id]) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                            @endcan

                                        </td>    
                                        @endcanany
                                        
                                        <!-- MODAL EDIT SEMESTER-->
                                        <div class="modal fade" id="editPaket{{ $paket->id }}"
                                            data-backdrop="static" tabindex="-1" role="dialog"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Paket
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.paket.krs.update', ['id_prodi' => $prodi->id_prodi, 'id' => $paket->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Pilih Mata Kuliah</label>
                                                                <select name="mapel_id" id="mapel_id{{ $paket->id }}"
                                                                    class="form-control select" data-live-search="true"
                                                                    required>
                                                                    @foreach ($data_mapel as $mapel)
                                                                        <option value="{{ $mapel->id }}"
                                                                            {{ $mapel->id == $paket->mapel_id ? 'selected' : '' }}>
                                                                            {{ $mapel->nama_mapel }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tingkat Semester</label>
                                                                <select name="tingkat_semester" class="form-control"
                                                                    required>
                                                                    <option value="1"
                                                                        {{ $paket->tingkat_semester == 1 ? 'selected' : '' }}>
                                                                        1</option>
                                                                    <option value="2"
                                                                        {{ $paket->tingkat_semester == 2 ? 'selected' : '' }}>
                                                                        2</option>
                                                                    <option value="3"
                                                                        {{ $paket->tingkat_semester == 3 ? 'selected' : '' }}>
                                                                        3</option>
                                                                    <option value="4"
                                                                        {{ $paket->tingkat_semester == 4 ? 'selected' : '' }}>
                                                                        4</option>
                                                                    <option value="5"
                                                                        {{ $paket->tingkat_semester == 5 ? 'selected' : '' }}>
                                                                        5</option>
                                                                    <option value="6"
                                                                        {{ $paket->tingkat_semester == 6 ? 'selected' : '' }}>
                                                                        6</option>
                                                                    <option value="7"
                                                                        {{ $paket->tingkat_semester == 7 ? 'selected' : '' }}>
                                                                        7</option>
                                                                    <option value="8"
                                                                        {{ $paket->tingkat_semester == 8 ? 'selected' : '' }}>
                                                                        8</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
                <div class="modal fade" id="tambahPaketKRS" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Paket KRS</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.paket.krs.store', ['id_prodi' => $prodi->id_prodi]) }}"
                                    method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Pilih Mata Kuliah</label>
                                        <select name="mapel_id[]" id="mapel_id" class="form-control select"
                                            data-live-search="true" multiple required>
                                            @foreach ($data_mapel as $mapel)
                                                <option value="{{ $mapel->id }}">[{{$mapel->kode_mapel}}] {{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tingkat Semester</label>
                                        <select name="tingkat_semester" id="tingkat_semester" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
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