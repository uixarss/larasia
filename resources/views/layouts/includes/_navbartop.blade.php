<!-- START X-NAVIGATION VERTICAL -->
<!-- <div class="x-navigation x-navigation-horizontal-home x-navigation-top">

  @auth
  <li class="xn-icon-button pull-right">
    <a href="{{ route('logout') }}" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
  </li>
  @endauth

  <div class="logo-nav">
    <a href="#" class="list-group-item-nav pull-left">
      <img src="{{asset('admin/img/logo-kampus.png')}}" alt="Logo Kampus">
    </a>
  </div>

  <ul style="float:right;">
    <li class="xn-icon-button pull-right">
      <a href="" class="mb-control">Home</a>
    </li>
    <li class="xn-icon-button pull-right">
      <a href="" class="mb-control">Tentang</a>
    </li>
    <li class="xn-icon-button pull-right">
      <a href="" class="mb-control">Pendidikan</a>
    </li>
    <li class="xn-icon-button pull-right">
      <a href="" class="mb-control">Login</a>
    </li>
  </ul>

</div> -->

<!-- 
  @can('view-pegawai')
  <ul class="x-navigation x-navigation-horizontal-home">

    <li class="">
      <a href="{{ route('pegawai.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
    </li>

    <li class="">
      <a href="{{ route('pegawai.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text">Kalender Akademik</span></a>
    </li>

    <li class="xn-openable">
      <a href="{{ route('pegawai.datapegawai.index') }}"><span class="fa fa-user"></span> Data Pegawai</a>
    </li>

    <li class="xn-openable">
      <a href="{{ route('pegawai.datasiswa.index') }}"><span class="fa fa-users"></span> Data Siswa</a>
    </li>

    <li class="">
      <a href="{{ route('pegawai.pembayaran.index') }}"><span class="fa fa-dollar"></span> <span class="xn-text">Pembayaran</span></a>
    </li>

  </ul>
  @endcan

  @can('view-siswa')
  <ul class="x-navigation x-navigation-horizontal-home">

    <li class="">
      <a href="{{ route('siswa.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
      <a href="#" class="x-navigation-control"></a>
    </li>

    <li class="">
      <a href="{{ route('siswa.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text">Kalender Akademik</span></a>
    </li>

    <li class="xn-openable">
      <a href="#"><span class="fa fa-user"></span> Data Siswa</a>
      <ul>
        <li><a href="{{ route('siswa.datapribadi.index') }}"><span class="fa fa-user"></span> Data Pribadi</a></li>
        <li><a href="{{ route('siswa.dataabsensi.index') }}"><span class="fa fa-table"></span> Data Absensi</a></li>
        <li><a href="{{ route('siswa.datanilai.index') }}"><span class="fa fa-sort-numeric-asc"></span> Data Nilai</a></li>
      </ul>
    </li>

    <li class="">
      <a href="{{ route('siswa.materipelajaran.index') }}"><span class="glyphicon glyphicon-book"></span> <span class="xn-text">Materi Pelajaran</span></a>
    </li>

    <li class="xn-openable">
      <a href="#"><span class="fa fa-file-text"></span> Tugas Siswa</a>
      <ul>
        <li><a href="{{ route('siswa.datatugas.index') }}"><span class="fa fa-columns"></span>Data Tugas</a></li>
        <li><a href="{{ route('siswa.datakuis.index') }}"><span class="fa fa-list-alt"></span>Data Kuis</a></li>
      </ul>
    </li>

    <li class="">
      <a href="{{ route('siswa.dataujian.index') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Data Ujian</span></a>
    </li>

    <li class="">
      <a href="{{ route('siswa.jadwalpelajaran.index') }}"><span class="fa fa-files-o"></span> <span class="xn-text">Jadwal Pelajaran</span></a>
    </li>

    <li class="xn-openable">
      <a href="#"><span class="fa fa-align-justify"></span> Lainnya</a>
      <ul>
        <li class="">
          <a href="{{ route('siswa.pembayaran.index') }}"><span class="fa fa-dollar"></span> <span class="xn-text">Pembayaran</span></a>
        </li>

        <li class="">
          <a href="{{ route('siswa.peminjamanbuku.index') }}"><span class="fa fa-book"></span> <span class="xn-text">Peminjaman Buku</span></a>
        </li>

        <li class="">
          <a href="{{ route('siswa.raporsiswa.index') }}"><span class="fa fa-star"></span> <span class="xn-text">Rapor Siswa</span></a>
        </li>

        <li class="">
          <a href="{{ route('siswa.chat.index') }}"><span class="fa fa-comment"></span> <span class="xn-text">Chat</span></a>
        </li>
      </ul>
    </li>



  </ul>
  @endcan

  @can('view-perpustakaan')
  <ul class="x-navigation x-navigation-horizontal-home">

    <li class="">
      <a href="{{ route('perpustakaan.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
    </li>

    <li class="">
      <a href="{{ route('perpustakaan.databuku.index') }}"><span class="fa fa-book"></span> <span class="xn-text">Data Buku</span></a>
    </li>

    <li class="">
      <a href="{{ route('perpustakaan.transaksibuku.index') }}"><span class="fa fa-list"></span> <span class="xn-text">Transaksi Buku</span></a>
    </li>

    <li class="">
      <a href="{{ route('perpustakaan.kondisibuku.index') }}"><span class="fa fa-info-circle"></span> <span class="xn-text">Info Kondisi Buku</span></a>
    </li>




  </ul>
@endcan -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="{{asset('admin/img/logo-kampus.png')}}" alt="Logo Kampus" width="70">
  </a>
  <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}" style="font-family: Asap; color: #000;">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/pendidikan')}}" style="font-family: Asap; color: #000;">Pendidikan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/tentang')}}" style="font-family: Asap; color: #000;">Tentang</a>
      </li>
      <li class="nav-item">
      @if (Auth::check())
        @if(Auth::user()->hasRole('orangtua'))
        <li class="xn-icon-button pull-right">
          <a class="mb-control" data-box="#mb-signout" href="{{route('logout')}}" style="font-family: Asap; color: #FF0000;">Logout</a>
        </li>
        @elseif (Auth::user()->hasRole('admin'))
        <a class="nav-link" href="{{route('admin.halamanutama.index')}}" style="font-family: Asap; color: #000;">Dashboard</a>
        @elseif (Auth::user()->hasRole('perpustakaan'))
        <a class="nav-link" href="{{route('perpustakaan.halamanutama.index')}}" style="font-family: Asap; color: #000;">Dashboard</a>
        @elseif (Auth::user()->hasRole('siswa'))
        <a class="nav-link" href="{{route('siswa.halamanutama.index')}}" style="font-family: Asap; color: #000;">Dashboard</a>
        @elseif (Auth::user()->hasRole('pegawai'))
        <a class="nav-link" href="{{route('pegawai.halamanutama.index')}}" style="font-family: Asap; color: #000;">Dashboard</a>
        @elseif (Auth::user()->hasRole('guru'))
        <a class="nav-link" href="{{route('guru.halamanutama.index')}}" style="font-family: Asap; color: #000;">Dashboard</a>
        @else
        <li class="xn-icon-button pull-right">
          <a class="mb-control" data-box="#mb-signout" href="{{route('logout')}}" style="font-family: Asap; color: #FF0000;">Logout</a>
        </li>
        @endif
      @else
        <a class="nav-link" href="{{route('login')}}" style="font-family: Asap; color: #000;">Login</a>
      @endif
      </li>
    </ul>
  </div>
</nav>