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
use PDF;

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
    
    // Group mahasiswa by riset_group based on dosen_pembimbing1
    foreach ($mahasiswaData as $mahasiswa) {
        foreach ($risetGroups as $risetGroup) {
            foreach ($risetGroup['dosen'] as $dosen) {
                if ($dosen['id_dosen'] === $mahasiswa['dosen_pembimbing1']) {
                    if (!isset($groupedData[$risetGroup['id_rg']])) {
                        $groupedData[$risetGroup['id_rg']] = [
                            'riset_group' => $risetGroup,
                            'mahasiswa' => [],
                        ];
                    }
                    $groupedData[$risetGroup['id_rg']]['mahasiswa'][] = $mahasiswa;
                    break 2; // Break both inner loops
                }
            }
        }
    }

    // Distribute mahasiswa into available rooms
    foreach ($groupedData as &$group) {
        $rooms = $group['riset_group']['ruang'];
        $roomCount = count($rooms);
        $mahasiswaList = $group['mahasiswa'];
        $mahasiswaCount = count($mahasiswaList);

        for ($i = 0; $i < $mahasiswaCount; $i++) {
            $roomIndex = $i % $roomCount;
            if (!isset($rooms[$roomIndex]['mahasiswa'])) {
                $rooms[$roomIndex]['mahasiswa'] = [];
            }
            $rooms[$roomIndex]['mahasiswa'][] = $mahasiswaList[$i];
        }

        // Assign updated rooms back to the riset_group
        $group['riset_group']['ruang'] = $rooms;
    }

    // Assign examiners to each mahasiswa ensuring no duplicate examiners across rooms
    foreach ($groupedData as &$group) {
        $dosenList = $group['riset_group']['dosen'];
        $assignedExaminers = [];

        foreach ($group['riset_group']['ruang'] as &$ruang) {
            $availableDosen = array_filter($dosenList, function($dosen) use ($assignedExaminers) {
                return !isset($assignedExaminers[$dosen['id_dosen']]);
            });

            $availableDosen = array_values($availableDosen); // Re-index the array

            foreach ($ruang['mahasiswa'] as &$mahasiswa) {
                $dosenPembimbing1 = $mahasiswa['dosen_pembimbing1'];
                $dosenPembimbing2 = $mahasiswa['dosen_pembimbing2'] ?? null;
                $dosenPembimbing3 = $mahasiswa['dosen_pembimbing3'] ?? null;
                
                // Add names for pembimbing
                $mahasiswa['nama_dosen_pembimbing1'] = $dosenMap[$dosenPembimbing1] ?? null;
                $mahasiswa['nama_dosen_pembimbing2'] = $dosenMap[$dosenPembimbing2] ?? null;
                $mahasiswa['nama_dosen_pembimbing3'] = $dosenMap[$dosenPembimbing3] ?? null;

                // Filter out pembimbing from available examiners
                $availableDosenForMahasiswa = array_filter($availableDosen, function($dosen) use ($dosenPembimbing1, $dosenPembimbing2, $dosenPembimbing3) {
                    return $dosen['id_dosen'] !== $dosenPembimbing1
                        && $dosen['id_dosen'] !== $dosenPembimbing2
                        && $dosen['id_dosen'] !== $dosenPembimbing3;
                });

                $availableDosenForMahasiswa = array_values($availableDosenForMahasiswa); // Re-index the array

                if (count($availableDosenForMahasiswa) >= 2) {
                    $mahasiswa['penguji1'] = $availableDosenForMahasiswa[0]['id_dosen'];
                    $mahasiswa['nama_penguji1'] = $availableDosenForMahasiswa[0]['nama_dosen'];
                    $mahasiswa['penguji2'] = $availableDosenForMahasiswa[1]['id_dosen'];
                    $mahasiswa['nama_penguji2'] = $availableDosenForMahasiswa[1]['nama_dosen'];
                    $assignedExaminers[$availableDosenForMahasiswa[0]['id_dosen']] = true;
                    $assignedExaminers[$availableDosenForMahasiswa[1]['id_dosen']] = true;
                } elseif (count($availableDosenForMahasiswa) === 1) {
                    $mahasiswa['penguji1'] = $availableDosenForMahasiswa[0]['id_dosen'];
                    $mahasiswa['nama_penguji1'] = $availableDosenForMahasiswa[0]['nama_dosen'];
                    $mahasiswa['penguji2'] = null;
                    $mahasiswa['nama_penguji2'] = null;
                    $assignedExaminers[$availableDosenForMahasiswa[0]['id_dosen']] = true;
                } else {
                    // Ensure there is no null value for examiners
                    if (!empty($availableDosen)) {
                        $mahasiswa['penguji1'] = $availableDosen[0]['id_dosen'];
                        $mahasiswa['nama_penguji1'] = $availableDosen[0]['nama_dosen'];
                        $mahasiswa['penguji2'] = $availableDosen[1]['id_dosen'] ?? null;
                        $mahasiswa['nama_penguji2'] = $availableDosen[1]['nama_dosen'] ?? null;
                        $assignedExaminers[$availableDosen[0]['id_dosen']] = true;
                        if (isset($availableDosen[1])) {
                            $assignedExaminers[$availableDosen[1]['id_dosen']] = true;
                        }
                    }
                }
            }
        }
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

    public function edit($id_jadwal_generate)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/data_generate', [
            'id_jadwal_generate' => 'eq.' . $id_jadwal_generate,
            'select' => '*,penguji_1(*),penguji_2(*),id_mhs(*,dosen_pembimbing1(*), dosen_pembimbing2(*), dosen_pembimbing3(*))'
        ]);

        $data = $response->json();

        if (empty($data)) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        
        $data_generate = $data[0];
        $id_header = $data_generate['id_header'];

        $dosenResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/dosen?select=*');

        $dosen = $dosenResponse->json();

        $ruangResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/ruang?select=*');

        $ruang = $ruangResponse->json();

        return view('edit', compact('data_generate', 'dosen', 'ruang',  'id_header'));
    }


    public function update(Request $request, $id_jadwal_generate)
    {
        $validatedData = $request->validate([
            'penguji_1' => 'required|uuid',
            'penguji_2' => 'required|uuid',
            'id_ruang' => 'required|uuid',
            'id_header' => 'required|uuid',
        ]);

        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
            'Content-Type' => 'application/json',
        ])->patch($this->supabaseUrl . '/rest/v1/data_generate?id_jadwal_generate=eq.' . $id_jadwal_generate, $validatedData);

        if ($response->successful()) {
            return redirect()->route('proyek-akhir.getdata', ['id_header' => $validatedData['id_header']])->with('success', 'Data updated successfully');
        } else {
            return redirect()->route('proyek-akhir.getdata', ['id_header' => $validatedData['id_header']])->with('error', 'Failed to update data');
        }
    }

    public function destroy($id_jadwal_generate)
    {
        DB::table('public.data_generate')->where('id_jadwal_generate', $id_jadwal_generate)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function downloadPDF($id_header)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
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

        $pdf = PDF::loadView('generate-pdf', compact('finalResult'));

        return $pdf->download('jadwal_sidang.pdf');
    }
    
}
