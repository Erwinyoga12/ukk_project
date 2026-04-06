<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;
use App\Models\AnggotaNatbinari;
use App\Models\AnggotaJurnal;
use App\Models\AnggotaMarchingband;
use App\Models\AnggotaPaskibra;
use App\Models\AnggotaPmr;
use App\Models\RekapPaskibra;
use App\Models\RekapPramuka;
use App\Models\RekapNatbinari;
use App\Models\RekapJurnal;
use App\Models\RekapMarchingband;
use App\Models\RekapPmr;

class PenilaianController extends Controller
{
    public function index()
    {
        return view('eskul');
    }

    public function data(Request $request)
    {
        $eskul = $request->eskul;
        $kelas = $request->kelas;

        $anggotaModels = [
            'pramuka'      => AnggotaPramuka::class,
            'paskibra'     => AnggotaPaskibra::class,
            'natbinari'    => AnggotaNatbinari::class,
            'jurnal'       => AnggotaJurnal::class,
            'marchingband' => AnggotaMarchingband::class,
            'pmr'          => AnggotaPmr::class,
        ];

        $model = $anggotaModels[$eskul] ?? null;

        if (!$model) {
            return response()->json([]);
        }

        $data = $model::where('kelas', $kelas)->get();
        return response()->json($data);
    }

    public function simpan(Request $request)
{
    $kelas = $request->kelas;
    $eskul = $request->eskul;
    $data  = $request->data;

    $rekapModels = [
        'pramuka'      => RekapPramuka::class,
        'paskibra'     => RekapPaskibra::class,
        'natbinari'    => RekapNatbinari::class,
        'jurnal'       => RekapJurnal::class,
        'marchingband' => RekapMarchingband::class,
        'pmr'          => RekapPmr::class,
    ];

    $model = $rekapModels[$eskul] ?? null;

    if (!$model) {
        return response()->json(['status' => 'eskul tidak dikenali'], 400);
    }

    // ✅ Langsung insert tanpa hapus data lama
    foreach ($data as $item) {
        $model::create([
            'nama_siswa' => $item['nama_siswa'],
            'nipd'       => $item['nipd'],
            'kelas'      => $kelas,
            'jurusan'    => $item['jurusan'],
            'nilai'      => $item['nilai'],
            'predikat'   => $item['predikat'],
            'deskripsi'  => $item['deskripsi'],
        ]);
    }

    session(['sudah_nilai' => true]);

    return response()->json(['status' => 'success']);
}
}
