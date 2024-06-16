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
            'tanggal' => 'required|date',
            'tahapan_sidang' => 'required|string',
            'waktu' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'start_year' => 'required|integer',
            'end_year' => 'required|integer|gte:start_year'
        ]);

        // Menggabungkan start_year dan end_year menjadi tahun_ajaran
        $tahun_ajaran = $request->start_year . ' / ' . $request->end_year;

        $headerData = [
            'judul' => $request->judul,
            'prodi' => $request->prodi,
            'tanggal' => $request->tanggal,
            'tahapan_sidang' => $request->tahapan_sidang,
            'waktu' => $request->waktu,
            'tahun_ajaran' => $tahun_ajaran,
        ];

        $id_header = DB::table('public.header')
            ->insertGetId($headerData, 'id_header');

        session(['id_header' => $id_header]);

        return redirect('/proyek-akhir/jadwal')->with('success', 'Data header berhasil disimpan.');
    }
}
