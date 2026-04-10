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
        if (!session('logged_in')) {
            return redirect('/gin')->with('pesan', 'Silakan login dulu');
        }

        $eskul = session('eskul_login');
        $kelasOptions = ['X', 'XI',];

        return view('eskul', compact('eskul', 'kelasOptions'));
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
        if (!$model) return response()->json([]);

        // Ambil data + nilai yang sudah ada (jika ada)
        $data = $model::where('kelas', $kelas)->get()->map(function ($s) use ($eskul, $kelas) {
            $rekapModels = [
                'pramuka'      => RekapPramuka::class,
                'paskibra'     => RekapPaskibra::class,
                'natbinari'    => RekapNatbinari::class,
                'jurnal'       => RekapJurnal::class,
                'marchingband' => RekapMarchingband::class,
                'pmr'          => RekapPmr::class,
            ];
            $rekapModel = $rekapModels[$eskul] ?? null;
            $nilai = $rekapModel ? $rekapModel::where('nipd', $s->nipd)->where('kelas', $kelas)->first() : null;

                return [
                    'nama_siswa'     => $s->nama_siswa,
                    'nipd'           => $s->nipd,
                    'jurusan'        => $s->jurusan ?? '-',
                    'nilai_lama'     => $nilai?->nilai,
                    'predikat_lama'  => $nilai?->predikat,
                    'deskripsi_lama' => $nilai?->deskripsi,
                ];
            });

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

        $updated = 0;
        foreach ($data as $item) {
            if (empty($item['nilai'])) continue; // Skip yang kosong

            $model::updateOrCreate(
                ['nipd' => $item['nipd'],  'kelas' => $kelas],
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

        session(['sudah_nilai' => true]);
        return response()->json(['status' => 'success', 'message' => "$updated data disimpan"]);
    }
}