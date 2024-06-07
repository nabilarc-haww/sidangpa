<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class DataProyekAkhirController extends Controller
{
    public function getDataProyek($id_master)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/master_pa', [
            'id_master' => 'eq.' . $id_master,
            'select' => '*,proyek_akhir(*,dosen_pembimbing1(*),dosen_pembimbing2(*),dosen_pembimbing3(*))'
        ]);

        $data_pa = $response->json();

        return view('proyek_akhir/public_pa', compact('data_pa', 'id_master'));
    }

    public function tambahDataProyek(Request $request, $id_master)
    {
        $request->validate([
            'nrp_mahasiswa' => 'required',
            'nama_mahasiswa' => 'required',
            'judul_pa' => 'required',
            'dosen_pembimbing1' => 'required',
            'dosen_pembimbing2' => 'required',
            'dosen_pembimbing3' => 'required',
        ]);

        DB::table('public.proyek_akhir')->insert([
            'nrp_mahasiswa' => $request->nrp_mahasiswa,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'judul_pa' => $request->judul_pa,
            'dosen_pembimbing1' => $request->dosen_pembimbing1,
            'dosen_pembimbing2' => $request->dosen_pembimbing2,
            'dosen_pembimbing3' => $request->dosen_pembimbing3,
            'id_master' => $id_master,
        ]);

        return redirect()->route('proyek-akhir.data', ['id_master' => $id_master])->with('success', 'Data berhasil ditambahkan.');
    }

    public function showEditForm($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/proyek_akhir', [
            'id_mhs' => 'eq.' . $id,
            'select' => '*,dosen_pembimbing1(*),dosen_pembimbing2(*),dosen_pembimbing3(*)'
        ]);

        $data_pa = $response->json();

        $dosenResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/dosen?select=*');

        $dosen = $dosenResponse->json();

        return view('proyek_akhir/edit_pa', compact('data_pa', 'dosen'));
    }

    public function updateDataProyek(Request $request, $id)
    {
        $request->validate([
            'nrp_mahasiswa' => 'required',
            'nama_mahasiswa' => 'required',
            'judul_pa' => 'required',
            'dosen_pembimbing1' => 'required',
            'dosen_pembimbing2' => 'required',
            'dosen_pembimbing3' => 'required',
        ]);

        DB::table('public.proyek_akhir')
            ->where('id_mhs', $id)
            ->update([
                'nrp_mahasiswa' => $request->nrp_mahasiswa,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'judul_pa' => $request->judul_pa,
                'dosen_pembimbing1' => $request->dosen_pembimbing1,
                'dosen_pembimbing2' => $request->dosen_pembimbing2,
                'dosen_pembimbing3' => $request->dosen_pembimbing3,
            ]);

        return redirect()->route('proyek-akhir.data', ['id_master' => $request->id_master])->with('success', 'Data berhasil diupdate.');
    }


    public function deleteDataProyek($id)
    {
        DB::table('public.proyek_akhir')->where('id_mhs', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function dosenDropdown($id_master)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/dosen?select=*');

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to retrieve data from API'], 500);
        }

        $dosen = $response->json();

        return view('proyek_akhir/tambah_pa', compact('dosen', 'id_master'));
    }

    public function getDataMasterPA()
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/master_pa?select=*,proyek_akhir(*)');

        $master_pa = $response->json();

        return view('proyek_akhir/card_pa', compact('master_pa'));
    }
}
