@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Kalender Akademik</li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-calendar"></span> Kalender Akademik</h2>
        </div>
        <div class="pull-right">
            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <div class="panel-body">
      <div class="row">
        <div class="col-md-6 push-up-20">
          <div id="alert_holder"></div>
          <div class="calendar">
              <div id="calendar"></div>
          </div>
        </div>

        <div class="col-md-6">
          <p class="panel-title push-up-20 push-down-20">Keterangan :</p>
          <!-- DEFAULT LIST GROUP -->
          <div class="panel panel-default">
              <div class="panel-heading ui-draggable-handle">
                <div class="panel-title">
                    <h4>Selasa, 17 Maret 2020</h4>
                </div>
              </div>
              <div class="panel-body">
                  <ul class="list-group border-bottom">
                      <li class="list-group-item">Penerimaan Peserta Didik Baru Tahun Pelajaran 2019/2020.</li>
                  </ul>
              </div>
            </div>

          <div class="panel panel-default">
              <div class="panel-heading ui-draggable-handle">
                <div class="panel-title-box">
                    <h3>Kegiatan Akademik</h3>
                    <span>Bulan Maret 2020</span>
                </div>
              </div>
              <div class="panel-body">
                  <ul class="list-group border-bottom">
                      <li class="list-group-item">
                        <div class="panel-title-box">
                            <h6> <strong>Tanggal 2-17 Juli 2020</strong></h6>
                            <span>Penerimaan Peserta Didik Baru Tahun Pelajaran 2019/2020</span>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="panel-title-box">
                            <h6> <strong>Tanggal 17 – 20 Oktober 2019</strong></h6>
                            <span>Awal masuk sekolah dan masa pengenalan lingkungan sekolah</span>
                        </div>
                      </li>
                  </ul>
              </div>
            </div>
          <!-- END DEFAULT LIST GROUP -->
        </div>
      </div>
    </div>

</div>
<!-- END CONTENT FRAME -->


@stop
