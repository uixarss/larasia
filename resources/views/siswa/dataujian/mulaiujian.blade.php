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
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-blue.css')}}"/>
        <!-- EOF CSS INCLUDE -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                  <div class="panel-heading push-up-10">
                    <div class="panel-title">
                      <a href="{{ route('siswa.dataujian.index') }}"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                  </div>
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- DATA OPENING KUIS -->
                    <div id="introKuis" class="row" style="display: block; overflow-y: scroll !important;">
                      <div class="container">
                        <div class="row push-up-20">
                          <!-- Data Opening -->
                          <div class="col-md-8">
                            <div class="panel panel-success">
                              <div class="panel-body">
                                <h4 class="text-center push-up-10">Jenis Ujian</h4>
                                <h3  class="text-center">{{$data_quiz->jenis_ujians->nama_jenis_ujian}}</h3>
                                <h4 class="text-center push-up-35">Kode Soal</h4>
                                <h3  class="text-center">{{$data_quiz->kode_soal}}</h3>
                                <h4 class="text-center push-up-35">Judul Kuis</h4>
                                <h3  class="text-center">{{$data_quiz->judul_kuis}}</h3>
                                <h4  class="text-center push-up-35">Jumlah Soal</h4>
                                <h3  class="text-center">{{$data_quiz->jumlah_soal}}</h3>
                                <h4 class="text-center push-up-25">Waktu Soal</h4>
                                <h3  class="text-center">{{$data_quiz->durasi}} Menit</h3> <br><br>
                              </div>

                            </div>
                          </div>
                          <!-- Data Peraturan Kuis -->
                          <div class="col-md-4">
                            <div class="panel panel-danger">
                              <div class="panel-body">
                                <h4>Peringatan :</h4>
                                <p style="font-weight: bold;">Silahkan kerjakan soal yang telah di siapkan. Harap dipatuhi peraturan berikut!</p>
                                <ul>
                                  <li class="push-down-10">Jangan mereload/refresh browser (jawaban akan hilang)</li>
                                  <li class="push-down-10">Jangan menekan tombol selesai saat mengerjakan soal, kecuali saat anda telah selesai mengerjakan seluruh soal</li>
                                  <li class="push-down-10">Perhatikan sisa waktu ujian, sistem akan mengumpulkan jawaban saat waktu sudah selesai</li>
                                  <li class="push-down-10">Waktu ujian akan dimulai saat tombol "<b>Mulai Mengerjakan Soal Kuis!</b>" di klik</li>
                                  <li class="push-down-10">Dilarang bekerjasama dengan teman</li>
                                  <li class="push-down-25">Jangan keluar dari mode fullscreen, setiap upaya keluar dari mode tersebut akan dihitung</li>
                                </ul>

                              </div>

                            </div>
                          </div>
                          @if($result_quiz == null)
                          <button type="submit" id="start-exam" onclick="$('#soalKuis').fullScreen(true)" class="btn-lg btn-success btn-block push-up-20"> Mulai Mengerjakan Soal</button>
                          @else
                          <button type="submit" id="start-exam" onclick="$('#soalKuis').fullScreen(true)" class="btn-lg btn-danger btn-block push-up-20" disabled> Soal Sudah Dikerjakan</button>
                          @endif
                        </div>
                      </div>
                    </div>

                    <!-- DATA SOAL KUIS -->
                    <div id="soalKuis" class="row" style="display: none; background-color: white; overflow-y: scroll !important;">
                      <div class="panel panel-default">
                        <!-- Timer -->
                        <p class="text-center"><span class="glyphicon glyphicon-time push-up-15"></span>
                          Sisa Waktu = <time id="countdown"></time>
                          <input type="hidden" name="" id="timer" value="{{$data_quiz->durasi * 60}}">
                        </p>

                        <!--List No Soal -->
                        <div class="panel-heading">
                        	<span>Nomor Soal</span>
                        	@if($data_question->count())
                        		<nav aria-label="Page navigation">
                              <ul class="pagination" style="margin-top: 5px !important;">
                                @foreach($data_question as $key_number => $data_number)
                                  <li class="no_soal"
                                		id="{{ 'nav'.$data_number->id }}"
                                		data-id="{{ $data_number->id }}"
                                		data-no="{{ $key_number+1 }}"
                                    data-soal="{{ $data_number->pertanyaan }}"
                                    data-pilihan="@foreach($data_number->options as $key_option => $data_option)
                                      <table width='100%'
                                      class='jawab'
                                      id='{{ 'dijawab'.$data_option->id }}'
                                      quiz-id = '{{$data_number->quiz_id}}'
                                      question-id = '{{$data_number->id}}'
                                      option-id = '{{$data_option->id}}'
                                      option-jawaban = '{{$data_option->pilihan_jawaban}}'
                                      option-correct = '{{$data_option->is_correct}}'>
                                        <tr>
                                          <td width='15p' valign='top'><span>
                                            @if(++$key_option==1) A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @elseif($key_option==2) B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @elseif($key_option==3) C.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @elseif($key_option==4) D.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @elseif($key_option==5) E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                          </span></td>
                                          <td valign='top'> {{$data_option->pilihan_jawaban}} </p> </td>
                                        </tr><br>
                                      </table>
                                    @endforeach">
                                    <a href="#">{{ $key_number+1 }}</a>
                                  </li>
                                @endforeach
                              </ul>
                        		</nav>
                        	@endif
                        </div>

                        <!-- List Pertanyaan dan Pilihan Jawaban -->
                        <div class="panel-body tab-panel">
                          <!-- List Pertanyaan -->
                          <div class="col-md-7">
                            <div class="col-md-12 col-xs-12">
                              <div class="panel-body">
                                <h4 class="push-down-10">Soal No :
                              	@if($data_question->count())
                    							@foreach($data_question as $key_number=>$data_number)
                    								@if($key_number == 0)
                                      <span id="no_soal_detail">1</span>
                                    @endif
                    							@endforeach
                    						@endif
                                </h4>

                                @if($data_question->count())
                        					@foreach($data_question as $key=>$data)
                        						@if($key == 0)
                                      <div id="soal_detail" class="soal">{!! $data->pertanyaan !!}</div>
                                    @endif
                                  @endforeach
                                @endif

                              </div>
                            </div>
                          </div>
                          <!-- List Pilihan Jawaban -->
                          <div class="col-md-5">
                            <div class="panel-body">
                              <div class="form-group">
                                <div class="col-md-12  push-down-10">
                                  <h4 class="push-down-10">Jawaban disini :</h4>

                                  @if($data_question->count())
                                    @foreach($data_question as $key_number=>$data_number)
                                      @if($key_number == 0)
                                        <div id="pilihan_detail">
                                          @foreach($data_number->options as $key_option=>$data_option)
                                          <table width="100%" class="jawab"
                                          id="{{ 'dijawab'.$data_option->id }}"
                                          quiz-id = "{{$data_number->quiz_id}}"
                                          question-id = "{{$data_number->id}}"
                                          option-id = "{{$data_option->id}}"
                                          option-jawaban = "{{$data_option->pilihan_jawaban}}"
                                          option-correct = "{{$data_option->is_correct}}">
                                            <tr>
                                              <td width="15p" valign="top"><span>
                                                @if(++$key_option==1) A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @elseif($key_option==2) B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @elseif($key_option==3) C.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @elseif($key_option==4) D.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @elseif($key_option==5) E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                              </span></td>
                                              <td valign="top">{!! $data_option->pilihan_jawaban !!}</td>
                                            </tr><br>
                                          </table>
                                          @endforeach
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Button Selesai -->
                        <div class="panel-footer">
                          <a id="count" href="" class="btn btn-success pull-right mb-control" data-box="#mb-selesai">Selesai</a>
                        </div>

                        <!-- MESSAGE BOX Button Selesai-->
                        <div class="message-box animated fadeIn" data-sound="alert" id="mb-selesai">
                          <div class="mb-container">
                            <div class="mb-middle">
                              <div class="mb-title"><span class="fa fa-sign-out"></span> Apakah anda <strong>Sudah Selesai</strong> ?</div>
                              <div class="mb-content">
                                <p>Anda Yakin ingin keluar dari kuis ini?</p> <strong> Sisa waktu : <time id="info-waktu"></time> </strong>
                                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                              </div>
                              <div class="mb-footer">
                                <button class="btn btn-default btn-lg mb-control-close pull-right">Tidak</button>
                                <div class="jarak pull-right" style="color:#000">jrk</div>
                                <div id="quizCount" class="pull-right">
                                    <button
                                    siswa-id="{{$data_siswa->id}}"
                                    quiz-id="{{$data_quiz->id}}"
                                    quiz-count="{{$data_answer->count()}}"
                                    question-count="{{$data_question->count()}}"

                                    id="end-exam" onclick="$('#soalKuis').fullScreen(false)" class="btn btn-success btn-lg"> Iya</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END MESSAGE BOX-->
                      </div>
                    </div>

                    <!-- DATA NILAI KUIS -->
                    <div id="nilaiSiswa" class="row" style="display: none; overflow-y: scroll !important;">
                      <div class="container">
                        <div class="row push-up-20" id="resultQuiz">
                          <!-- List Nilai Soal Kuis-->
                          <div class="col-md-6">
                            <div class="panel panel-success">
                              <div class="panel-body">
                                <h4 class="text-center push-up-10">Jumlah</h4>
                                <h3  class="text-center">{{$data_quiz->kode_soal}}</h3>
                                <h4 class="text-center push-up-35">Judul Kuis</h4>
                                <h3  class="text-center">{{$data_quiz->judul_kuis}}</h3>
                                <h4  class="text-center push-up-35">Jumlah Soal</h4>
                                <h3  class="text-center">{{$data_quiz->jumlah_soal}}</h3>
                                <h4 class="text-center push-up-25">Waktu Soal</h4>
                                <h3  class="text-center">{{$data_quiz->durasi}} Menit</h3> <br><br>
                              </div>
                            </div>
                          </div>
                          <!-- List Pengumuman Soal Kuis -->
                          <div class="col-md-6">
                            <div class="panel panel-info">
                              <div class="panel-body">
                                <h5 class="text-center text-info push-up-10">Selamat anda telah lulus dalam mengerjakan quiz ini</h5>
                                <br>
                                <h2 class="text-center push-up-10">Hasilnya Adalah</h2>
                                @if($result_quiz == null)
                                @else
                                <h1 class="text-center push-up-10"> <strong> {{$result_quiz->nilai_akhir}}</strong></h1>
                                @endif
                                <h4  class="text-center push-up-35">Jumlah Soal yang dikerjakan</h4>
                                <h3  class="text-center">{{$data_question->count()}}</h3>
                                <h4 class="text-center push-up-25">Sisa Waktu</h4>
                                <h3  class="text-center"><time id="waktu-akhir"></time></h3> <br><br>
                              </div>
                            </div>
                          </div>
                          <a href="{{ route('siswa.dataujian.index') }}"> <button class="btn-lg btn-success btn-block push-up-20"> Kembali</button></a>
                        </div>
                      </div>
                    </div>

                </div>
                <!-- PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <noscript>
      	  <style type="text/css">
      	    #soalKuis {display:none;}
            #nilaiSiswa {display: none;}
      	  </style>
      	  <div class="noscriptmsg">
      		  You don't have javascript enabled.  Good luck with that.
      	  </div>
      	</noscript>

        </script>

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

            <!-- <script type="text/javascript" src="{{asset('admin/js/demo_halamanutama.js')}}"></script> -->
            <script type="text/javascript" src="{{asset('admin/kuis/js/jquery.fullscreen-min.js')}}"></script>
            <script type="text/javascript" src="{{asset('admin/kuis/js/script.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!-- END TEMPLATE -->

        <!-- END SCRIPTS -->
    </body>
</html>
