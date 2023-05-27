@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Program Studi
                </h1>
            </div>
            @can('create-prodi')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
            </div>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">Data Program Studi</span>
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
                        <th>Nama Jurusan</th>
                        <th>Kode Prodi</th>
                        <th>Nama Prodi</th>
                        <th>Status</th>
                        <th>Jenjang</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;?>
                    @foreach($prodi as $prodi)
                    <?php $no++ ;?>
                  <tr>
                      <td>{{$no}}</td>
                      <td>{{$prodi->nama_jurusan}}</td>
                      <td>{{$prodi->kode_program_studi}}</td>
                      <td>{{$prodi->nama_program_studi}}</td>
                      <td>{{$prodi->status}}</td>
                      <td>{{$prodi->nama_jenjang_pendidikan}}</td>
                      <td align="center">
                        @can('edit-prodi')
                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProdi{{$prodi->id_prodi}}">Edit</a>
                        @endcan
                        @can('delete-prodi')
                        <a href="{{route('pegawai.prodi.destroy', $prodi->id_prodi)}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                        @endcan
                      </td>
                    </tr>
                    <!-- Modal edit prodi-->
                    <div class="modal fade" id="editProdi{{$prodi->id_prodi}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Program Studi</h3>
                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-lg fs-3"></i>
                                </div>
                            </div>
                          <div class="modal-body">

                            <form action="{{route('pegawai.prodi.update', $prodi->id_prodi)}}" method="post">
                              @csrf

                              <div class="fv-row mb-5">
                                  <label class="form-label">Jurusan</label>
                                  <select name="id_jurusan" class="form-control">
                                      @foreach($jurusan as $jur)
                                      <option value="{{$jur->id}}"{{ $jur->id == $prodi->id_jurusan ? 'selected' : ''  }} >{{$jur->nama_jurusan}}</option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="fv-row mb-5">
                                <label class="form-label">Kode Prodi</label>
                                <input name="kode_program_studi" type="text" class="form-control" value="{{$prodi->kode_program_studi}}">
                              </div>

                              <div class="fv-row mb-5">
                                <label class="form-label">Nama Prodi</label>
                                <input name="nama_program_studi" type="text" class="form-control" value="{{$prodi->nama_program_studi}}">
                              </div>

                              <div class="fv-row mb-5">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                  <option value="A" @if($prodi->status == 'A')selected @endif>A</option>
                                  <option value="B" @if($prodi->status == 'B')selected @endif>B</option>
                                  <option value="C" @if($prodi->status == 'C')selected @endif>C</option>
                                  <option value="D" @if($prodi->status == 'D')selected @endif>D</option>
                                  <option value="Belum Terakreditasi" @if($prodi->status == 'Belum Terakreditasi')selected @endif>Belum Terakreditasi</option>
                                </select>
                              </div>

                              <div class="fv-row">
                                  <label class="form-label">Jenjang Pendidikan</label>
                                  <select name="nama_jenjang_pendidikan" class="form-control">
                                      @foreach($jenjang as $jen)
                                      <option value="{{$jen->nama_jenjang}},{{$jen->id}}"{{ $jen->id == $prodi->id_jenjang_pendidikan ? 'selected' : ''  }} >{{$jen->nama_jenjang}}</option>
                                      @endforeach
                                  </select>
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
                    <!-- Modal end-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('pegawai.prodi.create')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Program Studi</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Jurusan</label>
                        <select name="id_jurusan" class="form-control">
                            @foreach($jurusan as $jur)
                            <option value="{{$jur->id}}">{{$jur->nama_jurusan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-5">
                      <label class="form-label">Kode Prodi</label>
                      <input name="kode_program_studi" type="text" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                      <label class="form-label">Nama Prodi</label>
                      <input name="nama_program_studi" type="text" class="form-control">
                    </div>

                    <div class="fv-row mb-5">
                      <label class="form-label">Status</label>
                      <select name="status" class="form-control">
                        <option value="A" >A</option>
                        <option value="B" >B</option>
                        <option value="C" >C</option>
                        <option value="D" >D</option>
                        <option value="Belum Terakreditasi">Belum Terakreditasi</option>
                      </select>
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Jenjang Pendidikan</label>
                        <select name="nama_jenjang_pendidikan" class="form-control">
                            @foreach($jenjang as $jen)
                            <option value="{{$jen->nama_jenjang}},{{$jen->id}}" >{{$jen->nama_jenjang}}</option>
                            @endforeach
                        </select>
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
                            targets: 6,
                            className: 'dt-body-right'
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
