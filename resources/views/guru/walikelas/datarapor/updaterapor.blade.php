@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
      <li><a href="{{ route('guru.walikelas.datarapor.index') }}">Update Rapor Siswa</a></li>
      <li class="active">Update Rapor Siswa</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span> Update Rapor Siswa </h2>
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

                  <tr><th colspan="3"></th></tr>

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

                  <tr><th colspan="3"></th></tr>

                </body>
                </table>
              </div>

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
                <form action="{{ route('guru.walikelas.datarapor.updateraporsiswa', $siswa->id) }}" method="post">
                  @csrf
                    @foreach($nilai_rapor_siswa as $no => $rapor_siswa)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>
                        {{$rapor_siswa->nama_mapel}}
                        <input name="id[]" type="hidden" class="form-control" value="{{$rapor_siswa->id}}">
                        <input name="nama_mapel[]" type="hidden" class="form-control" value="{{$rapor_siswa->nama_mapel}}">
                      </td>
                      <td>
                        <p aria-hidden="false" class="form-control" > {{$rapor_siswa->kkm}}  </p>
                        <input name="kkm[]" type="hidden" class="form-control" value="{{$rapor_siswa->kkm}}">
                      </td>
                      <td>
                        <input class="input" id="{{ 'myInput'.$rapor_siswa->id }}" input-id="{{$rapor_siswa->id}}" name="nilai_akhir[]" type="number" class="form-control" value="{{$rapor_siswa->nilai_akhir}}" placeholder="Nilai">
                      </td>
                      <td align="center">

                        @foreach($grade_nilai as $gn)
                          @if($rapor_siswa->nilai_akhir >= $gn->nilai_rendah && $rapor_siswa->nilai_akhir <= $gn->nilai_tinggi)
                            <p aria-hidden="false" class="form-control" align="center"> <strong> {{$gn->nama_grade}} </strong></p>
                          @endif
                        @endforeach

                        <!-- <p id="{{ 'demo'.$rapor_siswa->id }}" aria-hidden="false" class="form-control" > - </p> -->
                        <input id="{{ 'grade'.$rapor_siswa->id }}" name="huruf_mutu[]" type="hidden" class="form-control" value="{{$rapor_siswa->huruf_mutu ?? '-'}}">
                      </td>
                      <td>
                        <textarea name="keterangan[]" class="form-control" rows="3" cols="20" placeholder="Masukan Keterangan">{{$rapor_siswa->keterangan}}</textarea>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

            </div>

            <div class="panel-footer">
              <button type="submit" class="btn btn-primary pull-right push-down-25">Update Nilai Rapor</button>
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

  $(document).on('input', ".input", function(){

    var $this = $(this);
    var id_input = $this.attr('input-id');
    var nama_grade = $this.attr('grade-nama');
    var nilairendah_grade = $this.attr('grade-nilairendah');
    var nilaitinggi_grade = $this.attr('grade-nilaitinggi');

    var x = document.getElementById("myInput"+id_input).value;

    $('#grade'+id_input).val(x);

    if (x >= nilairendah_grade && x <= nilaitinggi_grade ) {
      x = nama_grade;
      document.getElementById("demo"+id_input).innerHTML = x;
    }else {
      console.log("input",id_input,x,nilairendah_grade);

    }




  });

</script>
@endsection
