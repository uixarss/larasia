@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Data Visi & Misi Prodi {{ $prodi->nama_program_studi }}
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.prodi.index') }}" class="text-muted text-hover-primary">Program Studi</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Data Visi & Misi Prodi {{ $prodi->nama_program_studi }}</li>
    </ul>
@endsection

@section('content')
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
            <div class="card card-px-0 bg-opacity-0">
                <div class="card-header border-0 pb-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-2x mb-1">Data Visi Prodi</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahVisi">Tambah Visi</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_visi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Visi</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            <?php $no = 0; ?>
                            @foreach ($data_visi as $visi)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $visi->teks }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editVisiprodi{{ $visi->id }}">Edit</a>

                                        <a href="{{ route('admin.prodi.visi.destroy', $visi->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>
                                <!-- Modal edit prodi-->
                                <div class="modal fade" id="editVisiprodi{{ $visi->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Visi Prodi</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('admin.prodi.visi.update', $visi->id) }}"
                                                    method="post">
                                                    @csrf

                                                    <div class="fv-row">
                                                        <label class="form-label">Visi Prodi</label>
                                                        <input name="teks" type="text" class="form-control"
                                                            value="{{ $visi->teks }}">
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
            <div class="modal fade" tabindex="-1" id="tambahVisi">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.prodi.visi.add', ['id' => $prodi->id_prodi]) }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Visi Prodi</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row">
                                <label class="form-label">Visi Prodi</label>
                                <input name="teks" type="text" class="form-control">
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
                        <span class="card-label fw-bold fs-2x mb-1">Data Misi Prodi</span>
                    </h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahMisi">Tambah Misi</button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="table_misi"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th>No</th>
                                <th>Visi</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            <?php $no = 0; ?>
                            @foreach ($data_misi as $misi)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $misi->teks }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editmisiprodi{{ $misi->id }}">Edit</a>
                                        <a href="{{ route('admin.prodi.misi.destroy', $misi->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                                    </td>
                                </tr>
                                <!-- Modal edit prodi-->
                                <div class="modal fade" id="editmisiprodi{{ $misi->id }}" data-backdrop="static"
                                    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edit Misi Prodi</h3>
                                                <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-lg fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('admin.prodi.misi.update', $misi->id) }}" method="post">
                                                    @csrf

                                                    <div class="fv-row">
                                                        <label class="form-label">Misi Prodi</label>
                                                        <input name="teks" type="text" class="form-control"
                                                            value="{{ $misi->teks }}">
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
            <div class="modal fade" tabindex="-1" id="tambahMisi">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('admin.prodi.misi.add', ['id' => $prodi->id_prodi]) }}" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Misi Prodi</h3>
                            <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="fv-row">
                                <label class="form-label">Misi prodi</label>
                                <input name="teks" type="text" class="form-control">
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
