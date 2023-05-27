@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li>Data Pengeluaran</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h3><span class="fa fa-user"></span> Data Pengeluaran</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
    <!-- START Kontent -->
    <div class="row">
        <div class="col-md-4">
            <a href="#" class="tile tile-info">
                Rp {{number_format($data_revenue->sum->amount - $data_bills->sum->amount)}}
                <p>Total Saldo</p>
                <div class="informer informer-default dir-bl"><span class="fa fa-shopping-cart"></span></div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="tile tile-primary">
                Rp {{number_format($data_revenue->sum->amount)}}
                <p>Total Pemasukan</p>
                <div class="informer informer-default dir-bl"><span class="fa fa-shopping-cart"></span></div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="tile tile-danger">
                Rp {{number_format($data_bills->sum->amount)}}
                <p>Total Pengeluaran</p>
                <div class="informer informer-default dir-bl"><span class="fa fa-shopping-cart"></span></div>
            </a>
        </div>
        <div class="col-md-12">

            <!-- START TABS -->
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-akademik" role="tab" data-toggle="tab">Data Pengeluaran</a></li>
                </ul>
                <div class="panel-body tab-content">
                    @include('layouts.alert')
                    <div class="tab-pane active" id="tab-akademik">

                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @can('create-keuangan')
                                <h3 class="panel-title"><a href="{{route('pegawai.pengeluaran.create')}}" class="btn btn-success">Create New</a></h3>
                                @endcan
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Deskripsi</td>
                                            <td>Jenis Biaya</td>
                                            <td>Tanggal</td>
                                            <td>Jumlah</td>
                                            <td>Transfer Via</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_bills as $bill)
                                        <tr>
                                            <td>{{$bill->nama}}</td>
                                            <td>{{$bill->deskripsi}}</td>
                                            <td>{{$bill->jenis->nama ?? 'Belum ada'}}</td>
                                            <td>{{$bill->tanggal}}</td>
                                            <td>{{number_format($bill->amount)}}</td>
                                            <td>{{$bill->transfer_via}}</td>
                                            <td>
                                            @can('edit-keuangan')
                                                <a href="{{route('pegawai.pengeluaran.edit',[$bill])}}" class="btn btn-info">Edit</a>
                                            @endcan
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
            <!-- END TABS -->

        </div>
    </div>
    <!-- END Kontent -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

@stop