<!-- START X-NAVIGATION VERTICAL -->
<div class="x-navigation x-navigation-horizontal x-navigation-top">


    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="{{ route('logout') }}" class="mb-control" data-box="#mb-signout"><span
                class="fa fa-sign-out"></span></a>
    </li>
    <!-- END SIGN OUT -->

    @can('view-pegawai')
    @php
    $pegawai = App\Models\Pegawai::where('user_id', Auth::id())->first();
    @endphp
    <div class="list-group list-group-contacts pull-right">
        <a href="{{ route('pegawai.pengaturan.index') }}" class="list-group-item-nav">
            @if($pegawai->photo != null)
            <img src="{{asset('admin/assets/images/users/pegawai/'.$pegawai->photo)}}" alt="Nadia Ali">
            @else
            <img src="{{asset('admin/assets/images/users/pegawai/no-image.jpg')}}" alt="Nadia Ali">
            @endif
        </a>
    </div>
    @endcan

    @can('view-siswa')
    @php
    $siswa = App\Models\Siswa::where('user_id', Auth::id())->first();
    @endphp

    <div class="list-group list-group-contacts pull-right">
        <a href="{{ route('siswa.pengaturan.index') }}" class="list-group-item-nav">
            @if($siswa->photo != null)
            <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
            @else
            <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
            @endif
        </a>
    </div>
    @endcan

    @can('view-perpustakaan')
    <!-- <div class="list-group list-group-contacts pull-right">
        <a href="{{ route('perpustakaan.pengaturan.index') }}" class="list-group-item-nav">
            <img src="{{asset('admin/img/admin/logosim.png')}}" alt="">
        </a>
    </div> -->
    @endcan

    <!-- Username -->
    <li class="xn-icon pull-right">
        <a> {{auth()->user()->name ?? ''}}</a>
    </li>
    <!-- END Username -->

    <div class="logo-nav">
        @php
        $data_sekolah = App\Models\DataSekolah::all()->first();
        @endphp
        <a href="#" class="list-group-item-nav  pull-left">
            @if($data_sekolah == null)
            <img src="{{asset('admin/assets/images/users/no-image.jpg')}}" alt="Logo Sekolah">
            @else
            <img src="{{asset('admin/assets/images/users/'.$data_sekolah->logo)}}" alt="Logo Sekolah">
            @endif
        </a>
        <div class="panel-title">SISTEM INFORMASI AKADEMIK</div>
        <div class="panel-title-nav">{{$data_sekolah->nama_sekolah ?? ''}}
            <p class="">{{$data_sekolah->alamat_sekolah ?? ''}}</p>
        </div>
    </div>



</div>

