<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapPramukaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('rekap_pramuka', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nipd');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('nilai');
            $table->string('predikat');
            $table->string('deskripsi');
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
        //
    }
}
