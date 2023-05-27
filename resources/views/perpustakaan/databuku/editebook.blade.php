@extends('layouts.adtheme')

@section('content')
    <form action="{{ route('perpustakaan.databuku.storeEBook') }}" method="post" enctype="multipart/form-data" class="card card-flush py-4">
        @csrf
        <div class="card-body">
            <input type="hidden" id="id" name="id" />
            <div class="d-flex flex-wrap gap-5">
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">ISBN:</label>
                    <input type="text" class="form-control" id="ISBN" name="ISBN" required />
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Judul Buku:</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" required />
                </div>
            </div>

            <div class="fv-row mb-5">
                <label class="form-label">Penulis:</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required />
            </div>

            <div class="d-flex flex-wrap gap-5">
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Penerbit:</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required />
                </div>
                <div class="fv-row w-100 flex-md-root mb-5">
                    <label class="form-label">Kategori:</label>
                    <select class="form-control select2" id="kategori_ebook_id" name="kategori_ebook_id" required> </select>
                </div>
            </div>

            <div class="fv-row mb-5">
                <label class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" required />
                <span class="form-text text-muted"></span>
            </div>
            <div class="fv-row mb-5">
                <label class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="0"> Belum Review</option>
                    <option value="1"> Publish</option>
                </select>
            </div>
            <div class="fv-row mb-5">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi_buku" id="deskripsi_buku" data-kt-autosize="true"  cols="20" rows="3"></textarea>
                <span class="form-text text-muted">Deskripsi buku secara singkat.</span>
            </div>
            <div class="fv-row">
                <label class="form-label">File E-book:</label>
                <input type="file" class="form-control" id="file_ebook" name="file_ebook" required>
            </div>
        </div>
    </form>
@endsection


@section('data-scripts')

<script type="text/javascript">
    var _id = '{{$id}}';

    function loadpage(){
            $.ajax({
                url: "<?php echo URL::to('perpustakaan/get_data_ebook'); ?>/"+_id,

                type: "GET",
                success: function(res) {
                    data=res.data;

                    $('#id').val(_id);
                    $('#judul_buku').val(data.judul_ebook);
                    $('#ISBN').val(data.ISBN);
                    $('#penulis').val(data.penulis);
                    $('#penerbit').val(data.penerbit);
                    $('#tanggal_terbit').val(data.tanggal_terbit);
                    $('#status').val(data.status);
                    $('#deskripsi').val(data.deskripsi);
                    $('#file_ebook').val(data.file_ebook);
                    var opt_kategori_ebook_id = new Option(data.nama_kategori,data.kategori_ebook_id, false, false);
                    $('#kategori_ebook_id').html(opt_kategori_ebook_id);

                },
            });


    }

    jQuery(document).ready(function() {
        loadpage();
    });

    $('#kategori_ebook_id').select2({
        ajax: {
            url: "<?php echo URL::to('perpustakaan/get_kategori'); ?>",
            dataType: 'json',
            delay: 200, //delay panggil ajax ketika ketik (milisecond)
            data: function (params) {
                var query = {
                    search_filter: params.term,
                    page: params.page || 1,
                    limit: 10
                }
                return query;
            },
            processResults: function (response) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                data = response.data.data;
                // console.log(data);
                data = $.map(data, function (obj) {
                    obj.id = obj.id; // replace id with the property used for the id
                    obj.text = obj.text || '['+obj.kode_kategori+'] '+obj.nama_kategori; // replace name with the property used for the text
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
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        },
        // minimumInputLength: 1,
        allowClear : true,
        placeholder: "--  Pilih  --",
        width: "100%",
        //dropdownParent: $("#tambahModul") //select2 kalo di modal dialog harus ditambah ini,issue nya gt
    });


</script>

@endsection
