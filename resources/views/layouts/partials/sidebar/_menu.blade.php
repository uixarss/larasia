<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
            @role('admin')
                <!-- BEGIN PROFIL PT -->
                <div class="menu-item">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Profil Perguruan Tinggi</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/halamanutama') ? 'active' : '' }}"
                        href="{{ route('admin.halamanutama.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-grid fs-3"></i>
                        </span>
                        <span class="menu-title">Halaman Utama</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('admin/profilpt', 'admin/pimpinan', 'admin/fakultas*', 'admin/jurusan*', 'admin/prodi*', 'admin/jenjang', 'admin/kalenderakademik', 'admin/pengumuman') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-house-gear fs-3"></i>
                        </span>
                        <span class="menu-title">Setting Kampus</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('view-profil-pt')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/profilpt') ? 'active' : '' }}"
                                    href="{{ route('admin.profilpt.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Profil PT</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/pimpinan') ? 'active' : '' }}"
                                    href="{{ route('admin.pimpinan.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pimpinan PT</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-fakultas')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/fakultas*') ? 'active' : '' }}"
                                    href="{{ route('admin.fakultas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Fakultas</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-jurusan')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/jurusan*') ? 'active' : '' }}"
                                    href="{{ route('admin.jurusan.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jurusan</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-prodi')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/prodi*') ? 'active' : '' }}"
                                    href="{{ route('admin.prodi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Program Studi</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-jenjang')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/jenjang') ? 'active' : '' }}""
                                    href="{{ route('admin.jenjang.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jenjang Pendidikan</span>
                                </a>
                            </div>
                        @endcan
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/kalenderakademik') ? 'active' : '' }}"
                                href="{{ route('admin.kalenderakademik.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Kalender Akademik</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/pengumuman') ? 'active' : '' }}"
                                href="{{ route('admin.pengumuman.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END PROFIL PT -->

                <!-- BEGIN KEUANGAN -->
                @can('view-keuangan')
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Keuangan</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/jenisbiaya', 'admin/biaya', 'admin/masterbiaya', 'admin/pengeluaran*', 'admin/pemasukan*') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-wallet fs-3"></i>
                            </span>
                            <span class="menu-title">Data Keuangan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/jenisbiaya') ? 'active' : '' }}"
                                    href="{{ route('admin.jenisbiaya.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jenis Biaya</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/biaya') ? 'active' : '' }}"
                                    href="{{ route('admin.biaya.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Komponen Biaya</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/masterbiaya') ? 'active' : '' }}"
                                    href="{{ route('admin.masterbiaya.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Master Biaya</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/pengeluaran*') ? 'active' : '' }}"
                                    href="{{ route('admin.pengeluaran.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pengeluaran</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/pemasukan*') ? 'active' : '' }}"
                                    href="{{ route('admin.pemasukan.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pemasukan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                <!-- END KEUANGAN -->

                <!-- BEGIN BAAK -->
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">BAAK</span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('admin/users', 'admin/mahasiswa*', 'admin/dosen*', 'admin/datapegawai*', 'admin/kelas') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-people fs-3"></i>
                        </span>
                        <span class="menu-title">Data Pengguna</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('view-users')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/users') ? 'active' : '' }}"
                                    href="{{ route('admin.users.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Akun Pengguna</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-mahasiswa')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/mahasiswa*') ? 'active' : '' }}"
                                    href="{{ route('admin.mahasiswa.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Mahasiswa</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-dosen')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/dosen*') ? 'active' : '' }}"
                                    href="{{ route('admin.dosen.index') }}"">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dosen</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-pegawai')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/datapegawai*') ? 'active' : '' }}"
                                    href="{{ route('admin.datapegawai.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kepegawaian</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-orang-tua')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/dataorangtua') ? 'active' : '' }}"
                                    href="{{ route('admin.dataorangtua.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Orang Tua</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-kelas')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/kelas') ? 'active' : '' }}"
                                    href="{{ route('admin.kelas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kelas</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('admin/kurikulum*', 'admin/pengampu*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-file-text fs-3"></i>
                        </span>
                        <span class="menu-title">Kurikulum, KRS, KHS</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('view-kurikulum')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/kurikulum*') ? 'active' : '' }}"
                                    href="{{ route('admin.kurikulum.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kurikulum</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-paket-krs')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.paket.krs.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kurikulum</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-paket-semester-pendek')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.paket.semesterpendek.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Paket Semester Pendek</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-daftar-ulang')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.daftarulang.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Daftar Ulang Mahasiswa</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-krs')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.krs.pilih.tahun') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Kartu Rencana Studi</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-sp')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.sp.pilih.tahun') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Semester Pendek</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-khs')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.khs.pilih.tahun') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Kartu Hasil Studi</span>
                                </a>
                            </div>
                        @endcan
                        @can('view-dosen')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/pengampu*') ? 'active' : '' }}"
                                    href="{{ route('admin.pengampu.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Pengampu</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                @can('view-materi-pelajaran')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/materipelajaran*') ? 'active' : '' }}"
                            href="{{ route('admin.materipelajaran.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-journal-bookmark fs-3"></i>
                            </span>
                            <span class="menu-title">Materi Mata Kuliah Dosen</span>
                        </a>
                    </div>
                @endcan
                @can('view-agenda')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/agendaguru*') ? 'active' : '' }}"
                            href="{{ route('admin.agendaguru.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-calendar-event fs-3"></i>
                            </span>
                            <span class="menu-title">Agenda Pelajaran</span>
                        </a>
                    </div>
                @endcan
                @can('view-mata-kuliah')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/matakuliah', 'admin/modulmatkul', 'admin/mataujian') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-book fs-3"></i>
                            </span>
                            <span class="menu-title">Data Mata Kuliah</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/matakuliah') ? 'active' : '' }}"
                                    href="{{ route('admin.matakuliah.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Mata Kuliah</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/modulmatkul') ? 'active' : '' }}"
                                    href="{{ route('admin.modulmatkul.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Modul Mata Kuliah</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/mataujian') ? 'active' : '' }}"
                                    href="{{ route('admin.mataujian.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Mata Ujian</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('view-jadwal-kelas')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/settingwaktuhari', 'admin/jadwal', 'admin/jadwal/pengganti', 'admin/jadwalujian*') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-clock fs-3"></i>
                            </span>
                            <span class="menu-title">Jadwal</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/settingwaktuhari') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.waktu.hari.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Waktu & Hari Perkuliah</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/jadwal') ? 'active' : '' }}"
                                    href="{{ route('admin.jadwal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jadwal Dosen</span>
                                </a>
                            </div>
                            @can('view-jadwal-pengganti')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/jadwal/pengganti') ? 'active' : '' }}"
                                        href="{{ route('admin.jadwal.pengganti.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Jadwal Pengganti</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view-jadwal-ujian')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/jadwalujian*') ? 'active' : '' }}"
                                        href="{{ route('admin.jadwalujian.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Jadwal Ujian</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view-jadwal-sp')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/jadwalsp') ? 'active' : '' }}"
                                        href="{{ route('admin.jadwalsp.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Jadwal Semester Pendek</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan
                @can('view-soal')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/kumpulansoal*', 'admin/evaluasisoal') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-archive fs-3"></i>
                            </span>
                            <span class="menu-title">Bank Soal</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/kumpulansoal*') ? 'active' : '' }}"
                                    href="{{ route('admin.kumpulansoal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kumpulan Soal-soal</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/evaluasisoal') ? 'active' : '' }}"
                                    href="{{ route('admin.evaluasisoal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Evaluasi Soal</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('view-nilai')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/nilaitugas*') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-journal-check fs-3"></i>
                            </span>
                            <span class="menu-title">Manajemen Nilai</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('admin/nilaitugas*') ? 'active' : '' }}"
                                    href="{{ route('admin.nilaitugas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Input Nilai Tugas Kuliah</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can(['view-absensi-dosen', 'view-absensi-mahasiswa'])
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/absensi/pegawai*', 'admin/absensi/dosen*', 'admin/absensi/prodi*') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-check2-square fs-3"></i>
                            </span>
                            <span class="menu-title">Absensi</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('view-absensi-pegawai')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/absensi/pegawai*') ? 'active' : '' }}"
                                        href="{{ route('admin.absensi.pegawai') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Absensi Pegawai</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view-absensi-dosen')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/absensi/dosen*') ? 'active' : '' }}"
                                        href="{{ route('admin.absensi.dosen') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Dosen</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view-absensi-mahasiswa')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/absensi/prodi*') ? 'active' : '' }}"
                                        href="{{ route('admin.absensi.mahasiswa.prodi') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Mahasiswa</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/dataruangan') ? 'active' : '' }}"
                        href="{{ route('admin.dataruangan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-house fs-3"></i>
                        </span>
                        <span class="menu-title">Ruangan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/pengaturan') ? 'active' : '' }}"
                        href="{{ route('admin.pengaturan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-calendar2 fs-3"></i>
                        </span>
                        <span class="menu-title">Semester & Tahun Ajaran</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('admin/transportasi', 'admin/jenispendidikan', 'admin/jenispekerjaan', 'admin/jenispenghasilan', 'admin/jenistinggal', 'admin/kebutuhankhusus', 'admin/lembaga', 'admin/pangkatgolongan', 'admin/statusmilik') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-gear fs-3"></i>
                        </span>
                        <span class="menu-title">Config</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/transportasi') ? 'active' : '' }}"
                                href="{{ route('admin.transportasi.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Alat Transportasi</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/jenispendidikan') ? 'active' : '' }}"
                                href="{{ route('admin.jenispendidikan.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Jenis Pendidikan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/jenispekerjaan') ? 'active' : '' }}"
                                href="{{ route('admin.jenispekerjaan.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Jenis Pekerjaan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/jenispenghasilan') ? 'active' : '' }}"
                                href="{{ route('admin.jenispenghasilan.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Jenis Penghasilan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/jenistinggal') ? 'active' : '' }}"
                                href="{{ route('admin.jenistinggal.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Jenis Tinggal</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/kebutuhankhusus') ? 'active' : '' }}""
                                href="{{ route('admin.kebutuhankhusus.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Kebutuhan Khusus</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/lembaga') ? 'active' : '' }}"
                                href="{{ route('admin.lembaga.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Lembaga</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/pangkatgolongan') ? 'active' : '' }}"
                                href="{{ route('admin.pangkatgolongan.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pangkat Golongan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('admin/statusmilik') ? 'active' : '' }}"
                                href="{{ route('admin.statusmilik.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Status Milik</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END BAAK -->
            @endrole

            @role('dosen')
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/halamanutama') ? 'active' : '' }}"
                        href="{{ route('guru.halamanutama.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-grid fs-3"></i>
                        </span>
                        <span class="menu-title">Halaman Utama</span>
                    </a>
                </div>
                @can('view-walikelas')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('dosen/datakelas', 'dosen/dataabsensi', 'dosen/datanilai', 'dosen/datarapor') ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-house-gear fs-3"></i>
                            </span>
                            <span class="menu-title">Wali Kelas</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('dosen/datakelas') ? 'active' : '' }}"
                                    href="{{ route('guru.walikelas.datakelas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Siswa</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('dosen/dataabsensi') ? 'active' : '' }}"
                                    href="{{ route('guru.walikelas.dataabsensi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Absensi</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('dosen/datanilai') ? 'active' : '' }}"
                                    href="{{ route('guru.walikelas.datanilai.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Nilai</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('dosen/datarapor') ? 'active' : '' }}"
                                    href="{{ route('guru.walikelas.datarapor.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rapor</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/Kalenderakademik') ? 'active' : '' }}"
                        href="{{ route('guru.Kalenderakademik.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-calendar-week fs-3"></i>
                        </span>
                        <span class="menu-title">Kalendar Akademik</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/jadwalkelas', 'dosen/absensi/siswa*', 'dosen/pengumuman/kelas*', 'dosen/absensipengganti/siswa*', 'dosen/absensisp/siswa*', 'dosen/pengumuman/update') ? 'active' : '' }}"
                        href="{{ route('guru.jadwalkelas.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-calendar-check fs-3"></i>
                        </span>
                        <span class="menu-title">Jadwal Kelas</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/materipelajaran') ? 'active' : '' }}"
                        href="{{ route('guru.materipelajaran.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journal-bookmark fs-3"></i>
                        </span>
                        <span class="menu-title">Materi Pelajaran</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/agenda*') ? 'active' : '' }}"
                        href="{{ route('guru.agenda.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-clock-history fs-3"></i>
                        </span>
                        <span class="menu-title">Agenda Pelajaran</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('dosen/tugas', 'dosen/hasiltugas') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-pencil-square fs-3"></i>
                        </span>
                        <span class="menu-title">Data Tugas</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/tugas') ? 'active' : '' }}"
                                href="{{ route('guru.tugas.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tugas</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/hasiltugas') ? 'active' : '' }}"
                                href="{{ route('guru.hasiltugas.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Hasil Tugas</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('dosen/banksoal*', 'dosen/evaluasisoal*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-journals fs-3"></i>
                        </span>
                        <span class="menu-title">Bank Soal</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/banksoal*') ? 'active' : '' }}"
                                href="{{ route('guru.banksoal.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Kumpulan Soal-soal</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/evaluasisoal*') ? 'active' : '' }}"
                                href="{{ route('guru.evaluasisoal.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Evaluasi Soal</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/jadwalujian*') ? 'active' : '' }}"
                        href="{{ route('guru.jadwalujian.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-calendar2-event fs-3"></i>
                        </span>
                        <span class="menu-title">Jadwal Ujian</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('dosen/absensi/dosen', 'dosen/absensi/kelas*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-check2-square fs-3"></i>
                        </span>
                        <span class="menu-title">Absensi</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/absensi/dosen') ? 'active' : '' }}"
                                href="{{ route('guru.absensi.dosen.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dosen</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/absensi/kelas*') ? 'active' : '' }}"
                                href="{{ route('guru.absensi.mahasiswa.kelas') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Mahasiswa</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('dosen/nilaitugas*', 'dosen/khs/matakuliah*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard-check fs-3"></i>
                        </span>
                        <span class="menu-title">Input</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/nilaitugas*') ? 'active' : '' }}"
                                href="{{ route('guru.nilaitugas.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Nilai Tugas</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('dosen/khs/matakuliah*') ? 'active' : '' }}"
                                href="{{ route('guru.pilih.matkul.khs') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">KHS</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="menu-item">
                    <a class="menu-link {{ request()->is('dosen/chat') ? 'active' : '' }}"
                        href="{{ route('guru.chat.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-chat-left-dots fs-3"></i>
                        </span>
                        <span class="menu-title">Chat</span>
                    </a>
                </div> --}}
            @endrole
        </div>
    </div>
</div>
