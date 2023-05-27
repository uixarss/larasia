@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a href="{{ route('siswa.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Data Absensi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
      <div class="page-title">
          <h3><span class="fa fa-table"></span> Data Absensi</h3>
      </div>
      <div class="panel panel-heading">
        <div class="col-md-5 push-down-15">
          <div class="col-md-12">
            <h3 class="panel-title"> <strong>Data Absensi Hari ini</strong><span><h5>{{ \Carbon\Carbon::parse($tanggal_absen)->format('l')}}, {{\Carbon\Carbon::parse($tanggal_absen)->format('d M Y')}}</h5></span></h3>
          </div>
          <form action="{{route('siswa.dataabsensi.cariabsen')}}" method="post">
          {{csrf_field()}}
            <div class="col-md-12">
              <p>Pilih Data Absensi Berdasarkan Bulan dan Tahun</p>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <select name="month" class="form-control select pilihMataPelajaran" data-live-search="true" required>
                  <option value="">-Pilih Bulan-</option>
                  @for ($month=1; $month <= 12 ; $month++)
                  @if ($rMonth == $month)
                  <option value="{{$month}}" selected>
                    @if($month == 1)
                    Januari
                    @elseif($month == 2)
                    February
                    @elseif($month == 3)
                    Maret
                    @elseif($month == 4)
                    April
                    @elseif($month == 5)
                    Mei
                    @elseif($month == 6)
                    Juni
                    @elseif($month == 7)
                    Juli
                    @elseif($month == 8)
                    Agustus
                    @elseif($month == 9)
                    September
                    @elseif($month == 10)
                    Oktober
                    @elseif($month == 11)
                    November
                    @else
                    Desember
                    @endif
                  </option>
                  @else
                  <option value="{{$month}}">
                    @if($month == 1)
                    Januari
                    @elseif($month == 2)
                    February
                    @elseif($month == 3)
                    Maret
                    @elseif($month == 4)
                    April
                    @elseif($month == 5)
                    Mei
                    @elseif($month == 6)
                    Juni
                    @elseif($month == 7)
                    Juli
                    @elseif($month == 8)
                    Agustus
                    @elseif($month == 9)
                    September
                    @elseif($month == 10)
                    Oktober
                    @elseif($month == 11)
                    November
                    @else
                    Desember

                    @endif
                  </option>
                  @endif
                  @endfor

                </select>

              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <select name="year" class="form-control select" data-live-search="true" required>
                  <option value="">-Pilih Tahun-</option>
                  @for ($years=1999; $years <= 2050 ; $years++)
                    @if($rYear == $years)
                    <option value="{{$years}}" selected>{{$years}}</option>
                    @else
                    <option value="{{$years}}">{{$years}}</option>
                    @endif
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success"> <span class="fa fa-search"></span>Cari Data Absensi</button>
            </div>
          </form>
        </div>
        <div class="col-md-4 pull-right push-up-15">
          @foreach($absensii as $absensi)
          @switch($absensi->keterangan)
          @case('Hadir')
          <div class="widget widget-info">
              <div class="widget-title">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</div>
              <div class="widget-subtitle">Jam Masuk : {{$absensi->jam_masuk}} / Jam Pulang : {{$absensi->jam_pulang}} </div>
              <div class="widget-int"><span>Hadir</span></div>
          </div>
          @break
          @case('Izin')
          <div class="widget widget-warning">
              <div class="widget-title">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</div>
              <div class="widget-subtitle">Masuk Jam : {{$absensi->jam_masuk}} Pulang Jam : {{$absensi->jam_pulang}} </div>
              <div class="widget-int"><span>Izin</span></div>
          </div>
          @break
          @case('Sakit')
          <div class="widget widget-primary">
              <div class="widget-title">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</div>
              <div class="widget-subtitle">Masuk Jam : {{$absensi->jam_masuk}} Pulang Jam : {{$absensi->jam_pulang}} </div>
              <div class="widget-int"><span>Sakit</span></div>
          </div>
          @break
          @default
          <div class="widget widget-danger">
              <div class="widget-title">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</div>
              <div class="widget-subtitle">Masuk Jam : {{$absensi->jam_masuk}} Pulang Jam : {{$absensi->jam_pulang}} </div>
              <div class="widget-int"><span>Alpha</span></div>
          </div>
          @endswitch
          @endforeach
        </div>
      </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <div class="panel-heading">

        <div class="col-md-8">

          <div class="panel-body">
              <table class="table datatable">
                  <thead>
                      <tr>
                        <th>Tanggal Absen</th>
                        <th>Hari</th>
                        <th>Jam Datang</th>
                        <th>Jam Pulang</th>
                        <th>Keterangan</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach($data_absensi as $absensi)
                    <tr>
                      <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absen)->format('d M Y')}}</td>
                      <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absen)->format('l')}}</td>
                      <td>{{$absensi->jam_masuk}}</td>
                      <td>{{$absensi->jam_pulang}}</td>

                      @switch($absensi->keterangan)
                      @case('Hadir')
                      <td><span class="label label-info label-form">Hadir</span></td>
                      @break
                      @case('Izin')
                      <td><span class="label label-warning label-form">Izin</span></td>
                      @break
                      @case('Sakit')
                      <td><span class="label label-default label-form">Sakit</span></td>
                      @break
                      @default
                      <td><span class="label label-danger label-form">Alpha</span></td>

                      @endswitch

                    </tr>


                    @endforeach


                  </tbody>
              </table>
          </div>

        </div>
        <div class="col-md-4 push-up-30">
          <p class="panel-title push-up-20 push-down-20">Keterangan :</p>
          <!-- DEFAULT LIST GROUP -->
          <div class="panel panel-default">
              <div class="panel-heading ui-draggable-handle">
                <div class="panel-title-box">
                    <h3>Laporan Absensi</h3>
                    <span>Bulan
                      @if($rMonth == 1)
                      <strong>Januari</strong>
                      @elseif($rMonth == 2)
                      <strong>February</strong>
                      @elseif($rMonth == 3)
                      <strong>Maret</strong>
                      @elseif($rMonth == 4)
                      <strong>April</strong>
                      @elseif($rMonth == 5)
                      <strong>Mei</strong>
                      @elseif($rMonth == 6)
                      <strong>Juni</strong>
                      @elseif($month == 7)
                      <strong>Juli</strong>
                      @elseif($rMonth == 8)
                      <strong>Agustus</strong>
                      @elseif($rMonth == 9)
                      <strong>September</strong>
                      @elseif($rMonth == 10)
                      <strong>Oktober</strong>
                      @elseif($rMonth == 11)
                      <strong>November</strong>
                      @else
                      <strong>Desember</strong>
                      @endif

                      Tahun <strong>{{$rYear}}</strong> </span>
                </div>
              </div>
              <div class="panel-body">
                <ul class="list-group border-bottom">
                    <li class="list-group-item">Hadir<span class="badge badge-info">{{$hadir->count()}}</span></li>
                    <li class="list-group-item">Izin<span class="badge badge-warning">{{$izin->count()}}</span></li>
                    <li class="list-group-item">Sakit<span class="badge badge-default">{{$sakit->count()}}</span></li>
                    <li class="list-group-item">Alpa<span class="badge badge-danger">{{$alpha->count()}}</span></li>
                    <li class="list-group-item">Jumlah Pertemuan<span class="badge badge-success">{{$jumlahPertemuan}}</span></li>
                </ul>
              </div>
            </div>

          <!-- END DEFAULT LIST GROUP -->
        </div>

    </div>

</div>
<!-- END CONTENT FRAME -->


@stop
