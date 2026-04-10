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

    public function index()
    {
        if (!session('logged_in')) {
            return redirect('/gin')->with('pesan', 'Silakan login dulu');
        }

        $eskul        = session('eskul_login');
        $kelasOptions = ['X', 'XI'];

        return view('eskul', compact('eskul', 'kelasOptions'));
    }

    public function data(Request $request)
    {
        $eskul = strtolower($request->eskul);
        $kelas = $request->kelas;

        $anggotaModel = $this->anggotaMap()[$eskul] ?? null;
        if (!$anggotaModel) return response()->json([]);

        $data = $anggotaModel::where('kelas', $kelas)
            ->get()
            ->map(function ($s) {
                return [
                    'nama_siswa'     => $s->nama_siswa,
                    'nipd'           => $s->nipd,
                    'jurusan'        => $s->jurusan ?? '-',
                    'nilai_lama'     => null,
                    'predikat_lama'  => null,
                    'deskripsi_lama' => null,
                ];
            });

        return response()->json($data);
    }

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
        $dataSesi = session('rekap_sesi', []); // ✅ ambil data sesi yang sudah ada

        foreach ($data as $item) {
            if (empty($item['nilai'])) continue;

            $rekapModel::updateOrCreate(
                ['nipd' => $item['nipd'], 'kelas' => $kelas],
                [
                    'nama_siswa' => $item['nama_siswa'],
                    'jurusan'    => $item['jurusan'] ?? '-',
                    'nilai'      => $item['nilai'],
                    'predikat'   => $item['predikat'],
                    'deskripsi'  => $item['deskripsi'] ?? null,
                ]
            );

            // ✅ Simpan data yang diinput ke session
            $dataSesi[] = [
                'nama_siswa' => $item['nama_siswa'],
                'nipd'       => $item['nipd'],
                'kelas'      => $kelas,
                'jurusan'    => $item['jurusan'] ?? '-',
                'nilai'      => $item['nilai'],
                'predikat'   => $item['predikat'],
                'deskripsi'  => $item['deskripsi'] ?? null,
            ];

            $updated++;
        }

        session([
            'sudah_nilai' => true,
            'rekap_sesi'  => $dataSesi, // ✅ simpan ke session
        ]);

        return response()->json(['status' => 'success', 'message' => "$updated data disimpan"]);
    }
}