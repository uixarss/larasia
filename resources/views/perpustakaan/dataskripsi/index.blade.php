@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Data Skripsi
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn fw-bold btn-primary" data-toggle="modal" onclick="store()">Tambah</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Skripsi Perpustakaan</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="table_search"
                        class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                id="table_data">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="min-w-50px rounded-start">No</th>
                        <th class="min-w-100px">Judul</th>
                        <th class="min-w-100px">Metode</th>
                        <th class="min-w-100px">Penulis</th>
                        <th class="min-w-100px">Tahun Terbit</th>
                        <th class="min-w-100px">Prodi</th>
                        <th class="min-w-100px">NRP</th>
                        <th class="min-w-50px">Rak</th>
                        <th class="min-w-50px">Baris</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_skripsi as $no => $ebook)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $ebook->judul }}</td>
                            <td>{{ $ebook->metode }}</td>
                            <td>{{ $ebook->penulis }}</td>
                            <td>{{ $ebook->tahun_terbit }}</td>
                            <td>{{ $ebook->nm_prodi }}</td>
                            <td>{{ $ebook->nrp }}</td>
                            <td>{{ $ebook->rak }}</td>
                            <td>{{ $ebook->baris }}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-warning"
                                    onclick="ubah({{ $ebook->id }},'{{ $ebook->judul }}','{{ $ebook->metode }}', '{{ $ebook->penulis }}','{{ $ebook->tahun_terbit }}','{{ $ebook->id_prodi }}','{{ $ebook->nm_prodi }}','{{ $ebook->nrp }}','{{ $ebook->rak }}','{{ $ebook->baris }}')">Edit</a>
                                <a href="javascript:hapus({{ $ebook->id }});" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" id="ubahModul" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ubah Data Skripsi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{ route('perpustakaan.dataskripsi.ubahdataskripsi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="edit_id" id="edit_id">

                        <div class=fv-row mb-5>
                            <label class="form-label">Judul Skripsi</label>
                            <input name="edit_judul" id="edit_judul" class="form-control" type="text" required>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Metode</label>
                            <input id="edit_metode" name="edit_metode" class="form-control" type="text" required>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Tahun Terbit</label>
                            <input id="edit_tahun" name="edit_tahun" class="form-control" type="text" required>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Prodi</label>
                            <select id="edit_prodi" name="edit_prodi" class="form-control select2" required></select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">NRP</label>
                            <select id="edit_nrp" name="edit_nrp" class="form-control select2" required></select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Rak</label>
                            <input id="edit_rak" name="edit_rak" class="form-control" type="text">
                        </div>
                        <div class="fv-row">
                            <label class="form-label">Baris</label>
                            <input id="edit_baris" name="edit_baris" class="form-control" type="text">
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModul" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Skripsi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('perpustakaan.dataskripsi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="fv-row mb-5">
                            <label class="form-label">Judul Skripsi</label>
                            <input name="judul" id="judul" class="form-control" type="text" required>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Metode</label>
                            <input id="metode" name="metode" class="form-control" type="text" required>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Tahun Terbit</label>
                            <input id="tahun" name="tahun" class="form-control" type="text" required>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Prodi</label>
                            <select id="prodi" name="prodi" class="form-control select2" required></select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">NRP</label>
                            <select id="nrp" name="nrp" class="form-control select2" required></select>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label">Rak</label>
                            <input id="rak" name="rak" class="form-control" type="text">
                        </div>
                        <div class="fv-row">
                            <label class="form-label">Baris</label>
                            <input id="baris" name="baris" class="form-control" type="text">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit2">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal Tambah-->
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ListData = function() {
            var table = document.getElementById('table_data');
            var datatable;
            var toolbarBase;

            // Private functions
            var initDataTable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": true,
                    "info": true,
                    'columnDefs': [{
                            orderable: false,
                            targets: 9
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search');
                filterSearch.addEventListener('keyup', function(e) {
                    datatable.search(e.target.value).draw();
                });
            }

            return {
                // Public functions
                init: function() {
                    if (!table) {
                        return;
                    }

                    initDataTable();
                    handleSearchDatatable();

                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            ListData.init();
        });
    </script>
    <script>
        var hapus = function(id) {

            var url = '{{ url('perpustakaan/dataskripsi/destroyDataSkripsi') }}';
            console.log(id);

            $.ajax({
                type: 'ajax',
                url: url,
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response, status, xhr, $form) {
                    alert("Data Berhasil dihapus!!");
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401) {
                        alert(jqXHR.responseJSON.message);
                    } else if (jqXHR.status == 422) {
                        let response = JSON.parse(jqXHR.responseText);
                        let errorString = '<ul>';
                        $.each(response.errors, function(key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        alert(errorString);
                    } else {
                        alert('Error Proses');
                    }
                }
            });
        }

        var ubah = function(id, nama, jml, sts, jumlah_real, prodi, nm_prodi, nrp, rak, baris) {
            $('#edit_id').val(id);
            $('#edit_judul').val(nama);
            $('#edit_metode').val(jml);

            // buat dulu object option yang sesuai data mau di load
            var opt_nama = new Option(sts, sts, false, false);
            $('#edit_penulis').html(opt_nama);

            var opt_prodi = new Option(nm_prodi, prodi, false, false);
            $('#edit_prodi').html(opt_prodi);

            var opt_nrp = new Option(nrp, nrp, false, false);
            $('#edit_nrp').html(opt_nrp);
            // $('#edit_penulis').val(sts);
            $('#edit_tahun').val(jumlah_real);
            //$('#edit_prodi').val(prodi);
            // $('#edit_nrp').val(nrp);
            $('#edit_rak').val(rak);
            $('#edit_baris').val(baris);
            $('#ubahModul').modal('show');


        }

        var store = function() {
            // $('#edit_id').val(id);

            $('#tambahModul').modal('show');
            //console.log(id);

        }

        $('#penulis').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_penulis'); ?>",
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
                        obj.id = obj.nama_mahasiswa; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.nim + '] ' + obj
                            .nama_mahasiswa; // replace name with the property used for the text
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
            width: "100%",
            dropdownParent: $("#tambahModul")
        });

        $('#edit_penulis').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_penulis'); ?>",
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
                        obj.id = obj.nama_mahasiswa; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.nim + '] ' + obj
                            .nama_mahasiswa; // replace name with the property used for the text
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
            width: "100%",
            dropdownParent: $("#ubahModul")
        });

        $('#prodi').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_prodi'); ?>",
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
                        obj.id = obj.id || obj.id_prodi; // replace id with the property used for the id
                        obj.text = obj.text || obj
                            .nama_program_studi; // replace name with the property used for the text for the text
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
            width: "100%",
            dropdownParent: $("#tambahModul")
        });

        $('#edit_prodi').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_prodi'); ?>",
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
                        obj.id = obj.id || obj.id_prodi; // replace id with the property used for the id
                        obj.text = obj.text || obj
                            .nama_program_studi; // replace name with the property used for the text
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
            width: "100%",
            dropdownParent: $("#ubahModul")
        });

        $('#nrp').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_penulis'); ?>",
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
                        obj.id = obj.nim; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.nim + '] ' + obj
                            .nama_mahasiswa; // replace name with the property used for the text
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
            width: "100%",
            dropdownParent: $("#tambahModul")
        });

        $('#edit_nrp').select2({
            ajax: {
                url: "<?php echo URL::to('perpustakaan/dataskripsi/get_penulis'); ?>",
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
                        obj.id = obj.nim; // replace id with the property used for the id
                        obj.text = obj.text || '[' + obj.nim + '] ' + obj
                            .nama_mahasiswa; // replace name with the property used for the text
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
            width: "100%",
            dropdownParent: $("#ubahModul")
        });

        $(document).on('change', '#penulis', function() {
            var penulis = jQuery(this).val();
            console.log(penulis);
            if (penulis) {
                jQuery.ajax({
                    url: "<?php echo URL::to('perpustakaan/dataskripsi/get_penulis'); ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#nrp').empty();
                        jQuery.each(data, function(key, value) {
                            $('#nrp').append('<option value="' + value + '">' + key +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="nrp"]').empty();
            }
        });
    </script>
@endsection
