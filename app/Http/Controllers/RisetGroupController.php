<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RisetGroupController extends Controller 
{
    public function getAllData()
    {
        // Buat request ke Supabase menggunakan HTTP Client
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/dosen?select=*,riset_group(*),ruang(*)');

        $riset_group = $response->json();

        return view('rg', compact('riset_group'));

    }
}
