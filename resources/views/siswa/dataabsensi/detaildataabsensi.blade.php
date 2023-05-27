@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{ route('siswa.dataabsensi.index') }}">Data Absensi Siswa</a></li>
    <li class="active">Absensi Perbulan</li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h3><span class="fa fa-table"></span> Data Absensi</h3>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <div class="panel-body">
      <div class="row">
        <div class="col-md-12 push-up-10">
          <div class="panel-heading">
            <div class="panel-title">
              <h3>Data Absensi Perbulan</h3>
            </div>
          </div>

          <div class="panel panel-deafult">
            <div class="panel-body">
              <table class="table datatable">
              <thead>
                  <tr>
                      <th width="100">No</th>
                      <th>Bulan</th>
                      <th width="100">Hadir</th>
                      <th width="100">Izin</th>
                      <th width="100">Sakit</th>
                      <th width="100">Alpa</th>
                      <th width="100">Jumlah</th>
                      <th width="100">Total</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>1</td>
                      <td>Maret 2020</td>
                      <td>18</td>
                      <td>0</td>
                      <td>2</td>
                      <td>0</td>
                      <td>20</td>
                      <td>23</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>April 2020</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>25</td>
                  </tr>

              </tbody>
          </table>
            </div>
          </div>

        </div>
      </div>
    </div>

</div>
<!-- END CONTENT FRAME -->

@stop