@role('pegawai')
<ul class="x-navigation x-navigation-horizontal">

    <li class="">
        <a href="{{ route('pegawai.halamanutama.index') }}"><span class="fa fa-home"></span> <span
                class="xn-text">Halaman Utama</span></a>
    </li>

    <!-- <li class="">
        <a href="{{ route('pegawai.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span
                class="xn-text">Kalender Akademik</span></a>
    </li> -->

    @can('view-profil-pt')
    <li>
        <a href="{{ route('pegawai.profilpt.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Profil
                PT</span></a>
    </li>
    @endcan
    @canany(['manage-fakultas', 'manage-jurusan', 'manage-prodi', 'manage-jenjang'])
    <li class="xn-openable">
        <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Data Fakultas</span></a>
        <ul>
            @can('manage-fakultas')
            <li><a href="{{ route('pegawai.fakultas.index') }}"><span class="fa fa-archive"></span> <span
                        class="xn-text">Fakultas</span></a></li>
            @endcan
            @can('manage-jurusan')
            <li><a href="{{ route('pegawai.jurusan.index') }}"><span class="fa fa-archive"></span> <span
                        class="xn-text">Jurusan</span></a></li>
            @endcan
            @can('manage-prodi')
            <li><a href="{{ route('pegawai.prodi.index') }}"><span class="fa fa-archive"></span> <span
                        class="xn-text">Program Studi</span></a></li>
            @endcan
            @can('manage-jenjang')
            <li><a href="{{ route('pegawai.jenjang.index') }}"><span class="fa fa-archive"></span> <span
                        class="xn-text">Jenjang Pendidikan</span></a></li>
            @endcan
        </ul>
    </li>
    @endcanany
    @can('manage-kelas')
    <li class="">
                <a href="{{ route('pegawai.kelas.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Data Kelas</span></a>
            </li>
    @endcan
    @can('manage-kurikulum')
    <li class="">
                <a href="{{ route('pegawai.kurikulum.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Kurikulum</span></a>
            </li>
    @endcan

    @can('manage-pegawai')
    <li class="xn-openable">
        <a href="{{ route('pegawai.datapegawai.index') }}"><span class="fa fa-user"></span> Data Pegawai</a>
    </li>
    @endcan


    @can('manage-dosen')
    <li class="xn-openable">
        <a href="{{ route('pegawai.dosen.index') }}"><span class="fa fa-users"></span> Data Dosen</a>
    </li>
    @endcan

    @can('manage-mahasiswa')
    <li class="xn-openable">
        <a href="{{ route('pegawai.mahasiswa.index') }}"><span class="fa fa-users"></span> Data Mahasiswa</a>
    </li>
    @endcan
    @can('manage-jadwal-kelas')
    <li class="xn-openable">
      <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Jadwal</span></a>
      <ul>
        <li><a href="{{ route('pegawai.jadwal.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Dosen</span></a></li>

        <!-- <li><a href="{{ route('admin.jadwalpelajaransiswa.index') }}"><span class="xn-text">Jadwal Pelajaran Mahasiswa</span></a></li> -->
      </ul>
    </li>
    @endcan

    @can('view-keuangan')
    <li class="xn-openable">
        <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Data Keuangan</span></a>
        <ul>
          <li><a href="{{route('pegawai.biaya.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Biaya</span></a></li>
          <li><a href="{{route('pegawai.pengeluaran.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Pengeluaran</span></a></li>
          <li><a href="{{route('pegawai.pemasukan.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Pemasukan</span></a></li>
          <li><a href="{{route('pegawai.pembayaran.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Pembayaran</span></a></li>
        </ul>
    </li>
    @endcan


    @canany(['manage-materi-pelajaran', 'view-mata-kuliah'])
    <li  class="xn-openable">
              <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Data Mata Kuliah</span></a>
              <ul>
                  @can('view-mata-kuliah')
                  <li><a href="{{ route('pegawai.matakuliah.index') }}"><span class="xn-text">Mata Kuliah</span></a></li>
                  <li><a href="{{ route('pegawai.modulmatkul.index') }}"><span class="xn-text">Modul Mata Kuliah</span></a></li>
                  @endcan
                  @can('manage-materi-pelajaran')
                  <li><a href="{{ route('pegawai.materipelajaran.index') }}"><span class="xn-text">Materi Pelajaran</span></a></li>
                  @endcan
              </ul>
    </li>
    @endcanany

    @can('manage-soal')
    <li  class="xn-openable">
        <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Bank Soal</span></a>
        <ul>
            <li><a href="{{ route('pegawai.kumpulansoal.index') }}"><span class="xn-text">Kumpulan Soal-Soal</span></a></li>
            <li><a href="{{ route('pegawai.evaluasisoal.index') }}"><span class="xn-text">Evaluasi Soal</span></a></li>
        </ul>
    </li>
    @endcan

    <li class="">
        <a href="{{ route('pegawai.pengaturan.index') }}"><span class="fa fa-gears"></span> <span
                class="xn-text">Pengaturan</span></a>
    </li>

</ul>
@endcan


