@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Tambah Data Buku Perpustakaan
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn fw-bold btn-light">Cancel</button>
                <button class="btn fw-bold btn-primary">Simpan</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('perpustakaan.databuku.store') }}" method="POST" class="card card-flush py-4">
        @csrf
        <div class="card-body">
            <div class="d-flex flex-wrap gap-5">
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="ISBN" name="ISBN" required />
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" required />
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" required />
                </div>
            </div>
            <div class="d-flex flex-wrap gap-5">
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required />
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Kategori</label>
                    <select class="form-control" data-control="select2" data-placeholder="==Pilih Kategori=="
                        id="kategori_buku_id" name="kategori_buku_id" required> </select>
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Distributor</label>
                    <select class="form-control" data-control="select2" data-placeholder="==Pilih Distributor=="
                        id="distributor_buku_id" name="distributor_buku_id" required> </select>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-5">
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" required>
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                </div>
            </div>
            <div class="fv-row mb-5">
                <label class="form-label">Stok Buku</label>
                <input type="number" id="stok_buku" name="stok_buku" class="form-control" required>
            </div>
            <div class="fv-row">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" data-kt-autosize="true" required></textarea>
            </div>
        </div>
    </form>
@endsection


@section('data-scripts')
    <script>

        $('#kategori_buku_id').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/get_kategori'); ?>",
                dataType: 'json',
                delay: 200, //delay panggil ajax ketika ketik (milisecond)
                data: function(params) {
                    var query = {
                        search_filter: params.term,
                        page: params.page || 1,
                        limit: 500.
                    }
                    return query;
                },
                processResults: function(response, params) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    params.page = params.page || 1;
                    data = response.data.data;
                    // console.log(data);
                    data = $.map(data, function(obj) {
                        obj.id = obj.id; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.kode_kategori + '] ' + obj
                            .nama_kategori; // replace name with the property used for the text
                        return obj;
                    });
                    page = true;
                    if (data.length < 10) page = false;
                    return {
                        results: data,
                        pagination: {
                            more: page
                        }
                    };
                },
                cache: true
            },
            tags: true,
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                }
            },
            // minimumInputLength: 1,
            //dropdownParent: $("#tambahModul") //select2 kalo di modal dialog harus ditambah ini,issue nya gt
        });


        $('#distributor_buku_id').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/get_distributor'); ?>",
                dataType: 'json',
                delay: 200, //delay panggil ajax ketika ketik (milisecond)
                data: function(params) {
                    var query = {
                        search_filter: params.term,
                        page: params.page || 1,
                        limit: 10
                    }
                    return query;
                },
                processResults: function(response) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    data = response.data.data;
                    // console.log(data);
                    data = $.map(data, function(obj) {
                        obj.id = obj.id; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.kode_distributor + '] ' + obj
                            .nama_distributor; // replace name with the property used for the text
                        return obj;
                    });
                    page = true;
                    if (data.length < 10) page = false;
                    return {
                        results: data,
                        pagination: {
                            more: page
                        }
                    };
                }
            },
            tags: true,
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                }
            },
            // minimumInputLength: 1,
            allowClear: true,
            placeholder: "--  Pilih  --",
            //dropdownParent: $("#tambahModul") //select2 kalo di modal dialog harus ditambah ini,issue nya gt
        });
    </script>
@endsection
