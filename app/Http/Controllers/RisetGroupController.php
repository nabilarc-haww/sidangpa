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
        ])->get($this->supabaseUrl . '/rest/v1/riset_group?select=*,dosen(*),ruang(*)');

        $riset_group = $response->json();

        return view('riset-group.rg', compact('riset_group'));

    }

    public function create()
    {
        $responseRg = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/riset_group?select=*');

        $rg = $responseRg->json();

        return view('riset-group.create', compact('rg'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama_dosen', 'nip', 'id_rg', 'available', 'psdku']);

        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->post($this->supabaseUrl . "/rest/v1/dosen", $data);

        if ($response->successful()) {
            return redirect('/riset-group')->with('success', 'Dosen created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create dosen');
        }
    }
   
    public function edit($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . "/rest/v1/dosen?id_dosen=eq.$id");

        $dosen = $response->json();

        if (empty($dosen)) {
            return redirect('/riset-group')->with('error', 'Dosen not found');
        }

        $responseRg = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/riset_group?select=*');

        $rg = $responseRg->json();

        return view('riset-group.edit', compact('dosen', 'rg'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['nama_dosen', 'nip', 'id_rg', 'available', 'psdku']);

        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->patch($this->supabaseUrl . "/rest/v1/dosen?id_dosen=eq.$id", $data);

        if ($response->successful()) {
            return redirect('/riset-group')->with('success', 'Dosen updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update dosen');
        }
    }

    public function destroy($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->delete($this->supabaseUrl . "/rest/v1/dosen?id_dosen=eq.$id");

        if ($response->successful()) {
            return redirect('/riset-group')->with('success', 'Dosen deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete dosen');
        }
    }
}
