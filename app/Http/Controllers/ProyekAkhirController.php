<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProyekAkhirController extends Controller
{
    // public function getData()
    // {
    //     // Buat request ke Supabase menggunakan HTTP Client
    //     $response = Http::withHeaders([
    //         'apikey' => $this->supabaseApiKey,
    //     ])->get($this->supabaseUrl . '/rest/v1/proyek_akhir');

    //     $proyek_akhir = $response->json();
    //     // dd($proyek_akhir);

    //     return view('generate', compact('proyek_akhir'));
    // }

    // public function getData()
    // {
    //     // Fetch data from the provided URLs with API key in headers
    //     $risetGroupsResponse = Http::withHeaders([
    //         'apikey' => $this->supabaseApiKey,
    //     ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/riset_group?select=*,dosen(*),ruang(*)');
    
    //     $mahasiswaResponse = Http::withHeaders([
    //         'apikey' => $this->supabaseApiKey,
    //     ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/proyek_akhir_mhs?select=*');
    
    //     // Check if the data retrieval was successful
    //     if ($risetGroupsResponse->failed() || $mahasiswaResponse->failed()) {
    //         return response()->json(['error' => 'Failed to retrieve data from API'], 500);
    //     }
    
    //     // Get the JSON response from the API calls
    //     $risetGroups = $risetGroupsResponse->json();
    //     $mahasiswaData = $mahasiswaResponse->json();
    
    //     // Initialize combinedData array
    //     $combinedData = [];
    
    //     // Loop through each proyek_akhir_mhs entry
    //     foreach ($mahasiswaData as $mahasiswa) {
    //         // Find the corresponding riset_group based on dosen_pembimbing1
    //         foreach ($risetGroups as $risetGroup) {
    //             foreach ($risetGroup['dosen'] as $dosen) {
    //                 if ($dosen['id_dosen'] === $mahasiswa['dosen_pembimbing1']) {
    //                     // Combine data and add to combinedData array
    //                     $combinedData[] = [
    //                         'mahasiswa' => $mahasiswa,
    //                         'riset_group' => $risetGroup,
    //                     ];
    //                     break 2; // Break both inner loops
    //                 }
    //             }
    //         }
    //     }
    
    //     // Return the combined data
    //     return response()->json($combinedData);
    // }
    
    
    public function getData()
    {
        // Fetch data from the provided URLs with API key in headers
        $risetGroupsResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/riset_group?select=*,dosen(*),ruang(*)');

        $mahasiswaResponse = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/proyek_akhir_mhs?select=*');

        // Check if the data retrieval was successful
        if ($risetGroupsResponse->failed() || $mahasiswaResponse->failed()) {
            return response()->json(['error' => 'Failed to retrieve data from API'], 500);
        }

        // Get the JSON response from the API calls
        $risetGroups = $risetGroupsResponse->json();
        $mahasiswaData = $mahasiswaResponse->json();

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

        // Re-index the grouped data by riset_group id
        $groupedData = array_values($groupedData);

        // Return the grouped data
        return response()->json($groupedData);
    }
    

//===================================================
// public function getData()
// {
//     // Fetch data from the provided URLs with API key in headers
//     $risetGroupsResponse = Http::withHeaders([
//         'apikey' => $this->supabaseApiKey,
//     ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/riset_group?select=*,dosen(*),ruang(*)');

//     $mahasiswaResponse = Http::withHeaders([
//         'apikey' => $this->supabaseApiKey,
//     ])->get('https://ihpqktbogxquohofeevj.supabase.co/rest/v1/proyek_akhir_mhs?select=*');

//     // Check if the data retrieval was successful
//     if ($risetGroupsResponse->failed() || $mahasiswaResponse->failed()) {
//         return response()->json(['error' => 'Failed to retrieve data from API'], 500);
//     }

//     // Get the JSON response from the API calls
//     $risetGroups = $risetGroupsResponse->json();
//     $mahasiswaData = $mahasiswaResponse->json();

//     // Initialize combinedData array grouped by riset_group
//     $groupedData = [];

//     // Create a mapping of dosen id to dosen name for quick lookup
//     $dosenMap = [];
//     foreach ($risetGroups as $risetGroup) {
//         foreach ($risetGroup['dosen'] as $dosen) {
//             $dosenMap[$dosen['id_dosen']] = $dosen['nama_dosen'];
//         }
//     }

//     // Loop through each proyek_akhir_mhs entry
//     foreach ($mahasiswaData as $mahasiswa) {
//         // Find the corresponding riset_group based on dosen_pembimbing1
//         foreach ($risetGroups as $risetGroup) {
//             foreach ($risetGroup['dosen'] as $dosen) {
//                 if ($dosen['id_dosen'] === $mahasiswa['dosen_pembimbing1']) {
//                     // Check if the riset_group is already in groupedData
//                     if (!isset($groupedData[$risetGroup['id_rg']])) {
//                         // Initialize the riset_group entry with details and an empty mahasiswa array
//                         $groupedData[$risetGroup['id_rg']] = [
//                             'riset_group' => $risetGroup,
//                             'mahasiswa' => [],
//                         ];
//                     }

//                     // Add the mahasiswa to the corresponding riset_group entry
//                     $groupedData[$risetGroup['id_rg']]['mahasiswa'][] = $mahasiswa;
//                     break 2; // Break both inner loops
//                 }
//             }
//         }
//     }

//     // Assign examiners to each mahasiswa
//     foreach ($groupedData as &$group) {
//         $dosenList = $group['riset_group']['dosen'];
        
//         foreach ($group['mahasiswa'] as &$mahasiswa) {
//             $dosenPembimbing1 = $mahasiswa['dosen_pembimbing1'];
//             $dosenPembimbing2 = $mahasiswa['dosen_pembimbing2'] ?? null;
//             $dosenPembimbing3 = $mahasiswa['dosen_pembimbing3'] ?? null;

//             // Add names for pembimbing
//             $mahasiswa['nama_dosen_pembimbing1'] = $dosenMap[$dosenPembimbing1] ?? null;
//             $mahasiswa['nama_dosen_pembimbing2'] = $dosenMap[$dosenPembimbing2] ?? null;
//             $mahasiswa['nama_dosen_pembimbing3'] = $dosenMap[$dosenPembimbing3] ?? null;

//             $availableDosen = array_filter($dosenList, function($dosen) use ($dosenPembimbing1, $dosenPembimbing2, $dosenPembimbing3) {
//                 return $dosen['id_dosen'] !== $dosenPembimbing1 
//                     && $dosen['id_dosen'] !== $dosenPembimbing2 
//                     && $dosen['id_dosen'] !== $dosenPembimbing3;
//             });

//             $availableDosen = array_values($availableDosen); // Re-index the array

//             if (count($availableDosen) >= 2) {
//                 $mahasiswa['penguji1'] = $availableDosen[0]['id_dosen'];
//                 $mahasiswa['nama_penguji1'] = $availableDosen[0]['nama_dosen'];
//                 $mahasiswa['penguji2'] = $availableDosen[1]['id_dosen'];
//                 $mahasiswa['nama_penguji2'] = $availableDosen[1]['nama_dosen'];
//             } elseif (count($availableDosen) === 1) {
//                 $mahasiswa['penguji1'] = $availableDosen[0]['id_dosen'];
//                 $mahasiswa['nama_penguji1'] = $availableDosen[0]['nama_dosen'];
//                 $mahasiswa['penguji2'] = null;
//                 $mahasiswa['nama_penguji2'] = null;
//             } else {
//                 $mahasiswa['penguji1'] = null;
//                 $mahasiswa['nama_penguji1'] = null;
//                 $mahasiswa['penguji2'] = null;
//                 $mahasiswa['nama_penguji2'] = null;
//             }
//         }

//         // Group mahasiswa by dosen_pembimbing1 and assign them to rooms without duplicates
//         $rooms = [];
//         $mahasiswaIds = []; // To track added mahasiswa IDs
//         foreach ($group['mahasiswa'] as $mahasiswa) {
//             $dosenPembimbing1 = $mahasiswa['dosen_pembimbing1'];
//             if (!isset($rooms[$dosenPembimbing1])) {
//                 $rooms[$dosenPembimbing1] = [
//                     'dosen_pembimbing1' => $dosenMap[$dosenPembimbing1] ?? 'Unknown',
//                     'mahasiswa' => []
//                 ];
//             }
//             if (!in_array($mahasiswa['id_mhs'], $mahasiswaIds)) {
//                 $rooms[$dosenPembimbing1]['mahasiswa'][] = $mahasiswa;
//                 $mahasiswaIds[] = $mahasiswa['id_mhs']; // Add ID to tracking array
//             }
//         }

//         // Initialize ruang if not already initialized
//         if (!isset($group['riset_group']['ruang'])) {
//             $group['riset_group']['ruang'] = [];
//         }

//         // Distribute mahasiswa into rooms with a maximum of 7 per room
//         foreach ($rooms as $dosenPembimbing1 => $room) {
//             $chunks = array_chunk($room['mahasiswa'], 7);
//             foreach ($chunks as $chunk) {
//                 $group['riset_group']['ruang'][] = [
//                     'dosen_pembimbing1' => $room['dosen_pembimbing1'],
//                     'mahasiswa' => $chunk
//                 ];
//             }
//         }

//         unset($group['mahasiswa']); // Remove the ungrouped mahasiswa list
//     }

//     // Re-index the grouped data by riset_group id
//     $groupedData = array_values($groupedData);

//     // Return the grouped data
//     return response()->json($groupedData);
// }
    
    



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
