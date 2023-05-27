<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * URL API untuk Siswa
 * http://localhost/sim/public/api/siswa/method
 *
 */
Route::group(['prefix' => 'siswa'], function () {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::post('refresh', 'API\UserController@userRefreshToken');

    Route::group(['middleware' => ['auth:api']], function () {
        /**
         * Logout dari sistem
         */
        Route::get('logout', 'API\UserController@logout');
        /**
         * Profil Pribadi Siswa
         */
        Route::get('userDetail', 'API\UserController@getUserDetail');
        Route::post('updatePassword', 'API\UserController@updatePassword');
        Route::post('update/profil', 'API\UserController@updateProfileSiswa');
        Route::post('update/photo', 'API\UserController@updateAvatareSiswa');


        /**
         * Kuis
         *
         */
        Route::get('getAllSoal', 'API\QuizController@getAllSoal');
        Route::get('getSoal/{kode_soal}', 'API\QuizController@getSoal');
        Route::post('kuis/{kode_soal}/jawab', 'API\QuizController@jawab');
        Route::get('kuis/{kode_soal}/ambilJawaban', 'API\QuizController@ambilJawaban');
        Route::post('kuis/{kode_soal}/simpanHasilJawaban', 'API\QuizController@simpanHasilJawaban');
        Route::post('kuis/check/{kode_soal}', 'API\QuizController@checkQuiz');



        /**
         *
         * Daftar Tugas dan Kuis Siswa
         */

        Route::get('tugas', 'API\TugasController@list');
        Route::get('upload/tugas/list', 'API\TugasController@listUpload');
        Route::post('upload/tugas/{id}', 'API\TugasController@upload');
        Route::get('download/{tugas_id}', 'API\TugasController@download');

        /**
         * Pembayaran
         *
         */
        Route::get('getPembayaran', 'API\PembayaranController@getPembayaran');

        /**
         *
         * Absensi
         *
         */
        
        Route::get('getAbsensiMahasiswa/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@getAbsensiMahasiswaPribadi');

        Route::get('getAbsensi/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@getAbsensiSiswaPribadi');
        Route::post('absen', 'API\AbsensiController@absensiSiswa');

        Route::get('listAbsensi', 'API\AbsensiController@getAbsensiMahasiswa');
        Route::post('absen/masuk', 'API\AbsensiController@absenMasukMahasiswa');
        Route::post('absen/keluar', 'API\AbsensiController@absenKeluarMahasiswa');

        /**
         * Kalender Akademik
         *
         */
        Route::get('kalender', 'API\KalenderAkademikController@list');
        Route::get('pengumuman', 'API\KalenderAkademikController@listPengumuman');

        /**
         * Jadwal Pelajaran Siswa
         *
         */
        Route::get('jadwal', 'API\JadwalPelajaranController@list');

        /**
         * Chatting
         *
         * aktivasi websocket di terminal
         * php artisan websockets:serve
         */
        Route::get('/message/{id}', 'API\ChatController@getMessage');
        Route::post('message', 'API\ChatController@sendMessage');
        Route::post('message/listGurus', 'API\ChatController@listGuru');

        /**
         *
         * Rapor Siswa
         *
         */
        Route::get('rapor/list', 'API\RaporController@listRapor');
        Route::post('rapor/siswa/list', 'API\RaporController@listRaporSiswa');


        /**
         * Data nilai
         *
         */
        Route::get('list/guru', 'API\RaporController@listGuru');
        Route::get('data/nilai/{guru_id}/detail', 'API\RaporController@listNilai');

        /**
         * Data perpus
         *
         */
        Route::get('list/buku','API\PerpustakaanController@listBuku');

        //Data Nilai

        Route::get('nilai/matkul','API\DataNilaiController@getMatkul');
        Route::post('nilai/matkul/tugas','API\DataNilaiController@getNilaiTugas');
        Route::post('nilai/matkul/kuis','API\DataNilaiController@getNilaiKuis');
        Route::post('nilai/matkul/uts','API\DataNilaiController@getNilaiUTS');
        Route::post('nilai/matkul/uas','API\DataNilaiController@getNilaiUAS');

        /**
         * KHS Mahasiswa
         */
        
        Route::get('khs', 'API\KHSController@index');
        Route::post('khs/nilai', 'API\KHSController@getKHS');
    });
});

