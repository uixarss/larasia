@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('admin.kumpulansoal.index') }}">List Dosen</a></li>
      <li><a href="{{route('admin.kumpulansoal.listSoal', [ 'id' => $pengampu->id] )}}">Kumpulan Soal</a></li>
      <li class="active">Detail Soal</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Detail Soal</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">


        <div class="panel panel-primary">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <table class="dataSoal">
                  <tr height="30">
                    <td width="100"> Kode Quiz</td>
                    <td width="20">:</td>
                    <td> {{$data_quiz->kode_soal}}</td>
                  </tr>

                  <tr height="30" valign="top">
                    <td >Judul Kuis</td>
                    <td>:</td>
                    <td>{{$data_quiz->judul_kuis}}</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <table class="dataSoal">
                  <tr height="30">
                    <td width="100"> Durasi</td>
                    <td width="20">:</td>
                    <td> {{$data_quiz->durasi}}</td>
                  </tr>

                  <tr height="30">
                    <td>Jumlah Soal</td>
                    <td>:</td>
                    <td>{{$data_quiz->jumlah_soal}}</td>
                  </tr>

                  <tr height="30">
                    <td>Tanggal Mulai</td>
                    <td>:</td>
                    <td> {{$data_quiz->tanggal_mulai}}</td>
                  </tr>

                  <tr height="30">
                    <td>Tanggal Akhir</td>
                    <td>:</td>
                    <td>{{$data_quiz->tanggal_akhir}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-warning">
        <div class="panel-heading ui-draggable-handle">
          <div class="panel-title-box">
              <!-- <h2>Tambah Soal</h2> -->
          </div>
            <ul class="panel-controls">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
            </ul>
        </div>

        <div class="panel-heading">
          <input type="hidden" name="" id="timer" value="">
          <span>Nomor Soal</span>
          @if($data_question->count())
            <nav aria-label="Page navigation">
              <ul class="pagination" style="margin-top: 5px !important;">
                @foreach($data_question as $key_number => $data_number)
                  <li class="no_soals"
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
                      option-jawaban = '{{$data_option->pilihan_jawaban}}'>
                        <tr>
                          <td width='40' valign='top'>
                            @if($data_option->is_correct == 0)
                            <span class='badge badge-warning'> <span class='fa fa-times'> </span></span>
                            @else
                            <span class='badge badge-success'> <span class='fa fa-check'> </span></span>
                            @endif
                          </td>
                          <td width='10' valign='top'><span>
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
                          option-jawaban = "{{$data_option->pilihan_jawaban}}">
                            <tr>
                              <td width="40" valign="top">
                                @if($data_option->is_correct == 0)
                                <span class="badge badge-warning"> <span class="fa fa-times"> </span></span>
                                @else
                                <span class="badge badge-success"> <span class="fa fa-check"> </span></span>
                                @endif
                              </td>
                              <td width="10" valign="top"><span>
                                @if(++$key_option==1) A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @elseif($key_option==2) B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @elseif($key_option==3) C.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @elseif($key_option==4) D.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @elseif($key_option==5) E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                              </span></td>
                              <td valign="top">{!!$data_option->pilihan_jawaban!!}</td>
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

      </div>

        <div class="panel-footer">
          <form action="{{route('admin.kumpulansoal.destroy', $data_quiz->id)}}" method="post">
          {{ csrf_field() }}
          @method('delete')
            <a href="{{route('admin.kumpulansoal.edit', $data_quiz->id)}}" type="button" class="btn btn-success pull-right">Edit Soal</a>
            <button class="btn pull-right" disabled></button>
            <!-- <button href="#" type="submit" class="btn btn-danger pull-right">Hapus</button> -->
          </form>
        </div>

        </div>

      </div>
    </div>
  </div>


@stop

@section('data-scripts')
<script type="text/javascript" src="{{asset('admin/kuis/js/script.js')}}"></script>
@stop
