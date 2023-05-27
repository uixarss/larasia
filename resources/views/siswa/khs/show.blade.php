@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.khs.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.khs.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li><a href="{{route('admin.khs.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}">Program Studi {{$prodi->nama_program_studi}}</a></li>
    <li class="active">Lihat Kartu Hasil Studi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Lihat Kartu Hasil Studi {{$mahasiswa->nama_mahasiswa}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">

        <div class="col-md-4">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                @include('layouts.alert')
                <div class="panel-body">
                <form action="{{route('admin.khs.post',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi, 'id' => $krs->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tingkat (Semester)</label>
                            <div class="input-group">
                                <select name="tingkat_semester" id="tingkat_semester" class="form-control" disabled>
                                    <option value="1" {{($krs->tingkat_semester == 1) ? 'selected' : ''}}>1</option>
                                    <option value="2" {{($krs->tingkat_semester == 2) ? 'selected' : ''}}>2</option>
                                    <option value="3" {{($krs->tingkat_semester == 3) ? 'selected' : ''}}>3</option>
                                    <option value="4" {{($krs->tingkat_semester == 4) ? 'selected' : ''}}>4</option>
                                    <option value="5" {{($krs->tingkat_semester == 5) ? 'selected' : ''}}>5</option>
                                    <option value="6" {{($krs->tingkat_semester == 6) ? 'selected' : ''}}>6</option>
                                    <option value="7" {{($krs->tingkat_semester == 7) ? 'selected' : ''}}>7</option>
                                    <option value="8" {{($krs->tingkat_semester == 8) ? 'selected' : ''}}>8</option>
                                </select>
                            </div>
                        </div>
                        


                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



        </div>
        <div class="col-md-8">

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
                                <th>Semester</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data_khs as $khs)
                            @foreach($krs->detail as $key => $detail)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                {{$khs->tahun->nama_tahun_ajaran}} / {{$khs->semester->nama_semester}}
                                </td>
                                <td>
                                {{$detail->mapel->kode_mapel}}
                                </td>
                                <td>{{$detail->mapel->nama_mapel}}</td>
                                <td>
                                {{$detail->mapel->jumlah_sks}}
                                </td>

                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



        </div>
    </div>
</div>



@stop