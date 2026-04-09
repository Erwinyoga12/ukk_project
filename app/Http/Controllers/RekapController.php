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
    private array $rekapModels = [
        'pmr'          => RekapPmr::class,
        'pramuka'      => RekapPramuka::class,
        'paskibra'     => RekapPaskibra::class,
        'natbinari'    => RekapNatbinari::class,
        'jurnal'       => RekapJurnal::class,
        'marchingband' => RekapMarchingband::class,
    ];

    public function index()
    {
        $eskul = session('eskul_login');

        // ✅ FIX: tambah with('pesan', ...) supaya notif muncul di halaman login
        if (!$eskul) {
            return redirect('/gin')->with('pesan', 'Silakan login terlebih dahulu.');
        }

        $model = $this->rekapModels[$eskul] ?? null;

        // ✅ FIX: kalau eskul tidak dikenali, logout paksa daripada diam-diam error
        if (!$model) {
            session()->forget(['eskul_login', 'sudah_nilai']);
            return redirect('/gin')->with('pesan', 'Sesi tidak valid. Silakan login kembali.');
        }

        // Belum simpan nilai di sesi ini → tampilkan tabel kosong
        if (!session('sudah_nilai')) {
            return view('rkpPramuka', [
                'data'  => collect(),
                'eskul' => $eskul,
            ]);
        }

        $data = $model::orderBy('kelas')
                      ->orderBy('nama_siswa')
                      ->get();

        return view('rkpPramuka', compact('data', 'eskul'));
    }
}