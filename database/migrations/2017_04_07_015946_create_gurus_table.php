<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('nama')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->enum('kelamin',['L','P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            // $table->string('pelajaran')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('status_kawin')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_ibu')->nullable();
            // ==============================================================
            $table->string('pend_akhir')->nullable();
            $table->date('tgl_lulus_pend_akhir')->nullable();
            $table->string('jurusan_pend_akhir')->nullable();
            $table->string('lembaga_pend_akhir')->nullable();
            // $table->date('tgl_lulus_pend_s1_div')->nullable();
            // $table->string('jurusan_pend_s1_div')->nullable();
            // $table->string('lembaga_pend_s1_div')->nullable();
            // $table->string('lanjut_kuliah')->nullable();
            // $table->string('tmt_lanjut_kuliah')->nullable();
            // $table->tinyInteger('sem_lanjut_kuliah')->nullable();
            // $table->string('jurusan_lanjut_kuliah')->nullable();
            // $table->string('pt_lanjut_kuliah')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('tmt_cpns')->nullable();
            $table->string('tmt_pns')->nullable();
            $table->string('tmt_inpassing_nonpns')->nullable();
            $table->string('no_sk_inpassing_nonpns')->nullable();
            $table->string('golongan')->nullable();
            $table->string('tmt_golongan')->nullable();
            $table->integer('masa_kerja_th')->nullable();
            $table->integer('masa_kerja_bln')->nullable();
            $table->string('gaji_pokok')->nullable();
            // ==============================================================
            $table->string('bidang_studi_sertifikasi')->nullable();
            $table->string('no_peserta_sertifikasi')->nullable();
            $table->date('tgl_sertifikasi')->nullable();
            $table->string('lptk_penyelenggara_sertifikasi')->nullable();
            $table->string('no_peserta_sertifikasi_konversi')->nullable();
            $table->string('nrg')->nullable();
            $table->string('bidang_studi_sertifikasi2')->nullable();
            $table->string('no_peserta_sertifikasi2')->nullable();
            $table->date('tgl_sertifikasi2')->nullable();
            $table->string('lptk_penyelenggara_sertifikasi2')->nullable();
            // ==============================================================
            $table->string('status_guru')->nullable();
            $table->string('tmt_guru_tidak_tetap')->nullable();
            $table->string('tmt_guru_tetap')->nullable();
            $table->string('jenis_guru')->nullable();
            $table->string('tugas_tambahan')->nullable();
            // ==============================================================
            $table->string('foto')->nullable();
            $table->string('nomor_kartu')->nullable();
            $table->string('pin')->nullable();
            // $table->string('no_rekening')->nullable();
            $table->tinyInteger('status')->nullable(); // 0 -> kalo mutasi, 1 -> masih aktif
            $table->date('tgl_non_aktif')->nullable(); // keisi kalo dia mutasi atau pensiun
            $table->index(['nip', 'nuptk', 'no_ktp', 'nama', 'nomor_kartu', 'status'], 'guru_index_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
