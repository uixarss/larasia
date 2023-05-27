<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);


// Route::get('/', function () {
//   return view('welcome');
// });
Route::get('/', 'HomeController@index');
// Route::get('/pendidikan', function () {
//   return view('pendidikan');
// });

// Route::get('/tentang', function () {
//   return view('tentang');
// });

Route::get('/dataJumlahKelas/{tingkat}', 'Admin\DashboardAdminController@dataJumlahKelas');



Route::get('/load-events', 'EventController@loadEvents')->name('routeLoadEvents');
Route::put('/update-events', 'EventController@update')->name('routeUpdateEvents');
Route::post('/store-events', 'EventController@store')->name('routeStoreEvents');
Route::delete('/destroy-events', 'EventController@destroy')->name('routeDeleteEvents');

Route::delete('/destroy-list-remainder', 'ListRemainderController@destroy')->name('routeDeleteListRemainder');

Route::put('/update-list-remainder', 'ListRemainderController@update')->name('routeUpdateListRemainder');
Route::post('/store-list-remainder', 'ListRemainderController@store')->name('routeStoreListRemainder');

Route::get('guest', 'DataSiswaController@index')->name('guest');
Route::get('get_jadwal', 'DataSiswaController@get_jadwal');


Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/dashboard', 'Admin\DashboardAdminController@index');



  Route::get('/admin/jadwal/detailjadwalguru', 'Admin\JadwalPelajaranGuruController@detailjadwalguru');


  Route::get('/dosen/halamanutama/absensi', 'Guru\DashboardGuruController@absensi');
  Route::get('/dosen/evaluasisoal/detailevaluasi', 'Guru\EvaluasiSoalController@detailevaluasi');
  Route::get('/dosen/inputnilaiharian/inputnilai/{{id}}', 'Guru\NilaiHarianController@inputnilai');
  Route::get('/dosen/inputnilaiakhir/inputnilai', 'Guru\NilaiAkhirController@inputnilai');



  Route::get('/student/dataabsensi/detaildataabsensi', 'Siswa\DataAbsensiController@detaildataabsensi');

  Route::get('/student/datakuis/nilaikuis', 'Siswa\DataKuisController@nilaikuis');

  Route::get('/{id}/dokumen/', 'Guru\MateriPelajaranController@download')->name('unduh.dokumen');
  Route::get('/{id}/ebook/', 'Perpustakaan\DataBukuController@download')->name('unduh.ebook');

  Route::get('{path_ebook}', 'Perpustakaan\DataBukuController@download')->name('download.ebook');
  Route::get('{path}', 'Guru\MateriPelajaranController@download')->name('download.dokumen');

  Route::get('{path_tugas}', 'Guru\DataTugasController@unduh')->name('download.tugas');

  Route::get('{id}/download', 'Siswa\DataTugasController@unduh')->name('tugas.download');
});






