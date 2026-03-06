<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapPramuka;
class RekapController extends Controller
{
public function simpan(Request $request)
{
    $kelas = $request->kelas;
    $data = $request->data;

    foreach ($data as $d) {

        RekapPramuka::create([
            'nipd' => $d['nipd'],
            'kelas' => $kelas,
            'nilai' => $d['nilai'],
            'predikat' => $d['predikat'],
            'deskripsi' => $d['deskripsi']
        ]);

    }

    return response()->json([
        'status' => 'success'
    ]);
}
}
