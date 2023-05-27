@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6" style="background: #1e1e2d;">
        <div class="app-container container-fluid py-5">
            <div class="row g-5">
                <div class="col-xl-6 col-md-12">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap mb-10">
                        <h1 class="page-heading d-flex text-white fw-bold fs-3 flex-column justify-content-center my-0">
                            Ringkasan
                        </h1>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-6">
                            <div class="d-flex lex-grow-1">
                                <span class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="bi bi-book fs-2x text-primary"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column text-start">
                                    <span class="text-white fw-bold fs-2">{{ $jumlah_data_buku }}</span>
                                    <span class="text-light fw-semibold mt-1">Jumlah Data Buku</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex lex-grow-1">
                                <span class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="bi bi-book-half fs-2x text-warning"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column text-start">
                                    <span class="text-white fw-bold fs-2">{{ $jumlah_kondisi_buku }}</span>
                                    <span class="text-light fw-semibold mt-1">Jumlah Buku Yang Bermasalah</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex lex-grow-1">
                                <span class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-success">
                                        <i class="bi bi-journal-arrow-down fs-2x text-success"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column text-start">
                                    <span class="text-white fw-bold fs-2">{{ $jumlah_pengembalian }}</span>
                                    <span class="text-light fw-semibold mt-1">Jumlah Pengembalian Buku Hari Ini</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex lex-grow-1">
                                <span class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="bi bi-journal-arrow-up fs-2x text-info"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column text-start">
                                    <span class="text-white fw-bold fs-2">{{ $jumlah_peminjaman }}</span>
                                    <span class="text-light fw-semibold mt-1">Jumlah Peminjaman Buku Hari Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-12"></div>
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Kalendar Akademik</span>
                            </h3>
                        </div>

                        <div class="card-body pt-7 px-0">
                            <div class="mb-2 px-9">
                                @foreach ($events as $event)
                                    <div class="d-flex align-items-center mb-6">
                                        <span data-kt-element="bullet"
                                            class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4"
                                            style="background-color:{{ $event->color }}"></span>
                                        <div class="flex-grow-1 me-5">
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $event->title }}</a>
                                                <span class="text-gray-400 fw-bold">{{ $event->start }} s/d
                                                    {{ $event->end }}</span>
                                            </div>
                                            <div class="mt-3">
                                                <div class="text-gray-800">
                                                    {{ $event->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <ul class="pagination">
                                {{ $events->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-5 g-xl-10 mb-xl-10 mt-1">
        <div class="col-lg-12 col-xl-12 col-xxl-8 mb-5 mb-xl-0">
            <div class="d-flex flex-wrap flex-stack mb-6">
                <h3 class="fw-bold my-2">Statistik Peminjaman Buku dan Jumlah Denda</h3>
                <form action="{{ route('perpustakaan.halamanutama.carilaporanpinjaman') }}" method="POST"
                    class="d-flex my-2">
                    @csrf
                    <div class="row g-3">
                        <div class="col-auto">
                            <select name="year" class="form-control" data-live-search="true" required>
                                <option value="">-Pilih Tahun-</option>
                                @for ($years = 1999; $years <= 2050; $years++)
                                    @if ($rYear == $years)
                                        <option value="{{ $years }}" selected>Tahun {{ $years }}
                                        </option>
                                    @else
                                        <option value="{{ $years }}">Tahun {{ $years }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card mb-5">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Statistik Peminjaman Buku</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Pada Tahun {{ $rYear }}</span>
                    </h3>
                    <div class="card-toolbar">
                        Jumlah :<strong> {{ $jml_pinjam->jumlah ?? '0' }} Buku</strong>
                    </div>
                </div>
                <div class="card-body py-7">
                    @if ($jml_pinjam->jumlah == null)
                        <p class="text-center text-info push-up-35 push-down-30"> <strong>Belum Ada Data !</strong> </p>
                    @else
                        <div class="chart-holder mb-12" id="chart-bar-peminjaman" style="height: 300px;"></div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Statistik Jumlah Denda</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Pada Tahun {{ $rYear }}</span>
                    </h3>
                    <div class="card-toolbar">
                        Jumlah :<strong> {{ $jumlahDenda ?? '0' }},-</strong>
                    </div>
                </div>
                <div class="card-body pt-7">
                    @if ($jml_pinjam->jumlah == null)
                        <p class="text-center text-info push-up-35 push-down-30"> <strong>Belum Ada Data !</strong> </p>
                    @else
                        <div class="chart-holder mb-12" id="chart-bar-denda" style="height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 col-xxl-4 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Pengumuman</span>
                    </h3>
                    <div class="card-toolbar">
                        <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm btn-light">Tambah</a>
                    </div>
                </div>

                <div class="card-body pt-7 px-0">
                    <div class="mb-2 px-9">
                        @foreach ($data_pengumuman as $pengumuman)
                            <div class="d-flex align-items-center mb-6">
                                <span data-kt-element="bullet"
                                    class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                <div class="flex-grow-1 me-5">
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $pengumuman->judul_pengumuman }}</a>
                                        <span class="text-gray-400 fw-bold">{{ $pengumuman->tanggal_pengumuman }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-gray-800">
                                            {!! $pengumuman->isi_pengumuman !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="pagination">
                        {{ $data_pengumuman->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.pengumuman.add') }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pengumuman</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Pilih Tanggal</label>
                        <input name="tanggal_pengumuman" type="datetime-local" class="form-control"
                            placeholder="Tanggal Mulai">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" name="judul_pengumuman">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control" name="isi_pengumuman" rows="5"></textarea>
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


@section('data-scripts')
    <script type="text/javascript" src="{{ asset('admin/js/plugins/morris/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/plugins/morris/morris.min.js') }}"></script>
    <script>
        $(function() {

            Morris.Bar({
                element: 'chart-bar-peminjaman',
                data: @php echo $nama_bulan; @endphp,
                xkey: 'months',
                ykeys: ['jumlah'],
                labels: ['Jumlah'],
                barColors: ['#1EAF9A']
            });

        });

        $(function() {

            Morris.Bar({
                element: 'chart-bar-denda',
                data: @php echo $denda; @endphp,
                xkey: 'months',
                ykeys: ['jumlah'],
                labels: ['Jumlah'],
                barColors: ['#1EAF9A']
            });

        });
    </script>
@endsection
