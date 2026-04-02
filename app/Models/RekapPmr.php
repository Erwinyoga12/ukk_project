<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPmr extends Model
{
    protected $table = 'rekap_pmr';

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
