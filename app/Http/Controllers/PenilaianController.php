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
    // -------------------------------------------------------
    // Map eskul → model (didefinisikan sekali, dipakai ulang)
    // -------------------------------------------------------
    private array $anggotaModels = [
        'pramuka'      => AnggotaPramuka::class,
        'paskibra'     => AnggotaPaskibra::class,
        'natbinari'    => AnggotaNatbinari::class,
        'jurnal'       => AnggotaJurnal::class,
        'marchingband' => AnggotaMarchingband::class,
        'pmr'          => AnggotaPmr::class,
    ];

    private array $rekapModels = [
        'pramuka'      => RekapPramuka::class,
        'paskibra'     => RekapPaskibra::class,
        'natbinari'    => RekapNatbinari::class,
        'jurnal'       => RekapJurnal::class,
        'marchingband' => RekapMarchingband::class,
        'pmr'          => RekapPmr::class,
    ];

    // -------------------------------------------------------
    // Helper: cek session login, return eskul atau abort
    // -------------------------------------------------------
    private function getEskulFromSession(): string
    {
        $eskul = session('eskul_login');

        if (!$eskul) {
            abort(401, 'Sesi tidak ditemukan. Silakan login terlebih dahulu.');
        }

        return $eskul;
    }

    // -------------------------------------------------------
    // GET /eskul — tampilkan halaman penilaian
    // -------------------------------------------------------
    public function index()
    {
        // ✅ FIX: cek 'eskul_login', bukan 'logged_in'
        if (!session('eskul_login')) {
            return redirect('/gin')->with('pesan', 'Silakan login dulu');
        }

        $eskul        = session('eskul_login');
        $kelasOptions = ['X', 'XI'];

        return view('eskul', compact('eskul', 'kelasOptions'));
    }

    // -------------------------------------------------------
    // GET /eskul/data — ambil data siswa + nilai lama
    // -------------------------------------------------------
    public function data(Request $request)
    {
        // ✅ FIX: eskul dari SESSION, bukan dari query string
        $eskul = $this->getEskulFromSession();
        $kelas = $request->kelas;

        if (!$kelas) {
            return response()->json(['message' => 'Parameter kelas diperlukan.'], 422);
        }

        $anggotaModel = $this->anggotaModels[$eskul] ?? null;
        $rekapModel   = $this->rekapModels[$eskul]   ?? null;

        if (!$anggotaModel) {
            return response()->json(['message' => 'Eskul tidak dikenali.'], 400);
        }

        $data = $anggotaModel::where('kelas', $kelas)
            ->get()
            ->map(function ($s) use ($rekapModel, $kelas) {
                $nilai = $rekapModel
                    ? $rekapModel::where('nipd', $s->nipd)->where('kelas', $kelas)->first()
                    : null;

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

    // -------------------------------------------------------
    // POST /eskul/simpan — simpan / update nilai siswa
    // -------------------------------------------------------
    public function simpan(Request $request)
    {
        // ✅ FIX: eskul dari SESSION, bukan dari request body
        $eskul = $this->getEskulFromSession();
        $kelas = $request->kelas;
        $data  = $request->data;

        if (!$kelas || empty($data)) {
            return response()->json(['message' => 'Data tidak lengkap.'], 422);
        }

        $rekapModel = $this->rekapModels[$eskul] ?? null;

        if (!$rekapModel) {
            return response()->json(['message' => 'Eskul tidak dikenali.'], 400);
        }

        $updated = 0;
        foreach ($data as $item) {
            if (empty($item['nilai'])) continue;

            $rekapModel::updateOrCreate(
                [
                    'nipd'  => $item['nipd'],
                    'kelas' => $kelas,
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

        session(['sudah_nilai' => true]);

        return response()->json([
            'status'  => 'success',
            'message' => "$updated data disimpan",
        ]);
    }
}