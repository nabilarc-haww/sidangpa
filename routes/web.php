<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyekAkhirController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\RisetGroupController;
use App\Http\Controllers\PengumumanController;



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::get('/',function () {
    return view('home');
});

// Route::get('/proyek-akhir/jadwal',function () {
//     return view('jadwal');
// });
Route::get('/proyek-akhir/generate', [ProyekAkhirController::class, 'getData'])->name('proyek-akhir.getData');
Route::post('/store-header', [HeaderController::class, 'store'])->name('header.store');

Route::post('/proyek-akhir/import', [ProyekAkhirController::class, 'import'])->name('proyek-akhir.import');

// Route::get('/proyek-akhir/jadwal', function () {
//     return view('/proyek-akhir/generate');
// });

Route::get('/proyek-akhir/jadwal',function () {
    return view('jadwal');
});

Route::get('/riset-group', [RisetGroupController::class, 'getAllData']);

// Route::get('/dosen', [DosenController::class, 'getAllData']);
Route::get('/pengumuman',function () {
    return view('announce');
});

Route::get('/pengumuman', [PengumumanController::class, 'getDataAnnounce']);
Route::post('/pengumuman/tambah-pengumuman', [PengumumanController::class, 'tambahPengumuman'])->name('pengumuman.tambahPengumuman');
Route::get('/pengumuman/edit-pengumuman/{id}', [PengumumanController::class, 'editPengumuman'])->name('pengumuman.editPengumuman');
Route::post('/pengumuman/update-pengumuman/{id}', [PengumumanController::class, 'updatePengumuman'])->name('pengumuman.updatePengumuman');
Route::delete('/pengumuman/delete-penguman/{id}', [PengumumanController::class, 'deletePengumuman'])->name('pengumuman.deletePengumuman');


Route::get('/pengumuman/tambah',function () {
    return view('tambah_ann');
});