/**
 * Route Admin
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {

  // Route::get('/dashboard','UsersController@dashboard')->name('dashboard');

  Route::get('/dashboard', 'DashboardAdminController@index')->name('halamanutama.index');

  Route::resource('/halamanutama', 'DashboardAdminController');

  // Pengumuman 
  Route::get('pengumuman', 'DashboardAdminController@indexPengumuman')->name('pengumuman.index');
  Route::post('/pengumuman/tambah', 'DashboardAdminController@storePengumuman')->name('pengumuman.add');
  Route::post('pengumuman/{id}/update', 'DashboardAdminController@updatePengumuman')->name('pengumuman.update');
  Route::get('pengumuman/{id}/delete', 'DashboardAdminController@deletePengumuman')->name('pengumuman.delete');

  // Route Profil PT
  Route::get('/profilpt', 'ProfilPTController@index')->name('profilpt.index');
  Route::post('/profilpt/create', 'ProfilPTController@create')->name('profilpt.create');
  Route::post('/profilpt/{id}.update/', 'ProfilPTController@update')->name('profilpt.update');

  // Route Pimpinan
  Route::resource('/pimpinan', 'PimpinanController');
  Route::get('/pimpinan/{id}/destroy', 'PimpinanController@destroy')->name('pimpinan.destroy');
  Route::get('/pimpinan/prodi/{id}', 'PimpinanController@prodi')->name('pimpinan.prodi');
  Route::get('/pimpinan/jurusan/{id}', 'PimpinanController@jurusan')->name('pimpinan.jurusan');
  // Route Fakultas
  Route::get('/fakultas', 'FakultasController@index')->name('fakultas.index');
  Route::post('/fakultas/create', 'FakultasController@create')->name('fakultas.create');
  Route::post('/fakultas/{id}/update/', 'FakultasController@update')->name('fakultas.update');
  Route::get('/fakultas/{id}/destroy', 'FakultasController@destroy')->name('fakultas.destroy');

  // Route Visi Misi Fakultas
  Route::get('/fakultas/{id}/visi', 'FakultasController@visiFakultas')->name('fakultas.visi.index');
  Route::post('/fakultas/{id}/visi/add', 'FakultasController@storeVisiFakultas')->name('fakultas.visi.add');
  Route::post('/fakultas/{id}/visi/update', 'FakultasController@updateVisiFakultas')->name('fakultas.visi.update');
  Route::get('/fakultas/{id}/visi/destroy', 'FakultasController@destroyVisiFakultas')->name('fakultas.visi.destroy');
  Route::get('/fakultas/{id}/misi', 'FakultasController@misiFakultas')->name('fakultas.misi.index');
  Route::post('/fakultas/{id}/misi/add', 'FakultasController@storeMisiFakultas')->name('fakultas.misi.add');
  Route::post('/fakultas/{id}/misi/update', 'FakultasController@updateMisiFakultas')->name('fakultas.misi.update');
  Route::get('/fakultas/{id}/misi/destroy', 'FakultasController@destroyMisiFakultas')->name('fakultas.misi.destroy');


  // Route Jurusan
  Route::get('/jurusan', 'JurusanController@index')->name('jurusan.index');
  Route::post('/jurusan/create', 'JurusanController@create')->name('jurusan.create');
  Route::post('/jurusan/{id}/update/', 'JurusanController@update')->name('jurusan.update');
  Route::get('/jurusan/{id}/destroy', 'JurusanController@destroy')->name('jurusan.destroy');

  // Route Visi Misi Jurusan
  Route::get('/jurusan/{id}/visi', 'JurusanController@visiJurusan')->name('jurusan.visi.index');
  Route::post('/jurusan/{id}/visi/add', 'JurusanController@storeVisiJurusan')->name('jurusan.visi.add');
  Route::post('/jurusan/{id}/visi/update', 'JurusanController@updateVisiJurusan')->name('jurusan.visi.update');
  Route::get('/jurusan/{id}/visi/destroy', 'JurusanController@destroyVisiJurusan')->name('jurusan.visi.destroy');
  Route::get('/jurusan/{id}/misi', 'JurusanController@misiJurusan')->name('jurusan.misi.index');
  Route::post('/jurusan/{id}/misi/add', 'JurusanController@storeMisiJurusan')->name('jurusan.misi.add');
  Route::post('/jurusan/{id}/misi/update', 'JurusanController@updateMisiJurusan')->name('jurusan.misi.update');
  Route::get('/jurusan/{id}/misi/destroy', 'JurusanController@destroyMisiJurusan')->name('jurusan.misi.destroy');

  // Route Prodi
  Route::get('/prodi', 'ProdiController@index')->name('prodi.index');
  Route::post('/prodi/create', 'ProdiController@create')->name('prodi.create');
  Route::post('/prodi/{id}/update/', 'ProdiController@update')->name('prodi.update');
  Route::get('/prodi/{id}/destroy', 'ProdiController@destroy')->name('prodi.destroy');

  // Route Visi Misi Prodi
  Route::get('/prodi/{id}/visi', 'ProdiController@visiProdi')->name('prodi.visi.index');
  Route::post('/prodi/{id}/visi/add', 'ProdiController@storeVisiProdi')->name('prodi.visi.add');
  Route::post('/prodi/{id}/visi/update', 'ProdiController@updateVisiProdi')->name('prodi.visi.update');
  Route::get('/prodi/{id}/visi/destroy', 'ProdiController@destroyVisiProdi')->name('prodi.visi.destroy');
  Route::get('/prodi/{id}/misi', 'ProdiController@misiProdi')->name('prodi.misi.index');
  Route::post('/prodi/{id}/misi/add', 'ProdiController@storeMisiProdi')->name('prodi.misi.add');
  Route::post('/prodi/{id}/misi/update', 'ProdiController@updateMisiProdi')->name('prodi.misi.update');
  Route::get('/prodi/{id}/misi/destroy', 'ProdiController@destroyMisiProdi')->name('prodi.misi.destroy');

  //Route Jenjang
  Route::get('/jenjang', 'JenjangController@index')->name('jenjang.index');
  Route::post('/jenjang/create', 'JenjangController@create')->name('jenjang.create');
  Route::post('/jenjang/{id}/update/', 'JenjangController@update')->name('jenjang.update');
  Route::get('/jenjang/{id}/destroy', 'JenjangController@destroy')->name('jenjang.destroy');

  //Route Data Mahasiswa
  Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
  Route::post('/mahasiswa/create', 'MahasiswaController@create')->name('mahasiswa.create');
  Route::get('/mahasiswa/{id}/edit', 'MahasiswaController@edit')->name('mahasiswa.edit');
  Route::get('/mahasiswa/{id}/delete', 'MahasiswaController@delete')->name('mahasiswa.delete');

  Route::post('/mahasiswa/{id}/updatedatakampus', 'MahasiswaController@updateDataKampus')->name('mahasiswa.updatedatakampus');
  Route::post('/mahasiswa/{id}/updatedatadiri', 'MahasiswaController@updateDataDiri')->name('mahasiswa.updatedatadiri');
  Route::post('/mahasiswa/{id}/updatedataorangtua', 'MahasiswaController@updateDataOrangTua')->name('mahasiswa.updatedataorangtua');
  Route::post('/mahasiswa/{id}/updatedatalain', 'MahasiswaController@updateDataLain')->name('mahasiswa.updatedatalain');
  Route::get('/mahasiswa/store/{id}', 'MahasiswaController@store')->name('mahasiswa.store');

  Route::post('/mahasiswa/{id}/updatedatakampus', 'MahasiswaController@updateDataKampus')->name('mahasiswa.updatedatakampus');
  Route::post('/mahasiswa/{id}/updatedatadiri', 'MahasiswaController@updateDataDiri')->name('mahasiswa.updatedatadiri');
  Route::post('/mahasiswa/{id}/updatedataorangtua', 'MahasiswaController@updateDataOrangTua')->name('mahasiswa.updatedataorangtua');
  Route::post('/mahasiswa/{id}/updatedatalain', 'MahasiswaController@updateDataLain')->name('mahasiswa.updatedatalain');
  Route::get('/mahasiswa/store/{id}', 'MahasiswaController@store')->name('mahasiswa.store');
  Route::get('/mahasiswa/prodi/{id}', 'MahasiswaController@prodi')->name('mahasiswa.prodi');

  Route::get('/mahasiswa/export/', 'MahasiswaController@mahasiswaExport')->name('mahasiswa.export');
  Route::post('/mahasiswa/import/', 'MahasiswaController@mahasiswaImport')->name('mahasiswa.import');

  // Untuk Mahasiswa Eksetensi
  Route::post('/mahasiswa/get_mata_kuliah/', 'MahasiswaController@getMataKuliah')->name('mahasiswa.getMataKuliah');
  Route::post('/mahasiswa/get_dosen_mata_kuliah/', 'MahasiswaController@getDosenMataKuliah')->name('mahasiswa.getDosenMataKuliah');
  Route::post('/mahasiswa/get_kelas_dosen_mata_kuliah/', 'MahasiswaController@getKelasDosenMataKuliah')->name('mahasiswa.getKelasDosenMataKuliah');
  Route::post('/mahasiswa/{id}/ekstensi/store', 'MahasiswaController@mahasiswaEkstensiStore')->name('mahasiswa.ekstensi.store');
  Route::post('/mahasiswa/ekstensi/{id}/update', 'MahasiswaController@updateMahasiswaEkstensi')->name('mahasiswa.ekstensi.update');
  Route::get('/mahasiswa/ekstensi/{id}/delete', 'MahasiswaController@deleteMahasiswaEkstensi')->name('mahasiswa.ekstensi.delete');
  Route::get('/mahasiswa/ekstensi/get_dosen', 'MahasiswaController@getDosen')->name('mahasiswa.getDosen');
  Route::post('/mahasiswa/get_paket_krs', 'MahasiswaController@getPaketKRS')->name('mahasiswa.getPaketKrs');



  //Route Data Dosen
  Route::get('/dosen', 'DosenController@index')->name('dosen.index');
  Route::post('/dosen/create', 'DosenController@create')->name('dosen.create');
  Route::get('/dosen/{id}/edit', 'DosenController@edit')->name('dosen.edit');
  Route::get('/dosen/{id}/destroy', 'DosenController@destroy')->name('dosen.destroy');
  Route::get('/dosen/store/{id}', 'DosenController@store')->name('dosen.store');

  Route::post('/dosen/{id}/updatedatakampus', 'DosenController@updateDataKampus')->name('dosen.updatedatakampus');
  Route::post('/dosen/{id}/updatedatapribadi', 'DosenController@updateDataPribadi')->name('dosen.updatedatapribadi');
  Route::post('/dosen/{id}/updatelainnya', 'DosenController@updateLainnya')->name('dosen.updatelainnya');

  Route::get('/dosen/export/', 'DosenController@dosenExport')->name('dosen.export');
  Route::post('/dosen/import/', 'DosenController@dosenImport')->name('dosen.import');



  /**
   * Route data siswa
   */
  Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
  Route::post('/siswa/create', 'SiswaController@create')->name('siswa.create');
  Route::get('/siswa/{id}/edit', 'SiswaController@edit')->name('siswa.edit');
  Route::post('/siswa/{id}/', 'SiswaController@update')->name('siswa.update');
  Route::get('/siswa/{id}/delete', 'SiswaController@delete')->name('siswa.delete');
  Route::get('/siswa/{id}/show', 'SiswaController@show')->name('siswa.show');

  Route::post('/siswa/{id}/updatedatasekolah', 'SiswaController@updateDataSekolah')->name('siswa.updatedatasekolah');
  Route::post('/siswa/{id}/updatedatadiri', 'SiswaController@updateDataDiri')->name('siswa.updatedatadiri');
  Route::post('/siswa/{id}/updatedatapendidikan', 'SiswaController@updateDataPendidikan')->name('siswa.updatedatapendidikan');
  Route::post('/siswa/{id}/updatedataorangtua', 'SiswaController@updateDataOrangTua')->name('siswa.updatedataorangtua');


  // rotue MataPelajaran
  Route::get('/matapelajaran', 'MataPelajaranController@index')->name('matapelajaran.index');

  // route MataKuliah
  Route::get('/matakuliah', 'MataKuliahController@index')->name('matakuliah.index');

  // route Modul MataKuliah
  Route::get('/modulmatkul', 'ModulMatkulController@index')->name('modulmatkul.index');

  // Pengampu
  Route::resource('/pengampu', 'PengampuController');
  Route::post('/pengampu/{id}/update', 'PengampuController@update')->name('pengampu.update');
  Route::get('/pengampu/{id}/destroy', 'PengampuController@destroy')->name('pengampu.destroy');

  // Pengampu Prodi per Tahun Ajaran dan Semester
  Route::get('/pengampu/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi', 'PengampuController@getProdi')->name('get.prodi');

  // Agenda Dosen per Tahun Ajaran dan Semester
  Route::get('/agendaguru/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi', 'AgendaGuruController@getProdi')->name('agendaguru.prodi');

  // Pengampu Detail Dosen Prodi per Tahun Ajaran dan Semester
  Route::get('/pengampu/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/detail', 'PengampuController@getDetailDosen')->name('get.pengampu.detail');
  Route::post('/pengampu/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/add/dosen', 'PengampuController@addDosen')->name('post.new.pengampu');

  /**
   * Route data kelas
   */

  Route::get('/kelas', 'KelasController@index')->name('kelas.index'); //list kelas yg sudah dibuat
  Route::post('/kelas/store', 'KelasController@store')->name('kelas.store'); //buat kelas baru
  Route::post('/kelas/{id}/update', 'KelasController@update')->name('kelas.update'); //update kelas baru
  Route::get('/kelas/{id}/destroy', 'KelasController@destroy')->name('kelas.destroy'); //delete kelas baru



  Route::resource('/kalenderakademik', 'KalenderAkademikController');

  // Route::get('/load-events', 'EventController@loadEvents')->name('routeLoadEvents');
  // Route::put('/update-events', 'EventController@update')->name('routeUpdateEvents');

  // Route::get('/kalenderakademik/load-events','KalenderAkademikController@loadEvents')->name('kalenderakademik.routeLoadEvents');
  // Route::get('/kalenderakademik/update-events','KalenderAkademikController@update')->name('kalenderakademik.routeUpdateEvents');

  Route::get('/kalenderakademik/loadKalender', 'KalenderAkademikController@loadKalender')->name('kalenderakademik.loadKalender');
  Route::get('/kalenderakademik/addevent', 'KalenderAkademikController@show')->name('kalenderakademik.show');
  Route::post('/kalenderakademik/store', 'KalenderAkademikController@store')->name('kalenderakademik.store');
  Route::post('/kalenderakademik/create', 'KalenderAkademikController@create');
  Route::post('/kalenderakademik/update', 'KalenderAkademikController@update');
  Route::post('/kalenderakademik/delete', 'KalenderAkademikController@destroy');



  Route::resource('/users', 'UsersController');

  Route::post('/users/roles/tambah', 'UsersController@tambahRoles')->name('users.roles.tambah');
  Route::post('/users/roles/update/{id}', 'UsersController@updateRoles')->name('users.roles.update');
  Route::get('/users/roles/delete/{id}', 'UsersController@deleteRoles')->name('users.roles.delete');
  Route::post('/users/admin/tambah', 'UsersController@tambahAdmin')->name('users.admin.tambah');
  Route::post('/users/permission/tambah', 'UsersController@tambahPermission')->name('users.permission.tambah');
  Route::post('/users/permission/update/{id}', 'UsersController@updatePermission')->name('users.permission.update');
  Route::get('/users/permission/delete/{id}', 'UsersController@deletePermission')->name('users.permission.delete');




  Route::get('/datasiswa/uploaddatasiswa', 'DataSiswaController@uploaddatasiswa');




  Route::resource('/datapegawai', 'DataPegawaiController', ['except' => ['store']]);
  Route::post('/datapegawai/create', 'DataPegawaiController@create')->name('datapegawai.create');
  Route::post('/guru/tambah', 'DataPegawaiController@tambahGuru')->name('akademik.tambah');
  Route::get('/datapegawai/{id}/show', 'DataPegawaiController@show')->name('datapegawai.show');

  Route::resource('/dataorangtua', 'DataOrangTuaController');

  Route::post('/dataorangtua/create', 'DataOrangTuaController@create')->name('dataorangtua.create');
  Route::get('/dataorangtua/{id}/destroy', 'DataOrangTuaController@destroy')->name('dataorangtua.destroy');

  Route::get('/dataorangtua/detailorangtua/{id}', 'DataOrangTuaController@detailOrangTua')->name('dataorangtua.detailorangtua');



  Route::get('/datapegawai/akademik/{id}/detailpegawaiakademik', 'DataPegawaiController@detailpegawaiakademik')->name('akademik.detail');
  Route::get('/datapegawai/akademik/{id}/hapus', 'DataPegawaiController@hapusAkademik')->name('akademik.hapus');

  //update akademik
  Route::post('/datapegawai/akademik/update/{id}', 'DataPegawaiController@updatePhotoAkademik')->name('akademik.update');


  Route::post('/datapegawai/akademik/{id}/tambah/gaji', 'DataPegawaiController@storeGajiGuru')->name('akademik.tambah.gaji');
  Route::post('/datapegawai/akademik/{id}/update/gaji/{id_gaji}', 'DataPegawaiController@updateGajiGuru')->name('akademik.update.gaji');
  Route::get('/datapegawai/akademik/{id}/delete/gaji/{id_gaji}', 'DataPegawaiController@deleteGajiGuru')->name('akademik.delete.gaji');

  Route::post('/datapegawai/akademik/{id}/tambah/sertifikat', 'DataPegawaiController@storeSertifikatGuru')->name('akademik.tambah.sertifikat');
  Route::post('/datapegawai/akademik/{id}/update/sertifikat/{id_sertifikat}', 'DataPegawaiController@updateSertifikatGuru')->name('akademik.update.sertifikat');
  Route::get('/datapegawai/akademik/{id}/delete/sertifikat/{id_sertifikat}', 'DataPegawaiController@deleteSertifikatGuru')->name('akademik.delete.sertifikat');

  Route::post('/datapegawai/akademik/{id}/tambah/pendidikan', 'DataPegawaiController@storePendidikanGuru')->name('akademik.tambah.pendidikan');
  Route::post('/datapegawai/akademik/{id}/update/pendidikan/{id_pendidikan}', 'DataPegawaiController@updatePendidikanGuru')->name('akademik.update.pendidikan');
  Route::get('/datapegawai/akademik/{id}/delete/pendidikan/{id_pendidikan}', 'DataPegawaiController@deletePendidikanGuru')->name('akademik.delete.pendidikan');

  Route::post('/datapegawai/akademik/{id}/tambah/pekerjaan', 'DataPegawaiController@storePekerjaanGuru')->name('akademik.tambah.pekerjaan');
  Route::post('/datapegawai/akademik/{id}/update/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@updatePekerjaanGuru')->name('akademik.update.pekerjaan');
  Route::get('/datapegawai/akademik/{id}/delete/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@deletePekerjaanGuru')->name('akademik.delete.pekerjaan');


  Route::get('/datapegawai/nonakademik/{id}/detailpegawainonakademik', 'DataPegawaiController@detailpegawainonakademik')->name('nonakademik.detail');
  Route::get('/datapegawai/nonakademik/{id}/hapus', 'DataPegawaiController@hapusNonAkademik')->name('nonakademik.hapus');

  //update non akademik
  Route::post('/datapegawai/nonakademik/update/{id}', 'DataPegawaiController@updatePhotoNonAkademik')->name('nonakademik.update');

  Route::post('/datapegawai/nonakademik/{id}/tambah/gaji', 'DataPegawaiController@storeGajiPegawai')->name('nonakademik.tambah.gaji');
  Route::post('/datapegawai/nonakademik/{id}/update/gaji/{id_gaji}', 'DataPegawaiController@updateGajiPegawai')->name('nonakademik.update.gaji');
  Route::get('/datapegawai/nonakademik/{id}/delete/gaji/{id_gaji}', 'DataPegawaiController@deleteGajiPegawai')->name('nonakademik.delete.gaji');

  Route::post('/datapegawai/nonakademik/{id}/tambah/sertifikat', 'DataPegawaiController@storeSertifikatPegawai')->name('nonakademik.tambah.sertifikat');
  Route::post('/datapegawai/nonakademik/{id}/update/sertifikat/{id_sertifikat}', 'DataPegawaiController@updateSertifikatPegawai')->name('nonakademik.update.sertifikat');
  Route::get('/datapegawai/nonakademik/{id}/delete/sertifikat/{id_sertifikat}', 'DataPegawaiController@deleteSertifikatPegawai')->name('nonakademik.delete.sertifikat');

  Route::post('/datapegawai/nonakademik/{id}/tambah/pendidikan', 'DataPegawaiController@storePendidikanPegawai')->name('nonakademik.tambah.pendidikan');
  Route::post('/datapegawai/nonakademik/{id}/update/pendidikan/{id_pendidikan}', 'DataPegawaiController@updatePendidikanPegawai')->name('nonakademik.update.pendidikan');
  Route::get('/datapegawai/nonakademik/{id}/delete/pendidikan/{id_pendidikan}', 'DataPegawaiController@deletePendidikanPegawai')->name('nonakademik.delete.pendidikan');

  Route::post('/datapegawai/nonakademik/{id}/tambah/pekerjaan', 'DataPegawaiController@storePekerjaanPegawai')->name('nonakademik.tambah.pekerjaan');
  Route::post('/datapegawai/nonakademik/{id}/update/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@updatePekerjaanPegawai')->name('nonakademik.update.pekerjaan');
  Route::get('/datapegawai/nonakademik/{id}/delete/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@deletePekerjaanPegawai')->name('nonakademik.delete.pekerjaan');

  //Mutasi
  Route::post('/datapegawai/nonakademik/{id}/tambah/mutasi', 'DataPegawaiController@storeMutasiPegawai')->name('nonakademik.tambah.mutasi');
  Route::post('/datapegawai/nonakademik/{id}/update/mutasi/{id_mutasi}', 'DataPegawaiController@updateMutasiPegawai')->name('nonakademik.update.mutasi');
  Route::get('/datapegawai/nonakademik/{id}/delete/mutasi/{id_mutasi}', 'DataPegawaiController@deleteMutasiPegawai')->name('nonakademik.delete.mutasi');


  Route::get('/datapegawai/akademik/uploaddatapegawaiakademik', 'DataPegawaiController@uploaddatapegawaiakademik');
  Route::get('/datapegawai/nonakademik/uploaddatapegawainonakademik', 'DataPegawaiController@uploaddatapegawainonakademik');

  // Route::resource('/dataorangtua','DataOrangTuaController', ['except' => ['show', 'store']]);
  Route::get('/dataorangtua/uploaddataorangtua', 'DataOrangTuaController@uploaddataorangtua');
  Route::get('/dataorangtua/detaildataorangtua', 'DataOrangTuaController@detaildataorangtua');

  /**
   * Mata Pelajaran
   */
  Route::resource('/matapelajaran', 'MataPelajaranController', ['except' => ['show', 'store']]);
  Route::post('/matapelajaran/create', 'MataPelajaranController@create')->name('matapelajaran.create');
  Route::post('/matapelajaran/{id}/', 'MataPelajaranController@update')->name('matapelajaran.update');
  Route::get('/matapelajaran/{id}/destroy', 'MataPelajaranController@destroy')->name('matapelajaran.destroy');

  /**
   * Waktu dan hari
   */
  Route::get('/settingwaktuhari', 'WaktuHariController@index')->name('setting.waktu.hari.index');
  Route::post('/settingwaktuhari/tambah/waktu', 'WaktuHariController@tambahWaktu')->name('waktu.add');
  Route::post('/settingwaktuhari/{id}/waktu', 'WaktuHariController@updateWaktu')->name('waktu.update');
  Route::get('/settingwaktuhari/{id}/waktu/destroy', 'WaktuHariController@destroyWaktu')->name('waktu.destroy');

  Route::post('/settingwaktuhari/tambah/hari', 'WaktuHariController@tambahHari')->name('hari.add');
  Route::post('/settingwaktuhari/{id}/hari', 'WaktuHariController@updateHari')->name('hari.update');
  Route::get('/settingwaktuhari/{id}/hari/destroy', 'WaktuHariController@destroyHari')->name('hari.destroy');


  /*
    Kurikulum
  */
  Route::get('/kurikulum', 'KurikulumController@index')->name('kurikulum.index');
  Route::post('/kurikulum/create', 'KurikulumController@create')->name('kurikulum.create');
  Route::post('/kurikulum/{id}/', 'KurikulumController@update')->name('kurikulum.update');
  Route::get('/kurikulum/{id}/destroy', 'KurikulumController@destroy')->name('kurikulum.destroy');
  Route::get('/kurikulum/jurusan/{id}', 'KurikulumController@jurusan')->name('kurikulum.jurusan');
  Route::get('/kurikulum/prodi/{id}', 'KurikulumController@prodi')->name('kurikulum.prodi');

  // Kurikulum detail
  Route::get('/kurikulum/{id}/detail', 'KurikulumController@detail')->name('kurikulum.detail');
  Route::post('/kurikulum/{id}/add', 'KurikulumController@addDetail')->name('kurikulum.detail.add');
  Route::post('/kurikulum/{id}/update', 'KurikulumController@updateDetail')->name('kurikulum.detail.update');
  Route::get('/kurikulum/{id}/detail/destroy', 'KurikulumController@destroyDetail')->name('kurikulum.detail.destroy');

  // Daftar Ulang
  Route::get('/daftarulang/tahun/semester/prodi', 'DaftarUlangController@pilihTahun')->name('daftarulang.pilih.tahun');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi', 'DaftarUlangController@pilihProdi')->name('daftarulang.pilih.prodi');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/', 'DaftarUlangController@index')->name('daftarulang.prodi');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/create', 'DaftarUlangController@create')->name('daftarulang.create');
  Route::post('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/tambah', 'DaftarUlangController@store')->name('daftarulang.store');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/{id}/show', 'DaftarUlangController@show')->name('daftarulang.show');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/{id}/edit', 'DaftarUlangController@edit')->name('daftarulang.edit');
  Route::post('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/{id}/update', 'DaftarUlangController@update')->name('daftarulang.update');
  Route::post('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/mahasiswa/{id_mahasiswa}/pembayaran', 'DaftarUlangController@pembayaran')->name('daftarulang.pembayaran');
  Route::post('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/mahasiswa/{id_mahasiswa}/ubahpembayaran', 'DaftarUlangController@ubahpembayaran')->name('daftarulang.ubahpembayaran');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/{id}/destroy', 'DaftarUlangController@destroy')->name('daftarulang.destroy');

  Route::get('/daftarulang/mahasiswa/tingkat/latest/{id_mahasiswa}', 'DaftarUlangController@tingkatTerakhir')->name('daftarulang.mahasiswa.tingkat');
  Route::get('/daftarulang/get_tagihan', 'DaftarUlangController@get_tagihan');
  Route::get('/daftarulang/get_nim', 'DaftarUlangController@get_nim');
  Route::get('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/create_va', 'DaftarUlangController@create_va')->name('daftarulang.create_va');
  Route::post('/daftarulang/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/pembayaran_va', 'DaftarUlangController@pembayaran_va')->name('daftarulang.pembayaran_va');

  // KHS
  Route::resource('/khs', 'KHSController');
  Route::get('/tahun/semester/prodi/khs', 'KHSController@pilihTahun')->name('khs.pilih.tahun');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/khs', 'KHSController@pilihProdi')->name('khs.pilih.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/', 'KHSController@index')->name('khs.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/create', 'KHSController@create')->name('khs.create');
  Route::post('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/tambah', 'KHSController@store')->name('khs.store');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/{id}/show', 'KHSController@show')->name('khs.show');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/{id}/edit', 'KHSController@edit')->name('khs.edit');
  // Route::post('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/khs/{id}/update', 'KHSController@updateKHS')->name('khs.update');
  Route::post('/khs/destroyKHS', 'KHSController@destroyKHS')->name('khs.destroyKHS');
  Route::get('/khs/mahasiswa/tingkat/latest/{id_mahasiswa}', 'KRSController@tingkatTerakhir')->name('khs.mahasiswa.tingkat');
  Route::post('/khs/update_nilai', 'KHSController@update_nilai')->name('khs.update_nilai');
  Route::post('/khs/{id}/update', 'MahasiswaController@updateNilaiKHS')->name('khs.updatenilai');

  Route::get('/khs/{id}/delete', 'KHSController@destroy')->name('khs.destroy');

  // KRS
  Route::resource('/krs', 'KRSController');
  Route::get('/tahun/semester/prodi/krs', 'KRSController@pilihTahun')->name('krs.pilih.tahun');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/krs', 'KRSController@pilihProdi')->name('krs.pilih.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/', 'KRSController@index')->name('krs.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/create', 'KRSController@create')->name('krs.create');
  Route::post('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/tambah', 'KRSController@store')->name('krs.store');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/{id}/show', 'KRSController@show')->name('krs.show');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/{id}/edit', 'KRSController@edit')->name('krs.edit');
  Route::post('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/{id}/update', 'KRSController@updateKRS')->name('krs.update');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/krs/{id}/destroy', 'KRSController@destroyKRS')->name('krs.destroy');

  Route::get('/krs/mahasiswa/tingkat/latest/{id_mahasiswa}', 'KRSController@tingkatTerakhir')->name('krs.mahasiswa.tingkat');
  // Paket KRS
  Route::get('/prodi/krs/paket', 'KRSController@prodi')->name('paket.krs.index');
  Route::get('/prodi/{id_prodi}/krs/paket/', 'KRSController@PaketKRSProdi')->name('paket.krs.prodi');
  Route::post('/prodi/{id_prodi}/krs/paket/tambah', 'KRSController@storePaketKRS')->name('paket.krs.store');
  Route::post('/prodi/{id_prodi}/krs/paket/{id}/update', 'KRSController@updatePaketKRS')->name('paket.krs.update');
  Route::get('/prodi/{id_prodi}/krs/paket/{id}/destroy', 'KRSController@destroyPaketKRS')->name('paket.krs.destroy');

  Route::resource('/sp', 'SpController');
  Route::get('/prodi/sp/paket', 'SpController@prodi')->name('paket.semesterpendek.index');
  Route::get('/prodi/{id_prodi}/sp/paket/', 'SpController@PaketKRSProdi')->name('paket.semesterpendek.prodi');
  Route::post('/prodi/{id_prodi}/sp/paket/tambah', 'SpController@storePaketKRS')->name('paket.sp.store');
  Route::post('/prodi/{id_prodi}/sp/paket/{id}/update', 'SpController@updatePaketKRS')->name('paket.sp.update');
  Route::get('/prodi/{id_prodi}/sp/paket/{id}/destroy', 'SpController@destroyPaketKRS')->name('paket.sp.destroy');

  Route::get('/tahun/semester/prodi/sp', 'SpController@pilihTahun')->name('sp.pilih.tahun');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/sp', 'SpController@pilihProdi')->name('sp.pilih.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/', 'SpController@index')->name('sp.prodi');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/create', 'SpController@create')->name('sp.create');
  Route::post('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/tambah', 'SpController@store')->name('sp.store');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/{id}/show', 'SpController@show')->name('sp.show');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/{id}/edit', 'SpController@edit')->name('sp.edit');
  // Route::get('/tahun/semester/prodi/sp/update/{id}', 'SpController@update')->name('sp.update');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/sp/{id}/{id_fakultas}/{id_jurusan}/update/{tingkat_semester}/{mapel_id}/{id_mahasiswa}', 'SpController@update')->name('sp.update');
  Route::get('/tahun/{id_tahun_ajaran}/semester/{id_semester}/{tingkat_semester}/prodi/{id_prodi}/sp/{id}/destroy/{id_mahasiswa}/{mapel_id}', 'SpController@destroySP')->name('sp.destroy');

  Route::get('/sp/mahasiswa/tingkat/latest/{id_mahasiswa}', 'SpController@tingkatTerakhir')->name('sp.mahasiswa.tingkat');
  /**
   * Mata Kuliah
   */
  Route::post('/matakuliah/create', 'MataKuliahController@create')->name('matakuliah.create');
  Route::post('/matakuliah/{id}/', 'MataKuliahController@update')->name('matakuliah.update');
  Route::get('/matakuliah/{id}/destroy', 'MataKuliahController@destroy')->name('matakuliah.destroy');
  Route::post('/matakuliah/import/data', 'MataKuliahController@matkulImport')->name('matakuliah.import');
  /**
   * Modul Mata Kuliah
   */
  Route::post('/modulmatkul/create', 'ModulMatkulController@create')->name('modulmatkul.create');
  Route::post('/modulmatkul/{id}/', 'ModulMatkulController@update')->name('modulmatkul.update');
  Route::get('/modulmatkul/{id}/destroy', 'ModulMatkulController@destroy')->name('modulmatkul.destroy');
  Route::get('/modulmatkul/prodi/{id}', 'ModulMatkulController@prodi')->name('modulmatkul.prodi');


  Route::resource('/mataujian', 'MataUjianController');
  Route::post('/mataujian/jenisujian/tambah', 'MataUjianController@store')->name('jenisujian.add');
  Route::post('/mataujian/jenisujian/{id}/update', 'MataUjianController@update')->name('jenisujian.update');
  Route::get('/mataujian/jenisujian/{id}/destroy', 'MataUjianController@destroy')->name('jenisujian.destroy');

  Route::post('/mataujian/grade/tambah', 'MataUjianController@gradeStore')->name('grade.add');
  Route::post('/mataujian/grade/{id}/update', 'MataUjianController@gradeUpdate')->name('grade.update');
  Route::get('/mataujian/grade/{id}/destroy', 'MataUjianController@gradeDestroy')->name('grade.destroy');

  Route::post('/mataujian/rapor/tambah', 'MataUjianController@raporStore')->name('rapor.add');
  Route::post('/mataujian/rapor/{id}/update', 'MataUjianController@raporUpdate')->name('rapor.update');
  Route::get('/mataujian/rapor/{id}/destroy', 'MataUjianController@raporDestroy')->name('rapor.destroy');


  Route::resource('/materipelajaran', 'MateriPelajaranController', ['except' => ['store']]);
  Route::get('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/detail', 'MateriPelajaranController@show')->name('materipelajaran.show');
  Route::get('/materipelajaran/detailmateri', 'MateriPelajaranController@detailmateri');
  Route::post('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/store', 'MateriPelajaranController@store')->name('materipelajaran.store');
  Route::post('/materipelajaran/update/{id}/dosen/{id_dosen}', 'MateriPelajaranController@updateMateri')->name('materipelajaran.update');
  Route::get('/materipelajaran/{id}/destroy', 'MateriPelajaranController@destroy')->name('materipelajaran.destroy');
  //pr
  Route::get('tugas/{id}/download', 'MateriPelajaranController@unduh')->name('tugas.download');

  Route::post('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/storeTugas', 'MateriPelajaranController@storeTugas')->name('materipelajaran.storeTugas');
  Route::post('materipelajaran/updateTugas/{id}/dosen/{id_dosen}', 'MateriPelajaranController@updateTugas')->name('materipelajaran.updateTugas');
  Route::get('/materipelajaran/{id}/tugasDestroy', 'MateriPelajaranController@tugasDestroy')->name('materipelajaran.tugasDestroy');



  //Agenda guru
  Route::resource('/agendaguru', 'AgendaGuruController');
  Route::get('/agendaguru/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/detail', 'AgendaGuruController@agendaGuru')->name('agendaguru.detail');
  Route::get('/agendaguru/{id}/lihatagenda/{id_agenda}', 'AgendaGuruController@show')->name('agendaguru.lihatagenda');

  /**
   * Jadwal Pengganti
   * 
   */
  Route::get('/jadwal/pengganti', 'JadwalPenggantiController@index')->name('jadwal.pengganti.index');
  Route::post('/jadwa/pengganti/{id}/update', 'JadwalPenggantiController@update')->name('jadwal.pengganti.update');

  /**
   * Jadwal Pelajaran
   *
   */
  Route::resource('/jadwal', 'JadwalPelajaranGuruController', ['except' => ['store']]);
  Route::post('/jadwal/generate', 'JadwalPelajaranGuruController@submit')->name('jadwal.generate');
  Route::post('/jadwal/create', 'JadwalPelajaranGuruController@create')->name('jadwal.create');
  Route::post('/jadwal/{id}/', 'JadwalPelajaranGuruController@edit')->name('jadwal.kelas.update');
  Route::get('/jadwal/{id}/delete', 'JadwalPelajaranGuruController@delete')->name('jadwal.kelas.delete');
  Route::resource('/jadwalpelajaransiswa', 'JadwalPelajaranSiswaController');
  Route::post('/jadwalpelajaransiswa/ambil', 'JadwalPelajaranSiswaController@ambilJadwal');
  Route::post('/jadwal/pelajaran/tambah', 'JadwalPelajaranSiswaController@tambahpelajaran')->name('tambah.jadwal.pelajaran');
  Route::post('/jadwal/tahun/{tahun_ajaran_id}/semester/{semester_id}/kelas/{kelas_id}/hari/{hari_id}/update', 'JadwalPelajaranSiswaController@updateJadwal')->name('jadwal.update');

  Route::get('/jadwal/pelajaran/siswa', 'JadwalPelajaranController@siswa')->name('jadwal.pelajaran.siswa');


  // Route::get('/jadwal/detailjadwalguru','JadwalPelajaranGuruController@detailjadwalguru');
  Route::get('/jadwal/tambahjadwalguru', 'JadwalPelajaranGuruController@tambahjadwalguru');

  /**
   * Jadwal Ujian
   */
  Route::resource('/jadwalujian', 'JadwalUjianController');
  Route::get('/jadwalujian/{id}/show', 'JadwalUjianController@show')->name('jadwalujian.show');
  Route::post('/jadwalujian/{id}/update', 'JadwalUjianController@update')->name('jadwalujian.update');
  Route::get('/jadwalujian/{id}/destroy', 'JadwalUjianController@destroy')->name('jadwalujian.destroy');
  Route::post('/jadwalujian/tambah', 'JadwalUjianController@tambahjadwalujian');
  /**
   * Jadwal Ujian Detail
   */
  Route::post('/jadwalujian/{id}/add', 'JadwalUjianController@add')->name('jadwalujian.add');
  Route::get('/jadwalujian/{id}/destroyDetail', 'JadwalUjianController@destroyDetail')->name('jadwalujian.destroyDetail');
  Route::post('/jadwalujian/{id}/updateDetail', 'JadwalUjianController@updateDetail')->name('jadwalujian.updateDetail');

  Route::resource('/jadwalsp', 'JadwalSPController');
  Route::get('/jadwalsp', 'JadwalSPController@index')->name('jadwalsp.index');
  Route::post('/jadwalsp/tambah', 'JadwalSPController@create')->name('jadwalsp.create');
  Route::post('/jadwalsp/{id}/update', 'JadwalSPController@update')->name('jadwalsp.update');
  Route::get('/jadwalsp/{id}/delete', 'JadwalSPController@delete')->name('jadwalsp.delete');

  Route::get('/kumpulansoal', 'KumpulanSoalController@index')->name('kumpulansoal.index');
  Route::delete('/kumpulansoal/destroy/{id}', 'KumpulanSoalController@destroy')->name('kumpulansoal.destroy');
  Route::get('/kumpulansoal/show/{id}', 'KumpulanSoalController@show')->name('kumpulansoal.show');
  Route::get('/kumpulansoal/edit/{id}', 'KumpulanSoalController@edit')->name('kumpulansoal.edit');
  Route::put('/kumpulansoal/update/{id}', 'KumpulanSoalController@update')->name('kumpulansoal.update');
  Route::get('/kumpulansoal/pengampu/{id}', 'KumpulanSoalController@list')->name('kumpulansoal.listSoal');
  Route::post('/kumpulansoal/store/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}', 'KumpulanSoalController@store')->name('kumpulansoal.store');
  Route::post('/kumpulansoal/{id}/create-question', 'KumpulanSoalController@createQuestions');
  Route::post('/kumpulansoal/{id}/delete-question', 'KumpulanSoalController@deleteQuestion');
  Route::post('/kumpulansoal/{id}/update-question', 'KumpulanSoalController@updateQuestion');
  Route::post('/kumpulansoal/{id}/create-option', 'KumpulanSoalController@createOption');
  Route::post('/kumpulansoal/{id}/delete-option', 'KumpulanSoalController@deleteOption');
  Route::post('/kumpulansoal/{id}/update-option', 'KumpulanSoalController@updateOption');
  Route::post('/kumpulansoal/{id}/update-option-answer', 'KumpulanSoalController@updateOptionAnswer');

  // Route::get('/kumpulansoal/id_dosen/{id}/mapel/{mapel}', 'KumpulanSoalController@prodi')->name('kumpulansoal.prodi');
  // Route::get('/kumpulansoal/mapel/{id}/prodi/{id_prodi}', 'KumpulanSoalController@semester')->name('kumpulansoal.semester');
  // Route::get('/kumpulansoal/mapel/{id}/prodi/{id_prodi}/semester/{semester}', 'KumpulanSoalController@tahunAjaran')->name('kumpulansoal.tahunajaran');


  Route::resource('/evaluasisoal', 'EvaluasiSoalController');
  Route::get('/evaluasisoal/detailevaluasi/{id}/{id_kelas}', 'EvaluasiSoalController@detailEvaluasi')->name('evaluasisoal.detailevaluasi');
  Route::get('/evaluasisoal/jawaban/soal/{question_id}/kelas/{kelas_id}', 'EvaluasiSoalController@jawaban')->name('evaluasi.soal');


  /**
   * Absensi pegawai
   *
   */
  // Route::resource('/absensipegawai','AbsensiPegawaiController', ['except' => ['show', 'store']]);
  Route::get('/absensi/pegawai', 'AbsensiController@pegawai')->name('absensi.pegawai');
  Route::post('/absensi/pegawai', 'AbsensiController@pegawaiAbsensi')->name('absensi.pegawai.cari');
  Route::get('/absensi/pegawai/laporan/', 'AbsensiController@pegawaiLaporan')->name('absensi.pegawai.laporan');
  /**
   * Absensi Guru
   *
   */
  Route::get('/absensi/guru', 'AbsensiController@guru')->name('absensi.guru');
  Route::post('/absensi/guru', 'AbsensiController@guruAbsensi')->name('absensi.guru.cari');
  Route::get('/absensi/guru/laporan', 'AbsensiController@guruLaporan')->name('absensi.guru.laporan');

  /**
   * Absensi Dosen
   */
  Route::get('/absensi/dosen', 'AbsensiController@dosen')->name('absensi.dosen');
  Route::post('/absensi/dosen', 'AbsensiController@dosenAbsensi')->name('absensi.dosen.cari');
  Route::post('/absensi/dosen/rekap', 'AbsensiController@cariRekapDosen')->name('absensi.dosen.cari.rekap');
  Route::get('/absensi/dosen/laporan', 'AbsensiController@dosenLaporan')->name('absensi.dosen.laporan');
  Route::get('/absensi/dosen/rekap', 'AbsensiController@rekapAbsensiDosen')->name('absensi.dosen.rekap');



  /**
   * Absensi Mahasiswa
   * 
   */
  Route::get('/absensi/prodi', 'AbsensiController@prodi')->name('absensi.mahasiswa.prodi');
  Route::get('/absensi/prodi/{id_prodi}/mahasiswa', 'AbsensiController@mahasiswaAbsensi')->name('absensi.mahasiswa');
  Route::post('/absensi/prodi/{id_prodi}/mahasiswa', 'AbsensiController@mahasiswaAbsensi')->name('absensi.mahasiswa.cari');
  Route::get('/absensi/prodi/{id_prodi}/mahasiswa/laporan', 'AbsensiController@mahasiswaLaporan')->name('absensi.mahasiswa.laporan');

  /**
   * Absensi Siswa
   *
   */
  // Route::resource('/absensisiswa','AbsensiSiswaController', ['except' => ['show', 'store']]);
  Route::get('/absensi/siswa', 'AbsensiController@siswa')->name('absensi.siswa');
  Route::post('/absensi/siswa', 'AbsensiController@siswaAbsensi')->name('absensi.siswa.cari');
  Route::get('/absensi/siswa/laporan', 'AbsensiController@siswaLaporan')->name('absensi.siswa.laporan');


  /**
   * Nilai Siswa
   *
   */

  Route::resource('/nilaisiswa', 'NilaiSiswaController');
  Route::get('/nilaisiswa/{id}/pilihmapel', 'NilaiSiswaController@pilihMapel')->name('nilaisiswa.pilihmapel');

  Route::resource('/raporsiswa', 'RaporSiswaController');
  Route::post('/raporsiswa/carilapor', 'RaporSiswaController@cariDataLapor')->name('raporsiswa.carilapor');

  Route::resource('/kenaikankelas', 'KenaikanKelasController', ['except' => ['show', 'store']]);
  /**
   * Data Ruangan
   *
   */
  Route::resource('/dataruangan', 'DataRuanganController', ['except' => ['show', 'store']]);

  Route::post('/dataruangan/ruangan/tambah', 'DataRuanganController@ruanganStore')->name('ruangan.store');
  Route::post('/dataruangan/kelas/tambah', 'DataRuanganController@kelasStore')->name('ruang.kelas.store');
  Route::post('/dataruangan/pegawai/tambah', 'DataRuanganController@pegawaiStore')->name('ruang.pegawai.store');
  Route::post('/dataruangan/lab/tambah', 'DataRuanganController@labStore')->name('ruang.lab.store');
  Route::post('/dataruangan/ekstra/tambah', 'DataRuanganController@ekstraStore')->name('ruang.ekstra.store');
  Route::post('/dataruangan/umum/tambah', 'DataRuanganController@umumStore')->name('ruang.umum.store');

  Route::post('/dataruangan/ruangan/{id}/update', 'DataRuanganController@ruanganUpdate')->name('ruangan.update');
  Route::post('/dataruangan/kelas/{id}/update', 'DataRuanganController@kelasUpdate')->name('ruang.kelas.update');
  Route::post('/dataruangan/pegawai/{id}/update', 'DataRuanganController@pegawaiUpdate')->name('ruang.pegawai.update');
  Route::post('/dataruangan/lab/{id}/update', 'DataRuanganController@labUpdate')->name('ruang.lab.update');
  Route::post('/dataruangan/ekstra/{id}/update', 'DataRuanganController@ekstraUpdate')->name('ruang.ekstra.update');
  Route::post('/dataruangan/umum/{id}/update', 'DataRuanganController@umumUpdate')->name('ruang.umum.update');

  Route::get('/dataruangan/ruangan/{id}/destroy', 'DataRuanganController@ruanganDestroy')->name('ruangan.destroy');
  Route::get('/dataruangan/kelas/{id}/destroy', 'DataRuanganController@kelasDestroy')->name('ruang.kelas.destroy');
  Route::get('/dataruangan/pegawai/{id}/destroy', 'DataRuanganController@pegawaiDestroy')->name('ruang.pegawai.destroy');
  Route::get('/dataruangan/lab/{id}/destroy', 'DataRuanganController@labDestroy')->name('ruang.lab.destroy');
  Route::get('/dataruangan/ekstra/{id}/destroy', 'DataRuanganController@ekstraDestroy')->name('ruang.ekstra.destroy');
  Route::get('/dataruangan/umum/{id}/destroy', 'DataRuanganController@umumDestroy')->name('ruang.umum.destroy');


  Route::resource('/datakelas', 'DataKelasController', ['except' => ['store']]);


  Route::resource('/pengaturan', 'PengaturanAdminController');
  Route::post('/pengaturan/update', 'PengaturanAdminController@update')->name('pengaturan.update');

  Route::post('/pengaturan/tambahtahunajaran', 'PengaturanAdminController@tambahTahunAjaran')->name('pengaturan.tambahtahunajaran');
  Route::post('/pengaturan/{id}/updatetahunajaran', 'PengaturanAdminController@updateTahunAjaran')->name('pengaturan.updatetahunajaran');
  Route::get('/pengaturan/{id}/deletetahunajaran', 'PengaturanAdminController@deleteTahunAjaran')->name('pengaturan.deletetahunajaran');

  Route::post('/pengaturan/tambahsemester', 'PengaturanAdminController@tambahSemester')->name('pengaturan.tambahsemester');
  Route::post('/pengaturan/{id}/updatesemester', 'PengaturanAdminController@updateSemester')->name('pengaturan.updatesemester');
  Route::get('/pengaturan/{id}/deletesemester', 'PengaturanAdminController@deleteSemester')->name('pengaturan.deletesemester');

  //Route Alat Transportasi
  Route::get('/transportasi', 'TransportasiController@index')->name('transportasi.index');
  Route::post('/transportasi/create', 'TransportasiController@create')->name('transportasi.create');
  Route::post('/transportasi/{id}/update/', 'TransportasiController@update')->name('transportasi.update');
  Route::get('/transportasi/{id}/destroy', 'TransportasiController@destroy')->name('transportasi.destroy');

  //Route Jenis Pendidikan
  Route::get('/jenispendidikan', 'JenisPendidikanController@index')->name('jenispendidikan.index');
  Route::post('/jenispendidikan/create', 'JenisPendidikanController@create')->name('jenispendidikan.create');
  Route::post('/jenispendidikan/{id}/update/', 'JenisPendidikanController@update')->name('jenispendidikan.update');
  Route::get('/jenispendidikan/{id}/destroy', 'JenisPendidikanController@destroy')->name('jenispendidikan.destroy');

  //Route Jenis Pekerjaan
  Route::get('/jenispekerjaan', 'JenisPekerjaanController@index')->name('jenispekerjaan.index');
  Route::post('/jenispekerjaan/create', 'JenisPekerjaanController@create')->name('jenispekerjaan.create');
  Route::post('/jenispekerjaan/{id}/update/', 'JenisPekerjaanController@update')->name('jenispekerjaan.update');
  Route::get('/jenispekerjaan/{id}/destroy', 'JenisPekerjaanController@destroy')->name('jenispekerjaan.destroy');

  //Route Jenis Penghasilan
  Route::get('/jenispenghasilan', 'JenisPenghasilanController@index')->name('jenispenghasilan.index');
  Route::post('/jenispenghasilan/create', 'JenisPenghasilanController@create')->name('jenispenghasilan.create');
  Route::post('/jenispenghasilan/{id}/update/', 'JenisPenghasilanController@update')->name('jenispenghasilan.update');
  Route::get('/jenispenghasilan/{id}/destroy', 'JenisPenghasilanController@destroy')->name('jenispenghasilan.destroy');

  //Route Jenis Tinggal
  Route::get('/jenistinggal', 'JenisTinggalController@index')->name('jenistinggal.index');
  Route::post('/jenistinggal/create', 'JenisTinggalController@create')->name('jenistinggal.create');
  Route::post('/jenistinggal/{id}/update/', 'JenisTinggalController@update')->name('jenistinggal.update');
  Route::get('/jenistinggal/{id}/destroy', 'JenisTinggalController@destroy')->name('jenistinggal.destroy');

  //Route Kebutuhan Khusus
  Route::get('/kebutuhankhusus', 'KebutuhanKhususController@index')->name('kebutuhankhusus.index');
  Route::post('/kebutuhankhusus/create', 'KebutuhanKhususController@create')->name('kebutuhankhusus.create');
  Route::post('/kebutuhankhusus/{id}/update/', 'KebutuhanKhususController@update')->name('kebutuhankhusus.update');
  Route::get('/kebutuhankhusus/{id}/destroy', 'KebutuhanKhususController@destroy')->name('kebutuhankhusus.destroy');

  //Route Status Milik
  Route::get('/statusmilik', 'StatusMilikController@index')->name('statusmilik.index');
  Route::post('/statusmilik/create', 'StatusMilikController@create')->name('statusmilik.create');
  Route::post('/statusmilik/{id}/update/', 'StatusMilikController@update')->name('statusmilik.update');
  Route::get('/statusmilik/{id}/destroy', 'StatusMilikController@destroy')->name('statusmilik.destroy');

  //Route Pangkat Golongan
  Route::get('/pangkatgolongan', 'PangkatGolonganController@index')->name('pangkatgolongan.index');
  Route::post('/pangkatgolongan/create', 'PangkatGolonganController@create')->name('pangkatgolongan.create');
  Route::post('/pangkatgolongan/{id}/update/', 'PangkatGolonganController@update')->name('pangkatgolongan.update');
  Route::get('/pangkatgolongan/{id}/destroy', 'PangkatGolonganController@destroy')->name('pangkatgolongan.destroy');

  //Route Lembaga
  Route::get('/lembaga', 'LembagaController@index')->name('lembaga.index');
  Route::post('/lembaga/create', 'LembagaController@create')->name('lembaga.create');
  Route::post('/lembaga/{id}/update/', 'LembagaController@update')->name('lembaga.update');
  Route::get('/lembaga/{id}/destroy', 'LembagaController@destroy')->name('lembaga.destroy');


  Route::resource('/biaya', 'BiayaController');
  Route::post('/biaya/{id}/update', 'BiayaController@update')->name('biaya.update');
  Route::get('/biaya/{id}/hapus', 'BiayaController@destroy')->name('biaya.destroy');

  Route::get('/jenisbiaya', 'BiayaController@indexJenisBiaya')->name('jenisbiaya.index');
  Route::post('/jenisbiaya/tambah', 'BiayaController@storeJenisBiaya')->name('tambah.jenisbiaya');
  Route::post('/jenisbiaya/{id}/update', 'BiayaController@updateJenisBiaya')->name('update.jenisbiaya');
  Route::get('/jenisbiaya/{id}/hapus', 'BiayaController@destroyJenisBiaya')->name('hapus.jenisbiaya');

  Route::resource('/pengeluaran', 'PengeluaranController');
  Route::post('/pengeluaran/{id}/update', 'PengeluaranController@update')->name('pengeluaran.update');

  Route::resource('/pemasukan', 'PemasukanController');
  Route::post('/pemasukan/{id}/update', 'PemasukanController@update')->name('pemasukan.update');

  Route::post('/pengeluaran/rekap', 'PengeluaranController@cariRekapPengeluaran')->name('pengeluaran.cari.rekap');
  Route::get('/pengeluaran/rekap', 'PengeluaranController@rekapPengeluaran')->name('pengeluaran.rekap');
  Route::post('/pemasukan/rekap', 'PemasukanController@cariRekapPemasukan')->name('pemasukan.cari.rekap');
  Route::get('/pemasukan/rekap', 'PemasukanController@rekapPemasukan')->name('pemasukan.rekap');

  Route::get('/masterbiaya', 'MasterBiayaController@index')->name('masterbiaya.index');
  Route::post('/masterbiaya/tambah', 'MasterBiayaController@store')->name('tambah.masterbiaya');
  Route::post('/masterbiaya/{id}/update', 'MasterBiayaController@update')->name('update.masterbiaya');
  Route::get('/masterbiaya/{id}/hapus', 'MasterBiayaController@destroy')->name('hapus.masterbiaya');



  //ROUTE NILAI TUGAS
  Route::resource('/nilaitugas', 'NilaiTugasController');
  Route::get('/nilaitugas/matkul/{id}', 'NilaiTugasController@kelas')->name('nilaitugas.listKelas');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}', 'NilaiTugasController@tugas')->name('nilaitugas.listTugas');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}', 'NilaiTugasController@mahasiswa')->name('nilaitugas.listMahasiswa');
  Route::post('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}/mahasiswa/{mahasiswa}', 'NilaiTugasController@store')->name('nilaitugas.store');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}/mahasiswa/{mahasiswa}/dosen/{dosen}', 'NilaiTugasController@update')->name('nilaitugas.update');
  Route::post('/nilaitugas/updatenilai/{id}/{nilai_id}', 'NilaiTugasController@updateNilai')->name('nilaitugas.updatenilai');
  Route::get('/nilaitugas/destroynilai/{id}/{nilai_id}', 'NilaiTugasController@destroyNilai')->name('nilaitugas.destroynilai');
});

