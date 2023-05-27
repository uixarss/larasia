@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li class="active">Daftar Ulang</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Ulang {{$prodi->nama_program_studi}} Tahun {{$tahun->nama_tahun_ajaran}} Semester {{$semester->nama_semester}} </h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default tabs">
                    <!-- START DEFAULT DATATABLE -->
                    <div class="panel panel-default">
                        <ul class="nav nav-tabs" role="tablist">
                            <li  class="active"><a href="#tab-first" role="tab" data-toggle="tab">Daftar Ulang</a></li>
                            <li><a href="#tab-second" role="tab" data-toggle="tab">Data Virtual Account</a></li>
                        </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane    active" id="tab-first">
                                        <div class="panel-heading">
                                            <ul class="panel-title">
                                                <a href="{{route('admin.daftarulang.create',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi])}}" class=" btn btn-success">Buat Daftar Ulang</a>
                                                <a href="{{route('admin.daftarulang.create_va',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi])}}" class=" btn btn-success">Buat Tagihan Baru</a>
                                            </ul>
                                            <ul class="panel-controls">
                                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            </ul>
                                        </div>
                                    @include('layouts.alert')
                                    
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama Lengkap Mahasiswa</th>
                                                    <th>Fakultas / Jurusan / Prodi</th>
                                                    <th>Tingkat (Semester)</th>
                                                    <th>Status (konfirmasi)</th>
                                                    <th>Status (pembayaran)</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data_daftar_ulang as $no => $daftarulang)

                                                <tr>
                                                    <td>{{++$no}}</td>
                                                    <td>{{$daftarulang->mahasiswa->nim}}</td>
                                                    <td>{{$daftarulang->mahasiswa->nama_mahasiswa}}</td>
                                                    <td>
                                                        {{$daftarulang->prodi->jurusan->fakultas->nama_fakultas}} /
                                                        {{$daftarulang->prodi->jurusan->nama_jurusan}} /
                                                        {{$daftarulang->prodi->nama_program_studi}}
                                                    </td>
                                                    <td>Semester {{$daftarulang->tingkat_semester}}</td>
                                                    <td> <span class="{{$daftarulang->konfirmasi == 0 ? 'badge badge-danger' : 'badge badge-success'}}">{{$daftarulang->konfirmasi == 0 ? 'Belum konfirmasi' : 'Konfirmasi'}}</span> </td>
                                                    <td><span class="{{$daftarulang->status_pembayaran == 0 ? 'badge badge-danger' : 'badge badge-success' }}">{{$daftarulang->status_pembayaran == 0 ? 'Belum Lunas' : 'Lunas' }}</span></td>
                                                    <td align="center">

                                                        <a href="{{route('admin.daftarulang.edit',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'id' => $daftarulang->id])}}" class="btn btn-info">Edit</a>
                                                        <a href="{{route('admin.daftarulang.destroy',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'id' => $daftarulang->id])}}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>

                                                @endforeach


                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="tab-second">
                                    @include('layouts.alert')         
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap Mahasiswa</th>
                                                    <th>Nomor Tagihan</th>
                                                    <th>Nomor VA</th>
                                                    <th>Deadline</th>
                                                    <th>Aksi</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($virtual_account as $no => $virtual_account)

                                                <tr>
                                                    <td>{{++$no}}</td>
                                                    <td>{{$virtual_account->customer_name}}</td>
                                                    <td>{{$virtual_account->trx_id}}</td>
                                                    <td>{{$virtual_account->virtual_account}}</td>
                                                    <td>{{$virtual_account->datetime_expired}}</td>
                                                    <td><a href="{{route('admin.daftarulang.detail_va',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id, 'id_prodi' => $prodi->id_prodi, 'tx' => $virtual_account->trx_id])}}" class=" btn btn-success">Cek Detail VA</a></td>

                                                </tr>

                                                @endforeach


                                            </tbody>
                                        </table>
                                </div>
                            </div>
                                 
                    </div>
                    <!-- END DEFAULT DATATABLE -->
            </div>
        </div>
    </div>
</div>




@stop