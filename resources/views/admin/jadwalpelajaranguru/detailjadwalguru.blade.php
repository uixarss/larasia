@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('admin.jadwalpelajaranguru.index') }}">Jadwal Guru</a></li>
      <li class="active">Detail Jadwal Guru</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Detail Jadwal Guru</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Jadwal Pelajaran</h3>
            <ul class="panel-controls">
              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            </ul>
          </div>

          <div class="panel-heading">
            <div class="panel-title">

              <!-- <h3 class="text-info push-left-20">Matematika</h3> -->
                <div class="col-md-12 push-down-0">
                    <div class="col-md-2 col-xs-2">
                        <a href="#" class="friend">
                            <img src="{{asset('admin/assets/images/users/user7.jpg')}}">
                        </a>
                    </div>
                    <div class="col-md-10 col-xs-10 push-up-10">
                        <h5>Herman Suherman S.Pd</h5>
                    </div>
                </div>
            </div>
          </div>

          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Waktu</th>
                  <th>Senin</th>
                  <th>Selasa</th>
                  <th>Rabu</th>
                  <th>Kamis</th>
                  <th>Jumat</th>
                  <th>Sabtu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>07:00 - 07:45</td>
                  <td></td>
                  <td>10 MIA 1</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>07:45 - 08:30</td>
                  <td>10 MIA 3</td>
                  <td>10 MIA 1</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>08:30 - 09:15</td>
                  <td>10 MIA 3</td>
                  <td>10 MIA 1</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>09:45 - 10:30</td>
                  <td>10 MIA 3</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>10:30 - 11:45</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>12:30 - 13:15</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>13:15 - 14:45</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
          </div>

          <div class="panel-footer">
              <a href="{{ route('admin.jadwalpelajaranguru.index') }}" class="btn btn-primary pull-right">Simpan</a>
          </div>

        </div>
        <!-- END DEFAULT DATATABLE -->

      </div>
    </div>
  </div>

@stop
