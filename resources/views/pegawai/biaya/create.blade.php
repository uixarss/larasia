@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li>Data Biaya</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h3><span class="fa fa-user"></span> Tambah Biaya</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
    <!-- START Kontent -->
    <div class="row">
        <div class="col-md-12">

            <form action="{{route('pegawai.biaya.store')}}" method="post">
            @csrf
                <div class="form-group">
                    <label for="nama">Nama Biaya</label>
                    <input name="nama" type="text" class="form-control" placeholder="Contoh : SPP">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Biaya</label>
                    <input name="deskripsi" type="text" class="form-control" placeholder="....">
                </div>
                <div class="form-group">
                    <label for="jenisbiaya">Jenis Biaya</label>
                    <select name="jenis_biaya_id" id="jenis_biaya_id" class="form-control">
                        @foreach($data_jenis_biaya as $jenis_biaya)
                        <option value="{{$jenis_biaya->id}}">{{$jenis_biaya->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Nominal Biaya</label>
                    <input name="jumlah" type="number" class="form-control" placeholder="....">
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>


        </div>
    </div>
    <!-- END Kontent -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

@stop