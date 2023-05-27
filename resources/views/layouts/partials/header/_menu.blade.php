<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
    data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
    data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
    data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
    data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <div class="menu menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
        id="kt_app_header_menu" data-kt-menu="true">
        @role('mahasiswa')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('siswa.halamanutama.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('student/halamanutama') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('siswa.kalenderakademik.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('student/kalenderakademik') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Kalendar Akademik</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-start">
                <a href="#"
                    class="menu-link border-3 border-bottom {{ request()->is('student/datapribadi*', 'student/khs', 'student/krs', 'student/sp') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Mahasiswa</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    <div class="menu-item">
                        <a href="{{ route('siswa.datapribadi.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Pribadi</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.khs.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Kartu Hasil Studi</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.krs.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Kartu Rencana Studi</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.sp.create') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Daftar Semester Pendek</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('siswa.materipelajaran.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('student/materipelajaran') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Materi Pelajaran</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-start">
                <a href="#"
                    class="menu-link border-3 border-bottom {{ request()->is('student/datatugas', 'student/datakuis') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Tugas Mahasiswa</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    <div class="menu-item">
                        <a href="{{ route('siswa.datatugas.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Tugas</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.datakuis.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Quiz</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('siswa.dataujian.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('student/dataujian') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Ujian</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('siswa.jadwalpelajaran.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('student/jadwalpelajaran') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Jadwal Kuliah</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-start">
                <a href="#"
                    class="menu-link border-3 border-bottom {{ request()->is('student/pembayaran', 'student/dataebook', 'student/databuku', 'student/dataskripsi', 'student/peminjamanbuku') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Lainnya</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    <div class="menu-item">
                        <a href="{{ route('siswa.pembayaran.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Pembayaran</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.dataebook.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">List E-Book</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.databuku.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">List Buku Perpustakan</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.dataskripsi.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">List Skripsi Perpustakan</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('siswa.peminjamanbuku.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Peminjaman Buku</span>
                        </a>
                    </div>
                </div>
            </div>
        @endrole

        @role('perpustakaan')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('perpustakaan.halamanutama.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('perpustakaan/halamanutama') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('perpustakaan.databuku.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('perpustakaan/databuku*') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Buku</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('perpustakaan.dataskripsi.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('perpustakaan/dataskripsi') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Skipsi</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('perpustakaan.transaksibuku.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('perpustakaan/transaksibuku') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Transaksi Buku</span>
                </a>
            </div>
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('perpustakaan.kondisibuku.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('perpustakaan/kondisibuku') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Info Kondisi Buku</span>
                </a>
            </div>
        @endrole

        @role('pegawai')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('pegawai.halamanutama.index') }}" class="menu-link border-3 border-bottom {{ request()->is('pegawai/halamanutama') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            @can('view-profil-pt')
                <div class="menu-item align-items-stretch mb-n1 mt-n1">
                    <a href="{{ route('pegawai.profilpt.index') }}" class="menu-link border-3 border-bottom {{ request()->is('pegawai/profilpt') ? 'border-primary active' : 'border-transparent' }}">
                        <span class="menu-title">Profil PT</span>
                    </a>
                </div>
            @endcan
            @canany(['manage-fakultas', 'manage-jurusan', 'manage-prodi', 'manage-jenjang'])
                <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-start">
                    <a href="#" class="menu-link border-3 border-bottom {{ request()->is('pegawai/fakultas', 'pegawai/jurusan', 'pegawai/prodi', 'pegawai/jenjang') ? 'border-primary active' : 'border-transparent' }}">
                        <span class="menu-title">Data PT</span>
                    </a>
                    <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                        @can('manage-fakultas')
                        <div class="menu-item">
                            <a href="{{ route('pegawai.fakultas.index') }}" class="menu-link px-1 py-3">
                                <span class="menu-title">Fakultas</span>
                            </a>
                        </div>
                        @endcan
                        @can('manage-jurusan')
                        <div class="menu-item">
                            <a href="{{ route('pegawai.jurusan.index') }}" class="menu-link px-1 py-3">
                                <span class="menu-title">Jurusan</span>
                            </a>
                        </div>
                        @endcan
                        @can('manage-prodi')
                        <div class="menu-item">
                            <a href="{{ route('pegawai.prodi.index') }}" class="menu-link px-1 py-3">
                                <span class="menu-title">Program Studi</span>
                            </a>
                        </div>
                        @endcan
                        @can('manage-jenjang')
                        <div class="menu-item">
                            <a href="{{ route('pegawai.jenjang.index') }}" class="menu-link px-1 py-3">
                                <span class="menu-title">Jenjang Pendidikan</span>
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
            @endcanany
            @can('manage-kelas')
                <div class="menu-item align-items-stretch mb-n1 mt-n1">
                    <a href="{{ route('pegawai.kelas.index') }}" class="menu-link border-3 border-bottom {{ request()->is('pegawai/kelas') ? 'border-primary active' : 'border-transparent' }}">
                        <span class="menu-title">Data Kelas</span>
                    </a>
                </div>
            @endcan
            @can('manage-kurikulum')
                <div class="menu-item align-items-stretch mb-n1 mt-n1">
                    <a href="{{ route('pegawai.kurikulum.index') }}"
                        class="menu-link border-3 border-bottom {{ request()->is('pegawai/kurikulum') ? 'border-primary active' : 'border-transparent' }}">
                        <span class="menu-title">Kurikulum</span>
                    </a>
                </div>
            @endcan
            @can('manage-pegawai')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('pegawai.datapegawai.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('pegawai/datapegawai*') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Pegawai</span>
                </a>
            </div>
            @endcan
            @can('manage-dosen')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('pegawai.dosen.index') }}"
                class="menu-link border-3 border-bottom {{ request()->is('pegawai/dosen*') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Dosen</span>
                </a>
            </div>
            @endcan
            @can('manage-mahasiswa')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('pegawai.mahasiswa.index') }}"
                    class="menu-link border-3 border-bottom {{ request()->is('pegawai/mahasiswa*') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Mahasiswa</span>
                </a>
            </div>
            @endcan
            @can('manage-jadwal-kelas')
            <div class="menu-item align-items-stretch mb-n1 mt-n1">
                <a href="{{ route('pegawai.jadwal.index') }}" class="menu-link border-3 border-bottom {{ request()->is('pegawai/jadwal') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Jadwal</span>
                </a>
            </div>
            @endcan
            @can('view-keuangan')
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-start">
                <a href="#" class="menu-link border-3 border-bottom {{ request()->is('pegawai/biaya', 'pegawai/pengeluaran', 'pegawai/pemasukan', 'pegawai/pembayaran') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Keuangan</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    <div class="menu-item">
                        <a href="{{route('pegawai.biaya.index')}}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Biaya</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('pegawai.pengeluaran.index')}}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Pengeluaran</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('pegawai.pemasukan.index')}}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Pemasukan</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('pegawai.pembayaran.index')}}" class="menu-link px-1 py-3">
                            <span class="menu-title">Data Pembayaran</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view-keuangan')
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-start">
                <a href="#" class="menu-link border-3 border-bottom {{ request()->is('pegawai/matakuliah', 'pegawai/modulmatkul', 'pegawai/materipelajaran') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Data Mata Kuliah</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    @can('view-mata-kuliah')
                    <div class="menu-item">
                        <a href="{{ route('pegawai.matakuliah.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Mata Kuliah</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('pegawai.modulmatkul.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Modul Mata Kuliah</span>
                        </a>
                    </div>
                    @endcan
                    @can('manage-materi-pelajaran')
                    <div class="menu-item">
                        <a href="{{ route('pegawai.materipelajaran.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Materi Pelajaran</span>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
            @endcan
            @can('manage-soal')
            <div class="menu-item align-items-stretch mb-n1 mt-n1" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-start">
                <a href="#" class="menu-link border-3 border-bottom {{ request()->is('pegawai/kumpulansoal', 'pegawai/evaluasisoal') ? 'border-primary active' : 'border-transparent' }}">
                    <span class="menu-title">Bank Soal</span>
                </a>
                <div class="menu-sub menu-sub-dropdown p-3 w-200px">
                    <div class="menu-item">
                        <a href="{{ route('pegawai.kumpulansoal.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Kumpulan Soal-Soal</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{ route('pegawai.evaluasisoal.index') }}" class="menu-link px-1 py-3">
                            <span class="menu-title">Evaluasi Soal</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcan
        @endrole
    </div>
</div>
