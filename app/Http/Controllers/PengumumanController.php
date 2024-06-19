<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class PengumumanController extends Controller
{
    public function getDataAnnounce()
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?select=*,attachment(*)&order=created_at.desc');
    
        $pengumuman = $response->json();

        return view('announce/announce', compact('pengumuman'));
    }

    public function showDetail($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?id_pengumuman=eq.' . $id . '&select=*,attachment(*)');

        $pengumuman = $response->json();

        return view('announce/detail_public', compact('pengumuman'));
    }

    public function getDataAnnounceDashboard()
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?select=*,attachment(*)&order=created_at.desc&status=eq.publish');
        
        $pengumuman = $response->json();
        
        return view('home', compact('pengumuman'));
    }


    public function tambahPengumuman(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'lampiran' => 'file|mimes:pdf,doc,docx|max:5120'
        ]);

        $id_pengumuman = Str::uuid();

        DB::table('public.pengumuman')->insert([
            'id_pengumuman' => $id_pengumuman,
            'judul_pengumuman' => $request->judul_pengumuman,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        if ($request->hasFile('gambar')) {
            $this->uploadAttachment($request->file('gambar'), 'file_gambar', $id_pengumuman);
        }

        if ($request->hasFile('lampiran')) {
            $this->uploadAttachment($request->file('lampiran'), 'file_lampiran', $id_pengumuman);
        }

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    private function uploadAttachment($file, $attachment_type, $id_pengumuman)
    {
        $client = new Client();
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $attachment_type . '/' . $fileName;
        
        $response = $client->request('POST', $this->supabaseUrl . '/storage/v1/object/attachment/' . $filePath, [
            'headers' => [
                'apikey' => $this->supabaseApiKey,
                'Authorization' => 'Bearer ' . $this->supabaseApiKey,
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($file->getPathname(), 'r'),
                    'filename' => $fileName,
                    'headers' => [
                        'Content-Type' => $file->getMimeType(),
                    ]
                ],
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $fileUrl = $this->supabaseUrl . '/storage/v1/object/public/attachment/' . $filePath;

            DB::table('public.attachment')->insert([
                'nama_file' => $fileName,
                'file_type' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'path' => $fileUrl,
                'attachment_type' => $attachment_type,
                'id_pengumuman' => $id_pengumuman,
            ]);
        } else {
            return back()->withErrors('File upload failed.');
        }
    }

    public function editPengumuman($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseApiKey,
        ])->get($this->supabaseUrl . '/rest/v1/pengumuman?id_pengumuman=eq.' . $id . '&select=*,attachment(*)');

        $pengumuman = $response->json();

        return view('announce/edit_ann', compact('pengumuman'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'gambar' => 'file|mimes:jpeg,png,jpg|max:2048',
            'lampiran' => 'file|mimes:pdf,doc,docx|max:5120'
        ]);

        DB::table('public.pengumuman')
            ->where('id_pengumuman', $id)
            ->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

        if ($request->hasFile('gambar')) {
            $this->uploadAttachment($request->file('gambar'), 'file_gambar', $id);
        }

        if ($request->hasFile('lampiran')) {
            $this->uploadAttachment($request->file('lampiran'), 'file_lampiran', $id);
        }

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function deletePengumuman(Request $request, $id)
    {
        DB::table('public.attachment')->where('id_pengumuman', $id)->delete();
        DB::table('public.pengumuman')->where('id_pengumuman', $id)->delete();
        
        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
