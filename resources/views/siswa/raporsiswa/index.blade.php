@extends('layouts.joliadmin-top')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Rapor Siswa</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Rapor Siswa</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-deafult">
          <div class="panel-heading push-down-10">
            <div class="col-md-12">
              <label class="panel-title block">Pilih Tahun Ajaran, Semester dan Kelas</label>

              <form action="{{route('siswa.raporsiswa.carilapor')}}" method="post">
              {{csrf_field()}}


              <div class="form-group">
                <div class="col-md-3">
                  <select name="tahun_ajaran" class="form-control" data-live-search="true" required>
                    @foreach($data_tahun_ajaran as $ajaran)
                      <option value="{{$ajaran->nama_tahun_ajaran}}">{{$ajaran->nama_tahun_ajaran}}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="form-group">
                <div class="col-md-3">
                  <select name="semester" class="form-control " data-live-search="true" required>
                    @foreach($data_semester as $semester)
                      <option value="{{$semester->nama_semester}}">{{$semester->nama_semester}}</option>
                    @endforeach

                  </select>
                </div>
              </div>

              <button type="submit" class="col-md-2 col-xs-12 btn btn-primary"><i class="fa fa-search pull-left"></i>Cari</button>
            </form>
            </div>
          </div>
        </div>

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Kelas {{$data_nilai_rapor->kelas_siswa ?? '-'}}
                <span>
                      <h5>Tahun Ajaran {{$data_nilai_rapor->tahun_ajaran ?? '-'}} / Semester {{$data_nilai_rapor->semester ?? '-'}}</h5>
                  </span>
                </h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
            </div>

            <div class="panel-body table-responsive">
              <table class="table datatable">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>WaliKelas</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th width="100">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($nilai_rapor as $no => $rapor)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$rapor->tahun_ajaran}}</td>
                      <td>{{$rapor->semester}}</td>
                      <td>{{$rapor->wali_kelas}}</td>
                      <td>{{$rapor->nis}}</td>
                      <td>{{$rapor->nama_siswa}}</td>
                      <td>{{$rapor->kelas_siswa}}</td>
                      <td><a href="{{ route('siswa.raporsiswa.show', $rapor->id) }}" type="button" class="btn btn-success">Lihat Nilai Rapor</a></td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>

          </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

      </div>
    </div>
  </div>

@stop
