<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;
use App\Models\RekapPramuka;

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

    public function simpan(Request $request)
{
    $kelas = $request->kelas;
    $eskul = $request->eskul;
    $data = $request->data;

    foreach ($data as $item) {

          RekapPramuka::create([
            'nama_siswa' => $item['nama_siswa'],
            'nipd' => $item['nipd'],
            'kelas' => $kelas,
            'jurusan' => $item['jurusan'],
            'nilai' => $item['nilai'],
            'predikat' => $item['predikat'],
            'deskripsi' => $item['deskripsi']
        ]);

    }

    return response()->json([
        'status' => 'success'
    ]);
}
}