<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapNatbinariMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('rekap_natbinari', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nipd');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('eskul');
            $table->string('nilai');
            $table->string('keterangan');
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
