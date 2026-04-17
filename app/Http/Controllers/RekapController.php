<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    private array $anggotaTables = [
        'pramuka'      => 'anggota_pramuka',
        'pmr'          => 'anggota_pmr',
        'paskibra'     => 'anggota_paskibra',
        'natbinari'    => 'anggota_natbinari',
        'jurnal'       => 'anggota_jurnal',
        'marchingband' => 'anggota_marchingband',
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

        $data = [];

        $kelasOptions = ['X', 'XI'];

        $jurusanOptions = ['RPL', 'DKV', 'TKJ 1', 'TKJ 2', 'BIDI 1','BIDI 2','BIDI 3'];

        return view('rkpPramuka', compact(
            'data',
            'eskul',
            'kelasOptions',
            'jurusanOptions'
        ));
    }

    // 🔥 FIX TOTAL DI SINI
    public function getData(Request $request)
    {
        $eskul   = session('eskul_login');
        $kelas   = $request->kelas;
        $jurusan = $request->jurusan;

        if (
            !isset($this->anggotaTables[$eskul]) ||
            !isset($this->rekapModels[$eskul])
        ) {
            return response()->json([]);
        }

        $anggotaTable = $this->anggotaTables[$eskul];
        $rekapTable   = (new $this->rekapModels[$eskul])->getTable();

        $query = DB::table($anggotaTable)
            ->leftJoin($rekapTable, function ($join) use ($anggotaTable, $rekapTable) {
                $join->on("$anggotaTable.nipd", '=', "$rekapTable.nipd");
            })
            ->select(
                "$anggotaTable.nama_siswa",
                "$anggotaTable.nipd",
                "$anggotaTable.kelas",
                "$anggotaTable.jurusan",
                "$rekapTable.nilai",
                "$rekapTable.predikat",
                "$rekapTable.deskripsi"
            );

        // ✅ FILTER KELAS (AMAN)
        if ($kelas) {
            $query->where($anggotaTable . '.kelas', $kelas);
        }

        // ✅ FILTER JURUSAN
        if ($jurusan) {
            $query->where("$anggotaTable.jurusan", $jurusan);
        }

        $data = $query->orderBy("$anggotaTable.nama_siswa")->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $eskul = session('eskul_login');

        if (!isset($this->rekapModels[$eskul])) {
            return back()->with('error', 'Eskul tidak valid');
        }

        $model = $this->rekapModels[$eskul];

        $model::updateOrCreate(
            ['nipd' => $request->nipd], // biar ga dobel
            [
                'nama_siswa' => $request->nama_siswa,
                'kelas'      => $request->kelas,
                'jurusan'    => $request->jurusan,
                'nilai'      => $request->nilai,
                'predikat'   => $request->predikat,
                'deskripsi'  => $request->deskripsi,
            ]
        );

        return back()->with('success', 'Data berhasil disimpan');
    }
}
