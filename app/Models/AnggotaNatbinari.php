<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaNatbinari extends Model
{
    use HasFactory;
    
    protected $table = 'anggota_natbinari';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan'
        
    ];
}
