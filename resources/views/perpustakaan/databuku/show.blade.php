@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Data Distributor Buku
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Buku dengan ISBN {{$buku->ISBN}}</span>
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
                        <th>Nama Distributor</th>
                        <th>Jumlah Buku</th>
                        <th>Tanggal Masuk</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku_detail as $no => $dis_buku)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$dis_buku->nama_distributor}}</td>
                      <td><span class="badge badge-info"> <strong>{{$dis_buku->pivot->jumlah_buku}} Buku</strong></span></td>
                      <td>{{$dis_buku->pivot->tanggal_masuk}}</td>
                      <td>
                          <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDataDistributorBuku{{$dis_buku->pivot->id}}">Edit</a>
                          <a href="{{route('perpustakaan.databuku.distributor.delete', ['id_buku' => $buku->id , 'id_distributor' => $dis_buku->pivot->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                      </td>
                    </tr>

                    <!-- EDIT DATA DISTRIBOTOR BUKU-->
                    <div class="modal fade" id="editDataDistributorBuku{{$dis_buku->pivot->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Edit Data Distributor Buku</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>
                          <div class="modal-body">

                            <form action="{{route('perpustakaan.databuku.distributor.update', ['id_buku' => $buku->id , 'id_distributor' => $dis_buku->pivot->id])}}" method="post">
                              {{csrf_field()}}

                              <div class="row">

                                <div class="form-group col-md-12 mb-5">
                                  <label class="form-label" for="distributor_id">Distributor</label>
                                  <select name="distributor_id" class="form-control" data-control="select2" data-dropdown-parent="#editDataDistributorBuku{{$dis_buku->pivot->id}}" data-placeholder="-Masukan Distributor Buku-" required>
                                    @foreach($data_distributor as $distributor)
                                    @if($distributor->id == $dis_buku->id)
                                    <option value="{{$distributor->id}}" selected>{{$distributor->nama_distributor}}</option>
                                    @else
                                    <option value="{{$distributor->id}}">{{$distributor->nama_distributor}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                </div>

                                <div class="form-group col-md-6">
                                  <label class="form-label" for="jumlah_buku">Jumlah Buku</label>
                                  <input name="jumlah_buku" type="number" class="form-control" value="{{$dis_buku->pivot->jumlah_buku}}"  placeholder="Masukan jumlah_buku">
                                </div>

                                <div class="form-group col-md-6">
                                  <label class="form-label" for="tanggal_masuk">Tanggal Masuk Buku</label>
                                  <input name="tanggal_masuk" type="date" class="form-control" value="{{$dis_buku->pivot->tanggal_masuk}}" placeholder="Masukan Tanggal">
                                </div><br>

                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END EDIT DATA DISTRIBOTOR BUKU -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" id="tambah" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Buku</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{route('perpustakaan.databuku.distributor.tambah', $buku->id)}}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="form-group col-md-12 mb-5">
                              <label class="form-label" for="distributor_id">Distributor</label>
                              <select name="distributor_id" class="form-control" data-control="select2" data-dropdown-parent="#tambah" data-placeholder="-Masukan Distributor Buku-" required>

                                @foreach($data_distributor as $distributor)
                                <option value="{{$distributor->id}}">{{$distributor->nama_distributor}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group col-md-6">
                              <label class="form-label" for="jumlah_buku">Jumlah Buku</label>
                              <input name="jumlah_buku" type="number" class="form-control"  placeholder="Masukan jumlah_buku">
                            </div>

                            <div class="form-group col-md-6">
                              <label class="form-label" for="tanggal_masuk">Tanggal Masuk Buku</label>
                              <input name="tanggal_masuk" type="date" class="form-control"  placeholder="Masukan Tanggal">
                            </div>

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
                            className: 'dt-body-right',
                            orderable: false,
                            targets: 4
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
   @endsection
