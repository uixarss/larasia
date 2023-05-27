@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6">
        <div class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Kumpulan Soal
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="#" class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSoal">Tambah Soal</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-flush h-lg-100">
        <div class="card-header pt-7 pb-0 d-block">
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-0" role="tablist">
                <li class="nav-item col-4 mx-0 p-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active" data-bs-toggle="pill"
                        href="#quiz" aria-selected="true" role="tab">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal Quiz
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#uts" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal UTS
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#uas" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                            Soal UAS
                        </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                    </a>
                </li>

                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="quiz" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal Quiz
                            </h3>
                            <span class="text-gray-400 fs-6">Kelola soal-soal Quiz</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_quiz"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_quiz">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-100px">Jumlah</th>
                                    <th class="min-w-100px">Waktu</th>
                                    <th class="min-w-100px">Created</th>
                                    <th class="min-w-250px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_quiz as $no => $quiz)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $quiz->kode_soal }}</td>
                                        <td>{{ $quiz->jenis_ujians->nama_jenis_ujian }}</td>
                                        <td>{{ $quiz->judul_kuis }}</td>
                                        <td>
                                            @foreach ($quiz->kelas as $kelas)
                                                <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $quiz->jumlah_soal }} Soal</td>
                                        <td>{{ $quiz->durasi }} Menit</td>
                                        <td>{{ $quiz->user->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.kumpulansoal.destroy', $quiz->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.kumpulansoal.show', $quiz->id) }}"
                                                    class="btn btn-sm btn-primary">Detail</a>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#editSoalQuiz{{ $quiz->id }}" type="button"
                                                    class="btn btn-sm btn-warning">Edit</button>
                                                <button href="#" type="submit"
                                                    class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editSoalQuiz{{ $quiz->id }}" tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Soal Quiz</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kumpulansoal.update', $quiz->id) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="jenis_soal">Jenis Soal</label>
                                                            <select name="jenis_soal" class="form-control" data-control="select2" data-hide-search="true" required>
                                                                @foreach ($jenis_soal as $jenis)
                                                                    @if ($quiz->jenis_ujians->id == $jenis->id)
                                                                        <option value="{{ $jenis->id }}" selected> {{ $jenis->nama_jenis_ujian }}</option>
                                                                    @else
                                                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_ujian }}</option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label">Masukan Kelas</label>
                                                            <select name="id_kelas[]" class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required>
                                                                @foreach ($data_kelas as $key => $kelas)
                                                                    <option value="{{ $kelas->id }}"
                                                                        @if ($quiz->kelas->containsStrict('id', $kelas->id)) selected="selected" @endif>
                                                                        {{ $kelas->nama_kelas }}</option>
                                                                    {{ $kelas->nama_kelas }}+{{ $key }}
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Kode Soal</label>
                                                            <input name="kode_soal" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $quiz->kode_soal }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Judul Soal</label>
                                                            <input name="judul_kuis" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $quiz->judul_kuis }}">
                                                        </div>


                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="durasi">Durasi</label>
                                                            <input name="durasi" type="number" class="form-control"
                                                                placeholder="Masukan Durasi Dalam Menit"
                                                                value="{{ $quiz->durasi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                            <input name="tanggal_mulai" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($quiz->tanggal_mulai)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                                            <input name="tanggal_akhir" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($quiz->tanggal_akhir)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
                <div class="tab-pane fade" id="uts" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal UTS
                            </h3>
                            <span class="text-gray-400 fs-6">Kelola soal-soal UTS</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_uts"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_uts">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-100px">Jumlah</th>
                                    <th class="min-w-100px">Waktu</th>
                                    <th class="min-w-100px">Created</th>
                                    <th class="min-w-250px text-end rounded-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_uts as $no => $uts)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $uts->kode_soal }}</td>
                                        <td>{{ $uts->jenis_ujians->nama_jenis_ujian }}</td>
                                        <td>{{ $uts->judul_kuis }}</td>
                                        <td>
                                            @foreach ($uts->kelas as $kelas)
                                                <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $uts->jumlah_soal }} Soal</td>
                                        <td>{{ $uts->durasi }} Menit</td>
                                        <td>{{ $uts->user->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.kumpulansoal.destroy', $uts->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.kumpulansoal.show', $uts->id) }}"
                                                    class="btn btn-sm btn-primary">Detail</a>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#editSoalUts{{ $uts->id }}" type="button"
                                                    class="btn btn-sm btn-warning">Edit</button>
                                                <button href="#" type="submit"
                                                    class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editSoalUts{{ $uts->id }}" tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Soal UTS</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{ route('admin.kumpulansoal.update', $uts->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="jenis_soal">Jenis Soal</label>
                                                            <select name="jenis_soal" class="form-select" data-control="select2" data-hide-search="true" required>
                                                                @foreach ($jenis_soal as $jenis)
                                                                    @if ($uts->jenis_ujians->id == $jenis->id)
                                                                        <option value="{{ $jenis->id }}" selected>
                                                                            {{ $jenis->nama_jenis_ujian }}</option>
                                                                    @else
                                                                        <option value="{{ $jenis->id }}">
                                                                            {{ $jenis->nama_jenis_ujian }}</option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="control-label">Masukan Kelas</label>
                                                            <select name="id_kelas[]" class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required>
                                                                @foreach ($data_kelas as $key => $kelas)
                                                                    <option value="{{ $kelas->id }}"
                                                                        @if ($uts->kelas->containsStrict('id', $kelas->id)) selected="selected" @endif>
                                                                        {{ $kelas->nama_kelas }}</option>
                                                                    {{ $kelas->nama_kelas }}+{{ $key }}
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Kode Soal</label>
                                                            <input name="kode_soal" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $uts->kode_soal }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Judul Soal</label>
                                                            <input name="judul_kuis" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $uts->judul_kuis }}">
                                                        </div>


                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="durasi">Durasi</label>
                                                            <input name="durasi" type="number" class="form-control"
                                                                placeholder="Masukan Durasi Dalam Menit"
                                                                value="{{ $uts->durasi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                            <input name="tanggal_mulai" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($uts->tanggal_mulai)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                                            <input name="tanggal_akhir" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($uts->tanggal_akhir)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
                <div class="tab-pane fade" id="uas" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal UAS
                            </h3>
                            <span class="text-gray-400 fs-6">Kelola soal-soal UAS</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search_uas"
                                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_uas">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-50px text-start rounded-start">No</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-100px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-100px">Kelas</th>
                                    <th class="min-w-100px">Jumlah</th>
                                    <th class="min-w-100px">Waktu</th>
                                    <th class="min-w-100px">Created</th>
                                    <th class="min-w-250px text-end rounded-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_uas as $no => $uas)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $uas->kode_soal }}</td>
                                        <td>{{ $uas->jenis_ujians->nama_jenis_ujian }}</td>
                                        <td>{{ $uas->judul_kuis }}</td>
                                        <td>
                                            @foreach ($uas->kelas as $kelas)
                                                <span class="badge badge-warning">{{ $kelas->nama_kelas }} </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $uas->jumlah_soal }} Soal</td>
                                        <td>{{ $uas->durasi }} Menit</td>
                                        <td>{{ $uas->user->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.kumpulansoal.destroy', $uas->id) }}"
                                                method="post">
                                                @csrf
                                                @method('post')
                                                <a href="{{ route('admin.kumpulansoal.show', $uas->id) }}" type="button"
                                                    class="btn btn-sm btn-primary">Detail</a>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#editSoalUas{{ $uas->id }}" type="button"
                                                    class="btn btn-sm btn-warning">Edit</button>
                                                <button href="#" type="submit"
                                                    class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editSoalUas{{ $uas->id }}" tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Soal UAS</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kumpulansoal.update', $uas->id) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="jenis_soal">Jenis Soal</label>
                                                            <select name="jenis_soal" class="form-select" data-control="select2" data-hide-search="true" required>
                                                                @foreach ($jenis_soal as $jenis)
                                                                    @if ($uas->jenis_ujians->id == $jenis->id)
                                                                        <option value="{{ $jenis->id }}" selected>
                                                                            {{ $jenis->nama_jenis_ujian }}</option>
                                                                    @else
                                                                        <option value="{{ $jenis->id }}">
                                                                            {{ $jenis->nama_jenis_ujian }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="control-label">Masukan Kelas</label>
                                                            <select name="id_kelas[]" class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required>
                                                                @foreach ($data_kelas as $key => $kelas)
                                                                    <option value="{{ $kelas->id }}"
                                                                        @if ($uas->kelas->containsStrict('id', $kelas->id)) selected="selected" @endif>
                                                                        {{ $kelas->nama_kelas }}
                                                                    </option>
                                                                    {{ $kelas->nama_kelas }}+{{ $key }}
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Kode Soal</label>
                                                            <input name="kode_soal" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $uas->kode_soal }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="kode_soal">Judul Soal</label>
                                                            <input name="judul_kuis" type="text"
                                                                class="form-control" placeholder="Masukan Kode Kuis"
                                                                value="{{ $uas->judul_kuis }}">
                                                        </div>


                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="durasi">Durasi</label>
                                                            <input name="durasi" type="number" class="form-control"
                                                                placeholder="Masukan Durasi Dalam Menit"
                                                                value="{{ $uas->durasi }}">
                                                        </div>

                                                        <div class="fv-row mb-5">
                                                            <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                            <input name="tanggal_mulai" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($uas->tanggal_mulai)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                        <div class="fv-row">
                                                            <label class="form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                                            <input name="tanggal_akhir" type="datetime-local"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($uas->tanggal_akhir)->format('Y-m-d\TH:i') }}" />
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
            </div>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambahSoal">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.kumpulansoal.store', ['id' => $id_dosen, 'mapel' => $mapel_id, 'id_prodi' => $id_prodi, 'semester' => $semester, 'tahun_ajaran' => $tahun_ajaran]) }}" method="POST">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Soal</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-5">
                        <label class="form-label" for="jenis_soal">Jenis Soal</label>
                        <select name="jenis_soal" class="form-select" data-control="select2" data-placeholder="Select an option" data-hide-search="true" required>
                            @foreach ($jenis_soal as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_ujian }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Masukan Kelas</label>
                        <select name="id_kelas[]" class="form-select" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required>
                            @foreach ($data_kelas as $kelas)
                                <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="kode_soal">Kode Soal</label>
                        <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="kode_soal">Judul Soal</label>
                        <input name="judul_kuis" type="text" class="form-control"
                            placeholder="Masukan Kode Kuis">
                    </div>


                    <div class="fv-row mb-5">
                        <label class="form-label" for="durasi">Durasi</label>
                        <input name="durasi" type="number" class="form-control"
                            placeholder="Masukan Durasi Dalam Menit">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        <input name="tanggal_mulai" type="datetime-local" class="form-control" />
                    </div>

                    <div class="fv-row">
                        <label class="form-label" for="tanggal_akhir">Tanggal Akhir</label>
                        <input name="tanggal_akhir" type="datetime-local" class="form-control" />
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
        var DataQuiz = function() {
            var table = document.getElementById('table_quiz');
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

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_quiz');
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

        var DataUTS = function() {
            var table = document.getElementById('table_uts');
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

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_uts');
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

        var DataUAS = function() {
            var table = document.getElementById('table_uas');
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

            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_uas');
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
            DataQuiz.init();
            DataUTS.init();
            DataUAS.init();
        });
    </script>
@endsection