/**
 * URL API untuk Orang Tua
 * http://localhost/sim/public/api/ortu/method
 *
 */
Route::group(['prefix' => 'ortu'], function () {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::post('refresh', 'API\UserController@userRefreshToken');

    Route::group(['middleware' => 'auth:api'], function () {
        /**
         * Logout dari sistem
         */
        Route::get('logout', 'API\UserController@logout');

        /**
         * Profil Pribadi Ortu Siswa
         */
        Route::get('userDetail', 'API\UserController@getOrtuProfile');
        Route::post('updatePassword', 'API\UserController@updatePassword');
        Route::get('data/siswa', 'API\UserController@dataSiswa');

        /**
         * Pembayaran
         *
         */
        Route::get('getPembayaran', 'API\PembayaranController@ortuGetPembayaran');

        /**
         *
         * Daftar Tugas dan Kuis Siswa untuk Ortu
         */

        Route::get('tugas', 'API\TugasController@listByOrtu');

        /**
         * Absensi
         *
         */
        Route::get('getAbsensi/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@ortuGetAbsensiSiswaPribadi');


        /**
         * Jadwal Pelajaran Siswa
         *
         */
        Route::get('jadwal', 'API\JadwalPelajaranController@listOrtu');

        /**
         * Kalender Akademik
         *
         */
        Route::get('kalender', 'API\KalenderAkademikController@list');
        Route::get('pengumuman', 'API\KalenderAkademikController@listPengumuman');

        /**
         * Chatting
         *
         * aktivasi websocket di terminal
         * php artisan websockets:serve
         */
        Route::get('/message/{id}', 'API\ChatController@getMessage');
        Route::post('message', 'API\ChatController@sendMessage');
        Route::post('/message/list/guru', 'API\ChatController@listGuru');

        /**
         *
         * Rapor Siswa dari ortu
         *
         */
        Route::get('rapor/list', 'API\RaporController@ortulistRapor');
        Route::post('rapor/siswa/list', 'API\RaporController@ortulistRaporSiswa');

        /**
         * Data nilai
         *
         */
        Route::get('list/guru', 'API\RaporController@listGuru');
        Route::get('data/nilai/{guru_id}/detail', 'API\RaporController@ortulistNilai');
    });
});



/**
 * URL API untuk Guru
 * http://localhost/sim/public/api/guru/method
 *
 */
