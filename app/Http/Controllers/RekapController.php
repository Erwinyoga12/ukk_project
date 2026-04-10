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

        if (!$eskul) {
            return redirect('/gin')->with('pesan', 'Silakan login terlebih dahulu.');
        }

        if (!isset($this->rekapModels[$eskul])) {
            session()->forget(['eskul_login', 'sudah_nilai', 'rekap_sesi']);
            return redirect('/gin')->with('pesan', 'Sesi tidak valid. Silakan login kembali.');
        }

        // ✅ Ambil dari session, bukan dari database
        $dataSesi = session('rekap_sesi', []);

        // ✅ Ubah ke collection supaya blade @forelse tetap bekerja
        $data = collect($dataSesi)->map(fn($d) => (object) $d);

        return view('rkpPramuka', compact('data', 'eskul'));
    }
}