@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Kenaikan Kelas</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Kenaikan Kelas</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">

      <div class="col-md-6">
        <div class="row">
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Naik Ke Kelas</h3>
                  <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  </ul>
              </div>

              <div class="col-md-12">
                <div class="form-group push-up-10">
                    <h5>Masukan Kelas Disini:</h5>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="fa fa-search"></span></div>
                        <input type="text" class="form-control" placeholder="Contoh 10 MIA 1 "/>
                        <div class="input-group-btn">
                          <button class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </div>
              </div>

              <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th>NISN</th>
                          <th>Nama Siswa</th>
                          <th>Nilai Akhir</th>
                          <th>Grade</th>
                          <th>Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

        </div>
      </div>

      <div class="col-md-6">
        <div class="row">
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tinggal Di Kelas</h3>
                  <ul class="panel-controls">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  </ul>
              </div>

              <div class="col-md-7">
                <div class="form-group push-up-10">
                    <h5>Kelas yang dimaksukan pada table kiri</h5>
                </div>
              </div>

              <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th>NISN</th>
                          <th>Nama Siswa</th>
                          <th>Nilai Akhir</th>
                          <th>Grade</th>
                          <th>Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
          </div>
          <!-- END DEFAULT DATATABLE -->

        </div>
      </div>

    </div>
  </div>

@stop
