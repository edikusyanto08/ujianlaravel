<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function siswaHeader()
    {
    	$header = [
	        'NIS',
	        'NISN',
	        'NIK',
	        'NAMA_LENGKAP',
	        'NAMA_PANGGILAN',
	        'JENIS_KELAMIN',
	        'TEMPAT_LAHIR',
	        'TANGGAL_LAHIR',
	        'AGAMA',
	        'KEWARGANEGARAAN',
	        'ANAK_KE',
	        'SAUDARA_KANDUNG',
	        'SAUDARA_ANGKAT',
	        'YATIM',
	        'BAHASA',
	        'ALAMAT',
	        'NO_TELEPON',
	        'TINGGAL',
	        'JARAK_TINGGAL',
	        'GOLONGAN_DARAH',
	        'PENYAKIT',
	        'KELAINAN',
	        'TINGGI_BADAN',
	        'BERAT_BADAN',
	        'TAMAT_DARI',
	        'NO_IJAZAH',
	        'NO_SKHUN',
	        'TGL_IJAZAH',
	        'TGL_SKHUN',
	        'DARI_SEKOLAH',
	        'ALASAN',
	        'TANGGAL_DITERIMA',
	        'NAMA_AYAH',
	        'TEMPAT_LAHIR_AYAH',
	        'TANGGAL_LAHIR_AYAH',
	        'AGAMA_AYAH',
	        'KEWARGANEGARAAN_AYAH',
	        'PENDIDIKAN_AYAH',
	        'PEKERJAAN_AYAH',
	        'PENGELUARAN_AYAH',
	        'TELEPON_AYAH',
	        'ALAMAT_AYAH',
	        'HIDUP_AYAH',
	        'NAMA_IBU',
	        'TEMPAT_LAHIR_IBU',
	        'TANGGAL_LAHIR_IBU',
	        'AGAMA_IBU',
	        'KEWARGANEGARAAN_IBU',
	        'PENDIDIKAN_IBU',
	        'PEKERJAAN_IBU',
	        'PENGELUARAN_IBU',
	        'TELEPON_IBU',
	        'ALAMAT_IBU',
	        'HIDUP_IBU',
	        'NAMA_WALI',
	        'TEMPAT_LAHIR_WALI',
	        'TANGGAL_LAHIR_WALI',
	        'AGAMA_WALI',
	        'KEWARGANEGARAAN_WALI',
	        'PENDIDIKAN_WALI',
	        'PEKERJAAN_WALI',
	        'PENGELUARAN_WALI',
	        'TELEPON_WALI',
	        'ALAMAT_WALI',
	        'PINDAH_SEKOLAH_KE',
	        'TANGGAL_PINDAH_SEKOLAH',
	        'ALASAN_PINDAH',
	        'TAHUN_LULUS',
	        'TANGGAL_IJAZAH_LULUS',
	        'TANGGAL_SKHUN_LULUS',
	        'NO_IJAZAH_LULUS',
	        'NO_SKHUN_LULUS',
	        'LANJUT_KE',
	        'TANGGAL_MULAI_KERJA',
	        'PERUSAHAAN',
      	];

     	return $header;
    }

    public function guruHeader()
    {
      $header = [
        'NIP',
        'NUPTK',
        'NO_KTP',
        'NAMA',
        'GELAR_DEPAN',
        'GELAR_BELAKANG',
        'KELAMIN',
        'TEMPAT_LAHIR',
        'TGL_LAHIR',
        'AGAMA',
        'ALAMAT',
        'RT',
        'RW',
        'KELURAHAN',
        'KECAMATAN',
        'KOTA',
        'PROVINSI',
        'KODE_POS',
        'STATUS_KAWIN',
        'NO_HP',
        'EMAIL',
        'NAMA_IBU',
        'PEND_AKHIR',
        'TGL_LULUS_PEND_AKHIR',
        'JURUSAN_PEND_AKHIR',
        'LEMBAGA_PEND_AKHIR',
        'STATUS_KEPEGAWAIAN',
        'TMT_CPNS',
        'TMT_PNS',
        'TMT_INPASSING_NONPNS',
        'NO_SK_INPASSING_NONPNS',
        'GOLONGAN',
        'TMT_GOLONGAN',
        'MASA_KERJA_TH',
        'MASA_KERJA_BLN',
        'GAJI_POKOK',
        'BIDANG_STUDI_SERTIFIKASI',
        'NO_PESERTA_SERTIFIKASI',
        'TGL_SERTIFIKASI',
        'LPTK_PENYELENGGARA_SERTIFIKASI',
        'NO_PESERTA_SERTIFIKASI_KONVERSI',
        'NRG',
        'BIDANG_STUDI_SERTIFIKASI2',
        'NO_PESERTA_SERTIFIKASI2',
        'TGL_SERTIFIKASI2',
        'LPTK_PENYELENGGARA_SERTIFIKASI2',
        'STATUS_GURU',
        'TMT_GURU_TIDAK_TETAP',
        'TMT_GURU_TETAP',
        'JENIS_GURU',
        'TUGAS_TAMBAHAN',
        'NOMOR_KARTU',
        'PIN',
        'STATUS',
        'TGL_NON_AKTIF',
      ];
    	return $header;
    }

    public function karyawanHeader()
    {
      $header = [
        'NIP',
        'NUPTK',
        'NO_KTP',
        'NAMA',
        'GELAR_DEPAN',
        'GELAR_BELAKANG',
        'KELAMIN',
        'TEMPAT_LAHIR',
        'TGL_LAHIR',
        'AGAMA',
        'ALAMAT',
        'RT',
        'RW',
        'KELURAHAN',
        'KECAMATAN',
        'KOTA',
        'PROVINSI',
        'KODE_POS',
        'STATUS_KAWIN',
        'NO_HP',
        'EMAIL',
        'NAMA_IBU',
        'PEND_AKHIR',
        'TGL_LULUS_PEND_AKHIR',
        'JURUSAN_PEND_AKHIR',
        'LEMBAGA_PEND_AKHIR',
        'TMT_CPNS',
        'NO_SK_CPNS',
        'TMT_PNS',
        'NO_SK_PNS',
        'STATUS_KEPEGAWAIAN',
        'GOLONGAN',
        'TMT_GOLONGAN',
        'NO_SK_GOLONGAN_AKHIR',
        'MASA_KERJA_TH',
        'MASA_KERJA_BLN',
        'GAJI_POKOK',
        'STATUS_KARYAWAN',
        'TMT_KARYAWAN',
        'NO_SK_PENGANGKATAN',
        'JABATAN_KARYAWAN',
        'NOMOR_KARTU',
        'PIN',
        'STATUS',
        'TGL_NON_AKTIF',
      ];

      return $header;
    }

    public function testCase()
    {
    	// To use multiple sheet, you must set force_sheets_collection to true in excel.php

    	Excel::load('assets/excel/'.$file_name, function($reader) {
        // Loop through all sheets
        $reader->each(function($sheet) {

          echo $sheet->getTitle().'<br>';

            // Loop through all rows
            $sheet->each(function($row) {
              echo $row->nis.'<br>';
              echo $row->tanggal_lahir.'<br>';
            });

        });

      });
    }
}
