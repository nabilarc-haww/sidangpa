<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrp_mahasiswa',
        'nama_mahasiswa',
        'judul_pa',
        'dosen_pembimbing1',
        'dosen_pembimbing2',
        'dosen_pembimbing3',
        'penguji_mitra',
        'jurusan',
    ];
}
