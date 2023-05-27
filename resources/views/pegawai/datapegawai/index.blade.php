@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Pegawai
                </h1>
            </div>
            @can('create-pegawai')
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
                <span class="card-label fw-bold text-dark">Data Pegawai</span>
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
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th class="min-w-200px text-end rounded-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_pegawai as $pegawai)
                    <tr>
                      <td>{{$pegawai->id}}</td>
                      <td>{{$pegawai->NIP}}</td>
                      {{-- <td>
                        <div class="photo-table">
                          @if($pegawai->photo != null)
                          <img src="{{asset('pegawai/assets/images/users/pegawai/'.$pegawai->photo)}}" alt="">
                          @else
                          <img src="{{asset('pegawai/assets/images/users/pegawai/no-image.jpg')}}" alt="">
                          @endif
                        </div>
                      </td> --}}
                      <td>{{$pegawai->nama_pegawai}}</td>
                      <td>{{$pegawai->bagian_pegawai}}</td>
                      <td>{{$pegawai->jabatan_pegawai}}</td>
                      <td>{{$pegawai->status_pegawai}}</td>
                      <td>{{$pegawai->agama}}</td>
                      <td>{{$pegawai->alamat}}</td>
                      <td align="center">
                      @can('edit-pegawai')
                        <a href="{{route('pegawai.nonakademik.detail',['id' => $pegawai->id ])}}" type="button" class="btn btn-sm btn-info">Detail</a>
                      @endcan
                      @can('delete-pegawai')
                        <a href="{{route('pegawai.nonakademik.hapus',['id'=> $pegawai->id])}}" type="button" class="btn btn-sm btn-danger"onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                      @endcan
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('pegawai.datapegawai.create')}}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pegawai</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">NIP</label>
                        <input name="nip" type="text" class="form-control" placeholder="NIP">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Nama Pegawai</label>
                        <input name="nama_pegawai" type="text" class="form-control" placeholder="Nama Pegawai">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-control">
                          <option value="Islam">Islam</option>
                          <option value="Kristen">Kristen</option>
                          <option value="Katolik">Katolik</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Budha">Budha</option>
                        </select>
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="date" class="form-control">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                          <option value="L">Laki-Laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">No Handphone</label>
                        <input name="no_hp" type="text" class="form-control">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat Lengkap"></textarea>
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Bagian Pegawai</label>
                        <input name="bagian_pegawai" type="texts" class="form-control" placeholder="Bagian Pegawai">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Jabatan Pegawai</label>
                        <input name="jabatan_pegawai" type="texts" class="form-control" placeholder="Jabatan Pegawai">
                      </div>

                      <div class="fv-row mb-5">
                        <label class="form-label">Status Pegawai</label>
                        <select name="status_pegawai" class="form-control">
                          <option value="PNS">PNS</option>
                          <option value="Honorer">Honorer</option>
                        </select>
                      </div>

                      <div class="fv-row">
                        <label class="form-label">Tanggal Masuk</label>
                        <input name="tanggal_masuk" type="date" class="form-control" placeholder="Tanggal Masuk">
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
                            targets: 8,
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
