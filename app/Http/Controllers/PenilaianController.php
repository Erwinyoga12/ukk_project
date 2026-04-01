<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPramuka;
use App\Models\AnggotaNatbinari;
use App\Models\AnggotaJurnal;
use App\Models\AnggotaMarchingband;
use App\Models\AnggotaPaskibra;
use App\Models\RekapPaskibra;
use App\Models\RekapPramuka;
use App\Models\RekapNatbinari;
use App\Models\RekapJurnal;
use App\Models\RekapMarchingband;

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

         if ($eskul == "paskibra") {
            $data = AnggotaPaskibra::where('kelas', $kelas)->get();
            return response()->json($data);
        }

         if ($eskul == "natbinari") {
            $data = AnggotaNatbinari::where('kelas', $kelas)->get();
            return response()->json($data);
        }

         if ($eskul == "nurnal") {
            $data = AnggotaJurnal::where('kelas', $kelas)->get();
            return response()->json($data);
        }

         if ($eskul == "marchingband") {
            $data = AnggotaMarchingband::where('kelas', $kelas)->get();
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

        if ($eskul == "pramuka") {
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

        if ($eskul == "paskibra") {
            RekapPaskibra::create([
                'nama_siswa' => $item['nama_siswa'],
                'nipd' => $item['nipd'],
                'kelas' => $kelas,
                'jurusan' => $item['jurusan'],
                'nilai' => $item['nilai'],
                'predikat' => $item['predikat'],
                'deskripsi' => $item['deskripsi']
            ]);
        }

        if ($eskul == "natbinari") {
            RekapNatbinari::create([
                'nama_siswa' => $item['nama_siswa'],
                'nipd' => $item['nipd'],
                'kelas' => $kelas,
                'jurusan' => $item['jurusan'],
                'nilai' => $item['nilai'],
                'predikat' => $item['predikat'],
                'deskripsi' => $item['deskripsi']
            ]);
        }

        if ($eskul == "jurnal") {
            RekapJurnal::create([
                'nama_siswa' => $item['nama_siswa'],
                'nipd' => $item['nipd'],
                'kelas' => $kelas,
                'jurusan' => $item['jurusan'],
                'nilai' => $item['nilai'],
                'predikat' => $item['predikat'],
                'deskripsi' => $item['deskripsi']
            ]);
        }

        if ($eskul == "marchingband") {
            RekapMarchingband::create([
                'nama_siswa' => $item['nama_siswa'],
                'nipd' => $item['nipd'],
                'kelas' => $kelas,
                'jurusan' => $item['jurusan'],
                'nilai' => $item['nilai'],
                'predikat' => $item['predikat'],
                'deskripsi' => $item['deskripsi']
            ]);
        }
    }

    return response()->json([
        'status' => 'success'
    ]);
}
}