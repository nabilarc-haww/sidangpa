<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProyekAkhirController extends Controller
{
    public function generate(Request $request)
    {
        // URL endpoint dari API Supabase
        $supabaseUrl = 'https://ihpqktbogxquohofeevj.supabase.co';
        
        // API key Supabase Anda
        $supabaseApiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImlocHFrdGJvZ3hxdW9ob2ZlZXZqIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MTM2MjMxOTQsImV4cCI6MjAyOTE5OTE5NH0.Evc1UjzoodkQvz2WAbJsN_Ui6w4dRz8-mPyAeo97_Yc';
        
        // // Buat instance dari Guzzle HTTP client
        // $client = new Client([
        //     'base_uri' => $supabaseUrl,
        //     'headers' => [
        //         'apikey' => $supabaseApiKey,
        //         'Content-Type' => 'application/json',
        //     ],
        // ]);

        // try {
        //     // Lakukan permintaan GET ke endpoint Supabase untuk mendapatkan data proyek_akhir
        //     $response = $client->request('GET', $supabaseUrl.'/rest/v1/proyek_akhir');
            
        //     // Ubah respons JSON menjadi array asosiatif
        //     $data = json_decode($response->getBody(), true);
            
        //     // Tampilkan data dalam ke view generate.blade.php
        //     // return view('proyek_akhir.index', ['data' => $data]);
        //     return view('generate', ['proyek_akhir' => $data]);
        // } catch (\Exception $e) {
        //     // Tangani jika terjadi kesalahan dalam permintaan HTTP
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

        $response = Http::withHeaders([
            'apikey' => $supabaseApiKey,
        ])->get($supabaseUrl . '/rest/v1/proyek_akhir');

        $proyek_akhir = $response->json();

        return view('generate', compact('proyek_akhir'));
    }
}