/**
 * Route Guru
 */
Route::namespace('Guru')->prefix('dosen')->name('guru.')->middleware('role:dosen')->group(function () {
  Route::get('/dashboard', 'DashboardGuruController@index')->name('halamanutama.index');
  Route::resource('/halamanutama', 'DashboardGuruController', ['except' => ['store']]);

  // Route::get('/dashboard/absensi','AbsensiGuruController@absensi');

  Route::resource('/Kalenderakademik', 'KalenderAkademikController', ['except' => ['store']]);

  Route::resource('/jadwalkelas', 'JadwalKelasController', ['except' => ['store']]);

  Route::resource('/materipelajaran', 'MateriPelajaranController');
  Route::post('/materipelajaran/tambah/rpp', 'MateriPelajaranController@storeRpp')->name('tambah.rpp');
  Route::post('/materipelajaran/update/{id}/rpp', 'MateriPelajaranController@updateRpp')->name('update.rpp');
  Route::get('/materipelajaran/destroy/{id}/rpp', 'MateriPelajaranController@destroyRpp')->name('destroy.rpp');
  Route::get('/materipelajaran/{id}/destroy', 'MateriPelajaranController@destroy')->name('materipelajaran.destroy');
  Route::get('/materipelajaran/mapel/{id}', 'MateriPelajaranController@prodi')->name('materipelajaran.mapel');
  Route::get('/materipelajaran/mapel/{id}/prodi/{id_prodi}', 'MateriPelajaranController@semester')->name('materipelajaran.semester');
  Route::get('/materipelajaran/mapel/{id}/prodi/{id_prodi}/semester/{semester}', 'MateriPelajaranController@tahunAjaran')->name('materipelajaran.tahunajaran');
  Route::post('/materipelajaran/update/{id}', 'MateriPelajaranController@updateMateri')->name('materipelajaran.update');
  Route::get('/materipelajaran/kelas/{mapel_id}', 'MateriPelajaranController@kelas')->name('materipelajaran.kelas');

  /**
   * Pengajuan Jadwal Pengganti
   * 
   */
  Route::post('/jadwal/pengganti', 'JadwalPenggantiController@store')->name('pengajuan.jadwal');

  //Agenda
  Route::get('agenda', 'AgendaController@index')->name('agenda.index');
  Route::post('agenda/store', 'AgendaController@store')->name('agenda.store');
  Route::post('agenda/{id}detail/store', 'AgendaController@storeDetail')->name('agenda.detail.store');

  Route::post('agenda/{id}/update', 'AgendaController@update')->name('agenda.update');
  Route::get('agenda/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/detail/{id}/detail', 'AgendaController@edit')->name('agenda.edit');
  Route::get('get/data/{nama_kelas}/siswa', 'AgendaController@getSiswa')->name('get.data.siswa');
  Route::post('agenda/{id}/detail/update', 'AgendaController@updateDetail')->name('agenda.detail.update');
  Route::post('agenda/{id}/detail/add', 'AgendaController@addDetail')->name('agenda.detail.siswa.add');
  Route::get('agenda/{id}/detail/delete', 'AgendaController@deleteDetail')->name('agenda.detail.siswa.delete');


  // Agenda Dosen per Tahun Ajaran dan Semester
  Route::get('/agenda/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi', 'AgendaController@getProdi')->name('agenda.prodi');

  Route::get('/agenda/tahun/{id_tahun_ajaran}/semester/{id_semester}/prodi/{id_prodi}/detail', 'AgendaController@detailAgenda')->name('agenda.detail');


  // Data Soal Tugas

  Route::resource('/tugas', 'DataTugasController');
  Route::get('{id}/download', 'DataTugasController@unduh')->name('tugas.download');
  Route::post('tugas/{id}/update', 'DataTugasController@update')->name('tugas.update');
  Route::get('/tugas/{id}/destroy', 'DataTugasController@destroy')->name('tugas.destroy');


  Route::resource('hasiltugas', 'HasilTugasController');
  Route::post('hasiltugas/ambil', 'HasilTugasController@ambil');
  Route::get('hasiltugas/download/{id}', 'HasilTugasController@download')->name('hasiltugas.download');



  // Route::resource('/absensiguru','AbsensiGuruController');
  Route::resource('/absensisiswa', 'AbsensiSiswaController');

  /**
   * Absensi Guru
   */
  Route::get('/absensi/guru', 'AbsensiController@guru')->name('absensi.guru.index');

  /**
   * Absensi Dosen
   * 
   */
  Route::get('/absensi/dosen', 'AbsensiController@dosenAbsen')->name('absensi.dosen.index');
  // Route::get('/absensi/siswa/{id}', 'AbsensiSiswaController@mahasiswaAbsen')->name('absensi.siswa.index');
  Route::post('/absensi/dosen/masuk', 'AbsensiController@dosenAbsenMasuk')->name('absen.masuk');
  Route::post('/absensi/dosen/keluar', 'AbsensiController@dosenAbsenKeluar')->name('absen.keluar');
  Route::post('/absensi/dosen/pengganti/masuk', 'AbsensiController@dosenAbsenPenggantiMasuk')->name('absen.pengganti.masuk');
  Route::post('/absensi/dosen/pengganti/keluar', 'AbsensiController@dosenAbsenPenggantiKeluar')->name('absen.pengganti.keluar');
  Route::post('/absensisp/dosen/masuk', 'AbsensiController@dosenAbsenSPMasuk')->name('absensp.masuk');
  Route::post('/absensisp/dosen/keluar', 'AbsensiController@dosenAbsenSPKeluar')->name('absensp.keluar');
  /**
   * Absensi Siswa
   *
   */
  Route::get('/absensi/siswa/{id_jadwal}', 'AbsensiController@mahasiswaAbsen')->name('absensi.siswa.index');
  Route::get('/absensi/siswa/get_kelas/{id}', 'AbsensiController@get_kelas_id');
  Route::get('/absensi/siswa/ubah_absen/{id}', 'AbsensiController@absensiMahasiswaMasuk');
  Route::post('/absensi/siswa', 'AbsensiController@siswaAbsensi')->name('absensi.siswa.cari');
  Route::get('/absensi/siswa/laporan', 'AbsensiController@siswaLaporan')->name('absensi.siswa.laporan');

  Route::get('/absensisp/siswa/{id_jadwal}', 'AbsensiController@mahasiswaAbsenSP')->name('absensisp.siswa.index');
  Route::get('/absensipengganti/siswa/{id_jadwal}', 'AbsensiController@mahasiswaAbsenPengganti')->name('absensipengganti.siswa.index');
  Route::get('/absensisp/siswa/get_mapel/{id}', 'AbsensiController@get_mapel_id');
  Route::get('/absensisp/siswa/ubah_absen/{id}', 'AbsensiController@absensiSPMahasiswaMasuk');
  Route::get('/absensipengganti/siswa/ubah_absen/{id}', 'AbsensiController@absensiPenggantiMahasiswaMasuk');

  Route::get('/absensi/kelas', 'AbsensiController@kelas')->name('absensi.mahasiswa.kelas');
  Route::get('/absensi/kelas/{kelas_id}/mahasiswa', 'AbsensiController@mahasiswaAbsensi')->name('absensi.mahasiswa');
  Route::post('/absensi/kelas/{kelas_id}/mahasiswa', 'AbsensiController@mahasiswaAbsensi')->name('absensi.mahasiswa.cari');
  Route::get('/absensi/kelas/{kelas_id}/mahasiswa/laporan', 'AbsensiController@mahasiswaLaporan')->name('absensi.mahasiswa.laporan');

  Route::resource('/pengumuman', 'PengumumanController');
  Route::get('/pengumuman/kelas/{id_jadwal}', 'PengumumanController@index')->name('pengumuman.kelas.index');
  Route::get('/pengumuman/kelas/get_kelas/{id}', 'PengumumanController@get_kelas_id');
  Route::delete('/pengumuman/destroy', 'PengumumanController@destroy')->name('pengumuman.destroy');
  Route::get('/pengumuman/get_id/{id}', 'PengumumanController@get_pengumuman_id');
  Route::post('/pengumuman/store', 'PengumumanController@store')->name('pengumuman.store');
  Route::get('/pengumuman/edit/{id}', 'PengumumanController@tambah')->name('pengumuman.edit');
  Route::post('/pengumuman/update', 'PengumumanController@update')->name('pengumuman.update');

  // BANK SOAL QUIZ

  Route::resource('/banksoal', 'BankSoalController');
  // Route::get('/banksoal','BankSoalController@index')->name('banksoal.index');
  // Route::post('/banksoal/{id}/quiz/destroy','BankSoalController@destroyQuiz')->name('banksoal.destroy');
  // Route::get('/banksoal/{id}/quiz/show','BankSoalController@show')->name('banksoal.show');
  Route::post('/banksoal/{id}/create-question', 'BankSoalController@createQuestions');
  Route::post('/banksoal/{id}/delete-question', 'BankSoalController@deleteQuestion');
  Route::post('/banksoal/{id}/update-question', 'BankSoalController@updateQuestion');
  Route::post('/banksoal/{id}/create-option', 'BankSoalController@createOption');
  Route::post('/banksoal/{id}/delete-option', 'BankSoalController@deleteOption');
  Route::post('/banksoal/{id}/update-option', 'BankSoalController@updateOption');
  Route::post('/banksoal/{id}/update-option-answer', 'BankSoalController@updateOptionAnswer');
  Route::post('/banksoal/{id}', 'BankSoalController@store');

  // TUGAS SISWA
  Route::post('/banksoal/tugas/tambah', 'DataTugasController@storeTugas')->name('tugas.store');


  /**
   * Jadwal Ujian
   */
  Route::resource('/jadwalujian', 'JadwalUjianController');
  Route::get('/jadwalujian/{id}/show', 'JadwalUjianController@show')->name('jadwalujian.show');
  Route::post('/jadwalujian/{id}/update', 'JadwalUjianController@update')->name('jadwalujian.update');
  Route::get('/jadwalujian/{id}/destroy', 'JadwalUjianController@destroy')->name('jadwalujian.destroy');
  Route::post('/jadwalujian/tambah', 'JadwalUjianController@tambahjadwalujian');
  /**
   * Jadwal Ujian Detail
   */
  Route::post('/jadwalujian/{id}/add', 'JadwalUjianController@add')->name('jadwalujian.add');
  Route::get('/jadwalujian/{id}/destroyDetail', 'JadwalUjianController@destroyDetail')->name('jadwalujian.destroyDetail');
  Route::post('/jadwalujian/{id}/updateDetail', 'JadwalUjianController@updateDetail')->name('jadwalujian.updateDetail');


  Route::resource('/evaluasisoal', 'EvaluasiSoalController');
  Route::post('evaluasisoal/ambil-kelas', 'EvaluasiSoalController@ambilKelas');
  Route::get('evaluasisoal/kuis/{kode_soal}/kelas/{kode_kelas}', 'EvaluasiSoalController@detailKelas')->name('evaluasi.detail');
  Route::get('evaluasisoal/jawaban/soal/{question_id}/kelas/{kelas_id}', 'EvaluasiSoalController@jawaban')->name('evaluasi.soal');

  Route::resource('/bobotdankkm', 'BobotDanKkmController');

  Route::resource('/nilaiharian', 'NilaiHarianController');
  Route::post('/nilaiharian/updatenilai/{id}/{nilai_id}', 'NilaiHarianController@updateNilai')->name('nilaiharian.updatenilai');
  Route::get('/nilaiharian/destroynilai/{id}/{nilai_id}', 'NilaiHarianController@destroyNilai')->name('nilaiharian.destroynilai');


  Route::resource('/nilaitugas', 'NilaiTugasController');
  Route::get('/nilaitugas/matkul/{id}', 'NilaiTugasController@kelas')->name('nilaitugas.listKelas');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}', 'NilaiTugasController@tugas')->name('nilaitugas.listTugas');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}', 'NilaiTugasController@mahasiswa')->name('nilaitugas.listMahasiswa');
  Route::post('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}/mahasiswa/{mahasiswa}', 'NilaiTugasController@store')->name('nilaitugas.store');
  Route::get('/nilaitugas/matkul/{id}/kelas/{kelas}/tugas/{tugas}/mahasiswa/{mahasiswa}', 'NilaiTugasController@update')->name('nilaitugas.update');
  Route::post('/nilaitugas/updatenilai/{id}/{nilai_id}', 'NilaiTugasController@updateNilai')->name('nilaitugas.updatenilai');
  Route::get('/nilaitugas/destroynilai/{id}/{nilai_id}', 'NilaiTugasController@destroyNilai')->name('nilaitugas.destroynilai');

  Route::resource('/nilaiakhir', 'NilaiAkhirController');
  Route::post('/nilaiakhir/updatenilaiakhir/{id}', 'NilaiAkhirController@updatenilai')->name('nilaiakhir.updatenilaiakhir');
  Route::get('/nilaiakhir/destroynilaiakhir/{id}/{id_na}', 'NilaiAkhirController@destroyNilaiAkhir')->name('nilaiakhir.destroynilaiakhir');

  // Dosen Input nilai KHS Mahasiswa
  /**
   * 1. Pilih Mata Kuliah pada data pengampu
   * 2. Pilih Kelas mengacu pada jadwal kuliah
   * 3. Tampilkan mahasiswa
   * 4. Input nilai-nilai dan mutu untuk mahasiswa
   */
  Route::get('/khs/matakuliah', 'KHSController@pilihMatkul')->name('pilih.matkul.khs');
  Route::get('/khs/matakuliah/{kode_mapel}/kelas', 'KHSController@pilihKelas')->name('pilih.kelas.khs');
  Route::get('/khs/matakuliah/{kode_mapel}/kelas/{kelas_id}/mahasiswa', 'KHSController@pilihMahasiswa')->name('pilih.mahasiswa.khs');
  Route::get('/khs/matakuliah/{kode_mapel}/kelas/{kelas_id}/mahasiswa/{id_mahasiswa}/detail', 'KHSController@detailMahasiswa')->name('pilih.mahasiswa.khs.detail');
  Route::post('/khs/matakuliah/{kode_mapel}/kelas/{kelas_id}/mahasiswa/{id_mahasiswa}/detail/{id}/store', 'KHSController@storeNilai')->name('input.mahasiswa.khs.detail');
  Route::post('/khs/matakuliah/{kode_mapel}/kelas/{kelas_id}/mahasiswa/{id_mahasiswa}/detail/{id}/update', 'KHSController@updateNilai')->name('update.mahasiswa.khs.detail');




  // Route::post('/nilaiharian/insert', 'NilaiHarianController@insert')->name('nilaiharian.insert');
  // Route::get('/nilaiharian','NilaiHarianController');
  // Route::get('/inputnilaiharian/inputnilai/{{kode_kelas}}','Guru\NilaiHarianController@inputnilai')->name('inputnilaiharian.inputnilai');


  Route::resource('/nilaiakhir', 'NilaiAkhirController', ['except' => ['store']]);

  Route::resource('/chat', 'ChatGuruController', ['except' => ['store']]);

  Route::get('/message/{id}', 'ChatGuruController@getMessage')->name('message');
  Route::post('message', 'ChatGuruController@sendMessage');

  // Route::resource('/walikelas/dataabsensi','WaliKelas\DataAbsensiController');


  Route::resource('/pengaturan', 'PengaturanGuruController');
  Route::post('/pengaturan/update', 'PengaturanGuruController@update')->name('pengaturan.update');
});

