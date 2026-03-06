<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapPramuka extends Model
{
    

    protected $table = 'rekap_pramuka';

 protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan',
        'nilai',
        'predikat',
        'deskripsi'
    ];
}