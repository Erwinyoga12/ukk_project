<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'm_siswa';

    protected $fillable = [
        'nama_siswa',
        'nipd',
        'kelas',
        'jurusan',
        'jenis_kelamin',
    ];

    public static $eskulTabel = [
        'pramuka'      => 'anggota_pramuka',
        'pmr'          => 'anggota_pmr',
        'marchingband' => 'anggota_marchingband',
        'paskibra'     => 'anggota_paskibra',
        'jurnal'       => 'anggota_jurnal',
        'natbinari'    => 'anggota_natbinari',
    ];
}