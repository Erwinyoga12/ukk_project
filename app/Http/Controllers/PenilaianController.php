<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;

class PenilaianController extends Controller
{
    // halaman utama /eskul
    public function index()
    {
        return view('eskul');
    }

    // ambil data siswa berdasarkan eskul dan kelas
    public function data(Request $request)
    {
        $eskul = $request->eskul;
        $kelas = $request->kelas;

        if ($eskul == "pramuka") {
            $data = AnggotaPramuka::where('kelas', $kelas)->get();
            return response()->json($data);
        }

        return response()->json([]);
    }
}