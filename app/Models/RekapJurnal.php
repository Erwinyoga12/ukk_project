<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapJurnal extends Model
{
    use HasFactory;

    protected $table = 'rekap_jurnal';

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