@role('mahasiswa')
<ul class="x-navigation x-navigation-horizontal">

    <li class="">
        <a href="{{ route('siswa.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman
                Utama</span></a>
        <a href="#" class="x-navigation-control"></a>
    </li>

    <li class="">
        <a href="{{ route('siswa.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span> <span
                class="xn-text">Kalender Akademik</span></a>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-user"></span> Data Mahasiswa</a>
        <ul>
            <li><a href="{{ route('siswa.datapribadi.index') }}"><span class="fa fa-user"></span> Data Pribadi</a></li>
            <!-- <li><a href="{{ route('siswa.dataabsensi.index') }}"><span class="fa fa-table"></span> Data Absensi</a></li> -->
            <!-- <li><a href="{{ route('siswa.datanilai.index') }}"><span class="fa fa-sort-numeric-asc"></span> Data Nilai</a></li> -->
            <li><a href="{{ route('siswa.khs.index') }}"><span class="fa fa-sort-numeric-asc"></span> Kartu Hasil Studi</a></li>
            <li><a href="{{ route('siswa.krs.index') }}"><span class="fa fa-sort-numeric-asc"></span> Kartu Rencana Studi</a></li>
            <li><a href="{{ route('siswa.sp.create') }}"><span class="fa fa-sort-numeric-asc"></span> Daftar Semester Pendek</a></li>
        </ul>
    </li>

    <li class="">
        <a href="{{ route('siswa.materipelajaran.index') }}"><span class="fa fa-book"></span> <span
                class="xn-text">Materi Pelajaran</span></a>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-file-text"></span> Tugas Mahasiswa</a>
        <ul>
            <li><a href="{{ route('siswa.datatugas.index') }}"><span class="fa fa-columns"></span>Data Tugas</a></li>
            <li><a href="{{ route('siswa.datakuis.index') }}"><span class="fa fa-list-alt"></span>Data Kuis</a></li>
        </ul>
    </li>

    <li class="">
        <a href="{{ route('siswa.dataujian.index') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Data
                Ujian</span></a>
    </li>

    <li class="">
        <a href="{{ route('siswa.jadwalpelajaran.index') }}"><span class="fa fa-files-o"></span> <span
                class="xn-text">Jadwal Kuliah</span></a>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-align-justify"></span> Lainnya</a>
        <ul>
            <li class="">
                <a href="{{ route('siswa.pembayaran.index') }}"><span class="fa fa-dollar"></span> <span
                        class="xn-text">Pembayaran</span></a>
            </li>

            <li class="">
                <a href="{{ route('siswa.dataebook.index') }}"><span class="fa fa-book"></span> <span
                        class="xn-text">List E-Book</span></a>
            </li>
            <li class="">
                <a href="{{ route('siswa.databuku.index') }}"><span class="fa fa-book"></span> <span
                        class="xn-text">List Buku Perpustakan</span></a>
            </li>
            <li class="">
                <a href="{{ route('siswa.dataskripsi.index') }}"><span class="fa fa-book"></span> <span
                        class="xn-text">List Skripsi Perpustakan</span></a>
            </li>
            <li class="">
                <a href="{{ route('siswa.peminjamanbuku.index') }}"><span class="fa fa-book"></span> <span
                        class="xn-text">Peminjaman Buku</span></a>
            </li>

            <!-- <li class="">
                <a href="{{ route('siswa.raporsiswa.index') }}"><span class="fa fa-star"></span> <span
                        class="xn-text">Rapor Mahasiswa</span></a>
            </li> -->

            <li class="">
                <a href="{{ route('siswa.chat.index') }}"><span class="fa fa-comment"></span> <span
                        class="xn-text">Chat</span></a>
            </li>
            <li class="">
                <a href="{{ route('siswa.pengaturan.index') }}"><span class="fa fa-gears"></span> <span
                        class="xn-text">Pengaturan</span></a>
            </li>
        </ul>
    </li>



</ul>
@endcan


@role('perpustakaan')
<ul class="x-navigation x-navigation-horizontal">

    <li class="">
        <a href="{{ route('perpustakaan.halamanutama.index') }}"><span class="fa fa-home"></span> <span
                class="xn-text">Halaman Utama</span></a>
                <a href="#" class="x-navigation-control"></a>
    </li>

    <li class="">
        <a href="{{ route('perpustakaan.databuku.index') }}"><span class="fa fa-book"></span> <span class="xn-text">Data
                Buku</span></a>
    </li>

     <li class="">
        <a href="{{ route('perpustakaan.dataskripsi.index') }}"><span class="fa fa-book"></span> <span class="xn-text">Data
                Skripsi</span></a>
    </li>

    <li class="">
        <a href="{{ route('perpustakaan.transaksibuku.index') }}"><span class="fa fa-list"></span> <span
                class="xn-text">Transaksi Buku</span></a>
    </li>

    <li class="">
        <a href="{{ route('perpustakaan.kondisibuku.index') }}"><span class="fa fa-info-circle"></span> <span
                class="xn-text">Info Kondisi Buku</span></a>
    </li>
    <li class="">
        <a href="{{ route('perpustakaan.pengaturan.index') }}"><span class="fa fa-gears"></span> <span
                class="xn-text">Pengaturan</span></a>
    </li>



</ul>
@endcan