/**
 * Route Guru Walikelas
 */
Route::namespace('Guru\WaliKelas')->prefix('dosen')->name('guru.walikelas.')->middleware('can:view-walikelas')->group(function () {

  Route::resource('/datakelas', 'DataSiswaController');
  Route::resource('/datasiswa', 'DataSiswaController');
  // Route::get('/siswa','DataSiswaController@index');
  Route::resource('/dataabsensi', 'DataAbsensiController');

  Route::get('/dataabsensi/{id}/laporan/', 'DataAbsensiController@siswaLaporan')->name('dataabsensi.laporan');


  Route::resource('/datanilai', 'DataNilaiController');

  Route::resource('/datarapor', 'DataRaporController');
  Route::post('/datarapor/store/{id}/', 'DataRaporController@store')->name('datarapor.store');
  Route::post('/datarapor/storerapor/{id}/', 'DataRaporController@storeRapor')->name('datarapor.storerapor');
  Route::get('/datarapor/raporsiswa/{id}/', 'DataRaporController@showRapor')->name('datarapor.raporsiswa');
  Route::get('/datarapor/updaterapor/{id}/', 'DataRaporController@updateRapor')->name('datarapor.updaterapor');
  Route::post('/datarapor/updateraporsiswa/{id}/', 'DataRaporController@updateRaporSiswa')->name('datarapor.updateraporsiswa');
  // Route::post('/datarapor/getgradenilai/','DataRaporController@getGradeNilai')->name('datarapor.getgradenilai');

});

