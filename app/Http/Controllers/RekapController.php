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
<<<<<<< HEAD
    /* =====================
       AMBIL DATA SISWA
    ===================== */
    public function getSiswa($eskul,$kelas)
=======
    public function index()
>>>>>>> 347fe212ceb6be0521a04fbd94774eb528c52ea3
    {
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

        // ✅ Kalau belum simpan nilai di sesi ini, tampilkan kosong
        if (!session('sudah_nilai')) {
            return view('rkpPramuka', ['data' => collect(), 'eskul' => $eskul]);
        }

        $data = $model
            ? $model::orderBy('kelas')->orderBy('nama_siswa')->get()
            : collect();

        return view('rkpPramuka', compact('data', 'eskul'));
    }
}
