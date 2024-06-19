<?php
namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Http;

class ProyekAkhirExportMahasiswa implements FromView
{
    protected  $data_pa;

    public function __construct(array $data_pa)
    {
        $this->data_pa =  $data_pa;
    }

    public function view(): View
    {
        return view('proyek_akhir.eksport', [
            'data_pa' => $this->data_pa
        ]);
    }
}
