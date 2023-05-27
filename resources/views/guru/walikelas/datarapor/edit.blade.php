@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="{{ route('guru.walikelas.datarapor.index') }}">Data Rapor</a></li>
  <li class="active">Input Rapor Siswa</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Input Rapor Siswa </h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">

      <!-- START DEFAULT DATATABLE -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Rapor Siswa Kelas {{$nilai_rapor->kelas_siswa}}</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
          </ul>
        </div>

        <div class="panel-body">

          <div class="col-md-6">
            <table class="table">

              <body>
                <tr>
                  <th>NIS</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->nis}}</th>
                </tr>

                <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->nama_siswa}}</th>
                </tr>

                <tr>
                  <th>Kelas</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->kelas_siswa}}</th>
                </tr>

                <tr>
                  <th colspan="3"></th>
                </tr>

              </body>
            </table>
          </div>

          <div class="col-md-6">
            <table class="table">

              <body>
                <tr>
                  <th>Wali Kelas</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->wali_kelas}}</th>
                </tr>

                <tr>
                  <th>Tahun Ajaran</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->tahun_ajaran}}</th>
                </tr>

                <tr>
                  <th>Semester</th>
                  <th>:</th>
                  <th>{{$nilai_rapor->semester}}</th>
                </tr>

                <tr>
                  <th colspan="3"></th>
                </tr>

              </body>
            </table>
          </div>

          <form action="{{ route('guru.walikelas.datarapor.storerapor', [$nilai_rapor->id]) }}" method="post">
            @csrf

            <table class="table">
              <thead>
                <tr>
                  <th width="60">No</th>
                  <th>Mata Pelajaran</th>
                  <th width="100">KKM</th>
                  <th width="100">Nilai</th>
                  <th width="100">Huruf Mutu</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_mapel as $no => $mapel)
                <tr>
                  <td>{{++$no}}</td>
                  <td>
                    {{$mapel->nama_mapel}}
                    <input type="hidden" class="nama_mapel" name="nama_mapel[]" value="{{$mapel->nama_mapel}}">
                  </td>
                  <td>
                    @foreach($mapel->kkms as $kkm)
                    <input name="kkm[]" type="hidden" class="form-control" value="{{$kkm->nilai ?? ''}}">
                    <input type="number" class="form-control" value="{{$kkm->nilai ?? ''}}" disabled>
                    @endforeach
                  </td>
                  <td>
                    <input name="nilai_rapor_id[]" type="hidden" class="form-control" value="{{$nilai_rapor->id ?? ''}}">
                    <input class="input" id="{{ 'myInput'.$mapel->id }}" input-id="{{$mapel->id}}" name="nilai_akhir[]" type="number" class="form-control" value="{{$nilai_rapor->id}}" placeholder="Nilai">
                  </td>
                  <td align="center">


                    <p id="{{ 'demo'.$mapel->id }}" aria-hidden="false" class="form-control"> - </p>


                    <input id="{{ 'grade'.$mapel->id }}" type="hidden" name="huruf_mutu[]" value="-">

                  </td>
                  <td>
                    <textarea name="keterangan[]" class="form-control" rows="3" cols="20"></textarea>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

        </div>

        <div class="panel-footer">

          <button type="submit" class="btn btn-primary pull-right push-down-25">Simpan Nilai Rapor</button>

          </form>
        </div>
      </div>
      <!-- END DEFAULT DATATABLE -->

    </div>
  </div>
</div>

@stop

@section('data-scripts-rapor')
<script type="text/javascript">
  $(document).on('input', ".input", function() {

    var $this = $(this);
    var id_input = $this.attr('input-id');


    var x = document.getElementById("myInput" + id_input).value;
    var nilai = "";
    switch (x) {
      case x < 100 && x > 85:
        nilai = "A";
        break;
      case x <= 85 && x > 75:
        nilai = "B";
        break;
      case x <= 75 && x > 65:
        nilai = "C";
        break;
      case x <= 65 && x > 55:
        nilai = "D";
        break;
      default:
        nilai = "E"
    }
    $('#grade' + id_input).val(nilai);



    document.getElementById("demo" + id_input).innerHTML = nilai;


    console.log("input", id_input);

  });
</script>
@endsection