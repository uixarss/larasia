@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('admin.datapegawai.index') }}"> Pegawai</a></li>
      <li class="active">Upload Data Pegawai Non Akademik</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Upload Data Pegawai Non Akademik</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">


            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Upload Data Pegawai Non Akademik</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                  <h3><span class="fa fa-mail-forward"></span> Import File Data Pegawai Non Akademik <span class="text-info">Excel</span></h3>
                  <p >Untuk Import File Pegawai Non Akademik Silahkan <a href="#"> <code>Download</code></a> dulu contoh File Excelnya. </p>
                    <p class="push-down-20">setelah selesai isi data Pegawai Non Akademik, silahkan upload di bawah ini.</p>
                  <form enctype="multipart/form-data" class="form-horizontal">
                      <div class="form-group">
                          <div class="col-md-12">
                              <input type="file" multiple class="file" data-preview-file-type="any"/>
                          </div>
                      </div>
                  </form>
              </div>

              <div class="panel-footer">
                <a href="{{ route('admin.datapegawai.index') }}" type="button" class="btn btn-success pull-right">Selesai</a>
                <a href="#" type="button" class="btn btn-info">Download File Excel</a>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



      </div>
    </div>
  </div>

@stop