/**
 * Route Pegawai
 */
Route::namespace('Pegawai')->prefix('pegawai')->name('pegawai.')->middleware('role:pegawai')->group(function () {
  Route::get('/dashboard', 'DashboardPegawaiController@index')->name('halamanutama.index');
  Route::resource('/halamanutama', 'DashboardPegawaiController');


  Route::post('/halamanutama/buatcatatan', 'CatatanController@store');

  Route::post('/halamanutama/buatreminder', 'DashboardPegawaiController@buatReminder');

  Route::resource('/kalenderakademik', 'KalenderAkademikController');

  Route::resource('/datapegawai', 'DataPegawaiController');
  Route::get('/datapegawai/akademik/{id}/detailakademik/', 'DataPegawaiController@detailpegawaiakademik')->name('akademik.detail');
  Route::post('/datapegawai/akademik/{id}/data/update', 'DataPegawaiController@updateGuru')->name('akademik.update');
  Route::post('/datapegawai/akademik/data/tambah', 'DataPegawaiController@tambahGuru')->name('akademik.tambah');
  Route::get('/datapegawai/akademik/{id}/data/delete', 'DataPegawaiController@deleteGuru')->name('akademik.delete');

  Route::post('/datapegawai/create', 'DataPegawaiController@create')->name('datapegawai.create');



  Route::post('/datapegawai/akademik/{id}/tambah/gaji', 'DataPegawaiController@storeGajiGuru')->name('akademik.tambah.gaji');
  Route::post('/datapegawai/akademik/{id}/update/gaji/{id_gaji}', 'DataPegawaiController@updateGajiGuru')->name('akademik.update.gaji');
  Route::get('/datapegawai/akademik/{id}/delete/gaji/{id_gaji}', 'DataPegawaiController@deleteGajiGuru')->name('akademik.delete.gaji');

  Route::post('/datapegawai/akademik/{id}/tambah/sertifikat', 'DataPegawaiController@storeSertifikatGuru')->name('akademik.tambah.sertifikat');
  Route::post('/datapegawai/akademik/{id}/update/sertifikat/{id_sertifikat}', 'DataPegawaiController@updateSertifikatGuru')->name('akademik.update.sertifikat');
  Route::get('/datapegawai/akademik/{id}/delete/sertifikat/{id_sertifikat}', 'DataPegawaiController@deleteSertifikatGuru')->name('akademik.delete.sertifikat');

  Route::post('/datapegawai/akademik/{id}/tambah/pendidikan', 'DataPegawaiController@storePendidikanGuru')->name('akademik.tambah.pendidikan');
  Route::post('/datapegawai/akademik/{id}/update/pendidikan/{id_pendidikan}', 'DataPegawaiController@updatePendidikanGuru')->name('akademik.update.pendidikan');
  Route::get('/datapegawai/akademik/{id}/delete/pendidikan/{id_pendidikan}', 'DataPegawaiController@deletePendidikanGuru')->name('akademik.delete.pendidikan');

  Route::post('/datapegawai/akademik/{id}/tambah/pekerjaan', 'DataPegawaiController@storePekerjaanGuru')->name('akademik.tambah.pekerjaan');
  Route::post('/datapegawai/akademik/{id}/update/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@updatePekerjaanGuru')->name('akademik.update.pekerjaan');
  Route::get('/datapegawai/akademik/{id}/delete/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@deletePekerjaanGuru')->name('akademik.delete.pekerjaan');


  Route::get('/datapegawai/nonakademik/{id}/detailnonakademik', 'DataPegawaiController@detailpegawainonakademik')->name('nonakademik.detail');
  Route::post('/datapegawai/nonakademik/{id}/data/update', 'DataPegawaiController@updatePegawai')->name('nonakademik.update');
  Route::post('/datapegawai/nonakademik/data/tambah', 'DataPegawaiController@tambahPegawai')->name('nonakademik.tambah');
  Route::get('/datapegawai/nonakademik/{id}/data/delete', 'DataPegawaiController@deletePegawai')->name('nonakademik.delete');



  Route::post('/datapegawai/nonakademik/{id}/tambah/gaji', 'DataPegawaiController@storeGajiPegawai')->name('nonakademik.tambah.gaji');
  Route::post('/datapegawai/nonakademik/{id}/update/gaji/{id_gaji}', 'DataPegawaiController@updateGajiPegawai')->name('nonakademik.update.gaji');
  Route::get('/datapegawai/nonakademik/{id}/delete/gaji/{id_gaji}', 'DataPegawaiController@deleteGajiPegawai')->name('nonakademik.delete.gaji');

  Route::post('/datapegawai/nonakademik/{id}/tambah/sertifikat', 'DataPegawaiController@storeSertifikatPegawai')->name('nonakademik.tambah.sertifikat');
  Route::post('/datapegawai/nonakademik/{id}/update/sertifikat/{id_sertifikat}', 'DataPegawaiController@updateSertifikatPegawai')->name('nonakademik.update.sertifikat');
  Route::get('/datapegawai/nonakademik/{id}/delete/sertifikat/{id_sertifikat}', 'DataPegawaiController@deleteSertifikatPegawai')->name('nonakademik.delete.sertifikat');

  Route::post('/datapegawai/nonakademik/{id}/tambah/pendidikan', 'DataPegawaiController@storePendidikanPegawai')->name('nonakademik.tambah.pendidikan');
  Route::post('/datapegawai/nonakademik/{id}/update/pendidikan/{id_pendidikan}', 'DataPegawaiController@updatePendidikanPegawai')->name('nonakademik.update.pendidikan');
  Route::get('/datapegawai/nonakademik/{id}/delete/pendidikan/{id_pendidikan}', 'DataPegawaiController@deletePendidikanPegawai')->name('nonakademik.delete.pendidikan');

  Route::post('/datapegawai/nonakademik/{id}/tambah/pekerjaan', 'DataPegawaiController@storePekerjaanPegawai')->name('nonakademik.tambah.pekerjaan');
  Route::post('/datapegawai/nonakademik/{id}/update/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@updatePekerjaanPegawai')->name('nonakademik.update.pekerjaan');
  Route::get('/datapegawai/nonakademik/{id}/delete/pekerjaan/{id_pekerjaan}', 'DataPegawaiController@deletePekerjaanPegawai')->name('nonakademik.delete.pekerjaan');

  //Mutasi
  Route::post('/datapegawai/nonakademik/{id}/tambah/mutasi', 'DataPegawaiController@storeMutasiPegawai')->name('nonakademik.tambah.mutasi');
  Route::post('/datapegawai/nonakademik/{id}/update/mutasi/{id_mutasi}', 'DataPegawaiController@updateMutasiPegawai')->name('nonakademik.update.mutasi');
  Route::get('/datapegawai/nonakademik/{id}/delete/mutasi/{id_mutasi}', 'DataPegawaiController@deleteMutasiPegawai')->name('nonakademik.delete.mutasi');


  Route::resource('/datasiswa', 'DataSiswaController');
  Route::get('/datasiswa/{id}/detail', 'DataSiswaController@detaildatasiswa')->name('datasiswa.detail');
  Route::post('/datasiswa/{id}/updateSekolah', 'DataSiswaController@updateSekolahdatasiswa')->name('datasiswa.updateSekolah');
  Route::post('/datasiswa/{id}/updatePribadi', 'DataSiswaController@updatePribadidatasiswa')->name('datasiswa.updatePribadi');
  Route::post('/datasiswa/{id}/updatePendidikan', 'DataSiswaController@updatePendidikandatasiswa')->name('datasiswa.updatePendidikan');
  Route::post('/datasiswa/{id}/updateOrtu', 'DataSiswaController@updateOrtudatasiswa')->name('datasiswa.updateOrtu');

  Route::resource('/biaya', 'BiayaController');
  Route::post('/biaya/{id}/update', 'BiayaController@update')->name('biaya.update');
  Route::get('/biaya/{id}/hapus', 'BiayaController@destroy')->name('biaya.destroy');

  Route::post('/jenisbiaya/tambah', 'BiayaController@storeJenisBiaya')->name('tambah.jenisbiaya');
  Route::get('/jenisbiaya/{id}/hapus', 'BiayaController@destroyJenisBiaya')->name('hapus.jenisbiaya');

  Route::resource('/pembayaran', 'DataPembayaranController');
  Route::get('pembayaran/get/non/lunas', 'DataPembayaranController@getNonLunas')->name('pembayaran.nonlunas');
  Route::get('pembayaran/get/lunas', 'DataPembayaranController@getLunas')->name('pembayaran.lunas');

  Route::resource('/pengeluaran', 'PengeluaranController');
  Route::post('/pengeluaran/{id}/update', 'PengeluaranController@update')->name('pengeluaran.update');

  Route::resource('/pemasukan', 'PemasukanController');
  Route::post('/pemasukan/{id}/update', 'PemasukanController@update')->name('pemasukan.update');



  Route::get('/pegawai/datasiswa/detaildatasiswa', 'DataSiswaController@detaildatasiswa');

  Route::resource('/pengaturan', 'PengaturanPegawaiController');
  Route::post('/pengaturan/update', 'PengaturanPegawaiController@update')->name('pengaturan.update');
  Route::get('/datapegawai/nonakademik/{id}/hapus', 'DataPegawaiController@hapusNonAkademik')->name('nonakademik.hapus');

  // Route::resource('/datapegawai','DataPegawaiController', ['except' => ['store']]);
  // Route::get('/datapegawai/detailpegawai','DataPegawaiController@detailpegawai');

  /**
   * Jadwal Pelajaran
   *
   */
  Route::resource('/jadwal', 'JadwalPelajaranGuruController', ['except' => ['store']]);
  Route::post('/jadwal/generate', 'JadwalPelajaranGuruController@submit')->name('jadwal.generate');
  Route::post('/jadwal/create', 'JadwalPelajaranGuruController@create')->name('jadwal.create');
  Route::post('/jadwal/{id}/', 'JadwalPelajaranGuruController@edit')->name('jadwal.kelas.update');
  Route::get('/jadwal/{id}/delete', 'JadwalPelajaranGuruController@delete')->name('jadwal.kelas.delete');


  // Route Profil PT
  Route::get('/profilpt', 'ProfilPTController@index')->name('profilpt.index');
  Route::post('/profilpt/create', 'ProfilPTController@create')->name('profilpt.create');
  Route::post('/profilpt/{id}.update/', 'ProfilPTController@update')->name('profilpt.update');

  // Route Fakultas
  Route::get('/fakultas', 'FakultasController@index')->name('fakultas.index');
  Route::post('/fakultas/create', 'FakultasController@create')->name('fakultas.create');
  Route::post('/fakultas/{id}/update/', 'FakultasController@update')->name('fakultas.update');
  Route::get('/fakultas/{id}/destroy', 'FakultasController@destroy')->name('fakultas.destroy');

  // Route Jurusan
  Route::get('/jurusan', 'JurusanController@index')->name('jurusan.index');
  Route::post('/jurusan/create', 'JurusanController@create')->name('jurusan.create');
  Route::post('/jurusan/{id}/update/', 'JurusanController@update')->name('jurusan.update');
  Route::get('/jurusan/{id}/destroy', 'JurusanController@destroy')->name('jurusan.destroy');

  // Route Prodi
  Route::get('/prodi', 'ProdiController@index')->name('prodi.index');
  Route::post('/prodi/create', 'ProdiController@create')->name('prodi.create');
  Route::post('/prodi/{id}/update/', 'ProdiController@update')->name('prodi.update');
  Route::get('/prodi/{id}/destroy', 'ProdiController@destroy')->name('prodi.destroy');

  //Route Jenjang
  Route::get('/jenjang', 'JenjangController@index')->name('jenjang.index');
  Route::post('/jenjang/create', 'JenjangController@create')->name('jenjang.create');
  Route::post('/jenjang/{id}/update/', 'JenjangController@update')->name('jenjang.update');
  Route::get('/jenjang/{id}/destroy', 'JenjangController@destroy')->name('jenjang.destroy');

  //Route Data Mahasiswa
  Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
  Route::post('/mahasiswa/create', 'MahasiswaController@create')->name('mahasiswa.create');
  Route::get('/mahasiswa/{id}/edit', 'MahasiswaController@edit')->name('mahasiswa.edit');
  Route::get('/mahasiswa/{id}/delete', 'MahasiswaController@delete')->name('mahasiswa.delete');



  Route::post('/mahasiswa/{id}/updatedatakampus', 'MahasiswaController@updateDataKampus')->name('mahasiswa.updatedatakampus');
  Route::post('/mahasiswa/{id}/updatedatadiri', 'MahasiswaController@updateDataDiri')->name('mahasiswa.updatedatadiri');
  Route::post('/mahasiswa/{id}/updatedataorangtua', 'MahasiswaController@updateDataOrangTua')->name('mahasiswa.updatedataorangtua');
  Route::post('/mahasiswa/{id}/updatedatalain', 'MahasiswaController@updateDataLain')->name('mahasiswa.updatedatalain');
  Route::get('/mahasiswa/store/{id}', 'MahasiswaController@store')->name('mahasiswa.store');

  Route::post('/mahasiswa/{id}/updatedatakampus', 'MahasiswaController@updateDataKampus')->name('mahasiswa.updatedatakampus');
  Route::post('/mahasiswa/{id}/updatedatadiri', 'MahasiswaController@updateDataDiri')->name('mahasiswa.updatedatadiri');
  Route::post('/mahasiswa/{id}/updatedataorangtua', 'MahasiswaController@updateDataOrangTua')->name('mahasiswa.updatedataorangtua');
  Route::post('/mahasiswa/{id}/updatedatalain', 'MahasiswaController@updateDataLain')->name('mahasiswa.updatedatalain');
  Route::get('/mahasiswa/store/{id}', 'MahasiswaController@store')->name('mahasiswa.store');
  Route::get('/mahasiswa/prodi/{id}', 'MahasiswaController@prodi')->name('mahasiswa.prodi');

  Route::get('/mahasiswa/export/', 'MahasiswaController@mahasiswaExport')->name('mahasiswa.export');
  Route::post('/mahasiswa/import/', 'MahasiswaController@mahasiswaImport')->name('mahasiswa.import');

  //Route Data Dosen
  Route::get('/dosen', 'DosenController@index')->name('dosen.index');
  Route::post('/dosen/create', 'DosenController@create')->name('dosen.create');
  Route::get('/dosen/{id}/edit', 'DosenController@edit')->name('dosen.edit');
  Route::get('/dosen/{id}/destroy', 'DosenController@destroy')->name('dosen.destroy');
  Route::get('/dosen/store/{id}', 'DosenController@store')->name('dosen.store');

  Route::post('/dosen/{id}/updatedatakampus', 'DosenController@updateDataKampus')->name('dosen.updatedatakampus');
  Route::post('/dosen/{id}/updatedatapribadi', 'DosenController@updateDataPribadi')->name('dosen.updatedatapribadi');
  Route::post('/dosen/{id}/updatelainnya', 'DosenController@updateLainnya')->name('dosen.updatelainnya');

  Route::get('/dosen/export/', 'DosenController@dosenExport')->name('dosen.export');
  Route::post('/dosen/import/', 'DosenController@dosenImport')->name('dosen.import');
  /*
    Kurikulum
  */
  Route::get('/kurikulum', 'KurikulumController@index')->name('kurikulum.index');
  Route::post('/kurikulum/create', 'KurikulumController@create')->name('kurikulum.create');
  Route::post('/kurikulum/{id}/', 'KurikulumController@update')->name('kurikulum.update');
  Route::get('/kurikulum/{id}/destroy', 'KurikulumController@destroy')->name('kurikulum.destroy');
  Route::get('/kurikulum/jurusan/{id}', 'KurikulumController@jurusan')->name('kurikulum.jurusan');
  Route::get('/kurikulum/prodi/{id}', 'KurikulumController@prodi')->name('kurikulum.prodi');
  /**
   * Mata Kuliah
   */
  Route::post('/matakuliah/create', 'MataKuliahController@create')->name('matakuliah.create');
  Route::post('/matakuliah/{id}/', 'MataKuliahController@update')->name('matakuliah.update');
  Route::get('/matakuliah/{id}/destroy', 'MataKuliahController@destroy')->name('matakuliah.destroy');
  /**
   * Modul Mata Kuliah
   */
  Route::post('/modulmatkul/create', 'ModulMatkulController@create')->name('modulmatkul.create');
  Route::post('/modulmatkul/{id}/', 'ModulMatkulController@update')->name('modulmatkul.update');
  Route::get('/modulmatkul/{id}/destroy', 'ModulMatkulController@destroy')->name('modulmatkul.destroy');
  Route::get('/modulmatkul/prodi/{id}', 'ModulMatkulController@prodi')->name('modulmatkul.prodi');
  // route MataKuliah
  Route::get('/matakuliah', 'MataKuliahController@index')->name('matakuliah.index');

  // route Modul MataKuliah
  Route::get('/modulmatkul', 'ModulMatkulController@index')->name('modulmatkul.index');


  //Materi Pelajaran
  Route::resource('/materipelajaran', 'MateriPelajaranController', ['except' => ['store']]);
  Route::get('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/detail', 'MateriPelajaranController@show')->name('materipelajaran.show');
  Route::get('/materipelajaran/detailmateri', 'MateriPelajaranController@detailmateri');
  Route::post('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/store', 'MateriPelajaranController@store')->name('materipelajaran.store');
  Route::post('/materipelajaran/update/{id}/dosen/{id_dosen}', 'MateriPelajaranController@updateMateri')->name('materipelajaran.update');
  Route::get('/materipelajaran/{id}/destroy', 'MateriPelajaranController@destroy')->name('materipelajaran.destroy');

  //Tugas
  Route::get('tugas/{id}/download', 'MateriPelajaranController@unduh')->name('tugas.download');

  Route::post('/materipelajaran/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}/storeTugas', 'MateriPelajaranController@storeTugas')->name('materipelajaran.storeTugas');
  Route::post('materipelajaran/updateTugas/{id}/dosen/{id_dosen}', 'MateriPelajaranController@updateTugas')->name('materipelajaran.updateTugas');
  Route::get('/materipelajaran/{id}/tugasDestroy', 'MateriPelajaranController@tugasDestroy')->name('materipelajaran.tugasDestroy');




  /**
   * Route data kelas
   */

  Route::get('/kelas', 'KelasController@index')->name('kelas.index'); //list kelas yg sudah dibuat
  Route::post('/kelas/store', 'KelasController@store')->name('kelas.store'); //buat kelas baru
  Route::post('/kelas/{id}/update', 'KelasController@update')->name('kelas.update'); //update kelas baru
  Route::get('/kelas/{id}/destroy', 'KelasController@destroy')->name('kelas.destroy'); //delete kelas baru

  //Route Bank Soal


  Route::get('/kumpulansoal', 'KumpulanSoalController@index')->name('kumpulansoal.index');
  Route::delete('/kumpulansoal/destroy/{id}', 'KumpulanSoalController@destroy')->name('kumpulansoal.destroy');
  Route::get('/kumpulansoal/show/{id}', 'KumpulanSoalController@show')->name('kumpulansoal.show');
  Route::get('/kumpulansoal/edit/{id}', 'KumpulanSoalController@edit')->name('kumpulansoal.edit');
  Route::put('/kumpulansoal/update/{id}', 'KumpulanSoalController@update')->name('kumpulansoal.update');
  Route::get('/kumpulansoal/pengampu/{id}', 'KumpulanSoalController@list')->name('kumpulansoal.listSoal');
  Route::post('/kumpulansoal/store/dosen/{id}/matkul/{mapel}/prodi/{id_prodi}/semester/{semester}/tahun_ajaran/{tahun_ajaran}', 'KumpulanSoalController@store')->name('kumpulansoal.store');
  Route::post('/kumpulansoal/{id}/create-question', 'KumpulanSoalController@createQuestions');
  Route::post('/kumpulansoal/{id}/delete-question', 'KumpulanSoalController@deleteQuestion');
  Route::post('/kumpulansoal/{id}/update-question', 'KumpulanSoalController@updateQuestion');
  Route::post('/kumpulansoal/{id}/create-option', 'KumpulanSoalController@createOption');
  Route::post('/kumpulansoal/{id}/delete-option', 'KumpulanSoalController@deleteOption');
  Route::post('/kumpulansoal/{id}/update-option', 'KumpulanSoalController@updateOption');
  Route::post('/kumpulansoal/{id}/update-option-answer', 'KumpulanSoalController@updateOptionAnswer');

  // Route::get('/kumpulansoal/id_dosen/{id}/mapel/{mapel}', 'KumpulanSoalController@prodi')->name('kumpulansoal.prodi');
  // Route::get('/kumpulansoal/mapel/{id}/prodi/{id_prodi}', 'KumpulanSoalController@semester')->name('kumpulansoal.semester');
  // Route::get('/kumpulansoal/mapel/{id}/prodi/{id_prodi}/semester/{semester}', 'KumpulanSoalController@tahunAjaran')->name('kumpulansoal.tahunajaran');


  Route::resource('/evaluasisoal', 'EvaluasiSoalController');
  Route::get('/evaluasisoal/detailevaluasi/{id}/{id_kelas}', 'EvaluasiSoalController@detailEvaluasi')->name('evaluasisoal.detailevaluasi');
  Route::get('/evaluasisoal/jawaban/soal/{question_id}/kelas/{kelas_id}', 'EvaluasiSoalController@jawaban')->name('evaluasi.soal');
});


