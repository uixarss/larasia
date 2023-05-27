@extends('layouts.joliadmin')

@section('content')

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li class="active">Dashboard</li>
    </ul>
    <!-- END BREADCRUMB -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <!-- START Kontent -->
        <div class="row">

          <div class="col-md-12">

            <div class="col-md-9">

              <div class="col-md-4">
                <div class="widget widget-info widget-item-icon" onclick="location.href='{{ route('admin.datasiswa.index') }}';">
                  <div class="widget-item-left">
                      <span class="fa fa-user"></span>
                  </div>
                  <div class="widget-data">
                    <div class="widget-title">Siswa</div>
                    <div class="widget-subtitle">Jumlah Semua Siswa</div>
                      <div class="widget-int num-count">320</div>
                  </div>
                  <div class="widget-controls">
                      <a href="#" class="widget-control-right"><span class="fa fa-refresh"></span></a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="widget widget-info widget-item-icon" onclick="location.href='{{ route('admin.datapegawai.index') }}';">
                  <div class="widget-item-left">
                      <span class="glyphicon glyphicon-user"></span>
                  </div>
                  <div class="widget-data">
                    <div class="widget-title">Pegawai</div>
                    <div class="widget-subtitle">Jumlah Pegawai Dieskolah</div>
                      <div class="widget-int num-count">35</div>
                  </div>
                  <div class="widget-controls">
                      <a href="#" class="widget-control-right"><span class="fa fa-refresh"></span></a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="widget widget-info widget-item-icon" onclick="location.href='{{ route('admin.dataorangtua.index') }}';">
                    <div class="widget-item-left">
                        <span class="fa fa-users"></span>
                    </div>
                    <div class="widget-data">
                      <div class="widget-title">Orang Tua</div>
                      <div class="widget-subtitle">Jumlah Orang Tua Siswa</div>
                        <div class="widget-int num-count">315</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-refresh"></span></a>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-event"></span>STATISTIK KEAKTIFAN KELAS</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <form action="#" role="form" class="form-horizontal">
                            <div class="form-group">

                              <!-- KEAKTIFAN KELAS -->

                              <div class="col-md-12">
                                  <!-- START USERS ACTIVITY BLOCK -->
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="panel-title-box">
                                              <h3>Kelas 10</h3>
                                              <span>Kelas 10 MIA - 10 IPS</span>
                                          </div>
                                          <ul class="panel-controls" style="margin-top: 2px;">
                                              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                              <li class="dropdown">
                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                                  <ul class="dropdown-menu">
                                                      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                                  </ul>
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="panel-body padding-0">
                                          <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
                                      </div>
                                  </div>
                                  <!-- END USERS ACTIVITY BLOCK -->
                              </div>

                              <div class="col-md-6">
                                  <!-- START USERS ACTIVITY BLOCK -->
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="panel-title-box">
                                              <h3>Kelas 11</h3>
                                              <span>Kelas 11 MIA - 11 IPS</span>
                                          </div>
                                          <ul class="panel-controls" style="margin-top: 2px;">
                                              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                              <li class="dropdown">
                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                                  <ul class="dropdown-menu">
                                                      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                                  </ul>
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="panel-body padding-0">
                                          <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
                                      </div>
                                  </div>
                                  <!-- END USERS ACTIVITY BLOCK -->
                              </div>

                              <div class="col-md-6">
                                  <!-- START USERS ACTIVITY BLOCK -->
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="panel-title-box">
                                              <h3>Kelas 12</h3>
                                              <span>Kelas 12 MIA - 12 IPS</span>
                                          </div>
                                          <ul class="panel-controls" style="margin-top: 2px;">
                                              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                              <li class="dropdown">
                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                                  <ul class="dropdown-menu">
                                                      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                                  </ul>
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="panel-body padding-0">
                                          <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
                                      </div>
                                  </div>
                                  <!-- END USERS ACTIVITY BLOCK -->
                              </div>

                              <!--END KEAKTIFAN KELAS -->

                            </div>

                        </form>
                    </div>
                </div>

              </div>

            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-event"></span> REMINDER</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li>
                              <li><a class="" data-toggle="modal" data-target="#modal_basic"><span class="fa fa-plus-circle"></span></a></li>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <form action="#" role="form" class="form-horizontal">
                            <div class="form-group">
                              <div class="col-md-12">
                                  <a href="#" class="tile tile-info">
                                    <div class="informer informer-default date"> <span class="fa fa-clock-o"></span> 07:10</div>
                                      15
                                      <p>September</p> <br>
                                      <div class="informer informer-default dir-bl">Rapat Guru</div>
                                      <div class="informer informer-default dir-br"><span class="fa fa-bell-o"></span></div>
                                      <div class="informer informer-default dir-tr"><span class="fa fa-times"></span></div>
                                  </a>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-12">
                                  <a href="#" class="tile tile-info">
                                  <div class="informer informer-default date"> <span class="fa fa-clock-o"></span> 11:10</div>
                                      31
                                      <p>September</p><br>
                                      <div class="informer informer-default dir-bl">Rapat Orang Tua</div>
                                      <div class="informer informer-default dir-br"><span class="fa fa-bell-o"></span></div>
                                      <div class="informer informer-default dir-tr"><span class="fa fa-times"></span></div>
                                  </a>
                              </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

          </div>

        </div>
        <!-- END Kontent -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->


@endsection