Route::group(['prefix' => 'guru'], function () {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::post('refresh', 'API\UserController@userRefreshToken');

    Route::group(['middleware' => 'auth:api'], function () {
        /**
         * Logout dari sistem
         */
        Route::get('logout', 'API\UserController@logout');

        /**
         * Profil Pribadi Guru
         */
        Route::get('profile', 'API\UserController@profileGuru');
        Route::post('updatePassword', 'API\UserController@updatePassword');
        Route::post('update/photo', 'API\UserController@updateAvatareGuru');

        /**
         * Pembayaran
         *
         */
        Route::get('getPembayaran', 'API\PembayaranController@ortuGetPembayaran');

        /**
         *
         * Daftar Upload Tugas Siswa
         */

        Route::get('tugas/{siswa_id}', 'API\TugasController@uploadBySiswa');

        /**
         * Absensi Guru
         *
         */

         //Baru
         Route::get('getAbsensi', 'API\AbsensiController@getListAbsensiDosen');
         Route::post('absensi/dosen/masuk', 'API\AbsensiController@dosenAbsenMasuk');
         Route::post('absensi/dosen/keluar', 'API\AbsensiController@dosenAbsenKeluar');
         Route::get('getAbsensiDosen/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@getAbsensiDosen');
      

         //Lama
        Route::get('getAbsensi/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@getAbsensiGuru');
        Route::post('absen', 'API\AbsensiController@absensiGuru');
        Route::get('list/kelas','API\AbsensiController@listKelas');
        Route::post('absensi/kelas/{kelas_id}','API\AbsensiController@absensiKelas');

        /**
         * Jadwal Pelajaran Guru
         *
         */
        Route::get('jadwal', 'API\JadwalPelajaranController@listGuru');


        /**
         * Kalender Akademik dan Pengumuman
         *
         */
        Route::get('kalender', 'API\KalenderAkademikController@list');
        Route::get('pengumuman', 'API\KalenderAkademikController@listPengumuman');


        /**
         * Daftar kelas dan siswanya
         *
         */
        Route::get('kelas', 'API\TugasController@listKelasGuru');

        /**
         * Chatting
         * aktivasi websocket di terminal
         * php artisan websockets:serve
         */
        Route::get('/message/{id}', 'API\ChatController@getMessage'); //list percakapan
        Route::post('message', 'API\ChatController@sendMessage'); //kirim pesan

        Route::post('/message/list/siswa', 'API\ChatController@listSiswa'); //list siswa
        Route::post('/message/list/ortu/siswa', 'API\ChatController@listOrtuSiswa');


        /**
         * Agenda
         *
         */
        Route::get('agenda/listTahunSemester', 'API\AgendaController@listTahunSemester');
        Route::post('agenda/listTahunSemester/prodi', 'API\AgendaController@listProdi');
        Route::post('agenda/list', 'API\AgendaController@listAgenda');
        Route::post('agenda/get/tahun', 'API\AgendaController@getTahunAjaran');
        Route::post('agenda/get/matkul', 'API\AgendaController@getMatkul');
        Route::post('agenda/get/semester', 'API\AgendaController@getSemester');
        Route::get('agenda/detail/list/{agenda_id}', 'API\AgendaController@listAgendaDetail');
        Route::get('agenda/detail/list/{agenda_detail_id}/siswa', 'API\AgendaController@listAgendaDetailSiswa');
        Route::get('agenda/list/kelas', 'API\AgendaController@listKelas');
        Route::post('agenda/list/siswa','API\AgendaController@listSiswa');


        Route::post('agenda/create', 'API\AgendaController@createAgenda');
        Route::post('agenda/update/{id}', 'API\AgendaController@updateAgenda');
        Route::post('agenda/create/{id}/detail', 'API\AgendaController@storeDetail');
        Route::post('agenda/update/{id_detail}/detail', 'API\AgendaController@updateDetail');
        Route::post('agenda/create/{id_detail}/detail/siswa', 'API\AgendaController@storeDetailSiswa');
        Route::post('agenda/update/{id_detail_siswa}/detail/siswa', 'API\AgendaController@updateDetailSiswa');

        /**
         * Laporan kuis
         * 1. Pilih kuis
         * 2. Pilih kelas
         * 3. Detail kuis - kelas (sudah / belum mengerjakan)
         */
        Route::get('laporan/kuis','API\QuizController@listKuis');
        Route::get('laporan/kuis/{kode_soal}/kelas', 'API\QuizController@listKuisKelas');
        Route::post('laporan/kuis/{kode_soal}/kelas/{kode_kelas}','API\QuizController@detailKuisKelas');




        /**
         * Tugas Siswa
         * 1. Pilih tugas
         * 2. Pilih kelas
         * 3. Detail tugas - kelas (sudah / belum mengerjakan)
         */
        Route::get('laporan/tugas', 'API\TugasController@listTugas');
        Route::get('laporan/tugas/{id_tugas}/kelas','API\TugasController@listTugasKelas');
        Route::post('laporan/tugas/{id_tugas}/kelas/{kode_kelas}', 'API\TugasController@detailTugasKelas');

        /**
         * Nilai Siswa
         * 1. Pilih kelas
         * 2. Pilih siswa
         * 3. Detail nilai siswa
         *
         */

        Route::get('laporan/nilai/kelas', 'API\RaporController@listNilaiKelas');
        Route::get('laporan/nilai/kelas/{kelas_id}','API\RaporController@listSiswaKelas');
        Route::get('laporan/nilai/siswa/{siswa_id}','API\RaporController@listNilaiSiswa');

        //Absensi Mahasiswa

        Route::get('absenlist', 'API\AbsensiController@getAllAbsensiMahasiswa');
        Route::post('absenlist/mahasiswa', 'API\AbsensiController@getAllMahasiswa');

        /**
         * Nilai Tugas Mahasiswa
         */

        Route::get('nilai/matakuliah','API\NilaiTugasController@getMatkul');
        Route::post('nilai/matakuliah/kelas','API\NilaiTugasController@getKelas');
        Route::post('nilai/matakuliah/kelas/tugas','API\NilaiTugasController@getTugas');
        Route::post('nilai/matakuliah/kelas/tugas/mahasiswa','API\NilaiTugasController@getMahasiswa');
        Route::post('nilai/simpan', 'API\NilaiTugasController@store');
        Route::post('nilai/update', 'API\NilaiTugasController@update');


    });
});



