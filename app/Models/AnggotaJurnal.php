<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaJurnal extends Model
{
    use HasFactory;

    protected $table = 'anggota_jurnal';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
        
    ];
}
