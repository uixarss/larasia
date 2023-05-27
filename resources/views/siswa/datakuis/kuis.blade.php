<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META SECTION -->
  <title>Joli Admin - Responsive Bootstrap Admin Template</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />
  <!-- END META SECTION -->

  <!-- CSS INCLUDE -->
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-blue.css')}}" />
  <!-- EOF CSS INCLUDE -->
</head>

<body>
  <!-- START PAGE CONTAINER -->
  <div class="page-container page-navigation-top">
    <!-- PAGE CONTENT -->
    <div class="page-content">

      <!-- START X-NAVIGATION VERTICAL -->
      <ul class="x-navigation x-navigation-horizontal">

        <li class="xn-icon-button pull-right">
          <p><span class="glyphicon glyphicon-time push-up-20"></span>
            <time id="countdown">{{$kuis->durasi}}</time> Detik
            @if($kuis->durasi==0)
            return view('siswa.datakuis.nilaikuis');
            @endif
          </p>
        </li>

        <script type="text/javascript">
          var seconds = {
            {
              $kuis - > durasi
            }
          }* 60;

          function secondPassed() {
            var minutes = Math.round((seconds - 30) / 60),
              remainingSeconds = seconds % 60;

            if (remainingSeconds < 10) {
              remainingSeconds = "0" + remainingSeconds;
            }

            document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
            if (seconds == 0) {
              clearInterval(countdownTimer);
              // document.form.submit();
            } else {
              seconds--;
            }
          }
          var countdownTimer = setInterval('secondPassed()', 1000);
        </script>

        <!-- <div class="panel-heading push-up-10">
                    <div class="panel-title">
                      <a href="{{ route('siswa.datakuis.index') }}"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                  </div> -->

      </ul>
      <!-- END X-NAVIGATION VERTICAL -->

      <!-- PAGE CONTENT WRAPPER -->
      <div class="page-content-wrap">

        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-body list-group push-up-10">
              <div class="list-group-item">
                <div class="row">

                  <div class="col-md-6">
                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Jenis Soal</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-5">
                        <h5>Kuis</h5>
                      </div>
                    </div>

                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Kode Soal</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-5">
                        <h5>{{$kuis->kode_soal}}</h5>
                      </div>
                    </div>

                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Nama Soal</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-8">
                        <h5>{{$kuis->judul_kuis}}</h5>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Mata Pelajaran</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-5">
                        <h5>Matematika</h5>
                      </div>
                    </div>

                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Kelas</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-5">
                        <h5>10 MIA</h5>
                      </div>
                    </div>

                    <div class="row push-down-10">
                      <div class="col-xs-3">
                        <h5>Jumlah Soal</h5>
                      </div>
                      <div class="col-xs-1">
                        :
                      </div>
                      <div class="col-xs-5">
                        <h5>{{$kuis->jumlah_soal}}</h5>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="panel-heading">
            <ul class="pagination pagination-sm pull-left">
              <!-- pengulangan No soal 1 - x -->
              @foreach($data_question as $question)
              <li class="">
                {{ $data_question->onEachSide(10)->links() }}
              </li>
              @endforeach
            </ul>
          </div>
          <form class="" action="" method="">
            <div class="panel-body tab-panel">
              @foreach($data_question as $question)
              <div class="col-md-7">
                <div class="col-md-12 col-xs-12">
                  <div class="panel-body">
                    <!-- pertanyaan 1 - x -->
                    <h3>Soal No {{$question->id}}</h3>
                    <h4>{{$question->pertanyaan}}</h4>

                    <div class="gallery" id="links">
                      <!-- <a class="gallery-item" href="{{asset('admin/assets/images/nature.jpg')}}" title="Nature Image 1" data-gallery="">
                                    <div class="image">
                                        <img src="{{asset('admin/assets/images/nature.jpg')}}" alt="nature">
                                    </div>
                                    <div class="meta">
                                        <strong>Gambar Soal No 1</strong>
                                    </div>
                                </a> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="col-md-12  push-down-10">
                      <h4>Jawaban No {{$question->id}}</h4> <br>
                      @foreach($question->options as $option)
                      <div class="col-md-1  push-down-10">
                        <div class="iradio_minimal-grey">
                          <input type="radio" class="iradio" name="jawaban" value="{{$option->pilihan_jawaban}}">
                        </div>
                      </div>
                      <!-- <div class="col-md-1  push-down-10">
                                A.
                              </div> -->
                      <div class="col-md-11  push-down-10">
                        <p>{{$option->pilihan_jawaban}}</p>
                      </div>
                      @endforeach

                      <button class="btn btn-info pull-right">Yakin</button>
                      <button class="btn pull-right" disabled>||</button>
                      <button class="btn btn-warning pull-right">Ragu Ragu</button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
          </form>

          <div class="panel-footer">
            <a href="" class="btn btn-success pull-right mb-control" data-box="#mb-selesai">Selesai</a>
            <!-- <a href="" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a> -->
            <!-- <button class="btn btn-primary" disabled>Sebelumnya</button>
                        <button class="btn" disabled>||</button>
                        <button class="btn btn-primary">Selanjutnya</button> -->
          </div>

          <!-- MESSAGE BOX-->
          <div class="message-box animated fadeIn" data-sound="alert" id="mb-selesai">
            <div class="mb-container">
              <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span> Apakah anda <strong>Sudah Selesai</strong> ?</div>
                <div class="mb-content">
                  <p>Anda Yakin ingin keluar dari kuis ini?</p> <strong> Siswa waktu : 25:00:01 detik</strong>
                  <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                </div>
                <div class="mb-footer">
                  <div class="pull-right">
                    <a href="{{url('/siswa/datakuis/nilaikuis')}}" class="btn btn-success btn-lg">Iya</a>
                    <button class="btn btn-default btn-lg mb-control-close">Tidak</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END MESSAGE BOX-->

        </div>

      </div>
      <!-- PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
  </div>
  <!-- END PAGE CONTAINER -->


  <!-- START SCRIPTS -->
  <!-- START PLUGINS -->
  <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
  <!-- END PLUGINS -->

  <!-- START THIS PAGE PLUGINS-->
  <script type='text/javascript' src="{{asset('admin/js/plugins/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>

  <!-- <script type="text/javascript" src="{{asset('admin/js/plugins/morris/raphael-min.js')}}"></script> -->
  <!-- <script type="text/javascript" src="{{asset('admin/js/plugins/morris/morris.min.js')}}"></script> -->
  <script type="text/javascript" src="{{asset('admin/js/plugins/rickshaw/d3.v3.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/rickshaw/rickshaw.min.js')}}"></script>
  <script type='text/javascript' src="{{asset('admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script type='text/javascript' src="{{asset('admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script type='text/javascript' src="{{asset('admin/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/owl/owl.carousel.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/plugins/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/fullcalendar/fullcalendar.min.js')}}" defer></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/dropzone/dropzone.min.js')}}"></script>
  <!-- END THIS PAGE PLUGINS-->

  <!-- START TEMPLATE -->
  <script type="text/javascript" src="{{asset('admin/js/settings.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/plugins.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/actions.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/kuis/js/script.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/campur.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


  <!-- <script type="text/javascript" src="{{asset('admin/js/demo_halamanutama.js')}}"></script> -->
  <!-- END TEMPLATE -->
  <!-- END SCRIPTS -->
</body>

</html>