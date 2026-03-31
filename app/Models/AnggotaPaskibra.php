<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPaskibra extends Model
{
    use HasFactory;

    protected $table = 'anggota_paskibra';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
        
    ];
}
