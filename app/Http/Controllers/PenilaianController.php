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
    /* ======================================================
       MAP MODEL
    ====================================================== */

    private function anggotaMap(): array
    {
        return [
            'pramuka'      => AnggotaPramuka::class,
            'paskibra'     => AnggotaPaskibra::class,
            'natbinari'    => AnggotaNatbinari::class,
            'jurnal'       => AnggotaJurnal::class,
            'marchingband' => AnggotaMarchingband::class,
            'pmr'          => AnggotaPmr::class,
        ];
    }

    private function rekapMap(): array
    {
        return [
            'pramuka'      => RekapPramuka::class,
            'paskibra'     => RekapPaskibra::class,
            'natbinari'    => RekapNatbinari::class,
            'jurnal'       => RekapJurnal::class,
            'marchingband' => RekapMarchingband::class,
            'pmr'          => RekapPmr::class,
        ];
    }

    /* ======================================================
       HALAMAN UTAMA
    ====================================================== */

    public function index()
    {
        if (!session('logged_in')) {
            return redirect('/gin')->with('pesan', 'Silakan login dulu');
        }

        $eskul        = session('eskul_login');
        $kelasOptions = ['X', 'XI'];

        return view('eskul', compact('eskul', 'kelasOptions'));
    }

    /* ======================================================
       LOAD DATA (INI YANG PALING PENTING 🔥)
       → ambil anggota + gabung rekap
       → bikin otomatis locked kalau nilai ada
    ====================================================== */

    public function data(Request $request)
    {
        $eskul = strtolower($request->eskul);
        $kelas = $request->kelas;

        $anggotaModel = $this->anggotaMap()[$eskul] ?? null;
        $rekapModel   = $this->rekapMap()[$eskul] ?? null;

        if (!$anggotaModel || !$rekapModel) {
            return response()->json([]);
        }

        // ambil data siswa
        $anggota = $anggotaModel::where('kelas', $kelas)->get();

        // ambil data nilai (rekap)
        $rekap = $rekapModel::where('kelas', $kelas)->get()->keyBy('nipd');

        $data = $anggota->map(function ($s) use ($rekap) {

            $nilai = $rekap[$s->nipd] ?? null;

            return [
                'nama_siswa'     => $s->nama_siswa,
                'nipd'           => $s->nipd,
                'jurusan'        => $s->jurusan ?? '-',

                // 🔥 ini yang bikin persist setelah login
                'nilai_lama'     => $nilai?->nilai,
                'predikat_lama'  => $nilai?->predikat,
                'deskripsi_lama' => $nilai?->deskripsi,
            ];
        });

        return response()->json($data);
    }

    /* ======================================================
       SIMPAN SEMUA
    ====================================================== */

    public function simpan(Request $request)
    {
        $eskul = strtolower($request->eskul);
        $kelas = $request->kelas;
        $data  = $request->data;

        $rekapModel = $this->rekapMap()[$eskul] ?? null;

        if (!$rekapModel) {
            return response()->json(['status' => 'eskul tidak dikenali'], 400);
        }

        $updated = 0;

        foreach ($data as $item) {

            if (empty($item['nilai'])) continue;

            $rekapModel::updateOrCreate(
                [
                    'nipd'  => $item['nipd'],
                    'kelas' => $kelas
                ],
                [
                    'nama_siswa' => $item['nama_siswa'],
                    'jurusan'    => $item['jurusan'] ?? '-',
                    'nilai'      => $item['nilai'],
                    'predikat'   => $item['predikat'],
                    'deskripsi'  => $item['deskripsi'] ?? null,
                ]
            );

            $updated++;
        }

        return response()->json([
            'status'  => 'success',
            'message' => "$updated data disimpan"
        ]);
    }

    /* ======================================================
       SIMPAN PER BARIS (BIAR EDIT LANGSUNG KE DB 🔥)
    ====================================================== */

    public function simpanBaris(Request $request)
    {
        $eskul = strtolower($request->eskul);

        $rekapModel = $this->rekapMap()[$eskul] ?? null;

        if (!$rekapModel) {
            return response()->json(['status' => 'error'], 400);
        }

        $rekapModel::updateOrCreate(
            [
                'nipd'  => $request->nipd,
                'kelas' => $request->kelas
            ],
            [
                'nama_siswa' => $request->nama_siswa,
                'jurusan'    => $request->jurusan ?? '-',
                'nilai'      => $request->nilai,
                'predikat'   => $request->predikat,
                'deskripsi'  => $request->deskripsi ?? null,
            ]
        );

        return response()->json(['status' => 'success']);
    }
}