@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Data Absensi</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Data Absensi</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Absensi Hari Ini Kelas 10 MIA 1<span> <h5 class="plugin-date"></h5> </span> </h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
              <table class="table datatable">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>NISN</th>
                          <th>Nama Siswa</th>
                          <th>No. Hp</th>
                          <th>Jam Datang</th>
                          <th>Jam Pulang</th>
                          <th>Absensi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>1</td>
                          <td>8769709775</td>
                          <td>Doni Supratman</td>
                          <td>0896542736</td>
                          <td>07:40 WIB</td>
                          <td>014:40 WIB</td>
                          <td><span class="label label-success label-form">Hadir</span></td>
                      </tr>
                      <tr>
                          <td>2</td>
                          <td>0809765</td>
                          <td>Alvy Fajri</td>
                          <td>0896542736</td>
                          <td></td>
                          <td></td>
                          <td><span class="label label-warning label-form">Ijin</span></td>
                      </tr>
                      <tr>
                          <td>3</td>
                          <td>9798656</td>
                          <td>Ade Saprudin</td>
                          <td>0896542736</td>
                          <td></td>
                          <td></td>
                          <td><span class="label label-danger label-form">Alfa</span></td>
                      </tr>
                      <tr>
                          <td>4</td>
                          <td>9709679</td>
                          <td>Perdi Supriadi</td>
                          <td>0896542736</td>
                          <td></td>
                          <td></td>
                          <td><span class="label label-info label-form">Sakit</span></td>
                      </tr>
                      <tr>
                          <td>5</td>
                          <td>9507896</td>
                          <td>Agung Firmansyahs</td>
                          <td>0896542736</td>
                          <td>08:00 WIB</td>
                          <td>14:00 WIB</td>
                          <td><span class="label label-success label-form">Hadir</span></td>
                      </tr>

                  </tbody>
              </table>
            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

      </div>
    </div>
  </div>

@stop
