<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tampat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->string('NIK');
            $table->string('agama');
            $table->string('no hp');
            $table->string('email');
            $table->string('asal_sekolah');
            $table->string('jurusan_yang_dipilih');
            $table->string('anak_ke-');
            $table->string('NISN');
            $table->string('Gol darah');
            $table->string('riwayat_penyakit');
            $table->string('jumlah_saudara');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
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
        Schema::dropIfExists('calon_siswa');
    }
}
