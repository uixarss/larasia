<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
  <!-- START X-NAVIGATION -->
  <ul class="x-navigation">
    <li class="xn-logo" style="height: auto;">
      @php
      $data_sekolah = App\Models\DataSekolah::all()->first();
      @endphp

      <a href="#">
        {{$data_sekolah->nama_sekolah ?? ''}}
        <p>{{$data_sekolah->alamat_sekolah ?? ''}}</p>
      </a>
      <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
      <a href="#" class="profile-mini">
        <!-- <img src="assets/images/users/avatar.jpg" alt="John Doe"/> -->
      </a>
      <div class="profile">
        @can('manage-users')
        @php
        $data_sekolah = App\Models\DataSekolah::all()->first();
        @endphp
        <a href="{{ route('admin.pengaturan.index') }}" class="list-group-item-nav">
          <div class="profile-image">
            @if($data_sekolah == null)
            <img src="{{asset('admin/assets/images/users/no-image.jpg')}}" alt="Logo Sekolah">
            @else
            <img src="{{asset('admin/assets/images/users/'.$data_sekolah->logo)}}" alt="Logo Sekolah">
            @endif
          </div>
        </a>
        @endcan
        @can('view-guru')
        @php
        $guru = App\Models\Guru::where('user_id', Auth::id())->first();
        @endphp
        <a href="{{ route('guru.pengaturan.index') }}" class="list-group-item-nav">
          <div class="profile-image">
            @if(isset($guru))
            @if($guru->photo != null)
            <img src="{{asset('admin/assets/images/users/guru/'.$guru->photo)}}" alt="PhotoGuru" />
            @else
            <img src="{{asset('admin/assets/images/users/guru/no-image.jpg')}}" alt="PhotoGuru">
            @endif
          </div>
          @endif
        </a>
        @endcan
        <div class="profile-data">
          <div class="profile-data-name">{{auth()->user()->name}}</div>

        </div>

      </div>
    </li>
    @role('admin')
    <li class="xn-title">Profil Perguruan Tinggi</li>
    <li class="active">

      <a href="{{ route('admin.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>

    </li>

    <li class="xn-openable">
      <a href="#"><span class="fa fa-home"></span> <span class="xn-text">Setting Kampus</span></a>
      <ul>
        @can('view-profil-pt')
        <li>
          <a href="{{ route('admin.profilpt.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Profil PT</span></a>
        </li>

        <li>
          <a href="{{ route('admin.pimpinan.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Pimpinan PT</span></a>
        </li>
        @endcan

        @can('view-fakultas')
        <li><a href="{{ route('admin.fakultas.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Fakultas</span></a></li>
        @endcan
        @can('view-jurusan')
        <li><a href="{{ route('admin.jurusan.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Jurusan</span></a></li>
        @endcan
        @can('view-prodi')
        <li><a href="{{ route('admin.prodi.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Program Studi</span></a></li>
        @endcan
        @can('view-jenjang')
        <li><a href="{{ route('admin.jenjang.index') }}"><span class="fa fa-archive"></span> <span class="xn-text">Jenjang Pendidikan</span></a></li>
        @endcan
        <li><a href="{{ route('admin.kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span><span class="xn-text">Kalender Akademik</span></a></li>
        <li><a href="{{ route('admin.pengumuman.index') }}"><span class="fa fa-calendar-o"></span><span class="xn-text">Pengumuman</span></a></li>
      </ul>
    </li>

    @can('view-keuangan')
    <li class="xn-title">Keuangan</li>
    <li class="xn-openable">
      <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Data Keuangan</span></a>
      <ul>
        <li><a href="{{route('admin.jenisbiaya.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Jenis Biaya</span></a></li>
        <li><a href="{{route('admin.biaya.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Komponen Biaya</span></a></li>
        <li><a href="{{route('admin.masterbiaya.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Master Biaya</span></a></li>
        <li><a href="{{route('admin.pengeluaran.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Pengeluaran</span></a></li>
        <li><a href="{{route('admin.pemasukan.index')}}"><span class="fa fa-archive"></span> <span class="xn-text">Data Pemasukan</span></a></li>
      </ul>
    </li>
    @endcan
    <li class="xn-title">BAAK</li>
    <li class="xn-openable">
      <a href="#"><span class="fa fa-user"></span> <span class="xn-text">Data Pengguna</span></a>
      <ul>
        @can('view-users')
        <li><a href="{{ route('admin.users.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Akun Pengguna</span></a></li>
        @endcan
        <!-- <li><a href="{{ route('admin.siswa.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Siswa</span></a></li> -->
        @can('view-mahasiswa')
        <li><a href="{{ route('admin.mahasiswa.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Mahasiswa</span></a></li>
        @endcan
        @can('view-dosen')
        <li><a href="{{ route('admin.dosen.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Dosen</span></a></li>
        @endcan
        @can('view-pegawai')
        <li><a href="{{ route('admin.datapegawai.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Kepegawaian</span></a></li>
        @endcan
        @can('view-orang-tua')
        <li><a href="{{ route('admin.dataorangtua.index') }}"><span class="fa fa-user"></span><span class="xn-text">Data Orang Tua</span></a></li>
        @endcan
        @can('view-kelas')
        <li><a href="{{ route('admin.kelas.index') }}"><span class="fa fa-user"></span><span class="xn-text">Kelas</sp    xan></a></li>
        @endcan
      </ul>
    </li>

    <li class="xn-openable">
      <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Kurikulum, KRS, KHS</span></a>
      <ul>
        <li>
          @can('view-kurikulum')
          <a href="{{ route('admin.kurikulum.index') }}"> <span class="fa fa-archive"> </span> <span class="xn-text">Kurikulum</span></a>
          @endcan
          @can('view-paket-krs')
          <a href="{{route('admin.paket.krs.index')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Paket KRS</span></a>
          @endcan
          @can('view-paket-semester-pendek')
          <a href="{{route('admin.paket.semesterpendek.index')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Paket Semester Pendek</span></a>
          @endcan
          @can('view-daftar-ulang')
          <a href="{{route('admin.daftarulang.pilih.tahun')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Data Daftar Ulang Mahasiswa</span></a>
          @endcan
          @can('view-krs')
          <a href="{{route('admin.krs.pilih.tahun')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Data Kartu Rencana Studi</span></a>
          @endcan
          @can('view-sp')
          <a href="{{route('admin.sp.pilih.tahun')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Data Semester Pendek</span></a>
          @endcan
          @can('view-khs')
          <a href="{{route('admin.khs.pilih.tahun')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Data Kartu Hasil Studi</span></a>
          @endcan
          @can('view-dosen')
          <a href="{{route('admin.pengampu.index')}}"> <span class="fa fa-archive"></span> <span class="xn-tex">Data Pengampu</span></a>
          @endcan
        </li>
      </ul>
      <ul></ul>
    </li>
    @can('view-materi-pelajaran')
    <li>
      <a href="{{ route('admin.materipelajaran.index') }}"><span class="fa fa-book"></span> <span class="xn-text">Materi Mata Kuliah Dosen</span></a>
    </li>
    @endcan
    @can('view-agenda')
    <li><a href="{{ route('admin.agendaguru.index') }}"><span class="fa fa-book"></span><span class="xn-text">Agenda Pelajaran</span></a></li>
    @endcan

    @can('view-mata-kuliah')
    <li class="xn-openable">
      <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Data Mata Kuliah</span></a>
      <ul>

        <li><a href="{{ route('admin.matakuliah.index') }}"><span class="xn-text">Mata Kuliah</span></a></li>
        <li><a href="{{ route('admin.modulmatkul.index') }}"><span class="xn-text">Modul Mata Kuliah</span></a></li>
        <li><a href="{{ route('admin.mataujian.index') }}"><span class="xn-text">Mata Ujian</span></a></li>
      </ul>
    </li>
    @endcan
    @can('view-jadwal-kelas')
    <li class="xn-openable">
      <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Jadwal</span></a>
      <ul>
        <li><a href="{{ route('admin.setting.waktu.hari.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Waktu dan Hari Perkuliahan</span></a></li>
        <li><a href="{{ route('admin.jadwal.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Dosen</span></a></li>
        @can('view-jadwal-pengganti')
        <li><a href="{{ route('admin.jadwal.pengganti.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Pengganti</span></a></li>
        @endcan
        @can('view-jadwal-ujian')
        <li>
          <a href="{{ route('admin.jadwalujian.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Ujian</span></a>
        </li>
        @endcan
        @can('view-jadwal-sp')
        <li>
          <a href="{{ route('admin.jadwalsp.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Semester Pendek</span></a>
        </li>
        @endcan
        <!-- <li><a href="{{ route('admin.jadwalpelajaransiswa.index') }}"><span class="xn-text">Jadwal Pelajaran Mahasiswa</span></a></li> -->
      </ul>
    </li>
    @endcan
    @can('view-soal')
    <li class="xn-openable">
      <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Bank Soal</span></a>
      <ul>
        <li><a href="{{ route('admin.kumpulansoal.index') }}"><span class="xn-text">Kumpulan Soal-Soal</span></a></li>
        <li><a href="{{ route('admin.evaluasisoal.index') }}"><span class="xn-text">Evaluasi Soal</span></a></li>
      </ul>
    </li>
    @endcan
    @can('view-nilai')
    <li class="xn-openable">
      <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Manajemen Nilai</span></a>
      <ul>
        <li><a href="{{route('admin.nilaitugas.index')}}"><span class="xn-text">Input Nilai Tugas</span></a></li>
      </ul>
    </li>
    @endcan
    @can(['view-absensi-dosen','view-absensi-mahasiswa'])
    <li class="xn-openable">
      <a href="#"><span class="fa fa-table"></span> <span class="xn-text">Absensi</span></a>
      <ul>
        @can('view-absensi-pegawai')
        <li><a href="{{ route('admin.absensi.pegawai') }}"><span class="xn-text">Absensi Pegawai</span></a></li>
        @endcan
        @can('view-absensi-dosen')
        <li><a href="{{ route('admin.absensi.dosen') }}"><span class="xn-text">Absensi Dosen</span></a></li>
        @endcan
        @can('view-absensi-mahasiswa')
        <li><a href="{{ route('admin.absensi.mahasiswa.prodi') }}"><span class="xn-text">Absensi Mahasiswa</span></a></li>
        @endcan
      </ul>
    </li>
    @endcan
    <!-- <li  class="xn-openable">
              <a href="#"><span class="fa fa-star"></span> <span class="xn-text">Nilai Rapor</span></a>
              <ul>
                  <li><a href="{{ route('admin.nilaisiswa.index') }}"><span class="xn-text">Nilai Siswa</span></a></li>
                  <li><a href="{{ route('admin.raporsiswa.index') }}"><span class="xn-text">Rapor Siswa</span></a></li>
                  <li><a href="{{ route('admin.kenaikankelas.index') }}"><span class="xn-text">Kenaikan Kelas</span></a></li>
              </ul>
            </li> -->
    <li>
      <a href="{{ route('admin.dataruangan.index') }}"><span class="fa fa-columns"></span> <span class="xn-text">Ruangan</span></a>
    </li>
    <li>
      <a href="{{ route('admin.pengaturan.index') }}"><span class="fa fa-gear"></span> Semester & Tahun Ajaran</a>
    </li>
    <li class="xn-openable">
      <a href="#"><span class="fa fa-gear"></span> <span class="xn-text">Config</span></a>
      <ul>
        <li><a href="{{ route('admin.transportasi.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Alat Transportasi</span></a></li>
        <li><a href="{{ route('admin.jenispendidikan.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Jenis Pendidikan</span></a></li>
        <li><a href="{{ route('admin.jenispekerjaan.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Jenis Pekerjaan</span></a></li>
        <li><a href="{{ route('admin.jenispenghasilan.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Jenis Penghasilan</span></a></li>
        <li><a href="{{ route('admin.jenistinggal.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Jenis Tinggal</span></a></li>
        <li><a href="{{ route('admin.kebutuhankhusus.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Kebutuhan Khusus</span></a></li>
        <li><a href="{{ route('admin.lembaga.index') }}"><span class="fa fa-gear"></span><span class="xn-text">List Lembaga</span></a></li>
        <li><a href="{{ route('admin.pangkatgolongan.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Pangkat / Golongan</span></a></li>
        <li><a href="{{ route('admin.statusmilik.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Status Milik</span></a></li>
      </ul>
    </li>
    @endrole



    @can('view-pegawai')
    <!-- <li class="xn-title">BAAK</li> -->
    <!-- <li class="">

                <a href="{{ route('pegawai.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>

            </li> -->
    @endcan

    @role('dosen')
    <li class="xn-title">Dosen</li>
    <li>
      <a href="{{ route('guru.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
    </li>

    @can('view-walikelas')
    <li class="xn-openable">
      <a href="#"><span class="glyphicon glyphicon-user"></span> <span class="xn-text">Wali Kelas</span></a>
      <ul>
        <li><a href="{{ route('guru.walikelas.datakelas.index') }}"><span class="xn-text">Data Siswa</span></a></li>
        <li><a href="{{ route('guru.walikelas.dataabsensi.index') }}"><span class="xn-text">Data Absensi</span></a></li>
        <li><a href="{{ route('guru.walikelas.datanilai.index') }}"><span class="xn-text">Data Nilai</span></a></li>
        <li><a href="{{ route('guru.walikelas.datarapor.index') }}"><span class="xn-text">Data Rapor</span></a></li>
      </ul>
    </li>
    @endcan

    <li><a href="{{ route('guru.Kalenderakademik.index') }}"><span class="fa fa-calendar-o"></span><span class="xn-text">Kalender Akademik</span></a></li>


    <li><a href="{{ route('guru.jadwalkelas.index') }}"><span class="fa fa-file-text-o"></span><span class="xn-text">Jadwal Kelas</span></a></li>


    <li><a href="{{ route('guru.materipelajaran.index') }}"><span class="fa fa-book"></span><span class="xn-text">Materi Pelajaran</span></a></li>


    <li><a href="{{ route('guru.agenda.index') }}"><span class="fa fa-book"></span><span class="xn-text">Agenda Pelajaran</span></a></li>


    <li class="xn-openable">
      <a href="#"><span class="fa fa-tasks"></span> <span class="xn-text">Data Tugas</span></a>
      <ul>
        <li><a href="{{ route('guru.tugas.index') }}"><span class="xn-text">Tugas</span></a></li>
        <li><a href="{{ route('guru.hasiltugas.index') }}"><span class="xn-text">Hasil Tugas</span></a></li>
      </ul>
    </li>
    <li class="xn-openable">
      <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Bank Soal</span></a>
      <ul>
        <li><a href="{{ route('guru.banksoal.index') }}"><span class="xn-text">Kumpulan Soal-Soal</span></a></li>
        <li><a href="{{ route('guru.evaluasisoal.index') }}"><span class="xn-text">Evaluasi Soal</span></a></li>
      </ul>
    </li>
    <li>
      <a href="{{ route('guru.jadwalujian.index') }}"><span class="fa fa-file-text"></span> <span class="xn-text">Jadwal Ujian</span></a>
    </li>
    <li class="xn-openable">
      <a href="#"><span class="fa fa-table"></span> <span class="xn-text">Absensi</span></a>
      <ul>

        <li><a href="{{ route('guru.absensi.dosen.index') }}"><span class="xn-text">Absensi Dosen</span></a></li>
        <li><a href="{{ route('guru.absensi.mahasiswa.kelas') }}"><span class="xn-text">Absensi Mahasiswa</span></a></li>
      </ul>
    </li>


    <li class="xn-openable">
      <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Input Nilai</span></a>
      <ul>
        <!-- <li><a href="{{ route('guru.bobotdankkm.index') }}"><span class="xn-text">Nilai Bobot dan KKM</span></a></li>
                  <li><a href="{{ route('guru.nilaiharian.index') }}"><span class="xn-text">Input Nilai Harian</span></a></li> -->
        <li><a href="{{ route('guru.nilaitugas.index') }}"><span class="xn-text">Input Nilai Tugas</span></a></li>
        <li><a href="{{ route('guru.pilih.matkul.khs') }}"><span class="xn-text">Input KHS</span></a></li>
        {{-- <li><a href="{{ route('guru.nilaiakhir.index') }}"><span class="xn-text">Input Nilai Akhir</span></a></li> --}}
      </ul>
    </li>

    <li><a href="{{ route('guru.chat.index') }}"><span class="fa fa-comment"></span><span class="xn-text">Chat</span></a></li>
    <li><a href="{{ route('guru.pengaturan.index') }}"><span class="fa fa-gear"></span><span class="xn-text">Pengaturan</span></a></li>

    @endrole
    @can('view-siswa')
    <li class="xn-title">Siswa</li>
    <li class="">
      <a href="{{ route('siswa.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
    </li>
    @endcan
    @role('mahasiswa')
    <li class="xn-title">Siswa</li>
    <li class="">
      <a href="{{ route('siswa.halamanutama.index') }}"><span class="fa fa-home"></span> <span class="xn-text">Halaman Utama</span></a>
    </li>
    @endrole
  </ul>
  <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->
