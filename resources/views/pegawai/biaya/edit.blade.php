@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li>Finance</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h3><span class="fa fa-user"></span> Edit Biaya</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
    <!-- START Kontent -->
    <div class="row">
        <div class="col-md-12">

            <form action="{{route('pegawai.biaya.update',['id' => $biaya->id])}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Biaya</label>
                    <input name="nama" type="text" class="form-control" value="{{$biaya->nama}}">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Biaya</label>
                    <input name="deskripsi" type="text" class="form-control" value="{{$biaya->deskripsi}}">
                </div>
                <div class="form-group">
                    <label for="jenisbiaya">Jenis Biaya</label>
                    <select name="jenis_biaya_id" id="jenis_biaya_id">
                        @foreach($data_jenis_biaya as $jenis_biaya)
                        <option value="{{$jenis_biaya->id}}" {{($biaya->jenis_biaya_id == $jenis_biaya->id) ? 'selected' : ''}}>{{$jenis_biaya->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Nominal Biaya</label>
                    <input name="jumlah" type="number" class="form-control" value="{{$biaya->jumlah}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>


        </div>
    </div>
    <!-- END Kontent -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

@stop