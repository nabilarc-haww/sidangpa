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
            'waktu' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/']
        ]);

        $headerData = [
            'judul' => $request->judul,
            'prodi' => $request->prodi,
            'tanggal' => $request->tanggal,
            'tahapan_sidang' => $request->tahapan_sidang,
            'waktu' => $request->waktu,
        ];

        $id_header = DB::table('public.header')
            ->insertGetId($headerData, 'id_header');

        session(['id_header' => $id_header]);

        return redirect('/proyek-akhir/jadwal')->with('success', 'Data header berhasil disimpan.');

        // return redirect()->route('proyek-akhir.generate', ['id_header' => $id_header])
        //                  ->with('success', 'Data header berhasil disimpan.');
    }
}
