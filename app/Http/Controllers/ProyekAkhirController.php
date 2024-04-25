<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Symfony\Component\HttpFoundation\Response;


class ProyekAkhirController extends Controller
{

    public function getData()
    {
        // Buat request ke Supabase menggunakan HTTP Client
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/proyek_akhir');

        $proyek_akhir = $response->json();

        return view('generate', compact('proyek_akhir'));
    }

    public function import(Request $request)
    {
        // Validasi request
        $request->validate([
            'fileUpload' => 'required|mimes:csv'
        ]);
    
        // Ambil file yang diunggah
        $file = $request->file('fileUpload');
    
        // Baca file CSV
        $data = array_map('str_getcsv', file($file));
    
        // Siapkan array untuk menyimpan data yang akan diimpor
        $importData = [];
    
        // Loop melalui setiap baris data CSV dan sesuaikan dengan struktur ProyekAkhir
        foreach ($data as $row) {
            if (count($row) >= 8) {
                $importData[] = [
                    'nrp_mahasiswa' => $row[0],
                    'nama_mahasiswa' => $row[1],
                    'judul_pa' => $row[2],
                    'dosen_pembimbing1' => $row[3],
                    'dosen_pembimbing2' => $row[4],
                    'dosen_pembimbing3' => $row[5],
                    'penguji_mitra' => $row[6],
                    'jurusan' => $row[7],
                ];
            } 
        }

        // dd($importData);//print data yg didapat dari csv

        array_shift($importData);

        $jsonData = json_encode($importData);
        // echo $jsonData;

        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
            'Content-Type' => 'application/json',
        ])->post($this->supabaseUrl . '/rest/v1/proyek_akhir', $importData);

        // dd($response);//print data yg dikirmkan ke database
    
        // Periksa apakah permintaan berhasil
        // if ($response->successful()) {
        //     // Redirect dengan pesan sukses
        //     return redirect('/proyek-akhir/jadwal')->with('success', 'Data berhasil diimpor.');
        // } else {
        //     // Redirect dengan pesan gagal
        //     return redirect('/proyek-akhir/jadwal')->with('error', 'Gagal mengimpor data. Silakan coba lagi.');
        // }

        return redirect('/proyek-akhir/jadwal')->with('success', 'Data header berhasil disimpan.');

    }
    
}
