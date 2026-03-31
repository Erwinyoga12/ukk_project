<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaMarchingband extends Model
{
    use HasFactory;

    protected $table = 'anggota_marchingband';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
        
    ];
}
