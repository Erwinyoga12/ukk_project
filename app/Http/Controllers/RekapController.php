<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapPmr;
use App\Models\RekapPramuka;
use App\Models\RekapPaskibra;
use App\Models\RekapNatbinari;
use App\Models\RekapJurnal;
use App\Models\RekapMarchingband;

class RekapController extends Controller
{
    public function index()
    {
        // Baca eskul dari session Laravel (di-set saat login via /set-session)
        $eskul = session('eskul_login');

        if (!$eskul) {
            return redirect('/gin');
        }

        $models = [
            'pmr'          => RekapPmr::class,
            'pramuka'      => RekapPramuka::class,
            'paskibra'     => RekapPaskibra::class,
            'natbinari'    => RekapNatbinari::class,
            'jurnal'       => RekapJurnal::class,
            'marchingband' => RekapMarchingband::class,
        ];

        $model = $models[$eskul] ?? null;

        $data = $model
            ? $model::orderBy('kelas')->orderBy('nama_siswa')->get()
            : collect();

        return view('rkpPramuka', compact('data', 'eskul'));
    }
}