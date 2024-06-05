<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class PengumumanController extends Controller
{
    public function getDataAnnounce()
    {
        // Buat request ke Supabase menggunakan HTTP Client
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?select=*');

        $pengumuman = $response->json();

        return view('announce/announce', compact('pengumuman'));

    }

    public function tambahPengumuman(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        DB::table('public.pengumuman')->insert([
            'judul_pengumuman' => $request->judul_pengumuman,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function editPengumuman($id)
    {
        // Mendapatkan data pengumuman berdasarkan ID
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?id_pengumuman=eq.' . $id);

        $pengumuman = $response->json();

        // dd($pengumuman);
        // Mengirim data pengumuman ke view edit_ann
        return view('announce/edit_ann', compact('pengumuman'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        // Update data pengumuman berdasarkan ID
        DB::table('public.pengumuman')
            ->where('id_pengumuman', $id)
            ->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function deletePengumuman(Request $request, $id)
    {
        // Hapus data pengumuman berdasarkan ID
        DB::table('public.pengumuman')->where('id_pengumuman', $id)->delete();

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

}
