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
            session()->forget(['eskul_login', 'sudah_nilai']);
            return redirect('/gin')->with('pesan', 'Sesi tidak valid.');
        }

        // ✅ Ambil model sesuai eskul
        $model = $this->rekapModels[$eskul];

        // ✅ Ambil data dari database
        $data = $model::orderBy('nama_siswa')->get();

        return view('rkpPramuka', compact('data', 'eskul'));
    }

    // 🔥 SIMPAN DATA NILAI KE DATABASE
    public function store(Request $request)
    {
        $eskul = session('eskul_login');

        $model = $this->rekapModels[$eskul];

        $model::create([
            'nama_siswa' => $request->nama_siswa,
            'nipd'       => $request->nipd,
            'kelas'      => $request->kelas,
            'jurusan'    => $request->jurusan,
            'nilai'      => $request->nilai,
            'predikat'   => $request->predikat,
            'deskripsi'  => $request->deskripsi,
        ]);

        return back()->with('success', 'Data berhasil disimpan');
    }
}
