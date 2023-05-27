@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Reminder</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span>Tambah Reminder</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START CONTENT FRAME -->
        <div class="content-frame">

          <!-- START CONTENT FRAME TOP -->
          <div class="content-frame-top">
              <div class="page-title">
                  <h2><span class="fa fa-calendar"></span> Calendar</h2>
              </div>
              <div class="pull-right">
                  <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
              </div>
          </div>
          <!-- END CONTENT FRAME TOP -->

          <div class="page-content-wrap">
            <div class="row">
              <div class="col-md-12">
                <div class="panel-heading">
                  Kalender Akademik
                </div>
                <div class="panel-body">
                  <div id='calendar'></div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
@stop
