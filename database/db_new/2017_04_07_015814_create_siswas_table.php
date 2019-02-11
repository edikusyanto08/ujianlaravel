<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lengkap')->nullable();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->enum('kelamin',['L','P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();

            $table->string('foto')->nullable();
            $table->string('nomor_kartu')->nullable();
            $table->string('pin')->nullable();

            $table->tinyInteger('lulus'); // 0 -> belum lulus, 1 -> sudah lulus
            $table->tinyInteger('status'); // 0 -> tidak aktif (mutasi), 1 -> aktif
            $table->timestamps();
            // $table->string('no_induk');
            // // $table->string('n1')->nullable();
            // // $table->string('n2')->nullable();
            // // $table->string('n3')->nullable();
            // $table->string('nik')->nullable();
            // // $table->string('nama_panggilan')->nullable();
            // $table->string('kewarganegaraan')->nullable();
            // $table->tinyInteger('anak_ke')->nullable();
            // $table->tinyInteger('saudara_kandung')->nullable();
            // // $table->tinyInteger('saudara_tiri')->nullable();
            // $table->tinyInteger('saudara_angkat')->nullable();
            // $table->string('yatim')->nullable();
            // $table->string('bahasa')->nullable();
            // $table->string('no_telp')->nullable();
            // $table->string('tinggal')->nullable();
            // $table->string('jarak_tinggal')->nullable();
            // //====================================================================
            // $table->string('gol_darah')->nullable();
            // $table->string('penyakit')->nullable();
            // $table->string('kelainan')->nullable();
            // $table->integer('tinggi')->nullable();
            // $table->integer('berat')->nullable();
            // //====================================================================
            // $table->string('tamat_dari')->nullable();
            // $table->string('no_ijazah')->nullable();
            // $table->string('no_skhun')->nullable();
            // $table->date('tgl_ijazah')->nullable();
            // $table->date('tgl_skhun')->nullable();
            // // $table->string('ijazah')->nullable();
            // // $table->string('skhun')->nullable();
            // // $table->tinyInteger('lama_belajar')->nullable();
            // $table->string('dari_sekolah')->nullable();
            // $table->string('alasan')->nullable();
            // // $table->integer('kelas_id')->unsigned();
            // // $table->foreign('kelas_id')->unsigned();
            // // $table->string('tingkat')->nullable();
            // // $table->string('bidang_keahlian')->nullable();
            // // $table->string('program_keahlian')->nullable();
            // // $table->string('paket_keahlian')->nullable();
            // // $table->string('jurusan')->nullable();
            // $table->date('tgl_diterima')->nullable();
            // //====================================================================
            // $table->string('nama_ayah')->nullable();
            // $table->string('tempat_lahir_ayah')->nullable();
            // $table->string('tgl_lahir_ayah')->nullable();
            // $table->string('agama_ayah')->nullable();
            // $table->string('kewarganegaraan_ayah')->nullable();
            // $table->string('pendidikan_ayah')->nullable();
            // $table->string('pekerjaan_ayah')->nullable();
            // $table->string('pengeluaran_ayah')->nullable();
            // $table->string('telp_ayah')->nullable();
            // $table->text('alamat_ayah')->nullable();
            // $table->string('hidup_ayah')->nullable();
            // $table->string('nama_ibu')->nullable();
            // $table->string('tempat_lahir_ibu')->nullable();
            // $table->string('tgl_lahir_ibu')->nullable();
            // $table->string('agama_ibu')->nullable();
            // $table->string('kewarganegaraan_ibu')->nullable();
            // $table->string('pendidikan_ibu')->nullable();
            // $table->string('pekerjaan_ibu')->nullable();
            // $table->string('pengeluaran_ibu')->nullable();
            // $table->string('telp_ibu')->nullable();
            // $table->text('alamat_ibu')->nullable();
            // $table->string('hidup_ibu')->nullable();
            // $table->string('nama_wali')->nullable();
            // $table->string('tempat_lahir_wali')->nullable();
            // $table->string('tgl_lahir_wali')->nullable();
            // $table->string('agama_wali')->nullable();
            // $table->string('kewarganegaraan_wali')->nullable();
            // $table->string('pendidikan_wali')->nullable();
            // $table->string('pekerjaan_wali')->nullable();
            // $table->string('pengeluaran_wali')->nullable();
            // $table->string('telp_wali')->nullable();
            // $table->text('alamat_wali')->nullable();
            // //====================================================================
            // // $table->string('kesenian')->nullable();
            // // $table->string('olahraga')->nullable();
            // // $table->string('organisasi')->nullable();
            // // $table->text('lain_lain')->nullable();
            // // $table->tinyInteger('th_bea1')->nullable();
            // // $table->string('kelas_bea1')->nullable();
            // // $table->string('dari_bea1')->nullable();
            // // $table->tinyInteger('th_bea2')->nullable();
            // // $table->string('kelas_bea2')->nullable();
            // // $table->string('dari_bea2')->nullable();
            // // $table->tinyInteger('th_bea3')->nullable();
            // // $table->string('kelas_bea3')->nullable();
            // // $table->string('dari_bea3')->nullable();
            // $table->string('sekolah_pindah')->nullable();
            // $table->date('tgl_pindah_sekolah')->nullable();
            // $table->string('alasan_pindah')->nullable();
            // //====================================================================
            // $table->integer('th_lulus')->nullable();
            // // $table->string('ijazah_lulus')->nullable();
            // // $table->string('skhun_lulus')->nullable();
            // $table->date('tgl_ijazah_lulus')->nullable();
            // $table->date('tgl_skhun_lulus')->nullable();
            // $table->string('no_ijazah_lulus')->nullable();
            // $table->string('no_skhun_lulus')->nullable();
            // $table->string('lanjut_di')->nullable();
            // $table->date('tgl_mulai_kerja')->nullable();
            // $table->string('perusahaan')->nullable();
            // // $table->integer('penghasilan')->nullable();
            // //====================================================================
            // $table->string('foto')->nullable();
            // $table->string('nomor_kartu')->nullable();
            // $table->string('pin')->nullable();
            // //====================================================================
            // // $table->string('no_rekening')->nullable();
            // // $table->string('tahun')->nullable();
            // $table->tinyInteger('lulus');
            // $table->timestamps();
            // $table->index(['status', 'nis', 'nama_lengkap', 'nomor_kartu', 'lulus'], 'siswa_index_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
