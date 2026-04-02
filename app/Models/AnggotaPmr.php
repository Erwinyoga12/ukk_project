<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPmr extends Model
{
    use HasFactory;

    protected $table = 'anggota_pmr';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
        
    ];
}
