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

          <div class="panel panel-warning">
            <div class="panel-heading ui-draggable-handle">
              <div class="panel-title-box">
                  <!-- <h2>Tambah Soal</h2> -->
              </div>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#EditSoalKuis"><span class="fa fa-pencil"></span></a></li>
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>

            <!--  MODAL UBAH SOAL KUIS-->
            <div class="modal fade" id="EditSoalKuis" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="staticBackdropLabel">Edit Soal Kuis</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{route('guru.banksoal.update', $data_quiz->id)}}">
                      {{csrf_field()}}
                      @method('put')
                      <div class="form-group">
                        <label for="kode_soal">Kode Kuis</label>
                        <input name="kode_soal" type="text" class="form-control" placeholder="Masukan Kode Kuis" value="{{$data_quiz->kode_soal}}">
                      </div>

                      <div class="form-group">
                        <label for="judul_kuis">Nama Kuis</label>
                        <input name="judul_kuis" type="text" class="form-control" placeholder="Masukan Nama Kuis" value="{{$data_quiz->judul_kuis}}">
                      </div>

                      <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input name="durasi" type="number" class="form-control" placeholder="Masukan Durasi Dalam Menit" value="{{$data_quiz->durasi}}">
                      </div>

                      <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input name="tanggal_mulai" type="text" class="form-control" value="{{$data_quiz->tanggal_mulai}}"/>
                      </div>

                      <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input name="tanggal_akhir" type="text" class="form-control" value="{{$data_quiz->tanggal_akhir}}"/>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- END MODAL UBAH SOAL KUIS -->

            <div class="panel-heading">
              <input type="hidden" name="" id="timer" value="">
              <span>Nomor Soal</span>
              @if($data_question->count())
                <nav aria-label="Page navigation">
                  <ul class="pagination" style="margin-top: 5px !important;">
                    @foreach($data_question as $key_number => $data_number)
                      <li class="no_soal_guru"
                        id="{{ 'nav'.$data_number->id }}"
                        data-id="{{ $data_number->id }}"
                        data-no="{{ $key_number+1 }}"
                        data-soal='

                        <div class="form-group">
                          <label for=""> <h5>Pertanyaan</h5></label>

                            <div id="{{ "summernote".$data_number->id }}" class="summernote">{!! $data_number->pertanyaan !!}</div>
                            <div class="push-up-10">
                              <button data-question="{{$data_number->id}}" type="submit" class="btn btn-info pull-right saveChange_Pertanyaan">Update Pertanyaan</button>
                              <button data-question="{{$data_number->id}}" type="submit" class="btn btn-danger pull-right delete_Pertanyaan">Delete Pertanyaan</button>
                              <input id="id" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                              <input id="addQuiz_id" type="hidden" name="id_quiz" value="{{$data_quiz->id}}">
                          </div>
                        </div>

                        '
                        data-pilihan='

                      <div class="form-group" id="#items">

                        <button type="submit" class="btn btn-success pull-right" id="showNewButton">Buat Pilihan Jawaban</button>
                        <button type="submit" class="btn btn-success pull-right" id="addButton" style="display:none">Simpan Jawaban</button>
                        <button type="submit" class="btn btn-danger pull-right" id="hideNewButton" style="display:none">Tidak Jadi Buat Pilihan Jawaban</button>

                        <label> <h5>Jawaban</h5></label>

                        <div id="newPilihanJawaban" style="display:none">
                          <div class="push-down-10">
                            <div class="summernote_pil"></div>
                          </div>

                          <div class="push-down-20">
                            <input id="addQuestion_id" type="hidden" name="question_id" value="@foreach($data_number->options as $key_option=>$data_option) {{$data_option->id}}  @endforeach">
                            <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                          </div>
                        </div>

                        @forelse($data_number->options as $key_option=>$data_option)

                        <div class="push-down-10">
                          <div id="{{ "summernote_pil".$data_option->id }}" class="summernote_pil">{!! $data_option->pilihan_jawaban !!}</div>
                        </div>

                        <div class="push-down-30">
                          @if($data_option->is_correct == 0)
                          <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-warning updateTrue" data-toggle="tooltip" data-placement="top" data-original-title="Klik untuk ubah jawaban ke-benar"><i class="fa fa-times"></i>Jawaban Salah</button>
                          @else
                          <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-success updateFalse" data-toggle="tooltip" data-placement="top" data-original-title="Klik untuk ubah jawaban ke-salah"><i class="fa fa-check"></i>Jawaban Benar</button>
                          @endif
                          <button option-id="{{$data_option->id}}" type="submit" class="btn btn-info pull-right saveChange">Update</button>
                          <button option-id="{{$data_option->id}}" type="submit" class="btn btn-danger pull-right delete">Delete</button><br>
                          <input id="addQuestion_id" type="hidden" name="question_id" value="{{$data_option->id}}">
                          <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                        </div>

                        @empty

                        <!-- <button type="submit" class="btn btn-success pull-right" id="addButton">Buat Pilihan Jawaban</button>

                        <div class="push-down-10">
                          <div class="summernote_pil"></div>
                        </div>

                        <div class="push-down-20">
                          <input id="addQuestion_id" type="hidden" name="question_id" value="@foreach($data_number->options as $key_option=>$data_option) {{$data_option->id}} @endforeach">
                          <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                          <input id="addJmlh_quiz" type="hidden" name="id_quiz" value="{{$data_question->count()}}">
                        </div> -->

                        @endforelse



                        '>
                        <a href="#">{{ $key_number+1 }}</a>
                      </li>
                    @endforeach
                    <li class="no_soal_baru" style="display:none">
                      <a id="noSoal" href="#"></a>
                    </li>
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

                    <span id="no_soal_details" style="display:none">{{$data_question->count()+1}}</span>
                    </h4>



                    <div id="new_soal_detail" class="soal" style="display:none">
                      <div class="form-group" id="#items_pertanyaan">
                        <label for=""> <h5>Pertanyaan</h5></label>
                        <button type="submit" class="btn btn-success pull-right" id="addButton_Pertanyaan">Simpan Pertanyaan</button>

                          <div class="summernote"></div>
                          <div class="push-up-15">
                            <button type="submit" class="btn btn-info pull-right" id="saveChange_Pertanyaan" >Update Pertanyaan</button>
                            <button type="submit" class="btn btn-danger pull-right" id="delete_Pertanyaan" >Delete Pertanyaan</button>
                            <input id="id" type="hidden" name="id_quiz" value="@if($data_question->count()) @foreach($data_question as $key=>$data) @if($key == 0){{$data->id}}  @endif @endforeach @endif">
                            <input id="addQuiz_id" type="hidden" name="id_quiz" value="{{$data_quiz->id}}">
                            <input id="addJmlh_quiz" type="hidden" name="id_quiz" value="{{$data_question->count()}}">
                          <!-- <input id="addPertanyaan" type="texts" name="id_quiz" value="@foreach($data_question as $key_number => $data_pertanyaan){!! $data_pertanyaan->id !!}@endforeach"> -->
                          </div>
                      </div>
                    </div>


                    <div id="soal_detail" class="soal">
                      <div class="form-group" id="#items_pertanyaan">
                        <label for=""> <h5>Pertanyaan</h5></label>


                        @forelse($data_question as $key=>$data)
                            @if($key == 0)
                            <div id="{{ 'summernote'.$data->id }}" class="summernote">{!! $data->pertanyaan !!}</div>
                            <div class="push-up-10">
                              <button data-question="{{$data->id}}" type="submit" class="btn btn-info pull-right saveChange_Pertanyaan" id="" >Update Pertanyaan</button>
                              <button type="submit" class="btn btn-danger pull-right" id="delete_Pertanyaan" >Delete Pertanyaan</button>
                              <input id="id" type="hidden" name="id_quiz" value="@if($data_question->count()) @foreach($data_question as $key=>$data) @if($key == 0){{$data->id}}  @endif @endforeach @endif">
                              <input id="addQuiz_id" type="hidden" name="id_quiz" value="{{$data_quiz->id}}">
                              <input id="addJmlh_quiz" type="hidden" name="id_quiz" value="{{$data_question->count()}}">
                            <!-- <input id="addPertanyaan" type="texts" name="id_quiz" value="@foreach($data_question as $key_number => $data_pertanyaan){!! $data_pertanyaan->id !!}@endforeach"> -->
                            </div>
                             @endif
                        @empty

                        <button type="submit" class="btn btn-success pull-right" id="addButtonAwal_Pertanyaan">Simpan Pertanyaan</button>

                          <div class="summernote" id="summernote"></div>
                          <div class="push-up-10">
                            <input id="id" type="hidden" name="id_quiz" value="@if($data_question->count()) @foreach($data_question as $key=>$data) @if($key == 0){{$data->id}}  @endif @endforeach @endif">
                            <input id="addQuiz_id" type="hidden" name="id_quiz" value="{{$data_quiz->id}}">
                            <input id="addJmlh_quiz" type="hidden" name="id_quiz" value="{{$data_question->count()}}">
                          <!-- <input id="addPertanyaan" type="texts" name="id_quiz" value="@foreach($data_question as $key_number => $data_pertanyaan){!! $data_pertanyaan->id !!}@endforeach"> -->
                          </div>

                          @endforelse
                      </div>
                    </div>


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
                            <div id="pilihan_detail" class="soal">
                              <div class="form-group" id="#items">
                                <button type="submit" class="btn btn-success pull-right" id="showNewButton">Buat Pilihan Jawaban</button>
                                <button type="submit" class="btn btn-success pull-right" id="addButton" style="display:none">Simpan Jawaban</button>
                                <button type="submit" class="btn btn-danger pull-right" id="hideNewButton" style="display:none">Tidak Jadi Buat Pilihan Jawaban</button>
                                <!-- <button type="submit" class="btn btn-info pull-right" id="saveChange" >Update</button>
                                <button type="submit" class="btn btn-danger pull-right" id="delete" >Delete</button> -->
                                <label> <h5>Jawaban</h5></label>

                                <div id="newPilihanJawaban" style="display:none">
                                  <div class="push-down-10">
                                    <div class="summernote_pil"></div>
                                  </div>

                                  <div class="push-down-20">
                                    <input id="addQuestion_id" type="hidden" name="question_id" value="@foreach($data_number->options as $key_option=>$data_option) {{$data_option->id}}  @endforeach">
                                    <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                                  </div>
                                </div>

                                @forelse($data_number->options as $key_option=>$data_option)

                                  <div class="push-down-10">
                                    <div id="{{ 'summernote_pil'.$data_option->id }}"  class="summernote_pil">{!! $data_option->pilihan_jawaban !!}</div>
                                  </div>

                                  <div class="push-down-30">
                                    @if($data_option->is_correct == 0)
                                    <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-warning updateTrue" data-toggle="tooltip" data-placement="top" data-original-title="Klik untuk ubah jawaban ke-benar"><i class="fa fa-times"></i>Jawaban Salah</button>
                                    @else
                                    <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-success updateFalse" data-toggle="tooltip" data-placement="top" data-original-title="Klik untuk ubah jawaban ke-salah"><i class="fa fa-check"></i>Jawaban Benar</button>
                                    @endif

                                    <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-info pull-right saveChange">Update</button>
                                    <button option-id="{{$data_option->id}}"  type="submit" class="btn btn-danger pull-right delete">Delete</button><br>
                                    <input id="addQuestion_id" type="hidden" name="question_id" value="{{$data_option->id}}">
                                    <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                                  </div>

                                @empty

                                <!-- <button type="submit" class="btn btn-success pull-right" id="addButton">Buat Pilihan Jawaban</button>

                                <div class="push-down-10">
                                  <div class="summernote_pil">@foreach($data_number->options as $key_option=>$data_option)  {!! $data_option->pilihan_jawaban !!} @endforeach</div>
                                </div>

                                <div class="push-down-20">
                                  <input id="addQuestion_id" type="hidden" name="question_id" value="@foreach($data_number->options as $key_option=>$data_option) {{$data_option->id}}  @endforeach">
                                  <input id="addQuiz_id_jawaban" type="hidden" name="id_quiz" value="{{$data_number->id}}">
                                </div> -->

                                @endforelse
                              </div>
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
                  <a href="{{route('admin.kumpulansoal.show', $data_quiz->id)}}" type="button" class="btn btn-info pull-right">Lihat Soal</a>
                <button type="button" class="btn btn-success pull-right" id="tambah_Pertanyaan">Buat Pertanyaan Baru</button>
                <button type="button" class="btn btn-danger pull-right" id="cancleTambah_Pertanyaan" style="display:none">Tidak Jadi Buat Soal</button>
            </div>


          </div>



          </div>

        </div>
      </div>
    </div>

@stop

@section('data-scripts')
<script type="text/javascript" src="{{asset('admin/kuis/js/script.js')}}"></script>
@stop
