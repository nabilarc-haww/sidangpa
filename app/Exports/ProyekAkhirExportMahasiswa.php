<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProyekAkhirExportMahasiswa implements FromCollection, WithHeadings
{
    protected $data_pa;

    public function __construct(array $data_pa)
    {
        $this->data_pa = $data_pa;
    }

    public function collection()
    {
        $formattedData = [];

        foreach ($this->data_pa as $master) {
            foreach ($master['proyek_akhir'] as $data) {
                $formattedData[] = [
                    'nrp_mahasiswa' => $data['nrp_mahasiswa'],
                    'nama_mahasiswa' => $data['nama_mahasiswa'],
                    'judul_pa' => $data['judul_pa'],
                    'dosen_pembimbing1' => $data['dosen_pembimbing1']['id_dosen'] ?? '-',
                    'dosen_pembimbing2' => $data['dosen_pembimbing2']['id_dosen'] ?? '-',
                    'dosen_pembimbing3' => $data['dosen_pembimbing3']['id_dosen'] ?? '-',
                ];
            }
        }

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [
            'nrp_mahasiswa',
            'nama_mahasiswa',
            'judul_pa',
            'dosen_pembimbing1',
            'dosen_pembimbing2',
            'dosen_pembimbing3'
        ];
    }
}