/**
 * URL API untuk perpus
 *
 */
Route::group(['prefix' => 'perpus'], function(){
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::post('refresh', 'API\UserController@userRefreshToken');

    Route::group(['middleware' => 'auth:api'], function () {
        /**
         * Logout dari sistem
         */
        Route::get('logout', 'API\UserController@logout');

        /**
         * Profil Pribadi Pegawai
         */
        Route::get('profile', 'API\UserController@profilePegawai');
        Route::post('updatePassword', 'API\UserController@updatePassword');


        /**
         * Kalender Akademik dan Pengumuman
         *
         */
        Route::get('kalender', 'API\KalenderAkademikController@list');
        Route::get('pengumuman', 'API\KalenderAkademikController@listPengumuman');


        /**
         * Absensi 
         * 
         */
        Route::get('getAbsensi/{tanggal_awal}/{tanggal_akhir}', 'API\AbsensiController@getAbsensiPerpus');
        Route::post('absen', 'API\AbsensiController@absensiPerpus');


        /**
         * List Kategori, Kondisi
         * dan Distributor
         *
         */
        Route::get('list/kategori','API\PerpustakaanController@listKategori');
        Route::get('list/distributor','API\PerpustakaanController@listDistributor');
        Route::get('list/kondisi','API\PerpustakaanController@listKondisi');

        /**
         * CRUD Data Buku
         *
         */
        Route::get('list/buku','API\PerpustakaanController@listBukuPerpus');
        Route::get('list/buku/{buku_id}/detail','API\PerpustakaanController@listBukuDetail');
        Route::post('data/buku/create','API\PerpustakaanController@createBuku');
        Route::post('data/buku/{buku_id}/add','API\PerpustakaanController@addBuku');

        // List siswa
        Route::get('list/siswa','API\PerpustakaanController@listSiswa');

        /**
         * Peminjaman dan Pengembalian
         *
         */
        Route::get('list/peminjaman','API\PerpustakaanController@listPeminjaman');
        Route::post('pinjam/buku','API\PerpustakaanController@pinjamBuku');
        Route::post('pengembalian/{id}','API\PerpustakaanController@kembaliBuku');
        Route::get('list/pengembalian','API\PerpustakaanController@listPengembalian');

        /**
         * Info kondisi
         * Buku
         */
        Route::get('list/kondisi/buku','API\PerpustakaanController@listKondisiBuku');
        Route::post('add/kondisi/buku','API\PerpustakaanController@addKondisiBuku');


        // Dashboard perpus
        Route::get('dashboard','API\PerpustakaanController@dashboardPerpus');

    });
});
