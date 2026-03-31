<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapPaskibra extends Model
{
    protected $table = 'rekap_paskibra';

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
