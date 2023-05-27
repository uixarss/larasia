@extends('layouts.adtheme')

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Data Absen SP</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex my-2">
                    <div class="row g-3">
                        <div class="col-auto justify-item-center">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="search_filter" name="search_filter" class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11 form-filter" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" id="btn-search" class="btn btn-primary btn-icon"><i class="bi bi-search"></i></button>
                            <button type="button" id="btn-clear" class="btn btn-danger btn-icon"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
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
                            <th>Mahasiswa</th>
                            <th>Pertemuan Ke</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th class="text-end">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection


@section('data-scripts')
<script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
    var id = {{$id_jadwal}};
    var LoadPage = function() {

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

                language: {
                    'lengthMenu': '_MENU_',
                },
                ordering: false,

                // searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: function(data, callback, settings) {
                    $.ajax({
                        url: "{{ url('dosen/absensisp/siswa/get_mapel') }}/"+id,
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
                columns: [
                    {
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    {
                        data: 'pertemuan_ke'
                    },
                    {
                        data: 'jam_masuk'
                    },
                    {
                        data: 'jam_keluar'
                    },
                    {
                        data: 'status'
                    },

                    {
                        data: {
                            id: 'id',
                        },
                        render: function(data, type, full, meta) {
                           var url = "{{url('dosen/absensisp/siswa/ubah_absen')}}/"+data.id;

                            return '<span class="dropdown">' +

                                        '<a class="btn btn-success" href="'+url+'"><i class="fa fa-pencil"></i>Ubah Status</a>'+

                                '</span>';
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
