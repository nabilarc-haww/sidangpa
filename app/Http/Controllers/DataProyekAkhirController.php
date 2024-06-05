<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class DataProyekAkhirController extends Controller
{
    public function getDataProyek()
    {
        // Buat request ke Supabase menggunakan HTTP Client
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/proyek_akhir?select=*,dosen_pembimbing1(*),dosen_pembimbing2(*),dosen_pembimbing3(*)');

        $data_pa = $response->json();

        return view('proyek_akhir/public_pa', compact('data_pa'));

    }

    public function tambahDataProyek(Request $request)
    {
        $this->dosenDropdown(); // Perbaiki pemanggilan method dosenDropdown()

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
        ]);

        return redirect('/proyek-akhir/data')->with('success', 'Data berhasil ditambahkan.');
    }

    public function editDataProyek($id)
    {
        // Mendapatkan data pengumuman berdasarkan ID
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/proyek_akhir?id_mhs=eq.' . $id);

        $data_pa = $response->json();

        // dd($pengumuman);
        // Mengirim data pengumuman ke view edit_ann
        return view('edit_pa', compact('data_pa'));
    }

    public function updateDataProyek(Request $request, $id)
    {
        $request->validate([
            'nrp_mahasiswa' => 'required',
            'nama_mahasiswa' => 'required',
            'judul_pa' => 'required',
        ]);

        // Update data pengumuman berdasarkan ID
        DB::table('public.')
            ->where('id_mhs', $id)
            ->update([
                'nrp_mahasiswa' => $request->nrp_mahasiswa,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'judul_pa' => $request->judul_pa,
            ]);

        return redirect('/proyek-akhir/data')->with('success', 'Data berhasil diperbarui.');
    }

    public function dosenDropdown()
    {
        // Ambil data dosen dari Supabase 
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/dosen?select=*');

        // Check if the request was successful
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to retrieve data from API'], 500);
        }

        // Get the JSON response from the API call
        $dosen = $response->json();

        // Return the view with the data dosen
        return view('proyek_akhir/tambah_pa', compact('dosen'));
    }

}
