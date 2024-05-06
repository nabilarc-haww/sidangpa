<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengumumanController extends Controller
{
    public function getDataAnnounce()
    {
        // Buat request ke Supabase menggunakan HTTP Client
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?select=*');

        $pengumuman = $response->json();

        return view('announce', compact('pengumuman'));

    }
}
