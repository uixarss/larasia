@extends('layouts.adtheme')

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Data Pengumuman</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex my-2">
                    <div class="row g-3">
                        <div class="col-auto justify-item-center">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="search_filter" name="search_filter"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11 form-filter"
                                    placeholder="Search">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" id="btn-search" class="btn btn-primary btn-icon"><i
                                    class="bi bi-search"></i></button>
                            <button type="button" id="btn-clear" class="btn btn-danger btn-icon"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
                <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                    id="table_list">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="text-start rounded-start">No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th class="text-end">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('guru.pengumuman.store') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pengumuman</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" id="id_jadwal" name="id_jadwal" />
                    <div class="fv-row mb-5">
                        <label class="form-label" for="judul">Judul Pengumuman</label>
                        <input name="judul" type="text" class="form-control" placeholder="Masukan Judul Pengumuman">
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="isi">Isi Pengumuman</label>
                        <textarea class="form-control" name="isi" id="isi" cols="10" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Modal Tambah-->

    <div class="modal fade" id="ubahPengumuman" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Pengumuman</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{ route('guru.pengumuman.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_id_jadwal" name="id_jadwal">
                        <div class="fv-row mb-5">
                            <label class="form-label" for="kode_kategori">Judul</label>
                            <input type="text" class="form-control" id="edit_judul" name="judul" required />
                        </div>

                        <div class="fv-row">
                            <label class="form-label" for="nama_kategori">Isi</label>
                            <textarea class="form-control" name="isi" id="edit_isi" cols="10" rows="3"></textarea>
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
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ubahPengumuman = function(id, id_jadwal, judul, isi) {
            $('#edit_id').val(id);
            $('#edit_id_jadwal').val(id_jadwal);
            $('#edit_judul').val(judul);
            $('#edit_isi').val(isi);
            $('#ubahPengumuman').modal('show');
        }

        var id = {{ $id_jadwal }};

        function hapus(id) {
            swal.fire({
                title: 'Konfirmasi?',
                text: "Yakin akan hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!'
            }).then(function(result) {
                if (result.value) {

                    url = "<?php echo URL::to('dosen/pengumuman/destroy'); ?>";

                    $.ajax({
                        url: url,
                        method: 'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data, status) {
                            $('#alertvalidate').html('');
                            swal.fire("Berhasil!", "Data Berhasil dihapus!!", "success");
                            LoadPage.init();

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 404) {
                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + jqXHR.responseJSON.message +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);
                                swal.fire("Gagal!", "Data Gagal dihapus!!", "error");

                            } else if (jqXHR.status == 422) {
                                var response = JSON.parse(jqXHR.responseText);
                                var errorString = '<ul>';
                                $.each(response.errors, function(key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';

                                var alert = '<div class="alert alert-warning" role="alert">' +
                                    '<div class="alert-icon"><i class="flaticon-warning"></i></div>' +
                                    '<div class="alert-text">' + errorString +
                                    '</div>' +
                                    '</div>';

                                $('#alertvalidate').html(alert);

                                swal.fire("Gagal!", "Data Gagal dihapus, Periksa Inputan!!", "error");
                            } else {
                                swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");

                            }
                        }
                    });
                }
            });
        }
        var LoadPage = function() {
            $('#id_jadwal').val(id);
            // $.fn.dataTable.Api.register('column().title()', function() {
            //     return $(this.header()).text().trim();
            // });
            var arrows;

            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }



            var initTable1 = function() {

                $('#btn-clear').click(function() {
                    $('.form-filter').val('');
                });

                $('#btn-search').click(function() {
                    $('#table_list').dataTable().fnDraw();
                });

                // begin first table
                var table = $('#table_list').DataTable({
                    responsive: true,
                    bDestroy: true,
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    columnDefs: [{
                        targets: 3,
                        className: 'dt-body-right'
                    }],
                    ordering: false,


                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('dosen/pengumuman/kelas/get_kelas') }}/" + id,
                            data: {
                                limit: settings._iDisplayLength,
                                page: Math.ceil(settings._iDisplayStart / settings
                                    ._iDisplayLength) + 1,
                                search_filter: $('#search_filter').val(),
                            },
                            type: "GET",
                            dataType: 'json',
                            success: function(res) {
                                callback({
                                    recordsTotal: res.data.total,
                                    recordsFiltered: res.data.total,
                                    data: res.data.data
                                });
                            },
                        })
                    },
                    columns: [{
                            "data": "id",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'judul'
                        },
                        {
                            data: 'isi'
                        },

                        {
                            data: {
                                id: 'id',
                            },
                            render: function(data, type, full, meta) {
                                var url = "{{ url('dosen/pengumuman/edit') }}/" + data.id;

                                return '<a class="me-2 btn btn-sm btn-warning" onclick="ubahPengumuman(' + data.id + ', \'' + data.id_jadwal + '\', \'' + data.judul + '\', \'' + data.isi + '\')">Edit</a>' +
                                        '<a class="btn btn-sm btn-danger" href="javascript:hapus(' + data.id + ');" class="btn btn-danger">Hapus</a>';
                            },
                        },
                    ],
                });

            };
            return {

                //main function to initiate the module
                init: function() {
                    initTable1();

                }
            };
        }();

        jQuery(document).ready(function() {
            LoadPage.init();
        });
    </script>
@endsection
