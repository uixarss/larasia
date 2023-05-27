@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    List Buku Perpustakaan
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Buku Perpustakaan</span>
            </h3>
            <div class="card-toolbar">
                <div class="d-flex align-items-center position-relative me-2">
                    <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                    <input type="text" id="search_filter" name="search_filter"
                        class="form-control form-control form-filter form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                        placeholder="Search">
                </div>
                <button type="button" class="me-1 btn btn-icon btn-sm btn-primary" id="btn-search"><i class="fa fa-search"></i></button>
                <button type="button" class="btn btn-icon btn-sm btn-danger" id="btn-clear"><i class="fa fa-trash"></i></button>
            </div>
        </div>

        <div class="card-body">
            <table class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                id="table_list">
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="min-w-50px rounded-start">No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th class="rounded-end">ISBN</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">

        //var token = '{{ Session::get('token') }}';
        //$(document).ajaxStart(function() {
         //   KTApp.blockPage({
         //       overlayColor: '#000000',
        //        type: 'v2',
        //        state: 'success',
       //         message: 'Please wait...'
       //     });
      //  });
     //   $(document).ajaxStop($.unblockUI);

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
                    ordering: false,
                    // searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: function(data, callback, settings) {
                        $.ajax({
                            url: "{{ url('/student/get_data_buku') }}",
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
                            data: 'judul_buku'
                        },
                        {
                            data: 'penulis'
                        },
                        {
                            data: 'penerbit'
                        },
                        {
                            data: 'ISBN'
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
