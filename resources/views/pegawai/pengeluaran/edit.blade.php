@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('pegawai.pengeluaran.index')}}">Data Pengeluaran</a></li>
    <li>Tambah Pengeluaran</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h3><span class="fa fa-user"></span> Tambah Pengeluaran</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    @include('layouts.alert')
    <!-- START Kontent -->
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('pegawai.pengeluaran.update',['id' => $pengeluaran->id])}}" method="post" class="form-horizontal">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Tambah</strong> Pengeluaran</h3>
                    </div>
                    <div class="panel-body form-group-separated">

                        @csrf

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="biaya_id">Kategori Biaya</label>
                            <div class="col-md-6 col-xs-12">
                                <select name="biaya_id" id="biaya_id" class="form-control">
                                    @foreach($data_biaya as $biaya)
                                    <option value="{{$biaya->id}}" {{$biaya->id == $pengeluaran->biaya_id ? 'selected' : ''}}>{{$biaya->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="nama">Nama</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <input name="nama" type="text" class="form-control" value="{{$pengeluaran->nama}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="deskripsi">Deskripsi</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <input name="deskripsi" type="text" class="form-control" value="{{$pengeluaran->deskripsi}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="tanggal">Tanggal</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <input name="tanggal" type="datetime-local" class="form-control" value="{{$pengeluaran->tanggal}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="amount">Jumlah</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <input name="amount" type="number" class="form-control" value="{{$pengeluaran->amount}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="transfer_via">Transfer via</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <input name="transfer_via" type="text" class="form-control" value="{{$pengeluaran->transfer_via}}">
                                </div>
                            </div>
                        </div>




                    </div>

                    <div class="panel-footer">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Tambah</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>
    <!-- END Kontent -->
    <!-- END PAGE CONTENT WRAPPER -->
</div>
@stop