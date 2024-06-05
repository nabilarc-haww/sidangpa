<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; 


class ProyekAkhirController extends Controller
{
   
    public function getData($id_header)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
            'Authorization' => 'Bearer ' . $this->supabaseApiKey,  
            // Tambahkan header Authorization jika diperlukan
        ])->get($this->supabaseUrl . '/rest/v1/header', [
            'id_header' => 'eq.' . $id_header,
            'select' => '*,data_generate(*,id_mhs(*,dosen_pembimbing1(*),dosen_pembimbing2(*),dosen_pembimbing3(*)),id_ruang(*),penguji_1(*),penguji_2(*))'
        ]);

        $proyek_akhir = $response->json();
    
        // Initialize array to store the final result
        $finalResult = [];
    
        foreach ($proyek_akhir as $header) {
            // Prepare the basic structure of each header entry
            $headerEntry = [
                'created_at' => $header['created_at'],
                'judul' => $header['judul'],
                'prodi' => $header['prodi'],
                'tanggal' => $header['tanggal'],
                'waktu'=> $header['waktu'],
                'tahapan_sidang' => $header['tahapan_sidang'],
                'id_header' => $header['id_header'],
                'data_generate' => []
            ];
    
            // Group the data_generate entries by id_ruang within each header
            $groupedData = [];
    
            if (isset($header['data_generate'])) {
                foreach ($header['data_generate'] as $data) {
                    $idRuang = $data['id_ruang']['id_ruang'];
                    if (!isset($groupedData[$idRuang])) {
                        $groupedData[$idRuang] = [
                            'id_ruang' => $idRuang,
                            'nama_ruang' => $data['id_ruang']['nama_ruang'],
                            'kode_ruang' => $data['id_ruang']['kode_ruang'],
                            'letak' => $data['id_ruang']['letak'],
                            'data_generate' => []
                        ];
                    }
                    $groupedData[$idRuang]['data_generate'][] = $data;
                }
            }
    
            // Convert groupedData to a numerically indexed array and add to headerEntry
            $headerEntry['data_generate'] = array_values($groupedData);
    
            // Add the prepared headerEntry to the final result
            $finalResult[] = $headerEntry;
        }
    
        // For debugging purpose, dump the grouped data
        response()->json($finalResult);

        return view('generate', compact('finalResult', 'id_header'));
    
        // Return view with the grouped data
        // return view('generate', compact('groupedData'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'fileUpload' => 'required|mimes:csv,txt' // Allowing txt for better compatibility
        ]);
    
        $file = $request->file('fileUpload');
        $filePath = $file->getRealPath();
    
        $data = array_map('str_getcsv', file($filePath));
    
        $importData = [];
        foreach ($data as $key => $row) {
            if ($key === 0) {
                continue; // Skip header row
            }
            if (count($row) >= 6) {
                $importData[] = [
                    'id_mhs' => (string) Str::uuid(), // Generate UUID for id_mhs
                    'nrp_mahasiswa' => $row[0],
                    'nama_mahasiswa' => $row[1],
                    'judul_pa' => $row[2],
                    'dosen_pembimbing1' => $row[3],
                    'dosen_pembimbing2' => $row[4],
                    'dosen_pembimbing3' => $row[5],
                ];
            }
        }
    
        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseApiKey,
                'Content-Type' => 'application/json',
            ])->post($this->supabaseUrl . '/rest/v1/proyek_akhir_mhs', $importData);
    
            if ($response->successful()) {
                $id_header = session('id_header');
    
                if ($id_header) {
                    return $this->generate($id_header, $importData)
                            ->with('success', 'Data header berhasil disimpan.');
                } else {
                    return redirect('/proyek-akhir/jadwal')->with('error', 'Gagal mengimpor data: id_header tidak ditemukan.');
                }
            } else {
                $error = $response->json();
                Log::error('Supabase import error', [
                    'status' => $response->status(),
                    'body' => $error,
                ]);
    
                return redirect('/proyek-akhir/jadwal')->with('error', 'Gagal mengimpor data: ' . json_encode($error));
            }
        } catch (\Exception $e) {
            Log::error('Exception during import', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return redirect('/proyek-akhir/jadwal')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function generate($id_header, $importData)
    {
        // Fetch data from the provided URLs with API key in headers
        $risetGroupsResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/riset_group?select=*,dosen(*),ruang(*)');
    
        // Use importData instead of fetching mahasiswaResponse from API
        $mahasiswaData = $importData;
    
        $headerResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get("https://ihpqktbogxquohofeevj.supabase.co/rest/v1/header?id_header=eq.{$id_header}");
    
        // Check if the data retrieval was successful
        if ($risetGroupsResponse->failed() || $headerResponse->failed()) {
            return response()->json(['error' => 'Failed to retrieve data from API'], 500);
        }
    
        // Get the JSON response from the API calls
        $risetGroups = $risetGroupsResponse->json();
        $headerData = $headerResponse->json();
    
        // Initialize combinedData array grouped by riset_group
        $groupedData = [];
    
        // Create a mapping of dosen id to dosen name for quick lookup
        $dosenMap = [];
        foreach ($risetGroups as $risetGroup) {
            foreach ($risetGroup['dosen'] as $dosen) {
                $dosenMap[$dosen['id_dosen']] = $dosen['nama_dosen'];
            }
        }
    
        // Loop through each proyek_akhir_mhs entry
        foreach ($mahasiswaData as $mahasiswa) {
            // Find the corresponding riset_group based on dosen_pembimbing1
            foreach ($risetGroups as $risetGroup) {
                foreach ($risetGroup['dosen'] as $dosen) {
                    if ($dosen['id_dosen'] === $mahasiswa['dosen_pembimbing1']) {
                        // Check if the riset_group is already in groupedData
                        if (!isset($groupedData[$risetGroup['id_rg']])) {
                            // Initialize the riset_group entry with details and an empty mahasiswa array
                            $groupedData[$risetGroup['id_rg']] = [
                                'riset_group' => $risetGroup,
                                'mahasiswa' => [],
                            ];
                        }
    
                        // Add the mahasiswa to the corresponding riset_group entry
                        $groupedData[$risetGroup['id_rg']]['mahasiswa'][] = $mahasiswa;
                        break 2; // Break both inner loops
                    }
                }
            }
        }
    
        // Assign examiners to each mahasiswa
        foreach ($groupedData as &$group) {
            $dosenList = $group['riset_group']['dosen'];
    
            foreach ($group['mahasiswa'] as &$mahasiswa) {
                $dosenPembimbing1 = $mahasiswa['dosen_pembimbing1'];
                $dosenPembimbing2 = $mahasiswa['dosen_pembimbing2'] ?? null;
                $dosenPembimbing3 = $mahasiswa['dosen_pembimbing3'] ?? null;
    
                // Add names for pembimbing
                $mahasiswa['nama_dosen_pembimbing1'] = $dosenMap[$dosenPembimbing1] ?? null;
                $mahasiswa['nama_dosen_pembimbing2'] = $dosenMap[$dosenPembimbing2] ?? null;
                $mahasiswa['nama_dosen_pembimbing3'] = $dosenMap[$dosenPembimbing3] ?? null;
    
                $availableDosen = array_filter($dosenList, function($dosen) use ($dosenPembimbing1, $dosenPembimbing2, $dosenPembimbing3) {
                    return $dosen['id_dosen'] !== $dosenPembimbing1
                        && $dosen['id_dosen'] !== $dosenPembimbing2
                        && $dosen['id_dosen'] !== $dosenPembimbing3;
                });
    
                $availableDosen = array_values($availableDosen); // Re-index the array
    
                if (count($availableDosen) >= 2) {
                    $mahasiswa['penguji1'] = $availableDosen[0]['id_dosen'];
                    $mahasiswa['nama_penguji1'] = $availableDosen[0]['nama_dosen'];
                    $mahasiswa['penguji2'] = $availableDosen[1]['id_dosen'];
                    $mahasiswa['nama_penguji2'] = $availableDosen[1]['nama_dosen'];
                } elseif (count($availableDosen) === 1) {
                    $mahasiswa['penguji1'] = $availableDosen[0]['id_dosen'];
                    $mahasiswa['nama_penguji1'] = $availableDosen[0]['nama_dosen'];
                    $mahasiswa['penguji2'] = null;
                    $mahasiswa['nama_penguji2'] = null;
                } else {
                    $mahasiswa['penguji1'] = null;
                    $mahasiswa['nama_penguji1'] = null;
                    $mahasiswa['penguji2'] = null;
                    $mahasiswa['nama_penguji2'] = null;
                }
            }
        }
    
        // Group mahasiswa by their penguji (examiners)
        foreach ($groupedData as &$group) {
            $mahasiswaGroups = [];
    
            // Create groups based on penguji1 and penguji2
            foreach ($group['mahasiswa'] as $mahasiswa) {
                $key = $mahasiswa['penguji1'] . '-' . $mahasiswa['penguji2'];
                if (!isset($mahasiswaGroups[$key])) {
                    $mahasiswaGroups[$key] = [];
                }
                $mahasiswaGroups[$key][] = $mahasiswa;
            }
    
            // Distribute mahasiswa groups into available rooms
            $rooms = $group['riset_group']['ruang'];
            $roomCount = count($rooms);
            $groupKeys = array_keys($mahasiswaGroups);
            $groupCount = count($groupKeys);
    
            // Ensure we have at least one room for each group, or groups will be split across available rooms
            if ($roomCount > 0) {
                for ($i = 0; $i < $groupCount; $i++) {
                    $roomIndex = $i % $roomCount;
                    if (!isset($rooms[$roomIndex]['mahasiswa'])) {
                        $rooms[$roomIndex]['mahasiswa'] = [];
                    }
                    $rooms[$roomIndex]['mahasiswa'] = array_merge($rooms[$roomIndex]['mahasiswa'], $mahasiswaGroups[$groupKeys[$i]]);
                }
            }
    
            // Assign updated rooms back to the riset_group
            $group['riset_group']['ruang'] = $rooms;
        }

        // Create the new response array with only the required fields
        $response = [];
        foreach ($groupedData as $group) {
            foreach ($group['riset_group']['ruang'] as $ruang) {
                foreach ($ruang['mahasiswa'] as $mahasiswa) {
                    $response[] = [
                        'penguji_1' => $mahasiswa['penguji1'],
                        'penguji_2' => $mahasiswa['penguji2'],
                        'id_mhs' => $mahasiswa['id_mhs'],
                        'id_header' => $id_header,
                        'id_ruang' => $ruang['id_ruang'],
                    ];
                }
            }
        }
    
        // Send the response data to the database
        $postResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->post($this->supabaseUrl . '/rest/v1/data_generate', $response);
    
        // Check if the post request was successful
        if ($postResponse->failed()) {
            return response()->json(['error' => 'Failed to send data to the database'], 500);
        }
    
        session(['id_header' => $id_header]);
        return redirect('/proyek-akhir/generate-hasil/'.$id_header)->with('success', 'Data header berhasil disimpan.');
    }
    
    public function getDataGenerate()
    {

        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/header?select=*&order=created_at.desc');
        
        $headers = $response->json();
        return view('card', compact('headers'));
    }

    
}
