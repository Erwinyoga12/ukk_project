<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    private static $labelToKey = [
        'Pramuka'       => 'pramuka',
        'PMR'           => 'pmr',
        'Marching Band' => 'marchingband',
        'Paskibra'      => 'paskibra',
        'Jurnal'        => 'jurnal',
        'Natbinari'     => 'natbinari',
    ];

    private static $keyToLabel = [
        'pramuka'      => 'Pramuka',
        'pmr'          => 'PMR',
        'marchingband' => 'Marching Band',
        'paskibra'     => 'Paskibra',
        'jurnal'       => 'Jurnal',
        'natbinari'    => 'Natbinari',
    ];

    public function index()
    {
        $siswa = Siswa::all()->map(function ($s) {
            $s->nama = $s->nama_siswa;

            $eskulList = [];
            foreach (Siswa::$eskulTabel as $key => $tabel) {
                try {
                    if (DB::table($tabel)->where('nipd', $s->nipd)->exists()) {
                        $eskulList[] = self::$keyToLabel[$key] ?? $key;
                    }
                } catch (\Throwable $e) {
                    // Skip jika tabel tidak ada
                }
            }
            $s->eskul_list = $eskulList;

            return $s;
        });

        $kelasList  = $siswa->pluck('kelas')->unique()->sort()->values();
        $ikutEskul  = $siswa->filter(fn($s) => count($s->eskul_list) > 0)->count();
        $belumEskul = $siswa->count() - $ikutEskul;

        $stats = [
            'total'       => $siswa->count(),
            'laki'        => $siswa->where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan'   => $siswa->where('jenis_kelamin', 'Perempuan')->count(),
            'ikut_eskul'  => $ikutEskul,
            'belum_eskul' => $belumEskul,
        ];

        return view('kesiswaan.dashboard', compact('siswa', 'stats', 'kelasList'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama'          => 'required|string|max:255',
                'nipd'          => 'required|string|max:255|unique:m_siswa,nipd',
                'kelas'         => 'required|string|max:50',
                'jurusan'       => 'required|string|max:50',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            ]);

            $siswa = Siswa::create([
                'nama_siswa'    => $validated['nama'],
                'nipd'          => $validated['nipd'],
                'kelas'         => $validated['kelas'],
                'jurusan'       => $validated['jurusan'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]);

            return response()->json([
                'success' => true,
                'data'    => $siswa,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            foreach (Siswa::$eskulTabel as $tabel) {
                try {
                    DB::table($tabel)->where('nipd', $siswa->nipd)->delete();
                } catch (\Throwable $e) {
                    // Skip jika tabel tidak ada
                }
            }

            $siswa->delete();

            return response()->json(['success' => true]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateEskul(Request $request, $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            $eskulLabels = $request->input('eskul', []);
            $eskulKeys   = array_values(array_filter(
                array_map(fn($label) => self::$labelToKey[$label] ?? null, $eskulLabels)
            ));

            foreach (Siswa::$eskulTabel as $key => $tabel) {
                try {
                    $sudahAda  = DB::table($tabel)->where('nipd', $siswa->nipd)->exists();
                    $mauDaftar = in_array($key, $eskulKeys);

                    if ($mauDaftar && !$sudahAda) {
                        DB::table($tabel)->insert([
                            'nipd'       => $siswa->nipd,
                            'nama_siswa' => $siswa->nama_siswa, // ✅ fix kolom
                            'kelas'      => $siswa->kelas,
                            'jurusan'    => $siswa->jurusan,
                        ]);
                    } elseif (!$mauDaftar && $sudahAda) {
                        DB::table($tabel)->where('nipd', $siswa->nipd)->delete();
                    }

                } catch (\Throwable $e) {
                    \Log::error("Gagal update eskul tabel $tabel: " . $e->getMessage());
                }
            }

            return response()->json(['success' => true]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}