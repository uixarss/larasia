@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Soal
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('guru.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Soal</li>
    </ul>
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
                            <span class="text-gray-400 fs-6"></span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary">Tambah</button>
                            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
                            <div class="d-flex align-items-center position-relative">
                                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                                <input type="text" id="table_search"
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
                                    <th class="min-w-30px text-start rounded-start">No</th>
                                    <th class="min-w-150px">Program Studi</th>
                                    <th class="min-w-100px">Semester</th>
                                    <th class="min-w-150px">Tahun Ajaran</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-150px">Mata Kuliah</th>
                                    <th class="min-w-200px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-200px">Kelas</th>
                                    <th class="min-w-200px">Jumlah</th>
                                    <th class="min-w-200px">Waktu</th>
                                    <th class="min-w-200px">Created</th>
                                    <th class="min-w-250px text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $j = 0; @endphp
                                @foreach ($data_quiz as $no => $quiz)
                                    @php $j++; @endphp
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $quiz->prodi->nama_program_studi }}</td>
                                        <td>{{ $quiz->semester->nama_semester }}</td>
                                        <td>{{ $quiz->tahunAjaran->nama_tahun_ajaran }}</td>
                                        <td>{{ $quiz->kode_soal }}</td>
                                        <td>{{ $quiz->mapel->nama_mapel }}</td>
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
                                        <td class="text-end">
                                            <form action="{{ route('guru.banksoal.destroy', $quiz->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('guru.banksoal.show', $quiz->id) }}" type="button"
                                                    class="btn btn-sm btn-info">Detail</a>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#editSoalKuis{{ $quiz->id }}" type="button"
                                                    class="btn btn-sm btn-warning">Edit</button>
                                                <button href="#" type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</button>
                                            </form>
                                        </td>

                                        <div class="modal fade" id="editSoalKuis{{ $quiz->id }}" data-backdrop="static"
                                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Edit Soal Quiz</h3>
                                                        <div class="btn btn-icon btn-sm btn-danger ms-2"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-lg fs-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('guru.banksoal.update', $quiz->id) }}"
                                                            method="POST">
                                                            {{ csrf_field() }}
                                                            @method('put')

                                                            <input name="prodi" id="prodi{{ $j }}"
                                                                type="text" value="{{ $quiz->id_prodi }}" hidden>
                                                            <input name="semester" id="semester{{ $j }}"
                                                                type="text" value="{{ $quiz->id_semester }}" hidden>
                                                            <input name="tahun_ajaran"
                                                                id="tahun_ajaran{{ $j }}" type="text"
                                                                value="{{ $quiz->id_tahun_ajaran }}" hidden>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label">Mata Kuliah</label>
                                                                <select name="mapel_id" id="mapel_id{{ $j }}"
                                                                    class="form-control" required>

                                                                    @foreach ($mapel as $map)
                                                                        <option value="{{ $map->mapel_id }}"
                                                                            {{ $quiz->mapel_id == $map->mapel_id ? 'selected' : '' }}>
                                                                            {{ $map->nama_mapel }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label">Program Studi</label>
                                                                <select name="id_prodi" id="id_prodi{{ $j }}"
                                                                    class="form-control" required>
                                                                    <option value="">== Pilih Program Studi ==
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label">Semester</label>
                                                                <select name="id_semester"
                                                                    id="id_semester{{ $j }}"
                                                                    class="form-control" required>
                                                                    <option value="">== Pilih Semester ==</option>
                                                                </select>
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label">Tahun Ajaran</label>
                                                                <select name="id_tahun_ajaran"
                                                                    id="id_tahun_ajaran{{ $j }}"
                                                                    class="form-control" required>
                                                                    <option value="">== Pilih Tahun Ajaran ==
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="fv-row mb-5">
                                                                <label class="form-label">Masukan Kelas</label>
                                                                <select name="id_kelas[]" id="kelas{{ $j }}"
                                                                    multiple class="form-control" data-live-search="true"
                                                                    required>
                                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                                    <script>
                                                                        jQuery.ajax({
                                                                            url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + {{ $quiz->mapel_id }},
                                                                            type: "GET",
                                                                            dataType: "json",
                                                                            success: function(data) {
                                                                                jQuery('#kelas' + {{ $j }}).empty();

                                                                                jQuery.each(data, function(key, value) {

                                                                                    $('#kelas' + {{ $j }}).append('<option value="' + value + '" >' + key +
                                                                                        '</option>');

                                                                                });

                                                                            }
                                                                        });

                                                                        $(document).on('change', '#mapel_id' + {{ $j }}, function() {
                                                                            var mapel = jQuery(this).val();
                                                                            jQuery.ajax({
                                                                                url: "{{ route('guru.materipelajaran.kelas', '') }}" + "/" + mapel,
                                                                                type: "GET",
                                                                                dataType: "json",
                                                                                success: function(data) {
                                                                                    jQuery('#kelas' + {{ $j }}).empty();
                                                                                    jQuery.each(data, function(key, value) {
                                                                                        $('#kelas' + {{ $j }}).append('<option value="' + value +
                                                                                            '" >' + key + '</option>');
                                                                                    });
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>
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


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{route('guru.banksoal.store')}}" method="POST">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Soal Quiz</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf
                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="jenis_soal">Jenis Soal</label>
                                        <select name="jenis_soal" class="form-control" data-live-search="true" required>

                                          @foreach($jenis_soal->where('id', 1) as $jenis)
                                          <option value="{{$jenis->id}}">{{$jenis->nama_jenis_ujian}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label">Mata Kuliah</label>
                                        <select name="mapel_id" id="mapel_id" class="form-control" required>

                                          @foreach($mapel as $map)
                                          <option value="{{$map->mapel_id}}" >{{$map->nama_mapel}}</option>
                                          @endforeach

                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label">Program Studi</label>
                                        <select name="id_prodi" id="id_prodi" class="form-control" required>
                                            <option value="">== Pilih Program Studi ==</option>
                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label">Semester</label>
                                        <select name="id_semester" id="id_semester" class="form-control" required>
                                            <option value="">== Pilih Semester ==</option>
                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control" required>
                                            <option value="">== Pilih Tahun Ajaran ==</option>
                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label">Masukan Kelas</label>
                                        <select name="id_kelas[]" id="kelas" multiple class="form-control" data-live-search="true" required>

                                        </select>
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label" for="kode_soal">Kode Soal</label>
                                        <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis">
                                      </div>

                                      <div class="fv-row mb-5">
                                        <label class="form-label" for="kode_soal">Judul Soal</label>
                                        <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Kode Kuis">
                                      </div>


                                      <div class="fv-row mb-5">
                                        <label class="form-label" for="durasi">Durasi</label>
                                        <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit">
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
                    <input id="jumlahQuiz" name="jumlahQuiz" type="text" value="{{$jumlah_quiz}}" hidden>
                </div>
                <div class="tab-pane fade" id="uts" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap flex-column justify-content-center my-1">
                            <h3 class="fw-bold me-5 my-1">
                                Soal UTS
                            </h3>
                            <span class="text-gray-400 fs-6"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_uts">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-30px text-start rounded-start">No</th>
                                    <th class="min-w-150px">Program Studi</th>
                                    <th class="min-w-100px">Semester</th>
                                    <th class="min-w-150px">Tahun Ajaran</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-150px">Mata Kuliah</th>
                                    <th class="min-w-200px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-200px">Kelas</th>
                                    <th class="min-w-200px">Jumlah</th>
                                    <th class="min-w-200px">Waktu</th>
                                    <th class="min-w-200px">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_uts as $no => $uts)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $uts->prodi->nama_program_studi }}</td>
                                        <td>{{ $uts->semester->nama_semester }}</td>
                                        <td>{{ $uts->tahunAjaran->nama_tahun_ajaran }}</td>
                                        <td>{{ $uts->kode_soal }}</td>
                                        <td>{{ $uts->mapel->nama_mapel }}</td>
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
                                    </tr>
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
                            <span class="text-gray-400 fs-6"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gs-5 gy-4"
                            id="table_uas">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-30px text-start rounded-start">No</th>
                                    <th class="min-w-150px">Program Studi</th>
                                    <th class="min-w-100px">Semester</th>
                                    <th class="min-w-150px">Tahun Ajaran</th>
                                    <th class="min-w-100px">Kode Soal</th>
                                    <th class="min-w-150px">Mata Kuliah</th>
                                    <th class="min-w-200px">Jenis Soal</th>
                                    <th class="min-w-100px">Nama Soal</th>
                                    <th class="min-w-200px">Kelas</th>
                                    <th class="min-w-200px">Jumlah</th>
                                    <th class="min-w-200px">Waktu</th>
                                    <th class="min-w-200px">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_uas as $no => $uas)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $uas->prodi->nama_program_studi }}</td>
                                        <td>{{ $uas->semester->nama_semester }}</td>
                                        <td>{{ $uas->tahunAjaran->nama_tahun_ajaran }}</td>
                                        <td>{{ $uas->kode_soal }}</td>
                                        <td>{{ $uas->mapel->nama_mapel }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('data-scripts')
<script>

    var mapel_id = document.getElementById("mapel_id").value;
    if (mapel_id) {
        jQuery.ajax({
            url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
              jQuery('#id_prodi').empty();
              jQuery.each(data, function(key, value) {
                $('#id_prodi').append('<option value="' + value + '">' + key + '</option>');
              });

              var id_prodi = document.getElementById("id_prodi").value;
              var mapel = document.getElementById("mapel_id").value;

              jQuery.ajax({
                url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel+ "/prodi/" + id_prodi,
                type: "GET",
                dataType: "json",
                success: function(data) {
                  jQuery('#id_semester').empty();
                  jQuery.each(data, function(key, value) {
                    $('#id_semester').append('<option value="' + value + '">' + key + '</option>');
                  });

                    var semester = document.getElementById("id_semester").value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel+ "/prodi/" + id_prodi+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      jQuery('#id_tahun_ajaran').empty();
                      jQuery.each(data, function(key, value) {
                        $('#id_tahun_ajaran').append('<option value="' + value + '">' + key + '</option>');
                      });
                      var map = document.getElementById("mapel_id").value;

                      jQuery.ajax({
                        url: "{{ route( 'guru.materipelajaran.kelas', '')}}" + "/" + map,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                          console.log(data);
                          jQuery('#kelas').empty();
                          jQuery.each(data, function(key, value) {
                            $('#kelas').append('<option value="' + value + '">' + key + '</option>');
                          });
                        }
                      });
                    }
                  });
                }
              });
            }
        });
    }else{
      $('select[name="id_prodi"]').empty();
    }

  $(document).on('change', '#mapel_id', function() {
      var jurusan = jQuery(this).val();
      if (jurusan) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_prodi').empty();
            jQuery.each(data, function(key, value) {
              $('#id_prodi').append('<option value="' + value + '">' + key + '</option>');
            });
            var id_prodi = document.getElementById("id_prodi").value;

              jQuery.ajax({
                url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan+ "/prodi/" + id_prodi,
                type: "GET",
                dataType: "json",
                success: function(data) {
                  jQuery('#id_semester').empty();
                  jQuery.each(data, function(key, value) {
                    $('#id_semester').append('<option value="' + value + '">' + key + '</option>');
                  });

                    var semester = document.getElementById("id_semester").value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan+ "/prodi/" + id_prodi+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      jQuery('#id_tahun_ajaran').empty();
                      jQuery.each(data, function(key, value) {
                        $('#id_tahun_ajaran').append('<option value="' + value + '">' + key + '</option>');
                      });
                      var map = document.getElementById("mapel_id").value;

                      jQuery.ajax({
                        url: "{{ route( 'guru.materipelajaran.kelas', '')}}" + "/" + map,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                          console.log(data);
                          jQuery('#kelas').empty();
                          jQuery.each(data, function(key, value) {
                            $('#kelas').append('<option value="' + value + '">' + key + '</option>');
                          });
                        }
                      });
                    }
                  });
                }
              });
          }
        });
      } else {
        $('select[name="id_prodi"]').empty();
      }
    });

    $(document).on('change', '#id_prodi', function() {
      var jurusan = jQuery(this).val();
      var mapel_id = document.getElementById("mapel_id").value;
      if (jurusan) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + jurusan,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_semester').empty();
            jQuery.each(data, function(key, value) {
              $('#id_semester').append('<option value="' + value + '">' + key + '</option>');
            });

            var semester = document.getElementById("id_semester").value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + jurusan+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      jQuery('#id_tahun_ajaran').empty();
                      jQuery.each(data, function(key, value) {
                        $('#id_tahun_ajaran').append('<option value="' + value + '">' + key + '</option>');
                      });
                    }
                  });

          }
        });
      } else {
        $('select[name="id_semester"]').empty();
      }
    });

    $(document).on('change', '#id_semester', function() {
      var semester = jQuery(this).val();
      var mapel_id = document.getElementById("mapel_id").value;
      var id_prodi = document.getElementById("id_prodi").value;
      if (semester) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + id_prodi+ "/semester/" + semester,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_tahun_ajaran').empty();
            jQuery.each(data, function(key, value) {
              $('#id_tahun_ajaran').append('<option value="' + value + '">' + key + '</option>');
            });
          }
        });
      } else {
        $('select[name="id_tahun_ajaran"]').empty();
      }
    });

    // Select Option Edit
    var jumlah = document.getElementById("jumlahQuiz");
    for (let i = 1; i <= jumlah.value; i++) {

      var mapel_id = document.getElementById("mapel_id"+i).value;

      if (mapel_id) {
        jQuery.ajax({
            url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
              var prodi = document.getElementById('prodi' + i);
              jQuery('#id_prodi'+i).empty();
              jQuery.each(data, function(key, value) {
                if(prodi.value != value){
                  $('#id_prodi'+i).append('<option value="' + value + '">' + key + '</option>');
                }else{
                  $('#id_prodi'+i).append('<option value="' + value + '" selected >' + key + '</option>');
                }
              });

              var id_prodi = document.getElementById("prodi"+i).value;
              var mapel = document.getElementById("mapel_id"+i).value;

              jQuery.ajax({
                url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel+ "/prodi/" + id_prodi,
                type: "GET",
                dataType: "json",
                success: function(data) {
                  var semester = document.getElementById('semester' + i);
                  jQuery('#id_semester'+i).empty();
                  jQuery.each(data, function(key, value) {
                    if(semester.value!=value){
                      $('#id_semester'+i).append('<option value="' + value + '">' + key + '</option>');
                    }else{
                      $('#id_semester'+i).append('<option value="' + value + '" selected>' + key + '</option>');
                    }
                  });

                    var semester = document.getElementById("id_semester"+i).value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel+ "/prodi/" + id_prodi+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      var tahun_ajaran = document.getElementById('tahun_ajaran' + i);
                      jQuery('#id_tahun_ajaran'+i).empty();
                      jQuery.each(data, function(key, value) {
                        if(tahun_ajaran.value!=value){
                          $('#id_tahun_ajaran'+i).append('<option value="' + value + '">' + key + '</option>');
                        }else{
                          $('#id_tahun_ajaran'+i).append('<option value="' + value + '"selected>' + key + '</option>');
                        }
                      });
                    }
                  });
                }
              });
            }
        });
    }else{
      $('select[name="id_prodi"]'+i).empty();
    }

      $(document).on('change', '#mapel_id'+i, function() {
      var jurusan = jQuery(this).val();

      if (jurusan) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_prodi'+i).empty();
            jQuery.each(data, function(key, value) {
              $('#id_prodi'+i).append('<option value="' + value + '">' + key + '</option>');
            });

            var id_prodi = document.getElementById("id_prodi"+i).value;

              jQuery.ajax({
                url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan+ "/prodi/" + id_prodi,
                type: "GET",
                dataType: "json",
                success: function(data) {
                  jQuery('#id_semester'+i).empty();
                  jQuery.each(data, function(key, value) {
                    $('#id_semester'+i).append('<option value="' + value + '">' + key + '</option>');
                  });

                    var semester = document.getElementById("id_semester"+i).value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + jurusan+ "/prodi/" + id_prodi+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      jQuery('#id_tahun_ajaran'+i).empty();
                      jQuery.each(data, function(key, value) {
                        $('#id_tahun_ajaran'+i).append('<option value="' + value + '">' + key + '</option>');
                      });
                    }
                  });
                }
              });

          }
        });
      } else {
        $('select[name="id_prodi"]'+i).empty();
      }
      });


      $(document).on('change', '#id_prodi'+i, function() {
      var jurusan = jQuery(this).val();
      var mapel_id = document.getElementById("mapel_id"+i).value;
      if (jurusan) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + jurusan,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_semester'+i).empty();
            jQuery.each(data, function(key, value) {
              $('#id_semester'+i).append('<option value="' + value + '">' + key + '</option>');
            });

            var semester = document.getElementById("id_semester"+i).value;
                    jQuery.ajax({
                    url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + jurusan+ "/semester/" + semester,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                      jQuery('#id_tahun_ajaran'+i).empty();
                      jQuery.each(data, function(key, value) {
                        $('#id_tahun_ajaran'+i).append('<option value="' + value + '">' + key + '</option>');
                      });
                    }
                  });

          }
        });
      } else {
        $('select[name="id_semester"]'+i).empty();
      }
    });

    $(document).on('change', '#id_semester'+i, function() {
      var semester = jQuery(this).val();
      var mapel_id = document.getElementById("mapel_id"+i).value;
      var id_prodi = document.getElementById("id_prodi"+i).value;
      if (semester) {
        jQuery.ajax({
          url: "{{ route( 'guru.materipelajaran.mapel', '')}}" + "/" + mapel_id+ "/prodi/" + id_prodi+ "/semester/" + semester,
          type: "GET",
          dataType: "json",
          success: function(data) {
            jQuery('#id_tahun_ajaran'+i).empty();
            jQuery.each(data, function(key, value) {
              $('#id_tahun_ajaran'+i).append('<option value="' + value + '">' + key + '</option>');
            });
          }
        });
      } else {
        $('select[name="id_tahun_ajaran"]'+i).empty();
      }
    });


    }

  </script>
@endsection
