@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-5 g-xl-10 mb-xl-10">
        <div class="col-lg-12 col-xl-12 col-xxl-8 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Catatan Kepegawaian</span>
                    </h3>
                    <div class="card-toolbar">
                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah">Buat Catatan</a>
                    </div>
                </div>
                <div class="card-body pt-7">
                    <div class="mb-2 ">
                        @foreach ($data_catatan as $catatan)
                            @if (count($data_catatan) > 0)
                                <div class="d-flex align-items-center mb-6">
                                    <span data-kt-element="bullet"
                                        class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                    <div class="flex-grow-1 me-5">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $catatan->judul_catatan }}</a>
                                            <span
                                                class="text-gray-400 fw-bold">{{ \Carbon\Carbon::parse($catatan->tanggal_catatan)->format('d M Y') }}</span>
                                        </div>
                                        <div class="mt-3">
                                            <div class="text-gray-800">
                                                {!! $catatan->isi_catatan !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h1 class="fw-bolder fs-2 text-gray-900 mb-4">
                                    Oops!
                                </h1>
                                <div class="fw-semibold fs-6 text-gray-500 mb-7">
                                    Data tidak ditemukan.
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 col-xxl-4 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Kalender Akademik</span>
                    </h3>
                </div>

                <div class="card-body pt-7 px-0">
                    <div class="mb-2 px-9">
                        @foreach ($events as $event)
                            @if (count($events) > 0)
                                <div class="d-flex align-items-center mb-6">
                                    <span data-kt-element="bullet"
                                        class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                    <div class="flex-grow-1 me-5">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $event->title }}</a>
                                            <span class="text-gray-400 fw-bold">{{ $event->start }} -
                                                {{ $event->end }}</span>
                                        </div>
                                        <div class="mt-3">
                                            <div class="text-gray-800">
                                                {{ $event->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h1 class="fw-bolder fs-2 text-gray-900 mb-4">
                                    Oops!
                                </h1>
                                <div class="fw-semibold fs-6 text-gray-500 mb-7">
                                   Data tidak ditemukan.
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <ul class="pagination">
                        {{ $events->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ url('/pegawai/halamanutama/buatcatatan') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Catatan</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_catatan" value="">
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label">Judul Catatan</label>
                        <input type="text" class="form-control" name="judul_catatan">
                    </div>

                    <div class="fv-row">
                        <label class="form-label">Isi Catatan</label>
                        <textarea class="form-control" name="isi_catatan" rows="5"></textarea>
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
@endsection
