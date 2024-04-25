<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeaderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'prodi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'tahapan_sidang' => 'required|string',
        ]);

        DB::table('public.header')->insert([
            'judul' => $request->judul,
            'prodi' => $request->prodi,
            'tanggal_waktu' => $request->tanggal_waktu,
            'tahapan_sidang' => $request->tahapan_sidang,
        ]);

        return redirect('/proyek-akhir/jadwal')->with('success', 'Data header berhasil disimpan.');
    }
}
