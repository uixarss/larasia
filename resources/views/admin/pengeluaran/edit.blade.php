@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Edit Pengeluaran
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="/admin/pengeluaran" class="text-muted text-hover-primary">Pengeluaran</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Edit</li>
    </ul>
@endsection

@section('content')

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Form Edit Pengeluaran</h3>
            </div>
        </div>


        <form action="{{route('admin.pengeluaran.update',['id' => $pengeluaran->id])}}" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework">
            @csrf
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Kategori Biaya</label>
                    <div class="col-lg-10">
                        <select name="biaya_id" id="biaya_id" class="form-control">
                            @foreach($data_biaya as $biaya)
                            <option value="{{$biaya->id}}" {{$biaya->id == $pengeluaran->biaya_id ? 'selected' : ''}} >{{$biaya->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Nama</label>
                    <div class="col-lg-10 fv-row">
                        <input name="nama" type="text" class="form-control" value="{{$pengeluaran->nama}}">
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Deskripsi</label>
                    <div class="col-lg-10 fv-row">
                        <input name="deskripsi" type="text" class="form-control" value="{{$pengeluaran->deskripsi}}">
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Tanggal</label>
                    <div class="col-lg-10 fv-row">
                        <input name="tanggal" type="datetime-local" class="form-control" value="{{\Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d\TH:i')}}">
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Jumlah</label>
                    <div class="col-lg-10 fv-row">
                        <input name="amount" type="number" class="form-control" value="{{$pengeluaran->amount}}">
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Transfer Via</label>
                    <div class="col-lg-10 fv-row">
                        <input name="transfer_via" type="text" class="form-control" value="{{$pengeluaran->transfer_via}}">
                    </div>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Reset</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