/**
 * Route Siswa
 */
Route::namespace('Siswa')->prefix('student')->name('siswa.')->middleware('role:mahasiswa')->group(function () {
  Route::get('/dashboard', 'DashboardSiswaController@index')->name('halamanutama.index');
  Route::resource('/halamanutama', 'DashboardSiswaController');
  Route::get('/get_data_pengumuman', 'DashboardSiswaController@get_data_pengumuman');
  Route::resource('/kalenderakademik', 'KalenderAkademikController');

  Route::get('/datapribadi/edit', 'DataPribadiController@editProfile')->name('datapribadi.editing');
  Route::post('/datapribadi/update', 'DataPribadiController@updateProfile')->name('datapribadi.updating');
  Route::resource('/datapribadi', 'DataPribadiController');

  Route::get('/mahasiswa/getKecamatan/{id}', 'DataPribadiController@getKecamatan')->name('get.kecamatan');

  Route::resource('/dataabsensi', 'DataAbsensiController');
  Route::post('/dataabsensi/cariabsen', 'DataAbsensiController@cariAbsen')->name('dataabsensi.cariabsen');

  // Route::get('/dataabsensi/detaildataabsensi','DataAbsensiController@detaildataabsensi');

  Route::resource('/materipelajaran', 'MateriPelajaranController');

  Route::resource('/datanilai', 'DataNilaiController');
  Route::post('/datanilai/carinilai', 'DataNilaiController@cariNilai')->name('datanilai.carinilai');

  Route::resource('/jadwalpelajaran', 'JadwalPelajaranSiswaController');

  Route::resource('/datatugas', 'DataTugasController');
  Route::post('/datatugas/{id}/upload', 'DataTugasController@upload')->name('upload.tugas');


  Route::resource('/datakuis', 'DataKuisController');
  Route::get('/datakuis/kuis/getRequset', 'DataKuisController@getRequset');
  Route::get('/datakuis/mulaikuis/{id}', 'DataKuisController@mulaikuis')->name('datakuis.mulaikuis');
  Route::post('/datakuis/mulaikuis/jawab', 'DataKuisController@jawab');
  Route::post('/datakuis/mulaikuis/{id}/create-result-quiz', 'DataKuisController@createStatusQuiz');
  Route::get('/datakuis/kuis/{id}', 'DataKuisController@kuis')->name('datakuis.kuis');
  Route::get('/datakuis/kuis/{id}/fetch_data', 'DataKuisController@fetch_data')->name('datakuis.fetch_data');
  Route::get('/datakuis/kuis/{id}', 'DataKuisController@kuis')->name('datakuis.kuis');
  Route::get('datakuis/get-soal/{id}', 'DataKuisController@getSoal');


  Route::resource('/dataujian', 'DataUjianController');
  Route::get('/dataujian/ujian/getRequset', 'DataUjianController@getRequset');
  Route::get('/dataujian/mulaiujian/{id}', 'DataUjianController@mulaiujian')->name('dataujian.mulaiujian');
  Route::post('/dataujian/mulaiujian/jawab', 'DataUjianController@jawab');
  Route::post('/dataujian/mulaiujian/{id}/create-result-quiz', 'DataUjianController@createStatusQuiz');
  Route::get('/dataujian/ujian/{id}', 'DataUjianController@ujian')->name('dataujian.ujian');
  Route::get('/dataujian/ujian/{id}/fetch_data', 'DataUjianController@fetch_data')->name('dataujian.fetch_data');
  Route::get('/dataujian/ujian/{id}', 'DataUjianController@ujian')->name('dataujian.ujian');
  Route::get('dataujian/get-soal/{id}', 'DataUjianController@getSoal');

  /**
   * Absen Mahasiswa
   * 
   */
  Route::post('absensi/student/masuk/', 'AbsensiController@absensiMahasiswaMasuk')->name('absen.masuk');
  Route::post('absensi/student/keluar', 'AbsensiController@absensiMahasiswaKeluar')->name('absen.keluar');
  Route::post('/absensi/student/pengganti/masuk', 'AbsensiController@absensiMahasiswaPenggantiMasuk')->name('absen.pengganti.masuk');
  Route::post('/absensi/student/pengganti/keluar', 'AbsensiController@absensiMahasiswaPenggantiKeluar')->name('absen.pengganti.keluar');
  Route::post('absensisp/student/masuk/', 'AbsensiController@absensiSPMahasiswaMasuk')->name('absensp.masuk');
  Route::post('absensisp/student/keluar', 'AbsensiController@absensiSPMahasiswaKeluar')->name('absensp.keluar');

  Route::resource('/pembayaran', 'DataPembayaranController');

  Route::resource('/peminjamanbuku', 'PeminjamanBukuController');

  Route::resource('/raporsiswa', 'RaporSiswaController');
  Route::post('/raporsiswa/carilapor', 'RaporSiswaController@cariDataLapor')->name('raporsiswa.carilapor');

  Route::resource('/chat', 'ChatSiswaController');
  Route::get('/message/{id}', 'ChatSiswaController@getMessage')->name('message');
  Route::post('message', 'ChatSiswaController@sendMessage');

  Route::resource('/pengaturan', 'PengaturanSiswaController');
  Route::post('/pengaturan/update', 'PengaturanSiswaController@update')->name('pengaturan.update');

  //Route Data Ebook

  Route::get('/dataebook', 'DataEBookController@index')->name('dataebook.index');
  // Route::get('/databuku', 'DataBukuController@index')->name('databuku.index');
  Route::get('/dataskripsi', 'DataSkripsiController@index')->name('dataskripsi.index');

  Route::get('/databuku', 'DataBukuController@index2')->name('databuku.index');
  Route::get('/get_data_buku', 'DataBukuController@get_databuku');

  /**
   * KHS Mahasiswa
   * 
   */
  Route::get('/khs', 'KHSController@index')->name('khs.index');
  Route::get('/krs', 'KRSController@index')->name('krs.index');
  Route::get('/sp', 'KRSController@create')->name('sp.create');
  Route::post('/sp/tambah/', 'KRSController@store')->name('sp.store');
});

