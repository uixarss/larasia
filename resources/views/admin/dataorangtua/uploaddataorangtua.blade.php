@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.dashboard.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('admin.dataorangtua.index') }}"> Data Orang Tua</a></li>
      <li class="active">Upload Data Orang Tua</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Upload Data Orang Tua</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">


            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Upload Data Orang Tua</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                  <h3><span class="fa fa-mail-forward"></span> Import File Data Orang Tua <span class="text-info">Excel</span></h3>
                  <p >Untuk Import File Orang Tua Silahkan <a href="#"> <code>Download</code></a> dulu contoh File Excelnya. </p>
                    <p class="push-down-20">setelah selesai isi data Orang Tua, silahkan upload di bawah ini.</p>
                  <form enctype="multipart/form-data" class="form-horizontal">
                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="file" multiple class="file" data-preview-file-type="any"/>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="panel-footer">
                <a href="/siswa" type="button" class="btn btn-success pull-right">Selesai</a>
                <a href="#" type="button" class="btn btn-info">Download File Excel</a>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



      </div>
    </div>
  </div>

@stop
