<!DOCTYPE html>
<html>
<head>

  <title>SIM Sekolah</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />

  <!-- CSS BOOSTRAP -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- END CSS BOOSTRAP -->

  <!-- CSS JOLI -->
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-default-kalender.css')}}"/>
  <!-- END CSS JOLI -->

  <meta charset='utf-8' />
  <link href="{{asset('assets/fullcalendar/packages/core/main.css')}}" rel='stylesheet' />
  <link href="{{asset('assets/fullcalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
  <link href="{{asset('assets/fullcalendar/packages/timegrid/main.css')}}" rel='stylesheet' />
  <link href="{{asset('assets/fullcalendar/packages/list/main.css')}}" rel='stylesheet' />

  <link href="{{asset('assets/fullcalendar/css/style.css')}}" rel='stylesheet' />

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

  <!-- START PAGE CONTAINER -->

  <div class="fixed-top">
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <h5 class="text-white h4">Menu Bar</h5>
        <!-- <span class="text-muted">Toggleable via the navbar brand.</span> -->

        <nav class="nav nav-pills flex-column flex-sm-row">
          @can('manage-users')
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('admin.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text"> Halaman Utama</span></a>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span> Data User</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.users.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Users Akun</span></a>
                <a class="dropdown-item" href="{{ route('admin.siswa.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Siswa</span></a>
                <a class="dropdown-item" href="{{ route('admin.datapegawai.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Kepegawaian</span></a>
                <a class="dropdown-item" href="{{ route('admin.dataorangtua.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Orang Tua</span></a>
              </div>
            </li>
            <li class="nav-item">
              <a  class="nav-link active" href=""><span class="fa fa-calendar-o"></span> <span class="xn-text"> Kalender Akademik</span></a>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Data Pelajaran/Ujian</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.matapelajaran.index') }}"><span class="xn-text">Mata Pelajaran</span></a>
                <a class="dropdown-item" href="{{ route('admin.mataujian.index') }}"><span class="xn-text">Mata Ujian</span></a>
              </div>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('admin.kelas.index') }}"><span class="fa fa-archive"></span> <span class="xn-text"> Data Kelas</span></a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('admin.materipelajaran.index') }}"><span class="fa fa-book"></span> <span class="xn-text"> Materi Pelajaran</span></a>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Jadwal Pelajaran</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.jadwalpelajaranguru.index') }}"><span class="xn-text">Jadwal Pelajaran Guru</span></a>
                <a class="dropdown-item" href="{{ route('admin.jadwalpelajaransiswa.index') }}"><span class="xn-text">Jadwal Pelajaran Siswa</span></a>
              </div>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('admin.jadwalujian.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Ujian</span></a>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Bank Soal</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.kumpulansoal.index') }}"><span class="xn-text">Kumpulan Soal-Soal</span></a>
                <a class="dropdown-item" href="{{ route('admin.evaluasisoal.index') }}"><span class="xn-text">Evaluasi Soal</span></a>
              </div>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Absensi</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.absensi.pegawai') }}"><span class="xn-text">Absensi Pegawai</span></a>
                <a class="dropdown-item" href="{{ route('admin.absensi.guru') }}"><span class="xn-text">Absensi Guru</span></a>
                <a class="dropdown-item" href="{{ route('admin.absensi.siswa') }}"><span class="xn-text">Absensi Siswa</span></a>
              </div>
            </li>
            <li  class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Nilai Rapor</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.nilaisiswa.index') }}"><span class="xn-text">Nilai Siswa</span></a>
                <a class="dropdown-item" href="{{ route('admin.raporsiswa.index') }}"><span class="xn-text">Rapor Siswa</span></a>
                <a class="dropdown-item" href="{{ route('admin.kenaikankelas.index') }}"><span class="xn-text">Kenaikan Kelas</span></a>
              </div>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('admin.dataruangan.index') }}"><span class="fa fa-columns"></span> <span class="xn-text">Ruangan</span></a>
            </li>
          @endcan
          @can('view-pegawai')
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('pegawai.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text"> Halaman Utama</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link active" href="{{ route('pegawai.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text">Kalender Akademik</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('pegawai.datapegawai.index') }}"><span class="fa fa-user"></span> Data Pegawai</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('pegawai.datasiswa.index') }}"><span class="fa fa-users"></span> Data Siswa</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('pegawai.pembayaran.index') }}"><span class="fa fa-dollar"></span> <span class="xn-text">Pembayaran</span></a>
          </li>
          @endcan
          @can('view-guru')
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('guru.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text"> Halaman Utama</span></a>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Wali Kelas</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('guru.walikelas.siswa.index') }}"><span class="xn-text">Data Siswa</span></a>
              <a class="dropdown-item" href="{{ route('guru.walikelas.dataabsensi.index') }}"><span class="xn-text">Data Absensi</span></a>
              <a class="dropdown-item" href="{{ route('guru.walikelas.datanilai.index') }}"><span class="xn-text">Data Nilai</span></a>
              <a class="dropdown-item" href="{{ route('guru.walikelas.datarapor.index') }}"><span class="xn-text">Data Rapor</span></a>
            </div>
          </li>
          <li class="nav-item">
            <a  class="nav-link active" href="{{ route('guru.Kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text"> Kalender Akademik</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('guru.jadwalkelas.index') }}"><span class="fa fa-file-text-o"></span> <span class="xn-text"> Jadwal Kelas</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('guru.materipelajaran.index') }}"><span class="fa fa-book"></span> <span class="xn-text"> Materi Pelajaran</span></a>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Absensi</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('guru.absensi.guru.index') }}"><span class="xn-text">Absensi Guru</span></a>
              <a class="dropdown-item" href="{{ route('guru.absensi.siswa.index') }}"><span class="xn-text">Absensi Siswa</span></a>
            </div>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Manajemen Soal</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('guru.banksoal.index') }}"><span class="xn-text">Bank Soal</span></a>
              <a class="dropdown-item" href="{{ route('guru.evaluasisoal.index') }}"><span class="xn-text">Evaluasi Soal</span></a>
            </div>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Input Nilai</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('guru.bobotdankkm.index') }}"><span class="xn-text">Nilai Bobot dan KKM</span></a>
              <a class="dropdown-item" href="{{ route('guru.nilaiharian.index') }}"><span class="xn-text">Input Nilai Harian</span></a>
              <a class="dropdown-item" href="{{ route('guru.nilaiakhir.index') }}"><span class="xn-text">Input Nilai Akhir</span></a>
            </div>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('guru.chat.index') }}"><span class="fa fa-comment"></span><span class="xn-text"> Chat</span></a>
          </li>
          @endcan
          @can('view-siswa')
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('siswa.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text"> Halaman Utama</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link active" href="{{ route('siswa.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text">Kalender Akademik</span></a>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span> Data Siswa</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('siswa.datapribadi.index') }}"><span class="fa fa-user"></span> Data Pribadi</a>
              <a class="dropdown-item" href="{{ route('siswa.dataabsensi.index') }}"><span class="fa fa-table"></span> Data Absensi</a>
              <a class="dropdown-item" href="{{ route('siswa.datanilai.index') }}"><span class="fa fa-sort-numeric-asc"></span> Data Nilai</a>
            </div>
          </li>
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-file-text"></span> Tugas Siswa</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('siswa.datatugas.index') }}"><span class="fa fa-columns"></span>Data Tugas</a>
              <a class="dropdown-item" href="{{ route('siswa.datakuis.index') }}"><span class="fa fa-list-alt"></span>Data Kuis</a>
            </div>
          </li>
          <li class="nav-item">
            <a  class="nav-link " href="{{ route('siswa.jadwalpelajaran.index') }}"><span class="fa fa-files-o"></span> <span class="xn-text">Jadwal Pelajaran</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link " href="{{ route('siswa.pembayaran.index') }}"><span class="fa fa-dollar"></span> <span class="xn-text">Pembayaran</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link " href="{{ route('siswa.raporsiswa.index') }}"><span class="fa fa-star"></span> <span class="xn-text">Rapor Siswa</span></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link " href="{{ route('siswa.chat.index') }}"><span class="fa fa-comment"></span> <span class="xn-text">Chat</span></a>
          </li>
          @endcan
        </nav>

      </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </div>

  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('pegawai.halamanutama.index') }}"><span class="fa fa-home"></span> Halaman Utama</a></li>
      <li><span class="fa fa-calendar"></span> Kalender Akademik</li>
  </ul>
  <!-- END BREADCRUMB -->

    <div class="page-content">
      @can('manage-users')
      @include('admin.kalenderakademik.modal-calendar')
      @include('admin.kalenderakademik.modal-list-remainder')
      @endcan
        <div id='wrap'>
            <div class="content-frame">

            <!-- START CONTENT FRAME TOP -->
            <div class="content-frame-top">
                <div class="page-title">
                    <h2><span class="fa fa-calendar"></span> Kalender Akademik</h2>
                </div>
            </div>
            <!-- END CONTENT FRAME TOP -->

            <div class="content-frame">
              <div id='external-events-b'>
              <!-- <button class="btn btn-primary">Halaman Utama <i class="fa fa-home"></i></button> -->
              @can('manage-users')
              <h4>List Remainder</h4>
              <button type="submit" class="btn btn-primary">Kembali Halaman Utama</button>
              @endcan
              <div id='external-events-list'>
                @can('manage-users')
                @if($listRemainder)
                  @foreach($listRemainder as $remainder)
                    <div
                      style="padding: 4px; border: 1px solid {{ $remainder->color }}; background-color: {{ $remainder->color }}"
                      class='fc-event event text-center'
                      data-event='{"id":"{{ $remainder->id }}","title":"{{ $remainder->title }}","color":"{{ $remainder->color }}","start":"{{ $remainder->start }}","end":"{{ $remainder->end }}"}'>
                      {{ $remainder->title }}
                    </div>
                  @endforeach
                @endif
                @endcan
              </div>
              @can('manage-users')
              <p>
                <input type='checkbox' id='drop-remove' />
                <label for='drop-remove'>remove after drop</label>
                <button class="btn btn-sm btn-success" id="newListRemainder" style="font-size: 1em; width: 100%;">Tambah List Remainder</button>
              </p>
              @endcan
            </div>

            <div id="calendar-list">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title"><span class="fa fa-calendar"></span> List Seluruh Kegiatan Sekolah</h3>
                      {{ $events->links() }}
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                        @foreach($events as $event)
                        <div class="list-group border-bottom">
                            <div class="list-group-item"><span class="fa fa-circle" style="color:{{$event->color}}"></span>
                              <b>{{$event->title}}</b>
                              <p class="push-up-10">
                                <span><p class="push-down-0">Deskripsi :</p> </span>
                                {{$event->description}}
                              </p>
                              <p class="push-up-20">Mulai : {{$event->start}}</p>
                              <p>Sampai : {{$event->end}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
              </div>
            </div>

            </div>

            <div class="content-frame padding-bottom-0">
              <div
              id='calendar'
              data-route-load-events="{{ route('routeLoadEvents') }}"

              data-route-update-events="{{ route('routeUpdateEvents') }}"
              data-route-store-events="{{ route('routeStoreEvents') }}"
              data-route-delete-events="{{ route('routeDeleteEvents') }}"

              data-route-delete-list-remainder="{{ route('routeDeleteListRemainder') }}"
              data-route-update-list-remainder="{{ route('routeUpdateListRemainder') }}"
              data-route-store-list-remainder="{{ route('routeStoreListRemainder') }}"
            ></div>
            </div>

            <div style='clear:both'></div>
            </div>

          </div>

    </div>

  <!-- END PAGE CONTAINER -->




  <!-- <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap.min.js')}}"></script>

  <script type='text/javascript' src="{{asset('admin/js/plugins/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script> -->


  <script src="{{asset('assets/fullcalendar/packages/core/main.js')}}"></script>
  <script src="{{asset('assets/fullcalendar/packages/interaction/main.js')}}"></script>
  <script src="{{asset('assets/fullcalendar/packages/daygrid/main.js')}}"></script>
  <script src="{{asset('assets/fullcalendar/packages/timegrid/main.js')}}"></script>
  <script src="{{asset('assets/fullcalendar/packages/list/main.js')}}"></script>

  <script src="{{asset('assets/fullcalendar/packages/core/locales-all.js')}}"></script>

  <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <script src="{{asset('assets/fullcalendar/js/script.js')}}"></script>
  <script src="{{asset('assets/fullcalendar/js/calendar.js')}}"></script>

</body>
</html>
