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

Route::get('login','Auth\LoginController@getLogin')->name('login');
Route::post('login','Auth\LoginController@postLogin')->name('post_login');
Route::get('logout','Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {

  Route::get('/','HomeController@index')->name('home');
  // Route::get('syn');

  Route::middleware('role:root|admin_sas')->group(function () {
    Route::group(['prefix' => 'buku-induk'], function() {
      Route::get('/', 'BukuIndukController@index')->name('buku_induk_index');
      Route::get('detail/{nis}', 'BukuIndukController@detail')->name('buku_induk_detail');
      Route::get('pdf/{nis}', 'BukuIndukController@exportToPdf')->name('buku_induk_pdf');
    });

    Route::group(['prefix'=>'kalender-akademik'], function () {
      Route::get('/','KalenderAkademikController@index')->name('kalender_akademik_index');
      Route::get('create','KalenderAkademikController@create')->name('kalender_akademik_create');
      Route::post('/','KalenderAkademikController@store')->name('kalender_akademik_store');
      Route::post('update','KalenderAkademikController@update')->name('kalender_akademik_update');
      Route::get('{id}','KalenderAkademikController@show')->name('kalender_akademik_show');
      Route::get('{id}/edit','KalenderAkademikController@edit')->name('kalender_akademik_edit');
      Route::get('{id}/destroy','KalenderAkademikController@destroy')->name('kalender_akademik_destroy');
    });

    Route::group(['prefix' => 'ajax'], function() {
      Route::get('{idjurusan}/kelas', 'AjaxController@getKelas')->name('ajax_get_kelas');
      Route::get('tingkat/{idtingkat}/kelas', 'AjaxController@getKelasTingkat')->name('ajax_get_kelas_tingkat');
      Route::get('{idprov}/kota', 'AjaxController@getKota')->name('ajax_get_kota');
      Route::get('{idkota}/kecamatan', 'AjaxController@getKec')->name('ajax_get_kecamatan');
      Route::get('{idkec}/kelurahan', 'AjaxController@getKel')->name('ajax_get_kelurahan');
      Route::get('{idkel}/siswa', 'AjaxController@getSiswa')->name('ajax_get_siswa');
      Route::get('{kelas_id}/siswa/all', 'AjaxController@getAllSiswa')->name('ajax_get_siswa_all');
    });

    Route::group(['prefix' => 'hari'], function() {
      Route::get('/', 'HariController@index')->name('hari_index');
      Route::get('create', 'HariController@create')->name('hari_create');
      Route::post('create', 'HariController@store')->name('hari_store');
      Route::get('{id}/edit', 'HariController@edit')->name('hari_edit');
      Route::post('update', 'HariController@update')->name('hari_update');
      Route::get('{id}/delete', 'HariController@delete')->name('hari_delete');
    });

    Route::group(['prefix' => 'jurusan'], function() {
      Route::get('/', 'JurusanController@index')->name('jurusan_index');
      Route::get('create', 'JurusanController@create')->name('jurusan_create');
      Route::post('create', 'JurusanController@store')->name('jurusan_store');
      Route::get('{id}/edit', 'JurusanController@edit')->name('jurusan_edit');
      Route::post('update', 'JurusanController@update')->name('jurusan_update');
      Route::get('{id}/delete', 'JurusanController@delete')->name('jurusan_delete');
      Route::get('rekap', 'JurusanController@rekap')->name('jurusan_rekap');
      Route::get('ekspor', 'JurusanController@rekap_ekspor')->name('jurusan_ekspor');
    });

    Route::group(['prefix' => 'tingkat'], function() {
      Route::get('/', 'TingkatController@index')->name('tingkat_index');
      Route::get('create', 'TingkatController@create')->name('tingkat_create');
      Route::post('create', 'TingkatController@store')->name('tingkat_store');
      Route::get('{id}/edit', 'TingkatController@edit')->name('tingkat_edit');
      Route::post('update', 'TingkatController@update')->name('tingkat_update');
      Route::get('{id}/delete', 'TingkatController@delete')->name('tingkat_delete');
    });

    Route::group(['prefix' => 'kelas'], function() {
      Route::get('/', 'KelasController@index')->name('kelas_index');
      Route::get('create', 'KelasController@create')->name('kelas_create');
      Route::post('create', 'KelasController@store')->name('kelas_store');
      Route::get('{id}/edit', 'KelasController@edit')->name('kelas_edit');
      Route::post('update', 'KelasController@update')->name('kelas_update');
      Route::get('{id}/delete', 'KelasController@delete')->name('kelas_delete');
      Route::get('rekap', 'KelasController@rekap')->name('kelas_rekap');
      Route::get('rekap/export', 'KelasController@export')->name('kelas_rekap_export');
    });

    Route::group(['prefix' => 'tahun-ajaran'], function() {
      Route::get('/', 'TahunAjaranController@index')->name('tahun_index');
      Route::get('create', 'TahunAjaranController@create')->name('tahun_create');
      Route::post('create', 'TahunAjaranController@store')->name('tahun_store');
      Route::get('{id}/edit', 'TahunAjaranController@edit')->name('tahun_edit');
      Route::post('update', 'TahunAjaranController@update')->name('tahun_update');
      Route::get('{id}/delete', 'TahunAjaranController@delete')->name('tahun_delete');
    });

    Route::group(['prefix' => 'kelompok-pelajaran'], function() {
      Route::get('/', 'PelajaranController@kelompok_index')->name('kelompok_index');
      Route::get('create', 'PelajaranController@kelompok_create')->name('kelompok_create');
      Route::post('create', 'PelajaranController@kelompok_store')->name('kelompok_store');
      Route::get('{id}/edit', 'PelajaranController@kelompok_edit')->name('kelompok_edit');
      Route::post('update', 'PelajaranController@kelompok_update')->name('kelompok_update');
      Route::get('{id}/delete', 'PelajaranController@kelompok_delete')->name('kelompok_delete');
    });

    Route::group(['prefix' => 'pelajaran'], function() {
      Route::get('/', 'PelajaranController@index')->name('pelajaran_index');
      Route::get('search', 'PelajaranController@search')->name('pelajaran_search');
      Route::get('create', 'PelajaranController@create')->name('pelajaran_create');
      Route::post('create', 'PelajaranController@store')->name('pelajaran_store');
      Route::get('{id}/edit', 'PelajaranController@edit')->name('pelajaran_edit');
      Route::post('update', 'PelajaranController@update')->name('pelajaran_update');
      Route::get('{id}/delete', 'PelajaranController@delete')->name('pelajaran_delete');
    });

    Route::group(['prefix' => 'sekolah'], function() {
      Route::get('/', 'SekolahController@index')->name('sekolah_index');
      Route::post('/', 'SekolahController@store')->name('sekolah_store');
      Route::post('update', 'SekolahController@update')->name('sekolah_update');
    });

    // Route::group(['prefix' => 'sekolah'], function() {
    //   Route::get('/', 'SekolahController@index')->name('sekolah_index');
    //   Route::get('create', 'SekolahController@create')->name('sekolah_create');
    //   Route::get('{id}/delete', 'SekolahController@delete')->name('sekolah_delete');
    // });

    Route::group(['prefix' => 'guru'], function() {
      Route::get('/', 'GuruController@index')->name('guru_index');
      Route::get('search', 'GuruController@search')->name('guru_search');
      Route::get('export/data-ujian', 'GuruController@data_ujian')->name('guru_data_ujian');
      Route::get('export/pdf', 'GuruController@exportToPdf')->name('guru_export_pdf');
      Route::get('export/excel', 'GuruController@exportToExcel')->name('guru_export_excel');
      Route::post('import/excel', 'GuruController@importFromExcel')->name('guru_import_excel');
      Route::get('sample/excel', 'GuruController@excelSample')->name('guru_sample_excel');
      Route::group(['prefix' => 'create'], function() {
        Route::get('/', 'GuruController@create')->name('guru_create');
        Route::post('/', 'GuruController@store')->name('guru_store');
        Route::get('education', 'GuruController@create_education')->name('guru_create_education');
        Route::post('education', 'GuruController@store_education')->name('guru_store_education');
        Route::get('experience', 'GuruController@create_experience')->name('guru_create_experience');
        Route::post('experience', 'GuruController@store_experience')->name('guru_store_experience');
        Route::get('status', 'GuruController@create_status')->name('guru_create_status');
        Route::post('status', 'GuruController@store_status')->name('guru_store_status');
      });
      Route::group(['prefix' => '{id}/edit'], function() {
        Route::get('/', 'GuruController@edit')->name('guru_edit');
        Route::get('education', 'GuruController@edit_education')->name('guru_edit_education');
        Route::get('experience', 'GuruController@edit_experience')->name('guru_edit_experience');
        Route::get('status', 'GuruController@edit_status')->name('guru_edit_status');
      });
      Route::group(['prefix' => 'update'], function() {
        Route::post('/', 'GuruController@update')->name('guru_update');
        Route::post('education', 'GuruController@update_education')->name('guru_update_education');
        Route::post('experience', 'GuruController@update_experience')->name('guru_update_experience');
        Route::post('status', 'GuruController@update_status')->name('guru_update_status');
      });
      Route::group(['prefix' => '{id}/pelajaran'], function () {
        Route::get('/', 'GuruMataPelajaranController@index')->name('guru_mata_pelajaran_index');
        Route::post('/', 'GuruMataPelajaranController@storeTeacherLessons')->name('guru_mata_pelajaran_store');
      });
      Route::get('{id}/delete', 'GuruController@delete')->name('guru_delete');
    });

    Route::group(['prefix' => 'jadwal-pelajaran'], function() {
      Route::get('/', 'JadwalController@index')->name('jadwal_index');
      Route::get('create', 'JadwalController@create')->name('jadwal_create');
      Route::post('create', 'JadwalController@store')->name('jadwal_store');
      Route::get('{id}/edit', 'JadwalController@edit')->name('jadwal_edit');
      Route::post('update', 'JadwalController@update')->name('jadwal_update');
      Route::get('{id}/delete', 'JadwalController@delete')->name('jadwal_delete');
      Route::get('rekap/{semester?}/{hari_id?}', 'JadwalController@rekap')->name('jadwal_rekap');
      Route::get('rekap/ekspor/{semester}/{hari_id}', 'JadwalController@ekspor')->name('jadwal_ekspor');
    });

    Route::group(['prefix' => 'siswa'], function() {
      Route::get('/', 'SiswaController@index')->name('siswa_index');
      Route::get('search', 'SiswaController@search')->name('siswa_search');
      Route::get('export/data-ujian', 'SiswaController@data_ujian')->name('siswa_data_ujian');
      Route::get('export/custom', 'SiswaController@customExport')->name('siswa_custom_export');
      Route::get('export/pdf', 'SiswaController@exportToPdf')->name('siswa_export_pdf');
      Route::get('export/excel', 'SiswaController@exportToExcel')->name('siswa_export_excel');
      Route::post('import/excel', 'SiswaController@importFromExcel')->name('siswa_import_excel');
      Route::get('sample/excel', 'SiswaController@excelSample')->name('siswa_sample_excel');
      Route::group(['prefix' => 'create'], function() {
        Route::get('/', 'SiswaController@create')->name('siswa_create');
        Route::post('/', 'SiswaController@store')->name('siswa_store');
        Route::get('health', 'SiswaController@create_health')->name('siswa_create_health');
        Route::post('health', 'SiswaController@store_health')->name('siswa_store_health');
        Route::get('family', 'SiswaController@create_family')->name('siswa_create_family');
        Route::post('family', 'SiswaController@store_family')->name('siswa_store_family');
        Route::get('administration', 'SiswaController@create_admin')->name('siswa_create_admin');
        Route::post('administration', 'SiswaController@store_admin')->name('siswa_store_admin');
      });
      Route::group(['prefix' => '{id}/edit'], function() {
        Route::get('/', 'SiswaController@edit')->name('siswa_edit');
        Route::get('health', 'SiswaController@edit_health')->name('siswa_edit_health');
        Route::get('family', 'SiswaController@edit_family')->name('siswa_edit_family');
        Route::get('administration', 'SiswaController@edit_admin')->name('siswa_edit_admin');
        Route::get('graduation', 'SiswaController@edit_graduation')->name('siswa_edit_graduation');
      });
      Route::group(['prefix' => 'update'], function() {
        Route::post('/', 'SiswaController@update')->name('siswa_update');
        Route::post('health', 'SiswaController@update_health')->name('siswa_update_health');
        Route::post('family', 'SiswaController@update_family')->name('siswa_update_family');
        Route::post('administration', 'SiswaController@update_admin')->name('siswa_update_admin');
        Route::post('graduation', 'SiswaController@update_graduation')->name('siswa_update_graduation');
      });
      Route::get('{id}/delete', 'SiswaController@delete')->name('siswa_delete');
    });

    Route::group(['prefix' => 'alumni'], function () {
      Route::get('/', 'AlumniController@index')->name('alumni_index');
    });

    Route::group(['prefix' => 'karyawan'], function() {
      Route::get('/', 'KaryawanController@index')->name('karyawan_index');
      Route::get('search', 'KaryawanController@search')->name('karyawan_search');
      Route::get('export/pdf', 'KaryawanController@exportToPdf')->name('karyawan_export_pdf');
      Route::get('export/excel', 'KaryawanController@exportToExcel')->name('karyawan_export_excel');
      Route::post('import/excel', 'KaryawanController@importFromExcel')->name('karyawan_import_excel');
      Route::get('sample/excel', 'KaryawanController@excelSample')->name('karyawan_sample_excel');
      Route::group(['prefix' => 'create'], function() {
        Route::get('/', 'KaryawanController@create')->name('karyawan_create');
        Route::post('/', 'KaryawanController@store')->name('karyawan_store');
        Route::get('education', 'KaryawanController@create_education')->name('karyawan_create_education');
        Route::post('education', 'KaryawanController@store_education')->name('karyawan_store_education');
        Route::get('status', 'KaryawanController@create_status')->name('karyawan_create_status');
        Route::post('status', 'KaryawanController@store_status')->name('karyawan_store_status');
      });
      Route::group(['prefix' => '{id}/edit'], function() {
        Route::get('/', 'KaryawanController@edit')->name('karyawan_edit');
        Route::get('education', 'KaryawanController@edit_education')->name('karyawan_edit_education');
        Route::get('status', 'KaryawanController@edit_status')->name('karyawan_edit_status');
      });
      Route::group(['prefix' => 'update'], function() {
        Route::post('/', 'KaryawanController@update')->name('karyawan_update');
        Route::post('education', 'KaryawanController@update_education')->name('karyawan_update_education');
        Route::post('status', 'KaryawanController@update_status')->name('karyawan_update_status');
      });
      Route::get('{id}/delete', 'KaryawanController@delete')->name('karyawan_delete');
    });

    Route::group(['prefix' => 'admin'], function () {
      Route::get('/', 'AdminController@index')->name('admin_index');
      Route::get('create', 'AdminController@create')->name('admin_create');
      Route::post('/', 'AdminController@store')->name('admin_store');
      Route::get('{id}/edit', 'AdminController@edit')->name('admin_edit');
      Route::post('update', 'AdminController@update')->name('admin_update');
      Route::get('{id}/destroy', 'AdminController@destroy')->name('admin_destroy');
    });

    Route::group(['prefix' => 'naik-kelas'], function() {
      Route::get('/', 'NaikKelasController@index')->name('naik_kelas_index');
      Route::post('/', 'NaikKelasController@process')->name('naik_kelas_process');
    });

    Route::group(['prefix' => 'jenis-mutasi'], function() {
      Route::get('/', 'JenisMutasiController@index')->name('jenis_mutasi_index');
      Route::get('create', 'JenisMutasiController@create')->name('jenis_mutasi_create');
      Route::post('/', 'JenisMutasiController@store')->name('jenis_mutasi_store');
      Route::get('{id}/edit', 'JenisMutasiController@edit')->name('jenis_mutasi_edit');
      Route::post('update', 'JenisMutasiController@update')->name('jenis_mutasi_update');
      Route::get('{id}/destroy', 'JenisMutasiController@destroy')->name('jenis_mutasi_destroy');
    });

    Route::group(['prefix' => 'mutasi'], function () {
      Route::group(['prefix' => 'siswa'], function () {
        Route::get('/', 'MutasiSiswaController@index')->name('mutasi_siswa_index');
        Route::get('create', 'MutasiSiswaController@create')->name('mutasi_siswa_create');
        Route::post('/', 'MutasiSiswaController@store')->name('mutasi_siswa_store');
        Route::get('{id}/edit', 'MutasiSiswaController@edit')->name('mutasi_siswa_edit');
        Route::post('update', 'MutasiSiswaController@update')->name('mutasi_siswa_update');
        Route::get('{id}/destroy', 'MutasiSiswaController@destroy')->name('mutasi_siswa_destroy');
        Route::get('pdf', 'MutasiSiswaController@exportToPdf')->name('mutasi_siswa_pdf');
      });
      Route::group(['prefix' => 'guru'], function () {
        Route::get('/', 'MutasiGuruController@index')->name('mutasi_guru_index');
        Route::get('create', 'MutasiGuruController@create')->name('mutasi_guru_create');
        Route::post('/', 'MutasiGuruController@store')->name('mutasi_guru_store');
        Route::get('{id}/edit', 'MutasiGuruController@edit')->name('mutasi_guru_edit');
        Route::post('update', 'MutasiGuruController@update')->name('mutasi_guru_update');
        Route::get('{id}/destroy', 'MutasiGuruController@destroy')->name('mutasi_guru_destroy');
        Route::get('pdf', 'MutasiGuruController@exportToPdf')->name('mutasi_guru_pdf');
      });
      Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', 'MutasiKaryawanController@index')->name('mutasi_karyawan_index');
        Route::get('create', 'MutasiKaryawanController@create')->name('mutasi_karyawan_create');
        Route::post('/', 'MutasiKaryawanController@store')->name('mutasi_karyawan_store');
        Route::get('{id}/edit', 'MutasiKaryawanController@edit')->name('mutasi_karyawan_edit');
        Route::post('update', 'MutasiKaryawanController@update')->name('mutasi_karyawan_update');
        Route::get('{id}/destroy', 'MutasiKaryawanController@destroy')->name('mutasi_karyawan_destroy');
        Route::get('pdf', 'MutasiKaryawanController@exportToPdf')->name('mutasi_karyawan_pdf');
      });
    });

  });

  Route::middleware('role:root')->group(function () {
    Route::group(['prefix' => 'cloud'], function () {
      Route::get('/', 'CloudComputingController@index')->name('cloud_computing_index');
      Route::get('create', 'CloudComputingController@create')->name('cloud_computing_create');
      Route::post('/', 'CloudComputingController@store')->name('cloud_computing_store');
      Route::get('{id}/edit', 'CloudComputingController@edit')->name('cloud_computing_edit');
      Route::post('update', 'CloudComputingController@update')->name('cloud_computing_update');
      Route::get('{id}/destroy', 'CloudComputingController@destroy')->name('cloud_computing_destroy');
      Route::get('{id}/disable', 'CloudComputingController@disable')->name('cloud_computing_disable');
      Route::get('{id}/activate', 'CloudComputingController@activate')->name('cloud_computing_activate');
    });

    Route::group(['prefix' => 'cctv'], function () {
      Route::get('/', 'CCTVController@index')->name('cctv_index');
      Route::get('create', 'CCTVController@create')->name('cctv_create');
      Route::post('/', 'CCTVController@store')->name('cctv_store');
      Route::get('{id}/edit', 'CCTVController@edit')->name('cctv_edit');
      Route::post('update', 'CCTVController@update')->name('cctv_update');
      Route::get('{id}/destroy', 'CCTVController@destroy')->name('cctv_destroy');
    });
  });

  Route::middleware(['checkdbconfig'])->group(function() {
    Route::middleware('role:guru')->group(function () {
      Route::get('absensi/guru', 'AbsensiController@index_guru')->name('absensi_guru');
    });

    Route::middleware('role:siswa')->group(function () {
      Route::get('absensi/siswa', 'AbsensiController@index_siswa')->name('absensi_siswa');
    });

    // Route::middleware('role:karyawan')->group(function () {
    //   Route::get('absensi/karyawan', 'AbsensiController@index_karyawan')->name('absensi_karyawan');
    // });
  });
});
