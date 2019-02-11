<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('nuptk')->nullable();
            $table->enum('kelamin',['L','P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('nip')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('jenis_ptk')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('tugas_tambahan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('nik')->nullable();

            $table->string('foto')->nullable();
            $table->string('nomor_kartu')->nullable();
            $table->string('pin')->nullable();

            $table->tinyInteger('status')->nullable();
            $table->date('tgl_non_aktif')->nullable(); // keisi kalo dia mutasi atau pensiun
            $table->timestamps();








            // $table->string('no_ktp')->nullable();
            // $table->string('status_kawin')->nullable();
            // $table->string('nama_ibu')->nullable();
            // // ==============================================================
            // $table->string('pend_akhir')->nullable();
            // $table->date('tgl_lulus_pend_akhir')->nullable();
            // $table->string('jurusan_pend_akhir')->nullable();
            // $table->string('lembaga_pend_akhir')->nullable();
            // // $table->date('tgl_lulus_pend_s1_div')->nullable();
            // // $table->string('jurusan_pend_s1_div')->nullable();
            // // $table->string('lembaga_pend_s1_div')->nullable();
            // // $table->string('lanjut_kuliah')->nullable();
            // // $table->string('tmt_lanjut_kuliah')->nullable();
            // // $table->tinyInteger('sem_lanjut_kuliah')->nullable();
            // // $table->string('jurusan_lanjut_kuliah')->nullable();
            // // $table->string('pt_lanjut_kuliah')->nullable();
            // $table->string('tmt_cpns')->nullable();
            // $table->string('no_sk_cpns')->nullable();
            // $table->string('tmt_pns')->nullable();
            // $table->string('no_sk_pns')->nullable();
            // $table->string('golongan')->nullable();
            // $table->string('tmt_golongan')->nullable();
            // $table->string('no_sk_golongan_akhir')->nullable();
            // $table->tinyInteger('masa_kerja_th')->nullable();
            // $table->tinyInteger('masa_kerja_bln')->nullable();
            // $table->string('gaji_pokok')->nullable();
            // // ==============================================================
            // $table->string('status_karyawan')->nullable();
            // $table->string('tmt_karyawan')->nullable();
            // $table->string('no_sk_pengangkatan')->nullable();
            // $table->string('jabatan_karyawan')->nullable();
            // $table->index(['nip', 'nuptk', 'no_ktp', 'nama', 'nomor_kartu', 'status'], 'karyawan_index_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
