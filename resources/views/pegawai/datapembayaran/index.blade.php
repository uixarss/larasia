@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Pembayaran
                </h1>
            </div>
            @can('create-keuangan')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn fw-bold btn-primary">Tambah</button>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-6 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#data" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Data Pembayaran
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>
                <li class="nav-item col-6 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#riwayat" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Data Riwayat Pembayaran
                        </span>
                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="data" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Pembayaran
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_master">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="text-start rounded-start">Nama Mahasiswa</th>
                                    <th>Kelas</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Batas Tanggal</th>
                                    <th>Status Pembayaran</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="riwayat" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Data Riwayat Pembayaran
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_jenis">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="text-start rounded-start">Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Batas Tanggal</th>
                                    <th>Status Pembayaran</th>
                                    <th class="min-w-80px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="#" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Pembayaran</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Siswa</label>
                        <select name="id_kelas" class="form-control" data-live-search="true" required>
                          <option value="">-Masukan Nama Siswa-</option>

                          @foreach($data_siswa as $siswa)
                          <option value="{{$siswa->id}}">{{$siswa->nama_mahasiswa}}</option>
                          @endforeach

                        </select>
                      </div>

                      <div class="form-group">
                        <label class="form-label">Kelas</label>
                        <select name="id_kelas" class="form-control select" data-live-search="true" required>
                          <option value="">-Masukan Kelas-</option>

                          @foreach($data_kelas as $kelas)
                          <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                          @endforeach

                        </select>
                      </div>

                      <div class="form-group">
                        <label class="form-label">Nama Pembayaran</label>
                        <input name="" type="text" class="form-control" placeholder="Nama Pembayaran">
                      </div>

                      <div class="form-group">
                        <label class="form-label">Jumlah Pembayaran</label>
                        <input name="" type="texts" class="form-control" placeholder="Jumlah Pembayaran">
                      </div>

                      <div class="form-group">
                        <label class="form-label">Batas Tanggal</label>
                        <input name="" type="date" class="form-control" placeholder="Batas Tanggal">
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
        $(function() {

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $(document).ready(function() {


            var url_data = '{{route("pegawai.pembayaran.nonlunas")}}';
            var url_data_lunas = '{{route("pegawai.pembayaran.lunas")}}';


            $('#pembayaran-lunas').DataTable({
              serverSide: true,
              processing: true,
              destroy: true,
              paging: true,
              searching: true,
              ajax: {
                "url": url_data_lunas,
                "type": 'GET',
                "data": function(d) {

                  d.tanggal_deadline = $('#tanggal_deadline').val();
                  console.log(d);
                  setTimeout(function() {

                  }, 50);
                },
              },
              columns: [{
                  data: 'nama',
                  name: 'nama'
                }, {
                  data: 'kelas',
                  name: 'kelas'
                }, {
                  data: 'pembayaran',
                  name: 'pembayaran'
                }, {
                  data: 'jumlah',
                  name: 'jumlah'
                }, {
                  data: 'batas',
                  name: 'batas'
                }, {
                  data: 'status',
                  name: 'status'
                },
                {
                  data: 'action',
                  name: 'action'
                  // render: function(data) {
                  //   // url = url.replace(':kuis_id', kuis_id);
                  //   // url = url.replace(':kelas_id', data);
                  //   return data;
                  // }
                }
              ],

              deferRender: true,
              scrollY: 500,
              scrollCollapse: true,
              scroller: true,
            });

            $('#pembayaran-non-lunas').DataTable({
              serverSide: true,
              processing: true,
              destroy: true,
              paging: true,
              searching: true,
              ajax: {
                "url": url_data,
                "type": 'GET',
                "data": function(d) {

                  d.tanggal_deadline = $('#tanggal_deadline').val();
                  console.log(d);
                  setTimeout(function() {

                  }, 50);
                },
              },
              columns: [{
                  data: 'nama',
                  name: 'nama'
                }, {
                  data: 'kelas',
                  name: 'kelas'
                }, {
                  data: 'pembayaran',
                  name: 'pembayaran'
                }, {
                  data: 'jumlah',
                  name: 'jumlah'
                }, {
                  data: 'batas',
                  name: 'batas'
                }, {
                  data: 'status',
                  name: 'status'
                },
                {
                  data: 'action',
                  name: 'action'
                  // render: function(data) {
                  //   // url = url.replace(':kuis_id', kuis_id);
                  //   // url = url.replace(':kelas_id', data);
                  //   return data;
                  // }
                }
              ],

              deferRender: true,
              scrollY: 500,
              scrollCollapse: true,
              scroller: true,
            });



          });

        });
      </script>
@endsection
