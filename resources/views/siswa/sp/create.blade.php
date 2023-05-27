@extends('layouts.joliadmin-top')
@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Buat Data SP</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Buat Data Semester Pendek</h2>
</div>
<!-- END PAGE TITLE -->


<!-- PAGE TITLE -->
<div class="page-title">
  <h3><span class="fa fa-columns"></span> Tambah Data Semester Pendek</h3>
</div>
<!-- END PAGE TITLE -->

    <div class="kt-portlet__body">
        @include('layouts.alert')
        <div class="kt-section__body">
            <form action="{{route('siswa.sp.store')}}" method="post">
              {{csrf_field()}}
                <div class="form-group row">
                    <input type="hidden" id="id" name="id" />
                    <div class="col-lg-4">
                        <label>Fakultas :</label>
                                    <input type="text" value="{{$prodi->jurusan->fakultas->nama_fakultas ?? ''}}" name="id_fakultas" id="id_fakultas" class="form-control" disabled>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-4">
                        <label>Jurusan :</label>
                        <div class="input-group">
                                    <input type="text" value="{{$prodi->jurusan->nama_jurusan ?? ''}}" name="id_jurusan" id="id_jurusan" class="form-control" disabled>
                            </div>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-4">
                        <label>Program Studi :</label>
                            <div class="input-group">
                                    <input type="text" value="{{$prodi->nama_program_studi ?? ''}}" name="id_prodi" id="id_prodi" class="form-control" disabled>
                            </div>
                        <span class="form-text text-muted"></span>
                    </div>
              </div>
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label>Nama Mahasiswa</label>
                            <div class="input-group">
                                    <input type="text" value="{{$data_mahasiswa->nama_mahasiswa ?? ''}}" name="id_mahasiswa" id="id_mahasiswa" class="form-control" disabled>
                            </div>
                        <span class="form-text text-muted"></span>
                    </div>
                    
                </div>
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label>Tahun Ajaran : </label>
                        <div class="input-group">
                                    <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control select" data-live-search="true" required>
                                        @foreach($tahun as $tahun_ajaran)
                                        <option value="{{$tahun_ajaran->id}}">{{$tahun_ajaran->nama_tahun_ajaran}}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-4">
                        <label>Tingkat (Semester) : </label>
                            <div class="input-group">
                                    <select name="tingkat_semester" id="tingkat_semester" class="form-control" required>
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
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-4">
                        <label>Mata Kuliah : </label>
                            <div class="input-group">
                                    <select name="id_mapel" id="id_mapel" class="form-control select" data-live-search="true" required>
                                        @foreach($data_mapel  as $mapel)
                                        <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" align="left">
                        <button type="Submit" class="btn btn-primary" id="btn-simpan-input">Submit</button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
@stop
