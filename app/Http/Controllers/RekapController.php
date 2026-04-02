<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;
use App\Models\AnggotaPaskibra;
use App\Models\AnggotaNatbinari;
use App\Models\AnggotaJurnal;
use App\Models\AnggotaMarchingband;
use App\Models\RekapPaskibra;
use App\Models\RekapPramuka;
use App\Models\RekapJurnal;
use App\Models\RekapNatbinari;
use App\Models\RekapMarchingband;
use App\Models\RekapPmr;

class PenilaianController extends Controller
{
    /* =====================
       AMBIL DATA SISWA
    ===================== */
    public function getSiswa($eskul,$kelas)
    {

        if($eskul == "pramuka"){

            $data = AnggotaPramuka::where('kelas',$kelas)->get();

            return response()->json($data);

        }

        if($eskul == "paskibra"){

            $data = AnggotaPaskibra::where('kelas',$kelas)->get();

            return response()->json($data);

        }

        if($eskul == "natbinari"){

            $data = AnggotaNatbinari::where('kelas',$kelas)->get();

            return response()->json($data);

        }

        if($eskul == "jurnal"){

            $data = AnggotaJurnal::where('kelas',$kelas)->get();

            return response()->json($data);

        }

        if($eskul == "marchingband"){

            $data = AnggotaMarchingband::where('kelas',$kelas)->get();

            return response()->json($data);

        }

        return response()->json([]);

    }


    /* =====================
       SIMPAN NILAI
    ===================== */

    public function simpanNilai(Request $request)
    {

        $eskul = $request->eskul;
        $kelas = $request->kelas;
        $data  = $request->data;

        foreach($data as $d){

        if($eskul == "pramuka"){

            RekapPramuka::updateOrCreate(
                [
                    'siswa_id' => $d['id'],
                    'eskul' => $eskul
                ],
                [
                    'kelas' => $kelas,
                    'nilai' => $d['nilai'],
                    'deskripsi' => $d['deskripsi']
                ]
            );

        }

        if($eskul == "paskibra"){

            RekapPaskibra::updateOrCreate(
                [
                    'siswa_id' => $d['id'],
                    'eskul' => $eskul
                ],
                [
                    'kelas' => $kelas,
                    'nilai' => $d['nilai'],
                    'deskripsi' => $d['deskripsi']
                ]
            );

        }

        if($eskul == "natbinari"){

            RekapNatbinari::updateOrCreate(
                [
                    'siswa_id' => $d['id'],
                    'eskul' => $eskul
                ],
                [
                    'kelas' => $kelas,
                    'nilai' => $d['nilai'],
                    'deskripsi' => $d['deskripsi']
                ]
            );

        }

        if($eskul == "jurnal"){

            RekapJurnal::updateOrCreate(
                [
                    'siswa_id' => $d['id'],
                    'eskul' => $eskul
                ],
                [
                    'kelas' => $kelas,
                    'nilai' => $d['nilai'],
                    'deskripsi' => $d['deskripsi']
                ]
            );

        }

        if($eskul == "marchingband"){

            RekapMarchingband::updateOrCreate(
                [
                    'siswa_id' => $d['id'],
                    'eskul' => $eskul
                ],
                [
                    'kelas' => $kelas,
                    'nilai' => $d['nilai'],
                    'deskripsi' => $d['deskripsi']
                ]
            );

        }
    }

    return response()->json([
        "status"=>"success"
    ]);

    
}

public function index()
    {
        $eskul = strtolower(auth()->user()->eskul);

        $models = [
            'pmr' => RekapPmr::class,
            'pramuka' => RekapPramuka::class,
            'paskibra' => RekapPaskibra::class,
            'natbinari' => RekapNatbinari::class,
            'jurnal' => RekapJurnal::class,
            'marchingband' => RekapMarchingband::class,
        ];

        $model = $models[$eskul] ?? null;

        if ($model) {
            $data = $model::all();
        } else {
            $data = collect();
        }

        return view('rekap', compact('data', 'eskul'));
    }
}
