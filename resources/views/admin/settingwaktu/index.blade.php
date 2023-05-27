@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Waktu & Hari Perkuliahan
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Waktu & Hari Perkuliahan</li>
    </ul>
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Waktu</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahWaktu">Tambah Waktu</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_visi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach($data_waktu as $waktu)
                            <tr>
                              <td>{{$waktu->jam_masuk}}</td>
                              <td>{{$waktu->jam_keluar}}</td>
                              <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJamMapel{{$waktu->id}}">Edit</a>
                                <a href="{{route('admin.waktu.destroy',['id' => $waktu->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                              </td>
                            </tr>

                            <!-- MODAL EDIT WAKTU PELAJARAN-->
                            <div class="modal fade" id="editJamMapel{{$waktu->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Waktu</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                  <div class="modal-body">

                                    <form action="{{route('admin.waktu.update',['id' => $waktu->id])}}" method="post" enctype="multipart/form-data">
                                      @csrf

                                      <div class="fv-row mb-5">
                                        <label class="form-label" for="exampleInputEmail1">Jam Masuk</label>
                                        <input name="jam_masuk" type="time" class="form-control" value="{{$waktu->jam_masuk}}">
                                      </div>

                                      <div class="fv-row">
                                        <label class="form-label" for="exampleInputEmail1">Jam Keluar</label>
                                        <input name="jam_keluar" type="time" class="form-control" value="{{$waktu->jam_keluar}}">
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
            <div class="modal fade" tabindex="-1" id="tambahWaktu">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{route('admin.waktu.add')}}"  method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Waktu</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row mb-5">
                                <label class="form-label" for="jam_masuk">Jam Masuk</label>
                                <input name="jam_masuk" type="time" class="form-control" placeholder="-">
                              </div>

                              <div class="fv-row">
                                <label class="form-label" for="jam_keluar">Jam Keluar</label>
                                <input name="jam_keluar" type="time" class="form-control" placeholder="-">
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
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Hari</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahHari">Tambah Hari</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_misi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>#</th>
                                <th>Hari</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach($data_hari as $hari)
                            <tr>
                              <td>{{$hari->id}}</td>
                              <td>{{$hari->hari}}</td>

                              <td class="text-end">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editHari{{$hari->id}}">Edit</a>
                                <a href="{{route('admin.hari.destroy',['id' => $hari->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                              </td>
                            </tr>

                            <!-- MODAL EDIT HARI -->
                            <div class="modal fade" id="editHari{{$hari->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Hari</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>
                                  <div class="modal-body">

                                    <form action="{{route('admin.hari.update',['id' => $hari->id])}}" method="post" enctype="multipart/form-data">
                                      @csrf

                                      <div class="fv-row">
                                        <label class="form-label" for="hari">Hari</label>
                                        <input name="hari" type="text" class="form-control" value="{{$hari->hari}}">
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
            <div class="modal fade" tabindex="-1" id="tambahHari">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{route('admin.hari.add')}}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Hari</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>


                        <div class="modal-body">
                            @csrf
                            <div class="fv-row">
                                <label class="form-label" for="hari">Hari</label>
                                <input name="hari" type="text" class="form-control" placeholder="">
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
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#table_visi").DataTable({
            'order': [],
            "info": false,
            'columnDefs': [{
                    orderable: false,
                    targets: 2
                }, // Disable ordering on column 6 (actions)
            ]
        });
        $("#table_misi").DataTable({
            'order': [],
            "info": false,
            'columnDefs': [{
                    orderable: false,
                    targets: 2
                }, // Disable ordering on column 6 (actions)
            ]
        });
    </script>
@endsection
