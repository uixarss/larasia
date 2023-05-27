@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6">
        <div class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mt-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Pengaturan
                </h1>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="d-flex flex-column flex-lg-row mt-5">
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-5">
            <div class="card pt-4 mb-6 mb-xl-8">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Profil</h2>
                    </div>
                    <div class="card-toolbar">
                        <button data-bs-toggle="modal" data-bs-target="#editakunperpus" class="btn btn-sm btn-info">Edit</button>
                    </div>
                </div>
                <div class="card-body pt-2 mb-3 ">
                    <div class="fw-bold">Nama</div>
                    <div class="text-gray-600">{{ $perpus->name }}</div>
                    <div class="fw-bold mt-5">Email</div>
                    <div class="text-gray-600">
                        <a href="#" class="text-gray-600 text-hover-primary">{{ $perpus->email }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Aturan Denda</h2>
                    </div>
                    <div class="card-toolbar">
                        <button data-bs-toggle="modal" data-bs-target="#editDenda" class="btn btn-sm btn-info">Edit</button>
                    </div>
                </div>
                <div class="card-body pt-2 pb-5">
                    <table class="table align-middle table-striped gy-7">
                        <tbody>
                            <tr>
                                <th>
                                    <div class="fw-bold d-flex align-items-center ps-9 fs-3">1 (Satu) hari Telat</div>
                                </th>
                                <td>:</td>
                                <td>
                                    <div class="fw-bold text-primary d-flex align-items-center ps-9 fs-3">Rp {{number_format($denda->uang_denda ?? '0' ,2,',','.') }}-</div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="fw-bold d-flex align-items-center ps-9 fs-3">Total Uang Denda Buku</div>
                                </th>
                                <td>:</td>
                                <td>
                                    <div class="fw-bold text-danger d-flex align-items-center ps-9 fs-3">Rp {{number_format($jumlah_denda ?? '0' ,2,',','.') }}-</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9" colspan="3">Mahasiswa yang telat mengembalikan buku pada batas yang telah ditentukan akan didenda perhari Rp. {{$denda->uang_denda ?? '0'}}, dan aturan ini dapat diubah.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT JADWAL UJIAN-->
    <div class="modal fade" id="editakunperpus" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Profil</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">

                    <form action="{{ route('perpustakaan.pengaturan.update', $perpus->id) }}" method="post"
                        enctype="multipart/form-data" class="form-horizontal">
                        {{ csrf_field() }}
                        @method('put')

                        <div class="panel-body">
                            <div class="row">

                                <div class="fv-row mb-5">
                                    <label class="form-label">Nama</label>
                                    <input name="name" type="text" class="form-control"
                                        value="{{ $perpus->name }}">
                                </div>

                                <div class="fv-row mb-5">
                                    <label class="form-label">Alamat Email</label>
                                    <input name="email" type="text" class="form-control"
                                        value="{{ auth()->user()->email }}">
                                </div>

                                <div class="fv-row">
                                    <label class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control">
                                </div>

                            </div>
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
    <!-- END EDIT JADWAL UJIAN-->


    <!-- MODAL EDIT DENDA-->
    <div class="modal fade" id="editDenda" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Setting Aturan Denda</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">

                    <form action="{{ route('perpustakaan.pengaturan.store') }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="form-group">
                                <label class="form-label" for="jumlah">Jumlah Denda</label>
                                <input type="hidden" name="id" value="{{ $denda->id ?? '' }}">
                                <input name="jumlah" type="number" class="form-control" value="{{ $denda->uang_denda ?? '' }}" placeholder="Masukan Jumlah Denda">
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL EDIT DENDA -->
@endsection