/**
 * Route Perpustakaan
 */
Route::namespace('Perpustakaan')->prefix('perpustakaan')->name('perpustakaan.')->middleware('role:perpustakaan')->group(function () {

  Route::resource('/halamanutama', 'DashboardPerpustakaanController');
  Route::post('/halamanutama/carilaporanpinjaman', 'DashboardPerpustakaanController@cariLaporanPeminjaman')->name('halamanutama.carilaporanpinjaman');

  Route::resource('/pengaturan', 'PengaturanPerpustakaanController');


  //Route::get('/databuku', 'DataBukuController@index')->name('databuku.index');
  Route::post('/databuku/store', 'DataBukuController@store')->name('databuku.store');
  Route::get('/databuku/show/{id}', 'DataBukuController@show')->name('databuku.show');
  Route::get('/databuku/tambahbuku', 'DataBukuController@tambah')->name('databuku.tambahbuku');
  Route::get('/databuku/tambahebook', 'DataBukuController@tambahebook')->name('databuku.tambahebook');
  Route::get('/databuku/editbuku/{id}', 'DataBukuController@edit')->name('databuku.editbuku');
  Route::get('/databuku/editebook/{id}', 'DataBukuController@editebook')->name('databuku.editebook');
  Route::get('/databuku/editkategori/{id}', 'DataBukuController@editkategori')->name('databuku.editkategori');
  Route::get('/databuku/editdistributor/{id}', 'DataBukuController@editdistributor')->name('databuku.editdistributor');

  Route::post('/databuku/update', 'DataBukuController@update')->name('databuku.update');

  Route::post('/databuku/storeEBook', 'DataBukuController@storeEBook')->name('databuku.storeEBook');
  Route::get('/databuku/publish/{id}', 'DataBukuController@publish')->name('databuku.publish');
  Route::delete('/databuku/destroy/{id}', 'DataBukuController@destroy')->name('databuku.destroy');
  Route::delete('/databuku/destroyEBook/{id}', 'DataBukuController@destroyEBook')->name('databuku.destroyEBook');
  Route::post('/databuku/updateEBook', 'DataBukuController@updateEBook')->name('databuku.updateEBook');

  // CRUD DISTRIBOTOR BUKU
  Route::post('/databuku/distributor/tambah/{id}', 'DataBukuController@tambahDistributorBuku')->name('databuku.distributor.tambah');
  Route::post('/databuku/distributor/{id_buku}/update/{id_distributor}', 'DataBukuController@updateDistributorBuku')->name('databuku.distributor.update');
  Route::get('/databuku/distributor/{id_buku}/delete/{id_distributor}', 'DataBukuController@deleteDistributorBuku')->name('databuku.distributor.delete');

  // CRUD KATEGORI BUKU
  Route::post('/databuku/datakategori/tambah', 'DataBukuController@tambahKategori')->name('databuku.datakategori.tambah');
  Route::post('/databuku/datakategori/update', 'DataBukuController@updateKategori')->name('databuku.datakategori.update');
  Route::delete('/databuku/datakategori/delete', 'DataBukuController@deleteKategori')->name('databuku.datakategori.delete');

  // CRUD DISTRIBOTOR BUKU
  Route::post('/databuku/datadistributor/tambah', 'DataBukuController@tambahDistributor')->name('databuku.datadistributor.tambah');
  Route::post('/databuku/datadistributor/update', 'DataBukuController@updateDistributor')->name('databuku.datadistributor.update');
  Route::delete('/databuku/datadistributor/delete', 'DataBukuController@deleteDistributor')->name('databuku.datadistributor.delete');


  Route::resource('/transaksibuku', 'TransaksiBukuController');
  // Route::post('/transaksibuku/peminjaman','TransaksiBukuController@tambahPeminjaman')->name('transaksibuku.peminjaman');

  Route::resource('/kondisibuku', 'KondisiBukuController');

  // CRUD LITS KONDISI
  Route::post('/databuku/listkondisi/tambah', 'KondisiBukuController@tambahKondisi')->name('databuku.listkondisi.tambah');
  Route::post('/databuku/listkondisi/{id}/update', 'KondisiBukuController@updateKondisi')->name('databuku.listkondisi.update');
  Route::get('/databuku/listkondisi/{id}/delete', 'KondisiBukuController@deleteKondisi')->name('databuku.listkondisi.delete');

  Route::post('/dataskripsi/destroyDataSkripsi', 'DataSkripsiController@destroy')->name('dataskripsi.destroyDataSkripsi');
  Route::get('/dataskripsi', 'DataSkripsiController@index')->name('dataskripsi.index');
  Route::get('/dataskripsi', 'DataSkripsiController@index')->name('dataskripsi.index');
  Route::post('/dataskripsi/ubahDataSkripsi', 'DataSkripsiController@ubahdataskripsi')->name('dataskripsi.ubahdataskripsi');
  Route::post('/dataskripsi/tambahDataSkripsi', 'DataSkripsiController@store')->name('dataskripsi.store');
  Route::get('/databuku', 'DataBukuController@index2')->name('databuku.index');
  Route::get('/get_data_buku', 'DataBukuController@get_databuku');
  Route::get('/get_data_buku/{id}', 'DataBukuController@get_data_buku');
  Route::get('/get_data_ebook', 'DataBukuController@get_dataebook');
  Route::get('/get_data_review', 'DataBukuController@get_reviewebook');
  Route::get('/get_data_ebook/{id}', 'DataBukuController@get_data_ebook');
  Route::get('/get_kategori', 'DataBukuController@get_kategori');
  Route::get('/get_kategori_id/{id}', 'DataBukuController@get_kategori_id');
  Route::get('/get_distributor', 'DataBukuController@get_distributor');
  Route::get('/get_distributor_id/{id}', 'DataBukuController@get_distributor_id');

  Route::get('/dataskripsi/get_penulis', 'DataSkripsiController@get_penulis');
  Route::get('/dataskripsi/get_prodi', 'DataSkripsiController@get_prodi');
});
