<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;

class ProyekAkhirExport implements FromView, WithHeadings
{
    protected $finalResult;

    public function __construct(array $finalResult)
    {
        $this->finalResult = $finalResult;
    }

    public function view(): View
    {
        return view('export-generate', [
            'finalResult' => $this->finalResult
        ]);
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Prodi',
            'Tanggal',
            'Waktu',
            'Tahapan Sidang',
            'Tahun Ajaran',
            'Nama Ruang',
            'Nama Mahasiswa',
            'Judul PA',
            'Pembimbing 1',
            'Pembimbing 2',
            'Pembimbing 3',
            'Penguji 1',
            'Penguji 2'
        ];
    }
}
