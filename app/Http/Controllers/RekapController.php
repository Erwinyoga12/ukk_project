<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;
use App\Models\RekapPramuka;

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

        return response()->json([
            "status"=>"success"
        ]);

    }

}
