@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Mata Kuliah
                </h1>
            </div>
            @can('create-mata-kuliah')
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
                <span class="card-label fw-bold text-dark">Data Mata Kuliah</span>
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
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Tipe Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Jumlah Jam</th>
                        <th>Keterangan</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                ?>
                @foreach($data_mapel as $mapel)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$mapel->kode_mapel}}</td>
                  <td>{{$mapel->nama_mapel}}</td>
                  <td>{{$mapel->tipemapel->tipe_pelajaran ?? ''}}</td>
                  <td>{{$mapel->jumlah_sks}}</td>
                  <td>{{$mapel->jumlah_jam}}</td>
                  <td>{{$mapel->keterangan ?? ''}}</td>
                  <td align="center">
                    @can('edit-mata-kuliah')
                    <a class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#editMapel{{$mapel->id}}">Edit</a>
                    @endcan
                    @can('delete-mata-kuliah')
                    <a href="{{route('pegawai.matakuliah.destroy',['id' => $mapel->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                    @endcan
                  </td>
                </tr>

                <!-- MMODAL EDIT MATA PELAJARAN-->
                <div class="modal fade" id="editMapel{{$mapel->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit Mata Kuliah</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>
                      <div class="modal-body">

                        <form action="{{route('pegawai.matakuliah.update', $mapel->id)}}" method="post">
                          {{csrf_field()}}
                          <div class="fv-row mb-5">
                            <label class="form-label">Kode Mapel</label>
                            <input name="kode_mapel" type="text" class="form-control" value="{{$mapel->kode_mapel}}" placeholder="Masukan Kode Mata Kuliah" >
                          </div>

                          <div class="fv-row mb-5">
                            <label class="form-label">Nama Mapel</label>
                            <input name="nama_mapel" type="texts" class="form-control" value="{{$mapel->nama_mapel}}" placeholder="Masukan Mata Kuliah">
                          </div>

                          <div class="fv-row mb-5">
                            <label class="form-label">Tipe</label>
                            <select name="tipe_mapel_id" class="form-control" data-live-search="true" required>
                              @foreach($data_tipemapel as $tipemapel)
                              <option value="{{$tipemapel->id}}" {{($tipemapel->id == $mapel->tipe_mapel_id) ? 'selected' : ''}}>{{$tipemapel->tipe_pelajaran}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="fv-row mb-5">
                            <label class="form-label">Jumlah SKS</label>
                            <input name="jumlah_sks" type="number" class="form-control" value="{{$mapel->jumlah_sks}}" placeholder="Masukan Jumlah SKS">
                          </div>

                          <div class="fv-row mb-5">
                            <label class="form-label">Jumlah Jam</label>
                            <input name="jumlah_jam" type="number" class="form-control" value="{{$mapel->jumlah_jam}}" placeholder="Masukan Jumlah Jam">
                          </div>

                          <div class="fv-row">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" type="text" class="form-control">{{$mapel->keterangan}}</textarea>
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('pegawai.matakuliah.create')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Mata Kuliah</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input name="kode_mapel" type="text" class="form-control" placeholder="Masukan Mata Kuliah">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input name="nama_mapel" type="texts" class="form-control" placeholder="Masukan Mata Kuliah">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Tipe</label>
                        <select name="tipe_mapel_id" class="form-control" data-live-search="true" required>
                          @foreach($data_tipemapel as $tipemapel)
                          <option value="{{$tipemapel->id}}">{{$tipemapel->tipe_pelajaran}}</option>
                          @endforeach

                        </select>
                      </div>
                      <div class="fv-row mb-5">
                        <label class="form-label">Jumlah SKS</label>
                        <input name="jumlah_sks" type="number" class="form-control" placeholder="Masukan Jumlah SKS">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Jumlah Jam</label>
                        <input name="jumlah_jam" type="number" class="form-control" placeholder="Masukan Jumlah Jam">
                      </div>

                      <div class="fv-row">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" type="text" class="form-control"></textarea>
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
                            targets: 7,
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
