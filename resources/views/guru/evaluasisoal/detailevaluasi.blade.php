@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{ route('guru.evaluasisoal.index') }}">Evaluasi Soal</a></li>
    <li class="active">Detail Evaluasi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Detail Evaluasi</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Evaluasi Soal {{$kelas->nama_kelas ?? ''}}</h3>

                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="panel-title">Mata Pelajaran : {{$quiz->mapel->nama_mapel  ?? ''}}</h3>
                        <hr>
                        <h3 class="panel-title ml-3">Kode Soal : {{$quiz->kode_soal  ?? ''}}</h3>

                    </div>


                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover table-striped table-bordered datatable">

                        <thead>
                            <tr align="center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Mahasiswa</th>
                                <th colspan="{{count($quiz->question)}}" style="text-align: center;">No Soal</th>
                                <th rowspan="2">Nilai Akhir</th>
                            </tr>

                            <tr>
                                @foreach($quiz->question as $key => $question)
                                <th>{{++$key ?? ''}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_siswa as $key_siswa => $mahasiswa)

                            <tr>
                                <td>{{++$key_siswa}}</td>
                                <td>{{$mahasiswa->nama_mahasiswa}} </td>

                                @php
                                $data_jawaban = collect($data_jawaban);
                                $data_jawaban_filter = $data_jawaban->where('siswa_id', $mahasiswa->id);

                                @endphp

                                @foreach($data_jawaban_filter as $jawaban)
                                <td>
                                    {{$jawaban['score'] ?? '0'}}
                                </td>

                                @endforeach


                                <td>{{$nilai_kuis->where('siswa_id', $mahasiswa->id)->where('quiz_id', $quiz->id)->first()->nilai_akhir ?? '0'}}</td>


                            </tr>
                            @endforeach


                        </tbody>

                        <tfoot id="stats-evaluasi-soal">
                            <tr class="baris-footer">
                                <td colspan="2" style="text-align: center;"><span class="fa fa-signal"></span> Statistik Jawaban </td>
                                @foreach($quiz->question as $key_question => $question)
                                @php
                                $jawaban = $question->options->where('is_correct', 1)->first();

                                @endphp
                                <td class="data-jawaban" name="dt" data-question="{{$question->pertanyaan  ?? ''}}" jawaban-id="{{$jawaban->id ?? '0'}}" kelas-id="{{$kelas->id ?? ''}}" data-id="{{++$key_question  ?? ''}}" question-id="{{$question->id ?? ''}}">
                                    <a href="#" class="btn btn-sm "><span class="fa fa-signal"></span></a>

                                </td>

                                @endforeach

                                <td>
                                    @php
                                    $rata2 = $nilai_kuis->avg('nilai_akhir');
                                    @endphp

                                    {{$rata2 ?? '0'}}
                                </td>

                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

        </div>
    </div>
</div>


<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="statsEvaluasiSoal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"> Statistik Soal </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="panel-heading">
                        <h3 class="data-pertanyaan">

                        </h3>
                    </div>
                    <div class="panel-body">
                        <div id="chart-bar-soal" class="bar-chart" style="width:600px; height:350px;"></div>

                    </div>


                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->
@stop

@section('data-scripts')

<script>
    $(function() {

        $(".baris-footer .data-jawaban").on("click", function() {
            // get data source
            var kelas_id = $(this).attr("kelas-id");
            var question_id = $(this).attr("question-id");
            var jawaban_id = $(this).attr("jawaban-id");
            var data_question = $(this).attr("data-question");
            var nomor = $(this).attr('data-id');

            var url = '{{route("guru.evaluasi.soal",[":question_id",":kelas_id"])}}';
            url = url.replace(':question_id', question_id);
            url = url.replace(':kelas_id', kelas_id);

            $('#chart-bar-soal').empty();
            var data_json = $.getJSON(url, function(data_json) {
                Morris.Bar({
                    element: 'chart-bar-soal',
                    data: data_json,
                    xkey: 'option_id',
                    ykeys: ['jumlah'],
                    labels: ['jumlah'],
                    barColors: [ '#95B75D']
                });
            });
            // console.log(data_json);
            $("#statsEvaluasiSoal .modal-title").html(' <span class="fa fa-signal"></span> Statistik Soal ' + nomor);
            $("#statsEvaluasiSoal .data-pertanyaan").html(data_question);
            $("#statsEvaluasiSoal").modal("show");


        })

    });
</script>
@stop
