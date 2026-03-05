<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPramuka extends Model
{
    use HasFactory;

    protected $table = 'anggota_pramuka';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
    ];
}